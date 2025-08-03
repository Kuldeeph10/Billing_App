<?php
include('../config/function.php');

if (isset($_POST['saveAdmin'])) {

    $name = validate($_POST['name']);
    $email = validate($_POST['email']);
    $password = validate($_POST['password']);
    $phone = validate($_POST['phone']);
    $is_ban = validate($_POST['is_ban']) == true ? 1 : 0;

    if ($name != '' && $email != '' && $password != '') {
        // fro email validation 
        $emailCheck = mysqli_query($conn, "SELECT * FROM admins WHERE email='$email'");
        if ($emailCheck) {
            if (mysqli_num_rows($emailCheck) > 0) {
                redirect('admins-crate.php', 'Email Already used byy another user.!');
            }
        }

        // for password validation 
        $bcrypt_password = password_hash($password, PASSWORD_BCRYPT);
        $data = [
            'name' => $name,
            'email' => $email,
            'password' => $bcrypt_password,
            'phone' => $phone,
            'is_ban' => $is_ban,
        ];
        $result = insert('admins', $data);
        if ($result) {
            redirect('admins.php', 'Admin Created Successfully!');
        } else {
            redirect('admins-crate.php', 'Something Went Wrong!');
        }

    } else {
        redirect('admins-crate.php', 'Please fill required fields.!');
    }

}

?>