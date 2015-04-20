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
            self.el.selectCase = $('.selectCaseColor');
            self.el.selectStrap = $('.selectStrap');
            self.el.selectHands = $('.selectHands');
            self.el.selectDial = $('.selectDial');
        },

        bindEvents: function() {
            var self = builder;

            self.el.startButton.on('click', self.removeIntro);
            self.bindSelectorEvents('.selectCaseColor', '.watchCase');
            self.bindSelectorEvents('.selectStrap', '.watchStrap');
            self.bindSelectorEvents('.selectHands', '.watchHands');
            self.bindSelectorEvents('.selectDial', '.watchDial');
        },

        removeIntro: function(){
            var self = builder;
            self.el.intro.hide();
            self.el.step1.show();
        },

        bindSelectorEvents: function(container, target){
            $(container + ' > .thumbnails > .thumbnail').each(function(index){
                var partType = $(this).data('parttype');
                $(this).on('click', function(e){
                    e.preventDefault();
                    $(target).each(function(index){
                        if($(this).data('parttype') == partType){
                            $(this).show();
                        } else {
                            $(this).hide();
                        }
                    });
                });

            });
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