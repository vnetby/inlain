<!DOCTYPE html>
<html <?= language_attributes(); ?>>

<head>
    <meta http-equiv="Content-Type" content="<?= get_bloginfo('html_type'); ?>; charset=<?= get_bloginfo('charset'); ?>" />
    <meta name="viewport" content="width=device-width,initial-scale=1.0" />

    <link rel="stylesheet" href="<?= THEME_URI; ?>css/head.min.css">

    <link rel="apple-touch-icon" sizes="180x180" href="<?= THEME_URI; ?>/icons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?= THEME_URI; ?>/icons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?= THEME_URI; ?>/icons/favicon-16x16.png">
    <link rel="manifest" href="<?= THEME_URI; ?>site.webmanifest">
    <link rel="mask-icon" href="<?= THEME_URI; ?>/icons/safari-pinned-tab.svg" color="#d81146">
    <meta name="msapplication-TileColor" content="#111111">
    <meta name="theme-color" content="#d81146">
    <?php
    wp_head();

    $body_class = implode(' ', get_body_class());
    ?>

    <!-- Google Tag Manager -->
    <script>
        (function(w, d, s, l, i) {
            w[l] = w[l] || [];
            w[l].push({
                'gtm.start': new Date().getTime(),
                event: 'gtm.js'
            });
            var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s),
                dl = l != 'dataLayer' ? '&l=' + l : '';
            j.async = true;
            j.src =
                'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
            f.parentNode.insertBefore(j, f);
        })(window, document, 'script', 'dataLayer', 'GTM-57Q4KR8');
    </script>
    <!-- End Google Tag Manager -->

</head>

<body class="<?= $body_class; ?>">
    <script src="<?= THEME_URI; ?>js/head.min.js"></script>
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-57Q4KR8" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->

    <div class="site-wrap">
        <?php
        global $vnet;
        $vnet->get_template('template-header');
        ?>