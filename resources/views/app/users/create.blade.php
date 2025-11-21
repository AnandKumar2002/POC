<x-layouts.admin title="Users" description="Manage your users efficiently" keywords="users,management,admin"
    ogImage="{{ asset('images/og-default.png') }}">

    <div class="max-w-6xl mx-auto py-6 lg:px-8">
        <div class="mb-4 flex items-center justify-between">
            <h1 class="text-2xl font-semibold">Create User</h1>
        </div>

        <form action="{{ route('users.store') }}" method="POST"
            class="rounded-lg shadow-lg p-6 sm:p-8 space-y-6 border border-gray-200">
            @csrf

            {{-- User Info --}}
            <h2 class="text-xl font-semibold">User Information</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                <flux:input type="text" label="Username" name="username" value="{{ old('username') }}"
                    placeholder="Enter username" required />

                <flux:input type="email" label="Email" name="email" value="{{ old('email') }}" placeholder="Enter email"
                    required />

                <flux:select wire:model="role" label="Role" placeholder="Choose role...">
                    @foreach ($roles as $role)
                        <flux:select.option value="{{ $role->id }}">
                            {{ ucfirst($role->name) }}
                        </flux:select.option>
                    @endforeach
                </flux:select>

                <flux:input type="password" label="Password" name="password" placeholder="Enter password" viewable
                    required />

                <flux:input type="text" wire:model="referral_code" label="Referral Code"
                    placeholder="Enter referral code (optional)" />

                <flux:select wire:model="referred_by" label="Referred By" placeholder="Select referring user...">
                    @foreach ($users as $user)
                        <flux:select.option value="{{ $user->id }}">
                            {{ $user->username }}
                        </flux:select.option>
                    @endforeach
                </flux:select>
            </div>

            {{-- Profile Details --}}
            <h2 class="text-xl font-semibold">Profile Details</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                <flux:input type="file" wire:model="profile_photo_path" label="Profile Photo" accept="image/*" />

                <flux:input type="text" label="First Name" name="first_name" value="{{ old('first_name') }}"
                    placeholder="Enter first name" />

                <flux:input type="text" label="Last Name" name="last_name" value="{{ old('last_name') }}"
                    placeholder="Enter last name" />

                <flux:select wire:model="gender" label="Gender" placeholder="Choose gender...">
                    <flux:select.option>Male</flux:select.option>
                    <flux:select.option>Female</flux:select.option>
                    <flux:select.option>Other</flux:select.option>
                </flux:select>

                <flux:input type="text" label="Phone" name="phone" value="{{ old('phone') }}"
                    placeholder="Enter phone number" />

                <flux:input type="date" label="Date of Birth" name="dob" value="{{ old('dob') }}"
                    placeholder="Select date of birth" />


                <flux:input type="text" label="City" name="city" value="{{ old('city') }}" placeholder="Enter city" />

                <flux:input type="text" label="State" name="state" value="{{ old('state') }}"
                    placeholder="Enter state" />

                <flux:input type="text" label="Country" name="country" value="{{ old('country') }}"
                    placeholder="Enter country" />

                <flux:input type="text" label="ZIP Code" name="zip_code" value="{{ old('zip_code') }}"
                    placeholder="Enter ZIP code" />

                <flux:input type="textarea" label="Address" name="address" value="{{ old('address') }}"
                    placeholder="Enter address" class="col-span-1 sm:col-span-2 lg:col-span-3" />

                <flux:input type="textarea" label="Bio" name="bio" value="{{ old('bio') }}"
                    placeholder="Tell us about the user" class="col-span-1 sm:col-span-2 lg:col-span-3" />
            </div>

            {{-- Social Links --}}
            <h2 class="text-xl font-semibold">Social Links</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                <flux:input type="text" label="Facebook" name="facebook" value="{{ old('facebook') }}"
                    placeholder="Enter Facebook link" />

                <flux:input type="text" label="Twitter" name="twitter" value="{{ old('twitter') }}"
                    placeholder="Enter Twitter link" />

                <flux:input type="text" label="LinkedIn" name="linkedin" value="{{ old('linkedin') }}"
                    placeholder="Enter LinkedIn link" />
            </div>

            {{-- Actions --}}
            <div class="flex flex-col sm:flex-row gap-4 mt-6">
                <flux:button type="submit" variant="primary" class="cursor-pointer" icon="check-circle">
                    Create
                </flux:button>
                <a href="{{ route('users.index') }}"
                    class="inline-flex items-center justify-center border rounded px-4 py-2">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</x-layouts.admin>