<?php

require_once "dbconfig.php";

// Initialize variables
$username = $password = $confirm_password = $name = $email = "";
$username_error = $password_error = $confirm_password_error = $name_error = $email_error = "";

// Process form data
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Check username
    if (empty(trim($_POST["username"]))) {
        $username_error = "Please enter an username.";
    } elseif (!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["username"]))) {
        $username_error = "Username can only contain letters, numbers, and underscores.";
    } else {
        // Perform duplicate check
        $sql = "SELECT id FROM `user` WHERE username = ?";

        if ($stmt = mysqli_prepare($conn, $sql)) {
            // Bind variables to prepare statement
            mysqli_stmt_bind_param($stmt, "s", $param_username);

            $param_username = trim($_POST["username"]);

            // Execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {

                // Store result
                mysqli_stmt_store_result($stmt);

                if (mysqli_stmt_num_rows($stmt) > 0) {
                    $username_error = "This username is already taken.";
                } else {
                    $username = trim($_POST["username"]);
                }
            } else {
                echo "Sorry. Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }

    // Check password
    if (empty(trim($_POST["password"]))) {
        $password_error = "Please enter a password.";
    } elseif (strlen(trim($_POST["password"])) < 6) {
        $password_error = "Password must have at least six characters.";
    } else {
        $password = trim($_POST["password"]);
    }

    // Check confirm password
    if (empty(trim($_POST["confirm_password"]))) {
        $confirm_password_error = "Please confirm password.";
    } else {
        $confirm_password = trim($_POST["confirm_password"]);
        if (empty($password_error) && ($password != $confirm_password)) {
            $confirm_password_error = "Password doesn't match.";
        }
    }

    // Check first name
    if (empty(trim($_POST["name"]))) {
        $name_error = "Please enter your first name.";
    } else {
        $name = trim($_POST["name"]);
    }


    // Check email
    if (empty(trim($_POST["email"]))) {
        $email_error = "Please enter your email address.";
    } elseif (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
        $email_error = "Email is invalid.";
    } else {
        $email = trim($_POST["email"]);

    }

    // If no input errors, create new user record
    if (empty($username_error) && empty($password_error) && empty($confirm_password_error) &&
        empty($fname_error) && empty($lname_error) && empty($email_error)) {
        // Perform an insertion
        $sql = "INSERT INTO `user` (username, password, name, email) VALUES (?, ?, ?, ?)";

        if ($stmt = mysqli_prepare($conn, $sql)) {
            // Bind variables to prepare statement
            mysqli_stmt_bind_param($stmt, "ssss", $username, $param_password, $name, $email);

            echo "alert(\"" . $password . ": " . password_hash($password, PASSWORD_DEFAULT) . "\");";
            
            // Set parameters
            $param_password = password_hash($password, PASSWORD_DEFAULT);

            // Execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                //header("location: index.php");
            } else {
                echo "Sorry. Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }

    // Close database connection
    mysqli_close($conn);
}
?>
<?php include('../Views/boilerplate.php'); ?>
<?php include('../Views/nav.php'); ?>

<div class="container py-5">
    <div class="row justify-content-center">
      <div class="col-lg-6 col-md-8">
        <div class="card shadow-sm">
          <div class="card-body">
            <h3 class="card-title text-center mb-4">Sign Up</h3>
            <p class="text-center">Please fill this form to create an account.</p>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
              <!-- Username -->
              <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" name="username" id="username" class="form-control <?php echo (!empty($username_error)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
                <div class="invalid-feedback"><?php echo $username_error; ?></div>
              </div>
              <!-- Password -->
              <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" id="password" class="form-control <?php echo (!empty($password_error)) ? 'is-invalid' : ''; ?>">
                <div class="invalid-feedback"><?php echo $password_error; ?></div>
              </div>
              <!-- Confirm Password -->
              <div class="mb-3">
                <label for="confirm_password" class="form-label">Confirm Password</label>
                <input type="password" name="confirm_password" id="confirm_password" class="form-control <?php echo (!empty($confirm_password_error)) ? 'is-invalid' : ''; ?>">
                <div class="invalid-feedback"><?php echo $confirm_password_error; ?></div>
              </div>
              <!-- First Name -->
              <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" name="name" id="name" class="form-control <?php echo (!empty($name_error)) ? 'is-invalid' : ''; ?>" value="<?php echo $name; ?>">
                <div class="invalid-feedback"><?php echo $name_error; ?></div>
              </div>

              <!-- Email -->
              <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" id="email" class="form-control <?php echo (!empty($email_error)) ? 'is-invalid' : ''; ?>" value="<?php echo $email; ?>">
                <div class="invalid-feedback"><?php echo $email_error; ?></div>
              </div>
              <!-- Submit -->
              <div class="d-grid">
                <button type="submit" class="btn btn-primary">Create Account</button>
              </div>
              <p class="text-center mt-3">Already have an account? <a href="../User/login.php">Sign in here</a>.</p>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

    <!-- Footer section -->
    <?php include '../Views/footer.php'; ?>

 
