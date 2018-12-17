<? header('Content-Type: text/html; charset=UTF-8'); ?>
<?
	include_once('../community/com_init.php');

	$document_id = get('document_id', false);
	if (!$document_id) {
		redirect(false, '게시물 일련번호가 없습니다. 정상적인 경로로 접근해주세요.');
	}

	$sql = "SELECT id, com_type, writer_name, email, subject, content, hit, reg_date, edit_date, member_id FROM com_document WHERE id=%d ";
	$input = array($document_id);
	$document = db_query($sql, $input);

	if (!$document) {
		redirect(false, '게시물 읽기에 실패했습니다. 관리자에게 문의바랍니다.');
	}

	if (count($document) < 1) {
		redirect(false, '존재하지 않는 게시물 입니다.');
	}

	$document = $document[0];

	/* 첨부파일 데이터 조회하기 */
	$sql = "SELECT id, com_document_id, file_name, file_type, file_size, file_path, reg_date, edit_date FROM com_file WHERE com_document_id=%d ";
	$input = array($document_id);
	$file_list = db_query($sql, $input);

	if ($file_list===false) {
		redirect(false, '첨부파일 조회에 실패했습니다. 관리자에게 문의 바랍니다.');
	}

	if (count($file_list) < 1) {
		$file_list = false;
	}

	/* 자신의 글에 대한 수정 요청인지 검사한다. */
	$is_mine = FALSE;

	if ($member_info !== false) {
		if($document['member_id'] == $member_info['id']) {
			$is_mine = TRUE;
		}
	}

	$tpl -> assign('is_mine', $is_mine);
	$tpl -> assign('com_document', $document);
	$tpl -> assign('com_file_list', $file_list);

	$tpl -> define('body', 'community/com_edit.html');
	$tpl -> print_('body');
?>