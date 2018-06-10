<?php self::renderView('partial/header', $model);?>
<div class="container">
    <?php if(!isset($model['rating'])){ ?>
    <h1>New rating for <?php self::htmlout($model['product']->getProductName())?></h1>
    <?php } else { ?>
    <h1>Update rating for <?php self::htmlout($model['product']->getProductName())?></h1>
    <?php } ?>
    <?php if (!isset($model['rating'])) {?>
    <?php self::beginActionForm('Create', 'NewRating', array('pid' => $model['product']->getId()), 'post');?>
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
    <?php self::endActionForm();?>
    <?php } else {?>
        <?php self::beginActionForm('Update', 'NewRating', array('pid' => $model['product']->getId(),'rid' => $model['rating']->getId()), 'post');?>
        <div class="form-group">
            <label for="comment">Comment</label>
            <input class="form-control" id="comment" name="cm" value="<?php self::htmlout($model['rating']->getDescription());?>">
        </div>
        <div class="radio">
            <label><input type="radio" name="rating" value="1"  <?php if ($model['rating']->getScore() == 1) {?>checked="checked" <?php }?>>1</label>
        </div>
        <div class="radio">
            <label><input type="radio" name="rating" value="2"  <?php if ($model['rating']->getScore() == 2) {?>checked="checked" <?php }?>>2</label>
        </div>
        <div class="radio">
    <label><input type="radio" name="rating" value="3"  <?php if ($model['rating']->getScore() == 3) {?>checked="checked" <?php }?>>3</label>
        </div>
        <div class="radio">
            <label><input type="radio" name="rating" value="4"  <?php if ($model['rating']->getScore() == 4) {?>checked="checked" <?php }?>>4</label>
        </div>
        <div class="radio">
            <label><input type="radio" name="rating" value="5"  <?php if ($model['rating']->getScore() == 5) {?>checked="checked" <?php }?>>5</label>
        </div>
        <button class="btn btn-primary">Update</button>
    <?php self::endActionForm();?>

    <?php }?>
</div>
<?php self::renderView('partial/footer', $model);?>