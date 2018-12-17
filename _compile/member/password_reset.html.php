<?php /* Template_ 2.2.8 2018/02/28 23:58:05 /Users/sonchowon/portfolio/_template/member/password_reset.html 000001506 */ ?>
<!DOCTYPE html>
<html>
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
		<form class="form_custom" action="<?php echo $TPL_VAR["home_url"]?>/member/password_reset_ok.php" method="post">
			<p class="lost_password">비밀번호를 분실하셨나요? 가입시 입력했던 사용자 이메일 주소를 입력해주세요. 새로운 비밀번호를 만들기 위해 임시비밀번호를 발송해드립니다.</p>
			<div class="input_custom reset_pw">
				<input type="email" name="email" placeholder="email주소" style="border: 1px solid #e5e5e5; background-color: #f5f5f5;">
				<button type="submit">임시 비밀번호 발급받기</button>
			</div>
		</form>
	</div>
<?php $this->print_("footer",$TPL_SCP,1);?>

</body>
</html>