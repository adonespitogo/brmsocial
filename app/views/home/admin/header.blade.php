<div class="navbar">
  <div class="container">
    <div class="navbar-header">
      <!-- toggle -->
      <button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".bs-navbar-collapse">
      <span class="sr-only">Toggle navigation</span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      </button>
      <!-- end toggle -->
      <a ui-sref="home" class="navbar-brand">
        <span class="glyphicon glyphicon-home"></span> Dashboard
      </a>
    </div>
    <!-- start nav -->
    <nav class="collapse navbar-collapse bs-navbar-collapse" role="navigation">
      <ul class="nav navbar-nav">
        <li>
          <a ui-sref="products">Products</a>          
        </li>
        <li>
          <a ui-sref="categories">Categories</a>
        </li>
      </ul>
      <ul class="nav navbar navbar-right">
  
        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown">
            <span class="glyphicon glyphicon-user"></span>
            @{{currentUser.fullname}}
            <span class="caret"></span>
          </a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="#">My Account</a></li>
            <li><a href="#">Logout</a></li>
          </ul>
        </li>
  
    </ul>
    </nav>
    <!-- end nav -->
  </div>
</div>