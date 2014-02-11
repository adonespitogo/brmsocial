<nav class="navbar navbar-default navbar-fixed-top padd-right-10" role="navigation">
      <div>
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" ui-sref="vendor" ng-click="navsOff()">
            <span class="glyphicon glyphicon-home"></span>
            Dashboard
          </a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav">
            <li ng-repeat="nav in navs" ng-class="{'active':nav.active}">
              <a ui-sref="@{{nav.state}}" ng-click="activateNav(nav)">
                @{{nav.text}}
              </a>
            </li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li class="dropdown">
              <a class="dropdown-toggle" data-toggle="dropdown"> @{{currentUser.firstname}} @{{currentUser.lastname}} <span class="glyphicon glyphicon-cog"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li><a ng-click="copyCurrentUser()" href="#account-settings" data-toggle="modal">My Account</a></li>
                <li><a href="{{URL::to('session/logout')}}">Logout</a></li>
              </ul>
            </li>
          </ul>
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
    </nav>
    <div style="height: 60px"></div>


<div class="modal fade" id="account-settings">
  <div class="modal-dialog">
    <form class="modal-content" novalidate ng-submit="updateCurrentUser()" name="accountForm">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Account Settings</h4>
      </div>
      <div class="modal-body">
        <div class="form-horizontal">
          <div class="form-group">
            <div class="col-md-4">
              <label class="control-label pull-right">Email:</label>
            </div>
            <div class="col-md-8">
              <input required type="email" name='email' ng-model="tmpUser.email" class="form-control">
              <span class="text-danger" ng-show="accountForm.email.$error.email">Please use a valid email.</span>
              <span class="text-danger" ng-show="accountForm.email.$error.required">Please fill out this field.</span>
            </div>
          </div>
          <div class="form-group">
            <div class="col-md-4">
              <label class="control-label pull-right">Current Password:</label>
            </div>
            <div class="col-md-8">
              <input required type="password" ng-model="tmpUser.current_password" class="form-control" name="current_password">
              <span class="text-danger" ng-show="accountForm.current_password.$error.required">Required.</span>
            </div>
          </div>
          <div class="form-group">
            <div class="col-md-4">
              <label class="control-label pull-right">New Password:</label>
            </div>
            <div class="col-md-8">
              <input required ng-minlength="6" type="password" ng-model="tmpUser.new_password" class="form-control" name="new_password">
              <span class="text-danger" ng-show="accountForm.new_password.$error.required">Required.</span>
              <span class="text-danger" ng-show="accountForm.new_password.$error.minlength">Minimum of 6 characters.</span>
            </div>
          </div>
          <div class="form-group">
            <div class="col-md-4">
              <label required min="6" class="control-label pull-right">Confirm New Password:</label>
            </div>
            <div class="col-md-8">
              <input required type="password" ng-model="tmpUser.confirm_password" class="form-control">
              <span class="text-danger" ng-show="tmpUser.new_password != tmpUser.confirm_password">Passwords do not match.</span>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary" ng-class="{'disabled':accountForm.$invalid}">Save changes</button>
        <a class="btn btn-default" data-dismiss="modal">Close</a>
      </div>
    </form>
  </div>
</div>
