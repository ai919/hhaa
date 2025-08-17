<?php $articleDetailRecommended = getArticleDetailRecommended();?>
<?php if (!empty($articleDetailRecommended)): ?>
  <div class="article-detail-recommended immersion-hide">
    <div class="article-detail-recommended-content">
        <a class="article-detail-recommended-link" href="<?php echo $articleDetailRecommended['permalink']; ?>" itemprop="url" target="_blank" title="<?php echo $articleDetailRecommended['title']; ?>">
          <div class="article-detail-recommended-item">
          <?php if (!empty($articleDetailRecommended['thumb'])): ?>
            <img class="article-detail-recommended-item-img" src="https://example.com/assets/home_recommended_article_loading.gif" data-src="<?php echo $articleDetailRecommended['thumb']; ?>" data-error="https://example.com/assets/loading_error.gif" alt="<?php echo $articleDetailRecommended['title']; ?>">
          <?php else: ?>
            <img class="article-detail-recommended-item-img" src="https://example.com/assets/home_recommended_article_loading.gif" data-src="https://example.com/assets/home_recommended_article_empty.jpg" alt="<?php echo $articleDetailRecommended['title']; ?>">
          <?php endif;?>
            <span class="article-detail-recommended-item-tag">
              <?php $this->options->articleRecommendedArticleTag();?>
            </span>
          </div>
        </a>
    </div>
  </div>
<?php endif;?>