<?php

namespace Tekstove\TekstoveBundle\Model\Base;

use \Exception;
use \PDO;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;
use Tekstove\TekstoveBundle\Model\PermissionUser as ChildPermissionUser;
use Tekstove\TekstoveBundle\Model\PermissionUserQuery as ChildPermissionUserQuery;
use Tekstove\TekstoveBundle\Model\Map\PermissionUserTableMap;

/**
 * Base class that represents a query for the 'permission_user' table.
 *
 *
 *
 * @method     ChildPermissionUserQuery orderByPermissionId($order = Criteria::ASC) Order by the permission_id column
 * @method     ChildPermissionUserQuery orderByUserId($order = Criteria::ASC) Order by the user_id column
 *
 * @method     ChildPermissionUserQuery groupByPermissionId() Group by the permission_id column
 * @method     ChildPermissionUserQuery groupByUserId() Group by the user_id column
 *
 * @method     ChildPermissionUserQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildPermissionUserQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildPermissionUserQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildPermissionUserQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildPermissionUserQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildPermissionUserQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildPermissionUser findOne(ConnectionInterface $con = null) Return the first ChildPermissionUser matching the query
 * @method     ChildPermissionUser findOneOrCreate(ConnectionInterface $con = null) Return the first ChildPermissionUser matching the query, or a new ChildPermissionUser object populated from the query conditions when no match is found
 *
 * @method     ChildPermissionUser findOneByPermissionId(int $permission_id) Return the first ChildPermissionUser filtered by the permission_id column
 * @method     ChildPermissionUser findOneByUserId(int $user_id) Return the first ChildPermissionUser filtered by the user_id column *

 * @method     ChildPermissionUser requirePk($key, ConnectionInterface $con = null) Return the ChildPermissionUser by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPermissionUser requireOne(ConnectionInterface $con = null) Return the first ChildPermissionUser matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildPermissionUser requireOneByPermissionId(int $permission_id) Return the first ChildPermissionUser filtered by the permission_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPermissionUser requireOneByUserId(int $user_id) Return the first ChildPermissionUser filtered by the user_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildPermissionUser[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildPermissionUser objects based on current ModelCriteria
 * @method     ChildPermissionUser[]|ObjectCollection findByPermissionId(int $permission_id) Return ChildPermissionUser objects filtered by the permission_id column
 * @method     ChildPermissionUser[]|ObjectCollection findByUserId(int $user_id) Return ChildPermissionUser objects filtered by the user_id column
 * @method     ChildPermissionUser[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class PermissionUserQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Tekstove\TekstoveBundle\Model\Base\PermissionUserQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\Tekstove\\TekstoveBundle\\Model\\PermissionUser', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildPermissionUserQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildPermissionUserQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildPermissionUserQuery) {
            return $criteria;
        }
        $query = new ChildPermissionUserQuery();
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
     * @param array[$permission_id, $user_id] $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildPermissionUser|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = PermissionUserTableMap::getInstanceFromPool(serialize(array((string) $key[0], (string) $key[1]))))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(PermissionUserTableMap::DATABASE_NAME);
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
     * @return ChildPermissionUser A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT permission_id, user_id FROM permission_user WHERE permission_id = :p0 AND user_id = :p1';
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
            /** @var ChildPermissionUser $obj */
            $obj = new ChildPermissionUser();
            $obj->hydrate($row);
            PermissionUserTableMap::addInstanceToPool($obj, serialize(array((string) $key[0], (string) $key[1])));
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
     * @return ChildPermissionUser|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildPermissionUserQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {
        $this->addUsingAlias(PermissionUserTableMap::COL_PERMISSION_ID, $key[0], Criteria::EQUAL);
        $this->addUsingAlias(PermissionUserTableMap::COL_USER_ID, $key[1], Criteria::EQUAL);

        return $this;
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildPermissionUserQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {
        if (empty($keys)) {
            return $this->add(null, '1<>1', Criteria::CUSTOM);
        }
        foreach ($keys as $key) {
            $cton0 = $this->getNewCriterion(PermissionUserTableMap::COL_PERMISSION_ID, $key[0], Criteria::EQUAL);
            $cton1 = $this->getNewCriterion(PermissionUserTableMap::COL_USER_ID, $key[1], Criteria::EQUAL);
            $cton0->addAnd($cton1);
            $this->addOr($cton0);
        }

        return $this;
    }

    /**
     * Filter the query on the permission_id column
     *
     * Example usage:
     * <code>
     * $query->filterByPermissionId(1234); // WHERE permission_id = 1234
     * $query->filterByPermissionId(array(12, 34)); // WHERE permission_id IN (12, 34)
     * $query->filterByPermissionId(array('min' => 12)); // WHERE permission_id > 12
     * </code>
     *
     * @param     mixed $permissionId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPermissionUserQuery The current query, for fluid interface
     */
    public function filterByPermissionId($permissionId = null, $comparison = null)
    {
        if (is_array($permissionId)) {
            $useMinMax = false;
            if (isset($permissionId['min'])) {
                $this->addUsingAlias(PermissionUserTableMap::COL_PERMISSION_ID, $permissionId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($permissionId['max'])) {
                $this->addUsingAlias(PermissionUserTableMap::COL_PERMISSION_ID, $permissionId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PermissionUserTableMap::COL_PERMISSION_ID, $permissionId, $comparison);
    }

    /**
     * Filter the query on the user_id column
     *
     * Example usage:
     * <code>
     * $query->filterByUserId(1234); // WHERE user_id = 1234
     * $query->filterByUserId(array(12, 34)); // WHERE user_id IN (12, 34)
     * $query->filterByUserId(array('min' => 12)); // WHERE user_id > 12
     * </code>
     *
     * @param     mixed $userId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPermissionUserQuery The current query, for fluid interface
     */
    public function filterByUserId($userId = null, $comparison = null)
    {
        if (is_array($userId)) {
            $useMinMax = false;
            if (isset($userId['min'])) {
                $this->addUsingAlias(PermissionUserTableMap::COL_USER_ID, $userId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($userId['max'])) {
                $this->addUsingAlias(PermissionUserTableMap::COL_USER_ID, $userId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PermissionUserTableMap::COL_USER_ID, $userId, $comparison);
    }

    /**
     * Exclude object from result
     *
     * @param   ChildPermissionUser $permissionUser Object to remove from the list of results
     *
     * @return $this|ChildPermissionUserQuery The current query, for fluid interface
     */
    public function prune($permissionUser = null)
    {
        if ($permissionUser) {
            $this->addCond('pruneCond0', $this->getAliasedColName(PermissionUserTableMap::COL_PERMISSION_ID), $permissionUser->getPermissionId(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond1', $this->getAliasedColName(PermissionUserTableMap::COL_USER_ID), $permissionUser->getUserId(), Criteria::NOT_EQUAL);
            $this->combine(array('pruneCond0', 'pruneCond1'), Criteria::LOGICAL_OR);
        }

        return $this;
    }

    /**
     * Deletes all rows from the permission_user table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(PermissionUserTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            PermissionUserTableMap::clearInstancePool();
            PermissionUserTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(PermissionUserTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(PermissionUserTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            PermissionUserTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            PermissionUserTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // PermissionUserQuery
