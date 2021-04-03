<?php if (count($errors)) : ?>

    <div class="alert alert-danger" role="alert">
        
        <?php foreach ($errors as $errorKey => $errorValue) : ?>

            <div><?= implode('; ', $errorValue); ?></div>

        <?php endforeach; ?>


    </div>

<?php endif; ?>
