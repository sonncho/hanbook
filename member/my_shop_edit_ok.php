<? header('Content-Type: text/html; charset=UTF-8'); ?>
<?
	include_once('../shop/shop_init.php');

	/* 사용자 입력값 받기 */
	$document_id = post('document_id', false);
	$shop_type = post('shop_type', false);
	$seller = post('seller', false);
	$tel = post('tel', false);
	$book_name = post('book_name', false);
	$author = post('author', false);
	$public = post('public', false);
	$lang = post('lang', false);
	$onega = post('onega', false);
	$price = post('price', false);
	$count = post('count', false);
	$content = post('content', false);

	/* 자신의 글에 대한 수정 요청인지 검사 */
	$is_mine = FALSE;
	if ($member_info !== false) {
		$sql = "SELECT count(id) AS `cnt` FROM shop_document WHERE id=%d AND member_id=%d ";
		$input = array($document_id, $member_info['id']);
		$result = db_query($sql, $input);

		if ($result !== false) {
			if ($result[0]['cnt'] > 0) {
				$is_mine = TRUE;
				$member_id = $member_info['id'];
				$seller = $member_info['user_name'];
				$tel = $member_info['tel'];
			}
		}
	}

	/* 입력값 검사 */
	if (!$book_name) { redirect(false, '책 이름을 입력해주세요.'); }
	if (!$author) { redirect(false, '책 저자를 입력해주세요.'); }
	if (!$public) { redirect(false, '출판사를 입력해주세요.'); }
	if (!$lang) { redirect(false, '발행언어를 입력해주세요.'); }
	if (!$onega) { redirect(false, '책 원가를 입력해주세요.'); }
	if (!$price) { redirect(false, '책 판매가를 입력해주세요.'); }
	if (!$count) { redirect(false, '책 수량을 입력해주세요.'); }
	if (!$content) { redirect(false, '본문을 입력해주세요.'); }

	/* 게시물 데이터 수정을 위한 SQL처리 */
	$sql = "UPDATE shop_document SET 
			shop_type='%s', seller='%s', tel='%s', book_name='%s', author='%s',
			public='%s', lang='%s', onega='%s', price='%s', count=%d, content='%s', edit_date=now(), member_id=%d 
			WHERE id=%d ";
	$input = array($shop_type, $seller, $tel, $book_name, $author, $public, $lang, $onega, $price, $count, $content, $member_id, $document_id);
	$result = db_query($sql, $input);

	if ($result === false || $result < 1) {
		redirect(false, '게시물 수정에 실패했습니다.');
	}

	/* 새롭게 등록된 첨부파일의 업로드 처리 */
	$file = do_upload('file');
	if (array($file)) {
		for ($i=0; $i<count($file); $i++) { 
			$sql = "INSERT INTO shop_file (shop_document_id, file_name, file_type, file_size, file_path, reg_date, edit_date ) 
				VALUES (%d, '%s', '%s', %d, '%s', now(), now() )";
			$input = array($document_id, $file[$i]['name'], $file[$i]['type'], $file[$i]['size'], $file[$i]['upload_uri'], );
			db_query($sql, $input);
		}
	}

	/* 삭제가 체크된 첨부파일의 처리 */
	$file_delete = post('file_delete', false);
	if (is_array($file_delete)) {
		// 선택값이 지정된 배열을 콤마로 사용하여 하나의 문자열로 반환
		$file_in = implode(',', $file_delete);
		// SQL의  IN절을 사용한다.(특정한 구문 여러개를 검색할 때 사용)
		$sql = "SELECT file_path FROM shop_file WHERE id IN (%s)";
		$result = db_query($sql, array($file_in));

		// 조회결과가 있다면 조회된 파일의 경로에 대한 삭제 처리를 수행
		if ($result) {
			for ($i=0; $i<count($result); $i++) { 
				$fname = $document_root.$result[$i]['file_path'];
				if (is_file($fname)) { unlink($fname); }
			}
		}
		db_query("DELETE FROM shop_file WHERE id IN (%s)", array($file_in));
	}

	/* 읽기 페이지로 이동 */
	// 읽을 대상을 지정 --> 게시물의 일련번호를 GET파라미터로 전달
	$url = sprintf('../shop/shop_read.php?shop_type=%s&shop_document_id=%d', $shop_type, $document_id);
	redirect($url, '수정되었습니다.');
?>