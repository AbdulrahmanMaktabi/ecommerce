    <div class="main-sidebar sidebar-style-2">
        <aside id="sidebar-wrapper">
            <div class="sidebar-brand">
                <a href="index.html">Stisla</a>
            </div>
            <div class="sidebar-brand sidebar-brand-sm">
                <a href="index.html">St</a>
            </div>
            <ul class="sidebar-menu">
                <li class="menu-header active {{ setActive('admin.dashboard') }}">Dashboard</li>
                <li class="dropdown ">
                    <a href="{{ route('admin.dashboard') }}"
                        class="nav-link active {{ setActive('admin.dashboard') }}"><i
                            class="fas fa-fire"></i><span>Dashboard</span></a>
                </li>
                <li class="menu-header">Starter</li>
                <li class="dropdown {{ setActive(['admin.slider.*']) }}">
                    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                            class="fas fa-columns"></i>
                        <span>Manege Site</span></a>
                    <ul class="dropdown-menu">
                        <li class="{{ setActive(['admin.slider.*']) }}"><a class="nav-link"
                                href="{{ route('admin.slider.index') }}">Slider</a></li>
                    </ul>
                </li>
                <li
                    class="dropdown {{ setActive(['admin.category.*', 'admin.sub-category.*', 'admin.child-category.*']) }}">
                    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                            class="fas fa-columns"></i>
                        <span>Manege Categories</span></a>
                    <ul class="dropdown-menu">
                        <li class="{{ setActive(['admin.category.*']) }}"><a class="nav-link "
                                href="{{ route('admin.category.index') }}">Category</a></li>
                        <li class="{{ setActive(['admin.sub-category.*']) }}"><a class="nav-link"
                                href="{{ route('admin.sub-category.index') }}">Sub Category</a></li>
                        <li class="{{ setActive(['admin.child-category.*']) }}"><a class="nav-link "
                                href="{{ route('admin.child-category.index') }}">Child Category</a></li>
                    </ul>
                </li>
                <li class="dropdown {{ setActive(['admin.brand.*']) }}">
                    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                            class="fas fa-columns"></i>
                        <span>Manege Brands</span></a>
                    <ul class="dropdown-menu">
                        <li class="{{ setActive(['admin.brand.*']) }}"><a class="nav-link "
                                href="{{ route('admin.brand.index') }}">Brand</a></li>
                    </ul>
                </li>

            </ul>

        </aside>
    </div>
