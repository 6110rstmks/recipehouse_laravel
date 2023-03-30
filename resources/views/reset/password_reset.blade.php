<h2>Please fill in your registerd email</h2>

<form action="{{ route('send-email-password-reset') }}" method="POST">
    @csrf
    <div>
        <label for="email">Email</label>
        <p><input type="text" name="email" id="email" value="{{ old('email') }}"></p>
    </div>
    <button>submit mail for password-reset</button>
</form>

@if ($errors->any())
    <div class="alert alert-danger" style="color: red;">
        <ul>
            @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </ul>
    </div>
@endif

<a href="{{ route('login_form') }}">Get back to login_form</a>


