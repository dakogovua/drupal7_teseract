<?php

session_start();

if(isset($_SESSION["session_username"])){
/* echo "Session is set "; // for testing purposes
 echo ($_SESSION["session_username"]);*/

 header("location: index.php");

}
require_once $_SERVER['DOCUMENT_ROOT'].'/sites/all/modules/travel/backfront/includes/connection.php';
// require_once("includes/connection.php"); 




if(isset($_POST["login"])){
	


if(!empty($_POST['username']) && !empty($_POST['password'])) {
    $username=$_POST['username'];
    $password=$_POST['password'];

    //$query =mysql_query("SELECT * FROM aaausers WHERE login='".$username."' AND pass='".$password."'");
    $query =mysqli_query($con,"SELECT * FROM aaausers WHERE login='".$username."' AND pass='".$password."'");

    //$numrows=mysql_num_rows($query);
    $numrows=mysqli_num_rows($query);
    if($numrows!=0)

    {
    //while($row=mysql_fetch_assoc($query))
    while($row=mysqli_fetch_assoc($query))
    {
    $dbusername=$row['login'];
    $dbpassword=$row['pass'];
    }

    if($username == $dbusername && $password == $dbpassword)

    {


    $_SESSION['session_username']=$username;

    /* Redirect browser */
    header('location: index.php');
    }
    } else {

 $message =  "Ой, что-то нет такого имени пользователя или пароля!";
    }

} else {
    $message = "Не все поля введены!";
}
}
?>



<div class="container">
  <h2>Система учета on-line полисов </h2>
  <!-- Trigger the modal with a button -->
  <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Войти</button>

  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Введите логин и пароль</h4>
        </div>
        <div class="modal-body">
       <div id="login">
    <h1>LOGIN</h1>
<form name="loginform" id="loginform" action="" method="POST">
    <p>
        <label for="user_login">Username<br />
        <input type="text" name="username" id="username" class="input" value="" size="20" /></label>
    </p>
    <p>
        <label for="user_pass">Password<br />
        <input type="password" name="password" id="password" class="input" value="" size="20" /></label>
    </p>
        <p class="submit">
        <input type="submit" name="login" class="button" value="Войти" />
    </p>
       
</form>

    </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
  
</div>



<?php 
include $_SERVER['DOCUMENT_ROOT'].'/sites/all/modules/travel/backfront/includes/header.php';
//include("includes/header.php"); ?>
 




    <div class="container mlogin">
           

    </div>
	
	<script>  $(window).on('load',function(){
        $('#myModal').modal('show');
    });
	</script>
	
	<?php 
	include $_SERVER['DOCUMENT_ROOT'].'/sites/all/modules/travel/backfront/includes/footer.php';
	//include("includes/footer.php"); ?>
	
	<?php if (!empty($message)) {echo "<p class=\"error\">" . "MESSAGE: ". $message . "</p>";} ?>