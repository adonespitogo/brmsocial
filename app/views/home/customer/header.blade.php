
      <!-- Start Header -->
      <div class="navigation hidden-xs">
        <div class="container-fluid nav-con">
            <div class="row">
              <div class="col-md-12">
                <div class="nav-style">
                  <a href="{{URL::to('/')}}"><img src="{{ URL::to('customer/images/brmsocial-logo.png') }}" alt="BRM Social" class="logo"></a>
                  <ul class="nav nav-pills">
                    <li class="dropdown shop">
                      <a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="fa fa-th"></i>Shop by Category</a>
                      <ul class="dropdown-menu">

                        <li ng-repeat="category in categories">
                          <a href="{{ URL::to('products/category') }}/@{{ category.slug }}"><i class="fa fa-star"></i ng-cloak class="ng-cloak">@{{ category.category }}</a>
                        </li>

                      </ul>
                    </li>
                    <li class="dropdown"><a href="{{URL::to('free-products')}}">Free Stuff</a></li>
                  </ul>
                </div>
                <div class="login-con">
                  <ul class="">
                      <li style="padding-left: 15px; padding-right: 15px;border-right: 1px solid #3a3d43; display:none"><a href="javascript:void(0)">Signup</a></li>
                      <li style="padding-left: 15px;"><a href="{{URL::to('session/logout')}}">Logout</a></li>
                        <li>
                          <?php
                            $cartSummary = Cart::getCartSummary();
                          ?>
                          <div class="bg-cart">
                            <span class="cart-dolsign">$</span>
                            <span class="cart-price totalPrice">{{$cartSummary['totalPrice']}}</span>
                            <i class="fa fa-shopping-cart"></i></span>
                            <span class="cart-orders totalItem">{{$cartSummary['numItem']}}</span>
                          </div>
                        </li>
                  </ul>
               </div>
              </div>
            </div>
          </div>
      </div>
      <!-- End Header -->
       <!-- Mobile View -->
      <div id="mobile-nav" class="visible-xs">
        <ul>
          <li><a href="#menu" class="mbtn"></a></li>
          <li><a href="#"><img src="{{ URL::to('customer/images/brmsocial-logo.png') }}" alt="BRM Social" style="margin-left:50px;"></a></li>
          <li></li>
        </ul>
          
          <nav id="menu">
            <ul>
              <li><a href="#">Home</a></li>
              <li>
                <a href="javascript:void(0);">Category</a>
                <ul>
                  <li><a href="#">Applce/Mac</a></li>
                  <li><a href="#">Designer</a></li>
                  <li><a href="#">Developer</a></li>
                  <li><a href="#">Entrepreneur</a></li>
                  <li><a href="#">Gamer</a></li>
                  <li><a href="#">Productivity</a></li>
                </ul>
              </li>
              <li><a href="#">Free Stuff</a></li>
              <li><a href="#">Signup</a></li>
              <li><a href="#">Login</a></li>
            </ul> 
          </nav>
      </div>