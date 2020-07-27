<?php
// $_SERVER['HTTP_REFERER'] - полный URL страницы, откуда пришел пользователь
// $url[0] - без GET параметров
// это нам понадобится для правильных редиректов
$url = explode("?", $_SERVER['HTTP_REFERER']);

// подключаем WordPress
// тут указан правильный путь, если profile-update.php находится непосредственно в папке с темой
require_once(dirname(__FILE__) . '/../../../wp-load.php');

// если не авторизован, просто выходим из файла
if (!is_user_logged_in()) exit;

// получаем объект пользователя с необходимыми данными
$user_ID = get_current_user_id();
$user = get_user_by('id', $user_ID);


// сначала обработаем пароли, ведь если при сохранении пользователь ничего не указал ни в одном поле пароля, то пропускаем эту часть
if ($_POST['pass_old'] || $_POST['pass_new']) {

    // при этом пользователь должен заполнить все поля
    if ($_POST['pass_old'] && $_POST['pass_new']) {

        // сначала проверяем соответствие нового пароля и его подтверждения
        //if( $_POST['pwd2'] == $_POST['pwd3'] ){

        // пароль из двух символов нам не нужен, минимум 8
        /*if( strlen( $_POST['pwd2'] ) < 8 ) {
                // если слишком короткий - перенаправляем
                header('location:' . $url[0] . '?status=short');
                exit;
            }*/

        // и самое главное - проверяем, правильно ли указан старый пароль
        if (wp_check_password($_POST['pass_old'], $user->data->user_pass, $user->ID)) {
            // если да, меняем на новый и заново авторизуем пользователя
            wp_set_password($_POST['pass_new'], $user_ID);
            $creds['user_login'] = $user->user_login;
            $creds['user_password'] = $_POST['pass_new'];
            $creds['remember'] = true;
            $user = wp_signon($creds, false);
        } else {
            // если нет, перенаправляем на ошибку
            header('location:' . $url[0] . '?status=wrong');
            exit;
        }

        /*} else {
            // новый пароль и его подтверждение не соответствуют друг другу
            header('location:' . $url[0] . '?status=mismatch');
            exit;
        }*/
    } else {
        // не все поля заполнены - перенеправляем
        header('location:' . $url[0] . '?status=required');
        exit;
    }
}

// допустим, что Имя, Фамилия и Емайл - обязательные поля, Город - не обязательное
if ($_POST['user_name'] && is_email($_POST['user_email'])) {

    // если пользователь указал новый емайл, а кто-то уже под ним зареган - отправляем на ошибку
    if (email_exists($_POST['user_email']) && $_POST['user_email'] != $user->user_email) {
        header('location:' . $url[0] . '?status=exist');
        exit;
    }

    // обновляем данные пользователя
    wp_update_user([
        'ID' => $user_ID,
        'user_email' => $_POST['user_email'],
        'display_name' => $_POST['user_name'],
    ]);

    // ну и город не забываем обновить
    //update_user_meta( $user_ID, 'city', $_POST['city']);
} else {
    // не все поля заполнены - перенеправляем
    header('location:' . $url[0] . '?status=required');
    exit;
}

global $vnet;

if (isset($_FILES['avatar_user'])) {
    $file = $_FILES['avatar_user'];
    $path = $file['tmp_name'];

    if (exif_imagetype($path) !== false) {
        $move_file = wp_handle_upload($file, ['test_form' => false]);
        if ($move_file && !is_wp_error($move_file) && isset($move_file['url'])) {
            delete_user_meta($user_ID, 'kino_avatar');
            update_user_meta($user_ID, 'kino_avatar', $move_file['url']);
        }
    }
}


// если выполнение кода дошло до сюда, то следовательно всё ок
header('location:' . $url[0] . '?status=ok');
exit;
