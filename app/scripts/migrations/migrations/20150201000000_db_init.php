<?php

use Phinx\Migration\AbstractMigration;

/**
 * Description of 2015020100000_db_init
 *
 * @author po_taka <angel.koilov@gmail.com>
 */
class DbInit extends AbstractMigration
{
        
    /**
     * Migrate Up.
     */
    public function up()
    {
        $this->query(<<<EOT

EOT
        );
        
        throw new \Exception('todo');
    }

    /**
     * Migrate Down.
     */
    public function down()
    {
        $this->query(<<<EOT
                
   
EOT
        );
    }
}
