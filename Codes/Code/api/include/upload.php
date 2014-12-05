<?php
require_once 'SimpleImage.php';
if ( !empty( $_FILES ) ) {
	
	if(isset($_FILES['news_image']['name']) != ""){
		$dir = '../uploads/news/';
		$unique = strtoupper(md5(uniqid(rand(), true)));	
		$image = new SimpleImage();
		$image->load($_FILES['news_image']['tmp_name']);
		$image->resizeToWidth(466);
		$image->save($dir.$unique.$_FILES['news_image']['name']);
		$response = array('error' => false, 'message'=>'File transfered completed!','image' =>$unique.$_FILES['news_image']['name']);
		$json = json_encode($response);
		echo $json;
	}elseif(isset($_FILES['slider_image']['name']) !=''){
		$dir = '../uploads/slider/';
		$unique = strtoupper(md5(uniqid(rand(), true)));	
		$image = new SimpleImage();
		$image->load($_FILES['slider_image']['tmp_name']);
		$image->resize(466,350);
		$image->save($dir.$unique.$_FILES['slider_image']['name']);
		$response = array('error' => false, 'message'=>'File transfered completed!','image' =>$unique.$_FILES['slider_image']['name']);
		$json = json_encode($response);
		echo $json;
	}elseif(isset($_FILES['event_image']['name']) !=''){
		$dir = '../uploads/events/';
		$unique = strtoupper(md5(uniqid(rand(), true)));	
		$image = new SimpleImage();
		$image->load($_FILES['event_image']['tmp_name']);
		$image->resizeToWidth(466);
		$image->save($dir.$unique.$_FILES['event_image']['name']);
		$response = array('error' => false, 'message'=>'File transfered completed!','image' =>$unique.$_FILES['event_image']['name']);
		$json = json_encode($response);
		echo $json;
	}elseif(isset($_FILES['fixedads_image']['name']) !=''){
		$dir = '../uploads/bannerAds/';
		$unique = strtoupper(md5(uniqid(rand(), true)));	
		$image = new SimpleImage();
		$image->load($_FILES['fixedads_image']['tmp_name']);
		//$image->resizeToWidth(466);
		$image->save($dir.$unique.$_FILES['fixedads_image']['name']);
		$response = array('error' => false, 'message'=>'File transfered completed!','image' =>$unique.$_FILES['fixedads_image']['name']);
		$json = json_encode($response);
		echo $json;
	}else{
		$response = array('error' => true, 'message'=>'Bad Request');
		$json = json_encode($response);
		echo $json;	
	}
} else {

    echo 'No files';

}

?>