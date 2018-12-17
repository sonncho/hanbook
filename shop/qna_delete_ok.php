<? header('Content-Type: text/html; charset=UTF-8'); ?>
<?
	include_once('shop_init.php');

	/* 파라미터 처리 */
	$shop_qna_id = post('shop_qna_id', false);
	$writer_pw = post('writer_pw', false);
	if (!$shop_qna_id) {
		print_rest_api('덧글 번호가 지정되지 않았습니다.', false);
	}
	/* 자신의 덧글에 대한 삭제 요청인지 검사한다. */
	$is_mine = FALSE;
	if ($member_info !== false) {
		$sql = "SELECT count(id) AS `cnt` FROM shop_qna WHERE id=%d AND member_id=%d";
		$input = array($shop_qna_id, $member_info['id']);
		$result = db_query($sql, $input);

		if ($result !== false) {
			if ($result[0]['cnt']>0) {
				$is_mine=TRUE;
			}
		}
	}
	/* 비밀번호 검사 수행은 자신의 글이 아닐 경우만 수행 */
	if ($is_mine === FALSE) {
		$sql = "SELECT count(id) as `cnt` FROM shop_qna WHERE id=%d AND writer_pw=password('%s')";
		$input = array($shop_qna_id, $writer_pw);
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
	$sql = "DELETE FROM shop_qna WHERE id=%d";
	$input = array($shop_qna_id);
	db_query($sql, $input);

	/* 삭제 완료를 의미하는 JSON출력 */
	print_rest_api('OK', array('shop_qna_id' => $shop_qna_id));

?>