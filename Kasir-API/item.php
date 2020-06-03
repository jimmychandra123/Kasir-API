<?php  
include_once('core/init.php');
if(isset($_REQUEST) && isset ($_REQUEST['method']))
{
	if (isset($_SESSION['id'])) {
		//list item
		if ($_REQUEST['method'] == "get") {
			
			$select = "SELECT * FROM item";
			$req = $connect->query($select);
			$array = [];
			while ($data = $req->fetch_assoc()) {
					$array[] = $data;}
				header('Content-type: application/json');
				echo json_encode($array);
		}

		//add item
		if ($_REQUEST['method'] == "post") {
		$barcode = $_GET['barcode'];
		$nama_item = $_GET['nama_barang'];
		$harga = $_GET['harga'];
		$level = "admin";
		$c_level = $_SESSION['level'];
			if($c_level == $level) {
    		$insert = "INSERT INTO item (barcode,nama_item,harga) VALUES ('".$barcode."','".$nama_item."','".$harga."')";
    		$req = $connect->query($insert);
    
    		if($req === TRUE)
    		{
    			$data = [
    					
    					'message' => "Successfully add new item"
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
		 else{
			$data = [
					'message' => "Akses dilarang!"];
					header('Content-type: application/json');
					echo json_encode($data);
			}
	}

if ($_REQUEST['method'] == "delete") {
		$barcode = $_GET['barcode'];
		$level = "admin";
		$c_level = $_SESSION['level'];
			if($c_level == $level) {
		$delete = "DELETE FROM item where barcode='".$barcode."'";
		$req = $connect->query($delete);

        		if($req === TRUE)
        		{
        			$data = [
        				
        					'message' => "Berhasil Menghapus barang"
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
        	  else{
			$data = [
					'message' => "Akses Dilarang!"];
					header('Content-type: application/json');
					echo json_encode($data);
			}
	}

	}
	else{
			$data = [
					'message' => "Silahkan Login Kembali"];
					header('Content-type: application/json');
					echo json_encode($data);
		}
}

?>