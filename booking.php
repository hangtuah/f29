<?php
include 'dbase.php';

if($_GET && $_GET['action'] == 'padam'){
    $query = "delete from booking where id = ".$_GET['id'];

    if($query){
        $link->query($query);
    }
}


//List booking
$query = "select a.id, a.tarikh, b.nama, c.model, c.pengeluar, c.plat from booking a 
            inner join pengguna b on b.id = a.pengguna_id 
            inner join kenderaan c on c.id = a.kenderaan_id ";
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
    <?php include 'menu.php'; ?>
    <br>
    <a href="formBooking.php"><button>Tambah Tempahan</button></a>
    <br>
    <table border="1">
        <tr>
            <td>Bil.</td>
            <td>Pengguna</td>
            <td>Kenderaan </td>
            <td>Ubah</td>
            <td>Padam</td>
        </tr>
        <?php
        $i = 1;
        foreach($data as $row){
            echo '<tr>';
            echo '<td>' .$i. '</td>';
            echo '<td>' . $row['nama'] . '</td>';
            echo '<td>' . $row['pengeluar'] . ' ' .  $row['model'] .' - '. $row['plat'] . '</td>';
            echo '<td><a href="formBooking.php?id='.$row['id'].'&action=ubah"><button>Ubah</button></a></td>';
            echo '<td><a href="booking.php?id='.$row['id'].'&action=padam"><button>Padam</button></a></td>';
            echo '</tr>';
            $i++;
        }
        ?>
    </table>
</body>
</html>