<?php include("includes/header.php"); ?>
<div class="container mregister">

	<form action="register.php" method="post">
		<span class="submit"><input class="button1" id="submit" name= "submit" type="submit" value="Зарегистрироваться"></span>
	</form>
	<form action="login.php" method="post">
		<span class="submit"><input class="button1" id="submit" name= "submit" type="submit" value="Войти"></span>
	</form>
	<form action="update.php"  method="post" >

		<h3>Выберите таблицу:</h3>
		<select name="table" id="table">
			<option value="cheque" <?php if (isset($_POST['table']) &&($_POST['table'] == 'cheque')){echo "selected='selected'";}?>>Чек</option>
			<option value="client" <?php if (isset($_POST['table']) &&($_POST['table'] == 'client')){echo "selected='selected'";}?>>Клиент</option>
			<option value="doctor" <?php if ( isset($_POST['table'])&&($_POST['table'] == 'doctor')){echo "selected='selected'";}?>>Доктор</option>
			<option value="manufacturer" <?php if ( isset($_POST['table'])&&($_POST['table'] == 'manufacturer')){echo "selected='selected'";}?>>Производитель</option>
			<option value="pharmacist" <?php if ( isset($_POST['table'])&&($_POST['table'] == 'pharmacist')){echo "selected='selected'";}?>>Фармацевт</option>
			<option value="product" <?php if ( isset($_POST['table'])&&($_POST['table'] == 'product')){echo "selected='selected'";}?>>Лекарства</option>
			<option value="recipe" <?php if ( isset($_POST['table'])&&($_POST['table'] == 'recipe')){echo "selected='selected'";}?>>Рецепты</option>
		</select>

		<span class="submit"><input class="button1" id="submit" name= "submit" type="submit" value="Просмотреть"></span>
		<span class="submit"><input class="button1" id="add" name= "add" type="submit" value="Добавить строку в табицу"></span>


		<br>
		<br>

		<?php 

		if(isset($_POST["submit"])){
			$request = $_POST['table'];
			$line = mysqli_query($con,"SELECT * FROM ".$request."");
			$a = mysqli_num_fields($line);
			$line = mysqli_fetch_all($line);
			?> 
			<table> 
				<span style="font-weight: 600; color: black;">ID</span>
				<?php 
				foreach ($line as $line) { 
					?>
					<tr>
						<?php
						for ($i=0; $i < $a; $i++) {;
							?> <td > <?php echo  
							$line[$i]; ?> </td> <?php
						}
						?> 

					</tr>
					<?php 	
				}
				?>
			</table>
			<?php

			?>
			<span style="font-weight: 600; ">Введите ID строки, которую хотите  <span style="font-weight: 700;">УДАЛИТЬ:</span></span>
			<input type="text" name="num" id="num" value="">
			<span class="submit"><input class="button1" id="delete" name= "delete" type="submit" value="Удалить"></span>
			<span style="font-weight: 600; ">Введите ID строки, которую хотите <span style="font-weight: 700;">ИЗМЕНИТЬ:</span></span>
			<input type="text" name="num1" id="num1" value="">
			<span class="submit"><input class="button1" id="change" name= "change" type="submit" value="Изменить"></span>
		</form>
		<?php 
	}
	else if(isset($_POST["delete"])){
		$request = $_POST['table'];
		$num =$_POST['num'];
		$num= filter_var( $num, FILTER_SANITIZE_NUMBER_INT );
		if(!is_numeric($num )){
			echo "Проверьте правильность введенных данных! ID должно быть числом!";
		}
		else{
			$id = $request . "_id";
			$del = mysqli_query($con, "DELETE FROM ".$request." WHERE  ".$id." = ".$num."");

			
		}
	}
	else if (isset($_POST["change"])){
		$request = $_POST['table'];
		$num1 =$_POST['num1'];
		$num1= filter_var( $num1, FILTER_SANITIZE_NUMBER_INT );
		if(!is_numeric($num1 )){
			echo "Проверьте правильность введенных данных! ID должно быть числом!";
		}
		?> <form action="" method="post">
			<input  type="hidden" name="num1" value="<?=$num1?>">
			<input  type="hidden" name="request" value="<?=$request?>">
			<?php
			if($request == "client"){
				$upd = mysqli_query($con,  "SELECT * FROM `client` WHERE `client_id` = '$num1'");
				$upd = mysqli_fetch_all($upd);
				foreach ($upd as $upd) { 	
					?> 
					<input disabled type="text" name="change1" placeholder="ID = [<?=  $upd[0] ?>]"> 
					<input  type="text" name="change1" value="<?=  $upd[1] ?>">  
					<input  type="text" name="change2" value="<?= $upd[2] ?>">  
					<input  type="text" name="change3" value="<?=  $upd[3] ?>">  
					<span class="submit"><input class="button1" id="save" name= "save" type="submit" value="Сохранить"></span>
					<span class="submit"><input class="button1" id="cancel" name= "cancel" type="submit" value="Отмена"></span> 
					<?php
				}
			}else if($request == "cheque"){
				$upd = mysqli_query($con,  "SELECT * FROM `cheque` WHERE `cheque_id` = '$num1'");
				$upd = mysqli_fetch_all($upd);
				foreach ($upd as $upd) { 	
					?> 
					<input disabled type="text" name="change1" placeholder="ID = [<?=  $upd[0] ?>]"> 
					<input  type="text" name="change1" value="<?=  $upd[1] ?>">  
					<input  type="text" name="change2" value="<?= $upd[2] ?>">  
					<input  type="text" name="change3" value="<?=  $upd[3] ?>"> 
					<input  type="text" name="change4" value="<?=  $upd[4] ?>">  
					<input  type="text" name="change5" value="<?= $upd[5] ?>">  
					<input  type="text" name="change6" value="<?=  $upd[6] ?>">     
					<span class="submit"><input class="button1" id="save" name= "save" type="submit" value="Сохранить"></span> 
					<span class="submit"><input class="button1" id="cancel" name= "cancel" type="submit" value="Отмена"></span>
					<?php
				}
			}
			else if($request == "doctor"){
				$upd = mysqli_query($con,  "SELECT * FROM `doctor` WHERE `doctor_id` = '$num1'");
				$upd = mysqli_fetch_all($upd);
				foreach ($upd as $upd) { 	
					?> 
					<input disabled type="text" name="change1" placeholder="ID = [<?=  $upd[0] ?>]">
					<input  type="text" name="change1" value="<?=  $upd[1] ?>">  
					<input  type="text" name="change2" value="<?= $upd[2] ?>">    
					<span class="submit"><input class="button1" id="save" name= "save" type="submit" value="Сохранить"></span> 
					<span class="submit"><input class="button1" id="cancel" name= "cancel" type="submit" value="Отмена"></span>
					<?php
				}
			}
			else if($request == "manufacturer"){
				$upd = mysqli_query($con,  "SELECT * FROM `manufacturer` WHERE `manufacturer_id` = '$num1'");
				$upd = mysqli_fetch_all($upd);
				foreach ($upd as $upd) { 	
					?> 
					<input disabled type="text" name="change1" placeholder="ID = [<?=  $upd[0] ?>]">
					<input  type="hidden" name="num1" value="<?=$num1?>">
					<input  type="text" name="change1" value="<?=  $upd[1] ?>">  
					<input  type="text" name="change2" value="<?= $upd[2] ?>">    
					<span class="submit"><input class="button1" id="save" name= "save" type="submit" value="Сохранить"></span>
					<span class="submit"><input class="button1" id="cancel" name= "cancel" type="submit" value="Отмена"></span> 
					<?php
				}
			}else if($request == "pharmacist"){
				$upd = mysqli_query($con,  "SELECT * FROM `pharmacist` WHERE `pharmacist_id` = '$num1'");
				$upd = mysqli_fetch_all($upd);
				foreach ($upd as $upd) { 	
					?> 
					<input disabled type="text" name="change1" placeholder="ID = [<?=  $upd[0] ?>]">
					<input  type="hidden" name="num1" value="<?=$num1?>">
					<input  type="text" name="change1" value="<?=  $upd[1] ?>">  
					<input  type="text" name="change2" value="<?= $upd[2] ?>">    
					<span class="submit"><input class="button1" id="save" name= "save" type="submit" value="Сохранить"></span> 
					<span class="submit"><input class="button1" id="cancel" name= "cancel" type="submit" value="Отмена"></span>
					<?php
				}
			}else if($request == "product"){
				$upd = mysqli_query($con,  "SELECT * FROM `product` WHERE `product_id` = '$num1'");
				$upd = mysqli_fetch_all($upd);
				foreach ($upd as $upd) { 	
					?> 
					<input disabled type="text" name="change1" placeholder="ID = [<?=  $upd[0] ?>]">
					<input  type="hidden" name="num1" value="<?=$num1?>">
					<input  type="text" name="change1" value="<?=  $upd[1] ?>">  
					<input  type="text" name="change2" value="<?= $upd[2] ?>">  
					<input  type="text" name="change3" value="<?=  $upd[3] ?>"> 
					<input  type="text" name="change4" value="<?=  $upd[4] ?>">  
					<span class="submit"><input class="button1" id="save" name= "save" type="submit" value="Сохранить"></span> 
					<span class="submit"><input class="button1" id="cancel" name= "cancel" type="submit" value="Отмена"></span>
					<?php
				}
			}else if($request == "recipe"){
				$upd = mysqli_query($con,  "SELECT * FROM `recipe` WHERE `recipe_id` = '$num1'");
				$upd = mysqli_fetch_all($upd);
				foreach ($upd as $upd) { 	
					?> 
					<input disabled type="text" name="change1" placeholder="ID = [<?=  $upd[0] ?>]">
					<input  type="hidden" name="num1" value="<?=$num1?>">
					<input  type="text" name="change1" value="<?=  $upd[1] ?>">  
					<input  type="text" name="change2" value="<?= $upd[2] ?>">  
					<input  type="text" name="change3" value="<?=  $upd[3] ?>"> 
					<input  type="text" name="change4" value="<?=  $upd[4] ?>">  
					<span class="submit"><input class="button1" id="save" name= "save" type="submit" value="Сохранить"></span> 
					<span class="submit"><input class="button1" id="cancel" name= "cancel" type="submit" value="Отмена"></span>
					<?php
				}
			}
			?></form><?php
		}
		else if (isset($_POST["save"])) {
			$request = $_POST['request'];
			$num1 =$_POST['num1'];
			if ($request == "client") {
				$name =$_POST["change1"];
				$phone =$_POST["change2"];
				$doctor =$_POST["change3"];
				mysqli_query($con, "UPDATE `client` SET `client_name` = '$name', `phone_number` = '$phone', `doctor_id` = '$doctor' WHERE `client`.`client_id` = ".$num1."");
			}else if ($request == "cheque") {
				$change1 =$_POST["change1"];
				$change2 =$_POST["change2"];
				$change3 =$_POST["change3"];
				$change4 =$_POST["change4"];
				$change5 =$_POST["change5"];
				$change6 =$_POST["change6"];
				mysqli_query($con, "UPDATE `cheque` SET `client_id` = '$change1', `order_date` = '$change2', `order_number` = '$change3', `order_price` = '$change4', `pharmacist_id` = '$change5', `pruduct_id` = '$change6' WHERE `cheque`.`cheque_id` = ".$num1."");
			}
			else if ($request == "doctor") {
				$change1 =$_POST["change1"];
				$change2 =$_POST["change2"];
				mysqli_query($con, "UPDATE `doctor` SET `doctor_name` = '$change1', `specialization` = '$change2' WHERE `doctor`.`doctor_id` = ".$num1."");
			}
			else if ($request == "manufacturer") {
				$change1 =$_POST["change1"];
				$change2 =$_POST["change2"];
				mysqli_query($con, "UPDATE `manufacturer` SET `manufacturer_name` = '$change1', `adress` = '$change2' WHERE `manufacturer`.`manufacturer_id` = ".$num1."");
			}
			else if ($request == "pharmacist") {
				$change1 =$_POST["change1"];
				$change2 =$_POST["change2"];
				mysqli_query($con, "UPDATE `pharmacist` SET `pharmacist_name` = '$change1', `salary` = '$change2' WHERE `pharmacist`.`pharmacist_id` =  ".$num1."");
			}
			else if ($request == "product") {
				$change1 =$_POST["change1"];
				$change2 =$_POST["change2"];
				$change3 =$_POST["change3"];
				$change4 =$_POST["change4"];
				mysqli_query($con, "UPDATE `product` SET `product_name` = '$change1', `product_date` = '$change2', `manufacturer_id` = '$change3', `product_price` = '$change4' WHERE `product`.`product_id` =  ".$num1."");
			}
			else if ($request == "recipe") {
				$change1 =$_POST["change1"];
				$change2 =$_POST["change2"];
				$change3 =$_POST["change3"];
				$change4 =$_POST["change4"];
				mysqli_query($con, "UPDATE `recipe` SET `recipe_number` = '$change1', `doctor_id` = '$change2', `cliaent_id` = '$change3', `product_id` = '$change4' WHERE `recipe`.`recipe_id` = ".$num1."");
			}
			echo "Изминения сохранены!";
		}
		else if (isset($_POST["add"])){
			$request = $_POST['table'];
			?> <form action="" method="post">
			<input  type="hidden" name="request" value="<?=$request?>">
			<?php
			if ($request == "client") {
				?>
				<input  type="text" name="new1" placeholder ="name">  
				<input  type="text" name="new2" placeholder="phone number"> 
				<input  type="text" name="new3" placeholder="id doctor "> 
				<span class="submit"><input class="button1" id="saveadd" name= "saveadd" type="submit" value="Добавить"></span> 
				<span class="submit"><input class="button1" id="cancel" name= "cancel" type="submit" value="Отмена"></span>
				<?php
			}
			else if ($request == "cheque") {
				?>
				<input  type="text" name="new1" placeholder ="client id">  
				<input  type="text" name="new2" placeholder="date"> 
				<input  type="text" name="new3" placeholder="number "> 
				<input  type="text" name="new4" placeholder ="price">  
				<input  type="text" name="new5" placeholder="pharmacist id"> 
				<input  type="text" name="new6" placeholder="product id "> 
				<span class="submit"><input class="button1" id="saveadd" name= "saveadd" type="submit" value="Добавить"></span> 
				<span class="submit"><input class="button1" id="cancel" name= "cancel" type="submit" value="Отмена"></span>
				<?php
			}
			else if ($request == "doctor") {
				?>
				<input  type="text" name="new1" placeholder ="name">  
				<input  type="text" name="new2" placeholder="specialization"> 
				<span class="submit"><input class="button1" id="saveadd" name= "saveadd" type="submit" value="Добавить"></span> 
				<span class="submit"><input class="button1" id="cancel" name= "cancel" type="submit" value="Отмена"></span>
				<?php
			}
			else if ($request == "manufacturer") {
				?>
				<input  type="text" name="new1" placeholder ="name">  
				<input  type="text" name="new2" placeholder="adress"> 
				<span class="submit"><input class="button1" id="saveadd" name= "saveadd" type="submit" value="Добавить"></span> 
				<span class="submit"><input class="button1" id="cancel" name= "cancel" type="submit" value="Отмена"></span>
				<?php
			}
			else if ($request == "pharmacist") {
				?>
				<input  type="text" name="new1" placeholder ="name">  
				<input  type="text" name="new2" placeholder="sallary"> 
				<span class="submit"><input class="button1" id="saveadd" name= "saveadd" type="submit" value="Добавить"></span> 
				<span class="submit"><input class="button1" id="cancel" name= "cancel" type="submit" value="Отмена"></span>
				<?php
			}
			else if ($request == "product") {
				?>
				<input  type="text" name="new1" placeholder ="name">  
				<input  type="text" name="new2" placeholder="date"> 
				<input  type="text" name="new3" placeholder="namufacturer id "> 
				<input  type="text" name="new4" placeholder="price "> 
				<span class="submit"><input class="button1" id="saveadd" name= "saveadd" type="submit" value="Добавить"></span> 
				<span class="submit"><input class="button1" id="cancel" name= "cancel" type="submit" value="Отмена"></span>
				<?php
			}
			else if ($request == "recipe") {
				?>
				<input  type="text" name="new1" placeholder ="number">  
				<input  type="text" name="new2" placeholder="doctor id"> 
				<input  type="text" name="new3" placeholder="client id "> 
				<input  type="text" name="new4" placeholder="product id "> 
				<span class="submit"><input class="button1" id="saveadd" name= "saveadd" type="submit" value="Добавить"></span> 
				<span class="submit"><input class="button1" id="cancel" name= "cancel" type="submit" value="Отмена"></span>
				<?php
			}
			?></form><?php
		} else if (isset($_POST["saveadd"])) {
			$request = $_POST['request'];
			
			if ($request == "client") {
				$change1 =$_POST["new1"];
				$change2 =$_POST["new2"];
				$change3 =$_POST["new3"];
				mysqli_query($con,"INSERT INTO client (client_name, phone_number,doctor_id) VALUES ('$change1','$change2', '$change3')");
			}
			else if ($request == "cheque") {
				$change1 =$_POST["new1"];
				$change2 =$_POST["new2"];
				$change3 =$_POST["new3"];
				$change4 =$_POST["new4"];
				$change5 =$_POST["new5"];
				$change6 =$_POST["new6"];
				mysqli_query($con,"INSERT INTO `cheque`( `client_id`, `order_date`, `order_number`, `order_price`, `pharmacist_id`, `pruduct_id`) VALUES ('$change1','$change2','$change3','$change4','$change5','$change6')");
			}
			else if ($request == "doctor") {
				$change1 =$_POST["new1"];
				$change2 =$_POST["new2"];
				mysqli_query($con,"INSERT INTO `doctor`( `doctor_name`, `specialization`) VALUES ('$change1','$change2')");
			}
			else if ($request == "manufacturer") {
				$change1 =$_POST["new1"];
				$change2 =$_POST["new2"];
				mysqli_query($con,"INSERT INTO `manufacturer`(`manufacturer_name`, `adress`) VALUES ('$change1' ,'$change2')");
			}
			else if ($request == "pharmacist") {
				$change1 =$_POST["new1"];
				$change2 =$_POST["new2"];
				mysqli_query($con,"INSERT INTO `pharmacist`( `pharmacist_name`, `salary`) VALUES ('$change1','$change2')");
			}
			else if ($request == "product") {
				$change1 =$_POST["new1"];
				$change2 =$_POST["new2"];
				$change3 =$_POST["new3"];
				$change4 =$_POST["new4"];
				mysqli_query($con,"INSERT INTO `product`(`product_name`, `product_date`, `manufacturer_id`, `product_price`) VALUES ('$change1','$change2','$change3','$change4')");
			}
			else if ($request == "recipe") {
				$change1 =$_POST["new1"];
				$change2 =$_POST["new2"];
				$change3 =$_POST["new3"];
				$change4 =$_POST["new4"];
				mysqli_query($con,"INSERT INTO `recipe`(`recipe_number`, `doctor_id`, `cliaent_id`, `product_id`) VALUES ('$change1','$change2','$change3','$change4')");
			}
			echo "Успешно добавлено!";
		}

		?>

	</div>	

	<?php include("includes/footer.php"); ?>
