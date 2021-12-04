<!DOCTYPE html>
<html>
@include("layouts.auth.parts.header")
@hasSection("header-resources")
    @yield("header-resources")
@endif
<body>
<section class="material-half-bg" style="background: #eee">
    <div class="cover"></div>
</section>
<section class="login-content">
    <div class="logo">
        <h1>Wallet</h1>
    </div>
    @yield("content")
</section>
<!-- Essential javascripts for application to work-->
@include("layouts.auth.parts.footer")
</body>
</html>
