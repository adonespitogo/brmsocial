@extends('base')

@section('head')
	<title>BRM Social - Login</title>
	<link rel="stylesheet" href="{{ URL::to('bootstrap-3.1/css/bootstrap.cosmo.min.css')}}">
	<style type="text/css">
		.logo-img { width: 80px; }
		.align-center { text-align: center; }
	</style>
@stop

@section('body')

	<div class="container">
		<div class="row">
			<div class="col-lg-4 col-lg-offset-4" style="padding-top: 50px;">

				<p class="align-center">
					{{ image_tag('brmsocial-icon.png', array('class' => 'logo-img')) }}
				</p>

				<form action="{{URL::to('session/login')}}" method="POST">
					<div class="form-group">
						<label for="">
							Email:
						</label>
						<input class="form-control" type="text" name="email">
					</div>
					<div class="form-group">
						<label for="">
							Password:
						</label>
						<input class="form-control" type="password" name="password">
					</div>
					<div class="form-group">
						<div class="checkbox">
							<label>Remember me
								<input type="checkbox" name="remember">
							</label>
						</div>
					</div>
					<button class="btn btn-primary" type="submit" style="width: 100%;">Login</button>
				</form>
			</div>
		</div>
	</div>
@stop