<? header('Content-Type:text/html; charset=UTF-8'); ?>
<?
	include_once '../inc/init.php';

	$member_id = $member_info['id'];
	$shop_type = post('shop_type', false);
	$shop_document_id = post('shop_document_id', false);
	if (!$shop_document_id) {
		print_rest_api('게시물 일련번호가 지정되지 않았습니다.');
	}

	// 관심상품 데이터를 삭제한다.
	$sql = "DELETE FROM shop_like WHERE member_id=%d AND shop_document_id=%d";
	$input = array($member_id, $shop_document_id);
	db_query($sql, $input);

	// 삭제 완료를 의미하는 JSON출력
	print_rest_api('OK', array('member_id' => $member_id, 'shop_document_id' => $shop_document_id));

?>