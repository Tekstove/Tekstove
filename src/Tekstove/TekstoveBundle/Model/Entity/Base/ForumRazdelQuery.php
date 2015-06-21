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
use Tekstove\TekstoveBundle\Model\Entity\ForumRazdel as ChildForumRazdel;
use Tekstove\TekstoveBundle\Model\Entity\ForumRazdelQuery as ChildForumRazdelQuery;
use Tekstove\TekstoveBundle\Model\Entity\Map\ForumRazdelTableMap;

/**
 * Base class that represents a query for the 'forum_razdel' table.
 *
 *
 *
 * @method     ChildForumRazdelQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method     ChildForumRazdelQuery orderByPodredba($order = Criteria::ASC) Order by the podredba column
 * @method     ChildForumRazdelQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildForumRazdelQuery orderByHidden($order = Criteria::ASC) Order by the hidden column
 *
 * @method     ChildForumRazdelQuery groupByName() Group by the name column
 * @method     ChildForumRazdelQuery groupByPodredba() Group by the podredba column
 * @method     ChildForumRazdelQuery groupById() Group by the id column
 * @method     ChildForumRazdelQuery groupByHidden() Group by the hidden column
 *
 * @method     ChildForumRazdelQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildForumRazdelQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildForumRazdelQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildForumRazdelQuery leftJoinForumTopic($relationAlias = null) Adds a LEFT JOIN clause to the query using the ForumTopic relation
 * @method     ChildForumRazdelQuery rightJoinForumTopic($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ForumTopic relation
 * @method     ChildForumRazdelQuery innerJoinForumTopic($relationAlias = null) Adds a INNER JOIN clause to the query using the ForumTopic relation
 *
 * @method     \Tekstove\TekstoveBundle\Model\Entity\ForumTopicQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildForumRazdel findOne(ConnectionInterface $con = null) Return the first ChildForumRazdel matching the query
 * @method     ChildForumRazdel findOneOrCreate(ConnectionInterface $con = null) Return the first ChildForumRazdel matching the query, or a new ChildForumRazdel object populated from the query conditions when no match is found
 *
 * @method     ChildForumRazdel findOneByName(string $name) Return the first ChildForumRazdel filtered by the name column
 * @method     ChildForumRazdel findOneByPodredba(boolean $podredba) Return the first ChildForumRazdel filtered by the podredba column
 * @method     ChildForumRazdel findOneById(int $id) Return the first ChildForumRazdel filtered by the id column
 * @method     ChildForumRazdel findOneByHidden(boolean $hidden) Return the first ChildForumRazdel filtered by the hidden column *

 * @method     ChildForumRazdel requirePk($key, ConnectionInterface $con = null) Return the ChildForumRazdel by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildForumRazdel requireOne(ConnectionInterface $con = null) Return the first ChildForumRazdel matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildForumRazdel requireOneByName(string $name) Return the first ChildForumRazdel filtered by the name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildForumRazdel requireOneByPodredba(boolean $podredba) Return the first ChildForumRazdel filtered by the podredba column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildForumRazdel requireOneById(int $id) Return the first ChildForumRazdel filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildForumRazdel requireOneByHidden(boolean $hidden) Return the first ChildForumRazdel filtered by the hidden column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildForumRazdel[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildForumRazdel objects based on current ModelCriteria
 * @method     ChildForumRazdel[]|ObjectCollection findByName(string $name) Return ChildForumRazdel objects filtered by the name column
 * @method     ChildForumRazdel[]|ObjectCollection findByPodredba(boolean $podredba) Return ChildForumRazdel objects filtered by the podredba column
 * @method     ChildForumRazdel[]|ObjectCollection findById(int $id) Return ChildForumRazdel objects filtered by the id column
 * @method     ChildForumRazdel[]|ObjectCollection findByHidden(boolean $hidden) Return ChildForumRazdel objects filtered by the hidden column
 * @method     ChildForumRazdel[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class ForumRazdelQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Tekstove\TekstoveBundle\Model\Entity\Base\ForumRazdelQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\Tekstove\\TekstoveBundle\\Model\\Entity\\ForumRazdel', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildForumRazdelQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildForumRazdelQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildForumRazdelQuery) {
            return $criteria;
        }
        $query = new ChildForumRazdelQuery();
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
     * @return ChildForumRazdel|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = ForumRazdelTableMap::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(ForumRazdelTableMap::DATABASE_NAME);
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
     * @return ChildForumRazdel A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT name, podredba, id, hidden FROM forum_razdel WHERE id = :p0';
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
            /** @var ChildForumRazdel $obj */
            $obj = new ChildForumRazdel();
            $obj->hydrate($row);
            ForumRazdelTableMap::addInstanceToPool($obj, (string) $key);
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
     * @return ChildForumRazdel|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildForumRazdelQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(ForumRazdelTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildForumRazdelQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(ForumRazdelTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildForumRazdelQuery The current query, for fluid interface
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

        return $this->addUsingAlias(ForumRazdelTableMap::COL_NAME, $name, $comparison);
    }

    /**
     * Filter the query on the podredba column
     *
     * Example usage:
     * <code>
     * $query->filterByPodredba(true); // WHERE podredba = true
     * $query->filterByPodredba('yes'); // WHERE podredba = true
     * </code>
     *
     * @param     boolean|string $podredba The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildForumRazdelQuery The current query, for fluid interface
     */
    public function filterByPodredba($podredba = null, $comparison = null)
    {
        if (is_string($podredba)) {
            $podredba = in_array(strtolower($podredba), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(ForumRazdelTableMap::COL_PODREDBA, $podredba, $comparison);
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
     * @return $this|ChildForumRazdelQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(ForumRazdelTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(ForumRazdelTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ForumRazdelTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the hidden column
     *
     * Example usage:
     * <code>
     * $query->filterByHidden(true); // WHERE hidden = true
     * $query->filterByHidden('yes'); // WHERE hidden = true
     * </code>
     *
     * @param     boolean|string $hidden The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildForumRazdelQuery The current query, for fluid interface
     */
    public function filterByHidden($hidden = null, $comparison = null)
    {
        if (is_string($hidden)) {
            $hidden = in_array(strtolower($hidden), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(ForumRazdelTableMap::COL_HIDDEN, $hidden, $comparison);
    }

    /**
     * Filter the query by a related \Tekstove\TekstoveBundle\Model\Entity\ForumTopic object
     *
     * @param \Tekstove\TekstoveBundle\Model\Entity\ForumTopic|ObjectCollection $forumTopic the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildForumRazdelQuery The current query, for fluid interface
     */
    public function filterByForumTopic($forumTopic, $comparison = null)
    {
        if ($forumTopic instanceof \Tekstove\TekstoveBundle\Model\Entity\ForumTopic) {
            return $this
                ->addUsingAlias(ForumRazdelTableMap::COL_ID, $forumTopic->getTopicRazdel(), $comparison);
        } elseif ($forumTopic instanceof ObjectCollection) {
            return $this
                ->useForumTopicQuery()
                ->filterByPrimaryKeys($forumTopic->getPrimaryKeys())
                ->endUse();
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
     * @return $this|ChildForumRazdelQuery The current query, for fluid interface
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
     * @param   ChildForumRazdel $forumRazdel Object to remove from the list of results
     *
     * @return $this|ChildForumRazdelQuery The current query, for fluid interface
     */
    public function prune($forumRazdel = null)
    {
        if ($forumRazdel) {
            $this->addUsingAlias(ForumRazdelTableMap::COL_ID, $forumRazdel->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the forum_razdel table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ForumRazdelTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            ForumRazdelTableMap::clearInstancePool();
            ForumRazdelTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(ForumRazdelTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(ForumRazdelTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            ForumRazdelTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            ForumRazdelTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // ForumRazdelQuery
