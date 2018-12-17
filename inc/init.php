<?
	// 사이트의 루트 폴더 경로를 변수에 저장
	$document_root = $_SERVER['DOCUMENT_ROOT'];

	/** 공통파일 참조 */
	include_once $document_root.'/inc/helper.php';
	include_once $document_root.'/inc/db_helper.php';
	include_once $document_root.'/inc/Template_/Template_.class.php';

	/** 홈페이지 안에서 특별한 의미를 갖는 폴더나 경로 생성 */
	// 사이트의 URL
	// --> 템플릿에서 링크의 주소를 명시할 경우 사용한다.
	// --> http://localhost
	$home_url = 'http://'.$_SERVER['SERVER_NAME'];

	// css, js, img등이 저장되어 있는 폴더의 URL
	// --> 템플릿에서 리소스를 참조할 때 사용한다.
	// --> http://localhost/_template/assets
	$assets_url = $home_url.'/_template/assets';

	// 첨부파일이 저장될 폴더
	$upload_dir = '/_files'; 	// --> 상대경로
	// --> 서버: /Users/sonchowon/phpuser/_files
	$upload_abs_path = $document_root.$upload_dir;
	// --> 웹: http://localhost/_files
	$upload_url = $home_url.$upload_dir;

	/** 템플릿 설정하기 */
	$tpl = new Template_();

	// 템플릿 파일들이 저장될 경로를 사이트 전역에 결처서 일괄 설정하기
	$tpl -> template_dir = $document_root.'/_template';
	$tpl -> compile_dir = $document_root.'/_compile';

	// 템플릿 폴더가 없다면 생성해준다.
	if (!is_dir($tpl->template_dir)) {
		mkdir($tpl->template_dir);
		chmod($tpl->template_dir, 0777);
	}

	// 템플릿의 컴파일 폴더가 없다면 생성해준다.
	if (!is_dir($tpl->compile_dir)) {
		mkdir($tpl->compile_dir);
		chmod($tpl->compile_dir, 0777);
	}

	// 모든 페이지에서 공통적으로 사용될 변수값들
	$tpl -> assign('home_url', $home_url);
	$tpl -> assign('assets_url', $assets_url);

	// 모든 페이지에서 공통적으로 사용할 html부품
	$tpl -> define('head', 'common/head.html');
	$tpl -> define('topbar', 'common/topbar.html');
	$tpl -> define('footer', 'common/footer.html');
	$tpl -> define('scrollup', 'common/scrollup.html');

	// 데이터베이스 접속하기
	db_open();

	// 사용자 인증 정보를 유지하기 위한 세션 사용 시작
	session_cache_expire(60); 		// 60분간 인증정보 유지
	session_start(); 				// 세션 시작하기

	/** 로그인한 회원 정보를 조회해서 템플릿에 전달한다. */
	// 회원정보가 저장될 배열 변수 (false인 경우는 로그인 안함)
	$member_info = false;

	// 세션에 저장된 회원의 일련번호(Primary Key를 추출한다.)
	// --> 값이 없을 경우 '0'이 리턴된다.
	$ses_member_id = get_session('member_id', 0);

	// 세션에 회원의 일련번호가 존재한다면?
	if ($ses_member_id > 0) {
		// 현재 회원의 모든 정보를 조회해서 준비한 배열에 저장한다.
		$sql = "SELECT id, user_id, user_pw, user_name, email, 
				tel, postcode, addr1, addr2, reg_date, edit_date 
				FROM member WHERE id=%d ";
		$input = array($ses_member_id);
		$result = db_query($sql, $input);

		if ($result === FALSE) {
			redirect(FALSE, '가입된 회원이 아닙니다. 다시 로그인해 주세요.');
		}

		// 조회된 결과를 전역변수에 저장한다.
		$member_info = $result[0];
	}

	// 회원정보를 템플릿에 전달한다.
	// 로그인된 경우 --> 연관배열 형태, 로그인되지 않은 경우 --> FALSE
	$tpl -> assign('member_info', $member_info);


?>