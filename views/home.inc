<?php self::renderView('partial/header', $model);?>
<div class="container">
    <h1>Products</h1>
    <p>
        <table class="table">
            <tr>
                <th>Name</th>
                <th>Manufacturer</th>
                <th>Description</th>
            </tr>
            <?php foreach ($model['products'] as $product) {?>
            <tr>
                <td>
                    <?php self::actionLink($product->getProductName(), 'Index', 'Product', array('pid' => $product->getId()));?>
                </td>
                <td>
                    <?php echo ($product->getManufacturer()); ?>
                </td>
                <td>
                    <?php echo ($product->getDescription()); ?>
                </td>
            </tr>
            <?php }?>
        </table>
    </p>
</div>
<?php self::renderView('partial/footer', $model);?>