<?php
global $front;
$title = $this->get_from_array($args, 'title');
$content = $this->get_from_array($args, 'content');
$id = $this->get_from_array($args, 'id');
?>


<section class="section section-editor-with-btns bg-grey" <?= $id ? 'id="' . $id . '"' : ''; ?> data-admin>
  <div class="container">
    <?php
    if ($title) {
    ?>
      <h2 class="section-title fs-40 lh-2 fw-bold"><?= $title; ?></h2>
    <?php
    }
    if ($content) {
    ?>
      <div class="content editor-content">
        <?= $content; ?>
      </div>
    <?php
    }
    ?>
    <div class="btn-row">
      <?php
      echo $front->the_modal_btn(['order_test', 'order_consult']);
      ?>
    </div>
  </div>
</section>