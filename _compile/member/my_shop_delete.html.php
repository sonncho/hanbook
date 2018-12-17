<?php /* Template_ 2.2.8 2018/07/27 22:07:00 /Users/sonchowon/portfolio/_template/member/my_shop_delete.html 000002644 */ ?>
<!DOCTYPE html>
<html>
<head>
<?php $this->print_("head",$TPL_SCP,1);?>

	<link rel="stylesheet" href="<?php echo $TPL_VAR["assets_url"]?>/css/mypage.css">
	<link rel="stylesheet" href="<?php echo $TPL_VAR["assets_url"]?>/css/my_shop_delete.css">
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
					<h1><span>MYPAGE</span></h1>
				</div>
			</div>
		</div>
	</div>

	<div class="wrapper">
		<div class="form_custom">
			<h4 class="form_title">내 게시글 삭제하기</h4>
			<form action="my_shop_delete_ok.php" method="post" name="myform">
				<input type="hidden" name="shop_type" value="<?php echo $TPL_VAR["shop_config"]["type"]?>">
				<input type="hidden" name="document_id" value="<?php echo $TPL_VAR["document_id"]?>">
				<div class="sub_title">
					<p>정말 이 게시글을 삭제하시겠습니까?</p>
					<p>(삭제하시면 더이상 복구가 불가능합니다.)</p>
				</div>
<?php if($TPL_VAR["is_mine"]===false){?>
				<div class="line_custom"></div>
				<div class="pwd_form">
					<label for="pwd">비밀번호</label>
					<input type="password" name="pwd">
				</div>
				<div class="btn_group clearfix">
					<div class="left">
						<a href="<?php echo $TPL_VAR["home_url"]?>/shop/shop_read.php?shop_type=<?php echo $TPL_VAR["shop_config"]["type"]?>&shop_document_id=<?php echo $TPL_VAR["document_id"]?>">본문보기</a>
						<a href="#">수정하기</a>
					</div>
					<div class="right">
						<button type="submit">비밀번호 확인</button>
					</div>
				</div>
<?php }else{?>
				<div class="btn_group clearfix">
					<div class="left">
						<a href="<?php echo $TPL_VAR["home_url"]?>/shop/shop_read.php?shop_type=<?php echo $TPL_VAR["shop_config"]["type"]?>&shop_document_id=<?php echo $TPL_VAR["document_id"]?>">본문보기</a>
						<a href="#">수정하기</a>
					</div>
					<div class="right">
						<button type="submit">삭제하기</button>
					</div>
				</div>
<?php }?>
			</form>
		</div>
	</div>
<?php $this->print_("footer",$TPL_SCP,1);?>

</body>
</html>