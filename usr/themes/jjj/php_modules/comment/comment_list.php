<?php $this->comments()->to($comments);?>
<?php if ($comments->have()): ?>
  <div class="comment-list-wrapper">
    <h3 class="comments-list-title"><?php $this->commentsNum('No comments yet', '1 Comment', '%d Comments');?></h3>
    <?php $this->need('/php_modules/comment/list-template.php');?>
    <?php $comments->listComments();?>
  </div>
  <div class="comment-pagination">
    <?php $comments->pageNav('&lt;', '&gt;');?>
  </div>
<?php else: ?>
  <div class="comment-list-empty">
    <img class="comment-list-empty-img" src="https://example.com/assets/comment/comment_list_empty.png" alt="No comment data">
    <p class="comment-list-empty-text">No comment data</p>
  </div>
<?php endif;?>
