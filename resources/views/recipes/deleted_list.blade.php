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
    <h1 class="text-yellow-800 text-2xl">Deleted recipes</h1>
    <p>Recipe is deleted in an month</p>
    <div class="mt-5">

        <ul>
            @foreach ($deleted_recipes as $deleted_recipe)
            <a class="relative block max-w-sm p-9
                bg-gray-500 border border-black-200
                rounded-lg shadow hover:bg-gray-600
                dark:bg-blue-400 dark:border-gray-700
                dark:hover:bg-yellow-700"
                href="{{ route('recipes.show', $deleted_recipe) }}">

                <span class="absolute top-0 left-0 border rounded-t">
                    {{$deleted_recipe->categories[0]->title}}
                </span>
                <form class="inline" action="{{route('recipes.restore', $deleted_recipe->id)}}" method="POST">
                    @csrf
                    <button class="absolute top-0 right-0 text-xs
                        bg-blue-400 hover:bg-blue-700 text-black py-1 px-2 rounded-full">
                        Restore
                    </button>
                </form>

                <span class="absolute top-6 left-4">
                    {{$deleted_recipe->name}}
                </span>

                <span class="absolute top-9 left-11">
                    created by username
                </span>
            </a>
            @endforeach

        </ul>
    </div>

    {{ $deleted_recipes->links('pagination.default') }}



    <button class="mt-5 bg-lime-200 hover:bg-lime-700 text-black py-1 px-2 rounded-full">
        <a class="text-xs" href="{{route('user.home')}}">MY PAGE</a>
    </button>
</body>
</html>
