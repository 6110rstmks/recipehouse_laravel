<x-layout>
    <section>
        {{-- 編集ボタンを押してこのページに入った場合 --}}

        {{-- レシピを作成のボタンを押してこのページに入った場合 --}}
        <h2>{{$recipe->name }}</h2>

        <span class="border rounded-xl px-1 -mt-2" title="テキストは自動保存されます。マークダウンに対応しています。">?</span>
        <form action="{{$route}}" method="POST">
            textarea
            <button class="btn-c">save</button>
        </form>
    </section>
</x-layout>
