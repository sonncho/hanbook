<?php /* Template_ 2.2.8 2018/08/22 21:04:36 /Users/sonchowon/portfolio/_template/community/com_edit.html 000005310 */ 
$TPL_com_file_list_1=empty($TPL_VAR["com_file_list"])||!is_array($TPL_VAR["com_file_list"])?0:count($TPL_VAR["com_file_list"]);?>
<!DOCTYPE html>
<html>
<head>
<?php $this->print_("head",$TPL_SCP,1);?>

	<link rel="stylesheet" href="<?php echo $TPL_VAR["assets_url"]?>/css/list.css">
	<link rel="stylesheet" href="<?php echo $TPL_VAR["assets_url"]?>/css/write.css">
</head>
<body>
<?php $this->print_("topbar",$TPL_SCP,1);?>

<?php $this->print_("scrollup",$TPL_SCP,1);?>

	<div class="wrap_mini">
	<div class="mini_banner" style="background-image: url(<?php echo $TPL_VAR["assets_url"]?>/img/mini_banner.jpg);">
		<img src="<?php echo $TPL_VAR["assets_url"]?>/img/mini_banner.jpg" alt="미니배너" style="visibility: hidden; display: none;">
		<div class="banner_inner">
			<div class="subtitle_holder text-center">
				<h1><span><?php echo $TPL_VAR["com_config"]["name"]?></span></h1>
			</div>
		</div>
	</div>
	</div>

	<div class="container">
		<div class="column1">
			<!-- ..전체검색폼.. -->
<!-- 			<div class="all_search_section">
				<p class="commu_col1_title"><span>SEARCH</span></p>
				<div class="search_form">
					<form action="all_search.php" method="get">
						<div class="all_search_box clearfix">
							<input type="text" name="all_keyword" placeholder="Search Here">
							<button type="submit" style="color: #adadad;"><i class="icon ion-search"></i></button>
						</div>
					</form>
				</div>
			</div> -->
			<div class="category_section">
				<p class="commu_col1_title"><span>COMMUNITY</span></p>
				<ul>
					<li><a href="<?php echo $TPL_VAR["home_url"]?>/community/com_list.php?com_type=notice">NOTICE</a></li>
					<li><a href="<?php echo $TPL_VAR["home_url"]?>/community/com_list.php?com_type=qna">Q &amp; A</a></li>
					<li><a href="<?php echo $TPL_VAR["home_url"]?>/community/com_list.php?com_type=review">REVIEW</a></li>
				</ul>
			</div>
		</div>

		<div class="column2">
			<!-- 타이틀시작 -->
			<div class="title_wrap">
				<div class="title_box">
					<div class="title_here">
						<span style="font-size: 13px; font-weight: bolder;"><?php echo $TPL_VAR["com_config"]["name"]?></span>
					</div>
				</div>
			</div>
			<!-- 타이틀 끝 -->
			<!-- 입력폼 시작 -->
			<div class="commu_write_section">
				<form action="<?php echo $TPL_VAR["home_url"]?>/member/my_com_edit_ok.php" method="post" enctype="multipart/form-data">
					<input type="hidden" name="com_type" value="<?php echo $TPL_VAR["com_config"]["type"]?>">
					<input type="hidden" name="com_document_id" value="<?php echo $TPL_VAR["com_document"]["id"]?>">
					<div class="row write_custom clearfix">
						<label for="subject" class="write_custom_title">제목</label>
						<div class="write_custom_input">
							<input type="text" id="subject" name="subject" class="write_custom_input" value="<?php echo $TPL_VAR["com_document"]["subject"]?>">
						</div>
					</div>
<?php if($TPL_VAR["member_info"]===FALSE){?>
					<div class="row write_custom">
						<label for="writer_name" class="write_custom_title">작성자</label>
						<div class="write_custom_input">
							<input type="text" id="writer_name" name="writer_name" class="write_custom_input" value="<?php echo $TPL_VAR["com_document"]["writer_name"]?>">
						</div>
					</div>
					<div class="row write_custom">
						<label for="email" class="write_custom_title">이메일</label>
						<div class="write_custom_input">
							<input type="email" id="email" name="email" class="write_custom_input">
						</div>
					</div>
					<div class="row write_custom">
						<label for="writer_pw" class="write_custom_title">비밀번호</label>
						<div class="write_custom_input">
							<input type="password" id="writer_pw" name="writer_pw" class="write_custom_input">
						</div>
					</div>
<?php }?>
					<div class="row write_custom">
						<textarea name="content" id="content"><?php echo $TPL_VAR["com_document"]["content"]?></textarea>
					</div>
					<div class="row write_custom form_last">
						<label for="file" class="write_custom_title">파일첨부
						</label>
						<div class="write_custom_input">
							<input type="file" id="file" name="file[]" multiple>
						</div>
					</div>

<?php if($TPL_VAR["com_file_list"]!==false){?>
					<!-- 파일삭제 -->
					<div class="row write_custom">
						<label class="write_custom_title">파일삭제</label>
						<div class="preview_delete">
<?php if($TPL_com_file_list_1){foreach($TPL_VAR["com_file_list"] as $TPL_V1){?>
							<div class="check_box display_in">
								<label class="basic_position">
									<input type="checkbox" name="file_delete[]" value="<?php echo $TPL_V1["id"]?>">
									<img src="<?php echo $TPL_V1["file_path"]?>" style="width:95px; height: 95px;">
								</label>
							</div>
<?php }}?>
						</div>
					</div>
<?php }?>
					<div class="write_custom custom_button clearfix">
						<button type="button" onclick="history.back();" class="float-left">돌아가기</button>
						<button type="submit" class="float-right">저장하기</button>
					</div>
				</form>
			</div>
			<!-- 입력폼 끝 -->

		</div>
	</div>
<?php $this->print_("footer",$TPL_SCP,1);?>


</body>
</html>