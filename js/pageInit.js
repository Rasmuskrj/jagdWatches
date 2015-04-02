/**
 * Created by RasmusKrøyer on 03-04-2015.
 */

function pageInit() {

    var settings = {

        // Fullscreen?
        fullScreen: true,

        // Section Transitions?
        sectionTransitions: true,

        // Fade in speed (in ms).
        fadeInSpeed: 1000

    };

    skel.init({
        reset: 'full',
        breakpoints: {
            'max': { range: '*', href: 'css/style.css', containers: 1440 },
            'wide': { range: '-1920', href: 'css/style-wide.css', containers: 1360 },
            'normal': { range: '-1680', href: 'css/style-normal.css', containers: 1200 },
            'narrow': { range: '-1280', href: 'css/style-narrow.css', containers: 960, lockViewport: true },
            'narrower': { range: '-1000', href: 'css/style-narrower.css', containers: '95%' },
            'mobile': { range: '-640', href: 'css/style-mobile.css', grid: { gutters: 20 } },
            'mobile-narrow': { range: '-480', grid: { collapse: true, gutters: 10 } }
        }
    });
}
