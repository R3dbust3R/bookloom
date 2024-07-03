<x-layout>

{{-- page title & alerts --}}
<div class="container">
    <h1 class="page-title main=title my-4">Settings</h1>

    @session('error')
        <div class="alert alert-danger mb-3">
            <i class="fa-solid fa-triangle-exclamation"></i> {{ session('error') }}
        </div>
    @endsession

    @session('success')
        <div class="alert alert-success mb-3">
            <i class="fa-solid fa-circle-check"></i> {{ session('success') }}
        </div>
    @endsession
</div>
{{-- page title & alerts --}}

{{-- info form --}}
<section class="container bg-light border rounded-4 p-4 mb-4">
    <h2 class="section-title mb-5">Edit your info</h2>
    <form action="{{ route('user.settings.update-info') }}" method="POST" class="">
        @csrf
        <div class="row">

            <div class="col-md-6">
                <div class="form-group mb-3">
                    <input 
                        type="text" 
                        class="form-control rounded-pill" 
                        placeholder="Name (Required)" 
                        value="{{ old('name', $user->name) }}"
                        name="name">
                    @error('name') <p class="text-danger"> {{ $message }} </p> @enderror
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group mb-3">
                    <input 
                        type="text" 
                        class="form-control rounded-pill" 
                        placeholder="Username (Required)" 
                        value="{{ old('username', $user->username) }}"
                        name="username">
                    @error('username') <p class="text-danger"> {{ $message }} </p> @enderror
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group mb-3">
                    <input 
                        type="text" 
                        class="form-control rounded-pill" 
                        placeholder="Email (Required)" 
                        value="{{ old('email', $user->email) }}"
                        name="email">
                    @error('email') <p class="text-danger"> {{ $message }} </p> @enderror
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group mb-3">
                    <select 
                        class="form-control rounded-pill"
                        name="gender_id">
                        <option value="0">Select your gender</option>
                        @foreach ($genders as $gender)
                            <option class="text-capitalize" {{ ($gender->id == $user->gender_id) ? 'SELECTED' : '' }} value="{{ $gender->id }}"> {{ $gender->name }} </option>
                        @endforeach
                    </select>
                    @error('gender_id') <p class="text-danger"> {{ $message }} </p> @enderror
                </div>
            </div>

            <div class="col-md-12">
                <div class="form-group mb-3">
                    <input 
                        type="date" 
                        class="form-control rounded-pill"
                        name="birth_date"
                        value="{{ \Carbon\Carbon::parse($user->birth_date)->format('Y-m-d') }}"
                        min="1990-01-01"
                        max="2020-01-01">
                    @error('birth_date') <p class="text-danger"> {{ $message }} </p> @enderror
                </div>
            </div>

            <div class="col-md-12">
                <div class="form-group mb-3">
                    <textarea 
                        class="form-control rounded-4"
                        placeholder="Type your biography (Optional)"
                        name="bio"
                        style="min-height: 140px">{{ old('bio', $user->bio) }}</textarea>
                    @error('bio') <p class="text-danger"> {{ $message }} </p> @enderror
                </div>
            </div>

            <div class="col-md-12">
                <div class="form-group mb-3">
                    <input 
                        type="text"
                        placeholder="Your website (Optional)"
                        class="form-control rounded-pill"
                        value="{{ old('website', $user->website) }}"
                        name="website" id="website">
                    @error('website') <p class="text-danger"> {{ $message }} </p> @enderror
                </div>
            </div>

            <div class="form-group mb-3">
                <button type="submit" class="btn btn-primary rounded-pill px-4"><i class="fa-solid fa-floppy-disk"></i> Update</button>
            </div>

        </div>
    </form>
</section>
{{-- info form --}}

{{-- password form --}}
<section class="container bg-white border rounded-4 p-4 mb-4">
    <h2 class="section-title mb-5">Edit your password</h2>
    <form action="{{ route('user.settings.update-password') }}" method="POST" class="">
        @csrf
        <div class="row">

            <div class="col-md-12">
                <div class="form-group mb-3">
                    <input 
                        type="password" 
                        class="form-control rounded-pill" 
                        placeholder="Old password" 
                        name="old_password">
                    @error('old_password') <p class="text-danger"> {{ $message }} </p> @enderror
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group mb-3">
                    <input 
                        type="password" 
                        class="form-control rounded-pill" 
                        placeholder="New password"
                        name="password">
                    @error('password') <p class="text-danger"> {{ $message }} </p> @enderror
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group mb-3">
                    <input 
                        type="password" 
                        class="form-control rounded-pill" 
                        placeholder="Password confirmation"
                        name="password_confirmation">
                    @error('password_confirmation') <p class="text-danger"> {{ $message }} </p> @enderror
                </div>
            </div>

            <div class="form-group mb-3">
                <button type="submit" class="btn btn-primary rounded-pill px-4"><i class="fa-solid fa-floppy-disk"></i> Update</button>
            </div>

        </div>
    </form>
</section>
{{-- password form --}}

{{-- profile image form --}}
<section class="container bg-light border rounded-4 p-4 mb-4">
    <h2 class="section-title mb-4">Edit your profile image</h2>
    <form action="{{ route('user.settings.update-image') }}" method="POST" class="" enctype="multipart/form-data">
        @csrf
        <div class="row">

            <div class="col-sm-10">
                <div class="form-group center mb-3">
                    <label for="profile_image" class="text-muted mb-2">Profile image (Optional)</label>
                    <input 
                        type="file" 
                        class="form-control rounded-pill"
                        value="{{ old('profile_image') }}"
                        name="profile_image" id="profile_image">
                    @error('profile_image') <p class="text-danger"> {{ $message }} </p> @enderror
                </div>
            </div>

            <div class="col-sm-2">
                <div class="form-group mb-3">
                    <img 
                        src="{{ asset('storage/' . ($user->profile_image ? $user->profile_image : 'users/default.png')) }}" 
                        alt="{{ $user->profile_image }}'s profile image"
                        class="d-block w-100 border rounded-4"
                        onclick="document.getElementById('profile_image').click()">
                </div>
            </div>


            <div class="form-group mb-3">
                <button type="submit" class="btn btn-primary rounded-pill px-4"><i class="fa-solid fa-floppy-disk"></i> Update</button>
            </div>

        </div>
    </form>
</section>
{{-- profile image form --}}

{{-- profile banner form --}}
<section class="container bg-white border rounded-4 p-4 mb-5">
    <h2 class="section-title mb-4">Edit your profile banner</h2>
    <form action="#" method="POST" class="" enctype="multipart/form-data">
        @csrf
        <div class="row">

            <div class="col-md-12">
                <div class="form-group mb-3">
                    <label for="profile_banner" class="text-muted mb-2">Profile banner (Optional)</label>
                    <input 
                        type="file" 
                        class="form-control rounded-pill"
                        value="{{ old('profile_banner') }}"
                        name="profile_banner" id="profile_banner">
                    @error('profile_banner') <p class="text-danger"> {{ $message }} </p> @enderror
                </div>
            </div>

            <div class="form-group mb-3">
                <button type="submit" class="btn btn-primary rounded-pill px-4"><i class="fa-solid fa-floppy-disk"></i> Update</button>
            </div>

        </div>
    </form>
</section>
{{-- profile banner form --}}

</x-layout>