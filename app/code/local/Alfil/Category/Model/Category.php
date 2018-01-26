<?php
class Alfil_Category_Model_Category extends Mage_Core_Model_Abstract
{
    /** @var integer regAdd */
    public $regAdd = 0;
    /** @var integer regError */
    public $regError = 0;

    protected function _construct()
    {
        $this->_init('alfil_category/category');
    }

    public function addCreate()
    {
        $model = Mage::getmodel('alfil_category/category');

        $categories[] = array('codCat' => 'Demo', 'Name' => 'Category Demo');
        $categories[] = array('codCat' => 'Demo2', 'Name' => 'Category Demo Two');
        
        foreach($categories as $cat => $row) {
            $model->load($row->codCat, 'codCat');
            $id_category = $model->getId_mage();

            $parent = Mage::getModel('catalog/category')->load(2);

            $category = Mage::getModel('catalog/category')->load($id_category);
            
            $category->setName($row->NAME);
            $category->setUrlKey('url-cat');
            $category->setIsActive(1);
            $category->setDisplayMode('PRODUCTS');
            $category->setIsAnchor(1); //for active anchor
            $category->setStoreId(Mage::app()->getStore()->getId());
            $category->setPath($parent->getPath());
            try{
                $category->save();

                if(empty($id_category)) {
                    $params = array('id_mage' => $category->getId(), 'codCat' => $row->codCat);
                    $model->setData($params);
                    $model->save();
                    $this->regAdd = $this->regAdd + 1;
                }
                
            } catch(Exception $e){
                $this->regError = $this->regError + 1;
                Zend_Debug::dump($e->getMessage());
            }
        }//end forech
        $data['Category']['add'] = $this->regAdd;
        if($this->regError > 0)
        $data['Category']['Error'] = $this->regError;

        return json_encode($data);
    }

}