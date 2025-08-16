<?php $list = getHomeRecommendedArticleList();?>
<?php if (!empty($list)): ?>
  <div class="recommended-article">
    <div class="recommended-article-content">
      <?php foreach ($list as $item): ?>
        <a class="recommended-article-item-link" href="<?php echo $item['permalink']; ?>" itemprop="url" target="_blank" title="<?php echo $item['title']; ?>">
          <div class="recommended-article-item">
            <?php if (!empty($item['thumb'])): ?>
              <div class="recommended-article-item-img" data-src="<?php echo $item['thumb']; ?>" aria-hidden="true"></div>
            <?php else: ?>
              <div class="recommended-article-item-img" aria-hidden="true"></div>
            <?php endif;?>
            <span class="recommended-article-item-tag">
              <?php $this->options->homeRecommendedArticleTag();?>
            </span>
          </div>
        </a>
      <?php endforeach;?>
    </div>
  </div>
<?php endif;?>