<div>
    <a href="{{ route('home') }}" class="nav_logo"> <i class='bi bi-speedometer2 nav_logo-icon'></i>
        <span class="nav_logo-name">Panel Admina</span> </a>
    <div class="nav_list">
        <a href="{{ route('posts') }}" class="nav_link mb-0">
            <i class='bi bi-card-list nav_icon'></i>
            <span class="nav_name">Wpisy</span>
        </a>
        <a href="{{ route('comments') }}" class="nav_link mb-0">
            <i class='bi bi-chat-quote nav_icon'></i> <span class="nav_name">Komentarze</span>
        </a>
        <a href="{{ route('allCategories') }}" class="nav_link mb-0">
            <i class='bi bi-shuffle nav_icon'></i>
            <span class="nav_name">Kategorie</span>
        </a>
        <a href="{{ route('pages') }}" class="nav_link mb-0">
            <i class='bi bi-boxes nav_icon'></i>
            <span class="nav_name">Strony</span>
        </a>
        <a href="{{ route('file-manager') }}" class="nav_link mb-0">
            <i class='bi bi-image nav_icon'></i>
            <span class="nav_name">Media</span>
        </a>
        <a href="{{ route('users') }}" class="nav_link mb-0">
            <i class='bi bi-people nav_icon'></i>
            <span class="nav_name">Użytkownicy</span>
        </a>
    </div>
</div>

<a href="{{ route('logout') }}" class="nav_link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
    <i class='bi bi-box-arrow-left nav_icon'></i> <span class="nav_name">{{ __('Logout') }}</span>
</a>
<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
    @csrf
</form>