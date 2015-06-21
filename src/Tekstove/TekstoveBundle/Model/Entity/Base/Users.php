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
use Tekstove\TekstoveBundle\Model\Entity\ChatOnline as ChildChatOnline;
use Tekstove\TekstoveBundle\Model\Entity\ChatOnlineQuery as ChildChatOnlineQuery;
use Tekstove\TekstoveBundle\Model\Entity\ForumTopicWatchers as ChildForumTopicWatchers;
use Tekstove\TekstoveBundle\Model\Entity\ForumTopicWatchersQuery as ChildForumTopicWatchersQuery;
use Tekstove\TekstoveBundle\Model\Entity\PermissionGroupUsers as ChildPermissionGroupUsers;
use Tekstove\TekstoveBundle\Model\Entity\PermissionGroupUsersQuery as ChildPermissionGroupUsersQuery;
use Tekstove\TekstoveBundle\Model\Entity\PermissionUsers as ChildPermissionUsers;
use Tekstove\TekstoveBundle\Model\Entity\PermissionUsersQuery as ChildPermissionUsersQuery;
use Tekstove\TekstoveBundle\Model\Entity\Prevodi as ChildPrevodi;
use Tekstove\TekstoveBundle\Model\Entity\PrevodiQuery as ChildPrevodiQuery;
use Tekstove\TekstoveBundle\Model\Entity\Users as ChildUsers;
use Tekstove\TekstoveBundle\Model\Entity\UsersQuery as ChildUsersQuery;
use Tekstove\TekstoveBundle\Model\Entity\Map\UsersTableMap;

/**
 * Base class that represents a row from the 'users' table.
 *
 *
 *
* @package    propel.generator.src.Tekstove.TekstoveBundle.Model.Entity.Base
*/
abstract class Users implements ActiveRecordInterface
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\Tekstove\\TekstoveBundle\\Model\\Entity\\Map\\UsersTableMap';


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
     * The value for the username field.
     * @var        string
     */
    protected $username;

    /**
     * The value for the password field.
     * @var        string
     */
    protected $password;

    /**
     * The value for the password_mod field.
     * @var        string
     */
    protected $password_mod;

    /**
     * The value for the password_mod_coockie field.
     * @var        string
     */
    protected $password_mod_coockie;

    /**
     * The value for the id field.
     * @var        int
     */
    protected $id;

    /**
     * The value for the mail field.
     * @var        string
     */
    protected $mail;

    /**
     * The value for the class field.
     * Note: this column has a database default value of: 0
     * @var        int
     */
    protected $class;

    /**
     * The value for the classcustomname field.
     * @var        string
     */
    protected $classcustomname;

    /**
     * The value for the avatar field.
     * @var        string
     */
    protected $avatar;

    /**
     * The value for the about field.
     * @var        string
     */
    protected $about;

    /**
     * The value for the reg_date field.
     * Note: this column has a database default value of: (expression) CURRENT_TIMESTAMP
     * @var        \DateTime
     */
    protected $reg_date;

    /**
     * The value for the pozdrav field.
     * @var        int
     */
    protected $pozdrav;

    /**
     * The value for the br_pesni field.
     * @var        int
     */
    protected $br_pesni;

    /**
     * The value for the rajdane field.
     * @var        string
     */
    protected $rajdane;

    /**
     * The value for the prevodi field.
     * @var        int
     */
    protected $prevodi;

    /**
     * The value for the autoplay field.
     * Note: this column has a database default value of: 1
     * @var        int
     */
    protected $autoplay;

    /**
     * The value for the skype field.
     * @var        string
     */
    protected $skype;

    /**
     * The value for the activity_points field.
     * @var        int
     */
    protected $activity_points;

    /**
     * The value for the banned field.
     * @var        \DateTime
     */
    protected $banned;

    /**
     * The value for the chatmessages field.
     * Note: this column has a database default value of: 0
     * @var        int
     */
    protected $chatmessages;

    /**
     * @var        ObjectCollection|ChildChatOnline[] Collection to store aggregation of ChildChatOnline objects.
     */
    protected $collChatOnlines;
    protected $collChatOnlinesPartial;

    /**
     * @var        ObjectCollection|ChildForumTopicWatchers[] Collection to store aggregation of ChildForumTopicWatchers objects.
     */
    protected $collForumTopicWatcherss;
    protected $collForumTopicWatcherssPartial;

    /**
     * @var        ObjectCollection|ChildPermissionGroupUsers[] Collection to store aggregation of ChildPermissionGroupUsers objects.
     */
    protected $collPermissionGroupUserss;
    protected $collPermissionGroupUserssPartial;

    /**
     * @var        ObjectCollection|ChildPermissionUsers[] Collection to store aggregation of ChildPermissionUsers objects.
     */
    protected $collPermissionUserss;
    protected $collPermissionUserssPartial;

    /**
     * @var        ObjectCollection|ChildPrevodi[] Collection to store aggregation of ChildPrevodi objects.
     */
    protected $collPrevodis;
    protected $collPrevodisPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var boolean
     */
    protected $alreadyInSave = false;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildChatOnline[]
     */
    protected $chatOnlinesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildForumTopicWatchers[]
     */
    protected $forumTopicWatcherssScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildPermissionGroupUsers[]
     */
    protected $permissionGroupUserssScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildPermissionUsers[]
     */
    protected $permissionUserssScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildPrevodi[]
     */
    protected $prevodisScheduledForDeletion = null;

    /**
     * Applies default values to this object.
     * This method should be called from the object's constructor (or
     * equivalent initialization method).
     * @see __construct()
     */
    public function applyDefaultValues()
    {
        $this->class = 0;
        $this->autoplay = 1;
        $this->chatmessages = 0;
    }

    /**
     * Initializes internal state of Tekstove\TekstoveBundle\Model\Entity\Base\Users object.
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
     * Compares this with another <code>Users</code> instance.  If
     * <code>obj</code> is an instance of <code>Users</code>, delegates to
     * <code>equals(Users)</code>.  Otherwise, returns <code>false</code>.
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
     * @return $this|Users The current object, for fluid interface
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
     * Get the [password_mod] column value.
     *
     * @return string
     */
    public function getPasswordMod()
    {
        return $this->password_mod;
    }

    /**
     * Get the [password_mod_coockie] column value.
     *
     * @return string
     */
    public function getPasswordModCoockie()
    {
        return $this->password_mod_coockie;
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
     * Get the [mail] column value.
     *
     * @return string
     */
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * Get the [class] column value.
     *
     * @return int
     */
    public function getClass()
    {
        return $this->class;
    }

    /**
     * Get the [classcustomname] column value.
     *
     * @return string
     */
    public function getClasscustomname()
    {
        return $this->classcustomname;
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
     * Get the [optionally formatted] temporal [reg_date] column value.
     *
     *
     * @param      string $format The date/time format string (either date()-style or strftime()-style).
     *                            If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getRegDate($format = NULL)
    {
        if ($format === null) {
            return $this->reg_date;
        } else {
            return $this->reg_date instanceof \DateTime ? $this->reg_date->format($format) : null;
        }
    }

    /**
     * Get the [pozdrav] column value.
     *
     * @return int
     */
    public function getPozdrav()
    {
        return $this->pozdrav;
    }

    /**
     * Get the [br_pesni] column value.
     *
     * @return int
     */
    public function getBrPesni()
    {
        return $this->br_pesni;
    }

    /**
     * Get the [rajdane] column value.
     *
     * @return string
     */
    public function getRajdane()
    {
        return $this->rajdane;
    }

    /**
     * Get the [prevodi] column value.
     *
     * @return int
     */
    public function getPrevodi()
    {
        return $this->prevodi;
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
     * Get the [skype] column value.
     *
     * @return string
     */
    public function getSkype()
    {
        return $this->skype;
    }

    /**
     * Get the [activity_points] column value.
     *
     * @return int
     */
    public function getActivityPoints()
    {
        return $this->activity_points;
    }

    /**
     * Get the [optionally formatted] temporal [banned] column value.
     *
     *
     * @param      string $format The date/time format string (either date()-style or strftime()-style).
     *                            If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getBanned($format = NULL)
    {
        if ($format === null) {
            return $this->banned;
        } else {
            return $this->banned instanceof \DateTime ? $this->banned->format($format) : null;
        }
    }

    /**
     * Get the [chatmessages] column value.
     *
     * @return int
     */
    public function getChatmessages()
    {
        return $this->chatmessages;
    }

    /**
     * Set the value of [username] column.
     *
     * @param string $v new value
     * @return $this|\Tekstove\TekstoveBundle\Model\Entity\Users The current object (for fluent API support)
     */
    public function setUsername($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->username !== $v) {
            $this->username = $v;
            $this->modifiedColumns[UsersTableMap::COL_USERNAME] = true;
        }

        return $this;
    } // setUsername()

    /**
     * Set the value of [password] column.
     *
     * @param string $v new value
     * @return $this|\Tekstove\TekstoveBundle\Model\Entity\Users The current object (for fluent API support)
     */
    public function setPassword($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->password !== $v) {
            $this->password = $v;
            $this->modifiedColumns[UsersTableMap::COL_PASSWORD] = true;
        }

        return $this;
    } // setPassword()

    /**
     * Set the value of [password_mod] column.
     *
     * @param string $v new value
     * @return $this|\Tekstove\TekstoveBundle\Model\Entity\Users The current object (for fluent API support)
     */
    public function setPasswordMod($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->password_mod !== $v) {
            $this->password_mod = $v;
            $this->modifiedColumns[UsersTableMap::COL_PASSWORD_MOD] = true;
        }

        return $this;
    } // setPasswordMod()

    /**
     * Set the value of [password_mod_coockie] column.
     *
     * @param string $v new value
     * @return $this|\Tekstove\TekstoveBundle\Model\Entity\Users The current object (for fluent API support)
     */
    public function setPasswordModCoockie($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->password_mod_coockie !== $v) {
            $this->password_mod_coockie = $v;
            $this->modifiedColumns[UsersTableMap::COL_PASSWORD_MOD_COOCKIE] = true;
        }

        return $this;
    } // setPasswordModCoockie()

    /**
     * Set the value of [id] column.
     *
     * @param int $v new value
     * @return $this|\Tekstove\TekstoveBundle\Model\Entity\Users The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[UsersTableMap::COL_ID] = true;
        }

        return $this;
    } // setId()

    /**
     * Set the value of [mail] column.
     *
     * @param string $v new value
     * @return $this|\Tekstove\TekstoveBundle\Model\Entity\Users The current object (for fluent API support)
     */
    public function setMail($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->mail !== $v) {
            $this->mail = $v;
            $this->modifiedColumns[UsersTableMap::COL_MAIL] = true;
        }

        return $this;
    } // setMail()

    /**
     * Set the value of [class] column.
     *
     * @param int $v new value
     * @return $this|\Tekstove\TekstoveBundle\Model\Entity\Users The current object (for fluent API support)
     */
    public function setClass($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->class !== $v) {
            $this->class = $v;
            $this->modifiedColumns[UsersTableMap::COL_CLASS] = true;
        }

        return $this;
    } // setClass()

    /**
     * Set the value of [classcustomname] column.
     *
     * @param string $v new value
     * @return $this|\Tekstove\TekstoveBundle\Model\Entity\Users The current object (for fluent API support)
     */
    public function setClasscustomname($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->classcustomname !== $v) {
            $this->classcustomname = $v;
            $this->modifiedColumns[UsersTableMap::COL_CLASSCUSTOMNAME] = true;
        }

        return $this;
    } // setClasscustomname()

    /**
     * Set the value of [avatar] column.
     *
     * @param string $v new value
     * @return $this|\Tekstove\TekstoveBundle\Model\Entity\Users The current object (for fluent API support)
     */
    public function setAvatar($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->avatar !== $v) {
            $this->avatar = $v;
            $this->modifiedColumns[UsersTableMap::COL_AVATAR] = true;
        }

        return $this;
    } // setAvatar()

    /**
     * Set the value of [about] column.
     *
     * @param string $v new value
     * @return $this|\Tekstove\TekstoveBundle\Model\Entity\Users The current object (for fluent API support)
     */
    public function setAbout($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->about !== $v) {
            $this->about = $v;
            $this->modifiedColumns[UsersTableMap::COL_ABOUT] = true;
        }

        return $this;
    } // setAbout()

    /**
     * Sets the value of [reg_date] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTime value.
     *               Empty strings are treated as NULL.
     * @return $this|\Tekstove\TekstoveBundle\Model\Entity\Users The current object (for fluent API support)
     */
    public function setRegDate($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->reg_date !== null || $dt !== null) {
            if ($this->reg_date === null || $dt === null || $dt->format("Y-m-d H:i:s") !== $this->reg_date->format("Y-m-d H:i:s")) {
                $this->reg_date = $dt === null ? null : clone $dt;
                $this->modifiedColumns[UsersTableMap::COL_REG_DATE] = true;
            }
        } // if either are not null

        return $this;
    } // setRegDate()

    /**
     * Set the value of [pozdrav] column.
     *
     * @param int $v new value
     * @return $this|\Tekstove\TekstoveBundle\Model\Entity\Users The current object (for fluent API support)
     */
    public function setPozdrav($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->pozdrav !== $v) {
            $this->pozdrav = $v;
            $this->modifiedColumns[UsersTableMap::COL_POZDRAV] = true;
        }

        return $this;
    } // setPozdrav()

    /**
     * Set the value of [br_pesni] column.
     *
     * @param int $v new value
     * @return $this|\Tekstove\TekstoveBundle\Model\Entity\Users The current object (for fluent API support)
     */
    public function setBrPesni($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->br_pesni !== $v) {
            $this->br_pesni = $v;
            $this->modifiedColumns[UsersTableMap::COL_BR_PESNI] = true;
        }

        return $this;
    } // setBrPesni()

    /**
     * Set the value of [rajdane] column.
     *
     * @param string $v new value
     * @return $this|\Tekstove\TekstoveBundle\Model\Entity\Users The current object (for fluent API support)
     */
    public function setRajdane($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->rajdane !== $v) {
            $this->rajdane = $v;
            $this->modifiedColumns[UsersTableMap::COL_RAJDANE] = true;
        }

        return $this;
    } // setRajdane()

    /**
     * Set the value of [prevodi] column.
     *
     * @param int $v new value
     * @return $this|\Tekstove\TekstoveBundle\Model\Entity\Users The current object (for fluent API support)
     */
    public function setPrevodi($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->prevodi !== $v) {
            $this->prevodi = $v;
            $this->modifiedColumns[UsersTableMap::COL_PREVODI] = true;
        }

        return $this;
    } // setPrevodi()

    /**
     * Set the value of [autoplay] column.
     *
     * @param int $v new value
     * @return $this|\Tekstove\TekstoveBundle\Model\Entity\Users The current object (for fluent API support)
     */
    public function setAutoplay($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->autoplay !== $v) {
            $this->autoplay = $v;
            $this->modifiedColumns[UsersTableMap::COL_AUTOPLAY] = true;
        }

        return $this;
    } // setAutoplay()

    /**
     * Set the value of [skype] column.
     *
     * @param string $v new value
     * @return $this|\Tekstove\TekstoveBundle\Model\Entity\Users The current object (for fluent API support)
     */
    public function setSkype($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->skype !== $v) {
            $this->skype = $v;
            $this->modifiedColumns[UsersTableMap::COL_SKYPE] = true;
        }

        return $this;
    } // setSkype()

    /**
     * Set the value of [activity_points] column.
     *
     * @param int $v new value
     * @return $this|\Tekstove\TekstoveBundle\Model\Entity\Users The current object (for fluent API support)
     */
    public function setActivityPoints($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->activity_points !== $v) {
            $this->activity_points = $v;
            $this->modifiedColumns[UsersTableMap::COL_ACTIVITY_POINTS] = true;
        }

        return $this;
    } // setActivityPoints()

    /**
     * Sets the value of [banned] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTime value.
     *               Empty strings are treated as NULL.
     * @return $this|\Tekstove\TekstoveBundle\Model\Entity\Users The current object (for fluent API support)
     */
    public function setBanned($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->banned !== null || $dt !== null) {
            if ($this->banned === null || $dt === null || $dt->format("Y-m-d H:i:s") !== $this->banned->format("Y-m-d H:i:s")) {
                $this->banned = $dt === null ? null : clone $dt;
                $this->modifiedColumns[UsersTableMap::COL_BANNED] = true;
            }
        } // if either are not null

        return $this;
    } // setBanned()

    /**
     * Set the value of [chatmessages] column.
     *
     * @param int $v new value
     * @return $this|\Tekstove\TekstoveBundle\Model\Entity\Users The current object (for fluent API support)
     */
    public function setChatmessages($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->chatmessages !== $v) {
            $this->chatmessages = $v;
            $this->modifiedColumns[UsersTableMap::COL_CHATMESSAGES] = true;
        }

        return $this;
    } // setChatmessages()

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
            if ($this->class !== 0) {
                return false;
            }

            if ($this->autoplay !== 1) {
                return false;
            }

            if ($this->chatmessages !== 0) {
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : UsersTableMap::translateFieldName('Username', TableMap::TYPE_PHPNAME, $indexType)];
            $this->username = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : UsersTableMap::translateFieldName('Password', TableMap::TYPE_PHPNAME, $indexType)];
            $this->password = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : UsersTableMap::translateFieldName('PasswordMod', TableMap::TYPE_PHPNAME, $indexType)];
            $this->password_mod = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : UsersTableMap::translateFieldName('PasswordModCoockie', TableMap::TYPE_PHPNAME, $indexType)];
            $this->password_mod_coockie = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : UsersTableMap::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : UsersTableMap::translateFieldName('Mail', TableMap::TYPE_PHPNAME, $indexType)];
            $this->mail = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : UsersTableMap::translateFieldName('Class', TableMap::TYPE_PHPNAME, $indexType)];
            $this->class = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : UsersTableMap::translateFieldName('Classcustomname', TableMap::TYPE_PHPNAME, $indexType)];
            $this->classcustomname = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : UsersTableMap::translateFieldName('Avatar', TableMap::TYPE_PHPNAME, $indexType)];
            $this->avatar = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : UsersTableMap::translateFieldName('About', TableMap::TYPE_PHPNAME, $indexType)];
            $this->about = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 10 + $startcol : UsersTableMap::translateFieldName('RegDate', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->reg_date = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 11 + $startcol : UsersTableMap::translateFieldName('Pozdrav', TableMap::TYPE_PHPNAME, $indexType)];
            $this->pozdrav = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 12 + $startcol : UsersTableMap::translateFieldName('BrPesni', TableMap::TYPE_PHPNAME, $indexType)];
            $this->br_pesni = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 13 + $startcol : UsersTableMap::translateFieldName('Rajdane', TableMap::TYPE_PHPNAME, $indexType)];
            $this->rajdane = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 14 + $startcol : UsersTableMap::translateFieldName('Prevodi', TableMap::TYPE_PHPNAME, $indexType)];
            $this->prevodi = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 15 + $startcol : UsersTableMap::translateFieldName('Autoplay', TableMap::TYPE_PHPNAME, $indexType)];
            $this->autoplay = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 16 + $startcol : UsersTableMap::translateFieldName('Skype', TableMap::TYPE_PHPNAME, $indexType)];
            $this->skype = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 17 + $startcol : UsersTableMap::translateFieldName('ActivityPoints', TableMap::TYPE_PHPNAME, $indexType)];
            $this->activity_points = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 18 + $startcol : UsersTableMap::translateFieldName('Banned', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->banned = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 19 + $startcol : UsersTableMap::translateFieldName('Chatmessages', TableMap::TYPE_PHPNAME, $indexType)];
            $this->chatmessages = (null !== $col) ? (int) $col : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 20; // 20 = UsersTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\Tekstove\\TekstoveBundle\\Model\\Entity\\Users'), 0, $e);
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
            $con = Propel::getServiceContainer()->getReadConnection(UsersTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildUsersQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->collChatOnlines = null;

            $this->collForumTopicWatcherss = null;

            $this->collPermissionGroupUserss = null;

            $this->collPermissionUserss = null;

            $this->collPrevodis = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see Users::setDeleted()
     * @see Users::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(UsersTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildUsersQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(UsersTableMap::DATABASE_NAME);
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
                UsersTableMap::addInstanceToPool($this);
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

            if ($this->chatOnlinesScheduledForDeletion !== null) {
                if (!$this->chatOnlinesScheduledForDeletion->isEmpty()) {
                    foreach ($this->chatOnlinesScheduledForDeletion as $chatOnline) {
                        // need to save related object because we set the relation to null
                        $chatOnline->save($con);
                    }
                    $this->chatOnlinesScheduledForDeletion = null;
                }
            }

            if ($this->collChatOnlines !== null) {
                foreach ($this->collChatOnlines as $referrerFK) {
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

            if ($this->permissionGroupUserssScheduledForDeletion !== null) {
                if (!$this->permissionGroupUserssScheduledForDeletion->isEmpty()) {
                    \Tekstove\TekstoveBundle\Model\Entity\PermissionGroupUsersQuery::create()
                        ->filterByPrimaryKeys($this->permissionGroupUserssScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->permissionGroupUserssScheduledForDeletion = null;
                }
            }

            if ($this->collPermissionGroupUserss !== null) {
                foreach ($this->collPermissionGroupUserss as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->permissionUserssScheduledForDeletion !== null) {
                if (!$this->permissionUserssScheduledForDeletion->isEmpty()) {
                    \Tekstove\TekstoveBundle\Model\Entity\PermissionUsersQuery::create()
                        ->filterByPrimaryKeys($this->permissionUserssScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->permissionUserssScheduledForDeletion = null;
                }
            }

            if ($this->collPermissionUserss !== null) {
                foreach ($this->collPermissionUserss as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->prevodisScheduledForDeletion !== null) {
                if (!$this->prevodisScheduledForDeletion->isEmpty()) {
                    \Tekstove\TekstoveBundle\Model\Entity\PrevodiQuery::create()
                        ->filterByPrimaryKeys($this->prevodisScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->prevodisScheduledForDeletion = null;
                }
            }

            if ($this->collPrevodis !== null) {
                foreach ($this->collPrevodis as $referrerFK) {
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

        $this->modifiedColumns[UsersTableMap::COL_ID] = true;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . UsersTableMap::COL_ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(UsersTableMap::COL_USERNAME)) {
            $modifiedColumns[':p' . $index++]  = 'username';
        }
        if ($this->isColumnModified(UsersTableMap::COL_PASSWORD)) {
            $modifiedColumns[':p' . $index++]  = 'password';
        }
        if ($this->isColumnModified(UsersTableMap::COL_PASSWORD_MOD)) {
            $modifiedColumns[':p' . $index++]  = 'password_mod';
        }
        if ($this->isColumnModified(UsersTableMap::COL_PASSWORD_MOD_COOCKIE)) {
            $modifiedColumns[':p' . $index++]  = 'password_mod_coockie';
        }
        if ($this->isColumnModified(UsersTableMap::COL_ID)) {
            $modifiedColumns[':p' . $index++]  = 'id';
        }
        if ($this->isColumnModified(UsersTableMap::COL_MAIL)) {
            $modifiedColumns[':p' . $index++]  = 'mail';
        }
        if ($this->isColumnModified(UsersTableMap::COL_CLASS)) {
            $modifiedColumns[':p' . $index++]  = 'class';
        }
        if ($this->isColumnModified(UsersTableMap::COL_CLASSCUSTOMNAME)) {
            $modifiedColumns[':p' . $index++]  = 'classCustomName';
        }
        if ($this->isColumnModified(UsersTableMap::COL_AVATAR)) {
            $modifiedColumns[':p' . $index++]  = 'avatar';
        }
        if ($this->isColumnModified(UsersTableMap::COL_ABOUT)) {
            $modifiedColumns[':p' . $index++]  = 'about';
        }
        if ($this->isColumnModified(UsersTableMap::COL_REG_DATE)) {
            $modifiedColumns[':p' . $index++]  = 'reg_date';
        }
        if ($this->isColumnModified(UsersTableMap::COL_POZDRAV)) {
            $modifiedColumns[':p' . $index++]  = 'pozdrav';
        }
        if ($this->isColumnModified(UsersTableMap::COL_BR_PESNI)) {
            $modifiedColumns[':p' . $index++]  = 'br_pesni';
        }
        if ($this->isColumnModified(UsersTableMap::COL_RAJDANE)) {
            $modifiedColumns[':p' . $index++]  = 'rajdane';
        }
        if ($this->isColumnModified(UsersTableMap::COL_PREVODI)) {
            $modifiedColumns[':p' . $index++]  = 'prevodi';
        }
        if ($this->isColumnModified(UsersTableMap::COL_AUTOPLAY)) {
            $modifiedColumns[':p' . $index++]  = 'autoplay';
        }
        if ($this->isColumnModified(UsersTableMap::COL_SKYPE)) {
            $modifiedColumns[':p' . $index++]  = 'skype';
        }
        if ($this->isColumnModified(UsersTableMap::COL_ACTIVITY_POINTS)) {
            $modifiedColumns[':p' . $index++]  = 'activity_points';
        }
        if ($this->isColumnModified(UsersTableMap::COL_BANNED)) {
            $modifiedColumns[':p' . $index++]  = 'banned';
        }
        if ($this->isColumnModified(UsersTableMap::COL_CHATMESSAGES)) {
            $modifiedColumns[':p' . $index++]  = 'chatMessages';
        }

        $sql = sprintf(
            'INSERT INTO users (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'username':
                        $stmt->bindValue($identifier, $this->username, PDO::PARAM_STR);
                        break;
                    case 'password':
                        $stmt->bindValue($identifier, $this->password, PDO::PARAM_STR);
                        break;
                    case 'password_mod':
                        $stmt->bindValue($identifier, $this->password_mod, PDO::PARAM_STR);
                        break;
                    case 'password_mod_coockie':
                        $stmt->bindValue($identifier, $this->password_mod_coockie, PDO::PARAM_STR);
                        break;
                    case 'id':
                        $stmt->bindValue($identifier, $this->id, PDO::PARAM_INT);
                        break;
                    case 'mail':
                        $stmt->bindValue($identifier, $this->mail, PDO::PARAM_STR);
                        break;
                    case 'class':
                        $stmt->bindValue($identifier, $this->class, PDO::PARAM_INT);
                        break;
                    case 'classCustomName':
                        $stmt->bindValue($identifier, $this->classcustomname, PDO::PARAM_STR);
                        break;
                    case 'avatar':
                        $stmt->bindValue($identifier, $this->avatar, PDO::PARAM_STR);
                        break;
                    case 'about':
                        $stmt->bindValue($identifier, $this->about, PDO::PARAM_STR);
                        break;
                    case 'reg_date':
                        $stmt->bindValue($identifier, $this->reg_date ? $this->reg_date->format("Y-m-d H:i:s") : null, PDO::PARAM_STR);
                        break;
                    case 'pozdrav':
                        $stmt->bindValue($identifier, $this->pozdrav, PDO::PARAM_INT);
                        break;
                    case 'br_pesni':
                        $stmt->bindValue($identifier, $this->br_pesni, PDO::PARAM_INT);
                        break;
                    case 'rajdane':
                        $stmt->bindValue($identifier, $this->rajdane, PDO::PARAM_STR);
                        break;
                    case 'prevodi':
                        $stmt->bindValue($identifier, $this->prevodi, PDO::PARAM_INT);
                        break;
                    case 'autoplay':
                        $stmt->bindValue($identifier, $this->autoplay, PDO::PARAM_INT);
                        break;
                    case 'skype':
                        $stmt->bindValue($identifier, $this->skype, PDO::PARAM_STR);
                        break;
                    case 'activity_points':
                        $stmt->bindValue($identifier, $this->activity_points, PDO::PARAM_INT);
                        break;
                    case 'banned':
                        $stmt->bindValue($identifier, $this->banned ? $this->banned->format("Y-m-d H:i:s") : null, PDO::PARAM_STR);
                        break;
                    case 'chatMessages':
                        $stmt->bindValue($identifier, $this->chatmessages, PDO::PARAM_INT);
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
        $pos = UsersTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getUsername();
                break;
            case 1:
                return $this->getPassword();
                break;
            case 2:
                return $this->getPasswordMod();
                break;
            case 3:
                return $this->getPasswordModCoockie();
                break;
            case 4:
                return $this->getId();
                break;
            case 5:
                return $this->getMail();
                break;
            case 6:
                return $this->getClass();
                break;
            case 7:
                return $this->getClasscustomname();
                break;
            case 8:
                return $this->getAvatar();
                break;
            case 9:
                return $this->getAbout();
                break;
            case 10:
                return $this->getRegDate();
                break;
            case 11:
                return $this->getPozdrav();
                break;
            case 12:
                return $this->getBrPesni();
                break;
            case 13:
                return $this->getRajdane();
                break;
            case 14:
                return $this->getPrevodi();
                break;
            case 15:
                return $this->getAutoplay();
                break;
            case 16:
                return $this->getSkype();
                break;
            case 17:
                return $this->getActivityPoints();
                break;
            case 18:
                return $this->getBanned();
                break;
            case 19:
                return $this->getChatmessages();
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

        if (isset($alreadyDumpedObjects['Users'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Users'][$this->hashCode()] = true;
        $keys = UsersTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getUsername(),
            $keys[1] => $this->getPassword(),
            $keys[2] => $this->getPasswordMod(),
            $keys[3] => $this->getPasswordModCoockie(),
            $keys[4] => $this->getId(),
            $keys[5] => $this->getMail(),
            $keys[6] => $this->getClass(),
            $keys[7] => $this->getClasscustomname(),
            $keys[8] => $this->getAvatar(),
            $keys[9] => $this->getAbout(),
            $keys[10] => $this->getRegDate(),
            $keys[11] => $this->getPozdrav(),
            $keys[12] => $this->getBrPesni(),
            $keys[13] => $this->getRajdane(),
            $keys[14] => $this->getPrevodi(),
            $keys[15] => $this->getAutoplay(),
            $keys[16] => $this->getSkype(),
            $keys[17] => $this->getActivityPoints(),
            $keys[18] => $this->getBanned(),
            $keys[19] => $this->getChatmessages(),
        );

        $utc = new \DateTimeZone('utc');
        if ($result[$keys[10]] instanceof \DateTime) {
            // When changing timezone we don't want to change existing instances
            $dateTime = clone $result[$keys[10]];
            $result[$keys[10]] = $dateTime->setTimezone($utc)->format('Y-m-d\TH:i:s\Z');
        }

        if ($result[$keys[18]] instanceof \DateTime) {
            // When changing timezone we don't want to change existing instances
            $dateTime = clone $result[$keys[18]];
            $result[$keys[18]] = $dateTime->setTimezone($utc)->format('Y-m-d\TH:i:s\Z');
        }

        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->collChatOnlines) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'chatOnlines';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'chat_onlines';
                        break;
                    default:
                        $key = 'ChatOnlines';
                }

                $result[$key] = $this->collChatOnlines->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
            if (null !== $this->collPermissionGroupUserss) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'permissionGroupUserss';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'permission_group_userss';
                        break;
                    default:
                        $key = 'PermissionGroupUserss';
                }

                $result[$key] = $this->collPermissionGroupUserss->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collPermissionUserss) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'permissionUserss';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'permission_userss';
                        break;
                    default:
                        $key = 'PermissionUserss';
                }

                $result[$key] = $this->collPermissionUserss->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collPrevodis) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'prevodis';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'prevodis';
                        break;
                    default:
                        $key = 'Prevodis';
                }

                $result[$key] = $this->collPrevodis->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
     * @return $this|\Tekstove\TekstoveBundle\Model\Entity\Users
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = UsersTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\Tekstove\TekstoveBundle\Model\Entity\Users
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setUsername($value);
                break;
            case 1:
                $this->setPassword($value);
                break;
            case 2:
                $this->setPasswordMod($value);
                break;
            case 3:
                $this->setPasswordModCoockie($value);
                break;
            case 4:
                $this->setId($value);
                break;
            case 5:
                $this->setMail($value);
                break;
            case 6:
                $this->setClass($value);
                break;
            case 7:
                $this->setClasscustomname($value);
                break;
            case 8:
                $this->setAvatar($value);
                break;
            case 9:
                $this->setAbout($value);
                break;
            case 10:
                $this->setRegDate($value);
                break;
            case 11:
                $this->setPozdrav($value);
                break;
            case 12:
                $this->setBrPesni($value);
                break;
            case 13:
                $this->setRajdane($value);
                break;
            case 14:
                $this->setPrevodi($value);
                break;
            case 15:
                $this->setAutoplay($value);
                break;
            case 16:
                $this->setSkype($value);
                break;
            case 17:
                $this->setActivityPoints($value);
                break;
            case 18:
                $this->setBanned($value);
                break;
            case 19:
                $this->setChatmessages($value);
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
        $keys = UsersTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setUsername($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setPassword($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setPasswordMod($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setPasswordModCoockie($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setId($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setMail($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setClass($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setClasscustomname($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setAvatar($arr[$keys[8]]);
        }
        if (array_key_exists($keys[9], $arr)) {
            $this->setAbout($arr[$keys[9]]);
        }
        if (array_key_exists($keys[10], $arr)) {
            $this->setRegDate($arr[$keys[10]]);
        }
        if (array_key_exists($keys[11], $arr)) {
            $this->setPozdrav($arr[$keys[11]]);
        }
        if (array_key_exists($keys[12], $arr)) {
            $this->setBrPesni($arr[$keys[12]]);
        }
        if (array_key_exists($keys[13], $arr)) {
            $this->setRajdane($arr[$keys[13]]);
        }
        if (array_key_exists($keys[14], $arr)) {
            $this->setPrevodi($arr[$keys[14]]);
        }
        if (array_key_exists($keys[15], $arr)) {
            $this->setAutoplay($arr[$keys[15]]);
        }
        if (array_key_exists($keys[16], $arr)) {
            $this->setSkype($arr[$keys[16]]);
        }
        if (array_key_exists($keys[17], $arr)) {
            $this->setActivityPoints($arr[$keys[17]]);
        }
        if (array_key_exists($keys[18], $arr)) {
            $this->setBanned($arr[$keys[18]]);
        }
        if (array_key_exists($keys[19], $arr)) {
            $this->setChatmessages($arr[$keys[19]]);
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
     * @return $this|\Tekstove\TekstoveBundle\Model\Entity\Users The current object, for fluid interface
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
        $criteria = new Criteria(UsersTableMap::DATABASE_NAME);

        if ($this->isColumnModified(UsersTableMap::COL_USERNAME)) {
            $criteria->add(UsersTableMap::COL_USERNAME, $this->username);
        }
        if ($this->isColumnModified(UsersTableMap::COL_PASSWORD)) {
            $criteria->add(UsersTableMap::COL_PASSWORD, $this->password);
        }
        if ($this->isColumnModified(UsersTableMap::COL_PASSWORD_MOD)) {
            $criteria->add(UsersTableMap::COL_PASSWORD_MOD, $this->password_mod);
        }
        if ($this->isColumnModified(UsersTableMap::COL_PASSWORD_MOD_COOCKIE)) {
            $criteria->add(UsersTableMap::COL_PASSWORD_MOD_COOCKIE, $this->password_mod_coockie);
        }
        if ($this->isColumnModified(UsersTableMap::COL_ID)) {
            $criteria->add(UsersTableMap::COL_ID, $this->id);
        }
        if ($this->isColumnModified(UsersTableMap::COL_MAIL)) {
            $criteria->add(UsersTableMap::COL_MAIL, $this->mail);
        }
        if ($this->isColumnModified(UsersTableMap::COL_CLASS)) {
            $criteria->add(UsersTableMap::COL_CLASS, $this->class);
        }
        if ($this->isColumnModified(UsersTableMap::COL_CLASSCUSTOMNAME)) {
            $criteria->add(UsersTableMap::COL_CLASSCUSTOMNAME, $this->classcustomname);
        }
        if ($this->isColumnModified(UsersTableMap::COL_AVATAR)) {
            $criteria->add(UsersTableMap::COL_AVATAR, $this->avatar);
        }
        if ($this->isColumnModified(UsersTableMap::COL_ABOUT)) {
            $criteria->add(UsersTableMap::COL_ABOUT, $this->about);
        }
        if ($this->isColumnModified(UsersTableMap::COL_REG_DATE)) {
            $criteria->add(UsersTableMap::COL_REG_DATE, $this->reg_date);
        }
        if ($this->isColumnModified(UsersTableMap::COL_POZDRAV)) {
            $criteria->add(UsersTableMap::COL_POZDRAV, $this->pozdrav);
        }
        if ($this->isColumnModified(UsersTableMap::COL_BR_PESNI)) {
            $criteria->add(UsersTableMap::COL_BR_PESNI, $this->br_pesni);
        }
        if ($this->isColumnModified(UsersTableMap::COL_RAJDANE)) {
            $criteria->add(UsersTableMap::COL_RAJDANE, $this->rajdane);
        }
        if ($this->isColumnModified(UsersTableMap::COL_PREVODI)) {
            $criteria->add(UsersTableMap::COL_PREVODI, $this->prevodi);
        }
        if ($this->isColumnModified(UsersTableMap::COL_AUTOPLAY)) {
            $criteria->add(UsersTableMap::COL_AUTOPLAY, $this->autoplay);
        }
        if ($this->isColumnModified(UsersTableMap::COL_SKYPE)) {
            $criteria->add(UsersTableMap::COL_SKYPE, $this->skype);
        }
        if ($this->isColumnModified(UsersTableMap::COL_ACTIVITY_POINTS)) {
            $criteria->add(UsersTableMap::COL_ACTIVITY_POINTS, $this->activity_points);
        }
        if ($this->isColumnModified(UsersTableMap::COL_BANNED)) {
            $criteria->add(UsersTableMap::COL_BANNED, $this->banned);
        }
        if ($this->isColumnModified(UsersTableMap::COL_CHATMESSAGES)) {
            $criteria->add(UsersTableMap::COL_CHATMESSAGES, $this->chatmessages);
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
        $criteria = ChildUsersQuery::create();
        $criteria->add(UsersTableMap::COL_ID, $this->id);

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
     * @param      object $copyObj An object of \Tekstove\TekstoveBundle\Model\Entity\Users (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setUsername($this->getUsername());
        $copyObj->setPassword($this->getPassword());
        $copyObj->setPasswordMod($this->getPasswordMod());
        $copyObj->setPasswordModCoockie($this->getPasswordModCoockie());
        $copyObj->setMail($this->getMail());
        $copyObj->setClass($this->getClass());
        $copyObj->setClasscustomname($this->getClasscustomname());
        $copyObj->setAvatar($this->getAvatar());
        $copyObj->setAbout($this->getAbout());
        $copyObj->setRegDate($this->getRegDate());
        $copyObj->setPozdrav($this->getPozdrav());
        $copyObj->setBrPesni($this->getBrPesni());
        $copyObj->setRajdane($this->getRajdane());
        $copyObj->setPrevodi($this->getPrevodi());
        $copyObj->setAutoplay($this->getAutoplay());
        $copyObj->setSkype($this->getSkype());
        $copyObj->setActivityPoints($this->getActivityPoints());
        $copyObj->setBanned($this->getBanned());
        $copyObj->setChatmessages($this->getChatmessages());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getChatOnlines() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addChatOnline($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getForumTopicWatcherss() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addForumTopicWatchers($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getPermissionGroupUserss() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addPermissionGroupUsers($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getPermissionUserss() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addPermissionUsers($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getPrevodis() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addPrevodi($relObj->copy($deepCopy));
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
     * @return \Tekstove\TekstoveBundle\Model\Entity\Users Clone of current object.
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
        if ('ChatOnline' == $relationName) {
            return $this->initChatOnlines();
        }
        if ('ForumTopicWatchers' == $relationName) {
            return $this->initForumTopicWatcherss();
        }
        if ('PermissionGroupUsers' == $relationName) {
            return $this->initPermissionGroupUserss();
        }
        if ('PermissionUsers' == $relationName) {
            return $this->initPermissionUserss();
        }
        if ('Prevodi' == $relationName) {
            return $this->initPrevodis();
        }
    }

    /**
     * Clears out the collChatOnlines collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addChatOnlines()
     */
    public function clearChatOnlines()
    {
        $this->collChatOnlines = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collChatOnlines collection loaded partially.
     */
    public function resetPartialChatOnlines($v = true)
    {
        $this->collChatOnlinesPartial = $v;
    }

    /**
     * Initializes the collChatOnlines collection.
     *
     * By default this just sets the collChatOnlines collection to an empty array (like clearcollChatOnlines());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initChatOnlines($overrideExisting = true)
    {
        if (null !== $this->collChatOnlines && !$overrideExisting) {
            return;
        }
        $this->collChatOnlines = new ObjectCollection();
        $this->collChatOnlines->setModel('\Tekstove\TekstoveBundle\Model\Entity\ChatOnline');
    }

    /**
     * Gets an array of ChildChatOnline objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildUsers is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildChatOnline[] List of ChildChatOnline objects
     * @throws PropelException
     */
    public function getChatOnlines(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collChatOnlinesPartial && !$this->isNew();
        if (null === $this->collChatOnlines || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collChatOnlines) {
                // return empty collection
                $this->initChatOnlines();
            } else {
                $collChatOnlines = ChildChatOnlineQuery::create(null, $criteria)
                    ->filterByUsers($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collChatOnlinesPartial && count($collChatOnlines)) {
                        $this->initChatOnlines(false);

                        foreach ($collChatOnlines as $obj) {
                            if (false == $this->collChatOnlines->contains($obj)) {
                                $this->collChatOnlines->append($obj);
                            }
                        }

                        $this->collChatOnlinesPartial = true;
                    }

                    return $collChatOnlines;
                }

                if ($partial && $this->collChatOnlines) {
                    foreach ($this->collChatOnlines as $obj) {
                        if ($obj->isNew()) {
                            $collChatOnlines[] = $obj;
                        }
                    }
                }

                $this->collChatOnlines = $collChatOnlines;
                $this->collChatOnlinesPartial = false;
            }
        }

        return $this->collChatOnlines;
    }

    /**
     * Sets a collection of ChildChatOnline objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $chatOnlines A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildUsers The current object (for fluent API support)
     */
    public function setChatOnlines(Collection $chatOnlines, ConnectionInterface $con = null)
    {
        /** @var ChildChatOnline[] $chatOnlinesToDelete */
        $chatOnlinesToDelete = $this->getChatOnlines(new Criteria(), $con)->diff($chatOnlines);


        $this->chatOnlinesScheduledForDeletion = $chatOnlinesToDelete;

        foreach ($chatOnlinesToDelete as $chatOnlineRemoved) {
            $chatOnlineRemoved->setUsers(null);
        }

        $this->collChatOnlines = null;
        foreach ($chatOnlines as $chatOnline) {
            $this->addChatOnline($chatOnline);
        }

        $this->collChatOnlines = $chatOnlines;
        $this->collChatOnlinesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related ChatOnline objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related ChatOnline objects.
     * @throws PropelException
     */
    public function countChatOnlines(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collChatOnlinesPartial && !$this->isNew();
        if (null === $this->collChatOnlines || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collChatOnlines) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getChatOnlines());
            }

            $query = ChildChatOnlineQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByUsers($this)
                ->count($con);
        }

        return count($this->collChatOnlines);
    }

    /**
     * Method called to associate a ChildChatOnline object to this object
     * through the ChildChatOnline foreign key attribute.
     *
     * @param  ChildChatOnline $l ChildChatOnline
     * @return $this|\Tekstove\TekstoveBundle\Model\Entity\Users The current object (for fluent API support)
     */
    public function addChatOnline(ChildChatOnline $l)
    {
        if ($this->collChatOnlines === null) {
            $this->initChatOnlines();
            $this->collChatOnlinesPartial = true;
        }

        if (!$this->collChatOnlines->contains($l)) {
            $this->doAddChatOnline($l);
        }

        return $this;
    }

    /**
     * @param ChildChatOnline $chatOnline The ChildChatOnline object to add.
     */
    protected function doAddChatOnline(ChildChatOnline $chatOnline)
    {
        $this->collChatOnlines[]= $chatOnline;
        $chatOnline->setUsers($this);
    }

    /**
     * @param  ChildChatOnline $chatOnline The ChildChatOnline object to remove.
     * @return $this|ChildUsers The current object (for fluent API support)
     */
    public function removeChatOnline(ChildChatOnline $chatOnline)
    {
        if ($this->getChatOnlines()->contains($chatOnline)) {
            $pos = $this->collChatOnlines->search($chatOnline);
            $this->collChatOnlines->remove($pos);
            if (null === $this->chatOnlinesScheduledForDeletion) {
                $this->chatOnlinesScheduledForDeletion = clone $this->collChatOnlines;
                $this->chatOnlinesScheduledForDeletion->clear();
            }
            $this->chatOnlinesScheduledForDeletion[]= $chatOnline;
            $chatOnline->setUsers(null);
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
     * If this ChildUsers is new, it will return
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
                    ->filterByUsers($this)
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
     * @return $this|ChildUsers The current object (for fluent API support)
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
            $forumTopicWatchersRemoved->setUsers(null);
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
                ->filterByUsers($this)
                ->count($con);
        }

        return count($this->collForumTopicWatcherss);
    }

    /**
     * Method called to associate a ChildForumTopicWatchers object to this object
     * through the ChildForumTopicWatchers foreign key attribute.
     *
     * @param  ChildForumTopicWatchers $l ChildForumTopicWatchers
     * @return $this|\Tekstove\TekstoveBundle\Model\Entity\Users The current object (for fluent API support)
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
        $forumTopicWatchers->setUsers($this);
    }

    /**
     * @param  ChildForumTopicWatchers $forumTopicWatchers The ChildForumTopicWatchers object to remove.
     * @return $this|ChildUsers The current object (for fluent API support)
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
            $forumTopicWatchers->setUsers(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Users is new, it will return
     * an empty collection; or if this Users has previously
     * been saved, it will retrieve related ForumTopicWatcherss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Users.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildForumTopicWatchers[] List of ChildForumTopicWatchers objects
     */
    public function getForumTopicWatcherssJoinForumTopic(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildForumTopicWatchersQuery::create(null, $criteria);
        $query->joinWith('ForumTopic', $joinBehavior);

        return $this->getForumTopicWatcherss($query, $con);
    }

    /**
     * Clears out the collPermissionGroupUserss collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addPermissionGroupUserss()
     */
    public function clearPermissionGroupUserss()
    {
        $this->collPermissionGroupUserss = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collPermissionGroupUserss collection loaded partially.
     */
    public function resetPartialPermissionGroupUserss($v = true)
    {
        $this->collPermissionGroupUserssPartial = $v;
    }

    /**
     * Initializes the collPermissionGroupUserss collection.
     *
     * By default this just sets the collPermissionGroupUserss collection to an empty array (like clearcollPermissionGroupUserss());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initPermissionGroupUserss($overrideExisting = true)
    {
        if (null !== $this->collPermissionGroupUserss && !$overrideExisting) {
            return;
        }
        $this->collPermissionGroupUserss = new ObjectCollection();
        $this->collPermissionGroupUserss->setModel('\Tekstove\TekstoveBundle\Model\Entity\PermissionGroupUsers');
    }

    /**
     * Gets an array of ChildPermissionGroupUsers objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildUsers is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildPermissionGroupUsers[] List of ChildPermissionGroupUsers objects
     * @throws PropelException
     */
    public function getPermissionGroupUserss(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collPermissionGroupUserssPartial && !$this->isNew();
        if (null === $this->collPermissionGroupUserss || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collPermissionGroupUserss) {
                // return empty collection
                $this->initPermissionGroupUserss();
            } else {
                $collPermissionGroupUserss = ChildPermissionGroupUsersQuery::create(null, $criteria)
                    ->filterByUsers($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collPermissionGroupUserssPartial && count($collPermissionGroupUserss)) {
                        $this->initPermissionGroupUserss(false);

                        foreach ($collPermissionGroupUserss as $obj) {
                            if (false == $this->collPermissionGroupUserss->contains($obj)) {
                                $this->collPermissionGroupUserss->append($obj);
                            }
                        }

                        $this->collPermissionGroupUserssPartial = true;
                    }

                    return $collPermissionGroupUserss;
                }

                if ($partial && $this->collPermissionGroupUserss) {
                    foreach ($this->collPermissionGroupUserss as $obj) {
                        if ($obj->isNew()) {
                            $collPermissionGroupUserss[] = $obj;
                        }
                    }
                }

                $this->collPermissionGroupUserss = $collPermissionGroupUserss;
                $this->collPermissionGroupUserssPartial = false;
            }
        }

        return $this->collPermissionGroupUserss;
    }

    /**
     * Sets a collection of ChildPermissionGroupUsers objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $permissionGroupUserss A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildUsers The current object (for fluent API support)
     */
    public function setPermissionGroupUserss(Collection $permissionGroupUserss, ConnectionInterface $con = null)
    {
        /** @var ChildPermissionGroupUsers[] $permissionGroupUserssToDelete */
        $permissionGroupUserssToDelete = $this->getPermissionGroupUserss(new Criteria(), $con)->diff($permissionGroupUserss);


        //since at least one column in the foreign key is at the same time a PK
        //we can not just set a PK to NULL in the lines below. We have to store
        //a backup of all values, so we are able to manipulate these items based on the onDelete value later.
        $this->permissionGroupUserssScheduledForDeletion = clone $permissionGroupUserssToDelete;

        foreach ($permissionGroupUserssToDelete as $permissionGroupUsersRemoved) {
            $permissionGroupUsersRemoved->setUsers(null);
        }

        $this->collPermissionGroupUserss = null;
        foreach ($permissionGroupUserss as $permissionGroupUsers) {
            $this->addPermissionGroupUsers($permissionGroupUsers);
        }

        $this->collPermissionGroupUserss = $permissionGroupUserss;
        $this->collPermissionGroupUserssPartial = false;

        return $this;
    }

    /**
     * Returns the number of related PermissionGroupUsers objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related PermissionGroupUsers objects.
     * @throws PropelException
     */
    public function countPermissionGroupUserss(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collPermissionGroupUserssPartial && !$this->isNew();
        if (null === $this->collPermissionGroupUserss || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collPermissionGroupUserss) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getPermissionGroupUserss());
            }

            $query = ChildPermissionGroupUsersQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByUsers($this)
                ->count($con);
        }

        return count($this->collPermissionGroupUserss);
    }

    /**
     * Method called to associate a ChildPermissionGroupUsers object to this object
     * through the ChildPermissionGroupUsers foreign key attribute.
     *
     * @param  ChildPermissionGroupUsers $l ChildPermissionGroupUsers
     * @return $this|\Tekstove\TekstoveBundle\Model\Entity\Users The current object (for fluent API support)
     */
    public function addPermissionGroupUsers(ChildPermissionGroupUsers $l)
    {
        if ($this->collPermissionGroupUserss === null) {
            $this->initPermissionGroupUserss();
            $this->collPermissionGroupUserssPartial = true;
        }

        if (!$this->collPermissionGroupUserss->contains($l)) {
            $this->doAddPermissionGroupUsers($l);
        }

        return $this;
    }

    /**
     * @param ChildPermissionGroupUsers $permissionGroupUsers The ChildPermissionGroupUsers object to add.
     */
    protected function doAddPermissionGroupUsers(ChildPermissionGroupUsers $permissionGroupUsers)
    {
        $this->collPermissionGroupUserss[]= $permissionGroupUsers;
        $permissionGroupUsers->setUsers($this);
    }

    /**
     * @param  ChildPermissionGroupUsers $permissionGroupUsers The ChildPermissionGroupUsers object to remove.
     * @return $this|ChildUsers The current object (for fluent API support)
     */
    public function removePermissionGroupUsers(ChildPermissionGroupUsers $permissionGroupUsers)
    {
        if ($this->getPermissionGroupUserss()->contains($permissionGroupUsers)) {
            $pos = $this->collPermissionGroupUserss->search($permissionGroupUsers);
            $this->collPermissionGroupUserss->remove($pos);
            if (null === $this->permissionGroupUserssScheduledForDeletion) {
                $this->permissionGroupUserssScheduledForDeletion = clone $this->collPermissionGroupUserss;
                $this->permissionGroupUserssScheduledForDeletion->clear();
            }
            $this->permissionGroupUserssScheduledForDeletion[]= clone $permissionGroupUsers;
            $permissionGroupUsers->setUsers(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Users is new, it will return
     * an empty collection; or if this Users has previously
     * been saved, it will retrieve related PermissionGroupUserss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Users.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildPermissionGroupUsers[] List of ChildPermissionGroupUsers objects
     */
    public function getPermissionGroupUserssJoinPermissionGroups(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildPermissionGroupUsersQuery::create(null, $criteria);
        $query->joinWith('PermissionGroups', $joinBehavior);

        return $this->getPermissionGroupUserss($query, $con);
    }

    /**
     * Clears out the collPermissionUserss collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addPermissionUserss()
     */
    public function clearPermissionUserss()
    {
        $this->collPermissionUserss = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collPermissionUserss collection loaded partially.
     */
    public function resetPartialPermissionUserss($v = true)
    {
        $this->collPermissionUserssPartial = $v;
    }

    /**
     * Initializes the collPermissionUserss collection.
     *
     * By default this just sets the collPermissionUserss collection to an empty array (like clearcollPermissionUserss());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initPermissionUserss($overrideExisting = true)
    {
        if (null !== $this->collPermissionUserss && !$overrideExisting) {
            return;
        }
        $this->collPermissionUserss = new ObjectCollection();
        $this->collPermissionUserss->setModel('\Tekstove\TekstoveBundle\Model\Entity\PermissionUsers');
    }

    /**
     * Gets an array of ChildPermissionUsers objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildUsers is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildPermissionUsers[] List of ChildPermissionUsers objects
     * @throws PropelException
     */
    public function getPermissionUserss(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collPermissionUserssPartial && !$this->isNew();
        if (null === $this->collPermissionUserss || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collPermissionUserss) {
                // return empty collection
                $this->initPermissionUserss();
            } else {
                $collPermissionUserss = ChildPermissionUsersQuery::create(null, $criteria)
                    ->filterByUsers($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collPermissionUserssPartial && count($collPermissionUserss)) {
                        $this->initPermissionUserss(false);

                        foreach ($collPermissionUserss as $obj) {
                            if (false == $this->collPermissionUserss->contains($obj)) {
                                $this->collPermissionUserss->append($obj);
                            }
                        }

                        $this->collPermissionUserssPartial = true;
                    }

                    return $collPermissionUserss;
                }

                if ($partial && $this->collPermissionUserss) {
                    foreach ($this->collPermissionUserss as $obj) {
                        if ($obj->isNew()) {
                            $collPermissionUserss[] = $obj;
                        }
                    }
                }

                $this->collPermissionUserss = $collPermissionUserss;
                $this->collPermissionUserssPartial = false;
            }
        }

        return $this->collPermissionUserss;
    }

    /**
     * Sets a collection of ChildPermissionUsers objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $permissionUserss A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildUsers The current object (for fluent API support)
     */
    public function setPermissionUserss(Collection $permissionUserss, ConnectionInterface $con = null)
    {
        /** @var ChildPermissionUsers[] $permissionUserssToDelete */
        $permissionUserssToDelete = $this->getPermissionUserss(new Criteria(), $con)->diff($permissionUserss);


        //since at least one column in the foreign key is at the same time a PK
        //we can not just set a PK to NULL in the lines below. We have to store
        //a backup of all values, so we are able to manipulate these items based on the onDelete value later.
        $this->permissionUserssScheduledForDeletion = clone $permissionUserssToDelete;

        foreach ($permissionUserssToDelete as $permissionUsersRemoved) {
            $permissionUsersRemoved->setUsers(null);
        }

        $this->collPermissionUserss = null;
        foreach ($permissionUserss as $permissionUsers) {
            $this->addPermissionUsers($permissionUsers);
        }

        $this->collPermissionUserss = $permissionUserss;
        $this->collPermissionUserssPartial = false;

        return $this;
    }

    /**
     * Returns the number of related PermissionUsers objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related PermissionUsers objects.
     * @throws PropelException
     */
    public function countPermissionUserss(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collPermissionUserssPartial && !$this->isNew();
        if (null === $this->collPermissionUserss || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collPermissionUserss) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getPermissionUserss());
            }

            $query = ChildPermissionUsersQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByUsers($this)
                ->count($con);
        }

        return count($this->collPermissionUserss);
    }

    /**
     * Method called to associate a ChildPermissionUsers object to this object
     * through the ChildPermissionUsers foreign key attribute.
     *
     * @param  ChildPermissionUsers $l ChildPermissionUsers
     * @return $this|\Tekstove\TekstoveBundle\Model\Entity\Users The current object (for fluent API support)
     */
    public function addPermissionUsers(ChildPermissionUsers $l)
    {
        if ($this->collPermissionUserss === null) {
            $this->initPermissionUserss();
            $this->collPermissionUserssPartial = true;
        }

        if (!$this->collPermissionUserss->contains($l)) {
            $this->doAddPermissionUsers($l);
        }

        return $this;
    }

    /**
     * @param ChildPermissionUsers $permissionUsers The ChildPermissionUsers object to add.
     */
    protected function doAddPermissionUsers(ChildPermissionUsers $permissionUsers)
    {
        $this->collPermissionUserss[]= $permissionUsers;
        $permissionUsers->setUsers($this);
    }

    /**
     * @param  ChildPermissionUsers $permissionUsers The ChildPermissionUsers object to remove.
     * @return $this|ChildUsers The current object (for fluent API support)
     */
    public function removePermissionUsers(ChildPermissionUsers $permissionUsers)
    {
        if ($this->getPermissionUserss()->contains($permissionUsers)) {
            $pos = $this->collPermissionUserss->search($permissionUsers);
            $this->collPermissionUserss->remove($pos);
            if (null === $this->permissionUserssScheduledForDeletion) {
                $this->permissionUserssScheduledForDeletion = clone $this->collPermissionUserss;
                $this->permissionUserssScheduledForDeletion->clear();
            }
            $this->permissionUserssScheduledForDeletion[]= clone $permissionUsers;
            $permissionUsers->setUsers(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Users is new, it will return
     * an empty collection; or if this Users has previously
     * been saved, it will retrieve related PermissionUserss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Users.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildPermissionUsers[] List of ChildPermissionUsers objects
     */
    public function getPermissionUserssJoinPermissions(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildPermissionUsersQuery::create(null, $criteria);
        $query->joinWith('Permissions', $joinBehavior);

        return $this->getPermissionUserss($query, $con);
    }

    /**
     * Clears out the collPrevodis collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addPrevodis()
     */
    public function clearPrevodis()
    {
        $this->collPrevodis = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collPrevodis collection loaded partially.
     */
    public function resetPartialPrevodis($v = true)
    {
        $this->collPrevodisPartial = $v;
    }

    /**
     * Initializes the collPrevodis collection.
     *
     * By default this just sets the collPrevodis collection to an empty array (like clearcollPrevodis());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initPrevodis($overrideExisting = true)
    {
        if (null !== $this->collPrevodis && !$overrideExisting) {
            return;
        }
        $this->collPrevodis = new ObjectCollection();
        $this->collPrevodis->setModel('\Tekstove\TekstoveBundle\Model\Entity\Prevodi');
    }

    /**
     * Gets an array of ChildPrevodi objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildUsers is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildPrevodi[] List of ChildPrevodi objects
     * @throws PropelException
     */
    public function getPrevodis(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collPrevodisPartial && !$this->isNew();
        if (null === $this->collPrevodis || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collPrevodis) {
                // return empty collection
                $this->initPrevodis();
            } else {
                $collPrevodis = ChildPrevodiQuery::create(null, $criteria)
                    ->filterByUsers($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collPrevodisPartial && count($collPrevodis)) {
                        $this->initPrevodis(false);

                        foreach ($collPrevodis as $obj) {
                            if (false == $this->collPrevodis->contains($obj)) {
                                $this->collPrevodis->append($obj);
                            }
                        }

                        $this->collPrevodisPartial = true;
                    }

                    return $collPrevodis;
                }

                if ($partial && $this->collPrevodis) {
                    foreach ($this->collPrevodis as $obj) {
                        if ($obj->isNew()) {
                            $collPrevodis[] = $obj;
                        }
                    }
                }

                $this->collPrevodis = $collPrevodis;
                $this->collPrevodisPartial = false;
            }
        }

        return $this->collPrevodis;
    }

    /**
     * Sets a collection of ChildPrevodi objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $prevodis A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildUsers The current object (for fluent API support)
     */
    public function setPrevodis(Collection $prevodis, ConnectionInterface $con = null)
    {
        /** @var ChildPrevodi[] $prevodisToDelete */
        $prevodisToDelete = $this->getPrevodis(new Criteria(), $con)->diff($prevodis);


        $this->prevodisScheduledForDeletion = $prevodisToDelete;

        foreach ($prevodisToDelete as $prevodiRemoved) {
            $prevodiRemoved->setUsers(null);
        }

        $this->collPrevodis = null;
        foreach ($prevodis as $prevodi) {
            $this->addPrevodi($prevodi);
        }

        $this->collPrevodis = $prevodis;
        $this->collPrevodisPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Prevodi objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related Prevodi objects.
     * @throws PropelException
     */
    public function countPrevodis(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collPrevodisPartial && !$this->isNew();
        if (null === $this->collPrevodis || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collPrevodis) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getPrevodis());
            }

            $query = ChildPrevodiQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByUsers($this)
                ->count($con);
        }

        return count($this->collPrevodis);
    }

    /**
     * Method called to associate a ChildPrevodi object to this object
     * through the ChildPrevodi foreign key attribute.
     *
     * @param  ChildPrevodi $l ChildPrevodi
     * @return $this|\Tekstove\TekstoveBundle\Model\Entity\Users The current object (for fluent API support)
     */
    public function addPrevodi(ChildPrevodi $l)
    {
        if ($this->collPrevodis === null) {
            $this->initPrevodis();
            $this->collPrevodisPartial = true;
        }

        if (!$this->collPrevodis->contains($l)) {
            $this->doAddPrevodi($l);
        }

        return $this;
    }

    /**
     * @param ChildPrevodi $prevodi The ChildPrevodi object to add.
     */
    protected function doAddPrevodi(ChildPrevodi $prevodi)
    {
        $this->collPrevodis[]= $prevodi;
        $prevodi->setUsers($this);
    }

    /**
     * @param  ChildPrevodi $prevodi The ChildPrevodi object to remove.
     * @return $this|ChildUsers The current object (for fluent API support)
     */
    public function removePrevodi(ChildPrevodi $prevodi)
    {
        if ($this->getPrevodis()->contains($prevodi)) {
            $pos = $this->collPrevodis->search($prevodi);
            $this->collPrevodis->remove($pos);
            if (null === $this->prevodisScheduledForDeletion) {
                $this->prevodisScheduledForDeletion = clone $this->collPrevodis;
                $this->prevodisScheduledForDeletion->clear();
            }
            $this->prevodisScheduledForDeletion[]= clone $prevodi;
            $prevodi->setUsers(null);
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
        $this->username = null;
        $this->password = null;
        $this->password_mod = null;
        $this->password_mod_coockie = null;
        $this->id = null;
        $this->mail = null;
        $this->class = null;
        $this->classcustomname = null;
        $this->avatar = null;
        $this->about = null;
        $this->reg_date = null;
        $this->pozdrav = null;
        $this->br_pesni = null;
        $this->rajdane = null;
        $this->prevodi = null;
        $this->autoplay = null;
        $this->skype = null;
        $this->activity_points = null;
        $this->banned = null;
        $this->chatmessages = null;
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
            if ($this->collChatOnlines) {
                foreach ($this->collChatOnlines as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collForumTopicWatcherss) {
                foreach ($this->collForumTopicWatcherss as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collPermissionGroupUserss) {
                foreach ($this->collPermissionGroupUserss as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collPermissionUserss) {
                foreach ($this->collPermissionUserss as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collPrevodis) {
                foreach ($this->collPrevodis as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collChatOnlines = null;
        $this->collForumTopicWatcherss = null;
        $this->collPermissionGroupUserss = null;
        $this->collPermissionUserss = null;
        $this->collPrevodis = null;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(UsersTableMap::DEFAULT_STRING_FORMAT);
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
