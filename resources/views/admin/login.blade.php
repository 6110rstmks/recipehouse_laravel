
<div>
    <h2>Admin login page</h2>
    <div>
        <form method="POST" action="{{ route('admin.login') }}">
            @csrf
            <div class="form-group">
                <span>名前</span>

                <input style="width: 260px;" type="text" name="name" value="{{ old('name') }}">
                {{-- @endif --}}
            </div>
            <div>
                <span>PASSWORD</span>
                <input type="password" name="password">
            </div>

                @if ($errors->any())

                    @foreach($errors->all() as $error)
                        <div style="color: red">{{ $error }}</div>
                    @endforeach
                @endif

            <button>ログイン</button>
        </form>
    </div>
</div>
