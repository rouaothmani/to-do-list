<?php
include 'db.php';
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($conn->real_escape_string($_POST['username']));
    $password = $_POST['password'];
    $confirm_password = $_POST['password1'];
    
    if ($password !== $confirm_password) {
        die("<script>alert('Passwords do not match'); window.location.href='forgot.php';</script>");
    }
    
    $check_sql = "SELECT username FROM users WHERE username = '$username'";
    if (!$conn->query($check_sql)->num_rows) {
        die("<script>alert('Username not found in database'); window.location.href='forgot.php';</script>");
    }

    $update_sql = "UPDATE users SET password = '$password' WHERE username = '$username'";
    
    if ($conn->query($update_sql)) {
        if (isset($_SESSION['username']) && $_SESSION['username'] === $username) {
            $_SESSION['password'] = $password;
        }
        
        echo "<script>alert('Password updated successfully!'); window.location.href='site.php';</script>";
        exit();
    } else {
        die("<script>alert('Error updating password'); window.location.href='forgot.php';</script>");
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Reset Password | Productivity App</title>
  <!-- Bootstrap 5 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;700&family=Montserrat:wght@300;400;500&display=swap" rel="stylesheet">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <style>
    :root {
      --primary-color: #dba49b;
      --primary-light: #e6c9c1;
      --text-light: #f8f5f2;
      --text-dark: #57403d;
      --accent-color: #b6938d;
      --border-radius: 12px;
      --error-color: #e53e3e;
    }
    
    body {
      font-family: 'Montserrat', sans-serif;
      background-color: #f8f5f2;
      min-height: 100vh;
      display: flex;
      align-items: center;
      position: relative;
      overflow: hidden;
    }
    
    .reset-container {
      background: white;
      border-radius: var(--border-radius);
      box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
      padding: 2.5rem;
      width: 100%;
      max-width: 450px;
      margin: 0 auto;
      position: relative;
      z-index: 10;
    }
    
    .reset-container::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 8px;
      background: linear-gradient(90deg, var(--primary-light), var(--primary-color));
      border-top-left-radius: var(--border-radius);
      border-top-right-radius: var(--border-radius);
    }
    
    .logo {
      width: 30px;
      margin-bottom: 1.5rem;
      transition: transform 0.3s ease;
    }
    
    .logo:hover {
      transform: rotate(-15deg);
    }
    
    .reset-title {
      font-family: 'Playfair Display', serif;
      color: var(--primary-color);
      font-weight: 700;
      margin-bottom: 2rem;
      text-align: center;
    }
    
    .sparkle {
      color: var(--text-dark);
      opacity: 0.7;
      margin: 0 8px;
    }
    
    .form-control {
      border-radius: 50px;
      padding: 0.75rem 1.5rem;
      border: 1px solid #e2e8f0;
      margin-bottom: 1.25rem;
      transition: all 0.3s ease;
    }
    
    .form-control:focus {
      border-color: var(--primary-color);
      box-shadow: 0 0 0 0.25rem rgba(219, 164, 155, 0.25);
    }
    
    .btn-reset {
      background-color: var(--text-dark);
      color: white;
      border: none;
      border-radius: 50px;
      padding: 0.75rem;
      width: 100%;
      font-weight: 500;
      transition: all 0.3s ease;
      margin-top: 0.5rem;
    }
    
    .btn-reset:hover {
      background-color: var(--primary-color);
      transform: translateY(-3px);
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }
    
    .error-message {
      color: var(--error-color);
      text-align: center;
      margin-bottom: 1.5rem;
      font-weight: 500;
    }
    
    /* Password strength indicator */
    .password-strength {
      height: 4px;
      background: #e2e8f0;
      border-radius: 2px;
      margin-bottom: 1.25rem;
      overflow: hidden;
    }
    
    .strength-meter {
      height: 100%;
      width: 0;
      transition: width 0.3s ease, background 0.3s ease;
    }
    
    /* Decorative elements */
    .circle-decoration {
      position: absolute;
      border-radius: 50%;
      background: radial-gradient(circle, rgba(219,164,155,0.1) 0%, rgba(219,164,155,0) 70%);
      z-index: 0;
    }
    
    .circle-1 {
      width: 300px;
      height: 300px;
      top: -100px;
      right: -100px;
    }
    
    .circle-2 {
      width: 200px;
      height: 200px;
      bottom: -50px;
      left: -50px;
    }
    
    /* Dot network animation */
    .dot-network {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      z-index: -1;
      clip-path: polygon(0 20px, 100% 20px, 100% 100%, 0 100%);
    }
    
    .dot {
      position: absolute;
      width: 2px;
      height: 2px;
      background: #c5b8b5;
      border-radius: 50%;
      animation: float 15s infinite linear;
    }
    
    .line {
      position: absolute;
      height: 1px;
      background: #c5b8b5;
      transform-origin: left center;
      animation: fade 5s infinite alternate;
    }
    
    @keyframes float {
      100% {
          transform: translateY(-100vh) translateX(20px);
      }
    }
    
    @keyframes fade {
      0% { opacity: 0; }
      100% { opacity: 1; }
    }
  </style>
</head>
<body>
  <!-- Decorative elements -->
  <div class="circle-decoration circle-1"></div>
  <div class="circle-decoration circle-2"></div>
  
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8 col-lg-6">
        <div class="reset-container">
          <a href="index.php">
            <img src="../php/img/l.png" alt="Logo" class="logo">
          </a>
          
          <h2 class="reset-title">
            <span class="sparkle">✦</span>
            Reset Password
            <span class="sparkle">✦</span>
          </h2>
          
          <?php if (isset($_GET['error'])): ?>
            <div class="error-message">
              <?php echo htmlspecialchars($_GET['error']); ?>
            </div>
          <?php endif; ?>
          
          <form action="forgot.php" method="POST">
            <div class="mb-3">
              <input type="text" class="form-control" name="username" placeholder="Username" required>
            </div>
            <div class="mb-3">
              <input type="password" class="form-control" name="password" placeholder="New Password" required minlength="8" id="password">
            </div>
            <div class="mb-3">
              <input type="password" class="form-control" name="password1" placeholder="Confirm Password" required minlength="8">
            </div>
            
            <button type="submit" class="btn btn-reset">
              <i class="fas fa-key me-2"></i>Update Password
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>
  
  <div class="dot-network" id="dotNetwork"></div>
  
  <!-- Bootstrap JS Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="script.js"></script>
</body>
</html>