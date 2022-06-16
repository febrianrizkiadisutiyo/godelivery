<?php
include 'connection.php';
if($_SERVER['REQUEST_METHOD'] !== 'POST'){
    http_response_code(400);
    $reply['error'] = 'POST method required';
    echo json_encode($reply);
    exit();
}

// get input data post

$jenis_barang = $_POST['jenis_barang'] ??'';
$nama_barang = $_POST['nama_barang'] ??'';
$photo_barang = $_POST['photo_barang']??'';
$stok = $_POST['stok']??'';
$harga = $_POST['harga']??'';
$deskripsi = $_POST['deskripsi']??'';

$isValidated = true;
if(empty($jenis_barang)){
    $reply['error'] = 'jenis barang harus diisi';
    $isValidated = false;
}    
if(empty($nama_barang)){
    $reply['error'] = 'nama barang harus diisi';
    $isValidated = false;
}
if(empty($photo_barang)){
    $reply['error'] = 'sertakan photo barang';
    $isValidated = false;
}
if(empty($stok)){
    $reply['error'] = 'isi stok barang';
    $isValidated = false;
}
if(empty($harga)){
    $reply['error'] = 'harga harus diisi';
    $isValidated = false;
}
if(empty($deskripsi)){
    $reply['error'] = 'deskripsi harus diisi';
    $isValidated = false;
}

/*
 * Jika filter gagal
 */
if(!$isValidated){
    echo json_encode($reply);
    http_response_code(400);
    exit(0);
}

try{
    $query ="INSERT INTO barang (jenis_barang, nama_barang, photo_barang, stok, harga, deskripsi) VALUES (:jenis_barang, :nama_barang, :photo_barang, :stok, :harga, :harga, :deskkripsi)";
    $statement = $connection->prepare($query);


}catch (Exception $exception) {
    $reply['error'] = $exception->getMessage();
    echo json_encode($reply);
    http_response_code(400);
    exit(0);
}