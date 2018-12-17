<? header('Content-Type: text/html; charset=UTF-8'); ?>
<?
	include_once('../shop/shop_init.php');

	/* 게시물 일련번호 받기 */
	$document_id = get('document_id', false);
	if (!$document_id) {
		redirect(false, '게시물 일련번호가 없습니다. 정상적인 경로로 접근해주세요.');
	}

	/* 게시물 일련번호와 일치하는 본문 데이터 조회하기 */
	$sql = "SELECT id, shop_type, seller, tel, book_name, author, public, onega, price, count, content, member_id, lang, hit, reg_date, edit_date FROM shop_document WHERE id=%d ";
	$input = array($document_id);
	$document = db_query($sql, $input);

	if ($document === false) {
		redirect(false, '게시물 읽기에 실패했습니다. 관리자에게 문의 바랍니다.');
	}
	if (count($document) < 1) {
		redirect(false, '존재하지 않는 게시물 입니다.');
	}

	$document = $document[0];

	/* 첨부파일 데이터 조회하기 */
	$sql = "SELECT id, shop_document_id, file_name, file_type, file_size, file_path, reg_date, edit_date FROM shop_file WHERE shop_document_id=%d";
	$input = array($document_id);
	$file_list = db_query($sql, $input);

	if ($file_list === false) {
		redirect(false, '첨부파일 조회에 실패했습니다. 관리자에게 문의 바랍니다.');
	}
	if (count($file_list)<1) {
		$file_list = false;
	}

	/* 자신의 글에 대한 수정 요청인지 검사한다. */
	$is_mine = false;
	if ($member_info !== false) {
		if ($document['member_id']== $member_info['id']) {
			$is_mine = TRUE;
		}
	}

	/* 템플릿 처리 */
	$tpl -> assign('is_mine', $is_mine);
	$tpl -> assign('document', $document);
	$tpl -> assign('file_list', $file_list);

	$tpl -> define('body', 'shop/shop_edit.html');
	$tpl -> print_('body');
?>