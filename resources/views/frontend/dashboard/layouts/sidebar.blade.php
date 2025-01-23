<div class="dashboard_sidebar">
    <span class="close_icon">
        <i class="far fa-bars dash_bar"></i>
        <i class="far fa-times dash_close"></i>
    </span>
    <a href="dsahboard.html" class="dash_logo"><img src="{{ asset('frontend/assets') }}/images//logo.png" alt="logo"
            class="img-fluid"></a>
    <ul class="dashboard_link">
        <li><a class="{{ setActive('user.dashboard') }}" href="{{ route('user.dashboard') }}"><i
                    class="fas fa-tachometer"></i>Dashboard</a></li>
        <li><a class="{{ setActive('') }}" href="#"><i class="fas fa-list-ul"></i> Orders</a></li>
        <li><a class="{{ setActive('') }}" href="#"><i class="far fa-cloud-download-alt"></i>
                Downloads</a></li>
        <li><a class="{{ setActive('') }}" href="#"><i class="far fa-star"></i> Reviews</a></li>
        <li><a class="{{ setActive('') }}" href="#"><i class="far fa-heart"></i> Wishlist</a></li>
        <li><a class="{{ setActive('user.profile') }}" href="{{ route('user.profile') }}"><i class="far fa-user"></i> My
                Profile</a>
        </li>
        <li><a class="{{ setActive('address.*') }}" href="{{ route('address.index') }}"><i
                    class="fal fa-gift-card"></i>
                Addresses</a></li>
        <li>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
            <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="far fa-sign-out-alt"></i> Log out
            </a>
        </li>
    </ul>
</div>
