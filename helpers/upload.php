<?php
  function upload($a='',$b='',$c=''){
      $handle = new \Verot\Upload\Upload($_FILES[$a]);
      $ex=explode('.',$_FILES[$a]['name']);
      $ext=$ex[(count($ex)-1)];
      if ($handle->uploaded) {
            
            // $handle->jpeg_quality   =  50 ;
            // $handle->jpeg_size      = 3072;
            // $handle->image_x        = 100;
            // $handle->image_y        = 100;
            // $handle->image_ratio    =  true ;
            $handle->file_new_name_body;
            $handle->file_new_name_ext=$ext;
            $handle->file_force_extension=false;
            $handle->file_overwrite=true;
            $handle->file_safe_name = true;
            $handle->process($c.'assets/unggah/'.$b.'/');
            if ($handle->processed) {
                return $handle->file_dst_name;
            } 
            else{
                return false;
            }
      }
  }