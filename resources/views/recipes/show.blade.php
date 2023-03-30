<x-layout>

    <div class="mt-3 ml-3">

        {{-- 一覧ページから来た場合 --}}
        {{-- show(),showList()を参照 --}}
        @if (isset($previous_page_url_number))
            <a href="{{route('recipes.list', ['page' => $previous_page_url_number])}}" class="btn-blue" onclick="history.back()">Back To All Recipes</a>
        @else
        {{-- レシピハウスから詳細レシピページに入った場合 --}}
            <a href="{{route('categories.index')}}" class="btn-blue">Back</a>
        @endif



        @guest
            <a class="btn-blue" href="{{ route('login_form') }}">Sign in from here</a>
        @endguest

        <h2 class="text-4xl inline">{{ $recipe->name }}</h2>

        <span class="inline">by {{$recipe->user->username}}</span>


        {{-- eye icon --}}
        <i class="fa fa-eye" style="font-size: 15px"></i><span>{{$recipe->view}}</span>


        <div>
            @foreach ($recipe->categories as $category)
                <span>{{$category->title}}</span>
            @endforeach
        </div>

        <ul class="mt-3 w-60 border-transparent">
            @foreach($recipe->tags as $tag)
                <div class="inline mr-2">
                    <li class="inline text-xs border-transparent w-fit px-3 py-0.5 bg-cyan-900 rounded">{{$tag->name}}</li>
                    <span class="text-sm">
                        <i class="fa fa-trash"></i>
                    </span>
                </div>
            @endforeach
        </ul>

        @if (!is_null($recipe->file_path))
            <img class="mt-6" width=380 src="{{ asset('storage/'. $recipe->file_path) }}">
        @endif

        @if ($recipe->user_id === Auth::id())
            <span class="border rounded-xl px-1 -mt-2" title="テキストは自動保存されます。マークダウンに対応しています。">?</span>
            <form action="">
                <textarea autofocus placeholder="テキストは自動保存されます" name="" id="" cols="30" rows="10"></textarea>
            </form>

            {{-- Add new tag --}}
            {{-- <form action="{{route('tags.store', $recipe)}}" method="POST" class="flex">
                @csrf
                <input type="text" name="name" placeholder="add tag">
                <button class="ml-3 cursor-pointer border w-4">
                    <i class="fa fa-plus"></i>
                </button>
            </form> --}}

            {{-- Add registered tag --}}
            <option value="tags">

            </option>

        @endif


    </div>

</x-layout>

