<?php
//dd( $_SESSION['user_id']);
if (!isset($_SESSION['user_id'])) {
    throw new Exception('open your profile by link', 404);
}
/*AIzaSyBOOMILXjozOEelGyNOw03Or8xLw9MyDNA*/
?>

<h1>profil php</h1>

<form action="upload.php" method="post" enctype="multipart/form-data">
    Select image to upload:
    <input type="file" name="fileToUpload" id="fileToUpload">
    <input type="submit" value="Upload Image" name="submit">
</form>