
	<div class="navigation hidden-xs">
		<div class="container nav-con">
	    	<div class="row">
	   			<div class="col-md-12">
				    <div class="nav-style">
				    	<a href="{{URL::to('/')}}">
				    		<img src='{{URL::to("website/images/brmsocial-logo.png")}}' alt="BRM Social" class="logo">
				    	</a>
					    <ul class="nav nav-pills">
					      <li class="dropdown shop">
					        <a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="fa fa-th"></i>Shop by Category</a>
					        <ul class="dropdown-menu">
					        	@foreach (Category::all() as $category)
									<li>
										<a href="{{URL::to('products/category/'.$category->slug)}}">
											<i class="fa fa-star"></i>
											{{$category->category}}
										</a>
									</li>
					        	@endforeach
					        </ul>
					      </li>
					      <li class="dropdown"><a href="{{URL::to('free-products')}}">Free Stuff</a></li>
					    </ul>
				    </div>
				    <div class="login-con">
					    <ul class="">
					    	@if(Auth::user()&&Auth::user()->type=='admin')
					    		<li style="padding-left: 15px;" class="custom-login-dropdown">
					              <div class="dropdown">
					                <a id="dLabel" role="button" data-toggle="dropdown" data-target="#" style="font-family: 'Open Sans', sans-serif;font-weight: 400;font-size: 15px;color: #FFF;"> 
					                {{Auth::user()->firstname}} {{Auth::user()->lastname}}
					                <span class="caret"></span></a>
					                <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">                  
					                  <li><a href="{{URL::to('home')}}">Dashboard</a></li>
					                  <li><a href="{{URL::to('home#/products')}}">Products</a></li>
					                  <li><a href="{{URL::to('home#/categories')}}">Categories</a></li> 
					                  <li><a href="{{URL::to('home#/users')}}">Users</a></li>
					                  <li><a href="{{URL::to('session/logout')}}">Logout</a></li>
					                </ul>
					              </div>
					            </li>
					        @elseif(Auth::user()&&Auth::user()->type=='customer')
					        	<li style="padding-left: 15px;" class="custom-login-dropdown">
					              <div class="dropdown">
					                <a id="dLabel" role="button" data-toggle="dropdown" data-target="#" style="font-family: 'Open Sans', sans-serif;font-weight: 400;font-size: 15px;color: #FFF;"> 
					                	{{Auth::user()->firstname}} {{Auth::user()->lastname}}
					                <span class="caret"></span></a>
					                <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">                  
					                  <li><a href="{{URL::to('home')}}">Dashboard</a></li>
					                  <li><a href="{{URL::to('home#/account')}}">My Account</a></li>
					                  <li><a href="{{URL::to('home#/purchases')}}">My Purchases</a></li> 
					                  <li><a href="{{URL::to('home#/credits')}}">Refer a Friend</a></li>
					                  <li><a href="{{URL::to('session/logout')}}">Logout</a></li>
					                </ul>
					              </div>
					            </li>
					    	@else
				          	<li style="padding-left: 15px; padding-right: 15px;border-right: 1px solid #3a3d43;"><a href="{{URL::to('signup')}}">Signup</a></li>
				         	<li style="padding-left: 15px;"><a href="{{URL::to('session/login')}}">Login</a></li>
				         	@endif
				           	<li>
				           		@include('public.shared.cart_btn')
				           	</li>
					    </ul>
				   </div>
    			</div>
  			</div>
    	</div>
	</div>


	<!-- Mobile View -->
	<div id="mobile-nav" class="visible-xs">
	   	<ul>
		   	<li><a href="#menu" class="mbtn"></a></li>
		   	<li><a href="#"><img src="website/images/brmsocial-logo.png" alt="BRM Social" style="margin-left:50px;"></a></li>
		   	<li></li>
	    </ul>
        
        <nav id="menu">
			<ul>
				<li><a href="#">Home</a></li>
				<li>
					<a href="javascript:void(0);">Category</a>
					<ul>


						@foreach (Category::all() as $category)
							<li>
								<a href="{{URL::to('products/category/'.$category->slug)}}">
									<i class="fa fa-star"></i>
									{{$category->category}}
								</a>
							</li>
			        	@endforeach
					</ul>
				</li>
				<li><a href="{{URL::to('free-products')}}">Free Stuff</a></li>
				@if(!Auth::check())
					<li><a href="#">Signup</a></li>
					<li><a href="{{URL::to('session/login')}}">Login</a></li>
				@else
					<li><a href="{{URL::to('session/logout')}}">Logout</a></li>
				@endif
			</ul>	
		</nav>
    </div>

