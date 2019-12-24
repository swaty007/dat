<section id="review" class="review__wrap">
    <div class="review__header" >
        <div class="container">

                    <h1 class="title">
                        <?= $model->title; ?>
                    </h1>
                    <p class="text--sub">
                        <?= $model->desc; ?>
                    </p>


        </div>
    </div>

    <div class="review__reasons reasons">
        <div class="container">
            <div class="row">
                <div class="col-md-10 col-md-offset-1 col-lg-8 col-lg-offset-2">
                    <h2>
                        <?= $model->reasons_head->meta_title; ?>
                    </h2>
                    <?= $model->reasons_head->meta_value; ?>
                    <?php foreach ($model->reasons as $n => $reason):?>
                        <h3><span class="text--green">Reason <?= $n+1; ?></span> <?= $reason->meta_title; ?></h3>
                        <p><?= $reason->meta_value; ?></p>
                    <?php endforeach;?>
                </div>
            </div>
        </div>
    </div>
</section>