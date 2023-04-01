<x-layout>
    @if (auth()->check())
        <div id="nowuserid" data-nowuserid={{Auth::user()->id}} class="mt-4 ml-4">
    @else
        <div id="nowuserid" class="mt-4 ml-4">
    @endif
        <h1 class="text-3xl">Recipe List</h1>
        @auth
            <span>Your point :{{Auth::user()->point}}</span>
            <p>・ポイントを消費して他人のレシピを閲覧できる</p>
        @endauth

        <table class="border-collapse border border-slate-400">
            <tr>
                <th class="border border-slate-300">ID</th>
                <th class="border border-slate-300">Name</th>
                {{-- <th class="border border-slate-300">Category</th> --}}
                <th class="border border-slate-300">User</th>
            </tr>
            @foreach ($recipes as $recipe)
            <tr>
                <td class="border border-slate-300">{{$recipe->id}}</td>
                <td class="border border-slate-300">
                    @auth
                        <a class="user_id" data-userid={{$recipe->user_id}}
                            data-recipeid={{$recipe->id}}
                            href="{{route('recipes.showFromList', $recipe)}}">{{$recipe->name}}
                        </a>
                    @endauth
                    @guest
                        <div>{{$recipe->name}}</div>
                    @endguest
                </td>

                {{-- jsでポイント消費するけどいいです？のダイアログだしたいねんけどうまくいかん、ので保留 --}}
                {{-- <td class="border border-slate-300"><a class="user_id" data-userid={{$recipe->user_id}}>{{$recipe->name}}</a></td> --}}
                {{-- <td class="border border-slate-300">
                    @foreach ($recipe->categories as $category)
                        {{$category->title}}
                    @endforeach
                </td> --}}
                <td class="border border-slate-300">
                    @if (is_null($recipe->user))
                        by 退会したユーザ
                    @else
                        by {{$recipe->user->username}}
                    @endif
                </td>
                <td>
                    @if ($recipe->user_id === Auth::id())
                    <form method="post" action="{{ route('recipes.destroy', $recipe) }}" class="delete-comment">
                        @method('DELETE')
                        @csrf
                        <button class="text-[12px] inline-flex btn btn-blue">
                            Delete
                        </button>
                    </form>

                    @endif
                </td>
            </tr>

            @endforeach
        </table>


        @if ($errors->any())

            @foreach($errors->all() as $error)
                <div style="color: red">{{ $error }}</div>
            @endforeach
        @endif

        {{ $recipes->links('pagination.default') }}

        @guest
            <p>You can add recipes if you sign in</p>
            <button class="btn btn-blue"><a href="{{ route('login_form') }}">Sign in</a></button>
        @endguest

        @auth
            <a class="btn-d" href="{{ route('user.home') }}">MyPage</a>
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
