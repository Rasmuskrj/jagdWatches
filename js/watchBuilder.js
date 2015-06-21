/**
 * Created by RasmusKrøyer on 03-04-2015.
 */

function generateUUID(){
    var d = new Date().getTime();
    var uuid = 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, function(c) {
        var r = (d + Math.random()*16)%16 | 0;
        d = Math.floor(d/16);
        return (c=='x' ? r : (r&0x3|0x8)).toString(16);
    });
    return uuid;
};


WatchBuilder = (function($) {
    //pageInit();


    var builder = {

        el: {},

        variables: {
            noneName: "1None",
            animationSpeed: 1000
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
            lastScreen: 'intro',
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
            lastScreen: 'intro',
            invertPattern: false,
            patternRotation: 0
        },

        init: function() {
            var self = builder;

            self.cacheElements();
            self.bindEvents();
            self.el.step1.hide();
            self.el.step2.hide();
            self.el.customerDetails.hide();
            self.setDefaultValues();
            $(".selectCaseColor img[data-parttype='" + self.state.case + "']").trigger('click');
            $(".selectStrap img[data-parttype='" + self.state.straps + "']").trigger('click');
            $(".selectHands img[data-parttype='" + self.state.hands + "']").trigger('click');
            $(".selectDial img[data-parttype='" + self.state.dial + "']").trigger('click');
            $(".selectIndex img[data-parttype='" + self.state.index + "']").trigger('click');
            console.log("before is " + self.state.pattern);
            $(".selectNumerals img[data-parttype='" + self.state.numerals + "']").trigger('click');
            $(".selectPattern img[data-parttype='" + self.state.pattern + "']").trigger('click');
            var sliderValue = 0;
            if(Cookies.get('patternRotation') != undefined){
                sliderValue = Cookies.get('patternRotation');
            }
            self.el.patternRotationSlider.slider({
                orientation: "horizontal",
                range: "min",
                value: sliderValue,
                max: 359,
                slide: function(event, ui){
                    $('.watchPattern').css("transform", "rotate(" + ui.value + "deg)");
                    self.state.patternRotation = ui.value;
                    Cookies.set('patternRotation', ui.value, {expires: 30, path: '/'});
                }
            });
            self.el.invertButton.button();
            if(Cookies.get('userID') == undefined){
                Cookies.set('userID', generateUUID(), {expires: 30, path: '/'});
            }
            console.log(Cookies.get('userID'));
        },

        cacheElements: function(){
            var self = builder;

            self.el.startButton = $('#startButton');
            self.el.step2Button = $('#step2Button');
            self.el.watchContainer = $('.watchContainer');
            self.el.intro = $('#splash');
            self.el.step1 = $('#step1');
            self.el.step2 = $('#step2');
            self.el.customerDetails = $('#customerDetails');
            self.el.selectCase = $('.selectCaseColor');
            self.el.selectStrap = $('.selectStrap');
            self.el.selectHands = $('.selectHands');
            self.el.selectDial = $('.selectDial');
            self.el.patternRotationSlider = $('.patternRotatorSlider');
            self.el.backButton = $('#backButton');
            self.el.invertButton = $('#invertPattern');
            self.el.buyNowButton = $('.buyNowButton');
            self.el.priceValue = $('.priceValue');
        },

        bindEvents: function() {
            var self = builder;

            self.el.startButton.on('click', self.enterStep1);
            self.el.step2Button.on('click', self.enterStep2);
            self.bindSelectorEvents('.selectCaseColor', '.watchCase');
            self.bindSelectorEvents('.selectStrap', '.watchStrap');
            self.bindSelectorEvents('.selectHands', '.watchHands');
            self.bindSelectorEvents('.selectDial', '.watchDial');
            self.bindSelectorEvents('.selectIndex', '.watchIndex');
            self.bindSelectorEvents('.selectNumerals', '.watchNumerals');
            self.bindSelectorEvents('.selectPattern', '.watchPattern');
            self.el.backButton.on('click', function(){
                if(self.state.lastScreen == 'intro' || self.state.currentScreen == 'step1'){
                    self.enterIntro();
                } else if(self.state.lastScreen == 'step1' || self.state.currentScreen == 'step2'){
                    self.enterStep1();
                } else if(self.state.lastScreen == 'step2'){
                    self.enterStep2();
                } else {
                    //Do Nothing
                }
            });
            self.el.invertButton.on('click', function() {
                if($(this).is(':checked')){
                    self.state.invertPattern = true;
                    Cookies.set('invertPattern', true, {expires: 30, path: '/'});
                    if(self.state.pattern != self.variables.noneName) {
                        $('.thumbnail[data-parttype="' + self.state.pattern + '"]').trigger('click');
                    }
                } else {
                    self.state.invertPattern = false;
                    Cookies.set('invertPattern', false, {expires: 30, path: '/'});
                    if(self.state.pattern != self.variables.noneName) {
                        $('.thumbnail[data-parttype="' + self.state.pattern + '"]').trigger('click');
                    }
                }
            });
            self.el.buyNowButton.on('click', self.enterCustomerDetails)
        },

        enterIntro: function(){
            var self = builder;
            self.el.intro.show(self.variables.animationSpeed);
            self.el.watchContainer.show(self.variables.animationSpeed);
            self.el.step2.hide(self.variables.animationSpeed);
            self.el.step1.hide(self.variables.animationSpeed);
            self.el.customerDetails.hide(self.variables.animationSpeed);
            self.state.lastScreen = self.state.currentScreen;
            self.state.currentScreen = 'intro';
        },

        enterStep1: function(){
            var self = builder;
            self.el.intro.hide(self.variables.animationSpeed);
            self.el.step2.hide(self.variables.animationSpeed);
            self.el.step1.show(self.variables.animationSpeed);
            self.el.watchContainer.show(self.variables.animationSpeed);
            self.el.customerDetails.hide(self.variables.animationSpeed);
            self.state.lastScreen = self.state.currentScreen;
            self.state.currentScreen = 'step1';
            console.log(Cookies.get());
        },

        enterStep2: function(){
            var self = builder;
            self.el.intro.hide(self.variables.animationSpeed);
            self.el.step1.hide(self.variables.animationSpeed);
            self.el.step2.show(self.variables.animationSpeed);
            self.el.watchContainer.show(self.variables.animationSpeed);
            self.el.customerDetails.hide(self.variables.animationSpeed);
            self.state.lastScreen = self.state.currentScreen;
            self.state.currentScreen = 'step2';
        },

        enterCustomerDetails: function() {
            var self = builder;
            self.el.intro.hide(self.variables.animationSpeed);
            self.el.step1.hide(self.variables.animationSpeed);
            self.el.step2.hide(self.variables.animationSpeed);
            self.el.watchContainer.hide(self.variables.animationSpeed);
            self.el.customerDetails.show(self.variables.animationSpeed);
            self.state.lastScreen = self.state.currentScreen;
            self.state.currentScreen = 'CustomerDetails';
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
                            Cookies.set('case', partType, {expires: 30, path: '/'});
                            break;
                        case '.selectStrap':
                            self.state.straps = partType;
                            Cookies.set('straps', partType, {expires: 30, path: '/'});
                            break;
                        case '.selectHands':
                            self.state.hands = partType;
                            Cookies.set('hands', partType, {expires: 30, path: '/'});
                            break;
                        case '.selectDial':
                            self.state.dial = partType;
                            Cookies.set('dial', partType, {expires: 30, path: '/'});
                            break;
                        case '.selectIndex':
                            self.state.index = partType;
                            Cookies.set('index', partType, {expires: 30, path: '/'});
                            break;
                        case '.selectNumerals':
                            self.state.numerals = partType;
                            Cookies.set('numerals', partType, {expires: 30, path: '/'});
                            break;
                        case '.selectPattern':
                            self.state.pattern = partType;
                            console.log("select Pattern Called. case " + container);
                            Cookies.set('pattern', partType, {expires: 30, path: '/'});
                            break;
                        default:
                            console.log("Error: State not changed");
                    }
                    if(self.state.pattern == self.variables.noneName && self.state.numerals == self.variables.noneName && self.state.index == self.variables.noneName) {
                        self.el.priceValue.text(pricePlainOneStrap);
                    } else {
                        self.el.priceValue.text(priceEngravedOneStrap);
                    }
                });

            });
        },

        setDefaultValues: function() {
            var self = builder;
            if(Cookies.get('userID') == undefined){
                self.state = self.defaultValues;
            } else {
                self.state.case = Cookies.get('case');
                self.state.straps = Cookies.get('straps');
                self.state.hands = Cookies.get('hands');
                self.state.dial = Cookies.get('dial');
                self.state.index = Cookies.get('index');
                self.state.numerals = Cookies.get('numerals');
                self.state.pattern = Cookies.get('pattern');
                console.log("pattern set to " + self.state.pattern);
                if(Cookies.get('patternRotation') != undefined) {
                    $('.watchPattern').css("transform", "rotate(" + Cookies.get('patternRotation') + "deg)");
                }
                if(Cookies.get('invertPattern') != undefined) {
                    var val = Cookies.get('invertPattern') == 'true';
                    self.el.invertButton.prop('checked', val);
                    self.state.invertPattern = val;
                }
            }

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