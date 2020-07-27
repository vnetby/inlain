<?php

check_login();


get_header();

// if (!is_user_logged_in()) {
// get_template_part('/pages/auth');
// } else {
get_template_part('/include/slider_top');
?>
<div class="page__wrapper container flex__beetwen">
    <?php
    get_sidebar();
    ?>
    <section id="content">
        <div class="film__card round border column">
            <h1 class="h">
                <? the_title() ?>
            </h1>
        </div>
    </section>
</div>

<?php
get_footer();
// }
?>