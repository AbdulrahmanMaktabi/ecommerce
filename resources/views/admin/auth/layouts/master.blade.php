<!DOCTYPE html>
<html lang="en">

@include('admin.auth.layouts.header')

<body>
    <div id="app">
        @yield('content')
    </div>

    @include('admin.auth.layouts.scripts')
</body>

</html>
