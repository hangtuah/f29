<?php
include 'dbase.php';

$penggunaQuery = "select * from pengguna";
$dataPengguna = array();

$resultPengguna = $link->query($penggunaQuery);
while ($row = $resultPengguna->fetch_assoc()) {
    $dataPengguna[] = $row;
}

$kenderaanQuery = "select * from kenderaan";
$dataKenderaan = array();

$resultKenderaan = $link->query($kenderaanQuery);
while ($row = $resultKenderaan->fetch_assoc()) {
    $dataKenderaan[] = $row;
}

$tarikh = '';
$pengguna_id = '';
$kenderaan_id = '';
$submit = 'DAFTAR';
$id = 0;

if($_GET && $_GET['action'] == 'ubah'){
    $query = "select * from booking where id = " . $_GET['id'];

    $result = $link->query($query);
    $row = $result->fetch_array();

    $pengguna_id = $row['pengguna_id'];
    $kenderaan_id = $row['kenderaan_id'];
    $tarikh = $row['tarikh'];
    $submit = 'UBAH';
    $id = $_GET['id'];
}

if($_POST){
$query = '';
    if($_POST['submit'] == 'DAFTAR'){
        $query = "insert into booking (pengguna_id,kenderaan_id,tarikh,status)values
        ('".$_POST['pengguna_id']."','".$_POST['kenderaan_id']."','".$_POST['tarikh']."',1)";
    }else{
        $query = "update booking set pengguna_id = '".$_POST['pengguna_id']."', kenderaan_id = '".$_POST['kenderaan_id']."', tarikh = '".$_POST['tarikh']."' where id = ".$_POST['id'];
    }

    echo $query;
    if($query){
        $link->query($query);
    }

    header('Location: booking.php');
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
    <h2>Tambah Tempahan</h2>
    <form action="formBooking.php" method="post">
    <table>
        <tr>
            <td>Pengguna</td>
            <td>: 
                <select name="pengguna_id">
                    <?php 
                        foreach($dataPengguna as $data){
                            $selected = '';
                            if($data["id"] == $pengguna_id){
                                $selected = 'selected';
                            }
                            echo '<option value="'.$data["id"].'" '.$selected.'>'.$data["nama"].'</option>';
                        }
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <td>Kenderaan</td>
            <td>: 
                <select name="kenderaan_id">
                    <?php 
                        foreach($dataKenderaan as $data){
                            $selected = '';
                            if($data["id"] == $kenderaan_id){
                                $selected = 'selected';
                            }
                            echo '<option value="'.$data["id"].'" '.$selected.'>'.$data["pengeluar"].' '. $data["model"].' - '.$data["plat"].'</option>';
                        }
                    ?>
                </select>
            </td>
            <tr>
            <td>Tarikh</td>
            <td>: <input type="text" name="tarikh" value="<?php echo $tarikh;?>"> </td>
        </tr>
            </tr>
        </tr>
        <tr>
            <td><input type="hidden" name="id" value="<?php echo $id;?>"></td>
            <td><input type="submit" name="submit" value="<?php echo $submit;?>"></td>
        </tr>
    </table>
    </form>
</body>
</html>