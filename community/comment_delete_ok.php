<? header('Content-Type: text/html; charset=UTF-8'); ?>
<?
	/* 게시판 공통 설정파일을 참조 */
	include_once('com_init.php');

	/* 파라미터 처리 */
	$comment_id = post('comment_id', FALSE);
	$writer_pw = post('writer_pw', FALSE);
	if (!$comment_id) {
		print_rest_api('덧글 번호가 지정되지 않았습니다.', false);
	}

	/* 자신의 덧글에 대한 삭제 요청인지 검사한다. */
	$is_mine = FALSE;
	if($member_info !== FALSE) {
		$sql = "SELECT count(id) AS `cnt` FROM com_comment WHERE id=%d AND member_id=%d";
		$input = array($comment_id, $member_info['id']);
		$result = db_query($sql, $input);

		if ($result !== FALSE) {
			if ($result[0]['cnt']>0) {
				$is_mine = TRUE;
			}
		}
	}

	/* 비밀번호 검사 수행은 자신의 글이 아닐 경우만 수행한다. */
	if ($is_mine === FALSE) {
		$sql = "SELECT count(id) as `cnt` FROM com_comment WHERE id=%d AND writer_pw=password('%s')";
		$input = array($comment_id, $writer_pw);
		$result = db_query($sql, $input);

		if ($result === FALSE) {
			print_rest_api('비밀번호 검사에 실패했습니다.', FALSE);
		}
		$cnt = $result[0]['cnt'];
		if ($cnt < 1) {
			print_rest_api('잘못된 비밀번호를 입력하셨습니다.', FALSE);
		}
	}

	/* 덧글 데이터를 삭제한다. */
	$sql = "DELETE FROM com_comment WHERE id=%d";
	$input = array($comment_id);
	db_query($sql, $input);

	/* 삭제 완료를 의미하는 JSON출력 */
	print_rest_api('OK', array('comment_id' => $comment_id));
?>