<? header('Content-Type: text/html; charset=UTF-8'); ?>
<?
	include_once('com_init.php');

	/* 사용자 입력값 받기 */
	$comment_id = post('comment_id', false);
	$writer_name = post('writer_name', false);
	$writer_pw = post('writer_pw', false);
	$content = post('content', false);

	/* 자신의 글에 대한 수정 요청인지 검사한다.*/
	$is_mine = false;
	if ($member_info !== false) {
		$sql = "SELECT count(id) as `cnt` FROM com_comment WHERE id=%d AND member_id=%d ";
		$input = array($comment_id, $member_info['id']);
		$result = db_query($sql, $input);

		if ($result !== false) {
			if ($result[0]['cnt'] > 0) {
				$is_mine = TRUE;
				$writer_name = $member_info['user_name'];
				$writer_pw = $member_info['user_pw'];
			}
		}
	}

	/* 입력값 검사 */
	if (!$comment_id) {print_rest_api('덧글 번호가 없습니다.', false);}
	if (!$writer_name) { print_rest_api('작성자 이름을 입력하세요.', false); }
	if (!$writer_pw) { print_rest_api('비밀번호를 입력하세요.', false); }
	if (!$content) { print_rest_api('글 내용을 입력하세요.', false); }

	/* 자신의 글이 아닐경우 비밀번호 검사하기 */
	if ($is_mine === false) {
		$sql = "SELECT count(id) as `cnt` FROM com_comment WHERE id=%d AND writer_pw=password('%s')";
		$input = array($comment_id, $writer_pw);
		$result = db_query($sql, $input);
		if ($result === false) {
			print_rest_api('비밀번호 검사에 실패했습니다.', false);
		}
		$cnt = $result[0]['cnt'];
		if ($cnt < 1) {
			print_rest_api('잘못된 비밀번호를 입력하셨습니다.', false);
		}
	}

	/* 덧글 데이터 수정을 위한 SQL처리 */
	$sql = "UPDATE com_comment SET writer_name='%s', content='%s', edit_date=now() WHERE id=%d";
	$input = array($writer_name, $content, $comment_id);
	$result = db_query($sql, $input);

	if ($result === false || $result<1) {
		print_rest_api('덧글 수정에 실패했습니다.', false);
	}

	/* 수정된 덧글 데이터 조회하기 */
	$sql = "SELECT id, writer_name, content, reg_date FROM com_comment WHERE id=%d";
	$result = db_query($sql, array($comment_id));

	if ($result === false || count($result)<1) {
		print_rest_api('덧글 조회에 실패했습니다.', false);
	}

	/* 조회결과를 순환하면서 사용자의 엔터키를 <br>태그로 변경한다. */
	for ($i=0; $i<count($result); $i++) { 
		$result[$i]['content'] = preg_replace("/\r|\n/", "<br/>", $result[$i]['content']);
	}

	/* 수정된 내역을 JSON으로 표현한다. */
	print_rest_api('OK', array('item'=>$result[0]));

?>