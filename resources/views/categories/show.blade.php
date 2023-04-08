<x-recipehouse>
    <x-slot name="left">
        <x-leftside :categories="$categories" />
    </x-slot>

    <!-- 画面右側 -->
    <!-- if there are any categories ,below html is rendered. -->
    {{-- if thre is no categories, right screen display nothing. --}}
    <span class="icon">
        <i class="fas fa-utensils fa-lg"></i>
    </span>
    <span>{{ $category->title }}</span>

    <form method="post" action="{{ route('recipes.pre_store', $category) }}" class="task-form" enctype="multipart/form-data">
        @csrf
        <p>add recipe</p>
        <input class="mt-6 border-black border-2" type="text" name="name">

        @error('name')
            <div class="error">{{ $message }}</div>
        @enderror

        <p class="mt-5"><input type="file" name="image"></p>
        <button class="mt-3 btn-c">
            Create Recipe
        </button>
    </form>
    <hr>

    <ul class="mt-2">
        @foreach ($category->recipes as $recipe)
            <li>
                <form method="post" action="{{ route('recipes.destroy', $recipe) }}">
                    @method('DELETE')
                    @csrf

                    <button class="text-[12px] inline-flex btn btn-blue">
                        Delete
                    </button>
                </form>
                <a href="{{route('recipes.edit_page', $recipe)}}" class="text-[12px] inline-flex btn btn-blue">
                    Edit
                </a>
                <a href="{{ route('recipes.edit_page', $recipe) }}">{{ $recipe->name }}</a>
            </li>
        @endforeach
    </ul>
</x-recipehouse>
