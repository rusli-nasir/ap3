<?php
/* @var $this ReportController */

Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl.'/css/foundation-datepicker.css');
Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl.'/js/foundation-datepicker.js', CClientScript::POS_HEAD);

$this->breadcrumbs = array(
    'Laporan' => array('index'),
    'Penjualan',
);

$this->boxHeader['small'] = 'Penjualan';
$this->boxHeader['normal'] = '<i class="fa fa-file fa-lg"></i> Laporan Penjualan';

$this->renderPartial('_form_penjualan', array('model' => $model));
?>
<div class="row">
   <div class="small-12 columns">
      <div id="tabel-profil" style="display: none">
         <?php $this->renderPartial('_profil', array('profil' => $profil)); ?>
      </div>
      <div id="tabel-user" style="display: none">
         <?php $this->renderPartial('_user', array('user' => $user)); ?>
      </div>
   </div>
</div>
<script>
   $(function () {
      $('.tanggalan').fdatepicker({
         format: 'dd-mm-yyyy'
      });
   });

   $("#tombol-browse-profil").click(function () {
      $("#tabel-profil").slideToggle(500);
      $("input[name='Profil[nama]']").focus();
   });

   $("#tombol-browse-user").click(function () {
      $("#tabel-user").slideToggle(500);
      $("input[name='User[nama_lengkap]']").focus();
   });

   $("body").on("click", "a.pilih.profil", function () {
      var dataurl = $(this).attr('href');
      $.ajax({
         url: dataurl,
         success: isiProfil
      });
      return false;
   });

   $("body").on("click", "a.pilih.user", function () {
      var dataurl = $(this).attr('href');
      $.ajax({
         url: dataurl,
         success: isiUser
      });
      return false;
   });

   function isiProfil(data) {
      console.log(data);
      $("#profil").val(data.nama);
      $("#tabel-profil").slideUp(500);
      $("#ReportPenjualanForm_profilId").val(data.id);
   }

   function isiUser(data) {
      console.log(data);
      $("#user").val(data.namaLengkap + ' (' + data.nama + ')');
      $("#tabel-user").slideUp(500);
      $("#ReportPenjualanForm_userId").val(data.id);
   }

   $("body").on("focusin", "a.pilih", function () {
      $(this).parent('td').parent('tr').addClass('pilih');
   });

   $("body").on("focusout", "a.pilih", function () {
      $(this).parent('td').parent('tr').removeClass('pilih');
   });
</script>