<?php include "../Views/boilerplate.php"; ?>
<?php include "../Views/nav.php"; ?>    

<main class="container my-5">
    <h2>Your Cart</h2>
    <a href="index.php" type="button" class="alert-link">Browse More Cars</a>
    <?php if (!empty($cart_items)) : ?>
        <table class="table table-striped">
            <thead class="table-dark">
                <tr>
                    <th>Car</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Subtotal</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($cart_items as $car_id => $item) : ?>
                    <tr>
                        <td><?php echo htmlspecialchars($item['name']); ?>
                            <?php if (!empty($item['details'])) : ?>
                                <ul>
                                    <?php foreach ($partdetails as $name => $price) : ?>
                                        <li><?php echo htmlspecialchars("$name: $price"); ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            <?php endif; ?>
                        </td>
                        <td>$<?php echo number_format($item['price'], 2); ?></td>
                        <td><?php echo htmlspecialchars($item['quantity']); ?></td>
                        <td>$<?php echo number_format($item['price'] * $item['quantity'], 2); ?></td>
                        <td>
                            <!-- Remove Item Form -->
                            <form action="?action=remove_from_cart" method="POST" class="d-inline">
                                <input type="hidden" name="car_id" value="<?php echo $car_id; ?>">
                                <button type="submit" class="btn btn-danger btn-sm">Remove</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3" class="text-end"><strong>Total</strong></td>
                    <td><strong>$<?php echo number_format($cart_total, 2); ?></strong></td>
                    <td>
                        <!-- Clear Cart Form -->
                        <form action="?action=clear_cart" method="POST" class="d-inline">
                            <button type="submit" class="btn btn-warning btn-sm">Clear Cart</button>
                        </form>
                    </td>
                </tr>
            </tfoot>
        </table>

        <!-- Create Order Form -->
        <div class="text-end mt-3">
            
            <form action="?action=create_order" method="POST">
                <button type="submit" class="btn btn-success">Create Order</button>
            </form>
        </div>

    <?php else : ?>
        <div class="alert alert-info" role="alert">
            Your cart is empty. <a href="index.php" class="alert-link">Browse Cars</a> to add items.
        </div>
    <?php endif; ?>
</main>
<?php include "../Views/footer.php"; ?>
