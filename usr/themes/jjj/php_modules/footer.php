<footer class="footer">
  <div class="footer-content">
    <div class="footer-item">
      <?php
$aboutLink = getHidePage($this, 'about');
$linksLink = getHidePage($this, 'links');
?>
      <?php if (!empty($aboutLink["href"])): ?>
        <a href="<?php echo $aboutLink["href"]; ?>" target="_self" title="<?php echo $aboutLink["title"]; ?>"><?php echo $aboutLink["title"]; ?></a>
      <?php endif;?>
      <?php if (!empty($linksLink["href"])): ?>
        <a href="<?php echo $linksLink["href"]; ?>" target="_self" title="<?php echo $linksLink["title"]; ?>"><?php echo $linksLink["title"]; ?></a>
      <?php endif;?>
      <a href="<?php $this->options->siteUrl();?>sitemap" target="_blank" title="Sitemap">Sitemap</a>
    </div>
    <div class="footer-item">
      Copyright: <?php $this->options->title();?>
    </div>
    <div class="footer-item">
      Address: <?php $this->options->address();?>
    </div>
    <div class="footer-item">
      <span>Email:</span><a href="mailto:<?php $this->author->mail();?>" target="_self"><?php $this->author->mail();?></a>
    </div>
    <div class="footer-item">
      <a href="<?php $this->options->siteUrl();?>" target="_self" title="<?php $this->options->title();?>">&copy;<?php echo date('Y'); ?> <?php $this->options->title();?></a>
    </div>
    <?php $this->options->filing();?>
    <div class="footer-item">
      Blog By <a href="http://typecho.org" target="_blank" title="Typecho">Typecho</a>
    </div>
  </div>
</footer>