/**
 * Created by RasmusKrøyer on 03-04-2015.
 */

WatchBuilder = (function($) {
    //pageInit();


    var builder = {

        el: {},

        state: {
            case: 'gun metal',
            hands: 'black',
            straps: 'croco black',
            dial: 'bamboo'
        },

        init: function() {
            var self = builder;

            self.cacheElements();
            self.bindEvents();
            self.el.step1.hide();
            self.el.step2.hide();
            $('.watchElement').each(function(){
                var parttype = $(this).data('parttype');
                if( parttype == self.state.case || parttype == self.state.hands ||parttype == self.state.straps || parttype == self.state.dial){
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
            $('.thumbnail').each(function(){
                var parttype = $(this).data('parttype');
                if( parttype == self.state.case || parttype == self.state.hands ||parttype == self.state.straps || parttype == self.state.dial){
                    $(this).addClass('selected');
                }
            });
        },

        cacheElements: function(){
            var self = builder;

            self.el.startButton = $('#startButton');
            self.el.step2Button = $('#step2Button');
            self.el.intro = $('#splash');
            self.el.step1 = $('#step1');
            self.el.step2 = $('#step2');
            self.el.selectCase = $('.selectCaseColor');
            self.el.selectStrap = $('.selectStrap');
            self.el.selectHands = $('.selectHands');
            self.el.selectDial = $('.selectDial');
        },

        bindEvents: function() {
            var self = builder;

            self.el.startButton.on('click', self.removeIntro);
            self.el.step2Button.on('click', self.enterStep2);
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

        enterStep2: function(){
            var self = builder;
            self.el.step1.hide();
            self.el.step2.show();
        },

        bindSelectorEvents: function(container, target){
            var self = builder;
            $(container + ' > .thumbnails > .thumbnail').each(function(index){
                var partType = $(this).data('parttype');
                $(this).on('click', function(e){
                    e.preventDefault();
                    $(container).find('.selected').each(function(){
                        $(this).removeClass('selected');
                    });
                    $(this).addClass('selected');
                    $(target).each(function(index){
                        if($(this).data('parttype') == partType){
                            $(this).show();
                        } else {
                            $(this).hide();
                        }
                    });
                });
                switch (container) {
                    case '.selectCaseColor':
                        self.state.case = partType;
                        break;
                    case '.selectStrap':
                        self.state.straps = partType;
                        break;
                    case '.selectHands':
                        self.state.hands = partType;
                        break;
                    case '.selectDial':
                        self.state.dial = partType;
                        break;
                }

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