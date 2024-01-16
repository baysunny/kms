<x-layout>
	<x-card>
        <form method="POST" action="/users">
            @csrf

            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" name="name" value="{{old('name')}}"/>
                @error('name')
                    <p class="text-danger">{{$message}}</p>
                @enderror
            </div>

            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" name="username" value="{{old('username')}}"/>
                @error('username')
                    <p class="text-danger">{{$message}}</p>
                @enderror
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" name="email" value="{{old('email')}}"/>
                @error('email')
                    <p class="text-danger">{{$message}}</p>
                @enderror
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" name="password" value="{{old('password')}}"/>
                @error('password')
                    <p class="text-danger">{{$message}}</p>
                @enderror
            </div>

            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" name="password_confirmation" value="{{old('password_confirmation')}}"/>
                @error('password_confirmation')
                    <p class="text-danger">{{$message}}</p>
                @enderror
            </div>

            <div class="mb-3">
                <button type="submit" class="btn btn-primary">Sign Up</button>
            </div>

            <div class="mt-3">
                <p>
                    Already have an account?
                    <a href="/login" class="text-primary">Login</a>
                </p>
            </div>
        </form>
    </x-card>

</x-layout>