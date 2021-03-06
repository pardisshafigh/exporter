<?php
include "autoload.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    // echo "Not Submitted";
    return;
}
// form submit is OK
// $params = $_POST;
[$title,$content,$format] = [$_POST["title"],$_POST["content"],$_POST["format"]];
// echo "Submit OK";


$whitelist = ["Text","Pdf","Json","Csv"];
if(!in_array($format,$whitelist)){
      echo "Invalid Format!!!";
      return;
}


$className = "Exporter\\{$format}Exporter";
if (class_exists($className)) {
    $exporter = new $className(["title"=>$title,"content"=>$content]);
    $exporter->export(); 
}


// switch($format){
//     case "Text":
//         Exporter::export_to_text($title,$content);
//         break;
//     case "Pdf":
//         Exporter::export_to_PDF($title,$content);
//         break;
//     case "Json":
//         Exporter::json_export($title,$content);
//         break;
// }

