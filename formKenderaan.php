<?php
include 'dbase.php';

$model = '';
$pengeluar = '';
$plat = '';
$submit = 'DAFTAR';
$id = 0;

if($_GET && $_GET['action'] == 'ubah'){
    $query = "select * from kenderaan where id = " . $_GET['id'];

    $result = $link->query($query);
    $row = $result->fetch_array();

    $model = $row['model'];
    $pengeluar = $row['pengeluar'];
    $plat = $row['plat'];
    $submit = 'UBAH';
    $id = $_GET['id'];
}

if($_POST){
$query = '';
    if($_POST['submit'] == 'DAFTAR'){
        $query = "insert into kenderaan (model,pengeluar,plat,status)values
        ('".$_POST['model']."','".$_POST['pengeluar']."','".$_POST['plat']."',1)";
    }else{
        $query = "update kenderaan set model = '".$_POST['model']."', pengeluar = '".$_POST['pengeluar']."', plat = '".$_POST['plat']."' where id = ".$_POST['id'];
    }

    echo $query;
    if($query){
        $link->query($query);
    }

    header('Location: kenderaan.php');
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
    <h2>Tambah Kenderaan</h2>
    <form action="formKenderaan.php" method="post">
    <table>
        <tr>
            <td>Model</td>
            <td>: <input type="text" name="model" value="<?php echo $model;?>"> </td>
        </tr>
        <tr>
        <td>Pengeluar</td>
            <td>: <input type="text" name="pengeluar" value="<?php echo $pengeluar;?>"> </td>
        </tr>
        <tr>
        <td>No. Plat Kenderaan</td>
            <td>: <input type="text" name="plat" value="<?php echo $plat;?>"> </td>
        </tr>
        <tr>
            <td><input type="hidden" name="id" value="<?php echo $id;?>"></td>
            <td><input type="submit" name="submit" value="<?php echo $submit;?>"></td>
        </tr>
    </table>
    </form>
</body>
</html>