<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		@yield('head')
		<style>a:hover{cursor: pointer;}</style>
		<link rel="shortcut icon" href="{{URL::to('favicon.ico')}}" type="image/x-icon" >
		<base href="{{URL::to('/')}}">
		<script type="text/javascript">base_url = '{{URL::to("/")}}'</script>
	</head>
	<body>
		@yield('body')
		@yield('scripts')
	</body>
</html>