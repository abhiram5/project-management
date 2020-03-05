/**=========================================================
 * Module: dashboard.v2
 =========================================================*/

(function($, window, document) {
    'use strict';

    if ( ! $.fn.vectorMap || ! $.fn.plot ) return;

    // Main big chart
    // ----------------------

    var splineData1 = [{
        'label': 'Unique',
        'color': '#14ddb3',
        data: [
            ['Jan', 30],
            ['Feb', 20],
            ['Mar', 40],
            ['Apr', 20],
            ['May', 30],
            ['Jun', 70],
            ['Jul', 30],
            ['Aug', 20],
            ['Sep', 30],
            ['Oct', 50],
            ['Nov', 20],
            ['Dec', 20]
        ]
    }, {
        'label': 'Recurrent',
        'color': '#23b7e5',
        data: [
            ['Jan', 5],
            ['Feb', 7],
            ['Mar', 15],
            ['Apr', 7],
            ['May', 15],
            ['Jun', 32],
            ['Jul', 17],
            ['Aug', 10],
            ['Sep', 10],
            ['Oct', 17],
            ['Nov', 7],
            ['Dec', 7]
        ]
    }];

    var splineOptions1 = {
        series: {
            points: {
                show: true,
                radius: 0
            },
            splines: {
                show: true,
                tension: 0.4,
                lineWidth: 0,
                fill: 0.9
            }
        },
        grid: {
            borderColor: '#eee',
            borderWidth: 0,
            hoverable: true,
            clickable: true,
            backgroundColor: 'transparent'
        },
        tooltip: true,
        tooltipOpts: {
            content: function(label, x, y) {
                return x + ' : ' + y;
            }
        },
        xaxis: {
            mode: 'categories',
            show: false
        },
        yaxis: {
            max: 80,
            show: false
        },
        legend: {
            backgroundColor: 'transparent',
            show: false
        },
        shadowSize: 0
    };

    $('#dashboard-splinechart-1').each(function(){
        runFlot(this, splineData1, splineOptions1);
    });

    // Bottom Big Chart
    // -----------------------

    var splineData2 = [{
        data: [
            [1, 30],
            [2, 20],
            [3, 40],
            [4, 20],
            [5, 30],
            [6, 70],
            [7, 30],
            [8, 20],
            [9, 30],
            [10, 50],
            [11, 20],
            [12, 20]
        ],
        splines: {
            show: true,
            tension: 0.45,
            lineWidth: 4,
            fill: 0.1,
        }
    }, {
        data: [
            [1, 30],
            [2, 20],
            [3, 40],
            [4, 20],
            [5, 30],
            [6, 70],
            [7, 30],
            [8, 20],
            [9, 30],
            [10, 50],
            [11, 20],
            [12, 20]
        ],
        bars: {
            show: true,
            barWidth: 0.05,
            align: 'center',
            lineWidth: 0,
            fillColor: {
                colors: [{
                    opacity: 0.2
                }, {
                    opacity: 0.2
                }]
            }
        }
    }]

    var splineOptions2 = {
        series: {
            points: {
                show: false
            }
        },
        colors: ['#1c75bf', '#1c75bf'],
        grid: {
            borderColor: '#eee',
            borderWidth: 0,
            hoverable: true,
            clickable: true,
            backgroundColor: 'transparent'
        },
        tooltip: true,
        tooltipOpts: {
            content: function(label, x, y) {
                return x + ' : ' + y;
            }
        },
        xaxis: {
            mode: 'categories',
            show: false
        },
        yaxis: {
            max: 80,
            show: false
        },
        legend: {
            backgroundColor: 'transparent',
            show: false
        },
        shadowSize: 0
    }


    $('#dashboard-splinechart-2').each(function(){
        runFlot(this, splineData2, splineOptions2);
    });


    // Common function to run charts
    // by reading custom height from data attribute
    function runFlot(el, data, opts) {
        var $el = $(el),
            height = $el.data('height');
        if (height) $el.height(height);
        $el.plot(data, opts);
    }


    // Vector Map
    // --------------------------------

    // USA Map
    var usa_markers = [{
        latLng: [40.71, -74.00],
        name: 'New York',
        style: {
            fill: '#23b7e5'
        }
    }, {
        latLng: [34.05, -118.24],
        name: 'Los Angeles',
        style: {
            fill: '#23b7e5'
        }
    }, {
        latLng: [41.87, -87.62],
        name: 'Chicago',
        style: {
            fill: '#23b7e5',
            r: 15
        }
    }, {
        latLng: [29.76, -95.36],
        name: 'Houston',
        style: {
            fill: '#7266ba',
            r: 10
        }
    }, {
        latLng: [39.95, -75.16],
        name: 'Philadelphia',
        style: {
            fill: '#23b7e5'
        }
    }, {
        latLng: [38.90, -77.03],
        name: 'Washington',
        style: {
            fill: '#23b7e5'
        }
    }, {
        latLng: [37.36, -122.03],
        name: 'Silicon Valley',
        style: {
            fill: '#27c24c',
            r: 20
        }
    }];

    var usa_options = {
        map: 'us_mill_en',
        normalizeFunction: 'polynomial',
        backgroundColor: 'transparent',
        regionsSelectable: false,
        markersSelectable: false,
        zoomButtons: false,
        zoomOnScroll: false,
        markers: usa_markers,
        regionStyle: {
            initial: {
                fill: '#e4eaec'
            },
            hover: {
                fill: '#1c75bf',
                stroke: ''
            },
        },
        markerStyle: {
            initial: {
                fill: '#232735',
                stroke: '#fff',
                r: 10
            },
            hover: {
                fill: '#dde6e9',
                stroke: '#fff'
            }
        }
    };

    $('#vector-map').vectorMap(usa_options);


}(jQuery, window, document));