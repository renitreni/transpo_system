<?php

namespace App\Livewire\Admin\Admins;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;

#[Title('Administrators')]
#[Layout('/livewire/layout/app')]
class Users extends Component
{
    #[Validate('required|min:3')]
    public string $name;

    #[Validate('required|email')]
    public string $email;

    #[Validate('required')]
    public string $role;

    #[Validate('required|min:8')]
    public string $password;

    public function save(): void
    {
        $this->validate();
        User::create([
            'name' => $this->name,
            'role' => $this->role,
            'email' => $this->email,
            'password' => Hash::make($this->password),
        ]);
        session()->flash('success', "{$this->role} {$this->name} account has been created.");
        $this->dispatch('close-modal', 'add-admin');
        $this->reset();
    }

    public function delete(User $user)
    {
        session()->flash('success', "{$user->role} {$user->name} account has been deleted.");
        $user->delete();
    }

    public function render()
    {
        return view('livewire.admin.admins.users', [
            'users' => User::all(),
        ]);
    }
}
