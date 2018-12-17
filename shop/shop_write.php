<? header("Content-type: text/html; charset=UTF-8"); ?>
<?
	include_once ('shop_init.php');

	// 로그인한 경우에만 책 판매하기 가능
	if($member_info === false) {
		redirect($home_url.'/member/login.php', '로그인후 이용해주세요.');
	}

	$tpl -> define('body', 'shop/shop_write.html');
	$tpl -> print_('body');
?>