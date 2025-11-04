<?php

namespace App\Livewire\Admin\Dashboard;

use App\Models\Customer;
use App\Models\Inquire;
use App\Models\Log;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Dashboard')]

class Dashboard extends Component
{
    public $data_deliveries;

    public $currentInquiries;

    public $previousInquiries;

    public $currentMonthDeliveries;

    public $previousMonthDeliveries;

    public $logs;

    public $lang = 'en';

    public function mount($lang)
    {
        $monthsAgo = now()->subMonths(4);
        $currentYear = now()->year;
        $currentMonth = now()->month;
        $previousMonth = now()->subMonth()->month;

        $this->displayNumberOfDelivies($monthsAgo, $currentYear, $currentMonth, $previousMonth);
        $this->displayNumberOfInquiries($currentYear, $currentMonth, $previousMonth);

        // LOGS
        $this->logs = Log::latest()->limit(15)->get();
        $this->lang = $lang;
        App::setLocale($lang);
    }

    public function render()
    {
        return view('livewire.admin.dashboard.dashboard')->layout('/livewire/layout/app', ['lang' => $this->lang]);
    }

    private function displayNumberOfDelivies($monthsAgo, $currentYear, $currentMonth, $previousMonth)
    {
        $this->data_deliveries = Customer::select(DB::raw('count(id) as `data`'), DB::raw("DATE_FORMAT(OrderDate, '%m-%Y') as monthYear"))
            ->where('OrderDate', '>=', $monthsAgo)
            ->groupBy('monthYear')
            ->orderBy('monthYear', 'ASC')
            ->get()
            ->pluck('data', 'monthYear');

        $this->data_deliveries = $this->data_deliveries->mapWithKeys(function ($data, $monthYear) {
            [$month, $year] = explode('-', $monthYear);

            return [date('F', mktime(0, 0, 0, $month, 10)).' '.$year => $data];
        });

        $this->currentMonthDeliveries = Customer::whereYear('OrderDate', $currentYear)
            ->whereMonth('OrderDate', $currentMonth)
            ->count();

        $this->previousMonthDeliveries = Customer::whereYear('OrderDate', $currentYear)
            ->whereMonth('OrderDate', $previousMonth)
            ->count();
    }

    private function displayNumberOfInquiries($currentYear, $currentMonth, $previousMonth)
    {
        $this->currentInquiries = Inquire::whereYear('created_at', $currentYear)
            ->whereMonth('created_at', $currentMonth)
            ->count();

        $this->previousInquiries = Inquire::whereYear('created_at', $currentYear)
            ->whereMonth('created_at', $previousMonth)
            ->count();
    }
}
