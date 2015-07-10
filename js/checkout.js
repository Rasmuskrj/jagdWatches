/**
 * Created by RasmusKrøyer on 08-07-2015.
 */

$(function(){

    var form = $('.paymentForm'),
        submit = $('.paymentButton');

    submit.button();
    submit.on('click', function(){
        form.submit();
    });

    $(window).bind("load", function() {

        WatchBuilder.positionFooter();

        $(window)
            .scroll(WatchBuilder.positionFooter)
            .resize(WatchBuilder.positionFooter)

    });
});