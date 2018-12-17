<? header('Content-Type: text/html; charset=UTF-8'); ?>
<?
	include_once '../inc/init.php';
	if (!$member_info) {
		redirect(FALSE, '로그인하지 않으셨습니다.');
	}
	session_destroy();
	redirect('/index.php', '로그아웃 되셨습니다. 안녕히가세요.');
?>