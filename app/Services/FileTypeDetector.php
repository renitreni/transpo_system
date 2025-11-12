<?php

declare(strict_types=1);

namespace App\Services;

/**
 * Service class for detecting file types based on extensions
 *
 * This class provides utilities to determine whether a file is
 * an image, video, document, or other media type based on its extension.
 */
class FileTypeDetector
{
    /**
     * Determine if the file is an image
     */
    public function isImage(string $filename): bool
    {
        return $this->hasExtension($filename, $this->getImageExtensions());
    }

    /**
     * Determine if the file is a video
     */
    public function isVideo(string $filename): bool
    {
        return $this->hasExtension($filename, $this->getVideoExtensions());
    }

    /**
     * Determine if the file is a document
     */
    public function isDocument(string $filename): bool
    {
        return $this->hasExtension($filename, $this->getDocumentExtensions());
    }

    /**
     * Determine if the file is media (image or video)
     */
    public function isMedia(string $filename): bool
    {
        return $this->isImage($filename) || $this->isVideo($filename);
    }

    /**
     * Get the storage directory based on file type
     */
    public function getStorageDirectory(string $filename): string
    {
        return $this->isMedia($filename) ? 'images' : 'files';
    }

    /**
     * Get the file extension
     */
    public function getExtension(string $filename): string
    {
        return strtolower(pathinfo($filename, PATHINFO_EXTENSION));
    }

    /**
     * Check if file has one of the specified extensions
     *
     * @param array<string> $extensions
     */
    private function hasExtension(string $filename, array $extensions): bool
    {
        $fileExtension = $this->getExtension($filename);

        return in_array($fileExtension, $extensions, true);
    }

    /**
     * Get image file extensions
     *
     * @return array<string>
     */
    private function getImageExtensions(): array
    {
        return ['jpg', 'jpeg', 'png', 'gif', 'webp', 'svg', 'bmp'];
    }

    /**
     * Get video file extensions
     *
     * @return array<string>
     */
    private function getVideoExtensions(): array
    {
        return ['mp4', 'mov', 'avi', 'webm', 'mkv'];
    }

    /**
     * Get document file extensions
     *
     * @return array<string>
     */
    private function getDocumentExtensions(): array
    {
        return ['pdf', 'doc', 'docx', 'xls', 'xlsx', 'txt'];
    }

    /**
     * Get all allowed image extensions
     *
     * @return array<string>
     */
    public function getAllowedImageExtensions(): array
    {
        return $this->getImageExtensions();
    }

    /**
     * Get all allowed document extensions
     *
     * @return array<string>
     */
    public function getAllowedDocumentExtensions(): array
    {
        return $this->getDocumentExtensions();
    }

    /**
     * Get MIME types for images
     *
     * @return array<string>
     */
    public function getImageMimeTypes(): array
    {
        return [
            'image/jpeg',
            'image/png',
            'image/gif',
            'image/webp',
            'image/svg+xml',
            'image/bmp',
        ];
    }

    /**
     * Get MIME types for documents
     *
     * @return array<string>
     */
    public function getDocumentMimeTypes(): array
    {
        return [
            'application/pdf',
            'application/msword',
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            'application/vnd.ms-excel',
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'text/plain',
        ];
    }
}
