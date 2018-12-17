<? header('Content-Type: text/html; charset=UTF-8'); ?>
<?
	include_once('com_init.php');

	/* 게시물 일련번호 받기 */
	$document_id = get('document_id', false);
	if (!$document_id) {
		print_rest_api('게시물 일련번호가 없습니다.', false);
	}

	/* 게시물 일련번호에 속한 모든 덧글 데이터 조회하기 */
	$sql = "SELECT id, writer_name, content, reg_date FROM com_comment WHERE com_document_id=%d ORDER BY id ASC";
	$result = db_query($sql, array($document_id));

	if ($result === FALSE) {
		print_rest_api('게시물 조회에 실패했습니다.', false);
	}

	for($i=0; $i<count($result); $i++) {
		$result[$i]['content'] = preg_replace("/\r|\n/", "<br/>", $result[$i]['content']);
	}

	/* 조회결과를 JSON으로 출력하기 */
	$item = array('item' => $result);
	print_rest_api('OK', $item);
?>