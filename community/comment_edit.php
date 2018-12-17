<? header('Content-Type: text/html; charset=UTF-8'); ?>
<?
	include_once('com_init.php');

	/* 덧글 일련번호 받기*/
	$comment_id = get('comment_id', false);
	if (!$comment_id) {
		redirect(false, '덧글 일련번호가 없습니다.');
	}

	/* 수정할 덧글의 내용을 조회한다.*/
	$sql = "SELECT id, writer_name, content, member_id FROM com_comment WHERE id=%d ";
	$result = db_query($sql, array($comment_id));

	if ($result === false) { redirect(false, '덧글 조회에 실패했습니다.');}
	if (count($result) <1) { redirect(false, '조회된 덧글이 없습니다.');}

	/* 조회결과를 템플릿에 전달하기*/
	$tpl -> assign('comment', $result[0]);
	$tpl -> define('body', 'community/comment_edit.html');
	$tpl -> print_('body');
?>