<?php
require_once 'includes/ordernow.inc.php';
if (!isset($_SESSION['user_id'])) {
    // User not logged in, redirect to login page
    header("Location: login.php");
    exit();
}
include_once 'headerordernow.php';

// Get distinct categories in your desired order
$sql = "
    SELECT DISTINCT category FROM image
    ORDER BY 
        FIELD(LOWER(category), 'pizzas', 'burgers', 'soft drinks') ASC,
        category ASC
";
$result = mysqli_query($conn, $sql);

if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}

$first = true;

// Map categories to background images
$backgrounds = [
    'pizzas' => 'itemimg/pizzahome.jpg',
    'burgers' => 'itemimg/burgerhome.jpg',
    'soft drinks' => 'itemimg/drinkshome.jpg',
];
?>

<body>
    <!-- Back Button -->
    <button onclick="window.location.href='home.php'" class="buttonborderless">
    <svg class="returnicon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
  <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 15.75 3 12m0 0 3.75-3.75M3 12h18" />
</svg>

</button>
  <div class="container">
    <?php while ($row = mysqli_fetch_assoc($result)) {
        $rawCategory = strtolower($row['category']);
        $category = ucfirst(htmlspecialchars($row['category']));

        // Fallback image if category is not in the map
        $bgImage = isset($backgrounds[$rawCategory]) ? $backgrounds[$rawCategory] : 'itemimg/default.jpg';
    ?>
        <div class="textwrapper">
            <img src="<?php echo $bgImage; ?>" class="ordernowhomeimg" alt="image">

            <?php if ($first): ?>
                <div class="text-overlay1">
                    Welcome, <?php echo ucfirst(strtolower($_SESSION["firstname"])) . " " . ucfirst(strtolower($_SESSION["lastname"])); ?>
                    <svg class="iconswelcome" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15.182 15.182a4.5 4.5 0 0 1-6.364 0M21 12a9 9 0 1 1-18 0 
                            9 9 0 0 1 18 0ZM9.75 9.75c0 .414-.168.75-.375.75S9 10.164 9 
                            9.75 9.168 9 9.375 9s.375.336.375.75Zm-.375 0h.008v.015h-.008V9.75Zm5.625 
                            0c0 .414-.168.75-.375.75s-.375-.336-.375-.75.168-.75.375-.75.375.336.375.75Zm-.375 
                            0h.008v.015h-.008V9.75Z" />
                    </svg>
                </div>
                <?php $first = false; ?>
            <?php endif; ?>

            <div class="text-overlay2">
                Craving for something nice?
                <br> Treat your buds to our magnificent menu
            </div>

            <div class="text-overlay3">
                <?php echo $category; ?>
            </div>

            <button class="orderbtn" onclick="window.location.href='items.php?category=<?php echo urlencode($rawCategory); ?>'">
                Order now
                <svg class="icons" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                    <path fill-rule="evenodd" d="M7.5 6v.75H5.513c-.96 0-1.764.724-1.865 
                        1.679l-1.263 12A1.875 1.875 0 0 0 4.25 22.5h15.5a1.875 1.875 
                        0 0 0 1.865-2.071l-1.263-12a1.875 1.875 0 0 0-1.865-1.679H16.5V6a4.5 
                        4.5 0 1 0-9 0ZM12 3a3 3 0 0 0-3 3v.75h6V6a3 3 0 0 0-3-3Zm-3 
                        8.25a3 3 0 1 0 6 0v-.75a.75.75 0 0 1 1.5 0v.75a4.5 4.5 0 1 1-9 
                        0v-.75a.75.75 0 0 1 1.5 0v.75Z" clip-rule="evenodd" />
                </svg>
            </button>
        </div>
        <br><br>
    <?php } ?>
  </div>

  <script src="cart.js"></script>
</body>
</html>
