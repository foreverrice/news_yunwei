<?php
		include_once('xmlrpc.php');
	//	$toupiaoDataEdit = dirname(dirname(__FILE__)).'/wp-content/themes/news/toupiaoDataEdit.cache';
	//	$tuopiaoDataCache = dirname(dirname(__FILE__)).'/wp-content/themes/news/toupiaoData.cache';
	//	$tuopiaoData = unserialize(file_get_contents($shidianDataEdit));
		$id=$_GET['id'];
        $shidian = new xmlrpc_client('http://www.ci123.com/special/rpc/vote.php', 'view');
        $result = $shidian->call('getVote',$id);
	/*	
		$special_id=$result['special_id'];
		$question=$result['question'];
		$answer1=$result['answer1'];
		$answer2=$result['answer2'];
		$num1=$result['num1'];
		$num2=$result['num2'];


		$tuopiaoData = array(
		'special_id'   => $special_id,
		'question'   => $question,
		'answer1'   => $answer1,
		'answer2'   => $answer2,
		'num1'   => $num1,
		'num2'   => $num2
		);
		
		$output = serialize($tuopiaoData);
		$fp = fopen($toupiaoDataEdit, "w");
		fputs($fp, $output);
		fclose($fp);

		$tuopiaoData = file_get_contents($toupiaoDataEdit);
		$fp = fopen($toupiaoDataCache, "w");
		fputs($fp, $tuopiaoData);
		fclose($fp);
	*/
	echo json_encode($result);
        
?>
