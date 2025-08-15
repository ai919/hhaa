<div class="latest-posts" role="complementary">
  <div class="latest-posts-content">
    <div class="latest-posts-head">
      <h3 class="latest-posts-title">Latest Posts</h3>
    </div>
    <div class="latest-posts-body">
      <?php $this->widget('Widget_Contents_Post_Recent', 'pageSize=30')->to($posts);?>
      <?php if ($posts->have()): ?>
        <?php while ($posts->next()): ?>
          <a class="latest-posts-item" href="<?php $posts->permalink();?>" target="_self" title="<?php $posts->title();?>">
            <div class="latest-posts-item-title"><?php $posts->title();?></div>
          </a>
        <?php endwhile;?>
      <?php else: ?>
        <div class="latest-posts-empty">No posts yet</div>
      <?php endif;?>
    </div>
  </div>
</div>
