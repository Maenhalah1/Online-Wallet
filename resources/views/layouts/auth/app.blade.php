<!DOCTYPE html>
<html>
@include("layouts.auth.parts.header")
@hasSection("css-links")
    @yield("css-links")
@endif
<body>
<section class="material-half-bg" style="background: #eee">
    <div class="cover"></div>
</section>
<section class="login-content">
    <div class="logo">
        <img src="{{asset("assets/logo2.svg")}}" alt="" class="site-logo login">
    </div>
    @yield("content")
</section>
<!-- Essential javascripts for application to work-->
@include("layouts.auth.parts.footer")
</body>
</html>
