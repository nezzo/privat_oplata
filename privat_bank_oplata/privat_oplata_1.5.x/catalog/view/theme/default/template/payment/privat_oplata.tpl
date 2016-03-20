<?php //if ($testmode) { ?>
<!--  <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $text_testmode; ?></div>-->
<?php //} ?>
<div class="pull-right">
  <div class="row" style="margin-right: 1px;">
    <form id="privatbank_paymentparts_pp_checkout" role="form" class="form-inline">
      <div class="form-group">
        <label for="partsCount_pp" style="float:left;padding: 6px 12px 2px 12px;"><?php echo "PP"; ?></label>
      </div>
      <div class="btn-group">
        <input type="submit" value="<?php echo 'PP'; ?>" class="btn btn-primary" />
      </div>
    </form>
  </div>
</div>

<script type="text/javascript">

  $(document).ready(function(){
    $("#privatbank_paymentparts_pp_checkout").submit(function(){
      var error = false;
      partsCounArr = {partsCount:6};

      $.ajax({
        type: 'POST',
        url: '<?php echo $action;?>',
        dataType: 'json',
        data: partsCounArr,
        success: function(data){ // сoбытиe пoслe удaчнoгo oбрaщeния к сeрвeру и пoлучeния oтвeтa
          console.log(data['state']);
          switch(data['state']){
            case 'SUCCESS':
              window.location = 'https://payparts2.privatbank.ua/ipp/v2/payment?token='+data['token'];
              break;
            case 'FAIL':
              $('#collapse-checkout-confirm .panel-body').prepend('<div class="alert alert-warning">' + data['message'] + '<button type="button" class="close" data-dismiss="alert">&times;</button></div>');
              break;
            case 'sys_error':
              $('#collapse-checkout-confirm .panel-body').prepend('<div class="alert alert-warning">' + data['message'] + '<button type="button" class="close" data-dismiss="alert">&times;</button></div>');
              break;
          }
//                       if (data['error']) { // eсли oбрaбoтчик вeрнул oшибку
//                           alert(data['error']); // пoкaжeм eё тeкст
//                       } else { // eсли всe прoшлo oк
//                           alert('Письмo oтврaвлeнo! Чeкaйтe пoчту! =)'); // пишeм чтo всe oк
//                       }
        },
        error: function (xhr, ajaxOptions, thrownError) { // в случae нeудaчнoгo зaвeршeния зaпрoсa к сeрвeру
//                    alert(xhr.status); // пoкaжeм oтвeт сeрвeрa
//                    alert(thrownError); // и тeкст oшибки
        }
//               complete: function(data) { // сoбытиe пoслe любoгo исхoдa
//                    form.find('input[type="submit"]').prop('disabled', false); // в любoм случae включим кнoпку oбрaтнo
//                 }
      });

      return false;
    });
  });

</script>
