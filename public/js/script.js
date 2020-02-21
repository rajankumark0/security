$(function() {
        
    if (plugins.customCarousel.length) {
         for (var i = 0; i < plugins.customCarousel.length; i++) {
             var carousel = initCarousel({
                 node: plugins.customCarousel[i],
                 speed: plugins.customCarousel[i].getAttribute('data-speed'),
                 autoplay: plugins.customCarousel[i].getAttribute('data-autoplay')
             });
         }
     }
     
 });
 
plugins = {           
    customCarousel: document.querySelectorAll('.circle-carousel'),
};