<div class="sidebar-backdrop" data-sidebar-close></div>
<aside class="admin-sidebar" id="adminSidebar" aria-label="Main navigation">
    <div class="sidebar-header">
        <a class="brand-mark" href="{{ route('admin.dashboard') }}" aria-label="Admin dashboard">
            {{-- <span class="brand-icon"><i class="bi bi-grid-1x2-fill" aria-hidden="true"></i></span> --}}
            <img style="height: 50px;"
                src="{{ configImage('web_logo') ?? asset('admin-theme/assets/images/brand/logo/logo-icon.svg') }}"
                alt="Logo" class="img-fluid">
            <span class="brand-copy">
                <span class="brand-title">{{ configSetting('web_name') }}</span>
                <span class="brand-subtitle">Welcome,{{ auth()->user()->name }}</span>
            </span>
        </a>
    </div>

    <nav class="sidebar-nav">
        <!-- Dashboard -->
        <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"
            href="{{ route('admin.dashboard') }}"
            aria-current="{{ request()->routeIs('admin.dashboard') ? 'page' : '' }}">
            <span class="nav-icon"><i class="bi bi-speedometer2" aria-hidden="true"></i></span>
            <span class="nav-text">Dashboard</span>
        </a>

        <!-- Pages -->
        <a class="nav-link {{ request()->routeIs('admin.page*') ? 'active' : '' }}" href="{{ route('admin.page') }}"
            aria-current="{{ request()->routeIs('admin.page*') ? 'page' : '' }}">
            <span class="nav-icon"><i class="bi bi-file-earmark-text" aria-hidden="true"></i></span>
            <span class="nav-text">Pages</span>
        </a>

        {{-- Products Dropdown --}}
        <div class="nav-item nav-dropdown {{ request()->routeIs('admin.product*') ? 'open' : '' }}">
            <a class="nav-link nav-dropdown-toggle {{ request()->routeIs('admin.product*') ? 'active' : '' }}"
                href="#productMenu" data-bs-toggle="collapse" role="button"
                aria-expanded="{{ request()->routeIs('admin.product*') ? 'true' : 'false' }}"
                aria-controls="productMenu">
                <span class="nav-icon"><i class="bi bi-box-seam" aria-hidden="true"></i></span>
                <span class="nav-text">Products</span>
                <span class="nav-dropdown-icon">
                    <i class="bi bi-chevron-down" aria-hidden="true"></i>
                </span>
            </a>
            <div class="collapse {{ request()->routeIs('admin.product*') ? 'show' : '' }}" id="productMenu">
                <ul class="nav-submenu">
                    <li>
                        <a class="nav-link {{ request()->routeIs('admin.product') ? 'active' : '' }}"
                            href="{{ route('admin.product') }}">
                            <span class="nav-icon"><i class="bi bi-box-seam" aria-hidden="true"></i></span>
                            <span class="nav-text">All Products</span>
                        </a>
                    </li>
                    <li>
                        <a class="nav-link {{ request()->routeIs('admin.product.create') ? 'active' : '' }}"
                            href="{{ route('admin.product.create') }}">
                            <span class="nav-icon"><i class="bi bi-plus-circle" aria-hidden="true"></i></span>
                            <span class="nav-text">Add Product</span>
                        </a>
                    </li>
                    <li>
                        <a class="nav-link {{ request()->routeIs('admin.product.brand*') ? 'active' : '' }}"
                            href="{{ route('admin.product.brand') }}">
                            <span class="nav-icon"><i class="bi bi-award" aria-hidden="true"></i></span>
                            <span class="nav-text">Brands</span>
                        </a>
                    </li>
                    <li>
                        <a class="nav-link {{ request()->routeIs('admin.product.category*') ? 'active' : '' }}"
                            href="{{ route('admin.product.category') }}">
                            <span class="nav-icon"><i class="bi bi-tags" aria-hidden="true"></i></span>
                            <span class="nav-text">Categories</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        {{-- Services --}}
        <a class="nav-link {{ request()->routeIs('admin.service*') ? 'active' : '' }}"
            href="{{ route('admin.service') }}" aria-current="{{ request()->routeIs('admin.service*') ? 'page' : '' }}">
            <span class="nav-icon"><i class="bi bi-gear-wide-connected" aria-hidden="true"></i></span>
            <span class="nav-text">Services</span>
        </a>

        {{-- Legal Pages --}}
        <a class="nav-link {{ request()->routeIs('admin.legal-page*') ? 'active' : '' }}"
            href="{{ route('admin.legal-page') }}"
            aria-current="{{ request()->routeIs('admin.legal-page*') ? 'page' : '' }}">
            <span class="nav-icon"><i class="bi bi-file-earmark-text" aria-hidden="true"></i></span>
            <span class="nav-text">Legal Pages</span>
        </a>

        {{-- Customer Reviews --}}
        <a class="nav-link {{ request()->routeIs('admin.customer-review*') ? 'active' : '' }}"
            href="{{ route('admin.customer-review') }}"
            aria-current="{{ request()->routeIs('admin.customer-review*') ? 'page' : '' }}">
            <span class="nav-icon"><i class="bi bi-star" aria-hidden="true"></i></span>
            <span class="nav-text">Customer Reviews</span>
        </a>


        <!-- Blog -->
        {{-- <a class="nav-link {{ request()->routeIs('admin.blog*') ? 'active' : '' }}"
            href="{{ route('admin.blog') }}" aria-current="{{ request()->routeIs('admin.blog*') ? 'page' : '' }}">
            <span class="nav-icon">
                <i class="bi bi-journal-text"></i>
            </span>
            <span class="nav-text">Blog</span>
        </a> --}}
        <!-- Blog with Submenu -->
        <div class="nav-item nav-dropdown {{ request()->routeIs('admin.blog*') ? 'open' : '' }}">
            <a class="nav-link nav-dropdown-toggle {{ request()->routeIs('admin.blog*') ? 'active' : '' }}"
                href="#blogMenu" data-bs-toggle="collapse" role="button"
                aria-expanded="{{ request()->routeIs('admin.blog*') ? 'true' : 'false' }}" aria-controls="blogMenu">
                <span class="nav-icon"><i class="bi bi-journal-text" aria-hidden="true"></i></span>
                <span class="nav-text">Blog</span>
                <span class="nav-dropdown-icon">
                    <i class="bi bi-chevron-down" aria-hidden="true"></i>
                </span>
            </a>
            <div class="collapse {{ request()->routeIs('admin.blog*') ? 'show' : '' }}" id="blogMenu">
                <ul class="nav-submenu">
                    <!-- Blog Posts -->
                    <li>
                        <a class="nav-link {{ request()->routeIs('admin.blog') ? 'active' : '' }}"
                            href="{{ route('admin.blog') }}">
                            <span class="nav-icon"><i class="bi bi-journal-text" aria-hidden="true"></i></span>
                            <span class="nav-text">All Posts</span>
                        </a>
                    </li>
                    <!-- Create Post -->
                    <li>
                        <a class="nav-link {{ request()->routeIs('admin.blog.create') ? 'active' : '' }}"
                            href="{{ route('admin.blog.create') }}">
                            <span class="nav-icon"><i class="bi bi-plus-circle" aria-hidden="true"></i></span>
                            <span class="nav-text">Add New Post</span>
                        </a>
                    </li>
                    <!-- Categories -->
                    <li>
                        <a class="nav-link {{ request()->routeIs('admin.blog.category*') ? 'active' : '' }}"
                            href="{{ route('admin.blog.category') }}">
                            <span class="nav-icon"><i class="bi bi-tags" aria-hidden="true"></i></span>
                            <span class="nav-text">Categories</span>
                        </a>
                    </li>
                    <!-- Tags -->
                    <li>
                        <a class="nav-link {{ request()->routeIs('admin.blog.tag*') ? 'active' : '' }}"
                            href="{{ route('admin.blog.tag') }}">
                            <span class="nav-icon"><i class="bi bi-tag" aria-hidden="true"></i></span>
                            <span class="nav-text">Tags</span>
                        </a>
                    </li>
                    <!-- Comments -->
                    <li>
                        <a class="nav-link {{ request()->routeIs('admin.blog.comment*') ? 'active' : '' }}"
                            href="{{ route('admin.blog.comment') }}">
                            <span class="nav-icon"><i class="bi bi-chat-dots" aria-hidden="true"></i></span>
                            <span class="nav-text">Comments</span>
                            @php
                                $pendingComments = \App\Models\Admin\BlogComment::where('status', 'pending')->count();
                            @endphp
                            @if($pendingComments > 0)
                                <span class="badge bg-danger ms-auto">{{ $pendingComments }}</span>
                            @endif
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Website Configuration with Submenu -->
        <div class="nav-item nav-dropdown {{ request()->routeIs('admin.config*') ? 'open' : '' }}">
            <a class="nav-link nav-dropdown-toggle {{ request()->routeIs('admin.config*') ? 'active' : '' }}"
                href="#configMenu" data-bs-toggle="collapse" role="button"
                aria-expanded="{{ request()->routeIs('admin.config*') ? 'true' : 'false' }}" aria-controls="configMenu">
                <span class="nav-icon"><i class="bi bi-gear-wide-connected" aria-hidden="true"></i></span>
                <span class="nav-text">Website Config</span>
                <span class="nav-dropdown-icon">
                    <i class="bi bi-chevron-down" aria-hidden="true"></i>
                </span>
            </a>
            <div class="collapse {{ request()->routeIs('admin.config*') ? 'show' : '' }}" id="configMenu">
                <ul class="nav-submenu">
                    <!-- General Settings -->
                    <li>
                        <a class="nav-link {{ request()->routeIs('admin.config') && request()->input('group') == 'general' ? 'active' : '' }}"
                            href="{{ route('admin.config', ['group' => 'general']) }}">
                            <span class="nav-icon"><i class="bi bi-sliders" aria-hidden="true"></i></span>
                            <span class="nav-text">General Settings</span>
                        </a>
                    </li>
                    <!-- Contact Information -->
                    <li>
                        <a class="nav-link {{ request()->routeIs('admin.config') && request()->input('group') == 'contact' ? 'active' : '' }}"
                            href="{{ route('admin.config', ['group' => 'contact']) }}">
                            <span class="nav-icon"><i class="bi bi-envelope" aria-hidden="true"></i></span>
                            <span class="nav-text">Contact Info</span>
                        </a>
                    </li>
                    <!-- Social Media -->
                    <li>
                        <a class="nav-link {{ request()->routeIs('admin.config') && request()->input('group') == 'social' ? 'active' : '' }}"
                            href="{{ route('admin.config', ['group' => 'social']) }}">
                            <span class="nav-icon"><i class="bi bi-share" aria-hidden="true"></i></span>
                            <span class="nav-text">Social Media</span>
                        </a>
                    </li>
                    <!-- SEO Settings -->
                    <li>
                        <a class="nav-link {{ request()->routeIs('admin.config') && request()->input('group') == 'seo' ? 'active' : '' }}"
                            href="{{ route('admin.config', ['group' => 'seo']) }}">
                            <span class="nav-icon"><i class="bi bi-search" aria-hidden="true"></i></span>
                            <span class="nav-text">SEO Settings</span>
                        </a>
                    </li>
                    <!-- Header Settings -->
                    <li>
                        <a class="nav-link {{ request()->routeIs('admin.config') && request()->input('group') == 'header' ? 'active' : '' }}"
                            href="{{ route('admin.config', ['group' => 'header']) }}">
                            <span class="nav-icon"><i class="bi bi-layout-text-window" aria-hidden="true"></i></span>
                            <span class="nav-text">Header Settings</span>
                        </a>
                    </li>
                    <!-- Footer Settings -->
                    <li>
                        <a class="nav-link {{ request()->routeIs('admin.config') && request()->input('group') == 'footer' ? 'active' : '' }}"
                            href="{{ route('admin.config', ['group' => 'footer']) }}">
                            <span class="nav-icon"><i class="bi bi-layout-text-sidebar" aria-hidden="true"></i></span>
                            <span class="nav-text">Footer Settings</span>
                        </a>
                    </li>
                    <!-- System Settings -->
                    <li>
                        <a class="nav-link {{ request()->routeIs('admin.config') && request()->input('group') == 'system' ? 'active' : '' }}"
                            href="{{ route('admin.config', ['group' => 'system']) }}">
                            <span class="nav-icon"><i class="bi bi-gear" aria-hidden="true"></i></span>
                            <span class="nav-text">System Settings</span>
                        </a>
                    </li>
                    <!-- Add New Config -->
                    <li>
                        <a class="nav-link {{ request()->routeIs('admin.config.create') ? 'active' : '' }}"
                            href="{{ route('admin.config.create') }}">
                            <span class="nav-icon"><i class="bi bi-plus-circle" aria-hidden="true"></i></span>
                            <span class="nav-text">Add New Config</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>





        {{-- <a class="nav-link" href="users.html">
            <span class="nav-icon"><i class="bi bi-people" aria-hidden="true"></i></span>
            <span class="nav-text">Users</span>
        </a>
        <a class="nav-link" href="add-user.html">
            <span class="nav-icon"><i class="bi bi-person-plus" aria-hidden="true"></i></span>
            <span class="nav-text">Add User</span>
        </a>
        <a class="nav-link" href="profile.html">
            <span class="nav-icon"><i class="bi bi-person-badge" aria-hidden="true"></i></span>
            <span class="nav-text">Profile</span>
        </a>
        <a class="nav-link" href="charts.html">
            <span class="nav-icon"><i class="bi bi-bar-chart-line" aria-hidden="true"></i></span>
            <span class="nav-text">Charts</span>
        </a>
        <a class="nav-link" href="tables.html">
            <span class="nav-icon"><i class="bi bi-table" aria-hidden="true"></i></span>
            <span class="nav-text">Tables</span>
        </a>
        <a class="nav-link" href="forms.html">
            <span class="nav-icon"><i class="bi bi-ui-checks-grid" aria-hidden="true"></i></span>
            <span class="nav-text">Forms</span>
        </a>
        <a class="nav-link" href="components.html">
            <span class="nav-icon"><i class="bi bi-grid-3x3-gap" aria-hidden="true"></i></span>
            <span class="nav-text">Components</span>
        </a>
        <a class="nav-link" href="alerts.html">
            <span class="nav-icon"><i class="bi bi-exclamation-triangle" aria-hidden="true"></i></span>
            <span class="nav-text">Alerts</span>
        </a>
        <a class="nav-link" href="modals.html">
            <span class="nav-icon"><i class="bi bi-window-stack" aria-hidden="true"></i></span>
            <span class="nav-text">Modals</span>
        </a>
        <a class="nav-link" href="settings.html">
            <span class="nav-icon"><i class="bi bi-gear" aria-hidden="true"></i></span>
            <span class="nav-text">Settings</span>
        </a>
        <a class="nav-link" href="blank.html">
            <span class="nav-icon"><i class="bi bi-file-earmark" aria-hidden="true"></i></span>
            <span class="nav-text">Blank Page</span>
        </a> --}}
    </nav>

    {{-- <div class="sidebar-user">
        <img class="avatar-img avatar-md sidebar-user-avatar"
            src="{{ asset('admin-theme/assets/images/avatar/avatar.jpg')}}" alt="{{ auth()->user()->name }}">
        <strong>{{ auth()->user()->name }}</strong>
        <small>Active Workspace</small>
    </div> --}}

    <div class="sidebar-footer">
        <span class="status-dot"></span>
        <span class="sidebar-footer-text">System running smoothly</span>
    </div>
</aside>