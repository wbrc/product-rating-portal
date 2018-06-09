<?php self::renderView('partial/header', $model);?>
<div class="container">
    <h1>Your products</h1>
    <p>
        <table class="table">
            <tr>
                <th>Name</th>
                <th>Manufacturer</th>
                <th>Action</th>
            </tr>
            <?php foreach ($model['products'] as $product) {?>
            <tr>
                <td>
                    <?php self::actionLink($product->getProductName(), 'Index', 'Product', array('pid' => $product->getId()));?>
                </td>
                <td>
                    <?php self::htmlout($product->getManufacturer()); ?>
                </td>
                <td>
                    <?php self::actionLink("delete", 'Delete', 'NewProduct', array('pid' => $product->getId()));?>
                </td>
            </tr>
            <?php }?>
        </table>
    </p>

    <h1>Your ratings</h1>
    <p>
        <table class="table">
            <tr>
                <th>Product</th>
                <th>Comment</th>
                <th>Rating</th>
                <th>Action</th>
            </tr>
            <?php foreach ($model['ratings'] as $rating) {?>
            <tr>
                <td>
                    <?php self::actionLink($rating[0]->getProductName(), 'Index', 'Product', array('pid' => $rating[0]->getId()));?>
                </td>
                <td>
                    <?php self::htmlout($rating[1]->getDescription()); ?>
                </td>
                <td>
                    <?php self::htmlout($rating[1]->getScore()); ?>
                </td>
                <td>
                <?php self::actionLink("delete", 'Delete', 'NewRating', array('rid' => $rating[1]->getId()));?>
                </td>
            </tr>
            <?php }?>
        </table>
    </p>
</div>
<?php self::renderView('partial/footer', $model);?>