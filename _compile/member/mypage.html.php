<?php /* Template_ 2.2.8 2018/12/10 23:42:10 /Users/sonchowon/portfolio/_template/member/mypage.html 000007678 */ 
$TPL_my_like_1=empty($TPL_VAR["my_like"])||!is_array($TPL_VAR["my_like"])?0:count($TPL_VAR["my_like"]);
$TPL_my_book_1=empty($TPL_VAR["my_book"])||!is_array($TPL_VAR["my_book"])?0:count($TPL_VAR["my_book"]);
$TPL_my_com_1=empty($TPL_VAR["my_com"])||!is_array($TPL_VAR["my_com"])?0:count($TPL_VAR["my_com"]);?>
<!DOCTYPE html>
<html>
<head>
<?php $this->print_("head",$TPL_SCP,1);?>

	<link rel="stylesheet" href="<?php echo $TPL_VAR["assets_url"]?>/css/join_login.css">
	<link rel="stylesheet" href="<?php echo $TPL_VAR["assets_url"]?>/css/mypage.css">
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
		<div class="mypage_custom">
			<div class="my_top">
				<div>안녕하세요 <?php echo $TPL_VAR["member_info"]["user_name"]?>님. 한북 HANBOOK에 오신걸 환영합니다.(<a href="<?php echo $TPL_VAR["home_url"]?>/member/logout.php" class="logout_btn">로그아웃 하기</a>)</div>
				<div class="btn_edit"><a href="<?php echo $TPL_VAR["home_url"]?>/member/edit.php">내 정보 수정하기</a></div>
				<div><a href="<?php echo $TPL_VAR["home_url"]?>/member/out.php">탈퇴하기</a></div>
			</div>

			<div class="my_like">
				<p class="section_title">내 관심상품 목록</p>
				<ul class="my_like clearfix">
<?php if($TPL_VAR["my_like"]!=false){?>
<?php if($TPL_my_like_1){foreach($TPL_VAR["my_like"] as $TPL_V1){?>
				<li class="my_like_li">
					<a href="<?php echo $TPL_VAR["home_url"]?>/shop/shop_read.php?shop_type=<?php echo $TPL_V1["shop_type"]?>&shop_document_id=<?php echo $TPL_V1["shop_document_id"]?>">
						<span class="like_thumb"><img src="<?php echo $TPL_V1["thumbnail"]?>" alt=""></span>
					</a>
					<div class="my_like_text">
						<div class="like_title"><h6><?php echo $TPL_V1["book_name"]?></h6></div>
						<div>판매자 : <?php echo $TPL_V1["seller"]?> / <span><?php echo $TPL_V1["tel"]?></span></div>
						<div>판매가격 : <?php echo $TPL_V1["price"]?>원</div>
						<div>카테고리 : <?php echo $TPL_V1["shop_type"]?></div>
						<form action="<?php echo $TPL_VAR["home_url"]?>/shop/shop_like_delete.php" method="post" id="like_form">
							<input type="hidden" name="shop_document_id" value="<?php echo $TPL_V1["shop_document_id"]?>">
							<input type="hidden" name="shop_type" value="<?php echo $TPL_V1["shop_type"]?>">
							<button type="submit" class="like_delete_btn">삭제<img src="<?php echo $TPL_VAR["assets_url"]?>/img/delete.png" class="delete_icon" alt="삭제"></button>
						</form>
						<!-- <img src="<?php echo $TPL_VAR["assets_url"]?>/img/delete.png" alt="삭제" class="delete_icon"></a> -->
					</div>
					
				</li>
<?php }}?>
<?php }else{?>
				<div class="no_like">관심상품이 없습니다.</div>
<?php }?>
				</ul>
			</div>
			
			<div class="book_section">
				<p class="section_title">판매하고 있는 책 보기</p>
				<ul class="my_books clearfix" id="more_load">
<?php if($TPL_VAR["my_book"]!=false){?>
<?php if($TPL_my_book_1){foreach($TPL_VAR["my_book"] as $TPL_V1){?>
					<li class="book_li more_load">
						<a href="<?php echo $TPL_VAR["home_url"]?>/shop/shop_read.php?shop_type=<?php echo $TPL_V1["shop_type"]?>&shop_document_id=<?php echo $TPL_V1["id"]?>"><span><img src="<?php echo $TPL_V1["thumbnail"]?>" alt="">
						</span></a>
						<div class="li_content">
							<div class="book_name"><h6><?php echo $TPL_V1["book_name"]?></h6></div>
							<div class="my_btn">
								<a href="<?php echo $TPL_VAR["home_url"]?>/member/my_shop_edit.php?document_id=<?php echo $TPL_V1["id"]?>&shop_type=<?php echo $TPL_V1["shop_type"]?>">수정</a>
								<a href="<?php echo $TPL_VAR["home_url"]?>/member/my_shop_delete.php?document_id=<?php echo $TPL_V1["id"]?>&shop_type=<?php echo $TPL_V1["shop_type"]?>">삭제</a>
							</div>
						</div>
					</li>
<?php }}?>
<?php }else{?>
					<div class="text-center">현재 판매중인 책이 없습니다.</div>
<?php }?>
				</ul>
				<div class="btn_wrap" id="js_btn_wrap"><a href="javascript:;" class="button">더보기</a></div>
			</div>
			<div class="my_community">
				<p class="section_title">내가 쓴 게시글 보기</p>
				<table class="table table-sm">
					<thead class="text-center">
						<tr>
							<td class="my_cate">분류</td>
							<td class="my_title">제목</td>
							<td class="my_date">날짜</td>
							<td class="my_hit">조회수</td>
							<td class="my_btn">관리</td>
						</tr>
					</thead>
					<tbody class="text-center">
<?php if($TPL_VAR["my_com"]!=false){?>
<?php if($TPL_my_com_1){foreach($TPL_VAR["my_com"] as $TPL_V1){?>
						<tr>
							<td class="my_cate"><?php echo $TPL_V1["com_type"]?></td>
							<td class="my_title text-left">
								<div class="cut_strings">
									<nobr><a href="<?php echo $TPL_VAR["home_url"]?>/community/read.php?com_type=<?php echo $TPL_V1["com_type"]?>&document_id=<?php echo $TPL_V1["id"]?>"><?php echo htmlspecialchars($TPL_V1["subject"])?><span style="color: red;">[<?php echo $TPL_V1["cnt"]?>]</span></a></nobr>
								</div>
							</td>
							<td class="my_date"><?php echo substr($TPL_V1["reg_date"], 0, 10)?></td>
							<td class="my_hit"><?php echo $TPL_V1["hit"]?></td>
							<td class="table_btn my_btn">
								<a href="<?php echo $TPL_VAR["home_url"]?>/member/my_com_edit.php?document_id=<?php echo $TPL_V1["id"]?>&com_type=<?php echo $TPL_V1["com_type"]?>">수정</a>
								<a href="#">삭제</a>
							</td>
						</tr>
<?php }}?>
<?php }else{?>
						<tr>
							<td colspan="5">작성한 글이 존재하지 않습니다.</td>
						</tr>
<?php }?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
<?php $this->print_("footer",$TPL_SCP,1);?>


	<!-- 더보기버튼 구현 -->
	<script type="text/javascript">
		$(function(){
			// 내 관심상품 삭제이벤트 생성
			$(document).on('submit', '#like_form', function(e) {
                e.preventDefault();
                $(this).ajaxSubmit(function(json) {
                    if (json.rt != "OK") {
                        alert(json.rt);
                        return false;
                    }
                    alert('관심상품에서 삭제되었습니다.');
                    location.reload();
                });
            });

			if ($(window).width() < 998 ) {
				$("#more_load .more_load").slice(0, 3).show();
				if ($("#more_load .more_load:hidden").length == 0) {
					$("#js_btn_wrap").hide();
				}
				$("#js_btn_wrap").on('click', function(e) {
					e.preventDefault();
					$("#more_load .more_load:hidden").slice(0, 3).slideDown();
					if ($("#more_load .more_load:hidden").length == 0) {
						$("#js_btn_wrap").fadeOut('slow');
					}
				});
			} else {
				$("#more_load .more_load").slice(0, 5).show();
				if ($("#more_load .more_load:hidden").length == 0) {
					$("#js_btn_wrap").hide();
				}
				$("#js_btn_wrap").on('click', function(e) {
					e.preventDefault();
					$("#more_load .more_load:hidden").slice(0, 5).slideDown();
					if ($("#more_load .more_load:hidden").length == 0) {
						$("#js_btn_wrap").fadeOut('slow');
					}
				});
			}
		});
	</script>
</body>
</html>