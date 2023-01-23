<p>please fill in your registerd email</p>


<form action="{{ route('SendEmailForPasswordReset') }}" method="POST">
    @csrf
    <div>
        <label for="email">メールアドレス</label>
        <p><input type="text" name="email" id="email" value="{{ old('email') }}"></p>
        @error('email')
            <span class="error">{{ $message }}</span>
        @enderror
    </div>
    <button>再設定用メールを送信</button>
</form>

<a href="{{ route('showLogin') }}">戻る</a>


