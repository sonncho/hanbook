<?php /* Template_ 2.2.8 2018/07/27 20:00:02 /Users/sonchowon/portfolio/_template/community/comment_delete.html 000001263 */ ?>
<form action="<?php echo $TPL_VAR["home_url"]?>/community/comment_delete_ok.php" method="post" id="comment_delete_form">
	<input type="hidden" name= "com_type" value="<?php echo $TPL_VAR["com_config"]["type"]?>">
	<input type="hidden" name= "comment_id" value="<?php echo $TPL_VAR["comment_id"]?>">

	<!-- 모달창 제목영역 -->
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<h4 class="modal-title">덧글 삭제</h4>
	</div>
	<!-- 모달창 본문영역 -->
	<div class="modal-body">
<?php if($TPL_VAR["is_mine"]==true){?>
		<p>정말 이 덧글을 삭제하시겠습니까?</p>
<?php }else{?>
		<p>삭제하시려면 비밀번호를 입력하세요.</p>
		<div class="form-group">
			<input type="password" name="writer_pw" id="writer_pw" class="form-control">
		</div>
<?php }?>
	</div>
	<!-- 모달창 하단버튼영역 -->
	<div class="modal-footer">
		<button type="button" class="btn btn-default" data-dismiss="modal">취소</button>
		<button type="submit" class="btn btn-danger">삭제</button>
	</div>
</form>