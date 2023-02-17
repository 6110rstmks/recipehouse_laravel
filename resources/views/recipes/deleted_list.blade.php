<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite('resources/css/app.css')
</head>
<body>
    <h1 class="text-red-800 text-2xl">Deleted recipes</h1>
    <p>Recipe is deleted in an month</p>
    <div class="mt-5">

        @foreach ($deleted_recipes as $deleted_recipe)
            <h3>
                {{$deleted_recipe->body}}
            </h3>

            <form action="{{route('recipes.restore', $deleted_recipe->id)}}" method="POST">
                @csrf
                <button class="text-xs bg-orange-500 hover:bg-blue-700 text-black py-1 px-2 rounded-full">
                    restore recipe
                </button>
            </form>
        @endforeach
    </div>


    <button class="mt-5 bg-blue-500 hover:bg-blue-700 text-black py-1 px-2 rounded-full">
        <a class="text-xs" href="{{route('user.home')}}">MY PAGE</a>
    </button>
</body>
</html>
