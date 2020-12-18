<?php include("includes/header.php"); ?>

<div class="container mlogin">
	<div id="login">
		<h1>Вход</h1>
		<form action="" id="loginform" method="post"name="loginform">
			<p><label for="user_login">Имя клиента<br>
				<input class="input" id="username" name="username"size="20"
				type="text" value=""></label></p>
					<p class="submit"><input class="button" name="login"type= "submit" value="Log In"></p>
					<p class="regtext">Еще не зарегистрированы?<a href= "register.php">Регистрация</a>!</p>
				</form>
			</div>
		</div>

		<?php
		session_start();
		?>

		<?php require_once("includes/connection.php"); ?>
		<?php include("includes/header.php"); ?>	 
		<?php

		if(isset($_SESSION["session_username"])){
	// вывод "Session is set"; // в целях проверки
			header("Location: intropage.php");
		}

		if(isset($_POST["login"])){

			if(!empty($_POST['username']) ) {
				$username=htmlspecialchars($_POST['username']);
				$query =mysqli_query($con, "SELECT * FROM client WHERE client_name ='$username'");
				$numrows=mysqli_num_rows($query);
				if($numrows!=0)
				{
					while($row=mysqli_fetch_assoc($query))
					{
						$dbusername=$row['client_name'];
					}
					if($username == $dbusername)
					{
	// старое место расположения
	//  session_start();
						$_SESSION['session_username']=$username;	 
						/* Перенаправление браузера */
						header("Location: intropage.php");
					}
				} else {
	//  $message = "Invalid username or password!";

					echo  "Invalid username or password!";
				}
			} else {
				$message = "All fields are required!";
			}
		}
		?>


		<?php include("includes/footer.php"); ?>