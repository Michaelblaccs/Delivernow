<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Order Success</title>
<style>
  body, html {
    height: 100%;
    margin: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    background: white;
  }
  .size-6 {
    width: 96px;  /* 24 * 4 */
    height: 96px;
    color: green;
  }
</style>
<script>
  // Redirect after 1 second (1000 milliseconds)
  setTimeout(() => {
    window.location.href = 'ordernow.php';
  }, 1000);
</script>
</head>
<body>

<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
  <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
</svg>

</body>
</html>
