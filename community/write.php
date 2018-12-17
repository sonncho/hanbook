<? header("Content-type: text/html; charset=UTF-8"); ?>
<?
	include_once ('com_init.php');

	/* 사용자 입력값 받기 */
	
	/* 입력값 검사 */

	/* 게시물 데이터 저장하기 */

	/* 첨부파일 업로드 처리 */

	/* 저장이 완료되었다면 읽기 페이지로 이동한다. */
	
	$tpl -> define('body', 'community/write.html');
	$tpl -> print_('body');
?>