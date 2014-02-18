var app = angular.module('EvenListeners', []);
app.directive('addTerms', function() {
    return {
        link: function(scope, elm, attrs, ctrl) {
            $(document).on('blur', '.term', function() {
                scope.product.terms.push('');
                if ($(this).val() && $(this).val().trim() != '') {
                    $('.terms-con').append($(this).parent().clone());
                    $('.term:last').val('').focus();
                } else if ($('.term').length > 1) $(this).parent().remove();
            });
        }
    };
});
app.directive('isFeatured', function() {
    return {
        link: function(scope, iElement, iAttrs) {  
            $(iElement).change(function() {
                if ($(this).is(':checked')) $('#feature_dates').show();
                else $('#feature_dates').hide();
            });
        }
    };
});