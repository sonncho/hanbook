<?php /* Template_ 2.2.8 2018/12/12 00:29:38 /Users/sonchowon/portfolio/_template/community/read.html 000010335 */ 
$TPL_file_list_1=empty($TPL_VAR["file_list"])||!is_array($TPL_VAR["file_list"])?0:count($TPL_VAR["file_list"]);?>
<!DOCTYPE html>
<html>
<head>
<?php $this->print_("head",$TPL_SCP,1);?>

	<link rel="stylesheet" href="<?php echo $TPL_VAR["assets_url"]?>/css/list.css">
	<link rel="stylesheet" href="<?php echo $TPL_VAR["assets_url"]?>/css/commu_read.css">
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
			<!-- 글정보시작 -->
			<div class="read_section">
				<div class="read_title">
					<p><?php echo $TPL_VAR["document"]["subject"]?></p>
				</div>
				<div class="read_inform row">
					<div class="inform_attr row">
						<div class="attr_name">작성자</div>
						<div class="attr_value"><?php echo $TPL_VAR["document"]["writer_name"]?></div>	
					</div>					
					<div class="inform_attr row">
						<div class="attr_name">작성일</div>
						<div class="attr_value"><?php echo $TPL_VAR["document"]["reg_date"]?></div>
					</div>			
					<div class="inform_attr row">
						<div class="attr_name">조회</div>
						<div class="attr_value"><?php echo $TPL_VAR["document"]["hit"]?></div>
					</div>					
				</div>
			</div>
			<!-- 글정보끝 -->
			<!-- 글내용시작 -->
			<div class="content_section">
				<div class="content_view">
					<?php echo $TPL_VAR["document"]["content"]?>

				</div>
				<div class="photo_section">
<?php if($TPL_file_list_1> 0){?>
<?php if($TPL_file_list_1){foreach($TPL_VAR["file_list"] as $TPL_V1){?>
						<img src="<?php echo $TPL_VAR["home_url"]?>/<?php echo $TPL_V1["file_path"]?>" alt="">
<?php }}?>
<?php }?>
				</div>
			</div>
			<!-- 글내용끝 -->
			<!-- 댓글폼시작 -->
			<div class="comment_section">
				<div class="comment_top_wrap">
					<div class="comment_count">
					전체 <span class="comment_total_count"><?php echo $TPL_VAR["document"]["cnt"]?></span>개<hr>
					</div>
					<!-- 덧글리스트 -->
					<div class="comment_list">
						<ul id="comment_list">
						</ul>
					</div>
					<!-- 덧글리스트끝 -->
					<form action="<?php echo $TPL_VAR["home_url"]?>/community/comment_insert.php" method="post" class="comment_form" id="comment_form">
						<input type="hidden" name="com_type" value="<?php echo $TPL_VAR["com_config"]["type"]?>">
						<input type="hidden" name="document_id" value="<?php echo $TPL_VAR["document"]["id"]?>">
						<div class="comment_write clearfix">
<?php if(!$TPL_VAR["member_info"]){?>
							<div class="form_group float-left">
								<label for="writer_name" class="comment_input_label">작성자</label>
								<input type="text" id="writer_name" name="writer_name" class="comment_input">
							</div>
							<div class="form_group float-left">
								<label for="writer_pw" class="comment_input_label">비밀번호</label>
								<input type="password" id="writer_pw" name="writer_pw" class="comment_input">
							</div>
<?php }?>
							<div class="comment_submit">
								<div class="comment_submit_text">
									<textarea name="content" id="reply_who"></textarea>
								</div>
								<div class="comment_submit_btn">
									<button type="submit">입력</button>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
			<!-- 댓글폼끝 -->
			<!-- 버튼들시작 -->
			<div class="control_button clearfix">
				<div class="float-left">
					<a href="com_list.php?com_type=<?php echo $TPL_VAR["com_config"]["type"]?>">목록보기</a>
					<a href="read.php?com_type=<?php echo $TPL_VAR["com_config"]["type"]?>&document_id=<?php echo $TPL_VAR["prev_document"]["id"]?>">이전글</a>
					<a href="read.php?com_type=<?php echo $TPL_VAR["com_config"]["type"]?>&document_id=<?php echo $TPL_VAR["next_document"]["id"]?>">다음글</a>
				</div>
			</div>
			<!-- 버튼들끝 -->
		</div>
	</div>
<?php $this->print_("footer",$TPL_SCP,1);?>


	<script type="text/javascript">
		$(function() {
			// 답글 이벤트 함수설정
			$(document).on('click', '.comment_reply', function(e){
			    e.preventDefault();
			    var what= $(this).closest('li').find('.comment_username').text(); //클릭된곳의 글쓴이의 이름을 얻음 ex)손초원
			    $("#reply_who").append('@'+what+' ');
			    $("#reply_who").focus();
			});

			// remote modal delete 강제오픈
			$(document).on('click', '.comment_delete_btn', function(e){
			    // 링크 클릭시 페이지 이동 방지
			    e.preventDefault();
			    // 삭제버튼의 href 속성 얻기
			    var url = $(this).attr('href');
			    // modal 틀 안에 url을 Ajax로 로드해 넣기
			    $("#comment_delete_modal").find('.modal-content').load(url);
			    // modal창 강제로 열기
			    $("#comment_delete_modal").modal('show');
			});

			// remote modal edit 강제오픈
			$(document).on('click', '.comment_edit_btn', function(e) {
				e.preventDefault();
				var url = $(this).attr('href');
				$("#comment_edit_modal").find('.modal-content').load(url);
				$("#comment_edit_modal").modal('show');
			});

			$("#comment_form").ajaxForm(function(json) {
				if (json.rt != "OK") {
					alert(json.rt);
					return false;
				}
				var template = Handlebars.compile($("#tmpl_comment_item").html());
				var html = template(json.item);
				$("#comment_list").append(html);
				$("#comment_form").trigger('reset');
			});

			// 덧글 목록 조회
			$.get("<?php echo $TPL_VAR["home_url"]?>/community/comment_list.php", {
				com_type: "<?php echo $TPL_VAR["com_config"]["type"]?>", 
				document_id: "<?php echo $TPL_VAR["document"]["id"]?>"
			}, function(json) {
				// 처리결과가 성공이 아닌 경우
				if(json.rt != "OK") {
					alert(json.rt);
					return false;
				}		
				var template = Handlebars.compile($("#tmpl_comment_item").html());
				for (var i=0; i< json.item.length; i++) {
					var html = template(json.item[i]);
					$("#comment_list").append(html);			
				}		
			});

			// 모든 모달창의 캐시방지처리
			$('.modal').on('hidden.bs.modal', function(e) {
				$(this).removeData('bs.modal');
			});

			// 동적으로 로드된 폼 안에서의 submit이벤트
			$(document).on('submit', "#comment_delete_form", function(e) {
				e.preventDefault();
				$(this).ajaxSubmit(function(json) {
					if (json.rt != "OK") {
						alert(json.rt);
						return false;
					}
					alert("삭제되었습니다.");
					// modal강제로 닫기
					$("#comment_delete_modal").modal('hide');

					// JSON 결과에 포함된 덧글일련번호를 사용하여 삭제할 <li>의 id값을 찾는다.
					var comment_id = json.comment_id;
					$("#comment_" + comment_id).remove();
					// 댓글 삭제시 전체 댓글 갯정 수정정
					var total_cnt = $('.comment_total_count').text();
					$(".comment_total_count").html(total_cnt-1);
				});
			});

			// 동적으로 로드된 edit submit이벤트
			$(document).on('submit', "#comment_edit_form", function(e) {
				e.preventDefault();
				$(this).ajaxSubmit(function(json) {
					if (json.rt != "OK") {
						alert(json.rt);
						return false;
					}

					var template = Handlebars.compile($("#tmpl_comment_item").html());
					var html = template(json.item);
					// 결합된 결과를 기존의 덧글 항목과 교체한다.
					$("#comment_" + json.item.id).replaceWith(html);
					$("#comment_edit_modal").modal('hide');
				});
			});
		});
	</script>
	<!-- 덧글 항목에 대한 템플릿 참조 -->
	<script id="tmpl_comment_item" type="text/x-handlebars-template">
		<li class="comment_item" id="comment_{{id}}">
			<div class="clearfix">
				<div class="comment_username float-left" id="who_is">{{writer_name}}</div>
				<div class="comment_date float-right">{{reg_date}}</div>
			</div>
			<div class="comment_content">{{{content}}}</div>
			<div class="comment_control">
				<span><a href="<?php echo $TPL_VAR["home_url"]?>/community/comment_delete.php?com_type=<?php echo $TPL_VAR["com_config"]["type"]?>&comment_id={{id}}" class="comment_delete_btn">삭제</a></span>
				<span style="color: #a0a0a0;">|</span>
				<span><a href="<?php echo $TPL_VAR["home_url"]?>/community/comment_edit.php?com_type=<?php echo $TPL_VAR["com_config"]["type"]?>&comment_id={{id}}" class="comment_edit_btn">수정</a></span>
				<span style="color: #a0a0a0;">|</span>
				<span><a href="#" class="comment_reply">답글</a></span>
			</div>
			<hr>
		</li>	
	</script>

	<!-- 덧글 삭제시 사용될 Remote_Modal -->
	<div class="modal fade" id="comment_delete_modal" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">

			</div>
		</div>
	</div>

	<!-- 덧글 수정시 사용될 Remote_Modal -->
	<div class="modal fade" id="comment_edit_modal" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">

			</div>
		</div>
	</div>

</body>
</html>