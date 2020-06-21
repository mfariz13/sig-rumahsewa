<?php
$setTemplate = false;
if ($_POST['id']) {
    $id = $_POST['id'];
    $db->where('tn_id', $id);

}


?>
<?php
$no = 1;
$row = $db->getOne('data_rumah');
if ($db->count > 0) {
    $tn_id = $row['tn_id'];
    $tn_pemilik = $row['tn_pemilik'];
    $tn_almt = $row['tn_almt'];
    $tn_status = $row['tn_status'];

?>
    <table class="table table-bordered">
        <tbody>
            <tr>              
                    <div style="text-align:center;"><?= ($row['tn_img'] == '' ? '-' : '<img src="' . assets('unggah/rumah/' . $row['tn_img']) . '"width=60%">') ?></div><br>
            </tr>
            <tr>
                <td>Nama :</td>
                <td><?= $row['tn_pemilik'] ?></td>
            </tr>
            <tr>
                <td>Alamat :</td>
                <td><?= $row['tn_almt'] ?></td>
            </tr>
            <tr>
                <td>Status</td>
                <td><?= $row['tn_status'] ?></td>
            </tr>
            <tr>
                <td>Luas Tanah</td>
                <td><?= $row['tn_luas'] ?></td>
            </tr>
            <tr>
                <td>Blok</td>
                <td><?= $row['tn_blok'] ?></td>
            </tr>
            <tr>
                <td>Latitude</td>
                <td><?= $row['tn_lat'] ?></td>
            </tr>

            <td>Langitude</td>
            <td><?= $row['tn_lang'] ?></td>
            </tr>
        </tbody>
    </table>
    </form>

<?php
}
?>