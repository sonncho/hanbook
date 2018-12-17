<?php /* Template_ 2.2.8 2018/12/11 03:32:07 /Users/sonchowon/portfolio/_template/community/com_list.html 000008122 */ 
$TPL_my_like_1=empty($TPL_VAR["my_like"])||!is_array($TPL_VAR["my_like"])?0:count($TPL_VAR["my_like"]);
$TPL_document_list_1=empty($TPL_VAR["document_list"])||!is_array($TPL_VAR["document_list"])?0:count($TPL_VAR["document_list"]);?>
<!DOCTYPE html>
<html>
<head>
<?php $this->print_("head",$TPL_SCP,1);?>

	<link rel="stylesheet" href="<?php echo $TPL_VAR["assets_url"]?>/css/list.css">
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
			<!-- 최근본 상품 -->
			<div class="cookie_section">
				<p class="commu_col1_title"><span>내 관심상품</span></p>
				<ul class="row">
<?php if($TPL_VAR["my_like"]!=false){?>
<?php if($TPL_my_like_1){foreach($TPL_VAR["my_like"] as $TPL_V1){?>
					<li class="like_li"><a href="<?php echo $TPL_VAR["home_url"]?>/shop/shop_read.php?shop_type=<?php echo $TPL_V1["shop_type"]?>&shop_document_id=<?php echo $TPL_V1["shop_document_id"]?>"><img class="my_like_img" src="<?php echo $TPL_V1["thumbnail"]?>" alt=""></a></li>
<?php }}?>
<?php }else{?>
					<p class="no_like">관심상품이 존재하지 않습니다.<br>
					(로그인후 이용가능)</p>
<?php }?>
					
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
			<!-- 부분 검색어시작 -->
			<div class="commu_search_section clearfix">
				<div class="float-right">
					<form action="com_list.php" method="get">
						<div class="search_form">
							<input type="hidden" name="com_type" value="<?php echo $TPL_VAR["com_config"]["type"]?>">
							<input type="text" name="keyword" placeholder="검색어" value="<?php echo $TPL_VAR["keyword"]?>">
							<span>
								<button type="submit">검색</button>
							</span>
						</div>
					</form>
				</div>
			</div>
			<!-- 검색어끝 -->
			<!-- 테이블시작 -->
<?php if($TPL_VAR["com_config"]["type"]=='notice'){?>
			<div class="list_table">
				<table class="table">
					<thead class="text-center">
						<tr>
							<td class="th_cate">분류</td>
							<td class="th_title">제목</td>
							<td class="th_writer">작성자</td>
							<td class="th_date">작성일</td>
							<td class="th_hit">조회</td>
						</tr>
					</thead>
					<tbody style="background-color: #f4f4f4;">
<?php if($TPL_VAR["document_list"]!=FALSE){?>
<?php if($TPL_document_list_1){foreach($TPL_VAR["document_list"] as $TPL_V1){?>
						<tr>
							<td class="tb_cate">공지사항</td>
							<td class="tb_title">
								<div class="cut_strings">
									<nobr><a href="read.php?com_type=<?php echo $TPL_VAR["com_config"]["type"]?>&document_id=<?php echo $TPL_V1["id"]?>"><?php echo htmlspecialchars($TPL_V1["subject"])?></a></nobr></div>
							</td>
							<td class="tb_writer"><?php echo htmlspecialchars($TPL_V1["writer_name"])?></td>
							<td class="tb_date"><?php echo substr($TPL_V1["reg_date"], 0, 10)?></td>
							<td class="tb_hit"><?php echo $TPL_V1["hit"]?></td>
						</tr>
<?php }}?>
<?php }else{?>
						<tr>
							<td colspan="5" class="text-center" style="line-height: 100px;">조회된 글이 없습니다.</td>
						</tr>
<?php }?>
					</tbody>
				</table>
			</div>
<?php }else{?>
			<div class="list_table">
				<table class="table qna_list">
					<thead class="text-center">
						<tr>
							<td class="th_cate">번호</td>
							<td class="th_title">제목</td>
							<td class="th_writer">작성자</td>
							<td class="th_date">작성일</td>
							<td class="th_hit">조회</td>
						</tr>
					</thead>
					<tbody>
<?php if($TPL_VAR["document_list"]!=FALSE){?>
<?php if($TPL_document_list_1){foreach($TPL_VAR["document_list"] as $TPL_V1){?>
						<tr>
							<td class="tb_cate"><?php echo $TPL_V1["id"]?></td>
							<td class="tb_title">
								<div class="cut_strings">
									<nobr><a href="read.php?com_type=<?php echo $TPL_VAR["com_config"]["type"]?>&document_id=<?php echo $TPL_V1["id"]?>"><?php echo htmlspecialchars($TPL_V1["subject"])?></a></nobr></div>
							</td>
							<td class="tb_writer">
								<?php echo htmlspecialchars($TPL_V1["writer_name"])?>

							</td>
							<td class="tb_date"><?php echo substr($TPL_V1["reg_date"], 0, 10)?></td>
							<td class="tb_hit"><?php echo $TPL_V1["hit"]?></td>
						</tr>
<?php }}?>
<?php }else{?>
						<tr>
							<td colspan="5" class="text-center" style="line-height: 100px;">조회된 글이 없습니다.</td>
						</tr>
<?php }?>
					</tbody>
				</table>
			</div>
<?php }?>
			<!-- 테이블끝 -->
			<!-- 페이지번호시작 -->
			<div class="page_num_info">
				<nav aria-label="Page navigation example">
				  <ul class="pagination justify-content-center">
<?php if($TPL_VAR["page_info"]["prev_group_last_page"]> 0){?>
				    <li class="page-item">
				      <a class="page-link" href="com_list.php?com_type=<?php echo $TPL_VAR["com_config"]["type"]?>&page=<?php echo $TPL_VAR["page_info"]["prev_group_last_page"]?>&keword=<?php echo urlencode($TPL_VAR["keyword"])?>" aria-label="Previous">
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
					    <li class="page-item"><a class="page-link" href="com_list.php?com_type=<?php echo $TPL_VAR["com_config"]["type"]?>&page=<?php echo $TPL_V1?>&keyword=<?php echo urlencode($TPL_VAR["keyword"])?>"><?php echo $TPL_V1?></a></li>
<?php }?>
<?php }}?>

<?php if($TPL_VAR["page_info"]["next_group_first_page"]> 0){?>
				    <li class="page-item">
				      <a class="page-link" href="com_list.php?com_type=<?php echo $TPL_VAR["com_config"]["type"]?>&page=<?php echo $TPL_VAR["page_info"]["next_group_first_page"]?>&keyword=<?php echo urlencode($TPL_VAR["keyword"])?>" aria-label="Next">
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
			<!-- 페이지번호끝 -->
			<div class="write_btn float-right">
				<a href="<?php echo $TPL_VAR["home_url"]?>/community/write.php?com_type=<?php echo $TPL_VAR["com_config"]["type"]?>">글쓰기</a>
			</div>
		</div>
	</div>
<?php $this->print_("footer",$TPL_SCP,1);?>

</body>
</html>