<? header('Content-Type:text/html; charset=UTF-8'); ?>
<?
	include_once '../inc/init.php';

	/* 파라미터 받기 */
	$user_name = post('user_name', FALSE);
	$tel = post('tel', FALSE);
	$email = post('email', FALSE);
	$postcode = post('postcode', FALSE);
	$addr1 = post('addr1', FALSE);
	$addr2 = post('addr2', FALSE);
	$user_pw = post('user_pw', FALSE);
	$new_user_pw = post('new_user_pw', FALSE);
	$new_user_pw_re = post('new_user_pw_re', FALSE);

	/* 필수 입력값 검사 */
	if (!$user_name) { redirect(false, '이름을 입력해주세요.'); }
	if (!$tel) { redirect(false, '연락처를 입력해주세요.'); }
	if (!$email) { redirect(false, '이메일을 입력해주세요.'); }
	if (!$postcode) { redirect(false, '우편번호 찾기를 이용해주세요.'); }
	if (!$addr1) { redirect(false, '주소를 입력해주세요.'); }
	if (!$addr2) { redirect(false, '상세주소를 입력해주세요.'); }
	if (!$user_pw) {
		redirect(false, '현재 비밀번호를 입력해주세요.');
	}

	/* 비밀번호 확인 */
	if ($new_user_pw != $new_user_pw_re) {
		redirect(false, '비밀번호 확인이 잘못되었습니다.');
	}

	/* 비밀번호가 변경되는 경우와 변경되지 않은 경우를 구분하여 SQL작성 */
	$sql = false;
	$input = false;

	if ($new_user_pw === false) {
		// SQL UPDATE구문 구성(비밀번호를 변경하지 않은 경우)
		$sql = "UPDATE member SET 
						user_name='%s',
						tel='%s', 
						email='%s', 
						postcode='%s',
						addr1='%s',
						addr2='%s',
						edit_date=now() 
				WHERE id=%d AND user_pw=password('%s') ";
		$input = array($user_name, $tel, $email, $postcode, $addr1, $addr2, $member_info['id'], $user_pw);
	} else {
		// 비밀번호를 변경한 경우
		$sql = "UPDATE member SET 
						user_name='%s', 
						tel='%s', 
						email='%s', 
						postcode='%s',
						addr1='%s',
						addr2='%s',
						user_pw=password('%s'),
						edit_date=now() 
				WHERE id=%d AND user_pw=password('%s') ";
		$input = array($user_name, $tel, $email, $postcode, $addr1, $addr2, $new_user_pw, $member_info['id'], $user_pw);
	}

	/* SQL문 실행 및 성공, 실패여부 검사 */
	$result = db_query($sql, $input);
	if ($result === false) {
		redirect(false, '회원정보 수정에 실패했습니다.');
	}
	if ($result < 1) {
		redirect(false, '현재 비밀번호가 잘못됬습니다.');
	}

	/* 페이지 이동 */
	redirect($home_url, '회원정보가 변경되었습니다.');
?>