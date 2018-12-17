<? header("Content-type: text/html; charset=UTF-8"); ?>
<?
	include_once ('inc/init.php');

	// 특정 타입의 게시물을 $cnt개 만큼 조회해서 리턴
	function getArticleList($cnt) {
		$sql = "SELECT id, shop_type, book_name, onega, price, count, reg_date
				FROM shop_document 
				ORDER BY id DESC LIMIT 0, %d";
		$list = db_query($sql, array($cnt));
		if ($list === false) {
			redirect(false, '게시물 목록 조회에 실패했습니다.');
		}
		return $list;
	}
	$shop_list = getArticleList(12);

	for ($i=0; $i<count($shop_list); $i++) { 
		$document_id = $shop_list[$i]['id'];
		$sql = "SELECT file_path, file_name FROM shop_file 
				WHERE shop_document_id=%d AND left(file_type, 5)='image' 
				ORDER BY id ASC LIMIT 0, 1";
		$file = db_query($sql, array($document_id));
		$shop_list[$i]['file_path']=$file[0]['file_path'];

		if ($file !== FALSE && count($file)>0) {
			$file_path = $file[0]['file_path'];
			$p = strrpos($file_path, '/');
			$file_name = substr($file_path, $p+1);
			$file_dir = substr($file_path, 0, $p);
			$thumbnail = $file_dir.'/thumb_'.$file_name;
			$shop_list[$i]['thumbnail'] = $thumbnail;
		}
	}



	$tpl -> assign('shop_list', $shop_list);
	$tpl -> define('body', 'index.html');
	$tpl -> print_('body');
?>