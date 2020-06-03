<?php  
include_once('core/init.php');
if(isset($_REQUEST) && isset ($_REQUEST['method']))
{
	if (isset($_SESSION['id'])) {
		//purchase
		if ($_REQUEST['method'] == "post") {
		$barcode = $_GET['barcode'];
		$jumlah = $_GET['jumlah'];
		$id = $_SESSION['id'];

		$sql_item = "SELECT * FROM item WHERE barcode='".$barcode."'";
		$query = $connect->query($sql_item);
		$userdata_item = mysqli_fetch_array($query);

		$harga_item = $userdata_item['harga'];
		$total_harga = $jumlah * $harga_item;
		
		$sql_users = "SELECT * FROM users WHERE id='".$id."'";
		$query_users = $connect->query($sql_users);
		$userdata_users = mysqli_fetch_array($query_users);
		$pembeli = $userdata_users['username'];

				$insert = "INSERT INTO history_purchase (id_nama,barcode,jumlah_purchase,total_harga) VALUES ('".$id."','".$barcode."','".$jumlah."','".$total_harga."')";
				$req = $connect->query($insert);
				if($req === TRUE)
				{
					$data = [
							'message' => "Penjualan Berhasil diinput"
					];
					header('Content-type: application/json');
				    echo json_encode($data);
				}
				else {
				$data = [
							'status' => "FAIL",
							'message' => "Something went wrong"
					];
					header('Content-type: application/json');
				echo json_encode($data);
				}
				
			}


		//list history purchase
		if ($_REQUEST['method'] == "get") {
		$level = "admin";
		$c_level = $_SESSION['level'];
			if($c_level == $level) {
				//menggunakan inner join untuk dpt value nya
			$select = "select users.username, item.nama_item, history_purchase.jumlah_purchase, history_purchase.waktu_purchase, total_harga From history_purchase inner join users ON history_purchase.id_nama = users.id INNER JOIN item on history_purchase.barcode = item.barcode";
			$req = $connect->query($select);
			$array = [];
			while ($data = $req->fetch_assoc()) {
				$array[] = $data;
			}
			header('Content-type: application/json');
			echo json_encode($array);
			}
			else{
			$data = [
					'message' => "Akses dilarang!"];
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