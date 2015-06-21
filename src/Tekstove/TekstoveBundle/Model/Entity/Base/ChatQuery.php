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
use Tekstove\TekstoveBundle\Model\Entity\Chat as ChildChat;
use Tekstove\TekstoveBundle\Model\Entity\ChatQuery as ChildChatQuery;
use Tekstove\TekstoveBundle\Model\Entity\Map\ChatTableMap;

/**
 * Base class that represents a query for the 'chat' table.
 *
 *
 *
 * @method     ChildChatQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildChatQuery orderByMessage($order = Criteria::ASC) Order by the message column
 * @method     ChildChatQuery orderByUsernameId($order = Criteria::ASC) Order by the username_id column
 * @method     ChildChatQuery orderByUsernameName($order = Criteria::ASC) Order by the username_name column
 * @method     ChildChatQuery orderByUsernameMood($order = Criteria::ASC) Order by the username_mood column
 * @method     ChildChatQuery orderByDate($order = Criteria::ASC) Order by the date column
 * @method     ChildChatQuery orderByIp($order = Criteria::ASC) Order by the ip column
 * @method     ChildChatQuery orderByLastedit($order = Criteria::ASC) Order by the lastEdit column
 * @method     ChildChatQuery orderByAllowban($order = Criteria::ASC) Order by the allowBan column
 *
 * @method     ChildChatQuery groupById() Group by the id column
 * @method     ChildChatQuery groupByMessage() Group by the message column
 * @method     ChildChatQuery groupByUsernameId() Group by the username_id column
 * @method     ChildChatQuery groupByUsernameName() Group by the username_name column
 * @method     ChildChatQuery groupByUsernameMood() Group by the username_mood column
 * @method     ChildChatQuery groupByDate() Group by the date column
 * @method     ChildChatQuery groupByIp() Group by the ip column
 * @method     ChildChatQuery groupByLastedit() Group by the lastEdit column
 * @method     ChildChatQuery groupByAllowban() Group by the allowBan column
 *
 * @method     ChildChatQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildChatQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildChatQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildChat findOne(ConnectionInterface $con = null) Return the first ChildChat matching the query
 * @method     ChildChat findOneOrCreate(ConnectionInterface $con = null) Return the first ChildChat matching the query, or a new ChildChat object populated from the query conditions when no match is found
 *
 * @method     ChildChat findOneById(int $id) Return the first ChildChat filtered by the id column
 * @method     ChildChat findOneByMessage(string $message) Return the first ChildChat filtered by the message column
 * @method     ChildChat findOneByUsernameId(int $username_id) Return the first ChildChat filtered by the username_id column
 * @method     ChildChat findOneByUsernameName(string $username_name) Return the first ChildChat filtered by the username_name column
 * @method     ChildChat findOneByUsernameMood(string $username_mood) Return the first ChildChat filtered by the username_mood column
 * @method     ChildChat findOneByDate(string $date) Return the first ChildChat filtered by the date column
 * @method     ChildChat findOneByIp(string $ip) Return the first ChildChat filtered by the ip column
 * @method     ChildChat findOneByLastedit(string $lastEdit) Return the first ChildChat filtered by the lastEdit column
 * @method     ChildChat findOneByAllowban(int $allowBan) Return the first ChildChat filtered by the allowBan column *

 * @method     ChildChat requirePk($key, ConnectionInterface $con = null) Return the ChildChat by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildChat requireOne(ConnectionInterface $con = null) Return the first ChildChat matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildChat requireOneById(int $id) Return the first ChildChat filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildChat requireOneByMessage(string $message) Return the first ChildChat filtered by the message column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildChat requireOneByUsernameId(int $username_id) Return the first ChildChat filtered by the username_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildChat requireOneByUsernameName(string $username_name) Return the first ChildChat filtered by the username_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildChat requireOneByUsernameMood(string $username_mood) Return the first ChildChat filtered by the username_mood column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildChat requireOneByDate(string $date) Return the first ChildChat filtered by the date column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildChat requireOneByIp(string $ip) Return the first ChildChat filtered by the ip column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildChat requireOneByLastedit(string $lastEdit) Return the first ChildChat filtered by the lastEdit column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildChat requireOneByAllowban(int $allowBan) Return the first ChildChat filtered by the allowBan column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildChat[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildChat objects based on current ModelCriteria
 * @method     ChildChat[]|ObjectCollection findById(int $id) Return ChildChat objects filtered by the id column
 * @method     ChildChat[]|ObjectCollection findByMessage(string $message) Return ChildChat objects filtered by the message column
 * @method     ChildChat[]|ObjectCollection findByUsernameId(int $username_id) Return ChildChat objects filtered by the username_id column
 * @method     ChildChat[]|ObjectCollection findByUsernameName(string $username_name) Return ChildChat objects filtered by the username_name column
 * @method     ChildChat[]|ObjectCollection findByUsernameMood(string $username_mood) Return ChildChat objects filtered by the username_mood column
 * @method     ChildChat[]|ObjectCollection findByDate(string $date) Return ChildChat objects filtered by the date column
 * @method     ChildChat[]|ObjectCollection findByIp(string $ip) Return ChildChat objects filtered by the ip column
 * @method     ChildChat[]|ObjectCollection findByLastedit(string $lastEdit) Return ChildChat objects filtered by the lastEdit column
 * @method     ChildChat[]|ObjectCollection findByAllowban(int $allowBan) Return ChildChat objects filtered by the allowBan column
 * @method     ChildChat[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class ChatQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Tekstove\TekstoveBundle\Model\Entity\Base\ChatQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\Tekstove\\TekstoveBundle\\Model\\Entity\\Chat', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildChatQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildChatQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildChatQuery) {
            return $criteria;
        }
        $query = new ChildChatQuery();
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
     * @return ChildChat|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = ChatTableMap::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(ChatTableMap::DATABASE_NAME);
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
     * @return ChildChat A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, message, username_id, username_name, username_mood, date, ip, lastEdit, allowBan FROM chat WHERE id = :p0';
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
            /** @var ChildChat $obj */
            $obj = new ChildChat();
            $obj->hydrate($row);
            ChatTableMap::addInstanceToPool($obj, (string) $key);
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
     * @return ChildChat|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildChatQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(ChatTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildChatQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(ChatTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildChatQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(ChatTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(ChatTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ChatTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the message column
     *
     * Example usage:
     * <code>
     * $query->filterByMessage('fooValue');   // WHERE message = 'fooValue'
     * $query->filterByMessage('%fooValue%'); // WHERE message LIKE '%fooValue%'
     * </code>
     *
     * @param     string $message The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildChatQuery The current query, for fluid interface
     */
    public function filterByMessage($message = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($message)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $message)) {
                $message = str_replace('*', '%', $message);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ChatTableMap::COL_MESSAGE, $message, $comparison);
    }

    /**
     * Filter the query on the username_id column
     *
     * Example usage:
     * <code>
     * $query->filterByUsernameId(1234); // WHERE username_id = 1234
     * $query->filterByUsernameId(array(12, 34)); // WHERE username_id IN (12, 34)
     * $query->filterByUsernameId(array('min' => 12)); // WHERE username_id > 12
     * </code>
     *
     * @param     mixed $usernameId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildChatQuery The current query, for fluid interface
     */
    public function filterByUsernameId($usernameId = null, $comparison = null)
    {
        if (is_array($usernameId)) {
            $useMinMax = false;
            if (isset($usernameId['min'])) {
                $this->addUsingAlias(ChatTableMap::COL_USERNAME_ID, $usernameId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($usernameId['max'])) {
                $this->addUsingAlias(ChatTableMap::COL_USERNAME_ID, $usernameId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ChatTableMap::COL_USERNAME_ID, $usernameId, $comparison);
    }

    /**
     * Filter the query on the username_name column
     *
     * Example usage:
     * <code>
     * $query->filterByUsernameName('fooValue');   // WHERE username_name = 'fooValue'
     * $query->filterByUsernameName('%fooValue%'); // WHERE username_name LIKE '%fooValue%'
     * </code>
     *
     * @param     string $usernameName The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildChatQuery The current query, for fluid interface
     */
    public function filterByUsernameName($usernameName = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($usernameName)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $usernameName)) {
                $usernameName = str_replace('*', '%', $usernameName);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ChatTableMap::COL_USERNAME_NAME, $usernameName, $comparison);
    }

    /**
     * Filter the query on the username_mood column
     *
     * Example usage:
     * <code>
     * $query->filterByUsernameMood('fooValue');   // WHERE username_mood = 'fooValue'
     * $query->filterByUsernameMood('%fooValue%'); // WHERE username_mood LIKE '%fooValue%'
     * </code>
     *
     * @param     string $usernameMood The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildChatQuery The current query, for fluid interface
     */
    public function filterByUsernameMood($usernameMood = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($usernameMood)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $usernameMood)) {
                $usernameMood = str_replace('*', '%', $usernameMood);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ChatTableMap::COL_USERNAME_MOOD, $usernameMood, $comparison);
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
     * @return $this|ChildChatQuery The current query, for fluid interface
     */
    public function filterByDate($date = null, $comparison = null)
    {
        if (is_array($date)) {
            $useMinMax = false;
            if (isset($date['min'])) {
                $this->addUsingAlias(ChatTableMap::COL_DATE, $date['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($date['max'])) {
                $this->addUsingAlias(ChatTableMap::COL_DATE, $date['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ChatTableMap::COL_DATE, $date, $comparison);
    }

    /**
     * Filter the query on the ip column
     *
     * Example usage:
     * <code>
     * $query->filterByIp('fooValue');   // WHERE ip = 'fooValue'
     * $query->filterByIp('%fooValue%'); // WHERE ip LIKE '%fooValue%'
     * </code>
     *
     * @param     string $ip The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildChatQuery The current query, for fluid interface
     */
    public function filterByIp($ip = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($ip)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $ip)) {
                $ip = str_replace('*', '%', $ip);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ChatTableMap::COL_IP, $ip, $comparison);
    }

    /**
     * Filter the query on the lastEdit column
     *
     * Example usage:
     * <code>
     * $query->filterByLastedit('2011-03-14'); // WHERE lastEdit = '2011-03-14'
     * $query->filterByLastedit('now'); // WHERE lastEdit = '2011-03-14'
     * $query->filterByLastedit(array('max' => 'yesterday')); // WHERE lastEdit > '2011-03-13'
     * </code>
     *
     * @param     mixed $lastedit The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildChatQuery The current query, for fluid interface
     */
    public function filterByLastedit($lastedit = null, $comparison = null)
    {
        if (is_array($lastedit)) {
            $useMinMax = false;
            if (isset($lastedit['min'])) {
                $this->addUsingAlias(ChatTableMap::COL_LASTEDIT, $lastedit['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($lastedit['max'])) {
                $this->addUsingAlias(ChatTableMap::COL_LASTEDIT, $lastedit['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ChatTableMap::COL_LASTEDIT, $lastedit, $comparison);
    }

    /**
     * Filter the query on the allowBan column
     *
     * Example usage:
     * <code>
     * $query->filterByAllowban(1234); // WHERE allowBan = 1234
     * $query->filterByAllowban(array(12, 34)); // WHERE allowBan IN (12, 34)
     * $query->filterByAllowban(array('min' => 12)); // WHERE allowBan > 12
     * </code>
     *
     * @param     mixed $allowban The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildChatQuery The current query, for fluid interface
     */
    public function filterByAllowban($allowban = null, $comparison = null)
    {
        if (is_array($allowban)) {
            $useMinMax = false;
            if (isset($allowban['min'])) {
                $this->addUsingAlias(ChatTableMap::COL_ALLOWBAN, $allowban['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($allowban['max'])) {
                $this->addUsingAlias(ChatTableMap::COL_ALLOWBAN, $allowban['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ChatTableMap::COL_ALLOWBAN, $allowban, $comparison);
    }

    /**
     * Exclude object from result
     *
     * @param   ChildChat $chat Object to remove from the list of results
     *
     * @return $this|ChildChatQuery The current query, for fluid interface
     */
    public function prune($chat = null)
    {
        if ($chat) {
            $this->addUsingAlias(ChatTableMap::COL_ID, $chat->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the chat table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ChatTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            ChatTableMap::clearInstancePool();
            ChatTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(ChatTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(ChatTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            ChatTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            ChatTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // ChatQuery
