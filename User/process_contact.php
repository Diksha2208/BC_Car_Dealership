<?php
// Start the session
session_start();

// Get form data
$name = isset($_POST['name']) ? htmlspecialchars($_POST['name']) : '';
$email = isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '';
$message = isset($_POST['message']) ? htmlspecialchars($_POST['message']) : '';
?>

<?php include '../Views/boilerplate.php'; ?>
<?php include '../Views/nav.php'; ?>    
<div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="card shadow-lg p-5" style="width: 100%; max-width: 600px;">
        <h2 class="text-center mb-4">Thank You!</h2>
        <p class="text-center">Thank you for sending us a message, <strong><?php echo $name; ?></strong>!</p>
        <p class="text-center">We will get back to you at <strong><?php echo $email; ?></strong> as soon as possible.</p>
        <div class="alert alert-success">
            <p><strong>Your Message:</strong></p>
            <p><?php echo nl2br($message); ?></p>
        </div>
        <div class="d-grid">
            <a href="contact_us.php" class="btn btn-primary">Back to Contact Page</a>
        </div>
    </div>
</div>

<?php include '../Views/footer.php'; ?>
\
