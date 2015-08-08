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
use Tekstove\TekstoveBundle\Model\Entity\ForumRazdel;
use Tekstove\TekstoveBundle\Model\Entity\ForumRazdelQuery;


/**
 * This class defines the structure of the 'forum_razdel' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class ForumRazdelTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'Tekstove.TekstoveBundle.Model.Entity.Map.ForumRazdelTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'forum_razdel';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\Tekstove\\TekstoveBundle\\Model\\Entity\\ForumRazdel';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'Tekstove.TekstoveBundle.Model.Entity.ForumRazdel';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 4;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 4;

    /**
     * the column name for the name field
     */
    const COL_NAME = 'forum_razdel.name';

    /**
     * the column name for the podredba field
     */
    const COL_PODREDBA = 'forum_razdel.podredba';

    /**
     * the column name for the id field
     */
    const COL_ID = 'forum_razdel.id';

    /**
     * the column name for the hidden field
     */
    const COL_HIDDEN = 'forum_razdel.hidden';

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
        self::TYPE_PHPNAME       => array('Name', 'Podredba', 'Id', 'Hidden', ),
        self::TYPE_CAMELNAME     => array('name', 'podredba', 'id', 'hidden', ),
        self::TYPE_COLNAME       => array(ForumRazdelTableMap::COL_NAME, ForumRazdelTableMap::COL_PODREDBA, ForumRazdelTableMap::COL_ID, ForumRazdelTableMap::COL_HIDDEN, ),
        self::TYPE_FIELDNAME     => array('name', 'podredba', 'id', 'hidden', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Name' => 0, 'Podredba' => 1, 'Id' => 2, 'Hidden' => 3, ),
        self::TYPE_CAMELNAME     => array('name' => 0, 'podredba' => 1, 'id' => 2, 'hidden' => 3, ),
        self::TYPE_COLNAME       => array(ForumRazdelTableMap::COL_NAME => 0, ForumRazdelTableMap::COL_PODREDBA => 1, ForumRazdelTableMap::COL_ID => 2, ForumRazdelTableMap::COL_HIDDEN => 3, ),
        self::TYPE_FIELDNAME     => array('name' => 0, 'podredba' => 1, 'id' => 2, 'hidden' => 3, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, )
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
        $this->setName('forum_razdel');
        $this->setPhpName('ForumRazdel');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Tekstove\\TekstoveBundle\\Model\\Entity\\ForumRazdel');
        $this->setPackage('Tekstove.TekstoveBundle.Model.Entity');
        $this->setUseIdGenerator(true);
        // columns
        $this->addColumn('name', 'Name', 'VARCHAR', true, 50, null);
        $this->addColumn('podredba', 'Podredba', 'BOOLEAN', true, 1, null);
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('hidden', 'Hidden', 'BOOLEAN', true, 1, false);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('ForumTopic', '\\Tekstove\\TekstoveBundle\\Model\\Entity\\ForumTopic', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':topic_razdel',
    1 => ':id',
  ),
), 'CASCADE', null, 'ForumTopics', false);
    } // buildRelations()
    /**
     * Method to invalidate the instance pool of all tables related to forum_razdel     * by a foreign key with ON DELETE CASCADE
     */
    public static function clearRelatedInstancePool()
    {
        // Invalidate objects in related instance pools,
        // since one or more of them may be deleted by ON DELETE CASCADE/SETNULL rule.
        ForumTopicTableMap::clearInstancePool();
    }

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
        if ($row[TableMap::TYPE_NUM == $indexType ? 2 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return (string) $row[TableMap::TYPE_NUM == $indexType ? 2 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
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
                ? 2 + $offset
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
        return $withPrefix ? ForumRazdelTableMap::CLASS_DEFAULT : ForumRazdelTableMap::OM_CLASS;
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
     * @return array           (ForumRazdel object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = ForumRazdelTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = ForumRazdelTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + ForumRazdelTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = ForumRazdelTableMap::OM_CLASS;
            /** @var ForumRazdel $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            ForumRazdelTableMap::addInstanceToPool($obj, $key);
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
            $key = ForumRazdelTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = ForumRazdelTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var ForumRazdel $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                ForumRazdelTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(ForumRazdelTableMap::COL_NAME);
            $criteria->addSelectColumn(ForumRazdelTableMap::COL_PODREDBA);
            $criteria->addSelectColumn(ForumRazdelTableMap::COL_ID);
            $criteria->addSelectColumn(ForumRazdelTableMap::COL_HIDDEN);
        } else {
            $criteria->addSelectColumn($alias . '.name');
            $criteria->addSelectColumn($alias . '.podredba');
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.hidden');
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
        return Propel::getServiceContainer()->getDatabaseMap(ForumRazdelTableMap::DATABASE_NAME)->getTable(ForumRazdelTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(ForumRazdelTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(ForumRazdelTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new ForumRazdelTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a ForumRazdel or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or ForumRazdel object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(ForumRazdelTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Tekstove\TekstoveBundle\Model\Entity\ForumRazdel) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(ForumRazdelTableMap::DATABASE_NAME);
            $criteria->add(ForumRazdelTableMap::COL_ID, (array) $values, Criteria::IN);
        }

        $query = ForumRazdelQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            ForumRazdelTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                ForumRazdelTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the forum_razdel table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return ForumRazdelQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a ForumRazdel or Criteria object.
     *
     * @param mixed               $criteria Criteria or ForumRazdel object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ForumRazdelTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from ForumRazdel object
        }

        if ($criteria->containsKey(ForumRazdelTableMap::COL_ID) && $criteria->keyContainsValue(ForumRazdelTableMap::COL_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.ForumRazdelTableMap::COL_ID.')');
        }


        // Set the correct dbName
        $query = ForumRazdelQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // ForumRazdelTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
ForumRazdelTableMap::buildTableMap();
