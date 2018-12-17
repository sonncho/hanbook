<?php /* Template_ 2.2.8 2018/11/20 22:51:13 /Users/sonchowon/portfolio/_template/shop/shop_edit.html 000005304 */ 
$TPL_file_list_1=empty($TPL_VAR["file_list"])||!is_array($TPL_VAR["file_list"])?0:count($TPL_VAR["file_list"]);?>
<!DOCTYPE html>
<html>
<head>
<?php $this->print_("head",$TPL_SCP,1);?>

	<link rel="stylesheet" href="<?php echo $TPL_VAR["assets_url"]?>/css/join_login.css">
	<link rel="stylesheet" href="<?php echo $TPL_VAR["assets_url"]?>/css/shop_write.css">
	<link rel="stylesheet" href="<?php echo $TPL_VAR["assets_url"]?>/css/shop_edit.css">

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
		<form action="<?php echo $TPL_VAR["home_url"]?>/member/my_shop_edit_ok.php" class="form_custom" method="post" enctype="multipart/form-data">
			<p class="form_title">책 판매하기</p>
			<input type="hidden" name="document_id" value="<?php echo $TPL_VAR["document"]["id"]?>">
			<input type="hidden">
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
					<input type="text" name="book_name" id="book_name" placeholder="제목을 입력해주세요..." value="<?php echo $TPL_VAR["document"]["book_name"]?>">
				</div>
			</div>
			<div class="shop_input">
				<label for="author">책 저자</label>
				<div class="book_input">
					<input type="text" name="author" id="author" placeholder="글쓴이를 입력해주세요..." value="<?php echo $TPL_VAR["document"]["author"]?>">
				</div>
			</div>
			<div class="shop_input">
				<label for="public">책 출판사</label>
				<div class="book_input">
					<input type="text" name="public" id="public" placeholder="출판 회사를 입력해주세요..." value="<?php echo $TPL_VAR["document"]["public"]?>">
				</div>
			</div>
			<div class="shop_input">
				<label for="lang">발행언어</label>
				<div class="book_input">
					<input type="text" name="lang" id="lang" placeholder="ex)한국어, 영어, 독일어 ..." value="<?php echo $TPL_VAR["document"]["lang"]?>">
				</div>
			</div>
			<div class="shop_input">
				<label for="onega">책 원가</label>
				<div class="book_input">
					<input type="text" name="onega" id="onega" placeholder="','없이 책의 원가를 입력해주세요..." value="<?php echo $TPL_VAR["document"]["onega"]?>">
				</div>
			</div>
			<div class="shop_input">
				<label for="price">책 판매가</label>
				<div class="book_input">
					<input type="text" name="price" id="price" placeholder="','없이 중고 판매가를 입력해주세요..." value="<?php echo $TPL_VAR["document"]["price"]?>">
				</div>
			</div>
			<div class="shop_input">
				<label for="count">책 수량</label>
				<div class="book_input">
					<input type="index" name="count" id="count" placeholder="숫자만 입력해주세요..." value="<?php echo $TPL_VAR["document"]["count"]?>">
				</div>
			</div>
			<div class="shop_input">
				<textarea name="content" id="content" placeholder="책 상태, 판매이유, 책 구입시기 등을 입력해주세요..."><?php echo $TPL_VAR["document"]["content"]?></textarea>
			</div>
			<div class="shop_input">
				<label for="book_pic">사진첨부</label>
				<div class="book_input">
					<input type="file" name="file[]" id="file" multiple style="height: 22px;">
				</div>
				<div class="sub_ment">- 사진은 최소 3장 최대 5장까지만 등록 가능합니다. 첫 사진은 표지로 이용됩니다.</div>
			</div>
			<div class="shop_input" style="padding-bottom: 10px">
<?php if($TPL_VAR["file_list"]!==false){?>
				<!-- 파일삭제 -->
				<div class="delete_section">
					<label class="">파일삭제</label>
					<div class="preview_delete">
<?php if($TPL_file_list_1){foreach($TPL_VAR["file_list"] as $TPL_V1){?>
						<div class="check_box">
							<label class="basic_position">
								<input type="checkbox" name="file_delete[]" value="<?php echo $TPL_V1["id"]?>">
								<img src="<?php echo $TPL_V1["file_path"]?>" style="width:95px; height: 95px;">
							</label>
						</div>
<?php }}?>
					</div>
				</div>
<?php }?>
			</div>
			<div class="input_button">
				<button type="reset">다시작성</button>
				<button type="submit">작성완료</button>
			</div>
		</form>
	</div>
<?php $this->print_("footer",$TPL_SCP,1);?>


	<script type="text/javascript">
	</script>
</body>
</html>