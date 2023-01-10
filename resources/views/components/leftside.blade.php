
<span class="button is-success purge-category" style="margin-top: 12px;">purge</span>
<ul class="category_ul">
    @forelse ($posts as $post)
    <li>
        <div class="title-container" style="margin-top: 30px">
            <span class="delete" style="margin-right: 10px" data-id="{{ $post->id }}">x</span>
            <input class="title-update" type="text" value="{{ $post->title}}" name="updateTitle" onfocus="this.select();" data-id="{{ $post->id }}">
        </div>
        @error('update-title')
            <div class="error">{{ $message }}</div>
        @enderror

        <a class="show-category" href="{{ route('posts.show', $post) }}"><span style="font-size: 15px;">◀</span>recipe list<span style="font-size: 15px;">▶</span></a>
    </li>
    @empty
    <li>No posts yet!</li>
    @endforelse
</ul>
