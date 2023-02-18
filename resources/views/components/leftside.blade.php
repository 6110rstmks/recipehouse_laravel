
{{-- this file reprezent the left screen --}}


{{-- カテゴリを表示 --}}
<ul class="category_ul">
    @forelse ($categories as $category)
    <li>
        {{-- <div class="title-container" style="margin-top: 30px">
            <span class="delete" style="margin-right: 10px" data-id="{{ $category->id }}">x</span>
        </div> --}}
        <a class="block" href="{{ route('categories.show', $category) }}"><span style="font-size: 15px;">◀</span>Show Recipe<span style="font-size: 15px;">▶</span></a>


        {{-- タイトルをajaxでupdateできる --}}
        <input class="cursor-text title-update"  type="text" value="{{ $category->title}}" name="updateTitle" onfocus="this.select();" data-id="{{ $category->id }}">

        <form action="{{ route('categories.destroy', $category)}}" method="POST">
            @csrf
            @method('DELETE')
            <button class="text-yellow-400 hover:text-white border
                focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5
                text-center mr-2 mb-2 dark:border-yellow-300 dark:text-yellow-300 dark:hover:text-white
                border-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:outline-none
                dark:hover:bg-yellow-400 dark:focus:ring-yellow-900">
                <i class="fa fa-trash" aria-hidden="true"></i>
                x
            </button>
        </form>

        @error('update-title')
            <div class="error">{{ $message }}</div>
        @enderror

    </li>
    @empty
    <li>No categories yet!</li>
    @endforelse
</ul>


