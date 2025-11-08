<?php

namespace App\Livewire\Admin\Inventory;

use App\Models\Inventory;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Title('Manage Inventories')]
#[Layout('/livewire/layout/app')]
class ManageInventories extends Component
{
    use WithPagination;

    public $search = '';
    public $sortField = 'product_name';
    public $sortDirection = 'asc';
    public $statusFilter = 'all';
    public $showLowStockOnly = false;
    public $showExpiredOnly = false;

    // Form properties
    public $showForm = false;
    public $editingId = null;
    public $product_name = '';
    public $serial_number = '';
    public $quantity = 0;
    public $location = '';
    public $expiration_date = '';
    public $balance_remaining = 0;
    public $low_stock_threshold = 2;
    public $description = '';
    public $unit_price = '';
    public $supplier = '';
    public $status = 'active';

    protected $rules = [
        'product_name' => 'required|string|max:255',
        'serial_number' => 'required|string|max:255|unique:inventories,serial_number',
        'quantity' => 'required|integer|min:0',
        'location' => 'required|string|max:255',
        'expiration_date' => 'nullable|date|after:today',
        'balance_remaining' => 'required|integer|min:0',
        'low_stock_threshold' => 'required|integer|min:1',
        'description' => 'nullable|string',
        'unit_price' => 'nullable|numeric|min:0',
        'supplier' => 'nullable|string|max:255',
        'status' => 'required|in:active,inactive,expired',
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingStatusFilter()
    {
        $this->resetPage();
    }

    public function updatingShowLowStockOnly()
    {
        $this->resetPage();
    }

    public function updatingShowExpiredOnly()
    {
        $this->resetPage();
    }

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortDirection = 'asc';
        }
        $this->sortField = $field;
        $this->resetPage();
    }

    public function create()
    {
        $this->resetForm();
        $this->showForm = true;
        $this->editingId = null;
    }

    public function edit($id)
    {
        $inventory = Inventory::findOrFail($id);
        $this->editingId = $id;
        $this->product_name = $inventory->product_name;
        $this->serial_number = $inventory->serial_number;
        $this->quantity = $inventory->quantity;
        $this->location = $inventory->location;
        $this->expiration_date = $inventory->expiration_date ? $inventory->expiration_date->format('Y-m-d') : '';
        $this->balance_remaining = $inventory->balance_remaining;
        $this->low_stock_threshold = $inventory->low_stock_threshold;
        $this->description = $inventory->description;
        $this->unit_price = $inventory->unit_price;
        $this->supplier = $inventory->supplier;
        $this->status = $inventory->status;
        $this->showForm = true;
    }

    public function save()
    {
        $this->validate();

        $rules = $this->rules;
        if ($this->editingId) {
            $rules['serial_number'] = 'required|string|max:255|unique:inventories,serial_number,' . $this->editingId;
        }

        $data = [
            'product_name' => $this->product_name,
            'serial_number' => $this->serial_number,
            'quantity' => $this->quantity,
            'location' => $this->location,
            'expiration_date' => $this->expiration_date ?: null,
            'balance_remaining' => $this->balance_remaining,
            'low_stock_threshold' => $this->low_stock_threshold,
            'description' => $this->description,
            'unit_price' => $this->unit_price ?: null,
            'supplier' => $this->supplier,
            'status' => $this->status,
        ];

        if ($this->editingId) {
            Inventory::findOrFail($this->editingId)->update($data);
            session()->flash('message', 'Inventory item updated successfully!');
        } else {
            Inventory::create($data);
            session()->flash('message', 'Inventory item created successfully!');
        }

        $this->resetForm();
        $this->showForm = false;
    }

    public function delete($id)
    {
        Inventory::findOrFail($id)->delete();
        session()->flash('message', 'Inventory item deleted successfully!');
    }

    public function cancel()
    {
        $this->resetForm();
        $this->showForm = false;
    }

    private function resetForm()
    {
        $this->product_name = '';
        $this->serial_number = '';
        $this->quantity = 0;
        $this->location = '';
        $this->expiration_date = '';
        $this->balance_remaining = 0;
        $this->low_stock_threshold = 2;
        $this->description = '';
        $this->unit_price = '';
        $this->supplier = '';
        $this->status = 'active';
        $this->editingId = null;
    }

    public function render()
    {
        $query = Inventory::query();

        // Search functionality
        if ($this->search) {
            $query->where(function ($q) {
                $q->where('product_name', 'like', '%' . $this->search . '%')
                  ->orWhere('serial_number', 'like', '%' . $this->search . '%')
                  ->orWhere('location', 'like', '%' . $this->search . '%')
                  ->orWhere('supplier', 'like', '%' . $this->search . '%');
            });
        }

        // Status filter
        if ($this->statusFilter !== 'all') {
            $query->where('status', $this->statusFilter);
        }

        // Low stock filter
        if ($this->showLowStockOnly) {
            $query->lowStock();
        }

        // Expired items filter
        if ($this->showExpiredOnly) {
            $query->expired();
        }

        // Sorting
        $query->orderBy($this->sortField, $this->sortDirection);

        $inventories = $query->paginate(10);

        // Get summary statistics
        $stats = [
            'total' => Inventory::count(),
            'low_stock' => Inventory::lowStock()->count(),
            'expired' => Inventory::expired()->count(),
            'active' => Inventory::active()->count(),
        ];

        return view('livewire.admin.inventory.manage-inventories', compact('inventories', 'stats'));
    }
}
