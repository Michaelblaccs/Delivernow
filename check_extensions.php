<?php
if (extension_loaded('curl')) {
    echo "cURL extension is enabled.<br>";
} else {
    echo "cURL extension is NOT enabled.<br>";
}

if (extension_loaded('openssl')) {
    echo "OpenSSL extension is enabled.<br>";
} else {
    echo "OpenSSL extension is NOT enabled.<br>";
}
?>
