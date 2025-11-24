<section class="w-full">
    <div class="flex items-center justify-between pr-5">
        <h1 class="text-2xl font-bold">Administrators</h1>
        <div class="flex gap-2">
            {{-- @include('livewire.admin.inquire.includes.search-box') --}}
            <button x-on:click='$dispatch("open-modal","add-admin")'
                class="gap-1 bg-white shadow hover:bg-blue-500 hover:text-white btn">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M18 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0ZM3 19.235v-.11a6.375 6.375 0 0 1 12.75 0v.109A12.318 12.318 0 0 1 9.374 21c-2.331 0-4.512-.645-6.374-1.766Z" />
                </svg>

                <span class="text-sm">Add User</span>
            </button>
        </div>
    </div>
    @include('success.success')
    <div class="flex w-full overflow-x-auto mt-7">
        <table class="table w-full table-compact">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Role</th>
                    <th>Email</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @forelse ($users as $user)
                    <tr>
                        <th>{{ $user->name }}</th>
                        <td>{{ $user->role }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            <button wire:confirm='Are you sure to delete {{ $user->role }} {{ $user->name }}?'
                                wire:click='delete({{ $user }})' class="text-xs text-rose-600">Delete</button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="12"> No admins</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <x-modal focusable maxWidth="md" name='add-admin' :show="false">
        <div class="p-6">
            <div class="mb-4">
                <h1 class="text-lg font-medium">Add User</h1>
                <small>All fields are required.</small>
            </div>
            <form wire:submit='save' class="space-y-2">
                <div class="flex flex-col">
                    <label>Name</label>
                    <input wire:model='name' type="text" class="border rounded shadow border-black/10" required>
                    @error('name')
                        <small class="italic text-rose-600">{{ $message }}</small>
                    @enderror
                </div>

                <div class="flex flex-col">
                    <label>Email</label>
                    <input wire:model='email' type="email" class="border rounded shadow border-black/10" required>
                    @error('email')
                        <small class="italic text-rose-600">{{ $message }}</small>
                    @enderror

                </div>

                <div class="flex flex-col">
                    <label>Role</label>
                    <select wire:model='role' class="border rounded shadow border-black/10" required>
                        <option value="" selected>Select Role</option>
                        <option value="Admin">Admin</option>
                        <option value="Mechanic">Mechanic</option>
                        <option value="FAW">FAW</option>
                        <option value="OTHER">OTHER</option>
                        <option value="Accountant">Accountant</option>
                        <option value="Sales">Sales</option>
                        <option value="Fleet">Fleet</option>
                    </select>
                    @error('role')
                        <small class="italic text-rose-600">{{ $message }}</small>
                    @enderror
                </div>

                <div class="flex flex-col">
                    <label>Password</label>
                    <input wire:model='password' type="password" class="border rounded shadow border-black/10" required>
                    @error('password')
                        <small class="italic text-rose-600">{{ $message }}</small>
                    @enderror
                </div>

                <div class="flex justify-end py-3">
                    <button type="submit" class="btn btn-primary">Create Account</button>
                </div>
            </form>
        </div>
    </x-modal>
</section>
