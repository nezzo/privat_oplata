<style>
    a.btn.btn-default.my_butt{
        display:none;

    }
    .banner{
        position: absolute;
        top: 0px;
        width: 1351px;
        height: 275px !important;
        overflow: hidden;
        clip: rect(0px 1351px 275px -186px);
        background-color: rgb(255, 255, 255);
        background: url("../wp-content/themes/chine-prop/images/page_news/page_news.png") 50% 0px / cover no-repeat fixed !important;
        opacity: 1;
        text-align: left !important;
    }
    .from-blog{
        margin-bottom: -25px;
    }
    .from_page_servis {
        border-top: 1px solid rgba(160, 160, 159, 1);
        border-bottom: 1px solid rgba(160, 160, 159, 1);
    }
    .small_text{
        display:none;
    }

    .big_text{
        font: normal normal normal 56px/1.4em avenir-lt-w01_35-light1475496,sans-serif !important;
        font-weight: 100 !important;
        padding-top: 7% !important;
        padding-left: 14%;
        letter-spacing: 0.05em;
    }

    /*------------------------------------------------------КОНСТАНТЫ------------------------------------------------*/
    .content{
        width: 100%;
    }




</style>
<?php
/**
 * Template Name: Page News
 *
 * @package Modality
 */

get_header();
news_unslider_slider();
?>

<div class="container-fluid">
    <div class="content">

    </div>
</div>

<?php
get_footer(); ?>


