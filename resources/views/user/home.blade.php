<x-layout>
    <h2>MY PAGE</h2>

    <form action="{{ route('logout') }}" method="POST">
    @csrf
        <button>logout</button>
    </form>

    <button>退会はこちら（未実装）</button>

    <a href="{{ route('register_page') }}"><button>user registeration is here</button></a>

    <div class="mt-6">
        <button class="inline-flex items-center h-8 px-4 m-2 text-sm text-indigo-100 transition-colors duration-150 bg-indigo-700 rounded-lg focus:shadow-outline hover:bg-indigo-800"><a href="{{route('recipes.deletedList')}}">
            <a href="{{route('categories.index')}}">Recipe House</a>
        </button>
    </div>

    <div>
        <div class="mt-6">
            <button class="inline-flex items-center h-8 px-4 m-2 text-sm text-indigo-100 transition-colors duration-150 bg-indigo-700 rounded-lg focus:shadow-outline hover:bg-indigo-800">
                <a href="{{route('recipes.deletedList')}}">Trashed Recipe</a>
            </button>
        </div>
    </div>


</x-layout>
