<?php include __DIR__ . "/header.php"; ?>

<?php
    if(isset($_GET['action'])){
        handleCartAction($_GET['action']);
        header("Location: http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");
    }
?>
<div class="row" id="Content">
    <div id="CenteredContent">
        <div id="ArticleHeader">
            <h2 class="StockItemNameViewSize StockItemName">Winkelmandje</h2>
            <!-- Create a table to display the products in cart -->
            <?php 
            ?>
            <table class="table table-striped" style="color: white;">
                        <thead>
                            <tr>
                                <th scope="col">Product</th>
                                <th scope="col">Aantal</th>
                                <th scope="col">Prijs</th>
                                <th scope="col">Totaal</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $totalPrice = 0;
                                foreach(getCartItems() as $productId => $product){
                                    $totalPrice += $product['SellPrice'] * $product['quantityInCart'];
                                    ?>
                                    <tr>
                                        <td>
                                            <?php echo $product['StockItemName']; ?>
                                        </td>
                                        <td>
                                            <form action="/cart.php" method="get">
                                                <input type="number" name="quantity" value="<?php echo $product['quantityInCart']; ?>">
                                                <input type="hidden" name="action" value="changeQuantity">
                                                <input type="hidden" name="productId" value="<?php echo $product['StockItemID']; ?>">
                                                <input type="submit" value="Wijzig">   
                                            </form>
                                        </td>
                                        <!-- format the price as: €49,99 -->
                                        <td><?php echo '€' . number_format($product['SellPrice'], 2, ',', '.'); ?></td>
                                        <!-- display total for that current item(s) -->
                                        <td><?php echo '€' . number_format($product['SellPrice'] * $product['quantityInCart'], 2, ',', '.'); ?></td>
                                        <!-- Totaal laten zien: -->
                                        <td>
                                            <form action="/cart.php">
                                                <input type="hidden" name="action" value="addOneToCart">
                                                <input type="hidden" name="productId" value="<?php echo $product['StockItemID']; ?>">
                                                <input type="submit" value="+">
                                            </form>

                                            <form action="/cart.php">
                                                <input type="hidden" name="action" value="removeOneFromCart">
                                                <input type="hidden" name="productId" value="<?php echo $product['StockItemID']; ?>">
                                                <input type="submit" value="-">
                                            </form>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            ?>
                        </tbody>
                    </table>    

        </div>
    </div>
</div>
<?php include __DIR__ . "/footer.php"; ?>