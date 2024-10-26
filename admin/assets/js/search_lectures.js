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
