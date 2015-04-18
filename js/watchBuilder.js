/**
 * Created by RasmusKrøyer on 03-04-2015.
 */

WatchBuilder = (function($) {
    //pageInit();


    var builder = {

        el: {},

        init: function() {
            var self = builder;

            self.cacheElements();
            self.bindEvents();
            self.el.step1.hide();
        },

        cacheElements: function(){
            var self = builder;

            self.el.startButton = $('#startButton');
            self.el.intro = $('#splash');
            self.el.step1 = $('#step1');

        },

        bindEvents: function() {
            var self = builder;

            self.el.startButton.on('click', self.removeIntro);

        },

        removeIntro: function(){
            var self = builder;
            self.el.intro.hide();
            self.el.step1.show();
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