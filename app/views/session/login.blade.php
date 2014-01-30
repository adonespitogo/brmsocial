@extends('base')

@section('body')
	<form action="{{URL::to('session/login')}}" method="POST">
		<div class="form-group">
			<label for="">
				Email:
			</label>
			<input type="text" name="email">
		</div>
		<div class="form-group">
			<label for="">
				Password:
			</label>
			<input type="password" name="password">
		</div>
		<button type="submit">Login</button>
	</form>
@stop