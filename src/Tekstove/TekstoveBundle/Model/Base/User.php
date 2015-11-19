<?php

namespace Tekstove\TekstoveBundle\Model\Base;

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
use Tekstove\TekstoveBundle\Model\Lyric as ChildLyric;
use Tekstove\TekstoveBundle\Model\LyricQuery as ChildLyricQuery;
use Tekstove\TekstoveBundle\Model\LyricTranslation as ChildLyricTranslation;
use Tekstove\TekstoveBundle\Model\LyricTranslationQuery as ChildLyricTranslationQuery;
use Tekstove\TekstoveBundle\Model\LyricVote as ChildLyricVote;
use Tekstove\TekstoveBundle\Model\LyricVoteQuery as ChildLyricVoteQuery;
use Tekstove\TekstoveBundle\Model\User as ChildUser;
use Tekstove\TekstoveBundle\Model\UserQuery as ChildUserQuery;
use Tekstove\TekstoveBundle\Model\Map\UserTableMap;

/**
 * Base class that represents a row from the 'user' table.
 *
 *
 *
* @package    propel.generator.src.Tekstove.TekstoveBundle.Model.Base
*/
abstract class User implements ActiveRecordInterface
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\Tekstove\\TekstoveBundle\\Model\\Map\\UserTableMap';


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
     * The value for the id field.
     *
     * @var        int
     */
    protected $id;

    /**
     * The value for the username field.
     *
     * @var        string
     */
    protected $username;

    /**
     * The value for the password field.
     *
     * @var        string
     */
    protected $password;

    /**
     * The value for the mail field.
     *
     * @var        string
     */
    protected $mail;

    /**
     * The value for the avatar field.
     *
     * @var        string
     */
    protected $avatar;

    /**
     * The value for the about field.
     *
     * @var        string
     */
    protected $about;

    /**
     * The value for the autoplay field.
     *
     * @var        int
     */
    protected $autoplay;

    /**
     * @var        ObjectCollection|ChildLyric[] Collection to store aggregation of ChildLyric objects.
     */
    protected $collLyrics;
    protected $collLyricsPartial;

    /**
     * @var        ObjectCollection|ChildLyricTranslation[] Collection to store aggregation of ChildLyricTranslation objects.
     */
    protected $collLyricTranslations;
    protected $collLyricTranslationsPartial;

    /**
     * @var        ObjectCollection|ChildLyricVote[] Collection to store aggregation of ChildLyricVote objects.
     */
    protected $collLyricVotes;
    protected $collLyricVotesPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var boolean
     */
    protected $alreadyInSave = false;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildLyric[]
     */
    protected $lyricsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildLyricTranslation[]
     */
    protected $lyricTranslationsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildLyricVote[]
     */
    protected $lyricVotesScheduledForDeletion = null;

    /**
     * Initializes internal state of Tekstove\TekstoveBundle\Model\Base\User object.
     */
    public function __construct()
    {
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
     * Compares this with another <code>User</code> instance.  If
     * <code>obj</code> is an instance of <code>User</code>, delegates to
     * <code>equals(User)</code>.  Otherwise, returns <code>false</code>.
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
     * @return $this|User The current object, for fluid interface
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

        $cls = new \ReflectionClass($this);
        $propertyNames = [];
        foreach($cls->getProperties() as $property) {
            $propertyNames[] = $property->getName();
        }
        return $propertyNames;
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
     * Get the [username] column value.
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Get the [password] column value.
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Get the [mail] column value.
     *
     * @return string
     */
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * Get the [avatar] column value.
     *
     * @return string
     */
    public function getAvatar()
    {
        return $this->avatar;
    }

    /**
     * Get the [about] column value.
     *
     * @return string
     */
    public function getAbout()
    {
        return $this->about;
    }

    /**
     * Get the [autoplay] column value.
     *
     * @return int
     */
    public function getAutoplay()
    {
        return $this->autoplay;
    }

    /**
     * Set the value of [id] column.
     *
     * @param int $v new value
     * @return $this|\Tekstove\TekstoveBundle\Model\User The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[UserTableMap::COL_ID] = true;
        }

        return $this;
    } // setId()

    /**
     * Set the value of [username] column.
     *
     * @param string $v new value
     * @return $this|\Tekstove\TekstoveBundle\Model\User The current object (for fluent API support)
     */
    public function setUsername($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->username !== $v) {
            $this->username = $v;
            $this->modifiedColumns[UserTableMap::COL_USERNAME] = true;
        }

        return $this;
    } // setUsername()

    /**
     * Set the value of [password] column.
     *
     * @param string $v new value
     * @return $this|\Tekstove\TekstoveBundle\Model\User The current object (for fluent API support)
     */
    public function setPassword($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->password !== $v) {
            $this->password = $v;
            $this->modifiedColumns[UserTableMap::COL_PASSWORD] = true;
        }

        return $this;
    } // setPassword()

    /**
     * Set the value of [mail] column.
     *
     * @param string $v new value
     * @return $this|\Tekstove\TekstoveBundle\Model\User The current object (for fluent API support)
     */
    public function setMail($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->mail !== $v) {
            $this->mail = $v;
            $this->modifiedColumns[UserTableMap::COL_MAIL] = true;
        }

        return $this;
    } // setMail()

    /**
     * Set the value of [avatar] column.
     *
     * @param string $v new value
     * @return $this|\Tekstove\TekstoveBundle\Model\User The current object (for fluent API support)
     */
    public function setAvatar($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->avatar !== $v) {
            $this->avatar = $v;
            $this->modifiedColumns[UserTableMap::COL_AVATAR] = true;
        }

        return $this;
    } // setAvatar()

    /**
     * Set the value of [about] column.
     *
     * @param string $v new value
     * @return $this|\Tekstove\TekstoveBundle\Model\User The current object (for fluent API support)
     */
    public function setAbout($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->about !== $v) {
            $this->about = $v;
            $this->modifiedColumns[UserTableMap::COL_ABOUT] = true;
        }

        return $this;
    } // setAbout()

    /**
     * Set the value of [autoplay] column.
     *
     * @param int $v new value
     * @return $this|\Tekstove\TekstoveBundle\Model\User The current object (for fluent API support)
     */
    public function setAutoplay($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->autoplay !== $v) {
            $this->autoplay = $v;
            $this->modifiedColumns[UserTableMap::COL_AUTOPLAY] = true;
        }

        return $this;
    } // setAutoplay()

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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : UserTableMap::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : UserTableMap::translateFieldName('Username', TableMap::TYPE_PHPNAME, $indexType)];
            $this->username = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : UserTableMap::translateFieldName('Password', TableMap::TYPE_PHPNAME, $indexType)];
            $this->password = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : UserTableMap::translateFieldName('Mail', TableMap::TYPE_PHPNAME, $indexType)];
            $this->mail = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : UserTableMap::translateFieldName('Avatar', TableMap::TYPE_PHPNAME, $indexType)];
            $this->avatar = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : UserTableMap::translateFieldName('About', TableMap::TYPE_PHPNAME, $indexType)];
            $this->about = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : UserTableMap::translateFieldName('Autoplay', TableMap::TYPE_PHPNAME, $indexType)];
            $this->autoplay = (null !== $col) ? (int) $col : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 7; // 7 = UserTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\Tekstove\\TekstoveBundle\\Model\\User'), 0, $e);
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
            $con = Propel::getServiceContainer()->getReadConnection(UserTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildUserQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->collLyrics = null;

            $this->collLyricTranslations = null;

            $this->collLyricVotes = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see User::setDeleted()
     * @see User::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(UserTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildUserQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(UserTableMap::DATABASE_NAME);
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
                UserTableMap::addInstanceToPool($this);
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

            if ($this->lyricsScheduledForDeletion !== null) {
                if (!$this->lyricsScheduledForDeletion->isEmpty()) {
                    foreach ($this->lyricsScheduledForDeletion as $lyric) {
                        // need to save related object because we set the relation to null
                        $lyric->save($con);
                    }
                    $this->lyricsScheduledForDeletion = null;
                }
            }

            if ($this->collLyrics !== null) {
                foreach ($this->collLyrics as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->lyricTranslationsScheduledForDeletion !== null) {
                if (!$this->lyricTranslationsScheduledForDeletion->isEmpty()) {
                    foreach ($this->lyricTranslationsScheduledForDeletion as $lyricTranslation) {
                        // need to save related object because we set the relation to null
                        $lyricTranslation->save($con);
                    }
                    $this->lyricTranslationsScheduledForDeletion = null;
                }
            }

            if ($this->collLyricTranslations !== null) {
                foreach ($this->collLyricTranslations as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->lyricVotesScheduledForDeletion !== null) {
                if (!$this->lyricVotesScheduledForDeletion->isEmpty()) {
                    foreach ($this->lyricVotesScheduledForDeletion as $lyricVote) {
                        // need to save related object because we set the relation to null
                        $lyricVote->save($con);
                    }
                    $this->lyricVotesScheduledForDeletion = null;
                }
            }

            if ($this->collLyricVotes !== null) {
                foreach ($this->collLyricVotes as $referrerFK) {
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

        $this->modifiedColumns[UserTableMap::COL_ID] = true;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . UserTableMap::COL_ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(UserTableMap::COL_ID)) {
            $modifiedColumns[':p' . $index++]  = 'id';
        }
        if ($this->isColumnModified(UserTableMap::COL_USERNAME)) {
            $modifiedColumns[':p' . $index++]  = 'username';
        }
        if ($this->isColumnModified(UserTableMap::COL_PASSWORD)) {
            $modifiedColumns[':p' . $index++]  = 'password';
        }
        if ($this->isColumnModified(UserTableMap::COL_MAIL)) {
            $modifiedColumns[':p' . $index++]  = 'mail';
        }
        if ($this->isColumnModified(UserTableMap::COL_AVATAR)) {
            $modifiedColumns[':p' . $index++]  = 'avatar';
        }
        if ($this->isColumnModified(UserTableMap::COL_ABOUT)) {
            $modifiedColumns[':p' . $index++]  = 'about';
        }
        if ($this->isColumnModified(UserTableMap::COL_AUTOPLAY)) {
            $modifiedColumns[':p' . $index++]  = 'autoplay';
        }

        $sql = sprintf(
            'INSERT INTO user (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'id':
                        $stmt->bindValue($identifier, $this->id, PDO::PARAM_INT);
                        break;
                    case 'username':
                        $stmt->bindValue($identifier, $this->username, PDO::PARAM_STR);
                        break;
                    case 'password':
                        $stmt->bindValue($identifier, $this->password, PDO::PARAM_STR);
                        break;
                    case 'mail':
                        $stmt->bindValue($identifier, $this->mail, PDO::PARAM_STR);
                        break;
                    case 'avatar':
                        $stmt->bindValue($identifier, $this->avatar, PDO::PARAM_STR);
                        break;
                    case 'about':
                        $stmt->bindValue($identifier, $this->about, PDO::PARAM_STR);
                        break;
                    case 'autoplay':
                        $stmt->bindValue($identifier, $this->autoplay, PDO::PARAM_INT);
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
        $this->setId($pk);

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
        $pos = UserTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getId();
                break;
            case 1:
                return $this->getUsername();
                break;
            case 2:
                return $this->getPassword();
                break;
            case 3:
                return $this->getMail();
                break;
            case 4:
                return $this->getAvatar();
                break;
            case 5:
                return $this->getAbout();
                break;
            case 6:
                return $this->getAutoplay();
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

        if (isset($alreadyDumpedObjects['User'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['User'][$this->hashCode()] = true;
        $keys = UserTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getUsername(),
            $keys[2] => $this->getPassword(),
            $keys[3] => $this->getMail(),
            $keys[4] => $this->getAvatar(),
            $keys[5] => $this->getAbout(),
            $keys[6] => $this->getAutoplay(),
        );
        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->collLyrics) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'lyrics';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'lyrics';
                        break;
                    default:
                        $key = 'Lyrics';
                }

                $result[$key] = $this->collLyrics->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collLyricTranslations) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'lyricTranslations';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'lyric_translations';
                        break;
                    default:
                        $key = 'LyricTranslations';
                }

                $result[$key] = $this->collLyricTranslations->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collLyricVotes) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'lyricVotes';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'lyric_votes';
                        break;
                    default:
                        $key = 'LyricVotes';
                }

                $result[$key] = $this->collLyricVotes->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
     * @return $this|\Tekstove\TekstoveBundle\Model\User
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = UserTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\Tekstove\TekstoveBundle\Model\User
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setId($value);
                break;
            case 1:
                $this->setUsername($value);
                break;
            case 2:
                $this->setPassword($value);
                break;
            case 3:
                $this->setMail($value);
                break;
            case 4:
                $this->setAvatar($value);
                break;
            case 5:
                $this->setAbout($value);
                break;
            case 6:
                $this->setAutoplay($value);
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
        $keys = UserTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setId($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setUsername($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setPassword($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setMail($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setAvatar($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setAbout($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setAutoplay($arr[$keys[6]]);
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
     * @return $this|\Tekstove\TekstoveBundle\Model\User The current object, for fluid interface
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
        $criteria = new Criteria(UserTableMap::DATABASE_NAME);

        if ($this->isColumnModified(UserTableMap::COL_ID)) {
            $criteria->add(UserTableMap::COL_ID, $this->id);
        }
        if ($this->isColumnModified(UserTableMap::COL_USERNAME)) {
            $criteria->add(UserTableMap::COL_USERNAME, $this->username);
        }
        if ($this->isColumnModified(UserTableMap::COL_PASSWORD)) {
            $criteria->add(UserTableMap::COL_PASSWORD, $this->password);
        }
        if ($this->isColumnModified(UserTableMap::COL_MAIL)) {
            $criteria->add(UserTableMap::COL_MAIL, $this->mail);
        }
        if ($this->isColumnModified(UserTableMap::COL_AVATAR)) {
            $criteria->add(UserTableMap::COL_AVATAR, $this->avatar);
        }
        if ($this->isColumnModified(UserTableMap::COL_ABOUT)) {
            $criteria->add(UserTableMap::COL_ABOUT, $this->about);
        }
        if ($this->isColumnModified(UserTableMap::COL_AUTOPLAY)) {
            $criteria->add(UserTableMap::COL_AUTOPLAY, $this->autoplay);
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
        $criteria = ChildUserQuery::create();
        $criteria->add(UserTableMap::COL_ID, $this->id);

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
        $validPk = null !== $this->getId();

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
     * Returns the primary key for this object (row).
     * @return int
     */
    public function getPrimaryKey()
    {
        return $this->getId();
    }

    /**
     * Generic method to set the primary key (id column).
     *
     * @param       int $key Primary key.
     * @return void
     */
    public function setPrimaryKey($key)
    {
        $this->setId($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     * @return boolean
     */
    public function isPrimaryKeyNull()
    {
        return null === $this->getId();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param      object $copyObj An object of \Tekstove\TekstoveBundle\Model\User (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setUsername($this->getUsername());
        $copyObj->setPassword($this->getPassword());
        $copyObj->setMail($this->getMail());
        $copyObj->setAvatar($this->getAvatar());
        $copyObj->setAbout($this->getAbout());
        $copyObj->setAutoplay($this->getAutoplay());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getLyrics() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addLyric($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getLyricTranslations() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addLyricTranslation($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getLyricVotes() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addLyricVote($relObj->copy($deepCopy));
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
     * @return \Tekstove\TekstoveBundle\Model\User Clone of current object.
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
     * Initializes a collection based on the name of a relation.
     * Avoids crafting an 'init[$relationName]s' method name
     * that wouldn't work when StandardEnglishPluralizer is used.
     *
     * @param      string $relationName The name of the relation to initialize
     * @return void
     */
    public function initRelation($relationName)
    {
        if ('Lyric' == $relationName) {
            return $this->initLyrics();
        }
        if ('LyricTranslation' == $relationName) {
            return $this->initLyricTranslations();
        }
        if ('LyricVote' == $relationName) {
            return $this->initLyricVotes();
        }
    }

    /**
     * Clears out the collLyrics collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addLyrics()
     */
    public function clearLyrics()
    {
        $this->collLyrics = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collLyrics collection loaded partially.
     */
    public function resetPartialLyrics($v = true)
    {
        $this->collLyricsPartial = $v;
    }

    /**
     * Initializes the collLyrics collection.
     *
     * By default this just sets the collLyrics collection to an empty array (like clearcollLyrics());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initLyrics($overrideExisting = true)
    {
        if (null !== $this->collLyrics && !$overrideExisting) {
            return;
        }
        $this->collLyrics = new ObjectCollection();
        $this->collLyrics->setModel('\Tekstove\TekstoveBundle\Model\Lyric');
    }

    /**
     * Gets an array of ChildLyric objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildUser is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildLyric[] List of ChildLyric objects
     * @throws PropelException
     */
    public function getLyrics(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collLyricsPartial && !$this->isNew();
        if (null === $this->collLyrics || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collLyrics) {
                // return empty collection
                $this->initLyrics();
            } else {
                $collLyrics = ChildLyricQuery::create(null, $criteria)
                    ->filterByUser($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collLyricsPartial && count($collLyrics)) {
                        $this->initLyrics(false);

                        foreach ($collLyrics as $obj) {
                            if (false == $this->collLyrics->contains($obj)) {
                                $this->collLyrics->append($obj);
                            }
                        }

                        $this->collLyricsPartial = true;
                    }

                    return $collLyrics;
                }

                if ($partial && $this->collLyrics) {
                    foreach ($this->collLyrics as $obj) {
                        if ($obj->isNew()) {
                            $collLyrics[] = $obj;
                        }
                    }
                }

                $this->collLyrics = $collLyrics;
                $this->collLyricsPartial = false;
            }
        }

        return $this->collLyrics;
    }

    /**
     * Sets a collection of ChildLyric objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $lyrics A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildUser The current object (for fluent API support)
     */
    public function setLyrics(Collection $lyrics, ConnectionInterface $con = null)
    {
        /** @var ChildLyric[] $lyricsToDelete */
        $lyricsToDelete = $this->getLyrics(new Criteria(), $con)->diff($lyrics);


        $this->lyricsScheduledForDeletion = $lyricsToDelete;

        foreach ($lyricsToDelete as $lyricRemoved) {
            $lyricRemoved->setUser(null);
        }

        $this->collLyrics = null;
        foreach ($lyrics as $lyric) {
            $this->addLyric($lyric);
        }

        $this->collLyrics = $lyrics;
        $this->collLyricsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Lyric objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related Lyric objects.
     * @throws PropelException
     */
    public function countLyrics(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collLyricsPartial && !$this->isNew();
        if (null === $this->collLyrics || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collLyrics) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getLyrics());
            }

            $query = ChildLyricQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByUser($this)
                ->count($con);
        }

        return count($this->collLyrics);
    }

    /**
     * Method called to associate a ChildLyric object to this object
     * through the ChildLyric foreign key attribute.
     *
     * @param  ChildLyric $l ChildLyric
     * @return $this|\Tekstove\TekstoveBundle\Model\User The current object (for fluent API support)
     */
    public function addLyric(ChildLyric $l)
    {
        if ($this->collLyrics === null) {
            $this->initLyrics();
            $this->collLyricsPartial = true;
        }

        if (!$this->collLyrics->contains($l)) {
            $this->doAddLyric($l);
        }

        return $this;
    }

    /**
     * @param ChildLyric $lyric The ChildLyric object to add.
     */
    protected function doAddLyric(ChildLyric $lyric)
    {
        $this->collLyrics[]= $lyric;
        $lyric->setUser($this);
    }

    /**
     * @param  ChildLyric $lyric The ChildLyric object to remove.
     * @return $this|ChildUser The current object (for fluent API support)
     */
    public function removeLyric(ChildLyric $lyric)
    {
        if ($this->getLyrics()->contains($lyric)) {
            $pos = $this->collLyrics->search($lyric);
            $this->collLyrics->remove($pos);
            if (null === $this->lyricsScheduledForDeletion) {
                $this->lyricsScheduledForDeletion = clone $this->collLyrics;
                $this->lyricsScheduledForDeletion->clear();
            }
            $this->lyricsScheduledForDeletion[]= $lyric;
            $lyric->setUser(null);
        }

        return $this;
    }

    /**
     * Clears out the collLyricTranslations collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addLyricTranslations()
     */
    public function clearLyricTranslations()
    {
        $this->collLyricTranslations = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collLyricTranslations collection loaded partially.
     */
    public function resetPartialLyricTranslations($v = true)
    {
        $this->collLyricTranslationsPartial = $v;
    }

    /**
     * Initializes the collLyricTranslations collection.
     *
     * By default this just sets the collLyricTranslations collection to an empty array (like clearcollLyricTranslations());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initLyricTranslations($overrideExisting = true)
    {
        if (null !== $this->collLyricTranslations && !$overrideExisting) {
            return;
        }
        $this->collLyricTranslations = new ObjectCollection();
        $this->collLyricTranslations->setModel('\Tekstove\TekstoveBundle\Model\LyricTranslation');
    }

    /**
     * Gets an array of ChildLyricTranslation objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildUser is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildLyricTranslation[] List of ChildLyricTranslation objects
     * @throws PropelException
     */
    public function getLyricTranslations(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collLyricTranslationsPartial && !$this->isNew();
        if (null === $this->collLyricTranslations || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collLyricTranslations) {
                // return empty collection
                $this->initLyricTranslations();
            } else {
                $collLyricTranslations = ChildLyricTranslationQuery::create(null, $criteria)
                    ->filterByUser($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collLyricTranslationsPartial && count($collLyricTranslations)) {
                        $this->initLyricTranslations(false);

                        foreach ($collLyricTranslations as $obj) {
                            if (false == $this->collLyricTranslations->contains($obj)) {
                                $this->collLyricTranslations->append($obj);
                            }
                        }

                        $this->collLyricTranslationsPartial = true;
                    }

                    return $collLyricTranslations;
                }

                if ($partial && $this->collLyricTranslations) {
                    foreach ($this->collLyricTranslations as $obj) {
                        if ($obj->isNew()) {
                            $collLyricTranslations[] = $obj;
                        }
                    }
                }

                $this->collLyricTranslations = $collLyricTranslations;
                $this->collLyricTranslationsPartial = false;
            }
        }

        return $this->collLyricTranslations;
    }

    /**
     * Sets a collection of ChildLyricTranslation objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $lyricTranslations A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildUser The current object (for fluent API support)
     */
    public function setLyricTranslations(Collection $lyricTranslations, ConnectionInterface $con = null)
    {
        /** @var ChildLyricTranslation[] $lyricTranslationsToDelete */
        $lyricTranslationsToDelete = $this->getLyricTranslations(new Criteria(), $con)->diff($lyricTranslations);


        $this->lyricTranslationsScheduledForDeletion = $lyricTranslationsToDelete;

        foreach ($lyricTranslationsToDelete as $lyricTranslationRemoved) {
            $lyricTranslationRemoved->setUser(null);
        }

        $this->collLyricTranslations = null;
        foreach ($lyricTranslations as $lyricTranslation) {
            $this->addLyricTranslation($lyricTranslation);
        }

        $this->collLyricTranslations = $lyricTranslations;
        $this->collLyricTranslationsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related LyricTranslation objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related LyricTranslation objects.
     * @throws PropelException
     */
    public function countLyricTranslations(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collLyricTranslationsPartial && !$this->isNew();
        if (null === $this->collLyricTranslations || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collLyricTranslations) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getLyricTranslations());
            }

            $query = ChildLyricTranslationQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByUser($this)
                ->count($con);
        }

        return count($this->collLyricTranslations);
    }

    /**
     * Method called to associate a ChildLyricTranslation object to this object
     * through the ChildLyricTranslation foreign key attribute.
     *
     * @param  ChildLyricTranslation $l ChildLyricTranslation
     * @return $this|\Tekstove\TekstoveBundle\Model\User The current object (for fluent API support)
     */
    public function addLyricTranslation(ChildLyricTranslation $l)
    {
        if ($this->collLyricTranslations === null) {
            $this->initLyricTranslations();
            $this->collLyricTranslationsPartial = true;
        }

        if (!$this->collLyricTranslations->contains($l)) {
            $this->doAddLyricTranslation($l);
        }

        return $this;
    }

    /**
     * @param ChildLyricTranslation $lyricTranslation The ChildLyricTranslation object to add.
     */
    protected function doAddLyricTranslation(ChildLyricTranslation $lyricTranslation)
    {
        $this->collLyricTranslations[]= $lyricTranslation;
        $lyricTranslation->setUser($this);
    }

    /**
     * @param  ChildLyricTranslation $lyricTranslation The ChildLyricTranslation object to remove.
     * @return $this|ChildUser The current object (for fluent API support)
     */
    public function removeLyricTranslation(ChildLyricTranslation $lyricTranslation)
    {
        if ($this->getLyricTranslations()->contains($lyricTranslation)) {
            $pos = $this->collLyricTranslations->search($lyricTranslation);
            $this->collLyricTranslations->remove($pos);
            if (null === $this->lyricTranslationsScheduledForDeletion) {
                $this->lyricTranslationsScheduledForDeletion = clone $this->collLyricTranslations;
                $this->lyricTranslationsScheduledForDeletion->clear();
            }
            $this->lyricTranslationsScheduledForDeletion[]= $lyricTranslation;
            $lyricTranslation->setUser(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this User is new, it will return
     * an empty collection; or if this User has previously
     * been saved, it will retrieve related LyricTranslations from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in User.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildLyricTranslation[] List of ChildLyricTranslation objects
     */
    public function getLyricTranslationsJoinLyric(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildLyricTranslationQuery::create(null, $criteria);
        $query->joinWith('Lyric', $joinBehavior);

        return $this->getLyricTranslations($query, $con);
    }

    /**
     * Clears out the collLyricVotes collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addLyricVotes()
     */
    public function clearLyricVotes()
    {
        $this->collLyricVotes = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collLyricVotes collection loaded partially.
     */
    public function resetPartialLyricVotes($v = true)
    {
        $this->collLyricVotesPartial = $v;
    }

    /**
     * Initializes the collLyricVotes collection.
     *
     * By default this just sets the collLyricVotes collection to an empty array (like clearcollLyricVotes());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initLyricVotes($overrideExisting = true)
    {
        if (null !== $this->collLyricVotes && !$overrideExisting) {
            return;
        }
        $this->collLyricVotes = new ObjectCollection();
        $this->collLyricVotes->setModel('\Tekstove\TekstoveBundle\Model\LyricVote');
    }

    /**
     * Gets an array of ChildLyricVote objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildUser is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildLyricVote[] List of ChildLyricVote objects
     * @throws PropelException
     */
    public function getLyricVotes(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collLyricVotesPartial && !$this->isNew();
        if (null === $this->collLyricVotes || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collLyricVotes) {
                // return empty collection
                $this->initLyricVotes();
            } else {
                $collLyricVotes = ChildLyricVoteQuery::create(null, $criteria)
                    ->filterByUser($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collLyricVotesPartial && count($collLyricVotes)) {
                        $this->initLyricVotes(false);

                        foreach ($collLyricVotes as $obj) {
                            if (false == $this->collLyricVotes->contains($obj)) {
                                $this->collLyricVotes->append($obj);
                            }
                        }

                        $this->collLyricVotesPartial = true;
                    }

                    return $collLyricVotes;
                }

                if ($partial && $this->collLyricVotes) {
                    foreach ($this->collLyricVotes as $obj) {
                        if ($obj->isNew()) {
                            $collLyricVotes[] = $obj;
                        }
                    }
                }

                $this->collLyricVotes = $collLyricVotes;
                $this->collLyricVotesPartial = false;
            }
        }

        return $this->collLyricVotes;
    }

    /**
     * Sets a collection of ChildLyricVote objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $lyricVotes A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildUser The current object (for fluent API support)
     */
    public function setLyricVotes(Collection $lyricVotes, ConnectionInterface $con = null)
    {
        /** @var ChildLyricVote[] $lyricVotesToDelete */
        $lyricVotesToDelete = $this->getLyricVotes(new Criteria(), $con)->diff($lyricVotes);


        $this->lyricVotesScheduledForDeletion = $lyricVotesToDelete;

        foreach ($lyricVotesToDelete as $lyricVoteRemoved) {
            $lyricVoteRemoved->setUser(null);
        }

        $this->collLyricVotes = null;
        foreach ($lyricVotes as $lyricVote) {
            $this->addLyricVote($lyricVote);
        }

        $this->collLyricVotes = $lyricVotes;
        $this->collLyricVotesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related LyricVote objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related LyricVote objects.
     * @throws PropelException
     */
    public function countLyricVotes(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collLyricVotesPartial && !$this->isNew();
        if (null === $this->collLyricVotes || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collLyricVotes) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getLyricVotes());
            }

            $query = ChildLyricVoteQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByUser($this)
                ->count($con);
        }

        return count($this->collLyricVotes);
    }

    /**
     * Method called to associate a ChildLyricVote object to this object
     * through the ChildLyricVote foreign key attribute.
     *
     * @param  ChildLyricVote $l ChildLyricVote
     * @return $this|\Tekstove\TekstoveBundle\Model\User The current object (for fluent API support)
     */
    public function addLyricVote(ChildLyricVote $l)
    {
        if ($this->collLyricVotes === null) {
            $this->initLyricVotes();
            $this->collLyricVotesPartial = true;
        }

        if (!$this->collLyricVotes->contains($l)) {
            $this->doAddLyricVote($l);
        }

        return $this;
    }

    /**
     * @param ChildLyricVote $lyricVote The ChildLyricVote object to add.
     */
    protected function doAddLyricVote(ChildLyricVote $lyricVote)
    {
        $this->collLyricVotes[]= $lyricVote;
        $lyricVote->setUser($this);
    }

    /**
     * @param  ChildLyricVote $lyricVote The ChildLyricVote object to remove.
     * @return $this|ChildUser The current object (for fluent API support)
     */
    public function removeLyricVote(ChildLyricVote $lyricVote)
    {
        if ($this->getLyricVotes()->contains($lyricVote)) {
            $pos = $this->collLyricVotes->search($lyricVote);
            $this->collLyricVotes->remove($pos);
            if (null === $this->lyricVotesScheduledForDeletion) {
                $this->lyricVotesScheduledForDeletion = clone $this->collLyricVotes;
                $this->lyricVotesScheduledForDeletion->clear();
            }
            $this->lyricVotesScheduledForDeletion[]= $lyricVote;
            $lyricVote->setUser(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this User is new, it will return
     * an empty collection; or if this User has previously
     * been saved, it will retrieve related LyricVotes from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in User.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildLyricVote[] List of ChildLyricVote objects
     */
    public function getLyricVotesJoinLyric(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildLyricVoteQuery::create(null, $criteria);
        $query->joinWith('Lyric', $joinBehavior);

        return $this->getLyricVotes($query, $con);
    }

    /**
     * Clears the current object, sets all attributes to their default values and removes
     * outgoing references as well as back-references (from other objects to this one. Results probably in a database
     * change of those foreign objects when you call `save` there).
     */
    public function clear()
    {
        $this->id = null;
        $this->username = null;
        $this->password = null;
        $this->mail = null;
        $this->avatar = null;
        $this->about = null;
        $this->autoplay = null;
        $this->alreadyInSave = false;
        $this->clearAllReferences();
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
            if ($this->collLyrics) {
                foreach ($this->collLyrics as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collLyricTranslations) {
                foreach ($this->collLyricTranslations as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collLyricVotes) {
                foreach ($this->collLyricVotes as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collLyrics = null;
        $this->collLyricTranslations = null;
        $this->collLyricVotes = null;
    }

    /**
     * Return the string representation of this object
     *
     * @return string The value of the 'username' column
     */
    public function __toString()
    {
        return (string) $this->getUsername();
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
