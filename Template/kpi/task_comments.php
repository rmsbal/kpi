<h3><?= $this->text->e($task['title']) ?></h3>

<?php if (empty($comments)): ?>

    <p><?= t('No comments found.') ?></p>

<?php else: ?>

    <?php foreach ($comments as $comment): ?>

        <div class="comment">

            <strong><?= $this->text->e($comment['username']) ?></strong>

            <div class="comment-date">
                <?= $this->dt->datetime($comment['date_creation']) ?>
            </div>

            <div class="comment-text">
                <?= $this->text->markdown($comment['comment']) ?>
            </div>

            <hr>

        </div>

    <?php endforeach; ?>

<?php endif; ?>