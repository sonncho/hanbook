<? header("Content-type: text/html; charset=UTF-8"); ?>
<?
	include_once ('../inc/init.php');

	$tpl -> define('body', 'member/password_reset.html');
	$tpl -> print_('body');
?>