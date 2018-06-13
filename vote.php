<!DOCTYPE html>
<html>
<head>
 <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    
</head>
<body>

<?php 



$servername = "localhost";
$username = "root";
$password = "";
$dbname = "voteform";

$countCar = 0;
$countBike = 0;
$coutPublictransport = 0;
$coutMotobike = 0;
$countWalk = 0;

$conn = new mysqli($servername, $username, $password, $dbname);




if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql="SELECT option1,option2,option3,option4,option5 from voteinfo";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
   
    while($row = $result->fetch_assoc()) {
         
          $countCar = $row["option1"];
    	$countBike	= $row["option2"];
    	 	$coutPublictransport= $row["option3"];
    	 	$coutMotobike	= $row["option4"];
    	 		$countWalk	= $row["option5"];
    }
} else {
    echo "0 results";
}





$info = $_GET["radio"];
$count;


	$agree=$_GET["agree"];
	    
	    $result=$_GET["radio"];
	if($agree == false)
	echo "You need accept agreements!";
	else
	{
	
	echo "<h2>You voted for ".$result."</h2>";



if($info == "Car")
{
$countCar++;
$sql2 = "UPDATE voteinfo SET option1=$countCar";
if ($conn->query($sql2) === TRUE) {
  
} else {
    echo "Error updating record: " . $conn->error;
}




}
if($info == "Bike")
{

$countBike++;
$sql2 = "UPDATE voteinfo SET option2=$countBike";
if ($conn->query($sql2) === TRUE) {
   
} else {
    echo "Error updating record: " . $conn->error;
}



}

if($info == "Public Transpor")
{
echo "AHOJ";
$coutPublictransport++;
$sql2 = "UPDATE voteinfo SET option3=$coutPublictransport";
if ($conn->query($sql2) === TRUE) {
   
} else {
    echo "Error updating record: " . $conn->error;
}



}

if($info == "Motorbike")
{

$coutMotobike++;
$sql2 = "UPDATE voteinfo SET option4=$coutMotobike";
if ($conn->query($sql2) === TRUE) {
   
} else {
    echo "Error updating record: " . $conn->error;
}


}
if($info == "Walk")
{


$countWalk++;
$sql2 = "UPDATE voteinfo SET option5=$countWalk";
if ($conn->query($sql2) === TRUE) {
    
} else {
    echo "Error updating record: " . $conn->error;
}




}
}




?>
 <div id="piechart"></div>
</body>


 <script type="text/javascript">
	

 var countcarnumber = <?php Print($countCar); ?>;
  var countbikenumber = <?php Print($countBike); ?>;
   var countpublicnumber = <?php Print($coutPublictransport); ?>;
    var countmotobikenumber = <?php Print($coutMotobike); ?>;
     var countwalknumber = <?php Print($countWalk); ?>;

// Load google charts
google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(drawChart);

// Draw the chart and set the chart values
function drawChart() {
  var data = google.visualization.arrayToDataTable([
  ['Task', 'Hours per Day'],
  ['Car', countcarnumber],
  ['Bike', countbikenumber],
  ['Public Transport',countpublicnumber],
  ['Motorbike', countmotobikenumber],
  ['Walk', countwalknumber],

]);

  // Optional; add a title and set the width and height of the chart
  var options = {'title':'Voting results', 'width':550, 'height':400};

  // Display the chart inside the <div> element with id="piechart"
  var chart = new google.visualization.PieChart(document.getElementById('piechart'));
  chart.draw(data, options);
}




	 </script>
</html>