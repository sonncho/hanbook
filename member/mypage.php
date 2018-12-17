<? header('Content-Type: text/html; charset=UTF-8'); ?>
<?
	include_once '../inc/init.php';
	
	/* 회원정보받기 */
	$member_id = $member_info['id'];
	$seller = $member_info['user_name'];

	/* 내 관심상품 조회하기 */
	$sql = "SELECT id, shop_document_id, member_id FROM shop_like WHERE member_id=%d ";
	$my_like = db_query($sql, array($member_id));

	for ($i=0; $i<count($my_like); $i++) { 
		$shop_document_id = $my_like[$i]['shop_document_id'];
		$sql = "SELECT file_path FROM shop_file 
				WHERE shop_document_id=%d 
				AND left(file_type, 5) ='image' 
				ORDER BY id ASC LIMIT 0, 1";
		$file = db_query($sql, array($shop_document_id));

		if ($file !== FALSE && count($file)>0) {
			$file_path = $file[0]['file_path'];
			$p = strrpos($file_path, '/');
			$file_name = substr($file_path, $p+1);
			$file_dir = substr($file_path, 0, $p);
			$thumbnail = $file_dir.'/thumb_'.$file_name;
			$my_like[$i]['thumbnail'] = $thumbnail;
		}

		$sql = "SELECT shop_type, book_name, seller, price, tel FROM shop_document WHERE id=%d";
		$result = db_query($sql, array($shop_document_id));
		$my_like[$i]['shop_type']= $result[0]['shop_type'];
		$my_like[$i]['book_name']=$result[0]['book_name'];
		$my_like[$i]['seller']=$result[0]['seller'];
		$my_like[$i]['price']=$result[0]['price'];
		$my_like[$i]['tel']=$result[0]['tel'];
	}

	/* 내가올린 책 조회하기 */
	$sql = "SELECT id, shop_type, book_name FROM shop_document WHERE member_id=%d AND seller='%s' ORDER BY id DESC";
	$input = array($member_id, $seller);
	$my_book = db_query($sql, $input);

	/* 썸네일 이미지 추출 */
	for ($i=0; $i<count($my_book); $i++) { 
		$shop_document_id = $my_book[$i]['id'];
		$sql = "SELECT file_path FROM shop_file 
				WHERE shop_document_id=%d 
				AND left(file_type, 5)='image' 
				ORDER BY id ASC LIMIT 0, 1";
		$file = db_query($sql, array($shop_document_id));

		if ($file !== FALSE && count($file)>0) {
			$file_path = $file[0]['file_path'];
			$p = strrpos($file_path, '/');
			$file_name = substr($file_path, $p+1);
			$file_dir = substr($file_path, 0, $p);
			$thumbnail = $file_dir.'/thumb_'.$file_name;
			$my_book[$i]['thumbnail'] = $thumbnail;
		}
	}

	/* 내가 올린음 게시글 조회 */
	$sql = "SELECT id, com_type, subject, hit, reg_date FROM com_document WHERE member_id=%d AND writer_name='%s' ORDER BY id DESC";
	$input = array($member_id, $seller);
	$my_com = db_query($sql, $input);

	/* 내 게시물 댓글 갯수 조회*/
	for ($i=0; $i<count($my_com); $i++) { 
		$document_id=$my_com[$i]['id'];
		$sql = "SELECT COUNT(id) AS `cnt` FROM com_comment WHERE com_document_id=%d";
		$input = array($document_id);
		$result = db_query($sql, $input);
		$my_com[$i]['cnt'] = $result[0]['cnt'];
	}

	$tpl -> assign('my_like', $my_like);
	$tpl -> assign('my_book', $my_book);
	$tpl -> assign('my_com', $my_com);
	$tpl -> define('body', 'member/mypage.html');
	$tpl -> print_('body');

?>