<?php 
require_once 'connections.php';
use Dompdf\Dompdf;

function make_pdf($text){
	require_once 'dompdf-master/autoload.inc.php';
	// instantiate and use the dompdf class
	$dompdf = new Dompdf();
	$dompdf->loadHtml($text);
	
	// (Optional) Setup the paper size and orientation
	//$dompdf->setPaper('a6', 'landscape');
	
	// Render the HTML as PDF
	$dompdf->render();
	
	// Output the generated PDF to Browser
	
	$dompdf->stream("hello.pdf");
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

function get_var() {
	$super_array = [];
	$var_array = [];
	$strah_array = [];
	$person1_array = [];
	$person2_array = [];
	$person3_array = [];
	$person4_array = [];
	$tourists = $_POST['tourists'];
	$Kter = $_POST['Kter_post'];
	$Kfr = $_POST['Kfr'];
	$Kpr = $_POST['Kpr'];

	$strah_flag = $_POST['strah_flag'];

	//$var_array['days'] = round(abs(strtotime($_POST['dateStart'])-strtotime($_POST['dateStop_php']))/60/60/24+1);

	$var_array['days'] = $_POST['days_php'];
	
///Функция переводит дату вида 25.01.2018 в формат mysql 2018-01-25 и присваивает её той переменной ,что и вызвала её
	function mysqldate($convtomysql)
	{
		$dd = substr($convtomysql,0,2);// выбирает с 0 позиции 2 следующих символа
		$mm = substr($convtomysql,3,2);
		$yy = substr($convtomysql,6,strlen($convtomysql));
		
	
		$convtomysql = substr($convtomysql,6,strlen($convtomysql))."-".substr($convtomysql,3,2)."-".substr($convtomysql,0,2);
		return $convtomysql;
	
	}
	
	
	
	//$var_array['dateStart'] = $_POST['dateStart'];
	$var_array['dateStart'] = mysqldate($_POST['dateStart']);
	
	//$var_array['dateStop'] = mysqldate($_POST['dateStop_php']);
	$var_array['dateStop'] = mysqldate($_POST['dateStop']);


	switch ($Kfr) {
		case 1:
			$var_array['Kfr_name'] = 0;
			break;
		case 0.95:
			$var_array['Kfr_name'] = 50;
			break;
		case 0.85:
			$var_array['Kfr_name'] = 100;
			break;
		case 0.8:
			$var_array['Kfr_name'] = 150;
			break;
		case 0.75:
			$var_array['Kfr_name'] = 200;
			break;
		case 0.7:
			$var_array['Kfr_name'] = 250;
			break;
	}
	if ($Kter == 1) {
		$var_array['Kter_name'] = "EUROPE";
	}elseif ($var_array['Kter'] == 1.5) {
		$var_array['Kter_name'] = "WORLDWIDE";
	}else{
		$var_array['Kter_name'] = "WORLDWIDE*";
	}
	switch ($Kpr) {
		case 1:
			$var_array['Kpr_name'] = "А (Standart)";
			break;
		case 1.38:
			$var_array['Kpr_name'] = "В (Business)";
			break;
		case 1.9:
			$var_array['Kpr_name'] = "С (Comfort)";
			break;
		case 3:
			$var_array['Kpr_name'] = "E (Elite)";
			break;
	}
	$var_array['insSum'] = $_POST['insSum'];
	$var_array['insCur'] = $_POST['insCur'];
	if (isset($_POST['SSnv_php'])) {
		$var_array['SSnv'] = $_POST['SSnv_php'];		
	}else{
		$var_array['SSnv'] = "";
	}
	$var_array['oplata'] = 0;
 	$var_array['liqpay_transaction'] = "";
 	if (isset($_POST['tariff'])) {
		$var_array['tariff'] = $_POST['tariff'];		
	}else{
		$var_array['tariff'] = "";
	}
	if (isset($_POST['sales'])) {
		$var_array['sales'] = $_POST['sales'];		
	}else{
		$var_array['sales'] = "";
	}

	$var_array['SPzag'] = $_POST['SPzag'];

	if ($_POST['SPnv'] == 0) {
		$var_array['SPnv'] = "";
	}else{
		$var_array['SPnv'] = $_POST['SPnv'];
	}
	$var_array['SPtr'] = $_POST['SPtr'];
	

 	//Персональні данні страхувальника
 	$strah_array['email'] = test_input($_POST['email_strah']);
	$strah_array['name'] = test_input($_POST['name_strah']);
	$strah_array['surname'] = test_input($_POST['surname_strah']);
	$strah_array['tel'] = test_input($_POST['tel_strah']);
	//$strah_array['birth_date'] = $_POST['date_strah'];
	$strah_array['birth_date'] = mysqldate($_POST['date_strah']);
	$strah_array['pass'] = test_input($_POST['pass_strah']);
	$strah_array['inn'] = test_input($_POST['inn_strah']);
	
				if (isset($_POST['nonrezidentstrah'])) 
				{
					//$strah_array['nonrezident']= test_input($_POST['nonrezidentstrah']);
					$strah_array['nonrezident']= "no_ukr";
				} 
				else 
				{
					$strah_array['nonrezident'] = "ukr";
				}
				
				
	//Персональні данні 1-ї застрахованої особи 
	if ($strah_flag == 0) {
		$person1_array['email'] = "";
		$person1_array['name'] = $strah_array['name'];
		$person1_array['surname'] = $strah_array['surname'];
		$person1_array['tel'] = "";
		$person1_array['birth_date'] = $strah_array['birth_date'];
		$person1_array['pass'] = $strah_array['pass'];
		$person1_array['inn'] = $strah_array['inn'];
			if (isset($strah_array['nonrezident'])) 
			{	
				$person1_array['nonrezident'] = $strah_array['nonrezident'];
			} 
				
	}else{
		$person1_array['email'] = "";
		if (isset($_POST['name1'])) {
			$person1_array['name'] = test_input($_POST['name1']);
		}
		if (isset($_POST['surname1'])) {
			$person1_array['surname'] = test_input($_POST['surname1']);
		}
		$person1_array['tel'] = "";
		if (isset($_POST['date1'])) {
			//$person1_array['birth_date'] = test_input($_POST['date1']);
			$person1_array['birth_date'] = test_input(mysqldate($_POST['date1']));
		}
		if (isset($_POST['pass1'])) {
			$person1_array['pass'] = test_input($_POST['pass1']);
		}
		if (isset($_POST['inn1'])) {
			$person1_array['inn'] = test_input($_POST['inn1']);
		}
			if (isset($_POST['nonrezident1'])) 
			{
				// $person1_array['nonrezident'] = test_input($_POST['nonrezident1']);
				$person1_array['nonrezident'] = "no_ukr";
			}
			else $person1_array['nonrezident'] = "ukr";
			
	}		
	//Персональні данні 2-ї застрахованої особи 
	if (!empty($_POST['name2'])) {
		$person2_array['email'] = "";
		$person2_array['name'] = test_input($_POST['name2']);
	}
	if (!empty($_POST['surname2'])) {
		$person2_array['surname'] = test_input($_POST['surname2']);
		$person2_array['tel'] = "";
	}
	if (!empty($_POST['date2'])) {
		$person2_array['birth_date'] = test_input(mysqldate($_POST['date2']));
	}
	if (!empty($_POST['pass2'])) {
		$person2_array['pass'] = test_input($_POST['pass2']);
	}
	if (!empty($_POST['inn2'])) {
		$person2_array['inn'] = test_input($_POST['inn2']);
	}

		if (isset($_POST['nonrezident2'])) 
		{
			//$person2_array['nonrezident'] = test_input($_POST['nonrezident2']);
			$person2_array['nonrezident'] = "no_ukr";
		}
		else $person2_array['nonrezident'] = "ukr";

	//Персональні данні 3-ї застрахованої особи 
	if (!empty($_POST['name3'])) {
		$person3_array['email'] = "";
		$person3_array['name'] = test_input($_POST['name3']);		
	}
	if (!empty($_POST['surname3'])) {
		$person3_array['surname'] = test_input($_POST['surname3']);
		$person3_array['tel'] = "";
	}
	if (!empty($_POST['date3'])) {
		$person3_array['birth_date'] = test_input(mysqldate($_POST['date3']));
	}
	if (!empty($_POST['pass3'])) {
		$person3_array['pass'] = test_input($_POST['pass3']);
	}
	if (!empty($_POST['inn3'])) {
		$person3_array['inn'] = test_input($_POST['inn3']);
	}

		if (isset($_POST['nonrezident3'])) 
		{
			//$person3_array['nonrezident'] = test_input($_POST['nonrezident3']);
			$person3_array['nonrezident'] = "no_ukr";
		}
			else $person3_array['nonrezident'] = "ukr";
			
	//Персональні данні 4-ї застрахованої особи 
	if (!empty($_POST['name4'])) {
		$person4_array['email'] = "";
		$person4_array['name'] = test_input($_POST['name4']);	
	}
	if (!empty($_POST['surname4'])) {
		$person4_array['surname'] = test_input($_POST['surname4']);
		$person4_array['tel'] = "";
	}
	if (!empty($_POST['date4'])) {
		$person4_array['birth_date'] = test_input(mysqldate($_POST['date4']));
	}
	if (!empty($_POST['pass4'])) {
		$person4_array['pass'] = test_input($_POST['pass4']);
	}
	if (!empty($_POST['inn4'])) {
		$person4_array['inn'] = test_input($_POST['inn4']);
	}
		if (isset($_POST['nonrezident4'])) 
		{
			// $person4_array['nonrezident'] = test_input($_POST['nonrezident4']);
			$person4_array['nonrezident'] = "no_ukr";
		}
		else $person4_array['nonrezident'] = "ukr";
		
/////////////////////////////////////////////////////////	
	if(!empty($var_array)){
		$super_array['var_array'] = $var_array;
	}
	if(!empty($strah_array['name'])){
		$super_array['strah_array'] = $strah_array;
	}
	if(!empty($person1_array['name'])){
		$super_array['person1_array'] = $person1_array;
	}
	if(!empty($person2_array['name'])){
		$super_array['person2_array'] = $person2_array;
	}
	if(!empty($person3_array['name'])){
		$super_array['person3_array'] = $person3_array;
	}
	if(!empty($person4_array['name'])){
		$super_array['person4_array'] = $person4_array;
	}
	return $super_array;
}
/*$qwe = get_var();
print_r($qwe);
echo"<hr> vyvod $qwe[1] <hr><br>";
print_r($qwe[2]);
echo "<br><hr>";*/
 

 
 
function new_insert($qwe, $nomerpolisa, $linkmysql) {
//qwe это массив $var_array
    $date = date("Y-m-d H:i:s");
	$j=0; 
	
	if(isset($_POST['post_rex'])){
	
	}
	
	
	foreach ($qwe as $key => $value) {
		
	
		if(strcasecmp($key, "var_array") == 0){
			$result = "INSERT INTO `aaapolis`(`nomer_polisa`, `days`, `dateStart`, `dateStop`, `franshiza`, `terittory`, `type`, `sum_complex`, `currency`, `sum_accident`, `oplata`, `transaction_id`, `tariff`, `sales`, `SPzag`, `SPnv`, `SPtr`, `date_zapisi_polisa`) VALUES (";
			$result .="'$nomerpolisa'".",";

			foreach($qwe[$key] as $row){
				$row = mysqli_real_escape_string($linkmysql, $row); 
	      		$result .=  "'$row'".",";
			}  
			$result .="'$date'".")";
		
		}
		
		else
		{
			
			
			
				$result = "INSERT INTO `aaaclients`(`nomerpolisa`, `j`, `email`, `name`, `sirname`, `phone`, `date_birth`, `passport`, `inn`, `nonrezident`, `date_zapisi`) VALUES (";
				//$result .="'$nomerpolisa'".",";
				$result .="'$nomerpolisa'".","."'$j'".",";
	
				foreach($qwe[$key] as $row)
				{
					$row = mysqli_real_escape_string($linkmysql,strtoupper($row)); 
					$result .=  "'$row'".",";
				}  
	
				$result .="'$date'".")";         
				$j++;
				
	 	}


				echo $result;
			 	mysqli_query($linkmysql, $result);
	}			
}		

function get_polis($order_id, $linkmysql) {
	$result = "SELECT * FROM `aaapolis` WHERE nomer_polisa = '$order_id'";
	$sql =  mysqli_query($linkmysql, $result);
	while ($row_user = mysqli_fetch_array($sql ,MYSQLI_ASSOC)){
    	$polis_array[] = $row_user;
    }
    return $polis_array;
	
}	
function get_clients($order_id, $linkmysql) {
	$result = "SELECT * FROM `aaaclients` WHERE nomerpolisa = '$order_id'";
	$sql = mysqli_query($linkmysql, $result);

	while ($row_user = mysqli_fetch_array($sql, MYSQLI_ASSOC)){
    	$clients_array[] = $row_user;
		
    }
    //echo '$result '.$result;
	return $clients_array;
}
////////////////////////////////////////////////////
//Выдираем распознанное тессерактом в массив
function get_tesseract_clients($order_id, $linkmysql) {
	$result = "SELECT * FROM `aaateseract` WHERE orderid = '$order_id'";
	$sql = mysqli_query($linkmysql, $result);

	while ($row_user = mysqli_fetch_array($sql, MYSQLI_ASSOC)){
    	$tesseract_array[] = $row_user;
		
    }
    //echo '$result '.$result;
	return $tesseract_array;
}



////////////////////////////////////////////////////////
// Функция разворачивалка картинок если стоит аттрибут ориентации 		
			function image_fix_orientation($filename) {
				$exif = exif_read_data($filename);
				if (!empty($exif['Orientation']) && $exif['Orientation']!="1") {
					
					$image = imagecreatefromjpeg($filename);
					switch ($exif['Orientation']) {
						case 3:
							$image = imagerotate($image, 180, 0);
							break;
			
						case 6:
							$image = imagerotate($image, -90, 0);
							break;
			
						case 8:
							$image = imagerotate($image, 90, 0);
							break;
					}
			
					imagejpeg($image, $filename);
				}
			}
//////////////////////////////////////////////////////////////////////////////////

	function kossfiles($orderid, $linkinfo)
	{
		$dateonly = date("Y-m-d");
		$i=0;
			foreach ($_FILES['pictures']['name'] as $key => $valuez)
			{
				
				if (!empty($valuez))
				{
					echo '$i -->'.$i."<br>";
					echo '$key '.$key.' $valuez '.$valuez. "<br>";
					
					$target_dir = "tesseract/uploads/$dateonly/";
					if (!is_dir($target_dir)) mkdir("$target_dir"); //делаем директорию с сегодняшней датой если нет
					
					$temp = explode(".", $_FILES["pictures"]["name"]["$key"]); // выдираем расширение
					$newfilename = $orderid ."-".$key. '.' . end($temp);
					
					// echo $target_dir. $newfilename;
					
					
					$target_file = $target_dir . basename($_FILES["pictures"]["name"]["$key"]);
					
					$uploadOk = 1;
					$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
					// Check if image file is a actual image or fake image
					if(isset($_POST["submit"])) {
					$check = getimagesize($_FILES["pictures"]["tmp_name"]["$key"]);
						if($check !== false) 
							{
								echo "File is an image - " . $check["mime"] . ".";
								$uploadOk = 1;
							} 
						else 
							{
							echo "File is not an image.";
							$uploadOk = 0;
							}
					}
					// Check if file already exists
					if (file_exists($target_file)) {
						echo "Sorry, file already exists.";
						$uploadOk = 0;
					}
					// Check file size
					if ($_FILES["pictures"]["size"]["$key"] > 3000000) {
						echo "Sorry, your file is too large.";
						$uploadOk = 0;
					}
					// Allow certain file formats
					if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
					&& $imageFileType != "gif" ) {
						echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
						$uploadOk = 0;
						}
						// Check if $uploadOk is set to 0 by an error
						if ($uploadOk == 0) {
							echo "Sorry, your file was not uploaded.";
						// if everything is ok, try to upload file
						} 
						else 
						{
							if (move_uploaded_file($_FILES["pictures"]["tmp_name"]["$key"], $target_dir . $newfilename)) 
							{
							echo "The file ". basename( $_FILES["pictures"]["name"]["$key"]). " has been uploaded.";
							} 
							else 
							{
								echo "Sorry, there was an error uploading your file.";
							}
						}
					//Делаем путь к файлу чтобы скормить его тесеракту
					$torecognise = $target_dir . $newfilename;
				
					// балуемся с выводом аттрибутов картинок
					$exif = exif_read_data($torecognise);
					//print_r($exif);
					echo $exif['Orientation'];
				
					// прогоняем картинку через функцию чтобы если стоит аттрибут поворота, то повернуло б
					image_fix_orientation($torecognise);
					
					//Передаем файл в тессеракт что распознать и кого распознаем
					tesseract($torecognise, $i, $linkinfo);
				}
				if(isset($_POST["strah_check"]) && $i == 1) ++$i;
				else $i++;
			}
			
	}



?>