<?php



class Upload extends Database{
    
    public $test;


    public function getStatus($file)
    {
        if($file['error'] == UPLOAD_ERR_OK){
            return true;
        }
    }

    public function checkImg($file)
    {
        $value = getimagesize($file['tmp_name']);
        
        if($value){return true;}
        else{return false;}
    }

    public function getDetails($file)
    {
        return array(
            'name' => $file['name'],
            'size' => $file['size'],
            'temp' => $file['tmp_name'],
            'type' => $file['type']
        );
    }

}