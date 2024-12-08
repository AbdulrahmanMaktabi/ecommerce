<!DOCTYPE html>
<html lang="en">

@include('admin.layouts.header')

<body>
    <div id="app">
        <div class="main-wrapper main-wrapper-1">
            {{-- Navbar --}}
            @include('admin.layouts.navbar')
            {{-- // Navbar // --}}

            {{-- Sidebar --}}
            @include('admin.layouts.sidebar')
            {{-- // Sidebar // --}}

            <!-- Main Content -->
            <div class="main-content">
                @yield('content')
            </div>

            {{-- Footer --}}
            @include('admin.layouts.footer')
            {{-- // Footer // --}}

        </div>
    </div>
    @include('admin.layouts.scripts')
</body>

</html>
