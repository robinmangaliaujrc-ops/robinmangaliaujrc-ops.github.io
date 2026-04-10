<!DOCTYPE html>
<html>
<head>
    ...
    @stack('styles')  {{-- ← add this in the <head> --}}
</head>
<body>
    @yield('content')

    @stack('scripts')  {{-- ← add this before </body> --}}
</body>
</html>