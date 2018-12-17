<? header('Content-Type: text/html; charset=UTF-8'); ?>
<?
	include_once('shop_init.php');

	/* 사용자 입력값 받기 */
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

	if ($member_info !== false) {
		$member_id = $member_info['id'];
		$seller = $member_info['user_name'];
		$tel = $member_info['tel'];
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

	/* 게시물 데이터 저장 */
	$sql = '';
	$input = false;

	if ($member_info !== false) {
		// 로그인한 경우 처리
		$sql = "INSERT INTO shop_document (
						shop_type, seller, tel, book_name, author,
						public, lang, onega, price, count, content,
						hit, reg_date, edit_date, member_id
				) VALUES (
						'%s', '%s', '%s', '%s', '%s',
						'%s', '%s', '%s', '%s', %d, '%s',
						0, now(), now(), %d 
				) ";
		$input = array($shop_type, $seller, $tel, $book_name, $author, $public, $lang, $onega, $price, $count, $content, $member_id);

	}
	// 성공시 게시물 번호가 리턴됨
	$shop_document_id = db_query($sql, $input);
	if ($shop_document_id === false) {
		redirect(false, '게시물저장에 실패했습니다. 관리자에게 문의하세요.');
	}

	/* 첨부파일 업로드 처리 */
	$file = do_upload('file');

	// 업로드된 파일 정보 저장하기
	// 첨부파일 갯수 정하기
	if (count($file)<3 || count($file)>5) {
		redirect(false , '첨부파일은 최소3장 최대5장입니다.');
	}
	if (is_array($file)) {
		// 업로드된 파일수 만큼 반복
		for ($i=0; $i<count($file); $i++) { 
			$sql = "INSERT INTO shop_file (
						shop_document_id, file_name, file_type,
						file_size, file_path, reg_date, edit_date
			) VALUES (
				%d, '%s', '%s', %d, '%s', now(), now()
			) ";

			$input = array($shop_document_id, $file[$i]['name'], $file[$i]['type'], $file[$i]['size'], $file[$i][upload_uri]);
			// 저장한다.
			db_query($sql, $input);
		}
	}

	/* 저장완료시 읽기페이지로 이동 */
	$url = 'shop_read.php?shop_type=%s&shop_document_id=%d';
	$url = sprintf($url, $shop_type, $shop_document_id);
	redirect($url, false);
?>