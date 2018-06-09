<?php self::renderView('partial/header', $model); ?>
<div class="container">
    <h1>New rating for <?php self::htmlout($model['product']->getProductName()) ?></h1>

    <?php self::beginActionForm('Create', 'NewRating', array('pid' => $model['product']->getId()), 'post'); ?>
        <div class="form-group">
            <label for="comment">Comment</label>
            <input class="form-control" id="comment" name="cm">
        </div>
        <div class="radio">
            <label><input type="radio" name="rating" value="1">1</label>
        </div>
        <div class="radio">
            <label><input type="radio" name="rating" value="2">2</label>
        </div>
        <div class="radio">
            <label><input type="radio" name="rating" value="3" checked="checked">3</label>
        </div>
        <div class="radio">
            <label><input type="radio" name="rating" value="4">4</label>
        </div>
        <div class="radio">
            <label><input type="radio" name="rating" value="5">5</label>
        </div>
        <button class="btn btn-primary">Create</button>
    <?php self::endActionForm(); ?> 
</div>
<?php self::renderView('partial/footer', $model); ?>