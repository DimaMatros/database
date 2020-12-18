<?php include("includes/header.php"); ?>

<div class="container mregister">
	<div id="login">
		<h1>Регистрация</h1>
		<form action="register.php" id="registerform" method="post"name="registerform">
			<p><label for="user_login">Полное имя<br>
				<input class="input" id="full_name" name="full_name"size="32"  type="text" value=""></label></p>
				<p><label for="user_pass">Номер телефона<br>
					<input class="input" id="email" name="number" size="32"type="tel" value=""></label></p>
					<p><label for="user_pass">ID доктора (от 1 до 12)<br>
						<input class="input" id="password" name="doctor"size="32"   type="text" value=""></label></p>
						<p class="submit"><input class="button" id="register" name= "register" type="submit" value="Зарегистрироваться"></p>
						<p class="regtext">Уже зарегистрированы? <a href= "login.php">Войдите</a>!</p>
					</form>
				</div>
			</div>

			<?php

			if(isset($_POST["register"])){

				if(!empty($_POST['full_name']) && !empty($_POST['number'])  && !empty($_POST['doctor'])) {
					$full_name= htmlspecialchars($_POST['full_name']);
					$number=htmlspecialchars($_POST['number']);
					$number= filter_var( $number, FILTER_SANITIZE_NUMBER_INT );
					$doctor =htmlspecialchars($_POST['doctor']);
					$doctor= filter_var( $doctor, FILTER_SANITIZE_NUMBER_INT );
					$query=mysqli_query($con, "SELECT * FROM client WHERE client_name ='".$full_name."'");
					$numrows=mysqli_num_rows($query);
					if(is_numeric($doctor ) && $doctor > 0 && $doctor < 13 )
					{
						if($numrows==0)
						{
							$sql="INSERT INTO client
							(client_name, phone_number,doctor_id)
							VALUES('$full_name','$number', '$doctor')";
							$result=mysqli_query($con, $sql);
							if($result){
								$message = "Account Successfully Created";
							} else {
								$message = "Failed to insert data information!";
							}
						} else {
							$message = "That username already exists! Please try another one!";
						}
					}else{
						$message = "Id has to be between 1 and 12!";
					}


				} else {
					$message = "All fields are required!";
				}
			}
			?>

			<?php if (!empty($message)) {echo "<p class='error'>" . "MESSAGE: ". $message . "</p>";} ?>


			<?php include("includes/footer.php"); ?>