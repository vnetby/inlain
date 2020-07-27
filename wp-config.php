<?php
ini_set('upload_max_size', '800M');
ini_set('post_max_size', '800M');
ini_set('max_execution_time', '300');
ini_set('memory_limit', '2048M');

$GLOBALS['SITE_SETTINGS'] = json_decode(file_get_contents(dirname(__FILE__) . '/.siteconf.json'), true);

/**
 * Основные параметры WordPress.
 *
 * Скрипт для создания wp-config.php использует этот файл в процессе
 * установки. Необязательно использовать веб-интерфейс, можно
 * скопировать файл в "wp-config.php" и заполнить значения вручную.
 *
 * Этот файл содержит следующие параметры:
 *
 * * Настройки MySQL
 * * Секретные ключи
 * * Префикс таблиц базы данных
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** Параметры MySQL: Эту информацию можно получить у вашего хостинг-провайдера ** //
/** Имя базы данных для WordPress */
define('DB_NAME', $SITE_SETTINGS['DB_NAME']);

/** Имя пользователя MySQL */
define('DB_USER', $SITE_SETTINGS['DB_USER']);

/** Пароль к базе данных MySQL */
define('DB_PASSWORD', $SITE_SETTINGS['DB_PASS']);

/** Имя сервера MySQL */
define('DB_HOST', $SITE_SETTINGS['DB_HOST']);

/** Кодировка базы данных для создания таблиц. */
define('DB_CHARSET', $SITE_SETTINGS['DB_CHARSET']);

/** Схема сопоставления. Не меняйте, если не уверены. */
define('DB_COLLATE', '');

/**#@+
 * Уникальные ключи и соли для аутентификации.
 *
 * Смените значение каждой константы на уникальную фразу.
 * Можно сгенерировать их с помощью {@link https://api.wordpress.org/secret-key/1.1/salt/ сервиса ключей на WordPress.org}
 * Можно изменить их, чтобы сделать существующие файлы cookies недействительными. Пользователям потребуется авторизоваться снова.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '-R+kFG.mXuB+HI$mQM ~Ghek!=tzD!qTsExqRd9N2/ ,W6,[.nd4FX}f7*`VaoL>');
define('SECURE_AUTH_KEY',  '>;&e,%Ei1|m%@Pz:qH;M4&P)Nb5ynw-h4;,ME+8h[wE]zn)V~)-`Pk*7m.D0~GLq');
define('LOGGED_IN_KEY',    'ma)JWS2%l.ZVUB]rjAylx4.V9FcT.If=nC8aDH;p>SYAMj71n18/?VJ<$DTd0,=.');
define('NONCE_KEY',        '~4WnJTm{YX%2f7$Vw^L(>CHCd_{EPr+9cCCmZwqcTTMx,R6(6xN*`f9C7g6LC*Q1');
define('AUTH_SALT',        '5<<KK945HO_%]OKv%j8c/FL9lRIJn9,/<h9[zQFCDg0wTUdiv~/>[!FAjU+D~cnj');
define('SECURE_AUTH_SALT', '=g=S{KdLQ:u}()Ql*T8Sis09*vS%IS8~|}w:=pH(7!Td+zg`+S_J?iv%ppuo&1c&');
define('LOGGED_IN_SALT',   '>:^7FLD)w8Z,t3xTNw&@1GLnNei:,}:/><`iE>o[iS4?#b=? ++R+&EGes>|A=u$');
define('NONCE_SALT',       'Z]=/{&9mzr2QtUzJ2?r%/j@_D&BCIK[-ZUyt1#O$`o,90X)lce~~AY,]qgvAd#B+');

/**#@-*/

/**
 * Префикс таблиц в базе данных WordPress.
 *
 * Можно установить несколько сайтов в одну базу данных, если использовать
 * разные префиксы. Пожалуйста, указывайте только цифры, буквы и знак подчеркивания.
 */
$table_prefix = 'wp_';

/**
 * Для разработчиков: Режим отладки WordPress.
 *
 * Измените это значение на true, чтобы включить отображение уведомлений при разработке.
 * Разработчикам плагинов и тем настоятельно рекомендуется использовать WP_DEBUG
 * в своём рабочем окружении.
 *
 * Информацию о других отладочных константах можно найти в Кодексе.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', $SITE_SETTINGS['WP_DEBUG']);

/* Это всё, дальше не редактируем. Успехов! */

/** Абсолютный путь к директории WordPress. */
if (!defined('ABSPATH')) {
	define('ABSPATH', dirname(__FILE__) . '/');
}

/** Инициализирует переменные WordPress и подключает файлы. */
require_once(ABSPATH . 'wp-settings.php');
