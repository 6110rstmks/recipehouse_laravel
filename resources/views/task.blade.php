{{-- step1ログイン時のみタスク追加ができるようにする --}}
{{-- step2 --}}

<h1>task list</h1>

@foreach ($tasks as $task)

    <p>{{ $task->body }}</p>

@endforeach

{{ $tasks->links('pagination.default') }}

@guest
    <p>ログインするとタスクを追加できます。</p>
@endguest



@auth
    商品登録
    <form action="">
        <input type="text" name="" id="">
    </form>
@endauth
