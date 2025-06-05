
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0", maximum-scale=1.0, user-scalable=no>
  <title>Menu</title>
  <link rel="stylesheet" href="menu.css" />
</head>
<body>
  <div class="container">

    <div class="navorders">
      <select id="Location" name="dropdownlocation" class="select_order">
        <option value="address"><?php echo ($_SESSION["delivery_address"]); ?></option>
        <!-- <option value="Phoenix">Phoenix</option> -->
      </select>

      <div class="navleft">
      <button class="buttonborderless" onclick="window.location.href='cart.php'">
  <svg class="menuicons" xmlns="http://www.w3.org/2000/svg" fill="none" 
       viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
    <path stroke-linecap="round" stroke-linejoin="round" 
          d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 
             1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 
             1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 
             5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 
             10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 
             0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
  </svg>
</button>
      </div>
    </div>

    <form action="search.php" method="POST" enctype="multipart/form-data">
      <div class="nav2">
        <!-- Inside your <form> -->
<div class="searchwrapper">
  <input type="text" class="searchbox" name="searchbox" placeholder="Search...pizza,burgers,drinks..." />

  <!-- Hidden file input -->
  <input type="file" id="imageUpload" name="imageUpload" accept="image/*" style="display: none;" onchange="this.form.submit()" />
  <!-- Camera Icon Button - changed type from submit to button -->
  <button type="button" class="camera-icon-btn" onclick="document.getElementById('imageUpload').click()">
    <svg class="cameraicon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
      stroke-width="1.5" stroke="currentColor">
      <path stroke-linecap="round" stroke-linejoin="round"
        d="M6.827 6.175A2.31 2.31 0 0 1 5.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 0 0-1.134-.175 2.31 2.31 0 0 1-1.64-1.055l-.822-1.316a2.192 2.192 0 0 0-1.736-1.039 48.774 48.774 0 0 0-5.232 0 2.192 2.192 0 0 0-1.736 1.039l-.821 1.316Z"/>
      <path stroke-linecap="round" stroke-linejoin="round"
        d="M16.5 12.75a4.5 4.5 0 1 1-9 0 4.5 4.5 0 0 1 9 0ZM18.75 10.5h.008v.008h-.008V10.5Z" />
    </svg>
  </button>
</div>

        <div class="navbtncontainer">
          <button type="submit" name="submit-search" class="searchbtn">Search</button>
        </div>
      </form>

      <!-- <form action="sort.php" method="POST">
        <button type="submit" name="sortby" class="sortbtn" title="Sort" onclick="toggleSortOptions()">
          <svg class="sorticon" xmlns="http://www.w3.org/2000/svg" fill="none"
            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round"
              d="M10.5 6h9.75M10.5 6a1.5 1.5 0 1 1-3 0m3 0a1.5 1.5 0 1 0-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m-9.75 0h9.75" />
          </svg>
        </button>
      </form> -->
    </div>

    <div id="menu-content">
      <!-- Your dynamic content here -->
    