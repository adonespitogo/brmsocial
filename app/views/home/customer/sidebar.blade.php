<div class="sidebar">
  <div class="user-avatar">
    <img src="{{ URL::to('customer/images/user-avatar.png') }}">
    <ul>
      <li>Credits: $150</li>
      <li>@{{ currentUser.email }}</li>
      <li>
        <i class="fa fa-star active"></i>
        <i class="fa fa-star active"></i>
        <i class="fa fa-star"></i>
        <i class="fa fa-star"></i>
        <i class="fa fa-star"></i>
      </li>
    </ul>
  </div>
  <div class="menu">
    <ul>
      <li><a href="#"><i class="fa fa-home"></i>Dashboard</a></li>
      <li><a href="#"><i class="fa fa-user"></i>My Profile</a></li>
      <li><a href="#"><i class="fa fa-gear"></i>Account</a></li>
      <li><a href="#"><i class="fa fa-shopping-cart"></i>Purchases</a></li>
      <li><a href="#"><i class="fa fa-envelope"></i>Email Preferences</a></li>
      <li><a href="#"><i class="fa fa-money"></i>Earn Credits</a></li>
    </ul>
  </div>
  <div class="connect">
    <div class="heading">Connect</div>
    <ul>
      <li>
        <a href="#"><img src="{{ URL::to('customer/images/ico-fb.png') }}"></a>
      </li>
      <li>
        <a href="#"><img src="{{ URL::to('customer/images/ico-twit.png') }}"></a>
      </li>
      <li>
        <a href="#"><img src="{{ URL::to('customer/images/ico-gplus.png') }}"></a>
      </li>
      <li>
        <a href="#"><img src="{{ URL::to('customer/images/ico-in.png') }}"></a>
      </li>
      <li>
        <a href="#"><img src="{{ URL::to('customer/images/ico-earth.png') }}"></a>
      </li>
    </ul>
    <div class="member">Member since: <span>JUL 10, 2013</span></div>
  </div>
</div>