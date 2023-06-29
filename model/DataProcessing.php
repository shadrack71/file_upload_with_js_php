<?php

class DataProcceing {
    private $conn;
    private $table= "fileupload";
    public function __construct($db){
        $this-> conn = $db;
    }

    public function InputValidation($name,$email){
        $nameSanitize = htmlspecialchars($name);
        $emailSanitize = filter_var($email, FILTER_SANITIZE_EMAIL);
        $returnObj = array(
            "name"=>$nameSanitize,
            "email"=>$emailSanitize
        );
        return $returnObj;
    }
    public function FileValidation($fileUpload){
    $ExtensionImg= strtolower(pathinfo($fileUpload['name'], PATHINFO_EXTENSION));
    $allowedExt =["jpg","png","jpeg"];
    if(in_array($ExtensionImg,$allowedExt)){
        if($fileUpload['size'] < ( 10* 1024*1024)){
        $imageSize = getimagesize($fileUpload['tmp_name']);
        $imageWidth = $imageSize[0];
        $imageHeigt = $imageSize[1];
            if($imageWidth <= $imageHeigt){
                $rep = [
                    "msg"=>"error",
                    "response"=>"only landscape images are supported"

                ];
                return $rep;
            }else{
                $tmp_location = $fileUpload['tmp_name'];
                $fileName= strtolower(pathinfo($fileUpload['name'], PATHINFO_FILENAME));
                $formatName = $fileName.uniqid().".".$ExtensionImg;
                $dir ="uploads/".$formatName;
                try{
                if(move_uploaded_file($tmp_location,$dir)){
                     $rep = [
                    "msg"=>"ok",
                    "response"=>"file uploaded successfully",
                    "dir"=>$dir
                ];
                return $rep;
                   
                    
                }else{
                     $rep = [
                    "msg"=>"error",
                    "response"=>"error occurred while uploading file"
                ];
                return $rep;
                    }
                }catch(Exception $e){
                     $rep = [
                    "msg"=>"error",
                    "response"=>$e->getMessage()
                ];
                return $rep;
                    
                }

                
                // $testName = "this is a test image name";
                // $formatArrayName = str_split($testName,4);
                // $formatName = implode("-",$formatArrayName);
                
  
            }


        }else{
             $rep = [
                    "msg"=>"error",
                    "response"=>"only 10mb image file size is allowed"

                ];
                return $rep;
        }
    }else{
         $rep = [
                    "msg"=>"error",
                    "response"=>"only image file is allowed"

                ];
                return $rep;
    }
        


    }

    public function FileUploadToDb($data){
        $name = $data['name'];
        $email = $data['email'];
        $filelocation=$data['dir'];
        $sql = "INSERT INTO ".$this->table." (name,email,filelocation) VALUES(:name,:email,:filelocation)";
        try{
        $stmt = $this->conn->prepare($sql);
        $stmt -> bindParam(":name",$name);
        $stmt -> bindParam(":email",$email);
        $stmt -> bindParam(":filelocation",$filelocation);
        if($stmt->execute()){
             return array(
                "msg"=> "ok",
                "response"=>"file uploaded successfully"
            );
        }else{
            unlink($filelocation);
             return array(
                "msg"=> "error",
                "response"=>"unknown error occurred"
            );

        }
        }catch(PDOException $e){
            unlink($filelocation);
            return array(
                "msg"=> "error",
                "response"=>$e -> getMessage()
            );

        }



    }



}