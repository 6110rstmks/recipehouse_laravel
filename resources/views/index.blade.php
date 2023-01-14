<x-layout>
    <x-slot name="left">
        <x-leftside :posts="$posts" />
    </x-slot>

    <!-- 画面右側 -->
    <!-- if there are any categories ,below html is rendered. -->
    {{-- if thre is no categories, right screen display nothing. --}}
    @if($posts->count() != 0)
        <span class="icon">
            <i class="fas fa-utensils fa-lg"></i>
        </span>
        <span style="font-size: 20px; margin-left: 10px;">{{ $posts[0]->title }}</span>

        <form method="post" action="{{ route('tasks.store', $posts[0]) }}" class="task-form">
            @csrf
            <p>add recipe</p>
            <input type="text" name="body">
        </form>

        <ul style="margin-top: 15px;">
            @foreach ($posts[0]->tasks as $task)
                <li>
                    {{-- <form method="post" action="{{ route('tasks.destroy', $posts[0], $task) }}" class="delete-comment"> --}}
                    <form method="post" action="{{ route('tasks.destroy', $task) }}" class="delete-comment">
                        @method('DELETE')
                        @csrf
                        <button>削除</button>
                    </form>
                    <span class="subtitle">
                        {{ $task->body }}
                    </span>
                </li>
            @endforeach
        </ul>
    {{-- @elseif ($posts->count() >= 2) --}}
    @endif
</x-layout>
