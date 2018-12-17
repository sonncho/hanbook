<? header("Content-type: text/html; charset=UTF-8"); ?>
<?
	include_once ('com_init.php');

	/* 게시물 일련번호 받기 */
	$document_id = get('document_id', false);
	if (!$document_id) {
		redirect(false, '게시물 일련번호가 없습니다. 정상적인 경로로 접근해주세요.');
	}

	/* 게시물 일련번호와 일치하는 본문 데이터 조회하기 */
	$sql = 'SELECT id, com_type, member_id, writer_name, 
					email, subject, content, hit, reg_date, edit_date
			FROM com_document 
			WHERE id=%d';
	$input = array($document_id);
	$document = db_query($sql, $input);

	if ($document === false) {
		redirect(false, '게시물 읽기에 실패했습니다. 관리자에게 문의 바랍니다.');
	}
	if (count($document) < 1) {
		redirect(false, '존재하지 않는 게시물 입니다.');
	}

	// // 콘텐츠 출력시 <br> [ENTER]키 입력 출력
	$document[0]['content'] = preg_replace("/\r|\n/", "<br/>", $document[0]['content']);

	/* 게시물의 댓글 수 조회하기*/
	$sql = "SELECT COUNT(id) as `cnt` FROM com_comment WHERE com_document_id = %d";
	$cnt = db_query($sql, array($document_id));
	$document[0]['cnt'] = $cnt[0]['cnt'];

	/* 첨부파일 데이터 조회하기 */
	$sql = 'SELECT id, com_document_id, file_name, file_type,
				file_size, file_path, reg_date, edit_date 
			FROM com_file 
			WHERE com_document_id = %d';
	$input = array($document_id);
	$file_list = db_query($sql, $input);

	if ($file_list === false) {
		redirect(false, '첨부파일 조회에 실패했습니다. 관리자에게 문의 바랍니다.');
	}

	/* 이전 글 조회하기 */
	$sql = "SELECT id, subject FROM com_document 
			WHERE com_type='%s' AND id < %d 
			ORDER BY id DESC 
			LIMIT 0, 1";
	$input = array($com_type, $document_id);
	$prev_document = db_query($sql, $input);

	if ($prev_document === false) {
		redirect(false, '게시물 읽기에 실패했습니다. 관리자에게 문의 바랍니다.');
	} elseif (count($prev_document) < 1) {
		$prev_document = false;
	} else {
		$prev_document = $prev_document[0];
	}

	/* 다음 글 조회하기 */
	$sql = "SELECT id, subject FROM com_document 
			WHERE com_type = '%s' AND id > %d 
			ORDER BY id ASC 
			LIMIT 0, 1";
	$input = array($com_type, $document_id);
	$next_document = db_query($sql, $input);

	if ($next_document === false) {
		redirect(false, '게시물 읽기에 실패했습니다. 관리자에게 문의 바랍니다.');
	} elseif (count($next_document) < 1) {
		$next_document = false;
	} else {
		$next_document = $next_document[0];
	}

	/* 조회수 1 증가 시키기 */
	$cookie_name = sprintf('com_document_%s_%d', $com_type, $document_id);
	if (get_cookie($cookie_name, false) === false) {
		$sql = 'UPDATE com_document SET hit=hit+1 WHERE id=%d';
		$input = array($document_id);
		db_query($sql, $input);

		set_cookie($cookie_name, 'Y', 24*60*60);
	}

	$tpl -> assign('document', $document[0]);
	$tpl -> assign('prev_document', $prev_document);
	$tpl -> assign('next_document', $next_document);
	$tpl -> assign('file_list', $file_list);
	$tpl -> define('body', 'community/read.html');
	$tpl -> print_('body');
	
?>