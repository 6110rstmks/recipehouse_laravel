<x-layout>
    <form method="POST" action="{{ route('admin.register') }}">
    @csrf

    <div>Email</div>
    <input id="text" type="email" name="email" value="{{ old('name') }}">

    <span>PASSWORD</span>
    <input type="password" name="password">
    <button>Submit</button>

    </form>
</x-layout>
