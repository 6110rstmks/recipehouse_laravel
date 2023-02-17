<x-layout>
    <h2 class="mt-4 ml-4 text-3xl">MY PAGE</h2>


    <div class="flex">
        <form action="{{ route('logout') }}" method="POST">
        @csrf
            <button class="inline-flex items-center h-8 px-4 m-2 text-sm text-indigo-100 transition-colors duration-150 bg-indigo-700 rounded-lg focus:shadow-outline hover:bg-indigo-800"><a href="{{route('recipes.deletedList')}}">
                Sign Out
            </button>
        </form>

        <div>
            <button class="inline-flex items-center h-8 px-4 m-2 text-sm text-indigo-100 transition-colors duration-150 bg-indigo-700 rounded-lg focus:shadow-outline hover:bg-indigo-800"><a href="{{route('recipes.deletedList')}}">
                <a href="{{route('categories.index')}}">Delete Account</a>
            </button>
        </div>
    </div>

    <button class="inline-flex items-center h-8 px-4 m-2 text-sm text-indigo-100 transition-colors duration-150 bg-indigo-700 rounded-lg focus:shadow-outline hover:bg-indigo-800">
        <a href="{{ route('register_page') }}">New Sign Up</a>
    </button>

    <div class="mt-6">
        <button class="inline-flex items-center h-8 px-4 m-2 text-sm text-indigo-100 transition-colors duration-150 bg-indigo-700 rounded-lg focus:shadow-outline hover:bg-indigo-800"><a href="{{route('recipes.deletedList')}}">
            <a href="{{route('categories.index')}}">Recipe House</a>
        </button>
    </div>

    <div class="flex mt-6">
        <div >
            <button class="inline-flex items-center h-8 px-4 m-2 text-sm text-indigo-100 transition-colors duration-150 bg-indigo-700 rounded-lg focus:shadow-outline hover:bg-indigo-800">
                <a href="{{route('recipes.deletedList')}}">Trashed Recipe</a>
            </button>
        </div>
            <button class="inline-flex items-center h-8 px-4 m-2 text-sm text-indigo-100 transition-colors duration-150 bg-indigo-700 rounded-lg focus:shadow-outline hover:bg-indigo-800">
                <a href="{{route('recipes.list')}}">Recipe List</a>
            </button>
        <div>

        </div>
    </div>


</x-layout>
