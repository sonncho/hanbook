<? header('Content-Type: text/html; charset=UTF-8'); ?>
<?
	include_once '../inc/init.php';

	/* 사용자의 입력값 받기 */
	$email = post('email', FALSE);

	/* 필수 입력값 검사 */
	if (!$email) {
		redirect(false, '이메일을 입력해주세요.');
	}

	/* 가입된 이메일인지 검사 */
	$sql = "SELECT count(id) as cnt FROM member WHERE email='%s' ";
	$input = array($email);
	$result = db_query($sql, $input);

	if ($result === false) {
		redirect(false, '이메일 검사에 실패했습니다.');
	}
	$email_count = $result[0]['cnt'];
	if ($email_count < 1) {
		redirect(false, '가입된 이메일이 아닙니다.');
	}

	/* 임의의 신규 비밀번호 생성 */
	$new_password = '';

	//임의의 비밀번호 생성하기
	// 모든글자나열후 이 문장에서 무작위로 한 글자씩 추출
	$word = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789!@#';

	// 생성할 글자수만큼 반복
	for ($i=0; $i<8 ; $i++) { 
		$r = rand(0, mb_strlen($word)-1 );
		$w = substr($word, $r, 1);
		$new_password .= $w;
	}

	/* 신규 비밀번호를 DB에 UPDATE */
	$sql = "UPDATE member SET user_pw=password('%s'), edit_date=now() WHERE email='%s' ";
	$input = array($new_password, $email);
	$result = db_query($sql, $input);

	if ($result == false) {
		redirect(false, '비밀번호 갱신에 실패했습니다.');
	}
	if ($result < 1) {
		redirect(false, '일치하는 이메일이 없습니다.');
	}

	/* 변경된 비밀번호를 이메일로 전송 */
	$mail_ok = send_mail(
		'dungcho93@icloud.com', '관리자', $email, false, '회원님의 비밀번호가 변경되었습니다.', sprintf("<h1>회원님의 임시 비밀번호는 <font color='red'>[%s]</font>입니다.</h1>", $new_password)
	);
	if ($mail_ok === false) {
		redirect(false, '이메일 발송에 실패했습니다.');
	}

	/* 모든 성공이라면 로그인페이지로 이동 */
	redirect($home_url.'/member/login.php', '이메일로 비밀번호를 전송해 드렸습니다.');
?>