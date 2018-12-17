<?php /* Template_ 2.2.8 2018/08/21 15:57:50 /Users/sonchowon/portfolio/_template/shop/shop_list.html 000007497 */ 
$TPL_document_list_1=empty($TPL_VAR["document_list"])||!is_array($TPL_VAR["document_list"])?0:count($TPL_VAR["document_list"]);?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php $this->print_("head",$TPL_SCP,1);?>

	<link rel="stylesheet" href="<?php echo $TPL_VAR["assets_url"]?>/css/list.css">
	<link rel="stylesheet" href="<?php echo $TPL_VAR["assets_url"]?>/css/shop_list.css">
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
		<div class="column1">
			<!-- ..전체검색폼.. -->
			<div class="all_search_section">
				<p class="commu_col1_title"><span>SEARCH</span></p>
				<div class="search_form">
					<form action="shop_list.php" method="get">
						<div class="all_search_box clearfix">
							<input type="hidden" name="shop_type" value="<?php echo $TPL_VAR["shop_config"]["type"]?>">
							<input type="hidden" name="select_sort" value="<?php echo $TPL_VAR["select_sort"]?>">
							<input type="text" name="keyword" placeholder="Search Here" value="<?php echo $TPL_VAR["keyword"]?>">
							<button type="submit" style="color: #adadad;"><i class="icon ion-search"></i></button>
						</div>
					</form>
				</div>
			</div>
			<div class="category_section">
				<p class="commu_col1_title"><span>SHOP</span></p>
				<ul id="shop_cate">
					<li><a href="<?php echo $TPL_VAR["home_url"]?>/shop/shop_list.php?shop_type=magazine">MAGAZINE</a></li>
					<li><a href="<?php echo $TPL_VAR["home_url"]?>/shop/shop_list.php?shop_type=novel">NOVEL</a></li>
					<li><a href="<?php echo $TPL_VAR["home_url"]?>/shop/shop_list.php?shop_type=foreign">FOREIGN</a></li>
					<li><a href="<?php echo $TPL_VAR["home_url"]?>/shop/shop_list.php?shop_type=cartoon" id="cartoon">CARTOON</a></li>
					<li><a href="<?php echo $TPL_VAR["home_url"]?>/shop/shop_list.php?shop_type=it">IT / COMPUTER</a></li>
					<li><a href="<?php echo $TPL_VAR["home_url"]?>/shop/shop_list.php?shop_type=study">STUDY</a></li>
					<li><a href="<?php echo $TPL_VAR["home_url"]?>/shop/shop_list.php?shop_type=acc">ACC</a></li>
				</ul>
			</div>
		</div>

		<div class="column2">
			<div class="column_inner clearfix">
				<p class="write_btn float-right"><a href="<?php echo $TPL_VAR["home_url"]?>/shop/shop_write.php?shop_type=<?php echo $TPL_VAR["shop_config"]["type"]?>">판매하기</a></p>
				<!-- 게시물정렬시작 -->
				<form class="select_sort" action="shop_list.php" method="get" id="sorting"> 
					<input type="hidden" name="shop_type" value="<?php echo $TPL_VAR["shop_config"]["type"]?>">
					<input type="hidden" name="keyword" value="<?php echo $TPL_VAR["keyword"]?>">
					<select name="sortby" id="sortby" class="sortby">
						<option value="date">최신순</option>
						<option value="popularity">인기순</option>
						<option value="price">높은가격순</option>
						<option value="price_asc">낮은가격순</option>
					</select>
					<button type="submit" style="visibility: hidden;">submit</button>
				</form>
				<!-- 게시물정렬끝 -->

				<!-- 리스트시작 -->
				<ul class="products clearfix">
<?php if($TPL_VAR["document_list"]!=false){?>
<?php if($TPL_document_list_1){foreach($TPL_VAR["document_list"] as $TPL_V1){?>
						<li class="product_li">
							<div class="top_product_li">
								<a href="shop_read.php?shop_type=<?php echo $TPL_VAR["shop_config"]["type"]?>&shop_document_id=<?php echo $TPL_V1["id"]?>">
									<span><img src="<?php echo $TPL_V1["thumbnail"]?>" style="width: 256px; height:256px"></span>
									<h6><?php echo htmlspecialchars($TPL_V1["book_name"])?></h6>
									<span class="book_count">남은 수량 : <?php echo $TPL_V1["count"]?></span>
								</a>
							</div>
							<span class="price">
								<del><span class="amount">₩<?php echo $TPL_V1["onega"]?></span></del>
								<ins><span class="amount">₩<?php echo $TPL_V1["price"]?></span></ins>
							</span>
						</li>
<?php }}?>
<?php }else{?>
					<div class="text-center" style="background-color: #f6f7fb; width: 100%; min-height: 200px; line-height: 200px;">조회된 글이 없습니다.</div>
<?php }?>
				</ul>
				<!-- 리스트끝 -->

				<!-- 페이지번호시작 -->
				<div class="page_num_info mt-3">
					<nav aria-label="Page navigation example">
					  <ul class="pagination justify-content-center">
<?php if($TPL_VAR["page_info"]["prev_group_last_page"]> 0){?>
					    <li class="page-item">
					      <a class="page-link" href="shop_list.php?shop_type=<?php echo $TPL_VAR["shop_config"]["type"]?>&page=<?php echo $TPL_VAR["page_info"]["prev_group_last_page"]?>&keword=<?php echo urlencode($TPL_VAR["keyword"])?>" aria-label="Previous">
					        <span aria-hidden="true">&laquo;</span>
					        <span class="sr-only">Previous</span>
					      </a>
					    </li>
<?php }else{?>
					    <li class="page-item disabled">
					    	<a class="page-link" href="#"><span aria-hidden="true">&laquo;</span></a>
					    </li>
<?php }?>

<?php if(is_array($TPL_R1=range($TPL_VAR["page_info"]["group_start"],$TPL_VAR["page_info"]["group_end"]))&&!empty($TPL_R1)){foreach($TPL_R1 as $TPL_V1){?>
<?php if($TPL_V1==$TPL_VAR["page_info"]["now_page"]){?>
						    <li class="page-item active"><a class="page-link" href="#"><?php echo $TPL_V1?></a></li>
<?php }else{?>
						    <li class="page-item"><a class="page-link" href="shop_list.php?shop_type=<?php echo $TPL_VAR["shop_info"]["type"]?>&page=<?php echo $TPL_V1?>&keyword=<?php echo urlencode($TPL_VAR["keyword"])?>"><?php echo $TPL_V1?></a></li>
<?php }?>
<?php }}?>

<?php if($TPL_VAR["page_info"]["next_group_first_page"]> 0){?>
					    <li class="page-item">
					      <a class="page-link" href="shop_list.php?shop_type=<?php echo $TPL_VAR["shop_info"]["type"]?>&page=<?php echo $TPL_VAR["page_info"]["next_group_first_page"]?>&keyword=<?php echo urlencode($TPL_VAR["keyword"])?>" aria-label="Next">
					        <span aria-hidden="true">&raquo;</span>
					        <span class="sr-only">Next</span>
					      </a>
					    </li>
<?php }else{?>
					    <li class="page-item disabled">
					    	<a href="#" class="page-link"><span aria-hidden="true">&raquo;</span></a>
					    </li>
<?php }?>
					  </ul>
					</nav>
				</div>
				<!-- 페이지번호끝끝 -->
			</div>
		</div>
	</div>
<?php $this->print_("footer",$TPL_SCP,1);?>

	<script type="text/javascript">
		// get방식의 파라미터 얻기 함수
		$.urlParam = function(name){
			var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
			return results[1] || 0;
		}

		$(document).ready(function() {
			$('#sortby').on('change', function() {
		    	var $form = $(this).closest('form');
			    $form.find('button[type=submit]').click();
		    });
		});
		$(function() {
			var getParam = $.urlParam('sortby'); //-->sortby파라미터를 얻는다
			$('#sortby').val(getParam).find('option[value'+getParam+']').attr('selected', true);
		});
	</script>
</body>
</html>