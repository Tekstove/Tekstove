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
use Tekstove\TekstoveBundle\Model\Entity\PermissionGroupUsers as ChildPermissionGroupUsers;
use Tekstove\TekstoveBundle\Model\Entity\PermissionGroupUsersQuery as ChildPermissionGroupUsersQuery;
use Tekstove\TekstoveBundle\Model\Entity\Map\PermissionGroupUsersTableMap;

/**
 * Base class that represents a query for the 'permission_group_users' table.
 *
 *
 *
 * @method     ChildPermissionGroupUsersQuery orderByGroupid($order = Criteria::ASC) Order by the groupId column
 * @method     ChildPermissionGroupUsersQuery orderByUserid($order = Criteria::ASC) Order by the userId column
 *
 * @method     ChildPermissionGroupUsersQuery groupByGroupid() Group by the groupId column
 * @method     ChildPermissionGroupUsersQuery groupByUserid() Group by the userId column
 *
 * @method     ChildPermissionGroupUsersQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildPermissionGroupUsersQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildPermissionGroupUsersQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildPermissionGroupUsersQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildPermissionGroupUsersQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildPermissionGroupUsersQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildPermissionGroupUsersQuery leftJoinPermissionGroups($relationAlias = null) Adds a LEFT JOIN clause to the query using the PermissionGroups relation
 * @method     ChildPermissionGroupUsersQuery rightJoinPermissionGroups($relationAlias = null) Adds a RIGHT JOIN clause to the query using the PermissionGroups relation
 * @method     ChildPermissionGroupUsersQuery innerJoinPermissionGroups($relationAlias = null) Adds a INNER JOIN clause to the query using the PermissionGroups relation
 *
 * @method     ChildPermissionGroupUsersQuery joinWithPermissionGroups($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the PermissionGroups relation
 *
 * @method     ChildPermissionGroupUsersQuery leftJoinWithPermissionGroups() Adds a LEFT JOIN clause and with to the query using the PermissionGroups relation
 * @method     ChildPermissionGroupUsersQuery rightJoinWithPermissionGroups() Adds a RIGHT JOIN clause and with to the query using the PermissionGroups relation
 * @method     ChildPermissionGroupUsersQuery innerJoinWithPermissionGroups() Adds a INNER JOIN clause and with to the query using the PermissionGroups relation
 *
 * @method     ChildPermissionGroupUsersQuery leftJoinUsers($relationAlias = null) Adds a LEFT JOIN clause to the query using the Users relation
 * @method     ChildPermissionGroupUsersQuery rightJoinUsers($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Users relation
 * @method     ChildPermissionGroupUsersQuery innerJoinUsers($relationAlias = null) Adds a INNER JOIN clause to the query using the Users relation
 *
 * @method     ChildPermissionGroupUsersQuery joinWithUsers($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Users relation
 *
 * @method     ChildPermissionGroupUsersQuery leftJoinWithUsers() Adds a LEFT JOIN clause and with to the query using the Users relation
 * @method     ChildPermissionGroupUsersQuery rightJoinWithUsers() Adds a RIGHT JOIN clause and with to the query using the Users relation
 * @method     ChildPermissionGroupUsersQuery innerJoinWithUsers() Adds a INNER JOIN clause and with to the query using the Users relation
 *
 * @method     \Tekstove\TekstoveBundle\Model\Entity\PermissionGroupsQuery|\Tekstove\TekstoveBundle\Model\Entity\UsersQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildPermissionGroupUsers findOne(ConnectionInterface $con = null) Return the first ChildPermissionGroupUsers matching the query
 * @method     ChildPermissionGroupUsers findOneOrCreate(ConnectionInterface $con = null) Return the first ChildPermissionGroupUsers matching the query, or a new ChildPermissionGroupUsers object populated from the query conditions when no match is found
 *
 * @method     ChildPermissionGroupUsers findOneByGroupid(int $groupId) Return the first ChildPermissionGroupUsers filtered by the groupId column
 * @method     ChildPermissionGroupUsers findOneByUserid(int $userId) Return the first ChildPermissionGroupUsers filtered by the userId column *

 * @method     ChildPermissionGroupUsers requirePk($key, ConnectionInterface $con = null) Return the ChildPermissionGroupUsers by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPermissionGroupUsers requireOne(ConnectionInterface $con = null) Return the first ChildPermissionGroupUsers matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildPermissionGroupUsers requireOneByGroupid(int $groupId) Return the first ChildPermissionGroupUsers filtered by the groupId column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPermissionGroupUsers requireOneByUserid(int $userId) Return the first ChildPermissionGroupUsers filtered by the userId column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildPermissionGroupUsers[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildPermissionGroupUsers objects based on current ModelCriteria
 * @method     ChildPermissionGroupUsers[]|ObjectCollection findByGroupid(int $groupId) Return ChildPermissionGroupUsers objects filtered by the groupId column
 * @method     ChildPermissionGroupUsers[]|ObjectCollection findByUserid(int $userId) Return ChildPermissionGroupUsers objects filtered by the userId column
 * @method     ChildPermissionGroupUsers[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class PermissionGroupUsersQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Tekstove\TekstoveBundle\Model\Entity\Base\PermissionGroupUsersQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\Tekstove\\TekstoveBundle\\Model\\Entity\\PermissionGroupUsers', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildPermissionGroupUsersQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildPermissionGroupUsersQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildPermissionGroupUsersQuery) {
            return $criteria;
        }
        $query = new ChildPermissionGroupUsersQuery();
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
     * @param array[$groupId, $userId] $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildPermissionGroupUsers|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = PermissionGroupUsersTableMap::getInstanceFromPool(serialize(array((string) $key[0], (string) $key[1]))))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(PermissionGroupUsersTableMap::DATABASE_NAME);
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
     * @return ChildPermissionGroupUsers A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT groupId, userId FROM permission_group_users WHERE groupId = :p0 AND userId = :p1';
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
            /** @var ChildPermissionGroupUsers $obj */
            $obj = new ChildPermissionGroupUsers();
            $obj->hydrate($row);
            PermissionGroupUsersTableMap::addInstanceToPool($obj, serialize(array((string) $key[0], (string) $key[1])));
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
     * @return ChildPermissionGroupUsers|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildPermissionGroupUsersQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {
        $this->addUsingAlias(PermissionGroupUsersTableMap::COL_GROUPID, $key[0], Criteria::EQUAL);
        $this->addUsingAlias(PermissionGroupUsersTableMap::COL_USERID, $key[1], Criteria::EQUAL);

        return $this;
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildPermissionGroupUsersQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {
        if (empty($keys)) {
            return $this->add(null, '1<>1', Criteria::CUSTOM);
        }
        foreach ($keys as $key) {
            $cton0 = $this->getNewCriterion(PermissionGroupUsersTableMap::COL_GROUPID, $key[0], Criteria::EQUAL);
            $cton1 = $this->getNewCriterion(PermissionGroupUsersTableMap::COL_USERID, $key[1], Criteria::EQUAL);
            $cton0->addAnd($cton1);
            $this->addOr($cton0);
        }

        return $this;
    }

    /**
     * Filter the query on the groupId column
     *
     * Example usage:
     * <code>
     * $query->filterByGroupid(1234); // WHERE groupId = 1234
     * $query->filterByGroupid(array(12, 34)); // WHERE groupId IN (12, 34)
     * $query->filterByGroupid(array('min' => 12)); // WHERE groupId > 12
     * </code>
     *
     * @see       filterByPermissionGroups()
     *
     * @param     mixed $groupid The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPermissionGroupUsersQuery The current query, for fluid interface
     */
    public function filterByGroupid($groupid = null, $comparison = null)
    {
        if (is_array($groupid)) {
            $useMinMax = false;
            if (isset($groupid['min'])) {
                $this->addUsingAlias(PermissionGroupUsersTableMap::COL_GROUPID, $groupid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($groupid['max'])) {
                $this->addUsingAlias(PermissionGroupUsersTableMap::COL_GROUPID, $groupid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PermissionGroupUsersTableMap::COL_GROUPID, $groupid, $comparison);
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
     * @return $this|ChildPermissionGroupUsersQuery The current query, for fluid interface
     */
    public function filterByUserid($userid = null, $comparison = null)
    {
        if (is_array($userid)) {
            $useMinMax = false;
            if (isset($userid['min'])) {
                $this->addUsingAlias(PermissionGroupUsersTableMap::COL_USERID, $userid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($userid['max'])) {
                $this->addUsingAlias(PermissionGroupUsersTableMap::COL_USERID, $userid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PermissionGroupUsersTableMap::COL_USERID, $userid, $comparison);
    }

    /**
     * Filter the query by a related \Tekstove\TekstoveBundle\Model\Entity\PermissionGroups object
     *
     * @param \Tekstove\TekstoveBundle\Model\Entity\PermissionGroups|ObjectCollection $permissionGroups The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildPermissionGroupUsersQuery The current query, for fluid interface
     */
    public function filterByPermissionGroups($permissionGroups, $comparison = null)
    {
        if ($permissionGroups instanceof \Tekstove\TekstoveBundle\Model\Entity\PermissionGroups) {
            return $this
                ->addUsingAlias(PermissionGroupUsersTableMap::COL_GROUPID, $permissionGroups->getId(), $comparison);
        } elseif ($permissionGroups instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(PermissionGroupUsersTableMap::COL_GROUPID, $permissionGroups->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByPermissionGroups() only accepts arguments of type \Tekstove\TekstoveBundle\Model\Entity\PermissionGroups or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the PermissionGroups relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildPermissionGroupUsersQuery The current query, for fluid interface
     */
    public function joinPermissionGroups($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('PermissionGroups');

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
            $this->addJoinObject($join, 'PermissionGroups');
        }

        return $this;
    }

    /**
     * Use the PermissionGroups relation PermissionGroups object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Tekstove\TekstoveBundle\Model\Entity\PermissionGroupsQuery A secondary query class using the current class as primary query
     */
    public function usePermissionGroupsQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinPermissionGroups($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'PermissionGroups', '\Tekstove\TekstoveBundle\Model\Entity\PermissionGroupsQuery');
    }

    /**
     * Filter the query by a related \Tekstove\TekstoveBundle\Model\Entity\Users object
     *
     * @param \Tekstove\TekstoveBundle\Model\Entity\Users|ObjectCollection $users The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildPermissionGroupUsersQuery The current query, for fluid interface
     */
    public function filterByUsers($users, $comparison = null)
    {
        if ($users instanceof \Tekstove\TekstoveBundle\Model\Entity\Users) {
            return $this
                ->addUsingAlias(PermissionGroupUsersTableMap::COL_USERID, $users->getId(), $comparison);
        } elseif ($users instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(PermissionGroupUsersTableMap::COL_USERID, $users->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return $this|ChildPermissionGroupUsersQuery The current query, for fluid interface
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
     * @param   ChildPermissionGroupUsers $permissionGroupUsers Object to remove from the list of results
     *
     * @return $this|ChildPermissionGroupUsersQuery The current query, for fluid interface
     */
    public function prune($permissionGroupUsers = null)
    {
        if ($permissionGroupUsers) {
            $this->addCond('pruneCond0', $this->getAliasedColName(PermissionGroupUsersTableMap::COL_GROUPID), $permissionGroupUsers->getGroupid(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond1', $this->getAliasedColName(PermissionGroupUsersTableMap::COL_USERID), $permissionGroupUsers->getUserid(), Criteria::NOT_EQUAL);
            $this->combine(array('pruneCond0', 'pruneCond1'), Criteria::LOGICAL_OR);
        }

        return $this;
    }

    /**
     * Deletes all rows from the permission_group_users table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(PermissionGroupUsersTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            PermissionGroupUsersTableMap::clearInstancePool();
            PermissionGroupUsersTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(PermissionGroupUsersTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(PermissionGroupUsersTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            PermissionGroupUsersTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            PermissionGroupUsersTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // PermissionGroupUsersQuery
