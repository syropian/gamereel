<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Welcome to GameReel</title>
	<link type="text/css" rel="stylesheet" href="//fast.fonts.net/cssapi/e86fec05-ed26-4bd2-b35f-be6ce5deb2c9.css" />
	<link rel="stylesheet" href="/css/app.css">

</head>

<body>
	<div id="app"></div>
	@if(isset($email_confirmed))
	<script>
		window.EMAIL_CONFIRMED = true;
	</script>
	@endif
	<script src="/js/app.js"></script>
</body>

</html>