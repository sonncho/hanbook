<? header('Content-Type: text/html; charset=UTF-8'); ?>
<?
	include_once('com_init.php');

	/* 어떤 게시물에 속한 덧글인지 판별하기 위한 게시글 일련번호 */
	$document_id = post('document_id', false);

	/* 사용자 입력값 받기*/
	$writer_name = post('writer_name', false);
	$writer_pw = post('writer_pw', false);
	$content = post('content', false);

	// 회원의 일련번호값 --> 비회원인 경우 0으로 저장한다.
	$member_id = 0;

	if ($member_info !== false) {
		$member_id = $member_info['id'];
		$writer_name = $member_info['user_name'];
		$writer_pw = $member_info['user_pw'];
	}

	/* 입력값 검사 */
	if (!$document_id) { print_rest_api('게시물 일련번호 값이 없습니다.', false);}
	if (!$writer_name) { print_rest_api('작성자 이름을 입력하세요.', false); }
	if (!$writer_pw) { print_rest_api('비밀번호를 입력하세요.', false); }
	if (!$content) { print_rest_api('덧글 내용을 입력하세요.', false); }

	/* 덧글 데이터 저장을 위한 SQL문 구성 */
	$sql = '';
	$input = false;

	if ($member_info !== false) {
		$sql = "INSERT INTO com_comment (
					writer_name, writer_pw, content, 
					reg_date, edit_date, com_document_id, member_id
				) VALUES (
					'%s', '%s', '%s', now(), now(), %d, %d
				)";
		$input = array($writer_name, $writer_pw, $content, $document_id, $member_id);
	} else {
		$sql = "INSERT INTO com_comment (
					writer_name, writer_pw, content,
					reg_date, edit_date, com_document_id, member_id
				) VALUES (
					'%s', password('%s'), '%s', now(), now(), %d, null
				)";
		$input = array($writer_name, $writer_pw, $content, $document_id);
	}

	/* SQL구문 실행하기*/
	$comment_id = db_query($sql, $input);

	if ($comment_id === false) {
		print_rest_api('덧글 저장에 실패했습니다.', false);
	}

	/* 생성된 댓글의 일련번호를 사용하여 저장된 덧글 데이터를 조회 */
	$sql ="SELECT id, writer_name, content, reg_date, edit_date, com_document_id FROM com_comment WHERE id=%d";
	$result = db_query($sql, array($comment_id));

	if($result === FALSE) {
		print_rest_api('덧글 조회에 실패했습니다.', false);
	}
	if (count($result) < 1) {
		print_rest_api('조회된 덧글이 없습니다.', false);
	}

	/* 조회결과를 순환하면서 사용자의 엔터키를 <br>태그로 변경한다. */
	for($i=0; $i<count($result); $i++) {
		$result[$i]['content'] = preg_replace("/\r|\n/", "<br/>", $result[$i]['content']);
	}

	/* 성공적으로 조회되었다면 JSON으로 출력할 데이터 구성 */
	$item = array('item' => $result[0]);
	print_rest_api('OK', $item);
?>