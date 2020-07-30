<?php
$title = $this->get_from_array($args, 'title');
$content = $this->get_from_array($args, 'content');
?>


<section class="section section-editor-with-btns bg-grey">
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
      <a href="#modalOrderTest" data-fancybox data-touch="false" class="btn btn-primary">
        <span class="text">Заказать тестирование</span>
      </a>
      <a href="#modalOrderConsult" data-fancybox data-touch="false" class="btn btn-border">
        <span class="text">Заказать консультацию</span>
      </a>
    </div>
  </div>
</section>