<?php
   include_once './if_not_login.php';
   include_once '../connection.php';
   include_once './header.php'; 
   include_once './navbar.php'; 
   include_once './sidebar.php'; 

$eva_array = array();
$count = 0;
$getchart = mysqli_query($conn, "SELECT * FROM lecturers_reports WHERE level = '$_SESSION[level]' ORDER BY l_name DESC");

while($row = mysqli_fetch_assoc($getchart)){
    $eva_array[$count]["label"] = $row['l_name'];
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
	theme: "light1", 
	title:{
		text: "Lecture Evaluation Matrix"
	},
	axisY:{
		title: "Percentile (%)"
	},
	axisX:{
		title: "Lecturers Name"
	},
	data: [{
		type: "line", 
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
<div id="chartContainer" style="height: 370px; width: 80%; float: right;"></div>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>

<?php 
        include_once './include/js_libraries.php';
        include_once 'footer.php';
   ?>
</body>
</html>     