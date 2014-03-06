<div class="sidebar">
  <div class="user-avatar">
    <img ng-src="@{{currentUser.pic}}">
    <ul>
      <li ng-cloak class="ng-cloak">Credits: $@{{currentUser.credits}}</li>
      <li ng-cloak class="ng-cloak">@{{ currentUser.email }}</li>
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
      <li ng-repeat="nav in navs" ui-sref-active='active'>
        <a ui-sref="@{{nav.state}}">
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
        <a href="https://www.facebook.com/brmsocial"><img src="{{ URL::to('customer/images/ico-fb.png') }}"></a>
      </li>
      <li>
        <a href="#"><img src="{{ URL::to('customer/images/ico-twit.png') }}"></a>
      </li>
      <li>
        <a href="https://plus.google.com/101263621102960725030/posts"><img src="{{ URL::to('customer/images/ico-gplus.png') }}"></a>
      </li>
      <li>
        <a href="#"><img src="{{ URL::to('customer/images/ico-in.png') }}"></a>
      </li>
      <li>
        <a href="#"><img src="{{ URL::to('customer/images/ico-earth.png') }}"></a>
      </li>
    </ul>
    <div class="member">Member since:
      <span >{{ Carbon\Carbon::parse(Auth::user()->created_at)->toFormattedDateString(); }}</span>
    </div>
  </div>
</div>