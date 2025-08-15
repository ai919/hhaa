<?php $paginationType = $this->options->paginationType;?>
<?php if ($paginationType === 'infinite'): ?>
  <div class="article-pagination hidden">
    <div class="article-pagination-content">
      <?php $this->pageLink('Previous', 'prev');?>
      <?php $this->pageLink('Next', 'next');?>
      <img class="article-pagination-loading" src="<?php $this->options->themeUrl('/static/images/article-loading.gif');?>" alt="Loading">
      <span class="article-pagination-no-more">No more</span>
    </div>
  </div>
<?php elseif ($paginationType === 'button'): ?>
  <?php
ob_start();
$this->pageNav('Previous', 'Next', 1, '...', array('wrapTag' => 'ul', 'wrapClass' => 'pagination-button hidden', 'itemTag' => 'li', 'textTag' => 'span', 'currentClass' => 'active', 'prevClass' => 'prev', 'nextClass' => 'next'));
$content = ob_get_contents();
ob_end_clean();

if (empty($content)) {
    echo '<div class="pagination-button-no-more hidden">No more</div>';
} else {
    $content = preg_replace("/<li><span>(.*?)<\/span><\/li>/sm", '', $content);
    echo $content;
}

?>

<?php endif;?>