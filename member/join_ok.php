<? header('Content-Type: text/html; charset=UTF-8'); ?>
<?
	include_once '../inc/init.php';

	/* 사용자의 입력값 받기 */
	$user_id = post('user_id', false);
	$user_pw = post('user_pw', false);
	$user_pw_re = post('user_pw', false);
	$user_name = post('user_name', false);
	$email = post('email', false);
	$tel = post('tel', false);
	$postcode = post('postcode', false);
	$addr1 = post('addr1', false);
	$addr2 = post('addr2', false);

	/* 필수 입력값 받기 */
	if (!$user_id) { redirect(false, '아이디를 입력해주세요.'); }
	if (!$user_pw) { redirect(false, '비밀번호를 입력해주세요.'); }
	if (!$user_pw_re) { redirect(false, '비밀번호 확인값을 입력해주세요.'); }
	if (!$user_name) { redirect(false, '이름을 입력해주세요.'); }
	if (!$email) { redirect(false, '이메일을 입력해주세요.'); }
	if (!$tel) { redirect(false, '연락처를 입력해주세요.'); }
	if (!$postcode) { redirect(false, '우편번호를 입력해주세요.'); }
	if (!$addr1) { redirect(false, '주소를 입력해주세요.'); }
	if (!$addr2) { redirect(false, '상세주소를 입력해주세요.'); }

	/* 비밀번호 확인 */
	if ($user_pw != $user_pw_re) {
		redirect(false, '비밀번호 확인이 잘못되었습니다.');
	}

	/* 유효성 검사 */
	// --> 아이디
	$idreg = "/^[a-zA-Z0-9]{6,15}$/";
	if (!preg_match($idreg, $user_id)) {
		redirect(false, '아이디는 숫자와 영문자 조합으로 6~15자리로 입력해주세요.');
	}
	// --> 이메일
	$emailreg = "/^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/";
	if (!preg_match($emailreg, $email)) {
		redirect(false, '이메일 형식이 올바르지 않습니다.');
	}

	// --> 비밀번호
	$pwreg = "/^[a-zA-Z0-9]+$/";
	if (!preg_match($pwreg, $user_pw)) {
		redirect(false, '비밀번호는 영문 숫자 조합으로만 가능합니다.');
	}

	/* 아이디 중복검사 */
	$sql = "SELECT count(id) as `cnt` FROM member WHERE user_id='%s' ";
	$input = array($user_id);
	$result = db_query($sql, $input);

	if ($result === false) {
		redirect(false, '아이디 중복검사에 실패했습니다.');
	}
	if ($result[0]['cnt'] > 0) {
		redirect(false, '이미 사용중인 아이디입니다.');
	}

	/* 이메일 중복검사 */
	$sql = "SELECT count(id) as `cnt` FROM member WHERE email='%s' ";
	$input = array($email);
	$result = db_query($sql, $input);

	if ($result === false) {
		redirect(false, '이메일 중복검사에 실패했습니다.');
	}

	if ($result[0]['cnt'] > 0) {
		redirect(false, '이미 사용중인 이메일입니다.');
	}

	/* 가입을 위한 INSERT처리 */
	$sql = "INSERT INTO member (
				user_id, user_pw, user_name, email, tel, postcode, addr1, addr2, reg_date, edit_date
			) VALUES ('%s', password('%s'), '%s', '%s', '%s',
					'%s', '%s', '%s', now(), now()
			)";

	$input = array($user_id, $user_pw, $user_name, $email, $tel, $postcode, $addr1, $addr2);
	$result = db_query($sql, $input);

	if ($result === false) {
		redirect(false, '회원가입에 실패했습니다. 관리자에게 문의 바랍니다.');
	}

	if ($result < 1) {
		redirect(false, '가입된 데이터가 없습니다. 관리자에게 문의 바랍니다.');
	}
	
	/* 가입 완료 후 페이지 이동 */
	redirect('/member/login.php', '가입이 완료되었습니다. 로그인해주세요.');
?>