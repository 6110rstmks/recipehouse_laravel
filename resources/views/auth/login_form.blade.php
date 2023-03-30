<x-layout>
    <a class="border-2 px-2 py-1 rounded-xl" href="{{ route('register_form') }}">Sign up</a>
    <a class="ml-4 border-2 px-2 py-1 rounded-xl" href="{{ route('recipes.list') }}">Recipe List</a>

    @if (session('login_error'))
        <div style="color: red">
            {{ session('login_error') }}
        </div>
    @endif

    @if (session('signout_msg'))
        <div class="alert alert-success">
            {{ session('signout_msg') }}
        </div>
    @endif

    <div style="margin:0 auto; width: 500px;">

        <h1 class="text-2xl h3 mb-3 font-weight-normal">Please sign in</h1>
        <form class="form-signin" method="POST" action="{{ route('login') }}">
            @csrf

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (Session::has('message'))
                <p>{{ Session::get('message')}}</p>
            @endif

            <label for="inputEmail">username</label>
            <input style="display: block; margin-top: 30px;" type="text" name="username" id="inputUserName" class="form-control" placeholder="Name" autofocus>

            <label for="inputPassword">Password</label>
            <input style="display: block" type="password" name="password" id="inputPassword" class="" placeholder="Password">

            <input type="checkbox" name="remember_me" value="true">

            <button class="btn-c" type="submit">Login in</button>
        </form>

        <a class="underline" href="{{ route('password-reset-page') }}">Are you forgetting your password?</a>

    </div>

</x-layout>
