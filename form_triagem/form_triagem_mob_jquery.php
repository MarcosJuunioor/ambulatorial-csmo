
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
  scEventControl_data["id_paciente" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": ""};
  scEventControl_data["id_triagem" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": ""};
  scEventControl_data["data" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": ""};
  scEventControl_data["hora" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": ""};
  scEventControl_data["pa" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": ""};
  scEventControl_data["fc" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": ""};
  scEventControl_data["fr" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": ""};
  scEventControl_data["tc" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": ""};
  scEventControl_data["hgt" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": ""};
  scEventControl_data["peso" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": ""};
  scEventControl_data["altura" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": ""};
  scEventControl_data["coren" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": ""};
  scEventControl_data["alergia" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": ""};
  scEventControl_data["tipo_alergia" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": ""};
  scEventControl_data["id_usuario" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": ""};
}

function scEventControl_active(iSeqRow) {
  if (scEventControl_data["id_paciente" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["id_paciente" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["id_triagem" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["id_triagem" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["data" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["data" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["hora" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["hora" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["pa" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["pa" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["fc" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["fc" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["fr" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["fr" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["tc" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["tc" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["hgt" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["hgt" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["peso" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["peso" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["altura" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["altura" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["coren" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["coren" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["alergia" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["alergia" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["tipo_alergia" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["tipo_alergia" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["id_usuario" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["id_usuario" + iSeqRow]["change"]) {
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
  if ("id_usuario" + iSeq == fieldName) {
    scEventControl_data[fieldName]["blur"] = false;
  }
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
  $('#id_sc_field_id_triagem' + iSeqRow).bind('blur', function() { sc_form_triagem_id_triagem_onblur(this, iSeqRow) })
                                        .bind('focus', function() { sc_form_triagem_id_triagem_onfocus(this, iSeqRow) });
  $('#id_sc_field_data' + iSeqRow).bind('blur', function() { sc_form_triagem_data_onblur(this, iSeqRow) })
                                  .bind('focus', function() { sc_form_triagem_data_onfocus(this, iSeqRow) });
  $('#id_sc_field_hora' + iSeqRow).bind('blur', function() { sc_form_triagem_hora_onblur(this, iSeqRow) })
                                  .bind('focus', function() { sc_form_triagem_hora_onfocus(this, iSeqRow) });
  $('#id_sc_field_pa' + iSeqRow).bind('blur', function() { sc_form_triagem_pa_onblur(this, iSeqRow) })
                                .bind('focus', function() { sc_form_triagem_pa_onfocus(this, iSeqRow) });
  $('#id_sc_field_fc' + iSeqRow).bind('blur', function() { sc_form_triagem_fc_onblur(this, iSeqRow) })
                                .bind('focus', function() { sc_form_triagem_fc_onfocus(this, iSeqRow) });
  $('#id_sc_field_fr' + iSeqRow).bind('blur', function() { sc_form_triagem_fr_onblur(this, iSeqRow) })
                                .bind('focus', function() { sc_form_triagem_fr_onfocus(this, iSeqRow) });
  $('#id_sc_field_tc' + iSeqRow).bind('blur', function() { sc_form_triagem_tc_onblur(this, iSeqRow) })
                                .bind('focus', function() { sc_form_triagem_tc_onfocus(this, iSeqRow) });
  $('#id_sc_field_hgt' + iSeqRow).bind('blur', function() { sc_form_triagem_hgt_onblur(this, iSeqRow) })
                                 .bind('focus', function() { sc_form_triagem_hgt_onfocus(this, iSeqRow) });
  $('#id_sc_field_peso' + iSeqRow).bind('blur', function() { sc_form_triagem_peso_onblur(this, iSeqRow) })
                                  .bind('focus', function() { sc_form_triagem_peso_onfocus(this, iSeqRow) });
  $('#id_sc_field_altura' + iSeqRow).bind('blur', function() { sc_form_triagem_altura_onblur(this, iSeqRow) })
                                    .bind('focus', function() { sc_form_triagem_altura_onfocus(this, iSeqRow) });
  $('#id_sc_field_coren' + iSeqRow).bind('blur', function() { sc_form_triagem_coren_onblur(this, iSeqRow) })
                                   .bind('focus', function() { sc_form_triagem_coren_onfocus(this, iSeqRow) });
  $('#id_sc_field_alergia' + iSeqRow).bind('blur', function() { sc_form_triagem_alergia_onblur(this, iSeqRow) })
                                     .bind('click', function() { sc_form_triagem_alergia_onclick(this, iSeqRow) })
                                     .bind('focus', function() { sc_form_triagem_alergia_onfocus(this, iSeqRow) });
  $('#id_sc_field_tipo_alergia' + iSeqRow).bind('blur', function() { sc_form_triagem_tipo_alergia_onblur(this, iSeqRow) })
                                          .bind('focus', function() { sc_form_triagem_tipo_alergia_onfocus(this, iSeqRow) });
  $('#id_sc_field_id_usuario' + iSeqRow).bind('blur', function() { sc_form_triagem_id_usuario_onblur(this, iSeqRow) })
                                        .bind('focus', function() { sc_form_triagem_id_usuario_onfocus(this, iSeqRow) });
  $('#id_sc_field_id_paciente' + iSeqRow).bind('blur', function() { sc_form_triagem_id_paciente_onblur(this, iSeqRow) })
                                         .bind('focus', function() { sc_form_triagem_id_paciente_onfocus(this, iSeqRow) });
} // scJQEventsAdd

function sc_form_triagem_id_triagem_onblur(oThis, iSeqRow) {
  do_ajax_form_triagem_mob_validate_id_triagem();
  scCssBlur(oThis);
}

function sc_form_triagem_id_triagem_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_triagem_data_onblur(oThis, iSeqRow) {
  do_ajax_form_triagem_mob_validate_data();
  scCssBlur(oThis);
}

function sc_form_triagem_data_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_triagem_hora_onblur(oThis, iSeqRow) {
  do_ajax_form_triagem_mob_validate_hora();
  scCssBlur(oThis);
}

function sc_form_triagem_hora_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_triagem_pa_onblur(oThis, iSeqRow) {
  do_ajax_form_triagem_mob_validate_pa();
  scCssBlur(oThis);
}

function sc_form_triagem_pa_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_triagem_fc_onblur(oThis, iSeqRow) {
  do_ajax_form_triagem_mob_validate_fc();
  scCssBlur(oThis);
}

function sc_form_triagem_fc_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_triagem_fr_onblur(oThis, iSeqRow) {
  do_ajax_form_triagem_mob_validate_fr();
  scCssBlur(oThis);
}

function sc_form_triagem_fr_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_triagem_tc_onblur(oThis, iSeqRow) {
  do_ajax_form_triagem_mob_validate_tc();
  scCssBlur(oThis);
}

function sc_form_triagem_tc_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_triagem_hgt_onblur(oThis, iSeqRow) {
  do_ajax_form_triagem_mob_validate_hgt();
  scCssBlur(oThis);
}

function sc_form_triagem_hgt_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_triagem_peso_onblur(oThis, iSeqRow) {
  do_ajax_form_triagem_mob_validate_peso();
  scCssBlur(oThis);
}

function sc_form_triagem_peso_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_triagem_altura_onblur(oThis, iSeqRow) {
  do_ajax_form_triagem_mob_validate_altura();
  scCssBlur(oThis);
}

function sc_form_triagem_altura_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_triagem_coren_onblur(oThis, iSeqRow) {
  do_ajax_form_triagem_mob_validate_coren();
  scCssBlur(oThis);
}

function sc_form_triagem_coren_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_triagem_alergia_onblur(oThis, iSeqRow) {
  do_ajax_form_triagem_mob_validate_alergia();
  scCssBlur(oThis);
}

function sc_form_triagem_alergia_onclick(oThis, iSeqRow) {
  do_ajax_form_triagem_mob_event_alergia_onclick();
}

function sc_form_triagem_alergia_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_triagem_tipo_alergia_onblur(oThis, iSeqRow) {
  do_ajax_form_triagem_mob_validate_tipo_alergia();
  scCssBlur(oThis);
}

function sc_form_triagem_tipo_alergia_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_triagem_id_usuario_onblur(oThis, iSeqRow) {
  do_ajax_form_triagem_mob_validate_id_usuario();
  scCssBlur(oThis);
}

function sc_form_triagem_id_usuario_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_triagem_id_paciente_onblur(oThis, iSeqRow) {
  do_ajax_form_triagem_mob_validate_id_paciente();
  scCssBlur(oThis);
}

function sc_form_triagem_id_paciente_onfocus(oThis, iSeqRow) {
  scCssFocus(oThis);
}

function scJQUploadAdd(iSeqRow) {
} // scJQUploadAdd


function scJQElementsAdd(iLine) {
  scJQEventsAdd(iLine);
  scEventControl_init(iLine);
  scJQUploadAdd(iLine);
} // scJQElementsAdd

var scBtnGrpStatus = {};
function scBtnGrpShow(sGroup) {
  var btnPos = $('#sc_btgp_btn_' + sGroup).offset();
  scBtnGrpStatus[sGroup] = 'open';
  $('#sc_btgp_btn_' + sGroup).mouseout(function() {
    setTimeout(function() {
      scBtnGrpHide(sGroup);
    }, 1000);
  });
  $('#sc_btgp_div_' + sGroup + ' span a').click(function() {
    scBtnGrpStatus[sGroup] = 'out';
    scBtnGrpHide(sGroup);
  });
  $('#sc_btgp_div_' + sGroup).css({
    'left': btnPos.left
  })
  .mouseover(function() {
    scBtnGrpStatus[sGroup] = 'over';
  })
  .mouseleave(function() {
    scBtnGrpStatus[sGroup] = 'out';
    setTimeout(function() {
      scBtnGrpHide(sGroup);
    }, 1000);
  })
  .show('fast');
}
function scBtnGrpHide(sGroup) {
  if ('over' != scBtnGrpStatus[sGroup]) {
    $('#sc_btgp_div_' + sGroup).hide('fast');
  }
}
