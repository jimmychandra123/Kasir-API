<?php  
include_once('core/init.php');
if(isset($_REQUEST) && isset ($_REQUEST['method']))
{
	//register users
		if ($_REQUEST['method'] == "post") {
		$username = $_GET['username'];
		$password = $_GET['password'];
		$password2 = md5($password);
		$level = "karyawan";
		$wallet = 0;
		$insert = "INSERT INTO users (username,password,level_id,wallet) VALUES ('".$username."','".$password2."','".$level."','".$wallet."')";
		$req = $connect->query($insert);

		if($req === TRUE)
		{
			$data = [
					'status' => "oke",
					'message' => "Successfully add new users"
			];
		}
		else
		{
			$data = [
					'status' => "FAIL",
					'message' => "Something went wrong"
			];
		}

		header('Content-type: application/json');
		echo json_encode($data);
		}

	if (isset($_SESSION['id'])) {
		//list users
		if ($_REQUEST['method'] == "get") {
			$level = $_SESSION['level'];
			$id = $_SESSION['id'];
			$c_level = "admin";
			if ($c_level == $level) {
				$select = "SELECT id, username, wallet FROM users";
				$req = $connect->query($select);
				$array = [];
				while ($data = $req->fetch_assoc()) {
					$array[] = $data;}
					header('Content-type: application/json');
					echo json_encode($array);
			}
			 else{
				$select = "SELECT id, username, wallet FROM users where id =".$id;
				$req = $connect->query($select);
				$array = [];
				while ($data = $req->fetch_assoc()) {
					$array[] = $data;}
					header('Content-type: application/json');
					echo json_encode($array);

			}
		}


		// update users
		if ($_REQUEST['method'] == "put") {
		$id = $_SESSION['id'];
		$username = $_GET['username'];
		$password = $_GET['password'];
		$password2 = md5($password);
		//$level = $_GET['level_id'];

		$update = "UPDATE users set username='".$username."',password = '".$password2."' WHERE id='".$id."'";
		$req = $connect->query($update);

		if($req === TRUE)
		{
			$data = [
					'status' => "oke",
					'message' => "Successfully update users"
			];
		}
		else
		{
			$data = [
					'status' => "FAIL",
					'message' => "Something went wrong"
			];
		}

		header('Content-type: application/json');
		echo json_encode($data);
		}

	}
	else{
			$data = [
					'message' => "silahkan login kembali"];
					header('Content-type: application/json');
					echo json_encode($data);
		}
}
?>