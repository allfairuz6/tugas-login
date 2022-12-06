<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Origin, Content-Type, Authorization, Accept, X-Requested-With, x-xsrf-token");
header("Content-Type: application/json; charset=utf-8");

    include "config.php";
    // File upload path
    $targetDir = "uploads/";
    $fileName = basename($_FILES["foto_siswa"]["name"]);
    $targetFilePath = $targetDir . $fileName;
    $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);


        // Allow certain formats
        $allowTypes = array('jpg','png','jpeg','gif','pdf');
        if(in_array($fileType, $allowTypes)){
            // Upload file to server
            if(move_uploaded_file($_FILES["foto_siswa"]["tmp_name"], $targetFilePath)){
                // Insert image file name into database
                $insert = mysqli_query($kon, "INSERT INTO tbl_mahasiswa (
                    'kd', 'npm', 'nama_mahasiswa', 'jenis_kelamin', 'jurusan', 'foto_mahasiswa')
                    VALUES (
                    '',
                    '$_POST[npm]',
                    '$_POST[nama_mahasiswa]',
                    '$_POST[jenis_kelamin]',
                    '$_POST[jurusan]',
                    '$fileName')");

if($insert){
    $result = json_encode(array('error'=>false, 'msg'=>'Data berhasil disimpan'));
}else{
    $result = json_encode(array('error'=>true, 'msg'=>'Data gagal disimpan'));
}

echo $result;
                }else{
                    $result = json_encode(array('error'=>true, 'msg'=>'Data gagal disimpan'));
                    echo $result;
                }
           
        }
