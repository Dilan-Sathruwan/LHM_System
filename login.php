 


<!DOCTYPE html>
<html lang="en">
  <head>
    <title>LHM login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      rel="stylesheet"
      href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
    />
    <link rel="stylesheet" href="./assets/css/style.css" />
  </head>

  <body>
    <div class="background"></div>
    <!-- LOGIN FORM MAIN -->

    <div
      class="container d-flex justify-content-center align-items-center min-vh-100"
    >
      <div class="mainlog border row w-100">
        <div class="text-center col-md-5">
          <h2 class="logo">
            <img src="./assets/img/Icon/tux.png" alt="Logo" class="img-fluid" />SLIATE
          </h2>
          <div class="text-item">
            <h2>Welcome! <br /><span>LHM System</span></h2>
            <p>
              Lorem ipsum dolor sit amet consectetur adipisicing elit. Odit,
              repellendus?
            </p>
          </div>
        </div>
        <div class="col-md-7">
          <div class="login-section">
            <div class="form-box login">
              <form action="">
                <h2>I am a,</h2>
                <a href="#loginAdmin" class="mb-2 d-block">
                  <button
                    type="button"
                    class="btn btn-primary btn-block"
                    onclick="showForm('admin')"
                  >
                    Admin
                  </button>
                </a>

                <a href="#loginStudent" class="mb-2 d-block">
                  <button
                    type="button"
                    class="btn btn-secondary btn-block"
                    onclick="showForm('student')"
                  >
                    Student
                  </button>
                </a>
                <a href="#loginLecturer" class="mb-2 d-block">
                  <button
                    type="button"
                    class="btn btn-success btn-block"
                    onclick="showForm('lecturer')"
                  >
                    Lecturer
                  </button>
                </a>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- LOGIN FORM ADMIN -->
    <div id="loginAdmin" class="d-none">
      <div class="background"></div>
      <div
        class="container d-flex align-items-center min-vh-100 d-none"
        id="admin-login"
      >
        <div class="mainlog row w-100">
          <div class="text-center col-md-5">
            <h2 class="logo">
              <img src="./assets/img/Icon/tux.png" alt="Logo" class="img-fluid" />SLIATE
            </h2>
            <div class="text-item">
              <h2>Welcome! <br /><span>LHM System</span></h2>
              <p>
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Odit,
                repellendus?
              </p>
            </div>
          </div>
          <div class="col-md-7">
            <div class="login-section">
              <div class="login2">
                <div class="form-box login">
                  <form action="">
                    <h2>Admin Sign In</h2>
                    <div class="input-box form-group">
                      <input type="email" required />
                      <label for="">Email</label>
                    </div>
                    <div class="input-box form-group">
                      <input type="password" required />
                      <label for="">Password</label>
                    </div>
                    <div
                      class="remember-password d-flex justify-content-between"
                    >
                      <label><input type="checkbox" /> Remember Me</label>
                      <a href="#">Forget Password</a>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">
                      Login In
                    </button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- LOGIN FORM STUDENT -->

    <div id="loginStudent" class="d-none">
      <div class="background"></div>
      <div
        class="container d-flex align-items-center min-vh-100 d-none"
        id="student-login"
      >
        <div class="mainlog row w-100">
          <div class="text-center col-md-5">
            <h2 class="logo">
              <img src="./assets/img/Icon/tux.png" alt="Logo" class="img-fluid" />SLIATE
            </h2>
            <div class="text-item">
              <h2>Welcome!<br /><span>LHM System</span></h2>
              <p>
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Odit,
                repellendus?
              </p>
            </div>
          </div>
          <div class="col-md-7">
            <div class="login-section">
              <div class="login2">
                <div class="form-box login">
                  <form action="" method = "post"p>
                    <h2>Student Sign In</h2>
                    <div class="input-box form-group">
                      <input type="email" required />
                      <label for="">Email</label>
                    </div>

                    <!-- Password -->
                    <div class="input-box form-group">
                      <input type="password" required />
                      <label for="">Password</label>
                    </div>

                    <!-- Remember Me -->
                    <div
                      class="remember-password d-flex justify-content-between"
                    >
                      <label><input type="checkbox" /> Remember Me</label>
                      <a href="#">Forget Password</a>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" name="submit_sutudent"  class="btn btn-primary btn-block">
                      Login In
                    </button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- LOGIN FORM LECTURER -->
    <div id="loginLecturer" class="d-none">
      <div class="background"></div>
      <div
        class="container d-flex align-items-center min-vh-100 d-none"
        id="lecturer-login"
      >
        <div class="mainlog row w-100">
          <div class="text-center col-md-5">
            <h2 class="logo">
              <img src="./assets/img/Icon/tux.png" alt="Logo" class="img-fluid" />SLIATE
            </h2>
            <div class="text-item">
              <h2>Welcome!<br /><span>LHM System</span></h2>
              <p>
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Odit,
                repellendus?
              </p>
            </div>
          </div>
          <div class="col-md-7">
            <div class="login-section">
              <div class="login2">
                <div class="form-box login">
                  <form action="./includes/login.inc.php">
                    <h2>Lecturer Sign In</h2>

                    <!-- Email -->
                    <div class="input-box form-group">
                      <input type="email" name="email" required />
                      <label for="">Email</label>
                    </div>

                    <!-- Password -->
                    <div class="input-box form-group">
                      <input type="password" name="pwd" required />
                      <label for="">Password</label>
                    </div>

                    <!-- Remember Me -->
                    <div
                      class="remember-password d-flex justify-content-between"
                    >
                      <label><input type="checkbox" /> Remember Me</label>
                      <a href="#">Forget Password</a>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-primary btn-block">
                      Login In
                    </button>

                    <!-- Sign Up Link -->
                    <div class="create-account">
                      <p>Create A New Account? <a href="register.php">Sign Up</a></p>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script src="./assets/js/login.js"></script>
  </body>
</html>
