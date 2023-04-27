<?php

$conn = mysqli_connect("localhost", "root", "", "tokohp");
if ( !$conn ){
    die("Gagal Terhubung : ". mysqli_connect_error());
}
?>