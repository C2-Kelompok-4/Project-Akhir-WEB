<?php
require "koneksi.php";

$query = "SELECT * FROM hp";
$result = mysqli_query($conn, $query);


$sortby = isset($_GET['sortby']) ? $_GET['sortby'] : 'id';
$sorttype = isset($_GET['sorttype']) ? $_GET['sorttype'] : 'asc';

$query = "SELECT * FROM hp ORDER BY $sortby $sorttype";
$result = mysqli_query($conn, $query);

$sortby = isset($_GET['sortby']) ? $_GET['sortby'] : 'id';
$sorttype = isset($_GET['sorttype']) ? $_GET['sorttype'] : 'asc';

$query = "SELECT * FROM hp ORDER BY $sortby $sorttype";
$result = mysqli_query($conn, $query);
?>

<?php


if(isset($_POST['search'])) {
    $search = $_POST['search'];
    $query = "SELECT * FROM hp WHERE Nama LIKE '%$search%' OR Brand LIKE '%$search%' OR Harga LIKE '%$search%'";
} else {
    $query = "SELECT * FROM hp";
}

$result = mysqli_query($conn, $query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Toko HP</title>
    <link rel="stylesheet" href="kategori.css">
</head>
<body>
    <header>
        <h1>Toko HP</h1>
    </header>
    <nav>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="kategori.php">Products</a></li>
        </ul>
    </nav>
    <br><br><br>
   
<form action="" method="get">
    <label for="sortby">Urutkan berdasarkan:</label>
    <select name="sortby" id="sortby">
        <option value="id">ID</option>
        <option value="nama">Nama</option>
        <option value="brand">Brand</option>
        <option value="harga">Harga</option>
    </select>
    <select name="sorttype" id="sorttype">
        <option value="asc">Ascending</option>
        <option value="desc">Descending</option>
    </select>
    <button type="submit" name="sort">Urutkan</button>
</form>
<br>


<form method="POST" action="">
    <input type="text" name="search" placeholder="Search">
    <button type="submit">Search</button>
</form>
<br>
    <a href="tambah_hp.php">Tambah Data</a>
<br>
    <table border="1" cellpadding="10" cellspacing="0">
        
        <tr>
            <td>Id</td>
            <td>Nama</td>
            <td>Brand</td>
            <td>Harga</td>
            <td>Gambar</td>
            <td>aksi</td>

        </tr>
        <?php
    $i = 1;
    while($row = mysqli_fetch_assoc($result)) {
    ?>
    <tr>
        <td><?php echo $i ?></td>
        <td><?php echo $row["Nama"]?></td>
        <td><?php echo $row["Brand"]?></td>
        <td><?php echo $row["Harga"]?></td>
        <td><img src='uploads/<?php echo $row["gambar"]?>' width='100'></td>
        <td>
            <a href="hapus.php?id=<?php echo $row["id"]?>">Hapus</a>
            <a href="update.php?id=<?php echo $row["id"]?>">Update</a>
        </td>
    </tr>
    <?php
    $i++;
    }
    ?>
    </table>
    <section class="products">
  
</section>
    <footer>
        <p>&copy; 2023 Toko HP. All Rights Reserved.</p>
    </footer>
</body>
</html>