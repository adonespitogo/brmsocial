<div class="right-col">
  <div class="questions">
    <i class="fa fa-umbrella pull-right"></i>
    <span class="heading"><strong>Questions?</strong> We’d love to help!</span><br />
    Email or chat M-F,  9am-5pm PST;<br />                
    <a href="mailto:support@buyrealmarketing.com">support@buyrealmarketing.com</a>                
  </div>
  <h3>Check some of our best seller services</h3>

  <!-- Start Best Sellers -->
  <div class="best-sellers">
    <ul>
      <li ng-repeat="best_seller_product in best_seller_products">
        <img src="@{{ best_seller_product.picture }}" style="width: 90px;" alt="related deals" title="related deals">
        <div><a href="product/@{{ best_seller_product.slug }}">@{{ best_seller_product.product_name }}</a></div>
        <div class="price">$@{{ best_seller_product.discounted_price }}</div>
        <ul>
          <li>4 days</li>
          <li><a href="category/@{{best_seller_product.category.slug}}">@{{ best_seller_product.category.category }}</a></li>
        </ul>
      </li>

    </ul>
  </div>
  <!-- End Best Sellers -->

  <div class="refer-friend">
    <form role="form">
      <div class="form-group">
        <input type="email" class="form-control border-radius-0" placeholder="Email Address">
      </div>
      <button type="submit" class="btn btn-green btn-default">REFER YOUR FRIENDS , GET $10</button>
    </form>
  </div>
  <div class="social-right">
    <ul>
      <li>
        <a href="javascript:void(0)" class="fb-btn"><img src="{{ URL::to('customer/images/ico-fb.png') }}"> Share on facebook</a>
      </li>
      <li>
        <a href="https://twitter.com/share?url=http%3A%2F%2Fwww.brmsocial.com%3Freferralid%3D{{ Auth::user()->id }}&text=Check+out+BRMSocial%2C+a+cool+new+deals+site+for+online+marketing+apps%2C+tools+and+training+courses."><img src="{{ URL::to('customer/images/ico-twit.png') }}"> Tweet on Facebook</a>
      </li>
    </ul>
  </div>
</div>

<div id="fb-root"></div>
<script>
  // window.fbAsyncInit = function() {
  // FB.init({
  //   appId      : '641816635878156',
  //   status     : true,
  //   xfbml      : true
  // });
  // };

  // (function(d, s, id){
  //  var js, fjs = d.getElementsByTagName(s)[0];
  //  if (d.getElementById(id)) {return;}
  //  js = d.createElement(s); js.id = id;
  //  js.src = "//connect.facebook.net/en_US/all.js";
  //  fjs.parentNode.insertBefore(js, fjs);
  //  }(document, 'script', 'facebook-jssdk'));
</script>

<script type="text/javascript">
// $(document).ready(function() {
//   $('.fb-btn').click(function() {
//     alert('aw');
//     FB.ui({
//       method: 'feed',
//       name: 'Check out BRM Social, a cool new deals site for online marketers',
//       link: 'http://www.brmsocial.com?referralid={{ Auth::user()->id }}',
//       picture: 'http://brmsocial.com/images/brmsocial-icon.png',
//       caption: 'Get $10 just for signing up for the launch',
//     description: ' '
//     }, function(response){});

//   });
// });
</script>
