/* Dishit Trial for chartinator*/
jQuery(function ($) {
            /**
             * A jQuery plugin that loads data from HTML tables, Google Sheets and data arrays and draws charts using Google Charts.
             *
             * Using HTML Tables
             * HTML tables can help make the chart data accessible.
             * You can either display the table with the chart or accessibly hide the table
             *
             * Suggested HTML Table setup
             * Create an HTML table with a caption and 'th' elements in the first row
             * For each 'th' element apply one of the following
             * 'data-type' attribute: 'string' 'number' 'boolean' 'date' 'datetime' 'timeofday'
             * or 'data-role' attribute:  'tooltip','annotation'
             * The caption element's text is used as a title for the chart by default.
             *
             * Apply the jQuery Chartinator plugin to the chart canvas(es)
             * or select the table(s) and Chartinator will insert a new chart canvas(es) after the table
             * or create js data arrays
             * See examples below and the readme file for more info
             */

            
            //  Pie Chart Example
            var chart2 = $('#pieChart').chartinator({

                // Custom Options ------------------------------------------------------
                // Note: This example appends data from a data array
                // to the data extracted from an HTML table
                // Google Charts does not support custom tooltips or annotations on Pie Charts

                // Append the following rows of data to the data extracted from the table
                //rows: [
                 //   ['France', 5],
                //    ['Mexico', 2]],

                // Create Table - String
                // Create a basic HTML table or a Google Table Chart from chart data
                // Options: false, 'basic-table', 'table-chart'
                // Note: This table will replace an existing HTML table
                createTable: 'table-chart',

                // The data title
                // A title used to identify the set of data
                // Used as a caption when generating an HTML table
                dataTitle: 'Pie Chart Data - Table Chart',

                // The chart type - String
                // Derived from the Google Charts visualization class name
                // Default: 'BarChart'
                // Use TitleCase names. eg. BarChart, PieChart, ColumnChart, Calendar, GeoChart, Table.
                // See Google Charts Gallery for a complete list of Chart types
                // https://developers.google.com/chart/interactive/docs/gallery
                chartType: 'PieChart',

                // The class to apply to the chart container element
                chartClass: 'col',

                // The class to apply to the table element
                tableClass: 'col-table',

                // The chart aspect ratio custom option - width/height
                // Used to calculate the chart dimensions relative to the width or height
                // this is overridden if the Google Chart's height and width options have values
                // Suggested value: 1.25
                // Default: false - not used
                //chartAspectRatio: 1.25,

                // Google Pie Chart Options
                pieChart: {

                    // Width of chart in pixels - Number
                    // Default: automatic (unspecified)
                    width: null,

                    // Height of chart in pixels - Number
                    // Default: automatic (unspecified)
                    height: 300,

                    chartArea: {
                        left: "6%",
                        top: 30,
                        width: "94%",
                        height: "100%"
                    },

                    // The font size in pixels - Number
                    // Or use css selectors as keywords to assign font sizes from the page
                    // For example: 'body'
                    // Default: false - Use Google Charts defaults
                    fontSize: 'body',

                    // The font family name. String
                    // Default: body font family
                    fontName: 'Roboto',

                    // Chart Title - String
                    // Default: Table caption.
                    //title: 'Pie Chart',

                    titleTextStyle: {

                        // The font size in pixels - Number
                        // Or use css selectors as keywords to assign font sizes from the page
                        // For example: 'body'
                        // Default: false - Use Google Charts defaults
                        fontSize: 'h4'
                    },
                    legend: {

                        // Legend position - String
                        // Options: bottom, top, left, right, in, none.
                        // Default: right
                        position: 'right'
                    },

                    // Array of colours
                    colors: ['#94ac27', '#3691ff', '#e248b3', '#f58327', '#bf5cff'],

                    // Make chart 3D - Boolean
                    // Default: false.
                    is3D: true,

                    tooltip: {

                        // Shows tooltip with values on hover - String
                        // Options: focus, none.
                        // Default: focus
                        trigger: 'focus'
                    }
                },
                // Show table as well as chart - String
                // Options: 'show', 'hide', 'remove'
                showTable: 'hide'
            });

           

        });

/* Dishit Trial for chartinator Ends*/



/* Dishit Trial for chartist*/
/**
* Theme: Adminto Dashboard
* Author: Coderthemes
* Chartist chart
*/

//smil-animations Chart

$(document).ready(function(){
	
    $("#total_profit_year").change(function(){
		
		var selected_year = $(this).val();
		
        $.ajax({ 
			url: profit_get_url,
			dataType:'JSON',
			data: {selected_year:selected_year},
			type: 'post',
			success: function(output) {
					if(output.status == 1){
						console.log(output.res['dec']);
						new Chartist.Line('#total_profit_chart', {
						  labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'July', 'Aug', 'Sept', 'Oct', 'Nov', 'Dec'],
						  series: [
							[output.res['jan'], output.res['feb'], output.res['mar'], output.res['apr'], output.res['may'], output.res['jun'], output.res['jul'], output.res['aug'], output.res['sept'], output.res['oct'], output.res['nov'], output.res['dec']]
						  ]
						}, {
						  fullWidth: true,
						  chartPadding: {
							right: 40
						  },
						  plugins: [
							Chartist.plugins.tooltip()
						  ]
						});
					}
					else{
						alert('alert');
					}
				}
			});
    });
	
    $("#total_spending_year").change(function(){
		
		var selected_year = $(this).val();
		
        $.ajax({ 
			url: spending_get_url,
			dataType:'JSON',
			data: {selected_year:selected_year},
			type: 'post',
			success: function(output) {
					if(output.status == 1){
						console.log(output.res['dec_spending']);
						new Chartist.Line('#total_spending_chart', {
						  labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'July', 'Aug', 'Sept', 'Oct', 'Nov', 'Dec'],
						  series: [
							[output.res['jan_spending'], output.res['feb_spending'], output.res['mar_spending'], output.res['apr_spending'], output.res['may_spending'], output.res['jun_spending'], output.res['jul_spending'], output.res['aug_spending'], output.res['sept_spending'], output.res['oct_spending'], output.res['nov_spending'], output.res['dec_spending']]
						  ]
						}, {
						  fullWidth: true,
						  chartPadding: {
							right: 40
						  },
						  plugins: [
							Chartist.plugins.tooltip()
						  ]
						});
					}
					else{
						alert('alert');
					}
				}
			});
    });
});



  var chart = new Chartist.Line('#smil-animations', {
  labels: ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12'],
  series: [
    [12, 9, 7, 8, 5, 4, 6, 2, 3, 3, 4, 6],
    [4,  5, 3, 7, 3, 5, 5, 3, 4, 4, 5, 5],
    [5,  3, 4, 5, 6, 3, 3, 4, 5, 6, 3, 4],
    [3,  4, 5, 6, 7, 6, 4, 5, 6, 7, 6, 3]
  ]
}, {
  low: 0,
  plugins: [
    Chartist.plugins.tooltip()
  ]
});

// Let's put a sequence number aside so we can use it in the event callbacks
var seq = 0,
  delays = 80,
  durations = 500;

// Once the chart is fully created we reset the sequence
chart.on('created', function() {
  seq = 0;
});

// On each drawn element by Chartist we use the Chartist.Svg API to trigger SMIL animations
chart.on('draw', function(data) {
  seq++;

  if(data.type === 'line') {
    // If the drawn element is a line we do a simple opacity fade in. This could also be achieved using CSS3 animations.
    data.element.animate({
      opacity: {
        // The delay when we like to start the animation
        begin: seq * delays + 1000,
        // Duration of the animation
        dur: durations,
        // The value where the animation should start
        from: 0,
        // The value where it should end
        to: 1
      }
    });
  } else if(data.type === 'label' && data.axis === 'x') {
    data.element.animate({
      y: {
        begin: seq * delays,
        dur: durations,
        from: data.y + 100,
        to: data.y,
        // We can specify an easing function from Chartist.Svg.Easing
        easing: 'easeOutQuart'
      }
    });
  } else if(data.type === 'label' && data.axis === 'y') {
    data.element.animate({
      x: {
        begin: seq * delays,
        dur: durations,
        from: data.x - 100,
        to: data.x,
        easing: 'easeOutQuart'
      }
    });
  } else if(data.type === 'point') {
    data.element.animate({
      x1: {
        begin: seq * delays,
        dur: durations,
        from: data.x - 10,
        to: data.x,
        easing: 'easeOutQuart'
      },
      x2: {
        begin: seq * delays,
        dur: durations,
        from: data.x - 10,
        to: data.x,
        easing: 'easeOutQuart'
      },
      opacity: {
        begin: seq * delays,
        dur: durations,
        from: 0,
        to: 1,
        easing: 'easeOutQuart'
      }
    });
  } else if(data.type === 'grid') {
    // Using data.axis we get x or y which we can use to construct our animation definition objects
    var pos1Animation = {
      begin: seq * delays,
      dur: durations,
      from: data[data.axis.units.pos + '1'] - 30,
      to: data[data.axis.units.pos + '1'],
      easing: 'easeOutQuart'
    };

    var pos2Animation = {
      begin: seq * delays,
      dur: durations,
      from: data[data.axis.units.pos + '2'] - 100,
      to: data[data.axis.units.pos + '2'],
      easing: 'easeOutQuart'
    };

    var animations = {};
    animations[data.axis.units.pos + '1'] = pos1Animation;
    animations[data.axis.units.pos + '2'] = pos2Animation;
    animations['opacity'] = {
      begin: seq * delays,
      dur: durations,
      from: 0,
      to: 1,
      easing: 'easeOutQuart'
    };

    data.element.animate(animations);
  }
});

// For the sake of the example we update the chart every time it's created with a delay of 10 seconds
chart.on('created', function() {
  if(window.__exampleAnimateTimeout) {
    clearTimeout(window.__exampleAnimateTimeout);
    window.__exampleAnimateTimeout = null;
  }
  window.__exampleAnimateTimeout = setTimeout(chart.update.bind(chart), 12000);
});



//Simple line chart
new Chartist.Line('#total_profit_chart', {
  labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'July', 'Aug', 'Sept', 'Oct', 'Nov', 'Dec'],
  series: [
    [jan, feb, mar, apr, may, jun, jul, aug, sept, oct, nov, dec]
  ]
}, {
  fullWidth: true,
  chartPadding: {
    right: 40
  },
  plugins: [
    Chartist.plugins.tooltip()
  ]
});

//Simple line chart
new Chartist.Line('#total_spending_chart', {
  labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'July', 'Aug', 'Sept', 'Oct', 'Nov', 'Dec'],
  series: [
    [jan_spending, feb_spending, mar_spending, apr_spending, may_spending, jun_spending, jul_spending, aug_spending, sept_spending, oct_spending, nov_spending, dec_spending]
  ]
}, {
  fullWidth: true,
  chartPadding: {
    right: 40
  },
  plugins: [
    Chartist.plugins.tooltip()
  ]
});




//Line Scatter Diagram
var times = function(n) {
  return Array.apply(null, new Array(n));
};

var data = times(52).map(Math.random).reduce(function(data, rnd, index) {
  data.labels.push(index + 1);
  data.series.forEach(function(series) {
    series.push(Math.random() * 100)
  });

  return data;
}, {
  labels: [],
  series: times(4).map(function() { return new Array() })
});

var options = {
  showLine: false,
  axisX: {
    labelInterpolationFnc: function(value, index) {
      return index % 13 === 0 ? 'W' + value : null;
    }
  }
};

var responsiveOptions = [
  ['screen and (min-width: 640px)', {
    axisX: {
      labelInterpolationFnc: function(value, index) {
        return index % 4 === 0 ? 'W' + value : null;
      }
    }
  }]
];

new Chartist.Line('#scatter-diagram', data, options, responsiveOptions);





//Line chart with tooltips

new Chartist.Line('#line-chart-tooltips', {
  labels: ['1', '2', '3', '4', '5', '6'],
  series: [
    {
      name: 'Fibonacci sequence',
      data: [1, 2, 3, 5, 8, 13]
    },
    {
      name: 'Golden section',
      data: [1, 1.618, 2.618, 4.236, 6.854, 11.09]
    }
  ]
},
    {
  plugins: [
    Chartist.plugins.tooltip()
  ]
}
);

var $chart = $('#line-chart-tooltips');

var $toolTip = $chart
  .append('<div class="tooltip"></div>')
  .find('.tooltip')
  .hide();

$chart.on('mouseenter', '.ct-point', function() {
  var $point = $(this),
    value = $point.attr('ct:value'),
    seriesName = $point.parent().attr('ct:series-name');
  $toolTip.html(seriesName + '<br>' + value).show();
});

$chart.on('mouseleave', '.ct-point', function() {
  $toolTip.hide();
});

$chart.on('mousemove', function(event) {
  $toolTip.css({
    left: (event.offsetX || event.originalEvent.layerX) - $toolTip.width() / 2 - 10,
    top: (event.offsetY || event.originalEvent.layerY) - $toolTip.height() - 40
  });
});




//Line chart with area

new Chartist.Line('#chart-with-area', {
  labels: [1, 2, 3, 4, 5, 6, 7, 8],
  series: [
    [5, 9, 7, 8, 5, 3, 5, 4]
  ]
}, {
  low: 0,
  showArea: true,
  plugins: [
    Chartist.plugins.tooltip()
  ]
});


//Bi-polar Line chart with area only

new Chartist.Line('#bi-polar-line', {
  labels: [1, 2, 3, 4, 5, 6, 7, 8],
  series: [
    [1, 2, 3, 1, -2, 0, 1, 0],
    [-2, -1, -2, -1, -2.5, -1, -2, -1],
    [0, 0, 0, 1, 2, 2.5, 2, 1],
    [2.5, 2, 1, 0.5, 1, 0.5, -1, -2.5]
  ]
}, {
  high: 3,
  low: -3,
  showArea: true,
  showLine: false,
  showPoint: false,
  fullWidth: true,
  axisX: {
    showLabel: false,
    showGrid: false
  },
  plugins: [
    Chartist.plugins.tooltip()
  ]
});





//SVG Path animation

var chart = new Chartist.Line('#svg-animation', {
  labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
  series: [
    [1, 5, 2, 5, 4, 3],
    [2, 3, 4, 8, 1, 2],
    [5, 4, 3, 2, 1, 0.5]
  ]
}, {
  low: 0,
  showArea: true,
  showPoint: false,
  fullWidth: true
});

chart.on('draw', function(data) {
  if(data.type === 'line' || data.type === 'area') {
    data.element.animate({
      d: {
        begin: 2000 * data.index,
        dur: 2000,
        from: data.path.clone().scale(1, 0).translate(0, data.chartRect.height()).stringify(),
        to: data.path.clone().stringify(),
        easing: Chartist.Svg.Easing.easeOutQuint
      }
    });
  }
});





//Line Interpolation / Smoothing

var chart = new Chartist.Line('#line-smoothing', {
  labels: [1, 2, 3, 4, 5],
  series: [
    [1, 5, 10, 0, 1],
    [10, 15, 0, 1, 2]
  ]
}, {
  // Remove this configuration to see that chart rendered with cardinal spline interpolation
  // Sometimes, on large jumps in data values, it's better to use simple smoothing.
  lineSmooth: Chartist.Interpolation.simple({
    divisor: 2
  }),
  fullWidth: true,
  chartPadding: {
    right: 20
  },
  low: 0,
  plugins: [
    Chartist.plugins.tooltip()
  ]
});





//Bi-polar bar chart

var data = {
  labels: ['W1', 'W2', 'W3', 'W4', 'W5', 'W6', 'W7', 'W8', 'W9', 'W10'],
  series: [
    [1, 2, 4, 8, 6, -2, -1, -4, -6, -2]
  ]
};

var options = {
  high: 10,
  low: -10,
  axisX: {
    labelInterpolationFnc: function(value, index) {
      return index % 2 === 0 ? value : null;
    }
  },
  plugins: [
    Chartist.plugins.tooltip()
  ]
};

new Chartist.Bar('#bi-polar-bar', data, options);




//Overlapping bars on mobile

var data = {
  labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mai', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
  series: [
    [5, 4, 3, 7, 5, 10, 3, 4, 8, 10, 6, 8],
    [3, 2, 9, 5, 4, 6, 4, 6, 7, 8, 7, 4]
  ]
};

var options = {
  seriesBarDistance: 10
};

var responsiveOptions = [
  ['screen and (max-width: 640px)', {
    seriesBarDistance: 5,
    axisX: {
      labelInterpolationFnc: function (value) {
        return value[0];
      }
    }
  }]
];

new Chartist.Bar('#overlapping-bars', data, options, responsiveOptions);





//Multi-line labels

new Chartist.Bar('#multi-line-chart', {
  labels: ['First quarter of the year', 'Second quarter of the year', 'Third quarter of the year', 'Fourth quarter of the year'],
  series: [
    [60000, 40000, 80000, 70000],
    [40000, 30000, 70000, 65000],
    [8000, 3000, 10000, 6000]
  ]
}, {
  seriesBarDistance: 10,
  axisX: {
    offset: 60
  },
  axisY: {
    offset: 80,
    labelInterpolationFnc: function(value) {
      return value + ' CHF'
    },
    scaleMinSpace: 15
  },
  plugins: [
    Chartist.plugins.tooltip()
  ]
});




//Stacked bar chart dishit

new Chartist.Bar('#outstanding_revenue_chart', {
  labels: ['Q1', 'Q2'],
  series: [
    [outstanding_total_amount],
    [overdue_total_amount]
  ]
}, {
  stackBars: true,
  reverseData: true,
  horizontalBars: true,
  plugins: [
    Chartist.plugins.tooltip()
  ]
}).on('draw', function(data) {
  if(data.type === 'bar') {
    data.element.attr({
      style: 'stroke-width: 30px'
    });
  }
});

//Stacked bar chart

new Chartist.Bar('#stacked-bar-chart', {
  labels: ['Q1', 'Q2', 'Q3', 'Q4'],
  series: [
    [800000, 1200000, 1400000, 1300000],
    [200000, 400000, 500000, 300000],
    [160000, 290000, 410000, 600000]
  ]
}, {
  stackBars: true,
  axisY: {
    labelInterpolationFnc: function(value) {
      return (value / 1000) + 'k';
    }
  },
  plugins: [
    Chartist.plugins.tooltip()
  ]
}).on('draw', function(data) {
  if(data.type === 'bar') {
    data.element.attr({
      style: 'stroke-width: 30px'
    });
  }
});






//Horizontal bar chart

new Chartist.Bar('#horizontal-bar-chart', {
  labels: ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'],
  series: [
    [5, 4, 3, 7, 5, 10, 3],
    [3, 2, 9, 5, 4, 6, 4]
  ]
}, {
  seriesBarDistance: 10,
  reverseData: true,
  horizontalBars: true,
  axisY: {
    offset: 70
  },
  plugins: [
    Chartist.plugins.tooltip()
  ]
});





// Extreme responsive configuration

new Chartist.Bar('#extreme-chart', {
  labels: ['Quarter 1', 'Quarter 2', 'Quarter 3', 'Quarter 4'],
  series: [
    [5, 4, 3, 7],
    [3, 2, 9, 5],
    [1, 5, 8, 4],
    [2, 3, 4, 6],
    [4, 1, 2, 1]
  ]
}, {
  // Default mobile configuration
  stackBars: true,
  axisX: {
    labelInterpolationFnc: function(value) {
      return value.split(/\s+/).map(function(word) {
        return word[0];
      }).join('');
    }
  },
  axisY: {
    offset: 20
  },
  plugins: [
    Chartist.plugins.tooltip()
  ]
}, [
  // Options override for media > 400px
  ['screen and (min-width: 400px)', {
    reverseData: true,
    horizontalBars: true,
    axisX: {
      labelInterpolationFnc: Chartist.noop
    },
    axisY: {
      offset: 60
    }
  }],
  // Options override for media > 800px
  ['screen and (min-width: 800px)', {
    stackBars: false,
    seriesBarDistance: 10
  }],
  // Options override for media > 1000px
  ['screen and (min-width: 1000px)', {
    reverseData: false,
    horizontalBars: false,
    seriesBarDistance: 15
  }]
]);




//Distributed series

new Chartist.Bar('#distributed-series', {
  labels: ['XS', 'S', 'M', 'L', 'XL', 'XXL', 'XXXL'],
  series: [20, 60, 120, 200, 180, 20, 10]
}, {
  distributeSeries: true,
  plugins: [
    Chartist.plugins.tooltip()
  ]
});



//Label placement

new Chartist.Bar('#label-placement-chart', {
  labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
  series: [
    [5, 4, 3, 7, 5, 10, 3],
    [3, 2, 9, 5, 4, 6, 4]
  ]
}, {
  axisX: {
    // On the x-axis start means top and end means bottom
    position: 'start'
  },
  axisY: {
    // On the y-axis start means left and end means right
    position: 'end'
  },
  plugins: [
    Chartist.plugins.tooltip()
  ]
});




//Animating a Donut with Svg.animate

var chart = new Chartist.Pie('#animating-donut', {
  series: [10, 20, 50, 20, 5, 50, 15],
  labels: [1, 2, 3, 4, 5, 6, 7]
}, {
  donut: true,
  showLabel: false,
  plugins: [
    Chartist.plugins.tooltip()
  ]
});

chart.on('draw', function(data) {
  if(data.type === 'slice') {
    // Get the total path length in order to use for dash array animation
    var pathLength = data.element._node.getTotalLength();

    // Set a dasharray that matches the path length as prerequisite to animate dashoffset
    data.element.attr({
      'stroke-dasharray': pathLength + 'px ' + pathLength + 'px'
    });

    // Create animation definition while also assigning an ID to the animation for later sync usage
    var animationDefinition = {
      'stroke-dashoffset': {
        id: 'anim' + data.index,
        dur: 1000,
        from: -pathLength + 'px',
        to:  '0px',
        easing: Chartist.Svg.Easing.easeOutQuint,
        // We need to use `fill: 'freeze'` otherwise our animation will fall back to initial (not visible)
        fill: 'freeze'
      }
    };

    // If this was not the first slice, we need to time the animation so that it uses the end sync event of the previous animation
    if(data.index !== 0) {
      animationDefinition['stroke-dashoffset'].begin = 'anim' + (data.index - 1) + '.end';
    }

    // We need to set an initial value before the animation starts as we are not in guided mode which would do that for us
    data.element.attr({
      'stroke-dashoffset': -pathLength + 'px'
    });

    // We can't use guided mode as the animations need to rely on setting begin manually
    // See http://gionkunz.github.io/chartist-js/api-documentation.html#chartistsvg-function-animate
    data.element.animate(animationDefinition, false);
  }
});

// For the sake of the example we update the chart every time it's created with a delay of 8 seconds
chart.on('created', function() {
  if(window.__anim21278907124) {
    clearTimeout(window.__anim21278907124);
    window.__anim21278907124 = null;
  }
  window.__anim21278907124 = setTimeout(chart.update.bind(chart), 10000);
});




//Simple pie chart

var data = {
  series: [5, 3, 4]
};

var sum = function(a, b) { return a + b };

new Chartist.Pie('#simple-pie', data, {
  labelInterpolationFnc: function(value) {
    return Math.round(value / data.series.reduce(sum) * 100) + '%';
  }
});

//Simple pie chart spending_by_category_chart_2 dishit

	var u = JSON.parse(categories_spend);
		var dt = new Array();
		var i = 0;
		var rr = '';
		for(var key in u) {
			//dt = dt + u[key] + ',';
			dt[i] = u[key];
			rr = rr + u[key] + ',';
			i++;
		}	
		console.log("dixdg: " + dt);
		var yu = rr.replace(/,\s*$/, "");
	var array = yu.split(',');
	
		
var data = {
  series: [285,100]
};

var sum = function(a, b) { return a + b };
//alert(sum);
new Chartist.Pie('#spending_by_category_chart_2--', data, {
  labelInterpolationFnc: function(value) {
    return Math.round(value / data.series.reduce(sum) * 100) + '%';
  }
});




//Pie chart with custom labels
var u = JSON.parse(categories_spend);
		var dt = new Array();
		var i = 0;
		var rr = '';
		var ro = '';
		for(var key in u) {
			//dt = dt + u[key] + ',';
			dt[i] = u[key];
			rr = rr + u[key] + ',';
			ro = ro + '"'+ key + '",';
			i++;
		}	
		console.log("dixdg: " + dt);
		var yu = rr.replace(/,\s*$/, "");
		var yo = ro.replace(/,\s*$/, "");
	var array = yu.split(',');
	var arrayo = yo.split(',');



var data = {
  labels: arrayo,
  series: array
};

var options = {
  labelInterpolationFnc: function(value) {
    return value[0]
  }
};

var responsiveOptions = [
  ['screen and (min-width: 640px)', {
    chartPadding: 30,
    labelOffset: 100,
    labelDirection: 'explode',
    labelInterpolationFnc: function(value) {
      return value;
    }
  }],
  ['screen and (min-width: 1024px)', {
    labelOffset: 80,
    chartPadding: 20
  }]
];

new Chartist.Pie('#spending_by_category_chart_2', data, options, responsiveOptions);



//Gauge chart

new Chartist.Pie('#gauge-chart', {
  series: [20, 10, 30, 40]
}, {
  donut: true,
  donutWidth: 60,
  startAngle: 270,
  total: 200,
  showLabel: false,
  plugins: [
    Chartist.plugins.tooltip()
  ]
});





// Different configuration for different series

var chart = new Chartist.Line('#different-series', {
  labels: ['1', '2', '3', '4', '5', '6', '7', '8'],
  // Naming the series with the series object array notation
  series: [{
    name: 'series-1',
    data: [5, 2, -4, 2, 0, -2, 5, -3]
  }, {
    name: 'series-2',
    data: [4, 3, 5, 3, 1, 3, 6, 4]
  }, {
    name: 'series-3',
    data: [2, 4, 3, 1, 4, 5, 3, 2]
  }]
}, {
  fullWidth: true,
  // Within the series options you can use the series names
  // to specify configuration that will only be used for the
  // specific series.
  series: {
    'series-1': {
      lineSmooth: Chartist.Interpolation.step()
    },
    'series-2': {
      lineSmooth: Chartist.Interpolation.simple(),
      showArea: true
    },
    'series-3': {
      showPoint: false
    }
  },
  plugins: [
    Chartist.plugins.tooltip()
  ]
}, [
  // You can even use responsive configuration overrides to
  // customize your series configuration even further!
  ['screen and (max-width: 320px)', {
    series: {
      'series-1': {
        lineSmooth: Chartist.Interpolation.none()
      },
      'series-2': {
        lineSmooth: Chartist.Interpolation.none(),
        showArea: false
      },
      'series-3': {
        lineSmooth: Chartist.Interpolation.none(),
        showPoint: true
      }
    }
  }]
]);




//SVG Animations chart

var chart = new Chartist.Line('#svg-dot-animation', {
  labels: ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12'],
  series: [
    [12, 4, 2, 8, 5, 4, 6, 2, 3, 3, 4, 6],
    [4, 8, 9, 3, 7, 2, 10, 5, 8, 1, 7, 10]
  ]
}, {
  low: 0,
  showLine: false,
  axisX: {
    showLabel: false,
    offset: 0
  },
  axisY: {
    showLabel: false,
    offset: 0
  },
  plugins: [
    Chartist.plugins.tooltip()
  ]
});

// Let's put a sequence number aside so we can use it in the event callbacks
var seq = 0;

// Once the chart is fully created we reset the sequence
chart.on('created', function() {
  seq = 0;
});

// On each drawn element by Chartist we use the Chartist.Svg API to trigger SMIL animations
chart.on('draw', function(data) {
  if(data.type === 'point') {
    // If the drawn element is a line we do a simple opacity fade in. This could also be achieved using CSS3 animations.
    data.element.animate({
      opacity: {
        // The delay when we like to start the animation
        begin: seq++ * 80,
        // Duration of the animation
        dur: 500,
        // The value where the animation should start
        from: 0,
        // The value where it should end
        to: 1
      },
      x1: {
        begin: seq++ * 80,
        dur: 500,
        from: data.x - 100,
        to: data.x,
        // You can specify an easing function name or use easing functions from Chartist.Svg.Easing directly
        easing: Chartist.Svg.Easing.easeOutQuart
      }
    });
  }
});

// For the sake of the example we update the chart every time it's created with a delay of 8 seconds
chart.on('created', function() {
  if(window.__anim0987432598723) {
    clearTimeout(window.__anim0987432598723);
    window.__anim0987432598723 = null;
  }
  window.__anim0987432598723 = setTimeout(chart.update.bind(chart), 8000);
});



/* Dishit Trial for chartist end*/


function goBack() {
    window.history.back();
}
		!function(jQuery) {
    "use strict";

    var MorrisCharts = function() {};

    //creates line chart
    MorrisCharts.prototype.createLineChart = function(element, data, xkey, ykeys, labels, opacity, Pfillcolor, Pstockcolor, lineColors, xLabelFormat) {
        Morris.Line({
          element: element,
          data: data,
          xkey: xkey,
          ykeys: ykeys,
          labels: labels,
          fillOpacity: opacity,
          pointFillColors: Pfillcolor,
          pointStrokeColors: Pstockcolor,
          behaveLikeLine: true,
          gridLineColor: '#eef0f2',
          hideHover: 'auto',
          lineWidth: '3px',
          pointSize: 0,
          preUnits: '$ ',
          resize: true, //defaulted to true
          lineColors: lineColors
        });
    },
    //creates Bar chart
    MorrisCharts.prototype.createBarChart  = function(element, data, xkey, ykeys, labels, lineColors) {
        Morris.Bar({
            element: element,
            data: data,
            xkey: xkey,
            ykeys: ykeys,
            labels: labels,
            hideHover: 'auto',
            resize: true, //defaulted to true
            gridLineColor: '#eeeeee',
            barSizeRatio: 0.4,
            barColors: lineColors
        });
    },
    
    //creates Donut chart
    MorrisCharts.prototype.createDonutChart = function(element, data, colors) {
        Morris.Donut({
            element: element,
            data: data,
            resize: true, //defaulted to true
            colors: colors
        });
    },
    MorrisCharts.prototype.init = function() {

 
 /* Dishit try */
 /* var months = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];

		Morris.Line({
		  element: 'total_profit_chart',
		  data: [{
			m: '2015-01', 
			a: 0
		  }, {
			m: '2015-02',
			a: 54
		  }, {
			m: '2015-03',
			a: 243
		  }, {
			m: '2015-04',
			a: 206
		  }, {
			m: '2015-05',
			a: 161
		  }, {
			m: '2015-06',
			a: 187
		  }, {
			m: '2015-07',
			a: 210
		  }, {
			m: '2015-08',
			a: 204
		  }, {
			m: '2015-09',
			a: 224
		  }, {
			m: '2015-10',
			a: 301
		  }, {
			m: '2015-11',
			a: 262
		  }, {
			m: '2015-12',
			a: 199
		  }, ],
		  xkey: 'm',
		  ykeys: ['a'],
		  labels: ['2015'],
		  xLabelFormat: function(x) { 
			var month = months[x.getMonth()];
			return month;
		  },
		  dateFormat: function(x) {
			var month = months[new Date(x).getMonth()];
			return month;
		  },
		});
 
 
 
 Morris.Line({
		  element: 'total_spending_chart',
		  data: [{
			m: '2015-01', // <-- valid timestamp strings
			a: 0
		  }, {
			m: '2015-02',
			a: 54
		  }, {
			m: '2015-03',
			a: 243
		  }, {
			m: '2015-04',
			a: 206
		  }, {
			m: '2015-05',
			a: 161
		  }, {
			m: '2015-06',
			a: 187
		  }, {
			m: '2015-07',
			a: 210
		  }, {
			m: '2015-08',
			a: 204
		  }, {
			m: '2015-09',
			a: 224
		  }, {
			m: '2015-10',
			a: 301
		  }, {
			m: '2015-11',
			a: 262
		  }, {
			m: '2015-12',
			a: 199
		  }, ],
		  xkey: 'm',
		  ykeys: ['a'],
		  labels: ['2015'],
		  xLabelFormat: function(x) { 
			var month = months[x.getMonth()];
			return month;
		  },
		  dateFormat: function(x) {
			var month = months[new Date(x).getMonth()];
			return month;
		  },
		});
		 */
		
		
		var dt = "";
		var u = JSON.parse(categories_spend);
		//console.log("u:: " + u);
		//alert(u);
		
		for(var key in u) {
			dt = dt + '{"label":"'+ key + '","value":' + u[key] + '},';
		}
		
		/* var yy = JSON.parse(dt);
		console.log("dt:: " + yy); */
		 
		var yu = dt.replace(/,\s*$/, "");
		var array = yu.split(','); 
		//alert(array);
		//console.log("dishit: " + JSON.parse('{"label":"Expence Category 1","value": 285}'));
		
		 Morris.Donut({
		  element: 'spending_by_category_chart',
		  data: array,
		  colors: ['#ff8acc', '#5b69bc', "#35b8e0"]
		});
 /* Dishit try end*/

     
        //creating bar chart
        var $barData  = [
            { y: '2009', a: 100, b: 90 , c: 40 },
            { y: '2010', a: 75,  b: 65 , c: 20 },
            { y: '2011', a: 50,  b: 40 , c: 50 },
            { y: '2012', a: 75,  b: 65 , c: 95 },
            { y: '2013', a: 50,  b: 40 , c: 22 },
            { y: '2014', a: 75,  b: 65 , c: 56 },
            { y: '2015', a: 100, b: 90 , c: 60 }
        ];
        this.createBarChart('morris-bar-example', $barData, 'y', ['a', 'b', 'c'], ['Series A', 'Series B', 'Series C'], ['#ff8acc', '#5b69bc', "#35b8e0"]);
    },
    //init
    $.MorrisCharts = new MorrisCharts, $.MorrisCharts.Constructor = MorrisCharts
}(window.jQuery),

//initializing 
jQuery(document).ready(function(){
	
	var min = new Date().getFullYear(),
    max = (min - 9),
    select = document.getElementById('total_profit_year');

	for (var i = min; i<=max; i++){
		var opt = document.createElement('option');
		alert(opt);
		opt.value = i;
		opt.innerHTML = i;
		select.appendChild(opt);
	}
	//alert();
	
    jQuery.MorrisCharts.init();
});