<? header("Content-type: text/html; charset=UTF-8"); ?>
<?
	include_once ('shop_init.php');

	/* 정렬 값 받기 */
	$sortby= "";
	$select_sort = get('sortby', 'date');
	if ($select_sort === false) {
		redirect($home_url, '책 정렬값이 지정되지 않았습니다. 정상적인 경로로 접근해 주세요.');
	}
	switch ($select_sort) {
		case 'date':
			$sortby = " ORDER BY id DESC";
			break;
		case 'popularity':
			$sortby = " ORDER BY hit DESC";
			break;
		case 'price':
			$sortby = " ORDER BY price DESC";
			break;
		case 'price_asc':
			$sortby = " ORDER BY price ASC";
			break;

	}

	/* 검색구문 만들기 */
	$where = "shop_type='%s'";
	$input = array($shop_type);

	/* 검색어가 존재한다면 검색구문 추가 */
	$keyword = get('keyword', false);
	if ($keyword !== false) {
		$where .= " AND (book_name LIKE '%%%s%%' OR content LIKE '%%%s%%')";
		$input[] = $keyword;
		$input[] = $keyword;
	}

	/* 페이지 구현 */
	// 현재 페이지 수
	$now_page = get('page', 1);
	// 한페이지에 보여질 목록 수
	$list_count = 12;
	// 한번에 표시될 페이지 번호 수룹 수수
	$group_count = 5;

	/* 게시물 수 가져오기 */
	$sql = "SELECT COUNT(id) `cnt` FROM shop_document WHERE ".$where.$sortby;
	$document_count = db_query($sql, $input);
	if ($document_count === false) {
		redirect(false, '게시물 조회에 실패했습니다.');
	}
	$total_count = $document_count[0]['cnt'];

	/* 페이지 계산 */
	$page_info = get_page_info($total_count, $now_page, $list_count, $group_count);

	/* 게시물 목록 가져오기 */
	$sql = "SELECT id, book_name, content, 
					FORMAT(onega, 0) as `onega`,
					FORMAT(price, 0) as `price`, count 
			FROM shop_document 
			WHERE ".$where.$sortby." LIMIT %d, %d ";

	$input[] = $page_info['offset'];
	$input[] = $page_info['list_count'];

	$document_list = db_query($sql, $input);

	if ($document_list === false) {
		redirect(false, '게시물 목록 조회에 실패했습니다.');
	}

	/* 썸네일 이미지 생성후 추출 */
	for ($i=0; $i<count($document_list); $i++) { 
		// $i번째 게시물에 해당되는 이미지 형식의 첫 번째 첨부파일을 가져온다.
		$document_id = $document_list[$i]['id'];
		$sql = "SELECT file_path FROM shop_file 
				WHERE shop_document_id=%d 
				AND left(file_type, 5)='image' 
				ORDER BY id ASC LIMIT 0, 1";
		$file = db_query($sql, array($document_id));

		// 에러가 발생하지 않고, 가져온 데이터가 존재한다면?
		if ($file !== FALSE && count($file)>0) {
			// 조회된 파일 경로
			$file_path = $file[0]['file_path'];

			// 경로에서 파일명과 파일이 저장된 폴더를 분리한다.
			$p = strrpos($file_path, '/');
			$file_name = substr($file_path, $p+1);  //123456.jpg
			$file_dir = substr($file_path, 0, $p);	//localhost/files/20170313

			// 썸네일이 저장될 파일 경로를 생성한다.
			$thumbnail = $file_dir.'/thumb_'.$file_name;
			// 썸네일 이미지 만들기
			image_crop($document_root.$file_path, $document_root.$thumbnail, 500, 500);
			// 생성될 썸네일 이미지를 게시물 목록에 추가한다.
			$document_list[$i]['thumbnail']=$thumbnail;
		}
	}

	/* 템플릿 처리 */
	$tpl -> assign('document_list', $document_list);
	$tpl -> assign('keyword', $keyword);
	$tpl -> assign('select_sort', $select_sort);

	$tpl -> assign('page_info', $page_info);

	$tpl -> define('body', 'shop/shop_list.html');
	$tpl -> print_('body');
?>