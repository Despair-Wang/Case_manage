<form action="test.php" method="POST">
    <input type="text" name="bb">
    <input type="submit" value="submit">
</form>

<?php
if (isset($_POST['bb'])) {
    echo "bb={$_POST['bb']}";
}
?>