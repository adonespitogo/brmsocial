@extends('base')

@section('head')
	<title>BRM Social - Sign Up</title>
	{{HTML::style('bootstrap-3.1/css/bootstrap.cosmo.min.css')}}
	<link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
	<style>
		.align-center{margin: 0 auto; display: block;}
	</style>
@stop

@section('body')
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-lg-4 col-md-4 col-md-offset-4 col-sm-8 col-sm-offset-2 col-lg-offset-4" style="padding-top: 50px;">

				<p class="text-center">
					<img src="http://localhost/htdocs/repo.brmsocial.com/public/assets/brmsocial-icon.png">
				</p>

				<form  method="POST" action="{{URL::to('register')}}">
					<div class="form-group">
						<label for="">Email:</label>
						<input name="email" class="form-control" type="text" name="email">
					</div>
					<div class="form-group">
						<label for="">Password:</label>
						<input name="password" class="form-control" type="password" name="password">
					</div>
					<div class="form-group">
						<label>First Name:</label>
						<input name="firstname" type="text" placeholder="First Name" class="form-control">
					</div>
					<div class="form-group">
						<label>Last Name:</label>
						<input name="lastname" type="text" placeholder="Last Name" class="form-control">
					</div>
					<div class="form-group">
						<label>Gender:</label>
						<select name="gender" class="form-control">
							<option value="1">Male</option>
							<option value="0">Female</option>
						</select>
					</div>
					<div class="form-group">
						<button class="btn btn-primary btn-block" type="submit">Register</button>
						
					</div>
					<div class="form-group">
						<a href="{{URL::to('register/facebook')}}" class="btn btn-info btn-block">
							<i class="fa fa-facebook-square"></i>
							Login with Facebook
						</a>
					</div>
				</form>
				
			</div>
		</div>
		
	</div>
@stop

@section('scripts')
	{{javascript_include_tag('register')}}
@stop