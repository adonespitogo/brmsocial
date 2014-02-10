<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
      <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" ui-sref="vendor">
            <span class="glyphicon glyphicon-home"></span>
            Dashboard
          </a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav">
            <li><a ui-sref="products">Products</a></li>
            <li><a ui-sref="sales">Sales</a></li>
            <li><a ui-sref="traffics">Traffics</a></li>
            <li><a ui-sref="orders">orders</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li class="dropdown">
              <a class="dropdown-toggle" data-toggle="dropdown"> Settings <span class="glyphicon glyphicon-cog"></span></b></a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="#">My Account</a></li>
                <li><a href="{{URL::to('session/logout')}}">Logout</a></li>
              </ul>
            </li>
          </ul>
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
    </nav>
    <div style="height: 60px"></div>