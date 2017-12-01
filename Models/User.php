<?php
require_once VENDOR . "Model.php";

class User extends Model
{

    public $table = 'user';

    public function userRegister()
    {
        $a = 0;
        if (isset($_POST['firstName']) && !empty($_POST['firstName'])) {

            $firstname = strip_tags($_POST['firstName']);
            $_SESSION['firstname'] = $firstname;
            unset($_SESSION['error_firstname']);

        } else {
            $a++;
            unset($_SESSION['firstname']);
            $_SESSION['error_firstname'] = 'Firstname is missing';
        }

        if (isset($_POST['lastName']) && !empty($_POST['lastName'])) {

            $lastname = strip_tags($_POST['lastName']);
            $_SESSION['lastname'] = $lastname;
            unset($_SESSION['error_lastname']);
        } else {
            $a++;
            unset($_SESSION['lastname']);
            $_SESSION['error_lastname'] = 'Lastname is missing';

        }

        if (isset($_POST['email']) && !empty($_POST['email'])) {

            $result = $this->selectMysql([
                'email' => $_POST['email'],
            ]);
            if (mysqli_num_rows($result) > 0) {
                $a++;
                $_SESSION['Email_repeat'] = 'Entered email is already in use by another user';
            } else {
                unset($_SESSION['error_emptyEmail']);
                $email = strip_tags($_POST['email']);

                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $a++;
                    $_SESSION['error_email'] = 'Email is not a valod!';
                } else {
                    $_SESSION['email'] = $email;
                }
            }
        } else {
            unset($_SESSION['error_email']);
            unset($_SESSION['email']);
            $a++;
            $_SESSION['error_emptyEmail'] = 'Email is missing';
        }

        if (isset($_POST['password']) && !empty($_POST['password'])) {
            unset($_SESSION['error_password']);
            $password = strip_tags($_POST['password']);
            $_SESSION['password'] = $password;
        } else {
            $a++;
            unset($_SESSION['password']);
            $_SESSION['error_password'] = 'Password is missing';

        }


        if (isset($_POST['conf']) && !empty($_POST['conf'])) {
            unset($_SESSION['error_conf_password']);
            $conf_password = strip_tags($_POST['password']);
            $_SESSION['conf_password'] = $conf_password;
        } else {
            $a++;
            unset($_SESSION['conf_password']);
            $_SESSION["errors"]['error_conf_password'] = 'conf_password is missing';
        }


        if (isset($_POST['gender']) && !empty($_POST['gender'])) {

            $gender = $_POST['gender'];
            $_SESSION['gender'] = $gender;

        } else {
            $a++;

            $_SESSION['error_gender'] = 'Gender is  missing';

        }

        $confirm_password = $_POST['conf'];

        if ($password == $confirm_password) {
            $password = crypt($password);
            unset($_SESSION['pass_error']);
        } else {
            $a++;

            $_SESSION['pass_error'] = 'Passwords doesnt match!';
        }
        if ($a == 0) {
            $array = [
                'firstName' => $_POST['firstName'],
                'lastName' => $_POST['lastName'],
                'gender' => $_POST['gender'],
                'email' => $_POST['email'],
                'password' => $_POST['password'],
            ];
            $this->insert($array);
            return true;

        } else {
            return false;

        }
    }


    public function userLogin()
    {


        if ($_SESSION['database'] == MY_JSON) {
            //  var_dump($_SESSION['database']);
            $result = $this->select($_POST);
            $_SESSION['user_id'] = $result['user_id'];
            return $result;
        } else if ($_SESSION['database'] == MY_XML) {
            //  var_dump(MY_XML);die();
        } else {
            // dd($_POST);
            $result = mysqli_fetch_assoc($this->select($_POST));
            $_SESSION['userInfoAll'] = $result;
            $_SESSION['user_id'] = $result['id'];

            return $result;
        }

    }

    public static function userUpload()
    {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $uploadOk = 1;
        $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
        if (isset($_POST["submit"])) {
            $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
            if ($check !== false) {
                echo "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                echo "File is not an image.";
                $uploadOk = 0;
            }
        }
// Check if file already exists
        if (file_exists($target_file)) {
            echo "Sorry, file already exists.";
            $uploadOk = 0;
        }
// Check file size
        if ($_FILES["fileToUpload"]["size"] > 500000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }
// Allow certain file formats
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif") {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }
// Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                echo "The file " . basename($_FILES["fileToUpload"]["name"]) . " has been uploaded.";
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    }


}