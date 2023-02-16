<h2 style="color: purple">Please enter auth-code and new password.</h2>

{{-- <h3>画面をリロードすると初期画面にリダイレクトされ、もう一度メール送信をやり直す必要があります。</h3> --}}

<form action="{{route('password_reset')}}" method="POST">
    @csrf

    <p>
        <span>auth-code</span>
        <input type="text" name="auth_code" value="{{old('auth_code')}}">
    </p>
    <p>
        <span>new password</span>
        <input type="password" name="password" id="">
    </p>

    <p>
        <span>new password reset</span>
        <input type="password" name="password_conf" id="">
    </p>

    @if ($errors->any())
        <div class="alert alert-danger" style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </ul>
        </div>
    @endif

    <button>Submit</button>
</form>

<script>


    // window.onbeforeunload = function(e) {
    //   e.returnValue = "ページを離れようとしています。よろしいですか？";
    // }

</script>
