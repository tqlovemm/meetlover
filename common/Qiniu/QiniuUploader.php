<?php
namespace common\Qiniu;

use common\Qiniu\Storage\BucketManager;
use common\Qiniu\Storage\UploadManager;

class QiniuUploader
{
    private $accessKey;
    private $secretKey;
    private $form_name;

    public function __construct($form_name,$accessKey,$secretKey)
    {
        $this->accessKey = $accessKey;
        $this->secretKey = $secretKey;
        $this->form_name = $form_name;
    }

    protected function Auth(){

        $auth = new Auth($this->accessKey, $this->secretKey);
        return $auth;
    }

    public function upload($bucket,$key){

        $file_name = $_FILES[$this->form_name]['name'];
        $filePath= $_FILES[$this->form_name]['tmp_name'];

        $upToken = $this->Auth()->uploadToken($bucket);
        $uploadMgr = new UploadManager();
        list($ret, $err) = $uploadMgr->putFile($upToken, $key.'_'.md5($file_name), $filePath);
        if ($err !== null) {
            var_dump($err);
        } else {
            return $ret;
        }

    }

    public function upload_multi($bucket,$key,$file){

        $upToken = $this->Auth()->uploadToken($bucket);
        $uploadMgr = new UploadManager();

        list($ret, $err) = $uploadMgr->putFile($upToken, $key.'_'.md5(time().rand(10000,99999)), $file);

        if ($err !== null) {
            var_dump($err);
        } else {
            return $ret;
        }
    }

    public function upload_app($bucket,$key,$filePath){

        $upToken = $this->Auth()->uploadToken($bucket);
        $uploadMgr = new UploadManager();
        list($ret, $err) = $uploadMgr->putFile($upToken, $key, $filePath);
        if ($err !== null) {
            var_dump($err);
        } else {
            return $ret;
        }

    }
    public function delete($bucket,$key){
        $deleteImg = new BucketManager($this->Auth());
        return $deleteImg->delete($bucket,$key);
    }

    public function thumb_img($url){
        $qf = new Qfunctions();
        return $qf->thumbnail($url, 4, 650, 650);
    }

    public function watermark_img($url){
        $qf = new Qfunctions();
        return $qf->waterImg($url,'http://13loveme.com/images/watermark/13.png',100,'Center');
    }

}