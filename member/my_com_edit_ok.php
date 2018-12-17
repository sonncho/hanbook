<? header("Content-Type: text/html; charset=UTF-8"); ?>
<?
	include_once('../community/com_init.php');

	/* 사용자 입력값 받기 */
	$com_document_id = post('com_document_id', false);
	$com_type = post('com_type', false);
	$subject = post('subject', false);
	$writer_name = post('writer_name', false);
	$email = post('email', false);
	$content = post('content', false);

	$is_mine = FALSE;
	if ($member_info !== false) {
		$sql = "SELECT count(id) AS `cnt` FROM com_document WHERE id=%d AND member_id=%d ";
		$input = array($com_document_id, $member_info['id']);
		$result = db_query($sql, $input);

		if ($result !== false) {
			if ($result[0]['cnt'] > 0) {
				$is_mine = TRUE;
				$member_id = $member_info['id'];
				$writer_name = $member_info['user_name'];
				$email = $member_info['email'];
			}
		}
	}

	/* 입력값 검사 */
	if (!$subject) { redirect(false, '제목을 입력해주세요.');}
	if (!$content) { redirect(false, '내용을 입력해주세요.');}

	/* 게시물 데이터 수정을 위한 SQL처리 */
	$sql = "UPDATE com_document SET 
			com_type='%s', subject='%s', writer_name='%s', 
			email='%s', content='%s', edit_date=now(), member_id=%d 
			WHERE id=%d";
	$input = array($com_type, $subject, $writer_name, $email, $content, $member_id, $com_document_id);
	$result = db_query($sql, $input);

	if ($result === false || $result<1) {
		redirect(false, '게시물 수정에 실패했습니다.');
	}

	/* 새롭게 등록된 첨부파일의 업로드 처리 */
	$file = do_upload('file');
	if (array($file)) {
		for ($i=0; $i<count($file); $i++) { 
			$sql = "INSERT INTO com_file ( com_document_id, file_name, file_type, file_size, file_path, reg_date, edit_date) 
			VALUES (%d, '%s', '%s', %d, '%s', now(), now())";
			$input = array($com_document_id, $file[$i]['name'], $file[$i]['type'], $file[$i]['size'], $file[$i]['upload_uri']);
			db_query($sql, $input);
		}
	}

	 /* 삭제가 체크된 첨부파일의 처리 */
	 $file_delete = post('file_delete', false);
	 if (is_array($file_delete)) {
	 	$file_in = implode(',', $file_delete);
	 	$sql = "SELECT file_path FROM com_file WHERE id IN(%s)";
	 	$result = db_query($sql, array($file_in));

	 	if ($result) {
	 		for ($i=0; $i<count($result); $i++) { 
	 			$fname = $document_root.$result[$i]['file_path'];
	 			if (is_file($fname)) { unlink($fname); }
	 		}
	 	}
	 	db_query("DELETE FROM com_file WHERE id IN (%s)", array($file_in));
	}
	
 	/* 읽기 페이지로 이동 */
 	// 읽을 대상을 지정 --> 게시물 일련번호를 GET파라미터로 전달
 	$url = sprintf('../community/read.php?com_type=%s&document_id=%d', $com_type, $com_document_id);
 	redirect($url, '수정되었습니다.');
?>