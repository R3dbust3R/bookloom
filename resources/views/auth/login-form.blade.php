<x-layout>

{{-- login form --}}
<section class="login py-5">
    <div class="container">
        <h2 class="text-center text-capitalize mb-4">Login</h2>
        <form action="{{ route('login.submit') }}" method="POST" class="border bg-light rounded-4 m-auto w-75 p-5">
            @csrf

            @session('error')
                <div class="alert alert-danger mb-3">
                    {{ session('error') }}
                </div>
            @endsession

            @session('success')
                <div class="alert alert-success mb-3">
                    {{ session('success') }}
                </div>
            @endsession

            <div class="form-group mb-3">
                <input type="text" class="form-control rounded-pill" placeholder="Email Address" name="email">
            </div>

            <div class="form-group mb-3">
                <input type="password" class="form-control rounded-pill" placeholder="Password" name="password">
                @error('email') <p class="text-danger">{{ $message }}</p> @enderror
            </div>

            <div class="form-group mb-3">
                <input type="checkbox" id="remember" name="remember">
                <label class="text-muted" for="remember">Remember me</label>
            </div>

            <div class="form-group mb-3">
                <input type="submit" class="btn btn-primary rounded-pill px-4" value="Login">
            </div>

            <div class="form-group">
                <p class="text-muted">
                    Do not have an account?
                    <a href="{{ route('auth.signup-form') }}">Create one</a>
                </p>
            </div>

        </form>
    </div>
</section>
{{-- login form --}}



</x-layout>