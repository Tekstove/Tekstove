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
use Tekstove\TekstoveBundle\Model\Entity\ForumTopicWatchers as ChildForumTopicWatchers;
use Tekstove\TekstoveBundle\Model\Entity\ForumTopicWatchersQuery as ChildForumTopicWatchersQuery;
use Tekstove\TekstoveBundle\Model\Entity\Map\ForumTopicWatchersTableMap;

/**
 * Base class that represents a query for the 'forum_topic_watchers' table.
 *
 *
 *
 * @method     ChildForumTopicWatchersQuery orderByUserId($order = Criteria::ASC) Order by the user_id column
 * @method     ChildForumTopicWatchersQuery orderByForumTopicId($order = Criteria::ASC) Order by the forum_topic_id column
 *
 * @method     ChildForumTopicWatchersQuery groupByUserId() Group by the user_id column
 * @method     ChildForumTopicWatchersQuery groupByForumTopicId() Group by the forum_topic_id column
 *
 * @method     ChildForumTopicWatchersQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildForumTopicWatchersQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildForumTopicWatchersQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildForumTopicWatchersQuery leftJoinUsers($relationAlias = null) Adds a LEFT JOIN clause to the query using the Users relation
 * @method     ChildForumTopicWatchersQuery rightJoinUsers($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Users relation
 * @method     ChildForumTopicWatchersQuery innerJoinUsers($relationAlias = null) Adds a INNER JOIN clause to the query using the Users relation
 *
 * @method     ChildForumTopicWatchersQuery leftJoinForumTopic($relationAlias = null) Adds a LEFT JOIN clause to the query using the ForumTopic relation
 * @method     ChildForumTopicWatchersQuery rightJoinForumTopic($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ForumTopic relation
 * @method     ChildForumTopicWatchersQuery innerJoinForumTopic($relationAlias = null) Adds a INNER JOIN clause to the query using the ForumTopic relation
 *
 * @method     \Tekstove\TekstoveBundle\Model\Entity\UsersQuery|\Tekstove\TekstoveBundle\Model\Entity\ForumTopicQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildForumTopicWatchers findOne(ConnectionInterface $con = null) Return the first ChildForumTopicWatchers matching the query
 * @method     ChildForumTopicWatchers findOneOrCreate(ConnectionInterface $con = null) Return the first ChildForumTopicWatchers matching the query, or a new ChildForumTopicWatchers object populated from the query conditions when no match is found
 *
 * @method     ChildForumTopicWatchers findOneByUserId(int $user_id) Return the first ChildForumTopicWatchers filtered by the user_id column
 * @method     ChildForumTopicWatchers findOneByForumTopicId(int $forum_topic_id) Return the first ChildForumTopicWatchers filtered by the forum_topic_id column *

 * @method     ChildForumTopicWatchers requirePk($key, ConnectionInterface $con = null) Return the ChildForumTopicWatchers by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildForumTopicWatchers requireOne(ConnectionInterface $con = null) Return the first ChildForumTopicWatchers matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildForumTopicWatchers requireOneByUserId(int $user_id) Return the first ChildForumTopicWatchers filtered by the user_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildForumTopicWatchers requireOneByForumTopicId(int $forum_topic_id) Return the first ChildForumTopicWatchers filtered by the forum_topic_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildForumTopicWatchers[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildForumTopicWatchers objects based on current ModelCriteria
 * @method     ChildForumTopicWatchers[]|ObjectCollection findByUserId(int $user_id) Return ChildForumTopicWatchers objects filtered by the user_id column
 * @method     ChildForumTopicWatchers[]|ObjectCollection findByForumTopicId(int $forum_topic_id) Return ChildForumTopicWatchers objects filtered by the forum_topic_id column
 * @method     ChildForumTopicWatchers[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class ForumTopicWatchersQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Tekstove\TekstoveBundle\Model\Entity\Base\ForumTopicWatchersQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\Tekstove\\TekstoveBundle\\Model\\Entity\\ForumTopicWatchers', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildForumTopicWatchersQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildForumTopicWatchersQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildForumTopicWatchersQuery) {
            return $criteria;
        }
        $query = new ChildForumTopicWatchersQuery();
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
     * @param array[$user_id, $forum_topic_id] $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildForumTopicWatchers|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = ForumTopicWatchersTableMap::getInstanceFromPool(serialize(array((string) $key[0], (string) $key[1]))))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(ForumTopicWatchersTableMap::DATABASE_NAME);
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
     * @return ChildForumTopicWatchers A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT user_id, forum_topic_id FROM forum_topic_watchers WHERE user_id = :p0 AND forum_topic_id = :p1';
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
            /** @var ChildForumTopicWatchers $obj */
            $obj = new ChildForumTopicWatchers();
            $obj->hydrate($row);
            ForumTopicWatchersTableMap::addInstanceToPool($obj, serialize(array((string) $key[0], (string) $key[1])));
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
     * @return ChildForumTopicWatchers|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildForumTopicWatchersQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {
        $this->addUsingAlias(ForumTopicWatchersTableMap::COL_USER_ID, $key[0], Criteria::EQUAL);
        $this->addUsingAlias(ForumTopicWatchersTableMap::COL_FORUM_TOPIC_ID, $key[1], Criteria::EQUAL);

        return $this;
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildForumTopicWatchersQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {
        if (empty($keys)) {
            return $this->add(null, '1<>1', Criteria::CUSTOM);
        }
        foreach ($keys as $key) {
            $cton0 = $this->getNewCriterion(ForumTopicWatchersTableMap::COL_USER_ID, $key[0], Criteria::EQUAL);
            $cton1 = $this->getNewCriterion(ForumTopicWatchersTableMap::COL_FORUM_TOPIC_ID, $key[1], Criteria::EQUAL);
            $cton0->addAnd($cton1);
            $this->addOr($cton0);
        }

        return $this;
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
     * @see       filterByUsers()
     *
     * @param     mixed $userId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildForumTopicWatchersQuery The current query, for fluid interface
     */
    public function filterByUserId($userId = null, $comparison = null)
    {
        if (is_array($userId)) {
            $useMinMax = false;
            if (isset($userId['min'])) {
                $this->addUsingAlias(ForumTopicWatchersTableMap::COL_USER_ID, $userId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($userId['max'])) {
                $this->addUsingAlias(ForumTopicWatchersTableMap::COL_USER_ID, $userId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ForumTopicWatchersTableMap::COL_USER_ID, $userId, $comparison);
    }

    /**
     * Filter the query on the forum_topic_id column
     *
     * Example usage:
     * <code>
     * $query->filterByForumTopicId(1234); // WHERE forum_topic_id = 1234
     * $query->filterByForumTopicId(array(12, 34)); // WHERE forum_topic_id IN (12, 34)
     * $query->filterByForumTopicId(array('min' => 12)); // WHERE forum_topic_id > 12
     * </code>
     *
     * @see       filterByForumTopic()
     *
     * @param     mixed $forumTopicId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildForumTopicWatchersQuery The current query, for fluid interface
     */
    public function filterByForumTopicId($forumTopicId = null, $comparison = null)
    {
        if (is_array($forumTopicId)) {
            $useMinMax = false;
            if (isset($forumTopicId['min'])) {
                $this->addUsingAlias(ForumTopicWatchersTableMap::COL_FORUM_TOPIC_ID, $forumTopicId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($forumTopicId['max'])) {
                $this->addUsingAlias(ForumTopicWatchersTableMap::COL_FORUM_TOPIC_ID, $forumTopicId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ForumTopicWatchersTableMap::COL_FORUM_TOPIC_ID, $forumTopicId, $comparison);
    }

    /**
     * Filter the query by a related \Tekstove\TekstoveBundle\Model\Entity\Users object
     *
     * @param \Tekstove\TekstoveBundle\Model\Entity\Users|ObjectCollection $users The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildForumTopicWatchersQuery The current query, for fluid interface
     */
    public function filterByUsers($users, $comparison = null)
    {
        if ($users instanceof \Tekstove\TekstoveBundle\Model\Entity\Users) {
            return $this
                ->addUsingAlias(ForumTopicWatchersTableMap::COL_USER_ID, $users->getId(), $comparison);
        } elseif ($users instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(ForumTopicWatchersTableMap::COL_USER_ID, $users->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByUsers() only accepts arguments of type \Tekstove\TekstoveBundle\Model\Entity\Users or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Users relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildForumTopicWatchersQuery The current query, for fluid interface
     */
    public function joinUsers($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Users');

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
            $this->addJoinObject($join, 'Users');
        }

        return $this;
    }

    /**
     * Use the Users relation Users object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Tekstove\TekstoveBundle\Model\Entity\UsersQuery A secondary query class using the current class as primary query
     */
    public function useUsersQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinUsers($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Users', '\Tekstove\TekstoveBundle\Model\Entity\UsersQuery');
    }

    /**
     * Filter the query by a related \Tekstove\TekstoveBundle\Model\Entity\ForumTopic object
     *
     * @param \Tekstove\TekstoveBundle\Model\Entity\ForumTopic|ObjectCollection $forumTopic The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildForumTopicWatchersQuery The current query, for fluid interface
     */
    public function filterByForumTopic($forumTopic, $comparison = null)
    {
        if ($forumTopic instanceof \Tekstove\TekstoveBundle\Model\Entity\ForumTopic) {
            return $this
                ->addUsingAlias(ForumTopicWatchersTableMap::COL_FORUM_TOPIC_ID, $forumTopic->getId(), $comparison);
        } elseif ($forumTopic instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(ForumTopicWatchersTableMap::COL_FORUM_TOPIC_ID, $forumTopic->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByForumTopic() only accepts arguments of type \Tekstove\TekstoveBundle\Model\Entity\ForumTopic or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the ForumTopic relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildForumTopicWatchersQuery The current query, for fluid interface
     */
    public function joinForumTopic($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('ForumTopic');

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
            $this->addJoinObject($join, 'ForumTopic');
        }

        return $this;
    }

    /**
     * Use the ForumTopic relation ForumTopic object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Tekstove\TekstoveBundle\Model\Entity\ForumTopicQuery A secondary query class using the current class as primary query
     */
    public function useForumTopicQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinForumTopic($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ForumTopic', '\Tekstove\TekstoveBundle\Model\Entity\ForumTopicQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildForumTopicWatchers $forumTopicWatchers Object to remove from the list of results
     *
     * @return $this|ChildForumTopicWatchersQuery The current query, for fluid interface
     */
    public function prune($forumTopicWatchers = null)
    {
        if ($forumTopicWatchers) {
            $this->addCond('pruneCond0', $this->getAliasedColName(ForumTopicWatchersTableMap::COL_USER_ID), $forumTopicWatchers->getUserId(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond1', $this->getAliasedColName(ForumTopicWatchersTableMap::COL_FORUM_TOPIC_ID), $forumTopicWatchers->getForumTopicId(), Criteria::NOT_EQUAL);
            $this->combine(array('pruneCond0', 'pruneCond1'), Criteria::LOGICAL_OR);
        }

        return $this;
    }

    /**
     * Deletes all rows from the forum_topic_watchers table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ForumTopicWatchersTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            ForumTopicWatchersTableMap::clearInstancePool();
            ForumTopicWatchersTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(ForumTopicWatchersTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(ForumTopicWatchersTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            ForumTopicWatchersTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            ForumTopicWatchersTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // ForumTopicWatchersQuery
