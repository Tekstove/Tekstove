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
use Tekstove\TekstoveBundle\Model\Language as ChildLanguage;
use Tekstove\TekstoveBundle\Model\LanguageQuery as ChildLanguageQuery;
use Tekstove\TekstoveBundle\Model\Lyric as ChildLyric;
use Tekstove\TekstoveBundle\Model\LyricLanguage as ChildLyricLanguage;
use Tekstove\TekstoveBundle\Model\LyricLanguageQuery as ChildLyricLanguageQuery;
use Tekstove\TekstoveBundle\Model\LyricQuery as ChildLyricQuery;
use Tekstove\TekstoveBundle\Model\LyricVote as ChildLyricVote;
use Tekstove\TekstoveBundle\Model\LyricVoteQuery as ChildLyricVoteQuery;
use Tekstove\TekstoveBundle\Model\Map\LyricTableMap;

/**
 * Base class that represents a row from the 'lyric' table.
 *
 *
 *
* @package    propel.generator.src.Tekstove.TekstoveBundle.Model.Base
*/
abstract class Lyric implements ActiveRecordInterface
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\Tekstove\\TekstoveBundle\\Model\\Map\\LyricTableMap';


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
     * The value for the title field.
     *
     * @var        string
     */
    protected $title;

    /**
     * The value for the text field.
     *
     * @var        string
     */
    protected $text;

    /**
     * The value for the text_bg field.
     *
     * @var        string
     */
    protected $text_bg;

    /**
     * The value for the cache_title_short field.
     *
     * @var        string
     */
    protected $cache_title_short;

    /**
     * The value for the views field.
     *
     * @var        int
     */
    protected $views;

    /**
     * The value for the popularity field.
     *
     * @var        int
     */
    protected $popularity;

    /**
     * @var        ObjectCollection|ChildLyricLanguage[] Collection to store aggregation of ChildLyricLanguage objects.
     */
    protected $collLyricLanguages;
    protected $collLyricLanguagesPartial;

    /**
     * @var        ObjectCollection|ChildLyricVote[] Collection to store aggregation of ChildLyricVote objects.
     */
    protected $collLyricVotes;
    protected $collLyricVotesPartial;

    /**
     * @var        ObjectCollection|ChildLanguage[] Cross Collection to store aggregation of ChildLanguage objects.
     */
    protected $collLanguages;

    /**
     * @var bool
     */
    protected $collLanguagesPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var boolean
     */
    protected $alreadyInSave = false;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildLanguage[]
     */
    protected $languagesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildLyricLanguage[]
     */
    protected $lyricLanguagesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildLyricVote[]
     */
    protected $lyricVotesScheduledForDeletion = null;

    /**
     * Initializes internal state of Tekstove\TekstoveBundle\Model\Base\Lyric object.
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
     * Compares this with another <code>Lyric</code> instance.  If
     * <code>obj</code> is an instance of <code>Lyric</code>, delegates to
     * <code>equals(Lyric)</code>.  Otherwise, returns <code>false</code>.
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
     * @return $this|Lyric The current object, for fluid interface
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
     * Get the [title] column value.
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Get the [text] column value.
     *
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * Get the [text_bg] column value.
     *
     * @return string
     */
    public function gettextBg()
    {
        return $this->text_bg;
    }

    /**
     * Get the [cache_title_short] column value.
     *
     * @return string
     */
    public function getcacheTitleShort()
    {
        return $this->cache_title_short;
    }

    /**
     * Get the [views] column value.
     *
     * @return int
     */
    public function getViews()
    {
        return $this->views;
    }

    /**
     * Get the [popularity] column value.
     *
     * @return int
     */
    public function getPopularity()
    {
        return $this->popularity;
    }

    /**
     * Set the value of [id] column.
     *
     * @param int $v new value
     * @return $this|\Tekstove\TekstoveBundle\Model\Lyric The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[LyricTableMap::COL_ID] = true;
        }

        return $this;
    } // setId()

    /**
     * Set the value of [title] column.
     *
     * @param string $v new value
     * @return $this|\Tekstove\TekstoveBundle\Model\Lyric The current object (for fluent API support)
     */
    public function setTitle($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->title !== $v) {
            $this->title = $v;
            $this->modifiedColumns[LyricTableMap::COL_TITLE] = true;
        }

        return $this;
    } // setTitle()

    /**
     * Set the value of [text] column.
     *
     * @param string $v new value
     * @return $this|\Tekstove\TekstoveBundle\Model\Lyric The current object (for fluent API support)
     */
    public function setText($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->text !== $v) {
            $this->text = $v;
            $this->modifiedColumns[LyricTableMap::COL_TEXT] = true;
        }

        return $this;
    } // setText()

    /**
     * Set the value of [text_bg] column.
     *
     * @param string $v new value
     * @return $this|\Tekstove\TekstoveBundle\Model\Lyric The current object (for fluent API support)
     */
    public function settextBg($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->text_bg !== $v) {
            $this->text_bg = $v;
            $this->modifiedColumns[LyricTableMap::COL_TEXT_BG] = true;
        }

        return $this;
    } // settextBg()

    /**
     * Set the value of [cache_title_short] column.
     *
     * @param string $v new value
     * @return $this|\Tekstove\TekstoveBundle\Model\Lyric The current object (for fluent API support)
     */
    public function setcacheTitleShort($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->cache_title_short !== $v) {
            $this->cache_title_short = $v;
            $this->modifiedColumns[LyricTableMap::COL_CACHE_TITLE_SHORT] = true;
        }

        return $this;
    } // setcacheTitleShort()

    /**
     * Set the value of [views] column.
     *
     * @param int $v new value
     * @return $this|\Tekstove\TekstoveBundle\Model\Lyric The current object (for fluent API support)
     */
    public function setViews($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->views !== $v) {
            $this->views = $v;
            $this->modifiedColumns[LyricTableMap::COL_VIEWS] = true;
        }

        return $this;
    } // setViews()

    /**
     * Set the value of [popularity] column.
     *
     * @param int $v new value
     * @return $this|\Tekstove\TekstoveBundle\Model\Lyric The current object (for fluent API support)
     */
    public function setPopularity($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->popularity !== $v) {
            $this->popularity = $v;
            $this->modifiedColumns[LyricTableMap::COL_POPULARITY] = true;
        }

        return $this;
    } // setPopularity()

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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : LyricTableMap::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : LyricTableMap::translateFieldName('Title', TableMap::TYPE_PHPNAME, $indexType)];
            $this->title = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : LyricTableMap::translateFieldName('Text', TableMap::TYPE_PHPNAME, $indexType)];
            $this->text = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : LyricTableMap::translateFieldName('textBg', TableMap::TYPE_PHPNAME, $indexType)];
            $this->text_bg = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : LyricTableMap::translateFieldName('cacheTitleShort', TableMap::TYPE_PHPNAME, $indexType)];
            $this->cache_title_short = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : LyricTableMap::translateFieldName('Views', TableMap::TYPE_PHPNAME, $indexType)];
            $this->views = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : LyricTableMap::translateFieldName('Popularity', TableMap::TYPE_PHPNAME, $indexType)];
            $this->popularity = (null !== $col) ? (int) $col : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 7; // 7 = LyricTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\Tekstove\\TekstoveBundle\\Model\\Lyric'), 0, $e);
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
            $con = Propel::getServiceContainer()->getReadConnection(LyricTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildLyricQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->collLyricLanguages = null;

            $this->collLyricVotes = null;

            $this->collLanguages = null;
        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see Lyric::setDeleted()
     * @see Lyric::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(LyricTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildLyricQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(LyricTableMap::DATABASE_NAME);
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
                LyricTableMap::addInstanceToPool($this);
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

            if ($this->languagesScheduledForDeletion !== null) {
                if (!$this->languagesScheduledForDeletion->isEmpty()) {
                    $pks = array();
                    foreach ($this->languagesScheduledForDeletion as $entry) {
                        $entryPk = [];

                        $entryPk[0] = $this->getId();
                        $entryPk[1] = $entry->getId();
                        $pks[] = $entryPk;
                    }

                    \Tekstove\TekstoveBundle\Model\LyricLanguageQuery::create()
                        ->filterByPrimaryKeys($pks)
                        ->delete($con);

                    $this->languagesScheduledForDeletion = null;
                }

            }

            if ($this->collLanguages) {
                foreach ($this->collLanguages as $language) {
                    if (!$language->isDeleted() && ($language->isNew() || $language->isModified())) {
                        $language->save($con);
                    }
                }
            }


            if ($this->lyricLanguagesScheduledForDeletion !== null) {
                if (!$this->lyricLanguagesScheduledForDeletion->isEmpty()) {
                    \Tekstove\TekstoveBundle\Model\LyricLanguageQuery::create()
                        ->filterByPrimaryKeys($this->lyricLanguagesScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->lyricLanguagesScheduledForDeletion = null;
                }
            }

            if ($this->collLyricLanguages !== null) {
                foreach ($this->collLyricLanguages as $referrerFK) {
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

        $this->modifiedColumns[LyricTableMap::COL_ID] = true;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . LyricTableMap::COL_ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(LyricTableMap::COL_ID)) {
            $modifiedColumns[':p' . $index++]  = 'id';
        }
        if ($this->isColumnModified(LyricTableMap::COL_TITLE)) {
            $modifiedColumns[':p' . $index++]  = 'title';
        }
        if ($this->isColumnModified(LyricTableMap::COL_TEXT)) {
            $modifiedColumns[':p' . $index++]  = 'text';
        }
        if ($this->isColumnModified(LyricTableMap::COL_TEXT_BG)) {
            $modifiedColumns[':p' . $index++]  = 'text_bg';
        }
        if ($this->isColumnModified(LyricTableMap::COL_CACHE_TITLE_SHORT)) {
            $modifiedColumns[':p' . $index++]  = 'cache_title_short';
        }
        if ($this->isColumnModified(LyricTableMap::COL_VIEWS)) {
            $modifiedColumns[':p' . $index++]  = 'views';
        }
        if ($this->isColumnModified(LyricTableMap::COL_POPULARITY)) {
            $modifiedColumns[':p' . $index++]  = 'popularity';
        }

        $sql = sprintf(
            'INSERT INTO lyric (%s) VALUES (%s)',
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
                    case 'title':
                        $stmt->bindValue($identifier, $this->title, PDO::PARAM_STR);
                        break;
                    case 'text':
                        $stmt->bindValue($identifier, $this->text, PDO::PARAM_STR);
                        break;
                    case 'text_bg':
                        $stmt->bindValue($identifier, $this->text_bg, PDO::PARAM_STR);
                        break;
                    case 'cache_title_short':
                        $stmt->bindValue($identifier, $this->cache_title_short, PDO::PARAM_STR);
                        break;
                    case 'views':
                        $stmt->bindValue($identifier, $this->views, PDO::PARAM_INT);
                        break;
                    case 'popularity':
                        $stmt->bindValue($identifier, $this->popularity, PDO::PARAM_INT);
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
        $pos = LyricTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getTitle();
                break;
            case 2:
                return $this->getText();
                break;
            case 3:
                return $this->gettextBg();
                break;
            case 4:
                return $this->getcacheTitleShort();
                break;
            case 5:
                return $this->getViews();
                break;
            case 6:
                return $this->getPopularity();
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

        if (isset($alreadyDumpedObjects['Lyric'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Lyric'][$this->hashCode()] = true;
        $keys = LyricTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getTitle(),
            $keys[2] => $this->getText(),
            $keys[3] => $this->gettextBg(),
            $keys[4] => $this->getcacheTitleShort(),
            $keys[5] => $this->getViews(),
            $keys[6] => $this->getPopularity(),
        );
        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->collLyricLanguages) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'lyricLanguages';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'lyric_languages';
                        break;
                    default:
                        $key = 'LyricLanguages';
                }

                $result[$key] = $this->collLyricLanguages->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
     * @return $this|\Tekstove\TekstoveBundle\Model\Lyric
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = LyricTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\Tekstove\TekstoveBundle\Model\Lyric
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setId($value);
                break;
            case 1:
                $this->setTitle($value);
                break;
            case 2:
                $this->setText($value);
                break;
            case 3:
                $this->settextBg($value);
                break;
            case 4:
                $this->setcacheTitleShort($value);
                break;
            case 5:
                $this->setViews($value);
                break;
            case 6:
                $this->setPopularity($value);
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
        $keys = LyricTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setId($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setTitle($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setText($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->settextBg($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setcacheTitleShort($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setViews($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setPopularity($arr[$keys[6]]);
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
     * @return $this|\Tekstove\TekstoveBundle\Model\Lyric The current object, for fluid interface
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
        $criteria = new Criteria(LyricTableMap::DATABASE_NAME);

        if ($this->isColumnModified(LyricTableMap::COL_ID)) {
            $criteria->add(LyricTableMap::COL_ID, $this->id);
        }
        if ($this->isColumnModified(LyricTableMap::COL_TITLE)) {
            $criteria->add(LyricTableMap::COL_TITLE, $this->title);
        }
        if ($this->isColumnModified(LyricTableMap::COL_TEXT)) {
            $criteria->add(LyricTableMap::COL_TEXT, $this->text);
        }
        if ($this->isColumnModified(LyricTableMap::COL_TEXT_BG)) {
            $criteria->add(LyricTableMap::COL_TEXT_BG, $this->text_bg);
        }
        if ($this->isColumnModified(LyricTableMap::COL_CACHE_TITLE_SHORT)) {
            $criteria->add(LyricTableMap::COL_CACHE_TITLE_SHORT, $this->cache_title_short);
        }
        if ($this->isColumnModified(LyricTableMap::COL_VIEWS)) {
            $criteria->add(LyricTableMap::COL_VIEWS, $this->views);
        }
        if ($this->isColumnModified(LyricTableMap::COL_POPULARITY)) {
            $criteria->add(LyricTableMap::COL_POPULARITY, $this->popularity);
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
        $criteria = ChildLyricQuery::create();
        $criteria->add(LyricTableMap::COL_ID, $this->id);

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
     * @param      object $copyObj An object of \Tekstove\TekstoveBundle\Model\Lyric (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setTitle($this->getTitle());
        $copyObj->setText($this->getText());
        $copyObj->settextBg($this->gettextBg());
        $copyObj->setcacheTitleShort($this->getcacheTitleShort());
        $copyObj->setViews($this->getViews());
        $copyObj->setPopularity($this->getPopularity());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getLyricLanguages() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addLyricLanguage($relObj->copy($deepCopy));
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
     * @return \Tekstove\TekstoveBundle\Model\Lyric Clone of current object.
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
        if ('LyricLanguage' == $relationName) {
            return $this->initLyricLanguages();
        }
        if ('LyricVote' == $relationName) {
            return $this->initLyricVotes();
        }
    }

    /**
     * Clears out the collLyricLanguages collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addLyricLanguages()
     */
    public function clearLyricLanguages()
    {
        $this->collLyricLanguages = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collLyricLanguages collection loaded partially.
     */
    public function resetPartialLyricLanguages($v = true)
    {
        $this->collLyricLanguagesPartial = $v;
    }

    /**
     * Initializes the collLyricLanguages collection.
     *
     * By default this just sets the collLyricLanguages collection to an empty array (like clearcollLyricLanguages());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initLyricLanguages($overrideExisting = true)
    {
        if (null !== $this->collLyricLanguages && !$overrideExisting) {
            return;
        }
        $this->collLyricLanguages = new ObjectCollection();
        $this->collLyricLanguages->setModel('\Tekstove\TekstoveBundle\Model\LyricLanguage');
    }

    /**
     * Gets an array of ChildLyricLanguage objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildLyric is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildLyricLanguage[] List of ChildLyricLanguage objects
     * @throws PropelException
     */
    public function getLyricLanguages(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collLyricLanguagesPartial && !$this->isNew();
        if (null === $this->collLyricLanguages || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collLyricLanguages) {
                // return empty collection
                $this->initLyricLanguages();
            } else {
                $collLyricLanguages = ChildLyricLanguageQuery::create(null, $criteria)
                    ->filterByLyric($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collLyricLanguagesPartial && count($collLyricLanguages)) {
                        $this->initLyricLanguages(false);

                        foreach ($collLyricLanguages as $obj) {
                            if (false == $this->collLyricLanguages->contains($obj)) {
                                $this->collLyricLanguages->append($obj);
                            }
                        }

                        $this->collLyricLanguagesPartial = true;
                    }

                    return $collLyricLanguages;
                }

                if ($partial && $this->collLyricLanguages) {
                    foreach ($this->collLyricLanguages as $obj) {
                        if ($obj->isNew()) {
                            $collLyricLanguages[] = $obj;
                        }
                    }
                }

                $this->collLyricLanguages = $collLyricLanguages;
                $this->collLyricLanguagesPartial = false;
            }
        }

        return $this->collLyricLanguages;
    }

    /**
     * Sets a collection of ChildLyricLanguage objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $lyricLanguages A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildLyric The current object (for fluent API support)
     */
    public function setLyricLanguages(Collection $lyricLanguages, ConnectionInterface $con = null)
    {
        /** @var ChildLyricLanguage[] $lyricLanguagesToDelete */
        $lyricLanguagesToDelete = $this->getLyricLanguages(new Criteria(), $con)->diff($lyricLanguages);


        //since at least one column in the foreign key is at the same time a PK
        //we can not just set a PK to NULL in the lines below. We have to store
        //a backup of all values, so we are able to manipulate these items based on the onDelete value later.
        $this->lyricLanguagesScheduledForDeletion = clone $lyricLanguagesToDelete;

        foreach ($lyricLanguagesToDelete as $lyricLanguageRemoved) {
            $lyricLanguageRemoved->setLyric(null);
        }

        $this->collLyricLanguages = null;
        foreach ($lyricLanguages as $lyricLanguage) {
            $this->addLyricLanguage($lyricLanguage);
        }

        $this->collLyricLanguages = $lyricLanguages;
        $this->collLyricLanguagesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related LyricLanguage objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related LyricLanguage objects.
     * @throws PropelException
     */
    public function countLyricLanguages(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collLyricLanguagesPartial && !$this->isNew();
        if (null === $this->collLyricLanguages || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collLyricLanguages) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getLyricLanguages());
            }

            $query = ChildLyricLanguageQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByLyric($this)
                ->count($con);
        }

        return count($this->collLyricLanguages);
    }

    /**
     * Method called to associate a ChildLyricLanguage object to this object
     * through the ChildLyricLanguage foreign key attribute.
     *
     * @param  ChildLyricLanguage $l ChildLyricLanguage
     * @return $this|\Tekstove\TekstoveBundle\Model\Lyric The current object (for fluent API support)
     */
    public function addLyricLanguage(ChildLyricLanguage $l)
    {
        if ($this->collLyricLanguages === null) {
            $this->initLyricLanguages();
            $this->collLyricLanguagesPartial = true;
        }

        if (!$this->collLyricLanguages->contains($l)) {
            $this->doAddLyricLanguage($l);
        }

        return $this;
    }

    /**
     * @param ChildLyricLanguage $lyricLanguage The ChildLyricLanguage object to add.
     */
    protected function doAddLyricLanguage(ChildLyricLanguage $lyricLanguage)
    {
        $this->collLyricLanguages[]= $lyricLanguage;
        $lyricLanguage->setLyric($this);
    }

    /**
     * @param  ChildLyricLanguage $lyricLanguage The ChildLyricLanguage object to remove.
     * @return $this|ChildLyric The current object (for fluent API support)
     */
    public function removeLyricLanguage(ChildLyricLanguage $lyricLanguage)
    {
        if ($this->getLyricLanguages()->contains($lyricLanguage)) {
            $pos = $this->collLyricLanguages->search($lyricLanguage);
            $this->collLyricLanguages->remove($pos);
            if (null === $this->lyricLanguagesScheduledForDeletion) {
                $this->lyricLanguagesScheduledForDeletion = clone $this->collLyricLanguages;
                $this->lyricLanguagesScheduledForDeletion->clear();
            }
            $this->lyricLanguagesScheduledForDeletion[]= clone $lyricLanguage;
            $lyricLanguage->setLyric(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Lyric is new, it will return
     * an empty collection; or if this Lyric has previously
     * been saved, it will retrieve related LyricLanguages from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Lyric.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildLyricLanguage[] List of ChildLyricLanguage objects
     */
    public function getLyricLanguagesJoinLanguage(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildLyricLanguageQuery::create(null, $criteria);
        $query->joinWith('Language', $joinBehavior);

        return $this->getLyricLanguages($query, $con);
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
     * If this ChildLyric is new, it will return
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
                    ->filterByLyric($this)
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
     * @return $this|ChildLyric The current object (for fluent API support)
     */
    public function setLyricVotes(Collection $lyricVotes, ConnectionInterface $con = null)
    {
        /** @var ChildLyricVote[] $lyricVotesToDelete */
        $lyricVotesToDelete = $this->getLyricVotes(new Criteria(), $con)->diff($lyricVotes);


        $this->lyricVotesScheduledForDeletion = $lyricVotesToDelete;

        foreach ($lyricVotesToDelete as $lyricVoteRemoved) {
            $lyricVoteRemoved->setLyric(null);
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
                ->filterByLyric($this)
                ->count($con);
        }

        return count($this->collLyricVotes);
    }

    /**
     * Method called to associate a ChildLyricVote object to this object
     * through the ChildLyricVote foreign key attribute.
     *
     * @param  ChildLyricVote $l ChildLyricVote
     * @return $this|\Tekstove\TekstoveBundle\Model\Lyric The current object (for fluent API support)
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
        $lyricVote->setLyric($this);
    }

    /**
     * @param  ChildLyricVote $lyricVote The ChildLyricVote object to remove.
     * @return $this|ChildLyric The current object (for fluent API support)
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
            $lyricVote->setLyric(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Lyric is new, it will return
     * an empty collection; or if this Lyric has previously
     * been saved, it will retrieve related LyricVotes from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Lyric.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildLyricVote[] List of ChildLyricVote objects
     */
    public function getLyricVotesJoinUser(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildLyricVoteQuery::create(null, $criteria);
        $query->joinWith('User', $joinBehavior);

        return $this->getLyricVotes($query, $con);
    }

    /**
     * Clears out the collLanguages collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addLanguages()
     */
    public function clearLanguages()
    {
        $this->collLanguages = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Initializes the collLanguages crossRef collection.
     *
     * By default this just sets the collLanguages collection to an empty collection (like clearLanguages());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @return void
     */
    public function initLanguages()
    {
        $this->collLanguages = new ObjectCollection();
        $this->collLanguagesPartial = true;

        $this->collLanguages->setModel('\Tekstove\TekstoveBundle\Model\Language');
    }

    /**
     * Checks if the collLanguages collection is loaded.
     *
     * @return bool
     */
    public function isLanguagesLoaded()
    {
        return null !== $this->collLanguages;
    }

    /**
     * Gets a collection of ChildLanguage objects related by a many-to-many relationship
     * to the current object by way of the lyric_language cross-reference table.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildLyric is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria Optional query object to filter the query
     * @param      ConnectionInterface $con Optional connection object
     *
     * @return ObjectCollection|ChildLanguage[] List of ChildLanguage objects
     */
    public function getLanguages(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collLanguagesPartial && !$this->isNew();
        if (null === $this->collLanguages || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collLanguages) {
                    $this->initLanguages();
                }
            } else {

                $query = ChildLanguageQuery::create(null, $criteria)
                    ->filterByLyric($this);
                $collLanguages = $query->find($con);
                if (null !== $criteria) {
                    return $collLanguages;
                }

                if ($partial && $this->collLanguages) {
                    //make sure that already added objects gets added to the list of the database.
                    foreach ($this->collLanguages as $obj) {
                        if (!$collLanguages->contains($obj)) {
                            $collLanguages[] = $obj;
                        }
                    }
                }

                $this->collLanguages = $collLanguages;
                $this->collLanguagesPartial = false;
            }
        }

        return $this->collLanguages;
    }

    /**
     * Sets a collection of Language objects related by a many-to-many relationship
     * to the current object by way of the lyric_language cross-reference table.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param  Collection $languages A Propel collection.
     * @param  ConnectionInterface $con Optional connection object
     * @return $this|ChildLyric The current object (for fluent API support)
     */
    public function setLanguages(Collection $languages, ConnectionInterface $con = null)
    {
        $this->clearLanguages();
        $currentLanguages = $this->getLanguages();

        $languagesScheduledForDeletion = $currentLanguages->diff($languages);

        foreach ($languagesScheduledForDeletion as $toDelete) {
            $this->removeLanguage($toDelete);
        }

        foreach ($languages as $language) {
            if (!$currentLanguages->contains($language)) {
                $this->doAddLanguage($language);
            }
        }

        $this->collLanguagesPartial = false;
        $this->collLanguages = $languages;

        return $this;
    }

    /**
     * Gets the number of Language objects related by a many-to-many relationship
     * to the current object by way of the lyric_language cross-reference table.
     *
     * @param      Criteria $criteria Optional query object to filter the query
     * @param      boolean $distinct Set to true to force count distinct
     * @param      ConnectionInterface $con Optional connection object
     *
     * @return int the number of related Language objects
     */
    public function countLanguages(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collLanguagesPartial && !$this->isNew();
        if (null === $this->collLanguages || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collLanguages) {
                return 0;
            } else {

                if ($partial && !$criteria) {
                    return count($this->getLanguages());
                }

                $query = ChildLanguageQuery::create(null, $criteria);
                if ($distinct) {
                    $query->distinct();
                }

                return $query
                    ->filterByLyric($this)
                    ->count($con);
            }
        } else {
            return count($this->collLanguages);
        }
    }

    /**
     * Associate a ChildLanguage to this object
     * through the lyric_language cross reference table.
     *
     * @param ChildLanguage $language
     * @return ChildLyric The current object (for fluent API support)
     */
    public function addLanguage(ChildLanguage $language)
    {
        if ($this->collLanguages === null) {
            $this->initLanguages();
        }

        if (!$this->getLanguages()->contains($language)) {
            // only add it if the **same** object is not already associated
            $this->collLanguages->push($language);
            $this->doAddLanguage($language);
        }

        return $this;
    }

    /**
     *
     * @param ChildLanguage $language
     */
    protected function doAddLanguage(ChildLanguage $language)
    {
        $lyricLanguage = new ChildLyricLanguage();

        $lyricLanguage->setLanguage($language);

        $lyricLanguage->setLyric($this);

        $this->addLyricLanguage($lyricLanguage);

        // set the back reference to this object directly as using provided method either results
        // in endless loop or in multiple relations
        if (!$language->isLyricsLoaded()) {
            $language->initLyrics();
            $language->getLyrics()->push($this);
        } elseif (!$language->getLyrics()->contains($this)) {
            $language->getLyrics()->push($this);
        }

    }

    /**
     * Remove language of this object
     * through the lyric_language cross reference table.
     *
     * @param ChildLanguage $language
     * @return ChildLyric The current object (for fluent API support)
     */
    public function removeLanguage(ChildLanguage $language)
    {
        if ($this->getLanguages()->contains($language)) { $lyricLanguage = new ChildLyricLanguage();

            $lyricLanguage->setLanguage($language);
            if ($language->isLyricsLoaded()) {
                //remove the back reference if available
                $language->getLyrics()->removeObject($this);
            }

            $lyricLanguage->setLyric($this);
            $this->removeLyricLanguage(clone $lyricLanguage);
            $lyricLanguage->clear();

            $this->collLanguages->remove($this->collLanguages->search($language));

            if (null === $this->languagesScheduledForDeletion) {
                $this->languagesScheduledForDeletion = clone $this->collLanguages;
                $this->languagesScheduledForDeletion->clear();
            }

            $this->languagesScheduledForDeletion->push($language);
        }


        return $this;
    }

    /**
     * Clears the current object, sets all attributes to their default values and removes
     * outgoing references as well as back-references (from other objects to this one. Results probably in a database
     * change of those foreign objects when you call `save` there).
     */
    public function clear()
    {
        $this->id = null;
        $this->title = null;
        $this->text = null;
        $this->text_bg = null;
        $this->cache_title_short = null;
        $this->views = null;
        $this->popularity = null;
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
            if ($this->collLyricLanguages) {
                foreach ($this->collLyricLanguages as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collLyricVotes) {
                foreach ($this->collLyricVotes as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collLanguages) {
                foreach ($this->collLanguages as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collLyricLanguages = null;
        $this->collLyricVotes = null;
        $this->collLanguages = null;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(LyricTableMap::DEFAULT_STRING_FORMAT);
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
