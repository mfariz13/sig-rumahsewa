<?php
$setTemplate = false;
if ($_POST['id']) {
    $id = $_POST['id'];
    $db->where('id_rumah', $id);

    echo $db->getLastQuery();
}


?>
<?php
$no = 1;
$row = $db->getOne('data_rumah');
if ($db->count > 0) {
    $id_rumah = $row['id_rumah'];
    $nama_rumah = $row['nama_rumah'];
    $alamat = $row['alamat'];
    $status = $row['status'];

?>
    <!-- <form method="post"> -->
    <table class="table table-bordered">
        <tbody>
            <tr>
                <div style="text-align:center;"><?= ($row['img_rumah'] == '' ? '-' : '<img src="' . assets('unggah/rumah/' . $row['img_rumah']) . '"width=80%">') ?></div><br>
            </tr>
            <tr>
                <td>Nama :</td>
                <td><?= $row['nama_rumah'] ?></td>
            </tr>
            <tr>
                <td>Alamat :</td>
                <td><?= $row['alamat'] ?></td>
            </tr>
            <tr>
                <td>Status</td>
                <td><?= $row['status'] ?></td>
            </tr>
            <tr>
                <td>Luas Tanah</td>
                <td><?= $row['luas_tanah'] ?></td>
            </tr>
            <tr>
                <td>latitur</td>
                <td><?= $row['latitude'] ?></td>
            </tr>

            <td>Langitude</td>
            <td><?= $row['langitude'] ?></td>
            </tr>
        </tbody>
    </table>
    </form>

<?php
}
?>