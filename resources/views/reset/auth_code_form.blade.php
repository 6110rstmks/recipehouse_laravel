<h2 style="color: purple">Please enter auth-code and new password.</h2>

<form action="{{route('password_reset')}}">
    @csrf

    <p>
        <span>auth-code</span>
        <input type="text" name="auth_code" id="">
    </p>
    <p>
        <span>new password</span>
        <input type="password" name="password" id="">
    </p>

    <p>
        <span>new password reset</span>
        <input type="password" name="password_conf" id="">
    </p>

    <button>Submit</button>
</form>
