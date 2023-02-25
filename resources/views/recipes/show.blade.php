<x-layout>

    @guest
        <a class="btn-blue" href="{{ route('login_form') }}">Sign in from here</a>
    @endguest

    <h2 class="text-4xl mt-6">{{ $recipe->name }}</h2>

    @if (!is_null($recipe->file_path))
        <img class="mt-6" width=380 src="{{ asset('storage/'. $recipe->file_path) }}">
    @endif

    <i class="fa fa-eye" style="font-size: 15px"></i><span>{{$recipe->view}}</span>

    @auth
    <form action="{{route('')}}" method="POST" class="flex">
        <input type="text" name="" id="">
        <div class="ml-3 cursor-pointer border w-4">
            <i class="fa fa-plus"></i>
        </div>
    </form>
    @endauth

    {{-- 一覧ページから来た場合 --}}
    {{-- show(),showList()を参照 --}}
    @if (isset($previous_page_url_number))
        <a href="{{route('recipes.list', ['page' => $previous_page_url_number])}}" class="btn-blue" onclick="history.back()">前に戻る</a>
    @else
    {{-- レシピハウスから詳細レシピページに入った場合 --}}
        <button class="btn-blue" onclick="history.back()">前に戻る</button>
    @endif

</x-layout>

