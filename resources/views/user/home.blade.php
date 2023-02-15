<div>mypage</div>

<form action="{{ route('logout') }}" method="POST">
    @csrf
        <button>logout</button>
    </form>

    <button>退会はこちら（未実装）</button>
    <a href="{{ route('register_page') }}"><button>user registeration is here</button></a>

    <button><a href="{{route('categories.index')}}">recipe register page</a></button>
