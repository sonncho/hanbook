<? header('Content-Type: text/html; charset=UTF-8'); ?>
<?
	include_once('../shop/shop_init.php');

	/* 파라미터 처리 */
	$document_id = post('document_id', false);
	$pwd = post('pwd', FALSE);
	// 삭제할 대상을 의미하는 글 번호의 존재여부 검사
	if (!$document_id) {
		redirect(false, '글 번호가 지정되지 않았습니다.');
	}

	/* 자신의 글에 대한 삭제 요청인지 검사 */
	$is_mine = FALSE;
	if ($member_info !== FALSE) {
		$sql = "SELECT count(id) AS `cnt` FROM shop_document WHERE id=%d AND member_id=%d";
		$input = array($document_id, $member_info['id']);
		$result = db_query($sql, $input);

		if ($result != FALSE) {
			if ($result[0]['cnt']>0) {
				$is_mine = TRUE;
			}
		}
	}

	/* 비밀번호 검사 수행은 자신의 글이 아닐 경우만 수행 */
	if ($is_mine === FALSE) {
		$sql = "SELECT count(id) as `cnt` FROM shop_document WHERE id=%d AND writer_pw=password('%s')";
		$input = array($document_id, $pwd);
		$result = db_query($sql, $input);

		if($result === false) {
			redirect(false, '비밀번호 검사에 실패했습니다. 관리자에게 문의 바랍니다.');
		}
		if ($result[0]['cnt']) {
			if ($cnt < 1) {
				redirect(false, '잘못된 비밀번호를 입력하셨습니다.');
			}
		}
	}

	/* 비밀번호 검사에 성공한 경우 게시글 관련 데이터 삭제 수행*/
	//(1) 첨부파일 목록 조회하기
	$sql = "SELECT file_path FROM shop_file WHERE shop_document_id=%d";
	$input = array($document_id);
	$file_list = db_query($sql, $input);

	if ($file_list !== false) {
		for ($i=0; $i<count($file_list); $i++) { 
			$fname = $document_root.$file_list[$i]['file_path'];
			if (is_file($fname)) {
				unlink($fname);
			}
			// 썸네일 이미지의 이름을 추출하여 삭제
			$p = strrpos($fname, '/');
			$dir = substr($fname, 0, $p);
			$fname = substr($fname, $p+1);
			$thumb_path = $dir."/thumb_".$fname;
			if (is_file($thumb_path)) {
				unlink($thumb_path);
			}
		}
	}
	//(2) 참조키 제약조건에 의해서 첨부턴 파일의 목록을 먼저 삭제
	$sql = "DELETE FROM shop_file WHERE shop_document_id=%d";
	$input = array($document_id);
	db_query($sql, $input);

	// 게시글에 속한 덧글을 먼저 삭제
	$sql = "DELETE FROM shop_qna WHERE shop_document_id=%d";
	$input = array($document_id);
	db_query($sql, $input);
	
	//(3) 게실물 데이터 삭제
	$sql = "DELETE FROM shop_document WHERE id=%d";
	$input = array($document_id);
	db_query($sql, $input);

	/* 삭제 완료 후 글 목록으로 이동 */
	redirect('mypage.php', '삭제되었습니다.');
?>