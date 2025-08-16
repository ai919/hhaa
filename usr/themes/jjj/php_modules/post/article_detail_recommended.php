<?php $articleDetailRecommended = getArticleDetailRecommended();?>
<?php if (!empty($articleDetailRecommended)): ?>
  <div class="article-detail-recommended immersion-hide">
    <div class="article-detail-recommended-content">
        <a class="article-detail-recommended-link" href="<?php echo $articleDetailRecommended['permalink']; ?>" itemprop="url" target="_blank" title="<?php echo $articleDetailRecommended['title']; ?>">
          <div class="article-detail-recommended-item">
          <?php if (!empty($articleDetailRecommended['thumb'])): ?>
            <div class="article-detail-recommended-item-img" data-src="<?php echo $articleDetailRecommended['thumb']; ?>" aria-hidden="true"></div>
          <?php else: ?>
            <div class="article-detail-recommended-item-img" aria-hidden="true"></div>
          <?php endif;?>
            <span class="article-detail-recommended-item-tag">
              <?php $this->options->articleRecommendedArticleTag();?>
            </span>
          </div>
        </a>
    </div>
  </div>
<?php endif;?>