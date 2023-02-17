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
            <a class="block max-w-sm p-6 bg-blue border border-gray-200 rounded-lg shadow hover:bg-blue-300 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-blue-700">

                <form class="inline" action="{{route('recipes.restore', $deleted_recipe->id)}}" method="POST">
                    @csrf
                    <button class="text-xs bg-orange-500 hover:bg-blue-700 text-black py-1 px-2 rounded-full">
                        Restore
                    </button>
                </form>
                <span>
                    {{$deleted_recipe->id}}
                </span>
                <span>
                    {{$deleted_recipe->name}}
                </span>
                <span>
                    {{$deleted_recipe->categories[0]->title}}
                </span>
            </a>
            @endforeach

        </ul>
    </div>


    <button class="mt-5 bg-lime-200 hover:bg-lime-700 text-black py-1 px-2 rounded-full">
        <a class="text-xs" href="{{route('user.home')}}">MY PAGE</a>
    </button>
</body>
</html>
