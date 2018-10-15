<?php
        
//Client @0-9B0A789B
define("RelativePath", ".");
define("PathToCurrentPage", "");
define("FileName", "");
include(RelativePath . "/Common.php");
$ClientFileEncoding = "UTF-8";
$AllowedFiles = array(
    "DatePicker.js" => "content-type: text/javascript; charset=$ClientFileEncoding",
    "Functions.js" => "content-type: text/javascript; charset=$ClientFileEncoding"
);
$file = CCGetFromGet("file");
if (!array_key_exists($file, $AllowedFiles)) {
    echo " ";
    exit;
}
$file_content = "";
$file_path = RelativePath . "/" . $file;
if (file_exists($file_path)) {
    $fh=fopen($file_path, "rb");
    if (filesize($file_path))
        $file_content = fread($fh, filesize($file_path));
    fclose($fh);
    $file_content = preg_replace("/\\{res:\s*(\w+)\\}/ise", "CCConvertEncoding(\$CCSLocales->GetText('\\1'), \$FileEncoding, \$ClientFileEncoding)", $file_content);
}
if ($AllowedFiles[$file]) 
    header($AllowedFiles[$file]);
echo $file_content;
//End Client


?>
