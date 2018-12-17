<? header("Content-type: text/html; charset=UTF-8"); ?>
<?
	include_once ('../inc/init.php');

	/** 아이디 중복 검사 **/
	$user_id = $_POST['user_id'];
	$sql = "SELECT COUNT('id') AS `cnt` FROM member WHERE user_id='%s'";
	$input = array($user_id);
	$result = db_query($sql, $input);

	if ($result[0]['cnt']>0) {
		echo json_encode(array('id_rt' =>'bad'));
	} else { 
		echo json_encode(array('id_rt'=>'ok'));
	}

?>