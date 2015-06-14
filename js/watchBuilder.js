/**
 * Created by RasmusKrøyer on 03-04-2015.
 */


WatchBuilder = (function($) {
    //pageInit();


    var builder = {

        el: {},

        variables: {
            noneName: "1None"
        },

        defaultValues: {
            case: 'Gun metal',
            hands: 'Black',
            straps: 'Croco black',
            dial: 'Bamboo2',
            index: '1None',
            numerals: '1None',
            pattern: '1None',
            currentScreen: 'intro',
            invertPattern: false,
            patternRotation: 0
        },

        state: {
            case: 'Gun metal',
            hands: 'black',
            straps: 'croco black',
            dial: 'bamboo',
            index: '1None',
            numerals: '1None',
            pattern: '1None',
            currentScreen: 'intro',
            invertPattern: false,
            patternRotation: 0
        },

        init: function() {
            var self = builder;

            self.cacheElements();
            self.bindEvents();
            self.el.step1.hide();
            self.el.step2.hide();
            self.setDefaultValues();
            $('.selectCaseColor').each(function(){
                $("img[data-parttype='" + self.state.case + "']").trigger('click');
            });
            $('.selectStrap').each(function(){
                $("img[data-parttype='" + self.state.straps + "']").trigger('click');
            });
            $('.selectHands').each(function(){
                $("img[data-parttype='" + self.state.hands + "']").trigger('click');
            });
            $('.selectDial').each(function(){
                $("img[data-parttype='" + self.state.dial + "']").trigger('click');
            });
            $('.selectIndex').each(function(){
                $("img[data-parttype='" + self.state.index + "']").trigger('click');
            });
            $('.selectNumerals').each(function(){
                $("img[data-parttype='" + self.state.numerals + "']").trigger('click');
            });
            $('.selectPattern').each(function(){
                $("img[data-parttype='" + self.state.pattern + "']").trigger('click');
            });
            self.el.patternRotationSlider.slider({
                orientation: "horizontal",
                range: "min",
                max: 359,
                slide: function(event, ui){
                    $('.watchPattern').css("transform", "rotate(" + ui.value + "deg)");
                    self.state.patternRotation = ui.value;
                }
            });
            self.el.invertButton.button();
            /*$('.watchElement').each(function(){
                var parttype = $(this).data('parttype');
                if( parttype == self.state.case || parttype == self.state.hands ||parttype == self.state.straps || parttype == self.state.dial){
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
            $('.thumbnail').each(function(){
                var parttype = $(this).data('parttype');
                if( parttype == self.state.case || parttype == self.state.hands ||parttype == self.state.straps || parttype == self.state.dial || parttype == self.state.index || parttype == self.state.numerals || parttype == self.state.pattern){
                    $(this).addClass('selected');
                }
            });*/
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
            self.el.patternRotationSlider = $('.patternRotatorSlider');
            self.el.backButton = $('#backButton');
            self.el.invertButton = $('#invertPattern');
        },

        bindEvents: function() {
            var self = builder;

            self.el.startButton.on('click', self.removeIntro);
            self.el.step2Button.on('click', self.enterStep2);
            self.bindSelectorEvents('.selectCaseColor', '.watchCase');
            self.bindSelectorEvents('.selectStrap', '.watchStrap');
            self.bindSelectorEvents('.selectHands', '.watchHands');
            self.bindSelectorEvents('.selectDial', '.watchDial');
            self.bindSelectorEvents('.selectIndex', '.watchIndex');
            self.bindSelectorEvents('.selectNumerals', '.watchNumerals');
            self.bindSelectorEvents('.selectPattern', '.watchPattern');
            self.el.backButton.on('click', function(){
                if(self.state.currentScreen == 'step2'){
                    self.state.currentScreen = 'step1';
                    self.el.step1.show();
                    self.el.step2.hide();
                    self.el.intro.hide();
                } else if(self.state.currentScreen == 'step1'){
                    self.state.currentScreen = 'intro';
                    self.el.step1.hide();
                    self.el.step2.hide();
                    self.el.intro.show();
                } else {
                    //Do nothing
                }
            });
            self.el.invertButton.on('click', function() {
                if($(this).is(':checked')){
                    self.state.invertPattern = true;
                    if(self.state.pattern != self.variables.noneName) {
                        $('.thumbnail[data-parttype="' + self.state.pattern + '"]').trigger('click');
                    }
                } else {
                    self.state.invertPattern = false;
                    if(self.state.pattern != self.variables.noneName) {
                        $('.thumbnail[data-parttype="' + self.state.pattern + '"]').trigger('click');
                    }
                }
            });
        },

        removeIntro: function(){
            var self = builder;
            self.el.intro.hide();
            self.el.step2.hide();
            self.el.step1.show();
            self.state.currentScreen = 'step1';
        },

        enterStep2: function(){
            var self = builder;
            self.el.intro.hide();
            self.el.step1.hide();
            self.el.step2.show();
            self.state.currentScreen = 'step2';
        },

        bindSelectorEvents: function(container, target){
            var self = builder;
            $(container + ' > .thumbnails > .thumbnailContainer > .thumbnailInnerContainer > .thumbnail').each(function(index){
                var partType = $(this).data('parttype');
                $(this).on('click', function(e){
                    e.preventDefault();
                    $(container).find('.selected').each(function(){
                        $(this).removeClass('selected');
                    });
                    $(container + ' > .selectorHeader > .partDescription').text(partType);
                    $(this).parent().addClass('selected');
                    //$(this).addClass('selected');
                    $(target).each(function(index){
                        if($(this).data('parttype') == partType && !(self.state.invertPattern && target == '.watchPattern') || self.state.invertPattern && $(this).data('parttype') == partType + " INV"){
                            $(this).show();
                        } else {
                            $(this).hide();
                        }
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
                        case '.selectIndex':
                            self.state.index = partType;
                            break;
                        case '.selectNumerals':
                            self.state.numerals = partType;
                            break;
                        case '.selectPattern':
                            self.state.pattern = partType;
                            break;
                        default:
                            console.log("Error: State not changed");
                    }
                });

            });
        },

        setDefaultValues: function() {
            var self = builder;
            self.state = self.defaultValues;
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