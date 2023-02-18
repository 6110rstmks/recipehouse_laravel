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

        <form method="post" action="{{ route('recipes.store', $categories[0]) }}" enctype="multipart/form-data">
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
                UPLOAD
            </button>
        </form>

        <hr>

        <ul style="margin-top: 15px;">
            @foreach ($categories[0]->recipes as $recipe)
                <li>
                    <a class="underline" href="{{ route('recipes.show', $recipe) }}">{{ $recipe->name }}</a>
                    <form method="post" action="{{ route('recipes.destroy', $recipe) }}" class="delete-comment">
                        @method('DELETE')
                        @csrf
                        <button class="inline-flex items-center
                            h-8 px-4 m-2 text-sm text-indigo-100 transition-colors
                            duration-150 bg-indigo-700 rounded-lg
                            focus:shadow-outline hover:bg-indigo-800">
                            DELETE
                        </button>
                    </form>
                </li>
            @endforeach
        </ul>
    @endif
</x-recipehouse>
