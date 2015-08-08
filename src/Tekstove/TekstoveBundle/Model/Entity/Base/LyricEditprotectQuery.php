<?php

namespace Tekstove\TekstoveBundle\Model\Entity\Base;

use \Exception;
use \PDO;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;
use Tekstove\TekstoveBundle\Model\Entity\LyricEditprotect as ChildLyricEditprotect;
use Tekstove\TekstoveBundle\Model\Entity\LyricEditprotectQuery as ChildLyricEditprotectQuery;
use Tekstove\TekstoveBundle\Model\Entity\Map\LyricEditprotectTableMap;

/**
 * Base class that represents a query for the 'lyric_editprotect' table.
 *
 *
 *
 * @method     ChildLyricEditprotectQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildLyricEditprotectQuery orderByPesenId($order = Criteria::ASC) Order by the pesen_id column
 * @method     ChildLyricEditprotectQuery orderByUserId($order = Criteria::ASC) Order by the user_id column
 * @method     ChildLyricEditprotectQuery orderByVreme($order = Criteria::ASC) Order by the vreme column
 *
 * @method     ChildLyricEditprotectQuery groupById() Group by the id column
 * @method     ChildLyricEditprotectQuery groupByPesenId() Group by the pesen_id column
 * @method     ChildLyricEditprotectQuery groupByUserId() Group by the user_id column
 * @method     ChildLyricEditprotectQuery groupByVreme() Group by the vreme column
 *
 * @method     ChildLyricEditprotectQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildLyricEditprotectQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildLyricEditprotectQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildLyricEditprotectQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildLyricEditprotectQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildLyricEditprotectQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildLyricEditprotect findOne(ConnectionInterface $con = null) Return the first ChildLyricEditprotect matching the query
 * @method     ChildLyricEditprotect findOneOrCreate(ConnectionInterface $con = null) Return the first ChildLyricEditprotect matching the query, or a new ChildLyricEditprotect object populated from the query conditions when no match is found
 *
 * @method     ChildLyricEditprotect findOneById(int $id) Return the first ChildLyricEditprotect filtered by the id column
 * @method     ChildLyricEditprotect findOneByPesenId(int $pesen_id) Return the first ChildLyricEditprotect filtered by the pesen_id column
 * @method     ChildLyricEditprotect findOneByUserId(int $user_id) Return the first ChildLyricEditprotect filtered by the user_id column
 * @method     ChildLyricEditprotect findOneByVreme(string $vreme) Return the first ChildLyricEditprotect filtered by the vreme column *

 * @method     ChildLyricEditprotect requirePk($key, ConnectionInterface $con = null) Return the ChildLyricEditprotect by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLyricEditprotect requireOne(ConnectionInterface $con = null) Return the first ChildLyricEditprotect matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildLyricEditprotect requireOneById(int $id) Return the first ChildLyricEditprotect filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLyricEditprotect requireOneByPesenId(int $pesen_id) Return the first ChildLyricEditprotect filtered by the pesen_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLyricEditprotect requireOneByUserId(int $user_id) Return the first ChildLyricEditprotect filtered by the user_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLyricEditprotect requireOneByVreme(string $vreme) Return the first ChildLyricEditprotect filtered by the vreme column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildLyricEditprotect[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildLyricEditprotect objects based on current ModelCriteria
 * @method     ChildLyricEditprotect[]|ObjectCollection findById(int $id) Return ChildLyricEditprotect objects filtered by the id column
 * @method     ChildLyricEditprotect[]|ObjectCollection findByPesenId(int $pesen_id) Return ChildLyricEditprotect objects filtered by the pesen_id column
 * @method     ChildLyricEditprotect[]|ObjectCollection findByUserId(int $user_id) Return ChildLyricEditprotect objects filtered by the user_id column
 * @method     ChildLyricEditprotect[]|ObjectCollection findByVreme(string $vreme) Return ChildLyricEditprotect objects filtered by the vreme column
 * @method     ChildLyricEditprotect[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class LyricEditprotectQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Tekstove\TekstoveBundle\Model\Entity\Base\LyricEditprotectQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\Tekstove\\TekstoveBundle\\Model\\Entity\\LyricEditprotect', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildLyricEditprotectQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildLyricEditprotectQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildLyricEditprotectQuery) {
            return $criteria;
        }
        $query = new ChildLyricEditprotectQuery();
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
     * @return ChildLyricEditprotect|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = LyricEditprotectTableMap::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(LyricEditprotectTableMap::DATABASE_NAME);
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
     * @return ChildLyricEditprotect A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, pesen_id, user_id, vreme FROM lyric_editprotect WHERE id = :p0';
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
            /** @var ChildLyricEditprotect $obj */
            $obj = new ChildLyricEditprotect();
            $obj->hydrate($row);
            LyricEditprotectTableMap::addInstanceToPool($obj, (string) $key);
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
     * @return ChildLyricEditprotect|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildLyricEditprotectQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(LyricEditprotectTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildLyricEditprotectQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(LyricEditprotectTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildLyricEditprotectQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(LyricEditprotectTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(LyricEditprotectTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LyricEditprotectTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the pesen_id column
     *
     * Example usage:
     * <code>
     * $query->filterByPesenId(1234); // WHERE pesen_id = 1234
     * $query->filterByPesenId(array(12, 34)); // WHERE pesen_id IN (12, 34)
     * $query->filterByPesenId(array('min' => 12)); // WHERE pesen_id > 12
     * </code>
     *
     * @param     mixed $pesenId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildLyricEditprotectQuery The current query, for fluid interface
     */
    public function filterByPesenId($pesenId = null, $comparison = null)
    {
        if (is_array($pesenId)) {
            $useMinMax = false;
            if (isset($pesenId['min'])) {
                $this->addUsingAlias(LyricEditprotectTableMap::COL_PESEN_ID, $pesenId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($pesenId['max'])) {
                $this->addUsingAlias(LyricEditprotectTableMap::COL_PESEN_ID, $pesenId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LyricEditprotectTableMap::COL_PESEN_ID, $pesenId, $comparison);
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
     * @return $this|ChildLyricEditprotectQuery The current query, for fluid interface
     */
    public function filterByUserId($userId = null, $comparison = null)
    {
        if (is_array($userId)) {
            $useMinMax = false;
            if (isset($userId['min'])) {
                $this->addUsingAlias(LyricEditprotectTableMap::COL_USER_ID, $userId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($userId['max'])) {
                $this->addUsingAlias(LyricEditprotectTableMap::COL_USER_ID, $userId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LyricEditprotectTableMap::COL_USER_ID, $userId, $comparison);
    }

    /**
     * Filter the query on the vreme column
     *
     * Example usage:
     * <code>
     * $query->filterByVreme('2011-03-14'); // WHERE vreme = '2011-03-14'
     * $query->filterByVreme('now'); // WHERE vreme = '2011-03-14'
     * $query->filterByVreme(array('max' => 'yesterday')); // WHERE vreme > '2011-03-13'
     * </code>
     *
     * @param     mixed $vreme The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildLyricEditprotectQuery The current query, for fluid interface
     */
    public function filterByVreme($vreme = null, $comparison = null)
    {
        if (is_array($vreme)) {
            $useMinMax = false;
            if (isset($vreme['min'])) {
                $this->addUsingAlias(LyricEditprotectTableMap::COL_VREME, $vreme['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($vreme['max'])) {
                $this->addUsingAlias(LyricEditprotectTableMap::COL_VREME, $vreme['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LyricEditprotectTableMap::COL_VREME, $vreme, $comparison);
    }

    /**
     * Exclude object from result
     *
     * @param   ChildLyricEditprotect $lyricEditprotect Object to remove from the list of results
     *
     * @return $this|ChildLyricEditprotectQuery The current query, for fluid interface
     */
    public function prune($lyricEditprotect = null)
    {
        if ($lyricEditprotect) {
            $this->addUsingAlias(LyricEditprotectTableMap::COL_ID, $lyricEditprotect->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the lyric_editprotect table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(LyricEditprotectTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            LyricEditprotectTableMap::clearInstancePool();
            LyricEditprotectTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(LyricEditprotectTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(LyricEditprotectTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            LyricEditprotectTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            LyricEditprotectTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // LyricEditprotectQuery
