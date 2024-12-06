<?php
    require_once '../Model/dbconfig.php';
    require_once '../Model/user_db.php';
    include '../User/user.php'; 

    session_start();
    $user = new User();

    $user = unserialize($_SESSION['user']); // Unserialize the object
    if (is_object($user)) {
        $username = $user->username;
    
    }

    $detailed_user = getUser($conn, $username);
    $email = $detailed_user['email'];

?>
<?php include '../Views/boilerplate.php'; ?>
<?php include '../Views/nav.php'; ?>
<div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="card shadow-lg" style="width: 100%; max-width: 500px;">
        <div class="card-body">
            <h2 class="text-center mb-4">Contact Us</h2>
            <form action="process_contact.php" method="POST">
                <!-- Name Field -->
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" name="name" 
                        value="<?php echo htmlspecialchars($username); ?>" placeholder="Enter your name" required>
                </div>
                
                <!-- Email Field -->
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" 
                        value="<?php echo htmlspecialchars($email); ?>" placeholder="Enter your email" required>
                </div>
                
                <!-- Message Field -->
                <div class="mb-3">
                    <label for="message" class="form-label">Message</label>
                    <textarea class="form-control" id="message" name="message" rows="5" placeholder="Write your message here..." required></textarea>
                </div>
                
                <!-- Submit Button -->
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">Send Message</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include '../Views/footer.php'; ?>
