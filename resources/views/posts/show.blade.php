<x-layout>
    <x-slot name="left">
        <x-leftside :posts="$posts" />
    </x-slot>

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
                <form method="post" action="{{ route('tasks.destroy', $task) }}" class="delete-comment">
                    @method('DELETE')
                    @csrf
                    <button class="btn">[x]</button>
                </form>
            </li>
        @endforeach
    </ul>
</x-layout>
