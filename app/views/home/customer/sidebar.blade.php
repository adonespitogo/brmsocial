<div class="sidebar">
  <div class="user-avatar">
    <img ng-src="@{{currentUser.pic}}">
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
      <li ng-repeat="nav in navs" ng-class="{'active': nav.active}">
        <a ui-sref="@{{nav.state}}" ng-click="activateNav(nav)">
          <i class="fa @{{nav.icon}}"></i>
          @{{nav.text}}
        </a>
      </li>
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