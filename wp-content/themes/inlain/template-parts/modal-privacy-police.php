<?php
$post = $this->get_from_array($args, 'post');

$content = apply_filters('the_content', $post->post_content);
?>



<div class="modal privacy-police-modal">
  <div class="editor-content">
    <?= $content; ?>
  </div>
</div>