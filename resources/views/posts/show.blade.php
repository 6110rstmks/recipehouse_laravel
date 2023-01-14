<x-layout>
    <x-slot name="left">
        <x-leftside :posts="$posts" />
    </x-slot>

        <!-- 画面右側 -->
    <!-- if there are any categories ,below html is rendered. -->
    {{-- if thre is no categories, right screen display nothing. --}}
    <h1>*List*  {{ $post->title }}</h1>

    <form method="post" action="{{ route('tasks.store', $post) }}" class="task-form">
        @csrf
        <p>add recipe</p>
        <input type="text" name="body">
    </form>
    <ul>
        @foreach ($post->tasks as $task)
            <li>
                {{ $task->body }}
                <form method="post" action="{{ route('tasks.destroy', $post, $task) }}" class="delete-comment">
                    @method('DELETE')
                    @csrf
                    <button class="btn">削除</button>
                </form>
            </li>
        @endforeach
    </ul>
</x-layout>
