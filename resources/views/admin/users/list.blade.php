<h2>users list</h2>

@foreach ($users as $user)

<p>
    <span>username:</span>
    {{$user->username}}
</p>
@endforeach
