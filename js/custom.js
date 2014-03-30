$(function () {
    function sliderFunction() {
        $('.banner').unslider({
            speed: 500,
            delay: 3000,
            keys: true,
            dots: true,
            fluid: false
        });
 
    }

    sliderFunction();
});