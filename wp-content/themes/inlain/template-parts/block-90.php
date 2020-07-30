<?php
$title = $this->get_from_array($args, 'title');
$motivations = $this->get_array_from_array($args, 'motivations');
?>

<section class="section section-motivations bg-dark c-white" data-admin>
  <div class="container">
    <?php
    if ($title) {
    ?>
      <h2 class="section-title fw-bold fs-40 lh-2"><?= $title; ?></h2>
    <?php
    }
    if ($motivations) {
    ?>
      <div class="motivations-list">
        <?php
        foreach ($motivations as $i => &$mot) {
          $mot_title = $this->get_from_array($mot, 'title');
          $mot_desc = $this->get_from_array($mot, 'desc');
          $index = $i + 1;
        ?>
          <div class="motivation-col">
            <div class="motivation-item">
              <?php
              if ($mot_title) {
              ?>
                <h3 class="motivation-title fw-bold fs-25"><?= $index . '.&nbsp;&nbsp;' . $mot_title; ?></h3>
              <?php
              }
              if ($mot_desc) {
              ?>
                <div class="motivation-desc c-light">
                  <?= $mot_desc; ?>
                </div>
              <?php
              }
              ?>
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