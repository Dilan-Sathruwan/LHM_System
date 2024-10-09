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

document.addEventListener('DOMContentLoaded', function() {

    // Function to pre-fill the form when edit button is clicked
    document.querySelectorAll('[data-bs-target="#Lecturecreate"]').forEach(function(button) {
        button.addEventListener('click', function() {
            const id = this.getAttribute('data-id');
            const index_number = this.getAttribute('data-index_number');
            const username = this.getAttribute('data-username');
            const email = this.getAttribute('data-email');
            const about = this.getAttribute('data-about');
            const address = this.getAttribute('data-address');
            const mobile_no = this.getAttribute('data-mobile_no');
            const lecturerole = this.getAttribute('data-lecturerole');
            const inputPassword = this.getAttribute('data-inputPassword');

            // Populate the form fields with the selected lecturer's data
            document.getElementById('lecturer-id').value = id;
            document.getElementById('Index_num').value = index_number;
            document.getElementById('username').value = username;
            document.getElementById('email').value = email;
            document.getElementById('phonenumber').value = mobile_no;
            document.getElementById('address').value = address;
            document.getElementById('lecturerole').value = lecturerole;
            document.getElementById('about').value = about;
            document.getElementById('inputPassword').value = inputPassword;
        });
    });

    // Function to pre-fill the LectureView form when view button is clicked
    document.querySelectorAll('[data-bs-target="#LectureView"]').forEach(function(button) {
        button.addEventListener('click', function() {
            const id1 = this.getAttribute('data-id');
            const index_number1 = this.getAttribute('data-index_number');
            const username1 = this.getAttribute('data-username');
            const email1 = this.getAttribute('data-email');
            const about1 = this.getAttribute('data-about');
            const address1 = this.getAttribute('data-address');
            const mobile_no1 = this.getAttribute('data-mobile_no');
            const lecturerole1 = this.getAttribute('data-lecturerole');

            // Populate the form fields with the selected lecturer's data
            document.getElementById('view-Index_num').value = index_number1;
            document.getElementById('view-username').value = username1;
            document.getElementById('view-email').value = email1;
            document.getElementById('view-phonenumber').value = mobile_no1;
            document.getElementById('view-address').value = address1;
            document.getElementById('view-lecturerole').value = lecturerole1;
            document.getElementById('view-about').value = about1;
        });
    });

});