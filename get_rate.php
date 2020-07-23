<?php 
require_once 'connections.php';
$dateonly = date("Y-m-d");
$query = "SELECT * FROM `aaagetrate` WHERE ratedate = '$dateonly'";
$result = mysqli_query($link, $query);
$numrows=mysqli_num_rows($result);

if($numrows!=0 )

    {
	//echo '$numrows '.$numrows. ' $query '.$query;
    //echo "<table id='my-table'> <thead><tr><th>id</th><th>Login</th><th>Pass</th><th>Rights</th><th>Fio</th><th>Position</th><th class='tabledit-toolbox-column'></th></tr></thead>";
    while($row=mysqli_fetch_assoc($result))
    //echo '$row'.$row;
    {
    	
		$eur = $row["rateeur"];
    	$usd = $row["rateusd"];
		//echo '$eur '.$eur.' $usd '.$usd." <----> ";
    }
    
  }
  else {
 
 echo "0 results";
	 


//$currency = $_POST['qwe'];
$url = "https://bank.gov.ua/NBUStatService/v1/statdirectory/exchange?json";
//  Initiate curl
$ch = curl_init();
// Disable SSL verification
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
// Will return the response, if false it print the response
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
// Set the url
curl_setopt($ch, CURLOPT_URL, $url);
// Execute
$result = curl_exec($ch);

// Closing
curl_close($ch);
$array = json_decode($result, true);

$array_USD_EUR = ["USD" => "", "EUR" => ""];

foreach ($array as $array_id) {
	foreach ($array_id as $key => $value) {
		if ($key == "r030" && $value == 840) {
			$array_USD_EUR["USD"] = $array_id["rate"];
		}
		if ($key == "r030" && $value == 978) {
			$array_USD_EUR["EUR"] = $array_id["rate"];
		}
	}	
}

$eur = $array_USD_EUR["EUR"];
$usd = $array_USD_EUR["USD"];

$query2 = "INSERT INTO `aaagetrate`(`ratedate`, `rateusd`, `rateeur`) VALUES ('$dateonly', '$usd', '$eur')";

mysqli_query($link, $query2);
//echo $query2;

}
//echo $query;
//echo(json_encode($array_USD_EUR));
//echo $array_USD_EUR["EUR"].";".$array_USD_EUR["USD"];
echo $eur.";".$usd;
//print_r($array_USD_EUR);
?>