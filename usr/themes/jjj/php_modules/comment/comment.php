<div class="comment immersion-hide" id="comments">
  <div class="comment-content">
    <h3 class="comment-title">Comments</h3>
    <?php //开启评论?>
    <?php if ($this->allow('comment')): ?>
      <?php $this->need("/php_modules/comment/comment_form.php");?>
      <?php $this->need("/php_modules/comment/comment_list.php");?>
    <?php else: ?>
      <div class="comment-off">-- Comments are closed --</div>
    <?php endif;?>
  </div>
</div>