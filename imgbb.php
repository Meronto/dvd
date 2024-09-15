<?php
	
	## ВНИМАНИЕ! Быдло код!
	
	if(!empty($_POST['img']) && !empty($_POST['code'])){
		$RESULT = upLoadIMG($_POST['img'], $_POST['code'], $_POST['name']);
		if($RESULT){
			echo json_encode($RESULT); 
		}
	}
	
	function upLoadIMG($IMAGE, $CODE, $NAME = NULL){
		$CURL = curl_init();
		curl_setopt($CURL, CURLOPT_URL, 'https://api.imgbb.com/1/upload?key=' . $CODE);
		curl_setopt($CURL, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($CURL, CURLOPT_POST, 1);
		curl_setopt($CURL, CURLOPT_SAFE_UPLOAD, FALSE);
		$FILENAME = ($NAME) ? $NAME : time();
		$DATA = [
			'image' => base64_encode($IMAGE), 
			'name' 	=> $FILENAME
		];
		curl_setopt($CURL, CURLOPT_POSTFIELDS, $DATA);
		$RESULT = curl_exec($CURL);
		
		if(!curl_errno($CURL)){
		   return json_decode($RESULT, TRUE);
		}
		curl_close($CURL);
	}
	
?>
