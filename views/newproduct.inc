<?php self::renderView('partial/header', $model); ?>
<div class="container">
    <h1>New Product</h1>

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
    <?php self::endActionForm(); ?> 
</div>
<?php self::renderView('partial/footer', $model); ?>