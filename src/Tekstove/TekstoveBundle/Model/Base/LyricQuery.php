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
use Tekstove\TekstoveBundle\Model\Lyric as ChildLyric;
use Tekstove\TekstoveBundle\Model\LyricQuery as ChildLyricQuery;
use Tekstove\TekstoveBundle\Model\Map\LyricTableMap;

/**
 * Base class that represents a query for the 'lyric' table.
 *
 *
 *
 * @method     ChildLyricQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildLyricQuery orderByTitle($order = Criteria::ASC) Order by the title column
 * @method     ChildLyricQuery orderByText($order = Criteria::ASC) Order by the text column
 * @method     ChildLyricQuery orderBytextBg($order = Criteria::ASC) Order by the text_bg column
 * @method     ChildLyricQuery orderByViews($order = Criteria::ASC) Order by the views column
 * @method     ChildLyricQuery orderByPopularity($order = Criteria::ASC) Order by the popularity column
 *
 * @method     ChildLyricQuery groupById() Group by the id column
 * @method     ChildLyricQuery groupByTitle() Group by the title column
 * @method     ChildLyricQuery groupByText() Group by the text column
 * @method     ChildLyricQuery groupBytextBg() Group by the text_bg column
 * @method     ChildLyricQuery groupByViews() Group by the views column
 * @method     ChildLyricQuery groupByPopularity() Group by the popularity column
 *
 * @method     ChildLyricQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildLyricQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildLyricQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildLyricQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildLyricQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildLyricQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildLyric findOne(ConnectionInterface $con = null) Return the first ChildLyric matching the query
 * @method     ChildLyric findOneOrCreate(ConnectionInterface $con = null) Return the first ChildLyric matching the query, or a new ChildLyric object populated from the query conditions when no match is found
 *
 * @method     ChildLyric findOneById(int $id) Return the first ChildLyric filtered by the id column
 * @method     ChildLyric findOneByTitle(string $title) Return the first ChildLyric filtered by the title column
 * @method     ChildLyric findOneByText(string $text) Return the first ChildLyric filtered by the text column
 * @method     ChildLyric findOneBytextBg(string $text_bg) Return the first ChildLyric filtered by the text_bg column
 * @method     ChildLyric findOneByViews(int $views) Return the first ChildLyric filtered by the views column
 * @method     ChildLyric findOneByPopularity(int $popularity) Return the first ChildLyric filtered by the popularity column *

 * @method     ChildLyric requirePk($key, ConnectionInterface $con = null) Return the ChildLyric by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLyric requireOne(ConnectionInterface $con = null) Return the first ChildLyric matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildLyric requireOneById(int $id) Return the first ChildLyric filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLyric requireOneByTitle(string $title) Return the first ChildLyric filtered by the title column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLyric requireOneByText(string $text) Return the first ChildLyric filtered by the text column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLyric requireOneBytextBg(string $text_bg) Return the first ChildLyric filtered by the text_bg column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLyric requireOneByViews(int $views) Return the first ChildLyric filtered by the views column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLyric requireOneByPopularity(int $popularity) Return the first ChildLyric filtered by the popularity column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildLyric[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildLyric objects based on current ModelCriteria
 * @method     ChildLyric[]|ObjectCollection findById(int $id) Return ChildLyric objects filtered by the id column
 * @method     ChildLyric[]|ObjectCollection findByTitle(string $title) Return ChildLyric objects filtered by the title column
 * @method     ChildLyric[]|ObjectCollection findByText(string $text) Return ChildLyric objects filtered by the text column
 * @method     ChildLyric[]|ObjectCollection findBytextBg(string $text_bg) Return ChildLyric objects filtered by the text_bg column
 * @method     ChildLyric[]|ObjectCollection findByViews(int $views) Return ChildLyric objects filtered by the views column
 * @method     ChildLyric[]|ObjectCollection findByPopularity(int $popularity) Return ChildLyric objects filtered by the popularity column
 * @method     ChildLyric[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class LyricQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Tekstove\TekstoveBundle\Model\Base\LyricQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\Tekstove\\TekstoveBundle\\Model\\Lyric', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildLyricQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildLyricQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildLyricQuery) {
            return $criteria;
        }
        $query = new ChildLyricQuery();
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
     * @return ChildLyric|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = LyricTableMap::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(LyricTableMap::DATABASE_NAME);
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
     * @return ChildLyric A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, title, text, text_bg, views, popularity FROM lyric WHERE id = :p0';
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
            /** @var ChildLyric $obj */
            $obj = new ChildLyric();
            $obj->hydrate($row);
            LyricTableMap::addInstanceToPool($obj, (string) $key);
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
     * @return ChildLyric|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildLyricQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(LyricTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildLyricQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(LyricTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildLyricQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(LyricTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(LyricTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LyricTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the title column
     *
     * Example usage:
     * <code>
     * $query->filterByTitle('fooValue');   // WHERE title = 'fooValue'
     * $query->filterByTitle('%fooValue%'); // WHERE title LIKE '%fooValue%'
     * </code>
     *
     * @param     string $title The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildLyricQuery The current query, for fluid interface
     */
    public function filterByTitle($title = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($title)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $title)) {
                $title = str_replace('*', '%', $title);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(LyricTableMap::COL_TITLE, $title, $comparison);
    }

    /**
     * Filter the query on the text column
     *
     * Example usage:
     * <code>
     * $query->filterByText('fooValue');   // WHERE text = 'fooValue'
     * $query->filterByText('%fooValue%'); // WHERE text LIKE '%fooValue%'
     * </code>
     *
     * @param     string $text The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildLyricQuery The current query, for fluid interface
     */
    public function filterByText($text = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($text)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $text)) {
                $text = str_replace('*', '%', $text);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(LyricTableMap::COL_TEXT, $text, $comparison);
    }

    /**
     * Filter the query on the text_bg column
     *
     * Example usage:
     * <code>
     * $query->filterBytextBg('fooValue');   // WHERE text_bg = 'fooValue'
     * $query->filterBytextBg('%fooValue%'); // WHERE text_bg LIKE '%fooValue%'
     * </code>
     *
     * @param     string $textBg The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildLyricQuery The current query, for fluid interface
     */
    public function filterBytextBg($textBg = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($textBg)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $textBg)) {
                $textBg = str_replace('*', '%', $textBg);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(LyricTableMap::COL_TEXT_BG, $textBg, $comparison);
    }

    /**
     * Filter the query on the views column
     *
     * Example usage:
     * <code>
     * $query->filterByViews(1234); // WHERE views = 1234
     * $query->filterByViews(array(12, 34)); // WHERE views IN (12, 34)
     * $query->filterByViews(array('min' => 12)); // WHERE views > 12
     * </code>
     *
     * @param     mixed $views The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildLyricQuery The current query, for fluid interface
     */
    public function filterByViews($views = null, $comparison = null)
    {
        if (is_array($views)) {
            $useMinMax = false;
            if (isset($views['min'])) {
                $this->addUsingAlias(LyricTableMap::COL_VIEWS, $views['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($views['max'])) {
                $this->addUsingAlias(LyricTableMap::COL_VIEWS, $views['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LyricTableMap::COL_VIEWS, $views, $comparison);
    }

    /**
     * Filter the query on the popularity column
     *
     * Example usage:
     * <code>
     * $query->filterByPopularity(1234); // WHERE popularity = 1234
     * $query->filterByPopularity(array(12, 34)); // WHERE popularity IN (12, 34)
     * $query->filterByPopularity(array('min' => 12)); // WHERE popularity > 12
     * </code>
     *
     * @param     mixed $popularity The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildLyricQuery The current query, for fluid interface
     */
    public function filterByPopularity($popularity = null, $comparison = null)
    {
        if (is_array($popularity)) {
            $useMinMax = false;
            if (isset($popularity['min'])) {
                $this->addUsingAlias(LyricTableMap::COL_POPULARITY, $popularity['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($popularity['max'])) {
                $this->addUsingAlias(LyricTableMap::COL_POPULARITY, $popularity['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LyricTableMap::COL_POPULARITY, $popularity, $comparison);
    }

    /**
     * Exclude object from result
     *
     * @param   ChildLyric $lyric Object to remove from the list of results
     *
     * @return $this|ChildLyricQuery The current query, for fluid interface
     */
    public function prune($lyric = null)
    {
        if ($lyric) {
            $this->addUsingAlias(LyricTableMap::COL_ID, $lyric->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the lyric table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(LyricTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            LyricTableMap::clearInstancePool();
            LyricTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(LyricTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(LyricTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            LyricTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            LyricTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // LyricQuery
