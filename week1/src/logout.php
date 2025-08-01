<?php
session_start();
if (session_destroy()) {
    echo "Success logout";
    echo "<script>location.href='index.php'</script>";
}
else {
    echo("Fail logout");
    echo "<script>location.href='index.php'</script>";
}
?>
