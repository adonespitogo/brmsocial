<!DOCTYPE html>
<html lang="en" @yield('html_tag_attributes')>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<style>a:hover{cursor: pointer;}</style>
		<link rel="shortcut icon" href="{{URL::to('favicon.ico')}}" type="image/x-icon" >
		<script type="text/javascript">base_url = '{{URL::to("/")}}'</script>
		<base href="{{URL::to('/')}}">
		@yield('head')
	</head>
	<body>
		@yield('body')
		@yield('scripts')
	</body>
</html>