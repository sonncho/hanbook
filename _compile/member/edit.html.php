<?php /* Template_ 2.2.8 2018/05/17 18:24:10 /Users/sonchowon/portfolio/_template/member/edit.html 000003352 */ ?>
<!DOCTYPE html>
<html>
<head>
<?php $this->print_("head",$TPL_SCP,1);?>

	<!-- <link rel="stylesheet" href="<?php echo $TPL_VAR["assets_url"]?>/css/join_login.css"> -->
	<link rel="stylesheet" href="<?php echo $TPL_VAR["assets_url"]?>/css/edit.css">
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
		<div class="edit_form_custom">
			<p class="edit_title">내 정보 수정하기</p>
			<form action="<?php echo $TPL_VAR["home_url"]?>/member/edit_ok.php" method="post" name="myform">
				<div class="input_edit">
					<label for="user_id">아이디<span>(수정불가)</span></label>
					<input type="text" class="color_change" id="user_id" name="user_id" value="<?php echo $TPL_VAR["member_info"]["user_id"]?>" disabled>
				</div>
				<div class="input_edit">
					<label for="user_name">이름*</label>
					<input type="text" id="user_name" name="user_name" value="<?php echo $TPL_VAR["member_info"]["user_name"]?>">
				</div>
				<div class="input_edit">
					<label for="tel">연락처*</label>
					<input type="tel" value="<?php echo $TPL_VAR["member_info"]["tel"]?>" id="tel" name="tel">
				</div>
				<div class="input_edit">
					<label for="email">이메일*</label>
					<input type="email" id="email" name="email" value="<?php echo $TPL_VAR["member_info"]["email"]?>">
				</div>
				<div class="input_edit">
					<label for="postcode">우편번호*</label>
					<input type="text" name="postcode" id="postcode" value="<?php echo $TPL_VAR["member_info"]["postcode"]?>" class="margin_edit width_edit">
					<button type="button" class="float-right" onclick="daumPostCode()">우편번호 찾기</button>
				</div>
				<div class="input_edit">
					<label for="addr1">주소*</label>
					<input type="text" name="addr1" id="addr1" value="<?php echo $TPL_VAR["member_info"]["addr1"]?>" class="margin_edit">
					<input type="text" name="addr2" id="addr2" value="<?php echo $TPL_VAR["member_info"]["addr2"]?>">
				</div>
				<div class="input_edit">
					<label for="user_pw">현재 비밀번호*</label>
					<input type="password" id="user_pw" name="user_pw">
				</div>
				<div class="input_edit">
					<p>비밀번호 변경</p>
					<label for="new_user_pw">새 비밀번호(변경하지 않으려면 비워두세요)</label>
					<input type="password" id="new_user_pw" name="new_user_pw">
				</div>
				<div class="input_edit">
					<label for="new_user_pw_re">새 비밀번호 확인(변경하지 않으려면 비워두세요)</label>
					<input type="password" id="new_user_pw_re" name="new_user_pw_re">
				</div>
				<div class="input_edit">
					<button type="submit">변경 사항 저장</button>
				</div>
			</form>
		</div>
	</div>
<?php $this->print_("footer",$TPL_SCP,1);?>

</body>
</html>