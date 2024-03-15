<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link" href="{{ route('home') }}">
                <i class="bi bi-house-fill"></i>
                <span>Home</span>
            </a>
        </li><!-- End Dashboard Nav -->
        @if ( Auth::user()->role == 'admin')
        <li class="nav-item">
            <a class="nav-link" href="{{ route('allUser') }}">
                <i class="bi bi-file-person-fill"></i><span>User</span>
            </a>
        </li>
        <li>
            <a class="nav-link" href="{{ route('category.index') }}">
                <i class="bi bi-hdd-stack"></i><span>Category</span>
            </a>
        </li>
        <li>
            <a class="nav-link" href="{{ route('news.index') }}">
                <i class="bi bi-file-earmark-richtext"></i><span>News</span>
            </a>
        </li>
        @else

        @endif
</aside><!-- End Sidebar-->