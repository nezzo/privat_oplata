<?php echo $header; ?>
<div id="content">
  <div class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
    <?php } ?>
  </div>
  <?php if ($error_warning) { ?>
  <div class="warning"><?php echo $error_warning; ?></div>
  <?php } ?>
  <div class="box">
    <div class="heading">
      <h1><img src="view/image/privat_oplata.png" alt="" /> <?php echo $heading_title; ?></h1>
      <div class="buttons"><a onclick="$('#form').submit();" class="button"><?php echo $button_save; ?></a><a onclick="location = '<?php echo $cancel; ?>';" class="button"><?php echo $button_cancel; ?></a></div>
    </div>
    <div class="content">
      <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">
        <table class="form">
        <tr>
         <td><span class="required">*</span> <?=$entry_id_shop?></td>
            <td><input type="text" name="privat_oplata_id_shop" value="<?=$privat_oplata_id_shop?>" />
              <?php if ($error_id_shop):?><span class="error"><?=$error_id_shop?></span><?php endif?>
          </td>
        </tr>
        <tr>
          <td><span class="required">*</span> <?=$entry_pass_shop?></td>
            <td><input type="text" name="privat_oplata_pass_shop" value="<?=$privat_oplata_pass_shop?>" />
              <?php if ($error_pass_shop):?><span class="error"><?=$error_pass_shop?></span><?php endif?>
          </td>
        </tr>
        <tr>
          <td><span class="required">*</span> <?=$entry_action?></td>
            <td><input type="text" name="privat_oplata_action" value="<?=$privat_oplata_action?>" />
              <?php if ($error_action):?><span class="error"><?=$error_action?></span><?php endif?>
          </td>
        </tr>
        <tr>
          <td><?=$entry_total?></td>
            <td><input type="text" name="privat_oplata_total" value="<?=$privat_oplata_total?>" /></td>
        </tr>
        <tr>
          <td><?=$entry_order_status?></td>
            <td>
              <select name="privat_oplata_order_status_id">
                <?php
                  foreach ($order_statuses as $order_status):
                    $order_status_id = $order_status['order_status_id'];
                      $sel = ($order_status_id == $privat_oplata_order_status_id);
                ?>
                  <option <?php if ($sel):?>selected="selected"<?php endif?> value="<?=$order_status_id?>">
                    <?=$order_status['name']?>
                  </option>
                <?php endforeach?>
              </select>
            </td>
          </tr>
          <tr>
            <td><?php echo $entry_geo_zone; ?></td>
            <td><select name="privat_oplata_geo_zone_id">
                <option value="0"><?php echo $text_all_zones; ?></option>
                <?php foreach ($geo_zones as $geo_zone) { ?>
                <?php if ($geo_zone['geo_zone_id'] == $cod_1_geo_zone_id) { ?>
                <option value="<?php echo $geo_zone['geo_zone_id']; ?>" selected="selected"><?php echo $geo_zone['name']; ?></option>
                <?php } else { ?>
                <option value="<?php echo $geo_zone['geo_zone_id']; ?>"><?php echo $geo_zone['name']; ?></option>
                <?php } ?>
                <?php } ?>
              </select></td>
          </tr>
          <tr>
            <td><?=$entry_status?></td>
              <td>
                <select name="privat_oplata_status">
                  <option <?php if ($privat_oplata_status): ?>selected="selected"<?php endif?> value="1">
                      <?=$text_enabled?>
                  </option>
                  <option <?php if (!$privat_oplata_status): ?>selected="selected"<?php endif?> value="0">
                      <?=$text_disabled?>
                  </option>
                </select>
            </td>
          </tr>
          <tr>
            <td><?=$entry_language?></td>
              <td>
                <select name="privat_oplata_language">
                    <option <?php if ($privat_oplata_language == 'ru'): ?>selected="selected"<?php endif?> value="ru">
                      ru
                    </option>
                    <option <?php if ($privat_oplata_language == 'en'): ?>selected="selected"<?php endif?> value="en">
                      en
                    </option>
                </select>
              </td>
          </tr>




          <tr>
            <td><?php echo $entry_sort_order; ?></td>
            <td><input type="text" name="privat_oplata_sort_order" value="<?php echo $privat_oplata_sort_order; ?>" size="1" /></td>
          </tr>
        </table>
      </form>
    </div>
  </div>
</div>
<?php echo $footer; ?> 