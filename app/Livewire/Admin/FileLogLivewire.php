<?php

namespace App\Livewire\Admin;

use App\Models\FileLog;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class FileLogLivewire extends Component
{
    public $uploadFiles;

    public $uploadImages = [];

    public $uploadRenting;

    public $uploadSupplier;

    public $lang = 'en';

    public function mount()
    {
        App::setLocale($this->lang);
    }

    public function render()
    {
        $this->uploadImages = FileLog::all()->toArray();

        return view('livewire.file-log-livewire')->layout('/livewire/layout/app', ['lang' => $this->lang]);
    }

    public function uploadThis($path)
    {
        Storage::disk('do')->put(config('filesystems.disks.do.folder').'/'.config('app.env').'/'.$path, Storage::get($path));
    }

    public function reSyncImages()
    {
        foreach (Storage::allFiles('storage/uploads/images') as $item) {
            FileLog::updateOrCreate(['path' => $item], ['is_sync' => 0]);
        }
    }
}
