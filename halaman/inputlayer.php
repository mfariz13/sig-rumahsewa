<?php
 $setTemplate=true;
if($setTemplate==True){
    if($session->get("logged")!==true){
        redirect(url('login'));
    }
}
?>
<?php
$title="Rumah Sewa Sumedang";
$judul="Rumah sewa Sumedang";
$url='inputlayer';

if(isset($_POST['simpan'])){
    $file=upload('geojson','geojson');
    if($file!=false){
        $data['geojson']=$file;
    }
if($_POST['id_layer']==""){
    $data['nama_layer']=$_POST['nama_layer'];

    $db->insert("geojson",$data); 
    ?>  
    <script type="text/javascript">
    window.alert('sukses disimpan');
    window.location.href="<?=url('inputlayer')?>";
    </script>   
    <?php
}
else {
    $data['nama_layer']=$_POST['nama_layer'];
    $db->where('id_layer',$_POST['id_layer']);
    $db->update("geojson",$data); 
    ?>  
    <script type="text/javascript">
    window.alert('sukses diubah');
    window.location.href="<?=url('inputlayer')?>";
    </script>   
    <?php
    }
}
if(isset($_GET['hapus'])){
        $db->where("id_layer",$_GET['id']);
        $db->delete("geojson"); 
        ?>  
        <script type="text/javascript">
        window.alert('sukses dihapus');
        window.location.href="<?=url('inputlayer')?>";
        </script>   
        <?php

}
if(isset($_GET['tambah']) OR isset($_GET['ubah'])) {
$id_layer="";
$nama_layer="";
$geojson="";
if(isset($_GET['ubah']) AND isset ($_GET['id'])){
    $id=$_GET['id'];
    $db->where('id_layer',$id);
    $row=$db->getOne('geojson');
    if($db->count>0){
        $id_layer=$row['id_layer'];
        $nama_layer=$row['nama_layer'];
        $geojson=$row['geojson'];
    }
}
?>
<?=content_open('Form Rumah Sewa')?>
<form method="post" enctype="multipart/form-data">
<?=input_hidden('id_layer',$id_layer)?>
<div class="form-group">
    <label>Nama Layer</label>
    <?=input_text('nama_layer',$nama_layer)?>
  </div>
  <div class="form-group">
    <label>File GeoJSON</label>
    <?=input_file('geojson',$geojson)?>
  </div>
  <button type="submit" name="simpan" class="btn btn-info">Simpan</button>
</form>
<?=content_close()?>
<?php } else { ?>


<?=content_open('Data Rumah Sewa')?>
<a href="<?=url($url.'&tambah')?>" class="btn btn-success">Tambah</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Layer</th>
                <th>GeoJson</th>
                <th>Aksi</th>
            </tr>
        </thead>

    <tbody>
        <?php
            $no=1;
            $getdata=$db->get('geojson');
            foreach($getdata as $row){
            ?>
                <tr>
                    <td><?=$no?></td>
                    <td><?=$row['nama_layer']?></td>
                    <td><a href="<?=assets('unggah/geojson/'.$row['geojson'])?>" target="_BLANK"><?=$row['geojson']?></a></td>
                    <td>
                    <a href="<?=url($url.'&ubah&id='.$row['id_layer'])?>" class="btn btn-info"> <i class="fa fa-edit"></i> Ubah</a>
                    <a href="<?=url($url.'&hapus&id='.$row['id_layer'])?>" onclick="return confirm('Apakah anda yakin ingin menghapus data?')" class="btn btn-danger">Hapus</a>
                    </td>
                </tr>
                <?php
                $no++;
            }
        ?>
    </tbody>
</table>
<?=content_close()?>
        <?php } ?>