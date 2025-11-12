<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\FileLog;
use App\Models\WarrantyFiles;
use Carbon\Carbon;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

/**
 * Service class for handling file uploads
 *
 * This service manages file uploads for warranty reports including
 * validation, storage, database persistence, and deletion.
 */
class FileUploadService
{
    private const MAX_FILE_SIZE = 10240; // 10MB in KB
    private const MAX_IMAGES_PER_UPLOAD = 10;

    /**
     * @var FileTypeDetector
     */
    private $fileTypeDetector;

    public function __construct(FileTypeDetector $fileTypeDetector)
    {
        $this->fileTypeDetector = $fileTypeDetector;
    }

    /**
     * Upload multiple image files
     *
     * @param array<UploadedFile> $images
     * @return array<int, string> Array of successfully uploaded file names
     * @throws \Exception
     */
    public function uploadImages(array $images, $reportId): array
    {
        if (empty($images)) {
            return [];
        }

        if (count($images) > self::MAX_IMAGES_PER_UPLOAD) {
            throw new \Exception("Maximum of " . self::MAX_IMAGES_PER_UPLOAD . " images allowed per upload");
        }

        $uploadedFiles = [];

        foreach ($images as $key => $image) {
            try {
                $this->validateImage($image);
                $fileName = $this->uploadImage($image, $key);
                $this->saveFileRecord($reportId, $fileName);
                $uploadedFiles[] = $fileName;
            } catch (\Exception $e) {
                // Log error and continue with other files
                Log::error('Image upload failed', [
                    'file' => $image->getClientOriginalName(),
                    'error' => $e->getMessage(),
                ]);

                // Rollback uploaded files on first failure
                $this->rollbackUploadedFiles($uploadedFiles, 'images');
                throw new \Exception("Failed to upload image: " . $e->getMessage());
            }
        }

        return $uploadedFiles;
    }

    /**
     * Upload a single document file
     *
     * @throws \Exception
     */
    public function uploadDocument(UploadedFile $file, $reportId): string
    {
        try {
            $this->validateDocument($file);
            $fileName = $this->uploadFile($file);
            $this->saveFileRecord($reportId, $fileName);

            return $fileName;
        } catch (\Exception $e) {
            Log::error('Document upload failed', [
                'file' => $file->getClientOriginalName(),
                'error' => $e->getMessage(),
            ]);

            throw new \Exception("Failed to upload document: " . $e->getMessage());
        }
    }

    /**
     * Delete a file from storage and database
     *
     * @throws \Exception
     */
    public function deleteFile(int $fileId): void
    {
        try {
            $file = WarrantyFiles::findOrFail($fileId);
            $directory = $this->fileTypeDetector->getStorageDirectory($file->FileName);
            $filePath = "uploads/{$directory}/{$file->FileName}";

            // Delete from storage
            if (Storage::disk('public')->exists($filePath)) {
                Storage::disk('public')->delete($filePath);

                // Log file deletion for sync
                FileLog::updateOrCreate(
                    ['path' => storage_path("app/public/{$filePath}")],
                    [
                        'path' => storage_path("app/public/{$filePath}"),
                        'is_sync' => 3,
                    ]
                );
            }

            // Delete database record
            $file->delete();
        } catch (\Exception $e) {
            Log::error('File deletion failed', [
                'file_id' => $fileId,
                'error' => $e->getMessage(),
            ]);

            throw new \Exception("Failed to delete file: " . $e->getMessage());
        }
    }

    /**
     * Validate image file
     *
     * @throws \Exception
     */
    private function validateImage(UploadedFile $file): void
    {
        // Check file size
        if ($file->getSize() > self::MAX_FILE_SIZE * 1024) {
            throw new \Exception("Image file size exceeds maximum allowed size of " . self::MAX_FILE_SIZE . "KB");
        }

        // Validate MIME type
        $allowedMimeTypes = $this->fileTypeDetector->getImageMimeTypes();
        if (!in_array($file->getMimeType(), $allowedMimeTypes, true)) {
            throw new \Exception("Invalid image file type. Allowed types: jpg, jpeg, png, gif, webp, svg, bmp");
        }

        // Validate extension
        $extension = strtolower($file->getClientOriginalExtension());
        $allowedExtensions = $this->fileTypeDetector->getAllowedImageExtensions();
        if (!in_array($extension, $allowedExtensions, true)) {
            throw new \Exception("Invalid image file extension");
        }
    }

    /**
     * Validate document file
     *
     * @throws \Exception
     */
    private function validateDocument(UploadedFile $file): void
    {
        // Check file size
        if ($file->getSize() > self::MAX_FILE_SIZE * 1024) {
            throw new \Exception("Document file size exceeds maximum allowed size of " . self::MAX_FILE_SIZE . "KB");
        }

        // Validate MIME type
        $allowedMimeTypes = $this->fileTypeDetector->getDocumentMimeTypes();
        if (!in_array($file->getMimeType(), $allowedMimeTypes, true)) {
            throw new \Exception("Invalid document file type");
        }

        // Validate extension
        $extension = strtolower($file->getClientOriginalExtension());
        $allowedExtensions = $this->fileTypeDetector->getAllowedDocumentExtensions();
        if (!in_array($extension, $allowedExtensions, true)) {
            throw new \Exception("Invalid document file extension");
        }
    }

    /**
     * Upload an image file to storage
     */
    private function uploadImage(UploadedFile $file, int $index): string
    {
        $fileName = $this->generateFileName($file, $index);
        $file->storeAs('uploads/images', $fileName, 'public');

        return $fileName;
    }

    /**
     * Upload a document file to storage
     */
    private function uploadFile(UploadedFile $file): string
    {
        $fileName = $this->generateFileName($file);
        $file->storeAs('uploads/files', $fileName, 'public');

        return $fileName;
    }

    /**
     * Generate a unique filename
     */
    private function generateFileName(UploadedFile $file, ?int $index = null): string
    {
        $timestamp = Carbon::now()->timestamp;
        $uniqueId = uniqid();
        $extension = $file->getClientOriginalExtension();

        // Sanitize and add index if provided
        $sanitizedName = $index !== null ? "_{$index}" : '';

        return "{$timestamp}{$uniqueId}{$sanitizedName}.{$extension}";
    }

    /**
     * Save file record to database
     */
    private function saveFileRecord($reportId, $fileName): void
    {
        $file = new WarrantyFiles();
        $file->Report_id = $reportId;
        $file->FileName = $fileName;
        $file->save();
    }

    /**
     * Rollback uploaded files in case of failure
     *
     * @param array<string> $fileNames
     */
    private function rollbackUploadedFiles(array $fileNames, string $directory): void
    {
        foreach ($fileNames as $fileName) {
            try {
                $filePath = "uploads/{$directory}/{$fileName}";
                if (Storage::disk('public')->exists($filePath)) {
                    Storage::disk('public')->delete($filePath);
                }
            } catch (\Exception $e) {
                Log::error('Failed to rollback file', [
                    'file' => $fileName,
                    'error' => $e->getMessage(),
                ]);
            }
        }
    }
}
