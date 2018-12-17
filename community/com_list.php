<? header("Content-type: text/html; charset=UTF-8"); ?>
<?
	include_once ('com_init.php');

	/* 내 관심상품 조회하기*/
	$member_id = $member_info['id'];
	$sql = "SELECT id, shop_document_id, member_id FROM shop_like WHERE member_id=%d ";
	$my_like = db_query($sql, array($member_id));
	for ($i=0; $i<count($my_like); $i++) { 
		$shop_document_id = $my_like[$i]['shop_document_id'];
		$sql = "SELECT file_path FROM shop_file 
				WHERE shop_document_id=%d 
				AND left(file_type, 5) ='image' 
				ORDER BY id ASC LIMIT 0, 1";
		$file = db_query($sql, array($shop_document_id));

		if ($file !== FALSE && count($file)>0) {
			$file_path = $file[0]['file_path'];
			$p = strrpos($file_path, '/');
			$file_name = substr($file_path, $p+1);
			$file_dir = substr($file_path, 0, $p);
			$thumbnail = $file_dir.'/thumb_'.$file_name;
			$my_like[$i]['thumbnail'] = $thumbnail;
		}
		$sql = "SELECT shop_type FROM shop_document WHERE id=%d";
		$result = db_query($sql, array($shop_document_id));
		$my_like[$i]['shop_type'] = $result[0]['shop_type'];
	}

	/* 검색구문 만들기 */
	$where = "com_type='%s'";
	$input = array($com_type);

	// 검색어 존재한다면 검색구문 추가한다
	$keyword = get('keyword', false);
	if ($keyword !== false) {
		$where .= " AND (subject LIKE '%%%s%%' OR content LIKE '%%%s%%')";
		$input[] = $keyword;
		$input[] = $keyword;
	}

	/* 페이지 구현 */
	$now_page = get('page', 1);
	// 한페이지에 보여질 목록 수
	$list_count = 10;
	// 한번에 표시될 페이지 번호 그룹 
	$group_count = 5;

	//게시물 수 가져오기
	$sql = "SELECT COUNT(id) `cnt` FROM com_document WHERE ".$where;
	$document_count = db_query($sql, $input);
	if ($document_count === false) {
		redirect(false, '게시물 수 조회에 실패했습니다.');
	}
	$total_count = $document_count[0]['cnt'];

	// 페이지 계산
	$page_info = get_page_info($total_count, $now_page, $list_count, $group_count);

	/* 게시물 목록 가져오기 */
	$sql = "SELECT id, subject, writer_name, hit, reg_date 
			FROM com_document 
			WHERE ".$where." ORDER BY id DESC LIMIT %d, %d";
	$input[] = $page_info['offset'];
	$input[] = $page_info['list_count'];

	$document_list = db_query($sql, $input);

	if ($document_list === false) {
		redirect(false, '게시물 목록 조회에 실패했습니다.');
	}

	/* 템플릿 처리 */
	$tpl -> assign('document_list', $document_list);
	$tpl -> assign('my_like', $my_like);
	$tpl -> assign('keyword', $keyword);
	$tpl -> assign('page_info', $page_info);
	$tpl -> define('body', 'community/com_list.html');
	$tpl -> print_('body');
?>