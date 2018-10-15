// JScript source code
// Include functions for CCS2 WYSIWYG Editor extension
// Developed by Bill Noble   www.web-presentations.com
function Init(){
iViewField.document.designMode = 'On';
iViewField.document.open();
iViewField.document.write(HTMLeditor.htmlsource.value);
iViewField.document.close();
}
function swaphtml(){
HTMLeditor.htmlsource.value=iViewField.document.body.innerHTML;
}
function selOn(ctrl){
ctrl.style.borderColor = '#000000';
ctrl.style.backgroundColor = '#B5BED6';
ctrl.style.cursor = 'hand';
}
function selOff(ctrl){
ctrl.style.borderColor = '#D6D3CE';
ctrl.style.backgroundColor = '#D6D3CE';
}
function selDown(ctrl){
ctrl.style.backgroundColor = '#8492B5';
}
function selUp(ctrl){
ctrl.style.backgroundColor = '#B5BED6';
}
function doPrint(){
iViewField.document.execCommand('print', false, null);
}
function doForeCol(){
 var fCol = dlgHelper.ChooseColorDlg();
	fCol = fCol.toString(16);
	if (fCol.length < 6) {
  	var sTempString = "000000".substring(0,6-fCol.length);
  	fCol = sTempString.concat(fCol);
}

iViewField.document.execCommand('forecolor', false, fCol);
}
function doBackCol(){
 var bCol = dlgHelper.ChooseColorDlg();
	bCol = bCol.toString(16);
	if (bCol.length < 6) {
  	var sTempString = "000000".substring(0,6-bCol.length);
  	bCol = sTempString.concat(bCol);
}

iViewField.document.execCommand('backcolor', false, bCol);
}
function doSmile(BNsmile){
BNsmile=showModalDialog("rteditor/smile.html",BNsmile, "status=No; location=No; dialogWidth:19.50em; dialogHeight:18.5em");
iViewField.focus();
iViewField.document.selection.createRange().pasteHTML(BNsmile);
}
function doChar(BNchar){
BNchar=showModalDialog("rteditor/CCS_Char.htm",BNchar, "status=No; location=No; dialogWidth:32.47em; dialogHeight:15.6em");
iViewField.focus();
iViewField.document.selection.createRange().pasteHTML(BNchar);
}
function doCut(){
iViewField.document.execCommand('cut', false, null);
}
function doCopy(){
iViewField.document.execCommand('copy', false, null);
}
function doPaste(){
iViewField.document.execCommand('paste', false, null);
}
function doBold(){
iViewField.document.execCommand('bold', false, null);
}
function doItalic(){
iViewField.document.execCommand('italic', false, null);
}
function doUnderline(){
iViewField.document.execCommand('underline', false, null);
}
function doLeft(){
iViewField.document.execCommand('justifyleft', false, null);
}
function doCenter(){
iViewField.document.execCommand('justifycenter', false, null);
}
function doRight(){
iViewField.document.execCommand('justifyright', false, null);
}
function doOrdList(){
iViewField.document.execCommand('insertorderedlist', false, null);
}
function doBulList(){
iViewField.document.execCommand('insertunorderedlist', false, null);
}
function doLink(){
iViewField.document.execCommand('createlink');
}
function doRule(){
iViewField.document.execCommand('inserthorizontalrule', false, null);
}
function doFont(fName){
if(fName != '')
iViewField.document.execCommand('fontname', false, fName);
}
function doSize(fSize){
if(fSize != '')
iViewField.document.execCommand('fontsize', false, fSize);
}


