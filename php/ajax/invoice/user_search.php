<?php
// include "../admin_login_system/php_user_session_check.php";
session_start();
include "../../database/connection.php";
header("content-type: application/json");

if (isset($_POST['search_key']) && !empty($_POST['search_key'])) {
	$search_key = $_POST['search_key'];
	if(is_numeric($search_key)){
		$sql = "SELECT `users`.*,`wallet`.`total_amount` as `amount` FROM `users` INNER JOIN `wallet` ON `wallet`.`user_id` = `users`.`id` WHERE `users`.`mobile` = '$search_key'";
	}else{
		$sql = "SELECT `users`.*,`wallet`.`total_amount` as `amount` FROM `users` INNER JOIN `wallet` ON `wallet`.`user_id` = `users`.`id` WHERE `users`.`email` = '$search_key'";
	}

	if ($res_sql = $connection->query($sql)) {
		if ($res_sql->num_rows > 0) {
			$row = $res_sql->fetch_assoc();
			$html =   '<h4>User Info</h4>
	              <div class="col-md-6">     
	                <b>Name : </b> '.$row['name'].'
	              </div>
	              <div class="col-md-6">     
	                <b>Mobile : </b> '.$row['mobile'].'
	                </div>      
	              <div class="col-md-6">     
	                <b>Is Free Shopping Amount: </b> '.$row['amount'].' 
				  </div>';
			$data = [
				'data' => $html,
				'status' => 1,
			];
			echo json_encode($data);
			
		}else{
			echo "3";
		}
	}else{
		echo "2";
	}
}else{
	echo "2";
}



?>