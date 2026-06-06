<x-guest-layout>
    <div class="card auth-card shadow-lg border-0">
        <div class="card-body">
            <div class="text-center">
                <a href="{{ route('movies.index') }}" class="auth-brand"> MovieFlix</a>
                <h2 class="auth-title">Welcome Back</h2>
                <p class="auth-subtitle">Sign in to your account to continue</p>
            </div>

            <!-- Session Status -->
            <x-auth-session-status class="alert alert-success" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email Address -->
                <div class="mb-3">
                    <label for="email" class="form-label">Email Address</label>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" placeholder="name@example.com">
                    @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <!-- Password -->
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Enter your password">
                    @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <!-- Remember Me & Forgot Password -->
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div class="form-check">
                        <input id="remember_me" type="checkbox" class="form-check-input" name="remember">
                        <label for="remember_me" class="form-check-label">Remember me</label>
                    </div>
                    @if (Route::has('password.request'))
                        <a class="text-decoration-none small text-primary" href="{{ route('password.request') }}">Forgot password?</a>
                    @endif
                </div>

                <!-- Submit Button -->
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary btn-lg">Sign In</button>
                </div>
            </form>

            <div class="auth-footer">
                Don't have an account? <a href="{{ route('register') }}">Create an account</a>
            </div>
        </div>
    </div>
</x-guest-layout>