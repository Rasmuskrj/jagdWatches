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
}


WatchBuilder = (function($) {
    //pageInit();


    var builder = {

        el: {},

        variables: {
            noneName: "None",
            animationType: "fade",
            animationSpeed: 500,
            checkoutURL: 'checkout.php',
            possibleStrapAmount: 5,
            outlineName: "Outline",
            introDelay: 2500,
            introChangeInterval: 1250,
            introNoOfChanges: 3
        },

        state: {
            case: 'Outline',
            hands: 'Black',
            straps: 'Outline',
            dial: 'White',
            index: 'None',
            numerals: 'None',
            marker: 'None',
            pattern: 'None',
            currentScreen: 'intro',
            lastScreen: 'intro',
            invertPattern: false,
            patternRotation: 0,
            noOfAdditionalStraps: 0,
            additionalStrap1: "None",
            additionalStrap2: "None",
            additionalStrap3: "None",
            additionalStrap4: "None",
            additionalStrap5: "None",
            validPromotionCodeAdded: false,
            totalPrice: 0,
            addedPromotionCode: ''
        },

        partLists: {},

        init: function() {
            var self = builder;

            self.state.totalPrice = shippingCost + pricePlainOneStrap;
            self.state.totalPrice = shippingCost + pricePlainOneStrap;
            self.cacheElements();
            self.bindEvents();
            self.el.step1.hide();
            self.el.step2.hide();
            self.el.bottomGallery.hide();
            self.el.buyStep1.hide();
            for(var i = 1; i < self.variables.possibleStrapAmount + 1; i++){
                self.el['partRecapAdditionalStrapRow' + i].hide();
            }
            self.el.partRecapAdditionStrapsTable.hide();
            self.setDefaultValues();
            self.el.promotionCodeTableRow.hide();
            var sliderValue = 0;
            self.initModals();
            $('.fancybox').fancybox({
                type: "image"
            });
            self.el.shippingCostValue = self.formatPrice(shippingCost);
            self.el.startButton.button();
            self.el.fullViewButton.button();
            self.el.step2Button.button();
            self.el.buyNowButton.button();
            self.el.invertButton.button();
            self.el.addPromotionCodeBtn.button();
            self.el.buyStep2Button.button();
            if(Cookies.get('patternRotation') != undefined){
                sliderValue = Cookies.get('patternRotation');
                self.state.patternRotation = sliderValue;
            }
            self.el.patternRotationSlider.slider({
                orientation: "horizontal",
                range: "min",
                value: sliderValue,
                max: 359,
                slide: function(event, ui){
                    self.el.watchPattern.css("-webkit-transform", "rotate(" + ui.value + "deg)");
                    self.el.watchPattern.css("-moz-transform", "rotate(" + ui.value + "deg)");
                    self.el.watchPattern.css("-ms-transform", "rotate(" + ui.value + "deg)");
                    self.el.watchPattern.css("-o-transform", "rotate(" + ui.value + "deg)");
                    self.el.watchPattern.css("transform", "rotate(" + ui.value + "deg)");
                    self.state.patternRotation = ui.value;
                    Cookies.set('patternRotation', ui.value, {expires: 30, path: '/'});
                    self.el.partRecapRotation.html(ui.value + " degrees");
                }
            });
            if(Cookies.get('userID') == undefined){
                Cookies.set('userID', generateUUID(), {expires: 30, path: '/'});
                self.animateIntro();
            } else {
                self.enterStep1();
            }
        },

        cacheElements: function(){
            var self = builder;

            self.el.startButton = $('#startButton');
            self.el.step2Button = $('#step2Button');
            self.el.watchContainer = $('.watchContainer');
            self.el.intro = $('.splash');
            self.el.step1 = $('.step1');
            self.el.step2 = $('.step2');
            self.el.bottomGallery = $('.bottomGalleryContainer');
            self.el.buyStep1 = $('.buyStep1');
            self.el.selectCase = $('.selectCaseColor');
            self.el.selectStrap = $('.selectStrap');
            self.el.selectHands = $('.selectHands');
            self.el.selectDial = $('.selectDial');
            self.el.selectMarker = $('.selectMarker');
            self.el.watchPattern = $('.watchPattern');
            self.el.fullViewButton = $('#fullViewButton');
            self.el.patternRotationSlider = $('.patternRotatorSlider');
            self.el.backButton = $('#backButton');
            self.el.invertButton = $('#invertPattern');
            self.el.buyNowButton = $('.buyNowButton');
            self.el.priceValue = $('.priceValue');
            self.el.subtotalValue = $('.subtotalValue');
            self.el.leftArrow = $('.chooseArrowLeft');
            self.el.rightArrow = $('.chooseArrowRight');
            self.el.openGallery = $('.openGalleryText');
            self.el.partRecapCase = $('.caseValue');
            self.el.partRecapHands = $('.handsValue');
            self.el.partRecapStrap = $('.strapValue');
            self.el.partRecapDial = $('.dialValue');
            self.el.partRecapIndex = $('.indexValue');
            self.el.partRecapNumerals = $('.numeralsValue');
            self.el.partRecapMarker = $('.markerValue');
            self.el.partRecapPattern = $('.patternValue');
            self.el.partRecapInverted = $('.invertedValue');
            self.el.partRecapRotation = $('.rotationValue');
            self.el.partRecapAdditionStrapsTable = $('.additionalStrapsRowMain');
            self.el.partRecapAdditionalStrap1 = $('.additionalStrap1Value');
            self.el.partRecapAdditionalStrap2 = $('.additionalStrap2Value');
            self.el.partRecapAdditionalStrap3 = $('.additionalStrap3Value');
            self.el.partRecapAdditionalStrap4 = $('.additionalStrap4Value');
            self.el.partRecapAdditionalStrap5 = $('.additionalStrap5Value');
            self.el.partRecapAdditionalStrapPrice1 = $('.additionalStrapPriceValue1');
            self.el.partRecapAdditionalStrapPrice2 = $('.additionalStrapPriceValue2');
            self.el.partRecapAdditionalStrapPrice3 = $('.additionalStrapPriceValue3');
            self.el.partRecapAdditionalStrapPrice4 = $('.additionalStrapPriceValue4');
            self.el.partRecapAdditionalStrapPrice5 = $('.additionalStrapPriceValue5');
            self.el.partRecapAdditionalStrapRow1 = $('.additionalStrapLine1');
            self.el.partRecapAdditionalStrapRow2 = $('.additionalStrapLine2');
            self.el.partRecapAdditionalStrapRow3 = $('.additionalStrapLine3');
            self.el.partRecapAdditionalStrapRow4 = $('.additionalStrapLine4');
            self.el.partRecapAdditionalStrapRow5 = $('.additionalStrapLine5');
            self.partLists.cases = cases;
            self.partLists.straps = straps;
            self.partLists.hands = hands;
            self.partLists.dials = dials;
            self.partLists.indices = indices;
            self.partLists.numerals = numerals;
            self.partLists.patterns = patterns;
            self.partLists.markers = markers;
            self.el.additionalStrapsButton = $('.additionalStrapModalButton');
            self.el.additionalStrapsDialog = $('#additionalStrapDialog');
            self.el.clearButtons = $('.clearButton');
            self.el.addPromotionCodeBtn = $('.addPromotionCodeBtn');
            self.el.addPromotionCodeInput = $('.promotionCodeInput');
            self.el.fullViewDialog = $('#fullViewDialog');
            self.el.editButton = $('.editButton');
            self.el.buyStep2Button = $('.buyStep2Button');
            self.el.promotionCodeTableRow = $('.promotionCodeRow');
            self.el.invalidPromotionCodeDialog = $('#invalidPromotionCodeModal');

            self.el.shippingCostValue = $('.shippingCostValue');
            self.el.promotionCodeDiscount = $('.promotionCodeDiscount');
            self.el.step1RecapTitle = $('.step1RecapTitle');
            self.el.additionalStrapPriceValue = $('.additionalStrapPriceValue');
            self.el.totalPriceValue = $('.totalPriceValue');
            self.el.invalidselectionsModal = $('#invalidSelectionsModal');
        },

        bindEvents: function() {
            var self = builder;

            self.el.startButton.on('click', self.enterStep1);
            self.el.step2Button.on('click', function() {
                if (self.state.case != self.variables.outlineName && self.state.straps != self.variables.outlineName) {
                    self.enterStep2();
                } else {
                    self.el.invalidselectionsModal.dialog('open');
                }
            });
            self.bindSelectorEvents('.selectCaseColor', '.watchCase', true, self.partLists.cases);
            self.bindSelectorEvents('.selectStrap', '.watchStrap', false, self.partLists.straps);
            self.bindSelectorEvents('.selectHands', '.watchHands', true, self.partLists.hands);
            self.bindSelectorEvents('.selectDial', '.watchDial', false);
            self.bindSelectorEvents('.selectIndex', '.watchIndex', true, self.partLists.indices);
            self.bindSelectorEvents('.selectNumerals', '.watchNumerals', true, self.partLists.numerals);
            self.bindSelectorEvents('.selectPattern', '.watchPattern', false);
            self.bindSelectorEvents('.selectMarker', '.watchMarker', true, self.partLists.markers);
            self.el.backButton.on('click', function(){
                if(self.state.lastScreen == 'step1' || self.state.currentScreen == 'step2'){
                    self.enterStep1();
                } else if(self.state.lastScreen == 'step2'){
                    self.enterStep2();
                } else {
                    //Do Nothing
                }
            });
            self.el.editButton.on('click', self.enterStep1);
            self.el.invertButton.on('click', function() {
                if($(this).is(':checked')){
                    self.state.invertPattern = true;
                    self.el.partRecapInverted.html('Yes');
                    Cookies.set('invertPattern', true, {expires: 30, path: '/'});
                    if(self.state.pattern != self.variables.noneName) {
                        $('.thumbnail[data-parttype="' + self.state.pattern + '"]').trigger('click');
                    }
                } else {
                    self.state.invertPattern = false;
                    self.el.partRecapInverted.html('No');
                    Cookies.set('invertPattern', false, {expires: 30, path: '/'});
                    if(self.state.pattern != self.variables.noneName) {
                        $('.thumbnail[data-parttype="' + self.state.pattern + '"]').trigger('click');
                    }
                }
            });
            self.el.buyNowButton.on('click', function() {
                if (self.state.case != self.variables.outlineName && self.state.straps != self.variables.outlineName) {
                    self.enterBuyStep1();
                } else {
                    self.el.invalidselectionsModal.dialog('open');
                }
            });
            self.el.leftArrow.on('click', function(){
                if(self.state.currentScreen == 'step1' || self.state.currentScreen == 'intro'){
                    var index = 0;
                    for(var i = 0; 0 < self.partLists.dials.length; i++){
                        if(self.partLists.dials[i] == self.state.dial){
                            index = i - 1;
                            break;
                        }
                    }
                    if(index < 0) {
                        index = self.partLists.dials.length - 1;
                    }
                    $(".selectDial img[data-parttype='" + self.partLists.dials[index] + "']").trigger('click');
                } else if (self.state.currentScreen == 'step2') {
                    var index = 0;
                    for(var i = 0; 0 < self.partLists.patterns.length; i++){
                        if(self.partLists.patterns[i] == self.state.pattern){
                            index = i - 1;
                            break;
                        }
                    }
                    if(index < 0) {
                        index = self.partLists.patterns.length - 1;
                    }
                    $(".selectPattern img[data-parttype='" + self.partLists.patterns[index] + "']").trigger('click');
                } else {
                    self.randomizeParts();
                }
            });
            self.el.rightArrow.on('click', function(){
                if(self.state.currentScreen == 'step1'  || self.state.currentScreen == 'intro'){
                    var index = 0;
                    for(var i = 0; 0 < self.partLists.dials.length; i++){
                        if(self.partLists.dials[i] == self.state.dial){
                            index = i + 1;
                            break;
                        }
                    }
                    if(index > self.partLists.dials.length - 1) {
                        index = 0;
                    }
                    $(".selectDial img[data-parttype='" + self.partLists.dials[index] + "']").trigger('click');
                } else if (self.state.currentScreen == 'step2') {
                    var index = 0;
                    for(var i = 0; 0 < self.partLists.patterns.length; i++){
                        if(self.partLists.patterns[i] == self.state.pattern){
                            index = i + 1;
                            break;
                        }
                    }
                    if(index > self.partLists.patterns.length - 1) {
                        index = 0;
                    }
                    $(".selectPattern img[data-parttype='" + self.partLists.patterns[index] + "']").trigger('click');
                } else {
                    self.randomizeParts();
                }
            });
            self.el.additionalStrapsButton.on('click', function(){
                self.el.additionalStrapsDialog.dialog('open');
            });
            self.el.fullViewButton.on('click', function () {
                self.el.fullViewDialog.dialog('open');
            });
            $('.modalSelector > .thumbnails > .thumbnailContainer > .thumbnailInnerContainer > .thumbnail').each(function(index){
                $(this).on('click', function(e){
                    var valueSet = false,
                        partType = $(this).data('parttype'),
                        count = 0;
                    e.preventDefault();
                    $('.unselectedStrap').each(function(){
                        count++;
                        if(!valueSet) {
                            $(this).removeClass('unselectedStrap');
                            $(this).addClass('selectedStrap');
                            $(this).html(partType);
                            valueSet = true;
                        }
                    });
                    if(count == 0 || count == 1){
                        $('#StrapButtonDone').button('enable');
                    }
                });
            });
            self.el.clearButtons.on('click', function () {
                $(this).closest('.strapLine').children(".strapModalValue").each(function(){
                    $(this).removeClass('selectedStrap');
                    $(this).addClass('unselectedStrap');
                    $(this).html("Please select");
                });
            });
            self.el.addPromotionCodeBtn.on('click', function(){
                $.ajax({
                    type: "POST",
                    url: 'phpScripts/checkDiscountCode.php',
                    data: {string: self.el.addPromotionCodeInput.val()},
                    dataType: 'json'
                }).done(function (data) {
                    if(data.response != undefined && data.response == true) {
                        self.state.validPromotionCodeAdded = true;
                        self.el.promotionCodeTableRow.show();
                        self.state.addedPromotionCode = self.el.addPromotionCodeInput.val();
                        self.updatePrice();
                    } else {
                        self.state.validPromotionCodeAdded = false;
                        self.el.promotionCodeTableRow.hide();
                        self.state.addedPromotionCode = self.el.addPromotionCodeInput.val();
                        self.updatePrice();
                        self.el.invalidPromotionCodeDialog.dialog('open');
                    }
                }).error(function() {
                    console.log("There was an error fetching data");
                })
            });

            self.el.buyStep2Button.on('click', function() {
                var postForm = '<form method="POST" action="' + self.variables.checkoutURL + '" + >\n';

                for(var key in self.state) {
                    if(self.state.hasOwnProperty(key)){
                        postForm += '<input type="hidden" name="' + key + '" value="' + self.state[key] + '" ></input>\n';
                        console.log(self.state[key]);
                    }
                }

                postForm += "</form>";

                var postFormEle = $(postForm);

                $('body').append(postFormEle);
                postFormEle.submit();
            });
            self.el.openGallery.on('click', function(){
                $('html, body').animate({scrollTop: 500}, 1000);
            });
        },

        enterIntro: function(){
            var self = builder;
            self.el.intro.show(self.variables.animationType, self.variables.animationSpeed);
            self.el.watchContainer.show(self.variables.animationType, self.variables.animationSpeed);
            self.el.watchContainer.removeClass('buyPosition');
            self.el.watchContainer.addClass('watchIntro');
            self.el.step2.hide(self.variables.animationType, self.variables.animationSpeed);
            self.el.step1.hide(self.variables.animationType, self.variables.animationSpeed);
            self.el.bottomGallery.hide(self.variables.animationType, self.variables.animationSpeed);
            self.el.buyStep1.hide(self.variables.animationType, self.variables.animationSpeed);
            self.state.lastScreen = self.state.currentScreen;
            self.state.currentScreen = 'intro';
            self.positionFooter();
        },

        enterStep1: function(){
            var self = builder;
            self.el.intro.hide(self.variables.animationType, self.variables.animationSpeed);
            self.el.step2.hide(self.variables.animationType, self.variables.animationSpeed);
            self.el.step1.show(self.variables.animationType, self.variables.animationSpeed);
            self.el.bottomGallery.show(self.variables.animationType, self.variables.animationSpeed);
            self.el.watchContainer.show(self.variables.animationType, self.variables.animationSpeed);
            self.el.watchContainer.removeClass('buyPosition');
            self.el.watchContainer.removeClass('watchIntro');
            self.el.buyStep1.hide(self.variables.animationType, self.variables.animationSpeed);
            self.state.lastScreen = self.state.currentScreen;
            self.state.currentScreen = 'step1';
            self.positionFooter();
        },

        enterStep2: function(){
            var self = builder;
            self.el.intro.hide(self.variables.animationType, self.variables.animationSpeed);
            self.el.step1.hide(self.variables.animationType, self.variables.animationSpeed);
            self.el.step2.show(self.variables.animationType, self.variables.animationSpeed);
            self.el.bottomGallery.show(self.variables.animationType, self.variables.animationSpeed);
            self.el.watchContainer.show(self.variables.animationType, self.variables.animationSpeed);
            self.el.buyStep1.hide(self.variables.animationType, self.variables.animationSpeed);
            self.el.watchContainer.removeClass('buyPosition');
            self.el.watchContainer.removeClass('watchIntro');
            self.state.lastScreen = self.state.currentScreen;
            self.state.currentScreen = 'step2';
            self.positionFooter();
        },

        enterBuyStep1: function() {
            var self = builder;
            self.el.intro.hide(self.variables.animationType, self.variables.animationSpeed);
            self.el.step1.hide(self.variables.animationType, self.variables.animationSpeed);
            self.el.step2.hide(self.variables.animationType, self.variables.animationSpeed);
            self.el.bottomGallery.hide(self.variables.animationType, self.variables.animationSpeed);
            //self.el.watchContainer.hide(self.variables.animationType, self.variables.animationSpeed);
            self.el.watchContainer.addClass('buyPosition');
            self.el.watchContainer.removeClass('watchIntro');
            self.el.buyStep1.show(self.variables.animationType, self.variables.animationSpeed);
            self.state.lastScreen = self.state.currentScreen;
            self.state.currentScreen = 'CustomerDetails';
            self.positionFooter();
        },

        bindSelectorEvents: function(container, target, arrowSelect, partArray){
            var self = builder;
            $(container + ' > .thumbnails > .thumbnailContainer > .thumbnailInnerContainer > .thumbnail').each(function(index) {
                if ($(this).hasClass('arrow')) {
                    $(this).on('click', function (e) {
                        e.preventDefault();
                        var index = 0;
                        if($(this).hasClass('leftArrow')) {
                            for(var i = 0; 0 < partArray.length; i++){
                                if(partArray[i] == $(container + ' > .selectorHeader > .partDescription').text()){
                                    index = i - 1;
                                    break;
                                }
                            }
                            if(index < 0) {
                                index = partArray.length - 1;
                            }
                        } else if($(this).hasClass('rightArrow')){
                            for(var i = 0; 0 < partArray.length; i++){
                                if(partArray[i] == $(container + ' > .selectorHeader > .partDescription').text()){
                                    index = i + 1;
                                    break;
                                }
                            }
                            if(index > partArray.length - 1) {
                                index = 0;
                            }
                        }
                        $(container + " img[data-parttype='" + partArray[index] + "']").trigger('click');
                    });
                } else {
                    var partType = $(this).data('parttype');
                    $(this).on('click', function (e) {
                        e.preventDefault();
                        if(!arrowSelect) {
                            $(container).find('.selected').each(function () {
                                $(this).removeClass('selected');
                            });
                            $(this).parent().addClass('selected');
                        } else {
                            $(container + ' > .thumbnails > .thumbnailContainer').each(function() {
                                var child = $(this).find('.thumbnail');
                                if(!child.hasClass('arrow')){
                                    $(this).hide();
                                }
                                if(child.data('parttype') == self.variables.outlineName && partType != self.variables.outlineName) {
                                    $(this).remove();
                                    var ind = partArray.indexOf(self.variables.outlineName);
                                    partArray.splice(ind, 1);
                                }
                            });
                            $(this).closest('.thumbnailContainer').show();
                        }
                        $(container + ' > .selectorHeader > .partDescription').text(partType);
                        $(target).each(function (index) {
                            if ($(this).data('parttype') == partType && !(self.state.invertPattern && target == '.watchPattern') || self.state.invertPattern && $(this).data('parttype') == partType + " INV") {
                                $(this).show();
                            } else {
                                $(this).hide();
                            }
                        });
                        switch (container) {
                            case '.selectCaseColor':
                                self.state.case = partType;
                                self.el.partRecapCase.html(partType);
                                Cookies.set('case', partType, {expires: 30, path: '/'});
                                break;
                            case '.selectStrap':
                                self.state.straps = partType;
                                self.el.partRecapStrap.html(partType);
                                Cookies.set('straps', partType, {expires: 30, path: '/'});
                                break;
                            case '.selectHands':
                                self.state.hands = partType;
                                self.el.partRecapHands.html(partType);
                                Cookies.set('hands', partType, {expires: 30, path: '/'});
                                break;
                            case '.selectDial':
                                self.state.dial = partType;
                                self.el.partRecapDial.html(partType);
                                Cookies.set('dial', partType, {expires: 30, path: '/'});
                                break;
                            case '.selectIndex':
                                self.state.index = partType;
                                self.el.partRecapIndex.html(partType);
                                Cookies.set('index', partType, {expires: 30, path: '/'});
                                break;
                            case '.selectNumerals':
                                self.state.numerals = partType;
                                self.el.partRecapNumerals.html(partType);
                                Cookies.set('numerals', partType, {expires: 30, path: '/'});
                                break;
                            case '.selectPattern':
                                self.state.pattern = partType;
                                self.el.partRecapPattern.html(partType);
                                Cookies.set('pattern', partType, {expires: 30, path: '/'});
                                break;
                            case '.selectMarker':
                                self.state.marker = partType;
                                self.el.partRecapMarker.html(partType);
                                Cookies.set('marker', partType, {expires: 30, path: '/'});
                                break;
                            default:
                                console.log("Error: State not changed");
                        }
                        self.updatePrice();
                    });
                }
            });
        },

        setDefaultValues: function() {
            var self = builder;
            if(Cookies.get('userID') == undefined){
                //Do Nothing
                //self.state = self.defaultValues;
            } else {
                self.state.case = Cookies.get('case');
                self.state.straps = Cookies.get('straps');
                self.state.hands = Cookies.get('hands');
                self.state.dial = Cookies.get('dial');
                self.state.index = Cookies.get('index');
                self.state.numerals = Cookies.get('numerals');
                self.state.pattern = Cookies.get('pattern');
                if(Cookies.get('patternRotation') != undefined) {
                    $('.watchPattern').css("transform", "rotate(" + Cookies.get('patternRotation') + "deg)");
                }
                if(Cookies.get('invertPattern') != undefined) {
                    var val = Cookies.get('invertPattern') == 'true';
                    self.el.invertButton.prop('checked', val);
                    self.state.invertPattern = val;
                }

                for(var i = 1; i < self.variables.possibleStrapAmount + 1; i++){
                    if(Cookies.get('additionalStrap' + i) != undefined){
                        self.state['additionalStrap' + i] = Cookies.get('additionalStrap' + i);
                    }

                    if(self.state['additionalStrap' + i] != self.variables.noneName){
                        self.el['partRecapAdditionalStrapPrice' + i].html(singleStrapCost);
                        self.el['partRecapAdditionalStrapRow' + i].show();
                        self.el['partRecapAdditionalStrap' + i].html(Cookies.get('additionalStrap' + i));
                    } else {
                        self.el['partRecapAdditionalStrapRow' + i].hide();
                    }
                }

                if(Cookies.get('noOfAdditionalStraps') != undefined){
                    self.state.noOfAdditionalStraps = Cookies.get('noOfAdditionalStraps');
                }
                if(self.state.noOfAdditionalStraps > 0) {
                    self.el.partRecapAdditionStrapsTable.show();
                } else {
                    self.el.partRecapAdditionStrapsTable.hide();
                }
            }
            console.log(self.state.straps);
            if(self.state.straps == self.variables.outlineName) {
                $('.watchStrap').each(function (index) {
                    if ($(this).data('parttype') == self.variables.outlineName) {
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                });
                Cookies.set('straps', self.variables.outlineName);
            } else {
                $(".selectStrap img[data-parttype='" + self.state.straps + "']").trigger('click');
            }

            $(".selectCaseColor img[data-parttype='" + self.state.case + "']").trigger('click');
            $(".selectHands img[data-parttype='" + self.state.hands + "']").trigger('click');
            $(".selectDial img[data-parttype='" + self.state.dial + "']").trigger('click');
            $(".selectIndex img[data-parttype='" + self.state.index + "']").trigger('click');
            $(".selectNumerals img[data-parttype='" + self.state.numerals + "']").trigger('click');
            $(".selectPattern img[data-parttype='" + self.state.pattern + "']").trigger('click');
            $(".selectMarker img[data-parttype='" + self.state.marker + "']").trigger('click');

        },
        randomizeParts: function() {
            var self = builder;

            $(".selectCaseColor img[data-parttype='" + self.partLists.cases[Math.floor(self.partLists.cases.length * Math.random())] + "']").trigger('click');
            $(".selectStrap img[data-parttype='" + self.partLists.straps[Math.floor(self.partLists.straps.length * Math.random())] + "']").trigger('click');
            $(".selectHands img[data-parttype='" + self.partLists.hands[Math.floor(self.partLists.hands.length * Math.random())] + "']").trigger('click');
            $(".selectDial img[data-parttype='" + self.partLists.dials[Math.floor(self.partLists.dials.length * Math.random())] + "']").trigger('click');
            $(".selectIndex img[data-parttype='" + self.partLists.indices[Math.floor(self.partLists.indices.length * Math.random())] + "']").trigger('click');
            $(".selectNumerals img[data-parttype='" + self.partLists.numerals[Math.floor(self.partLists.numerals.length * Math.random())] + "']").trigger('click');
            $(".selectPattern img[data-parttype='" + self.partLists.patterns[Math.floor(self.partLists.patterns.length * Math.random())] + "']").trigger('click');
            $(".selectMarker img[data-parttype='" + self.partLists.markers[Math.floor(self.partLists.markers.length * Math.random())] + "']").trigger('click');
        },

        formatPrice: function(number) {
            number = number + '';
            var arr = number.split(',');
            var n1 = arr[0];
            var n2 = arr.length > 1 ? ',' + arr[1] : ',00';
            var rgx = /(\d+)(\d{3})/;
            while (rgx.test(n1)) {
                n1 = n1.replace(rgx, '$1' + '.' + '$2');
            }

            return n1 + n2;
        },

        updatePrice: function () {
            var self = builder;
            var totalPrice = 0;
            if(self.state.pattern == self.variables.noneName && self.state.numerals == self.variables.noneName && self.state.index == self.variables.noneName){
                self.el.priceValue.text(self.formatPrice(pricePlainOneStrap));
                self.el.step1RecapTitle.text("JAGD WATCH - PLAIN DIAL");
                self.el.additionalStrapPriceValue.text(singleStrapCost);
                totalPrice = pricePlainOneStrap  + self.state.noOfAdditionalStraps * singleStrapCost;
            } else {
                self.el.priceValue.text(self.formatPrice(priceEngravedOneStrap));
                self.el.additionalStrapPriceValue.text(singleStrapCost);
                self.el.step1RecapTitle.text("JAGD WATCH - ENGRAVED DIAL");
                totalPrice = priceEngravedOneStrap  + self.state.noOfAdditionalStraps * singleStrapCost;
            }
            self.el.promotionCodeDiscount.text("-" + self.formatPrice(totalPrice + shippingCost));
            self.el.subtotalValue.text(totalPrice);
            if(self.state.validPromotionCodeAdded) {
                totalPrice = 0;
                self.el.totalPriceValue.text(self.formatPrice(totalPrice));
                self.state.totalPrice = totalPrice
            } else {
                totalPrice = totalPrice + shippingCost;
                self.el.totalPriceValue.text(self.formatPrice(totalPrice));
                self.state.totalPrice = totalPrice;
            }

        },

        initModals: function(){
            var self = builder;

            self.el.additionalStrapsDialog.dialog({
                autoOpen: false,
                height: 600,
                width: 700,
                modal: true,
                buttons: [
                    {
                        id: 'StrapButtonDone',
                        text: 'Done',
                        click: function() {
                            var strap1Value = $(this).find('.strap1Value'),
                                strap2Value = $(this).find('.strap2Value'),
                                strap3Value = $(this).find('.strap3Value'),
                                strap4Value = $(this).find('.strap4Value'),
                                strap5Value = $(this).find('.strap5Value'),
                                amountOfStraps = 0;

                            var strapValues =[strap1Value, strap2Value, strap3Value, strap4Value, strap5Value];

                            for(var i = 0; i < strapValues.length; i++) {
                                if(!(strapValues[i].hasClass('unselectedStrap'))) {
                                    self.state['additionalStrap' + (i+1)] = strapValues[i].html();
                                    self.el['partRecapAdditionalStrap' + (i+1)].html(strapValues[i].html());
                                    Cookies.set('additionalStrap' + (i + 1), strapValues[i].html(), {expires: 30, path: '/'});
                                    self.el['partRecapAdditionalStrapPrice' + (i+1)].html(singleStrapCost);
                                    self.el['partRecapAdditionalStrapRow' + (i+1)].show();
                                    amountOfStraps++;
                                } else {
                                    self.el['partRecapAdditionalStrapRow' + (i+1)].hide();
                                    Cookies.set('additionalStrap' + (i + 1), self.variables.noneName, {expires: 30, path: '/'});
                                }
                            }

                            if(amountOfStraps > 0){
                                self.el.partRecapAdditionStrapsTable.show();
                            } else {
                                self.el.partRecapAdditionStrapsTable.hide();
                            }
                            Cookies.set('noOfAdditionalStraps', amountOfStraps);
                            self.state.noOfAdditionalStraps = amountOfStraps;
                            self.updatePrice();
                            $(this).dialog('close');
                        }
                    }
                ],
                close: function(){

                    /*if($('#StrapButtonDone').is(':disabled')){
                        self.state.additionalStrap1 = self.variables.noneName;
                        self.state.additionalStrap2 = self.variables.noneName;
                        self.el.partRecapAdditionalStrap1.html(self.variables.noneName);
                        self.el.partRecapAdditionalStrap2.html(self.variables.noneName);
                        Cookies.set('additionalStrap1', self.variables.noneName, {expires: 30, path: '/'})
                        Cookies.set('additionalStrap2', self.variables.noneName, {expires: 30, path: '/'});
                        self.updatePrice();
                    }*/
                }
            });

            self.el.fullViewDialog.dialog({
                autoOpen: false,
                height: 700,
                width: 400,
                modal: true,
                resizable: false,
                buttons: {

                }
            });

            self.el.invalidPromotionCodeDialog.dialog({
                autoOpen: false,
                height: 500,
                width: 500,
                modal: true,
                buttons: {
                    "OK": function() {
                        $(this).dialog('close');
                    }
                }
            });

            self.el.invalidselectionsModal.dialog({
                autoOpen: false,
                height: 500,
                width: 500,
                modal: true,
                buttons: {
                    "OK": function() {
                        $(this).dialog('close');
                    }
                }
            });
        },

        animateIntro: function () {
            var self = builder;

            var func = function () {
                var i = 0;
                var innerFunc = function () {
                    self.el.rightArrow.trigger('click');
                    i++;
                    if(i < self.variables.introNoOfChanges){
                        setTimeout(innerFunc, self.variables.introChangeInterval);
                    } else {
                        self.enterStep1();
                    }
                };
                innerFunc();
            };

            setTimeout(func, self.variables.introDelay);
        },

        positionFooter: function () {
            var footerHeight = 0,
                footerTop = 0,
                $footer = $(".footer");

            footerHeight = $footer.height();
            footerTop = ($(document).height()-footerHeight) + "px";

            $footer.css({
                position: "absolute",
                top: footerTop
            })

        }
    };

    return {
        init: function(){
            builder.init();
        },

        positionFooter: function() {
            builder.positionFooter();
        }
    };

})(jQuery);