<?php /* Template_ 2.2.8 2018/03/11 21:29:03 /Users/sonchowon/portfolio/_template/community/notice_list.html 000004964 */ ?>
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
					<h1><span>NOTICE</span></h1>
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
					<form action="all_search.php" method="get">
						<div class="all_search_box clearfix">
							<input type="text" name="all_keyword" placeholder="Search Here">
							<button type="submit" style="color: #adadad;"><i class="icon ion-search"></i></button>
						</div>
					</form>
				</div>
			</div>
			<div class="category_section">
				<p class="commu_col1_title"><span>COMMUNITY</span></p>
				<ul>
					<li><a href="<?php echo $TPL_VAR["home_url"]?>/community/list.php?commu_type=notice">NOTICE</a></li>
					<li><a href="<?php echo $TPL_VAR["home_url"]?>/community/qna_list.php?">Q &amp; A</a></li>
					<li><a href="<?php echo $TPL_VAR["home_url"]?>/community/list.php?commu_type=review">REVIEW</a></li>
				</ul>
			</div>
		</div>

		<div class="column2">
			<!-- 타이틀시작 -->
			<div class="title_wrap">
				<div class="title_box">
					<div class="title_here">
						<span style="font-size: 13px; font-weight: bolder;">NOTICE</span>
					</div>
				</div>
			</div>
			<!-- 타이틀 끝 -->
			<!-- 부분 검색어시작 -->
			<div class="commu_search_section clearfix">
				<div class="float-right">
					<form action="list.php" method="get">
						<div class="search_form">
							<input type="hidden" name="commu_type" value="notice">
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
						<tr>
							<td class="tb_cate">공지사항</td>
							<td class="tb_title">
								<div class="cut_strings">
									<nobr><a href="#">HANBOOK Open EVEefdfgsdsggs</a></nobr></div>
							</td>
							<td class="tb_writer">HANBOOK</td>
							<td class="tb_date">2018-12-24</td>
							<td class="tb_hit">999</td>
						</tr>
						<tr>
							<td class="tb_cate">공지사항</td>
							<td class="tb_title">
								<div class="cut_strings">
									<nobr><a href="#">HANBOOK Open EVEefdfgsdsggs</a></nobr></div>
							</td>
							<td class="tb_writer">HANBOOK</td>
							<td class="tb_date">2018-01-24</td>
							<td class="tb_hit">999</td>
						</tr>
						<tr>
							<td class="tb_cate">공지사항</td>
							<td class="tb_title">
								<div class="cut_strings">
									<nobr><a href="#">HANBOOK Open EVEefdfgsdsggs</a></nobr></div>
							</td>
							<td class="tb_writer">HANBOOK</td>
							<td class="tb_date">2018-01-24</td>
							<td class="tb_hit">999</td>
						</tr>
					</tbody>
				</table>
			</div>
			<!-- 테이블끝 -->
			<!-- 페이지번호시작 -->
			<div class="page_num_info">
				<nav aria-label="Page navigation example">
				  <ul class="pagination justify-content-center">
				    <li class="page-item">
				      <a class="page-link" href="#" aria-label="Previous">
				        <span aria-hidden="true">&laquo;</span>
				        <span class="sr-only">Previous</span>
				      </a>
				    </li>
				    <li class="page-item"><a class="page-link" href="#">1</a></li>
				    <li class="page-item"><a class="page-link" href="#">2</a></li>
				    <li class="page-item"><a class="page-link" href="#">3</a></li>
				    <li class="page-item">
				      <a class="page-link" href="#" aria-label="Next">
				        <span aria-hidden="true">&raquo;</span>
				        <span class="sr-only">Next</span>
				      </a>
				    </li>
				  </ul>
				</nav>
			</div>
			<!-- 페이지번호끝 -->
		</div>
	</div>
<?php $this->print_("footer",$TPL_SCP,1);?>

</body>
</html>