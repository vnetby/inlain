<?php
global $cfextend, $front;
?>

<div class="modal" id="modalOrderTest">
  <h3 class="modal-title fw-bold fs-30"><?= __('Заказать тестирование', 'inlain'); ?></h3>
  <div class="modal-body">
    <?php
    echo $cfextend->get_form('order_test', ['btn_submit' => '<button type="submit" class="btn btn-primary">' . __('Отправить', 'inline') . '</button>']);
    ?>
  </div>
</div>




<div class="modal" id="modalOrderConsult">
  <h3 class="modal-title fw-bold fs-30"><?= __('Заказать консультацию', 'inlain'); ?></h3>
  <div class="modal-body">
    <?php
    echo $cfextend->get_form('order_consulting', ['btn_submit' => '<button type="submit" class="btn btn-primary">' . __('Отправить', 'inline') . '</button>']);
    ?>
  </div>
</div>