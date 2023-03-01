<x-recipehouse>
    <x-slot name="left">
        <x-leftside :categories="$categories" />
    </x-slot>

    <!-- 画面右側 -->
    <!-- if there are any categories ,below html is rendered. -->
    {{-- elseif thre is no categories, right screen display nothing. --}}
    @if($categories->count() != 0)
        <span class="icon">
           <i class="fas fa-utensils fa-lg"></i>
        </span>
        {{-- 左画面においてカテゴリが選択されていないとき、右画面のデフォルトカテゴリは登録カテゴリのうちidの一番大きいものを表示 --}}
        <span style="font-size: 20px; margin-left: 10px;">{{ $categories[0]->title }}</span>

        <form method="POST" action="{{ route('recipes.pre_store', $categories[0]) }}" enctype="multipart/form-data">
            @csrf
            <p>add recipe</p>
            <p class="mt-6"><input type="text" name="name"></p>

            @error('name')
                <div class="error">{{ $message }}</div>
            @enderror

            <p class="mt-5"><input type="file" name="image"></p>
            <button class="mt-3 text-white bg-purple-700
                hover:bg-purple-800 focus:outline-none focus:ring-4
                focus:ring-purple-300 font-medium rounded-full text-sm
                px-3 py-1 text-center mb-2 dark:bg-purple-600 dark:hover:bg-purple-700
                dark:focus:ring-purple-900">
                Write Details of Recipe
            </button>
        </form>

        <hr>

        <ul class="mt-2">
            @foreach ($categories[0]->recipes as $recipe)
                <li>
                    <form method="post" action="{{ route('recipes.destroy', $recipe) }}" class="delete-comment">
                        @method('DELETE')
                        @csrf
                        <button class="text-[12px] inline-flex btn btn-blue">
                            Delete
                        </button>
                    </form>
                    <a href="{{route('recipes.edit_page', $recipe)}}" class="text-[12px] inline-flex btn btn-blue">
                        Edit
                    </a>
                    {{-- <a class="underline" href="{{ route('recipes.show', $recipe) }}">{{ $recipe->name }}</a> --}}
                    <a class="underline" href="{{ route('recipes.edit_page', $recipe) }}">{{ $recipe->name }}</a>

                </li>
            @endforeach
        </ul>
    @endif
</x-recipehouse>
