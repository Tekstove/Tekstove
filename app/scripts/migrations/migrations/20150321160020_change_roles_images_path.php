<?php

use Phinx\Migration\AbstractMigration;

class ChangeRolesImagesPath extends AbstractMigration
{
    /**
     * Migrate Up.
     */
    public function up()
    {
        $this->query("
            UPDATE
                permission_groups
            SET
                image = CONCAT(\"bundles/tekstove/images/badges/\", image)
        ");
    }

    /**
     * Migrate Down.
     */
    public function down()
    {
        $this->query("
            UPDATE
                permission_groups
            SET
                image = REPLACE(image, \"bundles/tekstove/images/badges/\", \"\")
        ");
    }
}