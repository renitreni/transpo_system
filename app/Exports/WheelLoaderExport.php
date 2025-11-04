<?php

namespace App\Exports;

use App\Models\WheelLoader;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class WheelLoaderExport implements FromView, ShouldAutoSize, WithEvents
{
    private string $model = '';

    private string $status = '';

    public function __construct(?string $model = '', ?string $status = '')
    {
        $this->model = $model;
        $this->status = $status;
    }

    public function view(): View
    {
        $WheelLoader = [];
        if ($this->model !== '') {
            $WheelLoader = WheelLoader::where('BrandModel', $this->model)->get();
        }

        if ($this->status !== '') {
            $WheelLoader = WheelLoader::where('isActive', $this->status)->get();
        }

        if ($this->model !== '' && $this->status !== '') {
            $WheelLoader = WheelLoader::oldest()->where('BrandModel', $this->model)->where('isActive', $this->status)->get();
        }

        if ($this->model === '' && $this->status === '') {
            $WheelLoader = WheelLoader::oldest()->get();
        }

        return view('livewire.admin.stock.component.excels.excel-wheelloader',
            [
                'trucks' => $WheelLoader,
            ]);
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $event->sheet->getDelegate()->setShowGridlines(false);
            },
        ];
    }
}
