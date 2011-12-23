<?php

DEFINE ('CACHE_DIRECTORY','/cache/');

class Cache {

var $filename;

function Cache($url) {
  
  $fp=@fopen($url,'r');
  if($fp === false) 
    {
      $result=$this->checkCache($url);
      if ($result==true) 
        {
          $this->filename=getcwd().CACHE_DIRECTORY.md5($url);
          return;
        }
      else echo "ERROR - document not found!";die; 
    }
  else
    {
      $this->filename=$url;
      $this->saveToCache($url);
      return;
    }  
}

function checkCache($url) {

  $fp=file_exists(getcwd().CACHE_DIRECTORY.md5($url));
  if ($fp == false) return false;
  else 
    {
      return true;
    }
}

function saveToCache($url) {

  $fp=@file_get_contents($url);
  $foutput=@fopen(getcwd().CACHE_DIRECTORY.md5($url),'a+');
  @fwrite($foutput,$fp);
  
}

}


?>