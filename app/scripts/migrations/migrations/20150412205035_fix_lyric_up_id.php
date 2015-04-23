<?php

use Phinx\Migration\AbstractMigration;

class FixLyricUpId extends AbstractMigration
{
    /**
     * Migrate Up.
     */
    public function up()
    {
        throw new \Exception('todo');
        
        $this->query("
            UPDATE
                lyric
            SET
                up_id = NULL
            WHERE
                up_id = 0
        ");
    }

    /**
     * Migrate Down.
     */
    public function down()
    {

    }
}