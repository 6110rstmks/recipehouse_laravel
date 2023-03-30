<x-layout>

    <h1 class="text-amber-500">Auth History</h1>

    <ul>

    @foreach($histories as $history)

        <li class="list-none">
            <div>
                {{$history->ip_address}}
            </div>
        </li>
    @endforeach
    </ul>

</x-layout>

