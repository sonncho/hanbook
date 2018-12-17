<?php /* Template_ 2.2.8 2018/08/14 20:33:50 /Users/sonchowon/portfolio/_template/index.html 000002405 */ 
$TPL_shop_list_1=empty($TPL_VAR["shop_list"])||!is_array($TPL_VAR["shop_list"])?0:count($TPL_VAR["shop_list"]);?>
<!DOCTYPE html>
<html>
<head>
<?php $this->print_("head",$TPL_SCP,1);?>

	<link rel="stylesheet" href="<?php echo $TPL_VAR["assets_url"]?>/css/shop_list.css">
</head>
<body>
<?php $this->print_("topbar",$TPL_SCP,1);?>

<?php $this->print_("scrollup",$TPL_SCP,1);?>

	<div class="wrap">
		<div class="banner_img" style="background-image: url(<?php echo $TPL_VAR["assets_url"]?>/img/main2.jpg);">
			<img src="<?php echo $TPL_VAR["assets_url"]/$TPL_VAR["img"]/$TPL_VAR["main2"]["jpg"]?>" alt="메인01" style="visibility: hidden; display: none;">
			<div class="banner_content" id="banner_fade">
				<div class="banner_top_text text-center">
					<img src="<?php echo $TPL_VAR["assets_url"]?>/img/vanner.png" alt="배너이미지">
					<div class="banner_bottom">
						<p>
							<span>A book that is shut is but a block. - Thomas Fuller -</span>
						</p>
						<a href="#" class="quick_btn" style="margin-right: 10px;">SHOP NOW</a>
						<a href="<?php echo $TPL_VAR["home_url"]?>/member/about_us.php" class="quick_btn">ABOUT US</a>
					</div>
				</div>
			</div>
			<!-- <div id="log">0</div> -->
		</div>
	</div>
	<div class="wrapper">
<?php if($TPL_VAR["member_info"]==false){?>
			<h2>로그인되지않음</h2>
<?php }else{?>
			<h2>로그인 성공</h2>
			<?php echo debug($TPL_VAR["member_info"])?>

<?php }?>
		<div class="arrival">
			<h1 class="text-center">NEW ARRIVALS</h1>
			<div class="arrival_card cfixed">
				<ul class="card_part">
<?php if($TPL_shop_list_1){foreach($TPL_VAR["shop_list"] as $TPL_V1){?>
					<li class="card_li">
						<a href="<?php echo $TPL_VAR["home_url"]?>/shop/shop_read.php?shop_type=<?php echo $TPL_V1["shop_type"]?>&shop_document_id=<?php echo $TPL_V1["id"]?>">
							<img src="<?php echo $TPL_V1["thumbnail"]?>" alt="사진1">
							<div class="li_content text-center">
								<p class="mb-3"><?php echo $TPL_V1["book_name"]?></p>
								<p class="mb-3">Yann Martel / NOVEL</p>
								<p>2,000 won</p>
							</div>
						</a>
					</li>
<?php }}?>
				</ul>
			</div>
		</div>
		<div class="best_seller">
			<h1 class="text-center">BEST SELLER</h1>
		</div>
	</div>

<?php $this->print_("footer",$TPL_SCP,1);?>

</body>
</html>