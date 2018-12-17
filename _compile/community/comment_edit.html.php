<?php /* Template_ 2.2.8 2018/07/27 19:59:56 /Users/sonchowon/portfolio/_template/community/comment_edit.html 000001600 */ ?>
<form action="<?php echo $TPL_VAR["home_url"]?>/community/comment_edit_ok.php" method="post" id="comment_edit_form">
	<input type="hidden" name="com_type" value="<?php echo $TPL_VAR["com_config"]["type"]?>">
	<input type="hidden" name="comment_id" value="<?php echo $TPL_VAR["comment"]["id"]?>">

	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<h4 class="modal-title">덧글 수정</h4>
	</div>

	<div class="modal-body">
		<!-- 로그인중이 아니거나 자신의 글이 아닌 경우 -->
<?php if($TPL_VAR["member_info"]===false||$TPL_VAR["comment"]["member_id"]!=$TPL_VAR["member_info"]["id"]){?>
			<div class="form-group">
				<input type="text" name="writer_name" id="writer_name" class="form-control" placeholder="작성자" value="<?php echo $TPL_VAR["comment"]["writer_name"]?>">
			</div>
			<div class="form-group">
				<input type="password" name="writer_pw" id="writer_pw" class="form-control" placeholder="작성시 설정한 비밀번호">
			</div>
<?php }?>
		<!-- 덧글 내용 -->
		<div class="form-group">
			<textarea name="content" id="content" class="form-control" rows="5"><?php echo $TPL_VAR["comment"]["content"]?></textarea>
		</div>
	</div>
	<div class="modal-footer">
		<button type="button" class="btn btn-default" data-dismiss="modal">취소</button>
		<button type="submit" class="btn btn-danger">수정</button>
	</div>
</form>