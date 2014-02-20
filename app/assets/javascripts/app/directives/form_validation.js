var app = angular.module('FormValidation', []);
 
var INTEGER_REGEXP = /^\-?\d+$/;
app.directive('integer', function() {
  return {
    require: 'ngModel',
    link: function(scope, elm, attrs, ctrl) {
      ctrl.$parsers.unshift(function(viewValue) {
        if (INTEGER_REGEXP.test(viewValue)) {
          // it is valid
          ctrl.$setValidity('integer', true);
          return viewValue;
        } else {
          // it is invalid, return undefined (no model update)
          ctrl.$setValidity('integer', false);
          return undefined;
        }
      });
    }
  };
});

app.directive('ensureUnique', ['$http', function($http) {
  return {
    require: 'ngModel',
    link: function(scope, ele, attrs, c) {
      scope.$watch(attrs.ngModel, function() {
        $http({
          method: 'POST',
          url: '/users/is-unique',
          data: {'field': attrs.ensureUnique, value: $(ele).val()}
        }).success(function(data, status, headers, cfg) {
           check2 = scope.oldEmail==$(ele).val().trim(); 
           
           if(check2)
             ds = true;
           else
            ds = data.isUnique;

          c.$setValidity('unique', ds);
        }).error(function(data, status, headers, cfg) {
          c.$setValidity('unique', false);
        });
      });
    }
  }
}]);

app.directive("lessThan", function() {
   return {
      require: "ngModel",
      scope: {
        lessThan: '='
      },
      link: function(scope, element, attrs, ctrl) {
        scope.$watch(function() { 
            console.log(scope.lessThan, ctrl.$viewValue);
            ctrl.$setValidity("lessThan", false);
             return scope.lessThan; 

        }, function(value) {
            if(value){
              console.log('changed');
                 ctrl.$parsers.unshift(function(viewValue) {
                    var origin = scope.lessThan;
                    if (viewValue > origin) {
                        ctrl.$setValidity("lessThan", false);
                        return undefined;
                    } else {
                        ctrl.$setValidity("lessThan", true);
                        return viewValue;
                    }
                });
            } 
        });
     }
   };
});