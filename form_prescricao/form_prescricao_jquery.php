
function scJQGeneralAdd() {
  $('input:text.sc-js-input').listen();
  $('input:password.sc-js-input').listen();
  $('input:checkbox.sc-js-input').listen();
  $('input:radio.sc-js-input').listen();
  $('select.sc-js-input').listen();
  $('textarea.sc-js-input').listen();

} // scJQGeneralAdd

function scFocusField(sField) {
  var $oField = $('#id_sc_field_' + sField);

  if (0 == $oField.length) {
    $oField = $('input[name=' + sField + ']');
  }

  if (0 == $oField.length && document.F1.elements[sField]) {
    $oField = $(document.F1.elements[sField]);
  }

  if (false == scSetFocusOnField($oField) && $("#id_ac_" + sField).length > 0) {
    if (false == scSetFocusOnField($("#id_ac_" + sField))) {
      setTimeout(function () { scSetFocusOnField($("#id_ac_" + sField)); }, 500);
    }
  }
  else {
    setTimeout(function() { scSetFocusOnField($oField); }, 500);
  }
} // scFocusField

function scSetFocusOnField($oField) {
  if ($oField.length > 0 && $oField[0].offsetHeight > 0 && $oField[0].offsetWidth > 0 && !$oField[0].disabled) {
    $oField[0].focus();
    return true;
  }
  return false;
} // scSetFocusOnField

function scEventControl_init(iSeqRow) {
  scEventControl_data["id_prescricao" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": ""};
  scEventControl_data["medicamento" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": ""};
  scEventControl_data["prescritor" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": ""};
  scEventControl_data["hora_de_adm" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": ""};
  scEventControl_data["prof_que_adm" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": ""};
  scEventControl_data["data_cadastro" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": ""};
  scEventControl_data["id_paciente" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": ""};
}

function scEventControl_active(iSeqRow) {
  if (scEventControl_data["id_prescricao" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["id_prescricao" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["medicamento" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["medicamento" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["prescritor" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["prescritor" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["hora_de_adm" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["hora_de_adm" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["prof_que_adm" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["prof_que_adm" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["data_cadastro" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["data_cadastro" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["id_paciente" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["id_paciente" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["id_paciente" + iSeqRow]["autocomp"]) {
    return true;
  }
  return false;
} // scEventControl_active

function scEventControl_onFocus(oField, iSeq) {
  var fieldId, fieldName;
  fieldId = $(oField).attr("id");
  fieldName = fieldId.substr(12);
  scEventControl_data[fieldName]["blur"] = true;
  scEventControl_data[fieldName]["change"] = false;
} // scEventControl_onFocus

function scEventControl_onBlur(sFieldName) {
  scEventControl_data[sFieldName]["blur"] = false;
  if (scEventControl_data[sFieldName]["change"]) {
        if (scEventControl_data[sFieldName]["original"] == $("#id_sc_field_" + sFieldName).val()) {
          scEventControl_data[sFieldName]["change"] = false;
        }
  }
} // scEventControl_onBlur

function scEventControl_onChange(sFieldName) {
  scEventControl_data[sFieldName]["change"] = false;
} // scEventControl_onChange

function scEventControl_onChange_call(sFieldName, iFieldSeq) {
  var oField, fieldId, fieldName;
  oField = $("#id_sc_field_" + sFieldName + iFieldSeq);
  fieldId = oField.attr("id");
  fieldName = fieldId.substr(12);
} // scEventControl_onChange

function scEventControl_onAutocomp(sFieldName) {
  scEventControl_data[sFieldName]["autocomp"] = false;
} // scEventControl_onChange

var scEventControl_data = {};

function scJQEventsAdd(iSeqRow) {
  $('#id_sc_field_id_prescricao' + iSeqRow).bind('blur', function() { sc_form_prescricao_id_prescricao_onblur(this, iSeqRow) })
                                           .bind('focus', function() { sc_form_prescricao_id_prescricao_onfocus(this, iSeqRow) });
  $('#id_sc_field_data_cadastro' + iSeqRow).bind('blur', function() { sc_form_prescricao_data_cadastro_onblur(this, iSeqRow) })
                                           .bind('focus', function() { sc_form_prescricao_data_cadastro_onfocus(this, iSeqRow) });
  $('#id_sc_field_data_cadastro_hora' + iSeqRow).bind('blur', function() { sc_form_prescricao_data_cadastro_hora_onblur(this, iSeqRow) })
                                                .bind('focus', function() { sc_form_prescricao_data_cadastro_hora_onfocus(this, iSeqRow) });
  $('#id_sc_field_medicamento' + iSeqRow).bind('blur', function() { sc_form_prescricao_medicamento_onblur(this, iSeqRow) })
                                         .bind('focus', function() { sc_form_prescricao_medicamento_onfocus(this, iSeqRow) });
  $('#id_sc_field_prescritor' + iSeqRow).bind('blur', function() { sc_form_prescricao_prescritor_onblur(this, iSeqRow) })
                                        .bind('focus', function() { sc_form_prescricao_prescritor_onfocus(this, iSeqRow) });
  $('#id_sc_field_hora_de_adm' + iSeqRow).bind('blur', function() { sc_form_prescricao_hora_de_adm_onblur(this, iSeqRow) })
                                         .bind('focus', function() { sc_form_prescricao_hora_de_adm_onfocus(this, iSeqRow) });
  $('#id_sc_field_prof_que_adm' + iSeqRow).bind('blur', function() { sc_form_prescricao_prof_que_adm_onblur(this, iSeqRow) })
                                          .bind('focus', function() { sc_form_prescricao_prof_que_adm_onfocus(this, iSeqRow) });
  $('#id_sc_field_id_paciente' + iSeqRow).bind('blur', function() { sc_form_prescricao_id_paciente_onblur(this, iSeqRow) })
                                         .bind('focus', function() { sc_form_prescricao_id_paciente_onfocus(this, iSeqRow) });
} // scJQEventsAdd

function sc_form_prescricao_id_prescricao_onblur(oThis, iSeqRow) {
  do_ajax_form_prescricao_validate_id_prescricao();
  scCssBlur(oThis);
}

function sc_form_prescricao_id_prescricao_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_prescricao_data_cadastro_onblur(oThis, iSeqRow) {
  do_ajax_form_prescricao_validate_data_cadastro();
  scCssBlur(oThis);
}

function sc_form_prescricao_data_cadastro_hora_onblur(oThis, iSeqRow) {
  do_ajax_form_prescricao_validate_data_cadastro();
  scCssBlur(oThis);
}

function sc_form_prescricao_data_cadastro_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_prescricao_data_cadastro_hora_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_prescricao_medicamento_onblur(oThis, iSeqRow) {
  do_ajax_form_prescricao_validate_medicamento();
  scCssBlur(oThis);
}

function sc_form_prescricao_medicamento_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_prescricao_prescritor_onblur(oThis, iSeqRow) {
  do_ajax_form_prescricao_validate_prescritor();
  scCssBlur(oThis);
}

function sc_form_prescricao_prescritor_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_prescricao_hora_de_adm_onblur(oThis, iSeqRow) {
  do_ajax_form_prescricao_validate_hora_de_adm();
  scCssBlur(oThis);
}

function sc_form_prescricao_hora_de_adm_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_prescricao_prof_que_adm_onblur(oThis, iSeqRow) {
  do_ajax_form_prescricao_validate_prof_que_adm();
  scCssBlur(oThis);
}

function sc_form_prescricao_prof_que_adm_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_prescricao_id_paciente_onblur(oThis, iSeqRow) {
  do_ajax_form_prescricao_validate_id_paciente();
  scCssBlur(oThis);
}

function sc_form_prescricao_id_paciente_onfocus(oThis, iSeqRow) {
  scCssFocus(oThis);
}

var sc_jq_calendar_value = {};

function scJQCalendarAdd(iSeqRow) {
  $("#id_sc_field_data_cadastro" + iSeqRow).datepicker({
    beforeShow: function(input, inst) {
      var $oField = $(this),
          aParts  = $oField.val().split(" "),
          sTime   = "";
      sc_jq_calendar_value["#id_sc_field_data_cadastro" + iSeqRow] = $oField.val();
      if (2 == aParts.length) {
        sTime = " " + aParts[1];
      }
      if ('' == sTime || ' ' == sTime) {
        sTime = ' <?php echo $this->jqueryCalendarTimeStart($this->field_config['data_cadastro']['date_format']); ?>';
      }
      $oField.datepicker("option", "dateFormat", "<?php echo $this->jqueryCalendarDtFormat("" . str_replace(array('/', 'aaaa', 'hh', 'ii', 'ss', ':', ';', $_SESSION['scriptcase']['reg_conf']['date_sep'], $_SESSION['scriptcase']['reg_conf']['time_sep']), array('', 'yyyy', '','','', '', '', '', ''), $this->field_config['data_cadastro']['date_format']) . "", "" . $_SESSION['scriptcase']['reg_conf']['date_sep'] . ""); ?>" + sTime);
    },
    onClose: function(dateText, inst) {
    },
    showWeek: true,
    numberOfMonths: 1,
    changeMonth: true,
    changeYear: true,
    yearRange: 'c-5:c+5',
    dayNames: ["<?php        echo html_entity_decode($this->Ini->Nm_lang['lang_days_sund'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);        ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_days_mond'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);        ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_days_tued'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);        ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_days_wend'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);        ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_days_thud'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);        ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_days_frid'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);        ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_days_satd'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);        ?>"],
    dayNamesMin: ["<?php     echo html_entity_decode($this->Ini->Nm_lang['lang_substr_days_sund'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_substr_days_mond'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_substr_days_tued'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_substr_days_wend'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_substr_days_thud'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_substr_days_frid'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_substr_days_satd'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>"],
    monthNamesShort: ["<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_janu'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);   ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_febr'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);   ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_marc'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);   ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_apri'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);   ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_mayy'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);   ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_june'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);   ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_july'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);   ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_augu'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_sept'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_octo'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_nove'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_dece'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>"],
    weekHeader: "<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_days_sem'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>",
    firstDay: <?php echo $this->jqueryCalendarWeekInit("" . $_SESSION['scriptcase']['reg_conf']['date_week_ini'] . ""); ?>,
    dateFormat: "<?php echo $this->jqueryCalendarDtFormat("" . str_replace(array('/', 'aaaa', 'hh', 'ii', 'ss', ':', ';', $_SESSION['scriptcase']['reg_conf']['date_sep'], $_SESSION['scriptcase']['reg_conf']['time_sep']), array('', 'yyyy', '','','', '', '', '', ''), $this->field_config['data_cadastro']['date_format']) . "", "" . $_SESSION['scriptcase']['reg_conf']['date_sep'] . ""); ?>",
    showOtherMonths: true,
    showOn: "button",
    buttonImage: "<?php echo $this->jqueryIconFile('calendar'); ?>",
    buttonImageOnly: true
  });

} // scJQCalendarAdd

function scJQUploadAdd(iSeqRow) {
} // scJQUploadAdd


function scJQElementsAdd(iLine) {
  scJQEventsAdd(iLine);
  scEventControl_init(iLine);
  scJQCalendarAdd(iLine);
  scJQUploadAdd(iLine);
} // scJQElementsAdd

