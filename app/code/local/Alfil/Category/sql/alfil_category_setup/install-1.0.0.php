<?php
//Open the conection
$instancia = $this;
$instancia->startSetup();

/** 
 * Table Name: Category
 * Action: Create
 * Note: Table to add id of the category created
 * 
 * */
$table = $instancia->getConnection()
    ->newTable($instancia->getTable('alfil_category/category'))
    ->addColumn(
    'id_env', Varien_Db_Ddl_Table::TYPE_INTEGER, null,
    array(
        'identity' => true,
        'unsigned' => true,
        'nullable'=> false,
        'primary' => true
    ), 'Comment')
    ->addColumn(
    'id_mage', Varien_Db_Ddl_Table::TYPE_INTEGER, null,
    array(
        'nullable' => false,
    ), 'id magento')
    ->addColumn(
        'codCat', Varien_Db_Ddl_Table::TYPE_VARCHAR, 255,
    array(
        'nullable' => false,
    ), 'Cod');

$instancia->getConnection()->createTable($table);

//Closed Conection
$instancia->endSetup();
