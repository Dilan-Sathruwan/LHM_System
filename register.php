<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register & Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="./assets/css/register.css">
</head>
<body>
    <div class="container" id="signup" >
      <h1 class="form-title">Register</h1>
      <form method="post" action="include/signup.inc.php">
        <div class="input-group">
           <i class="fas fa-user"></i>
           <input type="text" name="id_num" id="fName" placeholder="First Name" required>
           <label for="fname">ID Number</label>
        </div>
        <div class="input-group">
            <i class="fas fa-user"></i>
            <input type="text" name="Name" id="lName" placeholder="User Name" required>
            <label for="lName">User Name</label>
        </div>
        <div class="input-group">
            <i class="fas fa-envelope"></i>
            <input type="email" name="email" id="email" placeholder="Email" required>
            <label for="email">Email</label>
        </div>
        <div class="input-group">
            <i class="fas fa-phone"></i>
            <input type="text" name="mNumber" id="mNumber" placeholder="Mobile number" required>
            <label for="mNumber">Mobile Number</label>
        </div>
        <div class="input-group">
            <i class="fas fa-home"></i>
            <input type="text" name="address" id="address" placeholder="Address" required>
            <label for="Address">Address</label>
        </div>
        <div class="input-group">
            <i class="fas fa-lock"></i>
            <input type="password" name="pwd" id="password" placeholder="Password" required>
            <label for="password">Password</label>
        </div>
        <div class="input-group">
            <i class="fas fa-lock"></i>
            <input type="password" name="pwdRepeat" id="password" placeholder="Password" required>
            <label for="password">Confirm Password</label>
        </div>
       <input type="submit" class="btn" value="Sign Up" name="signUp">
      </form>
      <div class="links">
        <p>Already Have Account ?</p>
        <a href="login.php"><button id="signInButton">Sign In</button></a>
      </div>
    </div>

</body>
</html>
