<?php
global $front;

$title = $this->get_from_array($args, 'title');
$solutions = $this->get_array_from_array($args, 'solutions');
?>
<section class="section section-solutions" id="solutions" data-admin>
  <div class="container">
    <?php
    if ($title) {
    ?>
      <h2 class="section-title fs-40 lh-2 fw-bold"><?= $title; ?></h2>
    <?php
    }
    if ($solutions) {
    ?>
      <div class="solutions-list">
        <?php
        foreach ($solutions as &$sol) {
          $sol_title = $this->get_from_array($sol, 'title');
          $desc = $this->get_from_array($sol, 'desc');
        ?>
          <div class="solution-col">
            <div class="solution-item">
              <?php
              if ($sol_title) {
              ?>
                <h3 class="sol-title fw-bold fs-25 c-primary"><?= $sol_title; ?></h3>
              <?php
              }
              if ($desc) {
              ?>
                <div class="sol-desc"><?= $desc; ?></div>
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
    <div class="btn-row">
      <?php
      echo $front->the_modal_btn(['order_test', 'order_consult']);
      ?>
    </div>
  </div>
</section>