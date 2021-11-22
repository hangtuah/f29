<?php
include 'dbase.php';

if($_GET && $_GET['action'] == 'padam'){
    $query = "delete from pengguna where id = ".$_GET['id'];

    if($query){
        $link->query($query);
    }
}


//List pengguna
$query = "select * from pengguna";
$data = array();

$result = $link->query($query);
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Tempahan Kenderaan</title>
</head>
<body>
    <ul>
        <li><a href="index.php">Utama</a></li>
        <li> <a href="pengguna.php">Pengguna</a></li>
        <li>Kenderaan</li>
        <li>Tempahan</li>
    </ul>
    <br>
    <a href="formPengguna.php"><button>Tambah Pengguna</button></a>
    <br>
    <table border="1">
        <tr>
            <td>Bil.</td>
            <td>Nama</td>
            <td>Email</td>
            <td>Telefon</td>
            <td>Ubah</td>
            <td>Padam</td>
        </tr>
        <?php
        $i = 1;
        foreach($data as $row){
            echo '<tr>';
            echo '<td>' .$i. '</td>';
            echo '<td>' . $row['nama'] . '</td>';
            echo '<td>' . $row['email'] . '</td>';
            echo '<td>' . $row['telefon'] . '</td>';
            echo '<td><a href="formPengguna.php?id='.$row['id'].'&action=ubah"><button>Ubah</button></a></td>';
            echo '<td><a href="pengguna.php?id='.$row['id'].'&action=padam"><button>Padam</button></a></td>';
            echo '</tr>';
            $i++;
        }
        ?>
    </table>
</body>
</html>