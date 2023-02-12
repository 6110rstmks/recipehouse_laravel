<form method="POST" action="{{ route('admin.register') }}">
    @csrf

    <div>名前</div>
    <input id="text" type="text" name="name" value="{{ old('name') }}">

    <span>PASSWORD</span>
    <input type="password" name="password">
    <button>Submit</button>

</form>
