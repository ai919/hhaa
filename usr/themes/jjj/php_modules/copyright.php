<div class="copyright">
  <div class="copyright-content">
    <div class="copyright-title">Copyright Notice</div>
    <?php $customCopyright = $this->options->customCopyright;?>
    <?php if (empty($customCopyright)): ?>
      <p class="copyright-desc">This article was originally published by <a href="<?php $this->author->permalink();?>">@<?php $this->author();?></a> on <?php $this->options->title();?>. Reproduction is prohibited without permission.</p>
    <?php else: ?>
      <p class="copyright-desc"><?php echo $customCopyright; ?></p>
    <?php endif;?>
  </div>
</div>