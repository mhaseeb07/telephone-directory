<!doctype html>
<html lang="en">
<head>
    @include('admin.layouts.head')
</head>
<body>
<div id="overlayer"></div>
<span class="loader">
  <span class="loader-inner"></span>
</span>
<div class="wrapper">
    <!-- Sidebar  -->
@include('admin.layouts.sidebar')
<!-- Page Content  -->
    <div class="content">
        <header>
            @include('admin.layouts.navigation')
        </header>
        <main>
            @yield('content')
        </main>
    </div>
</div>
@include('admin.layouts.scripts')
</body>
</html>
