<?php
require __DIR__ . '/vendor/autoload.php';
require_once 'includes/dbh.inc.php'; // ✅ Explicit DB connection
if (!isset($_SESSION['user_id'])) {
    // User not logged in, redirect to login page
    header("Location: login.php");
    exit();
}
include_once 'headerordernow.php';
use Google\Cloud\Vision\V1\Client\ImageAnnotatorClient;
use Google\Cloud\Vision\V1\BatchAnnotateImagesRequest;
use Google\Cloud\Vision\V1\AnnotateImageRequest;
use Google\Cloud\Vision\V1\Image;
use Google\Cloud\Vision\V1\Feature;

putenv('GOOGLE_APPLICATION_CREDENTIALS=feisty-wall-460309-g8-b738327006fb.json');

$client = new ImageAnnotatorClient();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo "<script>alert('Submit a search query'); window.history.back();</script>";
    exit;
}

$search = trim($_POST['searchbox'] ?? '');

function outputItemsGrid($result) {
    echo '<div class="item-grid">';
    if (mysqli_num_rows($result) > 0) {
        while ($item = mysqli_fetch_assoc($result)) {
            ?>
            <div class="item" data-category="<?php echo strtolower(htmlspecialchars($item['category'])); ?>">
            <form action="addtocart.php" method="POST" class="add-to-cart-form">
                <div class="itemimg">
                    <img src="<?php echo htmlspecialchars($item['img_path']); ?>" alt="<?php echo htmlspecialchars($item['img_name']); ?>" class="imgedit">
                    <button type="button" class="description" name="description">
                        <svg class="descriptionicon" xmlns="http://www.w3.org/2000/svg" fill="none"
                             viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021
                                  M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z"/>
                        </svg>
                    </button>
                </div>
                <div class="name">
                    <?php echo htmlspecialchars($item['img_name']); ?><br>
                    £<?php echo number_format($item['price'], 2); ?> | <?php echo htmlspecialchars($item['calories']); ?> cal
                </div>

                <!-- ✅ Hidden input for item ID -->
                <input type="hidden" name="item_id" value='<?php echo $item['img_id']; ?>'>
                <button type="submit" class="addToCart" name="submit">
                    <svg class="addtocartbtn" xmlns="http://www.w3.org/2000/svg" fill="none"
                         viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M12 4.5v15m7.5-7.5h-15"/>
                    </svg>
                </button>
            </form>
            </div>
            <?php
        }
    } else {
        echo "<p>No results found.</p>";
    }
    echo "</div>";

    // Fixed Back button
    echo '<a href="ordernow.php" class="back-btn">← Back to Menu</a>';
    echo '<style>
        .back-btn {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background-color: #333;
            color: #fff;
            padding: 10px 16px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: bold;
            z-index: 1000;
            box-shadow: 0 4px 6px rgba(0,0,0,0.3);
        }
        .back-btn:hover {
            background-color: #555;
        }
    </style>';
}

// Check if an image was uploaded and is OK
if (isset($_FILES['imageUpload']) && $_FILES['imageUpload']['error'] === UPLOAD_ERR_OK) {
    $imagePath = $_FILES['imageUpload']['tmp_name'];
    $imageContent = file_get_contents($imagePath);

    $image = (new Image())->setContent($imageContent);
    $feature = (new Feature())->setType(Feature\Type::LABEL_DETECTION);
    $annotateImageRequest = (new AnnotateImageRequest())->setImage($image)->setFeatures([$feature]);
    $batchRequest = (new BatchAnnotateImagesRequest())->setRequests([$annotateImageRequest]);

    $response = $client->batchAnnotateImages($batchRequest);

    // Map Vision labels to your DB categories/names
    $labelMap = [
        'hamburger' => 'burger',
        'buffalo burger' => 'burger',
        'cheeseburger' => 'burger',
        'burger' => 'burger',
        'pizza' => 'pizza',
        'cheese pizza' => 'pizza',
        'pepperoni pizza' => 'pizza',
        'soft drink' => 'soft drink',
        'coca-cola' => 'coke',
        'coke' => 'coke',
        'vegetable' => 'burger',
    ];

    $labels = [];
    foreach ($response->getResponses() as $res) {
        foreach ($res->getLabelAnnotations() as $label) {
            $desc = strtolower(trim($label->getDescription()));
            $score = $label->getScore();

            // Use labels with confidence >= 0.89
            if ($score >= 0.89) {
                if (isset($labelMap[$desc])) {
                    $labels[] = $labelMap[$desc];
                } else {
                    $labels[] = $desc;
                }
            }
        }
    }
    $labels = array_unique($labels);

    if (count($labels) === 0) {
        echo "<p>No recognizable content found in the image with enough confidence.</p>";
        echo '<a href="ordernow.php" class="back-btn">← Back to Menu</a>';
        ?>
        <script src="cart.js"></script>
        <?php
        exit;
    }

    // Build SQL with labels - select all columns you need including img_id
    $sqlParts = [];
    foreach ($labels as $label) {
        $labelEscaped = mysqli_real_escape_string($conn, $label);
        $sqlParts[] = "(img_name LIKE '%$labelEscaped%' OR category LIKE '%$labelEscaped%' OR Description LIKE '%$labelEscaped%')";
    }
    $sql = "SELECT img_id, img_name, img_path, price, calories, category, Description FROM image WHERE " . implode(' OR ', $sqlParts);

    $result = mysqli_query($conn, $sql);
    outputItemsGrid($result);
    ?>
    <script src="cart.js"></script>
    <?php
    exit;
}

// If no image uploaded, fallback to text search
if ($search === '') {
    echo "<p>Please enter a search term.</p>";
    echo '<a href="ordernow.php" class="back-btn">← Back to Menu</a>';
    ?>
    <script src="cart.js"></script>
    <?php
    exit;
}

$searchEscaped = mysqli_real_escape_string($conn, $search);

// Select explicit columns here too
$sql = "SELECT img_id, img_name, img_path, price, calories, category, Description FROM image WHERE img_name LIKE '%$searchEscaped%' OR category LIKE '%$searchEscaped%' OR Description LIKE '%$searchEscaped%'";
$result = mysqli_query($conn, $sql);

outputItemsGrid($result);
?>
<script src="cart.js"></script>
</body>
</html>
