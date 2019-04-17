<?php
    include_once('inc/init.php');

    $sql = "SELECT * FROM `news_term_relationships` WHERE `term_taxonomy_id` = '110'";

    $data = Db::getRows($sql);

    foreach ($data as $d)
	{
		echo $sql = "UPDATE `news_posts` SET `post_status` = 'publish' WHERE `ID` = '".$d['object_id']."';"."<br />";
	}

