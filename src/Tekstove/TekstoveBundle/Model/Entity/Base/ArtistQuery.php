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
use Tekstove\TekstoveBundle\Model\Entity\Artist as ChildArtist;
use Tekstove\TekstoveBundle\Model\Entity\ArtistQuery as ChildArtistQuery;
use Tekstove\TekstoveBundle\Model\Entity\Map\ArtistTableMap;

/**
 * Base class that represents a query for the 'artists' table.
 *
 *
 *
 * @method     ChildArtistQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method     ChildArtistQuery orderByNameAlternatives($order = Criteria::ASC) Order by the name_alternatives column
 * @method     ChildArtistQuery orderByAddedby($order = Criteria::ASC) Order by the addedby column
 * @method     ChildArtistQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildArtistQuery orderByRedirectToArtistId($order = Criteria::ASC) Order by the redirect_to_artist_id column
 * @method     ChildArtistQuery orderByForbidden($order = Criteria::ASC) Order by the forbidden column
 *
 * @method     ChildArtistQuery groupByName() Group by the name column
 * @method     ChildArtistQuery groupByNameAlternatives() Group by the name_alternatives column
 * @method     ChildArtistQuery groupByAddedby() Group by the addedby column
 * @method     ChildArtistQuery groupById() Group by the id column
 * @method     ChildArtistQuery groupByRedirectToArtistId() Group by the redirect_to_artist_id column
 * @method     ChildArtistQuery groupByForbidden() Group by the forbidden column
 *
 * @method     ChildArtistQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildArtistQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildArtistQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildArtistQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildArtistQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildArtistQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildArtistQuery leftJoinToday($relationAlias = null) Adds a LEFT JOIN clause to the query using the Today relation
 * @method     ChildArtistQuery rightJoinToday($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Today relation
 * @method     ChildArtistQuery innerJoinToday($relationAlias = null) Adds a INNER JOIN clause to the query using the Today relation
 *
 * @method     ChildArtistQuery joinWithToday($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Today relation
 *
 * @method     ChildArtistQuery leftJoinWithToday() Adds a LEFT JOIN clause and with to the query using the Today relation
 * @method     ChildArtistQuery rightJoinWithToday() Adds a RIGHT JOIN clause and with to the query using the Today relation
 * @method     ChildArtistQuery innerJoinWithToday() Adds a INNER JOIN clause and with to the query using the Today relation
 *
 * @method     ChildArtistQuery leftJoinLyricRelatedByArtist1($relationAlias = null) Adds a LEFT JOIN clause to the query using the LyricRelatedByArtist1 relation
 * @method     ChildArtistQuery rightJoinLyricRelatedByArtist1($relationAlias = null) Adds a RIGHT JOIN clause to the query using the LyricRelatedByArtist1 relation
 * @method     ChildArtistQuery innerJoinLyricRelatedByArtist1($relationAlias = null) Adds a INNER JOIN clause to the query using the LyricRelatedByArtist1 relation
 *
 * @method     ChildArtistQuery joinWithLyricRelatedByArtist1($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the LyricRelatedByArtist1 relation
 *
 * @method     ChildArtistQuery leftJoinWithLyricRelatedByArtist1() Adds a LEFT JOIN clause and with to the query using the LyricRelatedByArtist1 relation
 * @method     ChildArtistQuery rightJoinWithLyricRelatedByArtist1() Adds a RIGHT JOIN clause and with to the query using the LyricRelatedByArtist1 relation
 * @method     ChildArtistQuery innerJoinWithLyricRelatedByArtist1() Adds a INNER JOIN clause and with to the query using the LyricRelatedByArtist1 relation
 *
 * @method     ChildArtistQuery leftJoinLyricRelatedByArtist2($relationAlias = null) Adds a LEFT JOIN clause to the query using the LyricRelatedByArtist2 relation
 * @method     ChildArtistQuery rightJoinLyricRelatedByArtist2($relationAlias = null) Adds a RIGHT JOIN clause to the query using the LyricRelatedByArtist2 relation
 * @method     ChildArtistQuery innerJoinLyricRelatedByArtist2($relationAlias = null) Adds a INNER JOIN clause to the query using the LyricRelatedByArtist2 relation
 *
 * @method     ChildArtistQuery joinWithLyricRelatedByArtist2($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the LyricRelatedByArtist2 relation
 *
 * @method     ChildArtistQuery leftJoinWithLyricRelatedByArtist2() Adds a LEFT JOIN clause and with to the query using the LyricRelatedByArtist2 relation
 * @method     ChildArtistQuery rightJoinWithLyricRelatedByArtist2() Adds a RIGHT JOIN clause and with to the query using the LyricRelatedByArtist2 relation
 * @method     ChildArtistQuery innerJoinWithLyricRelatedByArtist2() Adds a INNER JOIN clause and with to the query using the LyricRelatedByArtist2 relation
 *
 * @method     ChildArtistQuery leftJoinLyricRelatedByArtist3($relationAlias = null) Adds a LEFT JOIN clause to the query using the LyricRelatedByArtist3 relation
 * @method     ChildArtistQuery rightJoinLyricRelatedByArtist3($relationAlias = null) Adds a RIGHT JOIN clause to the query using the LyricRelatedByArtist3 relation
 * @method     ChildArtistQuery innerJoinLyricRelatedByArtist3($relationAlias = null) Adds a INNER JOIN clause to the query using the LyricRelatedByArtist3 relation
 *
 * @method     ChildArtistQuery joinWithLyricRelatedByArtist3($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the LyricRelatedByArtist3 relation
 *
 * @method     ChildArtistQuery leftJoinWithLyricRelatedByArtist3() Adds a LEFT JOIN clause and with to the query using the LyricRelatedByArtist3 relation
 * @method     ChildArtistQuery rightJoinWithLyricRelatedByArtist3() Adds a RIGHT JOIN clause and with to the query using the LyricRelatedByArtist3 relation
 * @method     ChildArtistQuery innerJoinWithLyricRelatedByArtist3() Adds a INNER JOIN clause and with to the query using the LyricRelatedByArtist3 relation
 *
 * @method     ChildArtistQuery leftJoinLyricRelatedByArtist4($relationAlias = null) Adds a LEFT JOIN clause to the query using the LyricRelatedByArtist4 relation
 * @method     ChildArtistQuery rightJoinLyricRelatedByArtist4($relationAlias = null) Adds a RIGHT JOIN clause to the query using the LyricRelatedByArtist4 relation
 * @method     ChildArtistQuery innerJoinLyricRelatedByArtist4($relationAlias = null) Adds a INNER JOIN clause to the query using the LyricRelatedByArtist4 relation
 *
 * @method     ChildArtistQuery joinWithLyricRelatedByArtist4($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the LyricRelatedByArtist4 relation
 *
 * @method     ChildArtistQuery leftJoinWithLyricRelatedByArtist4() Adds a LEFT JOIN clause and with to the query using the LyricRelatedByArtist4 relation
 * @method     ChildArtistQuery rightJoinWithLyricRelatedByArtist4() Adds a RIGHT JOIN clause and with to the query using the LyricRelatedByArtist4 relation
 * @method     ChildArtistQuery innerJoinWithLyricRelatedByArtist4() Adds a INNER JOIN clause and with to the query using the LyricRelatedByArtist4 relation
 *
 * @method     ChildArtistQuery leftJoinLyricRelatedByArtist5($relationAlias = null) Adds a LEFT JOIN clause to the query using the LyricRelatedByArtist5 relation
 * @method     ChildArtistQuery rightJoinLyricRelatedByArtist5($relationAlias = null) Adds a RIGHT JOIN clause to the query using the LyricRelatedByArtist5 relation
 * @method     ChildArtistQuery innerJoinLyricRelatedByArtist5($relationAlias = null) Adds a INNER JOIN clause to the query using the LyricRelatedByArtist5 relation
 *
 * @method     ChildArtistQuery joinWithLyricRelatedByArtist5($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the LyricRelatedByArtist5 relation
 *
 * @method     ChildArtistQuery leftJoinWithLyricRelatedByArtist5() Adds a LEFT JOIN clause and with to the query using the LyricRelatedByArtist5 relation
 * @method     ChildArtistQuery rightJoinWithLyricRelatedByArtist5() Adds a RIGHT JOIN clause and with to the query using the LyricRelatedByArtist5 relation
 * @method     ChildArtistQuery innerJoinWithLyricRelatedByArtist5() Adds a INNER JOIN clause and with to the query using the LyricRelatedByArtist5 relation
 *
 * @method     ChildArtistQuery leftJoinLyricRelatedByArtist6($relationAlias = null) Adds a LEFT JOIN clause to the query using the LyricRelatedByArtist6 relation
 * @method     ChildArtistQuery rightJoinLyricRelatedByArtist6($relationAlias = null) Adds a RIGHT JOIN clause to the query using the LyricRelatedByArtist6 relation
 * @method     ChildArtistQuery innerJoinLyricRelatedByArtist6($relationAlias = null) Adds a INNER JOIN clause to the query using the LyricRelatedByArtist6 relation
 *
 * @method     ChildArtistQuery joinWithLyricRelatedByArtist6($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the LyricRelatedByArtist6 relation
 *
 * @method     ChildArtistQuery leftJoinWithLyricRelatedByArtist6() Adds a LEFT JOIN clause and with to the query using the LyricRelatedByArtist6 relation
 * @method     ChildArtistQuery rightJoinWithLyricRelatedByArtist6() Adds a RIGHT JOIN clause and with to the query using the LyricRelatedByArtist6 relation
 * @method     ChildArtistQuery innerJoinWithLyricRelatedByArtist6() Adds a INNER JOIN clause and with to the query using the LyricRelatedByArtist6 relation
 *
 * @method     \Tekstove\TekstoveBundle\Model\Entity\TodayQuery|\Tekstove\TekstoveBundle\Model\Entity\LyricQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildArtist findOne(ConnectionInterface $con = null) Return the first ChildArtist matching the query
 * @method     ChildArtist findOneOrCreate(ConnectionInterface $con = null) Return the first ChildArtist matching the query, or a new ChildArtist object populated from the query conditions when no match is found
 *
 * @method     ChildArtist findOneByName(string $name) Return the first ChildArtist filtered by the name column
 * @method     ChildArtist findOneByNameAlternatives(string $name_alternatives) Return the first ChildArtist filtered by the name_alternatives column
 * @method     ChildArtist findOneByAddedby(int $addedby) Return the first ChildArtist filtered by the addedby column
 * @method     ChildArtist findOneById(int $id) Return the first ChildArtist filtered by the id column
 * @method     ChildArtist findOneByRedirectToArtistId(int $redirect_to_artist_id) Return the first ChildArtist filtered by the redirect_to_artist_id column
 * @method     ChildArtist findOneByForbidden(boolean $forbidden) Return the first ChildArtist filtered by the forbidden column *

 * @method     ChildArtist requirePk($key, ConnectionInterface $con = null) Return the ChildArtist by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildArtist requireOne(ConnectionInterface $con = null) Return the first ChildArtist matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildArtist requireOneByName(string $name) Return the first ChildArtist filtered by the name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildArtist requireOneByNameAlternatives(string $name_alternatives) Return the first ChildArtist filtered by the name_alternatives column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildArtist requireOneByAddedby(int $addedby) Return the first ChildArtist filtered by the addedby column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildArtist requireOneById(int $id) Return the first ChildArtist filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildArtist requireOneByRedirectToArtistId(int $redirect_to_artist_id) Return the first ChildArtist filtered by the redirect_to_artist_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildArtist requireOneByForbidden(boolean $forbidden) Return the first ChildArtist filtered by the forbidden column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildArtist[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildArtist objects based on current ModelCriteria
 * @method     ChildArtist[]|ObjectCollection findByName(string $name) Return ChildArtist objects filtered by the name column
 * @method     ChildArtist[]|ObjectCollection findByNameAlternatives(string $name_alternatives) Return ChildArtist objects filtered by the name_alternatives column
 * @method     ChildArtist[]|ObjectCollection findByAddedby(int $addedby) Return ChildArtist objects filtered by the addedby column
 * @method     ChildArtist[]|ObjectCollection findById(int $id) Return ChildArtist objects filtered by the id column
 * @method     ChildArtist[]|ObjectCollection findByRedirectToArtistId(int $redirect_to_artist_id) Return ChildArtist objects filtered by the redirect_to_artist_id column
 * @method     ChildArtist[]|ObjectCollection findByForbidden(boolean $forbidden) Return ChildArtist objects filtered by the forbidden column
 * @method     ChildArtist[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class ArtistQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Tekstove\TekstoveBundle\Model\Entity\Base\ArtistQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\Tekstove\\TekstoveBundle\\Model\\Entity\\Artist', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildArtistQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildArtistQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildArtistQuery) {
            return $criteria;
        }
        $query = new ChildArtistQuery();
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
     * @return ChildArtist|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = ArtistTableMap::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(ArtistTableMap::DATABASE_NAME);
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
     * @return ChildArtist A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT name, name_alternatives, addedby, id, redirect_to_artist_id, forbidden FROM artists WHERE id = :p0';
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
            /** @var ChildArtist $obj */
            $obj = new ChildArtist();
            $obj->hydrate($row);
            ArtistTableMap::addInstanceToPool($obj, (string) $key);
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
     * @return ChildArtist|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildArtistQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(ArtistTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildArtistQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(ArtistTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildArtistQuery The current query, for fluid interface
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

        return $this->addUsingAlias(ArtistTableMap::COL_NAME, $name, $comparison);
    }

    /**
     * Filter the query on the name_alternatives column
     *
     * Example usage:
     * <code>
     * $query->filterByNameAlternatives('fooValue');   // WHERE name_alternatives = 'fooValue'
     * $query->filterByNameAlternatives('%fooValue%'); // WHERE name_alternatives LIKE '%fooValue%'
     * </code>
     *
     * @param     string $nameAlternatives The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildArtistQuery The current query, for fluid interface
     */
    public function filterByNameAlternatives($nameAlternatives = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($nameAlternatives)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $nameAlternatives)) {
                $nameAlternatives = str_replace('*', '%', $nameAlternatives);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ArtistTableMap::COL_NAME_ALTERNATIVES, $nameAlternatives, $comparison);
    }

    /**
     * Filter the query on the addedby column
     *
     * Example usage:
     * <code>
     * $query->filterByAddedby(1234); // WHERE addedby = 1234
     * $query->filterByAddedby(array(12, 34)); // WHERE addedby IN (12, 34)
     * $query->filterByAddedby(array('min' => 12)); // WHERE addedby > 12
     * </code>
     *
     * @param     mixed $addedby The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildArtistQuery The current query, for fluid interface
     */
    public function filterByAddedby($addedby = null, $comparison = null)
    {
        if (is_array($addedby)) {
            $useMinMax = false;
            if (isset($addedby['min'])) {
                $this->addUsingAlias(ArtistTableMap::COL_ADDEDBY, $addedby['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($addedby['max'])) {
                $this->addUsingAlias(ArtistTableMap::COL_ADDEDBY, $addedby['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ArtistTableMap::COL_ADDEDBY, $addedby, $comparison);
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
     * @return $this|ChildArtistQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(ArtistTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(ArtistTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ArtistTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the redirect_to_artist_id column
     *
     * Example usage:
     * <code>
     * $query->filterByRedirectToArtistId(1234); // WHERE redirect_to_artist_id = 1234
     * $query->filterByRedirectToArtistId(array(12, 34)); // WHERE redirect_to_artist_id IN (12, 34)
     * $query->filterByRedirectToArtistId(array('min' => 12)); // WHERE redirect_to_artist_id > 12
     * </code>
     *
     * @param     mixed $redirectToArtistId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildArtistQuery The current query, for fluid interface
     */
    public function filterByRedirectToArtistId($redirectToArtistId = null, $comparison = null)
    {
        if (is_array($redirectToArtistId)) {
            $useMinMax = false;
            if (isset($redirectToArtistId['min'])) {
                $this->addUsingAlias(ArtistTableMap::COL_REDIRECT_TO_ARTIST_ID, $redirectToArtistId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($redirectToArtistId['max'])) {
                $this->addUsingAlias(ArtistTableMap::COL_REDIRECT_TO_ARTIST_ID, $redirectToArtistId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ArtistTableMap::COL_REDIRECT_TO_ARTIST_ID, $redirectToArtistId, $comparison);
    }

    /**
     * Filter the query on the forbidden column
     *
     * Example usage:
     * <code>
     * $query->filterByForbidden(true); // WHERE forbidden = true
     * $query->filterByForbidden('yes'); // WHERE forbidden = true
     * </code>
     *
     * @param     boolean|string $forbidden The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildArtistQuery The current query, for fluid interface
     */
    public function filterByForbidden($forbidden = null, $comparison = null)
    {
        if (is_string($forbidden)) {
            $forbidden = in_array(strtolower($forbidden), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(ArtistTableMap::COL_FORBIDDEN, $forbidden, $comparison);
    }

    /**
     * Filter the query by a related \Tekstove\TekstoveBundle\Model\Entity\Today object
     *
     * @param \Tekstove\TekstoveBundle\Model\Entity\Today|ObjectCollection $today the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildArtistQuery The current query, for fluid interface
     */
    public function filterByToday($today, $comparison = null)
    {
        if ($today instanceof \Tekstove\TekstoveBundle\Model\Entity\Today) {
            return $this
                ->addUsingAlias(ArtistTableMap::COL_ID, $today->getArtistId(), $comparison);
        } elseif ($today instanceof ObjectCollection) {
            return $this
                ->useTodayQuery()
                ->filterByPrimaryKeys($today->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByToday() only accepts arguments of type \Tekstove\TekstoveBundle\Model\Entity\Today or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Today relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildArtistQuery The current query, for fluid interface
     */
    public function joinToday($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Today');

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
            $this->addJoinObject($join, 'Today');
        }

        return $this;
    }

    /**
     * Use the Today relation Today object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Tekstove\TekstoveBundle\Model\Entity\TodayQuery A secondary query class using the current class as primary query
     */
    public function useTodayQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinToday($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Today', '\Tekstove\TekstoveBundle\Model\Entity\TodayQuery');
    }

    /**
     * Filter the query by a related \Tekstove\TekstoveBundle\Model\Entity\Lyric object
     *
     * @param \Tekstove\TekstoveBundle\Model\Entity\Lyric|ObjectCollection $lyric the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildArtistQuery The current query, for fluid interface
     */
    public function filterByLyricRelatedByArtist1($lyric, $comparison = null)
    {
        if ($lyric instanceof \Tekstove\TekstoveBundle\Model\Entity\Lyric) {
            return $this
                ->addUsingAlias(ArtistTableMap::COL_ID, $lyric->getArtist1(), $comparison);
        } elseif ($lyric instanceof ObjectCollection) {
            return $this
                ->useLyricRelatedByArtist1Query()
                ->filterByPrimaryKeys($lyric->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByLyricRelatedByArtist1() only accepts arguments of type \Tekstove\TekstoveBundle\Model\Entity\Lyric or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the LyricRelatedByArtist1 relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildArtistQuery The current query, for fluid interface
     */
    public function joinLyricRelatedByArtist1($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('LyricRelatedByArtist1');

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
            $this->addJoinObject($join, 'LyricRelatedByArtist1');
        }

        return $this;
    }

    /**
     * Use the LyricRelatedByArtist1 relation Lyric object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Tekstove\TekstoveBundle\Model\Entity\LyricQuery A secondary query class using the current class as primary query
     */
    public function useLyricRelatedByArtist1Query($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinLyricRelatedByArtist1($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'LyricRelatedByArtist1', '\Tekstove\TekstoveBundle\Model\Entity\LyricQuery');
    }

    /**
     * Filter the query by a related \Tekstove\TekstoveBundle\Model\Entity\Lyric object
     *
     * @param \Tekstove\TekstoveBundle\Model\Entity\Lyric|ObjectCollection $lyric the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildArtistQuery The current query, for fluid interface
     */
    public function filterByLyricRelatedByArtist2($lyric, $comparison = null)
    {
        if ($lyric instanceof \Tekstove\TekstoveBundle\Model\Entity\Lyric) {
            return $this
                ->addUsingAlias(ArtistTableMap::COL_ID, $lyric->getArtist2(), $comparison);
        } elseif ($lyric instanceof ObjectCollection) {
            return $this
                ->useLyricRelatedByArtist2Query()
                ->filterByPrimaryKeys($lyric->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByLyricRelatedByArtist2() only accepts arguments of type \Tekstove\TekstoveBundle\Model\Entity\Lyric or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the LyricRelatedByArtist2 relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildArtistQuery The current query, for fluid interface
     */
    public function joinLyricRelatedByArtist2($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('LyricRelatedByArtist2');

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
            $this->addJoinObject($join, 'LyricRelatedByArtist2');
        }

        return $this;
    }

    /**
     * Use the LyricRelatedByArtist2 relation Lyric object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Tekstove\TekstoveBundle\Model\Entity\LyricQuery A secondary query class using the current class as primary query
     */
    public function useLyricRelatedByArtist2Query($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinLyricRelatedByArtist2($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'LyricRelatedByArtist2', '\Tekstove\TekstoveBundle\Model\Entity\LyricQuery');
    }

    /**
     * Filter the query by a related \Tekstove\TekstoveBundle\Model\Entity\Lyric object
     *
     * @param \Tekstove\TekstoveBundle\Model\Entity\Lyric|ObjectCollection $lyric the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildArtistQuery The current query, for fluid interface
     */
    public function filterByLyricRelatedByArtist3($lyric, $comparison = null)
    {
        if ($lyric instanceof \Tekstove\TekstoveBundle\Model\Entity\Lyric) {
            return $this
                ->addUsingAlias(ArtistTableMap::COL_ID, $lyric->getArtist3(), $comparison);
        } elseif ($lyric instanceof ObjectCollection) {
            return $this
                ->useLyricRelatedByArtist3Query()
                ->filterByPrimaryKeys($lyric->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByLyricRelatedByArtist3() only accepts arguments of type \Tekstove\TekstoveBundle\Model\Entity\Lyric or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the LyricRelatedByArtist3 relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildArtistQuery The current query, for fluid interface
     */
    public function joinLyricRelatedByArtist3($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('LyricRelatedByArtist3');

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
            $this->addJoinObject($join, 'LyricRelatedByArtist3');
        }

        return $this;
    }

    /**
     * Use the LyricRelatedByArtist3 relation Lyric object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Tekstove\TekstoveBundle\Model\Entity\LyricQuery A secondary query class using the current class as primary query
     */
    public function useLyricRelatedByArtist3Query($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinLyricRelatedByArtist3($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'LyricRelatedByArtist3', '\Tekstove\TekstoveBundle\Model\Entity\LyricQuery');
    }

    /**
     * Filter the query by a related \Tekstove\TekstoveBundle\Model\Entity\Lyric object
     *
     * @param \Tekstove\TekstoveBundle\Model\Entity\Lyric|ObjectCollection $lyric the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildArtistQuery The current query, for fluid interface
     */
    public function filterByLyricRelatedByArtist4($lyric, $comparison = null)
    {
        if ($lyric instanceof \Tekstove\TekstoveBundle\Model\Entity\Lyric) {
            return $this
                ->addUsingAlias(ArtistTableMap::COL_ID, $lyric->getArtist4(), $comparison);
        } elseif ($lyric instanceof ObjectCollection) {
            return $this
                ->useLyricRelatedByArtist4Query()
                ->filterByPrimaryKeys($lyric->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByLyricRelatedByArtist4() only accepts arguments of type \Tekstove\TekstoveBundle\Model\Entity\Lyric or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the LyricRelatedByArtist4 relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildArtistQuery The current query, for fluid interface
     */
    public function joinLyricRelatedByArtist4($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('LyricRelatedByArtist4');

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
            $this->addJoinObject($join, 'LyricRelatedByArtist4');
        }

        return $this;
    }

    /**
     * Use the LyricRelatedByArtist4 relation Lyric object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Tekstove\TekstoveBundle\Model\Entity\LyricQuery A secondary query class using the current class as primary query
     */
    public function useLyricRelatedByArtist4Query($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinLyricRelatedByArtist4($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'LyricRelatedByArtist4', '\Tekstove\TekstoveBundle\Model\Entity\LyricQuery');
    }

    /**
     * Filter the query by a related \Tekstove\TekstoveBundle\Model\Entity\Lyric object
     *
     * @param \Tekstove\TekstoveBundle\Model\Entity\Lyric|ObjectCollection $lyric the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildArtistQuery The current query, for fluid interface
     */
    public function filterByLyricRelatedByArtist5($lyric, $comparison = null)
    {
        if ($lyric instanceof \Tekstove\TekstoveBundle\Model\Entity\Lyric) {
            return $this
                ->addUsingAlias(ArtistTableMap::COL_ID, $lyric->getArtist5(), $comparison);
        } elseif ($lyric instanceof ObjectCollection) {
            return $this
                ->useLyricRelatedByArtist5Query()
                ->filterByPrimaryKeys($lyric->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByLyricRelatedByArtist5() only accepts arguments of type \Tekstove\TekstoveBundle\Model\Entity\Lyric or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the LyricRelatedByArtist5 relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildArtistQuery The current query, for fluid interface
     */
    public function joinLyricRelatedByArtist5($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('LyricRelatedByArtist5');

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
            $this->addJoinObject($join, 'LyricRelatedByArtist5');
        }

        return $this;
    }

    /**
     * Use the LyricRelatedByArtist5 relation Lyric object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Tekstove\TekstoveBundle\Model\Entity\LyricQuery A secondary query class using the current class as primary query
     */
    public function useLyricRelatedByArtist5Query($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinLyricRelatedByArtist5($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'LyricRelatedByArtist5', '\Tekstove\TekstoveBundle\Model\Entity\LyricQuery');
    }

    /**
     * Filter the query by a related \Tekstove\TekstoveBundle\Model\Entity\Lyric object
     *
     * @param \Tekstove\TekstoveBundle\Model\Entity\Lyric|ObjectCollection $lyric the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildArtistQuery The current query, for fluid interface
     */
    public function filterByLyricRelatedByArtist6($lyric, $comparison = null)
    {
        if ($lyric instanceof \Tekstove\TekstoveBundle\Model\Entity\Lyric) {
            return $this
                ->addUsingAlias(ArtistTableMap::COL_ID, $lyric->getArtist6(), $comparison);
        } elseif ($lyric instanceof ObjectCollection) {
            return $this
                ->useLyricRelatedByArtist6Query()
                ->filterByPrimaryKeys($lyric->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByLyricRelatedByArtist6() only accepts arguments of type \Tekstove\TekstoveBundle\Model\Entity\Lyric or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the LyricRelatedByArtist6 relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildArtistQuery The current query, for fluid interface
     */
    public function joinLyricRelatedByArtist6($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('LyricRelatedByArtist6');

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
            $this->addJoinObject($join, 'LyricRelatedByArtist6');
        }

        return $this;
    }

    /**
     * Use the LyricRelatedByArtist6 relation Lyric object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Tekstove\TekstoveBundle\Model\Entity\LyricQuery A secondary query class using the current class as primary query
     */
    public function useLyricRelatedByArtist6Query($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinLyricRelatedByArtist6($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'LyricRelatedByArtist6', '\Tekstove\TekstoveBundle\Model\Entity\LyricQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildArtist $artist Object to remove from the list of results
     *
     * @return $this|ChildArtistQuery The current query, for fluid interface
     */
    public function prune($artist = null)
    {
        if ($artist) {
            $this->addUsingAlias(ArtistTableMap::COL_ID, $artist->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the artists table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ArtistTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            ArtistTableMap::clearInstancePool();
            ArtistTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(ArtistTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(ArtistTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            ArtistTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            ArtistTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // ArtistQuery
