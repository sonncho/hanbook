<? header("Content-type: text/html; charset=UTF-8"); ?>
<?
	include_once ('../inc/init.php');

	/** 아이디 중복 검사 **/
	$email = $_POST['email'];
	$sql = "SELECT COUNT('id') AS `cnt` FROM member WHERE email='%s'";
	$input = array($email);
	$result = db_query($sql, $input);

	if ($result[0]['cnt']>0) {
		echo json_encode(array('email_rt' =>'bad'));
	} else { 
		echo json_encode(array('email_rt'=>'ok'));
	}

?>