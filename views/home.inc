<?php self::renderView('partial/header', $model);?>
<div class="container">
<?php
if (isset($model['user'])) { ?>
    <?php self::actionLink("Create new product", 'Index', 'NewProduct'); ?>
    </br>
<?php } ?>
    <?php self::beginActionForm('Index', 'Home', null, 'post');?>
        <div class="form-row">
            <div class="col">
                <input class="form-control" id="filter" name="f" placeholder="your filter here...">
            </div>
            <div class="col">
                <button class="btn btn-primary">Apply</button>
            </div>
        </div>
    <?php self::endActionForm();?>

    <h1>Products</h1>
    <p>
        <table class="table">
            <tr>
                <th>Name</th>
                <th>Manufacturer</th>
                <th>Rating</th>
                <th># Rated</th>
                <th>created by</th>
            </tr>
            <?php foreach ($model['products'] as $product) {?>
            <tr>
                <td>
                    <?php self::actionLink($product[2]->getProductName(), 'Index', 'Product', array('pid' => $product[2]->getId()));?>
                </td>
                <td>
                    <?php self::htmlout($product[2]->getManufacturer());?>
                </td>
                <td>
                    <?php self::htmlout($product[0]);?>
                </td>
                <td>
                    <?php self::htmlout($product[1]);?>
                </td>
                <td>
                    <?php self::htmlout($product[3]->getUserName());?>
                </td>
            </tr>
            <?php }?>
        </table>
    </p>
</div>
<?php self::renderView('partial/footer', $model);?>