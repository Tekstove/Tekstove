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
use Tekstove\TekstoveBundle\Model\Entity\Permissions as ChildPermissions;
use Tekstove\TekstoveBundle\Model\Entity\PermissionsQuery as ChildPermissionsQuery;
use Tekstove\TekstoveBundle\Model\Entity\Map\PermissionsTableMap;

/**
 * Base class that represents a query for the 'permissions' table.
 *
 *
 *
 * @method     ChildPermissionsQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildPermissionsQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method     ChildPermissionsQuery orderByValue($order = Criteria::ASC) Order by the value column
 *
 * @method     ChildPermissionsQuery groupById() Group by the id column
 * @method     ChildPermissionsQuery groupByName() Group by the name column
 * @method     ChildPermissionsQuery groupByValue() Group by the value column
 *
 * @method     ChildPermissionsQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildPermissionsQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildPermissionsQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildPermissionsQuery leftJoinPermissionGroupPermissions($relationAlias = null) Adds a LEFT JOIN clause to the query using the PermissionGroupPermissions relation
 * @method     ChildPermissionsQuery rightJoinPermissionGroupPermissions($relationAlias = null) Adds a RIGHT JOIN clause to the query using the PermissionGroupPermissions relation
 * @method     ChildPermissionsQuery innerJoinPermissionGroupPermissions($relationAlias = null) Adds a INNER JOIN clause to the query using the PermissionGroupPermissions relation
 *
 * @method     ChildPermissionsQuery leftJoinPermissionUsers($relationAlias = null) Adds a LEFT JOIN clause to the query using the PermissionUsers relation
 * @method     ChildPermissionsQuery rightJoinPermissionUsers($relationAlias = null) Adds a RIGHT JOIN clause to the query using the PermissionUsers relation
 * @method     ChildPermissionsQuery innerJoinPermissionUsers($relationAlias = null) Adds a INNER JOIN clause to the query using the PermissionUsers relation
 *
 * @method     \Tekstove\TekstoveBundle\Model\Entity\PermissionGroupPermissionsQuery|\Tekstove\TekstoveBundle\Model\Entity\PermissionUsersQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildPermissions findOne(ConnectionInterface $con = null) Return the first ChildPermissions matching the query
 * @method     ChildPermissions findOneOrCreate(ConnectionInterface $con = null) Return the first ChildPermissions matching the query, or a new ChildPermissions object populated from the query conditions when no match is found
 *
 * @method     ChildPermissions findOneById(int $id) Return the first ChildPermissions filtered by the id column
 * @method     ChildPermissions findOneByName(string $name) Return the first ChildPermissions filtered by the name column
 * @method     ChildPermissions findOneByValue(int $value) Return the first ChildPermissions filtered by the value column *

 * @method     ChildPermissions requirePk($key, ConnectionInterface $con = null) Return the ChildPermissions by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPermissions requireOne(ConnectionInterface $con = null) Return the first ChildPermissions matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildPermissions requireOneById(int $id) Return the first ChildPermissions filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPermissions requireOneByName(string $name) Return the first ChildPermissions filtered by the name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPermissions requireOneByValue(int $value) Return the first ChildPermissions filtered by the value column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildPermissions[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildPermissions objects based on current ModelCriteria
 * @method     ChildPermissions[]|ObjectCollection findById(int $id) Return ChildPermissions objects filtered by the id column
 * @method     ChildPermissions[]|ObjectCollection findByName(string $name) Return ChildPermissions objects filtered by the name column
 * @method     ChildPermissions[]|ObjectCollection findByValue(int $value) Return ChildPermissions objects filtered by the value column
 * @method     ChildPermissions[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class PermissionsQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Tekstove\TekstoveBundle\Model\Entity\Base\PermissionsQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\Tekstove\\TekstoveBundle\\Model\\Entity\\Permissions', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildPermissionsQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildPermissionsQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildPermissionsQuery) {
            return $criteria;
        }
        $query = new ChildPermissionsQuery();
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
     * @return ChildPermissions|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = PermissionsTableMap::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(PermissionsTableMap::DATABASE_NAME);
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
     * @return ChildPermissions A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, name, value FROM permissions WHERE id = :p0';
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
            /** @var ChildPermissions $obj */
            $obj = new ChildPermissions();
            $obj->hydrate($row);
            PermissionsTableMap::addInstanceToPool($obj, (string) $key);
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
     * @return ChildPermissions|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildPermissionsQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(PermissionsTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildPermissionsQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(PermissionsTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildPermissionsQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(PermissionsTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(PermissionsTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PermissionsTableMap::COL_ID, $id, $comparison);
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
     * @return $this|ChildPermissionsQuery The current query, for fluid interface
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

        return $this->addUsingAlias(PermissionsTableMap::COL_NAME, $name, $comparison);
    }

    /**
     * Filter the query on the value column
     *
     * Example usage:
     * <code>
     * $query->filterByValue(1234); // WHERE value = 1234
     * $query->filterByValue(array(12, 34)); // WHERE value IN (12, 34)
     * $query->filterByValue(array('min' => 12)); // WHERE value > 12
     * </code>
     *
     * @param     mixed $value The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPermissionsQuery The current query, for fluid interface
     */
    public function filterByValue($value = null, $comparison = null)
    {
        if (is_array($value)) {
            $useMinMax = false;
            if (isset($value['min'])) {
                $this->addUsingAlias(PermissionsTableMap::COL_VALUE, $value['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($value['max'])) {
                $this->addUsingAlias(PermissionsTableMap::COL_VALUE, $value['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PermissionsTableMap::COL_VALUE, $value, $comparison);
    }

    /**
     * Filter the query by a related \Tekstove\TekstoveBundle\Model\Entity\PermissionGroupPermissions object
     *
     * @param \Tekstove\TekstoveBundle\Model\Entity\PermissionGroupPermissions|ObjectCollection $permissionGroupPermissions the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildPermissionsQuery The current query, for fluid interface
     */
    public function filterByPermissionGroupPermissions($permissionGroupPermissions, $comparison = null)
    {
        if ($permissionGroupPermissions instanceof \Tekstove\TekstoveBundle\Model\Entity\PermissionGroupPermissions) {
            return $this
                ->addUsingAlias(PermissionsTableMap::COL_ID, $permissionGroupPermissions->getPermissionid(), $comparison);
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
     * @return $this|ChildPermissionsQuery The current query, for fluid interface
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
     * Filter the query by a related \Tekstove\TekstoveBundle\Model\Entity\PermissionUsers object
     *
     * @param \Tekstove\TekstoveBundle\Model\Entity\PermissionUsers|ObjectCollection $permissionUsers the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildPermissionsQuery The current query, for fluid interface
     */
    public function filterByPermissionUsers($permissionUsers, $comparison = null)
    {
        if ($permissionUsers instanceof \Tekstove\TekstoveBundle\Model\Entity\PermissionUsers) {
            return $this
                ->addUsingAlias(PermissionsTableMap::COL_ID, $permissionUsers->getPermissionid(), $comparison);
        } elseif ($permissionUsers instanceof ObjectCollection) {
            return $this
                ->usePermissionUsersQuery()
                ->filterByPrimaryKeys($permissionUsers->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByPermissionUsers() only accepts arguments of type \Tekstove\TekstoveBundle\Model\Entity\PermissionUsers or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the PermissionUsers relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildPermissionsQuery The current query, for fluid interface
     */
    public function joinPermissionUsers($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('PermissionUsers');

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
            $this->addJoinObject($join, 'PermissionUsers');
        }

        return $this;
    }

    /**
     * Use the PermissionUsers relation PermissionUsers object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Tekstove\TekstoveBundle\Model\Entity\PermissionUsersQuery A secondary query class using the current class as primary query
     */
    public function usePermissionUsersQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinPermissionUsers($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'PermissionUsers', '\Tekstove\TekstoveBundle\Model\Entity\PermissionUsersQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildPermissions $permissions Object to remove from the list of results
     *
     * @return $this|ChildPermissionsQuery The current query, for fluid interface
     */
    public function prune($permissions = null)
    {
        if ($permissions) {
            $this->addUsingAlias(PermissionsTableMap::COL_ID, $permissions->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the permissions table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(PermissionsTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            PermissionsTableMap::clearInstancePool();
            PermissionsTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(PermissionsTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(PermissionsTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            PermissionsTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            PermissionsTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // PermissionsQuery
