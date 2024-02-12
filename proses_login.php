<?php
    include "koneksi.php";
    session_start(); 

    $username = $_POST['username']; 
    $password = $_POST['password'];

    
    $stmt = $conn->prepare("SELECT * FROM user WHERE username=? and password=?");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $cek = mysqli_num_rows($result);

    if ($cek == 1) { 
        while ($data = $result->fetch_assoc()) {
            $_SESSION['userid'] = $data['userid'];
            $_SESSION['namalengkap'] = $data['namalengkap'];
        }
        header("location: index.php");
    } else {
        header("location: login.php");
        echo "<script> alert('Login Gagal') </script>";
    }

    $stmt->close(); 
    $conn->close(); 
?>
