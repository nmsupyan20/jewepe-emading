<?php 
include('config_query.php');
$db = new database();

session_start();
$id_users = $_SESSION['id_users'];
$aksi = $_GET['aksi'];

if($aksi == "add"){
    // Cek Apakah File sudah di insert?
    if($_FILES['header']['name'] != ''){
        $tmp = explode('.', $_FILES['header']['name']); // memecah nama file dan extension
        $ext = end($tmp); // mengambil extension
        $filename = $tmp[0]; // ambil nama file gambar
        $allowed_ext = array("jpg", "png", "jpeg"); // extension yang dibolehkan

        if(in_array($ext, $allowed_ext)){

            if($_FILES['header']['size'] <= 5120000){
                $name = $filename . "_" . rand() . "." . $ext; // rename nama gambar
                $path = "../files/" . $name; // buat path gambar
                $uploaded = move_uploaded_file($_FILES['header']['tmp_name'], $path); // upload file

                if($uploaded){
                    $insertData = $db->tambah_data($name, $_POST['judul_artikel'], $_POST['isi_artikel'], 
                    $_POST['status_publish'], $id_users);

                    if($insertData){
                        echo "<script>alert('Data Berhasil di Tambahkan'); window.location.href = 'index.php';</script>"; 
                    } else {
                        echo "<script>alert('Data Gagal di Tambahkan'); window.location.href = 'index.php';</script>"; 
                    }
                } else {
                    echo "<script>alert('Data Gagal di Upload'); window.location.href = 'tambah_data.php';</script>";
                }
            } else {
                echo "<script>alert('Ukuran Gambar Lebih dari 5 MB'); window.location.href = 'tambah_data.php';</script>";
            }
        } else {
            echo "<script>alert('Extension file tidak diizinkan'); window.location.href = 'tambah_data.php';</script>";
        }
    } else {
        echo "<script>alert('Silahkan Pilih File Gambar'); window.location.href = 'tambah_data.php';</script>"; 
    }

} else if($aksi == "edit"){
    // Lakukan Operasi Update Data
    $id_artikel = $_POST['id_artikel'];
    if(!empty($id_artikel)){
        if($_FILES['header']['name'] != ""){
            $data = $db->get_by_id($id_artikel);

            if(file_exists('../files/'.$data['header']) && $data['header']){
                unlink('../files/'.$data['header']);

                $tmp = explode('.', $_FILES['header']['name']); // memecah nama file dan extension
                $ext = end($tmp); // mengambil extension
                $filename = $tmp[0]; // ambil nama file gambar
                $allowed_ext = array("jpg", "png", "jpeg"); // extension yang dibolehkan
        
                if(in_array($ext, $allowed_ext)){
        
                    if($_FILES['header']['size'] <= 5120000){
                        $name = $filename . "_" . rand() . "." . $ext; // rename nama gambar
                        $path = "../files/" . $name; // buat path gambar
                        $uploaded = move_uploaded_file($_FILES['header']['tmp_name'], $path); // upload file
        
                        if($uploaded){
                            $updateData = $db->update_data($name, $_POST['judul_artikel'], $_POST['isi_artikel'], 
                            $_POST['status_publish'], $_POST['id_artikel'], $id_users);
        
                            if($insertData){
                                echo "<script>alert('Data Berhasil di Edit'); window.location.href = 'index.php';</script>"; 
                            } else {
                                echo "<script>alert('Data Gagal di Edit'); window.location.href = 'index.php';</script>"; 
                            }
                        } else {
                            echo "<script>alert('Data Gagal di Upload'); window.location.href = 'edit.php?id=".$id_artikel."';</script>";
                        }
                    } else {
                        echo "<script>alert('Ukuran Gambar Lebih dari 5 MB'); window.location.href = 'edit.php?id=".$id_artikel."';</script>";
                    }
                } else {
                    echo "<script>alert('Extension file tidak diizinkan'); window.location.href = 'edit.php?id=".$id_artikel."';</script>";
                }
            }
        } else {
            $updateData = $db->update_data('not_set', $_POST['judul_artikel'], $_POST['isi_artikel'],
            $_POST['status_publish'], $_POST['id_artikel'], $id_users);

            if($updateData){
                echo "<script>alert('Data Berhasil di Edit'); window.location.href = 'index.php';</script>";
            } else {
                echo "<script>alert('Data Gagal di Edit'); window.location.href = 'index.php';</script>";
            }
        }
    } else {
        echo "<script>alert('Anda belum memilih artikel'); window.location.href = 'index.php';</script>";
    }
} else if($aksi == "hapus"){
    // Lakukan Operasi Hapus Data
    $id_artikel = $_GET['id'];
    if(!empty($id_artikel)){
        $data = $db->get_by_id($id_artikel);

        if(file_exists('../files/'.$data['header']) && $data['header'])
            unlink('../files/'.$data['header']);

        $deleteData = $db->delete_data($id_artikel);
        if($deleteData){
            echo "<script>alert('Data Berhasil di Hapus'); window.location.href = 'index.php';</script>";
        } else {
            echo "<script>alert('Data Gagal di Hapus'); window.location.href = 'index.php';</script>";
        }
    } else {
        echo "<script>alert('Anda belum memilih artikel'); window.location.href = 'index.php';</script>";
    }
} else {
    // Kembali Ke index.php
    echo "
    <script>
        alert('Anda tidak memiliki akses untuk melakukan operasi');
        window.location.href = 'index.php';
    </script>
    ";
}

?>