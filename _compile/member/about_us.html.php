<?php /* Template_ 2.2.8 2018/03/30 18:30:14 /Users/sonchowon/portfolio/_template/member/about_us.html 000001206 */ ?>
<!DOCTYPE html>
<html>
<head>
<?php $this->print_("head",$TPL_SCP,1);?>

	<link rel="stylesheet" href="<?php echo $TPL_VAR["assets_url"]?>/css/join_login.css">
	<style>
		.about_wrap {padding: 30px 70px;}
		.about_wrap img { width: 100%; }
		@media all and (min-width: 768px) {
		.about_wrap { padding: 60px 80px 60px 80px; }
		}
		@media all and (min-width: 998px) {

		}
	</style>
</head>
<body>
<?php $this->print_("topbar",$TPL_SCP,1);?>

<?php $this->print_("scrollup",$TPL_SCP,1);?>

	<div class="wrap_mini">
		<div class="mini_banner" style="background-image: url(<?php echo $TPL_VAR["assets_url"]?>/img/mini_banner.jpg);">
			<img src="<?php echo $TPL_VAR["assets_url"]?>/img/mini_banner.jpg" alt="미니배너" style="visibility: hidden; display: none;">
			<div class="banner_inner">
				<div class="subtitle_holder text-center">
					<h1><span>ABOUT US</span></h1>
				</div>
			</div>
		</div>
	</div>
	<div class="about_wrap">
		<img src="<?php echo $TPL_VAR["assets_url"]?>/img/about_us.png" alt="about">
	</div>
<?php $this->print_("footer",$TPL_SCP,1);?>

</body>
</html>