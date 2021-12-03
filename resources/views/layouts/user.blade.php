<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-status-bar-style" content="default">
	{{-- <meta http-equiv="Content-Security-Policy" content="default-src * 'self' 'unsafe-inline' 'unsafe-eval' data: gap:"> --}}
    <meta http-equiv="Content-Security-Policy"
    content="
      worker-src blob:;
      child-src blob: gap:;
      img-src 'self' blob: data:;
      default-src * 'self' 'unsafe-inline' 'unsafe-eval' data: gap: content:">

	<link rel="icon" href="images/favicon.png">

	<link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;700;800;900&family=Montserrat:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

	<title>MosApp</title>
	<link rel="stylesheet" href="{{ asset('user/') }}/css/frame.css">
	<link rel="stylesheet" href="{{ asset('user/') }}/css/style.css">

</head>
<body>

	<div id="app">
        @yield('content')
	</div>

	<!-- script -->
	<script src="https://unpkg.com/ionicons@5.0.0/dist/ionicons.js"></script>
	<script src="{{ asset('user/') }}/js/frame.js"></script>
	<script src="{{ asset('user/') }}/js/routes.js"></script>
	<script src="{{ asset('user/') }}/js/app.js"></script>
	<!-- end script -->
    @yield('script')
</body>
</html>
