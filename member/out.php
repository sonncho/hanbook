<? header('Content-Type: text/html; charset=UTF-8'); ?>
<?
	include_once '../inc/init.php';

	// DB에 회원정보 삭제
	$sql = "DELETE FROM member WHERE id='%d' ";
	$input = array($member_info['id']);
	$result = db_query($sql, $input);

	if ($result === false) {
		redirect(false, '탈퇴에 실패했습니다. 관리자에게 문의하세요.');
	}

	// 세션삭제하기
	session_destroy();
	redirect($home_url, '탈퇴되었습니다. 안녕히가세요.');
?>