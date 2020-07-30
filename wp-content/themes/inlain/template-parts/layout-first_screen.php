<?php

global $front;

$title = $this->get_from_array($args, 'title');
$title = $front->wrap_br_in_span($title);

$subtitle = $this->get_from_array($args, 'subtitle');
$points = $this->get_array_from_array($args, 'points');
?>



<section class="section section-main-screen bg-grey" data-admin>
  <div class="container">
    <?php
    if ($title) {
    ?>
      <h1 class="page-title fw-bold fs-50 lh-2 animate-up js-clss-on-view"><?= $title; ?></h1>
    <?php
    }
    if ($subtitle) {
    ?>
      <h2 class="page-subtitle fw-normal fs-20"><?= $subtitle; ?></h2>
    <?php
    }
    if ($points) {
    ?>
      <div class="points-row ta-center">
        <?php
        foreach ($points as &$point) {
          $label = $this->get_from_array($point, 'label');
          $desc = $this->get_from_array($point, 'desc');
        ?>
          <div class="point-col">
            <div class="hidden-el">
              <h3 class="title fs-20 fw-normal"><?= $label; ?></h3>
              <div class="hidden-desc"><?= $desc; ?></div>
            </div>
          </div>
        <?php
        }
        ?>
      </div>
    <?php
    }
    ?>
  </div>
</section>