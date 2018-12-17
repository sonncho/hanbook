<?php /* Template_ 2.2.8 2018/07/10 22:21:42 /Users/sonchowon/portfolio/_template/common/topbar.html 000002217 */ ?>
<div id="topbar">
	<header class="header cfixed">
		<h1 class="logo"><a href="<?php echo $TPL_VAR["home_url"]?>">HANBOOK</a></h1>
		<nav>
			<ul class="gnb">
				<li><a href="<?php echo $TPL_VAR["home_url"]?>/member/about_us.php">ABOUT US</a></li>
				<li class="dropdown_li">
					<a href="<?php echo $TPL_VAR["home_url"]?>/shop/shop_list.php?shop_type=magazine&sortby=date" class="shop">SHOP</a>
					<div class="dropdown_item">
						<a href="<?php echo $TPL_VAR["home_url"]?>/shop/shop_list.php?shop_type=magazine">MAGAZINES</a>
						<a href="<?php echo $TPL_VAR["home_url"]?>/shop/shop_list.php?shop_type=novel">NOVEL</a>
						<a href="<?php echo $TPL_VAR["home_url"]?>/shop/shop_list.php?shop_type=foreign">FOREIGN</a>
						<a href="<?php echo $TPL_VAR["home_url"]?>/shop/shop_list.php?shop_type=cartoon">CARTOON</a>
						<a href="<?php echo $TPL_VAR["home_url"]?>/shop/shop_list.php?shop_type=it">IT / COMPUTER</a>
						<a href="<?php echo $TPL_VAR["home_url"]?>/shop/shop_list.php?shop_type=study">STUDY</a>
						<a href="<?php echo $TPL_VAR["home_url"]?>/shop/shop_list.php?shop_type=acc">ACC</a>
					</div>
				</li>
				<li class="dropdown_li">
					<a href="<?php echo $TPL_VAR["home_url"]?>/community/com_list.php?com_type=notice" class="commu">COMMUNITY</a>
					<div class="dropdown_item">
						<a href="<?php echo $TPL_VAR["home_url"]?>/community/com_list.php?com_type=notice">NOTICE</a>
						<a href="<?php echo $TPL_VAR["home_url"]?>/community/com_list.php?com_type=qna">Q &amp; A</a>
						<a href="#">REVIEW</a>
					</div>
				</li>
<?php if($TPL_VAR["member_info"]===false){?>
				<li><a href="<?php echo $TPL_VAR["home_url"]?>/member/login.php">LOGIN</a></li>
				<li><a href="<?php echo $TPL_VAR["home_url"]?>/member/join.php">JOIN</a></li>
<?php }else{?>
				<li><a href="<?php echo $TPL_VAR["home_url"]?>/member/mypage.php">MYPAGE</a></li>
				<li><a href="<?php echo $TPL_VAR["home_url"]?>/member/logout.php">LOGOUT</a></li>
<?php }?>
			</ul>
		</nav>
		<span class="menu_toggle_btn">
			<span></span>
			<span></span>
			<span></span>
		</span>
	</header>
</div>