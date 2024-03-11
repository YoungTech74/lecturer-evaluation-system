<?php
 $db = mysqli_connect('localhost', 'root', '', 'lecturer_eva_db');
 
$eva_array = array();
$count = 0;
$getchart = mysqli_query($db, "SELECT * FROM chart ORDER BY name DESC");

while($row = mysqli_fetch_assoc($getchart)){
    $eva_array[$count]["label"] = $row['name'];
    $eva_array[$count]["y"] = $row['percentile'];
    $count = $count + 1;
}
 
?>
<!DOCTYPE HTML>
<html>
<head>  
<script>
window.onload = function () {
 
var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	exportEnabled: true,
	theme: "light1", // "light1", "light2", "dark1", "dark2"
	title:{
		text: "Lecture Evaluation Matrix"
	},
	axisY:{
		title: "Percentile (%)"
	},
	data: [{
		type: "column", //change type to bar, line, area, pie, etc
		//indexLabel: "{y}", //Shows y value on all Data Points
		indexLabelFontColor: "#5A5757",
		indexLabelPlacement: "outside",   
		dataPoints: <?php echo json_encode($eva_array, JSON_NUMERIC_CHECK); ?>
	}]
});
chart.render();
 
}
</script>
</head>
<body>
<div id="chartContainer" style="height: 370px; width: 100%;"></div>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
</body>
</html>     