
<?php 

$settings = $this->get_settings_for_display();
$settings = $settings['custom_list'];




?>
<style>
    .xstudioapp_service_list{
        display:flex;
        justify-content:space-between;
        padding-bottom:20px;
        border-bottom:1px solid #ccc;
        padding-top:20px;
    }
    
    .xstudioapp_service_list_url{
        background-color:transparent;
        border:1px solid #ccc;
        width: 40px;
        height:40px;
        justify-content:center;
        display:flex;
        justify-content:"center";
        align-self:center;
        align-items:center;
         color:red
      
    }

     .xstudioapp_service_list_url a{
        text-transform:none
     }
.xstudioapp_service_list_square{
     
        width: 10px;
        height:10px;
        display:inline-block;
}

.xstduiaoapp_service_list_description{
    width: 60%;
  margin-left: 14px;
  max-width: 60%;
}

.xstudioapp_service_title_width{
    width: 30%;
    max-width:30%
}
</style>
<div>
     <?php foreach ( $settings as $item ) : ?>
        <div class="xstudioapp_service_list">
            <div class="xstudioapp_service_title_width">
                <h3 class="xstduiaoapp_service_title"> <?=$item['list_text']?>
                     <span class="xstudioapp_service_list_square"></span>
                </h3>
            </div>
            <div class="xstduiaoapp_service_list_description">
               <p><?= $item['list_description']['value'] ?? $item['list_description'] ?></p>

            </div>
            <span class="xstudioapp_service_list_url">
                <a href="<?=$item['list_url']?>">
                    <i class="<?=$item['list_icon']['value']?>"></i>
                 </a>
          </span>
        </div>
    <?php endforeach; ?>
</div>