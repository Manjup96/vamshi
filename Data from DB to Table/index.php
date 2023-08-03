<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        /* Define the highlight styles */
        .highlight {
            background-color: gold;
            transition: background-color 0.3s ease-in-out;
        }
    </style>
    <link rel="stylesheet" href="styles.css">
    <title>Data from DB to Table</title>
</head>
<body>

<input type="text" id="search-input" class="form-control" placeholder="Search by name">
<div id="autocomplete-list"></div>

<table>
  <thead>
   <tr>
    <th>S.NO</th>
    <th>Name</th>
    <th>Company</th>
    <th>Age</th>
    <th>Designation</th>
    <th>Hobbies</th>
   </tr>
  </thead>
  <tbody id="data-body">
   <!-- Data will be populated here -->
  </tbody>
 </table>
 
 


<script>

const searchInput = document.getElementById('search-input');
const autocompleteList = document.getElementById('autocomplete-list');

searchInput.addEventListener('input', () => {
    const searchTerm = searchInput.value;

    fetch(`autocomplete.php?term=${searchTerm}`)
        .then(response => response.json())  
        .then(data => {
            autocompleteList.innerHTML = '';
            data.forEach(name => {
                const item = document.createElement('div');
                item.classList.add('autocomplete-item');
                item.textContent = name;

                item.addEventListener('click', () => {
                    searchInput.value = name;
                    autocompleteList.innerHTML = '';
                    fetchData(name); // Fetch and display data for the selected name
                });

                autocompleteList.appendChild(item);
            });
        })
        .catch(error => console.error('Error:', error));
});

function fetchData(name) {
    // Fetch data from the database and populate the table based on the selected name
    // Update the fetch URL and handling logic as needed
}




    const tableBody = document.getElementById('data-body');
    let highlightedRow = null;

    fetch('get_data.php')
        .then(response => response.json())
        .then(data => {
            data.forEach(row => {
                const newRow = tableBody.insertRow();
                const cell1 = newRow.insertCell(0);
                const cell2 = newRow.insertCell(1);
                const cell3 = newRow.insertCell(2);
                const cell4 = newRow.insertCell(3);
                const cell5 = newRow.insertCell(4);
                const cell6 = newRow.insertCell(5);
                
                cell1.innerHTML = row.id;
                cell2.innerHTML = row.name;
                cell3.innerHTML = row.company;
                cell4.innerHTML = row.age;
                cell5.innerHTML = row.designation;
                cell6.innerHTML = row.hobbies;

                newRow.addEventListener('click', () => {
                    if (highlightedRow) {
                        highlightedRow.classList.remove('highlight');
                    }
                    newRow.classList.add('highlight');
                    highlightedRow = newRow;
                });
            });
        })
        .catch(error => console.error('Error:', error));
</script>

 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
 <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>
</html>
