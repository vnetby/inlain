<?php
$title = $this->get_from_array($args, 'title');
$subtitle = $this->get_from_array($args, 'subtitle');
$clients = $this->get_from_array($args, 'clients');
?>


<section class="section section-clients">
  <div class="container">
    <?php
    if ($title) {
    ?>
      <h2 class="section-title fw-bold fs-40 lh-2"><?= $title; ?></h2>
    <?php
    }
    if ($subtitle) {
    ?>
      <h3 class="subtitle fw-normal fs-20"><?= $subtitle; ?></h3>
    <?php
    }
    if ($clients) {
    ?>
      <div class="clients-list">
        <?php
        foreach ($clients as $client) {
          $img = wp_get_attachment_image_url($client, 'large');
        ?>
          <div class="client-col">
            <div class="client-item">
              <img src="<?= $img; ?>" alt="client logo">
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