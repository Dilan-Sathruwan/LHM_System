<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link
      rel="stylesheet"
      href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
    />
    <link rel="stylesheet" href="./assets/css/register.css" />
  </head>
  <body>
    <!-- REGISTRATION FORM LECTURER -->
    <div class="background"></div>
    <div
      class="container d-flex align-items-center min-vh-100 d-none"
      id="lecturer-register"
    >
      <div class="mainlog row w-100 ">
        <div class="text-center col-md-5  welcome">
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
        <div class="col-md-7  ">
          <div class="">
            <div class="login2">
              <div class="form-box register ">
                <form action="">
                  <h2>Lecturer Sign Up</h2>

                  <div class="col-12">
                    <div class="form-floating mb-2">
                      <label for="fullName" class="form-label text-white">Full Name</label>
                      <input
                        type="text"
                        class="form-control"
                        name="fullName"
                        id="fullName"
                        placeholder="Full Name"
                        required
                      />
                    </div>
                  </div>
                  <div class="col-12">
                    <div class="form-floating mb-1">
                      <label for="nic" class="form-label text-white">NIC</label>
                      <input
                        type="text"
                        class="form-control"
                        name="nic"
                        id="nic"
                        placeholder="NIC"
                        required
                      />
                    </div>
                  </div>
                  <div class="col-12">
                    <div class="form-floating mb-1">
                      <label for="email" class="form-label text-white">Email</label>
                      <input
                        type="email"
                        class="form-control"
                        name="email"
                        id="email"
                        placeholder="name@example.com"
                        required
                      />
                    </div>
                  </div>
                  <div class="col-12">
                    <div class="form-floating mb-1">
                      <label for="address" class="form-label text-white">Address</label>
                      <input
                        type="text"
                        class="form-control"
                        name="address"
                        id="address"
                        placeholder="Address"
                        required
                      />
                    </div>
                  </div>
                  <div class="col-12">
                    <div class="form-floating mb-1">
                      <label for="telephone" class="form-label text-white"
                        >Phone Number</label
                      >
                      <input
                        type="text"
                        class="form-control"
                        name="telephone"
                        id="telephone"
                        placeholder="Enter Phone Number"
                        required
                      />
                    </div>
                  </div>
                  <div class="col-12">
                    <div class="form-floating mb-1">
                      <label for="password" class="form-label text-white">Password</label>
                      <input
                        type="password"
                        class="form-control"
                        name="password"
                        id="password"
                        value=""
                        placeholder="Password"
                        required
                      />

                      <input
                        type="password"
                        class="form-control mt-2"
                        name="password"
                        id="password"
                        value=""
                        placeholder="Confirm Password"
                        required
                      />
                    </div>
                  </div>
                  <div class="col-12 ">
                    <div class="form-check">
                      <input
                        class="form-check-input"
                        type="checkbox"
                        value=""
                        name="iAgree"
                        id="iAgree"
                        required
                      />
                      <label
                        class="form-check-label text-white"
                        for="iAgree"
                      >
                        I agree to the
                        <a href="#!" class="link-primary text-decoration-none"
                          >terms and conditions</a
                        >
                      </label>
                    </div>
                  </div>
                  <div class="col-12 ">
                  <div class="d-flex  justify-content-between align-items-center">
                      <button class="btn btn-dark btn-lg" type="submit">
                        Sign up
                      </button>
                      <p class="text-white">
                 Already have an account? <a href="./login.php">sign in</a>
                 </p>
                    </div>
                  </div>

             
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
