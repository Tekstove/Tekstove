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
use Tekstove\TekstoveBundle\Model\Entity\PermissionUsers as ChildPermissionUsers;
use Tekstove\TekstoveBundle\Model\Entity\PermissionUsersQuery as ChildPermissionUsersQuery;
use Tekstove\TekstoveBundle\Model\Entity\Map\PermissionUsersTableMap;

/**
 * Base class that represents a query for the 'permission_users' table.
 *
 *
 *
 * @method     ChildPermissionUsersQuery orderByPermissionid($order = Criteria::ASC) Order by the permissionId column
 * @method     ChildPermissionUsersQuery orderByUserid($order = Criteria::ASC) Order by the userId column
 *
 * @method     ChildPermissionUsersQuery groupByPermissionid() Group by the permissionId column
 * @method     ChildPermissionUsersQuery groupByUserid() Group by the userId column
 *
 * @method     ChildPermissionUsersQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildPermissionUsersQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildPermissionUsersQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildPermissionUsersQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildPermissionUsersQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildPermissionUsersQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildPermissionUsersQuery leftJoinPermissions($relationAlias = null) Adds a LEFT JOIN clause to the query using the Permissions relation
 * @method     ChildPermissionUsersQuery rightJoinPermissions($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Permissions relation
 * @method     ChildPermissionUsersQuery innerJoinPermissions($relationAlias = null) Adds a INNER JOIN clause to the query using the Permissions relation
 *
 * @method     ChildPermissionUsersQuery joinWithPermissions($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Permissions relation
 *
 * @method     ChildPermissionUsersQuery leftJoinWithPermissions() Adds a LEFT JOIN clause and with to the query using the Permissions relation
 * @method     ChildPermissionUsersQuery rightJoinWithPermissions() Adds a RIGHT JOIN clause and with to the query using the Permissions relation
 * @method     ChildPermissionUsersQuery innerJoinWithPermissions() Adds a INNER JOIN clause and with to the query using the Permissions relation
 *
 * @method     ChildPermissionUsersQuery leftJoinUsers($relationAlias = null) Adds a LEFT JOIN clause to the query using the Users relation
 * @method     ChildPermissionUsersQuery rightJoinUsers($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Users relation
 * @method     ChildPermissionUsersQuery innerJoinUsers($relationAlias = null) Adds a INNER JOIN clause to the query using the Users relation
 *
 * @method     ChildPermissionUsersQuery joinWithUsers($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Users relation
 *
 * @method     ChildPermissionUsersQuery leftJoinWithUsers() Adds a LEFT JOIN clause and with to the query using the Users relation
 * @method     ChildPermissionUsersQuery rightJoinWithUsers() Adds a RIGHT JOIN clause and with to the query using the Users relation
 * @method     ChildPermissionUsersQuery innerJoinWithUsers() Adds a INNER JOIN clause and with to the query using the Users relation
 *
 * @method     \Tekstove\TekstoveBundle\Model\Entity\PermissionsQuery|\Tekstove\TekstoveBundle\Model\Entity\UsersQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildPermissionUsers findOne(ConnectionInterface $con = null) Return the first ChildPermissionUsers matching the query
 * @method     ChildPermissionUsers findOneOrCreate(ConnectionInterface $con = null) Return the first ChildPermissionUsers matching the query, or a new ChildPermissionUsers object populated from the query conditions when no match is found
 *
 * @method     ChildPermissionUsers findOneByPermissionid(int $permissionId) Return the first ChildPermissionUsers filtered by the permissionId column
 * @method     ChildPermissionUsers findOneByUserid(int $userId) Return the first ChildPermissionUsers filtered by the userId column *

 * @method     ChildPermissionUsers requirePk($key, ConnectionInterface $con = null) Return the ChildPermissionUsers by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPermissionUsers requireOne(ConnectionInterface $con = null) Return the first ChildPermissionUsers matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildPermissionUsers requireOneByPermissionid(int $permissionId) Return the first ChildPermissionUsers filtered by the permissionId column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPermissionUsers requireOneByUserid(int $userId) Return the first ChildPermissionUsers filtered by the userId column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildPermissionUsers[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildPermissionUsers objects based on current ModelCriteria
 * @method     ChildPermissionUsers[]|ObjectCollection findByPermissionid(int $permissionId) Return ChildPermissionUsers objects filtered by the permissionId column
 * @method     ChildPermissionUsers[]|ObjectCollection findByUserid(int $userId) Return ChildPermissionUsers objects filtered by the userId column
 * @method     ChildPermissionUsers[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class PermissionUsersQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Tekstove\TekstoveBundle\Model\Entity\Base\PermissionUsersQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\Tekstove\\TekstoveBundle\\Model\\Entity\\PermissionUsers', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildPermissionUsersQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildPermissionUsersQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildPermissionUsersQuery) {
            return $criteria;
        }
        $query = new ChildPermissionUsersQuery();
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
     * $obj = $c->findPk(array(12, 34), $con);
     * </code>
     *
     * @param array[$permissionId, $userId] $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildPermissionUsers|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = PermissionUsersTableMap::getInstanceFromPool(serialize(array((string) $key[0], (string) $key[1]))))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(PermissionUsersTableMap::DATABASE_NAME);
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
     * @return ChildPermissionUsers A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT permissionId, userId FROM permission_users WHERE permissionId = :p0 AND userId = :p1';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key[0], PDO::PARAM_INT);
            $stmt->bindValue(':p1', $key[1], PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildPermissionUsers $obj */
            $obj = new ChildPermissionUsers();
            $obj->hydrate($row);
            PermissionUsersTableMap::addInstanceToPool($obj, serialize(array((string) $key[0], (string) $key[1])));
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
     * @return ChildPermissionUsers|array|mixed the result, formatted by the current formatter
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
     * $objs = $c->findPks(array(array(12, 56), array(832, 123), array(123, 456)), $con);
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
     * @return $this|ChildPermissionUsersQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {
        $this->addUsingAlias(PermissionUsersTableMap::COL_PERMISSIONID, $key[0], Criteria::EQUAL);
        $this->addUsingAlias(PermissionUsersTableMap::COL_USERID, $key[1], Criteria::EQUAL);

        return $this;
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildPermissionUsersQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {
        if (empty($keys)) {
            return $this->add(null, '1<>1', Criteria::CUSTOM);
        }
        foreach ($keys as $key) {
            $cton0 = $this->getNewCriterion(PermissionUsersTableMap::COL_PERMISSIONID, $key[0], Criteria::EQUAL);
            $cton1 = $this->getNewCriterion(PermissionUsersTableMap::COL_USERID, $key[1], Criteria::EQUAL);
            $cton0->addAnd($cton1);
            $this->addOr($cton0);
        }

        return $this;
    }

    /**
     * Filter the query on the permissionId column
     *
     * Example usage:
     * <code>
     * $query->filterByPermissionid(1234); // WHERE permissionId = 1234
     * $query->filterByPermissionid(array(12, 34)); // WHERE permissionId IN (12, 34)
     * $query->filterByPermissionid(array('min' => 12)); // WHERE permissionId > 12
     * </code>
     *
     * @see       filterByPermissions()
     *
     * @param     mixed $permissionid The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPermissionUsersQuery The current query, for fluid interface
     */
    public function filterByPermissionid($permissionid = null, $comparison = null)
    {
        if (is_array($permissionid)) {
            $useMinMax = false;
            if (isset($permissionid['min'])) {
                $this->addUsingAlias(PermissionUsersTableMap::COL_PERMISSIONID, $permissionid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($permissionid['max'])) {
                $this->addUsingAlias(PermissionUsersTableMap::COL_PERMISSIONID, $permissionid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PermissionUsersTableMap::COL_PERMISSIONID, $permissionid, $comparison);
    }

    /**
     * Filter the query on the userId column
     *
     * Example usage:
     * <code>
     * $query->filterByUserid(1234); // WHERE userId = 1234
     * $query->filterByUserid(array(12, 34)); // WHERE userId IN (12, 34)
     * $query->filterByUserid(array('min' => 12)); // WHERE userId > 12
     * </code>
     *
     * @see       filterByUsers()
     *
     * @param     mixed $userid The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPermissionUsersQuery The current query, for fluid interface
     */
    public function filterByUserid($userid = null, $comparison = null)
    {
        if (is_array($userid)) {
            $useMinMax = false;
            if (isset($userid['min'])) {
                $this->addUsingAlias(PermissionUsersTableMap::COL_USERID, $userid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($userid['max'])) {
                $this->addUsingAlias(PermissionUsersTableMap::COL_USERID, $userid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PermissionUsersTableMap::COL_USERID, $userid, $comparison);
    }

    /**
     * Filter the query by a related \Tekstove\TekstoveBundle\Model\Entity\Permissions object
     *
     * @param \Tekstove\TekstoveBundle\Model\Entity\Permissions|ObjectCollection $permissions The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildPermissionUsersQuery The current query, for fluid interface
     */
    public function filterByPermissions($permissions, $comparison = null)
    {
        if ($permissions instanceof \Tekstove\TekstoveBundle\Model\Entity\Permissions) {
            return $this
                ->addUsingAlias(PermissionUsersTableMap::COL_PERMISSIONID, $permissions->getId(), $comparison);
        } elseif ($permissions instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(PermissionUsersTableMap::COL_PERMISSIONID, $permissions->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByPermissions() only accepts arguments of type \Tekstove\TekstoveBundle\Model\Entity\Permissions or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Permissions relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildPermissionUsersQuery The current query, for fluid interface
     */
    public function joinPermissions($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Permissions');

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
            $this->addJoinObject($join, 'Permissions');
        }

        return $this;
    }

    /**
     * Use the Permissions relation Permissions object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Tekstove\TekstoveBundle\Model\Entity\PermissionsQuery A secondary query class using the current class as primary query
     */
    public function usePermissionsQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinPermissions($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Permissions', '\Tekstove\TekstoveBundle\Model\Entity\PermissionsQuery');
    }

    /**
     * Filter the query by a related \Tekstove\TekstoveBundle\Model\Entity\Users object
     *
     * @param \Tekstove\TekstoveBundle\Model\Entity\Users|ObjectCollection $users The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildPermissionUsersQuery The current query, for fluid interface
     */
    public function filterByUsers($users, $comparison = null)
    {
        if ($users instanceof \Tekstove\TekstoveBundle\Model\Entity\Users) {
            return $this
                ->addUsingAlias(PermissionUsersTableMap::COL_USERID, $users->getId(), $comparison);
        } elseif ($users instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(PermissionUsersTableMap::COL_USERID, $users->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByUsers() only accepts arguments of type \Tekstove\TekstoveBundle\Model\Entity\Users or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Users relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildPermissionUsersQuery The current query, for fluid interface
     */
    public function joinUsers($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Users');

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
            $this->addJoinObject($join, 'Users');
        }

        return $this;
    }

    /**
     * Use the Users relation Users object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Tekstove\TekstoveBundle\Model\Entity\UsersQuery A secondary query class using the current class as primary query
     */
    public function useUsersQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinUsers($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Users', '\Tekstove\TekstoveBundle\Model\Entity\UsersQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildPermissionUsers $permissionUsers Object to remove from the list of results
     *
     * @return $this|ChildPermissionUsersQuery The current query, for fluid interface
     */
    public function prune($permissionUsers = null)
    {
        if ($permissionUsers) {
            $this->addCond('pruneCond0', $this->getAliasedColName(PermissionUsersTableMap::COL_PERMISSIONID), $permissionUsers->getPermissionid(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond1', $this->getAliasedColName(PermissionUsersTableMap::COL_USERID), $permissionUsers->getUserid(), Criteria::NOT_EQUAL);
            $this->combine(array('pruneCond0', 'pruneCond1'), Criteria::LOGICAL_OR);
        }

        return $this;
    }

    /**
     * Deletes all rows from the permission_users table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(PermissionUsersTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            PermissionUsersTableMap::clearInstancePool();
            PermissionUsersTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(PermissionUsersTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(PermissionUsersTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            PermissionUsersTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            PermissionUsersTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // PermissionUsersQuery
