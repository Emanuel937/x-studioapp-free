
jQuery(document).ready(function($){

    function hexagonLayout($scope){
        const hexItems = $scope.find('.hex-item');
        hexItems.each(function(index){
            if(index % 2 !== 0){
                $(this).css('marginTop', '30px');
            } else {
                $(this).css('marginTop', '0');
            }
        });
    }

    // Sur chargement classique (hors Elementor)
    $(window).on('load', function(){
        if(typeof elementorFrontend === 'undefined' || !elementorFrontend.hooks){
            hexagonLayout($(document));
        }
    });

    // Avec Elementor Frontend & Editor
    if(typeof elementorFrontend !== 'undefined' && elementorFrontend.hooks){
        elementorFrontend.hooks.addAction('frontend/element_ready/xstudioapp_hexagons.default', function($scope){
            hexagonLayout($scope);
        });
    }
});
