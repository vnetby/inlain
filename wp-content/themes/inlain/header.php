<?php
global $kino_user, $vnet;

$html_type = get_bloginfo('html_type');
$charset = get_bloginfo('charset');
$server_name = $vnet->get_from_server('SERVER_NAME');
?>
<!DOCTYPE html>
<html <?= language_attributes(); ?>>

<head>
    <meta http-equiv="Content-Type" content="<?= $html_type; ?>; charset=<?= $charset; ?>" />
    <link rel="apple-touch-icon" sizes="180x180" href="<?= THEME_URI ?>assets/images/favicon/apple-touch-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="48x48" href="<?= THEME_URI ?>assets/images/favicon/favicon.png">
    <link rel="manifest" href="/site.webmanifest">
    <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#e00e43">
    <meta name="apple-mobile-web-app-title" content="<?= $server_name ?>">
    <meta name="application-name" content="<?= $server_name ?>">
    <meta name="theme-color" content="#ffffff">
    <meta name="viewport" content="width=device-width,initial-scale=1.0" />
    <?php
    wp_head();
    ?>
</head>

<body>
    <?php
    if ($kino_user->can_view_content()) {
        $vnet->get_template('template-header');
    ?>
        <main>
        <?php
    }
