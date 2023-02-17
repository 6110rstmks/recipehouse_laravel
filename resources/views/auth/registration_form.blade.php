<x-layout>

    <h1>User Register</h1>

    <div class="card-body">

        @auth
            <p style="display: inline">You are certificated.</p>
            <a href="{{ route('categories.index')}}"><button>Go to home</button></a>

        @endauth

        @guest
            <p>You are a guest now.</p>
        @endguest

        <form method="POST" action="{{ route('saveRegister') }}">
            @csrf
            <div>
                <label for="">UserName</label>

                <p><input type="text" name="username" value="{{ old('username')}}"></p>
            </div>

            @error('username')
                <div class="error">{{ $message }}</div>
            @enderror

            <div>
                <div>email</div>
                <input type="email" name="email" id="">
            </div>


            <div>
                <div>password</div>
                <div class="col-md-6">
                    <input type="password" name="password">
                </div>
            </div>

            @error('password')
            <div class="error">{{ $message }}</div>
            @enderror

            <div>
                <div>Confirm Password</div>
                <div class="col-md-6">
                    <input type="password" name="password_conf">
                </div>
            </div>

            @error('password_conf')
                <div class="error">{{ $message }}</div>
            @enderror
            <button>Register</button>
        </form>

        <a href="{{ route('login_form') }}">user sign in is here</a>
    </div>

</x-layout>
