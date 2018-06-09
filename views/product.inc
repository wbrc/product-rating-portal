<?php self::renderView('partial/header', $model);?>
<div class="container">
    <h1><?php echo ($model['product']->getProductName()) ?></h1>
    By <em><?php echo ($model['product']->getManufacturer()) ?></em></br>
    Avarage score: <?php self::htmlout($model['score'])?></br>
    <?php
if (isset($model['user'])) {
    self::actionLink('create rating for this product', 'Index', 'NewRating', array('pid' => $model['product']->getId()));
}
?>
    <h2>Ratings</h2>
    <table class="table">
        <tr>
            <th>Score</th>
            <th>Comment</th>
            <th>rating by</th>
        </tr>
        <?php foreach ($model['ratings'] as $rating) {?>
        <tr>
            <td>
                <?php self::htmlout($rating->getScore())?>
            </td>
            <td>
                <?php self::htmlout($rating->getDescription())?>
            </td>
            <td>
                <?php self::htmlout($rating->getUserID()); ?>
            </td>
        </tr>
        <?php }?>
    </table>
</div>
<?php self::renderView('partial/footer', $model);?>