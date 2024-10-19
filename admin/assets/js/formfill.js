// ################student update

document.querySelectorAll('[data-bs-target="#studentcreate"]').forEach(function(button) {
    button.addEventListener('click', function() {
        const id = this.getAttribute('data-id');
        const index_number = this.getAttribute('data-index_number');
        const username = this.getAttribute('data-username');
        const email = this.getAttribute('data-email');
        const mobile_num = this.getAttribute('data-mobile_num');
        const batch_id = this.getAttribute('data-batch_id');
        const address = this.getAttribute('data-address');
        const department_id = this.getAttribute('data-department_id');
        const re_date = this.getAttribute('data-re_date');

        // Populate the form fields with the selected lecturer's data
        document.getElementById('student_id').value = id;
        document.getElementById('Index_Num').value = index_number;
        document.getElementById('Student_name').value = username;
        document.getElementById('email').value = email;
        document.getElementById('Mobile_num').value = mobile_num;
        document.getElementById('address').value = address;
        document.getElementById('department_id').value = department_id;
        document.getElementById('batch_id').value = batch_id;
    });
});






// ##########lecturers update and view 

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
        var profileImage = modal.querySelector('.profile-image-pic');
        if (image_path) {
            profileImage.src = './include/' + image_path; // Use the correct path for your images
        } else {
            profileImage.src = 'https://cdn.pixabay.com/photo/2016/03/31/19/56/avatar-1295397__340.png'; // Default image
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
        } else {
            profileImage.src = 'https://cdn.pixabay.com/photo/2016/03/31/19/56/avatar-1295397__340.png'; // Default image
        }
    });

});