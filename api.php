<?php
	require_once("config.php");
	require_once("class/statisticClass.php");
	
	//the user selects the date from and to

	$time1 = $_GET["start"];
	$time2 = $_GET["end"];
	
	$arg = array(
		"start" => $time1,
		"end" => $time2,
		"link" => $link,
		"file" => "file.txt"
	);
	
	$stat = new statistic($arg);

	header('Content-type: application/json');

	$response = array();
	$response[0] = array(
		'error' => $stat->err,
		'message'=> $stat->message,
		'sfrom'=> $stat->getInfoSimple()['start'],	
		'sto'=> $stat->getInfoSimple()['end'],	
		'data'=> 
			array(
				'mysql_st' => $stat->getInfoMysql(),
				'file_st'=> $stat->getInfoFile(),
				'google_st' => $stat->getInfoGoogle(),
				'all_st' => $stat->getInfoAll()
			)
	);

	echo json_encode($response);	
?>