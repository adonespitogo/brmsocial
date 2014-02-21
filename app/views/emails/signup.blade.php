@extends('base')

@section('head')

@stop

@section('body')
	<p>Hey, Superstar!</p> 
	<p>Your Buy Real Marketing Account has been created. </p>
	<br>
	<p>Email: {{$email}}</p>
	<p>Password: {{$password}}</p>
	<p>Login here: {{HTML::link('/', URL::to('/'), array('target' => '_blank'))}}</p>
	<br>
	<p>Yeah, that&#039;s sweet and all that dude, but, what now?</p>
	<br>
	<p>
	Houston this is how you&#039;ll fly that private jet of success, where you&#039;ll find an endless stash of win hacks!
	</p>
	<p>So login to the AWESOME Client Portal on the daily for:</p>

	<ol>
		<li>Discounts and promos</li>
		<li>Order tracking</li>
		<li>Hassle-free transactions</li>
		<li>Customer service love</li>
	</ol>

	<p>Keep heading up!</p>
	<br>
	<p>Team Buy Real Marketing</p>

@stop