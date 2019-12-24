<div class="blog__header" style="background-image:url('<?= $model->background_img_url; ?>');">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <?php if($model->type == "guide"):?>

                <?php endif;?>
                <h1 class="title">
                    <?= $model->h1; ?>
                </h1>
                <p class="text--sub">
                    <?= $model->desc; ?>
                </p>
            </div>
        </div>
    </div>
</div>

<div class="blog__content content">
    <div class="container">
        <?= $model->content; ?>
    </div>
</div>