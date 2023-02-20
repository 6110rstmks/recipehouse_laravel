<x-layout>
    <div id="nowuserid" data-nowuserid={{Auth::user()->id}} class="mt-4 ml-4">

        <h1 class="text-3xl">Recipe List</h1>

        <table class="border-collapse border border-slate-400">
            @foreach ($recipes as $recipe)
            <tr>

                <th class="border border-slate-300">ID</th>
                <th class="border border-slate-300">Name</th>
                <th class="border border-slate-300">Category</th>
                <th class="border border-slate-300">User</th>
            </tr>
            <tr>
                <td class="border border-slate-300">{{$recipe->id}}</td>
                <td class="border border-slate-300">
                    <a class="user_id" data-userid={{$recipe->user_id}}
                        href="{{route('recipes.show', $recipe)}}">{{$recipe->name}}
                    </a>
                </td>

                {{-- jsでポイント消費するけどいいです？のダイアログだしたいねんけどうまくいかん、ので保留 --}}
                {{-- <td class="border border-slate-300"><a class="user_id" data-userid={{$recipe->user_id}}>{{$recipe->name}}</a></td> --}}
                <td class="border border-slate-300">
                    @foreach ($recipe->categories as $category)
                        {{$category->title}}
                    @endforeach
                </td>
                <td class="border border-slate-300">
                    by {{$recipe->user->username}}
                </td>
            </tr>

            @endforeach
        </table>

        {{ $recipes->links('pagination.default') }}

        @guest
            <p>You can add recipes if you sign in</p>
            <button class="btn btn-blue"><a href="{{ route('login_form') }}">Sign in</a></button>
        @endguest

        @auth
            <button class="inline-flex items-center h-8 px-4 m-2 text-sm text-indigo-100 transition-colors duration-150 bg-indigo-700 rounded-lg focus:shadow-outline hover:bg-indigo-800">
                <a href="{{ route('user.home') }}">MyPage</a>
            </button>
        @endauth
        <a class="btn-d" href="{{route('recipes.deletedList')}}">Deleted Recipe</a>

        {{-- <form action="{{ route('recipes.store',) }}" method="POST">
            <select name="" id="">
                @forelse ($categories as $category)
                    <option value="">{{ $category->title}}</option>
                @empty
                    <option value="">no category</option>
                @endforelse
            </select>
        </form> --}}
    </div>

    <script src="{{ url('js/recipelist.js') }}"></script>



</x-layout>
