<? header('Content-Type: text/html; charset=UTF-8'); ?>
<?
	include_once('shop_init.php');

	/** 덧글 일련번호 받기 **/
	$shop_qna_id = get('shop_qna_id', false);
	if(!$shop_qna_id) {
		redirect(falase, '덧글 일련번호가 없습니다.');
	}

	/** 로그인한 경우 자신의 덧글인지 판별한다. **/
	$is_mine = FALSE;
	if ($member_info !== FALSE) {
		$sql = "SELECT count(id) AS `cnt` FROM shop_qna WHERE id=%d AND member_id=%d";
		$input = array($shop_qna_id, $member_info['id']);
		$result = db_query($sql, $input);

		if ($result !== false) {
			if ($result[0]['cnt']>0) {
				$is_mine = TRUE;
			}
		}
	}

	/** 조회결과를 템플릿에 전달하기 **/
	$tpl -> assign('is_mine', $is_mine);
	$tpl -> assign('shop_qna_id', $shop_qna_id);
	$tpl -> define('body', 'shop/qna_delete.html');
	$tpl -> print_('body');
?>