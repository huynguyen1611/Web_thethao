<!DOCTYPE html>
<html lang="en">
  <head>
   @include('frontend.parts.head')
  </head>
  <body>
    <!-- ------Header----------- -->
    @include('frontend.parts.header')
    <!-- -----------Content------------- -->
    @yield('content')
    <!-- --------Hot-product--------- -->
    @yield('hot_product')
    <!-- -------product - new -->
    {{-- @include('frontend.parts.product_new') --}}
    <!-- ----footer----- -->
    @include('frontend.parts.footer')
  </body>
</html>
