<?php

namespace App\Livewire\Admin\Auth;

use App\Models\Log;
use App\Models\Rent;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Administrator Login')]
#[Layout('/livewire/layout/app')]

class Login extends Component
{
    #[Rule('required|email')]
    public string $email;

    #[Rule('required|min:8')]
    public string $password;

    public function mount()
    {
        if (Auth::check()) {
            Log::newLog('Logout', Auth::user()->name);
            Rent::query()->update(['notification_sent' => false]);
            Auth::logout();
            Session::invalidate();
            Session::regenerate();

            return redirect()->route('login');
        }
    }

    public function login()
    {
        $this->validate();

        try {
            if (Auth::attempt(['email' => $this->email, 'password' => $this->password])) {
                $this->reset();

                if (Auth::user()->role === 'Mechanic') {
                    return redirect('admin/en@workshop');
                }
                if (Auth::user()->role === 'Ensign' || Auth::user()->role === 'Camc') {
                    return redirect('admin/en@supplier');
                }
                if (Auth::user()->role === 'Accountant' || Auth::user()->role === 'Sales' || Auth::user()->role === 'Fleet') {
                    return redirect()->route('admin_Renting', ['lang' => 'en']);
                }
                \App\Models\Log::newLog('Login', Auth::user()->name.' logged in');

                return redirect('admin/en@dashboard');
            } else {
                return session()->flash('error', 'Wrong email or password.');
            }
        } catch (Exception $error) {
            Log::destroy('Not Connected To Database.', [
                'reason' => $error->getMessage(),
            ]);

            return session()->flash('error', 'Something went wrong.');
        }
    }

    public function render()
    {
        return view('livewire.admin.auth.login');
    }
}
