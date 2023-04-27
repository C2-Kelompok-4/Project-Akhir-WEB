<?php
include 'koneksi.php';

// Proses edit data
if(isset($_POST['update'])) {
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $brand = $_POST['brand'];
    $harga = $_POST['harga'];
    
    // Proses upload gambar
    $gambar = $_FILES['gambar']['name'];
    $tmp_name = $_FILES['gambar']['tmp_name'];
    $size = $_FILES['gambar']['size'];
    $type = $_FILES['gambar']['type'];
    $error = $_FILES['gambar']['error'];
  
    // Jika tidak memilih gambar baru
    if($error === 4) {
        $query = "UPDATE hp SET Nama='$nama', Brand='$brand', Harga='$harga' WHERE Id=$id";
        if(mysqli_query($conn, $query)) {
            echo "<script>
                  alert('Data berhasil diupdate');
                  document.location.href = 'kategori.php';
                  </script>";
        } else {
            echo "<script>
                  alert('Data gagal diupdate');
                  </script>";
        }
    } else {
        // Ekstensi file yang diperbolehkan
        $allowed_extensions = array("jpg", "jpeg", "png");
  
        $file_extension = pathinfo($gambar, PATHINFO_EXTENSION);
        if(!in_array($file_extension, $allowed_extensions)) {
            echo "<script>
                  alert('File yang diupload harus berupa gambar (jpg, jpeg, png)');
                  </script>";
            return false;
        }
  
        if($size > 9000000) {
            echo "<script>
                  alert('Ukuran file gambar maksimal 9MB');
                  </script>";
            return false;
        }
  
        $upload_path = "uploads/";
        $uploaded_file = $upload_path . $gambar;
  
        if(move_uploaded_file($tmp_name, $uploaded_file)) {
            // Hapus gambar lama
            $query_get_gambar = "SELECT gambar FROM hp WHERE Id=$id";
            $result = mysqli_query($conn, $query_get_gambar);
            if($result) {
                $gambar_lama = mysqli_fetch_assoc($result)['gambar'];
                unlink($upload_path . $gambar_lama);
            }
  
            $query = "UPDATE hp SET Nama='$nama', Brand='$brand', Harga='$harga', gambar='$gambar' WHERE Id=$id";
            if(mysqli_query($conn, $query)) {
                echo "<script>
                      alert('Data berhasil diupdate');
                      document.location.href = 'kategori.php';
                      </script>";
            } else {
                echo "<script>
                      alert('Data gagal diupdate');
                      </script>";
            }
        } else {
            echo "<script>
                  alert('Terjadi kesalahan saat mengupload gambar');
                  </script>";
        }
    }
}
  
// Tampilkan form edit data
if(isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM hp WHERE Id=$id";
    $result = mysqli_query($conn, $query);
    if($result && mysqli_num_rows($result) > 0) {
        $data = mysqli_fetch_assoc($result);
?>
<form method="POST" action="" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?= $data['id'] ?>">
      
      <label for="nama">Nama:</label><br>
      <input type="text" id="nama" name="nama" value="<?= $data['Nama'] ?>"><br>
        
      <label for="brand">Brand:</label><br>
      <input type="text" id="brand" name="brand" value="<?= $data['Brand'] ?>"><br>
        
      <label for="harga">Harga:</label><br>
      <input type="number" id="harga" name="harga" value="<?= $data['Harga'] ?>"><br>
        
      <label for="gambar">Gambar:</label><br>
      <img src="uploads/<?= $data['gambar'] ?>" width="100"><br>
      <input type="file" id="gambar" name="gambar"><br>
        
      <button type="submit" name="update">Update Data</button>
  </form>
  <?php
      } else {
          echo "Data tidak ditemukan";
      }
  } else {
      echo "ID tidak ditemukan";
  }
  ?>
