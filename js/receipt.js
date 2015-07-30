/**
 * Created by RasmusKrøyer on 30-07-2015.
 */

$(function(){

    $(window).bind("load", function() {

        WatchBuilder.positionFooter();

        $(window)
            .scroll(WatchBuilder.positionFooter)
            .resize(WatchBuilder.positionFooter)

    });
});
