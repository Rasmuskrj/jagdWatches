/**
 * Created by RasmusKrøyer on 08-07-2015.
 */
$(function(){
    WatchBuilder.init();


    $(window).load(function(){
        $(".vScrollable").mCustomScrollbar({
            theme: "minimal-dark",
            advanced:{ autoExpandHorizontalScroll: true},
            scrollInertia: 0,
            alwaysShowScrollbar: 2,
            autoDraggerLength: true
        });
        $(".hScrollable").mCustomScrollbar({
            theme: "minimal-dark",
            axis: "x",
            advanced:{ autoExpandHorizontalScroll: true},
            scrollInertia: 0,
            alwaysShowScrollbar: 2,
            autoDraggerLength: true
        });
    });

    $(window).bind("load", function() {

        WatchBuilder.positionFooter();

        $(window)
            .scroll(WatchBuilder.positionFooter)
            .resize(WatchBuilder.positionFooter)

    });
});