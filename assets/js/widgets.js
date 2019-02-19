( function ( $ ) {
    "use strict";


    // Counter Number
    $('.count').each(function () {
        $(this).prop('Counter',0).animate({
            Counter: $(this).text()
        }, {
            duration: 3000,
            easing: 'swing',
            step: function (now) {
                $(this).text(Math.ceil(now));
            }
        });
    });

    //Chart.defaults.global.tooltips.enabled = false;

    //WidgetChart 1
    var ctx = document.getElementById( "widgetChart1" );
    ctx.height = 150;
    var myChart = new Chart( ctx, {
        type: 'line',
        data: {
            labels: ['8 AM', '10 AM', '12 PM', '4 PM', '7 PM', '9 PM', '11 PM'],
            type: 'line',
            datasets: [ {
                data: [2, 4, 8, 2, 4, 6, 2],
                backgroundColor: 'transparent',
                borderColor: 'rgba(255,255,255,.55)',
            }, ]
        },
        options: {

            maintainAspectRatio: false,
            legend: {
                display: false
            },
            responsive: true,
            tooltips: {enabled: false},

            scales: {
                xAxes: [ {
                    gridLines: {
                        color: 'transparent',
                        zeroLineColor: 'transparent'
                    },
                    ticks: {
                        fontSize: 2,
                        fontColor: 'transparent'
                    }
                } ],
                yAxes: [ {
                    display:false,
                    ticks: {
                        display: false,
                    }
                } ]
            },
            title: {
                display: false,
            },
            elements: {
                line: {
                    borderWidth: 1
                },
                point: {
                    radius: 4,
                    hitRadius: 10,
                    hoverRadius: 4
                }
            }
        }
    } );


    //WidgetChart 2
    var ctx = document.getElementById( "widgetChart2" );
    ctx.height = 150;
    var myChart = new Chart( ctx, {
        type: 'line',
        data: {
            labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
            type: 'line',
            datasets: [ {
                data: [1, 18, 9, 17, 34, 22, 11],
                label: 'Dataset',
                backgroundColor: '#63c2de',
                borderColor: 'rgba(255,255,255,.55)',
            }, ]
        },
        options: {

            maintainAspectRatio: false,
            legend: {
                display: false
            },
            responsive: true,

            tooltips: {enabled: false},
        
            scales: {
                xAxes: [ {
                    gridLines: {
                        color: 'transparent',
                        zeroLineColor: 'transparent'
                    },
                    ticks: {
                        fontSize: 2,
                        fontColor: 'transparent'
                    }
                } ],
                yAxes: [ {
                    display:false,
                    ticks: {
                        display: false,
                    }
                } ]
            },
            title: {
                display: false,
            },
            elements: {
                line: {
                    tension: 0.00001,
                    borderWidth: 1
                },
                point: {
                    radius: 4,
                    hitRadius: 10,
                    hoverRadius: 4
                }
            }
        }
    } );



    //WidgetChart 3
    var ctx = document.getElementById( "widgetChart3" );
    ctx.height = 70;
    var myChart = new Chart( ctx, {
        type: 'line',
        data: {
            labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
            type: 'line',
            datasets: [ {
                data: [78, 81, 80, 45, 34, 12, 40],
                label: 'Dataset',
                backgroundColor: 'rgba(255,255,255,.2)',
                borderColor: 'rgba(255,255,255,.55)',
            }, ]
        },
        options: {

            maintainAspectRatio: true,
            legend: {
                display: false
            },
            responsive: true,
            tooltips: {enabled: false},
            // tooltips: {
            //     mode: 'index',
            //     titleFontSize: 12,
            //     titleFontColor: '#000',
            //     bodyFontColor: '#000',
            //     backgroundColor: '#fff',
            //     titleFontFamily: 'Montserrat',
            //     bodyFontFamily: 'Montserrat',
            //     cornerRadius: 3,
            //     intersect: false,
            // },
            scales: {
                xAxes: [ {
                    gridLines: {
                        color: 'transparent',
                        zeroLineColor: 'transparent'
                    },
                    ticks: {
                        fontSize: 2,
                        fontColor: 'transparent'
                    }
                } ],
                yAxes: [ {
                    display:false,
                    ticks: {
                        display: false,
                    }
                } ]
            },
            title: {
                display: false,
            },
            elements: {
                line: {
                    borderWidth: 2
                },
                point: {
                    radius: 0,
                    hitRadius: 10,
                    hoverRadius: 4
                }
            }
        }
    } );
    


} )( jQuery );