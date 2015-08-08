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
use Tekstove\TekstoveBundle\Model\Entity\ForumTopic as ChildForumTopic;
use Tekstove\TekstoveBundle\Model\Entity\ForumTopicQuery as ChildForumTopicQuery;
use Tekstove\TekstoveBundle\Model\Entity\Map\ForumTopicTableMap;

/**
 * Base class that represents a query for the 'forum_topic' table.
 *
 *
 *
 * @method     ChildForumTopicQuery orderByTopicRazdel($order = Criteria::ASC) Order by the topic_razdel column
 * @method     ChildForumTopicQuery orderByTopicName($order = Criteria::ASC) Order by the topic_name column
 * @method     ChildForumTopicQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildForumTopicQuery orderByTopicPin($order = Criteria::ASC) Order by the topic_pin column
 * @method     ChildForumTopicQuery orderByTopicStarter($order = Criteria::ASC) Order by the topic_starter column
 * @method     ChildForumTopicQuery orderByTopicPosledenPost($order = Criteria::ASC) Order by the topic_posleden_post column
 * @method     ChildForumTopicQuery orderByPriority($order = Criteria::ASC) Order by the priority column
 *
 * @method     ChildForumTopicQuery groupByTopicRazdel() Group by the topic_razdel column
 * @method     ChildForumTopicQuery groupByTopicName() Group by the topic_name column
 * @method     ChildForumTopicQuery groupById() Group by the id column
 * @method     ChildForumTopicQuery groupByTopicPin() Group by the topic_pin column
 * @method     ChildForumTopicQuery groupByTopicStarter() Group by the topic_starter column
 * @method     ChildForumTopicQuery groupByTopicPosledenPost() Group by the topic_posleden_post column
 * @method     ChildForumTopicQuery groupByPriority() Group by the priority column
 *
 * @method     ChildForumTopicQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildForumTopicQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildForumTopicQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildForumTopicQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildForumTopicQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildForumTopicQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildForumTopicQuery leftJoinForumRazdel($relationAlias = null) Adds a LEFT JOIN clause to the query using the ForumRazdel relation
 * @method     ChildForumTopicQuery rightJoinForumRazdel($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ForumRazdel relation
 * @method     ChildForumTopicQuery innerJoinForumRazdel($relationAlias = null) Adds a INNER JOIN clause to the query using the ForumRazdel relation
 *
 * @method     ChildForumTopicQuery joinWithForumRazdel($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the ForumRazdel relation
 *
 * @method     ChildForumTopicQuery leftJoinWithForumRazdel() Adds a LEFT JOIN clause and with to the query using the ForumRazdel relation
 * @method     ChildForumTopicQuery rightJoinWithForumRazdel() Adds a RIGHT JOIN clause and with to the query using the ForumRazdel relation
 * @method     ChildForumTopicQuery innerJoinWithForumRazdel() Adds a INNER JOIN clause and with to the query using the ForumRazdel relation
 *
 * @method     ChildForumTopicQuery leftJoinNovini($relationAlias = null) Adds a LEFT JOIN clause to the query using the Novini relation
 * @method     ChildForumTopicQuery rightJoinNovini($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Novini relation
 * @method     ChildForumTopicQuery innerJoinNovini($relationAlias = null) Adds a INNER JOIN clause to the query using the Novini relation
 *
 * @method     ChildForumTopicQuery joinWithNovini($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Novini relation
 *
 * @method     ChildForumTopicQuery leftJoinWithNovini() Adds a LEFT JOIN clause and with to the query using the Novini relation
 * @method     ChildForumTopicQuery rightJoinWithNovini() Adds a RIGHT JOIN clause and with to the query using the Novini relation
 * @method     ChildForumTopicQuery innerJoinWithNovini() Adds a INNER JOIN clause and with to the query using the Novini relation
 *
 * @method     ChildForumTopicQuery leftJoinForumPosts($relationAlias = null) Adds a LEFT JOIN clause to the query using the ForumPosts relation
 * @method     ChildForumTopicQuery rightJoinForumPosts($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ForumPosts relation
 * @method     ChildForumTopicQuery innerJoinForumPosts($relationAlias = null) Adds a INNER JOIN clause to the query using the ForumPosts relation
 *
 * @method     ChildForumTopicQuery joinWithForumPosts($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the ForumPosts relation
 *
 * @method     ChildForumTopicQuery leftJoinWithForumPosts() Adds a LEFT JOIN clause and with to the query using the ForumPosts relation
 * @method     ChildForumTopicQuery rightJoinWithForumPosts() Adds a RIGHT JOIN clause and with to the query using the ForumPosts relation
 * @method     ChildForumTopicQuery innerJoinWithForumPosts() Adds a INNER JOIN clause and with to the query using the ForumPosts relation
 *
 * @method     ChildForumTopicQuery leftJoinForumTopicWatchers($relationAlias = null) Adds a LEFT JOIN clause to the query using the ForumTopicWatchers relation
 * @method     ChildForumTopicQuery rightJoinForumTopicWatchers($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ForumTopicWatchers relation
 * @method     ChildForumTopicQuery innerJoinForumTopicWatchers($relationAlias = null) Adds a INNER JOIN clause to the query using the ForumTopicWatchers relation
 *
 * @method     ChildForumTopicQuery joinWithForumTopicWatchers($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the ForumTopicWatchers relation
 *
 * @method     ChildForumTopicQuery leftJoinWithForumTopicWatchers() Adds a LEFT JOIN clause and with to the query using the ForumTopicWatchers relation
 * @method     ChildForumTopicQuery rightJoinWithForumTopicWatchers() Adds a RIGHT JOIN clause and with to the query using the ForumTopicWatchers relation
 * @method     ChildForumTopicQuery innerJoinWithForumTopicWatchers() Adds a INNER JOIN clause and with to the query using the ForumTopicWatchers relation
 *
 * @method     \Tekstove\TekstoveBundle\Model\Entity\ForumRazdelQuery|\Tekstove\TekstoveBundle\Model\Entity\NoviniQuery|\Tekstove\TekstoveBundle\Model\Entity\ForumPostsQuery|\Tekstove\TekstoveBundle\Model\Entity\ForumTopicWatchersQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildForumTopic findOne(ConnectionInterface $con = null) Return the first ChildForumTopic matching the query
 * @method     ChildForumTopic findOneOrCreate(ConnectionInterface $con = null) Return the first ChildForumTopic matching the query, or a new ChildForumTopic object populated from the query conditions when no match is found
 *
 * @method     ChildForumTopic findOneByTopicRazdel(int $topic_razdel) Return the first ChildForumTopic filtered by the topic_razdel column
 * @method     ChildForumTopic findOneByTopicName(string $topic_name) Return the first ChildForumTopic filtered by the topic_name column
 * @method     ChildForumTopic findOneById(int $id) Return the first ChildForumTopic filtered by the id column
 * @method     ChildForumTopic findOneByTopicPin(boolean $topic_pin) Return the first ChildForumTopic filtered by the topic_pin column
 * @method     ChildForumTopic findOneByTopicStarter(int $topic_starter) Return the first ChildForumTopic filtered by the topic_starter column
 * @method     ChildForumTopic findOneByTopicPosledenPost(string $topic_posleden_post) Return the first ChildForumTopic filtered by the topic_posleden_post column
 * @method     ChildForumTopic findOneByPriority(int $priority) Return the first ChildForumTopic filtered by the priority column *

 * @method     ChildForumTopic requirePk($key, ConnectionInterface $con = null) Return the ChildForumTopic by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildForumTopic requireOne(ConnectionInterface $con = null) Return the first ChildForumTopic matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildForumTopic requireOneByTopicRazdel(int $topic_razdel) Return the first ChildForumTopic filtered by the topic_razdel column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildForumTopic requireOneByTopicName(string $topic_name) Return the first ChildForumTopic filtered by the topic_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildForumTopic requireOneById(int $id) Return the first ChildForumTopic filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildForumTopic requireOneByTopicPin(boolean $topic_pin) Return the first ChildForumTopic filtered by the topic_pin column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildForumTopic requireOneByTopicStarter(int $topic_starter) Return the first ChildForumTopic filtered by the topic_starter column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildForumTopic requireOneByTopicPosledenPost(string $topic_posleden_post) Return the first ChildForumTopic filtered by the topic_posleden_post column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildForumTopic requireOneByPriority(int $priority) Return the first ChildForumTopic filtered by the priority column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildForumTopic[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildForumTopic objects based on current ModelCriteria
 * @method     ChildForumTopic[]|ObjectCollection findByTopicRazdel(int $topic_razdel) Return ChildForumTopic objects filtered by the topic_razdel column
 * @method     ChildForumTopic[]|ObjectCollection findByTopicName(string $topic_name) Return ChildForumTopic objects filtered by the topic_name column
 * @method     ChildForumTopic[]|ObjectCollection findById(int $id) Return ChildForumTopic objects filtered by the id column
 * @method     ChildForumTopic[]|ObjectCollection findByTopicPin(boolean $topic_pin) Return ChildForumTopic objects filtered by the topic_pin column
 * @method     ChildForumTopic[]|ObjectCollection findByTopicStarter(int $topic_starter) Return ChildForumTopic objects filtered by the topic_starter column
 * @method     ChildForumTopic[]|ObjectCollection findByTopicPosledenPost(string $topic_posleden_post) Return ChildForumTopic objects filtered by the topic_posleden_post column
 * @method     ChildForumTopic[]|ObjectCollection findByPriority(int $priority) Return ChildForumTopic objects filtered by the priority column
 * @method     ChildForumTopic[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class ForumTopicQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Tekstove\TekstoveBundle\Model\Entity\Base\ForumTopicQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\Tekstove\\TekstoveBundle\\Model\\Entity\\ForumTopic', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildForumTopicQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildForumTopicQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildForumTopicQuery) {
            return $criteria;
        }
        $query = new ChildForumTopicQuery();
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
     * @return ChildForumTopic|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        throw new LogicException('The ForumTopic object has no primary key');
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
        throw new LogicException('The ForumTopic object has no primary key');
    }

    /**
     * Filter the query by primary key
     *
     * @param     mixed $key Primary key to use for the query
     *
     * @return $this|ChildForumTopicQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {
        throw new LogicException('The ForumTopic object has no primary key');
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildForumTopicQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {
        throw new LogicException('The ForumTopic object has no primary key');
    }

    /**
     * Filter the query on the topic_razdel column
     *
     * Example usage:
     * <code>
     * $query->filterByTopicRazdel(1234); // WHERE topic_razdel = 1234
     * $query->filterByTopicRazdel(array(12, 34)); // WHERE topic_razdel IN (12, 34)
     * $query->filterByTopicRazdel(array('min' => 12)); // WHERE topic_razdel > 12
     * </code>
     *
     * @see       filterByForumRazdel()
     *
     * @param     mixed $topicRazdel The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildForumTopicQuery The current query, for fluid interface
     */
    public function filterByTopicRazdel($topicRazdel = null, $comparison = null)
    {
        if (is_array($topicRazdel)) {
            $useMinMax = false;
            if (isset($topicRazdel['min'])) {
                $this->addUsingAlias(ForumTopicTableMap::COL_TOPIC_RAZDEL, $topicRazdel['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($topicRazdel['max'])) {
                $this->addUsingAlias(ForumTopicTableMap::COL_TOPIC_RAZDEL, $topicRazdel['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ForumTopicTableMap::COL_TOPIC_RAZDEL, $topicRazdel, $comparison);
    }

    /**
     * Filter the query on the topic_name column
     *
     * Example usage:
     * <code>
     * $query->filterByTopicName('fooValue');   // WHERE topic_name = 'fooValue'
     * $query->filterByTopicName('%fooValue%'); // WHERE topic_name LIKE '%fooValue%'
     * </code>
     *
     * @param     string $topicName The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildForumTopicQuery The current query, for fluid interface
     */
    public function filterByTopicName($topicName = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($topicName)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $topicName)) {
                $topicName = str_replace('*', '%', $topicName);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ForumTopicTableMap::COL_TOPIC_NAME, $topicName, $comparison);
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
     * @return $this|ChildForumTopicQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(ForumTopicTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(ForumTopicTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ForumTopicTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the topic_pin column
     *
     * Example usage:
     * <code>
     * $query->filterByTopicPin(true); // WHERE topic_pin = true
     * $query->filterByTopicPin('yes'); // WHERE topic_pin = true
     * </code>
     *
     * @param     boolean|string $topicPin The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildForumTopicQuery The current query, for fluid interface
     */
    public function filterByTopicPin($topicPin = null, $comparison = null)
    {
        if (is_string($topicPin)) {
            $topicPin = in_array(strtolower($topicPin), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(ForumTopicTableMap::COL_TOPIC_PIN, $topicPin, $comparison);
    }

    /**
     * Filter the query on the topic_starter column
     *
     * Example usage:
     * <code>
     * $query->filterByTopicStarter(1234); // WHERE topic_starter = 1234
     * $query->filterByTopicStarter(array(12, 34)); // WHERE topic_starter IN (12, 34)
     * $query->filterByTopicStarter(array('min' => 12)); // WHERE topic_starter > 12
     * </code>
     *
     * @param     mixed $topicStarter The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildForumTopicQuery The current query, for fluid interface
     */
    public function filterByTopicStarter($topicStarter = null, $comparison = null)
    {
        if (is_array($topicStarter)) {
            $useMinMax = false;
            if (isset($topicStarter['min'])) {
                $this->addUsingAlias(ForumTopicTableMap::COL_TOPIC_STARTER, $topicStarter['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($topicStarter['max'])) {
                $this->addUsingAlias(ForumTopicTableMap::COL_TOPIC_STARTER, $topicStarter['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ForumTopicTableMap::COL_TOPIC_STARTER, $topicStarter, $comparison);
    }

    /**
     * Filter the query on the topic_posleden_post column
     *
     * Example usage:
     * <code>
     * $query->filterByTopicPosledenPost('2011-03-14'); // WHERE topic_posleden_post = '2011-03-14'
     * $query->filterByTopicPosledenPost('now'); // WHERE topic_posleden_post = '2011-03-14'
     * $query->filterByTopicPosledenPost(array('max' => 'yesterday')); // WHERE topic_posleden_post > '2011-03-13'
     * </code>
     *
     * @param     mixed $topicPosledenPost The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildForumTopicQuery The current query, for fluid interface
     */
    public function filterByTopicPosledenPost($topicPosledenPost = null, $comparison = null)
    {
        if (is_array($topicPosledenPost)) {
            $useMinMax = false;
            if (isset($topicPosledenPost['min'])) {
                $this->addUsingAlias(ForumTopicTableMap::COL_TOPIC_POSLEDEN_POST, $topicPosledenPost['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($topicPosledenPost['max'])) {
                $this->addUsingAlias(ForumTopicTableMap::COL_TOPIC_POSLEDEN_POST, $topicPosledenPost['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ForumTopicTableMap::COL_TOPIC_POSLEDEN_POST, $topicPosledenPost, $comparison);
    }

    /**
     * Filter the query on the priority column
     *
     * Example usage:
     * <code>
     * $query->filterByPriority(1234); // WHERE priority = 1234
     * $query->filterByPriority(array(12, 34)); // WHERE priority IN (12, 34)
     * $query->filterByPriority(array('min' => 12)); // WHERE priority > 12
     * </code>
     *
     * @param     mixed $priority The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildForumTopicQuery The current query, for fluid interface
     */
    public function filterByPriority($priority = null, $comparison = null)
    {
        if (is_array($priority)) {
            $useMinMax = false;
            if (isset($priority['min'])) {
                $this->addUsingAlias(ForumTopicTableMap::COL_PRIORITY, $priority['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($priority['max'])) {
                $this->addUsingAlias(ForumTopicTableMap::COL_PRIORITY, $priority['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ForumTopicTableMap::COL_PRIORITY, $priority, $comparison);
    }

    /**
     * Filter the query by a related \Tekstove\TekstoveBundle\Model\Entity\ForumRazdel object
     *
     * @param \Tekstove\TekstoveBundle\Model\Entity\ForumRazdel|ObjectCollection $forumRazdel The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildForumTopicQuery The current query, for fluid interface
     */
    public function filterByForumRazdel($forumRazdel, $comparison = null)
    {
        if ($forumRazdel instanceof \Tekstove\TekstoveBundle\Model\Entity\ForumRazdel) {
            return $this
                ->addUsingAlias(ForumTopicTableMap::COL_TOPIC_RAZDEL, $forumRazdel->getId(), $comparison);
        } elseif ($forumRazdel instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(ForumTopicTableMap::COL_TOPIC_RAZDEL, $forumRazdel->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByForumRazdel() only accepts arguments of type \Tekstove\TekstoveBundle\Model\Entity\ForumRazdel or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the ForumRazdel relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildForumTopicQuery The current query, for fluid interface
     */
    public function joinForumRazdel($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('ForumRazdel');

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
            $this->addJoinObject($join, 'ForumRazdel');
        }

        return $this;
    }

    /**
     * Use the ForumRazdel relation ForumRazdel object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Tekstove\TekstoveBundle\Model\Entity\ForumRazdelQuery A secondary query class using the current class as primary query
     */
    public function useForumRazdelQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinForumRazdel($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ForumRazdel', '\Tekstove\TekstoveBundle\Model\Entity\ForumRazdelQuery');
    }

    /**
     * Filter the query by a related \Tekstove\TekstoveBundle\Model\Entity\Novini object
     *
     * @param \Tekstove\TekstoveBundle\Model\Entity\Novini|ObjectCollection $novini the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildForumTopicQuery The current query, for fluid interface
     */
    public function filterByNovini($novini, $comparison = null)
    {
        if ($novini instanceof \Tekstove\TekstoveBundle\Model\Entity\Novini) {
            return $this
                ->addUsingAlias(ForumTopicTableMap::COL_ID, $novini->getId(), $comparison);
        } elseif ($novini instanceof ObjectCollection) {
            return $this
                ->useNoviniQuery()
                ->filterByPrimaryKeys($novini->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByNovini() only accepts arguments of type \Tekstove\TekstoveBundle\Model\Entity\Novini or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Novini relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildForumTopicQuery The current query, for fluid interface
     */
    public function joinNovini($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Novini');

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
            $this->addJoinObject($join, 'Novini');
        }

        return $this;
    }

    /**
     * Use the Novini relation Novini object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Tekstove\TekstoveBundle\Model\Entity\NoviniQuery A secondary query class using the current class as primary query
     */
    public function useNoviniQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinNovini($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Novini', '\Tekstove\TekstoveBundle\Model\Entity\NoviniQuery');
    }

    /**
     * Filter the query by a related \Tekstove\TekstoveBundle\Model\Entity\ForumPosts object
     *
     * @param \Tekstove\TekstoveBundle\Model\Entity\ForumPosts|ObjectCollection $forumPosts the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildForumTopicQuery The current query, for fluid interface
     */
    public function filterByForumPosts($forumPosts, $comparison = null)
    {
        if ($forumPosts instanceof \Tekstove\TekstoveBundle\Model\Entity\ForumPosts) {
            return $this
                ->addUsingAlias(ForumTopicTableMap::COL_ID, $forumPosts->getZaTopicId(), $comparison);
        } elseif ($forumPosts instanceof ObjectCollection) {
            return $this
                ->useForumPostsQuery()
                ->filterByPrimaryKeys($forumPosts->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByForumPosts() only accepts arguments of type \Tekstove\TekstoveBundle\Model\Entity\ForumPosts or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the ForumPosts relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildForumTopicQuery The current query, for fluid interface
     */
    public function joinForumPosts($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('ForumPosts');

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
            $this->addJoinObject($join, 'ForumPosts');
        }

        return $this;
    }

    /**
     * Use the ForumPosts relation ForumPosts object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Tekstove\TekstoveBundle\Model\Entity\ForumPostsQuery A secondary query class using the current class as primary query
     */
    public function useForumPostsQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinForumPosts($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ForumPosts', '\Tekstove\TekstoveBundle\Model\Entity\ForumPostsQuery');
    }

    /**
     * Filter the query by a related \Tekstove\TekstoveBundle\Model\Entity\ForumTopicWatchers object
     *
     * @param \Tekstove\TekstoveBundle\Model\Entity\ForumTopicWatchers|ObjectCollection $forumTopicWatchers the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildForumTopicQuery The current query, for fluid interface
     */
    public function filterByForumTopicWatchers($forumTopicWatchers, $comparison = null)
    {
        if ($forumTopicWatchers instanceof \Tekstove\TekstoveBundle\Model\Entity\ForumTopicWatchers) {
            return $this
                ->addUsingAlias(ForumTopicTableMap::COL_ID, $forumTopicWatchers->getForumTopicId(), $comparison);
        } elseif ($forumTopicWatchers instanceof ObjectCollection) {
            return $this
                ->useForumTopicWatchersQuery()
                ->filterByPrimaryKeys($forumTopicWatchers->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByForumTopicWatchers() only accepts arguments of type \Tekstove\TekstoveBundle\Model\Entity\ForumTopicWatchers or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the ForumTopicWatchers relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildForumTopicQuery The current query, for fluid interface
     */
    public function joinForumTopicWatchers($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('ForumTopicWatchers');

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
            $this->addJoinObject($join, 'ForumTopicWatchers');
        }

        return $this;
    }

    /**
     * Use the ForumTopicWatchers relation ForumTopicWatchers object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Tekstove\TekstoveBundle\Model\Entity\ForumTopicWatchersQuery A secondary query class using the current class as primary query
     */
    public function useForumTopicWatchersQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinForumTopicWatchers($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ForumTopicWatchers', '\Tekstove\TekstoveBundle\Model\Entity\ForumTopicWatchersQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildForumTopic $forumTopic Object to remove from the list of results
     *
     * @return $this|ChildForumTopicQuery The current query, for fluid interface
     */
    public function prune($forumTopic = null)
    {
        if ($forumTopic) {
            throw new LogicException('ForumTopic object has no primary key');

        }

        return $this;
    }

    /**
     * Deletes all rows from the forum_topic table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ForumTopicTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            ForumTopicTableMap::clearInstancePool();
            ForumTopicTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(ForumTopicTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(ForumTopicTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            ForumTopicTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            ForumTopicTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // ForumTopicQuery
