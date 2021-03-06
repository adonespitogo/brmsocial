@extends('public.template.base')
@section('head')
@parent
<title>Products</title>
<base href="{{URL::to('/')}}" />
@stop

@section('content')  

<!-- FB SDK-->
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=641816635878156";
  fjs.parentNode.insertBefore(js, fjs);
 
}(document, 'script', 'facebook-jssdk'));</script>
<!-- END FB SDK-->

<!-- TWITTER-->
<script>
    window.twttr = (function (d,s,id) {
      var t, js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return; js=d.createElement(s); js.id=id;
      js.src="https://platform.twitter.com/widgets.js"; fjs.parentNode.insertBefore(js, fjs);
      return window.twttr || (t = { _e: [], ready: function(f){ t._e.push(f) } });
    }(document, "script", "twitter-wjs"));
</script>
<!-- END TWITTER-->

<div id="wrap">                                   
    <!--script>
        // $('#myTab a[href="#overview"]').tab('show')
    </script-->
    <section class="sp2-ordinary-page-title two-lines text-center">
        <h1 class="fs-36">{{$product->product_name}}</h1>
        <h2 class="fs-24">{{$product->tagline}}</h2>
        @if(!Auth::user())
        <div class="social-header">
            <ul>
                <li><a href="{{URL::to('signup/facebook')}}" class="fb"><i class="fa fa-facebook"></i><span>sign up with facebook</span></a></li>
                <li><span>or</span></li>
                <li><a href="{{URL::to('signup/twitter')}}" class="twit"><i class="fa fa-twitter"></i><span>sign up with twitter</span></a></li>
            </ul>       
        </div>
        <div class="via-email"><a href="{{URL::to('signup ')}}" style="color:white; text-decoration:none !important">Sign up via E-Mail</a></div>
        @endif
    </section>
    <section class="deal-page bg-image-white" product-id="{{$product->id}}">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="left-col">
                        <!-- Start Featured Deal -->
                        <div class="banner-deal-page">
                            @if(isset($product->pictures[0]))
                            <img src='{{URL::to($product->pictures[0]->picture->url())}}' alt="featured deal" title="featured deal">
                            @endif
                        </div>
                        <!-- End Featured Deal -->
                    </div>
                    <div class="product-tabs">
                        <ul class="nav nav-tabs" id="myTab">
                            <li><a href="#overview" data-toggle="tab">Overview</a></li>
                            <li><a href="#comments" data-toggle="comments">Comments</a></li>
                        </ul>
                        <div class="left-col tab-content">
                            <!-- Start of Overview and Comments -->
                            <div id="overview" class="tab-pane fade active in">
                                {{$product->overview}}
                            </div>
                            <div id="comments" style="margin-top: 39px;">
                                <div id="disqus_thread"></div>
                                <script type="text/javascript">
                                    var disqus_shortname = 'brmsocial';
                                    /* * * DON'T EDIT BELOW THIS LINE * * */
                                    (function() {
                                        var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
                                        dsq.src = '//' + disqus_shortname + '.disqus.com/embed.js';
                                        (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
                                    })();
                                </script>
                                <noscript>Please enable JavaScript to view the <a href="http://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
                                <a href="http://disqus.com" class="dsq-brlink">comments powered by <span class="logo-disqus">Disqus</span></a>
                            </div>
                            <!-- End of Overview and Comments -->
                        </div>
                    </div>
                    <div class="left-col">
                        <h3>Customers also bought</h3>
                        <!-- Start Customers also bought -->
                        <div class="row deal-popular">

                            @foreach(Product::orderBy('created_at', 'DESC')->limit(3)->get() as $p)
                                <div class="col-md-4 col-sm-4">
                                    @if(isset($p->pictures[0]))

                                        <a href="{{URL::to('product/'.$p->slug)}}">
                                            <img src='{{URL::to($p->pictures[0]->picture->url("medium"))}}' alt="most popular service" title="most popular service">
                                        </a>

                                    @endif
                                    
                                    <h4>
                                    <a href="{{URL::to('product/'.$p->slug)}}">
                                    
                                    {{$p->product_name}}
                                    
                                    @if($p->discounted_price > 0)
                                        <span>${{number_format($p->discounted_price, 2)}}</span>
                                    @else
                                        <span class="free">$0.00</span>
                                    @endif
                                     
                                    </a></h4>
                                    <ul>
                                        <li>{{$p->getLeftSaleDays()}} days</li>
                                        <li><a href="{{URL::to('products/category/'.$p->category->slug)}}">{{$p->category->category}}</a></li>
                                    </ul>
                                </div>
                            @endforeach

                        </div>
                        <div class="row deal-popular">

                            @foreach(Product::orderBy('created_at', 'DESC')->skip(3)->take(3)->get() as $p)
                                <div class="col-md-4 col-sm-4">
                                    @if(isset($p->pictures[0]))

                                        <a href="{{URL::to('product/'.$p->slug)}}">
                                            <img src='{{URL::to($p->pictures[0]->picture->url("medium"))}}' alt="most popular service" title="most popular service">
                                        </a>

                                    @endif
                                    
                                    <h4>
                                    <a href="{{URL::to('product/'.$p->slug)}}">
                                    
                                    {{$p->product_name}}
                                    
                                    @if($p->discounted_price > 0)
                                        <span>${{number_format($p->discounted_price, 2)}}</span>
                                    @else
                                        <span class="free">$0.00</span>
                                    @endif
                                     
                                    </a></h4>
                                    <ul>
                                        <li>{{$p->getLeftSaleDays()}} days</li>
                                        <li><a href="{{URL::to('products/category/'.$p->category->slug)}}">{{$p->category->category}}</a></li>
                                    </ul>
                                </div>
                            @endforeach

                        </div>
                        <!-- End Customers also bought -->
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="right-col">
                        <div class="product-right-col clearfix"> 
                            @if($product->discounted_price > 0)
                                <span class="save">save {{$product->getDiscountPercentage()}}%</span>
                            @else
                                <span class="save">100% off</span>
                            @endif
 
                            <div class="featured-price">
                                <ul>
                                    @if($product->discounted_price > 0)
                                        <li>now only</li>
                                        <li>${{(int)$product->discounted_price}}<span>.00</span></li>
                                    @else
                                        <li></li>
                                        <li>$0<span>.00</span></li>
                                    @endif
                                </ul>
                            </div>
                            <div class="reg-price text-right">
                                <span>${{(int)$product->regular_price}}</span><br />
                                regular price
                                <h2></h2>
                            </div>
                            <h4 class="clearfix" style="clear:both">{{ is_object($product->user->vendorInfo) ? $product->user->vendorInfo->company_name : $product->user->firstname . ' ' . $product->user->lastname }}</h4>
                            <div class="progress">
                                <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="{{$product->getEndDatePercentage()}}" aria-valuemin="0" aria-valuemax="100" style="width: {{$product->getEndDatePercentage()}}%">
                                    <span class="sr-only">
                                    {{$product->getEndDatePercentage()}}% Complete (success)
                                    </span>
                                </div>
                            </div>
                            <ul class="clearfix">
                                <li class="pull-left fs-10">Started
                                    {{date("M d", strtotime($product->sale_start_date))}}
                                </li>
                                <li class="pull-right fs-10">Ends
                                    {{date("M d", strtotime($product->sale_end_date))}}
                                </li>
                            </ul>
                            
                            @if(!$orderExist)
                                @if($product->discounted_price>0)
                                    <h3 class="text-center first-h3">
                                    <i class="fa fa-time"></i>
                                    @if($product->getLeftSaleDays() > 0)
                                    Sale ends in <span>{{$product->getLeftSaleDays()}} days</span>
                                    @else
                                    Sale ends <span>today</span>
                                    @endif
                                    </h3>
                                    <button class="btn-green add2cart-btn"
                                    data-product-id="{{$product->id}}"
                                    data-product-price="{{$product->discounted_price}}"
                                    data-product-name="{{$product->product_name}}"
                                    data-product-description=""
                                    >
                                    BUY NOW
                                    </button>     
                                @else 
                                    <div class="fb-steps">
                                        <h3 class="text-center first-h3">
                                            <i class="fa fa-time"></i>Free offer ends in <span>5 days</span>
                                        </h3>
                                        <ul>
                                            <li id="free_step1"
                                                @if(Session::has('free_step_1') && in_array($product->id,Session::get('free_step_1')))
                                                    {{'class="active"'}}                                            
                                                @endif
                                            >
                                                <i class="fa fa-check-circle pull-right"></i>
                                                <div><strong>Step 1:</strong> Connect with us</div>
                                                 
                                                 <div class="fb-like" data-href="http://brmsocial.com/" data-layout="button" data-action="like" data-show-faces="false" data-share="false"></div>

                                                 <span>&nbsp;or&nbsp;</span>
                                                
                                                 <div 
                                                    class="g-plusone"
                                                    data-size="tall"
                                                    data-annotation='none' 
                                                    data-callback="gplus_callback" 
                                                    data-count="false" 
                                                    data-expandTo="right" 
                                                    data-href="https://plus.google.com/u/0/+ArnelLenteria"
                                                    data-lang="en-US"
                                                    data-parsetags="onload"
                                                    data-align="right"
                                                    data-recommendations="false"
                                                >
                                                </div>

                                                <span>&nbsp;or&nbsp;</span>

                                                <a href="https://twitter.com/revalderc" class="twitter-follow-button" data-show-count="false" data-lang="en" data-show-screen-name="false">Follow</a>                                            

                                                <p>Having trouble?<br />Try repeating step one.</p>
                                            </li>
                                            <li id="free_step2"
                                                @if(Session::has('free_step_2') && in_array($product->id,Session::get('free_step_2')))
                                                    {{'class="active"'}}                                            
                                                @endif
                                            >
                                                <i class="fa fa-check-circle"></i>
                                                <div><strong>Step 2:</strong> Spread the word</div>

                                                <div class="fb-share-button" data-href="{{Request::url()}}" data-type="button"></div>
                                                <span>&nbsp;or&nbsp;</span>
                                                <div 
                                                    class="g-plus" data-action="share" 
                                                    data-size="tall"
                                                    data-annotation='none'  
                                                    data-count="false" 
                                                    data-expandTo="right" 
                                                    data-href="{{Request::url()}}"
                                                    data-lang="en-US"
                                                    data-parsetags="onload"
                                                    data-align="right"
                                                    data-recommendations="false"
                                                    data-onendinteraction="gplus_callback_share"
                                                >
                                                </div>
                                                <span>&nbsp;or&nbsp;</span>

                                                <a href="https://twitter.com/share" data-url="{{Request::url()}}" class="twitter-share-button" data-lang="en">Tweet</a>

                                            </li>
                                        </ul>
                                        <button id="get_free" onclick="window.location.href='{{URL::to('get-free/'.$product->id)}}'"
                                            @if(Session::has('free_step_1') &&Session::has('free_step_2') && in_array($product->id,Session::get('free_step_1')) && in_array($product->id,Session::get('free_step_2')))
                                                {{'class="btn-green"'}} 
                                                >
                                                STEPS COMPLETED, GET IT NOW                                 
                                            @else
                                                {{'disabled="disabled"'}}
                                                {{'class="btn-disabled"'}}
                                                >
                                                 COMPLETE THE STEPS ABOVE TO GET IT 
                                            @endif
                                            
                                        </button>
                                    </div>
                                @endif

                            @else 
                                <br>
                                <button onclick="window.location.href='{{URL::to('/home#/purchases')}}'" class="btn btn-green" >VIEW YOUR ORDER</button>
                            @endif
                                                        
                            <div class="terms-of-sale">
                                <h4>Terms of Sale</h4>
                                <ul class="fa-ul">
                                    @foreach($product->terms as $index=>$t)
                                    <li><i class="fa-li fa fa-star-o"></i>{{$t->term}}</li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="question-box">
                                <p class="lead"><span>Questions?</span> We'd love to help!<i class="fa fa-umbrella fa-lg"></i></p>
                                <small>Email or chat M-F, 9am-5pm PST;</small>
                                <small><a href="#">support@buyrealmarketing.com</a></small>
                            </div>
                        </div>
                        <!-- Start Realated Sales -->
                        @include('public.shared.related_sales')
                        <!-- End Realated Sales -->
                        <!-- Start Upcoming Sales -->
                        @include('public.shared.upcoming_sales')
                        <!-- End Upcoming Sales -->
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@stop
@section('scripts')
@parent
{{HTML::script("website/js/add-order.js")}}
{{HTML::script("website/js/application.js")}}
<script type="text/javascript">
    /* * * CONFIGURATION VARIABLES: EDIT BEFORE PASTING INTO YOUR WEBPAGE * * */
    var disqus_shortname = 'brmsocial'; // required: replace example with your forum shortname
    /* * * DON'T EDIT BELOW THIS LINE * * */
    (function () {
        var s = document.createElement('script'); s.async = true;
        s.type = 'text/javascript';
        s.src = '//' + disqus_shortname + '.disqus.com/count.js';
        (document.getElementsByTagName('HEAD')[0] || document.getElementsByTagName('BODY')[0]).appendChild(s);
    }());
</script>

<script type="text/javascript" src="https://apis.google.com/js/plusone.js"></script>

@stop