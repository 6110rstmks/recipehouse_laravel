<h1>recipe list</h1>

@foreach ($recipes as $recipe)
<p>
    <span>recipe name:</span>
    <span>{{ $recipe->body }}</span>
</p>

@endforeach

{{ $recipes->links('pagination.default') }}

@guest
    <p>You can add recipes if you sign in</p>
    <button><a href="{{ route('login_form') }}">sign in form from here</a></button>
@endguest

@auth
    <button><a href="{{ route('user.home') }}">mypage from here</a></button>
@endauth

{{-- <form action="{{ route('recipes.store',) }}" method="POST">
    <select name="" id="">
        @forelse ($categories as $category)
            <option value="">{{ $category->title}}</option>
        @empty
            <option value="">no category</option>
        @endforelse
    </select>
</form> --}}

