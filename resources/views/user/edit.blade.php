<x-layout>

{{-- edit form --}}
<section class="login py-5">
    <div class="container">
        <h2 class="text-center text-capitalize mb-4">Edit profile</h2>
        <form 
            enctype="multipart/form-data" 
            action="{{ route('user.update', Auth::user()) }}" 
            method="POST" 
            class="border bg-light rounded-4 m-auto w-75 p-5">
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

            <div class="row">
                <div class="col-sm-6">
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
                <div class="col-sm-6">
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
                <div class="col-sm-12">
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
                <div class="col-sm-12">
                    <div class="form-group mb-3">
                        <input 
                            type="password" 
                            class="form-control rounded-pill" 
                            placeholder="Old password" 
                            name="old_password">
                        @error('old_password') <p class="text-danger"> {{ $message }} </p> @enderror
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group mb-3">
                        <input 
                            type="password" 
                            class="form-control rounded-pill" 
                            placeholder="New password"
                            name="password">
                        @error('password') <p class="text-danger"> {{ $message }} </p> @enderror
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group mb-3">
                        <input 
                            type="password" 
                            class="form-control rounded-pill" 
                            placeholder="Password confirmation"
                            name="password_confirmation">
                        @error('password_confirmation') <p class="text-danger"> {{ $message }} </p> @enderror
                    </div>
                </div>
                <div class="col-sm-6">
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
                <div class="col-sm-6">
                    <div class="form-group mb-3">
                        <input 
                            type="date" 
                            class="form-control rounded-pill"
                            name="birth_date">
                        @error('birth_date') <p class="text-danger"> {{ $message }} </p> @enderror
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="form-group mb-3">
                        <textarea 
                            class="form-control rounded-4"
                            placeholder="Type your biography (Optional)"
                            name="bio"
                            style="min-height: 140px">{{ old('bio', $user->bio) }}</textarea>
                        @error('bio') <p class="text-danger"> {{ $message }} </p> @enderror
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group mb-3">
                        <label for="profile_image" class="text-muted mb-2">Profile image (Optional)</label>
                        <input 
                            type="file" 
                            class="form-control rounded-pill"
                            value="{{ old('profile_image') }}"
                            name="profile_image" id="profile_image">
                        @error('profile_image') <p class="text-danger"> {{ $message }} </p> @enderror
                    </div>
                </div>
                <div class="col-sm-6">
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
                <div class="col-sm-6">
                    <div class="form-group mb-3">
                        <img 
                            src="{{ asset('storage/' . ($user->profile_image ? $user->profile_image : 'users/default.png')) }}" 
                            alt="Your profile image"
                            class="d-block w-100 rounded-4 img-thumbnail c-pointer"
                            onclick="document.getElementById('profile_image').click()">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group mb-3">
                        <img 
                            src="{{ asset('storage/' . ($user->profile_banner ? $user->profile_banner : 'users/banners/default.png')) }}" 
                            alt="Your profile banner"
                            class="d-block w-100 rounded-4 img-thumbnail c-pointer"
                            onclick="document.getElementById('profile_banner').click()">
                    </div>
                </div>
                <div class="col-sm-12">
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
            </div>

            <div class="form-group mb-3">
                <input type="submit" class="btn btn-primary rounded-pill px-4" value="Update">
            </div>

        </form>
    </div>
</section>
{{-- edit form --}}



</x-layout>