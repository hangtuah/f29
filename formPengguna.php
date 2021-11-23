<?php
include 'dbase.php';

$nama = '';
$email = '';
$telefon = '';
$submit = 'DAFTAR';
$id = 0;

if($_GET && $_GET['action'] == 'ubah'){
    $query = "select * from pengguna where id = " . $_GET['id'];

    $result = $link->query($query);
    $row = $result->fetch_array();

    $nama = $row['nama'];
    $email = $row['email'];
    $telefon = $row['telefon'];
    $submit = 'UBAH';
    $id = $_GET['id'];
}

if($_POST){
$query = '';
    if($_POST['submit'] == 'DAFTAR'){
        $query = "insert into pengguna (nama,email,telefon,status)values
        ('".$_POST['nama']."','".$_POST['email']."','".$_POST['telefon']."',1)";
    }else{
        $query = "update pengguna set nama = '".$_POST['nama']."', email = '".$_POST['email']."', telefon = '".$_POST['telefon']."' where id = ".$_POST['id'];
    }

    echo $query;
    if($query){
        $link->query($query);
    }

    header('Location: pengguna.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php include 'menu.php'; ?>
    <br>
    <h2>Tambah Pengguna</h2>
    <form action="formPengguna.php" method="post">
    <table>
        <tr>
            <td>Nama</td>
            <td>: <input type="text" name="nama" value="<?php echo $nama;?>"> </td>
        </tr>
        <tr>
        <td>Email</td>
            <td>: <input type="text" name="email" value="<?php echo $email;?>"> </td>
        </tr>
        <tr>
        <td>Telefon</td>
            <td>: <input type="text" name="telefon" value="<?php echo $telefon;?>"> </td>
        </tr>
        <tr>
            <td><input type="hidden" name="id" value="<?php echo $id;?>"></td>
            <td><input type="submit" name="submit" value="<?php echo $submit;?>"></td>
        </tr>
    </table>
    </form>
</body>
</html>