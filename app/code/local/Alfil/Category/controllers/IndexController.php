<?php
class Alfil_Category_IndexController extends Mage_Core_Controller_Front_Action {

    public function indexAction() {        
        $category = Mage::getmodel('alfil_category/category');
        $data = $category->addCreate();
        echo json_encode($data);
    }
    
}