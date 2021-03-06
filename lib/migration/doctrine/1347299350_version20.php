<?php
/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class Version20 extends Doctrine_Migration_Base
{
    public function up()
    {
        $this->dropTable('departement');
        $this->addColumn('charte_info', 'ip', 'string', '15', array(
             'notnull' => '1',
             ));
        $this->addColumn('charte_info', 'asso', 'string', '20', array(
             'notnull' => '1',
             ));
        $this->addColumn('charte_info', 'login', 'string', '20', array(
             'notnull' => '1',
             ));
        $this->changeColumn('charte_info', 'date', 'datetime', '', array(
             'notnull' => '1',
             ));
    }

    public function down()
    {
        $this->createTable('departement', array(
             'id' => 
             array(
              'type' => 'integer',
              'length' => '8',
              'autoincrement' => '1',
              'primary' => '1',
             ),
             'num' => 
             array(
              'type' => 'integer',
              'notnull' => '1',
              'length' => '2',
             ),
             'name' => 
             array(
              'type' => 'string',
              'notnull' => '1',
              'length' => '50',
             ),
             'created_at' => 
             array(
              'notnull' => '1',
              'type' => 'timestamp',
              'length' => '25',
             ),
             'updated_at' => 
             array(
              'notnull' => '1',
              'type' => 'timestamp',
              'length' => '25',
             ),
             ), array(
             'type' => '',
             'indexes' => 
             array(
             ),
             'primary' => 
             array(
              0 => 'id',
             ),
             'collate' => 'utf8_unicode_ci',
             'charset' => 'utf8',
             ));
        $this->removeColumn('charte_info', 'ip');
        $this->removeColumn('charte_info', 'asso');
        $this->removeColumn('charte_info', 'login');
    }
}