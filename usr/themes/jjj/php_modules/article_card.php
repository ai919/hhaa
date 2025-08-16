<?php $isArticleInfinite = $this->options->paginationType === 'infinite';?>
<?php $ArticleTarget = "_self";if ($isArticleInfinite) {$ArticleTarget = "_blank";}?>
<div class="article-card-wrap hidden">
  <?php while ($this->next()): ?>
  <article class="article-card" data-link="<?php $this->permalink();?>" itemscope itemtype="http://schema.org/BlogPosting">
    <a class="article-card-hidden-a" href="<?php $this->permalink();?>" itemprop="url"><?php $this->title();?></a>
    <div class="article-card-body">
      <div class="article-card-main">
        <h2 class="article-card-title" itemprop="name headline"><?php $this->sticky();?><?php $this->title();?></h2>
        <p class="article-card-desc" itemprop="articleBody"><?php $this->excerpt(300);?></p>
      </div>
      <?php $thumbnail = articleThumbnail($this);?>
      <?php if ($thumbnail !== ''): ?>
      <div class="article-card-thumb">
        <div class="article-card-thumb-img" data-src="<?php echo $thumbnail; ?>" aria-hidden="true"></div>
      </div>
      <?php endif;?>
    </div>
  </article>
  <?php endwhile;?>
</div>
