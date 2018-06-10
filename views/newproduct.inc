<?php self::renderView('partial/header', $model);?>
<div class="container">
    <?php if (!isset($model['product'])) {?>
    <h1>New Product</h1>
    <?php } else {?>
    <h1>Update Product</h1>
    <?php }?>
    
    <?php if (!isset($model['product'])){ ?>
    <?php self::beginActionForm('Create', 'NewProduct', null, 'post'); ?>
        <div class="form-group">
            <label for="productName">Product name</label>
            <input class="form-control" id="productName" name="pn">
        </div>
        <div class="form-group">
            <label for="manufacturer">Manufacturer</label>
            <input class="form-control" id="manufacturer" name="manu">
        </div>
        <button class="btn btn-primary">Create</button>
    <?php self::endActionForm();?>
    <?php } else { ?>
        <?php self::beginActionForm('Update', 'NewProduct', array('pid' => $model['product']->getId()), 'post'); ?>
        <div class="form-group">
            <label for="productName">Product name</label>
            <input class="form-control" id="productName" name="pn" value="<?php self::htmlout($model['product']->getProductName());?>">
        </div>
        <div class="form-group">
            <label for="manufacturer">Manufacturer</label>
            <input class="form-control" id="manufacturer" name="manu" value="<?php self::htmlout($model['product']->getManufacturer());?>">
        </div>
        <button class="btn btn-primary">Update</button>
    <?php self::endActionForm();?>
    <?php } ?>

</div>
<?php self::renderView('partial/footer', $model);?>