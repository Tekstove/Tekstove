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
use Tekstove\TekstoveBundle\Model\Entity\Chat;
use Tekstove\TekstoveBundle\Model\Entity\ChatQuery;


/**
 * This class defines the structure of the 'chat' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class ChatTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'src.Tekstove.TekstoveBundle.Model.Entity.Map.ChatTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'chat';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\Tekstove\\TekstoveBundle\\Model\\Entity\\Chat';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'src.Tekstove.TekstoveBundle.Model.Entity.Chat';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 9;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 9;

    /**
     * the column name for the id field
     */
    const COL_ID = 'chat.id';

    /**
     * the column name for the message field
     */
    const COL_MESSAGE = 'chat.message';

    /**
     * the column name for the username_id field
     */
    const COL_USERNAME_ID = 'chat.username_id';

    /**
     * the column name for the username_name field
     */
    const COL_USERNAME_NAME = 'chat.username_name';

    /**
     * the column name for the username_mood field
     */
    const COL_USERNAME_MOOD = 'chat.username_mood';

    /**
     * the column name for the date field
     */
    const COL_DATE = 'chat.date';

    /**
     * the column name for the ip field
     */
    const COL_IP = 'chat.ip';

    /**
     * the column name for the lastEdit field
     */
    const COL_LASTEDIT = 'chat.lastEdit';

    /**
     * the column name for the allowBan field
     */
    const COL_ALLOWBAN = 'chat.allowBan';

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
        self::TYPE_PHPNAME       => array('Id', 'Message', 'UsernameId', 'UsernameName', 'UsernameMood', 'Date', 'Ip', 'Lastedit', 'Allowban', ),
        self::TYPE_CAMELNAME     => array('id', 'message', 'usernameId', 'usernameName', 'usernameMood', 'date', 'ip', 'lastedit', 'allowban', ),
        self::TYPE_COLNAME       => array(ChatTableMap::COL_ID, ChatTableMap::COL_MESSAGE, ChatTableMap::COL_USERNAME_ID, ChatTableMap::COL_USERNAME_NAME, ChatTableMap::COL_USERNAME_MOOD, ChatTableMap::COL_DATE, ChatTableMap::COL_IP, ChatTableMap::COL_LASTEDIT, ChatTableMap::COL_ALLOWBAN, ),
        self::TYPE_FIELDNAME     => array('id', 'message', 'username_id', 'username_name', 'username_mood', 'date', 'ip', 'lastEdit', 'allowBan', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Id' => 0, 'Message' => 1, 'UsernameId' => 2, 'UsernameName' => 3, 'UsernameMood' => 4, 'Date' => 5, 'Ip' => 6, 'Lastedit' => 7, 'Allowban' => 8, ),
        self::TYPE_CAMELNAME     => array('id' => 0, 'message' => 1, 'usernameId' => 2, 'usernameName' => 3, 'usernameMood' => 4, 'date' => 5, 'ip' => 6, 'lastedit' => 7, 'allowban' => 8, ),
        self::TYPE_COLNAME       => array(ChatTableMap::COL_ID => 0, ChatTableMap::COL_MESSAGE => 1, ChatTableMap::COL_USERNAME_ID => 2, ChatTableMap::COL_USERNAME_NAME => 3, ChatTableMap::COL_USERNAME_MOOD => 4, ChatTableMap::COL_DATE => 5, ChatTableMap::COL_IP => 6, ChatTableMap::COL_LASTEDIT => 7, ChatTableMap::COL_ALLOWBAN => 8, ),
        self::TYPE_FIELDNAME     => array('id' => 0, 'message' => 1, 'username_id' => 2, 'username_name' => 3, 'username_mood' => 4, 'date' => 5, 'ip' => 6, 'lastEdit' => 7, 'allowBan' => 8, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, )
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
        $this->setName('chat');
        $this->setPhpName('Chat');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Tekstove\\TekstoveBundle\\Model\\Entity\\Chat');
        $this->setPackage('src.Tekstove.TekstoveBundle.Model.Entity');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('message', 'Message', 'LONGVARCHAR', true, null, null);
        $this->addColumn('username_id', 'UsernameId', 'INTEGER', false, null, null);
        $this->addColumn('username_name', 'UsernameName', 'VARCHAR', true, 30, null);
        $this->addColumn('username_mood', 'UsernameMood', 'VARCHAR', false, 20, null);
        $this->addColumn('date', 'Date', 'TIMESTAMP', true, null, 'CURRENT_TIMESTAMP');
        $this->addColumn('ip', 'Ip', 'VARCHAR', true, 50, null);
        $this->addColumn('lastEdit', 'Lastedit', 'TIMESTAMP', false, null, null);
        $this->addColumn('allowBan', 'Allowban', 'TINYINT', true, null, 0);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
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
                ? 0 + $offset
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
        return $withPrefix ? ChatTableMap::CLASS_DEFAULT : ChatTableMap::OM_CLASS;
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
     * @return array           (Chat object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = ChatTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = ChatTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + ChatTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = ChatTableMap::OM_CLASS;
            /** @var Chat $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            ChatTableMap::addInstanceToPool($obj, $key);
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
            $key = ChatTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = ChatTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Chat $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                ChatTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(ChatTableMap::COL_ID);
            $criteria->addSelectColumn(ChatTableMap::COL_MESSAGE);
            $criteria->addSelectColumn(ChatTableMap::COL_USERNAME_ID);
            $criteria->addSelectColumn(ChatTableMap::COL_USERNAME_NAME);
            $criteria->addSelectColumn(ChatTableMap::COL_USERNAME_MOOD);
            $criteria->addSelectColumn(ChatTableMap::COL_DATE);
            $criteria->addSelectColumn(ChatTableMap::COL_IP);
            $criteria->addSelectColumn(ChatTableMap::COL_LASTEDIT);
            $criteria->addSelectColumn(ChatTableMap::COL_ALLOWBAN);
        } else {
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.message');
            $criteria->addSelectColumn($alias . '.username_id');
            $criteria->addSelectColumn($alias . '.username_name');
            $criteria->addSelectColumn($alias . '.username_mood');
            $criteria->addSelectColumn($alias . '.date');
            $criteria->addSelectColumn($alias . '.ip');
            $criteria->addSelectColumn($alias . '.lastEdit');
            $criteria->addSelectColumn($alias . '.allowBan');
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
        return Propel::getServiceContainer()->getDatabaseMap(ChatTableMap::DATABASE_NAME)->getTable(ChatTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(ChatTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(ChatTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new ChatTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a Chat or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or Chat object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(ChatTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Tekstove\TekstoveBundle\Model\Entity\Chat) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(ChatTableMap::DATABASE_NAME);
            $criteria->add(ChatTableMap::COL_ID, (array) $values, Criteria::IN);
        }

        $query = ChatQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            ChatTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                ChatTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the chat table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return ChatQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Chat or Criteria object.
     *
     * @param mixed               $criteria Criteria or Chat object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ChatTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Chat object
        }

        if ($criteria->containsKey(ChatTableMap::COL_ID) && $criteria->keyContainsValue(ChatTableMap::COL_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.ChatTableMap::COL_ID.')');
        }


        // Set the correct dbName
        $query = ChatQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // ChatTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
ChatTableMap::buildTableMap();
