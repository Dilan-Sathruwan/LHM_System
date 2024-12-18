<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>login</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Roboto:wght@500;700&display=swap"
        rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">


    <!-- Customized Bootstrap Stylesheet -->
    <link href="./assets/css/bootstrap.min.css" rel="stylesheet">


    <style>
        /* Made with love by Mutiullah Samim*/

        @import url('https://fonts.googleapis.com/css?family=Numans');


        html,
        body {
            /* background-image: url('http://getwallpapers.com/wallpaper/full/a/5/d/544750.jpg'); */
            background-image: url('./assets/img/hnd1.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            height: 100%;
            font-family: 'Numans', sans-serif;
        }

        .container-fluid {
            height: 100%;
            align-content: center;
        }

        .bg-color-fram {
            background-color: #0B0B45;
        }

        .bg-color-btn {
            background-color: #CB0000;
        }

        /* Style for the message div */
        .message-popup {
            opacity: 0;
            position: fixed;
            cursor: default;
            top: 20px;
            left: 50%;
            transform: translateX(-50%) translateY(-30px);
            z-index: 2000;
            font-size: 20px;
            padding: 16px;
            color: green;
            font-weight: 200;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            /* Optional: add shadow */
            transition: opacity 0.5s ease, transform 0.5s ease;
            /* Transition for fade-in/fade-out */
        }

        .show-message {
            opacity: 1;
            transform: translateX(-50%) translateY(0);
            /* Move down to its original position */
        }
    </style>

</head>

<body>

    <!-- Massage show -->
    <div id="messagePopup" class="alert alert-success message-popup">
        <i class="bi bi-check-square-fill">&nbsp;</i>
        <span id="messageText"></span>
    </div>
    <!--Massage End -->

    <script>
        function getQueryParam(param) {
            let params = new URLSearchParams(window.location.search);
            return params.get(param);
        }
        // Function to remove the message parameter from the URL
        function removeQueryParam(param) {
            let url = new URL(window.location);
            url.searchParams.delete(param);
            window.history.replaceState({}, document.title, url.pathname); // Update the URL without reloading
        }
        // Function to show the message after the page has loaded
        window.onload = function() {
            let message = getQueryParam('message');
            if (message) {
                let messagePopup = document.getElementById('messagePopup');
                let messageText = document.getElementById('messageText');
                messageText.textContent = decodeURIComponent(message); // Show the message text


                messagePopup.classList.add('show-message'); // Add class to trigger fade-in

                // Remove the message parameter from the URL
                removeQueryParam('message');

                setTimeout(() => {
                    messagePopup.classList.remove('show-message'); // Remove class to trigger fade-out
                }, 3000);
            }
        };
    </script>

    <!-- Sign In Start -->
    <div class="container-fluid">

        <div class="row h-100 align-items-center justify-content-center" style="min-height: 100vh;">


            <div class="col-12 col-sm-8 col-md-6 col-lg-5 col-xl-4 ">
                <ul class="nav nav-pills mb-3 align-items-center justify-content-center p-2 bg-color-fram rounded mx-3"
                    id="pills-tab" role="tablist">
                    <li class="nav-item " role="presentation">
                        <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill"
                            data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home"
                            aria-selected="true">Student</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill"
                            data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile"
                            aria-selected="false">Lecture</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill"
                            data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact"
                            aria-selected="false">Admin</button>
                    </li>
                </ul>



                <div class="tab-content " id="pills-tabContent ">

                    <!-- ####################Student login################### -->
                    <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                        <div class="rounded p-4 p-sm-5 my-4 mx-3 bg-color-fram bg-gradient ">
                            <form action="./include/Login_student.php" method="POST">
                                <div class="d-flex align-items-center justify-content-between mb-3">
                                    <h3>Student Login</h3>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="email" name="email" class="form-control" id="floatingInput"
                                        placeholder="name@example.com" required>
                                    <label for="floatingInput">Email address</label>
                                </div>
                                <div class="form-floating mb-4">
                                    <input type="password" name="password" class="form-control" id="floatingPassword"
                                        placeholder="Password" required>
                                    <label for="floatingPassword">Index Number</label>
                                </div>
                                <div class="d-flex align-items-center justify-content-between mb-4">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="exampleCheck1" onclick="togglePasswordVisibility('floatingPassword')">
                                        <label class="form-check-label" for="exampleCheck1">Visible index number</label>
                                    </div>
                                </div>
                                <button type="submit" name="Ssubmit" class="btn btn-primary py-3 w-100 mb-4">Sign In</button>
                                <p class="text-center mb-0">Lecture Hall Management System</p>
                            </form>
                        </div>
                    </div>

                    <script>
                        function togglePasswordVisibility(passwordFieldId) {
                            const passwordField = document.getElementById(passwordFieldId);
                            if (passwordField.type === "password") {
                                passwordField.type = "text";
                            } else {
                                passwordField.type = "password";
                            }
                        }
                    </script>

                    <!--End-->



                    <!-- ####################Lecture login################### -->

                    <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                        <div class="bg-color-fram rounded p-4 p-sm-5 my-4 mx-3">

                            <form action="./include/Login_lecture.php" method="POST">
                                <div class="d-flex align-items-center justify-content-between mb-3">

                                    <h3>Lectures Sign In</h3>
                                </div>
                                <!-- <input type="hidden" name="role" value="lecturer"> -->
                                <div class="form-floating mb-3">
                                    <input type="email" name="email" class="form-control" id="floatingInput"
                                        placeholder="name@example.com " required>
                                    <label for="floatingInput">Email address</label>
                                </div>
                                <div class="form-floating mb-4">
                                    <input type="password" name="password" class="form-control" id="floatingPassword1"
                                        placeholder="Password" required>
                                    <label for="floatingPassword">Password</label>
                                </div>
                                <div class="d-flex align-items-center justify-content-between mb-4">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="exampleCheck1" onclick="togglePasswordVisibility('floatingPassword1')">
                                        <label class="form-check-label" for="exampleCheck1">Show password</label>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary py-3 w-100 mb-4" name="Lsubmit">Sign In</button>
                                <p class="text-center mb-0">Don't have an Account? <a href="./register.php">Sign Up</a></p>
                            </form>

                        </div>
                    </div>

                    <!--End-->


                    <!-- ####################Admin login################### -->

                    <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                        <div class="bg-color-fram rounded p-4 p-sm-5 my-4 mx-3">

                            <form action="./include/Login_Admin.php" method="POST">
                                <div class="d-flex align-items-center justify-content-between mb-3">
                                    <h3>Admin Sign In</h3>
                                </div>
                                <!-- <input type="hidden" name="role" value="admin"> -->
                                <div class="form-floating mb-3">
                                    <input type="email" name="email" class="form-control" id="floatingInput"
                                        placeholder="name@example.com" required>
                                    <label for="floatingInput">Email address</label>
                                </div>
                                <div class="form-floating mb-4">
                                    <input type="password" name="password" class="form-control" id="floatingPassword2"
                                        placeholder="Password" required>
                                    <label for="floatingPassword">Password</label>
                                </div>
                                <div class="d-flex align-items-center justify-content-between mb-4">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="exampleCheck1" onclick="togglePasswordVisibility('floatingPassword2')">
                                        <label class="form-check-label" for="exampleCheck1">Show password</label>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary py-3 w-100 mb-4" name="Asubmit">Sign In</button>
                                <p class="text-center mb-0">Lecture Hall Management System </p>
                            </form>

                        </div>
                    </div>

                    <!--End-->
                </div>

            </div>
        </div>
    </div>
    <!-- Sign In End -->
    </div>

</body>
<script src="./assets/vendor/bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js"></script>

</html>