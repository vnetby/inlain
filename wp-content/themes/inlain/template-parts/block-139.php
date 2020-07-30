<?php
$title = $this->get_from_array($args, 'title');
$questions = $this->get_array_from_array($args, 'questions');
?>


<section class="section section-faq">
  <div class="container">
    <?php
    if ($title) {
    ?>
      <h2 class="section-title fw-bold fs-40 lh-2"><?= $title; ?></h2>
    <?php
    }
    if ($questions) {
    ?>
      <div class="js-accordion faq-items">
        <?php
        foreach ($questions as $i => &$quest) {
          $question = $this->get_from_array($quest, 'question');
          $answ = $this->get_from_array($quest, 'answer');
        ?>
          <div class="accordion-item<?= $i === 0 ? ' active' : ''; ?>">
            <div class="accordion-head">
              <?php
              if ($question) {
              ?>
                <h3 class="quest-title fs-25 fw-bold"><?= $question; ?></h3>
              <?php
              }
              ?>
              <span class="accordion-ico"></span>
            </div>
            <div class="accordion-body">
              <?php
              if ($answ) {
              ?>
                <div class="editor-content content"><?= $answ; ?></div>
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