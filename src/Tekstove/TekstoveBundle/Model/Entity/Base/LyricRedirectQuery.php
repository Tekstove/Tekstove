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
use Tekstove\TekstoveBundle\Model\Entity\LyricRedirect as ChildLyricRedirect;
use Tekstove\TekstoveBundle\Model\Entity\LyricRedirectQuery as ChildLyricRedirectQuery;
use Tekstove\TekstoveBundle\Model\Entity\Map\LyricRedirectTableMap;

/**
 * Base class that represents a query for the 'lyric_redirect' table.
 *
 *
 *
 * @method     ChildLyricRedirectQuery orderByDeletedId($order = Criteria::ASC) Order by the deleted_id column
 * @method     ChildLyricRedirectQuery orderByRedirectId($order = Criteria::ASC) Order by the redirect_id column
 *
 * @method     ChildLyricRedirectQuery groupByDeletedId() Group by the deleted_id column
 * @method     ChildLyricRedirectQuery groupByRedirectId() Group by the redirect_id column
 *
 * @method     ChildLyricRedirectQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildLyricRedirectQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildLyricRedirectQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildLyricRedirectQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildLyricRedirectQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildLyricRedirectQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildLyricRedirectQuery leftJoinLyric($relationAlias = null) Adds a LEFT JOIN clause to the query using the Lyric relation
 * @method     ChildLyricRedirectQuery rightJoinLyric($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Lyric relation
 * @method     ChildLyricRedirectQuery innerJoinLyric($relationAlias = null) Adds a INNER JOIN clause to the query using the Lyric relation
 *
 * @method     ChildLyricRedirectQuery joinWithLyric($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Lyric relation
 *
 * @method     ChildLyricRedirectQuery leftJoinWithLyric() Adds a LEFT JOIN clause and with to the query using the Lyric relation
 * @method     ChildLyricRedirectQuery rightJoinWithLyric() Adds a RIGHT JOIN clause and with to the query using the Lyric relation
 * @method     ChildLyricRedirectQuery innerJoinWithLyric() Adds a INNER JOIN clause and with to the query using the Lyric relation
 *
 * @method     \Tekstove\TekstoveBundle\Model\Entity\LyricQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildLyricRedirect findOne(ConnectionInterface $con = null) Return the first ChildLyricRedirect matching the query
 * @method     ChildLyricRedirect findOneOrCreate(ConnectionInterface $con = null) Return the first ChildLyricRedirect matching the query, or a new ChildLyricRedirect object populated from the query conditions when no match is found
 *
 * @method     ChildLyricRedirect findOneByDeletedId(int $deleted_id) Return the first ChildLyricRedirect filtered by the deleted_id column
 * @method     ChildLyricRedirect findOneByRedirectId(int $redirect_id) Return the first ChildLyricRedirect filtered by the redirect_id column *

 * @method     ChildLyricRedirect requirePk($key, ConnectionInterface $con = null) Return the ChildLyricRedirect by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLyricRedirect requireOne(ConnectionInterface $con = null) Return the first ChildLyricRedirect matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildLyricRedirect requireOneByDeletedId(int $deleted_id) Return the first ChildLyricRedirect filtered by the deleted_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLyricRedirect requireOneByRedirectId(int $redirect_id) Return the first ChildLyricRedirect filtered by the redirect_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildLyricRedirect[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildLyricRedirect objects based on current ModelCriteria
 * @method     ChildLyricRedirect[]|ObjectCollection findByDeletedId(int $deleted_id) Return ChildLyricRedirect objects filtered by the deleted_id column
 * @method     ChildLyricRedirect[]|ObjectCollection findByRedirectId(int $redirect_id) Return ChildLyricRedirect objects filtered by the redirect_id column
 * @method     ChildLyricRedirect[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class LyricRedirectQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Tekstove\TekstoveBundle\Model\Entity\Base\LyricRedirectQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\Tekstove\\TekstoveBundle\\Model\\Entity\\LyricRedirect', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildLyricRedirectQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildLyricRedirectQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildLyricRedirectQuery) {
            return $criteria;
        }
        $query = new ChildLyricRedirectQuery();
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
     * @param array[$deleted_id, $redirect_id] $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildLyricRedirect|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = LyricRedirectTableMap::getInstanceFromPool(serialize(array((string) $key[0], (string) $key[1]))))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(LyricRedirectTableMap::DATABASE_NAME);
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
     * @return ChildLyricRedirect A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT deleted_id, redirect_id FROM lyric_redirect WHERE deleted_id = :p0 AND redirect_id = :p1';
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
            /** @var ChildLyricRedirect $obj */
            $obj = new ChildLyricRedirect();
            $obj->hydrate($row);
            LyricRedirectTableMap::addInstanceToPool($obj, serialize(array((string) $key[0], (string) $key[1])));
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
     * @return ChildLyricRedirect|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildLyricRedirectQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {
        $this->addUsingAlias(LyricRedirectTableMap::COL_DELETED_ID, $key[0], Criteria::EQUAL);
        $this->addUsingAlias(LyricRedirectTableMap::COL_REDIRECT_ID, $key[1], Criteria::EQUAL);

        return $this;
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildLyricRedirectQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {
        if (empty($keys)) {
            return $this->add(null, '1<>1', Criteria::CUSTOM);
        }
        foreach ($keys as $key) {
            $cton0 = $this->getNewCriterion(LyricRedirectTableMap::COL_DELETED_ID, $key[0], Criteria::EQUAL);
            $cton1 = $this->getNewCriterion(LyricRedirectTableMap::COL_REDIRECT_ID, $key[1], Criteria::EQUAL);
            $cton0->addAnd($cton1);
            $this->addOr($cton0);
        }

        return $this;
    }

    /**
     * Filter the query on the deleted_id column
     *
     * Example usage:
     * <code>
     * $query->filterByDeletedId(1234); // WHERE deleted_id = 1234
     * $query->filterByDeletedId(array(12, 34)); // WHERE deleted_id IN (12, 34)
     * $query->filterByDeletedId(array('min' => 12)); // WHERE deleted_id > 12
     * </code>
     *
     * @param     mixed $deletedId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildLyricRedirectQuery The current query, for fluid interface
     */
    public function filterByDeletedId($deletedId = null, $comparison = null)
    {
        if (is_array($deletedId)) {
            $useMinMax = false;
            if (isset($deletedId['min'])) {
                $this->addUsingAlias(LyricRedirectTableMap::COL_DELETED_ID, $deletedId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($deletedId['max'])) {
                $this->addUsingAlias(LyricRedirectTableMap::COL_DELETED_ID, $deletedId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LyricRedirectTableMap::COL_DELETED_ID, $deletedId, $comparison);
    }

    /**
     * Filter the query on the redirect_id column
     *
     * Example usage:
     * <code>
     * $query->filterByRedirectId(1234); // WHERE redirect_id = 1234
     * $query->filterByRedirectId(array(12, 34)); // WHERE redirect_id IN (12, 34)
     * $query->filterByRedirectId(array('min' => 12)); // WHERE redirect_id > 12
     * </code>
     *
     * @see       filterByLyric()
     *
     * @param     mixed $redirectId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildLyricRedirectQuery The current query, for fluid interface
     */
    public function filterByRedirectId($redirectId = null, $comparison = null)
    {
        if (is_array($redirectId)) {
            $useMinMax = false;
            if (isset($redirectId['min'])) {
                $this->addUsingAlias(LyricRedirectTableMap::COL_REDIRECT_ID, $redirectId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($redirectId['max'])) {
                $this->addUsingAlias(LyricRedirectTableMap::COL_REDIRECT_ID, $redirectId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LyricRedirectTableMap::COL_REDIRECT_ID, $redirectId, $comparison);
    }

    /**
     * Filter the query by a related \Tekstove\TekstoveBundle\Model\Entity\Lyric object
     *
     * @param \Tekstove\TekstoveBundle\Model\Entity\Lyric|ObjectCollection $lyric The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildLyricRedirectQuery The current query, for fluid interface
     */
    public function filterByLyric($lyric, $comparison = null)
    {
        if ($lyric instanceof \Tekstove\TekstoveBundle\Model\Entity\Lyric) {
            return $this
                ->addUsingAlias(LyricRedirectTableMap::COL_REDIRECT_ID, $lyric->getId(), $comparison);
        } elseif ($lyric instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(LyricRedirectTableMap::COL_REDIRECT_ID, $lyric->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByLyric() only accepts arguments of type \Tekstove\TekstoveBundle\Model\Entity\Lyric or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Lyric relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildLyricRedirectQuery The current query, for fluid interface
     */
    public function joinLyric($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Lyric');

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
            $this->addJoinObject($join, 'Lyric');
        }

        return $this;
    }

    /**
     * Use the Lyric relation Lyric object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Tekstove\TekstoveBundle\Model\Entity\LyricQuery A secondary query class using the current class as primary query
     */
    public function useLyricQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinLyric($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Lyric', '\Tekstove\TekstoveBundle\Model\Entity\LyricQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildLyricRedirect $lyricRedirect Object to remove from the list of results
     *
     * @return $this|ChildLyricRedirectQuery The current query, for fluid interface
     */
    public function prune($lyricRedirect = null)
    {
        if ($lyricRedirect) {
            $this->addCond('pruneCond0', $this->getAliasedColName(LyricRedirectTableMap::COL_DELETED_ID), $lyricRedirect->getDeletedId(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond1', $this->getAliasedColName(LyricRedirectTableMap::COL_REDIRECT_ID), $lyricRedirect->getRedirectId(), Criteria::NOT_EQUAL);
            $this->combine(array('pruneCond0', 'pruneCond1'), Criteria::LOGICAL_OR);
        }

        return $this;
    }

    /**
     * Deletes all rows from the lyric_redirect table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(LyricRedirectTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            LyricRedirectTableMap::clearInstancePool();
            LyricRedirectTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(LyricRedirectTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(LyricRedirectTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            LyricRedirectTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            LyricRedirectTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // LyricRedirectQuery
