function editLecture(id) {
    // Redirect to edit lecture page or show edit modal
    alert(`Edit lecture with ID: ${id}`);
}

function deleteLecture(id) {
    if (confirm("Are you sure you want to delete this lecture?")) {
        // Perform deletion operation
        alert(`Lecture with ID: ${id} deleted.`);
    }
}

function submitAttendance() {
    // Gather attendance data and submit to the server
    alert("Attendance submitted!");
}
