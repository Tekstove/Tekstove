<?php

namespace Tekstove\TekstoveBundle\Model\Entity\Base;

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
use Tekstove\TekstoveBundle\Model\Entity\Artist as ChildArtist;
use Tekstove\TekstoveBundle\Model\Entity\ArtistQuery as ChildArtistQuery;
use Tekstove\TekstoveBundle\Model\Entity\Lyric as ChildLyric;
use Tekstove\TekstoveBundle\Model\Entity\LyricQuery as ChildLyricQuery;
use Tekstove\TekstoveBundle\Model\Entity\Today as ChildToday;
use Tekstove\TekstoveBundle\Model\Entity\TodayQuery as ChildTodayQuery;
use Tekstove\TekstoveBundle\Model\Entity\Map\ArtistTableMap;

/**
 * Base class that represents a row from the 'artists' table.
 *
 *
 *
* @package    propel.generator.Tekstove.TekstoveBundle.Model.Entity.Base
*/
abstract class Artist implements ActiveRecordInterface
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\Tekstove\\TekstoveBundle\\Model\\Entity\\Map\\ArtistTableMap';


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
     * The value for the name field.
     * @var        string
     */
    protected $name;

    /**
     * The value for the name_alternatives field.
     * @var        string
     */
    protected $name_alternatives;

    /**
     * The value for the addedby field.
     * @var        int
     */
    protected $addedby;

    /**
     * The value for the id field.
     * @var        int
     */
    protected $id;

    /**
     * The value for the redirect_to_artist_id field.
     * @var        int
     */
    protected $redirect_to_artist_id;

    /**
     * The value for the forbidden field.
     * Note: this column has a database default value of: false
     * @var        boolean
     */
    protected $forbidden;

    /**
     * @var        ObjectCollection|ChildToday[] Collection to store aggregation of ChildToday objects.
     */
    protected $collTodays;
    protected $collTodaysPartial;

    /**
     * @var        ObjectCollection|ChildLyric[] Collection to store aggregation of ChildLyric objects.
     */
    protected $collLyricsRelatedByArtist1;
    protected $collLyricsRelatedByArtist1Partial;

    /**
     * @var        ObjectCollection|ChildLyric[] Collection to store aggregation of ChildLyric objects.
     */
    protected $collLyricsRelatedByArtist2;
    protected $collLyricsRelatedByArtist2Partial;

    /**
     * @var        ObjectCollection|ChildLyric[] Collection to store aggregation of ChildLyric objects.
     */
    protected $collLyricsRelatedByArtist3;
    protected $collLyricsRelatedByArtist3Partial;

    /**
     * @var        ObjectCollection|ChildLyric[] Collection to store aggregation of ChildLyric objects.
     */
    protected $collLyricsRelatedByArtist4;
    protected $collLyricsRelatedByArtist4Partial;

    /**
     * @var        ObjectCollection|ChildLyric[] Collection to store aggregation of ChildLyric objects.
     */
    protected $collLyricsRelatedByArtist5;
    protected $collLyricsRelatedByArtist5Partial;

    /**
     * @var        ObjectCollection|ChildLyric[] Collection to store aggregation of ChildLyric objects.
     */
    protected $collLyricsRelatedByArtist6;
    protected $collLyricsRelatedByArtist6Partial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var boolean
     */
    protected $alreadyInSave = false;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildToday[]
     */
    protected $todaysScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildLyric[]
     */
    protected $lyricsRelatedByArtist1ScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildLyric[]
     */
    protected $lyricsRelatedByArtist2ScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildLyric[]
     */
    protected $lyricsRelatedByArtist3ScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildLyric[]
     */
    protected $lyricsRelatedByArtist4ScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildLyric[]
     */
    protected $lyricsRelatedByArtist5ScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildLyric[]
     */
    protected $lyricsRelatedByArtist6ScheduledForDeletion = null;

    /**
     * Applies default values to this object.
     * This method should be called from the object's constructor (or
     * equivalent initialization method).
     * @see __construct()
     */
    public function applyDefaultValues()
    {
        $this->forbidden = false;
    }

    /**
     * Initializes internal state of Tekstove\TekstoveBundle\Model\Entity\Base\Artist object.
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
     * Compares this with another <code>Artist</code> instance.  If
     * <code>obj</code> is an instance of <code>Artist</code>, delegates to
     * <code>equals(Artist)</code>.  Otherwise, returns <code>false</code>.
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
     * @return $this|Artist The current object, for fluid interface
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
     * Get the [name] column value.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Get the [name_alternatives] column value.
     *
     * @return string
     */
    public function getNameAlternatives()
    {
        return $this->name_alternatives;
    }

    /**
     * Get the [addedby] column value.
     *
     * @return int
     */
    public function getAddedby()
    {
        return $this->addedby;
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
     * Get the [redirect_to_artist_id] column value.
     *
     * @return int
     */
    public function getRedirectToArtistId()
    {
        return $this->redirect_to_artist_id;
    }

    /**
     * Get the [forbidden] column value.
     *
     * @return boolean
     */
    public function getForbidden()
    {
        return $this->forbidden;
    }

    /**
     * Get the [forbidden] column value.
     *
     * @return boolean
     */
    public function isForbidden()
    {
        return $this->getForbidden();
    }

    /**
     * Set the value of [name] column.
     *
     * @param string $v new value
     * @return $this|\Tekstove\TekstoveBundle\Model\Entity\Artist The current object (for fluent API support)
     */
    public function setName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->name !== $v) {
            $this->name = $v;
            $this->modifiedColumns[ArtistTableMap::COL_NAME] = true;
        }

        return $this;
    } // setName()

    /**
     * Set the value of [name_alternatives] column.
     *
     * @param string $v new value
     * @return $this|\Tekstove\TekstoveBundle\Model\Entity\Artist The current object (for fluent API support)
     */
    public function setNameAlternatives($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->name_alternatives !== $v) {
            $this->name_alternatives = $v;
            $this->modifiedColumns[ArtistTableMap::COL_NAME_ALTERNATIVES] = true;
        }

        return $this;
    } // setNameAlternatives()

    /**
     * Set the value of [addedby] column.
     *
     * @param int $v new value
     * @return $this|\Tekstove\TekstoveBundle\Model\Entity\Artist The current object (for fluent API support)
     */
    public function setAddedby($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->addedby !== $v) {
            $this->addedby = $v;
            $this->modifiedColumns[ArtistTableMap::COL_ADDEDBY] = true;
        }

        return $this;
    } // setAddedby()

    /**
     * Set the value of [id] column.
     *
     * @param int $v new value
     * @return $this|\Tekstove\TekstoveBundle\Model\Entity\Artist The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[ArtistTableMap::COL_ID] = true;
        }

        return $this;
    } // setId()

    /**
     * Set the value of [redirect_to_artist_id] column.
     *
     * @param int $v new value
     * @return $this|\Tekstove\TekstoveBundle\Model\Entity\Artist The current object (for fluent API support)
     */
    public function setRedirectToArtistId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->redirect_to_artist_id !== $v) {
            $this->redirect_to_artist_id = $v;
            $this->modifiedColumns[ArtistTableMap::COL_REDIRECT_TO_ARTIST_ID] = true;
        }

        return $this;
    } // setRedirectToArtistId()

    /**
     * Sets the value of the [forbidden] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param  boolean|integer|string $v The new value
     * @return $this|\Tekstove\TekstoveBundle\Model\Entity\Artist The current object (for fluent API support)
     */
    public function setForbidden($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->forbidden !== $v) {
            $this->forbidden = $v;
            $this->modifiedColumns[ArtistTableMap::COL_FORBIDDEN] = true;
        }

        return $this;
    } // setForbidden()

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
            if ($this->forbidden !== false) {
                return false;
            }

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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : ArtistTableMap::translateFieldName('Name', TableMap::TYPE_PHPNAME, $indexType)];
            $this->name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : ArtistTableMap::translateFieldName('NameAlternatives', TableMap::TYPE_PHPNAME, $indexType)];
            $this->name_alternatives = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : ArtistTableMap::translateFieldName('Addedby', TableMap::TYPE_PHPNAME, $indexType)];
            $this->addedby = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : ArtistTableMap::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : ArtistTableMap::translateFieldName('RedirectToArtistId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->redirect_to_artist_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : ArtistTableMap::translateFieldName('Forbidden', TableMap::TYPE_PHPNAME, $indexType)];
            $this->forbidden = (null !== $col) ? (boolean) $col : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 6; // 6 = ArtistTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\Tekstove\\TekstoveBundle\\Model\\Entity\\Artist'), 0, $e);
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
            $con = Propel::getServiceContainer()->getReadConnection(ArtistTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildArtistQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->collTodays = null;

            $this->collLyricsRelatedByArtist1 = null;

            $this->collLyricsRelatedByArtist2 = null;

            $this->collLyricsRelatedByArtist3 = null;

            $this->collLyricsRelatedByArtist4 = null;

            $this->collLyricsRelatedByArtist5 = null;

            $this->collLyricsRelatedByArtist6 = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see Artist::setDeleted()
     * @see Artist::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(ArtistTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildArtistQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(ArtistTableMap::DATABASE_NAME);
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
                ArtistTableMap::addInstanceToPool($this);
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

            if ($this->todaysScheduledForDeletion !== null) {
                if (!$this->todaysScheduledForDeletion->isEmpty()) {
                    foreach ($this->todaysScheduledForDeletion as $today) {
                        // need to save related object because we set the relation to null
                        $today->save($con);
                    }
                    $this->todaysScheduledForDeletion = null;
                }
            }

            if ($this->collTodays !== null) {
                foreach ($this->collTodays as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->lyricsRelatedByArtist1ScheduledForDeletion !== null) {
                if (!$this->lyricsRelatedByArtist1ScheduledForDeletion->isEmpty()) {
                    foreach ($this->lyricsRelatedByArtist1ScheduledForDeletion as $lyricRelatedByArtist1) {
                        // need to save related object because we set the relation to null
                        $lyricRelatedByArtist1->save($con);
                    }
                    $this->lyricsRelatedByArtist1ScheduledForDeletion = null;
                }
            }

            if ($this->collLyricsRelatedByArtist1 !== null) {
                foreach ($this->collLyricsRelatedByArtist1 as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->lyricsRelatedByArtist2ScheduledForDeletion !== null) {
                if (!$this->lyricsRelatedByArtist2ScheduledForDeletion->isEmpty()) {
                    foreach ($this->lyricsRelatedByArtist2ScheduledForDeletion as $lyricRelatedByArtist2) {
                        // need to save related object because we set the relation to null
                        $lyricRelatedByArtist2->save($con);
                    }
                    $this->lyricsRelatedByArtist2ScheduledForDeletion = null;
                }
            }

            if ($this->collLyricsRelatedByArtist2 !== null) {
                foreach ($this->collLyricsRelatedByArtist2 as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->lyricsRelatedByArtist3ScheduledForDeletion !== null) {
                if (!$this->lyricsRelatedByArtist3ScheduledForDeletion->isEmpty()) {
                    foreach ($this->lyricsRelatedByArtist3ScheduledForDeletion as $lyricRelatedByArtist3) {
                        // need to save related object because we set the relation to null
                        $lyricRelatedByArtist3->save($con);
                    }
                    $this->lyricsRelatedByArtist3ScheduledForDeletion = null;
                }
            }

            if ($this->collLyricsRelatedByArtist3 !== null) {
                foreach ($this->collLyricsRelatedByArtist3 as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->lyricsRelatedByArtist4ScheduledForDeletion !== null) {
                if (!$this->lyricsRelatedByArtist4ScheduledForDeletion->isEmpty()) {
                    foreach ($this->lyricsRelatedByArtist4ScheduledForDeletion as $lyricRelatedByArtist4) {
                        // need to save related object because we set the relation to null
                        $lyricRelatedByArtist4->save($con);
                    }
                    $this->lyricsRelatedByArtist4ScheduledForDeletion = null;
                }
            }

            if ($this->collLyricsRelatedByArtist4 !== null) {
                foreach ($this->collLyricsRelatedByArtist4 as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->lyricsRelatedByArtist5ScheduledForDeletion !== null) {
                if (!$this->lyricsRelatedByArtist5ScheduledForDeletion->isEmpty()) {
                    foreach ($this->lyricsRelatedByArtist5ScheduledForDeletion as $lyricRelatedByArtist5) {
                        // need to save related object because we set the relation to null
                        $lyricRelatedByArtist5->save($con);
                    }
                    $this->lyricsRelatedByArtist5ScheduledForDeletion = null;
                }
            }

            if ($this->collLyricsRelatedByArtist5 !== null) {
                foreach ($this->collLyricsRelatedByArtist5 as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->lyricsRelatedByArtist6ScheduledForDeletion !== null) {
                if (!$this->lyricsRelatedByArtist6ScheduledForDeletion->isEmpty()) {
                    \Tekstove\TekstoveBundle\Model\Entity\LyricQuery::create()
                        ->filterByPrimaryKeys($this->lyricsRelatedByArtist6ScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->lyricsRelatedByArtist6ScheduledForDeletion = null;
                }
            }

            if ($this->collLyricsRelatedByArtist6 !== null) {
                foreach ($this->collLyricsRelatedByArtist6 as $referrerFK) {
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

        $this->modifiedColumns[ArtistTableMap::COL_ID] = true;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . ArtistTableMap::COL_ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(ArtistTableMap::COL_NAME)) {
            $modifiedColumns[':p' . $index++]  = 'name';
        }
        if ($this->isColumnModified(ArtistTableMap::COL_NAME_ALTERNATIVES)) {
            $modifiedColumns[':p' . $index++]  = 'name_alternatives';
        }
        if ($this->isColumnModified(ArtistTableMap::COL_ADDEDBY)) {
            $modifiedColumns[':p' . $index++]  = 'addedby';
        }
        if ($this->isColumnModified(ArtistTableMap::COL_ID)) {
            $modifiedColumns[':p' . $index++]  = 'id';
        }
        if ($this->isColumnModified(ArtistTableMap::COL_REDIRECT_TO_ARTIST_ID)) {
            $modifiedColumns[':p' . $index++]  = 'redirect_to_artist_id';
        }
        if ($this->isColumnModified(ArtistTableMap::COL_FORBIDDEN)) {
            $modifiedColumns[':p' . $index++]  = 'forbidden';
        }

        $sql = sprintf(
            'INSERT INTO artists (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'name':
                        $stmt->bindValue($identifier, $this->name, PDO::PARAM_STR);
                        break;
                    case 'name_alternatives':
                        $stmt->bindValue($identifier, $this->name_alternatives, PDO::PARAM_STR);
                        break;
                    case 'addedby':
                        $stmt->bindValue($identifier, $this->addedby, PDO::PARAM_INT);
                        break;
                    case 'id':
                        $stmt->bindValue($identifier, $this->id, PDO::PARAM_INT);
                        break;
                    case 'redirect_to_artist_id':
                        $stmt->bindValue($identifier, $this->redirect_to_artist_id, PDO::PARAM_INT);
                        break;
                    case 'forbidden':
                        $stmt->bindValue($identifier, (int) $this->forbidden, PDO::PARAM_INT);
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
        $pos = ArtistTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getName();
                break;
            case 1:
                return $this->getNameAlternatives();
                break;
            case 2:
                return $this->getAddedby();
                break;
            case 3:
                return $this->getId();
                break;
            case 4:
                return $this->getRedirectToArtistId();
                break;
            case 5:
                return $this->getForbidden();
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

        if (isset($alreadyDumpedObjects['Artist'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Artist'][$this->hashCode()] = true;
        $keys = ArtistTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getName(),
            $keys[1] => $this->getNameAlternatives(),
            $keys[2] => $this->getAddedby(),
            $keys[3] => $this->getId(),
            $keys[4] => $this->getRedirectToArtistId(),
            $keys[5] => $this->getForbidden(),
        );
        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->collTodays) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'todays';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'todays';
                        break;
                    default:
                        $key = 'Todays';
                }

                $result[$key] = $this->collTodays->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collLyricsRelatedByArtist1) {

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

                $result[$key] = $this->collLyricsRelatedByArtist1->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collLyricsRelatedByArtist2) {

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

                $result[$key] = $this->collLyricsRelatedByArtist2->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collLyricsRelatedByArtist3) {

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

                $result[$key] = $this->collLyricsRelatedByArtist3->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collLyricsRelatedByArtist4) {

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

                $result[$key] = $this->collLyricsRelatedByArtist4->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collLyricsRelatedByArtist5) {

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

                $result[$key] = $this->collLyricsRelatedByArtist5->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collLyricsRelatedByArtist6) {

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

                $result[$key] = $this->collLyricsRelatedByArtist6->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
     * @return $this|\Tekstove\TekstoveBundle\Model\Entity\Artist
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = ArtistTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\Tekstove\TekstoveBundle\Model\Entity\Artist
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setName($value);
                break;
            case 1:
                $this->setNameAlternatives($value);
                break;
            case 2:
                $this->setAddedby($value);
                break;
            case 3:
                $this->setId($value);
                break;
            case 4:
                $this->setRedirectToArtistId($value);
                break;
            case 5:
                $this->setForbidden($value);
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
        $keys = ArtistTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setName($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setNameAlternatives($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setAddedby($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setId($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setRedirectToArtistId($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setForbidden($arr[$keys[5]]);
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
     * @return $this|\Tekstove\TekstoveBundle\Model\Entity\Artist The current object, for fluid interface
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
        $criteria = new Criteria(ArtistTableMap::DATABASE_NAME);

        if ($this->isColumnModified(ArtistTableMap::COL_NAME)) {
            $criteria->add(ArtistTableMap::COL_NAME, $this->name);
        }
        if ($this->isColumnModified(ArtistTableMap::COL_NAME_ALTERNATIVES)) {
            $criteria->add(ArtistTableMap::COL_NAME_ALTERNATIVES, $this->name_alternatives);
        }
        if ($this->isColumnModified(ArtistTableMap::COL_ADDEDBY)) {
            $criteria->add(ArtistTableMap::COL_ADDEDBY, $this->addedby);
        }
        if ($this->isColumnModified(ArtistTableMap::COL_ID)) {
            $criteria->add(ArtistTableMap::COL_ID, $this->id);
        }
        if ($this->isColumnModified(ArtistTableMap::COL_REDIRECT_TO_ARTIST_ID)) {
            $criteria->add(ArtistTableMap::COL_REDIRECT_TO_ARTIST_ID, $this->redirect_to_artist_id);
        }
        if ($this->isColumnModified(ArtistTableMap::COL_FORBIDDEN)) {
            $criteria->add(ArtistTableMap::COL_FORBIDDEN, $this->forbidden);
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
        $criteria = ChildArtistQuery::create();
        $criteria->add(ArtistTableMap::COL_ID, $this->id);

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
     * @param      object $copyObj An object of \Tekstove\TekstoveBundle\Model\Entity\Artist (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setName($this->getName());
        $copyObj->setNameAlternatives($this->getNameAlternatives());
        $copyObj->setAddedby($this->getAddedby());
        $copyObj->setRedirectToArtistId($this->getRedirectToArtistId());
        $copyObj->setForbidden($this->getForbidden());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getTodays() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addToday($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getLyricsRelatedByArtist1() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addLyricRelatedByArtist1($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getLyricsRelatedByArtist2() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addLyricRelatedByArtist2($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getLyricsRelatedByArtist3() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addLyricRelatedByArtist3($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getLyricsRelatedByArtist4() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addLyricRelatedByArtist4($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getLyricsRelatedByArtist5() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addLyricRelatedByArtist5($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getLyricsRelatedByArtist6() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addLyricRelatedByArtist6($relObj->copy($deepCopy));
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
     * @return \Tekstove\TekstoveBundle\Model\Entity\Artist Clone of current object.
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
        if ('Today' == $relationName) {
            return $this->initTodays();
        }
        if ('LyricRelatedByArtist1' == $relationName) {
            return $this->initLyricsRelatedByArtist1();
        }
        if ('LyricRelatedByArtist2' == $relationName) {
            return $this->initLyricsRelatedByArtist2();
        }
        if ('LyricRelatedByArtist3' == $relationName) {
            return $this->initLyricsRelatedByArtist3();
        }
        if ('LyricRelatedByArtist4' == $relationName) {
            return $this->initLyricsRelatedByArtist4();
        }
        if ('LyricRelatedByArtist5' == $relationName) {
            return $this->initLyricsRelatedByArtist5();
        }
        if ('LyricRelatedByArtist6' == $relationName) {
            return $this->initLyricsRelatedByArtist6();
        }
    }

    /**
     * Clears out the collTodays collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addTodays()
     */
    public function clearTodays()
    {
        $this->collTodays = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collTodays collection loaded partially.
     */
    public function resetPartialTodays($v = true)
    {
        $this->collTodaysPartial = $v;
    }

    /**
     * Initializes the collTodays collection.
     *
     * By default this just sets the collTodays collection to an empty array (like clearcollTodays());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initTodays($overrideExisting = true)
    {
        if (null !== $this->collTodays && !$overrideExisting) {
            return;
        }
        $this->collTodays = new ObjectCollection();
        $this->collTodays->setModel('\Tekstove\TekstoveBundle\Model\Entity\Today');
    }

    /**
     * Gets an array of ChildToday objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildArtist is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildToday[] List of ChildToday objects
     * @throws PropelException
     */
    public function getTodays(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collTodaysPartial && !$this->isNew();
        if (null === $this->collTodays || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collTodays) {
                // return empty collection
                $this->initTodays();
            } else {
                $collTodays = ChildTodayQuery::create(null, $criteria)
                    ->filterByArtist($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collTodaysPartial && count($collTodays)) {
                        $this->initTodays(false);

                        foreach ($collTodays as $obj) {
                            if (false == $this->collTodays->contains($obj)) {
                                $this->collTodays->append($obj);
                            }
                        }

                        $this->collTodaysPartial = true;
                    }

                    return $collTodays;
                }

                if ($partial && $this->collTodays) {
                    foreach ($this->collTodays as $obj) {
                        if ($obj->isNew()) {
                            $collTodays[] = $obj;
                        }
                    }
                }

                $this->collTodays = $collTodays;
                $this->collTodaysPartial = false;
            }
        }

        return $this->collTodays;
    }

    /**
     * Sets a collection of ChildToday objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $todays A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildArtist The current object (for fluent API support)
     */
    public function setTodays(Collection $todays, ConnectionInterface $con = null)
    {
        /** @var ChildToday[] $todaysToDelete */
        $todaysToDelete = $this->getTodays(new Criteria(), $con)->diff($todays);


        $this->todaysScheduledForDeletion = $todaysToDelete;

        foreach ($todaysToDelete as $todayRemoved) {
            $todayRemoved->setArtist(null);
        }

        $this->collTodays = null;
        foreach ($todays as $today) {
            $this->addToday($today);
        }

        $this->collTodays = $todays;
        $this->collTodaysPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Today objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related Today objects.
     * @throws PropelException
     */
    public function countTodays(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collTodaysPartial && !$this->isNew();
        if (null === $this->collTodays || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collTodays) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getTodays());
            }

            $query = ChildTodayQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByArtist($this)
                ->count($con);
        }

        return count($this->collTodays);
    }

    /**
     * Method called to associate a ChildToday object to this object
     * through the ChildToday foreign key attribute.
     *
     * @param  ChildToday $l ChildToday
     * @return $this|\Tekstove\TekstoveBundle\Model\Entity\Artist The current object (for fluent API support)
     */
    public function addToday(ChildToday $l)
    {
        if ($this->collTodays === null) {
            $this->initTodays();
            $this->collTodaysPartial = true;
        }

        if (!$this->collTodays->contains($l)) {
            $this->doAddToday($l);
        }

        return $this;
    }

    /**
     * @param ChildToday $today The ChildToday object to add.
     */
    protected function doAddToday(ChildToday $today)
    {
        $this->collTodays[]= $today;
        $today->setArtist($this);
    }

    /**
     * @param  ChildToday $today The ChildToday object to remove.
     * @return $this|ChildArtist The current object (for fluent API support)
     */
    public function removeToday(ChildToday $today)
    {
        if ($this->getTodays()->contains($today)) {
            $pos = $this->collTodays->search($today);
            $this->collTodays->remove($pos);
            if (null === $this->todaysScheduledForDeletion) {
                $this->todaysScheduledForDeletion = clone $this->collTodays;
                $this->todaysScheduledForDeletion->clear();
            }
            $this->todaysScheduledForDeletion[]= $today;
            $today->setArtist(null);
        }

        return $this;
    }

    /**
     * Clears out the collLyricsRelatedByArtist1 collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addLyricsRelatedByArtist1()
     */
    public function clearLyricsRelatedByArtist1()
    {
        $this->collLyricsRelatedByArtist1 = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collLyricsRelatedByArtist1 collection loaded partially.
     */
    public function resetPartialLyricsRelatedByArtist1($v = true)
    {
        $this->collLyricsRelatedByArtist1Partial = $v;
    }

    /**
     * Initializes the collLyricsRelatedByArtist1 collection.
     *
     * By default this just sets the collLyricsRelatedByArtist1 collection to an empty array (like clearcollLyricsRelatedByArtist1());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initLyricsRelatedByArtist1($overrideExisting = true)
    {
        if (null !== $this->collLyricsRelatedByArtist1 && !$overrideExisting) {
            return;
        }
        $this->collLyricsRelatedByArtist1 = new ObjectCollection();
        $this->collLyricsRelatedByArtist1->setModel('\Tekstove\TekstoveBundle\Model\Entity\Lyric');
    }

    /**
     * Gets an array of ChildLyric objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildArtist is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildLyric[] List of ChildLyric objects
     * @throws PropelException
     */
    public function getLyricsRelatedByArtist1(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collLyricsRelatedByArtist1Partial && !$this->isNew();
        if (null === $this->collLyricsRelatedByArtist1 || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collLyricsRelatedByArtist1) {
                // return empty collection
                $this->initLyricsRelatedByArtist1();
            } else {
                $collLyricsRelatedByArtist1 = ChildLyricQuery::create(null, $criteria)
                    ->filterByArtistRelatedByArtist1($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collLyricsRelatedByArtist1Partial && count($collLyricsRelatedByArtist1)) {
                        $this->initLyricsRelatedByArtist1(false);

                        foreach ($collLyricsRelatedByArtist1 as $obj) {
                            if (false == $this->collLyricsRelatedByArtist1->contains($obj)) {
                                $this->collLyricsRelatedByArtist1->append($obj);
                            }
                        }

                        $this->collLyricsRelatedByArtist1Partial = true;
                    }

                    return $collLyricsRelatedByArtist1;
                }

                if ($partial && $this->collLyricsRelatedByArtist1) {
                    foreach ($this->collLyricsRelatedByArtist1 as $obj) {
                        if ($obj->isNew()) {
                            $collLyricsRelatedByArtist1[] = $obj;
                        }
                    }
                }

                $this->collLyricsRelatedByArtist1 = $collLyricsRelatedByArtist1;
                $this->collLyricsRelatedByArtist1Partial = false;
            }
        }

        return $this->collLyricsRelatedByArtist1;
    }

    /**
     * Sets a collection of ChildLyric objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $lyricsRelatedByArtist1 A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildArtist The current object (for fluent API support)
     */
    public function setLyricsRelatedByArtist1(Collection $lyricsRelatedByArtist1, ConnectionInterface $con = null)
    {
        /** @var ChildLyric[] $lyricsRelatedByArtist1ToDelete */
        $lyricsRelatedByArtist1ToDelete = $this->getLyricsRelatedByArtist1(new Criteria(), $con)->diff($lyricsRelatedByArtist1);


        $this->lyricsRelatedByArtist1ScheduledForDeletion = $lyricsRelatedByArtist1ToDelete;

        foreach ($lyricsRelatedByArtist1ToDelete as $lyricRelatedByArtist1Removed) {
            $lyricRelatedByArtist1Removed->setArtistRelatedByArtist1(null);
        }

        $this->collLyricsRelatedByArtist1 = null;
        foreach ($lyricsRelatedByArtist1 as $lyricRelatedByArtist1) {
            $this->addLyricRelatedByArtist1($lyricRelatedByArtist1);
        }

        $this->collLyricsRelatedByArtist1 = $lyricsRelatedByArtist1;
        $this->collLyricsRelatedByArtist1Partial = false;

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
    public function countLyricsRelatedByArtist1(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collLyricsRelatedByArtist1Partial && !$this->isNew();
        if (null === $this->collLyricsRelatedByArtist1 || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collLyricsRelatedByArtist1) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getLyricsRelatedByArtist1());
            }

            $query = ChildLyricQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByArtistRelatedByArtist1($this)
                ->count($con);
        }

        return count($this->collLyricsRelatedByArtist1);
    }

    /**
     * Method called to associate a ChildLyric object to this object
     * through the ChildLyric foreign key attribute.
     *
     * @param  ChildLyric $l ChildLyric
     * @return $this|\Tekstove\TekstoveBundle\Model\Entity\Artist The current object (for fluent API support)
     */
    public function addLyricRelatedByArtist1(ChildLyric $l)
    {
        if ($this->collLyricsRelatedByArtist1 === null) {
            $this->initLyricsRelatedByArtist1();
            $this->collLyricsRelatedByArtist1Partial = true;
        }

        if (!$this->collLyricsRelatedByArtist1->contains($l)) {
            $this->doAddLyricRelatedByArtist1($l);
        }

        return $this;
    }

    /**
     * @param ChildLyric $lyricRelatedByArtist1 The ChildLyric object to add.
     */
    protected function doAddLyricRelatedByArtist1(ChildLyric $lyricRelatedByArtist1)
    {
        $this->collLyricsRelatedByArtist1[]= $lyricRelatedByArtist1;
        $lyricRelatedByArtist1->setArtistRelatedByArtist1($this);
    }

    /**
     * @param  ChildLyric $lyricRelatedByArtist1 The ChildLyric object to remove.
     * @return $this|ChildArtist The current object (for fluent API support)
     */
    public function removeLyricRelatedByArtist1(ChildLyric $lyricRelatedByArtist1)
    {
        if ($this->getLyricsRelatedByArtist1()->contains($lyricRelatedByArtist1)) {
            $pos = $this->collLyricsRelatedByArtist1->search($lyricRelatedByArtist1);
            $this->collLyricsRelatedByArtist1->remove($pos);
            if (null === $this->lyricsRelatedByArtist1ScheduledForDeletion) {
                $this->lyricsRelatedByArtist1ScheduledForDeletion = clone $this->collLyricsRelatedByArtist1;
                $this->lyricsRelatedByArtist1ScheduledForDeletion->clear();
            }
            $this->lyricsRelatedByArtist1ScheduledForDeletion[]= $lyricRelatedByArtist1;
            $lyricRelatedByArtist1->setArtistRelatedByArtist1(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Artist is new, it will return
     * an empty collection; or if this Artist has previously
     * been saved, it will retrieve related LyricsRelatedByArtist1 from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Artist.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildLyric[] List of ChildLyric objects
     */
    public function getLyricsRelatedByArtist1JoinUsers(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildLyricQuery::create(null, $criteria);
        $query->joinWith('Users', $joinBehavior);

        return $this->getLyricsRelatedByArtist1($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Artist is new, it will return
     * an empty collection; or if this Artist has previously
     * been saved, it will retrieve related LyricsRelatedByArtist1 from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Artist.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildLyric[] List of ChildLyric objects
     */
    public function getLyricsRelatedByArtist1JoinLanguages(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildLyricQuery::create(null, $criteria);
        $query->joinWith('Languages', $joinBehavior);

        return $this->getLyricsRelatedByArtist1($query, $con);
    }

    /**
     * Clears out the collLyricsRelatedByArtist2 collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addLyricsRelatedByArtist2()
     */
    public function clearLyricsRelatedByArtist2()
    {
        $this->collLyricsRelatedByArtist2 = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collLyricsRelatedByArtist2 collection loaded partially.
     */
    public function resetPartialLyricsRelatedByArtist2($v = true)
    {
        $this->collLyricsRelatedByArtist2Partial = $v;
    }

    /**
     * Initializes the collLyricsRelatedByArtist2 collection.
     *
     * By default this just sets the collLyricsRelatedByArtist2 collection to an empty array (like clearcollLyricsRelatedByArtist2());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initLyricsRelatedByArtist2($overrideExisting = true)
    {
        if (null !== $this->collLyricsRelatedByArtist2 && !$overrideExisting) {
            return;
        }
        $this->collLyricsRelatedByArtist2 = new ObjectCollection();
        $this->collLyricsRelatedByArtist2->setModel('\Tekstove\TekstoveBundle\Model\Entity\Lyric');
    }

    /**
     * Gets an array of ChildLyric objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildArtist is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildLyric[] List of ChildLyric objects
     * @throws PropelException
     */
    public function getLyricsRelatedByArtist2(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collLyricsRelatedByArtist2Partial && !$this->isNew();
        if (null === $this->collLyricsRelatedByArtist2 || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collLyricsRelatedByArtist2) {
                // return empty collection
                $this->initLyricsRelatedByArtist2();
            } else {
                $collLyricsRelatedByArtist2 = ChildLyricQuery::create(null, $criteria)
                    ->filterByArtistRelatedByArtist2($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collLyricsRelatedByArtist2Partial && count($collLyricsRelatedByArtist2)) {
                        $this->initLyricsRelatedByArtist2(false);

                        foreach ($collLyricsRelatedByArtist2 as $obj) {
                            if (false == $this->collLyricsRelatedByArtist2->contains($obj)) {
                                $this->collLyricsRelatedByArtist2->append($obj);
                            }
                        }

                        $this->collLyricsRelatedByArtist2Partial = true;
                    }

                    return $collLyricsRelatedByArtist2;
                }

                if ($partial && $this->collLyricsRelatedByArtist2) {
                    foreach ($this->collLyricsRelatedByArtist2 as $obj) {
                        if ($obj->isNew()) {
                            $collLyricsRelatedByArtist2[] = $obj;
                        }
                    }
                }

                $this->collLyricsRelatedByArtist2 = $collLyricsRelatedByArtist2;
                $this->collLyricsRelatedByArtist2Partial = false;
            }
        }

        return $this->collLyricsRelatedByArtist2;
    }

    /**
     * Sets a collection of ChildLyric objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $lyricsRelatedByArtist2 A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildArtist The current object (for fluent API support)
     */
    public function setLyricsRelatedByArtist2(Collection $lyricsRelatedByArtist2, ConnectionInterface $con = null)
    {
        /** @var ChildLyric[] $lyricsRelatedByArtist2ToDelete */
        $lyricsRelatedByArtist2ToDelete = $this->getLyricsRelatedByArtist2(new Criteria(), $con)->diff($lyricsRelatedByArtist2);


        $this->lyricsRelatedByArtist2ScheduledForDeletion = $lyricsRelatedByArtist2ToDelete;

        foreach ($lyricsRelatedByArtist2ToDelete as $lyricRelatedByArtist2Removed) {
            $lyricRelatedByArtist2Removed->setArtistRelatedByArtist2(null);
        }

        $this->collLyricsRelatedByArtist2 = null;
        foreach ($lyricsRelatedByArtist2 as $lyricRelatedByArtist2) {
            $this->addLyricRelatedByArtist2($lyricRelatedByArtist2);
        }

        $this->collLyricsRelatedByArtist2 = $lyricsRelatedByArtist2;
        $this->collLyricsRelatedByArtist2Partial = false;

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
    public function countLyricsRelatedByArtist2(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collLyricsRelatedByArtist2Partial && !$this->isNew();
        if (null === $this->collLyricsRelatedByArtist2 || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collLyricsRelatedByArtist2) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getLyricsRelatedByArtist2());
            }

            $query = ChildLyricQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByArtistRelatedByArtist2($this)
                ->count($con);
        }

        return count($this->collLyricsRelatedByArtist2);
    }

    /**
     * Method called to associate a ChildLyric object to this object
     * through the ChildLyric foreign key attribute.
     *
     * @param  ChildLyric $l ChildLyric
     * @return $this|\Tekstove\TekstoveBundle\Model\Entity\Artist The current object (for fluent API support)
     */
    public function addLyricRelatedByArtist2(ChildLyric $l)
    {
        if ($this->collLyricsRelatedByArtist2 === null) {
            $this->initLyricsRelatedByArtist2();
            $this->collLyricsRelatedByArtist2Partial = true;
        }

        if (!$this->collLyricsRelatedByArtist2->contains($l)) {
            $this->doAddLyricRelatedByArtist2($l);
        }

        return $this;
    }

    /**
     * @param ChildLyric $lyricRelatedByArtist2 The ChildLyric object to add.
     */
    protected function doAddLyricRelatedByArtist2(ChildLyric $lyricRelatedByArtist2)
    {
        $this->collLyricsRelatedByArtist2[]= $lyricRelatedByArtist2;
        $lyricRelatedByArtist2->setArtistRelatedByArtist2($this);
    }

    /**
     * @param  ChildLyric $lyricRelatedByArtist2 The ChildLyric object to remove.
     * @return $this|ChildArtist The current object (for fluent API support)
     */
    public function removeLyricRelatedByArtist2(ChildLyric $lyricRelatedByArtist2)
    {
        if ($this->getLyricsRelatedByArtist2()->contains($lyricRelatedByArtist2)) {
            $pos = $this->collLyricsRelatedByArtist2->search($lyricRelatedByArtist2);
            $this->collLyricsRelatedByArtist2->remove($pos);
            if (null === $this->lyricsRelatedByArtist2ScheduledForDeletion) {
                $this->lyricsRelatedByArtist2ScheduledForDeletion = clone $this->collLyricsRelatedByArtist2;
                $this->lyricsRelatedByArtist2ScheduledForDeletion->clear();
            }
            $this->lyricsRelatedByArtist2ScheduledForDeletion[]= $lyricRelatedByArtist2;
            $lyricRelatedByArtist2->setArtistRelatedByArtist2(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Artist is new, it will return
     * an empty collection; or if this Artist has previously
     * been saved, it will retrieve related LyricsRelatedByArtist2 from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Artist.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildLyric[] List of ChildLyric objects
     */
    public function getLyricsRelatedByArtist2JoinUsers(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildLyricQuery::create(null, $criteria);
        $query->joinWith('Users', $joinBehavior);

        return $this->getLyricsRelatedByArtist2($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Artist is new, it will return
     * an empty collection; or if this Artist has previously
     * been saved, it will retrieve related LyricsRelatedByArtist2 from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Artist.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildLyric[] List of ChildLyric objects
     */
    public function getLyricsRelatedByArtist2JoinLanguages(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildLyricQuery::create(null, $criteria);
        $query->joinWith('Languages', $joinBehavior);

        return $this->getLyricsRelatedByArtist2($query, $con);
    }

    /**
     * Clears out the collLyricsRelatedByArtist3 collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addLyricsRelatedByArtist3()
     */
    public function clearLyricsRelatedByArtist3()
    {
        $this->collLyricsRelatedByArtist3 = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collLyricsRelatedByArtist3 collection loaded partially.
     */
    public function resetPartialLyricsRelatedByArtist3($v = true)
    {
        $this->collLyricsRelatedByArtist3Partial = $v;
    }

    /**
     * Initializes the collLyricsRelatedByArtist3 collection.
     *
     * By default this just sets the collLyricsRelatedByArtist3 collection to an empty array (like clearcollLyricsRelatedByArtist3());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initLyricsRelatedByArtist3($overrideExisting = true)
    {
        if (null !== $this->collLyricsRelatedByArtist3 && !$overrideExisting) {
            return;
        }
        $this->collLyricsRelatedByArtist3 = new ObjectCollection();
        $this->collLyricsRelatedByArtist3->setModel('\Tekstove\TekstoveBundle\Model\Entity\Lyric');
    }

    /**
     * Gets an array of ChildLyric objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildArtist is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildLyric[] List of ChildLyric objects
     * @throws PropelException
     */
    public function getLyricsRelatedByArtist3(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collLyricsRelatedByArtist3Partial && !$this->isNew();
        if (null === $this->collLyricsRelatedByArtist3 || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collLyricsRelatedByArtist3) {
                // return empty collection
                $this->initLyricsRelatedByArtist3();
            } else {
                $collLyricsRelatedByArtist3 = ChildLyricQuery::create(null, $criteria)
                    ->filterByArtistRelatedByArtist3($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collLyricsRelatedByArtist3Partial && count($collLyricsRelatedByArtist3)) {
                        $this->initLyricsRelatedByArtist3(false);

                        foreach ($collLyricsRelatedByArtist3 as $obj) {
                            if (false == $this->collLyricsRelatedByArtist3->contains($obj)) {
                                $this->collLyricsRelatedByArtist3->append($obj);
                            }
                        }

                        $this->collLyricsRelatedByArtist3Partial = true;
                    }

                    return $collLyricsRelatedByArtist3;
                }

                if ($partial && $this->collLyricsRelatedByArtist3) {
                    foreach ($this->collLyricsRelatedByArtist3 as $obj) {
                        if ($obj->isNew()) {
                            $collLyricsRelatedByArtist3[] = $obj;
                        }
                    }
                }

                $this->collLyricsRelatedByArtist3 = $collLyricsRelatedByArtist3;
                $this->collLyricsRelatedByArtist3Partial = false;
            }
        }

        return $this->collLyricsRelatedByArtist3;
    }

    /**
     * Sets a collection of ChildLyric objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $lyricsRelatedByArtist3 A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildArtist The current object (for fluent API support)
     */
    public function setLyricsRelatedByArtist3(Collection $lyricsRelatedByArtist3, ConnectionInterface $con = null)
    {
        /** @var ChildLyric[] $lyricsRelatedByArtist3ToDelete */
        $lyricsRelatedByArtist3ToDelete = $this->getLyricsRelatedByArtist3(new Criteria(), $con)->diff($lyricsRelatedByArtist3);


        $this->lyricsRelatedByArtist3ScheduledForDeletion = $lyricsRelatedByArtist3ToDelete;

        foreach ($lyricsRelatedByArtist3ToDelete as $lyricRelatedByArtist3Removed) {
            $lyricRelatedByArtist3Removed->setArtistRelatedByArtist3(null);
        }

        $this->collLyricsRelatedByArtist3 = null;
        foreach ($lyricsRelatedByArtist3 as $lyricRelatedByArtist3) {
            $this->addLyricRelatedByArtist3($lyricRelatedByArtist3);
        }

        $this->collLyricsRelatedByArtist3 = $lyricsRelatedByArtist3;
        $this->collLyricsRelatedByArtist3Partial = false;

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
    public function countLyricsRelatedByArtist3(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collLyricsRelatedByArtist3Partial && !$this->isNew();
        if (null === $this->collLyricsRelatedByArtist3 || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collLyricsRelatedByArtist3) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getLyricsRelatedByArtist3());
            }

            $query = ChildLyricQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByArtistRelatedByArtist3($this)
                ->count($con);
        }

        return count($this->collLyricsRelatedByArtist3);
    }

    /**
     * Method called to associate a ChildLyric object to this object
     * through the ChildLyric foreign key attribute.
     *
     * @param  ChildLyric $l ChildLyric
     * @return $this|\Tekstove\TekstoveBundle\Model\Entity\Artist The current object (for fluent API support)
     */
    public function addLyricRelatedByArtist3(ChildLyric $l)
    {
        if ($this->collLyricsRelatedByArtist3 === null) {
            $this->initLyricsRelatedByArtist3();
            $this->collLyricsRelatedByArtist3Partial = true;
        }

        if (!$this->collLyricsRelatedByArtist3->contains($l)) {
            $this->doAddLyricRelatedByArtist3($l);
        }

        return $this;
    }

    /**
     * @param ChildLyric $lyricRelatedByArtist3 The ChildLyric object to add.
     */
    protected function doAddLyricRelatedByArtist3(ChildLyric $lyricRelatedByArtist3)
    {
        $this->collLyricsRelatedByArtist3[]= $lyricRelatedByArtist3;
        $lyricRelatedByArtist3->setArtistRelatedByArtist3($this);
    }

    /**
     * @param  ChildLyric $lyricRelatedByArtist3 The ChildLyric object to remove.
     * @return $this|ChildArtist The current object (for fluent API support)
     */
    public function removeLyricRelatedByArtist3(ChildLyric $lyricRelatedByArtist3)
    {
        if ($this->getLyricsRelatedByArtist3()->contains($lyricRelatedByArtist3)) {
            $pos = $this->collLyricsRelatedByArtist3->search($lyricRelatedByArtist3);
            $this->collLyricsRelatedByArtist3->remove($pos);
            if (null === $this->lyricsRelatedByArtist3ScheduledForDeletion) {
                $this->lyricsRelatedByArtist3ScheduledForDeletion = clone $this->collLyricsRelatedByArtist3;
                $this->lyricsRelatedByArtist3ScheduledForDeletion->clear();
            }
            $this->lyricsRelatedByArtist3ScheduledForDeletion[]= $lyricRelatedByArtist3;
            $lyricRelatedByArtist3->setArtistRelatedByArtist3(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Artist is new, it will return
     * an empty collection; or if this Artist has previously
     * been saved, it will retrieve related LyricsRelatedByArtist3 from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Artist.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildLyric[] List of ChildLyric objects
     */
    public function getLyricsRelatedByArtist3JoinUsers(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildLyricQuery::create(null, $criteria);
        $query->joinWith('Users', $joinBehavior);

        return $this->getLyricsRelatedByArtist3($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Artist is new, it will return
     * an empty collection; or if this Artist has previously
     * been saved, it will retrieve related LyricsRelatedByArtist3 from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Artist.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildLyric[] List of ChildLyric objects
     */
    public function getLyricsRelatedByArtist3JoinLanguages(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildLyricQuery::create(null, $criteria);
        $query->joinWith('Languages', $joinBehavior);

        return $this->getLyricsRelatedByArtist3($query, $con);
    }

    /**
     * Clears out the collLyricsRelatedByArtist4 collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addLyricsRelatedByArtist4()
     */
    public function clearLyricsRelatedByArtist4()
    {
        $this->collLyricsRelatedByArtist4 = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collLyricsRelatedByArtist4 collection loaded partially.
     */
    public function resetPartialLyricsRelatedByArtist4($v = true)
    {
        $this->collLyricsRelatedByArtist4Partial = $v;
    }

    /**
     * Initializes the collLyricsRelatedByArtist4 collection.
     *
     * By default this just sets the collLyricsRelatedByArtist4 collection to an empty array (like clearcollLyricsRelatedByArtist4());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initLyricsRelatedByArtist4($overrideExisting = true)
    {
        if (null !== $this->collLyricsRelatedByArtist4 && !$overrideExisting) {
            return;
        }
        $this->collLyricsRelatedByArtist4 = new ObjectCollection();
        $this->collLyricsRelatedByArtist4->setModel('\Tekstove\TekstoveBundle\Model\Entity\Lyric');
    }

    /**
     * Gets an array of ChildLyric objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildArtist is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildLyric[] List of ChildLyric objects
     * @throws PropelException
     */
    public function getLyricsRelatedByArtist4(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collLyricsRelatedByArtist4Partial && !$this->isNew();
        if (null === $this->collLyricsRelatedByArtist4 || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collLyricsRelatedByArtist4) {
                // return empty collection
                $this->initLyricsRelatedByArtist4();
            } else {
                $collLyricsRelatedByArtist4 = ChildLyricQuery::create(null, $criteria)
                    ->filterByArtistRelatedByArtist4($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collLyricsRelatedByArtist4Partial && count($collLyricsRelatedByArtist4)) {
                        $this->initLyricsRelatedByArtist4(false);

                        foreach ($collLyricsRelatedByArtist4 as $obj) {
                            if (false == $this->collLyricsRelatedByArtist4->contains($obj)) {
                                $this->collLyricsRelatedByArtist4->append($obj);
                            }
                        }

                        $this->collLyricsRelatedByArtist4Partial = true;
                    }

                    return $collLyricsRelatedByArtist4;
                }

                if ($partial && $this->collLyricsRelatedByArtist4) {
                    foreach ($this->collLyricsRelatedByArtist4 as $obj) {
                        if ($obj->isNew()) {
                            $collLyricsRelatedByArtist4[] = $obj;
                        }
                    }
                }

                $this->collLyricsRelatedByArtist4 = $collLyricsRelatedByArtist4;
                $this->collLyricsRelatedByArtist4Partial = false;
            }
        }

        return $this->collLyricsRelatedByArtist4;
    }

    /**
     * Sets a collection of ChildLyric objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $lyricsRelatedByArtist4 A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildArtist The current object (for fluent API support)
     */
    public function setLyricsRelatedByArtist4(Collection $lyricsRelatedByArtist4, ConnectionInterface $con = null)
    {
        /** @var ChildLyric[] $lyricsRelatedByArtist4ToDelete */
        $lyricsRelatedByArtist4ToDelete = $this->getLyricsRelatedByArtist4(new Criteria(), $con)->diff($lyricsRelatedByArtist4);


        $this->lyricsRelatedByArtist4ScheduledForDeletion = $lyricsRelatedByArtist4ToDelete;

        foreach ($lyricsRelatedByArtist4ToDelete as $lyricRelatedByArtist4Removed) {
            $lyricRelatedByArtist4Removed->setArtistRelatedByArtist4(null);
        }

        $this->collLyricsRelatedByArtist4 = null;
        foreach ($lyricsRelatedByArtist4 as $lyricRelatedByArtist4) {
            $this->addLyricRelatedByArtist4($lyricRelatedByArtist4);
        }

        $this->collLyricsRelatedByArtist4 = $lyricsRelatedByArtist4;
        $this->collLyricsRelatedByArtist4Partial = false;

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
    public function countLyricsRelatedByArtist4(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collLyricsRelatedByArtist4Partial && !$this->isNew();
        if (null === $this->collLyricsRelatedByArtist4 || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collLyricsRelatedByArtist4) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getLyricsRelatedByArtist4());
            }

            $query = ChildLyricQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByArtistRelatedByArtist4($this)
                ->count($con);
        }

        return count($this->collLyricsRelatedByArtist4);
    }

    /**
     * Method called to associate a ChildLyric object to this object
     * through the ChildLyric foreign key attribute.
     *
     * @param  ChildLyric $l ChildLyric
     * @return $this|\Tekstove\TekstoveBundle\Model\Entity\Artist The current object (for fluent API support)
     */
    public function addLyricRelatedByArtist4(ChildLyric $l)
    {
        if ($this->collLyricsRelatedByArtist4 === null) {
            $this->initLyricsRelatedByArtist4();
            $this->collLyricsRelatedByArtist4Partial = true;
        }

        if (!$this->collLyricsRelatedByArtist4->contains($l)) {
            $this->doAddLyricRelatedByArtist4($l);
        }

        return $this;
    }

    /**
     * @param ChildLyric $lyricRelatedByArtist4 The ChildLyric object to add.
     */
    protected function doAddLyricRelatedByArtist4(ChildLyric $lyricRelatedByArtist4)
    {
        $this->collLyricsRelatedByArtist4[]= $lyricRelatedByArtist4;
        $lyricRelatedByArtist4->setArtistRelatedByArtist4($this);
    }

    /**
     * @param  ChildLyric $lyricRelatedByArtist4 The ChildLyric object to remove.
     * @return $this|ChildArtist The current object (for fluent API support)
     */
    public function removeLyricRelatedByArtist4(ChildLyric $lyricRelatedByArtist4)
    {
        if ($this->getLyricsRelatedByArtist4()->contains($lyricRelatedByArtist4)) {
            $pos = $this->collLyricsRelatedByArtist4->search($lyricRelatedByArtist4);
            $this->collLyricsRelatedByArtist4->remove($pos);
            if (null === $this->lyricsRelatedByArtist4ScheduledForDeletion) {
                $this->lyricsRelatedByArtist4ScheduledForDeletion = clone $this->collLyricsRelatedByArtist4;
                $this->lyricsRelatedByArtist4ScheduledForDeletion->clear();
            }
            $this->lyricsRelatedByArtist4ScheduledForDeletion[]= $lyricRelatedByArtist4;
            $lyricRelatedByArtist4->setArtistRelatedByArtist4(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Artist is new, it will return
     * an empty collection; or if this Artist has previously
     * been saved, it will retrieve related LyricsRelatedByArtist4 from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Artist.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildLyric[] List of ChildLyric objects
     */
    public function getLyricsRelatedByArtist4JoinUsers(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildLyricQuery::create(null, $criteria);
        $query->joinWith('Users', $joinBehavior);

        return $this->getLyricsRelatedByArtist4($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Artist is new, it will return
     * an empty collection; or if this Artist has previously
     * been saved, it will retrieve related LyricsRelatedByArtist4 from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Artist.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildLyric[] List of ChildLyric objects
     */
    public function getLyricsRelatedByArtist4JoinLanguages(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildLyricQuery::create(null, $criteria);
        $query->joinWith('Languages', $joinBehavior);

        return $this->getLyricsRelatedByArtist4($query, $con);
    }

    /**
     * Clears out the collLyricsRelatedByArtist5 collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addLyricsRelatedByArtist5()
     */
    public function clearLyricsRelatedByArtist5()
    {
        $this->collLyricsRelatedByArtist5 = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collLyricsRelatedByArtist5 collection loaded partially.
     */
    public function resetPartialLyricsRelatedByArtist5($v = true)
    {
        $this->collLyricsRelatedByArtist5Partial = $v;
    }

    /**
     * Initializes the collLyricsRelatedByArtist5 collection.
     *
     * By default this just sets the collLyricsRelatedByArtist5 collection to an empty array (like clearcollLyricsRelatedByArtist5());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initLyricsRelatedByArtist5($overrideExisting = true)
    {
        if (null !== $this->collLyricsRelatedByArtist5 && !$overrideExisting) {
            return;
        }
        $this->collLyricsRelatedByArtist5 = new ObjectCollection();
        $this->collLyricsRelatedByArtist5->setModel('\Tekstove\TekstoveBundle\Model\Entity\Lyric');
    }

    /**
     * Gets an array of ChildLyric objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildArtist is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildLyric[] List of ChildLyric objects
     * @throws PropelException
     */
    public function getLyricsRelatedByArtist5(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collLyricsRelatedByArtist5Partial && !$this->isNew();
        if (null === $this->collLyricsRelatedByArtist5 || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collLyricsRelatedByArtist5) {
                // return empty collection
                $this->initLyricsRelatedByArtist5();
            } else {
                $collLyricsRelatedByArtist5 = ChildLyricQuery::create(null, $criteria)
                    ->filterByArtistRelatedByArtist5($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collLyricsRelatedByArtist5Partial && count($collLyricsRelatedByArtist5)) {
                        $this->initLyricsRelatedByArtist5(false);

                        foreach ($collLyricsRelatedByArtist5 as $obj) {
                            if (false == $this->collLyricsRelatedByArtist5->contains($obj)) {
                                $this->collLyricsRelatedByArtist5->append($obj);
                            }
                        }

                        $this->collLyricsRelatedByArtist5Partial = true;
                    }

                    return $collLyricsRelatedByArtist5;
                }

                if ($partial && $this->collLyricsRelatedByArtist5) {
                    foreach ($this->collLyricsRelatedByArtist5 as $obj) {
                        if ($obj->isNew()) {
                            $collLyricsRelatedByArtist5[] = $obj;
                        }
                    }
                }

                $this->collLyricsRelatedByArtist5 = $collLyricsRelatedByArtist5;
                $this->collLyricsRelatedByArtist5Partial = false;
            }
        }

        return $this->collLyricsRelatedByArtist5;
    }

    /**
     * Sets a collection of ChildLyric objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $lyricsRelatedByArtist5 A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildArtist The current object (for fluent API support)
     */
    public function setLyricsRelatedByArtist5(Collection $lyricsRelatedByArtist5, ConnectionInterface $con = null)
    {
        /** @var ChildLyric[] $lyricsRelatedByArtist5ToDelete */
        $lyricsRelatedByArtist5ToDelete = $this->getLyricsRelatedByArtist5(new Criteria(), $con)->diff($lyricsRelatedByArtist5);


        $this->lyricsRelatedByArtist5ScheduledForDeletion = $lyricsRelatedByArtist5ToDelete;

        foreach ($lyricsRelatedByArtist5ToDelete as $lyricRelatedByArtist5Removed) {
            $lyricRelatedByArtist5Removed->setArtistRelatedByArtist5(null);
        }

        $this->collLyricsRelatedByArtist5 = null;
        foreach ($lyricsRelatedByArtist5 as $lyricRelatedByArtist5) {
            $this->addLyricRelatedByArtist5($lyricRelatedByArtist5);
        }

        $this->collLyricsRelatedByArtist5 = $lyricsRelatedByArtist5;
        $this->collLyricsRelatedByArtist5Partial = false;

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
    public function countLyricsRelatedByArtist5(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collLyricsRelatedByArtist5Partial && !$this->isNew();
        if (null === $this->collLyricsRelatedByArtist5 || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collLyricsRelatedByArtist5) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getLyricsRelatedByArtist5());
            }

            $query = ChildLyricQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByArtistRelatedByArtist5($this)
                ->count($con);
        }

        return count($this->collLyricsRelatedByArtist5);
    }

    /**
     * Method called to associate a ChildLyric object to this object
     * through the ChildLyric foreign key attribute.
     *
     * @param  ChildLyric $l ChildLyric
     * @return $this|\Tekstove\TekstoveBundle\Model\Entity\Artist The current object (for fluent API support)
     */
    public function addLyricRelatedByArtist5(ChildLyric $l)
    {
        if ($this->collLyricsRelatedByArtist5 === null) {
            $this->initLyricsRelatedByArtist5();
            $this->collLyricsRelatedByArtist5Partial = true;
        }

        if (!$this->collLyricsRelatedByArtist5->contains($l)) {
            $this->doAddLyricRelatedByArtist5($l);
        }

        return $this;
    }

    /**
     * @param ChildLyric $lyricRelatedByArtist5 The ChildLyric object to add.
     */
    protected function doAddLyricRelatedByArtist5(ChildLyric $lyricRelatedByArtist5)
    {
        $this->collLyricsRelatedByArtist5[]= $lyricRelatedByArtist5;
        $lyricRelatedByArtist5->setArtistRelatedByArtist5($this);
    }

    /**
     * @param  ChildLyric $lyricRelatedByArtist5 The ChildLyric object to remove.
     * @return $this|ChildArtist The current object (for fluent API support)
     */
    public function removeLyricRelatedByArtist5(ChildLyric $lyricRelatedByArtist5)
    {
        if ($this->getLyricsRelatedByArtist5()->contains($lyricRelatedByArtist5)) {
            $pos = $this->collLyricsRelatedByArtist5->search($lyricRelatedByArtist5);
            $this->collLyricsRelatedByArtist5->remove($pos);
            if (null === $this->lyricsRelatedByArtist5ScheduledForDeletion) {
                $this->lyricsRelatedByArtist5ScheduledForDeletion = clone $this->collLyricsRelatedByArtist5;
                $this->lyricsRelatedByArtist5ScheduledForDeletion->clear();
            }
            $this->lyricsRelatedByArtist5ScheduledForDeletion[]= $lyricRelatedByArtist5;
            $lyricRelatedByArtist5->setArtistRelatedByArtist5(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Artist is new, it will return
     * an empty collection; or if this Artist has previously
     * been saved, it will retrieve related LyricsRelatedByArtist5 from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Artist.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildLyric[] List of ChildLyric objects
     */
    public function getLyricsRelatedByArtist5JoinUsers(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildLyricQuery::create(null, $criteria);
        $query->joinWith('Users', $joinBehavior);

        return $this->getLyricsRelatedByArtist5($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Artist is new, it will return
     * an empty collection; or if this Artist has previously
     * been saved, it will retrieve related LyricsRelatedByArtist5 from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Artist.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildLyric[] List of ChildLyric objects
     */
    public function getLyricsRelatedByArtist5JoinLanguages(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildLyricQuery::create(null, $criteria);
        $query->joinWith('Languages', $joinBehavior);

        return $this->getLyricsRelatedByArtist5($query, $con);
    }

    /**
     * Clears out the collLyricsRelatedByArtist6 collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addLyricsRelatedByArtist6()
     */
    public function clearLyricsRelatedByArtist6()
    {
        $this->collLyricsRelatedByArtist6 = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collLyricsRelatedByArtist6 collection loaded partially.
     */
    public function resetPartialLyricsRelatedByArtist6($v = true)
    {
        $this->collLyricsRelatedByArtist6Partial = $v;
    }

    /**
     * Initializes the collLyricsRelatedByArtist6 collection.
     *
     * By default this just sets the collLyricsRelatedByArtist6 collection to an empty array (like clearcollLyricsRelatedByArtist6());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initLyricsRelatedByArtist6($overrideExisting = true)
    {
        if (null !== $this->collLyricsRelatedByArtist6 && !$overrideExisting) {
            return;
        }
        $this->collLyricsRelatedByArtist6 = new ObjectCollection();
        $this->collLyricsRelatedByArtist6->setModel('\Tekstove\TekstoveBundle\Model\Entity\Lyric');
    }

    /**
     * Gets an array of ChildLyric objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildArtist is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildLyric[] List of ChildLyric objects
     * @throws PropelException
     */
    public function getLyricsRelatedByArtist6(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collLyricsRelatedByArtist6Partial && !$this->isNew();
        if (null === $this->collLyricsRelatedByArtist6 || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collLyricsRelatedByArtist6) {
                // return empty collection
                $this->initLyricsRelatedByArtist6();
            } else {
                $collLyricsRelatedByArtist6 = ChildLyricQuery::create(null, $criteria)
                    ->filterByArtistRelatedByArtist6($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collLyricsRelatedByArtist6Partial && count($collLyricsRelatedByArtist6)) {
                        $this->initLyricsRelatedByArtist6(false);

                        foreach ($collLyricsRelatedByArtist6 as $obj) {
                            if (false == $this->collLyricsRelatedByArtist6->contains($obj)) {
                                $this->collLyricsRelatedByArtist6->append($obj);
                            }
                        }

                        $this->collLyricsRelatedByArtist6Partial = true;
                    }

                    return $collLyricsRelatedByArtist6;
                }

                if ($partial && $this->collLyricsRelatedByArtist6) {
                    foreach ($this->collLyricsRelatedByArtist6 as $obj) {
                        if ($obj->isNew()) {
                            $collLyricsRelatedByArtist6[] = $obj;
                        }
                    }
                }

                $this->collLyricsRelatedByArtist6 = $collLyricsRelatedByArtist6;
                $this->collLyricsRelatedByArtist6Partial = false;
            }
        }

        return $this->collLyricsRelatedByArtist6;
    }

    /**
     * Sets a collection of ChildLyric objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $lyricsRelatedByArtist6 A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildArtist The current object (for fluent API support)
     */
    public function setLyricsRelatedByArtist6(Collection $lyricsRelatedByArtist6, ConnectionInterface $con = null)
    {
        /** @var ChildLyric[] $lyricsRelatedByArtist6ToDelete */
        $lyricsRelatedByArtist6ToDelete = $this->getLyricsRelatedByArtist6(new Criteria(), $con)->diff($lyricsRelatedByArtist6);


        $this->lyricsRelatedByArtist6ScheduledForDeletion = $lyricsRelatedByArtist6ToDelete;

        foreach ($lyricsRelatedByArtist6ToDelete as $lyricRelatedByArtist6Removed) {
            $lyricRelatedByArtist6Removed->setArtistRelatedByArtist6(null);
        }

        $this->collLyricsRelatedByArtist6 = null;
        foreach ($lyricsRelatedByArtist6 as $lyricRelatedByArtist6) {
            $this->addLyricRelatedByArtist6($lyricRelatedByArtist6);
        }

        $this->collLyricsRelatedByArtist6 = $lyricsRelatedByArtist6;
        $this->collLyricsRelatedByArtist6Partial = false;

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
    public function countLyricsRelatedByArtist6(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collLyricsRelatedByArtist6Partial && !$this->isNew();
        if (null === $this->collLyricsRelatedByArtist6 || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collLyricsRelatedByArtist6) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getLyricsRelatedByArtist6());
            }

            $query = ChildLyricQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByArtistRelatedByArtist6($this)
                ->count($con);
        }

        return count($this->collLyricsRelatedByArtist6);
    }

    /**
     * Method called to associate a ChildLyric object to this object
     * through the ChildLyric foreign key attribute.
     *
     * @param  ChildLyric $l ChildLyric
     * @return $this|\Tekstove\TekstoveBundle\Model\Entity\Artist The current object (for fluent API support)
     */
    public function addLyricRelatedByArtist6(ChildLyric $l)
    {
        if ($this->collLyricsRelatedByArtist6 === null) {
            $this->initLyricsRelatedByArtist6();
            $this->collLyricsRelatedByArtist6Partial = true;
        }

        if (!$this->collLyricsRelatedByArtist6->contains($l)) {
            $this->doAddLyricRelatedByArtist6($l);
        }

        return $this;
    }

    /**
     * @param ChildLyric $lyricRelatedByArtist6 The ChildLyric object to add.
     */
    protected function doAddLyricRelatedByArtist6(ChildLyric $lyricRelatedByArtist6)
    {
        $this->collLyricsRelatedByArtist6[]= $lyricRelatedByArtist6;
        $lyricRelatedByArtist6->setArtistRelatedByArtist6($this);
    }

    /**
     * @param  ChildLyric $lyricRelatedByArtist6 The ChildLyric object to remove.
     * @return $this|ChildArtist The current object (for fluent API support)
     */
    public function removeLyricRelatedByArtist6(ChildLyric $lyricRelatedByArtist6)
    {
        if ($this->getLyricsRelatedByArtist6()->contains($lyricRelatedByArtist6)) {
            $pos = $this->collLyricsRelatedByArtist6->search($lyricRelatedByArtist6);
            $this->collLyricsRelatedByArtist6->remove($pos);
            if (null === $this->lyricsRelatedByArtist6ScheduledForDeletion) {
                $this->lyricsRelatedByArtist6ScheduledForDeletion = clone $this->collLyricsRelatedByArtist6;
                $this->lyricsRelatedByArtist6ScheduledForDeletion->clear();
            }
            $this->lyricsRelatedByArtist6ScheduledForDeletion[]= clone $lyricRelatedByArtist6;
            $lyricRelatedByArtist6->setArtistRelatedByArtist6(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Artist is new, it will return
     * an empty collection; or if this Artist has previously
     * been saved, it will retrieve related LyricsRelatedByArtist6 from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Artist.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildLyric[] List of ChildLyric objects
     */
    public function getLyricsRelatedByArtist6JoinUsers(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildLyricQuery::create(null, $criteria);
        $query->joinWith('Users', $joinBehavior);

        return $this->getLyricsRelatedByArtist6($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Artist is new, it will return
     * an empty collection; or if this Artist has previously
     * been saved, it will retrieve related LyricsRelatedByArtist6 from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Artist.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildLyric[] List of ChildLyric objects
     */
    public function getLyricsRelatedByArtist6JoinLanguages(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildLyricQuery::create(null, $criteria);
        $query->joinWith('Languages', $joinBehavior);

        return $this->getLyricsRelatedByArtist6($query, $con);
    }

    /**
     * Clears the current object, sets all attributes to their default values and removes
     * outgoing references as well as back-references (from other objects to this one. Results probably in a database
     * change of those foreign objects when you call `save` there).
     */
    public function clear()
    {
        $this->name = null;
        $this->name_alternatives = null;
        $this->addedby = null;
        $this->id = null;
        $this->redirect_to_artist_id = null;
        $this->forbidden = null;
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
            if ($this->collTodays) {
                foreach ($this->collTodays as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collLyricsRelatedByArtist1) {
                foreach ($this->collLyricsRelatedByArtist1 as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collLyricsRelatedByArtist2) {
                foreach ($this->collLyricsRelatedByArtist2 as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collLyricsRelatedByArtist3) {
                foreach ($this->collLyricsRelatedByArtist3 as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collLyricsRelatedByArtist4) {
                foreach ($this->collLyricsRelatedByArtist4 as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collLyricsRelatedByArtist5) {
                foreach ($this->collLyricsRelatedByArtist5 as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collLyricsRelatedByArtist6) {
                foreach ($this->collLyricsRelatedByArtist6 as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collTodays = null;
        $this->collLyricsRelatedByArtist1 = null;
        $this->collLyricsRelatedByArtist2 = null;
        $this->collLyricsRelatedByArtist3 = null;
        $this->collLyricsRelatedByArtist4 = null;
        $this->collLyricsRelatedByArtist5 = null;
        $this->collLyricsRelatedByArtist6 = null;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(ArtistTableMap::DEFAULT_STRING_FORMAT);
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
