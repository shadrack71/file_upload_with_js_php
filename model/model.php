<?php
include_once("config.php");
include_once("DataProcessing.php");
$db = new Connection();
$conn = $db->Connect();
if(isset($_POST["submit"])){
    $name =htmlentities( $_POST["name"]);
    $email=htmlentities( $_POST["email"]);
    $fileUpload= $_FILES["fileUpload"];
    $processingData =new DataProcceing($conn);
    $dataVAlueObj = $processingData ->InputValidation($name,$email);
    $fileUploadReps = $processingData ->FileValidation($fileUpload);
    if($fileUploadReps['msg'] === "ok"){
        $mergeDataInput = array_merge($dataVAlueObj,$fileUploadReps);
        $serverResponse = $processingData->FileUploadToDb($mergeDataInput);
        if($serverResponse['msg']=="ok"){
            $finalReps = $serverResponse['response'];
            // echo($finalReps);
        }else{
            $finalReps = $serverResponse['response'];
            // echo($finalReps);
        }
        // echo $fileUploadReps["response"];

    }else{
        $finalReps = $fileUploadReps["response"];
    }
    
    // var_dump ($fileUploadReps);
    // var_dump ($dataVAlueObj);
    

}