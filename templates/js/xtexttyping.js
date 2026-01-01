jQuery(document).ready(function($){

    function typingEffect($scope){
        const elements = $scope.find('.typing-container');

        elements.each(function(){
            const el = this;
            const text = el.dataset.text || " ";
            const speed = parseInt(el.dataset.speed) || 100;
            const delayAfter = parseInt(el.dataset.delay) || 1500;
            const deleteSpeed = parseInt(el.dataset.deleteSpeed) || 50;

            let i = 0;
            let typing = true;

            function typeLoop(){
                if (!el) return;

                if (typing) {
                    if (i < text.length) {
                        el.textContent += text[i];
                        i++;
                        setTimeout(typeLoop, speed);
                    } else {
                        typing = false;
                        setTimeout(typeLoop, delayAfter);
                    }
                } else {
                    if (i > 0) {
                        el.textContent = text.substring(0, i - 1);
                        i--;
                        setTimeout(typeLoop, deleteSpeed);
                    } else {
                        typing = true;
                        setTimeout(typeLoop, speed);
                    }
                }
            }

            if(text.length > 0){
                el.textContent = "";
                typeLoop();
            }
        });
    }

    // Lors du chargement de la page
    $(window).on('load', function(){
       if(typeof elementorFrontend !== 'undefined' && elementorFrontend.hooks) return;
        typingEffect($(document));
    });

    // Pour Elementor frontend & editor
    if (typeof elementorFrontend !== 'undefined' && elementorFrontend.hooks) {
        console.log('start');
      //  elementorFrontend.hooks.addAction('frontend/element_ready', function($scope){
         //   typingEffect($scope);
        //});

       // elementorFrontend.hooks.addAction('frontend/element_ready/global', function($scope){
         //   typingEffect($scope);
        //});

        elementorFrontend.hooks.addAction('frontend/element_ready/x-studioApp-typing.default', function($scope){
            typingEffect($scope);
        });
    }

});
