<?php
$setTemplate = true;
if ($setTemplate == True) {
  if ($session->get("logged") !== true) {
    redirect(url('login'));
  }
}
?>
<?php
$title = "Rumah Sewa Sumedang";
$judul = "Rumah sewa Sumedang";
$url = 'admin';

if (isset($_POST['simpan'])) {
  $file = upload('tn_img', 'rumah');
  if ($file != false) {
    $data['tn_img'] = $file;
  }
  $file = upload('tn_marker', 'marker');
  if ($file != false) {
    $data['tn_marker'] = $file;
  }
  if ($_POST['tn_id'] == "") {
    $data['tn_pemilik'] = $_POST['tn_pemilik'];
    $data['tn_almt'] = $_POST['tn_almt'];
    $data['tn_luas'] = $_POST['tn_luas'];
    $data['tn_lat'] = $_POST['tn_lat'];
    $data['tn_lang'] = $_POST['tn_lang'];
    $data['tn_status'] = $_POST['tn_status'];
    $data['tn_blok'] = $_POST['tn_blok'];

    $db->insert("data_rumah", $data);
?>
    <script type="text/javascript">
      window.alert('sukses disimpan');
      window.location.href = "<?= url('admin') ?>";
    </script>
  <?php
  } else {
    $data['tn_pemilik'] = $_POST['tn_pemilik'];
    $data['tn_almt'] = $_POST['tn_almt'];
    $data['tn_luas'] = $_POST['tn_luas'];
    $data['tn_lat'] = $_POST['tn_lat'];
    $data['tn_lang'] = $_POST['tn_lang'];
    $data['tn_status'] = $_POST['tn_status'];
    $data['tn_blok'] = $_POST['tn_blok'];

    $db->where('tn_id', $_POST['tn_id']);
    $db->update("data_rumah", $data);
  ?>
    <script type="text/javascript">
      window.alert('sukses diubah');
      window.location.href = "<?= url('admin') ?>";
    </script>
  <?php
  }
}
if (isset($_GET['hapus'])) {
  $db->where("tn_id", $_GET['id']);
  $db->delete("data_rumah");
  ?>
  <script type="text/javascript">
    window.alert('sukses dihapus');
    window.location.href = "<?= url('admin') ?>";
  </script>
<?php
}


if (isset($_GET['tambah']) or isset($_GET['ubah'])) {
  $row = $db->getOne('data_rumah');
  $tn_id = "";
  $tn_pemilik = "";
  $tn_almt = "";
  $tn_luas = "";
  $tn_blok = "";
  $tn_lat = "";
  $tn_lang = "";
  $tn_status = "";
  $tn_img = "";
  $tn_marker = "";

  if (isset($_GET['ubah']) and isset($_GET['id'])) {
    $id = $_GET['id'];
    $db->where('tn_id', $id);
    $row = $db->getOne('data_rumah');
    if ($db->count > 0) {
      $tn_id = $row['tn_id'];
      $tn_pemilik = $row['tn_pemilik'];
      $tn_almt = $row['tn_almt'];
      $tn_luas = $row['tn_luas'];
      $tn_blok = $row['tn_blok'];
      $tn_lat = $row['tn_lat'];
      $tn_lang = $row['tn_lang'];
      $tn_status = $row['tn_status'];
      $tn_img = $row['tn_img'];
      $tn_marker = $row['tn_marker'];
    }
  }
?>

  <?= content_open('Form Rumah Sewa') ?>
  <form method="post" enctype="multipart/form-data">
    <?= input_hidden('tn_id', $tn_id) ?>
    <div class="form-group">
      <label>Nama Pemilik Rumah</label>
      <?= input_text('tn_pemilik', $tn_pemilik) ?>
    </div>
    <div class="form-group">
      <label>tn_almt</label>
      <?= input_text('tn_almt', $tn_almt) ?>
    </div>
    <div class="form-group">
      <label>Luas Tanah</label>
      <?= input_text('tn_luas', $tn_luas) ?>
    </div>
    <div class="form-group">
      <label>tn_lat</label>
      <?= input_text('tn_lat', $tn_lat) ?>
    </div>
    <div class="form-group">
      <label>tn_lang</label>
      <?= input_text('tn_lang', $tn_lang) ?>
    </div>
    <p>

      <label>tn_status : </label>
      <input type="radio" name="tn_status" class="tn_status" value="Rumah Tinggal" <?php if ($row['tn_status'] == 'Rumah Tinggal') echo 'checked' ?>> Rumah Tinggal</label>
      <input type="radio" name="tn_status" class="tn_status" value="Berubah Fungsi" <?php if ($row['tn_status'] == 'Berubah Fungsi') echo 'checked' ?>> Berubah fungsi</label>
    </p>
    <div class="form-control">
    
      <label for="tn_blok">Pilih Blok</label>
      <select name="tn_blok" id="tn_blok">
        <option class="tn_blok" value="Blok Empang" <?php if ($row['tn_blok'] == 'Blok Empang') echo 'selected' ?>>Blok Empang</option>
        <option class="tn_blok" value="Blok Babakan"<?php if ($row['tn_blok'] == 'Blok Babakan') echo 'selected' ?>>Blok Babakan</option>
      </select>
    </div>
    <div class="form-group">
      <label>Gambar Rumah</label>
      <?= input_file('tn_img', $tn_img) ?>
    </div>
    <div class="form-group">
      <label>Point Marker</label>
      <?= input_file('tn_marker', $tn_marker) ?>
    </div>
    <button type="submit" name="simpan" class="btn btn-info">Simpan</button>
  </form>
  <?= content_close() ?>
<?php } else { ?>

  <?= content_open('Data Rumah Sewa') ?>

  <a href="<?= url($url . '&tambah') ?>" class="btn btn-success btn-lg btn-block">Tambah</a><br>
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>No</th>
        <th>Nama Pemilik Rumah</th>
        <th>Alamat</th>
        <th>Luas Tanah</th>
        <th>Latitude</th>
        <th>Langitude</th>
        <th>Status</th>
        <th>Blok Tanah</th>
        <th>Gambar Rumah</th>
        <th>Point Marker</th>
        <th>Option</th>
      </tr>
    </thead>

    <tbody>
      <?php
      $no = 1;
      $getdata = $db->get('data_rumah');
      foreach ($getdata as $row) {
      ?>
        <tr>
          <td><?= $no ?></td>
          <td><?= $row['tn_pemilik'] ?></td>
          <td><?= $row['tn_almt'] ?></td>
          <td><?= $row['tn_luas'] ?></td>
          <td><?= $row['tn_lat'] ?></td>
          <td><?= $row['tn_lang'] ?></td>
          <td><?= $row['tn_status'] ?></td>
          <td><?= $row['tn_blok'] ?></td>
          <td class="text-center"><?= ($row['tn_img'] == '' ? '-' : '<img src="' . assets('unggah/rumah/' . $row['tn_img']) . '"width=40px">') ?></td>
          <td class="text-center"><?= ($row['tn_marker'] == '' ? '-' : '<img src="' . assets('unggah/marker/' . $row['tn_marker']) . '"width=20px">') ?></td>
          <td>
            <a href="<?= url($url . '&ubah&id=' . $row['tn_id']) ?>" class="btn btn-info"> <i class="fa fa-edit"></i></a>
            <a href="<?= url($url . '&hapus&id=' . $row['tn_id']) ?>" onclick="return confirm('Apakah anda yakin ingin menghapus data?')" class="btn btn-danger"><i class="fa fa-trash"></i></a>
          </td>
        </tr>
      <?php
        $no++;
      }
      ?>
    </tbody>
  </table>
  <?= content_close() ?>
<?php } ?>