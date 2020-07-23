<?php 
//$date = date("Y-m-d");

$text = "<html>
			<head>

  				<style>

  					table, tr, td {
  						border: 1px solid black;
  						border-collapse: collapse;
  					}
  					body { font-family: DejaVu Serif; 
					font-size : xx-small;	
					}	
  				</style>
				<meta name='viewport' content='width=device-width, initial-scale=1.0'>
				<meta http-equiv='content-type' content='text/html; charset=utf-8' /> 	
			</head>
			<body>
			<p><b> Полоіс № $order_id </b></p>
			
			  <table >
			    <tr>
                	<td>Тривалість(днів)<br>/Duration(days)</td>
                	<td>".$polis_array["0"]['days']."</td>
                	<td>Знижки/надбавки(%)<br>Discount/increase(%)</td>
                	<td></td>
                	<td>Франшиза(у.о.)/<br>Deductible(c.u.)</td>
                	<td>".$polis_array["0"]['franshiza']." ".$polis_array["0"]['currency']."</td>
                	<td>Територія дії/<br> Territory of coverage</td>
                	<td>".$polis_array["0"]['terittory']."</td>
                	<td> Опція(програма страхування)/<br> Type of coverage</td>
                	<td>".$polis_array["0"]['type']."</td>
			    </tr>
			    <tr>
					<td>Строк дії Договору(днів):<br>Period of insurance(days):</td>
					<td>".$polis_array["0"]['days']."</td>
					<td>з/<br>from</td>
					<td>".$polis_array["0"]['dateStart']."</td>
					<td>до/<br>to</td>
					<td>".$polis_array["0"]['dateStop']."</td>
					<td colspan='2'>Умови страхування в Додатку 2 до Договору/<br>Conditions in Appendix 2 to the Policy</td>
					<td>УМОВИ І/<br>Conditions I</td>
					<td>УМОВИ ІІ/<br>Conditions II</td>
			    </tr>
			    <tr>
					<td>Страховик/<br>Insurer</td>
					<td colspan='5'>Geniun Comunity/<br>Geniun Comunity</td>
					<td colspan='2'>Страхова сума на кожну Застрах.особу<br>Sum insured per Insured person</td>
					<td>".$polis_array["0"]['sum_complex']." ".$polis_array["0"]['currency']."</td>
					<td>".$polis_array["0"]['sum_accident']." Грн.</td>
			    </tr>
			    <tr>
					<td>Адреса Страховика/<br>Adress of the Insurer</td>
					<td colspan='5'>Україна, 03150, м. Київ, /<br> Kyiv, 03150, Ukraine</td>
					<td colspan='2'>Страховий тариф/<br>Insurance rate</td>
					<td></td>
					<td></td>
			    </tr>
			    <tr>
					<td rowspan='2'>Телефон Страховика/<br>Telephone of the Insurer</td>
					<td rowspan='2' colspan='2'>тел./tel. +38(044)247-44-77<br>fax/факс +38(044)529-08-94</td>
					<td rowspan='2' colspan='2'>Адреса/<br>Address</td>
					<td rowspan='2'>ІНПП/<br>Identification code</td>
					<td rowspan='2'>Паспорт/<br>Passport</td>
					<td rowspan='2'>Дата народження/<br>Date of birth</td>
					<td colspan='2'>
						Страховий платіж(грн.)/Insurance premium(UAH)
						<tr>
							<td>УМОВИ І / Conditions I</td>
							<td>УМОВИ ІІ/ Conditions IІ</td>
						</tr>	
					</td>
			    </tr>
			    <tr>
					<td>Страхувальник/<br>Insured</td>
					<td colspan='2'>".$clients_array["0"]["sirname"]." ".$clients_array["0"]["name"]."</td>
					<td colspan='2'></td>
					<td>".$clients_array["0"]["inn"]."</td>
					<td>".$clients_array["0"]["passport"]."</td>
					<td>".$clients_array["0"]["date_birth"]."</td>
					<td>-----------</td>
					<td>-----------</td>
			    </tr>
			    <tr>
					<td>Застрахована особа 1/<br>Insured Person 1</td>
					<td colspan='2'>".$clients_array["1"]["sirname"]." ".$clients_array["1"]["name"]."</td>
					<td colspan='2'></td>
					<td></td>
					<td>".$clients_array["1"]["passport"]."</td>
					<td>".$clients_array["1"]["date_birth"]."</td>
					<td></td>
					<td></td>
			    </tr>
			    <tr>
					<td>Застрахована особа 2/<br>Insured Person 2</td>
					<td colspan='2'>".$clients_array["2"]["sirname"]." ".$clients_array["2"]["name"]."</td>
					<td colspan='2'></td>
					<td></td>
					<td>".$clients_array["2"]["passport"]."</td>
					<td>".$clients_array["2"]["date_birth"]."</td>
					<td></td>
					<td></td>
			    </tr>
			    <tr>
					<td>Застрахована особа 3/<br>Insured Person 3</td>
					<td colspan='2'>".$clients_array["3"]["sirname"]." ".$clients_array["3"]["name"]."</td>
					<td colspan='2'></td>
					<td></td>
					<td>".$clients_array["3"]["passport"]."</td>
					<td>".$clients_array["3"]["date_birth"]."</td>
					<td></td>
					<td></td>
			    </tr>
			    <tr>
					<td>Застрахована особа 4/<br>Insured Person 4</td>
					<td colspan='2'>".$clients_array["4"]["sirname"]." ".$clients_array["4"]["name"]."</td>
					<td colspan='2'></td>
					<td></td>
					<td>".$clients_array["4"]["passport"]."</td>
					<td>".$clients_array["4"]["date_birth"]."</td>
					<td></td>
					<td></td>
			    </tr>
			    <tr>
					<td>Особливі умови/<br>Special conditions</td>
					<td colspan='4'></td>
					<td colspan='3'>Страховий платіж за Умовами І та ІІ (грн.)/Insurance premium under Conditions I and II (UAH)<br></td>
					<td>".$polis_array["0"]['SPtr']."</td>
					<td>".$polis_array["0"]['SPnv']."</td>
			    </tr>
			    <tr>
					<td colspan='5'> При страхуванні групи додається список Застрахованих осіб, який є невід'ємною частиною цього Договору/<br> If the group is insured the lists of Insured persons is enclosed and is an integral part of this Policy.</td>
					<td colspan='3'>Загальна страховий платіж за Договором(грн.)/<br>Total insurance premium under this  Policy (UAH)</td>
					<td colspan='2'>".$polis_array["0"]['SPzag']."</td>
			    </tr>
			    <tr>
				    <td colspan='10'>Умови комплексного добровільного страхування під час перебування за кордоном (УМОВИ І) та умови добровільного страхування від нещасних випадків (УМОВИ ІІ) наведені у Додатку 1 та Додатку 2 до цього<br>Conditions of  Policy on voluntary complex insurance while staying abroad (Conditions I) and Voluntary accident insurance conditions (Conditions II) are listed in Appendix 1 and Appendix 2 to this  Policy.
				    </td>
			    </tr>
			    <tr>
					<td rowspan='2' colspan='5'>Підпис Страхувальника/Signature of the Insured<br>З Правилами страхування ознайомлений, з умовами згодний. Згоду Застрахованої особи на страхування отримав.<br>Has been familiarized with the Rules of insurance terms of insurance.The Insured received consent of the Insured person for insurance<br>М.П./Seal
					</td>
					<td rowspan='2' colspan='3'>Підпис Страховика(Агента)/Signature of the Insurer(Agent)<br>М.П./Seal
					</td>
						<td>Дата укладання Договору/<br>Date of the  Policy conclusion</td>
						<td>Сплатити страховий платіж до/<br>Insurance premium shall be paid till</td>
						<tr>
							<td>".$polis_array['0']['date_zapisi_polisa']."</td>
							<td>".$polis_array['0']['date_zapisi_polisa']."</td>
						</tr>
				</tr>
			    <tr>
			    	<td colspan='10'>* у. о. - грошовий еквівалент ліміту відповідальності Страховика перед Страхувальником (Застрахованою особою) у відношенні до грошової одиниці України<br> 
 					* standard unit - currency equivalent of the liability limit of the Insurer against the Insured (the Insured person) in relation to the Ukrainian currrency unit<br>
 					Страховий захист надається відповідно 'Рішення Ради ЄС 2004/17/EG щодо медичного страхування подорожуючих осіб'/<br>
 					Insurance coverage is provided acording to 'Resolution of the EU Council 2004/17/EG regarding medical insurance of persons who are traveling'
 					</td>
			    </tr>
			  </table>
			</body>
			</html>";

//echo $text;
require_once 'dompdf-master/autoload.inc.php';

use Dompdf\Dompdf;
// instantiate and use the dompdf class



$dompdf = new Dompdf();
$dompdf->loadHtml($text);

// (Optional) Setup the paper size and orientation/
//$dompdf->setPaper('a4', 'portrait');

// Render the HTML as PDF
$dompdf->setPaper('A4', 'portrait');

 $dompdf->render();
 


//			$dompdf->stream();// Output the generated PDF to Browser
		
if (isset($_GET['download'])) {

$dompdf->stream($order_id,array("Attachment"=>1));

}		
else{ 
$stream = $dompdf->output();
}

///////////////////////////
// Отправляем на почту

if (!isset($_GET['download'])) {
require_once 'mail.php';
}

//echo $text;
?>