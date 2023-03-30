<x-layout>
    <section class="mt-4 ml-4 font-serif">

        <h2 class="text-3xl">MY PAGE</h2>

        <div class="mt-4
         flex">
            <p class="text-xl mr-3">Hello <span class="text-cyan-100">{{Auth::user()->username}}</span></p>

            <div>
                <p>your point: {{Auth::user()->point}}</p>
                <a href="" class="text-1xl underline ">What you can do by using your point</a>
            </div>

        </div>
        <div class="flex">
            <form action="{{ route('sign_out') }}" method="POST">
            @csrf
                <button class="btn-d text-red-200">
                        Sign Out
                </button>
            </form>

            <div>

                <form action="{{route('delete_user')}}" method="POST">
                    @csrf
                    <button class="btn-d">Delete Account</button>
                </form>
            </div>
        </div>

        <span id="purge-category" class="btn-d">Tag List</span>

        <button class="inline-flex items-center h-8 px-4 m-2 text-sm text-indigo-100 transition-colors duration-150 bg-indigo-700 rounded-lg focus:shadow-outline hover:bg-indigo-800">
            <a href="{{ route('register_form') }}">New Sign Up</a>
        </button>



        <div class="mt-6">
            <button class="btn-c">
                <a href="{{route('categories.index')}}">Recipe House</a>
            </button>

            <button class="btn-c">
                <a href="{{route('categories.index')}}">Create Menu</a>
            </button>
        </div>

        <div class="flex mt-6">
            <div >
                <button class="inline-flex items-center h-8 px-4 m-2 text-sm text-indigo-100 transition-colors duration-150 bg-indigo-700 rounded-lg focus:shadow-outline hover:bg-indigo-800">
                    <a href="{{route('recipes.deletedList')}}">Trashed Recipe</a>
                </button>
            </div>

            <button class="btn-d">
                <a href="{{route('recipes.list')}}">Recipe List</a>
            </button>

            <div>

            </div>
        </div>
    </section>


</x-layout>
