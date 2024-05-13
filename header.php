<html>
     <?php include "database-connection.php" ?> 

<head>
     <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script> -->
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
     <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
     <style>
      .hide{
        display:none;
      }
      .hide sh{
        display: block;
      }
      </style>
    </head>
     

<body>


<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: rgba(0, 0, 0, 0.75);">
  <div class="container-fluid d-flex justify-content-between mx-4">
    <div class="d-flex">
      <img class="me-4" style="width:150px; height:max-content; border-radius: 100px" src="./imagesForWebsite/nexus_team.jpg" alt="logo" >

      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav">
          <li class="nav-item active">
            <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item ">
            <a class="nav-link" href="profile.php" >Profile</a>
          </li>
          <li class="nav-item ">
            <a class="nav-link" href="Games/Gaming.php" >Bored?</a>
        </li>
        <li>
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Search by
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" onclick="showSearchInput('Category')">Category</a>
                            <a class="dropdown-item" onclick="showSearchInput('Name')">Creator Name</a>
                        </div>
                    </div>
          </li>
          <li class="hide">
          <input type="text"  id="search" name="search">
          <button onclick="showInfo()">Search</button>
            </li>
        </ul>
      </div>
    </div>

    <!-- New Button -->
    <!-- <div>
      <a class="btn btn-primary" href="shto_postim.php">Shto postim</a>
    </div> -->
  </div>
</nav>


<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-H+K5I5uvW4ktIFlqezEp0oAxwGYm6j0e1axgkeM5V3E=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>

<script>

function showSearchInput(type) {
  const inputText = document.querySelector(".hide");
    
    var searchInput = document.getElementById('search');
    var dropdownMenuButton = document.querySelector('#dropdownMenuButton');
    if (type === 'Category' ) {
        // Update the dropdown menu text
        console.log(type);
        dropdownMenuButton.innerText = 'Search by ' + type;
        searchInput.placeholder = 'Search by ' + type;
        inputText.classList.toggle("hide");
    } else if(type === 'Name'){
       // Update the dropdown menu text
       console.log(type);
        dropdownMenuButton.innerText = 'Search by ' + type;
        searchInput.placeholder = 'Search by Creator ' + type;
        inputText.classList.toggle("hide");
    }else {
        alert("Problem");
    }
  }

  function showInfo(){

    var searchInput = document.getElementById('search').value;
    if (searchInput == null || searchInput == "") {
        alert("Search field must not be empty");
    } else {
        var searchType = document.querySelector('#dropdownMenuButton').innerText.trim();
        var url = 'mainBody.php?';
        if (searchType === 'Search by Category') {
            url += 'category=' + encodeURIComponent(searchInput);
        } else if (searchType === 'Search by Name') {
            // Change the searchType to match the server-side query parameter
            url += 'creator=' + encodeURIComponent(searchInput);
        }
        // Redirect to mainBody.php with search criteria
        window.location.href = url;
    }
  }
</script>
</html>