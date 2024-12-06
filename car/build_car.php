<?php include "../Views/boilerplate.php"; ?>
<?php include "../Views/nav.php"; ?>

<main class="container my-5">
    <h2>Build Your Own Car</h2>
    <p>Select your preferred options for each component to build your dream car.</p>

    <?php if (isset($error_message)) : ?>
        <div class="alert alert-danger"><?php echo $error_message; ?></div>
    <?php endif; ?>

    <form action="?action=add_to_cart_build" method="POST">
        <?php foreach ($parts as $step => $options) : ?>
            <div class="mb-4">
                <label for="<?php echo $step; ?>" class="form-label"><strong><?php echo $step; ?></strong></label>
                <select class="form-select" name="parts[<?php echo $step; ?>]" id="<?php echo $step; ?>" required>
                    <option value="">-- Select an option --</option>
                    <?php foreach ($options as $option) : ?>
                        <option value="<?php echo $option['partID']; ?>">
                            <?php echo htmlspecialchars($option['partName']); ?> ($<?php echo number_format($option['price'], 2); ?>)
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
        <?php endforeach; ?>
        <button type="submit" class="btn btn-primary mt-3">Submit Build</button>
    </form>
</main>

<?php include "../Views/footer.php"; ?>