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
  <div class="dev-foot">
    <div class="container">
      <a class="pub-link" target="_blank" href="https://itprofit.dev/">Сайт разработан ITprofit</a>
    </div>
  </div>
</footer>