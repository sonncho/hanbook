<? header('Content-Type: text/html; charset=UTF-8'); ?>
<?
	include_once '../inc/init.php';

	/* 각 게시물을 구분할 수 있는 파라미터 받기 */
	$com_type = get('com_type', false);

	if ($com_type === false) {
		$com_type = post('com_type', false);
	}
	if ($com_type === false) {
		redirect($home_url, '게시판 종류가 지정되지 않았습니다. 정상적인 경로로 접근해주세요.');
	}

	/* 게시판 종류에 따른 이름 설정하기 */
	$com_name = '';
	switch($com_type) {
		case 'notice' :
			$com_name = 'NOTICE';
			break;
		case 'review' :
			$com_name = 'REVIEW';
			break;
		case 'qna' :
			$com_name = 'Q & A';
			break;
	}

	/* 생성된 변수값을 template에 전달 */
	$com_config = array('name'=> $com_name, 'type'=> $com_type);
	$tpl->assign('com_config', $com_config);
?>
