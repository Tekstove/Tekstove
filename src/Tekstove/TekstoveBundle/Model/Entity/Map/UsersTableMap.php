<?php

namespace Tekstove\TekstoveBundle\Model\Entity\Map;

use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\InstancePoolTrait;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\DataFetcher\DataFetcherInterface;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\RelationMap;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Map\TableMapTrait;
use Tekstove\TekstoveBundle\Model\Entity\Users;
use Tekstove\TekstoveBundle\Model\Entity\UsersQuery;


/**
 * This class defines the structure of the 'users' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class UsersTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'Tekstove.TekstoveBundle.Model.Entity.Map.UsersTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'users';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\Tekstove\\TekstoveBundle\\Model\\Entity\\Users';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'Tekstove.TekstoveBundle.Model.Entity.Users';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 20;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 20;

    /**
     * the column name for the username field
     */
    const COL_USERNAME = 'users.username';

    /**
     * the column name for the password field
     */
    const COL_PASSWORD = 'users.password';

    /**
     * the column name for the password_mod field
     */
    const COL_PASSWORD_MOD = 'users.password_mod';

    /**
     * the column name for the password_mod_coockie field
     */
    const COL_PASSWORD_MOD_COOCKIE = 'users.password_mod_coockie';

    /**
     * the column name for the id field
     */
    const COL_ID = 'users.id';

    /**
     * the column name for the mail field
     */
    const COL_MAIL = 'users.mail';

    /**
     * the column name for the class field
     */
    const COL_CLASS = 'users.class';

    /**
     * the column name for the classCustomName field
     */
    const COL_CLASSCUSTOMNAME = 'users.classCustomName';

    /**
     * the column name for the avatar field
     */
    const COL_AVATAR = 'users.avatar';

    /**
     * the column name for the about field
     */
    const COL_ABOUT = 'users.about';

    /**
     * the column name for the reg_date field
     */
    const COL_REG_DATE = 'users.reg_date';

    /**
     * the column name for the pozdrav field
     */
    const COL_POZDRAV = 'users.pozdrav';

    /**
     * the column name for the br_pesni field
     */
    const COL_BR_PESNI = 'users.br_pesni';

    /**
     * the column name for the rajdane field
     */
    const COL_RAJDANE = 'users.rajdane';

    /**
     * the column name for the prevodi field
     */
    const COL_PREVODI = 'users.prevodi';

    /**
     * the column name for the autoplay field
     */
    const COL_AUTOPLAY = 'users.autoplay';

    /**
     * the column name for the skype field
     */
    const COL_SKYPE = 'users.skype';

    /**
     * the column name for the activity_points field
     */
    const COL_ACTIVITY_POINTS = 'users.activity_points';

    /**
     * the column name for the banned field
     */
    const COL_BANNED = 'users.banned';

    /**
     * the column name for the chatMessages field
     */
    const COL_CHATMESSAGES = 'users.chatMessages';

    /**
     * The default string format for model objects of the related table
     */
    const DEFAULT_STRING_FORMAT = 'YAML';

    /**
     * holds an array of fieldnames
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
     */
    protected static $fieldNames = array (
        self::TYPE_PHPNAME       => array('Username', 'Password', 'PasswordMod', 'PasswordModCoockie', 'Id', 'Mail', 'Class', 'Classcustomname', 'Avatar', 'About', 'RegDate', 'Pozdrav', 'BrPesni', 'Rajdane', 'Prevodi', 'Autoplay', 'Skype', 'ActivityPoints', 'Banned', 'Chatmessages', ),
        self::TYPE_CAMELNAME     => array('username', 'password', 'passwordMod', 'passwordModCoockie', 'id', 'mail', 'class', 'classcustomname', 'avatar', 'about', 'regDate', 'pozdrav', 'brPesni', 'rajdane', 'prevodi', 'autoplay', 'skype', 'activityPoints', 'banned', 'chatmessages', ),
        self::TYPE_COLNAME       => array(UsersTableMap::COL_USERNAME, UsersTableMap::COL_PASSWORD, UsersTableMap::COL_PASSWORD_MOD, UsersTableMap::COL_PASSWORD_MOD_COOCKIE, UsersTableMap::COL_ID, UsersTableMap::COL_MAIL, UsersTableMap::COL_CLASS, UsersTableMap::COL_CLASSCUSTOMNAME, UsersTableMap::COL_AVATAR, UsersTableMap::COL_ABOUT, UsersTableMap::COL_REG_DATE, UsersTableMap::COL_POZDRAV, UsersTableMap::COL_BR_PESNI, UsersTableMap::COL_RAJDANE, UsersTableMap::COL_PREVODI, UsersTableMap::COL_AUTOPLAY, UsersTableMap::COL_SKYPE, UsersTableMap::COL_ACTIVITY_POINTS, UsersTableMap::COL_BANNED, UsersTableMap::COL_CHATMESSAGES, ),
        self::TYPE_FIELDNAME     => array('username', 'password', 'password_mod', 'password_mod_coockie', 'id', 'mail', 'class', 'classCustomName', 'avatar', 'about', 'reg_date', 'pozdrav', 'br_pesni', 'rajdane', 'prevodi', 'autoplay', 'skype', 'activity_points', 'banned', 'chatMessages', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Username' => 0, 'Password' => 1, 'PasswordMod' => 2, 'PasswordModCoockie' => 3, 'Id' => 4, 'Mail' => 5, 'Class' => 6, 'Classcustomname' => 7, 'Avatar' => 8, 'About' => 9, 'RegDate' => 10, 'Pozdrav' => 11, 'BrPesni' => 12, 'Rajdane' => 13, 'Prevodi' => 14, 'Autoplay' => 15, 'Skype' => 16, 'ActivityPoints' => 17, 'Banned' => 18, 'Chatmessages' => 19, ),
        self::TYPE_CAMELNAME     => array('username' => 0, 'password' => 1, 'passwordMod' => 2, 'passwordModCoockie' => 3, 'id' => 4, 'mail' => 5, 'class' => 6, 'classcustomname' => 7, 'avatar' => 8, 'about' => 9, 'regDate' => 10, 'pozdrav' => 11, 'brPesni' => 12, 'rajdane' => 13, 'prevodi' => 14, 'autoplay' => 15, 'skype' => 16, 'activityPoints' => 17, 'banned' => 18, 'chatmessages' => 19, ),
        self::TYPE_COLNAME       => array(UsersTableMap::COL_USERNAME => 0, UsersTableMap::COL_PASSWORD => 1, UsersTableMap::COL_PASSWORD_MOD => 2, UsersTableMap::COL_PASSWORD_MOD_COOCKIE => 3, UsersTableMap::COL_ID => 4, UsersTableMap::COL_MAIL => 5, UsersTableMap::COL_CLASS => 6, UsersTableMap::COL_CLASSCUSTOMNAME => 7, UsersTableMap::COL_AVATAR => 8, UsersTableMap::COL_ABOUT => 9, UsersTableMap::COL_REG_DATE => 10, UsersTableMap::COL_POZDRAV => 11, UsersTableMap::COL_BR_PESNI => 12, UsersTableMap::COL_RAJDANE => 13, UsersTableMap::COL_PREVODI => 14, UsersTableMap::COL_AUTOPLAY => 15, UsersTableMap::COL_SKYPE => 16, UsersTableMap::COL_ACTIVITY_POINTS => 17, UsersTableMap::COL_BANNED => 18, UsersTableMap::COL_CHATMESSAGES => 19, ),
        self::TYPE_FIELDNAME     => array('username' => 0, 'password' => 1, 'password_mod' => 2, 'password_mod_coockie' => 3, 'id' => 4, 'mail' => 5, 'class' => 6, 'classCustomName' => 7, 'avatar' => 8, 'about' => 9, 'reg_date' => 10, 'pozdrav' => 11, 'br_pesni' => 12, 'rajdane' => 13, 'prevodi' => 14, 'autoplay' => 15, 'skype' => 16, 'activity_points' => 17, 'banned' => 18, 'chatMessages' => 19, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, )
    );

    /**
     * Initialize the table attributes and columns
     * Relations are not initialized by this method since they are lazy loaded
     *
     * @return void
     * @throws PropelException
     */
    public function initialize()
    {
        // attributes
        $this->setName('users');
        $this->setPhpName('Users');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Tekstove\\TekstoveBundle\\Model\\Entity\\Users');
        $this->setPackage('Tekstove.TekstoveBundle.Model.Entity');
        $this->setUseIdGenerator(true);
        // columns
        $this->addColumn('username', 'Username', 'VARCHAR', true, 30, null);
        $this->addColumn('password', 'Password', 'VARCHAR', true, 32, null);
        $this->addColumn('password_mod', 'PasswordMod', 'VARCHAR', true, 32, null);
        $this->addColumn('password_mod_coockie', 'PasswordModCoockie', 'VARCHAR', true, 32, null);
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('mail', 'Mail', 'VARCHAR', true, 37, null);
        $this->addColumn('class', 'Class', 'INTEGER', true, null, 0);
        $this->addColumn('classCustomName', 'Classcustomname', 'VARCHAR', false, 255, null);
        $this->addColumn('avatar', 'Avatar', 'VARCHAR', false, 100, null);
        $this->addColumn('about', 'About', 'LONGVARCHAR', true, null, null);
        $this->addColumn('reg_date', 'RegDate', 'TIMESTAMP', true, null, 'CURRENT_TIMESTAMP');
        $this->addColumn('pozdrav', 'Pozdrav', 'INTEGER', true, null, null);
        $this->addColumn('br_pesni', 'BrPesni', 'INTEGER', true, null, null);
        $this->addColumn('rajdane', 'Rajdane', 'VARCHAR', true, 8, null);
        $this->addColumn('prevodi', 'Prevodi', 'INTEGER', true, 10, null);
        $this->addColumn('autoplay', 'Autoplay', 'SMALLINT', true, 1, 1);
        $this->addColumn('skype', 'Skype', 'VARCHAR', true, 50, null);
        $this->addColumn('activity_points', 'ActivityPoints', 'INTEGER', true, 10, null);
        $this->addColumn('banned', 'Banned', 'TIMESTAMP', false, null, null);
        $this->addColumn('chatMessages', 'Chatmessages', 'INTEGER', true, 10, 0);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('ChatOnline', '\\Tekstove\\TekstoveBundle\\Model\\Entity\\ChatOnline', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':userId',
    1 => ':id',
  ),
), null, null, 'ChatOnlines', false);
        $this->addRelation('ForumTopicWatchers', '\\Tekstove\\TekstoveBundle\\Model\\Entity\\ForumTopicWatchers', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':user_id',
    1 => ':id',
  ),
), null, null, 'ForumTopicWatcherss', false);
        $this->addRelation('PermissionGroupUsers', '\\Tekstove\\TekstoveBundle\\Model\\Entity\\PermissionGroupUsers', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':userId',
    1 => ':id',
  ),
), null, null, 'PermissionGroupUserss', false);
        $this->addRelation('PermissionUsers', '\\Tekstove\\TekstoveBundle\\Model\\Entity\\PermissionUsers', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':userId',
    1 => ':id',
  ),
), null, null, 'PermissionUserss', false);
        $this->addRelation('Prevodi', '\\Tekstove\\TekstoveBundle\\Model\\Entity\\Prevodi', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':user_id',
    1 => ':id',
  ),
), null, null, 'Prevodis', false);
    } // buildRelations()

    /**
     * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
     *
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, a serialize()d version of the primary key will be returned.
     *
     * @param array  $row       resultset row.
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return string The primary key hash of the row
     */
    public static function getPrimaryKeyHashFromRow($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        // If the PK cannot be derived from the row, return NULL.
        if ($row[TableMap::TYPE_NUM == $indexType ? 4 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return (string) $row[TableMap::TYPE_NUM == $indexType ? 4 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
    }

    /**
     * Retrieves the primary key from the DB resultset row
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, an array of the primary key columns will be returned.
     *
     * @param array  $row       resultset row.
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return mixed The primary key of the row
     */
    public static function getPrimaryKeyFromRow($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        return (int) $row[
            $indexType == TableMap::TYPE_NUM
                ? 4 + $offset
                : self::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)
        ];
    }

    /**
     * The class that the tableMap will make instances of.
     *
     * If $withPrefix is true, the returned path
     * uses a dot-path notation which is translated into a path
     * relative to a location on the PHP include_path.
     * (e.g. path.to.MyClass -> 'path/to/MyClass.php')
     *
     * @param boolean $withPrefix Whether or not to return the path with the class name
     * @return string path.to.ClassName
     */
    public static function getOMClass($withPrefix = true)
    {
        return $withPrefix ? UsersTableMap::CLASS_DEFAULT : UsersTableMap::OM_CLASS;
    }

    /**
     * Populates an object of the default type or an object that inherit from the default.
     *
     * @param array  $row       row returned by DataFetcher->fetch().
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType The index type of $row. Mostly DataFetcher->getIndexType().
                                 One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     * @return array           (Users object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = UsersTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = UsersTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + UsersTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = UsersTableMap::OM_CLASS;
            /** @var Users $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            UsersTableMap::addInstanceToPool($obj, $key);
        }

        return array($obj, $col);
    }

    /**
     * The returned array will contain objects of the default type or
     * objects that inherit from the default.
     *
     * @param DataFetcherInterface $dataFetcher
     * @return array
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function populateObjects(DataFetcherInterface $dataFetcher)
    {
        $results = array();

        // set the class once to avoid overhead in the loop
        $cls = static::getOMClass(false);
        // populate the object(s)
        while ($row = $dataFetcher->fetch()) {
            $key = UsersTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = UsersTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Users $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                UsersTableMap::addInstanceToPool($obj, $key);
            } // if key exists
        }

        return $results;
    }
    /**
     * Add all the columns needed to create a new object.
     *
     * Note: any columns that were marked with lazyLoad="true" in the
     * XML schema will not be added to the select list and only loaded
     * on demand.
     *
     * @param Criteria $criteria object containing the columns to add.
     * @param string   $alias    optional table alias
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function addSelectColumns(Criteria $criteria, $alias = null)
    {
        if (null === $alias) {
            $criteria->addSelectColumn(UsersTableMap::COL_USERNAME);
            $criteria->addSelectColumn(UsersTableMap::COL_PASSWORD);
            $criteria->addSelectColumn(UsersTableMap::COL_PASSWORD_MOD);
            $criteria->addSelectColumn(UsersTableMap::COL_PASSWORD_MOD_COOCKIE);
            $criteria->addSelectColumn(UsersTableMap::COL_ID);
            $criteria->addSelectColumn(UsersTableMap::COL_MAIL);
            $criteria->addSelectColumn(UsersTableMap::COL_CLASS);
            $criteria->addSelectColumn(UsersTableMap::COL_CLASSCUSTOMNAME);
            $criteria->addSelectColumn(UsersTableMap::COL_AVATAR);
            $criteria->addSelectColumn(UsersTableMap::COL_ABOUT);
            $criteria->addSelectColumn(UsersTableMap::COL_REG_DATE);
            $criteria->addSelectColumn(UsersTableMap::COL_POZDRAV);
            $criteria->addSelectColumn(UsersTableMap::COL_BR_PESNI);
            $criteria->addSelectColumn(UsersTableMap::COL_RAJDANE);
            $criteria->addSelectColumn(UsersTableMap::COL_PREVODI);
            $criteria->addSelectColumn(UsersTableMap::COL_AUTOPLAY);
            $criteria->addSelectColumn(UsersTableMap::COL_SKYPE);
            $criteria->addSelectColumn(UsersTableMap::COL_ACTIVITY_POINTS);
            $criteria->addSelectColumn(UsersTableMap::COL_BANNED);
            $criteria->addSelectColumn(UsersTableMap::COL_CHATMESSAGES);
        } else {
            $criteria->addSelectColumn($alias . '.username');
            $criteria->addSelectColumn($alias . '.password');
            $criteria->addSelectColumn($alias . '.password_mod');
            $criteria->addSelectColumn($alias . '.password_mod_coockie');
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.mail');
            $criteria->addSelectColumn($alias . '.class');
            $criteria->addSelectColumn($alias . '.classCustomName');
            $criteria->addSelectColumn($alias . '.avatar');
            $criteria->addSelectColumn($alias . '.about');
            $criteria->addSelectColumn($alias . '.reg_date');
            $criteria->addSelectColumn($alias . '.pozdrav');
            $criteria->addSelectColumn($alias . '.br_pesni');
            $criteria->addSelectColumn($alias . '.rajdane');
            $criteria->addSelectColumn($alias . '.prevodi');
            $criteria->addSelectColumn($alias . '.autoplay');
            $criteria->addSelectColumn($alias . '.skype');
            $criteria->addSelectColumn($alias . '.activity_points');
            $criteria->addSelectColumn($alias . '.banned');
            $criteria->addSelectColumn($alias . '.chatMessages');
        }
    }

    /**
     * Returns the TableMap related to this object.
     * This method is not needed for general use but a specific application could have a need.
     * @return TableMap
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function getTableMap()
    {
        return Propel::getServiceContainer()->getDatabaseMap(UsersTableMap::DATABASE_NAME)->getTable(UsersTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(UsersTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(UsersTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new UsersTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a Users or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or Users object or primary key or array of primary keys
     *              which is used to create the DELETE statement
     * @param  ConnectionInterface $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
     public static function doDelete($values, ConnectionInterface $con = null)
     {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(UsersTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Tekstove\TekstoveBundle\Model\Entity\Users) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(UsersTableMap::DATABASE_NAME);
            $criteria->add(UsersTableMap::COL_ID, (array) $values, Criteria::IN);
        }

        $query = UsersQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            UsersTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                UsersTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the users table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return UsersQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Users or Criteria object.
     *
     * @param mixed               $criteria Criteria or Users object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(UsersTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Users object
        }

        if ($criteria->containsKey(UsersTableMap::COL_ID) && $criteria->keyContainsValue(UsersTableMap::COL_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.UsersTableMap::COL_ID.')');
        }


        // Set the correct dbName
        $query = UsersQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // UsersTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
UsersTableMap::buildTableMap();
