<?php
global $about;
?>
<footer class="footer bg-dark c-white">
  <div class="container">
    <div class="logo-col">
      <?= $about->get_logo(); ?>
    </div>
    <div class="sign-col">
      <?= $about->get_signature(); ?>
    </div>
  </div>
</footer>