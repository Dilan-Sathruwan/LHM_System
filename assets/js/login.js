function showForm(role) {
  const lectureSection = document.getElementById("loginLecturer");
  const studentSection = document.getElementById("loginStudent");
  const adminSection = document.getElementById("loginAdmin");

  adminSection.classList.add("d-none");
  studentSection.classList.add("d-none");
  lectureSection.classList.add("d-none");

  if (role === "admin") {
    adminSection.classList.remove("d-none");
  } else if (role === "lecturer") {
    lectureSection.classList.remove("d-none");
  } else if (role === "student") {
    studentSection.classList.remove("d-none");
  }
}
