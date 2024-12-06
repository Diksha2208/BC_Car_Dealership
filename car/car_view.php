<?php include '../Views/boilerplate.php'; ?>
<?php include '../Views/nav.php'; ?>


<main class="container my-5">
    <div class="row">
        <!-- Sidebar for Categories -->
        <aside class="col-md-3">
            <h2 class="mb-4">Categories</h2>
            <nav>
                <ul class="list-group">
                    <?php if (!empty($categories)) : ?>
                        <?php foreach ($categories as $category) : ?>
                            <li class="list-group-item">
                                <a href="?action=list_models&category_id=<?php echo $category['Category']; ?>" class="text-decoration-none">
                                    <?php echo htmlspecialchars($category['Category']); ?>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <li class="list-group-item">No categories available.</li>
                    <?php endif; ?>
                </ul>
            </nav>
        </aside>

        <!-- Main Section for Models -->
        <section class="col-md-9">
            <?php if (isset($models) && !empty($models)) : ?>
                <h2 class="mb-4"><?php echo htmlspecialchars($category_name); ?></h2>
                <ul class="list-group">
                    <?php foreach ($models as $model) : ?>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <div>
                                <a href="?action=view_model&model_id=<?php echo $model['id']; ?>" class="text-decoration-none">
                                <strong> <?php echo htmlspecialchars($model['Model']); ?></strong>
                                    
                                <p class="mb-0">Price: $<?php echo htmlspecialchars($model['Price']); ?></p></a>
                                </div>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php elseif (isset($model)) : ?>
                <h2 class="mb-4"><?php echo htmlspecialchars($model['Model']); ?></h2>
                <p>Make: <?php echo htmlspecialchars($model['Make']); ?></p>
                <p>Category: <?php echo htmlspecialchars($model['Category']); ?></p>
                <p>Style: <?php echo htmlspecialchars($model['Style']); ?></p>
                <p>Year: <?php echo htmlspecialchars($model['Year']); ?></p>
                <p>Price: $<?php echo htmlspecialchars($model['Price']); ?></p>
                <img src="<?php echo htmlspecialchars($model['Image']); ?>" alt="<?php echo htmlspecialchars($model['Model']); ?>" class="img-fluid">
                <!-- Add to Cart Button -->
                <form action="?action=add_to_cart" method="POST" class="mt-3">
                    <input type="hidden" name="car_id" value="<?php echo $model['id']; ?>">
                    <input type="hidden" name="car_name" value="<?php echo $model['Model']; ?>">
                    <input type="hidden" name="car_price" value="<?php echo $model['Price']; ?>">
                    <button type="submit" class="btn btn-primary">Add to Cart</button>
                </form>
            <?php else : ?>
                <p>Please select a category to view models.</p>
            <?php endif; ?>
        </section>
    </div>
</main>

<?php include '../Views/footer.php'; ?>