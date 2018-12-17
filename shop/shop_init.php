<? header('Content-Type: text/html; charset=UTF-8'); ?>
<?
	include_once '../inc/init.php';

	/* 각 게시물을 구분할 수 있는 파라미터 받기 */
	// 메뉴에서 전달되는 shop_type받기
	$shop_type = get('shop_type', FALSE);

	// GET방식으로 전달된 값이 없다면 POST방식으로 시도한다.
	if ($shop_type === false) {
		$shop_type = post('shop_type', false);
	}

	// 최종적으로 값이 없다면 정상적인 접근이 아님
	if ($shop_type === false) {
		redirect($home_url, '책 카테고리가 지정되지 않았습니다. 정상적인 경로로 접근해 주세요.');
	}

	/* 게시판 종류에 따른 이름 설정하기 */
	$shop_name ='';
	switch ($shop_type) {
		case 'magazine':
			$shop_name = 'MAGAZINE';
			break;
		case 'novel':
			$shop_name = 'NOVEL';
			break;
		case 'foreign':
			$shop_name = 'FOREIGN';
			break;
		case 'cartoon':
			$shop_name = 'CARTOON';
			break;
		case 'it':
			$shop_name = 'IT/COMPUTER';
			break;
		case 'study':
			$shop_name = 'STUDY';
			break;
		case 'acc':
			$shop_name = 'ACC';
			break;
	}


	/* 생성된 변수값을 template에 전달 */
	$shop_config = array('name'=>$shop_name, 'type'=>$shop_type);
	$tpl -> assign('shop_config', $shop_config);
?>