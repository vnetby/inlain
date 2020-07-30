<!DOCTYPE html>
<html <?= language_attributes(); ?>>

<head>
    <meta http-equiv="Content-Type" content="<?= get_bloginfo('html_type'); ?>; charset=<?= get_bloginfo('charset'); ?>" />
    <meta name="viewport" content="width=device-width,initial-scale=1.0" />

    <link rel="stylesheet" href="<?= THEME_URI; ?>css/head.min.css">

    <?php
    wp_head();

    $body_class = implode(' ', get_body_class());
    ?>
</head>

<body class="<?= $body_class; ?>">
    <script src="<?= THEME_URI; ?>js/head.min.js"></script>
    <div class="site-wrap">
        <?php
        global $vnet;
        $vnet->get_template('template-header');
        ?>