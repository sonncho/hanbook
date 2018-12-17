<?php /* Template_ 2.2.8 2018/11/20 22:51:08 /Users/sonchowon/portfolio/_template/shop/shop_write.html 000003859 */ ?>
<!DOCTYPE html>
<html>
<head>
<?php $this->print_("head",$TPL_SCP,1);?>

	<link rel="stylesheet" href="<?php echo $TPL_VAR["assets_url"]?>/css/join_login.css">
	<link rel="stylesheet" href="<?php echo $TPL_VAR["assets_url"]?>/css/shop_write.css">
</head>
<body>
<?php $this->print_("topbar",$TPL_SCP,1);?>

<?php $this->print_("scrollup",$TPL_SCP,1);?>

	<div class="wrap_mini">
		<div class="mini_banner" style="background-image: url(<?php echo $TPL_VAR["assets_url"]?>/img/mini_banner.jpg);">
			<img src="<?php echo $TPL_VAR["assets_url"]?>/img/mini_banner.jpg" alt="미니배너" style="visibility: hidden; display: none;">
			<div class="banner_inner">
				<div class="subtitle_holder text-center">
					<h1><span>SELLING</span></h1>
				</div>
			</div>
		</div>
	</div>

	<div class="wrapper">
		<form action="<?php echo $TPL_VAR["home_url"]?>/shop/shop_write_ok.php" class="form_custom" method="post" enctype="multipart/form-data">
			<p class="form_title">책 판매하기</p>
			<div class="shop_input">
				<label for="shop_type">책 카테고리</label>
				<select name="shop_type" id="shop_type">
					<option value="magazine">잡지</option>
					<option value="novel">소설</option>
					<option value="foreign">외국서적</option>
					<option value="cartoon">만화</option>
					<option value="it">IT/컴퓨터</option>
					<option value="study">참고서/문제집</option>
					<option value="acc">기타</option>
				</select>
			</div>
			<div class="shop_input">
				<label for="book_name">책 이름</label>
				<div class="book_input">
					<input type="text" name="book_name" id="book_name" placeholder="제목을 입력해주세요...">
				</div>
			</div>
			<div class="shop_input">
				<label for="author">책 저자</label>
				<div class="book_input">
					<input type="text" name="author" id="author" placeholder="글쓴이를 입력해주세요...">
				</div>
			</div>
			<div class="shop_input">
				<label for="public">책 출판사</label>
				<div class="book_input">
					<input type="text" name="public" id="public" placeholder="출판 회사를 입력해주세요...">
				</div>
			</div>
			<div class="shop_input">
				<label for="lang">발행언어</label>
				<div class="book_input">
					<input type="text" name="lang" id="lang" placeholder="ex)한국어, 영어, 독일어 ...">
				</div>
			</div>
			<div class="shop_input">
				<label for="onega">책 원가</label>
				<div class="book_input">
					<input type="text" name="onega" id="onega" placeholder="','없이 책의 원가를 입력해주세요...">
				</div>
			</div>
			<div class="shop_input">
				<label for="price">책 판매가</label>
				<div class="book_input">
					<input type="text" name="price" id="price" placeholder="','없이 중고 판매가를 입력해주세요...">
				</div>
			</div>
			<div class="shop_input">
				<label for="count">책 수량</label>
				<div class="book_input">
					<input type="index" name="count" id="count" placeholder="숫자만 입력해주세요...">
				</div>
			</div>
			<div class="shop_input">
				<textarea name="content" id="content" placeholder="책 상태, 판매이유, 책 구입시기 등을 입력해주세요..."></textarea>
			</div>
			<div class="shop_input">
				<label for="book_pic">사진첨부</label>
				<div class="book_input">
					<input type="file" name="file[]" id="file" multiple>
				</div>
				<div>사진은 최소 3장 최대 5장까지만 등록 가능합니다. 첫 사진은 표지로 이용됩니다.</div>
			</div>
			<div class="input_button">
				<button type="reset">다시작성</button>
				<button type="submit">작성완료</button>
			</div>
		</form>
	</div>
<?php $this->print_("footer",$TPL_SCP,1);?>

</body>
</html>