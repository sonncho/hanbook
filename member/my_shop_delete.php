<? header('Content-Type: text/html; charset=UTF-8'); ?>
<?
	// 게시만 공통 설정파일 참조
	include_once('../shop/shop_init.php');

	/* 파라미터 받기 */
	// 삭제 대상을 의미하는 글 번호 받기
	$document_id = get('document_id', false);
	if (!$document_id) {
		redirect(false, '글 번호가 지정되지 않았습니다.');
	}

	/* 자신의 글에 대한 삭제 요청인지 검사한다. */
	$is_mine = FALSE;
	if ($member_info !== FALSE) {
		$sql = "SELECT count(id) AS `cnt` FROM shop_document WHERE id=%d AND member_id=%d";
		$input = array($document_id, $member_info['id']);
		$result = db_query($sql, $input);

		if ($result !== FALSE) {
			if ($result[0]['cnt'] > 0) {
				$is_mine = TRUE;
			}
		}
	}

	/* 템플릿 처리*/
	$tpl -> assign('is_mine', $is_mine);
	$tpl -> assign('document_id', $document_id);
	$tpl -> define('body', 'member/my_shop_delete.html');
	$tpl -> print_('body');
?>