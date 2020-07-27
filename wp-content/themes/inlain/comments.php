<? if (comments_open()): ?>
    <div class="comment__block column">
        <h3 class="h">Комментарии</h3>

        <form action="<? bloginfo( 'url' ); ?>/wp-comments-post.php" id="commentform" method="post" class="column">
            <div class="form__row column">
                <textarea name="comment" id="comment" placeholder="Ваш комментарий ..." required></textarea>
            </div>
            <div class="form__row flex__beetwen">
                <input class="btn__in point round b" type="submit" value="Добавить комментарий" />
                <span class="comment__message">Комментарии с оскорблениями, нецензурными выражениями и рекламой не будут опубликованы</span>
            </div>
            <? comment_id_fields();
            do_action('comment_form',$post->ID); ?>
        </form>

        <? $args = [
            'post_id' => $post->ID,
            'status' => 'approve',
            'orderby' => 'meta_value',
            'meta_key' => 'karma',
            'order' => 'DESC',
        ];
        $comments = get_comments( $args );
        if($comments): ?>
            <div class="comment__list column">
                <? foreach( $comments as $comment ):
                    $author = get_userdata($comment->user_id);
                    $date = explode(' ', $comment->comment_date); ?>

                    <div class="comment__card column flex__start">
                        <div class="comment__title flex">
                            <img src="<?= get_avatar_url( $comment->user_id ); ?>" alt="<?= $author->display_name ?>">
                            <span class="comment__autor b"><?= $author->display_name ?></span>
                            <span class="comment__date b"><?= $date[0] ?></span>
                        </div>
                        <div class="comment__text">
                            <p><?= $comment->comment_content; ?></p>
                        </div>
                        <div class="comment__down flex">
                            <!-- <span class="point b">Ответить</span> -->
                            <? $like = get_comment_meta ($comment->comment_ID, 'karma', true) ? get_comment_meta ($comment->comment_ID, 'karma', true) : 0; ?>
                            <div class="comment__like flex__beetwen" data-id="<?= $comment->comment_ID ?>">
                                <img src="<?= get_template_directory_uri() ?>/assets/images/svg/like_btn.svg" alt="" class="point plus click">
                                <span class="count b <? if($like < 0): ?>bad<? endif; ?>" data-count="<?= $like ?>">
                                    <?= $like ?>
                                </span>
                                <img src="<?= get_template_directory_uri() ?>/assets/images/svg/like_btn.svg" alt="" class="point minus click">
                            </div>
                        </div>
                    </div>
                <? endforeach; ?>
            </div>
        <? endif; ?>

    </div>



<? else : ?>
    <h3>Обсуждения закрыты для данной страницы</h3>
    <? comment_form(); ?>
<? endif; ?>
