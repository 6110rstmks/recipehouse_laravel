<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>recipe house</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ url('css/style.css') }}">
</head>
<body>
    <div class="container" style="margin-top: 30px;">

        <div class="left-container">
        <h1 class="text-3xl font-bold underline"></h1>
            <form action="{{ route('logout') }}" method="POST">
            @csrf
                <button>logout</button>
            </form>

            <button>退会はこちら（未実装）</button>

            <a href="{{ route('recipes.list') }}"><button>recipe一覧はここから</button></a>

            <a href="{{ route('showRegister') }}"><button>user registeration is here</button></a>

            <li class="text-red-500">username: {{ Auth::user()->username }}</li>
            <div class="form-box">
                <h4 style="margin-bottom: 20px; margin-top: 10px">RECIPE HOUSE</h4>

                {{-- add form --}}
                <form method="POST" action="{{ route('categories.store') }}">
                    @csrf
                    <span class="icon is-small is-left">
                        <i class="fas fa-utensils"></i>
                    </span>
                    <input type="text" class="title-input" name="title" placeholder="entry category name" value="{{ old('title') }}">
                    <button>ADD</button>
                </form>
                
                @error('title')
                    <div class="error">{{ $message }}</div>
                @enderror

            </div>
            <div class="category-box">
                {{ $left }}
            </div>
        </div>

        <div class="right-container">
            {{ $slot }}
        </div>
    </div>
</body>
</html>
<script src="{{ url('js/main.js') }}"></script>
<script defer src="https://use.fontawesome.com/releases/v5.15.4/js/all.js"></script>
