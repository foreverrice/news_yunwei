<?php
	include_once('init.php');
	class C
	{
		/**
		 * 获取标签ID
		 */
		function getTagId($tag)
		{
			$sql = "SELECT * FROM `news_terms` WHERE `name` = '".$tag."' LIMIT 1";
		    $tagInfo = Db::getRow($sql);
			return $tagInfo ? $tagInfo['term_id'] : false;
		}

		/**
		 * 根据标签ID取文章
		 */
		function getPostsByTagID($tag_id, $page, $limit)
		{
			$start = ($page - 1)*$limit;
			$sql = "SELECT a.ID, a.post_date, a.post_title, a.post_excerpt FROM `news_term_relationships` LEFT JOIN `news_posts` a ON a.ID = object_id AND term_taxonomy_id = '".$tag_id."' AND term_taxonomy_id != '109' WHERE a.post_status = 'publish' ORDER BY a.ID DESC LIMIT $start,$limit";
			$posts = Db::getRows($sql);
			return $posts ? $posts : false;
		}


		/**
		 * 根据文章ID取文章
		 */
		function getPostContentByID($post_id){
			$sql = "SELECT ID, post_date, post_title, post_content FROM `news_posts` WHERE ID = ".$post_id;
			$post = Db::getRow($sql);
			if($post){
				$sql = "SELECT a.name as tag_name FROM `news_term_relationships` LEFT JOIN `news_terms` a ON a.term_id = term_taxonomy_id and term_taxonomy_id>45 and term_taxonomy_id != '109' WHERE object_id = ".$post_id;
				$tags = Db::getRows($sql);
				$tagstr = "";
				foreach($tags as $tag){
					if(empty($tagstr)){
						$tagstr = $tag['tag_name'];
					}else{	
						$tagstr .= "、".$tag['tag_name'];
					}
				}
				$post['tag'] = $tagstr;
			}
			return $post ? $post : false;
		}

		/**
		 * 根据标签ID取文章总数
		 */
		function getPostsNumByTagID($tag_id)
		{
			$sql = "SELECT count(a.ID) as count FROM `news_term_relationships` LEFT JOIN `news_posts` a ON a.ID = object_id AND term_taxonomy_id = '".$tag_id."' AND term_taxonomy_id != '109' WHERE a.post_status = 'publish'";

			$result = Db::getRow($sql);
			return $result['count'];
		}

	}

?>
