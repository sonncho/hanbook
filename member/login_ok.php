<? header('Content-Type: text/html; charset=UTF-8'); ?>
<?
	include_once '../inc/init.php';

	/* 사용자의 입력값 받기 */
	$user_id = post('user_id', false);
	$user_pw = post('user_pw', false);

	/* 필수 입력값 검사 */
	if (!$user_id) { redirect(false, '아이디를 입력해주세요.');}
	if (!$user_pw) { redirect(false, '비밀번호를 입력해주세요.');}

	/* 로그인을 위한 SQL실행하기 */
	$sql = "SELECT id, user_name FROM member WHERE user_id='%s' AND user_pw=password('%s') ";
		$input = array($user_id, $user_pw);

	// 조회결과는 2차배열로 넘어옴
	$result = db_query($sql, $input);

	if ($result === false) {
		redirect(false, '로그인에 실패했습니다. 관리자에게 문의 바랍니다.');
	}
	if (count($result) < 1) {
		redirect(false, '아이디나 비밀번호가 맞지 않습니다.');
	}

	/* 조회결과를 기반으로 로그인 처리하기 --> 세션생성 */
	$member_id = $result[0]['id'];
	$member_name = $result[0]['user_name'];

	// 회원 일련번호를 세션에 기장하기기
	// -->모든 페이지에서 이 값을 인식할 수 있다.
	// init.php에서 session_start()를 했기 때문에 사용 가능함
	$_SESSION['member_id'] = $member_id;

	/* 로그인 완료후 페이지 이동*/
	redirect('/index.php', '안녕하세요.'.$member_name.'님');
?>