<!DOCTYPE html>
<html lang="en">

@include('layouts.head')

<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
    @include('layouts.navbar')

    @include('layouts.sidebar')

    <div class="content-wrapper">
        @yield('content')
    </div>

    @include('layouts.footer')

    <aside class="control-sidebar control-sidebar-dark">
    </aside>
</div>
@include('layouts.scripts')
</body>
</html>
