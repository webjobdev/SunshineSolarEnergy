<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Admin Dashboard">
  <title>{{ configSetting('web_name') }} | @yield('title')</title>
  <link rel="icon" type="image/x-icon" href="{{ configImage('web_favicon') ?? asset('admin-theme/assets/images/brand/logo/logo-icon.svg') }}">
  @include('admin.layouts.partials.head')
</head>
<body>
  <div class="admin-shell">
    @include('admin.layouts.partials.sidebar')
    <div class="admin-main">
      @include('admin.layouts.partials.header')
      <main class="dashboard-content">
        <div class="container-fluid px-3 px-lg-4 py-4">
          @yield('content')
        </div>
      </main>
      @include('admin.layouts.partials.footer')
    </div>
  </div>
  @include('admin.layouts.partials.scripts')
</body>
</html>