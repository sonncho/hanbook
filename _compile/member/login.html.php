<?php /* Template_ 2.2.8 2018/05/16 22:24:22 /Users/sonchowon/portfolio/_template/member/login.html 000001630 */ ?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php $this->print_("head",$TPL_SCP,1);?>

	<link rel="stylesheet" href="<?php echo $TPL_VAR["assets_url"]?>/css/join_login.css">
</head>
<body>
<?php $this->print_("topbar",$TPL_SCP,1);?>

<?php $this->print_("scrollup",$TPL_SCP,1);?>

	<div class="wrap_mini">
		<div class="mini_banner" style="background-image: url(<?php echo $TPL_VAR["assets_url"]?>/img/mini_banner.jpg);">
			<img src="<?php echo $TPL_VAR["assets_url"]?>/img/mini_banner.jpg" alt="미니배너" style="visibility: hidden; display: none;">
			<div class="banner_inner">
				<div class="subtitle_holder text-center">
					<h1><span>MY ACCOUNT</span></h1>
				</div>
			</div>
		</div>
	</div>

	<div class="wrapper">
		<form class="form_custom" action="<?php echo $TPL_VAR["home_url"]?>/member/login_ok.php" method="post">
			<p class="form_title"><span>로그인</span></p>
			<div class="input_custom">
				<input class="mb-3" type="text" name="user_id" placeholder="사용자 아이디" style="background-color: #fff; border: 1px solid #262626;">
				<input class="mb-3" type="password" name="user_pw" placeholder="비밀번호" style="background-color: #fff; border: 1px solid #262626;">
			</div>
			<div class="input_custom form-inline login_btn">
				<button type="submit">로그인</button>
				<a href="<?php echo $TPL_VAR["home_url"]?>/member/password_reset.php">
					<span>Lost password?</span>
				</a>
			</div>
		</form>
	</div>
<?php $this->print_("footer",$TPL_SCP,1);?>

</body>
</html>