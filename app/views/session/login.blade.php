@extends('base')

@section('head')
	<link rel="stylesheet" href="{{ URL::to('bootstrap-3.1/css/bootstrap.cosmo.min.css')}}">
	<style type="text/css">
		.logo-img { width: 80px; display: block; margin: 0px auto;}
		.align-center { text-align: center; }
	</style>
@stop

@section('body')

	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-lg-4 col-md-4 col-md-offset-4 col-sm-8 col-sm-offset-2 col-lg-offset-4" style="padding-top: 50px;">

				<p class="align-center">
					{{ 
						image_tag(
							'brmsocial-icon.png', 
							array(
								'class' => 'logo-img img-responsive'
							)
						) 
					}}
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
					<button class="btn btn-primary btn-block" type="submit">Login</button>
				</form>
			</div>
		</div>
	</div>
@stop