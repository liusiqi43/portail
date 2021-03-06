<?php
/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class Version19 extends Doctrine_Migration_Base
{
    public function up()
    {
        $this->dropForeignKey('annonce', 'annonce_branche_id_branche_id');
    }

    public function down()
    {
        $this->createForeignKey('annonce', 'annonce_branche_id_branche_id', array(
             'name' => 'annonce_branche_id_branche_id',
             'local' => 'branche_id',
             'foreign' => 'id',
             'foreignTable' => 'branche',
             'onUpdate' => 'CASCADE',
             'onDelete' => '',
             ));
    }
}