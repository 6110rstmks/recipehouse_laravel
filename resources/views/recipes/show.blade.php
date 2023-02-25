<x-layout>

    @guest
        <a class="btn-blue" href="{{ route('login_form') }}">Sign in from here</a>
    @endguest

    <h2 class="mt-6">{{ $recipe->name }}</h2>

    @if (!is_null($recipe->file_path))
        <img class="mt-6" width=380 src="{{ asset('storage/'. $recipe->file_path) }}">
    @endif

    <i class="fa fa-eye" style="font-size: 15px"></i><span>{{$recipe->view}}</span>

    <button class="btn-blue" onclick="history.back()">前に戻る</button>


</x-layout>

