<x-layout>
    <x-card>
        <form method="POST" action="/login">
            @csrf

            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="username" class="form-control" name="username" value="{{old('username')}}"/>
                @error('username')
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
                <button type="submit" class="btn btn-primary" onclick="submitForm(this);">Sign In</button>
            </div>

            <div class="mt-3">
                <p>
                    Don't have an account?
                    <a href="/register" class="text-primary">Register</a>
                </p>
            </div>
        </form>
    </x-card>
</x-layout>