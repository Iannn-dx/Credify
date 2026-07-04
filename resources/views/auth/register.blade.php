<x-auth-split-layout>
    <div class="auth-stagger flex flex-col gap-6">
        <x-auth-split-header title="Welcome!"
            description="Create an account to access all features and manage your profile" />

        <x-auth-session-status class="auth-stagger-item mb-2 text-sm text-green-400" :status="session('status')" />

        <form method="POST" action="{{ route('register') }}" class="auth-stagger-item space-y-4">
            @csrf

            {{-- name --}}
            <div>
                <x-form-label for="name" class="auth-label"> Full Name</x-form-label>
                <x-form-input for="name" id="name" name="name" value="{{ old('email') }}"
                    placeholder="e.g Juan Dela Cruz" required autofocus autocomplete="name"
                    class="auth-input"></x-form-input>
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            {{-- email --}}
            <div>
                <x-form-label for="email" class="auth-label">Email Address</x-form-label>
                <x-form-input id="email" type="email" name="email" value="{{ old('email') }}"
                    placeholder="email@example.com" required autofocus autocomplete="username" class="auth-input" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            {{-- pass --}}
            <div>
                <x-form-label for="password" class="auth-label">Password</x-form-label>
                <x-form-input id="password" type="password" name="password" placeholder="••••••••••••" required
                    autocomplete="new-password" class="auth-input" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            {{-- confirm pass --}}
            <div>
                <x-form-label for="password_confirmation" class="auth-label">Confirm Password</x-form-label>
                <x-form-input id="password_confirmation" type="password" name="password_confirmation"
                    placeholder="••••••••••••" required autocomplete="new-password" class="auth-input" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <button type="submit" class="auth-button">
                Continue
            </button>
        </form>

        <x-p/>
    </div>
</x-auth-split-layout>
