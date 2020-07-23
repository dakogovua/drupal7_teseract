<?php 
session_start();
if(!isset($_SESSION["session_username"])) {
	header("location:login.php");
} else {
?>


<?php include("includes/header.php"); ?>
<div id="welcome">	
	<h2>Добро пожаловать, <span><?php echo $_SESSION['session_username'];?>! </span></h2>
	<p><a href="logout.php">Выйти</a> Из системы "PolisOnLime"</p>
</div>

		<div class="container">

			<h1>
				Система "PolisOnLine" <span>Полисы</span>
			</h1>

			<table cellpadding="0" cellspacing="0" border="0" class="display table-responsive" id="polises" width="100%">
				<thead>
					<tr>
						<th>id db</th> 
						<th>Номер полісу</th>
						<th>Ім'я</th>
						<th>Прізвище</th>
						<th>Дата народження</th>
						<th>ІПН</th>
						<th>Номер Паспорту</th>
						<th>email</th>
						<th>Тел.</th>
						<th>Дата запису</th>
						<th>id полісу</th>
						<th>Дні</th>
						<th>Дата початку</th>
						<th>Дата кінця</th>
						<th>Франшиза</th>
						<th>Територія</th>
						<th>Тип</th>
						<th>Страхова сума КС</th>
						<th>Валюта</th>
						<th>Страхова сума НВ</th>
						<th>Оплата</th>
						<th>id транзакції</th>
						<th>Тариф</th>
						<th>Знижки</th>
						<th>Загальний страховий платіж</th>
						<th>Страховий платіж НВ</th>
						<th>Страховий платіж КС</th>
						<th>Не резидент</th>

					</tr>
				</thead>
	
			</table>

		</div>



<script> $(document).ready(function() {
    $('#polises').DataTable( {
        "processing": true,
		

        "ajax": "scripts/server_processing.php"
    } );
} );      
</script>


<?php include("includes/footer.php"); ?>
	

<?php
}
?>