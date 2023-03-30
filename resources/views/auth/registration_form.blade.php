<x-layout>

    <h1 class="text-3xl inline">User Register</h1>
    <a class="btn-c" href="{{ route('login_form') }}">Sign in</a>


    <div>
        @auth
            <p style="display: inline">You are certificated.</p>
            <a href="{{ route('categories.index')}}">Menu</a>

        @endauth

        @guest
            <p>You are a guest now.</p>
        @endguest

        @if (session('delete_user_msg'))
            <div class="text-indigo-400">
                {{ session('delete_user_msg') }}
            </div>
        @endif

        <form method="POST" action="{{ route('saveRegister') }}">
            @csrf
            <div>
                <p >UserName</p>

                <p><input class="rounded-md" type="text" name="username" value="{{ old('username')}}"></p>
            </div>

            @error('username')
                <div class="text-red-300">{{ $message }}</div>
            @enderror

            <div>
                <div>Email</div>
                <input class="rounded-md" type="email" name="email" id="">
            </div>

            <div>
                <div>password</div>
                <div>
                    <input class="rounded-md" type="password" name="password">
                </div>
            </div>

            @error('password')
                <div class="text-red-300">{{ $message }}</div>
            @enderror

            <div>
                <div>Confirm Password</div>
                <div class="col-md-6">
                    <input class="rounded-md" type="password" name="password_conf">
                </div>
            </div>

            @error('password_conf')
                <div class="text-red-300">{{ $message }}</div>
            @enderror
            <button class="btn-d">Register</button>
        </form>

    </div>

</x-layout>
