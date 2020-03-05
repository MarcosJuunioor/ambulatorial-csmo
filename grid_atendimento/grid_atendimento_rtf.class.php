<?php

class grid_atendimento_rtf
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
   function grid_atendimento_rtf()
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
      $this->Arquivo   .= "_grid_atendimento";
      $this->Arquivo   .= ".rtf";
      $this->Tit_doc    = "grid_atendimento.rtf";
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
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['grid_atendimento']['field_display']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['grid_atendimento']['field_display']))
      {
          foreach ($_SESSION['scriptcase']['sc_apl_conf']['grid_atendimento']['field_display'] as $NM_cada_field => $NM_cada_opc)
          {
              $this->NM_cmp_hidden[$NM_cada_field] = $NM_cada_opc;
          }
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_atendimento']['usr_cmp_sel']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_atendimento']['usr_cmp_sel']))
      {
          foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_atendimento']['usr_cmp_sel'] as $NM_cada_field => $NM_cada_opc)
          {
              $this->NM_cmp_hidden[$NM_cada_field] = $NM_cada_opc;
          }
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_atendimento']['php_cmp_sel']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_atendimento']['php_cmp_sel']))
      {
          foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_atendimento']['php_cmp_sel'] as $NM_cada_field => $NM_cada_opc)
          {
              $this->NM_cmp_hidden[$NM_cada_field] = $NM_cada_opc;
          }
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_atendimento']['campos_busca']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_atendimento']['campos_busca']))
      { 
          $Busca_temp = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_atendimento']['campos_busca'];
          if ($_SESSION['scriptcase']['charset'] != "UTF-8")
          {
              $Busca_temp = NM_conv_charset($Busca_temp, $_SESSION['scriptcase']['charset'], "UTF-8");
          }
          $this->id_atendimento = $Busca_temp['id_atendimento']; 
          $tmp_pos = strpos($this->id_atendimento, "##@@");
          if ($tmp_pos !== false)
          {
              $this->id_atendimento = substr($this->id_atendimento, 0, $tmp_pos);
          }
          $this->id_atendimento_2 = $Busca_temp['id_atendimento_input_2']; 
          $this->id_servidor_saude = $Busca_temp['id_servidor_saude']; 
          $tmp_pos = strpos($this->id_servidor_saude, "##@@");
          if ($tmp_pos !== false)
          {
              $this->id_servidor_saude = substr($this->id_servidor_saude, 0, $tmp_pos);
          }
          $this->id_servidor_saude_2 = $Busca_temp['id_servidor_saude_input_2']; 
          $this->tipo_servico = $Busca_temp['tipo_servico']; 
          $tmp_pos = strpos($this->tipo_servico, "##@@");
          if ($tmp_pos !== false)
          {
              $this->tipo_servico = substr($this->tipo_servico, 0, $tmp_pos);
          }
          $this->procedimento = $Busca_temp['procedimento']; 
          $tmp_pos = strpos($this->procedimento, "##@@");
          if ($tmp_pos !== false)
          {
              $this->procedimento = substr($this->procedimento, 0, $tmp_pos);
          }
      } 
      $this->nm_field_dinamico = array();
      $this->nm_order_dinamico = array();
      $this->sc_where_orig   = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_atendimento']['where_orig'];
      $this->sc_where_atual  = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_atendimento']['where_pesq'];
      $this->sc_where_filtro = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_atendimento']['where_pesq_filtro'];
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_atendimento']['rtf_name']))
      {
          $this->Arquivo = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_atendimento']['rtf_name'];
          $this->Tit_doc = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_atendimento']['rtf_name'];
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_atendimento']['rtf_name']);
      }
      if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sybase))
      { 
          $nmgp_select = "SELECT procedimento, id_atendimento, id_servidor_saude, tipo_servico, tipo_paciente, str_replace (convert(char(10),data_hora,102), '.', '-') + ' ' + convert(char(8),data_hora,20) from " . $this->Ini->nm_tabela; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
      { 
          $nmgp_select = "SELECT procedimento, id_atendimento, id_servidor_saude, tipo_servico, tipo_paciente, data_hora from " . $this->Ini->nm_tabela; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
      { 
       $nmgp_select = "SELECT procedimento, id_atendimento, id_servidor_saude, tipo_servico, tipo_paciente, convert(char(23),data_hora,121) from " . $this->Ini->nm_tabela; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
      { 
          $nmgp_select = "SELECT procedimento, id_atendimento, id_servidor_saude, tipo_servico, tipo_paciente, data_hora from " . $this->Ini->nm_tabela; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
      { 
          $nmgp_select = "SELECT procedimento, id_atendimento, id_servidor_saude, tipo_servico, tipo_paciente, EXTEND(data_hora, YEAR TO FRACTION) from " . $this->Ini->nm_tabela; 
      } 
      else 
      { 
          $nmgp_select = "SELECT procedimento, id_atendimento, id_servidor_saude, tipo_servico, tipo_paciente, data_hora from " . $this->Ini->nm_tabela; 
      } 
      $nmgp_select .= " " . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_atendimento']['where_pesq'];
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_atendimento']['where_resumo']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_atendimento']['where_resumo'])) 
      { 
          if (empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_atendimento']['where_pesq'])) 
          { 
              $nmgp_select .= " where " . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_atendimento']['where_resumo']; 
          } 
          else
          { 
              $nmgp_select .= " and (" . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_atendimento']['where_resumo'] . ")"; 
          } 
      } 
      $nmgp_select .= " group by tipo_servico, procedimento"; 
      $nmgp_order_by = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_atendimento']['order_grid'];
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
      foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_atendimento']['field_order'] as $Cada_col)
      { 
          $SC_Label = (isset($this->New_label['procedimento'])) ? $this->New_label['procedimento'] : "Procedimento"; 
          if ($Cada_col == "procedimento" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['aluno'])) ? $this->New_label['aluno'] : "Aluno"; 
          if ($Cada_col == "aluno" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['servidor'])) ? $this->New_label['servidor'] : "Servidor"; 
          if ($Cada_col == "servidor" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['servidor_terceirizado'])) ? $this->New_label['servidor_terceirizado'] : "Servidor Terceirizado"; 
          if ($Cada_col == "servidor_terceirizado" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['visitante'])) ? $this->New_label['visitante'] : "Visitante"; 
          if ($Cada_col == "visitante" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['total'])) ? $this->New_label['total'] : "Total"; 
          if ($Cada_col == "total" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['id_atendimento'])) ? $this->New_label['id_atendimento'] : "Id Atendimento"; 
          if ($Cada_col == "id_atendimento" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['id_servidor_saude'])) ? $this->New_label['id_servidor_saude'] : "Id Servidor Saude"; 
          if ($Cada_col == "id_servidor_saude" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['tipo_servico'])) ? $this->New_label['tipo_servico'] : ""; 
          if ($Cada_col == "tipo_servico" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['tipo_paciente'])) ? $this->New_label['tipo_paciente'] : "Tipo Paciente"; 
          if ($Cada_col == "tipo_paciente" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = sc_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['data_hora'])) ? $this->New_label['data_hora'] : "Data Hora"; 
          if ($Cada_col == "data_hora" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
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
         $this->procedimento = $rs->fields[0] ;  
         $this->id_atendimento = $rs->fields[1] ;  
         $this->id_atendimento = (string)$this->id_atendimento;
         $this->id_servidor_saude = $rs->fields[2] ;  
         $this->id_servidor_saude = (string)$this->id_servidor_saude;
         $this->tipo_servico = $rs->fields[3] ;  
         $this->tipo_paciente = $rs->fields[4] ;  
         $this->data_hora = $rs->fields[5] ;  
         $this->sc_proc_grid = true; 
         $_SESSION['scriptcase']['grid_atendimento']['contr_erro'] = 'on';
  
      $nm_select = "select count(id_atendimento) from atendimento where procedimento = '$this->procedimento' and tipo_paciente = 'aluno' and tipo_servico = '$this->tipo_servico'"; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->DS_total_aluno = array();
      $this->ds_total_aluno = array();
      if ($rx = $this->Db->Execute($nm_select)) 
      { 
          $y = 0; 
          $nm_count = $rx->FieldCount();
          while (!$rx->EOF)
          { 
                 for ($x = 0; $x < $nm_count; $x++)
                 { 
                        $this->DS_total_aluno[$y] [$x] = $rx->fields[$x];
                        $this->ds_total_aluno[$y] [$x] = $rx->fields[$x];
                 }
                 $y++; 
                 $rx->MoveNext();
          } 
          $rx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->DS_total_aluno = false;
          $this->DS_total_aluno_erro = $this->Db->ErrorMsg();
          $this->ds_total_aluno = false;
          $this->ds_total_aluno_erro = $this->Db->ErrorMsg();
      } 
;
if ($this->Ini->sc_tem_trans_banco)
{
    $this->Db->CommitTrans();
    $this->Ini->sc_tem_trans_banco = false;
}


 
      $nm_select = "select count(id_atendimento) from atendimento where procedimento = '$this->procedimento' and tipo_paciente = 'servidor' and tipo_servico = '$this->tipo_servico'"; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->DS_total_servidor = array();
      $this->ds_total_servidor = array();
      if ($rx = $this->Db->Execute($nm_select)) 
      { 
          $y = 0; 
          $nm_count = $rx->FieldCount();
          while (!$rx->EOF)
          { 
                 for ($x = 0; $x < $nm_count; $x++)
                 { 
                        $this->DS_total_servidor[$y] [$x] = $rx->fields[$x];
                        $this->ds_total_servidor[$y] [$x] = $rx->fields[$x];
                 }
                 $y++; 
                 $rx->MoveNext();
          } 
          $rx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->DS_total_servidor = false;
          $this->DS_total_servidor_erro = $this->Db->ErrorMsg();
          $this->ds_total_servidor = false;
          $this->ds_total_servidor_erro = $this->Db->ErrorMsg();
      } 
;
if ($this->Ini->sc_tem_trans_banco)
{
    $this->Db->CommitTrans();
    $this->Ini->sc_tem_trans_banco = false;
}


 
      $nm_select = "select count(id_atendimento) from atendimento where procedimento = '$this->procedimento' and tipo_paciente = 'servidor terceirizado' and tipo_servico = '$this->tipo_servico'"; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->DS_total_servidor_terceirizado = array();
      $this->ds_total_servidor_terceirizado = array();
      if ($rx = $this->Db->Execute($nm_select)) 
      { 
          $y = 0; 
          $nm_count = $rx->FieldCount();
          while (!$rx->EOF)
          { 
                 for ($x = 0; $x < $nm_count; $x++)
                 { 
                        $this->DS_total_servidor_terceirizado[$y] [$x] = $rx->fields[$x];
                        $this->ds_total_servidor_terceirizado[$y] [$x] = $rx->fields[$x];
                 }
                 $y++; 
                 $rx->MoveNext();
          } 
          $rx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->DS_total_servidor_terceirizado = false;
          $this->DS_total_servidor_terceirizado_erro = $this->Db->ErrorMsg();
          $this->ds_total_servidor_terceirizado = false;
          $this->ds_total_servidor_terceirizado_erro = $this->Db->ErrorMsg();
      } 
;
if ($this->Ini->sc_tem_trans_banco)
{
    $this->Db->CommitTrans();
    $this->Ini->sc_tem_trans_banco = false;
}


 
      $nm_select = "select count(id_atendimento) from atendimento where procedimento = '$this->procedimento' and tipo_paciente = 'visitante' and tipo_servico = '$this->tipo_servico'"; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->DS_total_visitante = array();
      $this->ds_total_visitante = array();
      if ($rx = $this->Db->Execute($nm_select)) 
      { 
          $y = 0; 
          $nm_count = $rx->FieldCount();
          while (!$rx->EOF)
          { 
                 for ($x = 0; $x < $nm_count; $x++)
                 { 
                        $this->DS_total_visitante[$y] [$x] = $rx->fields[$x];
                        $this->ds_total_visitante[$y] [$x] = $rx->fields[$x];
                 }
                 $y++; 
                 $rx->MoveNext();
          } 
          $rx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->DS_total_visitante = false;
          $this->DS_total_visitante_erro = $this->Db->ErrorMsg();
          $this->ds_total_visitante = false;
          $this->ds_total_visitante_erro = $this->Db->ErrorMsg();
      } 
;
if ($this->Ini->sc_tem_trans_banco)
{
    $this->Db->CommitTrans();
    $this->Ini->sc_tem_trans_banco = false;
}



$this->aluno  = $this->ds_total_aluno[0][0];
$this->servidor  = $this->ds_total_servidor[0][0];
$this->servidor_terceirizado  = $this->ds_total_servidor_terceirizado[0][0];
$this->visitante  = $this->ds_total_visitante[0][0];


$this->total  = $this->ds_total_aluno[0][0] + $this->ds_total_servidor[0][0] + $this->ds_total_servidor_terceirizado[0][0] + $this->ds_total_visitante[0][0]; 




if($this->sc_where_filtro ){
 
      $nm_select = "select count(id_atendimento) from atendimento where procedimento = '$this->procedimento' and tipo_paciente = 'aluno' and tipo_servico = '$this->tipo_servico' and $this->sc_where_filtro "; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->DS_total_aluno = array();
      $this->ds_total_aluno = array();
      if ($rx = $this->Db->Execute($nm_select)) 
      { 
          $y = 0; 
          $nm_count = $rx->FieldCount();
          while (!$rx->EOF)
          { 
                 for ($x = 0; $x < $nm_count; $x++)
                 { 
                        $this->DS_total_aluno[$y] [$x] = $rx->fields[$x];
                        $this->ds_total_aluno[$y] [$x] = $rx->fields[$x];
                 }
                 $y++; 
                 $rx->MoveNext();
          } 
          $rx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->DS_total_aluno = false;
          $this->DS_total_aluno_erro = $this->Db->ErrorMsg();
          $this->ds_total_aluno = false;
          $this->ds_total_aluno_erro = $this->Db->ErrorMsg();
      } 
;
if ($this->Ini->sc_tem_trans_banco)
{
    $this->Db->CommitTrans();
    $this->Ini->sc_tem_trans_banco = false;
}


 
      $nm_select = "select count(id_atendimento) from atendimento where procedimento = '$this->procedimento' and tipo_paciente = 'servidor' and tipo_servico = '$this->tipo_servico' and $this->sc_where_filtro "; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->DS_total_servidor = array();
      $this->ds_total_servidor = array();
      if ($rx = $this->Db->Execute($nm_select)) 
      { 
          $y = 0; 
          $nm_count = $rx->FieldCount();
          while (!$rx->EOF)
          { 
                 for ($x = 0; $x < $nm_count; $x++)
                 { 
                        $this->DS_total_servidor[$y] [$x] = $rx->fields[$x];
                        $this->ds_total_servidor[$y] [$x] = $rx->fields[$x];
                 }
                 $y++; 
                 $rx->MoveNext();
          } 
          $rx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->DS_total_servidor = false;
          $this->DS_total_servidor_erro = $this->Db->ErrorMsg();
          $this->ds_total_servidor = false;
          $this->ds_total_servidor_erro = $this->Db->ErrorMsg();
      } 
;
if ($this->Ini->sc_tem_trans_banco)
{
    $this->Db->CommitTrans();
    $this->Ini->sc_tem_trans_banco = false;
}


 
      $nm_select = "select count(id_atendimento) from atendimento where procedimento = '$this->procedimento' and tipo_paciente = 'servidor terceirizado' and tipo_servico = '$this->tipo_servico' and $this->sc_where_filtro "; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->DS_total_servidor_terceirizado = array();
      $this->ds_total_servidor_terceirizado = array();
      if ($rx = $this->Db->Execute($nm_select)) 
      { 
          $y = 0; 
          $nm_count = $rx->FieldCount();
          while (!$rx->EOF)
          { 
                 for ($x = 0; $x < $nm_count; $x++)
                 { 
                        $this->DS_total_servidor_terceirizado[$y] [$x] = $rx->fields[$x];
                        $this->ds_total_servidor_terceirizado[$y] [$x] = $rx->fields[$x];
                 }
                 $y++; 
                 $rx->MoveNext();
          } 
          $rx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->DS_total_servidor_terceirizado = false;
          $this->DS_total_servidor_terceirizado_erro = $this->Db->ErrorMsg();
          $this->ds_total_servidor_terceirizado = false;
          $this->ds_total_servidor_terceirizado_erro = $this->Db->ErrorMsg();
      } 
;
if ($this->Ini->sc_tem_trans_banco)
{
    $this->Db->CommitTrans();
    $this->Ini->sc_tem_trans_banco = false;
}


 
      $nm_select = "select count(id_atendimento) from atendimento where procedimento = '$this->procedimento' and tipo_paciente = 'visitante' and tipo_servico = '$this->tipo_servico' and $this->sc_where_filtro "; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->DS_total_visitante = array();
      $this->ds_total_visitante = array();
      if ($rx = $this->Db->Execute($nm_select)) 
      { 
          $y = 0; 
          $nm_count = $rx->FieldCount();
          while (!$rx->EOF)
          { 
                 for ($x = 0; $x < $nm_count; $x++)
                 { 
                        $this->DS_total_visitante[$y] [$x] = $rx->fields[$x];
                        $this->ds_total_visitante[$y] [$x] = $rx->fields[$x];
                 }
                 $y++; 
                 $rx->MoveNext();
          } 
          $rx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->DS_total_visitante = false;
          $this->DS_total_visitante_erro = $this->Db->ErrorMsg();
          $this->ds_total_visitante = false;
          $this->ds_total_visitante_erro = $this->Db->ErrorMsg();
      } 
;
if ($this->Ini->sc_tem_trans_banco)
{
    $this->Db->CommitTrans();
    $this->Ini->sc_tem_trans_banco = false;
}



$this->aluno  = $this->ds_total_aluno[0][0];
$this->servidor  = $this->ds_total_servidor[0][0];
$this->servidor_terceirizado  = $this->ds_total_servidor_terceirizado[0][0];
$this->visitante  = $this->ds_total_visitante[0][0];


$this->total  = $this->ds_total_aluno[0][0] + $this->ds_total_servidor[0][0] + $this->ds_total_servidor_terceirizado[0][0] + $this->ds_total_visitante[0][0];

}
$_SESSION['scriptcase']['grid_atendimento']['contr_erro'] = 'off'; 
         foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_atendimento']['field_order'] as $Cada_col)
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
   //----- procedimento
   function NM_export_procedimento()
   {
         $this->procedimento = html_entity_decode($this->procedimento, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->procedimento = strip_tags($this->procedimento);
         if (!NM_is_utf8($this->procedimento))
         {
             $this->procedimento = sc_convert_encoding($this->procedimento, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->procedimento = str_replace('<', '&lt;', $this->procedimento);
         $this->procedimento = str_replace('>', '&gt;', $this->procedimento);
         $this->Texto_tag .= "<td>" . $this->procedimento . "</td>\r\n";
   }
   //----- aluno
   function NM_export_aluno()
   {
         nmgp_Form_Num_Val($this->aluno, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "", "1", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
         if (!NM_is_utf8($this->aluno))
         {
             $this->aluno = sc_convert_encoding($this->aluno, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->aluno = str_replace('<', '&lt;', $this->aluno);
         $this->aluno = str_replace('>', '&gt;', $this->aluno);
         $this->Texto_tag .= "<td>" . $this->aluno . "</td>\r\n";
   }
   //----- servidor
   function NM_export_servidor()
   {
         nmgp_Form_Num_Val($this->servidor, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "", "1", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
         if (!NM_is_utf8($this->servidor))
         {
             $this->servidor = sc_convert_encoding($this->servidor, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->servidor = str_replace('<', '&lt;', $this->servidor);
         $this->servidor = str_replace('>', '&gt;', $this->servidor);
         $this->Texto_tag .= "<td>" . $this->servidor . "</td>\r\n";
   }
   //----- servidor_terceirizado
   function NM_export_servidor_terceirizado()
   {
         nmgp_Form_Num_Val($this->servidor_terceirizado, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "", "", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
         if (!NM_is_utf8($this->servidor_terceirizado))
         {
             $this->servidor_terceirizado = sc_convert_encoding($this->servidor_terceirizado, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->servidor_terceirizado = str_replace('<', '&lt;', $this->servidor_terceirizado);
         $this->servidor_terceirizado = str_replace('>', '&gt;', $this->servidor_terceirizado);
         $this->Texto_tag .= "<td>" . $this->servidor_terceirizado . "</td>\r\n";
   }
   //----- visitante
   function NM_export_visitante()
   {
         nmgp_Form_Num_Val($this->visitante, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "", "", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
         if (!NM_is_utf8($this->visitante))
         {
             $this->visitante = sc_convert_encoding($this->visitante, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->visitante = str_replace('<', '&lt;', $this->visitante);
         $this->visitante = str_replace('>', '&gt;', $this->visitante);
         $this->Texto_tag .= "<td>" . $this->visitante . "</td>\r\n";
   }
   //----- total
   function NM_export_total()
   {
         nmgp_Form_Num_Val($this->total, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "", "1", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
         if (!NM_is_utf8($this->total))
         {
             $this->total = sc_convert_encoding($this->total, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->total = str_replace('<', '&lt;', $this->total);
         $this->total = str_replace('>', '&gt;', $this->total);
         $this->Texto_tag .= "<td>" . $this->total . "</td>\r\n";
   }
   //----- id_atendimento
   function NM_export_id_atendimento()
   {
         nmgp_Form_Num_Val($this->id_atendimento, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
         if (!NM_is_utf8($this->id_atendimento))
         {
             $this->id_atendimento = sc_convert_encoding($this->id_atendimento, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->id_atendimento = str_replace('<', '&lt;', $this->id_atendimento);
         $this->id_atendimento = str_replace('>', '&gt;', $this->id_atendimento);
         $this->Texto_tag .= "<td>" . $this->id_atendimento . "</td>\r\n";
   }
   //----- id_servidor_saude
   function NM_export_id_servidor_saude()
   {
         nmgp_Form_Num_Val($this->id_servidor_saude, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
         if (!NM_is_utf8($this->id_servidor_saude))
         {
             $this->id_servidor_saude = sc_convert_encoding($this->id_servidor_saude, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->id_servidor_saude = str_replace('<', '&lt;', $this->id_servidor_saude);
         $this->id_servidor_saude = str_replace('>', '&gt;', $this->id_servidor_saude);
         $this->Texto_tag .= "<td>" . $this->id_servidor_saude . "</td>\r\n";
   }
   //----- tipo_servico
   function NM_export_tipo_servico()
   {
         $this->tipo_servico = html_entity_decode($this->tipo_servico, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->tipo_servico = strip_tags($this->tipo_servico);
         if (!NM_is_utf8($this->tipo_servico))
         {
             $this->tipo_servico = sc_convert_encoding($this->tipo_servico, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->tipo_servico = str_replace('<', '&lt;', $this->tipo_servico);
         $this->tipo_servico = str_replace('>', '&gt;', $this->tipo_servico);
         $this->Texto_tag .= "<td>" . $this->tipo_servico . "</td>\r\n";
   }
   //----- tipo_paciente
   function NM_export_tipo_paciente()
   {
         $this->tipo_paciente = html_entity_decode($this->tipo_paciente, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->tipo_paciente = strip_tags($this->tipo_paciente);
         if (!NM_is_utf8($this->tipo_paciente))
         {
             $this->tipo_paciente = sc_convert_encoding($this->tipo_paciente, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->tipo_paciente = str_replace('<', '&lt;', $this->tipo_paciente);
         $this->tipo_paciente = str_replace('>', '&gt;', $this->tipo_paciente);
         $this->Texto_tag .= "<td>" . $this->tipo_paciente . "</td>\r\n";
   }
   //----- data_hora
   function NM_export_data_hora()
   {
         if (substr($this->data_hora, 10, 1) == "-") 
         { 
             $this->data_hora = substr($this->data_hora, 0, 10) . " " . substr($this->data_hora, 11);
         } 
         if (substr($this->data_hora, 13, 1) == ".") 
         { 
            $this->data_hora = substr($this->data_hora, 0, 13) . ":" . substr($this->data_hora, 14, 2) . ":" . substr($this->data_hora, 17);
         } 
         $conteudo_x = $this->data_hora;
         nm_conv_limpa_dado($conteudo_x, "YYYY-MM-DD HH:II:SS");
         if (is_numeric($conteudo_x) && $conteudo_x > 0) 
         { 
             $this->nm_data->SetaData($this->data_hora, "YYYY-MM-DD HH:II:SS");
             $this->data_hora = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DH", "ddmmaaaa;hhiiss"));
         } 
         if (!NM_is_utf8($this->data_hora))
         {
             $this->data_hora = sc_convert_encoding($this->data_hora, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         $this->data_hora = str_replace('<', '&lt;', $this->data_hora);
         $this->data_hora = str_replace('>', '&gt;', $this->data_hora);
         $this->Texto_tag .= "<td>" . $this->data_hora . "</td>\r\n";
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
      unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_atendimento']['rtf_file']);
      if (is_file($this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_atendimento']['rtf_file'] = $this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo;
      }
      $path_doc_md5 = md5($this->Ini->path_imag_temp . "/" . $this->Arquivo);
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_atendimento'][$path_doc_md5][0] = $this->Ini->path_imag_temp . "/" . $this->Arquivo;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_atendimento'][$path_doc_md5][1] = $this->Tit_doc;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
            "http://www.w3.org/TR/1999/REC-html401-19991224/loose.dtd">
<HTML<?php echo $_SESSION['scriptcase']['reg_conf']['html_dir'] ?>>
<HEAD>
 <TITLE><?php echo $this->Ini->Nm_lang['lang_othr_grid_titl'] ?> - atendimento :: RTF</TITLE>
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
<form name="Fdown" method="get" action="grid_atendimento_download.php" target="_blank" style="display: none"> 
<input type="hidden" name="script_case_init" value="<?php echo NM_encode_input($this->Ini->sc_page); ?>"> 
<input type="hidden" name="nm_tit_doc" value="grid_atendimento"> 
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
