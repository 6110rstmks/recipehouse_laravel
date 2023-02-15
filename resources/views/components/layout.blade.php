<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>recipe house</title>
    {{-- <link rel="stylesheet" href="{{ asset('css/app.css') }}"> --}}
    <link rel="stylesheet" href="{{ url('css/style.css') }}">
</head>
<body>
    <div class="container" style="margin-top: 30px;">

        <div class="left-container">
        <h1 class="text-3xl font-bold underline"></h1>

            <a href="{{ route('recipes.list') }}"><button>recipe list is here</button></a>

            <button><a href="{{route('user.home')}}">MY PAGE</a></button>


            <p class="text-red-500">Hello <span style="color: green">{{ Auth::user()->username }}</span></p>
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
