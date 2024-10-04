<nav class="bg-gray-800 p-4">
    <div class="container mx-auto flex justify-between items-center">
        <a href="{{ route('dashboard') }}" class="text-white text-lg font-bold">my website</a>
        <ul class="flex space-x-4">
            @if(auth()->check())
                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-white hover:bg-gray-700 rounded">Logout</button>
                    </form>
                </li>
            @else
                <li><a href="{{ route('login') }}" class="text-white hover:text-blue-400 mt-4 p-4">Login</a></li>
                <li><a href="{{ route('register') }}" class="text-white hover:text-blue-400 m-4 p-4">Register</a></li>
            @endif
        </ul>
    </div>
</nav>
