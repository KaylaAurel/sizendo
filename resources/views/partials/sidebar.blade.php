<!-- resources/views/partials/sidebar.blade.php -->
<div class="d-flex flex-column p-3 bg-light" style="width: 250px; height: 100vh;">
    <h4 class="mb-4">Admin Menu</h4>
    <ul class="nav nav-pills flex-column">
        <li class="nav-item mb-2">
            <a href="{{ route('admin.member.dashboard') }}" class="nav-link text-dark">
                Data Member
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.register') }}" class="nav-link text-dark">
                Daftar
            </a>
        </li>
    </ul>
</div>
