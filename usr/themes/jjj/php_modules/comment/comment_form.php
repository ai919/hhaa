<?php $this->comments()->to($comments);?>
<div id="<?php $this->respondId();?>" class="comment-form-wrap">
  <form class="comment-form" method="post" action="<?php $this->commentUrl()?>" id="comment-form" role="form">
    <div class="comment-form-body">
      <div class="comment-form-avatar">
        <?php if ($this->user->hasLogin()): ?>
          <?php $this->author->gravatar();?>
        <?php else: ?>
          <?php $email = $this->remember('mail', true);if (!empty($email)): ?>
            <img src="https://cravatar.cn/avatar/<?php echo md5($email); ?>">
          <?php else: ?>
            <img src="<?php $this->options->themeUrl('/static/images/comment/default_avatar.svg');?>">
          <?php endif;?>
        <?php endif;?>
      </div>
      <div class="comment-form-content">
        <?php if (!$this->user->hasLogin()): ?>
        <div class="comment-form-input-group">
            <input class="comment-form-input" type="text" name="author" placeholder="Name" value="<?php $this->remember('author');?>" required pattern="\S+.*"/>
          <input class="comment-form-input" type="email" name="mail" placeholder="Email" value="<?php $this->remember('mail');?>"<?php if ($this->options->commentsRequireMail): ?> required<?php endif;?> />
            <input class="comment-form-input" type="url" name="url" placeholder="<?php _e('http://');?>" value="<?php $this->remember('url');?>"<?php if ($this->options->commentsRequireURL): ?> required pattern="\S+.*"<?php endif;?> />
        </div>
        <?php endif;?>
        <div class="comment-form-combination">
          <div class="comment-form-textarea-wrap">
              <textarea id="textarea" class="comment-form-textarea" name="text" placeholder="Please provide a valid email for contact and leave meaningful feedback." required><?php $this->remember('text');?></textarea>
          </div>
          <div class="comment-form-footer">
            <div class="comment-form-tool">
              <?php $this->need("/php_modules/comment/emoji.php");?>
            </div>
            <div class="comment-form-btn-wrap">
                <?php $comments->cancelReply('<button class="comment-form-btn comment-form-cancel">Cancel</button>');?>
                <button class="comment-form-btn comment-form-submit" type="submit">Submit</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </form>
</div>