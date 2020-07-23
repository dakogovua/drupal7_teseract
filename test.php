<?php
if (isset($_GET['width']) AND isset($_GET['height'])) {
  // выводим переменные с размерами
  echo "Ширина экрана: ". $_GET['width'] ."<br />\n";
  echo "Высота экрана: ". $_GET['height'] ."<br />\n";
} else {
  // передаем переменные с размерами
  // (сохраняем оригинальную строку запроса
  //   -- post переменные нужно будет передавать другим способом)

  echo "<script language='javascript'>\n";
  echo "  location.href=\"${_SERVER['SCRIPT_NAME']}?${_SERVER['QUERY_STRING']}"
            . "&width=\" + screen.width + \"&height=\" + screen.height;\n";
  echo "</script>\n";
  exit();
}
?>

<?php /*
require_once 'functions.php';
require_once 'connections.php';

$clients_array['0']['email'] = "gklj";


echo  "
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0/jquery.min.js'></script>

<!-- jQuery Modal -->
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js'></script>
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css' />

<div id='ex1' class='modal'>
  <p>Ваш полис отправлен по адресу: ".$clients_array['0']['email']."</p>
  <a href=''>В самое ближайшее время вы сможете скачать полис</a>
	<br>
	  <center><h2><a href='/'>Закрыть</a></h2></center>
</div>

<script>
$('#ex1').modal({
  					showClose: false
				}, 
				'show');

</script>
"
?>