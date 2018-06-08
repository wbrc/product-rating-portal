<?php self::renderView('partial/header', $model);?>
<div class="container">
    <h1><?php echo($model['product']->getProductName()) ?></h1>
    <em><?php echo($model['product']->getManufacturer()) ?></em>
    <h2>Ratings</h2>
    <?php foreach ($model['ratings'] as $rating) {?>
        <p><?php echo($rating->getDescription()) ?>
        <?php echo($rating->getScore()) ?></p>
    <?php } ?>
</div>
<?php self::renderView('partial/footer', $model);?>