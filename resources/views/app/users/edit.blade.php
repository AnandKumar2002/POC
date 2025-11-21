<x-layouts.admin title="Edit User" description="Edit user details" keywords="users,management,admin"
    ogImage="{{ asset('images/og-default.png') }}">

    <div class="max-w-6xl mx-auto py-6 lg:px-8">
        <div class="mb-4 flex items-center justify-between">
            <h1 class="text-2xl font-semibold">Edit User</h1>
        </div>

        {{-- Validation Summary --}}
        @if ($errors->any())
            <div class="p-4 mb-6 bg-red-100 text-red-700 rounded">
                <strong>There were some problems with your input:</strong>
                <ul class="mt-2 list-disc pl-6 space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data"
            class="rounded-lg shadow-lg p-6 sm:p-8 space-y-6 border border-gray-200">
            @csrf
            @method('PUT')

            {{-- User Info --}}
            <h2 class="text-xl font-semibold">User Information</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                {{-- Username --}}
                <flux:input type="text" name="username" label="Username" value="{{ old('username', $user->username) }}"
                    placeholder="Enter username" required />

                {{-- Email --}}
                <flux:input type="email" name="email" label="Email" value="{{ old('email', $user->email) }}"
                    placeholder="Enter email" required />

                {{-- Role --}}
                <flux:select name="role" label="Role" placeholder="Choose role...">
                    @foreach ($roles as $role)
                        <flux:select.option value="{{ $role->id }}" @selected(
                            old('role', optional($user)->role_id) ==
                            $role->id
                        )>
                            {{ ucfirst($role->name) }}
                        </flux:select.option>
                    @endforeach
                </flux:select>

                {{-- Password --}}
                <flux:input type="password" name="password" label="Password (Leave blank to keep current)"
                    placeholder="Enter new password" revealable />

                {{-- Referral Code --}}
                <flux:input type="text" name="referral_code" label="Referral Code"
                    value="{{ old('referral_code', $user->referral_code) }}"
                    placeholder="Enter referral code (optional)" />

                {{-- Referred By --}}
                <flux:select name="referred_by" label="Referred By" placeholder="Select referring user...">
                    <flux:select.option value="">None</flux:select.option>
                    @foreach ($users as $refUser)
                        <flux:select.option value="{{ $refUser->id }}" @selected(
                            old('referred_by', $user->referred_by) ==
                            $refUser->id
                        )>
                            {{ $refUser->username }}
                        </flux:select.option>
                    @endforeach
                </flux:select>
            </div>

            {{-- Profile Details --}}
            <h2 class="text-xl font-semibold">Profile Details</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                {{-- Profile Photo --}}
                <flux:input type="file" name="profile_photo_path" label="Profile Photo" accept="image/*" />

                {{-- First Name --}}
                <flux:input type="text" name="first_name" label="First Name"
                    value="{{ old('first_name', optional($user->profile)->first_name) }}"
                    placeholder="Enter first name" />

                {{-- Last Name --}}
                <flux:input type="text" name="last_name" label="Last Name"
                    value="{{ old('last_name', optional($user->profile)->last_name) }}" placeholder="Enter last name" />

                {{-- Gender --}}
                <flux:select name="gender" label="Gender" placeholder="Choose gender...">
                    <flux:select.option @selected(old('gender', optional($user->profile)->gender) === 'Male')>Male
                    </flux:select.option>
                    <flux:select.option @selected(old('gender', optional($user->profile)->gender) === 'Female')>Female
                    </flux:select.option>
                    <flux:select.option @selected(
                        old('gender', optional($user->profile)->gender) ===
                        'Other'
                    )>Other</flux:select.option>
                </flux:select>

                {{-- Phone --}}
                <flux:input type="text" name="phone" label="Phone"
                    value="{{ old('phone', optional($user->profile)->phone) }}" placeholder="Enter phone number" />

                {{-- DOB --}}
                <flux:input type="date" name="dob" label="Date of Birth"
                    value="{{ old('dob', optional($user->profile)->date_of_birth?->format('Y-m-d')) }}"
                    placeholder="Select date of birth" />

                {{-- City --}}
                <flux:input type="text" name="city" label="City"
                    value="{{ old('city', optional($user->profile)->city) }}" placeholder="Enter city" />

                {{-- State --}}
                <flux:input type="text" name="state" label="State"
                    value="{{ old('state', optional($user->profile)->state) }}" placeholder="Enter state" />

                {{-- Country --}}
                <flux:input type="text" name="country" label="Country"
                    value="{{ old('country', optional($user->profile)->country) }}" placeholder="Enter country" />

                {{-- ZIP --}}
                <flux:input type="text" name="zip_code" label="ZIP Code"
                    value="{{ old('zip_code', optional($user->profile)->zip_code) }}" placeholder="Enter ZIP code" />

                {{-- Address --}}
                <flux:input type="textarea" name="address" label="Address"
                    value="{{ old('address', optional($user->profile)->address) }}" placeholder="Enter address"
                    class="col-span-3" />

                {{-- Bio --}}
                <flux:input type="textarea" name="bio" label="Bio"
                    value="{{ old('bio', optional($user->profile)->bio) }}" placeholder="Tell us about the user"
                    class="col-span-3" />
            </div>

            {{-- Social Links --}}
            <h2 class="text-xl font-semibold">Social Links</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                <flux:input type="text" name="facebook" label="Facebook"
                    value="{{ old('facebook', optional($user->profile)->facebook) }}"
                    placeholder="Enter Facebook link" />
                <flux:input type="text" name="twitter" label="Twitter"
                    value="{{ old('twitter', optional($user->profile)->twitter) }}" placeholder="Enter Twitter link" />
                <flux:input type="text" name="linkedin" label="LinkedIn"
                    value="{{ old('linkedin', optional($user->profile)->linkedin) }}"
                    placeholder="Enter LinkedIn link" />
            </div>

            {{-- Actions --}}
            <div class="flex flex-col sm:flex-row gap-4 mt-6">
                <flux:button type="submit" variant="primary" class="cursor-pointer" icon="check-circle">
                    Update
                </flux:button>
                <a href="{{ route('users.index') }}"
                    class="inline-flex items-center justify-center border rounded px-4 py-2">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</x-layouts.admin>