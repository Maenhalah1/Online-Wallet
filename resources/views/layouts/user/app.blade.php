<!DOCTYPE html>
<html lang="en">
<head>
@include("layouts.user.parts.header")
</head>
<body class="app sidebar-mini rtl">
<!-- Navbar-->
@include("layouts.user.parts.navbar")

<main style="padding-top: 60px">
    <div class="container">
        @yield("content")
    </div>
</main>
@include("layouts.user.parts.footer")
</body>
</html>
