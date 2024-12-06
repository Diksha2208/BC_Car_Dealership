<?php include "../Views/boilerplate.php"; ?>
<?php include "../Views/nav.php"; ?>

<main class="container my-5">
    <h2>Your Past Orders</h2>

    <?php if (!empty($past_orders)) : ?>
        <table class="table">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Order Date</th>
                    <th>Product Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                
                <?php foreach ($past_orders as $order) : ?>
                    <tr>
                        <td><?php echo htmlspecialchars($order['orderID']); ?></td>
                        <td><?php echo htmlspecialchars($order['created_at']); ?></td>
                        <td><?php echo htmlspecialchars($order['product_name']); ?></td>
                        <td>$<?php echo number_format($order['product_price'], 2); ?></td>
                        <td><?php echo htmlspecialchars($order['quantity']); ?></td>
                        <td>$<?php echo number_format($order['total'],2); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else : ?>
        <p>You have no past orders.</p>
    <?php endif; ?>
</main>

<?php include "../Views/footer.php"; ?>