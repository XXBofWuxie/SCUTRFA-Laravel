<!DOCTYPE html>
<head>
<meta charset="utf-8">
<title>ECharts</title>
</head>
<body>
	<div>
        	<p>
        		请选择数据类型
        		<select id="type">
        			<option value="0">数据类型</option>
        			<option value="1">心电</option>
        			<option value="2">脉搏</option>
        		</select>
        	</p>
        	<p>
        		请选择数据收集时间
        		<select id="time">
        			<option>收集时间</option>
        		</select>
        	</p>
	</div>
	<!-- 为ECharts准备一个具备大小（宽高）的Dom -->
	<div id="main" style="height: 600px; width: 90%"></div>
	<!-- ECharts单文件引入 -->
	<script src="http://echarts.baidu.com/build/dist/echarts.js"></script>
	<script src="http://code.jquery.com/jquery-latest.js"></script>
	<script src="{{ URL::asset('js/showcharts.js') }}"></script>
</body>
