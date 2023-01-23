<x-layout>
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

        <form method="post" action="{{ route('recipes.store', $categories[0]) }}" class="recipe-form" enctype="multipart/form-data">
            @csrf
            <p>add recipe</p>
            <p><input type="text" name="body"></p>
            <p><input type="file" name="image"></p>
            <button>UPLOAD</button>
        </form>

        <hr>

        <ul style="margin-top: 15px;">
            @foreach ($categories[0]->recipes as $recipe)
                <li>
                    <a href="{{ route('recipes.show', $recipe) }}">{{ $recipe->body }}</a>
                    <form method="post" action="{{ route('recipes.destroy', $recipe) }}" class="delete-comment">
                        @method('DELETE')
                        @csrf
                        <button>削除</button>
                    </form>
                </li>
            @endforeach
        </ul>
    {{-- @elseif ($categories->count() >= 2) --}}
    @endif
</x-layout>
