/**=========================================================
 * Module: sparkline.js
 * SparkLines Mini Charts
 =========================================================*/

(function($, window, document) {
    'use strict';

    var Selector = '.inlinesparkline';

    // Match color with css values to style charts
    var colors = {
        primary: '#6cb5f4',
        success: '#27c24c',
        info: '#23b7e5',
        warning: '#ff902b',
        danger: '#f05050',
        inverse: '#131e26',
        green: '#0BBEB5',
        pink: '#ff3366',
        purple: '#7266ba',
        dark: '#3a3f51'
    };

    // Inline sparklines take their values from the contents of the tag 
    $(Selector).each(function() {

        var el = $(this);
        var opts = startSparkline( el );

        if (opts.resize) {
            $(window).resize(function() {
                startSparkline(el);
            });
        }

    });

    function startSparkline(el) {
        var data = el.data();

        if (data.barColor && colors[data.barColor])
            data.barColor = colors[data.barColor];

        var options = data;
        options.type = data.type || 'bar'; // default chart is bar

        el.sparkline(options.values, options);

        el.children('canvas').css('max-width', '100%');

        return options;
    }

}(jQuery, window, document));