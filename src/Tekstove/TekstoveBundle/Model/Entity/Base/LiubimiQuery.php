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
use Tekstove\TekstoveBundle\Model\Entity\Liubimi as ChildLiubimi;
use Tekstove\TekstoveBundle\Model\Entity\LiubimiQuery as ChildLiubimiQuery;
use Tekstove\TekstoveBundle\Model\Entity\Map\LiubimiTableMap;

/**
 * Base class that represents a query for the 'liubimi' table.
 *
 *
 *
 * @method     ChildLiubimiQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildLiubimiQuery orderByUsername($order = Criteria::ASC) Order by the username column
 * @method     ChildLiubimiQuery orderByPesen($order = Criteria::ASC) Order by the pesen column
 *
 * @method     ChildLiubimiQuery groupById() Group by the id column
 * @method     ChildLiubimiQuery groupByUsername() Group by the username column
 * @method     ChildLiubimiQuery groupByPesen() Group by the pesen column
 *
 * @method     ChildLiubimiQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildLiubimiQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildLiubimiQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildLiubimiQuery leftJoinLyric($relationAlias = null) Adds a LEFT JOIN clause to the query using the Lyric relation
 * @method     ChildLiubimiQuery rightJoinLyric($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Lyric relation
 * @method     ChildLiubimiQuery innerJoinLyric($relationAlias = null) Adds a INNER JOIN clause to the query using the Lyric relation
 *
 * @method     \Tekstove\TekstoveBundle\Model\Entity\LyricQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildLiubimi findOne(ConnectionInterface $con = null) Return the first ChildLiubimi matching the query
 * @method     ChildLiubimi findOneOrCreate(ConnectionInterface $con = null) Return the first ChildLiubimi matching the query, or a new ChildLiubimi object populated from the query conditions when no match is found
 *
 * @method     ChildLiubimi findOneById(int $id) Return the first ChildLiubimi filtered by the id column
 * @method     ChildLiubimi findOneByUsername(int $username) Return the first ChildLiubimi filtered by the username column
 * @method     ChildLiubimi findOneByPesen(int $pesen) Return the first ChildLiubimi filtered by the pesen column *

 * @method     ChildLiubimi requirePk($key, ConnectionInterface $con = null) Return the ChildLiubimi by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLiubimi requireOne(ConnectionInterface $con = null) Return the first ChildLiubimi matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildLiubimi requireOneById(int $id) Return the first ChildLiubimi filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLiubimi requireOneByUsername(int $username) Return the first ChildLiubimi filtered by the username column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLiubimi requireOneByPesen(int $pesen) Return the first ChildLiubimi filtered by the pesen column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildLiubimi[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildLiubimi objects based on current ModelCriteria
 * @method     ChildLiubimi[]|ObjectCollection findById(int $id) Return ChildLiubimi objects filtered by the id column
 * @method     ChildLiubimi[]|ObjectCollection findByUsername(int $username) Return ChildLiubimi objects filtered by the username column
 * @method     ChildLiubimi[]|ObjectCollection findByPesen(int $pesen) Return ChildLiubimi objects filtered by the pesen column
 * @method     ChildLiubimi[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class LiubimiQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Tekstove\TekstoveBundle\Model\Entity\Base\LiubimiQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\Tekstove\\TekstoveBundle\\Model\\Entity\\Liubimi', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildLiubimiQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildLiubimiQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildLiubimiQuery) {
            return $criteria;
        }
        $query = new ChildLiubimiQuery();
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
     * @return ChildLiubimi|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = LiubimiTableMap::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(LiubimiTableMap::DATABASE_NAME);
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
     * @return ChildLiubimi A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, username, pesen FROM liubimi WHERE id = :p0';
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
            /** @var ChildLiubimi $obj */
            $obj = new ChildLiubimi();
            $obj->hydrate($row);
            LiubimiTableMap::addInstanceToPool($obj, (string) $key);
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
     * @return ChildLiubimi|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildLiubimiQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(LiubimiTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildLiubimiQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(LiubimiTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildLiubimiQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(LiubimiTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(LiubimiTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LiubimiTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the username column
     *
     * Example usage:
     * <code>
     * $query->filterByUsername(1234); // WHERE username = 1234
     * $query->filterByUsername(array(12, 34)); // WHERE username IN (12, 34)
     * $query->filterByUsername(array('min' => 12)); // WHERE username > 12
     * </code>
     *
     * @param     mixed $username The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildLiubimiQuery The current query, for fluid interface
     */
    public function filterByUsername($username = null, $comparison = null)
    {
        if (is_array($username)) {
            $useMinMax = false;
            if (isset($username['min'])) {
                $this->addUsingAlias(LiubimiTableMap::COL_USERNAME, $username['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($username['max'])) {
                $this->addUsingAlias(LiubimiTableMap::COL_USERNAME, $username['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LiubimiTableMap::COL_USERNAME, $username, $comparison);
    }

    /**
     * Filter the query on the pesen column
     *
     * Example usage:
     * <code>
     * $query->filterByPesen(1234); // WHERE pesen = 1234
     * $query->filterByPesen(array(12, 34)); // WHERE pesen IN (12, 34)
     * $query->filterByPesen(array('min' => 12)); // WHERE pesen > 12
     * </code>
     *
     * @see       filterByLyric()
     *
     * @param     mixed $pesen The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildLiubimiQuery The current query, for fluid interface
     */
    public function filterByPesen($pesen = null, $comparison = null)
    {
        if (is_array($pesen)) {
            $useMinMax = false;
            if (isset($pesen['min'])) {
                $this->addUsingAlias(LiubimiTableMap::COL_PESEN, $pesen['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($pesen['max'])) {
                $this->addUsingAlias(LiubimiTableMap::COL_PESEN, $pesen['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LiubimiTableMap::COL_PESEN, $pesen, $comparison);
    }

    /**
     * Filter the query by a related \Tekstove\TekstoveBundle\Model\Entity\Lyric object
     *
     * @param \Tekstove\TekstoveBundle\Model\Entity\Lyric|ObjectCollection $lyric The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildLiubimiQuery The current query, for fluid interface
     */
    public function filterByLyric($lyric, $comparison = null)
    {
        if ($lyric instanceof \Tekstove\TekstoveBundle\Model\Entity\Lyric) {
            return $this
                ->addUsingAlias(LiubimiTableMap::COL_PESEN, $lyric->getId(), $comparison);
        } elseif ($lyric instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(LiubimiTableMap::COL_PESEN, $lyric->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return $this|ChildLiubimiQuery The current query, for fluid interface
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
     * @param   ChildLiubimi $liubimi Object to remove from the list of results
     *
     * @return $this|ChildLiubimiQuery The current query, for fluid interface
     */
    public function prune($liubimi = null)
    {
        if ($liubimi) {
            $this->addUsingAlias(LiubimiTableMap::COL_ID, $liubimi->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the liubimi table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(LiubimiTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            LiubimiTableMap::clearInstancePool();
            LiubimiTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(LiubimiTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(LiubimiTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            LiubimiTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            LiubimiTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // LiubimiQuery
