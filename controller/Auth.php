<?php 
require_once '../public/config.php';

    if(isset($_POST['login']))
    {
        try
        {   
            $TiennVo = new TiennVo;
            $username = $_POST['username'];
            $password = md5($_POST['password']);
            if(empty($username))
            {
                echo "<script>alert('Vui lòng nhập Email !'); window.location.href='../signin.php';</script>";
                exit;
            }
            if(!$TiennVo->get_row(" SELECT * FROM `users` WHERE `username` = '$username' "))
            {
                echo "<script>alert('username không tồn tại !'); window.location.href='../signin.php';</script>";
                exit;
            }
            if(empty($password))
            {
                echo "<script>alert('Vui lòng nhập Password !'); window.location.href='../signin.php';</script>";
                exit;
            }
            if(!$TiennVo->get_row(" SELECT * FROM `users` WHERE `username` = '$username' AND password = '$password' "))
            {
                echo "<script>alert('Password đăng nhập không chính xác'); window.location.href='../signin.php';</script>";
                exit;
            }
            echo "<script>alert('Đăng nhập thành công'); window.location.href='../index.php';</script>";
            exit;
        }
        catch (Exception $e)
        {
            echo 'error';
        }
    }

    if(isset($_POST['Register']))
    {   
        $TiennVo = new TiennVo;
        $username = $_POST['username'];
        $password = $_POST['password'];
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        if(empty($username))
        {
            echo "<script>alert('Vui lòng nhập Email !'); window.location.href='../signup.php';</script>";
            exit;
        }
        if($TiennVo->check_email($username) != True)
        {
            echo "<script>alert('Vui lòng nhập định dạng Email hợp lệ'); window.location.href='../signup.php';</script>";
            exit;
        }
        if(strlen($username) < 5 || strlen($username) > 64)
        {
            echo "<script>alert('Tài khoản phải từ 5 đến 64 ký tự'); window.location.href='../signup.php';</script>";
            exit;
        }
        if($TiennVo->get_row(" SELECT * FROM `users` WHERE `username` = '$username' "))
        {
            echo "<script>alert('User đã tồn tại!'); window.location.href='../signup.php';</script>";
            exit;
        }
        if(empty($password))
        {
            echo "<script>alert('Vui lòng nhập Password !'); window.location.href='../signup.php';</script>";
            exit;
        }
        if(strlen($password) < 3)
        {
            echo "<script>alert('Vui lòng đặt Password trên 3 ký tự'); window.location.href='../signup.php';</script>";
            exit;
        }
        if(empty($firstname))
        {
            echo "<script>alert('Vui lòng nhập First Name !'); window.location.href='../signup.php';</script>";
            exit;
        }
        if(empty($lastname))
        {
            echo "<script>alert('Vui lòng nhập Last Name !'); window.location.href='../signup.php';</script>";
            exit;
        }
        $create = $TiennVo->insert("users", [
            'username'      => $username,
            'password'      => md5($password),
            'firstname'     => $firstname,
            'lastname'      => $lastname,
        ]);
        if ($create)
        {   
            $_SESSION['username'] = $username;
            echo "<script>alert('Tạo tài khoản thành công'); window.location.href='../signin.php';</script>";
            exit;
        }
        else
        {
            echo "<script>alert('Vui lòng kiểm tra cấu hình DATABASE'); window.location.href='../signup.php';</script>";
            exit;
        }
    }
?>