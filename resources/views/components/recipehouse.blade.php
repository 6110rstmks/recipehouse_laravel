<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>recipe house</title>
    <link rel="stylesheet" href="{{ url('css/style.css') }}">
    @vite('resources/css/app.css')
</head>
<body>
    <button class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded">
        <a href="{{route('user.home')}}">MY PAGE</a>
    </button>

    <a class="mt-4 bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-1 px-1 border border-blue-500 hover:border-transparent" href="{{ route('recipes.list') }}">All Recipe</a>

    <div class="container" style="margin-top: 12px;">

        <div class="left-container">
            <hr>

            <p class="text-amber-500">Hello <span style="color: green">{{ Auth::user()->username }}</span></p>
            <div class="form-box">
                <h4 style="margin-bottom: 20px; margin-top: 10px">RECIPE HOUSE</h4>

                {{-- add form --}}
                <form method="POST" action="{{ route('categories.store') }}">
                    @csrf
                    <span class="icon is-small is-left">
                        <i class="fas fa-utensils"></i>
                    </span>
                    <input type="text" class="title-input" name="title" placeholder="entry category name" value="{{ old('title') }}">
                    <button class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded">ADD</button>
                </form>

                @error('title')
                    <div class="text-red-900">{{ $message }}</div>
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
