<!DOCTYPE html>
<html lang="en">
	
<?php
session_start();




require_once 'functions.php';
require_once 'connections.php';

$signature = $_POST["signature"];
$data = $_POST["data"];
//Anton $public_key = 'i69930799562';
//Anton $private_key = 'rRZfFUKEnYTzXG0pgadJRKCdiQr9OAeW0au5gtAH';
$sign = base64_encode(sha1($private_key.$data.$private_key, 1));

$data_result = base64_decode($data);
$date = date("Y-m-d H:i:s");



if(strcasecmp($sign, $signature) == 0){	
	file_put_contents("callback.txt", $date."-".$data_result."\r\n", FILE_APPEND);

}else{
	file_put_contents("callback.txt", $date." - error not valid signiture\r\n", FILE_APPEND);
	exit();
//$data_result = '{"action":"pay","payment_id":607630372,"status":"sandbox","version":3,"type":"buy","paytype":"card","public_key":"i61109306451","acq_id":414963,"order_id":"1516975132-1","liqpay_order_id":"R6NJITGQ1516975155706917","description":"Оплата за поліс 1516975132-1","sender_first_name":"Irina","sender_last_name":"Konstantinova","sender_card_mask2":"516875*62","sender_card_bank":"pb","sender_card_type":"mc","sender_card_country":804,"ip":"5.254.65.189","amount":551.76,"currency":"UAH","sender_commission":0.0,"receiver_commission":15.17,"agent_commission":0.0,"amount_debit":551.76,"amount_credit":551.76,"commission_debit":0.0,"commission_credit":15.17,"currency_debit":"UAH","currency_credit":"UAH","sender_bonus":0.0,"amount_bonus":0.0,"mpi_eci":"7","is_3ds":false,"create_date":1516975154300,"end_date":1516975155744,"transaction_id":607630372}';
}



$array = json_decode($data_result, true);
$status = $array["status"];
$transaction_id = $array["transaction_id"];
$order_id = $array["order_id"];

//апдейтим статус полиса в БД
$result = "UPDATE `aaapolis` SET `oplata`= '$status',`transaction_id`= '$transaction_id' WHERE nomer_polisa = '$order_id'";

mysqli_query($link, $result);
//echo '$result '.$result;

if(strcasecmp($status, "sandbox") == 0) {
	
	$polis_array = get_polis($order_id, $link); //формируем массив с данными полиса
	$clients_array = get_clients($order_id, $link); // формируем массив с данными клиентов
	$tesseract_array = get_tesseract_clients($order_id, $link); // формируем массив с распознанными данными

//print_r($polis_array);
/*
echo "<hr>";
echo "clients_array ";
print_r($clients_array);

echo "<hr>";

echo "tesseract_array ";
print_r($tesseract_array);
echo "<hr>";
*/
//$result=array_intersect($clients_array[0],$tesseract_array[0]);
//print_r($result);


//Устанавливаем сессию чтобы можно генерировать на основании её скачивание полисов


$_SESSION['downloadnum'] = $array["order_id"];

// генерим вывод полиса
 	require_once 'make_pdf.php';
}
else{
	file_put_contents("callback.txt", $date." -  ".$status."\r\n", FILE_APPEND);
 	exit();	
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
// В этом разделе проходим по клиентам и генерим новый вид массивов $names, $sirnames, $birthday, $passports. Можно было бы и не делать, а
// перебирать и сравнивать по ключу массив тессеракта и клиентов, но лень переписывать.
			  $names = array_column($clients_array, 'name');
			  $sirnames = array_column($clients_array, 'sirname');
			  $birthday = array_column($clients_array, 'date_birth');
			  $passports = array_column($clients_array, 'passport');
			  $j = array_column($clients_array, 'j');
			  $newclients=[];
				
			// приделываем к $j поочередно каждое выдранное из массива клиентов
				foreach ($j as $key => $value){
				$newclients+=array($value => array($names[$key], $sirnames[$key], $birthday[$key], $passports[$key]));
				}
/*					
echo "<hr>";
echo "newclients ";
print_r($newclients);
echo "<hr>";
*/
//////////////////////////////////////////////////////////////////////////////////////
// Аналогично проделываем с массивом распозанного, но тут без $i никак, т.к. этот параметр вводится на этапе проверки страхчек
			  $tessnames = array_column($tesseract_array, 'passname');
			  $tessssirnames = array_column($tesseract_array, 'passsirname');
			  $tessbirthday = array_column($tesseract_array, 'pass_birth');
			  $tesspassports = array_column($tesseract_array, 'passsernumb');
			  $i = array_column($tesseract_array, 'i');
			  
			  
			  $tesseractclients = [];
					foreach ($i as $key => $value){
					$tesseractclients += array($value => array($tessnames[$key], $tessssirnames[$key], $tessbirthday[$key], $tesspassports[$key]));
					}
				
/*echo "<hr>";
echo "tesseractclients ";
print_r($tesseractclients);
echo "<hr>";
*/
///////////////////////////////////////////////////////////////////////////////////////

?>

<head>
	<meta charset="UTF-8">
	<title>Ваша страховка</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css'/>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link rel="stylesheet" href="../travel/css/travel.css">
</head>

<body>



			<div id='ex1' class='container modal'>
				<div class="row">

		      <div class='col-md-8 offset-md-2 position-order'>
		      	<div class="col-md-12">
		      		<div class="col-md-12 maininfostrah table-info">
		      			<h1>Данные страхового полиса</h1>
		      			<div class="email-address">
		      				<p class="col-md-6">Ваш полис отправлен по адресу:</p><input class="col-md-6" value ="<?php echo $clients_array['0']['email'] ?>" disabled>
		      			</div>
		      			<div class="cont-telephone">
		      				<p class="col-md-6">Контактный телефон: </p><input class="col-md-6" value ="<?php echo $clients_array['0']['phone']?>" disabled>
		      			</div>
		      			<div class="download-polis">
		      				<p class="col-md-6">Скачать полис</p><a class="col-md-6" href="download.php?download=<?php echo $array["order_id"] ?>" target = "_blank"> <?php echo $array["order_id"] ?> </a>
		      			</div>
		      		</div>
		      	</div>
		      	<div class="col-md-12 maininfostrahall">
			  <?php
//начинается треш. Берем новосозданный массив массивов $newclients и начинаем работать с каждым
foreach ($newclients as $key => $value){
	$result=array_diff($value,$tesseractclients[$key]); // сравниваем перебираемый массив с аналогичным в тесеракте по ключу.
	
	$chek = array_diff($newclients[1],$newclients[0]); // эта проверка нужна если страхователь и застрахованный одно лицо.
			
			 
	$strah = ($key == 0)?"страхователя":"застрахованного лица $key";
	if (empty($chek) && $key == 0) 
			{
				$strah = "страхователя / застрахованного лица 1";
				
			}
	
	
/*
	echo "<hr>";
	echo "value, key -> $key ---> ";
	print_r($value);
	echo "<hr>";
	
	echo "<hr>";
	echo "tesseractclients key -> $key ----> ";
	print_r($tesseractclients[$key]);
	echo "<hr>";
	
	echo "<hr>";
	echo "result ";
	print_r($result);
*/
// Ну тут все понятно. Если пустой массив result и такой же тессеракт, потом ничего не выводим, если совпало страхователь и застрахованный.
	if (empty($result) && empty($tesseractclients[$key]) ) {
		
				if (count($chek)== 0 && $key == 1)
				{
					echo "<div>";
					//echo "<h2 id = 'strah'>Данные ".$strah. "</h2>";
					//echo "<p>Система не смогла count($chek)== 0 && $key == 1</p>";
				}
				else
				{
					echo "<div class='col-md-12 infostrahall table-danger'>";
					echo "<h2 id = 'strah'>Данные ".$strah. "</h2>";
					echo "<p>Система не смогла проверить правильность введеных данных т.к. не были вложены файлы.</p>";
				}
				
				
				/*
				echo "<hr>";
				echo '$key '.$key."<br>";
				print_r($newclients);
				echo "<br>";
				print_r($newclients[$key]);
				echo "<br>";
				print_r($newclients[$key-1]);
				echo '$key '.$key."<br>";
				$aaaaa = array_diff($newclients[$key],$newclients[$key-1]);
				//if (empty($aaaaa)) echo "empty";
				if (empty(array_diff($newclients[$key],$newclients[$key-1]))) echo "empty";
				echo "<hr>";
				*/
				echo "</div>";
		//	}

		
	}
	// Если резултат пустой и не пустой перебираемый массив тесеракта, то ок.
	else if (empty($result) && !empty($tesseractclients[$key])){
			echo "<div class='col-md-12 infostrahall table-success'>";
			echo "<h2>Данные ".$strah. "</h2>";
			echo "<p>Система проверила правильность введеных данных, всё ОК.</p>";
			echo "</div>";
	}
	// Начинаем перебор того, что не совпадает.
	else {
			
	echo "<div class='col-md-12 infostrahall table-warning'>";
	echo "<h2>Данные ".$strah. "</h2>";
	echo "<p>Система распозанала данные, проверьте нет ли ошибки</p>";

	//Проходим по массиву $result, который из себя представляет разницу в массивах
		foreach ($result as $kye => $valuee)
		{
			//здесь мы дошли до подстановки 4-х вариантов.
				switch ($kye){
				case 0:
				$field = "Имя";
				break;
				case 1:
				$field = "Фамилия";
				break;
				case 2:
				$field = "Дата рождения";
				break;
				case 3:
				$field = "Номер паспорта";
				break;
				}
				
				//Генерим вывод, проходим по всем ключам распознанного
				$teseractout = (empty($tesseractclients[$key][$kye]))?"'не распознала :с'":$tesseractclients[$key][$kye];
														//field зависит от ключа, valuee - это значение распознанного в в массиве result
				echo "<div class='col-md-8 er-info'><h4>".$field.": </h4><br>".$valuee."<p>распознало как:</p></div>";
				echo "<div class='col-md-4 er-info'><input value = ".$teseractout." disabled></div>";
			
			 
	
		}
	echo "</div>";
	}
		
			
}
/* Какая-то отладочная херня
$chek = array_diff($newclients[1],$newclients[0]);
			if (empty($chek)) 
			{
				echo "<script>document.getElementById('strah').innerHTML = 'страхователя/застрахованного лица 1' ;</script>";
			}
			else echo "<script>console.log('not empty');</script>";
*/
			  

			  ?>

			</div>
			<div class="button-group">
				<button class="btn btn-primary closebutton"><a href='/'>Закрыть</a></button>
			</div>
			</div>
			</div>

		</div>
			
			
			

			<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0/jquery.min.js'></script>

			<!-- jQuery Modal -->
			<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js'></script>

			<!-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
			<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
			<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script> -->
			<script>
				$('#ex1').modal('show');
				$('#ex1').modal({showClose: false},'show');
				
				// $('.jquery-modal').click(function(){
				//  location.href = "/";
				// });
				
			</script>

	</body>
</html>