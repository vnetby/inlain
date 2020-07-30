<?php
$title = $this->get_from_array($args, 'title');
$steps = $this->get_array_from_array($args, 'steps');
?>


<section class="section section-steps bg-primary c-white" data-admin>
  <div class="container">
    <?php
    if ($title) {
    ?>
      <h2 class="section-title fw-bold fs-40"><?= $title; ?></h2>
    <?php
    }
    if ($steps) {
    ?>
      <div class="steps-list">
        <?php
        foreach ($steps as $i => &$step) {
          $desc = $this->get_from_array($step, 'desc');
        ?>
          <div class="step-col">
            <div class="step-item">
              <span class="step-num fw-bold fs-25"><?= $i + 1; ?></span>
              <div class="desc">
                <?= $desc; ?>
              </div>
            </div>
          </div>
        <?php
        }
        ?>
      </div>
    <?php
    }
    ?>
    <div class="btn-row">
      <a href="#modalOrderTest" class="btn btn-border-fff" data-fancybox data-touch="false">
        <span class="text"><?= __('Заказать тестирование', 'inlain'); ?></span>
      </a>
    </div>
  </div>
</section>