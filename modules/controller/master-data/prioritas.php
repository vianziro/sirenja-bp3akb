<?php
	if (isset($_POST['apa']) && $_POST['apa'] != "") {
		
		include 'modules/model/class.prioritas.php';
		$data = new prioritas();
		
		switch ($_POST['apa']) {
			case "get-prioritas":
				$collect = array();
				
				if ($query = $data->get_prioritas()) {
					while ($rs = $query->fetch_array()) {
						$detail = array();
						array_push($detail, $rs["prioritas"]);
						array_push($detail, "<button type='button' class='btn btn-sm btn-primary' id='btn-ubah-data' data-id='".$rs["id"]."' data-prioritas='".$rs["prioritas"]."'>
									<i class='fa fa-pencil'></i></button> 
									<button type='button' class='btn btn-sm btn-danger' id='btn-hapus-prioritas' data-id='".$rs["id"]."'><i class='fa fa-trash-o'></i></button>");
						array_push($collect, $detail);
						unset($detail);
					}
				}
				echo json_encode(array("aaData"=>$collect));
				break;
			case "tambah-prioritas":
				$arr=array();
				
				if (isset($_POST['txt-prioritas']) && $_POST['txt-prioritas'] != "") {
					
					if ($result = $data->tambah($_POST['txt-prioritas'])) {
						$arr['status']=TRUE;
						$arr['msg']="Data tersimpan..";
					} else {
						$arr['status']=FALSE;
						$arr['msg']="Gagal menyimpan..";
					}
				} else {
					$arr['status']=FALSE;
					$arr['msg']="Harap isi data dengan lengkap..";
				}
				
				echo json_encode($arr);
				break;
			case "ubah-prioritas":
				$arr=array();
				
				if (isset($_POST['txt-prioritas']) && $_POST['txt-prioritas'] != "" && isset($_POST['txt-id']) && $_POST['txt-id'] != "") {
					
					if ($result = $data->ubah($_POST['txt-id'], $_POST['txt-prioritas'])) {
						$arr['status']=TRUE;
						$arr['msg']="Data tersimpan..";
					} else {
						$arr['status']=FALSE;
						$arr['msg']="Gagal menyimpan..";
					}
				} else {
					$arr['status']=FALSE;
					$arr['msg']="Harap isi data dengan lengkap..";
				}
				
				echo json_encode($arr);
				break;
			case "hapus-prioritas":
				$arr=array();
				
				if (isset($_POST['id']) && $_POST['id'] != "" ) {
					
					if ($result = $data->hapus($_POST['id'])) {
						$arr['status']=TRUE;
						$arr['msg']="Data terhapus..";
					} else {
						$arr['status']=FALSE;
						$arr['msg']="Gagal menghapus..";
					}
				} else {
					$arr['status']=FALSE;
					$arr['msg']="Harap isi data dengan lengkap..";
				}
				
				echo json_encode($arr);
				break;
		}
	}
?>