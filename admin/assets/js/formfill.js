// ################student update

// Function to populate the modal with the student's data
document.addEventListener('DOMContentLoaded', function () {
    // Event listener for when the modal is triggered
    var StudentCreateModal = document.getElementById('studentcreate');
    var StudentViewModal = document.getElementById('studentView');

    StudentCreateModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget; // Button that triggered the modal

        // Extract info from data-* attributes
        var id = button.getAttribute('data-id');
        var index_number = button.getAttribute('data-index_number');
        var username = button.getAttribute('data-username');
        var email = button.getAttribute('data-email');
        var mobile_num = button.getAttribute('data-mobile_num');
        var batch_id = button.getAttribute('data-batch_id');
        var address = button.getAttribute('data-address');
        var department_id = button.getAttribute('data-department_id');
        var re_date = button.getAttribute('data-re_date');
        var image_path = button.getAttribute('data-image_path'); // Get image path

        // Populate the form fields
        var modal = StudentCreateModal;
        modal.querySelector('#student_id').value = id;
        modal.querySelector('#Index_Num').value = index_number;
        modal.querySelector('#Student_name').value = username;
        modal.querySelector('#email').value = email;
        modal.querySelector('#Mobile_num').value = mobile_num;
        modal.querySelector('#address').value = address;
        modal.querySelector('#department_id').value = department_id;
        modal.querySelector('#batch_id').value = batch_id;

        // Update the image preview
        var profileImage = modal.querySelector('.profile-image-pic'); // Change to the correct class or ID for the image
        if (image_path) {
            profileImage.src = './include/' + image_path; // Use the correct path for your images

            // Set the onerror fallback to default image if the image path is not valid
            profileImage.onerror = function () {
                this.src = './include/uploads/pngwing.com.png'; // Default image
            };
        } else {
            // If no image_path provided, set default image directly
            profileImage.src = './include/uploads/pngwing.com.png'; // Default image
        }
    });

    StudentViewModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget; // Button that triggered the modal

        var id = button.getAttribute('data-id');
        var index_number = button.getAttribute('data-index_number');
        var student_name = button.getAttribute('data-username');
        var email = button.getAttribute('data-email');
        var mobile_num = button.getAttribute('data-mobile_num');
        var address = button.getAttribute('data-address');
        var department_id = button.getAttribute('data-department_id');
        var batch_id = button.getAttribute('data-batch_id');
        var image_path = button.getAttribute('data-image_path'); // Get image path


        var modal = StudentViewModal;
        modal.querySelector('#view-student_id').value = id;
        modal.querySelector('#view-Index_Num').value = index_number;
        modal.querySelector('#view-Student_name').value = student_name;
        modal.querySelector('#view-email').value = email;
        modal.querySelector('#view-Mobile_num').value = mobile_num;
        modal.querySelector('#view-address').value = address;
        modal.querySelector('#view-department_id').value = department_id;
        modal.querySelector('#view-batch_id').value = batch_id;

        var profileImage = modal.querySelector('#view-student-profile-image');
        if (image_path) {
            profileImage.src = './include/' + image_path;

            profileImage.onerror = function () {
                this.src = './include/uploads/pngwing.com.png';
            };
        } else {
            profileImage.src = './include/uploads/pngwing.com.png';
        }
    });

});










// ##########lecturers update and view #################

// Function to populate the modal with the lecturer's data
document.addEventListener('DOMContentLoaded', function () {
    // Event listener for when the modal is triggered
    var LecturecreateModal = document.getElementById('Lecturecreate');
    var LectureViewModal = document.getElementById('LectureView');

    LecturecreateModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget; // Button that triggered the modal

        // Extract info from data-* attributes
        var id = button.getAttribute('data-id');
        var index_number = button.getAttribute('data-index_number');
        var username = button.getAttribute('data-username');
        var email = button.getAttribute('data-email');
        var about = button.getAttribute('data-about');
        var address = button.getAttribute('data-address');
        var mobile_no = button.getAttribute('data-mobile_no');
        var lecturerole = button.getAttribute('data-lecturerole');
        var password = button.getAttribute('data-inputPassword');
        var image_path = button.getAttribute('data-image_path'); // Get image path

        // Populate the form fields
        var modal = LecturecreateModal;
        modal.querySelector('#lecturer-id').value = id;
        modal.querySelector('#Index_num').value = index_number;
        modal.querySelector('#username').value = username;
        modal.querySelector('#email').value = email;
        modal.querySelector('#about').value = about;
        modal.querySelector('#address').value = address;
        modal.querySelector('#phonenumber').value = mobile_no;
        modal.querySelector('#lecturerole').value = lecturerole;
        modal.querySelector('#inputPassword').value = password;

        // Update the image preview
        // Update the image preview
        var profileImage = modal.querySelector('.profile-image-pic');
        if (image_path) {
            profileImage.src = './include/' + image_path; // Use the correct path for your images

            // Set the onerror fallback to default image if the image path is not valid
            profileImage.onerror = function () {
                this.src = './include/uploads/pngwing.com.png'; // Default image
            };
        } else {
            // If no image_path provided, set default image directly
            profileImage.src = './include/uploads/pngwing.com.png'; // Default image
        }

    });


    // Function to pre-fill the LectureView form when view button is clicked
    LectureViewModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget; // Button that triggered the modal

        // Extract info from data-* attributes
        var id = button.getAttribute('data-id');
        var index_number = button.getAttribute('data-index_number');
        var username = button.getAttribute('data-username');
        var email = button.getAttribute('data-email');
        var about = button.getAttribute('data-about');
        var address = button.getAttribute('data-address');
        var mobile_no = button.getAttribute('data-mobile_no');
        var lecturerole = button.getAttribute('data-lecturerole');
        var image_path = button.getAttribute('data-image_path'); // Get image path

        // Populate the form fields
        var modal = LectureViewModal;
        modal.querySelector('#view-Index_num').value = index_number;
        modal.querySelector('#view-username').value = username;
        modal.querySelector('#view-email').value = email;
        modal.querySelector('#view-about').value = about;
        modal.querySelector('#view-address').value = address;
        modal.querySelector('#view-phonenumber').value = mobile_no;
        modal.querySelector('#view-lecturerole').value = lecturerole;

        // Update the image preview
        var profileImage = modal.querySelector('#view-profile-image');
        if (image_path) {
            profileImage.src = './include/' + image_path; // Use the correct path for your images

            // Set the onerror fallback to default image if the image path is not valid
            profileImage.onerror = function () {
                this.src = './include/uploads/pngwing.com.png'; // Default image
            };
        } else {
            // If no image_path provided, set default image directly
            profileImage.src = './include/uploads/pngwing.com.png'; // Default image
        }
    });

});