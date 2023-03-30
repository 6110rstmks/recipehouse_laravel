<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>recipe house</title>
    <link rel="stylesheet" href="{{ url('css/style.css') }}">
    @vite('resources/css/app.css')
</head>
<body class="ml-4 mt-4 font-serif">

    <a class="btn-b" href="{{route('user.home')}}">MY PAGE</a>

    <a class="btn-b ml-3" href="{{ route('recipes.list') }}">All Recipes</a>

    <a href="" class="btn-b ml-3">My Recipes</a>

    <div class="flex mt-12">

        <div class="left-container">
            <hr>
            <div class="form-box">
                <h2 class="mt-2 ml-2">RECIPE HOUSE</h2>

                {{-- add form --}}
                <form method="POST" action="{{ route('categories.store') }}">
                    @csrf
                    <span>
                        <i class="fas fa-utensils"></i>
                    </span>
                    <input type="text" class="category-input" name="title"
                        placeholder="entry category name" value="{{ old('title') }}">
                    <button class="btn-d">
                        ADD
                    </button>
                </form>

                @error('title')
                    <div class="text-xl text-red-400 font-bold">{{ $message }}</div>
                @enderror

            </div>

            <div>
                <hr>
                {{ $left }}
            </div>
        </div>

        <div class="right-container">
            {{ $slot }}
        </div>
    </div>
</body>
</html>
<script src="{{ url('js/recipehouse.js') }}"></script>
<script defer src="https://use.fontawesome.com/releases/v5.15.4/js/all.js"></script>
