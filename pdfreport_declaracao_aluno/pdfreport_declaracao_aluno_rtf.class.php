<?php

class pdfreport_declaracao_aluno_rtf
{
   var $Db;
   var $Erro;
   var $Ini;
   var $Lookup;
   var $nm_data;
   var $Texto_tag;
   var $Arquivo;
   var $Tit_doc;
   var $sc_proc_grid; 
   var $NM_cmp_hidden = array();

   //---- 
   function pdfreport_declaracao_aluno_rtf()
   {
      $this->nm_data   = new nm_data("pt_br");
      $this->Texto_tag = "";
   }

   //---- 
   function monta_rtf()
   {
      $this->inicializa_vars();
      $this->gera_texto_tag();
      $this->grava_arquivo_rtf();
      $this->monta_html();
   }

   //----- 
   function inicializa_vars()
   {
      global $nm_lang;
      $dir_raiz          = strrpos($_SERVER['PHP_SELF'],"/") ;  
      $dir_raiz          = substr($_SERVER['PHP_SELF'], 0, $dir_raiz + 1) ;  
      $this->nm_location = $this->Ini->sc_protocolo . $this->Ini->server . $dir_raiz; 
      $this->Arquivo    = "sc_rtf";
      $this->Arquivo   .= "_" . date("YmdHis") . "_" . rand(0, 1000);
      $this->Arquivo   .= "_pdfreport_declaracao_aluno";
      $this->Arquivo   .= ".rtf";
      $this->Tit_doc    = "pdfreport_declaracao_aluno.rtf";
   }

   //----- 
   function gera_texto_tag()
   {
     global $nm_lang;
      global
             $nm_nada, $nm_lang;

      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->sc_proc_grid = false; 
      $nm_raiz_img  = ""; 
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_declaracao_aluno']['campos_busca']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_declaracao_aluno']['campos_busca']))
      { 
          $Busca_temp = $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_declaracao_aluno']['campos_busca'];
          if ($_SESSION['scriptcase']['charset'] != "UTF-8")
          {
              $Busca_temp = NM_conv_charset($Busca_temp, $_SESSION['scriptcase']['charset'], "UTF-8");
          }
          $this->id_usuario = $Busca_temp['id_usuario']; 
          $tmp_pos = strpos($this->id_usuario, "##@@");
          if ($tmp_pos !== false)
          {
              $this->id_usuario = substr($this->id_usuario, 0, $tmp_pos);
          }
          $this->id_usuario_2 = $Busca_temp['id_usuario_input_2']; 
      } 
      $this->nm_field_dinamico = array();
      $this->nm_order_dinamico = array();
      $this->sc_where_orig   = $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_declaracao_aluno']['where_orig'];
      $this->sc_where_atual  = $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_declaracao_aluno']['where_pesq'];
      $this->sc_where_filtro = $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_declaracao_aluno']['where_pesq_filtro'];
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_declaracao_aluno']['rtf_name']))
      {
          $this->Arquivo = $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_declaracao_aluno']['rtf_name'];
          $this->Tit_doc = $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_declaracao_aluno']['rtf_name'];
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_declaracao_aluno']['rtf_name']);
      }
      if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sybase))
      { 
          $nmgp_select = "SELECT id_usuario from (SELECT     id_usuario FROM      usuario LIMIT 1) nm_sel_esp"; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
      { 
          $nmgp_select = "SELECT id_usuario from (SELECT     id_usuario FROM      usuario LIMIT 1) nm_sel_esp"; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
      { 
          $nmgp_select = "SELECT id_usuario from (SELECT     id_usuario FROM      usuario LIMIT 1) nm_sel_esp"; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
      { 
          $nmgp_select = "SELECT id_usuario from (SELECT     id_usuario FROM      usuario LIMIT 1) nm_sel_esp"; 
       } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
      { 
          $nmgp_select = "SELECT id_usuario from (SELECT     id_usuario FROM      usuario LIMIT 1) nm_sel_esp"; 
       } 
      else 
      { 
          $nmgp_select = "SELECT id_usuario from (SELECT     id_usuario FROM      usuario LIMIT 1) nm_sel_esp"; 
      } 
      $nmgp_select .= " " . $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_declaracao_aluno']['where_pesq'];
      $nmgp_order_by = $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_declaracao_aluno']['order_grid'];
      $nmgp_select .= $nmgp_order_by; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nmgp_select;
      $rs = $this->Db->Execute($nmgp_select);
      if ($rs === false && !$rs->EOF && $GLOBALS["NM_ERRO_IBASE"] != 1)
      {
         $this->Erro->mensagem(__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg());
         exit;
      }

      $this->Texto_tag .= "<table>\r\n";
      $this->Texto_tag .= "<tr>\r\n";
      foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_declaracao_aluno']['field_order'] as $Cada_col)
      { 
          $SC_Label = (isset($this->New_label['id_usuario'])) ? $this->New_label['id_usuario'] : "Id Usuario"; 
          if ($Cada_col == "id_usuario" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['de'])) ? $this->New_label['de'] : "de"; 
          if ($Cada_col == "de" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['as'])) ? $this->New_label['as'] : "as"; 
          if ($Cada_col == "as" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['nome_parte1'])) ? $this->New_label['nome_parte1'] : "nome_parte1"; 
          if ($Cada_col == "nome_parte1" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['nome_parte2'])) ? $this->New_label['nome_parte2'] : "nome_parte2"; 
          if ($Cada_col == "nome_parte2" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['dia'])) ? $this->New_label['dia'] : "dia"; 
          if ($Cada_col == "dia" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['mes'])) ? $this->New_label['mes'] : "mes"; 
          if ($Cada_col == "mes" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['ano'])) ? $this->New_label['ano'] : "ano"; 
          if ($Cada_col == "ano" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
      } 
      $this->Texto_tag .= "</tr>\r\n";
      while (!$rs->EOF)
      {
         $this->Texto_tag .= "<tr>\r\n";
         $this->id_usuario = $rs->fields[0] ;  
         $this->id_usuario = (string)$this->id_usuario;
         $this->sc_proc_grid = true; 
         $_SESSION['scriptcase']['pdfreport_declaracao_aluno']['contr_erro'] = 'on';
if (!isset($_SESSION['global_data'])) {$_SESSION['global_data'] = "";}
if (!isset($this->sc_temp_global_data)) {$this->sc_temp_global_data = (isset($_SESSION['global_data'])) ? $_SESSION['global_data'] : "";}
if (!isset($_SESSION['global_horario_as'])) {$_SESSION['global_horario_as'] = "";}
if (!isset($this->sc_temp_global_horario_as)) {$this->sc_temp_global_horario_as = (isset($_SESSION['global_horario_as'])) ? $_SESSION['global_horario_as'] : "";}
if (!isset($_SESSION['global_horario_de'])) {$_SESSION['global_horario_de'] = "";}
if (!isset($this->sc_temp_global_horario_de)) {$this->sc_temp_global_horario_de = (isset($_SESSION['global_horario_de'])) ? $_SESSION['global_horario_de'] : "";}
if (!isset($_SESSION['global_nome_aluno'])) {$_SESSION['global_nome_aluno'] = "";}
if (!isset($this->sc_temp_global_nome_aluno)) {$this->sc_temp_global_nome_aluno = (isset($_SESSION['global_nome_aluno'])) ? $_SESSION['global_nome_aluno'] : "";}
 $nome_auxiliar = $this->sc_temp_global_nome_aluno;
$de_auxiliar = $this->sc_temp_global_horario_de;
$as_auxiliar = $this->sc_temp_global_horario_as;
$data_auxiliar = $this->sc_temp_global_data; 




$tamanho_nome_parte1 = strlen($nome_auxiliar);

if($tamanho_nome_parte1 < 33)
{
	
$nome_parte1_local = substr($nome_auxiliar, 0, $tamanho_nome_parte1);

}
else
{

$nome_parte1_local = substr($nome_auxiliar, 0, 33);  
$nome_parte2_local = substr($nome_auxiliar, 33, $tamanho_nome_parte1);

}



$hora_de = substr($de_auxiliar, 0, 2); 
$min_de = substr($de_auxiliar, 2, 2); 

$hora_as = substr($as_auxiliar, 0, 2); 
$min_as = substr($as_auxiliar, 2, 2); 



$this->ano =  substr($data_auxiliar, 2, 2);
$this->mes = substr($data_auxiliar, 4, 2);
$this->dia = substr($data_auxiliar, 6, 2);

switch($this->mes)
{
	case 1: $this->mes = "Janeiro"; break;
	case 2: $this->mes = "Fevereiro"; break;
	case 3: $this->mes = "Mar�o"; break;
	case 4: $this->mes = "Abril"; break;
	case 5: $this->mes = "Maio"; break;
	case 6: $this->mes = "Junho"; break;
	case 7: $this->mes = "Julho"; break;
	case 8: $this->mes = "Agosto"; break;
	case 9: $this->mes = "Setembro"; break;
	case 10: $this->mes = "Outubro"; break;
	case 11: $this->mes = "Novembro"; break;
	case 12: $this->mes = "Dezembro"; break;
}


$this->nome_parte1  = $nome_parte1_local;
$this->nome_parte2  = $nome_parte2_local;
$this->de  = $hora_de.":".$min_de;
$this->as  = $hora_as.":".$min_as;
$this->dia  = $this->dia;
$this->mes  = $this->mes;
$this->ano  = $this->ano;

if (isset($this->sc_temp_global_nome_aluno)) {$_SESSION['global_nome_aluno'] = $this->sc_temp_global_nome_aluno;}
if (isset($this->sc_temp_global_horario_de)) {$_SESSION['global_horario_de'] = $this->sc_temp_global_horario_de;}
if (isset($this->sc_temp_global_horario_as)) {$_SESSION['global_horario_as'] = $this->sc_temp_global_horario_as;}
if (isset($this->sc_temp_global_data)) {$_SESSION['global_data'] = $this->sc_temp_global_data;}
$_SESSION['scriptcase']['pdfreport_declaracao_aluno']['contr_erro'] = 'off'; 
         foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_declaracao_aluno']['field_order'] as $Cada_col)
         { 
            if (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off")
            { 
                $NM_func_exp = "NM_export_" . $Cada_col;
                $this->$NM_func_exp();
            } 
         } 
         $this->Texto_tag .= "</tr>\r\n";
         $rs->MoveNext();
      }
      $this->Texto_tag .= "</table>\r\n";

      $rs->Close();
   }
   //----- id_usuario
   function NM_export_id_usuario()
   {
         nmgp_Form_Num_Val($this->id_usuario, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
         if (!NM_is_utf8($this->id_usuario))
         {
             $this->id_usuario = sc_convert_encoding($this->id_usuario, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->id_usuario = str_replace('<', '&lt;', $this->id_usuario);
         $this->id_usuario = str_replace('>', '&gt;', $this->id_usuario);
         $this->Texto_tag .= "<td>" . $this->id_usuario . "</td>\r\n";
   }
   //----- de
   function NM_export_de()
   {
         $this->de = html_entity_decode($this->de, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         if (!NM_is_utf8($this->de))
         {
             $this->de = sc_convert_encoding($this->de, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->de = str_replace('<', '&lt;', $this->de);
         $this->de = str_replace('>', '&gt;', $this->de);
         $this->Texto_tag .= "<td>" . $this->de . "</td>\r\n";
   }
   //----- as
   function NM_export_as()
   {
         $this->as = html_entity_decode($this->as, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         if (!NM_is_utf8($this->as))
         {
             $this->as = sc_convert_encoding($this->as, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->as = str_replace('<', '&lt;', $this->as);
         $this->as = str_replace('>', '&gt;', $this->as);
         $this->Texto_tag .= "<td>" . $this->as . "</td>\r\n";
   }
   //----- nome_parte1
   function NM_export_nome_parte1()
   {
         $this->nome_parte1 = html_entity_decode($this->nome_parte1, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         if (!NM_is_utf8($this->nome_parte1))
         {
             $this->nome_parte1 = sc_convert_encoding($this->nome_parte1, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->nome_parte1 = str_replace('<', '&lt;', $this->nome_parte1);
         $this->nome_parte1 = str_replace('>', '&gt;', $this->nome_parte1);
         $this->Texto_tag .= "<td>" . $this->nome_parte1 . "</td>\r\n";
   }
   //----- nome_parte2
   function NM_export_nome_parte2()
   {
         $this->nome_parte2 = html_entity_decode($this->nome_parte2, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         if (!NM_is_utf8($this->nome_parte2))
         {
             $this->nome_parte2 = sc_convert_encoding($this->nome_parte2, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->nome_parte2 = str_replace('<', '&lt;', $this->nome_parte2);
         $this->nome_parte2 = str_replace('>', '&gt;', $this->nome_parte2);
         $this->Texto_tag .= "<td>" . $this->nome_parte2 . "</td>\r\n";
   }
   //----- dia
   function NM_export_dia()
   {
         $this->dia = html_entity_decode($this->dia, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->dia = strip_tags($this->dia);
         if (!NM_is_utf8($this->dia))
         {
             $this->dia = sc_convert_encoding($this->dia, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->dia = str_replace('<', '&lt;', $this->dia);
         $this->dia = str_replace('>', '&gt;', $this->dia);
         $this->Texto_tag .= "<td>" . $this->dia . "</td>\r\n";
   }
   //----- mes
   function NM_export_mes()
   {
         $this->mes = html_entity_decode($this->mes, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->mes = strip_tags($this->mes);
         if (!NM_is_utf8($this->mes))
         {
             $this->mes = sc_convert_encoding($this->mes, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->mes = str_replace('<', '&lt;', $this->mes);
         $this->mes = str_replace('>', '&gt;', $this->mes);
         $this->Texto_tag .= "<td>" . $this->mes . "</td>\r\n";
   }
   //----- ano
   function NM_export_ano()
   {
         $this->ano = html_entity_decode($this->ano, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->ano = strip_tags($this->ano);
         if (!NM_is_utf8($this->ano))
         {
             $this->ano = sc_convert_encoding($this->ano, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->ano = str_replace('<', '&lt;', $this->ano);
         $this->ano = str_replace('>', '&gt;', $this->ano);
         $this->Texto_tag .= "<td>" . $this->ano . "</td>\r\n";
   }

   //----- 
   function grava_arquivo_rtf()
   {
      global $nm_lang, $doc_wrap;
      $rtf_f = fopen($this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo, "w");
      require_once($this->Ini->path_third      . "/rtf_new/document_generator/cl_xml2driver.php"); 
      $text_ok  =  "<?xml version=\"1.0\" encoding=\"UTF-8\" ?>\r\n"; 
      $text_ok .=  "<DOC config_file=\"" . $this->Ini->path_third . "/rtf_new/doc_config.inc\" >\r\n"; 
      $text_ok .=  $this->Texto_tag; 
      $text_ok .=  "</DOC>\r\n"; 
      $xml = new nDOCGEN($text_ok,"RTF"); 
      fwrite($rtf_f, $xml->get_result_file());
      fclose($rtf_f);
   }

   function nm_conv_data_db($dt_in, $form_in, $form_out)
   {
       $dt_out = $dt_in;
       if (strtoupper($form_in) == "DB_FORMAT")
       {
           if ($dt_out == "null" || $dt_out == "")
           {
               $dt_out = "";
               return $dt_out;
           }
           $form_in = "AAAA-MM-DD";
       }
       if (strtoupper($form_out) == "DB_FORMAT")
       {
           if (empty($dt_out))
           {
               $dt_out = "null";
               return $dt_out;
           }
           $form_out = "AAAA-MM-DD";
       }
       nm_conv_form_data($dt_out, $form_in, $form_out);
       return $dt_out;
   }
   //---- 
   function monta_html()
   {
      global $nm_url_saida, $nm_lang;
      include($this->Ini->path_btn . $this->Ini->Str_btn_grid);
      unset($_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_declaracao_aluno']['rtf_file']);
      if (is_file($this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_declaracao_aluno']['rtf_file'] = $this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo;
      }
      $path_doc_md5 = md5($this->Ini->path_imag_temp . "/" . $this->Arquivo);
      $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_declaracao_aluno'][$path_doc_md5][0] = $this->Ini->path_imag_temp . "/" . $this->Arquivo;
      $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_declaracao_aluno'][$path_doc_md5][1] = $this->Tit_doc;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
            "http://www.w3.org/TR/1999/REC-html401-19991224/loose.dtd">
<HTML<?php echo $_SESSION['scriptcase']['reg_conf']['html_dir'] ?>>
<HEAD>
 <TITLE><?php echo $this->Ini->Nm_lang['lang_othr_chart_titl'] ?> -  :: RTF</TITLE>
 <META http-equiv="Content-Type" content="text/html; charset=<?php echo $_SESSION['scriptcase']['charset_html'] ?>" />
<?php
if ($_SESSION['scriptcase']['proc_mobile'])
{
?>
  <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;" />
<?php
}
?>
  <META http-equiv="Expires" content="Fri, Jan 01 1900 00:00:00 GMT"/>
  <META http-equiv="Last-Modified" content="<?php echo gmdate("D, d M Y H:i:s"); ?> GMT"/>
  <META http-equiv="Cache-Control" content="no-store, no-cache, must-revalidate"/>
  <META http-equiv="Cache-Control" content="post-check=0, pre-check=0"/>
  <META http-equiv="Pragma" content="no-cache"/>
  <link rel="stylesheet" type="text/css" href="../_lib/css/<?php echo $this->Ini->str_schema_all ?>_export.css" /> 
  <link rel="stylesheet" type="text/css" href="../_lib/css/<?php echo $this->Ini->str_schema_all ?>_export<?php echo $_SESSION['scriptcase']['reg_conf']['css_dir'] ?>.css" /> 
  <link rel="stylesheet" type="text/css" href="../_lib/buttons/<?php echo $this->Ini->Str_btn_css ?>" /> 
</HEAD>
<BODY class="scExportPage">
<?php echo $this->Ini->Ajax_result_set ?>
<table style="border-collapse: collapse; border-width: 0; height: 100%; width: 100%"><tr><td style="padding: 0; text-align: center; vertical-align: middle">
 <table class="scExportTable" align="center">
  <tr>
   <td class="scExportTitle" style="height: 25px">RTF</td>
  </tr>
  <tr>
   <td class="scExportLine" style="width: 100%">
    <table style="border-collapse: collapse; border-width: 0; width: 100%"><tr><td class="scExportLineFont" style="padding: 3px 0 0 0" id="idMessage">
    <?php echo $this->Ini->Nm_lang['lang_othr_file_msge'] ?>
    </td><td class="scExportLineFont" style="text-align:right; padding: 3px 0 0 0">
     <?php echo nmButtonOutput($this->arr_buttons, "bexportview", "document.Fview.submit()", "document.Fview.submit()", "idBtnView", "", "", "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "");
 ?>
     <?php echo nmButtonOutput($this->arr_buttons, "bdownload", "document.Fdown.submit()", "document.Fdown.submit()", "idBtnDown", "", "", "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "");
 ?>
     <?php echo nmButtonOutput($this->arr_buttons, "bvoltar", "document.F0.submit()", "document.F0.submit()", "idBtnBack", "", "", "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "");
 ?>
    </td></tr></table>
   </td>
  </tr>
 </table>
</td></tr></table>
<form name="Fview" method="get" action="<?php echo $this->Ini->path_imag_temp . "/" . $this->Arquivo ?>" target="_blank" style="display: none"> 
</form>
<form name="Fdown" method="get" action="pdfreport_declaracao_aluno_download.php" target="_blank" style="display: none"> 
<input type="hidden" name="script_case_init" value="<?php echo NM_encode_input($this->Ini->sc_page); ?>"> 
<input type="hidden" name="nm_tit_doc" value="pdfreport_declaracao_aluno"> 
<input type="hidden" name="nm_name_doc" value="<?php echo $path_doc_md5 ?>"> 
</form>
<FORM name="F0" method=post action="./"> 
<INPUT type="hidden" name="script_case_init" value="<?php echo NM_encode_input($this->Ini->sc_page); ?>"> 
<INPUT type="hidden" name="script_case_session" value="<?php echo NM_encode_input(session_id()); ?>"> 
<INPUT type="hidden" name="nmgp_opcao" value="volta_grid"> 
</FORM> 
</BODY>
</HTML>
<?php
   }
   function nm_gera_mask(&$nm_campo, $nm_mask)
   { 
      $trab_campo = $nm_campo;
      $trab_mask  = $nm_mask;
      $tam_campo  = strlen($nm_campo);
      $trab_saida = "";
      $mask_num = false;
      for ($x=0; $x < strlen($trab_mask); $x++)
      {
          if (substr($trab_mask, $x, 1) == "#")
          {
              $mask_num = true;
              break;
          }
      }
      if ($mask_num )
      {
          $ver_duas = explode(";", $trab_mask);
          if (isset($ver_duas[1]) && !empty($ver_duas[1]))
          {
              $cont1 = count(explode("#", $ver_duas[0])) - 1;
              $cont2 = count(explode("#", $ver_duas[1])) - 1;
              if ($cont2 >= $tam_campo)
              {
                  $trab_mask = $ver_duas[1];
              }
              else
              {
                  $trab_mask = $ver_duas[0];
              }
          }
          $tam_mask = strlen($trab_mask);
          $xdados = 0;
          for ($x=0; $x < $tam_mask; $x++)
          {
              if (substr($trab_mask, $x, 1) == "#" && $xdados < $tam_campo)
              {
                  $trab_saida .= substr($trab_campo, $xdados, 1);
                  $xdados++;
              }
              elseif ($xdados < $tam_campo)
              {
                  $trab_saida .= substr($trab_mask, $x, 1);
              }
          }
          if ($xdados < $tam_campo)
          {
              $trab_saida .= substr($trab_campo, $xdados);
          }
          $nm_campo = $trab_saida;
          return;
      }
      for ($ix = strlen($trab_mask); $ix > 0; $ix--)
      {
           $char_mask = substr($trab_mask, $ix - 1, 1);
           if ($char_mask != "x" && $char_mask != "z")
           {
               $trab_saida = $char_mask . $trab_saida;
           }
           else
           {
               if ($tam_campo != 0)
               {
                   $trab_saida = substr($trab_campo, $tam_campo - 1, 1) . $trab_saida;
                   $tam_campo--;
               }
               else
               {
                   $trab_saida = "0" . $trab_saida;
               }
           }
      }
      if ($tam_campo != 0)
      {
          $trab_saida = substr($trab_campo, 0, $tam_campo) . $trab_saida;
          $trab_mask  = str_repeat("z", $tam_campo) . $trab_mask;
      }
   
      $iz = 0; 
      for ($ix = 0; $ix < strlen($trab_mask); $ix++)
      {
           $char_mask = substr($trab_mask, $ix, 1);
           if ($char_mask != "x" && $char_mask != "z")
           {
               if ($char_mask == "." || $char_mask == ",")
               {
                   $trab_saida = substr($trab_saida, 0, $iz) . substr($trab_saida, $iz + 1);
               }
               else
               {
                   $iz++;
               }
           }
           elseif ($char_mask == "x" || substr($trab_saida, $iz, 1) != "0")
           {
               $ix = strlen($trab_mask) + 1;
           }
           else
           {
               $trab_saida = substr($trab_saida, 0, $iz) . substr($trab_saida, $iz + 1);
           }
      }
      $nm_campo = $trab_saida;
   } 
}

?>
