<?php include './include/header.php'; ?>

<!-- Content Start -->
<div class="content">
    <!-- Navbar Start -->
    <?php include './include/navbar.php'; ?>
    <!-- Navbar End -->






    <!-- Blank Start -->
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop1">
        Launch static backdrop modal1
    </button>

    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop1" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Modal title1</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- type here -->
                    <div class="container">
                        <form class="form-horizontal" role="form">
                            <h2>Registration</h2>
                            <div class="form-group">
                                <label for="firstName" class="col-sm-3 control-label">First Name</label>
                                <div class="col-sm-9">
                                    <input type="text" id="firstName" placeholder="First Name" class="form-control"
                                        autofocus>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="lastName" class="col-sm-3 control-label">Last Name</label>
                                <div class="col-sm-9">
                                    <input type="text" id="lastName" placeholder="Last Name" class="form-control"
                                        autofocus>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="email" class="col-sm-3 control-label">Email* </label>
                                <div class="col-sm-9">
                                    <input type="email" id="email" placeholder="Email" class="form-control"
                                        name="email">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="password" class="col-sm-3 control-label">Password*</label>
                                <div class="col-sm-9">
                                    <input type="password" id="password" placeholder="Password" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="password" class="col-sm-3 control-label">Confirm Password*</label>
                                <div class="col-sm-9">
                                    <input type="password" id="password" placeholder="Password" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="birthDate" class="col-sm-3 control-label">Date of Birth*</label>
                                <div class="col-sm-9">
                                    <input type="date" id="birthDate" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="phoneNumber" class="col-sm-3 control-label">Phone number </label>
                                <div class="col-sm-9">
                                    <input type="phoneNumber" id="phoneNumber" placeholder="Phone number"
                                        class="form-control">
                                    <span class="help-block">Your phone number won't be disclosed anywhere </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="Height" class="col-sm-3 control-label">Height* </label>
                                <div class="col-sm-9">
                                    <input type="number" id="height"
                                        placeholder="Please write your height in centimetres" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="weight" class="col-sm-3 control-label">Weight* </label>
                                <div class="col-sm-9">
                                    <input type="number" id="weight" placeholder="Please write your weight in kilograms"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-3">Gender</label>
                                <div class="col-sm-6">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="radio-inline">
                                                <input type="radio" id="femaleRadio" value="Female">Female
                                            </label>
                                        </div>
                                        <div class="col-sm-4">
                                            <label class="radio-inline">
                                                <input type="radio" id="maleRadio" value="Male">Male
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div> <!-- /.form-group -->
                            <div class="form-group">
                                <div class="col-sm-9 col-sm-offset-3">
                                    <span class="help-block">*Required fields</span>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">Register</button>
                        </form> <!-- /form -->
                    </div> <!-- ./container -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" form="myForm" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </div>
    </div>








    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
        Launch static backdrop modal
    </button>

    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Create Lecture profile</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- type here -->

                    <div class="container">
                        <div class="row">
                            <div class="justify-content-md-center">


                                <div class="card my-1">

                                    <form class="card-body cardbody-color p-lg-2">

                                        <div class="row g-3">

                                            <div class="text-center">
                                                <img src="https://cdn.pixabay.com/photo/2016/03/31/19/56/avatar-1295397__340.png"
                                                    class="img-fluid profile-image-pic img-thumbnail rounded-circle my-3"
                                                    width="200px" alt="profile">
                                            </div>

                                            <div class="col-sm-6">
                                                <label for="firstName" class="form-label">Lecture Name</label>
                                                <input type="text" class="form-control" id="Lecture Name" placeholder=""
                                                    value="" required>
                                                <div class="invalid-feedback">
                                                    Valid Lecture name is required.
                                                </div>
                                            </div>

                                            <div class="col-sm-6">
                                                <label for="password" class="form-label">Password</label>
                                                <input type="password" class="form-control" id="inputPassword3">
                                                <div class="invalid-feedback">
                                                    Valid password is required.
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <label for="username" class="form-label">Username</label>
                                                <div class="input-group has-validation">
                                                    <input type="text" class="form-control" id="username"
                                                        placeholder="Username" required>
                                                    <div class="invalid-feedback">
                                                        Your username is required.
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <label for="email" class="form-label">Email </label>
                                                <input type="email" class="form-control" id="email"
                                                    placeholder="you@example.com">
                                                <div class="invalid-feedback">
                                                    Please enter a valid email address.
                                                </div>
                                            </div>


                                            <div class="col-sm-6">
                                                <label for="number" class="form-label">Mobile Number</label>
                                                <input type="number" class="form-control" id="inputnumber">
                                                <div class="invalid-feedback">
                                                    Valid Mobile Number is required.
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <label for="address" class="form-label">Address</label>
                                                <input type="text" class="form-control" id="address"
                                                    placeholder="1234, Main St,kegalle" required>
                                                <div class="invalid-feedback">
                                                    Please enter your address.
                                                </div>
                                            </div>

                                            <div class="col-sm-6">
                                                <label for="Lecturerole" class="form-label">Lecture Roles</label>
                                                <select class="form-select" id="lecturerole" required>
                                                    <option value="">Choose...</option>
                                                    <option>Part time Lecture</option>
                                                    <option>Visiting Lecture</option>
                                                    <option>Permernet Lecture</option>
                                                </select>
                                                <div class="invalid-feedback">
                                                    Please select a valid Roles.
                                                </div>
                                            </div>


                                            <div class="mb-3">
                                                <label for="exampleFormControlTextarea1" class="form-label">About
                                                    Lecture</label>
                                                <textarea class="form-control" id="exampleFormControlTextarea1"
                                                    rows="3"></textarea>
                                            </div>

                                            <div class="col-12">
                                                <button type="submit" class="btn btn-primary">Sign in</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>






    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop2">
        Launch static backdrop modal11
    </button>

    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop2" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Modal title 2</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- type here -->
                    <!-- Registration 3 - Bootstrap Brain Component -->
                    <section class="p-3 p-md-4 p-xl-5">
                        <div class="container">
                            <div class="row">
                                <div class="col-12 col-md-6 bsb-tpl-bg-platinum">
                                    <div class="d-flex flex-column justify-content-between h-100 p-3 p-md-4 p-xl-5">
                                        <h3 class="m-0">Welcome!</h3>
                                        <img class="img-fluid rounded mx-auto my-4" loading="lazy"
                                            src="./assets/img/bsb-logo.svg" width="245" height="80"
                                            alt="BootstrapBrain Logo">
                                        <p class="mb-0">Not a member yet? <a href="#!"
                                                class="link-secondary text-decoration-none">Register now</a></p>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 bsb-tpl-bg-lotion">
                                    <div class="p-3 p-md-4 p-xl-5">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="mb-5">
                                                    <h2 class="h3">Registration</h2>
                                                    <h3 class="fs-6 fw-normal text-secondary m-0">Enter your details to
                                                        register</h3>
                                                </div>
                                            </div>
                                        </div>
                                        <form action="#!">
                                            <div class="row gy-3 gy-md-4 overflow-hidden">
                                                <div class="col-12">
                                                    <label for="firstName" class="form-label">First Name <span
                                                            class="text-danger">*</span></label>
                                                    <input type="email" class="form-control" name="firstName"
                                                        id="firstName" placeholder="First Name" required>
                                                </div>
                                                <div class="col-12">
                                                    <label for="lastName" class="form-label">Last Name <span
                                                            class="text-danger">*</span></label>
                                                    <input type="email" class="form-control" name="lastName"
                                                        id="lastName" placeholder="Last Name" required>
                                                </div>
                                                <div class="col-12">
                                                    <label for="email" class="form-label">Email <span
                                                            class="text-danger">*</span></label>
                                                    <input type="email" class="form-control" name="email" id="email"
                                                        placeholder="name@example.com" required>
                                                </div>
                                                <div class="col-12">
                                                    <label for="password" class="form-label">Password <span
                                                            class="text-danger">*</span></label>
                                                    <input type="password" class="form-control" name="password"
                                                        id="password" value="" required>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            name="iAgree" id="iAgree" required>
                                                        <label class="form-check-label text-secondary" for="iAgree">
                                                            I agree to the <a href="#!"
                                                                class="link-primary text-decoration-none">terms and
                                                                conditions</a>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="d-grid">
                                                        <button class="btn bsb-btn-xl btn-primary" type="submit">Sign
                                                            up</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                        <div class="row">
                                            <div class="col-12">
                                                <hr class="mt-5 mb-4 border-secondary-subtle">
                                                <p class="m-0 text-secondary text-end">Already have an account? <a
                                                        href="#!" class="link-primary text-decoration-none">Sign in</a>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <p class="mt-5 mb-4">Or sign in with</p>
                                                <div class="d-flex gap-3 flex-column flex-xl-row">
                                                    <a href="#!" class="btn bsb-btn-xl btn-outline-primary">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                            fill="currentColor" class="bi bi-google"
                                                            viewBox="0 0 16 16">
                                                            <path
                                                                d="M15.545 6.558a9.42 9.42 0 0 1 .139 1.626c0 2.434-.87 4.492-2.384 5.885h.002C11.978 15.292 10.158 16 8 16A8 8 0 1 1 8 0a7.689 7.689 0 0 1 5.352 2.082l-2.284 2.284A4.347 4.347 0 0 0 8 3.166c-2.087 0-3.86 1.408-4.492 3.304a4.792 4.792 0 0 0 0 3.063h.003c.635 1.893 2.405 3.301 4.492 3.301 1.078 0 2.004-.276 2.722-.764h-.003a3.702 3.702 0 0 0 1.599-2.431H8v-3.08h7.545z" />
                                                        </svg>
                                                        <span class="ms-2 fs-6">Google</span>
                                                    </a>
                                                    <a href="#!" class="btn bsb-btn-xl btn-outline-primary">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                            fill="currentColor" class="bi bi-facebook"
                                                            viewBox="0 0 16 16">
                                                            <path
                                                                d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z" />
                                                        </svg>
                                                        <span class="ms-2 fs-6">Facebook</span>
                                                    </a>
                                                    <a href="#!" class="btn bsb-btn-xl btn-outline-primary">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                            fill="currentColor" class="bi bi-twitter"
                                                            viewBox="0 0 16 16">
                                                            <path
                                                                d="M5.026 15c6.038 0 9.341-5.003 9.341-9.334 0-.14 0-.282-.006-.422A6.685 6.685 0 0 0 16 3.542a6.658 6.658 0 0 1-1.889.518 3.301 3.301 0 0 0 1.447-1.817 6.533 6.533 0 0 1-2.087.793A3.286 3.286 0 0 0 7.875 6.03a9.325 9.325 0 0 1-6.767-3.429 3.289 3.289 0 0 0 1.018 4.382A3.323 3.323 0 0 1 .64 6.575v.045a3.288 3.288 0 0 0 2.632 3.218 3.203 3.203 0 0 1-.865.115 3.23 3.23 0 0 1-.614-.057 3.283 3.283 0 0 0 3.067 2.277A6.588 6.588 0 0 1 .78 13.58a6.32 6.32 0 0 1-.78-.045A9.344 9.344 0 0 0 5.026 15z" />
                                                        </svg>
                                                        <span class="ms-2 fs-6">Twitter</span>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>
    <!-- Blank End -->



</div>
<!-- Content End -->

<?php include './include/footer.php';?>