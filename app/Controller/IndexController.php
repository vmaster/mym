<?php
  class IndexController extends AppController{
       var $name = 'Index';
       
       public function index(){
           $this->layout = "default";
       }
  }
?>
