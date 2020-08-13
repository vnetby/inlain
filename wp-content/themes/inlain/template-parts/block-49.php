<?php
global $front, $vnet;

$title = $this->get_from_array($args, 'title');
$targets = $this->get_array_from_array($args, 'targets');
$bold_text = $this->get_from_array($args, 'bold_text');

$video = $this->get_from_array($args, 'video');
$youtube_link = $this->get_from_array($video, 'link');
$video_caption = $this->get_from_array($video, 'caption');
$video_cover = $this->get_from_array($video, 'img');

$desc = $this->get_from_array($args, 'desc');
?>



<section class="section section-about" data-admin>
  <div class="container">
    <?php
    if ($title) {
    ?>
      <h2 class="section-title fw-normal fs-20"><?= $title; ?></h2>
    <?php
    }
    if ($targets) {
    ?>
      <div class="targets-list">
        <?php
        foreach ($targets as &$target) {
          $target_title = $this->get_from_array($target, 'title');
          $target_desc = $this->get_from_array($target, 'desc');
        ?>
          <div class="target-col">
            <div class="target-item">
              <h3 class="target-title fs-25 fw-bold c-primary lh-2"><?= $target_title; ?></h3>
              <div class="target-desc"><?= $target_desc; ?></div>
            </div>
          </div>
        <?php
        }
        ?>
      </div>
    <?php
    }
    if ($bold_text) {
    ?>
      <h3 class="bold-text"><?= $bold_text; ?></h3>
    <?php
    }
    if ($youtube_link) {
      $video_id = $front->get_youtube_id($youtube_link);
      $player_id = $vnet->random_str(5);
    ?>
      <div class="video-container">
        <div class="video-wrap js-video-play" data-id="<?= $video_id; ?>" data-player-id="<?= $player_id; ?>">
          <?php
          if ($video_cover) {
            $img = wp_get_attachment_image_url($video_cover, 'inlain-video-cover');
          ?>
            <div class="video-cover" tab-index>
              <img src="<?= $img; ?>" alt="video cover">
              <?= $vnet->get_svg('play'); ?>
            </div>
            <div class="player" id="<?= $player_id; ?>"></div>
          <?php
          }
          ?>
        </div>
        <?php
        if ($video_caption) {
        ?>
          <div class="video-caption c-grey fs-15">
            <?= $video_caption; ?>
          </div>
        <?php
        }
        ?>
      </div>
    <?php
    }
    if ($desc) {
    ?>
      <div class="editor-content about-desc">
        <?= $desc; ?>
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