<?php require_once 'core/init.php'; 

		if ($_REQUEST['method'] == "get") {
		    $logout = $_GET['logout'];
		    if($logout == "true") {
		        session_destroy();
		       $data = [
					'message' => "anda berhasil logout"];
					header('Content-type: application/json');
					echo json_encode($data);
            
			
			
		}
}
?>