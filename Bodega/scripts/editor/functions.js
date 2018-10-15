//JS Functions @0-B7FF2866
var isNN = (navigator.appName.indexOf("Netscape") != -1);
var isIE = (navigator.appName.indexOf("Microsoft") != -1);
var IEVersion = (isIE ? getIEVersion() : 0);

function ccsShowError(control, msg)
{
  alert(msg);
  control.focus();
  return false;
}

function getIEVersion()
{
  var userAgent = window.navigator.userAgent;
  var MSIEPos = userAgent.indexOf("MSIE");
  return (MSIEPos > 0 ? parseInt(userAgent.substring(MSIEPos+5, userAgent.indexOf(".", MSIEPos))) : 0);
}

function inputMasking(evt)
{
  if (isIE && IEVersion > 4)
  {
    if (window.event.altKey) return false;
    if (window.event.ctrlKey) return false;
    if (typeof(this.ccsInputMask) == "string")
    {
      var mask = this.ccsInputMask;
      var keycode = window.event.keyCode;
      this.value = applyMask(keycode, mask, this.value);
    }
    return false;
  }
  else
    return true;
}

function applyMask(keycode, mask, value)
{
  var digit = (keycode >= 48 && keycode <= 57);
  var plus = (keycode == 43);
  var dash = (keycode == 45);
  var space = (keycode == 32);
  var uletter = (keycode >= 65 && keycode <= 90);
  var lletter = (keycode >= 97 && keycode <= 122);
  
  var pos = value.length;
  switch(mask.charAt(pos))
  {
    case "0":
      if (digit)
        value += String.fromCharCode(keycode);
      break;
    case "L":
      if (uletter || lletter)
        value += String.fromCharCode(keycode);
    default:
      var isMatchMask = (String.fromCharCode(keycode) == mask.charAt(pos));
      while (pos < mask.length && mask.charAt(pos) != "0")
        value += mask.charAt(pos++);
      if (!isMatchMask && pos < mask.length)
        value = applyMask(keycode, mask, value);
  }  
  return value;
}

function validate_control(control)
{
/*
ccsCaption - string
ccsErrorMessage - string

ccsRequired - boolean
ccsMinLength - integer
ccsMaxLength - integer
ccsRegExp - string

ccsValidator - validation function

ccsInputMask - string
*/
  var errorMessage = control.ccsErrorMessage;
  var customErrorMessage = (typeof(errorMessage) != "undefined");
   
  if (typeof(control.ccsRequired) == "boolean" && control.ccsRequired)
    if (control.value == "")
      return ccsShowError(control, customErrorMessage ? errorMessage :
        "The value in field " + control.ccsCaption + " is required.");

  if (typeof(control.ccsMinLength) == "number")
    if (control.value != "" && control.value.length < parseInt(control.ccsMinLength))
      return ccsShowError(control, customErrorMessage ? errorMessage :
        "The length in field " + control.ccsCaption + " can't be less than " + parseInt(control.ccsMinLength) + " symbols.");

  if (typeof(control.ccsMaxLength) == "number")
    if (control.value != "" && control.value.length > parseInt(control.ccsMaxLength))
      return ccsShowError(control, customErrorMessage ? errorMessage :
        "The length in field " + control.ccsCaption + " can't be greater than " + parseInt(control.ccsMaxLength) + " symbols.");

  if (typeof(control.ccsRegExp) == "string")
    if (control.value != "" && (control.value.search(new RegExp(control.ccsRegExp, "i")) > 0))
      return ccsShowError(control, customErrorMessage ? errorMessage :
        "The value in field " + control.ccsCaption + " is not valid.");
  
  if (typeof(control.ccsValidator) == "function")
    if (!control.ccsValidator())
      return ccsShowError(control, customErrorMessage ? errorMessage :
        "The value in field " + control.ccsCaption + " is not valid.");
}

function validate_form(form)
{
  var result;
  for (var i = 0; i < form.elements.length && (result = validate_control(form.elements[i])); i++);
  return result;
}

function forms_onload()
{
  var forms = document.forms;
  var i, j, elm, form;
  for(i = 0; i < forms.length; i++)
  {
    form = forms[i];
    if (typeof(form.onLoad) == "function") form.onLoad();
    for (j = 0; j < form.elements.length; j++)
    {
      elm = form.elements[j];
      if (typeof(elm.onLoad) == "function") elm.onLoad();
    }
  }
  return true;
}

//End JS Functions

