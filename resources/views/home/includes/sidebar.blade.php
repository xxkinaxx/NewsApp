<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link " href="{{ route('home') }}">
                <i class="bi bi-house-fill"></i>
                <span>Home</span>
            </a>
        </li><!-- End Dashboard Nav -->
        @if ( Auth::user()->role == 'admin')
        <li class="nav-item">
            <a class="nav-link " data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-folder-fill"></i><span>Components</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="components-nav" class="nav-content collapse show" data-bs-parent="#sidebar-nav">
                <li>
                    <a href="components-alerts.html">
                        <i class="bi bi-circle"></i><span>Alerts</span>
                    </a>
                </li>
                <li>
                    <a href="components-accordion.html">
                        <i class="bi bi-circle"></i><span>Accordion</span>
                    </a>
                </li>
            </ul>
        </li><!-- End Components Nav -->
        @else
            
        @endif
</aside><!-- End Sidebar-->