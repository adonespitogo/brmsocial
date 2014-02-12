var app = angular.module('EvenListeners', []);
  
app.directive('addTerms', function() {
  return {  
    link: function(scope, elm, attrs, ctrl) {
      $(document).on('blur', '.term', function(){
        if($(this).val()&&$(this).val().trim() != ''){
          $('.terms-con').append($(this).parent().clone());
          $('.term:last').val('').focus().attr('ng-model', 'product.terms['+($('.term').length-1)+']')
          scope.product.terms.push($('.term:last').val());
                 
        }else if($('.term').length >1)
          $(this).parent().remove();
      });       
    }
  };
});