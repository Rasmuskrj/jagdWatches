/**
 * Created by RasmusKrøyer on 03-04-2015.
 */

WatchBuilder = (function($) {
    pageInit();


    var builder = {

        el: {},

        init: function() {
            var self = builder;

            self.cacheElements();
            self.bindEvents();
        },

        cacheElements: function(){
            var self = builder;

            self.el.startButton = $('#startButton');
            self.el.intro = $('#splash');

        },

        bindEvents: function() {
            var self = builder;

            self.el.startButton.on('click', self.removeIntro);

        },

        removeIntro: function(){
            var self = builder;
            console.log("clicked");

            self.el.intro.hide();
        }
    };

    return {
        init: function(){
            builder.init();
        }
    };

})(jQuery);

$(function(){
    WatchBuilder.init();
});