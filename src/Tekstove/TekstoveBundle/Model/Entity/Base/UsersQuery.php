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
use Tekstove\TekstoveBundle\Model\Entity\Users as ChildUsers;
use Tekstove\TekstoveBundle\Model\Entity\UsersQuery as ChildUsersQuery;
use Tekstove\TekstoveBundle\Model\Entity\Map\UsersTableMap;

/**
 * Base class that represents a query for the 'users' table.
 *
 *
 *
 * @method     ChildUsersQuery orderByUsername($order = Criteria::ASC) Order by the username column
 * @method     ChildUsersQuery orderByPassword($order = Criteria::ASC) Order by the password column
 * @method     ChildUsersQuery orderByPasswordMod($order = Criteria::ASC) Order by the password_mod column
 * @method     ChildUsersQuery orderByPasswordModCoockie($order = Criteria::ASC) Order by the password_mod_coockie column
 * @method     ChildUsersQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildUsersQuery orderByMail($order = Criteria::ASC) Order by the mail column
 * @method     ChildUsersQuery orderByClass($order = Criteria::ASC) Order by the class column
 * @method     ChildUsersQuery orderByClasscustomname($order = Criteria::ASC) Order by the classCustomName column
 * @method     ChildUsersQuery orderByAvatar($order = Criteria::ASC) Order by the avatar column
 * @method     ChildUsersQuery orderByAbout($order = Criteria::ASC) Order by the about column
 * @method     ChildUsersQuery orderByRegDate($order = Criteria::ASC) Order by the reg_date column
 * @method     ChildUsersQuery orderByPozdrav($order = Criteria::ASC) Order by the pozdrav column
 * @method     ChildUsersQuery orderByBrPesni($order = Criteria::ASC) Order by the br_pesni column
 * @method     ChildUsersQuery orderByRajdane($order = Criteria::ASC) Order by the rajdane column
 * @method     ChildUsersQuery orderByPrevodi($order = Criteria::ASC) Order by the prevodi column
 * @method     ChildUsersQuery orderByAutoplay($order = Criteria::ASC) Order by the autoplay column
 * @method     ChildUsersQuery orderBySkype($order = Criteria::ASC) Order by the skype column
 * @method     ChildUsersQuery orderByActivityPoints($order = Criteria::ASC) Order by the activity_points column
 * @method     ChildUsersQuery orderByBanned($order = Criteria::ASC) Order by the banned column
 * @method     ChildUsersQuery orderByChatmessages($order = Criteria::ASC) Order by the chatMessages column
 *
 * @method     ChildUsersQuery groupByUsername() Group by the username column
 * @method     ChildUsersQuery groupByPassword() Group by the password column
 * @method     ChildUsersQuery groupByPasswordMod() Group by the password_mod column
 * @method     ChildUsersQuery groupByPasswordModCoockie() Group by the password_mod_coockie column
 * @method     ChildUsersQuery groupById() Group by the id column
 * @method     ChildUsersQuery groupByMail() Group by the mail column
 * @method     ChildUsersQuery groupByClass() Group by the class column
 * @method     ChildUsersQuery groupByClasscustomname() Group by the classCustomName column
 * @method     ChildUsersQuery groupByAvatar() Group by the avatar column
 * @method     ChildUsersQuery groupByAbout() Group by the about column
 * @method     ChildUsersQuery groupByRegDate() Group by the reg_date column
 * @method     ChildUsersQuery groupByPozdrav() Group by the pozdrav column
 * @method     ChildUsersQuery groupByBrPesni() Group by the br_pesni column
 * @method     ChildUsersQuery groupByRajdane() Group by the rajdane column
 * @method     ChildUsersQuery groupByPrevodi() Group by the prevodi column
 * @method     ChildUsersQuery groupByAutoplay() Group by the autoplay column
 * @method     ChildUsersQuery groupBySkype() Group by the skype column
 * @method     ChildUsersQuery groupByActivityPoints() Group by the activity_points column
 * @method     ChildUsersQuery groupByBanned() Group by the banned column
 * @method     ChildUsersQuery groupByChatmessages() Group by the chatMessages column
 *
 * @method     ChildUsersQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildUsersQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildUsersQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildUsersQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildUsersQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildUsersQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildUsersQuery leftJoinChatOnline($relationAlias = null) Adds a LEFT JOIN clause to the query using the ChatOnline relation
 * @method     ChildUsersQuery rightJoinChatOnline($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ChatOnline relation
 * @method     ChildUsersQuery innerJoinChatOnline($relationAlias = null) Adds a INNER JOIN clause to the query using the ChatOnline relation
 *
 * @method     ChildUsersQuery joinWithChatOnline($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the ChatOnline relation
 *
 * @method     ChildUsersQuery leftJoinWithChatOnline() Adds a LEFT JOIN clause and with to the query using the ChatOnline relation
 * @method     ChildUsersQuery rightJoinWithChatOnline() Adds a RIGHT JOIN clause and with to the query using the ChatOnline relation
 * @method     ChildUsersQuery innerJoinWithChatOnline() Adds a INNER JOIN clause and with to the query using the ChatOnline relation
 *
 * @method     ChildUsersQuery leftJoinPermissionGroupUsers($relationAlias = null) Adds a LEFT JOIN clause to the query using the PermissionGroupUsers relation
 * @method     ChildUsersQuery rightJoinPermissionGroupUsers($relationAlias = null) Adds a RIGHT JOIN clause to the query using the PermissionGroupUsers relation
 * @method     ChildUsersQuery innerJoinPermissionGroupUsers($relationAlias = null) Adds a INNER JOIN clause to the query using the PermissionGroupUsers relation
 *
 * @method     ChildUsersQuery joinWithPermissionGroupUsers($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the PermissionGroupUsers relation
 *
 * @method     ChildUsersQuery leftJoinWithPermissionGroupUsers() Adds a LEFT JOIN clause and with to the query using the PermissionGroupUsers relation
 * @method     ChildUsersQuery rightJoinWithPermissionGroupUsers() Adds a RIGHT JOIN clause and with to the query using the PermissionGroupUsers relation
 * @method     ChildUsersQuery innerJoinWithPermissionGroupUsers() Adds a INNER JOIN clause and with to the query using the PermissionGroupUsers relation
 *
 * @method     ChildUsersQuery leftJoinPermissionUsers($relationAlias = null) Adds a LEFT JOIN clause to the query using the PermissionUsers relation
 * @method     ChildUsersQuery rightJoinPermissionUsers($relationAlias = null) Adds a RIGHT JOIN clause to the query using the PermissionUsers relation
 * @method     ChildUsersQuery innerJoinPermissionUsers($relationAlias = null) Adds a INNER JOIN clause to the query using the PermissionUsers relation
 *
 * @method     ChildUsersQuery joinWithPermissionUsers($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the PermissionUsers relation
 *
 * @method     ChildUsersQuery leftJoinWithPermissionUsers() Adds a LEFT JOIN clause and with to the query using the PermissionUsers relation
 * @method     ChildUsersQuery rightJoinWithPermissionUsers() Adds a RIGHT JOIN clause and with to the query using the PermissionUsers relation
 * @method     ChildUsersQuery innerJoinWithPermissionUsers() Adds a INNER JOIN clause and with to the query using the PermissionUsers relation
 *
 * @method     ChildUsersQuery leftJoinForumTopicWatchers($relationAlias = null) Adds a LEFT JOIN clause to the query using the ForumTopicWatchers relation
 * @method     ChildUsersQuery rightJoinForumTopicWatchers($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ForumTopicWatchers relation
 * @method     ChildUsersQuery innerJoinForumTopicWatchers($relationAlias = null) Adds a INNER JOIN clause to the query using the ForumTopicWatchers relation
 *
 * @method     ChildUsersQuery joinWithForumTopicWatchers($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the ForumTopicWatchers relation
 *
 * @method     ChildUsersQuery leftJoinWithForumTopicWatchers() Adds a LEFT JOIN clause and with to the query using the ForumTopicWatchers relation
 * @method     ChildUsersQuery rightJoinWithForumTopicWatchers() Adds a RIGHT JOIN clause and with to the query using the ForumTopicWatchers relation
 * @method     ChildUsersQuery innerJoinWithForumTopicWatchers() Adds a INNER JOIN clause and with to the query using the ForumTopicWatchers relation
 *
 * @method     ChildUsersQuery leftJoinPrevodi($relationAlias = null) Adds a LEFT JOIN clause to the query using the Prevodi relation
 * @method     ChildUsersQuery rightJoinPrevodi($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Prevodi relation
 * @method     ChildUsersQuery innerJoinPrevodi($relationAlias = null) Adds a INNER JOIN clause to the query using the Prevodi relation
 *
 * @method     ChildUsersQuery joinWithPrevodi($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Prevodi relation
 *
 * @method     ChildUsersQuery leftJoinWithPrevodi() Adds a LEFT JOIN clause and with to the query using the Prevodi relation
 * @method     ChildUsersQuery rightJoinWithPrevodi() Adds a RIGHT JOIN clause and with to the query using the Prevodi relation
 * @method     ChildUsersQuery innerJoinWithPrevodi() Adds a INNER JOIN clause and with to the query using the Prevodi relation
 *
 * @method     \Tekstove\TekstoveBundle\Model\Entity\ChatOnlineQuery|\Tekstove\TekstoveBundle\Model\Entity\PermissionGroupUsersQuery|\Tekstove\TekstoveBundle\Model\Entity\PermissionUsersQuery|\Tekstove\TekstoveBundle\Model\Entity\ForumTopicWatchersQuery|\Tekstove\TekstoveBundle\Model\Entity\PrevodiQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildUsers findOne(ConnectionInterface $con = null) Return the first ChildUsers matching the query
 * @method     ChildUsers findOneOrCreate(ConnectionInterface $con = null) Return the first ChildUsers matching the query, or a new ChildUsers object populated from the query conditions when no match is found
 *
 * @method     ChildUsers findOneByUsername(string $username) Return the first ChildUsers filtered by the username column
 * @method     ChildUsers findOneByPassword(string $password) Return the first ChildUsers filtered by the password column
 * @method     ChildUsers findOneByPasswordMod(string $password_mod) Return the first ChildUsers filtered by the password_mod column
 * @method     ChildUsers findOneByPasswordModCoockie(string $password_mod_coockie) Return the first ChildUsers filtered by the password_mod_coockie column
 * @method     ChildUsers findOneById(int $id) Return the first ChildUsers filtered by the id column
 * @method     ChildUsers findOneByMail(string $mail) Return the first ChildUsers filtered by the mail column
 * @method     ChildUsers findOneByClass(int $class) Return the first ChildUsers filtered by the class column
 * @method     ChildUsers findOneByClasscustomname(string $classCustomName) Return the first ChildUsers filtered by the classCustomName column
 * @method     ChildUsers findOneByAvatar(string $avatar) Return the first ChildUsers filtered by the avatar column
 * @method     ChildUsers findOneByAbout(string $about) Return the first ChildUsers filtered by the about column
 * @method     ChildUsers findOneByRegDate(string $reg_date) Return the first ChildUsers filtered by the reg_date column
 * @method     ChildUsers findOneByPozdrav(int $pozdrav) Return the first ChildUsers filtered by the pozdrav column
 * @method     ChildUsers findOneByBrPesni(int $br_pesni) Return the first ChildUsers filtered by the br_pesni column
 * @method     ChildUsers findOneByRajdane(string $rajdane) Return the first ChildUsers filtered by the rajdane column
 * @method     ChildUsers findOneByPrevodi(int $prevodi) Return the first ChildUsers filtered by the prevodi column
 * @method     ChildUsers findOneByAutoplay(int $autoplay) Return the first ChildUsers filtered by the autoplay column
 * @method     ChildUsers findOneBySkype(string $skype) Return the first ChildUsers filtered by the skype column
 * @method     ChildUsers findOneByActivityPoints(int $activity_points) Return the first ChildUsers filtered by the activity_points column
 * @method     ChildUsers findOneByBanned(string $banned) Return the first ChildUsers filtered by the banned column
 * @method     ChildUsers findOneByChatmessages(int $chatMessages) Return the first ChildUsers filtered by the chatMessages column *

 * @method     ChildUsers requirePk($key, ConnectionInterface $con = null) Return the ChildUsers by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsers requireOne(ConnectionInterface $con = null) Return the first ChildUsers matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildUsers requireOneByUsername(string $username) Return the first ChildUsers filtered by the username column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsers requireOneByPassword(string $password) Return the first ChildUsers filtered by the password column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsers requireOneByPasswordMod(string $password_mod) Return the first ChildUsers filtered by the password_mod column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsers requireOneByPasswordModCoockie(string $password_mod_coockie) Return the first ChildUsers filtered by the password_mod_coockie column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsers requireOneById(int $id) Return the first ChildUsers filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsers requireOneByMail(string $mail) Return the first ChildUsers filtered by the mail column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsers requireOneByClass(int $class) Return the first ChildUsers filtered by the class column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsers requireOneByClasscustomname(string $classCustomName) Return the first ChildUsers filtered by the classCustomName column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsers requireOneByAvatar(string $avatar) Return the first ChildUsers filtered by the avatar column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsers requireOneByAbout(string $about) Return the first ChildUsers filtered by the about column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsers requireOneByRegDate(string $reg_date) Return the first ChildUsers filtered by the reg_date column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsers requireOneByPozdrav(int $pozdrav) Return the first ChildUsers filtered by the pozdrav column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsers requireOneByBrPesni(int $br_pesni) Return the first ChildUsers filtered by the br_pesni column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsers requireOneByRajdane(string $rajdane) Return the first ChildUsers filtered by the rajdane column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsers requireOneByPrevodi(int $prevodi) Return the first ChildUsers filtered by the prevodi column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsers requireOneByAutoplay(int $autoplay) Return the first ChildUsers filtered by the autoplay column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsers requireOneBySkype(string $skype) Return the first ChildUsers filtered by the skype column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsers requireOneByActivityPoints(int $activity_points) Return the first ChildUsers filtered by the activity_points column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsers requireOneByBanned(string $banned) Return the first ChildUsers filtered by the banned column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsers requireOneByChatmessages(int $chatMessages) Return the first ChildUsers filtered by the chatMessages column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildUsers[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildUsers objects based on current ModelCriteria
 * @method     ChildUsers[]|ObjectCollection findByUsername(string $username) Return ChildUsers objects filtered by the username column
 * @method     ChildUsers[]|ObjectCollection findByPassword(string $password) Return ChildUsers objects filtered by the password column
 * @method     ChildUsers[]|ObjectCollection findByPasswordMod(string $password_mod) Return ChildUsers objects filtered by the password_mod column
 * @method     ChildUsers[]|ObjectCollection findByPasswordModCoockie(string $password_mod_coockie) Return ChildUsers objects filtered by the password_mod_coockie column
 * @method     ChildUsers[]|ObjectCollection findById(int $id) Return ChildUsers objects filtered by the id column
 * @method     ChildUsers[]|ObjectCollection findByMail(string $mail) Return ChildUsers objects filtered by the mail column
 * @method     ChildUsers[]|ObjectCollection findByClass(int $class) Return ChildUsers objects filtered by the class column
 * @method     ChildUsers[]|ObjectCollection findByClasscustomname(string $classCustomName) Return ChildUsers objects filtered by the classCustomName column
 * @method     ChildUsers[]|ObjectCollection findByAvatar(string $avatar) Return ChildUsers objects filtered by the avatar column
 * @method     ChildUsers[]|ObjectCollection findByAbout(string $about) Return ChildUsers objects filtered by the about column
 * @method     ChildUsers[]|ObjectCollection findByRegDate(string $reg_date) Return ChildUsers objects filtered by the reg_date column
 * @method     ChildUsers[]|ObjectCollection findByPozdrav(int $pozdrav) Return ChildUsers objects filtered by the pozdrav column
 * @method     ChildUsers[]|ObjectCollection findByBrPesni(int $br_pesni) Return ChildUsers objects filtered by the br_pesni column
 * @method     ChildUsers[]|ObjectCollection findByRajdane(string $rajdane) Return ChildUsers objects filtered by the rajdane column
 * @method     ChildUsers[]|ObjectCollection findByPrevodi(int $prevodi) Return ChildUsers objects filtered by the prevodi column
 * @method     ChildUsers[]|ObjectCollection findByAutoplay(int $autoplay) Return ChildUsers objects filtered by the autoplay column
 * @method     ChildUsers[]|ObjectCollection findBySkype(string $skype) Return ChildUsers objects filtered by the skype column
 * @method     ChildUsers[]|ObjectCollection findByActivityPoints(int $activity_points) Return ChildUsers objects filtered by the activity_points column
 * @method     ChildUsers[]|ObjectCollection findByBanned(string $banned) Return ChildUsers objects filtered by the banned column
 * @method     ChildUsers[]|ObjectCollection findByChatmessages(int $chatMessages) Return ChildUsers objects filtered by the chatMessages column
 * @method     ChildUsers[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class UsersQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Tekstove\TekstoveBundle\Model\Entity\Base\UsersQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\Tekstove\\TekstoveBundle\\Model\\Entity\\Users', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildUsersQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildUsersQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildUsersQuery) {
            return $criteria;
        }
        $query = new ChildUsersQuery();
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
     * @return ChildUsers|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = UsersTableMap::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(UsersTableMap::DATABASE_NAME);
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
     * @return ChildUsers A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT username, password, password_mod, password_mod_coockie, id, mail, class, classCustomName, avatar, about, reg_date, pozdrav, br_pesni, rajdane, prevodi, autoplay, skype, activity_points, banned, chatMessages FROM users WHERE id = :p0';
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
            /** @var ChildUsers $obj */
            $obj = new ChildUsers();
            $obj->hydrate($row);
            UsersTableMap::addInstanceToPool($obj, (string) $key);
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
     * @return ChildUsers|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildUsersQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(UsersTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildUsersQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(UsersTableMap::COL_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the username column
     *
     * Example usage:
     * <code>
     * $query->filterByUsername('fooValue');   // WHERE username = 'fooValue'
     * $query->filterByUsername('%fooValue%'); // WHERE username LIKE '%fooValue%'
     * </code>
     *
     * @param     string $username The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUsersQuery The current query, for fluid interface
     */
    public function filterByUsername($username = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($username)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $username)) {
                $username = str_replace('*', '%', $username);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(UsersTableMap::COL_USERNAME, $username, $comparison);
    }

    /**
     * Filter the query on the password column
     *
     * Example usage:
     * <code>
     * $query->filterByPassword('fooValue');   // WHERE password = 'fooValue'
     * $query->filterByPassword('%fooValue%'); // WHERE password LIKE '%fooValue%'
     * </code>
     *
     * @param     string $password The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUsersQuery The current query, for fluid interface
     */
    public function filterByPassword($password = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($password)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $password)) {
                $password = str_replace('*', '%', $password);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(UsersTableMap::COL_PASSWORD, $password, $comparison);
    }

    /**
     * Filter the query on the password_mod column
     *
     * Example usage:
     * <code>
     * $query->filterByPasswordMod('fooValue');   // WHERE password_mod = 'fooValue'
     * $query->filterByPasswordMod('%fooValue%'); // WHERE password_mod LIKE '%fooValue%'
     * </code>
     *
     * @param     string $passwordMod The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUsersQuery The current query, for fluid interface
     */
    public function filterByPasswordMod($passwordMod = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($passwordMod)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $passwordMod)) {
                $passwordMod = str_replace('*', '%', $passwordMod);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(UsersTableMap::COL_PASSWORD_MOD, $passwordMod, $comparison);
    }

    /**
     * Filter the query on the password_mod_coockie column
     *
     * Example usage:
     * <code>
     * $query->filterByPasswordModCoockie('fooValue');   // WHERE password_mod_coockie = 'fooValue'
     * $query->filterByPasswordModCoockie('%fooValue%'); // WHERE password_mod_coockie LIKE '%fooValue%'
     * </code>
     *
     * @param     string $passwordModCoockie The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUsersQuery The current query, for fluid interface
     */
    public function filterByPasswordModCoockie($passwordModCoockie = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($passwordModCoockie)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $passwordModCoockie)) {
                $passwordModCoockie = str_replace('*', '%', $passwordModCoockie);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(UsersTableMap::COL_PASSWORD_MOD_COOCKIE, $passwordModCoockie, $comparison);
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
     * @return $this|ChildUsersQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(UsersTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(UsersTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UsersTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the mail column
     *
     * Example usage:
     * <code>
     * $query->filterByMail('fooValue');   // WHERE mail = 'fooValue'
     * $query->filterByMail('%fooValue%'); // WHERE mail LIKE '%fooValue%'
     * </code>
     *
     * @param     string $mail The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUsersQuery The current query, for fluid interface
     */
    public function filterByMail($mail = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($mail)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $mail)) {
                $mail = str_replace('*', '%', $mail);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(UsersTableMap::COL_MAIL, $mail, $comparison);
    }

    /**
     * Filter the query on the class column
     *
     * Example usage:
     * <code>
     * $query->filterByClass(1234); // WHERE class = 1234
     * $query->filterByClass(array(12, 34)); // WHERE class IN (12, 34)
     * $query->filterByClass(array('min' => 12)); // WHERE class > 12
     * </code>
     *
     * @param     mixed $class The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUsersQuery The current query, for fluid interface
     */
    public function filterByClass($class = null, $comparison = null)
    {
        if (is_array($class)) {
            $useMinMax = false;
            if (isset($class['min'])) {
                $this->addUsingAlias(UsersTableMap::COL_CLASS, $class['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($class['max'])) {
                $this->addUsingAlias(UsersTableMap::COL_CLASS, $class['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UsersTableMap::COL_CLASS, $class, $comparison);
    }

    /**
     * Filter the query on the classCustomName column
     *
     * Example usage:
     * <code>
     * $query->filterByClasscustomname('fooValue');   // WHERE classCustomName = 'fooValue'
     * $query->filterByClasscustomname('%fooValue%'); // WHERE classCustomName LIKE '%fooValue%'
     * </code>
     *
     * @param     string $classcustomname The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUsersQuery The current query, for fluid interface
     */
    public function filterByClasscustomname($classcustomname = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($classcustomname)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $classcustomname)) {
                $classcustomname = str_replace('*', '%', $classcustomname);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(UsersTableMap::COL_CLASSCUSTOMNAME, $classcustomname, $comparison);
    }

    /**
     * Filter the query on the avatar column
     *
     * Example usage:
     * <code>
     * $query->filterByAvatar('fooValue');   // WHERE avatar = 'fooValue'
     * $query->filterByAvatar('%fooValue%'); // WHERE avatar LIKE '%fooValue%'
     * </code>
     *
     * @param     string $avatar The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUsersQuery The current query, for fluid interface
     */
    public function filterByAvatar($avatar = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($avatar)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $avatar)) {
                $avatar = str_replace('*', '%', $avatar);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(UsersTableMap::COL_AVATAR, $avatar, $comparison);
    }

    /**
     * Filter the query on the about column
     *
     * Example usage:
     * <code>
     * $query->filterByAbout('fooValue');   // WHERE about = 'fooValue'
     * $query->filterByAbout('%fooValue%'); // WHERE about LIKE '%fooValue%'
     * </code>
     *
     * @param     string $about The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUsersQuery The current query, for fluid interface
     */
    public function filterByAbout($about = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($about)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $about)) {
                $about = str_replace('*', '%', $about);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(UsersTableMap::COL_ABOUT, $about, $comparison);
    }

    /**
     * Filter the query on the reg_date column
     *
     * Example usage:
     * <code>
     * $query->filterByRegDate('2011-03-14'); // WHERE reg_date = '2011-03-14'
     * $query->filterByRegDate('now'); // WHERE reg_date = '2011-03-14'
     * $query->filterByRegDate(array('max' => 'yesterday')); // WHERE reg_date > '2011-03-13'
     * </code>
     *
     * @param     mixed $regDate The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUsersQuery The current query, for fluid interface
     */
    public function filterByRegDate($regDate = null, $comparison = null)
    {
        if (is_array($regDate)) {
            $useMinMax = false;
            if (isset($regDate['min'])) {
                $this->addUsingAlias(UsersTableMap::COL_REG_DATE, $regDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($regDate['max'])) {
                $this->addUsingAlias(UsersTableMap::COL_REG_DATE, $regDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UsersTableMap::COL_REG_DATE, $regDate, $comparison);
    }

    /**
     * Filter the query on the pozdrav column
     *
     * Example usage:
     * <code>
     * $query->filterByPozdrav(1234); // WHERE pozdrav = 1234
     * $query->filterByPozdrav(array(12, 34)); // WHERE pozdrav IN (12, 34)
     * $query->filterByPozdrav(array('min' => 12)); // WHERE pozdrav > 12
     * </code>
     *
     * @param     mixed $pozdrav The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUsersQuery The current query, for fluid interface
     */
    public function filterByPozdrav($pozdrav = null, $comparison = null)
    {
        if (is_array($pozdrav)) {
            $useMinMax = false;
            if (isset($pozdrav['min'])) {
                $this->addUsingAlias(UsersTableMap::COL_POZDRAV, $pozdrav['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($pozdrav['max'])) {
                $this->addUsingAlias(UsersTableMap::COL_POZDRAV, $pozdrav['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UsersTableMap::COL_POZDRAV, $pozdrav, $comparison);
    }

    /**
     * Filter the query on the br_pesni column
     *
     * Example usage:
     * <code>
     * $query->filterByBrPesni(1234); // WHERE br_pesni = 1234
     * $query->filterByBrPesni(array(12, 34)); // WHERE br_pesni IN (12, 34)
     * $query->filterByBrPesni(array('min' => 12)); // WHERE br_pesni > 12
     * </code>
     *
     * @param     mixed $brPesni The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUsersQuery The current query, for fluid interface
     */
    public function filterByBrPesni($brPesni = null, $comparison = null)
    {
        if (is_array($brPesni)) {
            $useMinMax = false;
            if (isset($brPesni['min'])) {
                $this->addUsingAlias(UsersTableMap::COL_BR_PESNI, $brPesni['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($brPesni['max'])) {
                $this->addUsingAlias(UsersTableMap::COL_BR_PESNI, $brPesni['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UsersTableMap::COL_BR_PESNI, $brPesni, $comparison);
    }

    /**
     * Filter the query on the rajdane column
     *
     * Example usage:
     * <code>
     * $query->filterByRajdane('fooValue');   // WHERE rajdane = 'fooValue'
     * $query->filterByRajdane('%fooValue%'); // WHERE rajdane LIKE '%fooValue%'
     * </code>
     *
     * @param     string $rajdane The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUsersQuery The current query, for fluid interface
     */
    public function filterByRajdane($rajdane = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($rajdane)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $rajdane)) {
                $rajdane = str_replace('*', '%', $rajdane);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(UsersTableMap::COL_RAJDANE, $rajdane, $comparison);
    }

    /**
     * Filter the query on the prevodi column
     *
     * Example usage:
     * <code>
     * $query->filterByPrevodi(1234); // WHERE prevodi = 1234
     * $query->filterByPrevodi(array(12, 34)); // WHERE prevodi IN (12, 34)
     * $query->filterByPrevodi(array('min' => 12)); // WHERE prevodi > 12
     * </code>
     *
     * @param     mixed $prevodi The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUsersQuery The current query, for fluid interface
     */
    public function filterByPrevodi($prevodi = null, $comparison = null)
    {
        if (is_array($prevodi)) {
            $useMinMax = false;
            if (isset($prevodi['min'])) {
                $this->addUsingAlias(UsersTableMap::COL_PREVODI, $prevodi['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($prevodi['max'])) {
                $this->addUsingAlias(UsersTableMap::COL_PREVODI, $prevodi['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UsersTableMap::COL_PREVODI, $prevodi, $comparison);
    }

    /**
     * Filter the query on the autoplay column
     *
     * Example usage:
     * <code>
     * $query->filterByAutoplay(1234); // WHERE autoplay = 1234
     * $query->filterByAutoplay(array(12, 34)); // WHERE autoplay IN (12, 34)
     * $query->filterByAutoplay(array('min' => 12)); // WHERE autoplay > 12
     * </code>
     *
     * @param     mixed $autoplay The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUsersQuery The current query, for fluid interface
     */
    public function filterByAutoplay($autoplay = null, $comparison = null)
    {
        if (is_array($autoplay)) {
            $useMinMax = false;
            if (isset($autoplay['min'])) {
                $this->addUsingAlias(UsersTableMap::COL_AUTOPLAY, $autoplay['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($autoplay['max'])) {
                $this->addUsingAlias(UsersTableMap::COL_AUTOPLAY, $autoplay['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UsersTableMap::COL_AUTOPLAY, $autoplay, $comparison);
    }

    /**
     * Filter the query on the skype column
     *
     * Example usage:
     * <code>
     * $query->filterBySkype('fooValue');   // WHERE skype = 'fooValue'
     * $query->filterBySkype('%fooValue%'); // WHERE skype LIKE '%fooValue%'
     * </code>
     *
     * @param     string $skype The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUsersQuery The current query, for fluid interface
     */
    public function filterBySkype($skype = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($skype)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $skype)) {
                $skype = str_replace('*', '%', $skype);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(UsersTableMap::COL_SKYPE, $skype, $comparison);
    }

    /**
     * Filter the query on the activity_points column
     *
     * Example usage:
     * <code>
     * $query->filterByActivityPoints(1234); // WHERE activity_points = 1234
     * $query->filterByActivityPoints(array(12, 34)); // WHERE activity_points IN (12, 34)
     * $query->filterByActivityPoints(array('min' => 12)); // WHERE activity_points > 12
     * </code>
     *
     * @param     mixed $activityPoints The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUsersQuery The current query, for fluid interface
     */
    public function filterByActivityPoints($activityPoints = null, $comparison = null)
    {
        if (is_array($activityPoints)) {
            $useMinMax = false;
            if (isset($activityPoints['min'])) {
                $this->addUsingAlias(UsersTableMap::COL_ACTIVITY_POINTS, $activityPoints['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($activityPoints['max'])) {
                $this->addUsingAlias(UsersTableMap::COL_ACTIVITY_POINTS, $activityPoints['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UsersTableMap::COL_ACTIVITY_POINTS, $activityPoints, $comparison);
    }

    /**
     * Filter the query on the banned column
     *
     * Example usage:
     * <code>
     * $query->filterByBanned('2011-03-14'); // WHERE banned = '2011-03-14'
     * $query->filterByBanned('now'); // WHERE banned = '2011-03-14'
     * $query->filterByBanned(array('max' => 'yesterday')); // WHERE banned > '2011-03-13'
     * </code>
     *
     * @param     mixed $banned The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUsersQuery The current query, for fluid interface
     */
    public function filterByBanned($banned = null, $comparison = null)
    {
        if (is_array($banned)) {
            $useMinMax = false;
            if (isset($banned['min'])) {
                $this->addUsingAlias(UsersTableMap::COL_BANNED, $banned['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($banned['max'])) {
                $this->addUsingAlias(UsersTableMap::COL_BANNED, $banned['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UsersTableMap::COL_BANNED, $banned, $comparison);
    }

    /**
     * Filter the query on the chatMessages column
     *
     * Example usage:
     * <code>
     * $query->filterByChatmessages(1234); // WHERE chatMessages = 1234
     * $query->filterByChatmessages(array(12, 34)); // WHERE chatMessages IN (12, 34)
     * $query->filterByChatmessages(array('min' => 12)); // WHERE chatMessages > 12
     * </code>
     *
     * @param     mixed $chatmessages The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUsersQuery The current query, for fluid interface
     */
    public function filterByChatmessages($chatmessages = null, $comparison = null)
    {
        if (is_array($chatmessages)) {
            $useMinMax = false;
            if (isset($chatmessages['min'])) {
                $this->addUsingAlias(UsersTableMap::COL_CHATMESSAGES, $chatmessages['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($chatmessages['max'])) {
                $this->addUsingAlias(UsersTableMap::COL_CHATMESSAGES, $chatmessages['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UsersTableMap::COL_CHATMESSAGES, $chatmessages, $comparison);
    }

    /**
     * Filter the query by a related \Tekstove\TekstoveBundle\Model\Entity\ChatOnline object
     *
     * @param \Tekstove\TekstoveBundle\Model\Entity\ChatOnline|ObjectCollection $chatOnline the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildUsersQuery The current query, for fluid interface
     */
    public function filterByChatOnline($chatOnline, $comparison = null)
    {
        if ($chatOnline instanceof \Tekstove\TekstoveBundle\Model\Entity\ChatOnline) {
            return $this
                ->addUsingAlias(UsersTableMap::COL_ID, $chatOnline->getUserid(), $comparison);
        } elseif ($chatOnline instanceof ObjectCollection) {
            return $this
                ->useChatOnlineQuery()
                ->filterByPrimaryKeys($chatOnline->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByChatOnline() only accepts arguments of type \Tekstove\TekstoveBundle\Model\Entity\ChatOnline or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the ChatOnline relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildUsersQuery The current query, for fluid interface
     */
    public function joinChatOnline($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('ChatOnline');

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
            $this->addJoinObject($join, 'ChatOnline');
        }

        return $this;
    }

    /**
     * Use the ChatOnline relation ChatOnline object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Tekstove\TekstoveBundle\Model\Entity\ChatOnlineQuery A secondary query class using the current class as primary query
     */
    public function useChatOnlineQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinChatOnline($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ChatOnline', '\Tekstove\TekstoveBundle\Model\Entity\ChatOnlineQuery');
    }

    /**
     * Filter the query by a related \Tekstove\TekstoveBundle\Model\Entity\PermissionGroupUsers object
     *
     * @param \Tekstove\TekstoveBundle\Model\Entity\PermissionGroupUsers|ObjectCollection $permissionGroupUsers the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildUsersQuery The current query, for fluid interface
     */
    public function filterByPermissionGroupUsers($permissionGroupUsers, $comparison = null)
    {
        if ($permissionGroupUsers instanceof \Tekstove\TekstoveBundle\Model\Entity\PermissionGroupUsers) {
            return $this
                ->addUsingAlias(UsersTableMap::COL_ID, $permissionGroupUsers->getUserid(), $comparison);
        } elseif ($permissionGroupUsers instanceof ObjectCollection) {
            return $this
                ->usePermissionGroupUsersQuery()
                ->filterByPrimaryKeys($permissionGroupUsers->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByPermissionGroupUsers() only accepts arguments of type \Tekstove\TekstoveBundle\Model\Entity\PermissionGroupUsers or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the PermissionGroupUsers relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildUsersQuery The current query, for fluid interface
     */
    public function joinPermissionGroupUsers($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('PermissionGroupUsers');

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
            $this->addJoinObject($join, 'PermissionGroupUsers');
        }

        return $this;
    }

    /**
     * Use the PermissionGroupUsers relation PermissionGroupUsers object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Tekstove\TekstoveBundle\Model\Entity\PermissionGroupUsersQuery A secondary query class using the current class as primary query
     */
    public function usePermissionGroupUsersQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinPermissionGroupUsers($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'PermissionGroupUsers', '\Tekstove\TekstoveBundle\Model\Entity\PermissionGroupUsersQuery');
    }

    /**
     * Filter the query by a related \Tekstove\TekstoveBundle\Model\Entity\PermissionUsers object
     *
     * @param \Tekstove\TekstoveBundle\Model\Entity\PermissionUsers|ObjectCollection $permissionUsers the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildUsersQuery The current query, for fluid interface
     */
    public function filterByPermissionUsers($permissionUsers, $comparison = null)
    {
        if ($permissionUsers instanceof \Tekstove\TekstoveBundle\Model\Entity\PermissionUsers) {
            return $this
                ->addUsingAlias(UsersTableMap::COL_ID, $permissionUsers->getUserid(), $comparison);
        } elseif ($permissionUsers instanceof ObjectCollection) {
            return $this
                ->usePermissionUsersQuery()
                ->filterByPrimaryKeys($permissionUsers->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByPermissionUsers() only accepts arguments of type \Tekstove\TekstoveBundle\Model\Entity\PermissionUsers or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the PermissionUsers relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildUsersQuery The current query, for fluid interface
     */
    public function joinPermissionUsers($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('PermissionUsers');

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
            $this->addJoinObject($join, 'PermissionUsers');
        }

        return $this;
    }

    /**
     * Use the PermissionUsers relation PermissionUsers object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Tekstove\TekstoveBundle\Model\Entity\PermissionUsersQuery A secondary query class using the current class as primary query
     */
    public function usePermissionUsersQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinPermissionUsers($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'PermissionUsers', '\Tekstove\TekstoveBundle\Model\Entity\PermissionUsersQuery');
    }

    /**
     * Filter the query by a related \Tekstove\TekstoveBundle\Model\Entity\ForumTopicWatchers object
     *
     * @param \Tekstove\TekstoveBundle\Model\Entity\ForumTopicWatchers|ObjectCollection $forumTopicWatchers the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildUsersQuery The current query, for fluid interface
     */
    public function filterByForumTopicWatchers($forumTopicWatchers, $comparison = null)
    {
        if ($forumTopicWatchers instanceof \Tekstove\TekstoveBundle\Model\Entity\ForumTopicWatchers) {
            return $this
                ->addUsingAlias(UsersTableMap::COL_ID, $forumTopicWatchers->getUserId(), $comparison);
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
     * @return $this|ChildUsersQuery The current query, for fluid interface
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
     * Filter the query by a related \Tekstove\TekstoveBundle\Model\Entity\Prevodi object
     *
     * @param \Tekstove\TekstoveBundle\Model\Entity\Prevodi|ObjectCollection $prevodi the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildUsersQuery The current query, for fluid interface
     */
    public function filterByPrevodi($prevodi, $comparison = null)
    {
        if ($prevodi instanceof \Tekstove\TekstoveBundle\Model\Entity\Prevodi) {
            return $this
                ->addUsingAlias(UsersTableMap::COL_ID, $prevodi->getUserId(), $comparison);
        } elseif ($prevodi instanceof ObjectCollection) {
            return $this
                ->usePrevodiQuery()
                ->filterByPrimaryKeys($prevodi->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByPrevodi() only accepts arguments of type \Tekstove\TekstoveBundle\Model\Entity\Prevodi or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Prevodi relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildUsersQuery The current query, for fluid interface
     */
    public function joinPrevodi($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Prevodi');

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
            $this->addJoinObject($join, 'Prevodi');
        }

        return $this;
    }

    /**
     * Use the Prevodi relation Prevodi object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Tekstove\TekstoveBundle\Model\Entity\PrevodiQuery A secondary query class using the current class as primary query
     */
    public function usePrevodiQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinPrevodi($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Prevodi', '\Tekstove\TekstoveBundle\Model\Entity\PrevodiQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildUsers $users Object to remove from the list of results
     *
     * @return $this|ChildUsersQuery The current query, for fluid interface
     */
    public function prune($users = null)
    {
        if ($users) {
            $this->addUsingAlias(UsersTableMap::COL_ID, $users->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the users table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(UsersTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            UsersTableMap::clearInstancePool();
            UsersTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(UsersTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(UsersTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            UsersTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            UsersTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // UsersQuery
