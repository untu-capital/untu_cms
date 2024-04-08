$(".dial1").knob();
$({animatedVal: 0}).animate({animatedVal: 80}, {
	duration: 3000,
	easing: "swing",
	step: function() {
		$(".dial1").val(Math.ceil(this.animatedVal)).trigger("change");
	}
});

$(".dial2").knob();
$({animatedVal: 0}).animate({animatedVal: 70}, {
	duration: 3000,
	easing: "swing",
	step: function() {
		$(".dial2").val(Math.ceil(this.animatedVal)).trigger("change");
	}
});

$(".dial3").knob();
$({animatedVal: 0}).animate({animatedVal: 90}, {
	duration: 3000,
	easing: "swing",
	step: function() {
		$(".dial3").val(Math.ceil(this.animatedVal)).trigger("change");
	}
});

$(".dial4").knob();
$({animatedVal: 0}).animate({animatedVal: 65}, {
	duration: 3000,
	easing: "swing",
	step: function() {
		$(".dial4").val(Math.ceil(this.animatedVal)).trigger("change");
	}
});
// map
jQuery('#browservisit').vectorMap({
	map: 'world_mill_en',
	backgroundColor: '#fff',
	borderWidth: 1,
	zoomOnScroll : false,
	color: '#ddd',
	regionStyle: {
		initial: {
			fill: '#fff'
		}
	},
	enableZoom: true,
	normalizeFunction: 'linear',
	showTooltip: true
});
// chart
Highcharts.chart('chart', {
	chart: {
		type: 'line'
	},
	title: {
		text: ''
	},
	xAxis: {
		categories: [
			'Jan',
			'Feb',
			'Mar',
			'Apr',
			'May',
			'Jun',
			'Jul',
			'Aug',
			'Sep',
			'Oct',
			'Nov',
			'Dec'
		],
		labels: {
			style: {
				color: '#1b00ff',
				fontSize: '12px',
			}
		}
	},
	yAxis: {
		labels: {
			formatter: function () {
				return this.value;
			},
			style: {
				color: '#1b00ff',
				fontSize: '14px'
			}
		},
		title: {
			text: ''
		},
	},
	credits: {
		enabled: false
	},
	tooltip: {
		crosshairs: true,
		shared: true
	},
	plotOptions: {
		spline: {
			marker: {
				radius: 10,
				lineColor: '#1b00ff',
				lineWidth: 2
			}
		}
	},
	legend: {
		align: 'center',
		x: 0,
		y: 0
	},
	series: [
	// 	{
	// 	name: 'HarareA',
	// 	color: '#00789c',
	// 	marker: {
	// 		symbol: 'circle'
	// 	},
	// 	data: [0, 10, 5, 30, 40, 20, 10, 0, 10, 5, 30, 40]
	// },
	// {
	// 	name: 'Harare',
	// 	color: '#236adc',
	// 	marker: {
	// 		symbol: 'circle'
	// 	},
	// 	data: [40, 20, 10, 40, 15, 15, 20, 40, 20, 10, 40, 15]
	// },
	{
		name: 'Bulawayo',
		color: '#ff686b',
		marker: {
			symbol: 'circle'
		},
		data: [0, 15, 5, 30, 40, 30, 28, 0, 15, 5, 30, 40]
	}
	// {
	// 	name: 'Gweru',
	// 	color: '#264653',
	// 	marker: {
	// 		symbol: 'circle'
	// 	},
	// 	data: [35, 25, 10, 40, 15, 5, 38, 35, 25, 10, 40, 15]
	// },
	// {
	// 	name: 'Gokwe',
	// 	color: '#4cb848',
	// 	marker: {
	// 		symbol: 'circle'
	// 	},
	// 	data: [15, 35, 20, 30, 25, 15, 28, 15, 35, 20, 30, 25]
	// }

	]
});
//Complience chart
Highcharts.chart('compliance-trend', {
	chart: {
		type: 'column'
	},
	colors: ['#0051bd', '#00eccf', '#d11372'],
	title: {
		text: ''
	},
	credits: {
		enabled: false
	},
	xAxis: {
		categories: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October'],
		crosshair: true,
		lineWidth:1,
		lineColor: '#979797',
		labels: {
			style: {
				fontSize: '10px',
				color: '#5a5a5a'
			}
		},
	},
	yAxis: {
		min: 0,
		max: 100,
		gridLineWidth: 0,
		lineWidth:1,
		lineColor: '#979797',
		title: {
			text: ''
		},
		stackLabels: {
			enabled: false,
			style: {
				fontWeight: 'bold',
				color: (Highcharts.theme && Highcharts.theme.textColor) || 'gray'
			}
		}
	},
	legend: {
		enabled: true
	},
	tooltip: {
		headerFormat: '<b>{point.x}</b><br/>',
		pointFormat: '{series.name}: {point.y}'
	},
	plotOptions: {
		column: {
			stacking: 'normal',
			dataLabels: {
				enabled: false,
				color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'white'
			},
			borderWidth: 0
		}
	},
	series: [{
		name: 'Receipts',
		maxPointWidth: 10,
		data: [50, 30, 40, 70, 20, 50, 30, 40, 70, 20,]
	 },
		// {
	// 	name: 'Warning',
	// 	maxPointWidth: 10,
	// 	data: [0, 0, 0, 0, 0, 0, 0, 0, 0, 0,]
	// },
		{
		name: 'Payments',
		maxPointWidth: 10,
		data: [50, 50, 30, 10, 70, 1, 40, 20, 20, 60,]
	}]
});


// chart 2
$.getJSON(
	'https://cdn.rawgit.com/highcharts/highcharts/057b672172ccc6c08fe7dbb27fc17ebca3f5b770/samples/data/usdeur.json',
	function (data) {

		Highcharts.chart('chart2', {
			chart: {
				zoomType: 'x'
			},
			title: {
				text: 'USD to EUR exchange rate over time'
			},
			subtitle: {
				text: document.ontouchstart === undefined ?
					'Click and drag in the plot area to zoom in' : 'Pinch the chart to zoom in'
			},
			xAxis: {
				type: 'datetime'
			},
			yAxis: {
				title: {
					text: 'Exchange rate'
				}
			},
			legend: {
				enabled: false
			},
			plotOptions: {
				area: {
					fillColor: {
						linearGradient: {
							x1: 0,
							y1: 0,
							x2: 0,
							y2: 1
						},
						stops: [
							[0, Highcharts.getOptions().colors[0]],
							[1, Highcharts.Color(Highcharts.getOptions().colors[0]).setOpacity(0).get('rgba')]
						]
					},
					marker: {
						radius: 2
					},
					lineWidth: 1,
					states: {
						hover: {
							lineWidth: 1
						}
					},
					threshold: null
				}
			},

			series: [{
				type: 'area',
				name: 'USD to EUR',
				data: data
			}]
		});


	}
);

// equality chart

Highcharts.chart('eqaulity-chart', {
	title: {
		text: 'Pie point CSS'
	},
	xAxis: {
		categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
	},
	series: [{
		type: 'pie',
		allowPointSelect: true,
		keys: ['name', 'y', 'selected', 'sliced'],
		data: [
			['Apples', 29.9, false],
			['Pears', 71.5, false],
			['Oranges', 106.4, false],
			['Plums', 129.2, false],
			['Bananas', 144.0, false],
			['Peaches', 176.0, false],
			['Prunes', 135.6, true, true],
			['Avocados', 148.5, false]
		],
		showInLegend: true
	}]
});