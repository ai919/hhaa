<?php if ( ! defined('__TYPECHO_ROOT_DIR__')) {
    exit;
}
?>
<!DOCTYPE html>
<html lang="en-US">
  <?php $this->need('./php_modules/notes.php');?>
<head>
  <?php $this->need('./php_modules/default_head.php');?>
  <?php if ($this->options->errorType === 'chrome'): ?>
    <link href="<?php $this->options->themeUrl('/static/game/fonts.css');?>" rel="stylesheet" type="text/css">
    <link href="<?php $this->options->themeUrl('/static/game/game.css');?>" rel="stylesheet" type="text/css">
    <script src="<?php $this->options->themeUrl('/static/game/game.js');?>"></script>
  <?php endif;?>
  <?php $this->need('./dist/head/404.php');?>
  <?php //head标签底部插入代码 ?>
  <?php $this->options->headInsertCode();?>
</head>
<body class="<?php if ($this->options->errorType !== 'chrome') {echo 'juejin-error';}?>">
  <?php $this->need('./php_modules/header.php');?>
  <?php $this->need('./php_modules/nav.php');?>
  <main class="main" role="main">
    <div class="container">
      <div class="error-content">
        <?php if ($this->options->errorType === 'chrome'): ?>
          <div class="error-card">
            <div class="error-card-head">
              <div class="error-card-logo-wrap">
                <div class="error-card-logo-text"><?php $this->options->title();?></div>
              </div>
            </div>
            <div class="error-card-body">
              <div class="error-title">
                <strong>404.</strong> An error occurred.
              </div>
              <div class="error-desc">Maybe try another method (spacebar or touch)</div>
            </div>
          </div>
        <?php else: ?>
          <div class="juejin-error-card">
            <div class="juejin-error-card-head">
              <div class="juejin-error-card-img">404</div>
            </div>
            <div class="juejin-error-card-footer">
              <a class="juejin-error-card-btn" href="<?php $this->options->siteUrl();?>" target="_self">Return Home</a>
            </div>
          </div>
        <?php endif;?>
      </div>
    </div>
  </main>
  <?php if ($this->options->errorType === 'chrome'): ?>
    <div id="t" class="offline">
      <?php $this->need('./php_modules/404/game.php');?>
    </div>
  <?php endif;?>
  <?php $this->need('./php_modules/fixed_tool.php');?>
  <?php //body标签底部插入代码 ?>
  <?php $this->options->bodyInsertCode();?>
  <?php //typecho 插件挂接点 ?>
  <?php $this->footer();?>
</body>
</html>
