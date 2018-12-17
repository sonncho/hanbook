<? header("Content-type: text/html; charset=UTF-8"); ?>
<?
	include_once ('shop_init.php');

	/* 게시물 일련번호 받기 */
	$shop_document_id = get('shop_document_id', false);
	if (!$shop_document_id) {
		redirect(false, '게시물 일련번호가 없습니다. 정상적인 경로로 접급해주세요.');
	}

	/* 로그인 정보 받기 */
	$member_id = $member_info['id'];
	// --> 회원일련번호와 게시물아이디를 동시에 가진 관심상품이 있는지 조회한다
	$sql = "SELECT count(id) AS `cnt` FROM shop_like WHERE member_id=%d AND shop_document_id=%d ";
	$input = array($member_id, $shop_document_id);
	$like_cnt = db_query($sql, $input);

	$like_is = 'NO';
	if ($like_cnt[0]['cnt'] > 0 ) { $like_is = "OK" ;}

	/* 게시물 일련번호와 일치하는 본문 데이터 조회하기 */
	$sql = "SELECT id, shop_type, seller, book_name, author, public, lang, tel, FORMAT(onega, 0) as `onega`, FORMAT(price, 0) as `price`, count, content, hit, reg_date, edit_date, member_id FROM shop_document WHERE id=%d ";
	$input = array($shop_document_id);

	// 조회결과는 2차배열로 리턴
	$document = db_query($sql, $input);
	if ($document === false) {
		redirect(false, '게시물 읽기에 실패했습니다. 관리자에게 문의 바랍니다.');
	}
	if (count($document)<1) {
		redirect(false, '존재하지 않는 게시물입니다.');
	}

	for ($i=0; $i < count($document); $i++) { 
		$document[$i]['content'] = preg_replace("/\r|\n/", "<br/>", $document[$i]['content']);
	}

	/* 첨부파일 데이터 조회하기 */
	$sql = "SELECT id, file_name, file_type, file_size, file_path, reg_date, edit_date, shop_document_id 
		FROM shop_file 
		WHERE shop_document_id=%d ";
	$input = array($shop_document_id);
	$file_list = db_query($sql, $input);

	// SQL처리 에러인경우
	// 파일은 무조건 업로드 되야함 --> NOT NULL
	if ($file_list === false) {
		redirect(false, '첨부파일 조회에 실패했습니다. 관리자에게 문의 바랍니다.');
	}
	if (count($file_list) < 1) {
		redirect(false, '첨부파일이 존재하지 않습니다. 관리자에게 문의 바랍니다.');
	}
	if ($file_list !== FALSE && count($file_list)>0) {
			// 조회된 파일 경로
			$file_path = $file_list[0]['file_path'];

			// 경로에서 파일명과 파일이 저장된 폴더를 분리한다.
			$p = strrpos($file_path, '/');
			$file_name = substr($file_path, $p+1);  //123456.jpg
			$file_dir = substr($file_path, 0, $p);	//localhost/files/20170313

			// 썸네일이 저장될 파일 경로를 생성한다.
			$thumbnail = $file_dir.'/thumb_'.$file_name;
			// 생성될 썸네일 이미지를 게시물 목록에 추가한다.
			$file_list[0]['thumbnail']=$thumbnail;
		}

	/* 조회수 1 증가시키기 */
	// -->각 게시물을 고유하게 식별할 수 있는 이름 만들기
	$cookie_name = sprintf('shop_document_%s_%d', $shop_type, $shop_document_id);
	// 이 이름의 쿠키가 없을경우에만 조회수 갱신
	if (get_cookie($cookie_name, false) === false) {
		$sql = "UPDATE shop_document SET hit=hit+1 WHERE id=%d ";
		$input = array($shop_document_id);
		db_query($sql, $input);

		// 쿠키생성 -> 같은 게시물을 24시간 내에 다시 읽을 경우 조회수 갱신 않함
		set_cookie($cookie_name, 'Y', 24*60*60);
	}

	/* 문의 댓글 수 조회하기*/
	$sql ="SELECT count(id) AS `cnt` FROM shop_qna WHERE shop_document_id=%d";
	$input = array($shop_document_id);
	$shop_qna_cnt = db_query($sql, $input);
	if ($shop_qna_cnt === false) {
		redirect(false, '조회에 실패했습니다. 관리자에게 문의 바랍니ㅋ.');
	}
	/* 리뷰 댓글 수 조회하기*/

	/* 관심상품 등록 submit*/
	

	/* 템플릿 처리 */
	$tpl -> assign('like_cnt', $like_cnt[0]['cnt']);

	$tpl -> assign('like_is', $like_is);
	$tpl -> assign('document', $document[0]);
	$tpl -> assign('file_list', $file_list);
	$tpl -> assign('shop_qna_cnt', $shop_qna_cnt[0]);

	$tpl -> define('body', 'shop/shop_read.html');
	$tpl -> print_('body');
?>