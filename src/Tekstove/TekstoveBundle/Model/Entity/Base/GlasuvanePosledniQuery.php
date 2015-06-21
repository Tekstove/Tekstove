<?php

namespace Tekstove\TekstoveBundle\Model\Entity\Base;

use \Exception;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\LogicException;
use Propel\Runtime\Exception\PropelException;
use Tekstove\TekstoveBundle\Model\Entity\GlasuvanePosledni as ChildGlasuvanePosledni;
use Tekstove\TekstoveBundle\Model\Entity\GlasuvanePosledniQuery as ChildGlasuvanePosledniQuery;
use Tekstove\TekstoveBundle\Model\Entity\Map\GlasuvanePosledniTableMap;

/**
 * Base class that represents a query for the 'glasuvane_posledni' table.
 *
 *
 *
 * @method     ChildGlasuvanePosledniQuery orderByText($order = Criteria::ASC) Order by the text column
 * @method     ChildGlasuvanePosledniQuery orderByDate($order = Criteria::ASC) Order by the date column
 * @method     ChildGlasuvanePosledniQuery orderByZa($order = Criteria::ASC) Order by the za column
 *
 * @method     ChildGlasuvanePosledniQuery groupByText() Group by the text column
 * @method     ChildGlasuvanePosledniQuery groupByDate() Group by the date column
 * @method     ChildGlasuvanePosledniQuery groupByZa() Group by the za column
 *
 * @method     ChildGlasuvanePosledniQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildGlasuvanePosledniQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildGlasuvanePosledniQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildGlasuvanePosledni findOne(ConnectionInterface $con = null) Return the first ChildGlasuvanePosledni matching the query
 * @method     ChildGlasuvanePosledni findOneOrCreate(ConnectionInterface $con = null) Return the first ChildGlasuvanePosledni matching the query, or a new ChildGlasuvanePosledni object populated from the query conditions when no match is found
 *
 * @method     ChildGlasuvanePosledni findOneByText(string $text) Return the first ChildGlasuvanePosledni filtered by the text column
 * @method     ChildGlasuvanePosledni findOneByDate(string $date) Return the first ChildGlasuvanePosledni filtered by the date column
 * @method     ChildGlasuvanePosledni findOneByZa(int $za) Return the first ChildGlasuvanePosledni filtered by the za column *

 * @method     ChildGlasuvanePosledni requirePk($key, ConnectionInterface $con = null) Return the ChildGlasuvanePosledni by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGlasuvanePosledni requireOne(ConnectionInterface $con = null) Return the first ChildGlasuvanePosledni matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildGlasuvanePosledni requireOneByText(string $text) Return the first ChildGlasuvanePosledni filtered by the text column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGlasuvanePosledni requireOneByDate(string $date) Return the first ChildGlasuvanePosledni filtered by the date column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGlasuvanePosledni requireOneByZa(int $za) Return the first ChildGlasuvanePosledni filtered by the za column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildGlasuvanePosledni[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildGlasuvanePosledni objects based on current ModelCriteria
 * @method     ChildGlasuvanePosledni[]|ObjectCollection findByText(string $text) Return ChildGlasuvanePosledni objects filtered by the text column
 * @method     ChildGlasuvanePosledni[]|ObjectCollection findByDate(string $date) Return ChildGlasuvanePosledni objects filtered by the date column
 * @method     ChildGlasuvanePosledni[]|ObjectCollection findByZa(int $za) Return ChildGlasuvanePosledni objects filtered by the za column
 * @method     ChildGlasuvanePosledni[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class GlasuvanePosledniQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Tekstove\TekstoveBundle\Model\Entity\Base\GlasuvanePosledniQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\Tekstove\\TekstoveBundle\\Model\\Entity\\GlasuvanePosledni', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildGlasuvanePosledniQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildGlasuvanePosledniQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildGlasuvanePosledniQuery) {
            return $criteria;
        }
        $query = new ChildGlasuvanePosledniQuery();
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
     * @return ChildGlasuvanePosledni|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        throw new LogicException('The GlasuvanePosledni object has no primary key');
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
        throw new LogicException('The GlasuvanePosledni object has no primary key');
    }

    /**
     * Filter the query by primary key
     *
     * @param     mixed $key Primary key to use for the query
     *
     * @return $this|ChildGlasuvanePosledniQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {
        throw new LogicException('The GlasuvanePosledni object has no primary key');
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildGlasuvanePosledniQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {
        throw new LogicException('The GlasuvanePosledni object has no primary key');
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
     * @return $this|ChildGlasuvanePosledniQuery The current query, for fluid interface
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

        return $this->addUsingAlias(GlasuvanePosledniTableMap::COL_TEXT, $text, $comparison);
    }

    /**
     * Filter the query on the date column
     *
     * Example usage:
     * <code>
     * $query->filterByDate('2011-03-14'); // WHERE date = '2011-03-14'
     * $query->filterByDate('now'); // WHERE date = '2011-03-14'
     * $query->filterByDate(array('max' => 'yesterday')); // WHERE date > '2011-03-13'
     * </code>
     *
     * @param     mixed $date The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildGlasuvanePosledniQuery The current query, for fluid interface
     */
    public function filterByDate($date = null, $comparison = null)
    {
        if (is_array($date)) {
            $useMinMax = false;
            if (isset($date['min'])) {
                $this->addUsingAlias(GlasuvanePosledniTableMap::COL_DATE, $date['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($date['max'])) {
                $this->addUsingAlias(GlasuvanePosledniTableMap::COL_DATE, $date['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(GlasuvanePosledniTableMap::COL_DATE, $date, $comparison);
    }

    /**
     * Filter the query on the za column
     *
     * Example usage:
     * <code>
     * $query->filterByZa(1234); // WHERE za = 1234
     * $query->filterByZa(array(12, 34)); // WHERE za IN (12, 34)
     * $query->filterByZa(array('min' => 12)); // WHERE za > 12
     * </code>
     *
     * @param     mixed $za The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildGlasuvanePosledniQuery The current query, for fluid interface
     */
    public function filterByZa($za = null, $comparison = null)
    {
        if (is_array($za)) {
            $useMinMax = false;
            if (isset($za['min'])) {
                $this->addUsingAlias(GlasuvanePosledniTableMap::COL_ZA, $za['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($za['max'])) {
                $this->addUsingAlias(GlasuvanePosledniTableMap::COL_ZA, $za['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(GlasuvanePosledniTableMap::COL_ZA, $za, $comparison);
    }

    /**
     * Exclude object from result
     *
     * @param   ChildGlasuvanePosledni $glasuvanePosledni Object to remove from the list of results
     *
     * @return $this|ChildGlasuvanePosledniQuery The current query, for fluid interface
     */
    public function prune($glasuvanePosledni = null)
    {
        if ($glasuvanePosledni) {
            throw new LogicException('GlasuvanePosledni object has no primary key');

        }

        return $this;
    }

    /**
     * Deletes all rows from the glasuvane_posledni table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(GlasuvanePosledniTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            GlasuvanePosledniTableMap::clearInstancePool();
            GlasuvanePosledniTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(GlasuvanePosledniTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(GlasuvanePosledniTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            GlasuvanePosledniTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            GlasuvanePosledniTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // GlasuvanePosledniQuery
