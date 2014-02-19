var app = angular.module('EvenListeners', []);

app.directive('addTerms', function() {
    return {
        link: function(scope, elm, attrs, ctrl) {
            $(document).on('blur', '.term', function() {
                if ($(this).val() && $(this).val().trim() != '') {
                    $('.terms-con').append($(this).parent().clone()); 
                    $('.term:last').val('').focus();
                } else if ($('.term').length > 1) {
                    $(this).parent().remove();
                }
                scope.product.terms = '';
                $.each($('.term'), function(i, d) {
                    if ($(this).val() && $(this).val().trim() != '') scope.product.terms += $(this).val() + ',';
                });
                 return;
            }); 
             return;
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