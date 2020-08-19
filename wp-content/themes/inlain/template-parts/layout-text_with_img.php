<?php
$title = $this->get_from_array($args, 'title');
$desc = $this->get_from_array($args, 'desc');
$img = $this->get_from_array($args, 'img');
if ($img) $img = wp_get_attachment_image_url($img, 'large');
$capiton = $this->get_from_array($args, 'caption');

$id = $this->get_from_array($args, 'id');
?>


<section class="section section-targets" <?= $id ? 'id="' . $id . '"' : ''; ?> data-admin>
  <div class="container">
    <?php
    if ($title) {
    ?>
      <h2 class="section-title fw-bold fs-40 lh-2"><?= $title; ?></h2>
    <?php
    }
    if ($desc) {
    ?>
      <div class="desc editor-content"><?= $desc; ?></div>
    <?php
    }
    if ($img) {
    ?>
      <div class="img-wrap">
        <img src="<?= $img; ?>" alt="targets image">
        <?php
        if ($capiton) {
        ?>
          <div class="img-caption fs-15 c-grey"><?= $capiton; ?></div>
        <?php
        }
        ?>
      </div>
    <?php
    }
    ?>
  </div>
</section>