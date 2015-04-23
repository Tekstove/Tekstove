<?php

use Phinx\Migration\AbstractMigration;

class ChangeTextBgToAllowNull extends AbstractMigration
{

    /**
     * Migrate Up.
     */
    public function up() {
        
        echo "changing table..." . PHP_EOL;
        $this->query("
            ALTER TABLE lyric MODIFY text_bg text NULL;
        ");
        
        echo "Updating lyrics..." . PHP_EOL;
        $this->query("
            UPDATE
                lyric
            SET
                text_bg = NULL
            WHERE
                TRIM(text_bg) = ''
        ");
    }

    /**
     * Migrate Down.
     */
    public function down() {
        $this->query("
            ALTER TABLE lyric MODIFY text_bg text NOT NULL;
        ");
    }

}
