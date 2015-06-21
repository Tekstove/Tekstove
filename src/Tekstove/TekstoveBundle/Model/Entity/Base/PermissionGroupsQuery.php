<?php

namespace Tekstove\TekstoveBundle\Model\Entity\Base;

use \Exception;
use \PDO;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;
use Tekstove\TekstoveBundle\Model\Entity\PermissionGroups as ChildPermissionGroups;
use Tekstove\TekstoveBundle\Model\Entity\PermissionGroupsQuery as ChildPermissionGroupsQuery;
use Tekstove\TekstoveBundle\Model\Entity\Map\PermissionGroupsTableMap;

/**
 * Base class that represents a query for the 'permission_groups' table.
 *
 *
 *
 * @method     ChildPermissionGroupsQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildPermissionGroupsQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method     ChildPermissionGroupsQuery orderByImage($order = Criteria::ASC) Order by the image column
 *
 * @method     ChildPermissionGroupsQuery groupById() Group by the id column
 * @method     ChildPermissionGroupsQuery groupByName() Group by the name column
 * @method     ChildPermissionGroupsQuery groupByImage() Group by the image column
 *
 * @method     ChildPermissionGroupsQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildPermissionGroupsQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildPermissionGroupsQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildPermissionGroupsQuery leftJoinPermissionGroupPermissions($relationAlias = null) Adds a LEFT JOIN clause to the query using the PermissionGroupPermissions relation
 * @method     ChildPermissionGroupsQuery rightJoinPermissionGroupPermissions($relationAlias = null) Adds a RIGHT JOIN clause to the query using the PermissionGroupPermissions relation
 * @method     ChildPermissionGroupsQuery innerJoinPermissionGroupPermissions($relationAlias = null) Adds a INNER JOIN clause to the query using the PermissionGroupPermissions relation
 *
 * @method     ChildPermissionGroupsQuery leftJoinPermissionGroupUsers($relationAlias = null) Adds a LEFT JOIN clause to the query using the PermissionGroupUsers relation
 * @method     ChildPermissionGroupsQuery rightJoinPermissionGroupUsers($relationAlias = null) Adds a RIGHT JOIN clause to the query using the PermissionGroupUsers relation
 * @method     ChildPermissionGroupsQuery innerJoinPermissionGroupUsers($relationAlias = null) Adds a INNER JOIN clause to the query using the PermissionGroupUsers relation
 *
 * @method     \Tekstove\TekstoveBundle\Model\Entity\PermissionGroupPermissionsQuery|\Tekstove\TekstoveBundle\Model\Entity\PermissionGroupUsersQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildPermissionGroups findOne(ConnectionInterface $con = null) Return the first ChildPermissionGroups matching the query
 * @method     ChildPermissionGroups findOneOrCreate(ConnectionInterface $con = null) Return the first ChildPermissionGroups matching the query, or a new ChildPermissionGroups object populated from the query conditions when no match is found
 *
 * @method     ChildPermissionGroups findOneById(int $id) Return the first ChildPermissionGroups filtered by the id column
 * @method     ChildPermissionGroups findOneByName(string $name) Return the first ChildPermissionGroups filtered by the name column
 * @method     ChildPermissionGroups findOneByImage(string $image) Return the first ChildPermissionGroups filtered by the image column *

 * @method     ChildPermissionGroups requirePk($key, ConnectionInterface $con = null) Return the ChildPermissionGroups by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPermissionGroups requireOne(ConnectionInterface $con = null) Return the first ChildPermissionGroups matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildPermissionGroups requireOneById(int $id) Return the first ChildPermissionGroups filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPermissionGroups requireOneByName(string $name) Return the first ChildPermissionGroups filtered by the name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPermissionGroups requireOneByImage(string $image) Return the first ChildPermissionGroups filtered by the image column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildPermissionGroups[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildPermissionGroups objects based on current ModelCriteria
 * @method     ChildPermissionGroups[]|ObjectCollection findById(int $id) Return ChildPermissionGroups objects filtered by the id column
 * @method     ChildPermissionGroups[]|ObjectCollection findByName(string $name) Return ChildPermissionGroups objects filtered by the name column
 * @method     ChildPermissionGroups[]|ObjectCollection findByImage(string $image) Return ChildPermissionGroups objects filtered by the image column
 * @method     ChildPermissionGroups[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class PermissionGroupsQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Tekstove\TekstoveBundle\Model\Entity\Base\PermissionGroupsQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\Tekstove\\TekstoveBundle\\Model\\Entity\\PermissionGroups', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildPermissionGroupsQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildPermissionGroupsQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildPermissionGroupsQuery) {
            return $criteria;
        }
        $query = new ChildPermissionGroupsQuery();
        if (null !== $modelAlias) {
            $query->setModelAlias($modelAlias);
        }
        if ($criteria instanceof Criteria) {
            $query->mergeWith($criteria);
        }

        return $query;
    }

    /**
     * Find object by primary key.
     * Propel uses the instance pool to skip the database if the object exists.
     * Go fast if the query is untouched.
     *
     * <code>
     * $obj  = $c->findPk(12, $con);
     * </code>
     *
     * @param mixed $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildPermissionGroups|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = PermissionGroupsTableMap::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(PermissionGroupsTableMap::DATABASE_NAME);
        }
        $this->basePreSelect($con);
        if ($this->formatter || $this->modelAlias || $this->with || $this->select
         || $this->selectColumns || $this->asColumns || $this->selectModifiers
         || $this->map || $this->having || $this->joins) {
            return $this->findPkComplex($key, $con);
        } else {
            return $this->findPkSimple($key, $con);
        }
    }

    /**
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildPermissionGroups A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, name, image FROM permission_groups WHERE id = :p0';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key, PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildPermissionGroups $obj */
            $obj = new ChildPermissionGroups();
            $obj->hydrate($row);
            PermissionGroupsTableMap::addInstanceToPool($obj, (string) $key);
        }
        $stmt->closeCursor();

        return $obj;
    }

    /**
     * Find object by primary key.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @return ChildPermissionGroups|array|mixed the result, formatted by the current formatter
     */
    protected function findPkComplex($key, ConnectionInterface $con)
    {
        // As the query uses a PK condition, no limit(1) is necessary.
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKey($key)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->formatOne($dataFetcher);
    }

    /**
     * Find objects by primary key
     * <code>
     * $objs = $c->findPks(array(12, 56, 832), $con);
     * </code>
     * @param     array $keys Primary keys to use for the query
     * @param     ConnectionInterface $con an optional connection object
     *
     * @return ObjectCollection|array|mixed the list of results, formatted by the current formatter
     */
    public function findPks($keys, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getReadConnection($this->getDbName());
        }
        $this->basePreSelect($con);
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKeys($keys)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->format($dataFetcher);
    }

    /**
     * Filter the query by primary key
     *
     * @param     mixed $key Primary key to use for the query
     *
     * @return $this|ChildPermissionGroupsQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(PermissionGroupsTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildPermissionGroupsQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(PermissionGroupsTableMap::COL_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the id column
     *
     * Example usage:
     * <code>
     * $query->filterById(1234); // WHERE id = 1234
     * $query->filterById(array(12, 34)); // WHERE id IN (12, 34)
     * $query->filterById(array('min' => 12)); // WHERE id > 12
     * </code>
     *
     * @param     mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPermissionGroupsQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(PermissionGroupsTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(PermissionGroupsTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PermissionGroupsTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the name column
     *
     * Example usage:
     * <code>
     * $query->filterByName('fooValue');   // WHERE name = 'fooValue'
     * $query->filterByName('%fooValue%'); // WHERE name LIKE '%fooValue%'
     * </code>
     *
     * @param     string $name The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPermissionGroupsQuery The current query, for fluid interface
     */
    public function filterByName($name = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($name)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $name)) {
                $name = str_replace('*', '%', $name);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(PermissionGroupsTableMap::COL_NAME, $name, $comparison);
    }

    /**
     * Filter the query on the image column
     *
     * Example usage:
     * <code>
     * $query->filterByImage('fooValue');   // WHERE image = 'fooValue'
     * $query->filterByImage('%fooValue%'); // WHERE image LIKE '%fooValue%'
     * </code>
     *
     * @param     string $image The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPermissionGroupsQuery The current query, for fluid interface
     */
    public function filterByImage($image = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($image)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $image)) {
                $image = str_replace('*', '%', $image);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(PermissionGroupsTableMap::COL_IMAGE, $image, $comparison);
    }

    /**
     * Filter the query by a related \Tekstove\TekstoveBundle\Model\Entity\PermissionGroupPermissions object
     *
     * @param \Tekstove\TekstoveBundle\Model\Entity\PermissionGroupPermissions|ObjectCollection $permissionGroupPermissions the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildPermissionGroupsQuery The current query, for fluid interface
     */
    public function filterByPermissionGroupPermissions($permissionGroupPermissions, $comparison = null)
    {
        if ($permissionGroupPermissions instanceof \Tekstove\TekstoveBundle\Model\Entity\PermissionGroupPermissions) {
            return $this
                ->addUsingAlias(PermissionGroupsTableMap::COL_ID, $permissionGroupPermissions->getGroupid(), $comparison);
        } elseif ($permissionGroupPermissions instanceof ObjectCollection) {
            return $this
                ->usePermissionGroupPermissionsQuery()
                ->filterByPrimaryKeys($permissionGroupPermissions->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByPermissionGroupPermissions() only accepts arguments of type \Tekstove\TekstoveBundle\Model\Entity\PermissionGroupPermissions or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the PermissionGroupPermissions relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildPermissionGroupsQuery The current query, for fluid interface
     */
    public function joinPermissionGroupPermissions($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('PermissionGroupPermissions');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'PermissionGroupPermissions');
        }

        return $this;
    }

    /**
     * Use the PermissionGroupPermissions relation PermissionGroupPermissions object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Tekstove\TekstoveBundle\Model\Entity\PermissionGroupPermissionsQuery A secondary query class using the current class as primary query
     */
    public function usePermissionGroupPermissionsQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinPermissionGroupPermissions($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'PermissionGroupPermissions', '\Tekstove\TekstoveBundle\Model\Entity\PermissionGroupPermissionsQuery');
    }

    /**
     * Filter the query by a related \Tekstove\TekstoveBundle\Model\Entity\PermissionGroupUsers object
     *
     * @param \Tekstove\TekstoveBundle\Model\Entity\PermissionGroupUsers|ObjectCollection $permissionGroupUsers the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildPermissionGroupsQuery The current query, for fluid interface
     */
    public function filterByPermissionGroupUsers($permissionGroupUsers, $comparison = null)
    {
        if ($permissionGroupUsers instanceof \Tekstove\TekstoveBundle\Model\Entity\PermissionGroupUsers) {
            return $this
                ->addUsingAlias(PermissionGroupsTableMap::COL_ID, $permissionGroupUsers->getGroupid(), $comparison);
        } elseif ($permissionGroupUsers instanceof ObjectCollection) {
            return $this
                ->usePermissionGroupUsersQuery()
                ->filterByPrimaryKeys($permissionGroupUsers->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByPermissionGroupUsers() only accepts arguments of type \Tekstove\TekstoveBundle\Model\Entity\PermissionGroupUsers or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the PermissionGroupUsers relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildPermissionGroupsQuery The current query, for fluid interface
     */
    public function joinPermissionGroupUsers($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('PermissionGroupUsers');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'PermissionGroupUsers');
        }

        return $this;
    }

    /**
     * Use the PermissionGroupUsers relation PermissionGroupUsers object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Tekstove\TekstoveBundle\Model\Entity\PermissionGroupUsersQuery A secondary query class using the current class as primary query
     */
    public function usePermissionGroupUsersQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinPermissionGroupUsers($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'PermissionGroupUsers', '\Tekstove\TekstoveBundle\Model\Entity\PermissionGroupUsersQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildPermissionGroups $permissionGroups Object to remove from the list of results
     *
     * @return $this|ChildPermissionGroupsQuery The current query, for fluid interface
     */
    public function prune($permissionGroups = null)
    {
        if ($permissionGroups) {
            $this->addUsingAlias(PermissionGroupsTableMap::COL_ID, $permissionGroups->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the permission_groups table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(PermissionGroupsTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            PermissionGroupsTableMap::clearInstancePool();
            PermissionGroupsTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

    /**
     * Performs a DELETE on the database based on the current ModelCriteria
     *
     * @param ConnectionInterface $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public function delete(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(PermissionGroupsTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(PermissionGroupsTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            PermissionGroupsTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            PermissionGroupsTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // PermissionGroupsQuery
