<?php

require './assets/config/function.php';

if (isset($_POST['loginBtn'])) {
    $email = validate($_POST['email']);
    $password = validate($_POST['password']);

    if ($email != '' && $password != '') {
        $query = "SELECT * FROM admins WHERE email='$email' LIMIT 1";
        $result = mysqli_query($conn, $query);

        if ($result && mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
            $storedPassword = $row['password'];

            if ($password !== $storedPassword) {
                redirect('login.php', 'Invalid Password');
            }

            if ($row['is_ban'] == 1) {
                redirect('login.php', 'Your account has been banned. Contact your admin.');
            }

            $_SESSION['loggedIn'] = true;
            $_SESSION['loggedInUser'] = [
                'user_id' => $row['id'],
                'name' => $row['name'],
                'email' => $row['email'],
                'phone' => $row['phone'],
            ];
            redirect('assets/index.php', 'Logged in successfully');
        } else {
            redirect('login.php', 'Invalid email address');
        }
    } else {
        redirect('login.php', 'All fields are mandatory!');
    }
}
?>
