<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/../vendor/autoload.php';
//require_once $_SERVER['DOCUMENT_ROOT'].'/sites/all/modules/travel/functions.php';
//$datetime = date("Y-m-d H:i:s");
$dateonly = date("Y-m-d");
//$orderid=time()."-".rand(1, 9);
//echo $dateonly;


//tesseract($torecognise);

//начинаем распознавать 
use thiagoalessio\TesseractOCR\TesseractOCR;
			
	function tesseract($torecognise, $i, $linkmysql){
				
			$text = (new TesseractOCR("$torecognise"))
				->whitelist(range('A', 'Z'), range(0, 9),'<')
				->run();

				
//////////KOSSTERACT//////////////////////////////////////////////////////			
			
			//записываем распознанное с таким же именем как и файл + кого распознали
			$pattern = "/.jpeg|.png|.jpg|.gif/i";
			$replacement = "";
			$txt = preg_replace($pattern, $replacement, $torecognise).".txt";;
			
			file_put_contents($txt, $text, FILE_APPEND);
			
		
			//$regexp = '/^P<[A-Z]{3}([A-Z-]+)<{2}([A-Z-]+)/m';
			$regexpsirname = '/^(?:P<[A-Z]{3})([A-Z]+)<{2}(?:[A-Z-]+)</m';
			$regexpnames = '/^(?:P<[A-Z]{3}).+<{2}([A-Z-]+)</m';
			
			$passsirnames = array();
			echo "<hr>";
			if (preg_match($regexpsirname, $text, $passsirnames))
				{
				echo $passsirnames[1]." <- Sirname";
				}
			//	print_r($passsirnames);
				
			echo "<hr>";
	
				$regexpnames = '/^(?:P<[A-Z]{3}).+<{2}([A-Z-]+)</m';
			
			$passnames = array();
			
			if (preg_match($regexpnames, $text, $passnames))
				{
				echo $passnames[1]." <- Name";
				}
			//		print_r($passnames);
				
			echo "<hr>";
			
			
			///////////////////////////////////////////////////////////
			//$regexppasdate = '/(^[A-Z0-9]{2}[0-9]+)<[A-Z0-9]{1}[A-Z]{3}([0-9]{6})/m';
			
			if (isset($_POST['nonrezidentstrah']))
			{
				$regexppasnumber = '/^([A-Z0-9]{8})(?:\d\w{3})(\d{6})/m';
			}
			else
			{
				$regexppasnumber = '/^([A-Z]{2}[0-9]{6})(?:<.\w{3})(\d{6})/m';
			}
			
							
			
			$passsernumb = array();
			if (preg_match($regexppasnumber, $text, $passsernumb))
				{
					echo $passsernumb[1]. " <- PassNumber";			
					echo $passsernumb[2]. " <- BirthDate";			
					
				}
				echo "<hr>";
////////////////////////////////////////////////////////////				
/*			$regexppasdate = '/^(?:(?:[A-Z]{2}|[\d]{2}])[\d]{6}(?:\d|<))[\d\w]{4}(\d{6})/m';			   
			$passdateser = array();
			if (preg_match($regexppasdate, $text, $passdateser))
				{
					echo $passdateser[1]. " <- BirthDate";			
					
				}
						
				echo "<hr>";
*/			/////////////////////////////	
	// Обрабатываем выдранную дату и приводим к формату MySQL		
			$yearnow = substr(date("Y"),2,2);
			if (!strlen($passsernumb[2]) != 0)
			{
				$yy = substr($passsernumb[2],0,2);// выбирает с 0 позиции 2 следующих символа
				$mm = substr($passsernumb[2],2,2);// выбирает с 2 позиции 2 следующих символа
				$dd = substr($passsernumb[2],4,2);// выбирает с 4 позиции 2 следующих символа
				
				//приводим распознанное к виду MYSQL
				$newymd = ($yy <= substr(date("Y"),2,2) && $yy >= 0 )?"20".$yy."-".$mm."-".$dd : "19".$yy."-".$mm."-".$dd;
				
			}
			echo $newymd;
			$result = "INSERT INTO `aaateseract`(`orderid`, `i`, `passname`, `passsirname`, `pass_birth`, `passsernumb`, `pass_date_zapisi`) VALUES ('".$GLOBALS["orderid"]."','".$i."','".$passnames[1]."','".$passsirnames[1]."','".$newymd."','".$passsernumb[1]."','".$GLOBALS["date"]."')";
			mysqli_query($linkmysql, $result);
			
			echo "<hr>";
			echo $result;
			// echo $GLOBALS["date"];
			// echo $GLOBALS["orderid"];
			
			
			
		}

