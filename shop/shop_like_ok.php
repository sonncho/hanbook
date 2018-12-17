<? header('Content-type: text/html; charset=UTF-8'); ?>
<?
	include_once('../inc/init.php');

	if ($member_info === false) {
		redirect($home_url.'/member/login.php', '로그인후 이용해주세요.');
	} 
	$member_id = $member_info['id'];
	/* 사용자 입력값 받기 */
	$shop_document_id = post('shop_document_id', false);

	/*게시물 일련값 검사하기*/
	if (!$shop_document_id) { print_rest_api('게시물 일련번호값이 없습니다.', false);}


	/* 게시물 데이터 저장하기 */
	$sql = "SELECT COUNT(id) AS `cnt` FROM shop_like WHERE member_id=%d AND shop_document_id=%d ";
	$input = array($member_id, $shop_document_id);
	$count = db_query($sql, $input);

	// 중복방지
	if ($count[0]['cnt'] < 1 ) {
		if ($member_info !== false) {
				$sql = "INSERT INTO shop_like (shop_document_id, member_id) VALUES (%d, %d)";
				$input = array($shop_document_id, $member_id);
			}	
		$shop_like_id = db_query($sql, $input);
	}

	if ($shop_like_id === false) { print_rest_api('관심상품 담기에 실패했습니다.', false); }

	/* 조회하기 */
	$sql = "SELECT id, shop_document_id, member_id FROM shop_like WHERE id=%d";
	$result = db_query($sql, array($shop_like_id));

	if ($result === false) {
		print_rest_api('조회에 실패했습니다.', false);
	}
	if (count($result) < 1) {
		print_rest_api('조회된 데이터가 없습니다.', false);
	}
	
	/* 성공적으로 조회되었다면 JSON으로 출력할 데이터 구성 */
	$item = array('item' => $result[0]);
	print_rest_api('OK', $item);

?>