
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
        {{-- bg-inheritでテキストフォームのbackground-colorを同化させている --}}
        <input class="text-red-400 bg-inherit cursor-text title-update" type="text"
            value="{{ $category->title}}" name="updateTitle"
            onfocus="this.select();" data-id="{{ $category->id }}">

        <form action="{{ route('categories.destroy', $category)}}" method="POST">
            @csrf
            @method('DELETE')
            <button class="btn-d">
                <i class="fa fa-trash" aria-hidden="true"></i>
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


