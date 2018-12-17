<? header('Content-Type: text/html; charset=UTF-8'); ?>
<?
	include_once('shop_init.php');

	/* 어떤 게시물에 속한 덧글인지 판별하기 위한 게시글 일련번호 */
	$shop_document_id = post('shop_document_id', false);

	/* 사용자 입력값 받기 */
	$writer_name = post('writer_name', false);
	$writer_pw = post('writer_pw', false);
	$email = post('email', false);
	$content = post('content', false);

	$member_id = 0;
	if ($member_info !== false) {
		$member_id = $member_info['id'];
		$writer_name = $member_info['user_name'];
		$writer_pw = $member_info['user_pw'];
		$email = $member_info['email'];
	}

	/* 입력값 검사 */
	if (!$shop_document_id) { print_rest_api('게시물 일련번호값이 없습니다.', false);}
	if (!$writer_name) { print_rest_api('작성자 이름을 입력하세요.', false); }
	if (!$writer_pw) { print_rest_api('비밀번호를 입력하세요.', false); }
	if (!$email) { print_rest_api('이메일을 입력해주세요.', false); }
	if (!$content) { print_rest_api('문의 내용을 입력해주세요.', false); }

	/* 덧글 데이터 저장을 위한 SQL문 구성 */
	$sql = '';
	$input = false;

	if ($member_info !== false) {
		// 로그인한 경우의 SQL처리
		$sql = "INSERT INTO shop_qna (
					writer_name, writer_pw, email, content, 
					reg_date, edit_date, shop_document_id, member_id
				) VALUES (
					'%s', password('%s'), '%s', '%s', now(), now(), %d, %d
				)";
		$input = array($writer_name, $writer_pw, $email, $content, $shop_document_id, $member_id);
	} else {
		// 로그인 하지 않은 경우
		$sql = "INSERT INTO shop_qna (
					writer_name, writer_pw, email, content,
					reg_date, edit_date, shop_document_id, member_id
				) VALUES (
					'%s', password('%s'), '%s', '%s', now(), now(), %d, null
				)";
		$input = array($writer_name, $writer_pw, $email, $content, $shop_document_id);
	}

	/* SQL문 실행 */
	$shop_qna_id = db_query($sql, $input);
	if ($shop_qna_id === false) { print_rest_api('덧글 저장에 실패했습니다.', false); }

	/* 생성된 덧글의 일련번호를 사용하여 저장할 덧글 데이터 조회 */
	$sql = "SELECT writer_name, email, content, reg_date, edit_date, shop_document_id FROM shop_qna WHERE id=%d";
	$result = db_query($sql, array($shop_qna_id));

	if ($result === false) {
		print_rest_api('덧글 조회에 실패했습니다.', false);
	}
	if (count($result) < 1) {
		print_rest_api('조회된 데이터가 없습니다.', false);
	}
	for ($i=0; $i < count($result); $i++) { 
		$result[$i]['content'] = preg_replace("/\r|\n/", "<br/>", $result[$i]['content']);
	}

	/* 성공적으로 조회되었다면 JSON으로 출력할 데이터 구성 */
	$item = array('item' => $result[0]);
	print_rest_api('OK', $item);
?>