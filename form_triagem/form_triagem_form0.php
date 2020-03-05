<?php

if (!isset($this->NM_ajax_info['param']['buffer_output']) || !$this->NM_ajax_info['param']['buffer_output'])
{
    $sOBContents = ob_get_contents();
    ob_end_clean();
}

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
            "http://www.w3.org/TR/1999/REC-html401-19991224/loose.dtd">

<html<?php echo $_SESSION['scriptcase']['reg_conf']['html_dir'] ?>>
<HEAD>
 <TITLE><?php if ('novo' == $this->nmgp_opcao) { echo strip_tags(""); } else { echo strip_tags(""); } ?></TITLE>
 <META http-equiv="Content-Type" content="text/html; charset=<?php echo $_SESSION['scriptcase']['charset_html'] ?>" />
 <META http-equiv="Expires" content="Fri, Jan 01 1900 00:00:00 GMT"/>
 <META http-equiv="Last-Modified" content="<?php echo gmdate("D, d M Y H:i:s"); ?> GMT"/>
 <META http-equiv="Cache-Control" content="no-store, no-cache, must-revalidate"/>
 <META http-equiv="Cache-Control" content="post-check=0, pre-check=0"/>
 <META http-equiv="Pragma" content="no-cache"/>
<?php
header("X-XSS-Protection: 0");
?>
<?php

if (isset($_SESSION['scriptcase']['device_mobile']) && $_SESSION['scriptcase']['device_mobile'] && $_SESSION['scriptcase']['display_mobile'])
{
?>
 <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
<?php
}

?>
 <link rel="stylesheet" href="<?php echo $this->Ini->path_prod ?>/third/jquery_plugin/thickbox/thickbox.css" type="text/css" media="screen" />
 <SCRIPT type="text/javascript">
  var sc_pathToTB = '<?php echo $this->Ini->path_prod ?>/third/jquery_plugin/thickbox/';
  var sc_blockCol = '<?php echo $this->Ini->Block_img_col; ?>';
  var sc_blockExp = '<?php echo $this->Ini->Block_img_exp; ?>';
  var sc_ajaxBg = '<?php echo $this->Ini->Color_bg_ajax; ?>';
  var sc_ajaxBordC = '<?php echo $this->Ini->Border_c_ajax; ?>';
  var sc_ajaxBordS = '<?php echo $this->Ini->Border_s_ajax; ?>';
  var sc_ajaxBordW = '<?php echo $this->Ini->Border_w_ajax; ?>';
  var sc_ajaxMsgTime = 2;
  var sc_img_status_ok = '<?php echo $this->Ini->path_icones; ?>/<?php echo $this->Ini->Img_status_ok; ?>';
  var sc_img_status_err = '<?php echo $this->Ini->path_icones; ?>/<?php echo $this->Ini->Img_status_err; ?>';
  var sc_css_status = '<?php echo $this->Ini->Css_status; ?>';
 </SCRIPT>
 <SCRIPT type="text/javascript" src="<?php echo $this->Ini->path_prod; ?>/third/jquery/js/jquery.js"></SCRIPT>
 <SCRIPT type="text/javascript" src="<?php echo $this->Ini->path_prod; ?>/third/jquery/js/jquery-ui.js"></SCRIPT>
 <link rel="stylesheet" href="<?php echo $this->Ini->path_prod ?>/third/jquery/css/smoothness/jquery-ui.css" type="text/css" media="screen" />
 <SCRIPT type="text/javascript" src="<?php echo $this->Ini->url_lib_js; ?>jquery.iframe-transport.js"></SCRIPT>
 <SCRIPT type="text/javascript" src="<?php echo $this->Ini->url_lib_js; ?>jquery.fileupload.js"></SCRIPT>
 <SCRIPT type="text/javascript" src="<?php echo $this->Ini->path_prod; ?>/third/jquery_plugin/malsup-blockui/jquery.blockUI.js"></SCRIPT>
 <SCRIPT type="text/javascript" src="<?php echo $this->Ini->path_prod; ?>/third/jquery_plugin/thickbox/thickbox-compressed.js"></SCRIPT>
 <style type="text/css">
  .fileinput-button-padding {
   padding: 3px 10px !important;
  }
  .fileinput-button {
   position: relative;
   overflow: hidden;
   float: left;
   margin-right: 4px;
  }
  .fileinput-button input {
   position: absolute;
   top: 0;
   right: 0;
   margin: 0;
   border: solid transparent;
   border-width: 0 0 100px 200px;
   opacity: 0;
   filter: alpha(opacity=0);
   -moz-transform: translate(-300px, 0) scale(4);
   direction: ltr;
   cursor: pointer;
  }
 </style>
 <SCRIPT type="text/javascript" src="<?php echo $this->Ini->url_lib_js; ?>jquery.scInput.js"></SCRIPT>
 <SCRIPT type="text/javascript" src="<?php echo $this->Ini->url_lib_js; ?>jquery.fieldSelection.js"></SCRIPT>
 <?php
 if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_triagem']['embutida_pdf']))
 {
 ?>
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>_lib/css/<?php echo $this->Ini->str_schema_all ?>_form.css" />
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>_lib/css/<?php echo $this->Ini->str_schema_all ?>_form<?php echo $_SESSION['scriptcase']['reg_conf']['css_dir'] ?>.css" />
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>_lib/css/<?php echo $this->Ini->str_schema_all ?>_tab.css" />
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>_lib/css/<?php echo $this->Ini->str_schema_all ?>_tab<?php echo $_SESSION['scriptcase']['reg_conf']['css_dir'] ?>.css" />
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>_lib/buttons/<?php echo $this->Ini->Str_btn_form . '/' . $this->Ini->Str_btn_form ?>.css" />
<?php
   include_once("../_lib/css/" . $this->Ini->str_schema_all . "_tab.php");
 }
?>
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>form_triagem/form_triagem_<?php echo strtolower($_SESSION['scriptcase']['reg_conf']['css_dir']) ?>.css" />

<script>
var scFocusFirstErrorField = false;
var scFocusFirstErrorName  = "<?php echo $this->scFormFocusErrorName; ?>";
</script>

<?php
include_once("form_triagem_sajax_js.php");
?>
<script type="text/javascript">
if (document.getElementById("id_error_display_fixed"))
{
 scCenterFixedElement("id_error_display_fixed");
}
var posDispLeft = 0;
var posDispTop = 0;
var Nm_Proc_Atualiz = false;
function findPos(obj)
{
 var posCurLeft = posCurTop = 0;
 if (obj.offsetParent)
 {
  posCurLeft = obj.offsetLeft
  posCurTop = obj.offsetTop
  while (obj = obj.offsetParent)
  {
   posCurLeft += obj.offsetLeft
   posCurTop += obj.offsetTop
  }
 }
 posDispLeft = posCurLeft - 10;
 posDispTop = posCurTop + 30;
}
var Nav_permite_ret = "<?php if ($this->Nav_permite_ret) { echo 'S'; } else { echo 'N'; } ?>";
var Nav_permite_ava = "<?php if ($this->Nav_permite_ava) { echo 'S'; } else { echo 'N'; } ?>";
var Nav_binicio     = "<?php echo $this->arr_buttons['binicio']['type']; ?>";
var Nav_binicio_off = "<?php echo $this->arr_buttons['binicio_off']['type']; ?>";
var Nav_bavanca     = "<?php echo $this->arr_buttons['bavanca']['type']; ?>";
var Nav_bavanca_off = "<?php echo $this->arr_buttons['bavanca_off']['type']; ?>";
var Nav_bretorna    = "<?php echo $this->arr_buttons['bretorna']['type']; ?>";
var Nav_bretorna_off = "<?php echo $this->arr_buttons['bretorna_off']['type']; ?>";
var Nav_bfinal      = "<?php echo $this->arr_buttons['bfinal']['type']; ?>";
var Nav_bfinal_off  = "<?php echo $this->arr_buttons['bfinal_off']['type']; ?>";
function nav_atualiza(str_ret, str_ava, str_pos)
{
<?php
 if (isset($this->NM_btn_navega) && 'N' == $this->NM_btn_navega)
 {
     echo " return;";
 }
 else
 {
?>
 if ('S' == str_ret)
 {
<?php
    if ($this->nmgp_botoes['first'] == "on")
    {
?>
       $("#sc_b_ini_" + str_pos).show();
       $("#sc_b_ini_off_" + str_pos).hide().prop("disabled", false);
       $("#gbl_sc_b_ini_" + str_pos).show();
       $("#gbl_sc_b_ini_off_" + str_pos).hide();
<?php
    }
    if ($this->nmgp_botoes['back'] == "on")
    {
?>
       $("#sc_b_ret_" + str_pos).show();
       $("#sc_b_ret_off_" + str_pos).hide().prop("disabled", false);
       $("#gbl_sc_b_ret_" + str_pos).show();
       $("#gbl_sc_b_ret_off_" + str_pos).hide();
<?php
    }
?>
 }
 else
 {
<?php
    if ($this->nmgp_botoes['first'] == "on")
    {
?>
       $("#sc_b_ini_" + str_pos).hide();
       $("#sc_b_ini_off_" + str_pos).prop("disabled", true).show();
       $("#gbl_sc_b_ini_" + str_pos).hide();
       $("#gbl_sc_b_ini_off_" + str_pos).show();
<?php
    }
    if ($this->nmgp_botoes['back'] == "on")
    {
?>
       $("#sc_b_ret_" + str_pos).hide();
       $("#sc_b_ret_off_" + str_pos).prop("disabled", true).show();
       $("#gbl_sc_b_ret_" + str_pos).hide();
       $("#gbl_sc_b_ret_off_" + str_pos).show();
<?php
    }
?>
 }
 if ('S' == str_ava)
 {
<?php
    if ($this->nmgp_botoes['last'] == "on")
    {
?>
       $("#sc_b_fim_" + str_pos).show();
       $("#sc_b_fim_off_" + str_pos).hide().prop("disabled", false);
       $("#gbl_sc_b_fim_" + str_pos).show();
       $("#gbl_sc_b_fim_off_" + str_pos).hide();
<?php
    }
    if ($this->nmgp_botoes['forward'] == "on")
    {
?>
       $("#sc_b_avc_" + str_pos).show();
       $("#sc_b_avc_off_" + str_pos).hide().prop("disabled", false);
       $("#gbl_sc_b_avc_" + str_pos).show();
       $("#gbl_sc_b_avc_off_" + str_pos).hide();
<?php
    }
?>
 }
 else
 {
<?php
    if ($this->nmgp_botoes['last'] == "on")
    {
?>
       $("#sc_b_fim_" + str_pos).hide();
       $("#sc_b_fim_off_" + str_pos).prop("disabled", true).show();
       $("#gbl_sc_b_fim_" + str_pos).hide();
       $("#gbl_sc_b_fim_off_" + str_pos).show();
<?php
    }
    if ($this->nmgp_botoes['forward'] == "on")
    {
?>
       $("#sc_b_avc_" + str_pos).hide();
       $("#sc_b_avc_off_" + str_pos).prop("disabled", true).show();
       $("#gbl_sc_b_avc_" + str_pos).hide();
       $("#gbl_sc_b_avc_off_" + str_pos).show();
<?php
    }
?>
 }
<?php
  }
?>
}
function nav_liga_img()
{
 sExt = sImg.substr(sImg.length - 4);
 sImg = sImg.substr(0, sImg.length - 4);
 if ('_off' == sImg.substr(sImg.length - 4))
 {
  sImg = sImg.substr(0, sImg.length - 4);
 }
 sImg += sExt;
}
function nav_desliga_img()
{
 sExt = sImg.substr(sImg.length - 4);
 sImg = sImg.substr(0, sImg.length - 4);
 if ('_off' != sImg.substr(sImg.length - 4))
 {
  sImg += '_off';
 }
 sImg += sExt;
}
<?php

include_once('form_triagem_jquery.php');

?>

 var scQSInit = true;
 var scQSPos  = {};
 var Dyn_Ini  = true;
 $(function() {

  scJQElementsAdd('');

  scJQGeneralAdd();

  addAutocomplete(this);

  $(document).bind('drop dragover', function (e) {
      e.preventDefault();
  });

  var i, iTestWidth, iMaxLabelWidth = 0, $labelList = $(".scUiLabelWidthFix");
  for (i = 0; i < $labelList.length; i++) {
    iTestWidth = $($labelList[i]).width();
    sTestWidth = iTestWidth + "";
    if ("" == iTestWidth) {
      iTestWidth = 0;
    }
    else if ("px" == sTestWidth.substr(sTestWidth.length - 2)) {
      iTestWidth = parseInt(sTestWidth.substr(0, sTestWidth.length - 2));
    }
    iMaxLabelWidth = Math.max(iMaxLabelWidth, iTestWidth);
  }
  if (0 < iMaxLabelWidth) {
    $(".scUiLabelWidthFix").css("width", iMaxLabelWidth + "px");
  }
<?php
if (!$this->NM_ajax_flag && isset($this->NM_non_ajax_info['ajaxJavascript']) && !empty($this->NM_non_ajax_info['ajaxJavascript']))
{
    foreach ($this->NM_non_ajax_info['ajaxJavascript'] as $aFnData)
    {
?>
  <?php echo $aFnData[0]; ?>(<?php echo implode(', ', $aFnData[1]); ?>);

<?php
    }
}
?>
 });

   $(window).load(function() {
   });
 if($(".sc-ui-block-control").length) {
  preloadBlock = new Image();
  preloadBlock.src = "<?php echo $this->Ini->path_icones; ?>/" + sc_blockExp;
 }

 var show_block = {
  
 };

 function toggleBlock(e) {
  var block = e.data.block,
      block_id = $(block).attr("id");
      block_img = $("#" + block_id + " .sc-ui-block-control");

  if (1 >= block.rows.length) {
   return;
  }

  show_block[block_id] = !show_block[block_id];

  if (show_block[block_id]) {
    $(block).css("height", "100%");
    if (block_img.length) block_img.attr("src", changeImgName(block_img.attr("src"), sc_blockCol));
  }
  else {
    $(block).css("height", "");
    if (block_img.length) block_img.attr("src", changeImgName(block_img.attr("src"), sc_blockExp));
  }

  for (var i = 1; i < block.rows.length; i++) {
   if (show_block[block_id])
    $(block.rows[i]).show();
   else
    $(block.rows[i]).hide();
  }

  if (show_block[block_id]) {
  }
 }

 function changeImgName(imgOld, imgNew) {
   var aOld = imgOld.split("/");
   aOld.pop();
   aOld.push(imgNew);
   return aOld.join("/");
 }

 function addAutocomplete(elem) {


  $(".sc-ui-autocomp-id_paciente", elem).focus(function() {
   var sId = $(this).attr("id").substr(6);
   scEventControl_data[sId]["autocomp"] = true;
  }).blur(function() {
   var sId = $(this).attr("id").substr(6), sRow = "id_paciente" != sId ? sId.substr(11) : "";
   if ("" == $(this).val()) {
    $("#id_sc_field_" + sId).val("");
   }
   scEventControl_data[sId]["autocomp"] = false;
  }).autocomplete({
   source: function (request, response) {
    $.ajax({
     url: "form_triagem.php",
     dataType: "json",
     data: {
      term: request.term,
      nmgp_parms: "NM_ajax_opcao?#?autocomp_id_paciente",
      script_case_init: document.F2.script_case_init.value
     },
     success: function (data) {
      response(data);
     }
    });
   },
   select: function (event, ui) {
    var sId = $(this).attr("id").substr(6), sRow = 'id_paciente' != sId ? sId.substr(11) : '';
    $("#id_sc_field_" + sId).val(ui.item.value);
    $(this).val(ui.item.label);
    event.preventDefault();
   }
  });
}
</script>
</HEAD>
<?php
$str_iframe_body = ('F' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_triagem']['run_iframe'] || 'R' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_triagem']['run_iframe']) ? 'margin: 2px;' : '';
 if (isset($_SESSION['nm_aba_bg_color']))
 {
     $this->Ini->cor_bg_grid = $_SESSION['nm_aba_bg_color'];
     $this->Ini->img_fun_pag = $_SESSION['nm_aba_bg_img'];
 }
if ($GLOBALS["erro_incl"] == 1)
{
    $this->nmgp_opcao = "novo";
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_triagem']['opc_ant'] = "novo";
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_triagem']['recarga'] = "novo";
}
if (empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_triagem']['recarga']))
{
    $opcao_botoes = $this->nmgp_opcao;
}
else
{
    $opcao_botoes = $_SESSION['sc_session'][$this->Ini->sc_page]['form_triagem']['recarga'];
}
?>
<body class="scFormPage" style="<?php echo $str_iframe_body; ?>">
<?php

if (!isset($this->NM_ajax_info['param']['buffer_output']) || !$this->NM_ajax_info['param']['buffer_output'])
{
    echo $sOBContents;
}

?>
<div id="idJSSpecChar" style="display: none;"></div>
<script type="text/javascript">
function NM_tp_critica(TP)
{
    if (TP == 0 || TP == 1 || TP == 2)
    {
        nmdg_tipo_crit = TP;
    }
}
</script> 
<?php
 include_once("form_triagem_js0.php");
?>
<script type="text/javascript"> 
 function setLocale(oSel)
 {
  var sLocale = "";
  if (-1 < oSel.selectedIndex)
  {
   sLocale = oSel.options[oSel.selectedIndex].value;
  }
  document.F1.nmgp_idioma_novo.value = sLocale;
 }
 function setSchema(oSel)
 {
  var sLocale = "";
  if (-1 < oSel.selectedIndex)
  {
   sLocale = oSel.options[oSel.selectedIndex].value;
  }
  document.F1.nmgp_schema_f.value = sLocale;
 }
 </script>
<form name="F1" method="post" 
               action="./" 
               target="_self"> 
<input type="hidden" name="nm_form_submit" value="1">
<input type="hidden" name="nmgp_idioma_novo" value="">
<input type="hidden" name="nmgp_schema_f" value="">
<input type="hidden" name="nmgp_url_saida" value="">
<?php
if ('novo' == $this->nmgp_opcao || 'incluir' == $this->nmgp_opcao)
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_triagem']['insert_validation'] = md5(time() . rand(1, 99999));
?>
<input type="hidden" name="nmgp_ins_valid" value="<?php echo $_SESSION['sc_session'][$this->Ini->sc_page]['form_triagem']['insert_validation']; ?>">
<?php
}
?>
<input type="hidden" name="nmgp_opcao" value="">
<input type="hidden" name="nmgp_ancora" value="">
<input type="hidden" name="nmgp_num_form" value="<?php  echo $this->form_encode_input($nmgp_num_form); ?>">
<input type="hidden" name="nmgp_parms" value="">
<input type="hidden" name="script_case_init" value="<?php  echo $this->form_encode_input($this->Ini->sc_page); ?>"> 
<input type="hidden" name="script_case_session" value="<?php  echo $this->form_encode_input(session_id()); ?>"> 
<input type="hidden" name="NM_cancel_return_new" value="<?php echo $this->NM_cancel_return_new ?>"> 
<input type="hidden" name="csrf_token" value="<?php echo $this->scCsrfGetToken() ?>" /> 
<input type="hidden" name="_sc_force_mobile" id="sc-id-mobile-control" value="" />
<?php
$_SESSION['scriptcase']['error_span_title']['form_triagem'] = $this->Ini->Error_icon_span;
$_SESSION['scriptcase']['error_icon_title']['form_triagem'] = '' != $this->Ini->Err_ico_title ? $this->Ini->path_icones . '/' . $this->Ini->Err_ico_title : '';
?>
<div style="display: none; position: absolute; z-index: 1000" id="id_error_display_table_frame">
<table class="scFormErrorTable">
<tr><?php if ($this->Ini->Error_icon_span && '' != $this->Ini->Err_ico_title) { ?><td style="padding: 0px" rowspan="2"><img src="<?php echo $this->Ini->path_icones; ?>/<?php echo $this->Ini->Err_ico_title; ?>" style="border-width: 0px" align="top"></td><?php } ?><td class="scFormErrorTitle"><table style="border-collapse: collapse; border-width: 0px; width: 100%"><tr><td class="scFormErrorTitleFont" style="padding: 0px; vertical-align: top; width: 100%"><?php if (!$this->Ini->Error_icon_span && '' != $this->Ini->Err_ico_title) { ?><img src="<?php echo $this->Ini->path_icones; ?>/<?php echo $this->Ini->Err_ico_title; ?>" style="border-width: 0px" align="top">&nbsp;<?php } ?><?php echo $this->Ini->Nm_lang['lang_errm_errt'] ?></td><td style="padding: 0px; vertical-align: top"><?php echo nmButtonOutput($this->arr_buttons, "berrm_clse", "scAjaxHideErrorDisplay('table')", "scAjaxHideErrorDisplay('table')", "", "", "", "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "");?>
</td></tr></table></td></tr>
<tr><td class="scFormErrorMessage"><span id="id_error_display_table_text"></span></td></tr>
</table>
</div>
<div style="display: none; position: absolute; z-index: 1000" id="id_message_display_frame">
 <table class="scFormMessageTable" id="id_message_display_content" style="width: 100%">
  <tr id="id_message_display_title_line">
   <td class="scFormMessageTitle" style="height: 20px"><?php
if ('' != $this->Ini->Msg_ico_title) {
?>
<img src="<?php echo $this->Ini->path_icones . '/' . $this->Ini->Msg_ico_title; ?>" style="border-width: 0px; vertical-align: middle">&nbsp;<?php
}
?>
<?php echo nmButtonOutput($this->arr_buttons, "bmessageclose", "_scAjaxMessageBtnClose()", "_scAjaxMessageBtnClose()", "id_message_display_close_icon", "", "", "float: right", "", "", "", $this->Ini->path_botoes, "", "", "", "", "");?>
<span id="id_message_display_title" style="vertical-align: middle"></span></td>
  </tr>
  <tr>
   <td class="scFormMessageMessage"><?php
if ('' != $this->Ini->Msg_ico_body) {
?>
<img id="id_message_display_body_icon" src="<?php echo $this->Ini->path_icones . '/' . $this->Ini->Msg_ico_body; ?>" style="border-width: 0px; vertical-align: middle">&nbsp;<?php
}
?>
<span id="id_message_display_text"></span><div id="id_message_display_buttond" style="display: none; text-align: center"><br /><input id="id_message_display_buttone" type="button" class="scButton_default" value="Ok" onClick="_scAjaxMessageBtnClick()" ></div></td>
  </tr>
 </table>
</div>
<script type="text/javascript">
var scMsgDefTitle = "<?php echo $this->Ini->Nm_lang['lang_usr_lang_othr_msgs_titl']; ?>";
var scMsgDefButton = "Ok";
var scMsgDefClick = "close";
var scMsgDefScInit = "<?php echo $this->Ini->page; ?>";
</script>
<table id="main_table_form"  align="center" cellpadding=0 cellspacing=0 >
 <tr>
  <td>
  <div class="scFormBorder">
   <table width='100%' cellspacing=0 cellpadding=0>
<?php
  if (!$this->Embutida_call && (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_triagem']['mostra_cab']) || $_SESSION['sc_session'][$this->Ini->sc_page]['form_triagem']['mostra_cab'] != "N"))
  {
?>
<tr><td>
<style>
#lin1_col1 { padding-left:9px; padding-top:7px;  height:27px; overflow:hidden; text-align:left;}			 
#lin1_col2 { padding-right:9px; padding-top:7px; height:27px; text-align:right; overflow:hidden;   font-size:12px; font-weight:normal;}
</style>

<div style="width: 100%">
 <div class="scFormHeader" style="height:11px; display: block; border-width:0px; "></div>
 <div style="height:37px; border-width:0px 0px 1px 0px;  border-style: dashed; border-color:#ddd; display: block">
 	<table style="width:100%; border-collapse:collapse; padding:0;">
    	<tr>
        	<td id="lin1_col1" class="scFormHeaderFont"><span><?php if ($this->nmgp_opcao == "novo") { echo ""; } else { echo ""; } ?></span></td>
            <td id="lin1_col2" class="scFormHeaderFont"><span><?php echo date($this->dateDefaultFormat()); ?></span></td>
        </tr>
    </table>		 
 </div>
</div>
</td></tr>
<?php
  }
?>
<tr><td>
<?php
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_triagem']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_triagem']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_triagem']['run_iframe'] != "R")
{
?>
    <table style="border-collapse: collapse; border-width: 0px; width: 100%"><tr><td class="scFormToolbar" style="padding: 0px; spacing: 0px">
    <table style="border-collapse: collapse; border-width: 0px; width: 100%">
    <tr> 
     <td nowrap align="left" valign="middle" width="33%" class="scFormToolbarPadding"> 
<?php
}
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_triagem']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_triagem']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_triagem']['run_iframe'] != "R")
{
    $NM_btn = false;
?> 
     </td> 
     <td nowrap align="center" valign="middle" width="33%" class="scFormToolbarPadding"> 
<?php 
?> 
     </td> 
     <td nowrap align="right" valign="middle" width="33%" class="scFormToolbarPadding"> 
<?php 
    if ('' != $this->url_webhelp) {
        $sCondStyle = '';
?>
       <?php echo nmButtonOutput($this->arr_buttons, "bhelp", "window.open('" . $this->url_webhelp. "', '', 'resizable, scrollbars'); ", "window.open('" . $this->url_webhelp. "', '', 'resizable, scrollbars'); ", "", "", "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "");?>
 
<?php
        $NM_btn = true;
    }
    if (!$this->Embutida_call) {
        $sCondStyle = (isset($_SESSION['scriptcase']['nm_sc_retorno']) && !empty($_SESSION['scriptcase']['nm_sc_retorno']) && $nm_apl_dependente != 1 && $_SESSION['sc_session'][$this->Ini->sc_page]['form_triagem']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_triagem']['run_iframe'] != "R" && (!$this->aba_iframe || $this->is_calendar_app) && $this->nmgp_botoes['exit'] == "on") ? '' : 'display: none;';
?>
       <?php echo nmButtonOutput($this->arr_buttons, "bsair", "document.F6.action='" . $nm_url_saida. "'; document.F6.submit(); return false;", "document.F6.action='" . $nm_url_saida. "'; document.F6.submit(); return false;", "sc_b_sai_t", "", "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "");?>
 
<?php
        $NM_btn = true;
    }
    if (!$this->Embutida_call) {
        $sCondStyle = (!isset($_SESSION['scriptcase']['nm_sc_retorno']) || empty($_SESSION['scriptcase']['nm_sc_retorno']) || $nm_apl_dependente == 1 || $_SESSION['sc_session'][$this->Ini->sc_page]['form_triagem']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['form_triagem']['run_iframe'] == "R" || $this->aba_iframe || $this->nmgp_botoes['exit'] != "on") && ($_SESSION['sc_session'][$this->Ini->sc_page]['form_triagem']['run_iframe'] != "R" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_triagem']['run_iframe'] != "F" && $this->nmgp_botoes['exit'] == "on") && ($nm_apl_dependente == 1 && $this->nmgp_botoes['exit'] == "on") ? '' : 'display: none;';
?>
       <?php echo nmButtonOutput($this->arr_buttons, "bvoltar", "document.F6.action='" . $nm_url_saida. "'; document.F6.submit(); return false;", "document.F6.action='" . $nm_url_saida. "'; document.F6.submit(); return false;", "sc_b_sai_t", "", "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "");?>
 
<?php
        $NM_btn = true;
    }
    if (!$this->Embutida_call) {
        $sCondStyle = (!isset($_SESSION['scriptcase']['nm_sc_retorno']) || empty($_SESSION['scriptcase']['nm_sc_retorno']) || $nm_apl_dependente == 1 || $_SESSION['sc_session'][$this->Ini->sc_page]['form_triagem']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['form_triagem']['run_iframe'] == "R" || $this->aba_iframe || $this->nmgp_botoes['exit'] != "on") && ($_SESSION['sc_session'][$this->Ini->sc_page]['form_triagem']['run_iframe'] != "R" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_triagem']['run_iframe'] != "F" && $this->nmgp_botoes['exit'] == "on") && ($nm_apl_dependente != 1 || $this->nmgp_botoes['exit'] != "on") && (!$this->aba_iframe && $this->nmgp_botoes['exit'] == "on") ? '' : 'display: none;';
?>
       <?php echo nmButtonOutput($this->arr_buttons, "bsair", "document.F6.action='" . $nm_url_saida. "'; document.F6.submit(); return false;", "document.F6.action='" . $nm_url_saida. "'; document.F6.submit(); return false;", "sc_b_sai_t", "", "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "");?>
 
<?php
        $NM_btn = true;
    }
}
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_triagem']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_triagem']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_triagem']['run_iframe'] != "R")
{
?>
   </td></tr> 
   </table> 
   </td></tr></table> 
<?php
}
?>
<?php
if (!$NM_btn && isset($NM_ult_sep))
{
    echo "    <script language=\"javascript\">";
    echo "      document.getElementById('" .  $NM_ult_sep . "').style.display='none';";
    echo "    </script>";
}
unset($NM_ult_sep);
?>
<?php if ('novo' != $this->nmgp_opcao || $this->Embutida_form) { ?><script>nav_atualiza(Nav_permite_ret, Nav_permite_ava, 't');</script><?php } ?>
</td></tr> 
<tr><td>
<?php
       echo "<div id=\"sc-ui-empty-form\" class=\"scFormPageText\" style=\"padding: 10px; text-align: center; font-weight: bold" . ($this->nmgp_form_empty ? '' : '; display: none') . "\">";
       echo $this->Ini->Nm_lang['lang_errm_empt'];
       echo "</div>";
  if ($this->nmgp_form_empty)
  {
       if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_triagem']['where_filter']))
       {
           $_SESSION['sc_session'][$this->Ini->sc_page]['form_triagem']['empty_filter'] = true;
       }
  }
  else
  {
?>
<?php $sc_hidden_no = 1; $sc_hidden_yes = 0; ?>
   <a name="bloco_0"></a>
   <table width="100%" height="100%" cellpadding="0" cellspacing=0><tr valign="top"><td width="100%" height="">
<div id="div_hidden_bloco_0"><!-- bloco_c -->
<?php
   if (!isset($this->nmgp_cmp_hidden['id_usuario']))
   {
       $this->nmgp_cmp_hidden['id_usuario'] = 'off';
   }
?>
<TABLE align="center" id="hidden_bloco_0" class="scFormTable" width="100%" style="height: 100%;"><?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>
<?php
           if ('novo' != $this->nmgp_opcao && !isset($this->nmgp_cmp_readonly['id_triagem']))
           {
               $this->nmgp_cmp_readonly['id_triagem'] = 'on';
           }
?>


   <?php
    if (!isset($this->nm_new_label['id_paciente']))
    {
        $this->nm_new_label['id_paciente'] = "Nome do Paciente";
    }
?>
<?php
   $nm_cor_fun_cel  = ($nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = ($nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $id_paciente = $this->id_paciente;
   $sStyleHidden_id_paciente = '';
   if (isset($this->nmgp_cmp_hidden['id_paciente']) && $this->nmgp_cmp_hidden['id_paciente'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['id_paciente']);
       $sStyleHidden_id_paciente = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_id_paciente = 'display: none;';
   $sStyleReadInp_id_paciente = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['id_paciente']) && $this->nmgp_cmp_readonly['id_paciente'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['id_paciente']);
       $sStyleReadLab_id_paciente = '';
       $sStyleReadInp_id_paciente = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['id_paciente']) && $this->nmgp_cmp_hidden['id_paciente'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="id_paciente" value="<?php echo $this->form_encode_input($id_paciente) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_id_paciente_label" id="hidden_field_label_id_paciente" style="<?php echo $sStyleHidden_id_paciente; ?>"><span id="id_label_id_paciente"><?php echo $this->nm_new_label['id_paciente']; ?></span></TD>
    <TD class="scFormDataOdd css_id_paciente_line" id="hidden_field_data_id_paciente" style="<?php echo $sStyleHidden_id_paciente; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_id_paciente_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["id_paciente"]) &&  $this->nmgp_cmp_readonly["id_paciente"] == "on") { 

 ?>
<input type="hidden" name="id_paciente" value="<?php echo $this->form_encode_input($id_paciente) . "\">" . $id_paciente . ""; ?>
<?php } else { ?>

<?php
$aRecData['id_paciente'] = $this->id_paciente;
$aLookup = array();
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_triagem']['Lookup_id_paciente']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_triagem']['Lookup_id_paciente'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_triagem']['Lookup_id_paciente']); 
   }
   else
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_triagem']['Lookup_id_paciente'] = array(); 
    }

   $old_value_id_triagem = $this->id_triagem;
   $old_value_data = $this->data;
   $old_value_hora = $this->hora;
   $old_value_fc = $this->fc;
   $old_value_fr = $this->fr;
   $old_value_hgt = $this->hgt;
   $old_value_altura = $this->altura;
   $this->nm_tira_formatacao();
   $this->nm_converte_datas(false);


   $unformatted_value_id_triagem = $this->id_triagem;
   $unformatted_value_data = $this->data;
   $unformatted_value_hora = $this->hora;
   $unformatted_value_fc = $this->fc;
   $unformatted_value_fr = $this->fr;
   $unformatted_value_hgt = $this->hgt;
   $unformatted_value_altura = $this->altura;

   $nm_comando = "SELECT id_paciente, nome_paciente FROM paciente WHERE id_paciente = " . substr($this->Db->qstr($this->id_paciente), 1, -1) . " ORDER BY nome_paciente";

   $this->id_triagem = $old_value_id_triagem;
   $this->data = $old_value_data;
   $this->hora = $old_value_hora;
   $this->fc = $old_value_fc;
   $this->fr = $old_value_fr;
   $this->hgt = $old_value_hgt;
   $this->altura = $old_value_altura;

   if ('' != $this->id_paciente)
   {
   $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando; 
   $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
   if ($nm_comando != "" && $rs = $this->Db->Execute($nm_comando)) 
   {
       while (!$rs->EOF) 
       { 
              $rs->fields[0] = str_replace(',', '.', $rs->fields[0]);
              $rs->fields[0] = (strpos(strtolower($rs->fields[0]), "e")) ? (float)$rs->fields[0] : $rs->fields[0];
              $rs->fields[0] = (string)$rs->fields[0];
              $aLookup[] = array($rs->fields[0] => $rs->fields[1]);
              $nmgp_def_dados .= $rs->fields[1] . "?#?" ; 
              $nmgp_def_dados .= $rs->fields[0] . "?#?N?@?" ; 
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_triagem']['Lookup_id_paciente'][] = $rs->fields[0];
              $rs->MoveNext() ; 
       } 
       $rs->Close() ; 
   } 
   elseif ($GLOBALS["NM_ERRO_IBASE"] != 1 && $nm_comando != "")  
   {  
       $this->Erro->mensagem(__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
       exit; 
   } 
   }
   $GLOBALS["NM_ERRO_IBASE"] = 0; 
$id_paciente_look = (isset($aLookup[0][$this->id_paciente])) ? $aLookup[0][$this->id_paciente] : $this->id_paciente;
?>
<span id="id_read_on_id_paciente" class="sc-ui-readonly-id_paciente css_id_paciente_line" style="<?php echo $sStyleReadLab_id_paciente; ?>"><?php echo $id_paciente_look; ?></span><span id="id_read_off_id_paciente" style="white-space: nowrap;<?php echo $sStyleReadInp_id_paciente; ?>">
 <input class="sc-js-input scFormObjectOdd css_id_paciente_obj" style="display: none;" id="id_sc_field_id_paciente" type=text name="id_paciente" value="<?php echo $this->form_encode_input($id_paciente) ?>"
 size=11 maxlength=11 style="display: none" alt="{datatype: 'text', maxLength: 11, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}">
<?php
$aRecData['id_paciente'] = $this->id_paciente;
$aLookup = array();
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_triagem']['Lookup_id_paciente']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_triagem']['Lookup_id_paciente'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_triagem']['Lookup_id_paciente']); 
   }
   else
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_triagem']['Lookup_id_paciente'] = array(); 
    }

   $old_value_id_triagem = $this->id_triagem;
   $old_value_data = $this->data;
   $old_value_hora = $this->hora;
   $old_value_fc = $this->fc;
   $old_value_fr = $this->fr;
   $old_value_hgt = $this->hgt;
   $old_value_altura = $this->altura;
   $this->nm_tira_formatacao();
   $this->nm_converte_datas(false);


   $unformatted_value_id_triagem = $this->id_triagem;
   $unformatted_value_data = $this->data;
   $unformatted_value_hora = $this->hora;
   $unformatted_value_fc = $this->fc;
   $unformatted_value_fr = $this->fr;
   $unformatted_value_hgt = $this->hgt;
   $unformatted_value_altura = $this->altura;

   $nm_comando = "SELECT id_paciente, nome_paciente FROM paciente WHERE id_paciente = " . substr($this->Db->qstr($this->id_paciente), 1, -1) . " ORDER BY nome_paciente";

   $this->id_triagem = $old_value_id_triagem;
   $this->data = $old_value_data;
   $this->hora = $old_value_hora;
   $this->fc = $old_value_fc;
   $this->fr = $old_value_fr;
   $this->hgt = $old_value_hgt;
   $this->altura = $old_value_altura;

   if ('' != $this->id_paciente)
   {
   $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando; 
   $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
   if ($nm_comando != "" && $rs = $this->Db->Execute($nm_comando)) 
   {
       while (!$rs->EOF) 
       { 
              $rs->fields[0] = str_replace(',', '.', $rs->fields[0]);
              $rs->fields[0] = (strpos(strtolower($rs->fields[0]), "e")) ? (float)$rs->fields[0] : $rs->fields[0];
              $rs->fields[0] = (string)$rs->fields[0];
              $aLookup[] = array($rs->fields[0] => $rs->fields[1]);
              $nmgp_def_dados .= $rs->fields[1] . "?#?" ; 
              $nmgp_def_dados .= $rs->fields[0] . "?#?N?@?" ; 
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_triagem']['Lookup_id_paciente'][] = $rs->fields[0];
              $rs->MoveNext() ; 
       } 
       $rs->Close() ; 
   } 
   elseif ($GLOBALS["NM_ERRO_IBASE"] != 1 && $nm_comando != "")  
   {  
       $this->Erro->mensagem(__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
       exit; 
   } 
   }
   $GLOBALS["NM_ERRO_IBASE"] = 0; 
$sAutocompValue = (isset($aLookup[0][$this->id_paciente])) ? $aLookup[0][$this->id_paciente] : '';
?>
<input type="text" id="id_ac_id_paciente" name="id_paciente_autocomp" class="scFormObjectOdd sc-ui-autocomp-id_paciente css_id_paciente_obj" size="30" value="<?php echo $sAutocompValue; ?>" /></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 1px 0px 0px 0px"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_id_paciente_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_id_paciente_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['id_triagem']))
    {
        $this->nm_new_label['id_triagem'] = "Id Triagem";
    }
?>
<?php
   $nm_cor_fun_cel  = ($nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = ($nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $id_triagem = $this->id_triagem;
   $sStyleHidden_id_triagem = '';
   if (isset($this->nmgp_cmp_hidden['id_triagem']) && $this->nmgp_cmp_hidden['id_triagem'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['id_triagem']);
       $sStyleHidden_id_triagem = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_id_triagem = 'display: none;';
   $sStyleReadInp_id_triagem = '';
   if (/*($this->nmgp_opcao != "novo" && $this->nmgp_opc_ant != "incluir") || */(isset($this->nmgp_cmp_readonly["id_triagem"]) &&  $this->nmgp_cmp_readonly["id_triagem"] == "on"))
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['id_triagem']);
       $sStyleReadLab_id_triagem = '';
       $sStyleReadInp_id_triagem = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['id_triagem']) && $this->nmgp_cmp_hidden['id_triagem'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="id_triagem" value="<?php echo $this->form_encode_input($id_triagem) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>
<?php if ((isset($this->Embutida_form) && $this->Embutida_form) || ($this->nmgp_opcao != "novo" && $this->nmgp_opc_ant != "incluir")) { ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_id_triagem_label" id="hidden_field_label_id_triagem" style="<?php echo $sStyleHidden_id_triagem; ?>"><span id="id_label_id_triagem"><?php echo $this->nm_new_label['id_triagem']; ?></span></TD>
    <TD class="scFormDataOdd css_id_triagem_line" id="hidden_field_data_id_triagem" style="<?php echo $sStyleHidden_id_triagem; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_id_triagem_line" style="vertical-align: top;padding: 0px"><span id="id_read_on_id_triagem" class="css_id_triagem_line" style="<?php echo $sStyleReadLab_id_triagem; ?>"><?php echo $this->form_encode_input($this->id_triagem); ?></span><span id="id_read_off_id_triagem" style="<?php echo $sStyleReadInp_id_triagem; ?>"><input type="hidden" name="id_triagem" value="<?php echo $this->form_encode_input($id_triagem) . "\">"?><span id="id_ajax_label_id_triagem"><?php echo nl2br($id_triagem); ?></span>
</span></span></td></tr><tr><td style="vertical-align: top; padding: 1px 0px 0px 0px"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_id_triagem_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_id_triagem_text"></span></td></tr></table></td></tr></table></TD>
   <?php }
      else
      {
         $sc_hidden_no--;
      }
?>
<?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['data']))
    {
        $this->nm_new_label['data'] = "Data";
    }
?>
<?php
   $nm_cor_fun_cel  = ($nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = ($nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $data = $this->data;
   $sStyleHidden_data = '';
   if (isset($this->nmgp_cmp_hidden['data']) && $this->nmgp_cmp_hidden['data'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['data']);
       $sStyleHidden_data = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_data = 'display: none;';
   $sStyleReadInp_data = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['data']) && $this->nmgp_cmp_readonly['data'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['data']);
       $sStyleReadLab_data = '';
       $sStyleReadInp_data = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['data']) && $this->nmgp_cmp_hidden['data'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="data" value="<?php echo $this->form_encode_input($data) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_data_label" id="hidden_field_label_data" style="<?php echo $sStyleHidden_data; ?>"><span id="id_label_data"><?php echo $this->nm_new_label['data']; ?></span><?php if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_triagem']['php_cmp_required']['data']) || $_SESSION['sc_session'][$this->Ini->sc_page]['form_triagem']['php_cmp_required']['data'] == "on") { ?> <span class="scFormRequiredOdd">*</span> <?php }?></TD>
    <TD class="scFormDataOdd css_data_line" id="hidden_field_data_data" style="<?php echo $sStyleHidden_data; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_data_line" style="vertical-align: top;padding: 0px"><input type="hidden" name="data" value="<?php echo $this->form_encode_input($data); ?>"><span id="id_ajax_label_data"><?php echo nl2br($data); ?></span>
<?php
$tmp_form_data = $this->field_config['data']['date_format'];
$tmp_form_data = str_replace('aaaa', 'yyyy', $tmp_form_data);
$tmp_form_data = str_replace('dd'  , $this->Ini->Nm_lang['lang_othr_date_days'], $tmp_form_data);
$tmp_form_data = str_replace('mm'  , $this->Ini->Nm_lang['lang_othr_date_mnth'], $tmp_form_data);
$tmp_form_data = str_replace('yyyy', $this->Ini->Nm_lang['lang_othr_date_year'], $tmp_form_data);
$tmp_form_data = str_replace('hh'  , $this->Ini->Nm_lang['lang_othr_date_hour'], $tmp_form_data);
$tmp_form_data = str_replace('ii'  , $this->Ini->Nm_lang['lang_othr_date_mint'], $tmp_form_data);
$tmp_form_data = str_replace('ss'  , $this->Ini->Nm_lang['lang_othr_date_scnd'], $tmp_form_data);
$tmp_form_data = str_replace(';'   , ' '                                       , $tmp_form_data);
?>
&nbsp;<?php echo $tmp_form_data; ?></td></tr><tr><td style="vertical-align: top; padding: 1px 0px 0px 0px"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_data_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_data_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['hora']))
    {
        $this->nm_new_label['hora'] = "Hora";
    }
?>
<?php
   $nm_cor_fun_cel  = ($nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = ($nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $hora = $this->hora;
   $sStyleHidden_hora = '';
   if (isset($this->nmgp_cmp_hidden['hora']) && $this->nmgp_cmp_hidden['hora'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['hora']);
       $sStyleHidden_hora = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_hora = 'display: none;';
   $sStyleReadInp_hora = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['hora']) && $this->nmgp_cmp_readonly['hora'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['hora']);
       $sStyleReadLab_hora = '';
       $sStyleReadInp_hora = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['hora']) && $this->nmgp_cmp_hidden['hora'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="hora" value="<?php echo $this->form_encode_input($hora) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_hora_label" id="hidden_field_label_hora" style="<?php echo $sStyleHidden_hora; ?>"><span id="id_label_hora"><?php echo $this->nm_new_label['hora']; ?></span><?php if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_triagem']['php_cmp_required']['hora']) || $_SESSION['sc_session'][$this->Ini->sc_page]['form_triagem']['php_cmp_required']['hora'] == "on") { ?> <span class="scFormRequiredOdd">*</span> <?php }?></TD>
    <TD class="scFormDataOdd css_hora_line" id="hidden_field_data_hora" style="<?php echo $sStyleHidden_hora; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_hora_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["hora"]) &&  $this->nmgp_cmp_readonly["hora"] == "on") { 

 ?>
<input type="hidden" name="hora" value="<?php echo $this->form_encode_input($hora) . "\">" . $hora . ""; ?>
<?php } else { ?>
<span id="id_read_on_hora" class="sc-ui-readonly-hora css_hora_line" style="<?php echo $sStyleReadLab_hora; ?>"><?php echo $this->form_encode_input($hora); ?></span><span id="id_read_off_hora" style="white-space: nowrap;<?php echo $sStyleReadInp_hora; ?>">
 <input class="sc-js-input scFormObjectOdd css_hora_obj" style="" id="id_sc_field_hora" type=text name="hora" value="<?php echo $this->form_encode_input($hora) ?>"
 size=8 alt="{datatype: 'time', timeSep: '<?php echo $this->field_config['hora']['time_sep']; ?>', timeFormat: '<?php echo $this->field_config['hora']['date_format']; ?>', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}"><?php
$tmp_form_data = $this->field_config['hora']['date_format'];
$tmp_form_data = str_replace('aaaa', 'yyyy', $tmp_form_data);
$tmp_form_data = str_replace('dd'  , $this->Ini->Nm_lang['lang_othr_date_days'], $tmp_form_data);
$tmp_form_data = str_replace('mm'  , $this->Ini->Nm_lang['lang_othr_date_mnth'], $tmp_form_data);
$tmp_form_data = str_replace('yyyy', $this->Ini->Nm_lang['lang_othr_date_year'], $tmp_form_data);
$tmp_form_data = str_replace('hh'  , $this->Ini->Nm_lang['lang_othr_date_hour'], $tmp_form_data);
$tmp_form_data = str_replace('ii'  , $this->Ini->Nm_lang['lang_othr_date_mint'], $tmp_form_data);
$tmp_form_data = str_replace('ss'  , $this->Ini->Nm_lang['lang_othr_date_scnd'], $tmp_form_data);
$tmp_form_data = str_replace(';'   , ' '                                       , $tmp_form_data);
?>
&nbsp;<?php echo $tmp_form_data; ?></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 1px 0px 0px 0px"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_hora_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_hora_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['pa']))
    {
        $this->nm_new_label['pa'] = "PA (mmHg)";
    }
?>
<?php
   $nm_cor_fun_cel  = ($nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = ($nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $pa = $this->pa;
   $sStyleHidden_pa = '';
   if (isset($this->nmgp_cmp_hidden['pa']) && $this->nmgp_cmp_hidden['pa'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['pa']);
       $sStyleHidden_pa = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_pa = 'display: none;';
   $sStyleReadInp_pa = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['pa']) && $this->nmgp_cmp_readonly['pa'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['pa']);
       $sStyleReadLab_pa = '';
       $sStyleReadInp_pa = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['pa']) && $this->nmgp_cmp_hidden['pa'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="pa" value="<?php echo $this->form_encode_input($pa) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_pa_label" id="hidden_field_label_pa" style="<?php echo $sStyleHidden_pa; ?>"><span id="id_label_pa"><?php echo $this->nm_new_label['pa']; ?></span></TD>
    <TD class="scFormDataOdd css_pa_line" id="hidden_field_data_pa" style="<?php echo $sStyleHidden_pa; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_pa_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["pa"]) &&  $this->nmgp_cmp_readonly["pa"] == "on") { 

 ?>
<input type="hidden" name="pa" value="<?php echo $this->form_encode_input($pa) . "\">" . $pa . ""; ?>
<?php } else { ?>
<span id="id_read_on_pa" class="sc-ui-readonly-pa css_pa_line" style="<?php echo $sStyleReadLab_pa; ?>"><?php echo $this->form_encode_input($this->pa); ?></span><span id="id_read_off_pa" style="white-space: nowrap;<?php echo $sStyleReadInp_pa; ?>">
 <input class="sc-js-input scFormObjectOdd css_pa_obj" style="" id="id_sc_field_pa" type=text name="pa" value="<?php echo $this->form_encode_input($pa) ?>"
 size=5 maxlength=11 alt="{datatype: 'text', maxLength: 11, allowedChars: '<?php echo $this->allowedCharsCharset("abcdefghijklmnopqrstuvwxyz0123456789") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}"></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 1px 0px 0px 0px"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_pa_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_pa_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['fc']))
    {
        $this->nm_new_label['fc'] = "FC (bpm)";
    }
?>
<?php
   $nm_cor_fun_cel  = ($nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = ($nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $fc = $this->fc;
   $sStyleHidden_fc = '';
   if (isset($this->nmgp_cmp_hidden['fc']) && $this->nmgp_cmp_hidden['fc'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['fc']);
       $sStyleHidden_fc = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_fc = 'display: none;';
   $sStyleReadInp_fc = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['fc']) && $this->nmgp_cmp_readonly['fc'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['fc']);
       $sStyleReadLab_fc = '';
       $sStyleReadInp_fc = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['fc']) && $this->nmgp_cmp_hidden['fc'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="fc" value="<?php echo $this->form_encode_input($fc) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_fc_label" id="hidden_field_label_fc" style="<?php echo $sStyleHidden_fc; ?>"><span id="id_label_fc"><?php echo $this->nm_new_label['fc']; ?></span></TD>
    <TD class="scFormDataOdd css_fc_line" id="hidden_field_data_fc" style="<?php echo $sStyleHidden_fc; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_fc_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["fc"]) &&  $this->nmgp_cmp_readonly["fc"] == "on") { 

 ?>
<input type="hidden" name="fc" value="<?php echo $this->form_encode_input($fc) . "\">" . $fc . ""; ?>
<?php } else { ?>
<span id="id_read_on_fc" class="sc-ui-readonly-fc css_fc_line" style="<?php echo $sStyleReadLab_fc; ?>"><?php echo $this->form_encode_input($this->fc); ?></span><span id="id_read_off_fc" style="white-space: nowrap;<?php echo $sStyleReadInp_fc; ?>">
 <input class="sc-js-input scFormObjectOdd css_fc_obj" style="" id="id_sc_field_fc" type=text name="fc" value="<?php echo $this->form_encode_input($fc) ?>"
 size=5 alt="{datatype: 'integer', maxLength: 11, thousandsSep: '<?php echo str_replace("'", "\'", $this->field_config['fc']['symbol_grp']); ?>', thousandsFormat: <?php echo $this->field_config['fc']['symbol_fmt']; ?>, allowNegative: false, onlyNegative: false, alignment: 'left', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}"></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 1px 0px 0px 0px"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_fc_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_fc_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['fr']))
    {
        $this->nm_new_label['fr'] = "FR (rpm)";
    }
?>
<?php
   $nm_cor_fun_cel  = ($nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = ($nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $fr = $this->fr;
   $sStyleHidden_fr = '';
   if (isset($this->nmgp_cmp_hidden['fr']) && $this->nmgp_cmp_hidden['fr'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['fr']);
       $sStyleHidden_fr = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_fr = 'display: none;';
   $sStyleReadInp_fr = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['fr']) && $this->nmgp_cmp_readonly['fr'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['fr']);
       $sStyleReadLab_fr = '';
       $sStyleReadInp_fr = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['fr']) && $this->nmgp_cmp_hidden['fr'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="fr" value="<?php echo $this->form_encode_input($fr) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_fr_label" id="hidden_field_label_fr" style="<?php echo $sStyleHidden_fr; ?>"><span id="id_label_fr"><?php echo $this->nm_new_label['fr']; ?></span></TD>
    <TD class="scFormDataOdd css_fr_line" id="hidden_field_data_fr" style="<?php echo $sStyleHidden_fr; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_fr_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["fr"]) &&  $this->nmgp_cmp_readonly["fr"] == "on") { 

 ?>
<input type="hidden" name="fr" value="<?php echo $this->form_encode_input($fr) . "\">" . $fr . ""; ?>
<?php } else { ?>
<span id="id_read_on_fr" class="sc-ui-readonly-fr css_fr_line" style="<?php echo $sStyleReadLab_fr; ?>"><?php echo $this->form_encode_input($this->fr); ?></span><span id="id_read_off_fr" style="white-space: nowrap;<?php echo $sStyleReadInp_fr; ?>">
 <input class="sc-js-input scFormObjectOdd css_fr_obj" style="" id="id_sc_field_fr" type=text name="fr" value="<?php echo $this->form_encode_input($fr) ?>"
 size=5 alt="{datatype: 'integer', maxLength: 11, thousandsSep: '<?php echo str_replace("'", "\'", $this->field_config['fr']['symbol_grp']); ?>', thousandsFormat: <?php echo $this->field_config['fr']['symbol_fmt']; ?>, allowNegative: false, onlyNegative: false, alignment: 'left', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}"></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 1px 0px 0px 0px"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_fr_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_fr_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['tc']))
    {
        $this->nm_new_label['tc'] = "T (ºC)";
    }
?>
<?php
   $nm_cor_fun_cel  = ($nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = ($nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $tc = $this->tc;
   $sStyleHidden_tc = '';
   if (isset($this->nmgp_cmp_hidden['tc']) && $this->nmgp_cmp_hidden['tc'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['tc']);
       $sStyleHidden_tc = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_tc = 'display: none;';
   $sStyleReadInp_tc = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['tc']) && $this->nmgp_cmp_readonly['tc'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['tc']);
       $sStyleReadLab_tc = '';
       $sStyleReadInp_tc = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['tc']) && $this->nmgp_cmp_hidden['tc'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="tc" value="<?php echo $this->form_encode_input($tc) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_tc_label" id="hidden_field_label_tc" style="<?php echo $sStyleHidden_tc; ?>"><span id="id_label_tc"><?php echo $this->nm_new_label['tc']; ?></span></TD>
    <TD class="scFormDataOdd css_tc_line" id="hidden_field_data_tc" style="<?php echo $sStyleHidden_tc; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_tc_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["tc"]) &&  $this->nmgp_cmp_readonly["tc"] == "on") { 

 ?>
<input type="hidden" name="tc" value="<?php echo $this->form_encode_input($tc) . "\">" . $tc . ""; ?>
<?php } else { ?>
<span id="id_read_on_tc" class="sc-ui-readonly-tc css_tc_line" style="<?php echo $sStyleReadLab_tc; ?>"><?php echo $this->form_encode_input($this->tc); ?></span><span id="id_read_off_tc" style="white-space: nowrap;<?php echo $sStyleReadInp_tc; ?>">
 <input class="sc-js-input scFormObjectOdd css_tc_obj" style="" id="id_sc_field_tc" type=text name="tc" value="<?php echo $this->form_encode_input($tc) ?>"
 size=5 maxlength=12 alt="{datatype: 'text', maxLength: 12, allowedChars: '<?php echo $this->allowedCharsCharset("0123456789,") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}"></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 1px 0px 0px 0px"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_tc_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_tc_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['hgt']))
    {
        $this->nm_new_label['hgt'] = "HGT (mg/dl)";
    }
?>
<?php
   $nm_cor_fun_cel  = ($nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = ($nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $hgt = $this->hgt;
   $sStyleHidden_hgt = '';
   if (isset($this->nmgp_cmp_hidden['hgt']) && $this->nmgp_cmp_hidden['hgt'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['hgt']);
       $sStyleHidden_hgt = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_hgt = 'display: none;';
   $sStyleReadInp_hgt = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['hgt']) && $this->nmgp_cmp_readonly['hgt'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['hgt']);
       $sStyleReadLab_hgt = '';
       $sStyleReadInp_hgt = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['hgt']) && $this->nmgp_cmp_hidden['hgt'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="hgt" value="<?php echo $this->form_encode_input($hgt) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_hgt_label" id="hidden_field_label_hgt" style="<?php echo $sStyleHidden_hgt; ?>"><span id="id_label_hgt"><?php echo $this->nm_new_label['hgt']; ?></span></TD>
    <TD class="scFormDataOdd css_hgt_line" id="hidden_field_data_hgt" style="<?php echo $sStyleHidden_hgt; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_hgt_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["hgt"]) &&  $this->nmgp_cmp_readonly["hgt"] == "on") { 

 ?>
<input type="hidden" name="hgt" value="<?php echo $this->form_encode_input($hgt) . "\">" . $hgt . ""; ?>
<?php } else { ?>
<span id="id_read_on_hgt" class="sc-ui-readonly-hgt css_hgt_line" style="<?php echo $sStyleReadLab_hgt; ?>"><?php echo $this->form_encode_input($this->hgt); ?></span><span id="id_read_off_hgt" style="white-space: nowrap;<?php echo $sStyleReadInp_hgt; ?>">
 <input class="sc-js-input scFormObjectOdd css_hgt_obj" style="" id="id_sc_field_hgt" type=text name="hgt" value="<?php echo $this->form_encode_input($hgt) ?>"
 size=5 alt="{datatype: 'integer', maxLength: 11, thousandsSep: '<?php echo str_replace("'", "\'", $this->field_config['hgt']['symbol_grp']); ?>', thousandsFormat: <?php echo $this->field_config['hgt']['symbol_fmt']; ?>, allowNegative: false, onlyNegative: false, alignment: 'left', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}"></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 1px 0px 0px 0px"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_hgt_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_hgt_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['peso']))
    {
        $this->nm_new_label['peso'] = "Peso (kg)";
    }
?>
<?php
   $nm_cor_fun_cel  = ($nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = ($nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $peso = $this->peso;
   $sStyleHidden_peso = '';
   if (isset($this->nmgp_cmp_hidden['peso']) && $this->nmgp_cmp_hidden['peso'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['peso']);
       $sStyleHidden_peso = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_peso = 'display: none;';
   $sStyleReadInp_peso = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['peso']) && $this->nmgp_cmp_readonly['peso'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['peso']);
       $sStyleReadLab_peso = '';
       $sStyleReadInp_peso = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['peso']) && $this->nmgp_cmp_hidden['peso'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="peso" value="<?php echo $this->form_encode_input($peso) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_peso_label" id="hidden_field_label_peso" style="<?php echo $sStyleHidden_peso; ?>"><span id="id_label_peso"><?php echo $this->nm_new_label['peso']; ?></span></TD>
    <TD class="scFormDataOdd css_peso_line" id="hidden_field_data_peso" style="<?php echo $sStyleHidden_peso; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_peso_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["peso"]) &&  $this->nmgp_cmp_readonly["peso"] == "on") { 

 ?>
<input type="hidden" name="peso" value="<?php echo $this->form_encode_input($peso) . "\">" . $peso . ""; ?>
<?php } else { ?>
<span id="id_read_on_peso" class="sc-ui-readonly-peso css_peso_line" style="<?php echo $sStyleReadLab_peso; ?>"><?php echo $this->form_encode_input($this->peso); ?></span><span id="id_read_off_peso" style="white-space: nowrap;<?php echo $sStyleReadInp_peso; ?>">
 <input class="sc-js-input scFormObjectOdd css_peso_obj" style="" id="id_sc_field_peso" type=text name="peso" value="<?php echo $this->form_encode_input($peso) ?>"
 size=5 maxlength=12 alt="{datatype: 'text', maxLength: 12, allowedChars: '<?php echo $this->allowedCharsCharset("0123456789,") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}"></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 1px 0px 0px 0px"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_peso_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_peso_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['altura']))
    {
        $this->nm_new_label['altura'] = "Altura (cm)";
    }
?>
<?php
   $nm_cor_fun_cel  = ($nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = ($nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $altura = $this->altura;
   $sStyleHidden_altura = '';
   if (isset($this->nmgp_cmp_hidden['altura']) && $this->nmgp_cmp_hidden['altura'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['altura']);
       $sStyleHidden_altura = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_altura = 'display: none;';
   $sStyleReadInp_altura = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['altura']) && $this->nmgp_cmp_readonly['altura'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['altura']);
       $sStyleReadLab_altura = '';
       $sStyleReadInp_altura = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['altura']) && $this->nmgp_cmp_hidden['altura'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="altura" value="<?php echo $this->form_encode_input($altura) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_altura_label" id="hidden_field_label_altura" style="<?php echo $sStyleHidden_altura; ?>"><span id="id_label_altura"><?php echo $this->nm_new_label['altura']; ?></span></TD>
    <TD class="scFormDataOdd css_altura_line" id="hidden_field_data_altura" style="<?php echo $sStyleHidden_altura; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_altura_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["altura"]) &&  $this->nmgp_cmp_readonly["altura"] == "on") { 

 ?>
<input type="hidden" name="altura" value="<?php echo $this->form_encode_input($altura) . "\">" . $altura . ""; ?>
<?php } else { ?>
<span id="id_read_on_altura" class="sc-ui-readonly-altura css_altura_line" style="<?php echo $sStyleReadLab_altura; ?>"><?php echo $this->form_encode_input($this->altura); ?></span><span id="id_read_off_altura" style="white-space: nowrap;<?php echo $sStyleReadInp_altura; ?>">
 <input class="sc-js-input scFormObjectOdd css_altura_obj" style="" id="id_sc_field_altura" type=text name="altura" value="<?php echo $this->form_encode_input($altura) ?>"
 size=5 alt="{datatype: 'integer', maxLength: 12, thousandsSep: '<?php echo str_replace("'", "\'", $this->field_config['altura']['symbol_grp']); ?>', thousandsFormat: <?php echo $this->field_config['altura']['symbol_fmt']; ?>, allowNegative: false, onlyNegative: false, alignment: 'left', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}"></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 1px 0px 0px 0px"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_altura_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_altura_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['coren']))
    {
        $this->nm_new_label['coren'] = "Coren";
    }
?>
<?php
   $nm_cor_fun_cel  = ($nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = ($nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $coren = $this->coren;
   $sStyleHidden_coren = '';
   if (isset($this->nmgp_cmp_hidden['coren']) && $this->nmgp_cmp_hidden['coren'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['coren']);
       $sStyleHidden_coren = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_coren = 'display: none;';
   $sStyleReadInp_coren = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['coren']) && $this->nmgp_cmp_readonly['coren'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['coren']);
       $sStyleReadLab_coren = '';
       $sStyleReadInp_coren = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['coren']) && $this->nmgp_cmp_hidden['coren'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="coren" value="<?php echo $this->form_encode_input($coren) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_coren_label" id="hidden_field_label_coren" style="<?php echo $sStyleHidden_coren; ?>"><span id="id_label_coren"><?php echo $this->nm_new_label['coren']; ?></span></TD>
    <TD class="scFormDataOdd css_coren_line" id="hidden_field_data_coren" style="<?php echo $sStyleHidden_coren; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_coren_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["coren"]) &&  $this->nmgp_cmp_readonly["coren"] == "on") { 

 ?>
<input type="hidden" name="coren" value="<?php echo $this->form_encode_input($coren) . "\">" . $coren . ""; ?>
<?php } else { ?>
<span id="id_read_on_coren" class="sc-ui-readonly-coren css_coren_line" style="<?php echo $sStyleReadLab_coren; ?>"><?php echo $this->form_encode_input($this->coren); ?></span><span id="id_read_off_coren" style="white-space: nowrap;<?php echo $sStyleReadInp_coren; ?>">
 <input class="sc-js-input scFormObjectOdd css_coren_obj" style="" id="id_sc_field_coren" type=text name="coren" value="<?php echo $this->form_encode_input($coren) ?>"
 size=5 maxlength=25 alt="{datatype: 'text', maxLength: 25, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}"></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 1px 0px 0px 0px"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_coren_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_coren_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['alergia']))
    {
        $this->nm_new_label['alergia'] = "Alergia";
    }
?>
<?php
   $nm_cor_fun_cel  = ($nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = ($nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $alergia = $this->alergia;
   $sStyleHidden_alergia = '';
   if (isset($this->nmgp_cmp_hidden['alergia']) && $this->nmgp_cmp_hidden['alergia'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['alergia']);
       $sStyleHidden_alergia = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_alergia = 'display: none;';
   $sStyleReadInp_alergia = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['alergia']) && $this->nmgp_cmp_readonly['alergia'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['alergia']);
       $sStyleReadLab_alergia = '';
       $sStyleReadInp_alergia = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['alergia']) && $this->nmgp_cmp_hidden['alergia'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="alergia" value="<?php echo $this->form_encode_input($alergia) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_alergia_label" id="hidden_field_label_alergia" style="<?php echo $sStyleHidden_alergia; ?>"><span id="id_label_alergia"><?php echo $this->nm_new_label['alergia']; ?></span></TD>
    <TD class="scFormDataOdd css_alergia_line" id="hidden_field_data_alergia" style="<?php echo $sStyleHidden_alergia; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_alergia_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["alergia"]) &&  $this->nmgp_cmp_readonly["alergia"] == "on") { 

 if ("sim" == $this->alergia) { $alergia_look = "Sim";} 
 if ("nao" == $this->alergia) { $alergia_look = "Não";} 
?>
<input type="hidden" name="alergia" value="<?php echo $this->form_encode_input($alergia) . "\">" . $alergia_look . ""; ?>
<?php } else { ?>

<?php

 if ("sim" == $this->alergia) { $alergia_look = "Sim";} 
 if ("nao" == $this->alergia) { $alergia_look = "Não";} 
?>
<span id="id_read_on_alergia"  class="css_alergia_line" style="<?php echo $sStyleReadLab_alergia; ?>"><?php echo $this->form_encode_input($alergia_look); ?></span><span id="id_read_off_alergia" style="<?php echo $sStyleReadInp_alergia; ?>"><div id="idAjaxRadio_alergia" style="display: inline-block">
<TABLE cellspacing="0" cellpadding="0" border="0"><TR>
  <TD class="scFormDataFontOdd css_alergia_line">    <input style="float:left; position:relative; top: -3px;" type=radio name="alergia" value="sim"
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_triagem']['Lookup_alergia'][] = 'sim'; ?>
<?php  if ("sim" == $this->alergia)  { echo " checked" ;} ?>  onClick="do_ajax_form_triagem_event_alergia_onclick();" >Sim</TD>
</TR>
<TR>
  <TD class="scFormDataFontOdd css_alergia_line">    <input style="float:left; position:relative; top: -3px;" type=radio name="alergia" value="nao"
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_triagem']['Lookup_alergia'][] = 'nao'; ?>
<?php  if ("nao" == $this->alergia)  { echo " checked" ;} ?><?php  if (empty($this->alergia)) { echo " checked" ;} ?>  onClick="do_ajax_form_triagem_event_alergia_onclick();" >Não</TD>
</TR></TABLE>
</div>
</span><?php  }?>
</td></tr><tr><td style="vertical-align: top; padding: 1px 0px 0px 0px"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_alergia_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_alergia_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['tipo_alergia']))
    {
        $this->nm_new_label['tipo_alergia'] = "Tipo Alergia";
    }
?>
<?php
   $nm_cor_fun_cel  = ($nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = ($nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $tipo_alergia = $this->tipo_alergia;
   $sStyleHidden_tipo_alergia = '';
   if (isset($this->nmgp_cmp_hidden['tipo_alergia']) && $this->nmgp_cmp_hidden['tipo_alergia'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['tipo_alergia']);
       $sStyleHidden_tipo_alergia = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_tipo_alergia = 'display: none;';
   $sStyleReadInp_tipo_alergia = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['tipo_alergia']) && $this->nmgp_cmp_readonly['tipo_alergia'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['tipo_alergia']);
       $sStyleReadLab_tipo_alergia = '';
       $sStyleReadInp_tipo_alergia = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['tipo_alergia']) && $this->nmgp_cmp_hidden['tipo_alergia'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="tipo_alergia" value="<?php echo $this->form_encode_input($tipo_alergia) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_tipo_alergia_label" id="hidden_field_label_tipo_alergia" style="<?php echo $sStyleHidden_tipo_alergia; ?>"><span id="id_label_tipo_alergia"><?php echo $this->nm_new_label['tipo_alergia']; ?></span></TD>
    <TD class="scFormDataOdd css_tipo_alergia_line" id="hidden_field_data_tipo_alergia" style="<?php echo $sStyleHidden_tipo_alergia; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_tipo_alergia_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["tipo_alergia"]) &&  $this->nmgp_cmp_readonly["tipo_alergia"] == "on") { 

 ?>
<input type="hidden" name="tipo_alergia" value="<?php echo $this->form_encode_input($tipo_alergia) . "\">" . $tipo_alergia . ""; ?>
<?php } else { ?>
<span id="id_read_on_tipo_alergia" class="sc-ui-readonly-tipo_alergia css_tipo_alergia_line" style="<?php echo $sStyleReadLab_tipo_alergia; ?>"><?php echo $this->form_encode_input($this->tipo_alergia); ?></span><span id="id_read_off_tipo_alergia" style="white-space: nowrap;<?php echo $sStyleReadInp_tipo_alergia; ?>">
 <input class="sc-js-input scFormObjectOdd css_tipo_alergia_obj" style="" id="id_sc_field_tipo_alergia" type=text name="tipo_alergia" value="<?php echo $this->form_encode_input($tipo_alergia) ?>"
 size=50 maxlength=120 alt="{datatype: 'text', maxLength: 120, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}"></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 1px 0px 0px 0px"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_tipo_alergia_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_tipo_alergia_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
   if (!isset($this->nm_new_label['id_usuario']))
   {
       $this->nm_new_label['id_usuario'] = "Id Usuario";
   }
   $nm_cor_fun_cel  = ($nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = ($nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $id_usuario = $this->id_usuario;
   if (!isset($this->nmgp_cmp_hidden['id_usuario']))
   {
       $this->nmgp_cmp_hidden['id_usuario'] = 'off';
   }
   $sStyleHidden_id_usuario = '';
   if (isset($this->nmgp_cmp_hidden['id_usuario']) && $this->nmgp_cmp_hidden['id_usuario'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['id_usuario']);
       $sStyleHidden_id_usuario = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_id_usuario = 'display: none;';
   $sStyleReadInp_id_usuario = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['id_usuario']) && $this->nmgp_cmp_readonly['id_usuario'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['id_usuario']);
       $sStyleReadLab_id_usuario = '';
       $sStyleReadInp_id_usuario = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['id_usuario']) && $this->nmgp_cmp_hidden['id_usuario'] == 'off') { $sc_hidden_yes++; ?>
<input type=hidden name="id_usuario" value="<?php echo $this->form_encode_input($this->id_usuario) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_id_usuario_label" id="hidden_field_label_id_usuario" style="<?php echo $sStyleHidden_id_usuario; ?>"><span id="id_label_id_usuario"><?php echo $this->nm_new_label['id_usuario']; ?></span></TD>
    <TD class="scFormDataOdd css_id_usuario_line" id="hidden_field_data_id_usuario" style="<?php echo $sStyleHidden_id_usuario; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_id_usuario_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["id_usuario"]) &&  $this->nmgp_cmp_readonly["id_usuario"] == "on") { 
 
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_triagem']['Lookup_id_usuario']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_triagem']['Lookup_id_usuario'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_triagem']['Lookup_id_usuario']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_triagem']['Lookup_id_usuario'] = array(); 
}
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_triagem']['Lookup_id_usuario']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_triagem']['Lookup_id_usuario'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_triagem']['Lookup_id_usuario']); 
   }
   else
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_triagem']['Lookup_id_usuario'] = array(); 
    }

   $old_value_id_triagem = $this->id_triagem;
   $old_value_data = $this->data;
   $old_value_hora = $this->hora;
   $old_value_fc = $this->fc;
   $old_value_fr = $this->fr;
   $old_value_hgt = $this->hgt;
   $old_value_altura = $this->altura;
   $this->nm_tira_formatacao();
   $this->nm_converte_datas(false);


   $unformatted_value_id_triagem = $this->id_triagem;
   $unformatted_value_data = $this->data;
   $unformatted_value_hora = $this->hora;
   $unformatted_value_fc = $this->fc;
   $unformatted_value_fr = $this->fr;
   $unformatted_value_hgt = $this->hgt;
   $unformatted_value_altura = $this->altura;

   $nm_comando = "SELECT id_usuario, id_usuario FROM usuario ORDER BY id_usuario";

   $this->id_triagem = $old_value_id_triagem;
   $this->data = $old_value_data;
   $this->hora = $old_value_hora;
   $this->fc = $old_value_fc;
   $this->fr = $old_value_fr;
   $this->hgt = $old_value_hgt;
   $this->altura = $old_value_altura;

   $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando; 
   $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
   if ($nm_comando != "" && $rs = $this->Db->Execute($nm_comando)) 
   {
       while (!$rs->EOF) 
       { 
              $rs->fields[0] = str_replace(',', '.', $rs->fields[0]);
              $rs->fields[1] = str_replace(',', '.', $rs->fields[1]);
              $rs->fields[0] = (strpos(strtolower($rs->fields[0]), "e")) ? (float)$rs->fields[0] : $rs->fields[0];
              $rs->fields[0] = (string)$rs->fields[0];
              $rs->fields[1] = (strpos(strtolower($rs->fields[1]), "e")) ? (float)$rs->fields[1] : $rs->fields[1];
              $rs->fields[1] = (string)$rs->fields[1];
              $nmgp_def_dados .= $rs->fields[1] . "?#?" ; 
              $nmgp_def_dados .= $rs->fields[0] . "?#?N?@?" ; 
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_triagem']['Lookup_id_usuario'][] = $rs->fields[0];
              $rs->MoveNext() ; 
       } 
       $rs->Close() ; 
   } 
   elseif ($GLOBALS["NM_ERRO_IBASE"] != 1 && $nm_comando != "")  
   {  
       $this->Erro->mensagem(__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
       exit; 
   } 
   $GLOBALS["NM_ERRO_IBASE"] = 0; 
   $x = 0; 
   $id_usuario_look = ""; 
   $todox = str_replace("?#?@?#?", "?#?@ ?#?", trim($nmgp_def_dados)) ; 
   $todo  = explode("?@?", $todox) ; 
   while (!empty($todo[$x])) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          if (isset($this->Embutida_ronly) && $this->Embutida_ronly && isset($this->id_usuario_1))
          {
              foreach ($this->id_usuario_1 as $tmp_id_usuario)
              {
                  if (trim($tmp_id_usuario) === trim($cadaselect[1])) { $id_usuario_look .= $cadaselect[0] . '__SC_BREAK_LINE__'; }
              }
          }
          elseif (trim($this->id_usuario) === trim($cadaselect[1])) { $id_usuario_look .= $cadaselect[0]; } 
          $x++; 
   }

?>
<input type="hidden" name="id_usuario" value="<?php echo $this->form_encode_input($id_usuario) . "\">" . $id_usuario_look . ""; ?>
<?php } else { ?>
 
<?php  
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_triagem']['Lookup_id_usuario']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_triagem']['Lookup_id_usuario'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_triagem']['Lookup_id_usuario']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_triagem']['Lookup_id_usuario'] = array(); 
}
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_triagem']['Lookup_id_usuario']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_triagem']['Lookup_id_usuario'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_triagem']['Lookup_id_usuario']); 
   }
   else
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_triagem']['Lookup_id_usuario'] = array(); 
    }

   $old_value_id_triagem = $this->id_triagem;
   $old_value_data = $this->data;
   $old_value_hora = $this->hora;
   $old_value_fc = $this->fc;
   $old_value_fr = $this->fr;
   $old_value_hgt = $this->hgt;
   $old_value_altura = $this->altura;
   $this->nm_tira_formatacao();
   $this->nm_converte_datas(false);


   $unformatted_value_id_triagem = $this->id_triagem;
   $unformatted_value_data = $this->data;
   $unformatted_value_hora = $this->hora;
   $unformatted_value_fc = $this->fc;
   $unformatted_value_fr = $this->fr;
   $unformatted_value_hgt = $this->hgt;
   $unformatted_value_altura = $this->altura;

   $nm_comando = "SELECT id_usuario, id_usuario FROM usuario ORDER BY id_usuario";

   $this->id_triagem = $old_value_id_triagem;
   $this->data = $old_value_data;
   $this->hora = $old_value_hora;
   $this->fc = $old_value_fc;
   $this->fr = $old_value_fr;
   $this->hgt = $old_value_hgt;
   $this->altura = $old_value_altura;

   $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando; 
   $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
   if ($nm_comando != "" && $rs = $this->Db->Execute($nm_comando)) 
   {
       while (!$rs->EOF) 
       { 
              $rs->fields[0] = str_replace(',', '.', $rs->fields[0]);
              $rs->fields[1] = str_replace(',', '.', $rs->fields[1]);
              $rs->fields[0] = (strpos(strtolower($rs->fields[0]), "e")) ? (float)$rs->fields[0] : $rs->fields[0];
              $rs->fields[0] = (string)$rs->fields[0];
              $rs->fields[1] = (strpos(strtolower($rs->fields[1]), "e")) ? (float)$rs->fields[1] : $rs->fields[1];
              $rs->fields[1] = (string)$rs->fields[1];
              $nmgp_def_dados .= $rs->fields[1] . "?#?" ; 
              $nmgp_def_dados .= $rs->fields[0] . "?#?N?@?" ; 
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_triagem']['Lookup_id_usuario'][] = $rs->fields[0];
              $rs->MoveNext() ; 
       } 
       $rs->Close() ; 
   } 
   elseif ($GLOBALS["NM_ERRO_IBASE"] != 1 && $nm_comando != "")  
   {  
       $this->Erro->mensagem(__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
       exit; 
   } 
   $GLOBALS["NM_ERRO_IBASE"] = 0; 
   $x = 0 ; 
   $todox = str_replace("?#?@?#?", "?#?@ ?#?", trim($nmgp_def_dados)) ; 
   $todo  = explode("?@?", $todox) ; 
   $x = 0; 
   $id_usuario_look = ""; 
   $todox = str_replace("?#?@?#?", "?#?@ ?#?", trim($nmgp_def_dados)) ; 
   $todo  = explode("?@?", $todox) ; 
   while (!empty($todo[$x])) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          if (isset($this->Embutida_ronly) && $this->Embutida_ronly && isset($this->id_usuario_1))
          {
              foreach ($this->id_usuario_1 as $tmp_id_usuario)
              {
                  if (trim($tmp_id_usuario) === trim($cadaselect[1])) { $id_usuario_look .= $cadaselect[0] . '__SC_BREAK_LINE__'; }
              }
          }
          elseif (trim($this->id_usuario) === trim($cadaselect[1])) { $id_usuario_look .= $cadaselect[0]; } 
          $x++; 
   }
          if (empty($id_usuario_look))
          {
              $id_usuario_look = $this->id_usuario;
          }
   $x = 0; 
   echo "<span id=\"id_read_on_id_usuario\" class=\"css_id_usuario_line\" style=\"" .  $sStyleReadLab_id_usuario . "\">" . $this->form_encode_input($id_usuario_look) . "</span><span id=\"id_read_off_id_usuario\" style=\"" . $sStyleReadInp_id_usuario . "\">";
   echo " <span id=\"idAjaxSelect_id_usuario\"><select class=\"sc-js-input scFormObjectOdd css_id_usuario_obj\" style=\"\" id=\"id_sc_field_id_usuario\" name=\"id_usuario\" size=\"1\" alt=\"{type: 'select', enterTab: false}\">" ; 
   echo "\r" ; 
   while (!empty($todo[$x]) && !$nm_nao_carga) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          echo "  <option value=\"$cadaselect[1]\"" ; 
          if (trim($this->id_usuario) === trim($cadaselect[1])) 
          {
              echo " selected" ; 
          }
          if (strtoupper($cadaselect[2]) == "S") 
          {
              if (empty($this->id_usuario)) 
              {
                  echo " selected" ;
              } 
           } 
          echo ">$cadaselect[0] </option>" ; 
          echo "\r" ; 
          $x++ ; 
   }  ; 
   echo " </select></span>" ; 
   echo "\r" ; 
   echo "</span>";
?> 
<?php  }?>
</td></tr><tr><td style="vertical-align: top; padding: 1px 0px 0px 0px"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_id_usuario_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_id_usuario_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } ?>
   </td></tr></table>
   </tr>
</TABLE></div><!-- bloco_f -->
<?php
  }
?>
</td></tr> 
<tr><td>
<?php
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_triagem']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_triagem']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_triagem']['run_iframe'] != "R")
{
?>
    <table style="border-collapse: collapse; border-width: 0px; width: 100%"><tr><td class="scFormToolbar" style="padding: 0px; spacing: 0px">
    <table style="border-collapse: collapse; border-width: 0px; width: 100%">
    <tr> 
     <td nowrap align="left" valign="middle" width="33%" class="scFormToolbarPadding"> 
<?php
}
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_triagem']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_triagem']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_triagem']['run_iframe'] != "R")
{
    $NM_btn = false;
?> 
     </td> 
     <td nowrap align="center" valign="middle" width="33%" class="scFormToolbarPadding"> 
<?php 
    if ($opcao_botoes != "novo") {
        $sCondStyle = ($this->nmgp_botoes['new'] == "on") ? '' : 'display: none;';
?>
       <?php echo nmButtonOutput($this->arr_buttons, "bnovo", "nm_move ('novo');", "nm_move ('novo');", "sc_b_new_b", "", "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes == "novo") && (!$this->Embutida_call || $this->sc_evento == "novo" || $this->sc_evento == "insert" || $this->sc_evento == "incluir")) {
        $sCondStyle = ($this->nmgp_botoes['insert'] == "on") ? '' : 'display: none;';
?>
       <?php echo nmButtonOutput($this->arr_buttons, "bincluir", "nm_atualiza ('incluir');", "nm_atualiza ('incluir');", "sc_b_ins_b", "", "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "");?>
 
<?php
        $NM_btn = true;
    }
?> 
     </td> 
     <td nowrap align="right" valign="middle" width="33%" class="scFormToolbarPadding"> 
<?php 
}
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_triagem']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_triagem']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_triagem']['run_iframe'] != "R")
{
?>
   </td></tr> 
   </table> 
   </td></tr></table> 
<?php
}
?>
<?php
if (!$NM_btn && isset($NM_ult_sep))
{
    echo "    <script language=\"javascript\">";
    echo "      document.getElementById('" .  $NM_ult_sep . "').style.display='none';";
    echo "    </script>";
}
unset($NM_ult_sep);
?>
<?php if ('novo' != $this->nmgp_opcao || $this->Embutida_form) { ?><script>nav_atualiza(Nav_permite_ret, Nav_permite_ava, 'b');</script><?php } ?>
</td></tr> 
</table> 
</div> 
</td> 
</tr> 
</table> 

<div id="id_debug_window" style="display: none; position: absolute; left: 50px; top: 50px"><table class="scFormMessageTable">
<tr><td class="scFormMessageTitle"><?php echo nmButtonOutput($this->arr_buttons, "berrm_clse", "scAjaxHideDebug()", "scAjaxHideDebug()", "", "", "", "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "");?>
&nbsp;&nbsp;Output</td></tr>
<tr><td class="scFormMessageMessage" style="padding: 0px; vertical-align: top"><div style="padding: 2px; height: 200px; width: 350px; overflow: auto" id="id_debug_text"></div></td></tr>
</table></div>

</form> 
<script> 
<?php
  $nm_sc_blocos_da_pag = array(0);

  foreach ($this->Ini->nm_hidden_blocos as $bloco => $hidden)
  {
      if ($hidden == "off" && in_array($bloco, $nm_sc_blocos_da_pag))
      {
          echo "document.getElementById('hidden_bloco_" . $bloco . "').style.display = 'none';";
          if (isset($nm_sc_blocos_aba[$bloco]))
          {
               echo "document.getElementById('id_tabs_" . $nm_sc_blocos_aba[$bloco] . "_" . $bloco . "').style.display = 'none';";
          }
      }
  }
?>
</script> 
<script>
<?php
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_triagem']['masterValue']))
{
?>
if (parent && parent.scAjaxDetailValue)
{
<?php
foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['form_triagem']['masterValue'] as $cmp_master => $val_master)
{
?>
    parent.scAjaxDetailValue('<?php echo $cmp_master ?>', '<?php echo $val_master ?>');
<?php
}
unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_triagem']['masterValue']);
?>
}
<?php
}
?>
function updateHeaderFooter(sFldName, sFldValue)
{
  if (sFldValue[0] && sFldValue[0]["value"])
  {
    sFldValue = sFldValue[0]["value"];
  }
}
</script>
<?php
if (isset($_POST['master_nav']) && 'on' == $_POST['master_nav'])
{
    $sTamanhoIframe = isset($_POST['sc_ifr_height']) && '' != $_POST['sc_ifr_height'] ? '"' . $_POST['sc_ifr_height'] . '"' : '$(document).innerHeight()';
?>
<script>
 parent.scAjaxDetailStatus("form_triagem");
 parent.scAjaxDetailHeight("form_triagem", <?php echo $sTamanhoIframe; ?>);
</script>
<?php
}
elseif (isset($_GET['script_case_detail']) && 'Y' == $_GET['script_case_detail'])
{
    $sTamanhoIframe = isset($_GET['sc_ifr_height']) && '' != $_GET['sc_ifr_height'] ? '"' . $_GET['sc_ifr_height'] . '"' : '$(document).innerHeight()';
?>
<script>
 if (0 == <?php echo $sTamanhoIframe; ?>) {
  setTimeout(function() {
   parent.scAjaxDetailHeight("form_triagem", <?php echo $sTamanhoIframe; ?>);
  }, 100);
 }
 else {
  parent.scAjaxDetailHeight("form_triagem", <?php echo $sTamanhoIframe; ?>);
 }
</script>
<?php
}
?>
<?php
if (isset($this->NM_ajax_info['displayMsg']) && $this->NM_ajax_info['displayMsg'])
{
?>
<script type="text/javascript">
_scAjaxShowMessage(scMsgDefTitle, "<?php echo $this->NM_ajax_info['displayMsgTxt']; ?>", false, sc_ajaxMsgTime, false, "Ok", 0, 0, 0, 0, "", "", "", false, true);
</script>
<?php
}
?>
<?php
if ('' != $this->scFormFocusErrorName)
{
?>
<script>
scAjaxFocusError();
</script>
<?php
}
?>
<script>
bLigEditLookupCall = <?php if ($this->lig_edit_lookup_call) { ?>true<?php } else { ?>false<?php } ?>;
function scLigEditLookupCall()
{
<?php
if ($this->lig_edit_lookup && isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_triagem']['sc_modal']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_triagem']['sc_modal'])
{
?>
  parent.<?php echo $this->lig_edit_lookup_cb; ?>(<?php echo $this->lig_edit_lookup_row; ?>);
<?php
}
elseif ($this->lig_edit_lookup)
{
?>
  opener.<?php echo $this->lig_edit_lookup_cb; ?>(<?php echo $this->lig_edit_lookup_row; ?>);
<?php
}
?>
}
if (bLigEditLookupCall)
{
  scLigEditLookupCall();
}
<?php
if (isset($this->redir_modal) && !empty($this->redir_modal))
{
    echo $this->redir_modal;
}
?>
</script>
<script type="text/javascript">
$(function() {
 $("#sc-id-mobile-in").mouseover(function() {
  $(this).css("cursor", "pointer");
 }).click(function() {
  scMobileDisplayControl("in");
 });
 $("#sc-id-mobile-out").mouseover(function() {
  $(this).css("cursor", "pointer");
 }).click(function() {
  scMobileDisplayControl("out");
 });
});
function scMobileDisplayControl(sOption) {
 $("#sc-id-mobile-control").val(sOption);
 nm_atualiza("recarga_mobile");
}
</script>
<?php
       if (isset($_SESSION['scriptcase']['device_mobile']) && $_SESSION['scriptcase']['device_mobile'])
       {
?>
<span id="sc-id-mobile-in"><?php echo $this->Ini->Nm_lang['lang_version_mobile']; ?></span>
<?php
       }
?>
</body> 
</html> 
