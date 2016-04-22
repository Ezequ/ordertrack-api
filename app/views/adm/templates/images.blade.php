@if(count($object->getImagesForEdit()) > 0)
<div class="col-lg-12">
<?php 
    foreach ($object->getImagesForEdit() as $key => $info) 
    { 
        if($info['cantFotos'] > 0) 
        {
            ?><h3><?php if(isset($info['titulo_imagen'])) echo $info['titulo_imagen']; else echo "Imagenes"  ?></h3><p>(medidas recomendadas <?=$info['medidas'] ?>)</p>
            <?php
            for ($i=1; $i < $info['cantFotos'] ; $i++) {
                if($info['slider']) 
                $id_foto = $info['name']."_".$i; 
                else $id_foto = $info['name'];        
                $boton = ManejoArchivos::boton_editar_foto ( $id_foto, $info['folder'], 500, 400,  Config::get('constants.hd_imagenes').$info['folder'].Config::get('constants.pait')) ;
                 echo '<p>Imagen '.$i.': '.$boton.'</p>';
            }
         ?>
    <?php } 
    }?>   
</div>
@endif