<x-layout>

    @auth
        <a href="{{ route('login_form') }}">Sign in from here</a>
    @endauth
    <h2>{{ $recipe->name }}</h2>

    @if (!is_null($recipe->file_path))
        <img src="{{ asset('storage/'. $recipe->file_path) }}">
    @endif
</x-layout>

