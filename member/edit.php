<? header('Content-Type: text/html; charset=UTF-8'); ?>
<?
	include_once '../inc/init.php';

	$tpl -> define('body', 'member/edit.html');
	$tpl -> print_('body');
?>