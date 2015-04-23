<?php

use Phinx\Migration\AbstractMigration;

class LanguagesTable extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-change-method
     *
     * Uncomment this method if you would like to use it.
     *
    public function change()
    {
    }
    */
    
    /**
     * Migrate Up.
     */
    public function up()
    {
        $this->query("
            CREATE TABLE IF NOT EXISTS `languages` (
                `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
                `name` varchar(255) NOT NULL,
                PRIMARY KEY (`id`)
              ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

              --
              -- Dumping data for table `languages`
              --

              INSERT INTO `languages` (`id`, `name`) VALUES
              (1, 'Български'),
              (2, 'Английски'),
              (3, 'Гръцки'),
              (4, 'Сръбски'),
              (5, 'Френски'),
              (6, 'Руски'),
              (7, 'Немски'),
              (8, 'Италиански'),
              (9, 'Испански'),
              (10, 'Турски'),
              (11, 'Македонски'),
              (12, 'Румънски'),
              (13, 'Хинди(Индийски)'),
              (14, 'Унгарски'),
              (15, 'Иврит'),
              (16, 'Ирландски'),
              (17, 'Португалски')
        ");
    }

    /**
     * Migrate Down.
     */
    public function down()
    {
        $this->query("DROP TABLE languages");
    }
}