<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>@yield('title')</title>

  @include('admin.partials.css')
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

    @include('admin.partials.navbar')

    @include('admin.partials.header')
    @yield('content')

  <aside class="control-sidebar control-sidebar-dark">
    <div class="p-3">
      <h5>Title</h5>
      <p>Sidebar content</p>
    </div>
  </aside>

  <!-- Main Footer -->
  @include('admin.partials.footer')
</div>

@include('admin.partials.script')
@include('sweetalert::alert')
</body>
</html>
