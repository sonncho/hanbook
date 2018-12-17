<?php /* Template_ 2.2.8 2018/12/07 18:02:07 /Users/sonchowon/portfolio/_template/shop/shop_read.html 000015020 */ 
$TPL_file_list_1=empty($TPL_VAR["file_list"])||!is_array($TPL_VAR["file_list"])?0:count($TPL_VAR["file_list"]);?>
<!DOCTYPE html>
<html>
<head>
<?php $this->print_("head",$TPL_SCP,1);?>

    <link rel="stylesheet" href="<?php echo $TPL_VAR["assets_url"]?>/css/shop_read.css">
</head>

<body>
<?php $this->print_("topbar",$TPL_SCP,1);?>

<?php $this->print_("scrollup",$TPL_SCP,1);?>

    <div class="wrap_mini">
        <div class="mini_banner" style="background-image: url(<?php echo $TPL_VAR["assets_url"]?>/img/mini_banner.jpg);">
            <img src="<?php echo $TPL_VAR["assets_url"]?>/img/mini_banner.jpg" alt="미니배너" style="visibility: hidden; display: none;">
            <div class="banner_inner">
                <div class="subtitle_holder text-center">
                    <h1><span>SHOP</span></h1>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="item_info_row row">
            <div class="item_column1">
                <img src="<?php echo $TPL_VAR["file_list"][ 0]["thumbnail"]?>" alt="썸네일">
            </div>
            <div class="item_column2">
                <div class="item_info">
                    <div class="book_title"><?php echo $TPL_VAR["document"]["book_name"]?></div>
                    <div class="book_review">(<?php echo $TPL_VAR["shop_qna_cnt"]["cnt"]?>개의 리뷰)</div>
                </div>
                <div class="price_info">
                    <div class="book_price">
                        <p class="onega">
                            <del><span>₩<?php echo $TPL_VAR["document"]["onega"]?></span></del>
                        </p>
                        <p class="price">₩<?php echo $TPL_VAR["document"]["price"]?></p>
                    </div>
                </div>
                <div class="seller_info">
                    <p>판매자 : <?php echo $TPL_VAR["document"]["seller"]?></p>
                    <p>연락처 : <span><?php echo $TPL_VAR["document"]["tel"]?></span></p>
                </div>
                <div class="sell_btn">
<?php if($TPL_VAR["like_is"]=="NO"){?>
                    <form  method="post" action="<?php echo $TPL_VAR["home_url"]?>/shop/shop_like_ok.php" class="like_form" id="like_form">
                        <input type="hidden" name="member_id" id="member_id" value=<?php echo $TPL_VAR["member_info"]["id"]?>>
                        <input type="hidden" name="shop_document_id" id="shop_document_id" value=<?php echo $TPL_VAR["document"]["id"]?>>
                        <button type="submit" name="like_ok" id="like_ok">관심상품</button>
                    </form>
<?php }else{?>
                    <div class="like_is_ok"><img src="<?php echo $TPL_VAR["assets_url"]?>/img/circle-check.svg">관심상품</div>
<?php }?>
                    <a href="#tab2">문의하기</a>
                </div>
                <div class="book_info">
                    <p>- 저자 : <?php echo $TPL_VAR["document"]["author"]?></p>
                    <p>- 출판사 : <?php echo $TPL_VAR["document"]["public"]?></p>
                    <p>- 카테고리 : <?php echo $TPL_VAR["shop_config"]["name"]?></p>
                    <p>- 남은수량 : <?php echo $TPL_VAR["document"]["count"]?></p>
                    <p>- 발행언어 : <?php echo $TPL_VAR["document"]["lang"]?></p>
                </div>
            </div>
        </div>
        <!-- 본문탭! -->
        <div class="tabs">
            <ul class="tab-links">
                <li class="active"><a href="#tab1">상세 정보</a></li>
                <li><a href="#tab2">문의(<span class="top_cnt qna_total_count"><?php echo $TPL_VAR["shop_qna_cnt"]["cnt"]?></span>)</a></li>
                <li><a href="#tab3">리뷰(2)</a></li>
            </ul>
            <div class="tab-content">
                <div id="tab1" class="tab active">
                    <p class="content_detail">
                    <?php echo $TPL_VAR["document"]["content"]?>

                    </p>
<?php if($TPL_file_list_1> 0){?>
<?php if($TPL_file_list_1){foreach($TPL_VAR["file_list"] as $TPL_V1){?>
                        <div class="content_img">
                    		<img src="<?php echo $TPL_VAR["home_url"]?>/<?php echo $TPL_V1["file_path"]?>" alt="상세사진">
                        </div>  
<?php }}?>
<?php }?>
                </div>
                <div id="tab2" class="tab">
                    <div class="content_qna">
                    	<p class="qna_count"><span class="qna_total_count mid_cnt"><?php echo $TPL_VAR["shop_qna_cnt"]["cnt"]?></span> 문의 MARCH BE HEALTHY</p>
                    	<div class="qna_section">
                            <!-- 덧글 리스트: ajax결과 출력될 위치 -->
                    		<ul class="media_list" id="qna_list">
                    		</ul>
                    	</div>
                        <div class="form_section">
                            <h3 class="form_title">문의 작성하기</h3>
                            <form action="<?php echo $TPL_VAR["home_url"]?>/shop/qna_insert.php" method="post" id="qna_form">
                                <input type="hidden" name="shop_type" value="<?php echo $TPL_VAR["shop_config"]["type"]?>">
                                <input type="hidden" name="shop_document_id" value="<?php echo $TPL_VAR["document"]["id"]?>">
<?php if(!$TPL_VAR["member_info"]){?>
                                <p class="qna_form_writer">
                                    <label for="writer_name">이름*</label>
                                    <input type="text" name="writer_name" id="writer_name">
                                </p>
                                <p class="qna_form_pw">
                                    <label for="author">비밀번호*</label>
                                    <input type="password" name="writer_pw" id="writer_pw">
                                </p>
                                <p class="qna_form_email">
                                    <label for="email">이메일*</label>
                                    <input type="email" name="email" id="email">
                                </p>
<?php }?>
                                <p class="qna_form_comment">
                                    <label for="content">고객님의 문의</label>
                                    <textarea name="content" id="content" cols="45" rows="8"></textarea>
                                </p>
                                <p class="qna_form_submit">
                                    <input type="submit" value="제출하기">
                                </p>
                            </form>
                        </div>
                    </div>
                </div>
                <div id="tab3" class="tab">
                    <p>Tab #3 content goes here!</p>
                    <p>Donec pulvinar neque sed semper lacinia. Curabitur lacinia ullamcorper nibh; quis imperdiet velit eleifend ac. Donec blandit mauris eget aliquet lacinia! Donec pulvinar massa interdum ri.Donec pulvinar neque sed semper lacinia. Curabitur lacinia ullamcorper nibh; quis imperdiet velit eleifend ac. Donec blandit mauris eget aliquet lacinia! Donec pulvinar massa interdum ri.Donec pulvinar neque sed semper lacinia. Curabitur lacinia ullamcorper nibh; quis imperdiet velit eleifend ac. Donec blandit mauris eget aliquet lacinia! Donec pulvinar massa interdum ri.Donec pulvinar neque sed semper lacinia. Curabitur lacinia ullamcorper nibh; quis imperdiet velit eleifend ac. Donec blandit mauris eget aliquet lacinia! Donec pulvinar massa interdum ri.</p>
                </div>
            </div>
        </div>
    </div>
<?php $this->print_("footer",$TPL_SCP,1);?>

    <script type="text/javascript">
        $(document).ready(function() {
			$('.tabs .tab-links a').on('click', function(e)  {
				var currentAttrValue = $(this).attr('href');
				// Show/Hide Tabs
				$('.tabs ' + currentAttrValue).fadeIn(400).siblings().hide();
				// Change/remove current tab to active
				$(this).parent('li').addClass('active').siblings().removeClass('active');
				e.preventDefault();
			});
		});

        $(function() {
            /** 관심상품 submit 페이지이동 없이 Ajax로 구현**/
            $(document).on('submit', '#like_form', function(e) {
                e.preventDefault();
                $(this).ajaxSubmit(function(json) {
                    if (json.rt != "OK") {
                        alert(json.rt);
                        return false;
                    }
                    alert('관심상품에 담겼습니다. 마이페이지에서 확인 가능합니다.');
                    location.reload();
                });
            });

            // remote modal 강제오픈
            $(document).on('click', '#delete_btn', function(e){
                // 링크 클릭시 페이지 이동 방지
                e.preventDefault();
                // 삭제버튼의 href 속성 얻기
                var url = $(this).attr('href');
                // modal 틀 안에 url을 Ajax로 로드해 넣기
                $("#qna_delete_modal").find('.modal-content').load(url);
                // modal창 강제로 열기
                $("#qna_delete_modal").modal('show');
            });

            $(document).on('click', '#edit_btn', function(e){
                // 링크 클릭시 페이지 이동 방지
                e.preventDefault();
                // 삭제버튼의 href 속성 얻기
                var url = $(this).attr('href');
                // modal 틀 안에 url을 Ajax로 로드해 넣기
                $("#qna_edit_modal").find('.modal-content').load(url);
                // modal창 강제로 열기
                $("#qna_edit_modal").modal('show');
            });

            /** 덧글 작성 폼의 submit이벤트 Ajax로 구현 **/
            // ajaxForm함수 : <form>요소의 method, action속성과 input태그를 Ajax요청으로 자동 구성
            $("#qna_form").ajaxForm(function(json) {
                if (json.rt != "OK") {
                    alert(json.rt);
                    return false;
                }
                var template = Handlebars.compile($("#tmpl_comment_item").html());
                var html = template(json.item);
                $("#qna_list").append(html);
                $("#qna_form").trigger('reset');
            });

            /* 덧글 목록 조회하기 */
            // 페이지가 열리면서 동작하도록 이벤트 정의 없이 Ajax요청
            $.get("<?php echo $TPL_VAR["home_url"]?>/shop/qna_list.php", {
                shop_type: "<?php echo $TPL_VAR["shop_config"]["type"]?>",
                shop_document_id: "<?php echo $TPL_VAR["document"]["id"]?>"
            }, function(json) {
                // 처리결과가 성공이 아닌 경우
                if (json.rt != "OK") {
                    alert(json.rt);
                    return false;
                }
                var template = Handlebars.compile($("#tmpl_comment_item").html());
                for (var i = 0;i<json.item.length; i++) {
                    var html = template(json.item[i]);
                    $("#qna_list").append(html);
                }
            });

            // 모달창 캐시 방리 처리
            $('.modal').on('hidden.bs.modal', function(e){
                $(this).removeData('bs.modal');
            });

            // 동적으로 로드된 폼 안에서의 submit이벤트
            $(document).on('submit', "#qna_delete_form", function(e){
                e.preventDefault();
                $(this).ajaxSubmit(function(json) {
                    if (json.rt != 'OK') {
                        alert(json.rt);
                        return false;
                    }
                    alert("삭제되었습니다.");
                    $("#qna_delete_modal").modal('hide');
                    var qna_id = json.shop_qna_id;
                    $("#qna_"+qna_id).remove();

                    var top_cnt = $('.top_cnt').text();
                    $(".top_cnt").html(top_cnt-1);

                    var mid_cnt = $('.mid_cnt').text();
                    $(".mid_cnt").html(mid_cnt-1);
                });
            });
            // 동적으로 로드된 edit submit이벤트
            $(document).on('submit', "#qna_edit_form", function(e) {
                e.preventDefault();
                $(this).ajaxSubmit(function(json) {
                    if (json.rt != "OK") {
                        alert(json.rt);
                        return false;
                    }
                    var template = Handlebars.compile($("#tmpl_comment_item").html());
                    var html = template(json.item);
                    $("#qna_"+json.item.id).replaceWith(html);
                    $("#qna_edit_modal").modal('hide');
                });
            });

        });

    </script>
    <script id="tmpl_comment_item" type="text/x-handlebars-template">
        <li class="qna_list clearfix" id="qna_{{id}}">
            <div class="clearfix comment_info">
                <div class="qna_username float-left"><img src="<?php echo $TPL_VAR["assets_url"]?>/img/profile_pic.png" class="rounded-circle"style="width:30px; margin-right: 10px;">{{writer_name}}</div>
                <div class="qna_date float-right">{{reg_date}}</div>
            </div>
            <div class="qna_content">{{{content}}}</div>
            <div class="qna_control">
                <span><a href="<?php echo $TPL_VAR["home_url"]?>/shop/qna_edit.php?shop_type=<?php echo $TPL_VAR["shop_config"]["type"]?>&shop_qna_id={{id}}" data-toggle="modal" data-target="#qna_edit_modal" id="edit_btn">수정</a></span>
                <span style="color: #a3a3a3;">|</span>
                <span><a href="<?php echo $TPL_VAR["home_url"]?>/shop/qna_delete.php?shop_type=<?php echo $TPL_VAR["shop_config"]["type"]?>&shop_qna_id={{id}}" data-toggle="modal" id="delete_btn" data-target="#qna_delete_modal">삭제</a></span>
                <span style="color: #a3a3a3;">|</span>
                <span><a href="<?php echo $TPL_VAR["home_url"]?>/shop/qna_reply.php">답글</a></span>
            </div>
        </li>
    </script>

    <!-- 덧글 삭제시 사용할 modal -->
    <div class="modal fade" id="qna_delete_modal" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <!-- 가져오기 -->
        </div>
      </div>
    </div>

    <div class="modal fade" id="qna_edit_modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">

            </div>
        </div>
    </div>
    
</body>
</html>