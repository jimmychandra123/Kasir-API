<?php 
include_once('core/init.php');
if(isset($_REQUEST) && isset ($_REQUEST['method']))
{
	if ($_REQUEST['method'] == "post") {
		$username= $_GET['username'];
		$password= $_GET['password'];
        $password2 = md5($password);

		if ($username && $password) {
			$sql = "SELECT * FROM users WHERE username='".$username."' AND password = '".$password2."'";
			$query = $connect->query($sql);
			if ($query->num_rows >= 1) {
				$userdata = mysqli_fetch_array($query);
				$_SESSION['id'] = $userdata['id'];
				$_SESSION ['level'] = $userdata['level_id'];
				$data = ['level_id' => $_SESSION['level'],
						'message' => "Successfully login"];
					header('Content-type: application/json');
					echo json_encode($data);
			}else {
				$data = [
						'message' => "Incorrect username/password combination"];
					header('Content-type: application/json');
					echo json_encode($data);
			}
		}
	}
}



?>