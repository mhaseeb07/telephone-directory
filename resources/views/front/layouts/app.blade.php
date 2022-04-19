<!doctype html>
<html lang="en">
@include('front.layouts.head')
<body>
@include('front.layouts.top-nav')
@include('front.layouts.header')
@yield('content')

@include('front.layouts.scripts')
@include('front.layouts.footer')
</body>
</html>
