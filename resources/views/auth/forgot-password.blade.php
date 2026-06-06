<x-guest-layout>
    <div class="card auth-card shadow-lg border-0">
        <div class="card-body">
            <div class="text-center">
                <a href="{{ route('movies.index') }}" class="auth-brand">🎬 MovieFlix</a>
                <h2 class="auth-title">Forgot Password</h2>
                <p class="auth-subtitle">Enter your email to receive a reset link</p>
            </div>

            <!-- Session Status -->
            <x-auth-session-status class="alert alert-success" :status="session('status')" />

            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <!-- Email Address -->
                <div class="mb-4">
                    <label for="email" class="form-label">Email Address</label>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" placeholder="name@example.com">
                    @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <!-- Submit Button -->
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary btn-lg">Email Password Reset Link</button>
                </div>
            </form>

            <div class="auth-footer">
                Remember your password? <a href="{{ route('login') }}">Sign in</a>
            </div>
        </div>
    </div>
</x-guest-layout>