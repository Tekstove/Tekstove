<?php

namespace Tekstove\TekstoveBundle\Model\Entity\Base;

use \DateTime;
use \Exception;
use \PDO;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveRecord\ActiveRecordInterface;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\BadMethodCallException;
use Propel\Runtime\Exception\LogicException;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Parser\AbstractParser;
use Propel\Runtime\Util\PropelDateTime;
use Tekstove\TekstoveBundle\Model\Entity\ForumPosts as ChildForumPosts;
use Tekstove\TekstoveBundle\Model\Entity\ForumPostsQuery as ChildForumPostsQuery;
use Tekstove\TekstoveBundle\Model\Entity\ForumRazdel as ChildForumRazdel;
use Tekstove\TekstoveBundle\Model\Entity\ForumRazdelQuery as ChildForumRazdelQuery;
use Tekstove\TekstoveBundle\Model\Entity\ForumTopic as ChildForumTopic;
use Tekstove\TekstoveBundle\Model\Entity\ForumTopicQuery as ChildForumTopicQuery;
use Tekstove\TekstoveBundle\Model\Entity\ForumTopicWatchers as ChildForumTopicWatchers;
use Tekstove\TekstoveBundle\Model\Entity\ForumTopicWatchersQuery as ChildForumTopicWatchersQuery;
use Tekstove\TekstoveBundle\Model\Entity\Novini as ChildNovini;
use Tekstove\TekstoveBundle\Model\Entity\NoviniQuery as ChildNoviniQuery;
use Tekstove\TekstoveBundle\Model\Entity\Map\ForumTopicTableMap;

/**
 * Base class that represents a row from the 'forum_topic' table.
 *
 *
 *
* @package    propel.generator.Tekstove.TekstoveBundle.Model.Entity.Base
*/
abstract class ForumTopic implements ActiveRecordInterface
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\Tekstove\\TekstoveBundle\\Model\\Entity\\Map\\ForumTopicTableMap';


    /**
     * attribute to determine if this object has previously been saved.
     * @var boolean
     */
    protected $new = true;

    /**
     * attribute to determine whether this object has been deleted.
     * @var boolean
     */
    protected $deleted = false;

    /**
     * The columns that have been modified in current object.
     * Tracking modified columns allows us to only update modified columns.
     * @var array
     */
    protected $modifiedColumns = array();

    /**
     * The (virtual) columns that are added at runtime
     * The formatters can add supplementary columns based on a resultset
     * @var array
     */
    protected $virtualColumns = array();

    /**
     * The value for the topic_razdel field.
     * @var        int
     */
    protected $topic_razdel;

    /**
     * The value for the topic_name field.
     * @var        string
     */
    protected $topic_name;

    /**
     * The value for the id field.
     * @var        int
     */
    protected $id;

    /**
     * The value for the topic_pin field.
     * @var        boolean
     */
    protected $topic_pin;

    /**
     * The value for the topic_starter field.
     * @var        int
     */
    protected $topic_starter;

    /**
     * The value for the topic_posleden_post field.
     * Note: this column has a database default value of: (expression) CURRENT_TIMESTAMP
     * @var        \DateTime
     */
    protected $topic_posleden_post;

    /**
     * The value for the priority field.
     * @var        int
     */
    protected $priority;

    /**
     * @var        ChildForumRazdel
     */
    protected $aForumRazdel;

    /**
     * @var        ChildNovini one-to-one related ChildNovini object
     */
    protected $singleNovini;

    /**
     * @var        ObjectCollection|ChildForumPosts[] Collection to store aggregation of ChildForumPosts objects.
     */
    protected $collForumPostss;
    protected $collForumPostssPartial;

    /**
     * @var        ObjectCollection|ChildForumTopicWatchers[] Collection to store aggregation of ChildForumTopicWatchers objects.
     */
    protected $collForumTopicWatcherss;
    protected $collForumTopicWatcherssPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var boolean
     */
    protected $alreadyInSave = false;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildForumPosts[]
     */
    protected $forumPostssScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildForumTopicWatchers[]
     */
    protected $forumTopicWatcherssScheduledForDeletion = null;

    /**
     * Applies default values to this object.
     * This method should be called from the object's constructor (or
     * equivalent initialization method).
     * @see __construct()
     */
    public function applyDefaultValues()
    {
    }

    /**
     * Initializes internal state of Tekstove\TekstoveBundle\Model\Entity\Base\ForumTopic object.
     * @see applyDefaults()
     */
    public function __construct()
    {
        $this->applyDefaultValues();
    }

    /**
     * Returns whether the object has been modified.
     *
     * @return boolean True if the object has been modified.
     */
    public function isModified()
    {
        return !!$this->modifiedColumns;
    }

    /**
     * Has specified column been modified?
     *
     * @param  string  $col column fully qualified name (TableMap::TYPE_COLNAME), e.g. Book::AUTHOR_ID
     * @return boolean True if $col has been modified.
     */
    public function isColumnModified($col)
    {
        return $this->modifiedColumns && isset($this->modifiedColumns[$col]);
    }

    /**
     * Get the columns that have been modified in this object.
     * @return array A unique list of the modified column names for this object.
     */
    public function getModifiedColumns()
    {
        return $this->modifiedColumns ? array_keys($this->modifiedColumns) : [];
    }

    /**
     * Returns whether the object has ever been saved.  This will
     * be false, if the object was retrieved from storage or was created
     * and then saved.
     *
     * @return boolean true, if the object has never been persisted.
     */
    public function isNew()
    {
        return $this->new;
    }

    /**
     * Setter for the isNew attribute.  This method will be called
     * by Propel-generated children and objects.
     *
     * @param boolean $b the state of the object.
     */
    public function setNew($b)
    {
        $this->new = (boolean) $b;
    }

    /**
     * Whether this object has been deleted.
     * @return boolean The deleted state of this object.
     */
    public function isDeleted()
    {
        return $this->deleted;
    }

    /**
     * Specify whether this object has been deleted.
     * @param  boolean $b The deleted state of this object.
     * @return void
     */
    public function setDeleted($b)
    {
        $this->deleted = (boolean) $b;
    }

    /**
     * Sets the modified state for the object to be false.
     * @param  string $col If supplied, only the specified column is reset.
     * @return void
     */
    public function resetModified($col = null)
    {
        if (null !== $col) {
            if (isset($this->modifiedColumns[$col])) {
                unset($this->modifiedColumns[$col]);
            }
        } else {
            $this->modifiedColumns = array();
        }
    }

    /**
     * Compares this with another <code>ForumTopic</code> instance.  If
     * <code>obj</code> is an instance of <code>ForumTopic</code>, delegates to
     * <code>equals(ForumTopic)</code>.  Otherwise, returns <code>false</code>.
     *
     * @param  mixed   $obj The object to compare to.
     * @return boolean Whether equal to the object specified.
     */
    public function equals($obj)
    {
        if (!$obj instanceof static) {
            return false;
        }

        if ($this === $obj) {
            return true;
        }

        if (null === $this->getPrimaryKey() || null === $obj->getPrimaryKey()) {
            return false;
        }

        return $this->getPrimaryKey() === $obj->getPrimaryKey();
    }

    /**
     * Get the associative array of the virtual columns in this object
     *
     * @return array
     */
    public function getVirtualColumns()
    {
        return $this->virtualColumns;
    }

    /**
     * Checks the existence of a virtual column in this object
     *
     * @param  string  $name The virtual column name
     * @return boolean
     */
    public function hasVirtualColumn($name)
    {
        return array_key_exists($name, $this->virtualColumns);
    }

    /**
     * Get the value of a virtual column in this object
     *
     * @param  string $name The virtual column name
     * @return mixed
     *
     * @throws PropelException
     */
    public function getVirtualColumn($name)
    {
        if (!$this->hasVirtualColumn($name)) {
            throw new PropelException(sprintf('Cannot get value of inexistent virtual column %s.', $name));
        }

        return $this->virtualColumns[$name];
    }

    /**
     * Set the value of a virtual column in this object
     *
     * @param string $name  The virtual column name
     * @param mixed  $value The value to give to the virtual column
     *
     * @return $this|ForumTopic The current object, for fluid interface
     */
    public function setVirtualColumn($name, $value)
    {
        $this->virtualColumns[$name] = $value;

        return $this;
    }

    /**
     * Logs a message using Propel::log().
     *
     * @param  string  $msg
     * @param  int     $priority One of the Propel::LOG_* logging levels
     * @return boolean
     */
    protected function log($msg, $priority = Propel::LOG_INFO)
    {
        return Propel::log(get_class($this) . ': ' . $msg, $priority);
    }

    /**
     * Export the current object properties to a string, using a given parser format
     * <code>
     * $book = BookQuery::create()->findPk(9012);
     * echo $book->exportTo('JSON');
     *  => {"Id":9012,"Title":"Don Juan","ISBN":"0140422161","Price":12.99,"PublisherId":1234,"AuthorId":5678}');
     * </code>
     *
     * @param  mixed   $parser                 A AbstractParser instance, or a format name ('XML', 'YAML', 'JSON', 'CSV')
     * @param  boolean $includeLazyLoadColumns (optional) Whether to include lazy load(ed) columns. Defaults to TRUE.
     * @return string  The exported data
     */
    public function exportTo($parser, $includeLazyLoadColumns = true)
    {
        if (!$parser instanceof AbstractParser) {
            $parser = AbstractParser::getParser($parser);
        }

        return $parser->fromArray($this->toArray(TableMap::TYPE_PHPNAME, $includeLazyLoadColumns, array(), true));
    }

    /**
     * Clean up internal collections prior to serializing
     * Avoids recursive loops that turn into segmentation faults when serializing
     */
    public function __sleep()
    {
        $this->clearAllReferences();

        return array_keys(get_object_vars($this));
    }

    /**
     * Get the [topic_razdel] column value.
     *
     * @return int
     */
    public function getTopicRazdel()
    {
        return $this->topic_razdel;
    }

    /**
     * Get the [topic_name] column value.
     *
     * @return string
     */
    public function getTopicName()
    {
        return $this->topic_name;
    }

    /**
     * Get the [id] column value.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the [topic_pin] column value.
     *
     * @return boolean
     */
    public function getTopicPin()
    {
        return $this->topic_pin;
    }

    /**
     * Get the [topic_pin] column value.
     *
     * @return boolean
     */
    public function isTopicPin()
    {
        return $this->getTopicPin();
    }

    /**
     * Get the [topic_starter] column value.
     *
     * @return int
     */
    public function getTopicStarter()
    {
        return $this->topic_starter;
    }

    /**
     * Get the [optionally formatted] temporal [topic_posleden_post] column value.
     *
     *
     * @param      string $format The date/time format string (either date()-style or strftime()-style).
     *                            If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getTopicPosledenPost($format = NULL)
    {
        if ($format === null) {
            return $this->topic_posleden_post;
        } else {
            return $this->topic_posleden_post instanceof \DateTime ? $this->topic_posleden_post->format($format) : null;
        }
    }

    /**
     * Get the [priority] column value.
     *
     * @return int
     */
    public function getPriority()
    {
        return $this->priority;
    }

    /**
     * Set the value of [topic_razdel] column.
     *
     * @param int $v new value
     * @return $this|\Tekstove\TekstoveBundle\Model\Entity\ForumTopic The current object (for fluent API support)
     */
    public function setTopicRazdel($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->topic_razdel !== $v) {
            $this->topic_razdel = $v;
            $this->modifiedColumns[ForumTopicTableMap::COL_TOPIC_RAZDEL] = true;
        }

        if ($this->aForumRazdel !== null && $this->aForumRazdel->getId() !== $v) {
            $this->aForumRazdel = null;
        }

        return $this;
    } // setTopicRazdel()

    /**
     * Set the value of [topic_name] column.
     *
     * @param string $v new value
     * @return $this|\Tekstove\TekstoveBundle\Model\Entity\ForumTopic The current object (for fluent API support)
     */
    public function setTopicName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->topic_name !== $v) {
            $this->topic_name = $v;
            $this->modifiedColumns[ForumTopicTableMap::COL_TOPIC_NAME] = true;
        }

        return $this;
    } // setTopicName()

    /**
     * Set the value of [id] column.
     *
     * @param int $v new value
     * @return $this|\Tekstove\TekstoveBundle\Model\Entity\ForumTopic The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[ForumTopicTableMap::COL_ID] = true;
        }

        return $this;
    } // setId()

    /**
     * Sets the value of the [topic_pin] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param  boolean|integer|string $v The new value
     * @return $this|\Tekstove\TekstoveBundle\Model\Entity\ForumTopic The current object (for fluent API support)
     */
    public function setTopicPin($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->topic_pin !== $v) {
            $this->topic_pin = $v;
            $this->modifiedColumns[ForumTopicTableMap::COL_TOPIC_PIN] = true;
        }

        return $this;
    } // setTopicPin()

    /**
     * Set the value of [topic_starter] column.
     *
     * @param int $v new value
     * @return $this|\Tekstove\TekstoveBundle\Model\Entity\ForumTopic The current object (for fluent API support)
     */
    public function setTopicStarter($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->topic_starter !== $v) {
            $this->topic_starter = $v;
            $this->modifiedColumns[ForumTopicTableMap::COL_TOPIC_STARTER] = true;
        }

        return $this;
    } // setTopicStarter()

    /**
     * Sets the value of [topic_posleden_post] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTime value.
     *               Empty strings are treated as NULL.
     * @return $this|\Tekstove\TekstoveBundle\Model\Entity\ForumTopic The current object (for fluent API support)
     */
    public function setTopicPosledenPost($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->topic_posleden_post !== null || $dt !== null) {
            if ($this->topic_posleden_post === null || $dt === null || $dt->format("Y-m-d H:i:s") !== $this->topic_posleden_post->format("Y-m-d H:i:s")) {
                $this->topic_posleden_post = $dt === null ? null : clone $dt;
                $this->modifiedColumns[ForumTopicTableMap::COL_TOPIC_POSLEDEN_POST] = true;
            }
        } // if either are not null

        return $this;
    } // setTopicPosledenPost()

    /**
     * Set the value of [priority] column.
     *
     * @param int $v new value
     * @return $this|\Tekstove\TekstoveBundle\Model\Entity\ForumTopic The current object (for fluent API support)
     */
    public function setPriority($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->priority !== $v) {
            $this->priority = $v;
            $this->modifiedColumns[ForumTopicTableMap::COL_PRIORITY] = true;
        }

        return $this;
    } // setPriority()

    /**
     * Indicates whether the columns in this object are only set to default values.
     *
     * This method can be used in conjunction with isModified() to indicate whether an object is both
     * modified _and_ has some values set which are non-default.
     *
     * @return boolean Whether the columns in this object are only been set with default values.
     */
    public function hasOnlyDefaultValues()
    {
        // otherwise, everything was equal, so return TRUE
        return true;
    } // hasOnlyDefaultValues()

    /**
     * Hydrates (populates) the object variables with values from the database resultset.
     *
     * An offset (0-based "start column") is specified so that objects can be hydrated
     * with a subset of the columns in the resultset rows.  This is needed, for example,
     * for results of JOIN queries where the resultset row includes columns from two or
     * more tables.
     *
     * @param array   $row       The row returned by DataFetcher->fetch().
     * @param int     $startcol  0-based offset column which indicates which restultset column to start with.
     * @param boolean $rehydrate Whether this object is being re-hydrated from the database.
     * @param string  $indexType The index type of $row. Mostly DataFetcher->getIndexType().
                                  One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                            TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @return int             next starting column
     * @throws PropelException - Any caught Exception will be rewrapped as a PropelException.
     */
    public function hydrate($row, $startcol = 0, $rehydrate = false, $indexType = TableMap::TYPE_NUM)
    {
        try {

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : ForumTopicTableMap::translateFieldName('TopicRazdel', TableMap::TYPE_PHPNAME, $indexType)];
            $this->topic_razdel = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : ForumTopicTableMap::translateFieldName('TopicName', TableMap::TYPE_PHPNAME, $indexType)];
            $this->topic_name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : ForumTopicTableMap::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : ForumTopicTableMap::translateFieldName('TopicPin', TableMap::TYPE_PHPNAME, $indexType)];
            $this->topic_pin = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : ForumTopicTableMap::translateFieldName('TopicStarter', TableMap::TYPE_PHPNAME, $indexType)];
            $this->topic_starter = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : ForumTopicTableMap::translateFieldName('TopicPosledenPost', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->topic_posleden_post = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : ForumTopicTableMap::translateFieldName('Priority', TableMap::TYPE_PHPNAME, $indexType)];
            $this->priority = (null !== $col) ? (int) $col : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 7; // 7 = ForumTopicTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\Tekstove\\TekstoveBundle\\Model\\Entity\\ForumTopic'), 0, $e);
        }
    }

    /**
     * Checks and repairs the internal consistency of the object.
     *
     * This method is executed after an already-instantiated object is re-hydrated
     * from the database.  It exists to check any foreign keys to make sure that
     * the objects related to the current object are correct based on foreign key.
     *
     * You can override this method in the stub class, but you should always invoke
     * the base method from the overridden method (i.e. parent::ensureConsistency()),
     * in case your model changes.
     *
     * @throws PropelException
     */
    public function ensureConsistency()
    {
        if ($this->aForumRazdel !== null && $this->topic_razdel !== $this->aForumRazdel->getId()) {
            $this->aForumRazdel = null;
        }
    } // ensureConsistency

    /**
     * Reloads this object from datastore based on primary key and (optionally) resets all associated objects.
     *
     * This will only work if the object has been saved and has a valid primary key set.
     *
     * @param      boolean $deep (optional) Whether to also de-associated any related objects.
     * @param      ConnectionInterface $con (optional) The ConnectionInterface connection to use.
     * @return void
     * @throws PropelException - if this object is deleted, unsaved or doesn't have pk match in db
     */
    public function reload($deep = false, ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("Cannot reload a deleted object.");
        }

        if ($this->isNew()) {
            throw new PropelException("Cannot reload an unsaved object.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(ForumTopicTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildForumTopicQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aForumRazdel = null;
            $this->singleNovini = null;

            $this->collForumPostss = null;

            $this->collForumTopicWatcherss = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see ForumTopic::setDeleted()
     * @see ForumTopic::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(ForumTopicTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildForumTopicQuery::create()
                ->filterByPrimaryKey($this->getPrimaryKey());
            $ret = $this->preDelete($con);
            if ($ret) {
                $deleteQuery->delete($con);
                $this->postDelete($con);
                $this->setDeleted(true);
            }
        });
    }

    /**
     * Persists this object to the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All modified related objects will also be persisted in the doSave()
     * method.  This method wraps all precipitate database operations in a
     * single transaction.
     *
     * @param      ConnectionInterface $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @see doSave()
     */
    public function save(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("You cannot save an object that has been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(ForumTopicTableMap::DATABASE_NAME);
        }

        return $con->transaction(function () use ($con) {
            $isInsert = $this->isNew();
            $ret = $this->preSave($con);
            if ($isInsert) {
                $ret = $ret && $this->preInsert($con);
            } else {
                $ret = $ret && $this->preUpdate($con);
            }
            if ($ret) {
                $affectedRows = $this->doSave($con);
                if ($isInsert) {
                    $this->postInsert($con);
                } else {
                    $this->postUpdate($con);
                }
                $this->postSave($con);
                ForumTopicTableMap::addInstanceToPool($this);
            } else {
                $affectedRows = 0;
            }

            return $affectedRows;
        });
    }

    /**
     * Performs the work of inserting or updating the row in the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All related objects are also updated in this method.
     *
     * @param      ConnectionInterface $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @see save()
     */
    protected function doSave(ConnectionInterface $con)
    {
        $affectedRows = 0; // initialize var to track total num of affected rows
        if (!$this->alreadyInSave) {
            $this->alreadyInSave = true;

            // We call the save method on the following object(s) if they
            // were passed to this object by their corresponding set
            // method.  This object relates to these object(s) by a
            // foreign key reference.

            if ($this->aForumRazdel !== null) {
                if ($this->aForumRazdel->isModified() || $this->aForumRazdel->isNew()) {
                    $affectedRows += $this->aForumRazdel->save($con);
                }
                $this->setForumRazdel($this->aForumRazdel);
            }

            if ($this->isNew() || $this->isModified()) {
                // persist changes
                if ($this->isNew()) {
                    $this->doInsert($con);
                    $affectedRows += 1;
                } else {
                    $affectedRows += $this->doUpdate($con);
                }
                $this->resetModified();
            }

            if ($this->singleNovini !== null) {
                if (!$this->singleNovini->isDeleted() && ($this->singleNovini->isNew() || $this->singleNovini->isModified())) {
                    $affectedRows += $this->singleNovini->save($con);
                }
            }

            if ($this->forumPostssScheduledForDeletion !== null) {
                if (!$this->forumPostssScheduledForDeletion->isEmpty()) {
                    \Tekstove\TekstoveBundle\Model\Entity\ForumPostsQuery::create()
                        ->filterByPrimaryKeys($this->forumPostssScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->forumPostssScheduledForDeletion = null;
                }
            }

            if ($this->collForumPostss !== null) {
                foreach ($this->collForumPostss as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->forumTopicWatcherssScheduledForDeletion !== null) {
                if (!$this->forumTopicWatcherssScheduledForDeletion->isEmpty()) {
                    \Tekstove\TekstoveBundle\Model\Entity\ForumTopicWatchersQuery::create()
                        ->filterByPrimaryKeys($this->forumTopicWatcherssScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->forumTopicWatcherssScheduledForDeletion = null;
                }
            }

            if ($this->collForumTopicWatcherss !== null) {
                foreach ($this->collForumTopicWatcherss as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            $this->alreadyInSave = false;

        }

        return $affectedRows;
    } // doSave()

    /**
     * Insert the row in the database.
     *
     * @param      ConnectionInterface $con
     *
     * @throws PropelException
     * @see doSave()
     */
    protected function doInsert(ConnectionInterface $con)
    {
        $modifiedColumns = array();
        $index = 0;


         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(ForumTopicTableMap::COL_TOPIC_RAZDEL)) {
            $modifiedColumns[':p' . $index++]  = 'topic_razdel';
        }
        if ($this->isColumnModified(ForumTopicTableMap::COL_TOPIC_NAME)) {
            $modifiedColumns[':p' . $index++]  = 'topic_name';
        }
        if ($this->isColumnModified(ForumTopicTableMap::COL_ID)) {
            $modifiedColumns[':p' . $index++]  = 'id';
        }
        if ($this->isColumnModified(ForumTopicTableMap::COL_TOPIC_PIN)) {
            $modifiedColumns[':p' . $index++]  = 'topic_pin';
        }
        if ($this->isColumnModified(ForumTopicTableMap::COL_TOPIC_STARTER)) {
            $modifiedColumns[':p' . $index++]  = 'topic_starter';
        }
        if ($this->isColumnModified(ForumTopicTableMap::COL_TOPIC_POSLEDEN_POST)) {
            $modifiedColumns[':p' . $index++]  = 'topic_posleden_post';
        }
        if ($this->isColumnModified(ForumTopicTableMap::COL_PRIORITY)) {
            $modifiedColumns[':p' . $index++]  = 'priority';
        }

        $sql = sprintf(
            'INSERT INTO forum_topic (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'topic_razdel':
                        $stmt->bindValue($identifier, $this->topic_razdel, PDO::PARAM_INT);
                        break;
                    case 'topic_name':
                        $stmt->bindValue($identifier, $this->topic_name, PDO::PARAM_STR);
                        break;
                    case 'id':
                        $stmt->bindValue($identifier, $this->id, PDO::PARAM_INT);
                        break;
                    case 'topic_pin':
                        $stmt->bindValue($identifier, (int) $this->topic_pin, PDO::PARAM_INT);
                        break;
                    case 'topic_starter':
                        $stmt->bindValue($identifier, $this->topic_starter, PDO::PARAM_INT);
                        break;
                    case 'topic_posleden_post':
                        $stmt->bindValue($identifier, $this->topic_posleden_post ? $this->topic_posleden_post->format("Y-m-d H:i:s") : null, PDO::PARAM_STR);
                        break;
                    case 'priority':
                        $stmt->bindValue($identifier, $this->priority, PDO::PARAM_INT);
                        break;
                }
            }
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute INSERT statement [%s]', $sql), 0, $e);
        }

        try {
            $pk = $con->lastInsertId();
        } catch (Exception $e) {
            throw new PropelException('Unable to get autoincrement id.', 0, $e);
        }

        $this->setNew(false);
    }

    /**
     * Update the row in the database.
     *
     * @param      ConnectionInterface $con
     *
     * @return Integer Number of updated rows
     * @see doSave()
     */
    protected function doUpdate(ConnectionInterface $con)
    {
        $selectCriteria = $this->buildPkeyCriteria();
        $valuesCriteria = $this->buildCriteria();

        return $selectCriteria->doUpdate($valuesCriteria, $con);
    }

    /**
     * Retrieves a field from the object by name passed in as a string.
     *
     * @param      string $name name
     * @param      string $type The type of fieldname the $name is of:
     *                     one of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                     TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                     Defaults to TableMap::TYPE_PHPNAME.
     * @return mixed Value of field.
     */
    public function getByName($name, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = ForumTopicTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
        $field = $this->getByPosition($pos);

        return $field;
    }

    /**
     * Retrieves a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param      int $pos position in xml schema
     * @return mixed Value of field at $pos
     */
    public function getByPosition($pos)
    {
        switch ($pos) {
            case 0:
                return $this->getTopicRazdel();
                break;
            case 1:
                return $this->getTopicName();
                break;
            case 2:
                return $this->getId();
                break;
            case 3:
                return $this->getTopicPin();
                break;
            case 4:
                return $this->getTopicStarter();
                break;
            case 5:
                return $this->getTopicPosledenPost();
                break;
            case 6:
                return $this->getPriority();
                break;
            default:
                return null;
                break;
        } // switch()
    }

    /**
     * Exports the object as an array.
     *
     * You can specify the key type of the array by passing one of the class
     * type constants.
     *
     * @param     string  $keyType (optional) One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     *                    TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                    Defaults to TableMap::TYPE_PHPNAME.
     * @param     boolean $includeLazyLoadColumns (optional) Whether to include lazy loaded columns. Defaults to TRUE.
     * @param     array $alreadyDumpedObjects List of objects to skip to avoid recursion
     * @param     boolean $includeForeignObjects (optional) Whether to include hydrated related objects. Default to FALSE.
     *
     * @return array an associative array containing the field names (as keys) and field values
     */
    public function toArray($keyType = TableMap::TYPE_PHPNAME, $includeLazyLoadColumns = true, $alreadyDumpedObjects = array(), $includeForeignObjects = false)
    {

        if (isset($alreadyDumpedObjects['ForumTopic'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['ForumTopic'][$this->hashCode()] = true;
        $keys = ForumTopicTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getTopicRazdel(),
            $keys[1] => $this->getTopicName(),
            $keys[2] => $this->getId(),
            $keys[3] => $this->getTopicPin(),
            $keys[4] => $this->getTopicStarter(),
            $keys[5] => $this->getTopicPosledenPost(),
            $keys[6] => $this->getPriority(),
        );

        $utc = new \DateTimeZone('utc');
        if ($result[$keys[5]] instanceof \DateTime) {
            // When changing timezone we don't want to change existing instances
            $dateTime = clone $result[$keys[5]];
            $result[$keys[5]] = $dateTime->setTimezone($utc)->format('Y-m-d\TH:i:s\Z');
        }

        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->aForumRazdel) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'forumRazdel';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'forum_razdel';
                        break;
                    default:
                        $key = 'ForumRazdel';
                }

                $result[$key] = $this->aForumRazdel->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->singleNovini) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'novini';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'novini';
                        break;
                    default:
                        $key = 'Novini';
                }

                $result[$key] = $this->singleNovini->toArray($keyType, $includeLazyLoadColumns, $alreadyDumpedObjects, true);
            }
            if (null !== $this->collForumPostss) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'forumPostss';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'forum_postss';
                        break;
                    default:
                        $key = 'ForumPostss';
                }

                $result[$key] = $this->collForumPostss->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collForumTopicWatcherss) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'forumTopicWatcherss';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'forum_topic_watcherss';
                        break;
                    default:
                        $key = 'ForumTopicWatcherss';
                }

                $result[$key] = $this->collForumTopicWatcherss->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
        }

        return $result;
    }

    /**
     * Sets a field from the object by name passed in as a string.
     *
     * @param  string $name
     * @param  mixed  $value field value
     * @param  string $type The type of fieldname the $name is of:
     *                one of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                Defaults to TableMap::TYPE_PHPNAME.
     * @return $this|\Tekstove\TekstoveBundle\Model\Entity\ForumTopic
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = ForumTopicTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\Tekstove\TekstoveBundle\Model\Entity\ForumTopic
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setTopicRazdel($value);
                break;
            case 1:
                $this->setTopicName($value);
                break;
            case 2:
                $this->setId($value);
                break;
            case 3:
                $this->setTopicPin($value);
                break;
            case 4:
                $this->setTopicStarter($value);
                break;
            case 5:
                $this->setTopicPosledenPost($value);
                break;
            case 6:
                $this->setPriority($value);
                break;
        } // switch()

        return $this;
    }

    /**
     * Populates the object using an array.
     *
     * This is particularly useful when populating an object from one of the
     * request arrays (e.g. $_POST).  This method goes through the column
     * names, checking to see whether a matching key exists in populated
     * array. If so the setByName() method is called for that column.
     *
     * You can specify the key type of the array by additionally passing one
     * of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     * TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     * The default key type is the column's TableMap::TYPE_PHPNAME.
     *
     * @param      array  $arr     An array to populate the object from.
     * @param      string $keyType The type of keys the array uses.
     * @return void
     */
    public function fromArray($arr, $keyType = TableMap::TYPE_PHPNAME)
    {
        $keys = ForumTopicTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setTopicRazdel($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setTopicName($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setId($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setTopicPin($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setTopicStarter($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setTopicPosledenPost($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setPriority($arr[$keys[6]]);
        }
    }

     /**
     * Populate the current object from a string, using a given parser format
     * <code>
     * $book = new Book();
     * $book->importFrom('JSON', '{"Id":9012,"Title":"Don Juan","ISBN":"0140422161","Price":12.99,"PublisherId":1234,"AuthorId":5678}');
     * </code>
     *
     * You can specify the key type of the array by additionally passing one
     * of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     * TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     * The default key type is the column's TableMap::TYPE_PHPNAME.
     *
     * @param mixed $parser A AbstractParser instance,
     *                       or a format name ('XML', 'YAML', 'JSON', 'CSV')
     * @param string $data The source data to import from
     * @param string $keyType The type of keys the array uses.
     *
     * @return $this|\Tekstove\TekstoveBundle\Model\Entity\ForumTopic The current object, for fluid interface
     */
    public function importFrom($parser, $data, $keyType = TableMap::TYPE_PHPNAME)
    {
        if (!$parser instanceof AbstractParser) {
            $parser = AbstractParser::getParser($parser);
        }

        $this->fromArray($parser->toArray($data), $keyType);

        return $this;
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(ForumTopicTableMap::DATABASE_NAME);

        if ($this->isColumnModified(ForumTopicTableMap::COL_TOPIC_RAZDEL)) {
            $criteria->add(ForumTopicTableMap::COL_TOPIC_RAZDEL, $this->topic_razdel);
        }
        if ($this->isColumnModified(ForumTopicTableMap::COL_TOPIC_NAME)) {
            $criteria->add(ForumTopicTableMap::COL_TOPIC_NAME, $this->topic_name);
        }
        if ($this->isColumnModified(ForumTopicTableMap::COL_ID)) {
            $criteria->add(ForumTopicTableMap::COL_ID, $this->id);
        }
        if ($this->isColumnModified(ForumTopicTableMap::COL_TOPIC_PIN)) {
            $criteria->add(ForumTopicTableMap::COL_TOPIC_PIN, $this->topic_pin);
        }
        if ($this->isColumnModified(ForumTopicTableMap::COL_TOPIC_STARTER)) {
            $criteria->add(ForumTopicTableMap::COL_TOPIC_STARTER, $this->topic_starter);
        }
        if ($this->isColumnModified(ForumTopicTableMap::COL_TOPIC_POSLEDEN_POST)) {
            $criteria->add(ForumTopicTableMap::COL_TOPIC_POSLEDEN_POST, $this->topic_posleden_post);
        }
        if ($this->isColumnModified(ForumTopicTableMap::COL_PRIORITY)) {
            $criteria->add(ForumTopicTableMap::COL_PRIORITY, $this->priority);
        }

        return $criteria;
    }

    /**
     * Builds a Criteria object containing the primary key for this object.
     *
     * Unlike buildCriteria() this method includes the primary key values regardless
     * of whether or not they have been modified.
     *
     * @throws LogicException if no primary key is defined
     *
     * @return Criteria The Criteria object containing value(s) for primary key(s).
     */
    public function buildPkeyCriteria()
    {
        throw new LogicException('The ForumTopic object has no primary key');

        return $criteria;
    }

    /**
     * If the primary key is not null, return the hashcode of the
     * primary key. Otherwise, return the hash code of the object.
     *
     * @return int Hashcode
     */
    public function hashCode()
    {
        $validPk = false;

        $validPrimaryKeyFKs = 0;
        $primaryKeyFKs = [];

        if ($validPk) {
            return crc32(json_encode($this->getPrimaryKey(), JSON_UNESCAPED_UNICODE));
        } elseif ($validPrimaryKeyFKs) {
            return crc32(json_encode($primaryKeyFKs, JSON_UNESCAPED_UNICODE));
        }

        return spl_object_hash($this);
    }

    /**
     * Returns NULL since this table doesn't have a primary key.
     * This method exists only for BC and is deprecated!
     * @return null
     */
    public function getPrimaryKey()
    {
        return null;
    }

    /**
     * Dummy primary key setter.
     *
     * This function only exists to preserve backwards compatibility.  It is no longer
     * needed or required by the Persistent interface.  It will be removed in next BC-breaking
     * release of Propel.
     *
     * @deprecated
     */
    public function setPrimaryKey($pk)
    {
        // do nothing, because this object doesn't have any primary keys
    }

    /**
     * Returns true if the primary key for this object is null.
     * @return boolean
     */
    public function isPrimaryKeyNull()
    {
        return ;
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param      object $copyObj An object of \Tekstove\TekstoveBundle\Model\Entity\ForumTopic (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setTopicRazdel($this->getTopicRazdel());
        $copyObj->setTopicName($this->getTopicName());
        $copyObj->setTopicPin($this->getTopicPin());
        $copyObj->setTopicStarter($this->getTopicStarter());
        $copyObj->setTopicPosledenPost($this->getTopicPosledenPost());
        $copyObj->setPriority($this->getPriority());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            $relObj = $this->getNovini();
            if ($relObj) {
                $copyObj->setNovini($relObj->copy($deepCopy));
            }

            foreach ($this->getForumPostss() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addForumPosts($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getForumTopicWatcherss() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addForumTopicWatchers($relObj->copy($deepCopy));
                }
            }

        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setId(NULL); // this is a auto-increment column, so set to default value
        }
    }

    /**
     * Makes a copy of this object that will be inserted as a new row in table when saved.
     * It creates a new object filling in the simple attributes, but skipping any primary
     * keys that are defined for the table.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param  boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @return \Tekstove\TekstoveBundle\Model\Entity\ForumTopic Clone of current object.
     * @throws PropelException
     */
    public function copy($deepCopy = false)
    {
        // we use get_class(), because this might be a subclass
        $clazz = get_class($this);
        $copyObj = new $clazz();
        $this->copyInto($copyObj, $deepCopy);

        return $copyObj;
    }

    /**
     * Declares an association between this object and a ChildForumRazdel object.
     *
     * @param  ChildForumRazdel $v
     * @return $this|\Tekstove\TekstoveBundle\Model\Entity\ForumTopic The current object (for fluent API support)
     * @throws PropelException
     */
    public function setForumRazdel(ChildForumRazdel $v = null)
    {
        if ($v === null) {
            $this->setTopicRazdel(NULL);
        } else {
            $this->setTopicRazdel($v->getId());
        }

        $this->aForumRazdel = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildForumRazdel object, it will not be re-added.
        if ($v !== null) {
            $v->addForumTopic($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildForumRazdel object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildForumRazdel The associated ChildForumRazdel object.
     * @throws PropelException
     */
    public function getForumRazdel(ConnectionInterface $con = null)
    {
        if ($this->aForumRazdel === null && ($this->topic_razdel !== null)) {
            $this->aForumRazdel = ChildForumRazdelQuery::create()->findPk($this->topic_razdel, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aForumRazdel->addForumTopics($this);
             */
        }

        return $this->aForumRazdel;
    }


    /**
     * Initializes a collection based on the name of a relation.
     * Avoids crafting an 'init[$relationName]s' method name
     * that wouldn't work when StandardEnglishPluralizer is used.
     *
     * @param      string $relationName The name of the relation to initialize
     * @return void
     */
    public function initRelation($relationName)
    {
        if ('ForumPosts' == $relationName) {
            return $this->initForumPostss();
        }
        if ('ForumTopicWatchers' == $relationName) {
            return $this->initForumTopicWatcherss();
        }
    }

    /**
     * Gets a single ChildNovini object, which is related to this object by a one-to-one relationship.
     *
     * @param  ConnectionInterface $con optional connection object
     * @return ChildNovini
     * @throws PropelException
     */
    public function getNovini(ConnectionInterface $con = null)
    {

        if ($this->singleNovini === null && !$this->isNew()) {
            $this->singleNovini = ChildNoviniQuery::create()->findPk($this->getPrimaryKey(), $con);
        }

        return $this->singleNovini;
    }

    /**
     * Sets a single ChildNovini object as related to this object by a one-to-one relationship.
     *
     * @param  ChildNovini $v ChildNovini
     * @return $this|\Tekstove\TekstoveBundle\Model\Entity\ForumTopic The current object (for fluent API support)
     * @throws PropelException
     */
    public function setNovini(ChildNovini $v = null)
    {
        $this->singleNovini = $v;

        // Make sure that that the passed-in ChildNovini isn't already associated with this object
        if ($v !== null && $v->getForumTopic(null, false) === null) {
            $v->setForumTopic($this);
        }

        return $this;
    }

    /**
     * Clears out the collForumPostss collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addForumPostss()
     */
    public function clearForumPostss()
    {
        $this->collForumPostss = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collForumPostss collection loaded partially.
     */
    public function resetPartialForumPostss($v = true)
    {
        $this->collForumPostssPartial = $v;
    }

    /**
     * Initializes the collForumPostss collection.
     *
     * By default this just sets the collForumPostss collection to an empty array (like clearcollForumPostss());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initForumPostss($overrideExisting = true)
    {
        if (null !== $this->collForumPostss && !$overrideExisting) {
            return;
        }
        $this->collForumPostss = new ObjectCollection();
        $this->collForumPostss->setModel('\Tekstove\TekstoveBundle\Model\Entity\ForumPosts');
    }

    /**
     * Gets an array of ChildForumPosts objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildForumTopic is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildForumPosts[] List of ChildForumPosts objects
     * @throws PropelException
     */
    public function getForumPostss(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collForumPostssPartial && !$this->isNew();
        if (null === $this->collForumPostss || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collForumPostss) {
                // return empty collection
                $this->initForumPostss();
            } else {
                $collForumPostss = ChildForumPostsQuery::create(null, $criteria)
                    ->filterByForumTopic($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collForumPostssPartial && count($collForumPostss)) {
                        $this->initForumPostss(false);

                        foreach ($collForumPostss as $obj) {
                            if (false == $this->collForumPostss->contains($obj)) {
                                $this->collForumPostss->append($obj);
                            }
                        }

                        $this->collForumPostssPartial = true;
                    }

                    return $collForumPostss;
                }

                if ($partial && $this->collForumPostss) {
                    foreach ($this->collForumPostss as $obj) {
                        if ($obj->isNew()) {
                            $collForumPostss[] = $obj;
                        }
                    }
                }

                $this->collForumPostss = $collForumPostss;
                $this->collForumPostssPartial = false;
            }
        }

        return $this->collForumPostss;
    }

    /**
     * Sets a collection of ChildForumPosts objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $forumPostss A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildForumTopic The current object (for fluent API support)
     */
    public function setForumPostss(Collection $forumPostss, ConnectionInterface $con = null)
    {
        /** @var ChildForumPosts[] $forumPostssToDelete */
        $forumPostssToDelete = $this->getForumPostss(new Criteria(), $con)->diff($forumPostss);


        $this->forumPostssScheduledForDeletion = $forumPostssToDelete;

        foreach ($forumPostssToDelete as $forumPostsRemoved) {
            $forumPostsRemoved->setForumTopic(null);
        }

        $this->collForumPostss = null;
        foreach ($forumPostss as $forumPosts) {
            $this->addForumPosts($forumPosts);
        }

        $this->collForumPostss = $forumPostss;
        $this->collForumPostssPartial = false;

        return $this;
    }

    /**
     * Returns the number of related ForumPosts objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related ForumPosts objects.
     * @throws PropelException
     */
    public function countForumPostss(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collForumPostssPartial && !$this->isNew();
        if (null === $this->collForumPostss || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collForumPostss) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getForumPostss());
            }

            $query = ChildForumPostsQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByForumTopic($this)
                ->count($con);
        }

        return count($this->collForumPostss);
    }

    /**
     * Method called to associate a ChildForumPosts object to this object
     * through the ChildForumPosts foreign key attribute.
     *
     * @param  ChildForumPosts $l ChildForumPosts
     * @return $this|\Tekstove\TekstoveBundle\Model\Entity\ForumTopic The current object (for fluent API support)
     */
    public function addForumPosts(ChildForumPosts $l)
    {
        if ($this->collForumPostss === null) {
            $this->initForumPostss();
            $this->collForumPostssPartial = true;
        }

        if (!$this->collForumPostss->contains($l)) {
            $this->doAddForumPosts($l);
        }

        return $this;
    }

    /**
     * @param ChildForumPosts $forumPosts The ChildForumPosts object to add.
     */
    protected function doAddForumPosts(ChildForumPosts $forumPosts)
    {
        $this->collForumPostss[]= $forumPosts;
        $forumPosts->setForumTopic($this);
    }

    /**
     * @param  ChildForumPosts $forumPosts The ChildForumPosts object to remove.
     * @return $this|ChildForumTopic The current object (for fluent API support)
     */
    public function removeForumPosts(ChildForumPosts $forumPosts)
    {
        if ($this->getForumPostss()->contains($forumPosts)) {
            $pos = $this->collForumPostss->search($forumPosts);
            $this->collForumPostss->remove($pos);
            if (null === $this->forumPostssScheduledForDeletion) {
                $this->forumPostssScheduledForDeletion = clone $this->collForumPostss;
                $this->forumPostssScheduledForDeletion->clear();
            }
            $this->forumPostssScheduledForDeletion[]= clone $forumPosts;
            $forumPosts->setForumTopic(null);
        }

        return $this;
    }

    /**
     * Clears out the collForumTopicWatcherss collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addForumTopicWatcherss()
     */
    public function clearForumTopicWatcherss()
    {
        $this->collForumTopicWatcherss = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collForumTopicWatcherss collection loaded partially.
     */
    public function resetPartialForumTopicWatcherss($v = true)
    {
        $this->collForumTopicWatcherssPartial = $v;
    }

    /**
     * Initializes the collForumTopicWatcherss collection.
     *
     * By default this just sets the collForumTopicWatcherss collection to an empty array (like clearcollForumTopicWatcherss());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initForumTopicWatcherss($overrideExisting = true)
    {
        if (null !== $this->collForumTopicWatcherss && !$overrideExisting) {
            return;
        }
        $this->collForumTopicWatcherss = new ObjectCollection();
        $this->collForumTopicWatcherss->setModel('\Tekstove\TekstoveBundle\Model\Entity\ForumTopicWatchers');
    }

    /**
     * Gets an array of ChildForumTopicWatchers objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildForumTopic is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildForumTopicWatchers[] List of ChildForumTopicWatchers objects
     * @throws PropelException
     */
    public function getForumTopicWatcherss(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collForumTopicWatcherssPartial && !$this->isNew();
        if (null === $this->collForumTopicWatcherss || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collForumTopicWatcherss) {
                // return empty collection
                $this->initForumTopicWatcherss();
            } else {
                $collForumTopicWatcherss = ChildForumTopicWatchersQuery::create(null, $criteria)
                    ->filterByForumTopic($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collForumTopicWatcherssPartial && count($collForumTopicWatcherss)) {
                        $this->initForumTopicWatcherss(false);

                        foreach ($collForumTopicWatcherss as $obj) {
                            if (false == $this->collForumTopicWatcherss->contains($obj)) {
                                $this->collForumTopicWatcherss->append($obj);
                            }
                        }

                        $this->collForumTopicWatcherssPartial = true;
                    }

                    return $collForumTopicWatcherss;
                }

                if ($partial && $this->collForumTopicWatcherss) {
                    foreach ($this->collForumTopicWatcherss as $obj) {
                        if ($obj->isNew()) {
                            $collForumTopicWatcherss[] = $obj;
                        }
                    }
                }

                $this->collForumTopicWatcherss = $collForumTopicWatcherss;
                $this->collForumTopicWatcherssPartial = false;
            }
        }

        return $this->collForumTopicWatcherss;
    }

    /**
     * Sets a collection of ChildForumTopicWatchers objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $forumTopicWatcherss A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildForumTopic The current object (for fluent API support)
     */
    public function setForumTopicWatcherss(Collection $forumTopicWatcherss, ConnectionInterface $con = null)
    {
        /** @var ChildForumTopicWatchers[] $forumTopicWatcherssToDelete */
        $forumTopicWatcherssToDelete = $this->getForumTopicWatcherss(new Criteria(), $con)->diff($forumTopicWatcherss);


        //since at least one column in the foreign key is at the same time a PK
        //we can not just set a PK to NULL in the lines below. We have to store
        //a backup of all values, so we are able to manipulate these items based on the onDelete value later.
        $this->forumTopicWatcherssScheduledForDeletion = clone $forumTopicWatcherssToDelete;

        foreach ($forumTopicWatcherssToDelete as $forumTopicWatchersRemoved) {
            $forumTopicWatchersRemoved->setForumTopic(null);
        }

        $this->collForumTopicWatcherss = null;
        foreach ($forumTopicWatcherss as $forumTopicWatchers) {
            $this->addForumTopicWatchers($forumTopicWatchers);
        }

        $this->collForumTopicWatcherss = $forumTopicWatcherss;
        $this->collForumTopicWatcherssPartial = false;

        return $this;
    }

    /**
     * Returns the number of related ForumTopicWatchers objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related ForumTopicWatchers objects.
     * @throws PropelException
     */
    public function countForumTopicWatcherss(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collForumTopicWatcherssPartial && !$this->isNew();
        if (null === $this->collForumTopicWatcherss || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collForumTopicWatcherss) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getForumTopicWatcherss());
            }

            $query = ChildForumTopicWatchersQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByForumTopic($this)
                ->count($con);
        }

        return count($this->collForumTopicWatcherss);
    }

    /**
     * Method called to associate a ChildForumTopicWatchers object to this object
     * through the ChildForumTopicWatchers foreign key attribute.
     *
     * @param  ChildForumTopicWatchers $l ChildForumTopicWatchers
     * @return $this|\Tekstove\TekstoveBundle\Model\Entity\ForumTopic The current object (for fluent API support)
     */
    public function addForumTopicWatchers(ChildForumTopicWatchers $l)
    {
        if ($this->collForumTopicWatcherss === null) {
            $this->initForumTopicWatcherss();
            $this->collForumTopicWatcherssPartial = true;
        }

        if (!$this->collForumTopicWatcherss->contains($l)) {
            $this->doAddForumTopicWatchers($l);
        }

        return $this;
    }

    /**
     * @param ChildForumTopicWatchers $forumTopicWatchers The ChildForumTopicWatchers object to add.
     */
    protected function doAddForumTopicWatchers(ChildForumTopicWatchers $forumTopicWatchers)
    {
        $this->collForumTopicWatcherss[]= $forumTopicWatchers;
        $forumTopicWatchers->setForumTopic($this);
    }

    /**
     * @param  ChildForumTopicWatchers $forumTopicWatchers The ChildForumTopicWatchers object to remove.
     * @return $this|ChildForumTopic The current object (for fluent API support)
     */
    public function removeForumTopicWatchers(ChildForumTopicWatchers $forumTopicWatchers)
    {
        if ($this->getForumTopicWatcherss()->contains($forumTopicWatchers)) {
            $pos = $this->collForumTopicWatcherss->search($forumTopicWatchers);
            $this->collForumTopicWatcherss->remove($pos);
            if (null === $this->forumTopicWatcherssScheduledForDeletion) {
                $this->forumTopicWatcherssScheduledForDeletion = clone $this->collForumTopicWatcherss;
                $this->forumTopicWatcherssScheduledForDeletion->clear();
            }
            $this->forumTopicWatcherssScheduledForDeletion[]= clone $forumTopicWatchers;
            $forumTopicWatchers->setForumTopic(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this ForumTopic is new, it will return
     * an empty collection; or if this ForumTopic has previously
     * been saved, it will retrieve related ForumTopicWatcherss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in ForumTopic.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildForumTopicWatchers[] List of ChildForumTopicWatchers objects
     */
    public function getForumTopicWatcherssJoinUsers(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildForumTopicWatchersQuery::create(null, $criteria);
        $query->joinWith('Users', $joinBehavior);

        return $this->getForumTopicWatcherss($query, $con);
    }

    /**
     * Clears the current object, sets all attributes to their default values and removes
     * outgoing references as well as back-references (from other objects to this one. Results probably in a database
     * change of those foreign objects when you call `save` there).
     */
    public function clear()
    {
        if (null !== $this->aForumRazdel) {
            $this->aForumRazdel->removeForumTopic($this);
        }
        $this->topic_razdel = null;
        $this->topic_name = null;
        $this->id = null;
        $this->topic_pin = null;
        $this->topic_starter = null;
        $this->topic_posleden_post = null;
        $this->priority = null;
        $this->alreadyInSave = false;
        $this->clearAllReferences();
        $this->applyDefaultValues();
        $this->resetModified();
        $this->setNew(true);
        $this->setDeleted(false);
    }

    /**
     * Resets all references and back-references to other model objects or collections of model objects.
     *
     * This method is used to reset all php object references (not the actual reference in the database).
     * Necessary for object serialisation.
     *
     * @param      boolean $deep Whether to also clear the references on all referrer objects.
     */
    public function clearAllReferences($deep = false)
    {
        if ($deep) {
            if ($this->singleNovini) {
                $this->singleNovini->clearAllReferences($deep);
            }
            if ($this->collForumPostss) {
                foreach ($this->collForumPostss as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collForumTopicWatcherss) {
                foreach ($this->collForumTopicWatcherss as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->singleNovini = null;
        $this->collForumPostss = null;
        $this->collForumTopicWatcherss = null;
        $this->aForumRazdel = null;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(ForumTopicTableMap::DEFAULT_STRING_FORMAT);
    }

    /**
     * Code to be run before persisting the object
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preSave(ConnectionInterface $con = null)
    {
        return true;
    }

    /**
     * Code to be run after persisting the object
     * @param ConnectionInterface $con
     */
    public function postSave(ConnectionInterface $con = null)
    {

    }

    /**
     * Code to be run before inserting to database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preInsert(ConnectionInterface $con = null)
    {
        return true;
    }

    /**
     * Code to be run after inserting to database
     * @param ConnectionInterface $con
     */
    public function postInsert(ConnectionInterface $con = null)
    {

    }

    /**
     * Code to be run before updating the object in database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preUpdate(ConnectionInterface $con = null)
    {
        return true;
    }

    /**
     * Code to be run after updating the object in database
     * @param ConnectionInterface $con
     */
    public function postUpdate(ConnectionInterface $con = null)
    {

    }

    /**
     * Code to be run before deleting the object in database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preDelete(ConnectionInterface $con = null)
    {
        return true;
    }

    /**
     * Code to be run after deleting the object in database
     * @param ConnectionInterface $con
     */
    public function postDelete(ConnectionInterface $con = null)
    {

    }


    /**
     * Derived method to catches calls to undefined methods.
     *
     * Provides magic import/export method support (fromXML()/toXML(), fromYAML()/toYAML(), etc.).
     * Allows to define default __call() behavior if you overwrite __call()
     *
     * @param string $name
     * @param mixed  $params
     *
     * @return array|string
     */
    public function __call($name, $params)
    {
        if (0 === strpos($name, 'get')) {
            $virtualColumn = substr($name, 3);
            if ($this->hasVirtualColumn($virtualColumn)) {
                return $this->getVirtualColumn($virtualColumn);
            }

            $virtualColumn = lcfirst($virtualColumn);
            if ($this->hasVirtualColumn($virtualColumn)) {
                return $this->getVirtualColumn($virtualColumn);
            }
        }

        if (0 === strpos($name, 'from')) {
            $format = substr($name, 4);

            return $this->importFrom($format, reset($params));
        }

        if (0 === strpos($name, 'to')) {
            $format = substr($name, 2);
            $includeLazyLoadColumns = isset($params[0]) ? $params[0] : true;

            return $this->exportTo($format, $includeLazyLoadColumns);
        }

        throw new BadMethodCallException(sprintf('Call to undefined method: %s.', $name));
    }

}
