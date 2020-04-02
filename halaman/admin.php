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
$url='admin';

if(isset($_POST['simpan'])){
    $file=upload('img_rumah','rumah');
    if($file!=false){
        $data['img_rumah']=$file;
    }
    $file=upload('point_marker','marker');
    if($file!=false){
        $data['point_marker']=$file;
    }
    if($_POST['id_rumah']==""){
        $data['nama_rumah']=$_POST['nama_rumah'];
        $data['alamat']=$_POST['alamat'];
        $data['latitude']=$_POST['latitude'];
        $data['langitude']=$_POST['langitude'];
        $data['status']=$_POST['status'];

        


        $db->insert("data_rumah",$data); 
        ?>  
        <script type="text/javascript">
        window.alert('sukses disimpan');
        window.location.href="<?=url('admin')?>";
        </script>   
        <?php
        
    }
    else {
        $data['nama_rumah']=$_POST['nama_rumah'];
        $data['alamat']=$_POST['alamat'];
        $data['latitude']=$_POST['latitude'];
        $data['langitude']=$_POST['langitude'];
        $data['status']=$_POST['status'];
       
        $db->where('id_rumah',$_POST['id_rumah']);
        $db->update("data_rumah",$data); 
        ?>  
        <script type="text/javascript">
        window.alert('sukses diubah');
        window.location.href="<?=url('admin')?>";
        </script>   
        <?php
    }
}
if(isset($_GET['hapus'])){
        $db->where("id_rumah",$_GET['id']);
        $db->delete("data_rumah"); 
        ?>  
        <script type="text/javascript">
        window.alert('sukses dihapus');
        window.location.href="<?=url('admin')?>";
        </script>   
        <?php
}


if(isset($_GET['tambah']) OR isset($_GET['ubah'])) {
$id_rumah="";
$nama_rumah="";
$alamat="";
$GeoJSON="";
$latitude="";
$langitude="";
$status="";
$img_rumah="";
$point_marker="";

if(isset($_GET['ubah']) AND isset ($_GET['id'])){
    $id=$_GET['id'];
    $db->where('id_rumah',$id);
    $row=$db->getOne('data_rumah');
    if($db->count>0){
        $id_rumah=$row['id_rumah'];
        $nama_rumah=$row['nama_rumah'];
        $alamat=$row['alamat'];
        $GeoJSON=$row['GeoJSON'];
        $latitude=$row['latitude'];
        $langitude=$row['langitude'];
        $status=$row['status'];
        $img_rumah=$row['img_rumah'];
        $point_marker=$row['point_marker'];
    }
}
?>

<?=content_open('Form Rumah Sewa')?>
<form method="post" enctype="multipart/form-data">
<?=input_hidden('id_rumah',$id_rumah)?>
  <div class="form-group">
    <label>Nama Pemilik Rumah</label>
    <?=input_text('nama_rumah',$nama_rumah)?>
  </div>
  <div class="form-group">
    <label>Alamat</label>
    <?=input_text('alamat',$alamat)?>
  </div>
  <div class="form-group">
    <label>Latitude</label>
    <?=input_text('latitude',$latitude)?>
  </div>
  <div class="form-group">
    <label>Langitude</label>
    <?=input_text('langitude',$langitude)?>
  </div>
  <div class="form-group">
    <label>Status</label>
    <?=input_text('status',$status)?>
  </div>
  <div class="form-group">
    <label>Gambar Rumah</label>
    <?=input_file('img_rumah',$img_rumah)?>
  </div>
  <div class="form-group">
    <label>Point Marker</label>
    <?=input_file('point_marker',$point_marker)?>
  </div>
  <button type="submit" name="simpan" class="btn btn-info">Simpan</button>
</form>
<?=content_close()?>
<?php } else { ?>

<?=content_open('Data Rumah Sewa')?>

<a href="<?=url($url.'&tambah')?>" class="btn btn-success btn-lg btn-block">Tambah</a><br>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Pemilik Rumah</th>
                <th>Alamat</th>
                <th>Latitude</th>
                <th>Longitude</th>
                <th>Status</th>
                <th>Gambar Rumah</th>
                <th>Point Marker</th>
                <th>Option</th>
            </tr>
        </thead>

    <tbody>
        <?php
            $no=1;
            $getdata=$db->get('data_rumah');
            foreach($getdata as $row){
            ?>
                <tr>
                    <td><?=$no?></td>
                    <td><?=$row['nama_rumah']?></td>
                    <td><?=$row['alamat']?></td>
                    <td><?=$row['latitude']?></td>
                    <td><?=$row['langitude']?></td> 
                    <td><?=$row['status']?></td>  
                    <td class="text-center"><?=($row['img_rumah']==''?'-':'<img src="'.assets('unggah/rumah/'.$row['img_rumah']).'"width=40px">')?></td>
                    <td class="text-center"><?=($row['point_marker']==''?'-':'<img src="'.assets('unggah/marker/'.$row['point_marker']).'"width=20px">')?></td>
                    <td>
                    <a href="<?=url($url.'&ubah&id='.$row['id_rumah'])?>" class="btn btn-info"> <i class="fa fa-edit"></i></a>
                    <a href="<?=url($url.'&hapus&id='.$row['id_rumah'])?>" onclick="return confirm('Apakah anda yakin ingin menghapus data?')" class="btn btn-danger"><i class="fa fa-trash"></i></a>
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