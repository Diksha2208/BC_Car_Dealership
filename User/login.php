<?php
require_once "user.php";
require_once "dbconfig.php";

// Initialize the session
session_start();

// If the current user is already logged in, redirect to the home page
$user = new User;
if (isset($_SESSION['user'])) {
  $user = unserialize($_SESSION['user']);
}

if ($user->isSignedIn()) {
  header("location: index.php");
  exit;
}

$username = $password = "";
$error_message = "";

// Handle login form data
if ($_SERVER["REQUEST_METHOD"] == "POST") {

  if (empty(trim($_POST["username"]))) {
    $error_message = "Please enter user name";
  } else {
    $username = trim($_POST["username"]);
  }

  if (empty(trim($_POST["password"]))) {
    $error_message = "Please enter your password";
  } else {
    $password = trim($_POST["password"]);
  }

  // Validate credential
  if (empty($error_message)) {
    $sql = "SELECT `id`, `password` FROM `User` WHERE username = ?";

    if ($stmt = mysqli_prepare($conn, $sql)) {
      // Bind variables to prepare statement
      mysqli_stmt_bind_param($stmt, "s", $username);

      // Execute the prepared statement
      if (mysqli_stmt_execute($stmt)) {
        // Store result
        mysqli_stmt_store_result($stmt);

        if (mysqli_stmt_num_rows($stmt) == 1) {
          mysqli_stmt_bind_result($stmt, $id, $hashed_password);

          if (mysqli_stmt_fetch($stmt) && password_verify($password, $hashed_password)) {
            session_start();

            // Initialize user information
            $user->id = $id;
            $user->username = $username;
            $user->isSignedIn = true;

            // Initialize session variables
            $_SESSION['user'] = serialize($user);

              header("location: ../Views/index.php");            
              
                    
          }
        } else {
          $username_error = "Invalid username or password.";
        }
      

      mysqli_stmt_close($stmt);
    }
     else {
            $username_error = "Invalid username or password.";
      }
  }
  }
  // Close connection
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
            <h3 class="card-title text-center mb-4"> Login </h3>
   
            <form action= "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"> 
              <div class="mb-3">       
                <label for="uname"><b>Username</b></label>
                <input type="text" placeholder="Enter Username" name="username" >
              </div>
              <div class="mb-3">
                <label for="psw"><b>Password</b></label>
                <input type="password" placeholder="Enter Password" name="password"> 
              </div>
              <button type="submit"  class="btn btn-primary" >Login</button>
            
              <p>New to Car Company? <a href="./register.php"> Register Now </a></p>    
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

    <!-- Footer section -->
    <?php include '../Views/footer.php'; ?>

