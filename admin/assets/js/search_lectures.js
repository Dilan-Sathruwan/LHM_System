const search_input = document.getElementById("search_student");
const outputEl = document.getElementById("output");

search_input.addEventListener("keyup", (e) => {
  console.log(e.target.value);

  const xhr = new XMLHttpRequest();
  xhr.open(
    "GET",
    `../../../../LHM_SYSTEM/admin/include/search.php?query=${e.target.value}`,
    true
  );

  xhr.onload = function () {
    if (this.status === 200) {
      const data = JSON.parse(this.responseText);
      console.log(data);

      // Clear previous output
      outputEl.innerHTML = "";

      // Check if any results were returned
      if (data.length > 0) {
        // Loop through each item and create a row
        data.forEach((lecture) => {
          const row = `
            <tr>
              <td>${lecture.index_number}</td>
              <td>${lecture.username}</td>
              <td>${lecture.email}</td>
              <td>${lecture.mobile_no || "N/A"}</td>
              <td>${lecture.address}</td>
              <td>${lecture.created_at || "N/A"}</td>
               <td> 
              <a href="#" class="m-1" data-bs-toggle="modal" data-bs-target="#LectureView" 
                                            data-id= ${lecture.id}
                                               data-index_number=${
                                                 lecture.index_number
                                               }
                                               data-username=${lecture.username}
                                               data-email= ${lecture.email}
                                               data-about= ${lecture.expertise}
                                               data-address= ${lecture.address}
                                               data-mobile_no=${
                                                 lecture.mobile_no
                                               }
                                               data-lecturerole=${lecture.role}
                                               data-image_path=${
                                                 lecture.image_path
                                               }>
                                                <i class="fas fa-eye fa-lg"></i>
                                               </a>

                                               <a href="#" class="m-1" data-bs-toggle="modal" data-bs-target="#Lecturecreate"
                                            data-id= ${lecture.id}
                                               data-index_number=${
                                                 lecture.index_number
                                               }
                                               data-username=${lecture.username}
                                               data-email= ${lecture.email}
                                               data-about= ${lecture.expertise}
                                               data-address= ${lecture.address}
                                               data-mobile_no=${
                                                 lecture.mobile_no
                                               }
                                               data-lecturerole=${lecture.role}
                                               data-inputPassword=${
                                                 lecture.password
                                               }
                                               data-image_path=${
                                                 lecture.image_path
                                               }>
                                                <i class="fas fa-user-edit fa-lg"></i>
                                               </a>
                                               <a href="include/delete.php?type=lectures&id=${
                                                 lecture.id
                                               } class="m-1" onclick="return confirm(\'Are you sure you want to delete this Lecture?\')"><i class="fas fa-trash-alt fa-lg"></i></a>
                      </td>
            </tr>
          `;
          outputEl.innerHTML += row;
        });
      } else {
        // Display a message if no results are found
        outputEl.innerHTML = `
          <tr>
            <td colspan="9" class="text-center">No results found</td>
          </tr>
        `;
      }
    }
  };

  xhr.send();
});

function fillInputs() {
  const xhr = new XMLHttpRequest();
  xhr.open(
    "GET",
    `../../../../LHM_SYSTEM/admin/include/search.php?query=init`,
    true
  );

  xhr.onload = function () {
    if (this.status === 200) {
      const data = JSON.parse(this.responseText);
      console.log(data);

      // Clear previous output
      outputEl.innerHTML = "";

      // Check if any results were returned
      if (data.length > 0) {
        // Loop through each item and create a row
        data.forEach((lecture) => {
          const row = `
            <tr>
              <td>${lecture.index_number}</td>
              <td>${lecture.username}</td>
              <td>${lecture.email}</td>
              <td>${lecture.mobile_no || "N/A"}</td>
              <td>${lecture.address}</td>
              <td>${lecture.created_at || "N/A"}</td>
              <td> 
              <a href="#" class="m-1" data-bs-toggle="modal" data-bs-target="#LectureView" 
                                            data-id= ${lecture.id}
                                               data-index_number=${
                                                 lecture.index_number
                                               }
                                               data-username=${lecture.username}
                                               data-email= ${lecture.email}
                                               data-about= ${lecture.expertise}
                                               data-address= ${lecture.address}
                                               data-mobile_no=${
                                                 lecture.mobile_no
                                               }
                                               data-lecturerole=${lecture.role}
                                               data-image_path=${
                                                 lecture.image_path
                                               }>
                                                <i class="fas fa-eye fa-lg"></i>
                                               </a>

                                               <a href="#" class="m-1" data-bs-toggle="modal" data-bs-target="#Lecturecreate"
                                            data-id= ${lecture.id}
                                               data-index_number=${
                                                 lecture.index_number
                                               }
                                               data-username=${lecture.username}
                                               data-email= ${lecture.email}
                                               data-about= ${lecture.expertise}
                                               data-address= ${lecture.address}
                                               data-mobile_no=${
                                                 lecture.mobile_no
                                               }
                                               data-lecturerole=${lecture.role}
                                               data-inputPassword=${
                                                 lecture.password
                                               }
                                               data-image_path=${
                                                 lecture.image_path
                                               }>
                                                <i class="fas fa-user-edit fa-lg"></i>
                                               </a>
                                               <a href="include/delete.php?type=lectures&id=${
                                                 lecture.id
                                               } class="m-1" onclick="return confirm(\'Are you sure you want to delete this Lecture?\')"><i class="fas fa-trash-alt fa-lg"></i></a>
                      </td>
            </tr>
          `;
          outputEl.innerHTML += row;
        });
      } else {
        // Display a message if no results are found
        outputEl.innerHTML = `
          <tr>
            <td colspan="9" class="text-center">No results found</td>
          </tr>
        `;
      }
    }
  };

  xhr.send();
}

fillInputs();
