<header id="header" class="header">
  <div class="header-container" style="max-width:1140px;margin:0 auto;width:100%;">
    <div class="header-content">
      <div class="header-left">
        <nav class="header-nav">
          <div class="header-nav-mobile-menu-wrap">
              <div class="header-nav-mobile-menu" style="font-size:24px;font-weight:bold;">
                <?php $this->options->title();?>
                <i class="jj-icon jj-icon-down header-nav-mobile-menu-icon"></i>
            </div>
          </div>
          <ul class="header-nav-list">
            <li>
              <a class="header-nav-list-item <?php if ($this->is('index')) {echo 'active';}
  ;?>"  target="_self" href="<?php $this->options->siteUrl();?>" title="<?php $this->options->title();?>" style="font-size:24px;font-weight:bold;"><?php $this->options->title();?></a>
            </li>
            <?php $this->widget('Widget_Contents_Page_List')->to($pages);?>
            <?php while ($pages->next()): ?>
            <li>
              <a class="header-nav-list-item <?php if ($this->is('page', $pages->slug)) {echo 'active';}
;?>" target="_self" href="<?php $pages->permalink();?>" title="<?php $pages->title();?>"><?php $pages->title();?></a>
            </li>
            <?php endwhile;?>
          </ul>
        </nav>
      </div>
      <div class="header-right">
        <div class="header-search-icon-wrap">
            <div class="header-search-icon" title="Search">
            <i class="jj-icon jj-icon-sousuo"></i>
          </div>
        </div>
        <div class="header-search-wrap">
            <form class="header-search-form" method="post" action="<?php $this->options->siteUrl();?>" role="search">
              <input id="header-search-input" class="header-search-input" type="text" id="s" name="s" maxlength="40" placeholder="<?php _e('Enter keywords to search');?>" autocomplete="off">
            <label for="header-search-input" class="header-search-btn" tabindex="0">
              <i class="jj-icon jj-icon-sousuo"></i>
            </label>
            <div class="search-history">
              <div class="search-history-head">
                <span class="search-history-head-title">Search History</span>
                <span class="search-history-clear-btn">Clear</span>
              </div>
              <div class="search-history-list">
              </div>
            </div>
          </form>
      </div>
    </div>
  </div>
</header>
<div class="mobile-search">
  <div class="mobile-search-mask"></div>
  <div class="mobile-search-content">
    <div class="mobile-search-close">
      <i class="jj-icon jj-icon-guanbi mobile-search-close-icon"></i>
    </div>
    <div class="mobile-search-body"></div>
  </div>
</div>