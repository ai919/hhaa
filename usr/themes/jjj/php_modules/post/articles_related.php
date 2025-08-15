<div class="articles-related immersion-hide">
  <div class="articles-related-content">
    <div class="articles-related-head">
      <h3 class="articles-related-title">Related Articles</h3>
    </div>
    <div class="articles-related-body">
      <?php $this->related(10, null)->to($relatedPosts);?>
      <?php if ($relatedPosts->have()): ?>
        <div class="articles-related-list">
        <?php while ($relatedPosts->next()): ?>
          <div class="articles-related-list-item" data-link="<?php $relatedPosts->permalink()?>" itemscope itemtype="http://schema.org/BlogPosting">
            <a class="articles-related-list-hidden-a" href="<?php $relatedPosts->permalink();?>" itemprop="url"><?php $relatedPosts->title()?></a>
            <div class="articles-related-list-item-body">
              <h4 class="articles-related-list-item-title" itemprop="name headline"><?php $relatedPosts->title()?></h4>
            </div>
          </div>
        <?php endwhile;?>
        </div>
      <?php else: ?>
        <div class="articles-related-empty">No related articles</div>
      <?php endif;?>
    </div>
  </div>
</div>