<?php
	function assayImg(){
		$file_name = $_FILES['file']['name'];
		$file_tmp = $_FILES['file']['tmp_name'];
		$array = explode('.',$file_name);
		$file_format = end($array);
		$expensions = ['jpg','JPG','jpeg','JPEG','png','PNG','gif','GIF'];
		if (in_array($file_format, $expensions)) {
			return true;
		}
		else {
			return false;
		}
	}
 ?>
