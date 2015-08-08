<?php

namespace Tekstove\TekstoveBundle\Model\Entity\Base;

use \Exception;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\LogicException;
use Propel\Runtime\Exception\PropelException;
use Tekstove\TekstoveBundle\Model\Entity\PermissionGroupPermissions as ChildPermissionGroupPermissions;
use Tekstove\TekstoveBundle\Model\Entity\PermissionGroupPermissionsQuery as ChildPermissionGroupPermissionsQuery;
use Tekstove\TekstoveBundle\Model\Entity\Map\PermissionGroupPermissionsTableMap;

/**
 * Base class that represents a query for the 'permission_group_permissions' table.
 *
 *
 *
 * @method     ChildPermissionGroupPermissionsQuery orderByGroupid($order = Criteria::ASC) Order by the groupId column
 * @method     ChildPermissionGroupPermissionsQuery orderByPermissionid($order = Criteria::ASC) Order by the permissionId column
 *
 * @method     ChildPermissionGroupPermissionsQuery groupByGroupid() Group by the groupId column
 * @method     ChildPermissionGroupPermissionsQuery groupByPermissionid() Group by the permissionId column
 *
 * @method     ChildPermissionGroupPermissionsQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildPermissionGroupPermissionsQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildPermissionGroupPermissionsQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildPermissionGroupPermissionsQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildPermissionGroupPermissionsQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildPermissionGroupPermissionsQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildPermissionGroupPermissionsQuery leftJoinPermissionGroups($relationAlias = null) Adds a LEFT JOIN clause to the query using the PermissionGroups relation
 * @method     ChildPermissionGroupPermissionsQuery rightJoinPermissionGroups($relationAlias = null) Adds a RIGHT JOIN clause to the query using the PermissionGroups relation
 * @method     ChildPermissionGroupPermissionsQuery innerJoinPermissionGroups($relationAlias = null) Adds a INNER JOIN clause to the query using the PermissionGroups relation
 *
 * @method     ChildPermissionGroupPermissionsQuery joinWithPermissionGroups($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the PermissionGroups relation
 *
 * @method     ChildPermissionGroupPermissionsQuery leftJoinWithPermissionGroups() Adds a LEFT JOIN clause and with to the query using the PermissionGroups relation
 * @method     ChildPermissionGroupPermissionsQuery rightJoinWithPermissionGroups() Adds a RIGHT JOIN clause and with to the query using the PermissionGroups relation
 * @method     ChildPermissionGroupPermissionsQuery innerJoinWithPermissionGroups() Adds a INNER JOIN clause and with to the query using the PermissionGroups relation
 *
 * @method     ChildPermissionGroupPermissionsQuery leftJoinPermissions($relationAlias = null) Adds a LEFT JOIN clause to the query using the Permissions relation
 * @method     ChildPermissionGroupPermissionsQuery rightJoinPermissions($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Permissions relation
 * @method     ChildPermissionGroupPermissionsQuery innerJoinPermissions($relationAlias = null) Adds a INNER JOIN clause to the query using the Permissions relation
 *
 * @method     ChildPermissionGroupPermissionsQuery joinWithPermissions($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Permissions relation
 *
 * @method     ChildPermissionGroupPermissionsQuery leftJoinWithPermissions() Adds a LEFT JOIN clause and with to the query using the Permissions relation
 * @method     ChildPermissionGroupPermissionsQuery rightJoinWithPermissions() Adds a RIGHT JOIN clause and with to the query using the Permissions relation
 * @method     ChildPermissionGroupPermissionsQuery innerJoinWithPermissions() Adds a INNER JOIN clause and with to the query using the Permissions relation
 *
 * @method     \Tekstove\TekstoveBundle\Model\Entity\PermissionGroupsQuery|\Tekstove\TekstoveBundle\Model\Entity\PermissionsQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildPermissionGroupPermissions findOne(ConnectionInterface $con = null) Return the first ChildPermissionGroupPermissions matching the query
 * @method     ChildPermissionGroupPermissions findOneOrCreate(ConnectionInterface $con = null) Return the first ChildPermissionGroupPermissions matching the query, or a new ChildPermissionGroupPermissions object populated from the query conditions when no match is found
 *
 * @method     ChildPermissionGroupPermissions findOneByGroupid(int $groupId) Return the first ChildPermissionGroupPermissions filtered by the groupId column
 * @method     ChildPermissionGroupPermissions findOneByPermissionid(int $permissionId) Return the first ChildPermissionGroupPermissions filtered by the permissionId column *

 * @method     ChildPermissionGroupPermissions requirePk($key, ConnectionInterface $con = null) Return the ChildPermissionGroupPermissions by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPermissionGroupPermissions requireOne(ConnectionInterface $con = null) Return the first ChildPermissionGroupPermissions matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildPermissionGroupPermissions requireOneByGroupid(int $groupId) Return the first ChildPermissionGroupPermissions filtered by the groupId column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPermissionGroupPermissions requireOneByPermissionid(int $permissionId) Return the first ChildPermissionGroupPermissions filtered by the permissionId column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildPermissionGroupPermissions[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildPermissionGroupPermissions objects based on current ModelCriteria
 * @method     ChildPermissionGroupPermissions[]|ObjectCollection findByGroupid(int $groupId) Return ChildPermissionGroupPermissions objects filtered by the groupId column
 * @method     ChildPermissionGroupPermissions[]|ObjectCollection findByPermissionid(int $permissionId) Return ChildPermissionGroupPermissions objects filtered by the permissionId column
 * @method     ChildPermissionGroupPermissions[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class PermissionGroupPermissionsQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Tekstove\TekstoveBundle\Model\Entity\Base\PermissionGroupPermissionsQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\Tekstove\\TekstoveBundle\\Model\\Entity\\PermissionGroupPermissions', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildPermissionGroupPermissionsQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildPermissionGroupPermissionsQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildPermissionGroupPermissionsQuery) {
            return $criteria;
        }
        $query = new ChildPermissionGroupPermissionsQuery();
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
     * @return ChildPermissionGroupPermissions|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        throw new LogicException('The PermissionGroupPermissions object has no primary key');
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
        throw new LogicException('The PermissionGroupPermissions object has no primary key');
    }

    /**
     * Filter the query by primary key
     *
     * @param     mixed $key Primary key to use for the query
     *
     * @return $this|ChildPermissionGroupPermissionsQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {
        throw new LogicException('The PermissionGroupPermissions object has no primary key');
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildPermissionGroupPermissionsQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {
        throw new LogicException('The PermissionGroupPermissions object has no primary key');
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
     * @return $this|ChildPermissionGroupPermissionsQuery The current query, for fluid interface
     */
    public function filterByGroupid($groupid = null, $comparison = null)
    {
        if (is_array($groupid)) {
            $useMinMax = false;
            if (isset($groupid['min'])) {
                $this->addUsingAlias(PermissionGroupPermissionsTableMap::COL_GROUPID, $groupid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($groupid['max'])) {
                $this->addUsingAlias(PermissionGroupPermissionsTableMap::COL_GROUPID, $groupid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PermissionGroupPermissionsTableMap::COL_GROUPID, $groupid, $comparison);
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
     * @return $this|ChildPermissionGroupPermissionsQuery The current query, for fluid interface
     */
    public function filterByPermissionid($permissionid = null, $comparison = null)
    {
        if (is_array($permissionid)) {
            $useMinMax = false;
            if (isset($permissionid['min'])) {
                $this->addUsingAlias(PermissionGroupPermissionsTableMap::COL_PERMISSIONID, $permissionid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($permissionid['max'])) {
                $this->addUsingAlias(PermissionGroupPermissionsTableMap::COL_PERMISSIONID, $permissionid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PermissionGroupPermissionsTableMap::COL_PERMISSIONID, $permissionid, $comparison);
    }

    /**
     * Filter the query by a related \Tekstove\TekstoveBundle\Model\Entity\PermissionGroups object
     *
     * @param \Tekstove\TekstoveBundle\Model\Entity\PermissionGroups|ObjectCollection $permissionGroups The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildPermissionGroupPermissionsQuery The current query, for fluid interface
     */
    public function filterByPermissionGroups($permissionGroups, $comparison = null)
    {
        if ($permissionGroups instanceof \Tekstove\TekstoveBundle\Model\Entity\PermissionGroups) {
            return $this
                ->addUsingAlias(PermissionGroupPermissionsTableMap::COL_GROUPID, $permissionGroups->getId(), $comparison);
        } elseif ($permissionGroups instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(PermissionGroupPermissionsTableMap::COL_GROUPID, $permissionGroups->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return $this|ChildPermissionGroupPermissionsQuery The current query, for fluid interface
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
     * Filter the query by a related \Tekstove\TekstoveBundle\Model\Entity\Permissions object
     *
     * @param \Tekstove\TekstoveBundle\Model\Entity\Permissions|ObjectCollection $permissions The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildPermissionGroupPermissionsQuery The current query, for fluid interface
     */
    public function filterByPermissions($permissions, $comparison = null)
    {
        if ($permissions instanceof \Tekstove\TekstoveBundle\Model\Entity\Permissions) {
            return $this
                ->addUsingAlias(PermissionGroupPermissionsTableMap::COL_PERMISSIONID, $permissions->getId(), $comparison);
        } elseif ($permissions instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(PermissionGroupPermissionsTableMap::COL_PERMISSIONID, $permissions->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return $this|ChildPermissionGroupPermissionsQuery The current query, for fluid interface
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
     * Exclude object from result
     *
     * @param   ChildPermissionGroupPermissions $permissionGroupPermissions Object to remove from the list of results
     *
     * @return $this|ChildPermissionGroupPermissionsQuery The current query, for fluid interface
     */
    public function prune($permissionGroupPermissions = null)
    {
        if ($permissionGroupPermissions) {
            throw new LogicException('PermissionGroupPermissions object has no primary key');

        }

        return $this;
    }

    /**
     * Deletes all rows from the permission_group_permissions table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(PermissionGroupPermissionsTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            PermissionGroupPermissionsTableMap::clearInstancePool();
            PermissionGroupPermissionsTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(PermissionGroupPermissionsTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(PermissionGroupPermissionsTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            PermissionGroupPermissionsTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            PermissionGroupPermissionsTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // PermissionGroupPermissionsQuery
