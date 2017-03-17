var xhrRequest = function() {

	this.getChartData = function(createTime, callback) {
		$.ajax({
			url : '../get-chart-data?createTime=' + createTime,
			dataType : 'json',
			success : function(data) {
				callback(data);
			}
		});
	}

	this.getChartsList = function(callback) {
		$.ajax({
			url : '../get-charts-list',
			dataType : 'json',
			success : function(data) {
				callback(data);
			}
		});
	}
}

var chartLoad = function() {
	var option = {
		title : {
			text : '健康状况',
			subtext : ''
		},
		tooltip : {
			trigger : 'axis'
		},
		legend : {
			data : []
		},
		toolbox : {
			show : true,
			feature : {
				mark : {
					show : true
				},
				magicType : {
					show : true,
					type : [ 'line', 'bar' ]
				},
				restore : {
					show : true
				},
			}
		},
		calculable : true,
		xAxis : [ {
			type : 'category',
			boundaryGap : true,
			show : false,
			data : []
		} ],
		yAxis : [ {
			type : 'value',
			axisLabel : {
				formatter : '{value}/min'
			}
		} ],
		series : [ {
			name : '',
			type : 'line',
			smooth : true,
			data : [],
			markPoint : {
				data : [ {
					type : 'max',
					name : '最大值'
				}, {
					type : 'min',
					name : '最小值'
				} ]
			},
			markLine : {
				data : [ {
					type : 'average',
					name : ''
				} ]
			},
			symbol : 'none',
			itemStyle : {
				normal : {
					color : 'green',
					lineStyle : {
						width : 2,
						type : 'solid'
					}
				},
			},
		} ],
	};

	this.init = function() {
		require.config({
			paths : {
				'echarts' : 'http://echarts.baidu.com/build/dist',
				'echarts/theme/macarons' : 'http://echarts.baidu.com/doc/example/theme/macarons.js'
			}
		});
	}

	this.createChart = function(data, dataType) {
		data = data['data'];
		data.pop();
		var type = (dataType == 1) ? '心率' : '脉搏';
		var average = 0;
		var max = 0;
		var min = 500;
		option.title.subtext = type;
		option.legend.data = [ type ];
		option.series[0].name = type;
		option.series[0].markLine.data[0].name = '平均' + type;
		// 清空数组
		option.xAxis[0].data.length = 0;
		option.series[0].data.length = 0;
		$.each(data, function(index, element) {
			element = parseInt(element);
			if (max < element) {
				max = element;
			}
			if (element < min) {
				min = element;
			}
			average += element;
			option.xAxis[0].data.push('');
			option.series[0].data.push(element);
		});
		option.yAxis[0].min = min - 30;
		option.yAxis[0].max = max + 30;
		average /= data.length;
		if (average < 120) {
			option.series[0].itemStyle.normal.color = 'blue';
		} else if (average >= 120 && average < 150) {
			option.series[0].itemStyle.normal.color = '#79FF79';
		} else if (average >= 150 && average < 180) {
			option.series[0].itemStyle.normal.color = 'orange';
		} else {
			option.series[0].itemStyle.normal.color = 'red';
		}
		require([ 'echarts', 'echarts/theme/macarons', 'echarts/chart/line',
				'echarts/chart/bar' ], function(ec, theme) {
			var myChart = ec.init(document.getElementById('main'), theme);
			myChart.setOption(option);
		});
	}
}

var actionHandler = function(Request, Chart) {
	var requestCreator = Request;
	var chartCreator = Chart;
	/*
	 * 'heartbeat' : jsonObj 'create_time' 创建时间 'data_time' 数据收集时间 'pulse' :
	 * jsonObj 'create_time' 创建时间 'data_time' 数据收集时间
	 */
	var chartsListPackage;

	this.init = function() {
		requestCreator.getChartsList(function(chartsList) {
			chartsListPackage = chartsList;
			$('#type').change(function() {
				selectType($('#type').val());
			});
			$('#time').change(function() {
				selectTime($('#time').val(), $('#type').val());
			});
		});
	}

	var selectType = function(type) {
		var select = $('#time');
		select.empty();
		select.append("<option>收集时间</option>");
		if (type == 1) {
			$.each(chartsListPackage.heartbeat, function(index, time) {
				var Y = time.data_time.substring(0, 4) + '.';
               	 		var Mon = time.data_time.substring(4, 6) + '.';
                		var D = time.data_time.substring(6, 8) + '  ';
               			var H = time.data_time.substring(8, 10) + ':';
                		var Min = time.data_time.substring(10, 12);
                		var date = Y + Mon + D + H + Min;
				select.append("<option value='" + time.create_time + "'>" + date + "</option>");
			});
		} else {
			$.each(chartsListPackage.pulse, function(index, time) {
                        	var Y = time.data_time.substring(0, 4) + '.';
                        	var Mon = time.data_time.substring(4, 6) + '.';
                        	var D = time.data_time.substring(6, 8) + '  ';
                        	var H = time.data_time.substring(8, 10) + ':';
                        	var Min = time.data_time.substring(10, 12);
                        	var date = Y + Mon + D + H + Min;
				select.append("<option value='" + time.create_time + "'>"+ date + "</option>");
			});
		}
	}

	var selectTime = function(create_time, data_type) {
		requestCreator.getChartData(create_time, function(data) {
			chartCreator.createChart(data, data_type);
		});
	}
}

window.onload = function() {
	var LoadChart = new chartLoad();
	LoadChart.init();
	var Request = new xhrRequest();
	var Handler = new actionHandler(Request, LoadChart);
	Handler.init();
}
