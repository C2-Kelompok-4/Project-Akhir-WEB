<?php
include 'koneksi.php';

if(isset($_POST['submit'])) {
  $nama = $_POST['nama'];
  $brand = $_POST['brand'];
  $harga = $_POST['harga'];
  
  // Proses upload gambar
  $gambar = $_FILES['gambar']['name'];
  $tmp_name = $_FILES['gambar']['tmp_name'];
  $size = $_FILES['gambar']['size'];
  $type = $_FILES['gambar']['type'];
  $error = $_FILES['gambar']['error'];

  // Ekstensi file yang diperbolehkan
  $allowed_extensions = array("jpg", "jpeg", "png");

  if($error === 4) {
    echo "<script>
          alert('Pilih gambar terlebih dahulu');
          </script>";
    return false;
  }

  $file_extension = pathinfo($gambar, PATHINFO_EXTENSION);
  if(!in_array($file_extension, $allowed_extensions)) {
    echo "<script>
          alert('File yang diupload harus berupa gambar (jpg, jpeg, png)');
          </script>";
    return false;
  }

  if($size > 1000000) {
    echo "<script>
          alert('Ukuran file gambar maksimal 1MB');
          </script>";
    return false;
  }

  $upload_path = "uploads/";
  $uploaded_file = $upload_path . $gambar;

  if(move_uploaded_file($tmp_name, $uploaded_file)) {
    $query = "INSERT INTO hp (Nama, Brand, Harga, gambar) VALUES ('$nama', '$brand', '$harga', '$gambar')";
    if(mysqli_query($conn, $query)) {
      echo "<script>
            alert('Data berhasil ditambahkan');
            document.location.href = 'kategori.php';
            </script>";
    } else {
      echo "<script>
            alert('Data gagal ditambahkan');
            </script>";
    }
  } else {
    echo "<script>
          alert('File gagal diupload');
          </script>";
  }
}
?>

<!-- Tampilkan form untuk menambah data -->
<form method="POST" action="" enctype="multipart/form-data">
  <label for="nama">Nama:</label><br>
  <input type="text" id="nama" name="nama"><br>

  <label for="brand">Brand:</label><br>
  <input type="text" id="brand" name="brand"><br>

  <label for="harga">Harga:</label><br>
  <input type="text" id="harga" name="harga"><br>

  <label for="gambar">Gambar:</label><br>
  <input type="file" id="gambar" name="gambar"><br><br>

  <input type="submit" name="submit" value="Tambah">
</form>
