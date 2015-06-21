<?php

namespace Tekstove\TekstoveBundle\Model\Entity\Base;

use \Exception;
use \PDO;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveRecord\ActiveRecordInterface;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\BadMethodCallException;
use Propel\Runtime\Exception\LogicException;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Parser\AbstractParser;
use Tekstove\TekstoveBundle\Model\Entity\AlbumsQuery as ChildAlbumsQuery;
use Tekstove\TekstoveBundle\Model\Entity\Map\AlbumsTableMap;

/**
 * Base class that represents a row from the 'albums' table.
 *
 *
 *
* @package    propel.generator.src.Tekstove.TekstoveBundle.Model.Entity.Base
*/
abstract class Albums implements ActiveRecordInterface
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\Tekstove\\TekstoveBundle\\Model\\Entity\\Map\\AlbumsTableMap';


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
     * @var        int
     */
    protected $id;

    /**
     * The value for the name field.
     * @var        string
     */
    protected $name;

    /**
     * The value for the artist1id field.
     * @var        int
     */
    protected $artist1id;

    /**
     * The value for the artist2id field.
     * @var        int
     */
    protected $artist2id;

    /**
     * The value for the dopylnitelnoinfo field.
     * @var        string
     */
    protected $dopylnitelnoinfo;

    /**
     * The value for the year field.
     * @var        int
     */
    protected $year;

    /**
     * The value for the image field.
     * @var        string
     */
    protected $image;

    /**
     * The value for the vid field.
     * @var        int
     */
    protected $vid;

    /**
     * The value for the up_id field.
     * @var        int
     */
    protected $up_id;

    /**
     * The value for the va field.
     * @var        boolean
     */
    protected $va;

    /**
     * The value for the p1 field.
     * @var        int
     */
    protected $p1;

    /**
     * The value for the p2 field.
     * @var        int
     */
    protected $p2;

    /**
     * The value for the p3 field.
     * @var        int
     */
    protected $p3;

    /**
     * The value for the p4 field.
     * @var        int
     */
    protected $p4;

    /**
     * The value for the p5 field.
     * @var        int
     */
    protected $p5;

    /**
     * The value for the p6 field.
     * @var        int
     */
    protected $p6;

    /**
     * The value for the p7 field.
     * @var        int
     */
    protected $p7;

    /**
     * The value for the p8 field.
     * @var        int
     */
    protected $p8;

    /**
     * The value for the p9 field.
     * @var        int
     */
    protected $p9;

    /**
     * The value for the p10 field.
     * @var        int
     */
    protected $p10;

    /**
     * The value for the p11 field.
     * @var        int
     */
    protected $p11;

    /**
     * The value for the p12 field.
     * @var        int
     */
    protected $p12;

    /**
     * The value for the p13 field.
     * @var        int
     */
    protected $p13;

    /**
     * The value for the p14 field.
     * @var        int
     */
    protected $p14;

    /**
     * The value for the p15 field.
     * @var        int
     */
    protected $p15;

    /**
     * The value for the p16 field.
     * @var        int
     */
    protected $p16;

    /**
     * The value for the p17 field.
     * @var        int
     */
    protected $p17;

    /**
     * The value for the p18 field.
     * @var        int
     */
    protected $p18;

    /**
     * The value for the p19 field.
     * @var        int
     */
    protected $p19;

    /**
     * The value for the p20 field.
     * @var        int
     */
    protected $p20;

    /**
     * The value for the p21 field.
     * @var        int
     */
    protected $p21;

    /**
     * The value for the p22 field.
     * @var        int
     */
    protected $p22;

    /**
     * The value for the p23 field.
     * @var        int
     */
    protected $p23;

    /**
     * The value for the p24 field.
     * @var        int
     */
    protected $p24;

    /**
     * The value for the p25 field.
     * @var        int
     */
    protected $p25;

    /**
     * The value for the p26 field.
     * @var        int
     */
    protected $p26;

    /**
     * The value for the p27 field.
     * @var        int
     */
    protected $p27;

    /**
     * The value for the p28 field.
     * @var        int
     */
    protected $p28;

    /**
     * The value for the p29 field.
     * @var        int
     */
    protected $p29;

    /**
     * The value for the p30 field.
     * @var        int
     */
    protected $p30;

    /**
     * The value for the p31 field.
     * @var        int
     */
    protected $p31;

    /**
     * The value for the p32 field.
     * @var        int
     */
    protected $p32;

    /**
     * The value for the p33 field.
     * @var        int
     */
    protected $p33;

    /**
     * The value for the p34 field.
     * @var        int
     */
    protected $p34;

    /**
     * The value for the p35 field.
     * @var        int
     */
    protected $p35;

    /**
     * The value for the p1n field.
     * @var        string
     */
    protected $p1n;

    /**
     * The value for the p2n field.
     * @var        string
     */
    protected $p2n;

    /**
     * The value for the p3n field.
     * @var        string
     */
    protected $p3n;

    /**
     * The value for the p4n field.
     * @var        string
     */
    protected $p4n;

    /**
     * The value for the p5n field.
     * @var        string
     */
    protected $p5n;

    /**
     * The value for the p6n field.
     * @var        string
     */
    protected $p6n;

    /**
     * The value for the p7n field.
     * @var        string
     */
    protected $p7n;

    /**
     * The value for the p8n field.
     * @var        string
     */
    protected $p8n;

    /**
     * The value for the p9n field.
     * @var        string
     */
    protected $p9n;

    /**
     * The value for the p10n field.
     * @var        string
     */
    protected $p10n;

    /**
     * The value for the p11n field.
     * @var        string
     */
    protected $p11n;

    /**
     * The value for the p12n field.
     * @var        string
     */
    protected $p12n;

    /**
     * The value for the p13n field.
     * @var        string
     */
    protected $p13n;

    /**
     * The value for the p14n field.
     * @var        string
     */
    protected $p14n;

    /**
     * The value for the p15n field.
     * @var        string
     */
    protected $p15n;

    /**
     * The value for the p16n field.
     * @var        string
     */
    protected $p16n;

    /**
     * The value for the p17n field.
     * @var        string
     */
    protected $p17n;

    /**
     * The value for the p18n field.
     * @var        string
     */
    protected $p18n;

    /**
     * The value for the p19n field.
     * @var        string
     */
    protected $p19n;

    /**
     * The value for the p20n field.
     * @var        string
     */
    protected $p20n;

    /**
     * The value for the p21n field.
     * @var        string
     */
    protected $p21n;

    /**
     * The value for the p22n field.
     * @var        string
     */
    protected $p22n;

    /**
     * The value for the p23n field.
     * @var        string
     */
    protected $p23n;

    /**
     * The value for the p24n field.
     * @var        string
     */
    protected $p24n;

    /**
     * The value for the p25n field.
     * @var        string
     */
    protected $p25n;

    /**
     * The value for the p26n field.
     * @var        string
     */
    protected $p26n;

    /**
     * The value for the p27n field.
     * @var        string
     */
    protected $p27n;

    /**
     * The value for the p28n field.
     * @var        string
     */
    protected $p28n;

    /**
     * The value for the p29n field.
     * @var        string
     */
    protected $p29n;

    /**
     * The value for the p30n field.
     * @var        string
     */
    protected $p30n;

    /**
     * The value for the p31n field.
     * @var        string
     */
    protected $p31n;

    /**
     * The value for the p32n field.
     * @var        string
     */
    protected $p32n;

    /**
     * The value for the p33n field.
     * @var        string
     */
    protected $p33n;

    /**
     * The value for the p34n field.
     * @var        string
     */
    protected $p34n;

    /**
     * The value for the p35n field.
     * @var        string
     */
    protected $p35n;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var boolean
     */
    protected $alreadyInSave = false;

    /**
     * Initializes internal state of Tekstove\TekstoveBundle\Model\Entity\Base\Albums object.
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
     * Compares this with another <code>Albums</code> instance.  If
     * <code>obj</code> is an instance of <code>Albums</code>, delegates to
     * <code>equals(Albums)</code>.  Otherwise, returns <code>false</code>.
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
     * @return $this|Albums The current object, for fluid interface
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
     * Get the [id] column value.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
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
     * Get the [artist1id] column value.
     *
     * @return int
     */
    public function getArtist1id()
    {
        return $this->artist1id;
    }

    /**
     * Get the [artist2id] column value.
     *
     * @return int
     */
    public function getArtist2id()
    {
        return $this->artist2id;
    }

    /**
     * Get the [dopylnitelnoinfo] column value.
     *
     * @return string
     */
    public function getDopylnitelnoinfo()
    {
        return $this->dopylnitelnoinfo;
    }

    /**
     * Get the [year] column value.
     *
     * @return int
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * Get the [image] column value.
     *
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Get the [vid] column value.
     *
     * @return int
     */
    public function getVid()
    {
        return $this->vid;
    }

    /**
     * Get the [up_id] column value.
     *
     * @return int
     */
    public function getUpId()
    {
        return $this->up_id;
    }

    /**
     * Get the [va] column value.
     *
     * @return boolean
     */
    public function getVa()
    {
        return $this->va;
    }

    /**
     * Get the [va] column value.
     *
     * @return boolean
     */
    public function isVa()
    {
        return $this->getVa();
    }

    /**
     * Get the [p1] column value.
     *
     * @return int
     */
    public function getP1()
    {
        return $this->p1;
    }

    /**
     * Get the [p2] column value.
     *
     * @return int
     */
    public function getP2()
    {
        return $this->p2;
    }

    /**
     * Get the [p3] column value.
     *
     * @return int
     */
    public function getP3()
    {
        return $this->p3;
    }

    /**
     * Get the [p4] column value.
     *
     * @return int
     */
    public function getP4()
    {
        return $this->p4;
    }

    /**
     * Get the [p5] column value.
     *
     * @return int
     */
    public function getP5()
    {
        return $this->p5;
    }

    /**
     * Get the [p6] column value.
     *
     * @return int
     */
    public function getP6()
    {
        return $this->p6;
    }

    /**
     * Get the [p7] column value.
     *
     * @return int
     */
    public function getP7()
    {
        return $this->p7;
    }

    /**
     * Get the [p8] column value.
     *
     * @return int
     */
    public function getP8()
    {
        return $this->p8;
    }

    /**
     * Get the [p9] column value.
     *
     * @return int
     */
    public function getP9()
    {
        return $this->p9;
    }

    /**
     * Get the [p10] column value.
     *
     * @return int
     */
    public function getP10()
    {
        return $this->p10;
    }

    /**
     * Get the [p11] column value.
     *
     * @return int
     */
    public function getP11()
    {
        return $this->p11;
    }

    /**
     * Get the [p12] column value.
     *
     * @return int
     */
    public function getP12()
    {
        return $this->p12;
    }

    /**
     * Get the [p13] column value.
     *
     * @return int
     */
    public function getP13()
    {
        return $this->p13;
    }

    /**
     * Get the [p14] column value.
     *
     * @return int
     */
    public function getP14()
    {
        return $this->p14;
    }

    /**
     * Get the [p15] column value.
     *
     * @return int
     */
    public function getP15()
    {
        return $this->p15;
    }

    /**
     * Get the [p16] column value.
     *
     * @return int
     */
    public function getP16()
    {
        return $this->p16;
    }

    /**
     * Get the [p17] column value.
     *
     * @return int
     */
    public function getP17()
    {
        return $this->p17;
    }

    /**
     * Get the [p18] column value.
     *
     * @return int
     */
    public function getP18()
    {
        return $this->p18;
    }

    /**
     * Get the [p19] column value.
     *
     * @return int
     */
    public function getP19()
    {
        return $this->p19;
    }

    /**
     * Get the [p20] column value.
     *
     * @return int
     */
    public function getP20()
    {
        return $this->p20;
    }

    /**
     * Get the [p21] column value.
     *
     * @return int
     */
    public function getP21()
    {
        return $this->p21;
    }

    /**
     * Get the [p22] column value.
     *
     * @return int
     */
    public function getP22()
    {
        return $this->p22;
    }

    /**
     * Get the [p23] column value.
     *
     * @return int
     */
    public function getP23()
    {
        return $this->p23;
    }

    /**
     * Get the [p24] column value.
     *
     * @return int
     */
    public function getP24()
    {
        return $this->p24;
    }

    /**
     * Get the [p25] column value.
     *
     * @return int
     */
    public function getP25()
    {
        return $this->p25;
    }

    /**
     * Get the [p26] column value.
     *
     * @return int
     */
    public function getP26()
    {
        return $this->p26;
    }

    /**
     * Get the [p27] column value.
     *
     * @return int
     */
    public function getP27()
    {
        return $this->p27;
    }

    /**
     * Get the [p28] column value.
     *
     * @return int
     */
    public function getP28()
    {
        return $this->p28;
    }

    /**
     * Get the [p29] column value.
     *
     * @return int
     */
    public function getP29()
    {
        return $this->p29;
    }

    /**
     * Get the [p30] column value.
     *
     * @return int
     */
    public function getP30()
    {
        return $this->p30;
    }

    /**
     * Get the [p31] column value.
     *
     * @return int
     */
    public function getP31()
    {
        return $this->p31;
    }

    /**
     * Get the [p32] column value.
     *
     * @return int
     */
    public function getP32()
    {
        return $this->p32;
    }

    /**
     * Get the [p33] column value.
     *
     * @return int
     */
    public function getP33()
    {
        return $this->p33;
    }

    /**
     * Get the [p34] column value.
     *
     * @return int
     */
    public function getP34()
    {
        return $this->p34;
    }

    /**
     * Get the [p35] column value.
     *
     * @return int
     */
    public function getP35()
    {
        return $this->p35;
    }

    /**
     * Get the [p1n] column value.
     *
     * @return string
     */
    public function getP1n()
    {
        return $this->p1n;
    }

    /**
     * Get the [p2n] column value.
     *
     * @return string
     */
    public function getP2n()
    {
        return $this->p2n;
    }

    /**
     * Get the [p3n] column value.
     *
     * @return string
     */
    public function getP3n()
    {
        return $this->p3n;
    }

    /**
     * Get the [p4n] column value.
     *
     * @return string
     */
    public function getP4n()
    {
        return $this->p4n;
    }

    /**
     * Get the [p5n] column value.
     *
     * @return string
     */
    public function getP5n()
    {
        return $this->p5n;
    }

    /**
     * Get the [p6n] column value.
     *
     * @return string
     */
    public function getP6n()
    {
        return $this->p6n;
    }

    /**
     * Get the [p7n] column value.
     *
     * @return string
     */
    public function getP7n()
    {
        return $this->p7n;
    }

    /**
     * Get the [p8n] column value.
     *
     * @return string
     */
    public function getP8n()
    {
        return $this->p8n;
    }

    /**
     * Get the [p9n] column value.
     *
     * @return string
     */
    public function getP9n()
    {
        return $this->p9n;
    }

    /**
     * Get the [p10n] column value.
     *
     * @return string
     */
    public function getP10n()
    {
        return $this->p10n;
    }

    /**
     * Get the [p11n] column value.
     *
     * @return string
     */
    public function getP11n()
    {
        return $this->p11n;
    }

    /**
     * Get the [p12n] column value.
     *
     * @return string
     */
    public function getP12n()
    {
        return $this->p12n;
    }

    /**
     * Get the [p13n] column value.
     *
     * @return string
     */
    public function getP13n()
    {
        return $this->p13n;
    }

    /**
     * Get the [p14n] column value.
     *
     * @return string
     */
    public function getP14n()
    {
        return $this->p14n;
    }

    /**
     * Get the [p15n] column value.
     *
     * @return string
     */
    public function getP15n()
    {
        return $this->p15n;
    }

    /**
     * Get the [p16n] column value.
     *
     * @return string
     */
    public function getP16n()
    {
        return $this->p16n;
    }

    /**
     * Get the [p17n] column value.
     *
     * @return string
     */
    public function getP17n()
    {
        return $this->p17n;
    }

    /**
     * Get the [p18n] column value.
     *
     * @return string
     */
    public function getP18n()
    {
        return $this->p18n;
    }

    /**
     * Get the [p19n] column value.
     *
     * @return string
     */
    public function getP19n()
    {
        return $this->p19n;
    }

    /**
     * Get the [p20n] column value.
     *
     * @return string
     */
    public function getP20n()
    {
        return $this->p20n;
    }

    /**
     * Get the [p21n] column value.
     *
     * @return string
     */
    public function getP21n()
    {
        return $this->p21n;
    }

    /**
     * Get the [p22n] column value.
     *
     * @return string
     */
    public function getP22n()
    {
        return $this->p22n;
    }

    /**
     * Get the [p23n] column value.
     *
     * @return string
     */
    public function getP23n()
    {
        return $this->p23n;
    }

    /**
     * Get the [p24n] column value.
     *
     * @return string
     */
    public function getP24n()
    {
        return $this->p24n;
    }

    /**
     * Get the [p25n] column value.
     *
     * @return string
     */
    public function getP25n()
    {
        return $this->p25n;
    }

    /**
     * Get the [p26n] column value.
     *
     * @return string
     */
    public function getP26n()
    {
        return $this->p26n;
    }

    /**
     * Get the [p27n] column value.
     *
     * @return string
     */
    public function getP27n()
    {
        return $this->p27n;
    }

    /**
     * Get the [p28n] column value.
     *
     * @return string
     */
    public function getP28n()
    {
        return $this->p28n;
    }

    /**
     * Get the [p29n] column value.
     *
     * @return string
     */
    public function getP29n()
    {
        return $this->p29n;
    }

    /**
     * Get the [p30n] column value.
     *
     * @return string
     */
    public function getP30n()
    {
        return $this->p30n;
    }

    /**
     * Get the [p31n] column value.
     *
     * @return string
     */
    public function getP31n()
    {
        return $this->p31n;
    }

    /**
     * Get the [p32n] column value.
     *
     * @return string
     */
    public function getP32n()
    {
        return $this->p32n;
    }

    /**
     * Get the [p33n] column value.
     *
     * @return string
     */
    public function getP33n()
    {
        return $this->p33n;
    }

    /**
     * Get the [p34n] column value.
     *
     * @return string
     */
    public function getP34n()
    {
        return $this->p34n;
    }

    /**
     * Get the [p35n] column value.
     *
     * @return string
     */
    public function getP35n()
    {
        return $this->p35n;
    }

    /**
     * Set the value of [id] column.
     *
     * @param int $v new value
     * @return $this|\Tekstove\TekstoveBundle\Model\Entity\Albums The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[AlbumsTableMap::COL_ID] = true;
        }

        return $this;
    } // setId()

    /**
     * Set the value of [name] column.
     *
     * @param string $v new value
     * @return $this|\Tekstove\TekstoveBundle\Model\Entity\Albums The current object (for fluent API support)
     */
    public function setName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->name !== $v) {
            $this->name = $v;
            $this->modifiedColumns[AlbumsTableMap::COL_NAME] = true;
        }

        return $this;
    } // setName()

    /**
     * Set the value of [artist1id] column.
     *
     * @param int $v new value
     * @return $this|\Tekstove\TekstoveBundle\Model\Entity\Albums The current object (for fluent API support)
     */
    public function setArtist1id($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->artist1id !== $v) {
            $this->artist1id = $v;
            $this->modifiedColumns[AlbumsTableMap::COL_ARTIST1ID] = true;
        }

        return $this;
    } // setArtist1id()

    /**
     * Set the value of [artist2id] column.
     *
     * @param int $v new value
     * @return $this|\Tekstove\TekstoveBundle\Model\Entity\Albums The current object (for fluent API support)
     */
    public function setArtist2id($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->artist2id !== $v) {
            $this->artist2id = $v;
            $this->modifiedColumns[AlbumsTableMap::COL_ARTIST2ID] = true;
        }

        return $this;
    } // setArtist2id()

    /**
     * Set the value of [dopylnitelnoinfo] column.
     *
     * @param string $v new value
     * @return $this|\Tekstove\TekstoveBundle\Model\Entity\Albums The current object (for fluent API support)
     */
    public function setDopylnitelnoinfo($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->dopylnitelnoinfo !== $v) {
            $this->dopylnitelnoinfo = $v;
            $this->modifiedColumns[AlbumsTableMap::COL_DOPYLNITELNOINFO] = true;
        }

        return $this;
    } // setDopylnitelnoinfo()

    /**
     * Set the value of [year] column.
     *
     * @param int $v new value
     * @return $this|\Tekstove\TekstoveBundle\Model\Entity\Albums The current object (for fluent API support)
     */
    public function setYear($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->year !== $v) {
            $this->year = $v;
            $this->modifiedColumns[AlbumsTableMap::COL_YEAR] = true;
        }

        return $this;
    } // setYear()

    /**
     * Set the value of [image] column.
     *
     * @param string $v new value
     * @return $this|\Tekstove\TekstoveBundle\Model\Entity\Albums The current object (for fluent API support)
     */
    public function setImage($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->image !== $v) {
            $this->image = $v;
            $this->modifiedColumns[AlbumsTableMap::COL_IMAGE] = true;
        }

        return $this;
    } // setImage()

    /**
     * Set the value of [vid] column.
     *
     * @param int $v new value
     * @return $this|\Tekstove\TekstoveBundle\Model\Entity\Albums The current object (for fluent API support)
     */
    public function setVid($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->vid !== $v) {
            $this->vid = $v;
            $this->modifiedColumns[AlbumsTableMap::COL_VID] = true;
        }

        return $this;
    } // setVid()

    /**
     * Set the value of [up_id] column.
     *
     * @param int $v new value
     * @return $this|\Tekstove\TekstoveBundle\Model\Entity\Albums The current object (for fluent API support)
     */
    public function setUpId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->up_id !== $v) {
            $this->up_id = $v;
            $this->modifiedColumns[AlbumsTableMap::COL_UP_ID] = true;
        }

        return $this;
    } // setUpId()

    /**
     * Sets the value of the [va] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param  boolean|integer|string $v The new value
     * @return $this|\Tekstove\TekstoveBundle\Model\Entity\Albums The current object (for fluent API support)
     */
    public function setVa($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->va !== $v) {
            $this->va = $v;
            $this->modifiedColumns[AlbumsTableMap::COL_VA] = true;
        }

        return $this;
    } // setVa()

    /**
     * Set the value of [p1] column.
     *
     * @param int $v new value
     * @return $this|\Tekstove\TekstoveBundle\Model\Entity\Albums The current object (for fluent API support)
     */
    public function setP1($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->p1 !== $v) {
            $this->p1 = $v;
            $this->modifiedColumns[AlbumsTableMap::COL_P1] = true;
        }

        return $this;
    } // setP1()

    /**
     * Set the value of [p2] column.
     *
     * @param int $v new value
     * @return $this|\Tekstove\TekstoveBundle\Model\Entity\Albums The current object (for fluent API support)
     */
    public function setP2($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->p2 !== $v) {
            $this->p2 = $v;
            $this->modifiedColumns[AlbumsTableMap::COL_P2] = true;
        }

        return $this;
    } // setP2()

    /**
     * Set the value of [p3] column.
     *
     * @param int $v new value
     * @return $this|\Tekstove\TekstoveBundle\Model\Entity\Albums The current object (for fluent API support)
     */
    public function setP3($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->p3 !== $v) {
            $this->p3 = $v;
            $this->modifiedColumns[AlbumsTableMap::COL_P3] = true;
        }

        return $this;
    } // setP3()

    /**
     * Set the value of [p4] column.
     *
     * @param int $v new value
     * @return $this|\Tekstove\TekstoveBundle\Model\Entity\Albums The current object (for fluent API support)
     */
    public function setP4($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->p4 !== $v) {
            $this->p4 = $v;
            $this->modifiedColumns[AlbumsTableMap::COL_P4] = true;
        }

        return $this;
    } // setP4()

    /**
     * Set the value of [p5] column.
     *
     * @param int $v new value
     * @return $this|\Tekstove\TekstoveBundle\Model\Entity\Albums The current object (for fluent API support)
     */
    public function setP5($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->p5 !== $v) {
            $this->p5 = $v;
            $this->modifiedColumns[AlbumsTableMap::COL_P5] = true;
        }

        return $this;
    } // setP5()

    /**
     * Set the value of [p6] column.
     *
     * @param int $v new value
     * @return $this|\Tekstove\TekstoveBundle\Model\Entity\Albums The current object (for fluent API support)
     */
    public function setP6($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->p6 !== $v) {
            $this->p6 = $v;
            $this->modifiedColumns[AlbumsTableMap::COL_P6] = true;
        }

        return $this;
    } // setP6()

    /**
     * Set the value of [p7] column.
     *
     * @param int $v new value
     * @return $this|\Tekstove\TekstoveBundle\Model\Entity\Albums The current object (for fluent API support)
     */
    public function setP7($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->p7 !== $v) {
            $this->p7 = $v;
            $this->modifiedColumns[AlbumsTableMap::COL_P7] = true;
        }

        return $this;
    } // setP7()

    /**
     * Set the value of [p8] column.
     *
     * @param int $v new value
     * @return $this|\Tekstove\TekstoveBundle\Model\Entity\Albums The current object (for fluent API support)
     */
    public function setP8($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->p8 !== $v) {
            $this->p8 = $v;
            $this->modifiedColumns[AlbumsTableMap::COL_P8] = true;
        }

        return $this;
    } // setP8()

    /**
     * Set the value of [p9] column.
     *
     * @param int $v new value
     * @return $this|\Tekstove\TekstoveBundle\Model\Entity\Albums The current object (for fluent API support)
     */
    public function setP9($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->p9 !== $v) {
            $this->p9 = $v;
            $this->modifiedColumns[AlbumsTableMap::COL_P9] = true;
        }

        return $this;
    } // setP9()

    /**
     * Set the value of [p10] column.
     *
     * @param int $v new value
     * @return $this|\Tekstove\TekstoveBundle\Model\Entity\Albums The current object (for fluent API support)
     */
    public function setP10($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->p10 !== $v) {
            $this->p10 = $v;
            $this->modifiedColumns[AlbumsTableMap::COL_P10] = true;
        }

        return $this;
    } // setP10()

    /**
     * Set the value of [p11] column.
     *
     * @param int $v new value
     * @return $this|\Tekstove\TekstoveBundle\Model\Entity\Albums The current object (for fluent API support)
     */
    public function setP11($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->p11 !== $v) {
            $this->p11 = $v;
            $this->modifiedColumns[AlbumsTableMap::COL_P11] = true;
        }

        return $this;
    } // setP11()

    /**
     * Set the value of [p12] column.
     *
     * @param int $v new value
     * @return $this|\Tekstove\TekstoveBundle\Model\Entity\Albums The current object (for fluent API support)
     */
    public function setP12($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->p12 !== $v) {
            $this->p12 = $v;
            $this->modifiedColumns[AlbumsTableMap::COL_P12] = true;
        }

        return $this;
    } // setP12()

    /**
     * Set the value of [p13] column.
     *
     * @param int $v new value
     * @return $this|\Tekstove\TekstoveBundle\Model\Entity\Albums The current object (for fluent API support)
     */
    public function setP13($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->p13 !== $v) {
            $this->p13 = $v;
            $this->modifiedColumns[AlbumsTableMap::COL_P13] = true;
        }

        return $this;
    } // setP13()

    /**
     * Set the value of [p14] column.
     *
     * @param int $v new value
     * @return $this|\Tekstove\TekstoveBundle\Model\Entity\Albums The current object (for fluent API support)
     */
    public function setP14($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->p14 !== $v) {
            $this->p14 = $v;
            $this->modifiedColumns[AlbumsTableMap::COL_P14] = true;
        }

        return $this;
    } // setP14()

    /**
     * Set the value of [p15] column.
     *
     * @param int $v new value
     * @return $this|\Tekstove\TekstoveBundle\Model\Entity\Albums The current object (for fluent API support)
     */
    public function setP15($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->p15 !== $v) {
            $this->p15 = $v;
            $this->modifiedColumns[AlbumsTableMap::COL_P15] = true;
        }

        return $this;
    } // setP15()

    /**
     * Set the value of [p16] column.
     *
     * @param int $v new value
     * @return $this|\Tekstove\TekstoveBundle\Model\Entity\Albums The current object (for fluent API support)
     */
    public function setP16($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->p16 !== $v) {
            $this->p16 = $v;
            $this->modifiedColumns[AlbumsTableMap::COL_P16] = true;
        }

        return $this;
    } // setP16()

    /**
     * Set the value of [p17] column.
     *
     * @param int $v new value
     * @return $this|\Tekstove\TekstoveBundle\Model\Entity\Albums The current object (for fluent API support)
     */
    public function setP17($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->p17 !== $v) {
            $this->p17 = $v;
            $this->modifiedColumns[AlbumsTableMap::COL_P17] = true;
        }

        return $this;
    } // setP17()

    /**
     * Set the value of [p18] column.
     *
     * @param int $v new value
     * @return $this|\Tekstove\TekstoveBundle\Model\Entity\Albums The current object (for fluent API support)
     */
    public function setP18($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->p18 !== $v) {
            $this->p18 = $v;
            $this->modifiedColumns[AlbumsTableMap::COL_P18] = true;
        }

        return $this;
    } // setP18()

    /**
     * Set the value of [p19] column.
     *
     * @param int $v new value
     * @return $this|\Tekstove\TekstoveBundle\Model\Entity\Albums The current object (for fluent API support)
     */
    public function setP19($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->p19 !== $v) {
            $this->p19 = $v;
            $this->modifiedColumns[AlbumsTableMap::COL_P19] = true;
        }

        return $this;
    } // setP19()

    /**
     * Set the value of [p20] column.
     *
     * @param int $v new value
     * @return $this|\Tekstove\TekstoveBundle\Model\Entity\Albums The current object (for fluent API support)
     */
    public function setP20($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->p20 !== $v) {
            $this->p20 = $v;
            $this->modifiedColumns[AlbumsTableMap::COL_P20] = true;
        }

        return $this;
    } // setP20()

    /**
     * Set the value of [p21] column.
     *
     * @param int $v new value
     * @return $this|\Tekstove\TekstoveBundle\Model\Entity\Albums The current object (for fluent API support)
     */
    public function setP21($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->p21 !== $v) {
            $this->p21 = $v;
            $this->modifiedColumns[AlbumsTableMap::COL_P21] = true;
        }

        return $this;
    } // setP21()

    /**
     * Set the value of [p22] column.
     *
     * @param int $v new value
     * @return $this|\Tekstove\TekstoveBundle\Model\Entity\Albums The current object (for fluent API support)
     */
    public function setP22($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->p22 !== $v) {
            $this->p22 = $v;
            $this->modifiedColumns[AlbumsTableMap::COL_P22] = true;
        }

        return $this;
    } // setP22()

    /**
     * Set the value of [p23] column.
     *
     * @param int $v new value
     * @return $this|\Tekstove\TekstoveBundle\Model\Entity\Albums The current object (for fluent API support)
     */
    public function setP23($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->p23 !== $v) {
            $this->p23 = $v;
            $this->modifiedColumns[AlbumsTableMap::COL_P23] = true;
        }

        return $this;
    } // setP23()

    /**
     * Set the value of [p24] column.
     *
     * @param int $v new value
     * @return $this|\Tekstove\TekstoveBundle\Model\Entity\Albums The current object (for fluent API support)
     */
    public function setP24($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->p24 !== $v) {
            $this->p24 = $v;
            $this->modifiedColumns[AlbumsTableMap::COL_P24] = true;
        }

        return $this;
    } // setP24()

    /**
     * Set the value of [p25] column.
     *
     * @param int $v new value
     * @return $this|\Tekstove\TekstoveBundle\Model\Entity\Albums The current object (for fluent API support)
     */
    public function setP25($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->p25 !== $v) {
            $this->p25 = $v;
            $this->modifiedColumns[AlbumsTableMap::COL_P25] = true;
        }

        return $this;
    } // setP25()

    /**
     * Set the value of [p26] column.
     *
     * @param int $v new value
     * @return $this|\Tekstove\TekstoveBundle\Model\Entity\Albums The current object (for fluent API support)
     */
    public function setP26($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->p26 !== $v) {
            $this->p26 = $v;
            $this->modifiedColumns[AlbumsTableMap::COL_P26] = true;
        }

        return $this;
    } // setP26()

    /**
     * Set the value of [p27] column.
     *
     * @param int $v new value
     * @return $this|\Tekstove\TekstoveBundle\Model\Entity\Albums The current object (for fluent API support)
     */
    public function setP27($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->p27 !== $v) {
            $this->p27 = $v;
            $this->modifiedColumns[AlbumsTableMap::COL_P27] = true;
        }

        return $this;
    } // setP27()

    /**
     * Set the value of [p28] column.
     *
     * @param int $v new value
     * @return $this|\Tekstove\TekstoveBundle\Model\Entity\Albums The current object (for fluent API support)
     */
    public function setP28($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->p28 !== $v) {
            $this->p28 = $v;
            $this->modifiedColumns[AlbumsTableMap::COL_P28] = true;
        }

        return $this;
    } // setP28()

    /**
     * Set the value of [p29] column.
     *
     * @param int $v new value
     * @return $this|\Tekstove\TekstoveBundle\Model\Entity\Albums The current object (for fluent API support)
     */
    public function setP29($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->p29 !== $v) {
            $this->p29 = $v;
            $this->modifiedColumns[AlbumsTableMap::COL_P29] = true;
        }

        return $this;
    } // setP29()

    /**
     * Set the value of [p30] column.
     *
     * @param int $v new value
     * @return $this|\Tekstove\TekstoveBundle\Model\Entity\Albums The current object (for fluent API support)
     */
    public function setP30($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->p30 !== $v) {
            $this->p30 = $v;
            $this->modifiedColumns[AlbumsTableMap::COL_P30] = true;
        }

        return $this;
    } // setP30()

    /**
     * Set the value of [p31] column.
     *
     * @param int $v new value
     * @return $this|\Tekstove\TekstoveBundle\Model\Entity\Albums The current object (for fluent API support)
     */
    public function setP31($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->p31 !== $v) {
            $this->p31 = $v;
            $this->modifiedColumns[AlbumsTableMap::COL_P31] = true;
        }

        return $this;
    } // setP31()

    /**
     * Set the value of [p32] column.
     *
     * @param int $v new value
     * @return $this|\Tekstove\TekstoveBundle\Model\Entity\Albums The current object (for fluent API support)
     */
    public function setP32($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->p32 !== $v) {
            $this->p32 = $v;
            $this->modifiedColumns[AlbumsTableMap::COL_P32] = true;
        }

        return $this;
    } // setP32()

    /**
     * Set the value of [p33] column.
     *
     * @param int $v new value
     * @return $this|\Tekstove\TekstoveBundle\Model\Entity\Albums The current object (for fluent API support)
     */
    public function setP33($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->p33 !== $v) {
            $this->p33 = $v;
            $this->modifiedColumns[AlbumsTableMap::COL_P33] = true;
        }

        return $this;
    } // setP33()

    /**
     * Set the value of [p34] column.
     *
     * @param int $v new value
     * @return $this|\Tekstove\TekstoveBundle\Model\Entity\Albums The current object (for fluent API support)
     */
    public function setP34($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->p34 !== $v) {
            $this->p34 = $v;
            $this->modifiedColumns[AlbumsTableMap::COL_P34] = true;
        }

        return $this;
    } // setP34()

    /**
     * Set the value of [p35] column.
     *
     * @param int $v new value
     * @return $this|\Tekstove\TekstoveBundle\Model\Entity\Albums The current object (for fluent API support)
     */
    public function setP35($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->p35 !== $v) {
            $this->p35 = $v;
            $this->modifiedColumns[AlbumsTableMap::COL_P35] = true;
        }

        return $this;
    } // setP35()

    /**
     * Set the value of [p1n] column.
     *
     * @param string $v new value
     * @return $this|\Tekstove\TekstoveBundle\Model\Entity\Albums The current object (for fluent API support)
     */
    public function setP1n($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->p1n !== $v) {
            $this->p1n = $v;
            $this->modifiedColumns[AlbumsTableMap::COL_P1N] = true;
        }

        return $this;
    } // setP1n()

    /**
     * Set the value of [p2n] column.
     *
     * @param string $v new value
     * @return $this|\Tekstove\TekstoveBundle\Model\Entity\Albums The current object (for fluent API support)
     */
    public function setP2n($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->p2n !== $v) {
            $this->p2n = $v;
            $this->modifiedColumns[AlbumsTableMap::COL_P2N] = true;
        }

        return $this;
    } // setP2n()

    /**
     * Set the value of [p3n] column.
     *
     * @param string $v new value
     * @return $this|\Tekstove\TekstoveBundle\Model\Entity\Albums The current object (for fluent API support)
     */
    public function setP3n($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->p3n !== $v) {
            $this->p3n = $v;
            $this->modifiedColumns[AlbumsTableMap::COL_P3N] = true;
        }

        return $this;
    } // setP3n()

    /**
     * Set the value of [p4n] column.
     *
     * @param string $v new value
     * @return $this|\Tekstove\TekstoveBundle\Model\Entity\Albums The current object (for fluent API support)
     */
    public function setP4n($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->p4n !== $v) {
            $this->p4n = $v;
            $this->modifiedColumns[AlbumsTableMap::COL_P4N] = true;
        }

        return $this;
    } // setP4n()

    /**
     * Set the value of [p5n] column.
     *
     * @param string $v new value
     * @return $this|\Tekstove\TekstoveBundle\Model\Entity\Albums The current object (for fluent API support)
     */
    public function setP5n($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->p5n !== $v) {
            $this->p5n = $v;
            $this->modifiedColumns[AlbumsTableMap::COL_P5N] = true;
        }

        return $this;
    } // setP5n()

    /**
     * Set the value of [p6n] column.
     *
     * @param string $v new value
     * @return $this|\Tekstove\TekstoveBundle\Model\Entity\Albums The current object (for fluent API support)
     */
    public function setP6n($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->p6n !== $v) {
            $this->p6n = $v;
            $this->modifiedColumns[AlbumsTableMap::COL_P6N] = true;
        }

        return $this;
    } // setP6n()

    /**
     * Set the value of [p7n] column.
     *
     * @param string $v new value
     * @return $this|\Tekstove\TekstoveBundle\Model\Entity\Albums The current object (for fluent API support)
     */
    public function setP7n($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->p7n !== $v) {
            $this->p7n = $v;
            $this->modifiedColumns[AlbumsTableMap::COL_P7N] = true;
        }

        return $this;
    } // setP7n()

    /**
     * Set the value of [p8n] column.
     *
     * @param string $v new value
     * @return $this|\Tekstove\TekstoveBundle\Model\Entity\Albums The current object (for fluent API support)
     */
    public function setP8n($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->p8n !== $v) {
            $this->p8n = $v;
            $this->modifiedColumns[AlbumsTableMap::COL_P8N] = true;
        }

        return $this;
    } // setP8n()

    /**
     * Set the value of [p9n] column.
     *
     * @param string $v new value
     * @return $this|\Tekstove\TekstoveBundle\Model\Entity\Albums The current object (for fluent API support)
     */
    public function setP9n($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->p9n !== $v) {
            $this->p9n = $v;
            $this->modifiedColumns[AlbumsTableMap::COL_P9N] = true;
        }

        return $this;
    } // setP9n()

    /**
     * Set the value of [p10n] column.
     *
     * @param string $v new value
     * @return $this|\Tekstove\TekstoveBundle\Model\Entity\Albums The current object (for fluent API support)
     */
    public function setP10n($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->p10n !== $v) {
            $this->p10n = $v;
            $this->modifiedColumns[AlbumsTableMap::COL_P10N] = true;
        }

        return $this;
    } // setP10n()

    /**
     * Set the value of [p11n] column.
     *
     * @param string $v new value
     * @return $this|\Tekstove\TekstoveBundle\Model\Entity\Albums The current object (for fluent API support)
     */
    public function setP11n($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->p11n !== $v) {
            $this->p11n = $v;
            $this->modifiedColumns[AlbumsTableMap::COL_P11N] = true;
        }

        return $this;
    } // setP11n()

    /**
     * Set the value of [p12n] column.
     *
     * @param string $v new value
     * @return $this|\Tekstove\TekstoveBundle\Model\Entity\Albums The current object (for fluent API support)
     */
    public function setP12n($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->p12n !== $v) {
            $this->p12n = $v;
            $this->modifiedColumns[AlbumsTableMap::COL_P12N] = true;
        }

        return $this;
    } // setP12n()

    /**
     * Set the value of [p13n] column.
     *
     * @param string $v new value
     * @return $this|\Tekstove\TekstoveBundle\Model\Entity\Albums The current object (for fluent API support)
     */
    public function setP13n($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->p13n !== $v) {
            $this->p13n = $v;
            $this->modifiedColumns[AlbumsTableMap::COL_P13N] = true;
        }

        return $this;
    } // setP13n()

    /**
     * Set the value of [p14n] column.
     *
     * @param string $v new value
     * @return $this|\Tekstove\TekstoveBundle\Model\Entity\Albums The current object (for fluent API support)
     */
    public function setP14n($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->p14n !== $v) {
            $this->p14n = $v;
            $this->modifiedColumns[AlbumsTableMap::COL_P14N] = true;
        }

        return $this;
    } // setP14n()

    /**
     * Set the value of [p15n] column.
     *
     * @param string $v new value
     * @return $this|\Tekstove\TekstoveBundle\Model\Entity\Albums The current object (for fluent API support)
     */
    public function setP15n($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->p15n !== $v) {
            $this->p15n = $v;
            $this->modifiedColumns[AlbumsTableMap::COL_P15N] = true;
        }

        return $this;
    } // setP15n()

    /**
     * Set the value of [p16n] column.
     *
     * @param string $v new value
     * @return $this|\Tekstove\TekstoveBundle\Model\Entity\Albums The current object (for fluent API support)
     */
    public function setP16n($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->p16n !== $v) {
            $this->p16n = $v;
            $this->modifiedColumns[AlbumsTableMap::COL_P16N] = true;
        }

        return $this;
    } // setP16n()

    /**
     * Set the value of [p17n] column.
     *
     * @param string $v new value
     * @return $this|\Tekstove\TekstoveBundle\Model\Entity\Albums The current object (for fluent API support)
     */
    public function setP17n($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->p17n !== $v) {
            $this->p17n = $v;
            $this->modifiedColumns[AlbumsTableMap::COL_P17N] = true;
        }

        return $this;
    } // setP17n()

    /**
     * Set the value of [p18n] column.
     *
     * @param string $v new value
     * @return $this|\Tekstove\TekstoveBundle\Model\Entity\Albums The current object (for fluent API support)
     */
    public function setP18n($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->p18n !== $v) {
            $this->p18n = $v;
            $this->modifiedColumns[AlbumsTableMap::COL_P18N] = true;
        }

        return $this;
    } // setP18n()

    /**
     * Set the value of [p19n] column.
     *
     * @param string $v new value
     * @return $this|\Tekstove\TekstoveBundle\Model\Entity\Albums The current object (for fluent API support)
     */
    public function setP19n($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->p19n !== $v) {
            $this->p19n = $v;
            $this->modifiedColumns[AlbumsTableMap::COL_P19N] = true;
        }

        return $this;
    } // setP19n()

    /**
     * Set the value of [p20n] column.
     *
     * @param string $v new value
     * @return $this|\Tekstove\TekstoveBundle\Model\Entity\Albums The current object (for fluent API support)
     */
    public function setP20n($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->p20n !== $v) {
            $this->p20n = $v;
            $this->modifiedColumns[AlbumsTableMap::COL_P20N] = true;
        }

        return $this;
    } // setP20n()

    /**
     * Set the value of [p21n] column.
     *
     * @param string $v new value
     * @return $this|\Tekstove\TekstoveBundle\Model\Entity\Albums The current object (for fluent API support)
     */
    public function setP21n($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->p21n !== $v) {
            $this->p21n = $v;
            $this->modifiedColumns[AlbumsTableMap::COL_P21N] = true;
        }

        return $this;
    } // setP21n()

    /**
     * Set the value of [p22n] column.
     *
     * @param string $v new value
     * @return $this|\Tekstove\TekstoveBundle\Model\Entity\Albums The current object (for fluent API support)
     */
    public function setP22n($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->p22n !== $v) {
            $this->p22n = $v;
            $this->modifiedColumns[AlbumsTableMap::COL_P22N] = true;
        }

        return $this;
    } // setP22n()

    /**
     * Set the value of [p23n] column.
     *
     * @param string $v new value
     * @return $this|\Tekstove\TekstoveBundle\Model\Entity\Albums The current object (for fluent API support)
     */
    public function setP23n($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->p23n !== $v) {
            $this->p23n = $v;
            $this->modifiedColumns[AlbumsTableMap::COL_P23N] = true;
        }

        return $this;
    } // setP23n()

    /**
     * Set the value of [p24n] column.
     *
     * @param string $v new value
     * @return $this|\Tekstove\TekstoveBundle\Model\Entity\Albums The current object (for fluent API support)
     */
    public function setP24n($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->p24n !== $v) {
            $this->p24n = $v;
            $this->modifiedColumns[AlbumsTableMap::COL_P24N] = true;
        }

        return $this;
    } // setP24n()

    /**
     * Set the value of [p25n] column.
     *
     * @param string $v new value
     * @return $this|\Tekstove\TekstoveBundle\Model\Entity\Albums The current object (for fluent API support)
     */
    public function setP25n($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->p25n !== $v) {
            $this->p25n = $v;
            $this->modifiedColumns[AlbumsTableMap::COL_P25N] = true;
        }

        return $this;
    } // setP25n()

    /**
     * Set the value of [p26n] column.
     *
     * @param string $v new value
     * @return $this|\Tekstove\TekstoveBundle\Model\Entity\Albums The current object (for fluent API support)
     */
    public function setP26n($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->p26n !== $v) {
            $this->p26n = $v;
            $this->modifiedColumns[AlbumsTableMap::COL_P26N] = true;
        }

        return $this;
    } // setP26n()

    /**
     * Set the value of [p27n] column.
     *
     * @param string $v new value
     * @return $this|\Tekstove\TekstoveBundle\Model\Entity\Albums The current object (for fluent API support)
     */
    public function setP27n($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->p27n !== $v) {
            $this->p27n = $v;
            $this->modifiedColumns[AlbumsTableMap::COL_P27N] = true;
        }

        return $this;
    } // setP27n()

    /**
     * Set the value of [p28n] column.
     *
     * @param string $v new value
     * @return $this|\Tekstove\TekstoveBundle\Model\Entity\Albums The current object (for fluent API support)
     */
    public function setP28n($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->p28n !== $v) {
            $this->p28n = $v;
            $this->modifiedColumns[AlbumsTableMap::COL_P28N] = true;
        }

        return $this;
    } // setP28n()

    /**
     * Set the value of [p29n] column.
     *
     * @param string $v new value
     * @return $this|\Tekstove\TekstoveBundle\Model\Entity\Albums The current object (for fluent API support)
     */
    public function setP29n($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->p29n !== $v) {
            $this->p29n = $v;
            $this->modifiedColumns[AlbumsTableMap::COL_P29N] = true;
        }

        return $this;
    } // setP29n()

    /**
     * Set the value of [p30n] column.
     *
     * @param string $v new value
     * @return $this|\Tekstove\TekstoveBundle\Model\Entity\Albums The current object (for fluent API support)
     */
    public function setP30n($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->p30n !== $v) {
            $this->p30n = $v;
            $this->modifiedColumns[AlbumsTableMap::COL_P30N] = true;
        }

        return $this;
    } // setP30n()

    /**
     * Set the value of [p31n] column.
     *
     * @param string $v new value
     * @return $this|\Tekstove\TekstoveBundle\Model\Entity\Albums The current object (for fluent API support)
     */
    public function setP31n($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->p31n !== $v) {
            $this->p31n = $v;
            $this->modifiedColumns[AlbumsTableMap::COL_P31N] = true;
        }

        return $this;
    } // setP31n()

    /**
     * Set the value of [p32n] column.
     *
     * @param string $v new value
     * @return $this|\Tekstove\TekstoveBundle\Model\Entity\Albums The current object (for fluent API support)
     */
    public function setP32n($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->p32n !== $v) {
            $this->p32n = $v;
            $this->modifiedColumns[AlbumsTableMap::COL_P32N] = true;
        }

        return $this;
    } // setP32n()

    /**
     * Set the value of [p33n] column.
     *
     * @param string $v new value
     * @return $this|\Tekstove\TekstoveBundle\Model\Entity\Albums The current object (for fluent API support)
     */
    public function setP33n($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->p33n !== $v) {
            $this->p33n = $v;
            $this->modifiedColumns[AlbumsTableMap::COL_P33N] = true;
        }

        return $this;
    } // setP33n()

    /**
     * Set the value of [p34n] column.
     *
     * @param string $v new value
     * @return $this|\Tekstove\TekstoveBundle\Model\Entity\Albums The current object (for fluent API support)
     */
    public function setP34n($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->p34n !== $v) {
            $this->p34n = $v;
            $this->modifiedColumns[AlbumsTableMap::COL_P34N] = true;
        }

        return $this;
    } // setP34n()

    /**
     * Set the value of [p35n] column.
     *
     * @param string $v new value
     * @return $this|\Tekstove\TekstoveBundle\Model\Entity\Albums The current object (for fluent API support)
     */
    public function setP35n($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->p35n !== $v) {
            $this->p35n = $v;
            $this->modifiedColumns[AlbumsTableMap::COL_P35N] = true;
        }

        return $this;
    } // setP35n()

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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : AlbumsTableMap::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : AlbumsTableMap::translateFieldName('Name', TableMap::TYPE_PHPNAME, $indexType)];
            $this->name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : AlbumsTableMap::translateFieldName('Artist1id', TableMap::TYPE_PHPNAME, $indexType)];
            $this->artist1id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : AlbumsTableMap::translateFieldName('Artist2id', TableMap::TYPE_PHPNAME, $indexType)];
            $this->artist2id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : AlbumsTableMap::translateFieldName('Dopylnitelnoinfo', TableMap::TYPE_PHPNAME, $indexType)];
            $this->dopylnitelnoinfo = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : AlbumsTableMap::translateFieldName('Year', TableMap::TYPE_PHPNAME, $indexType)];
            $this->year = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : AlbumsTableMap::translateFieldName('Image', TableMap::TYPE_PHPNAME, $indexType)];
            $this->image = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : AlbumsTableMap::translateFieldName('Vid', TableMap::TYPE_PHPNAME, $indexType)];
            $this->vid = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : AlbumsTableMap::translateFieldName('UpId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->up_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : AlbumsTableMap::translateFieldName('Va', TableMap::TYPE_PHPNAME, $indexType)];
            $this->va = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 10 + $startcol : AlbumsTableMap::translateFieldName('P1', TableMap::TYPE_PHPNAME, $indexType)];
            $this->p1 = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 11 + $startcol : AlbumsTableMap::translateFieldName('P2', TableMap::TYPE_PHPNAME, $indexType)];
            $this->p2 = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 12 + $startcol : AlbumsTableMap::translateFieldName('P3', TableMap::TYPE_PHPNAME, $indexType)];
            $this->p3 = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 13 + $startcol : AlbumsTableMap::translateFieldName('P4', TableMap::TYPE_PHPNAME, $indexType)];
            $this->p4 = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 14 + $startcol : AlbumsTableMap::translateFieldName('P5', TableMap::TYPE_PHPNAME, $indexType)];
            $this->p5 = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 15 + $startcol : AlbumsTableMap::translateFieldName('P6', TableMap::TYPE_PHPNAME, $indexType)];
            $this->p6 = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 16 + $startcol : AlbumsTableMap::translateFieldName('P7', TableMap::TYPE_PHPNAME, $indexType)];
            $this->p7 = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 17 + $startcol : AlbumsTableMap::translateFieldName('P8', TableMap::TYPE_PHPNAME, $indexType)];
            $this->p8 = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 18 + $startcol : AlbumsTableMap::translateFieldName('P9', TableMap::TYPE_PHPNAME, $indexType)];
            $this->p9 = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 19 + $startcol : AlbumsTableMap::translateFieldName('P10', TableMap::TYPE_PHPNAME, $indexType)];
            $this->p10 = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 20 + $startcol : AlbumsTableMap::translateFieldName('P11', TableMap::TYPE_PHPNAME, $indexType)];
            $this->p11 = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 21 + $startcol : AlbumsTableMap::translateFieldName('P12', TableMap::TYPE_PHPNAME, $indexType)];
            $this->p12 = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 22 + $startcol : AlbumsTableMap::translateFieldName('P13', TableMap::TYPE_PHPNAME, $indexType)];
            $this->p13 = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 23 + $startcol : AlbumsTableMap::translateFieldName('P14', TableMap::TYPE_PHPNAME, $indexType)];
            $this->p14 = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 24 + $startcol : AlbumsTableMap::translateFieldName('P15', TableMap::TYPE_PHPNAME, $indexType)];
            $this->p15 = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 25 + $startcol : AlbumsTableMap::translateFieldName('P16', TableMap::TYPE_PHPNAME, $indexType)];
            $this->p16 = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 26 + $startcol : AlbumsTableMap::translateFieldName('P17', TableMap::TYPE_PHPNAME, $indexType)];
            $this->p17 = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 27 + $startcol : AlbumsTableMap::translateFieldName('P18', TableMap::TYPE_PHPNAME, $indexType)];
            $this->p18 = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 28 + $startcol : AlbumsTableMap::translateFieldName('P19', TableMap::TYPE_PHPNAME, $indexType)];
            $this->p19 = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 29 + $startcol : AlbumsTableMap::translateFieldName('P20', TableMap::TYPE_PHPNAME, $indexType)];
            $this->p20 = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 30 + $startcol : AlbumsTableMap::translateFieldName('P21', TableMap::TYPE_PHPNAME, $indexType)];
            $this->p21 = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 31 + $startcol : AlbumsTableMap::translateFieldName('P22', TableMap::TYPE_PHPNAME, $indexType)];
            $this->p22 = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 32 + $startcol : AlbumsTableMap::translateFieldName('P23', TableMap::TYPE_PHPNAME, $indexType)];
            $this->p23 = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 33 + $startcol : AlbumsTableMap::translateFieldName('P24', TableMap::TYPE_PHPNAME, $indexType)];
            $this->p24 = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 34 + $startcol : AlbumsTableMap::translateFieldName('P25', TableMap::TYPE_PHPNAME, $indexType)];
            $this->p25 = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 35 + $startcol : AlbumsTableMap::translateFieldName('P26', TableMap::TYPE_PHPNAME, $indexType)];
            $this->p26 = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 36 + $startcol : AlbumsTableMap::translateFieldName('P27', TableMap::TYPE_PHPNAME, $indexType)];
            $this->p27 = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 37 + $startcol : AlbumsTableMap::translateFieldName('P28', TableMap::TYPE_PHPNAME, $indexType)];
            $this->p28 = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 38 + $startcol : AlbumsTableMap::translateFieldName('P29', TableMap::TYPE_PHPNAME, $indexType)];
            $this->p29 = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 39 + $startcol : AlbumsTableMap::translateFieldName('P30', TableMap::TYPE_PHPNAME, $indexType)];
            $this->p30 = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 40 + $startcol : AlbumsTableMap::translateFieldName('P31', TableMap::TYPE_PHPNAME, $indexType)];
            $this->p31 = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 41 + $startcol : AlbumsTableMap::translateFieldName('P32', TableMap::TYPE_PHPNAME, $indexType)];
            $this->p32 = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 42 + $startcol : AlbumsTableMap::translateFieldName('P33', TableMap::TYPE_PHPNAME, $indexType)];
            $this->p33 = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 43 + $startcol : AlbumsTableMap::translateFieldName('P34', TableMap::TYPE_PHPNAME, $indexType)];
            $this->p34 = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 44 + $startcol : AlbumsTableMap::translateFieldName('P35', TableMap::TYPE_PHPNAME, $indexType)];
            $this->p35 = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 45 + $startcol : AlbumsTableMap::translateFieldName('P1n', TableMap::TYPE_PHPNAME, $indexType)];
            $this->p1n = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 46 + $startcol : AlbumsTableMap::translateFieldName('P2n', TableMap::TYPE_PHPNAME, $indexType)];
            $this->p2n = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 47 + $startcol : AlbumsTableMap::translateFieldName('P3n', TableMap::TYPE_PHPNAME, $indexType)];
            $this->p3n = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 48 + $startcol : AlbumsTableMap::translateFieldName('P4n', TableMap::TYPE_PHPNAME, $indexType)];
            $this->p4n = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 49 + $startcol : AlbumsTableMap::translateFieldName('P5n', TableMap::TYPE_PHPNAME, $indexType)];
            $this->p5n = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 50 + $startcol : AlbumsTableMap::translateFieldName('P6n', TableMap::TYPE_PHPNAME, $indexType)];
            $this->p6n = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 51 + $startcol : AlbumsTableMap::translateFieldName('P7n', TableMap::TYPE_PHPNAME, $indexType)];
            $this->p7n = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 52 + $startcol : AlbumsTableMap::translateFieldName('P8n', TableMap::TYPE_PHPNAME, $indexType)];
            $this->p8n = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 53 + $startcol : AlbumsTableMap::translateFieldName('P9n', TableMap::TYPE_PHPNAME, $indexType)];
            $this->p9n = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 54 + $startcol : AlbumsTableMap::translateFieldName('P10n', TableMap::TYPE_PHPNAME, $indexType)];
            $this->p10n = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 55 + $startcol : AlbumsTableMap::translateFieldName('P11n', TableMap::TYPE_PHPNAME, $indexType)];
            $this->p11n = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 56 + $startcol : AlbumsTableMap::translateFieldName('P12n', TableMap::TYPE_PHPNAME, $indexType)];
            $this->p12n = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 57 + $startcol : AlbumsTableMap::translateFieldName('P13n', TableMap::TYPE_PHPNAME, $indexType)];
            $this->p13n = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 58 + $startcol : AlbumsTableMap::translateFieldName('P14n', TableMap::TYPE_PHPNAME, $indexType)];
            $this->p14n = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 59 + $startcol : AlbumsTableMap::translateFieldName('P15n', TableMap::TYPE_PHPNAME, $indexType)];
            $this->p15n = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 60 + $startcol : AlbumsTableMap::translateFieldName('P16n', TableMap::TYPE_PHPNAME, $indexType)];
            $this->p16n = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 61 + $startcol : AlbumsTableMap::translateFieldName('P17n', TableMap::TYPE_PHPNAME, $indexType)];
            $this->p17n = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 62 + $startcol : AlbumsTableMap::translateFieldName('P18n', TableMap::TYPE_PHPNAME, $indexType)];
            $this->p18n = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 63 + $startcol : AlbumsTableMap::translateFieldName('P19n', TableMap::TYPE_PHPNAME, $indexType)];
            $this->p19n = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 64 + $startcol : AlbumsTableMap::translateFieldName('P20n', TableMap::TYPE_PHPNAME, $indexType)];
            $this->p20n = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 65 + $startcol : AlbumsTableMap::translateFieldName('P21n', TableMap::TYPE_PHPNAME, $indexType)];
            $this->p21n = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 66 + $startcol : AlbumsTableMap::translateFieldName('P22n', TableMap::TYPE_PHPNAME, $indexType)];
            $this->p22n = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 67 + $startcol : AlbumsTableMap::translateFieldName('P23n', TableMap::TYPE_PHPNAME, $indexType)];
            $this->p23n = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 68 + $startcol : AlbumsTableMap::translateFieldName('P24n', TableMap::TYPE_PHPNAME, $indexType)];
            $this->p24n = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 69 + $startcol : AlbumsTableMap::translateFieldName('P25n', TableMap::TYPE_PHPNAME, $indexType)];
            $this->p25n = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 70 + $startcol : AlbumsTableMap::translateFieldName('P26n', TableMap::TYPE_PHPNAME, $indexType)];
            $this->p26n = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 71 + $startcol : AlbumsTableMap::translateFieldName('P27n', TableMap::TYPE_PHPNAME, $indexType)];
            $this->p27n = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 72 + $startcol : AlbumsTableMap::translateFieldName('P28n', TableMap::TYPE_PHPNAME, $indexType)];
            $this->p28n = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 73 + $startcol : AlbumsTableMap::translateFieldName('P29n', TableMap::TYPE_PHPNAME, $indexType)];
            $this->p29n = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 74 + $startcol : AlbumsTableMap::translateFieldName('P30n', TableMap::TYPE_PHPNAME, $indexType)];
            $this->p30n = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 75 + $startcol : AlbumsTableMap::translateFieldName('P31n', TableMap::TYPE_PHPNAME, $indexType)];
            $this->p31n = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 76 + $startcol : AlbumsTableMap::translateFieldName('P32n', TableMap::TYPE_PHPNAME, $indexType)];
            $this->p32n = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 77 + $startcol : AlbumsTableMap::translateFieldName('P33n', TableMap::TYPE_PHPNAME, $indexType)];
            $this->p33n = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 78 + $startcol : AlbumsTableMap::translateFieldName('P34n', TableMap::TYPE_PHPNAME, $indexType)];
            $this->p34n = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 79 + $startcol : AlbumsTableMap::translateFieldName('P35n', TableMap::TYPE_PHPNAME, $indexType)];
            $this->p35n = (null !== $col) ? (string) $col : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 80; // 80 = AlbumsTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\Tekstove\\TekstoveBundle\\Model\\Entity\\Albums'), 0, $e);
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
            $con = Propel::getServiceContainer()->getReadConnection(AlbumsTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildAlbumsQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see Albums::setDeleted()
     * @see Albums::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(AlbumsTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildAlbumsQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(AlbumsTableMap::DATABASE_NAME);
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
                AlbumsTableMap::addInstanceToPool($this);
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

        $this->modifiedColumns[AlbumsTableMap::COL_ID] = true;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . AlbumsTableMap::COL_ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(AlbumsTableMap::COL_ID)) {
            $modifiedColumns[':p' . $index++]  = 'id';
        }
        if ($this->isColumnModified(AlbumsTableMap::COL_NAME)) {
            $modifiedColumns[':p' . $index++]  = 'name';
        }
        if ($this->isColumnModified(AlbumsTableMap::COL_ARTIST1ID)) {
            $modifiedColumns[':p' . $index++]  = 'artist1id';
        }
        if ($this->isColumnModified(AlbumsTableMap::COL_ARTIST2ID)) {
            $modifiedColumns[':p' . $index++]  = 'artist2id';
        }
        if ($this->isColumnModified(AlbumsTableMap::COL_DOPYLNITELNOINFO)) {
            $modifiedColumns[':p' . $index++]  = 'dopylnitelnoinfo';
        }
        if ($this->isColumnModified(AlbumsTableMap::COL_YEAR)) {
            $modifiedColumns[':p' . $index++]  = 'year';
        }
        if ($this->isColumnModified(AlbumsTableMap::COL_IMAGE)) {
            $modifiedColumns[':p' . $index++]  = 'image';
        }
        if ($this->isColumnModified(AlbumsTableMap::COL_VID)) {
            $modifiedColumns[':p' . $index++]  = 'vid';
        }
        if ($this->isColumnModified(AlbumsTableMap::COL_UP_ID)) {
            $modifiedColumns[':p' . $index++]  = 'up_id';
        }
        if ($this->isColumnModified(AlbumsTableMap::COL_VA)) {
            $modifiedColumns[':p' . $index++]  = 'va';
        }
        if ($this->isColumnModified(AlbumsTableMap::COL_P1)) {
            $modifiedColumns[':p' . $index++]  = 'p1';
        }
        if ($this->isColumnModified(AlbumsTableMap::COL_P2)) {
            $modifiedColumns[':p' . $index++]  = 'p2';
        }
        if ($this->isColumnModified(AlbumsTableMap::COL_P3)) {
            $modifiedColumns[':p' . $index++]  = 'p3';
        }
        if ($this->isColumnModified(AlbumsTableMap::COL_P4)) {
            $modifiedColumns[':p' . $index++]  = 'p4';
        }
        if ($this->isColumnModified(AlbumsTableMap::COL_P5)) {
            $modifiedColumns[':p' . $index++]  = 'p5';
        }
        if ($this->isColumnModified(AlbumsTableMap::COL_P6)) {
            $modifiedColumns[':p' . $index++]  = 'p6';
        }
        if ($this->isColumnModified(AlbumsTableMap::COL_P7)) {
            $modifiedColumns[':p' . $index++]  = 'p7';
        }
        if ($this->isColumnModified(AlbumsTableMap::COL_P8)) {
            $modifiedColumns[':p' . $index++]  = 'p8';
        }
        if ($this->isColumnModified(AlbumsTableMap::COL_P9)) {
            $modifiedColumns[':p' . $index++]  = 'p9';
        }
        if ($this->isColumnModified(AlbumsTableMap::COL_P10)) {
            $modifiedColumns[':p' . $index++]  = 'p10';
        }
        if ($this->isColumnModified(AlbumsTableMap::COL_P11)) {
            $modifiedColumns[':p' . $index++]  = 'p11';
        }
        if ($this->isColumnModified(AlbumsTableMap::COL_P12)) {
            $modifiedColumns[':p' . $index++]  = 'p12';
        }
        if ($this->isColumnModified(AlbumsTableMap::COL_P13)) {
            $modifiedColumns[':p' . $index++]  = 'p13';
        }
        if ($this->isColumnModified(AlbumsTableMap::COL_P14)) {
            $modifiedColumns[':p' . $index++]  = 'p14';
        }
        if ($this->isColumnModified(AlbumsTableMap::COL_P15)) {
            $modifiedColumns[':p' . $index++]  = 'p15';
        }
        if ($this->isColumnModified(AlbumsTableMap::COL_P16)) {
            $modifiedColumns[':p' . $index++]  = 'p16';
        }
        if ($this->isColumnModified(AlbumsTableMap::COL_P17)) {
            $modifiedColumns[':p' . $index++]  = 'p17';
        }
        if ($this->isColumnModified(AlbumsTableMap::COL_P18)) {
            $modifiedColumns[':p' . $index++]  = 'p18';
        }
        if ($this->isColumnModified(AlbumsTableMap::COL_P19)) {
            $modifiedColumns[':p' . $index++]  = 'p19';
        }
        if ($this->isColumnModified(AlbumsTableMap::COL_P20)) {
            $modifiedColumns[':p' . $index++]  = 'p20';
        }
        if ($this->isColumnModified(AlbumsTableMap::COL_P21)) {
            $modifiedColumns[':p' . $index++]  = 'p21';
        }
        if ($this->isColumnModified(AlbumsTableMap::COL_P22)) {
            $modifiedColumns[':p' . $index++]  = 'p22';
        }
        if ($this->isColumnModified(AlbumsTableMap::COL_P23)) {
            $modifiedColumns[':p' . $index++]  = 'p23';
        }
        if ($this->isColumnModified(AlbumsTableMap::COL_P24)) {
            $modifiedColumns[':p' . $index++]  = 'p24';
        }
        if ($this->isColumnModified(AlbumsTableMap::COL_P25)) {
            $modifiedColumns[':p' . $index++]  = 'p25';
        }
        if ($this->isColumnModified(AlbumsTableMap::COL_P26)) {
            $modifiedColumns[':p' . $index++]  = 'p26';
        }
        if ($this->isColumnModified(AlbumsTableMap::COL_P27)) {
            $modifiedColumns[':p' . $index++]  = 'p27';
        }
        if ($this->isColumnModified(AlbumsTableMap::COL_P28)) {
            $modifiedColumns[':p' . $index++]  = 'p28';
        }
        if ($this->isColumnModified(AlbumsTableMap::COL_P29)) {
            $modifiedColumns[':p' . $index++]  = 'p29';
        }
        if ($this->isColumnModified(AlbumsTableMap::COL_P30)) {
            $modifiedColumns[':p' . $index++]  = 'p30';
        }
        if ($this->isColumnModified(AlbumsTableMap::COL_P31)) {
            $modifiedColumns[':p' . $index++]  = 'p31';
        }
        if ($this->isColumnModified(AlbumsTableMap::COL_P32)) {
            $modifiedColumns[':p' . $index++]  = 'p32';
        }
        if ($this->isColumnModified(AlbumsTableMap::COL_P33)) {
            $modifiedColumns[':p' . $index++]  = 'p33';
        }
        if ($this->isColumnModified(AlbumsTableMap::COL_P34)) {
            $modifiedColumns[':p' . $index++]  = 'p34';
        }
        if ($this->isColumnModified(AlbumsTableMap::COL_P35)) {
            $modifiedColumns[':p' . $index++]  = 'p35';
        }
        if ($this->isColumnModified(AlbumsTableMap::COL_P1N)) {
            $modifiedColumns[':p' . $index++]  = 'p1n';
        }
        if ($this->isColumnModified(AlbumsTableMap::COL_P2N)) {
            $modifiedColumns[':p' . $index++]  = 'p2n';
        }
        if ($this->isColumnModified(AlbumsTableMap::COL_P3N)) {
            $modifiedColumns[':p' . $index++]  = 'p3n';
        }
        if ($this->isColumnModified(AlbumsTableMap::COL_P4N)) {
            $modifiedColumns[':p' . $index++]  = 'p4n';
        }
        if ($this->isColumnModified(AlbumsTableMap::COL_P5N)) {
            $modifiedColumns[':p' . $index++]  = 'p5n';
        }
        if ($this->isColumnModified(AlbumsTableMap::COL_P6N)) {
            $modifiedColumns[':p' . $index++]  = 'p6n';
        }
        if ($this->isColumnModified(AlbumsTableMap::COL_P7N)) {
            $modifiedColumns[':p' . $index++]  = 'p7n';
        }
        if ($this->isColumnModified(AlbumsTableMap::COL_P8N)) {
            $modifiedColumns[':p' . $index++]  = 'p8n';
        }
        if ($this->isColumnModified(AlbumsTableMap::COL_P9N)) {
            $modifiedColumns[':p' . $index++]  = 'p9n';
        }
        if ($this->isColumnModified(AlbumsTableMap::COL_P10N)) {
            $modifiedColumns[':p' . $index++]  = 'p10n';
        }
        if ($this->isColumnModified(AlbumsTableMap::COL_P11N)) {
            $modifiedColumns[':p' . $index++]  = 'p11n';
        }
        if ($this->isColumnModified(AlbumsTableMap::COL_P12N)) {
            $modifiedColumns[':p' . $index++]  = 'p12n';
        }
        if ($this->isColumnModified(AlbumsTableMap::COL_P13N)) {
            $modifiedColumns[':p' . $index++]  = 'p13n';
        }
        if ($this->isColumnModified(AlbumsTableMap::COL_P14N)) {
            $modifiedColumns[':p' . $index++]  = 'p14n';
        }
        if ($this->isColumnModified(AlbumsTableMap::COL_P15N)) {
            $modifiedColumns[':p' . $index++]  = 'p15n';
        }
        if ($this->isColumnModified(AlbumsTableMap::COL_P16N)) {
            $modifiedColumns[':p' . $index++]  = 'p16n';
        }
        if ($this->isColumnModified(AlbumsTableMap::COL_P17N)) {
            $modifiedColumns[':p' . $index++]  = 'p17n';
        }
        if ($this->isColumnModified(AlbumsTableMap::COL_P18N)) {
            $modifiedColumns[':p' . $index++]  = 'p18n';
        }
        if ($this->isColumnModified(AlbumsTableMap::COL_P19N)) {
            $modifiedColumns[':p' . $index++]  = 'p19n';
        }
        if ($this->isColumnModified(AlbumsTableMap::COL_P20N)) {
            $modifiedColumns[':p' . $index++]  = 'p20n';
        }
        if ($this->isColumnModified(AlbumsTableMap::COL_P21N)) {
            $modifiedColumns[':p' . $index++]  = 'p21n';
        }
        if ($this->isColumnModified(AlbumsTableMap::COL_P22N)) {
            $modifiedColumns[':p' . $index++]  = 'p22n';
        }
        if ($this->isColumnModified(AlbumsTableMap::COL_P23N)) {
            $modifiedColumns[':p' . $index++]  = 'p23n';
        }
        if ($this->isColumnModified(AlbumsTableMap::COL_P24N)) {
            $modifiedColumns[':p' . $index++]  = 'p24n';
        }
        if ($this->isColumnModified(AlbumsTableMap::COL_P25N)) {
            $modifiedColumns[':p' . $index++]  = 'p25n';
        }
        if ($this->isColumnModified(AlbumsTableMap::COL_P26N)) {
            $modifiedColumns[':p' . $index++]  = 'p26n';
        }
        if ($this->isColumnModified(AlbumsTableMap::COL_P27N)) {
            $modifiedColumns[':p' . $index++]  = 'p27n';
        }
        if ($this->isColumnModified(AlbumsTableMap::COL_P28N)) {
            $modifiedColumns[':p' . $index++]  = 'p28n';
        }
        if ($this->isColumnModified(AlbumsTableMap::COL_P29N)) {
            $modifiedColumns[':p' . $index++]  = 'p29n';
        }
        if ($this->isColumnModified(AlbumsTableMap::COL_P30N)) {
            $modifiedColumns[':p' . $index++]  = 'p30n';
        }
        if ($this->isColumnModified(AlbumsTableMap::COL_P31N)) {
            $modifiedColumns[':p' . $index++]  = 'p31n';
        }
        if ($this->isColumnModified(AlbumsTableMap::COL_P32N)) {
            $modifiedColumns[':p' . $index++]  = 'p32n';
        }
        if ($this->isColumnModified(AlbumsTableMap::COL_P33N)) {
            $modifiedColumns[':p' . $index++]  = 'p33n';
        }
        if ($this->isColumnModified(AlbumsTableMap::COL_P34N)) {
            $modifiedColumns[':p' . $index++]  = 'p34n';
        }
        if ($this->isColumnModified(AlbumsTableMap::COL_P35N)) {
            $modifiedColumns[':p' . $index++]  = 'p35n';
        }

        $sql = sprintf(
            'INSERT INTO albums (%s) VALUES (%s)',
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
                    case 'name':
                        $stmt->bindValue($identifier, $this->name, PDO::PARAM_STR);
                        break;
                    case 'artist1id':
                        $stmt->bindValue($identifier, $this->artist1id, PDO::PARAM_INT);
                        break;
                    case 'artist2id':
                        $stmt->bindValue($identifier, $this->artist2id, PDO::PARAM_INT);
                        break;
                    case 'dopylnitelnoinfo':
                        $stmt->bindValue($identifier, $this->dopylnitelnoinfo, PDO::PARAM_STR);
                        break;
                    case 'year':
                        $stmt->bindValue($identifier, $this->year, PDO::PARAM_INT);
                        break;
                    case 'image':
                        $stmt->bindValue($identifier, $this->image, PDO::PARAM_STR);
                        break;
                    case 'vid':
                        $stmt->bindValue($identifier, $this->vid, PDO::PARAM_INT);
                        break;
                    case 'up_id':
                        $stmt->bindValue($identifier, $this->up_id, PDO::PARAM_INT);
                        break;
                    case 'va':
                        $stmt->bindValue($identifier, (int) $this->va, PDO::PARAM_INT);
                        break;
                    case 'p1':
                        $stmt->bindValue($identifier, $this->p1, PDO::PARAM_INT);
                        break;
                    case 'p2':
                        $stmt->bindValue($identifier, $this->p2, PDO::PARAM_INT);
                        break;
                    case 'p3':
                        $stmt->bindValue($identifier, $this->p3, PDO::PARAM_INT);
                        break;
                    case 'p4':
                        $stmt->bindValue($identifier, $this->p4, PDO::PARAM_INT);
                        break;
                    case 'p5':
                        $stmt->bindValue($identifier, $this->p5, PDO::PARAM_INT);
                        break;
                    case 'p6':
                        $stmt->bindValue($identifier, $this->p6, PDO::PARAM_INT);
                        break;
                    case 'p7':
                        $stmt->bindValue($identifier, $this->p7, PDO::PARAM_INT);
                        break;
                    case 'p8':
                        $stmt->bindValue($identifier, $this->p8, PDO::PARAM_INT);
                        break;
                    case 'p9':
                        $stmt->bindValue($identifier, $this->p9, PDO::PARAM_INT);
                        break;
                    case 'p10':
                        $stmt->bindValue($identifier, $this->p10, PDO::PARAM_INT);
                        break;
                    case 'p11':
                        $stmt->bindValue($identifier, $this->p11, PDO::PARAM_INT);
                        break;
                    case 'p12':
                        $stmt->bindValue($identifier, $this->p12, PDO::PARAM_INT);
                        break;
                    case 'p13':
                        $stmt->bindValue($identifier, $this->p13, PDO::PARAM_INT);
                        break;
                    case 'p14':
                        $stmt->bindValue($identifier, $this->p14, PDO::PARAM_INT);
                        break;
                    case 'p15':
                        $stmt->bindValue($identifier, $this->p15, PDO::PARAM_INT);
                        break;
                    case 'p16':
                        $stmt->bindValue($identifier, $this->p16, PDO::PARAM_INT);
                        break;
                    case 'p17':
                        $stmt->bindValue($identifier, $this->p17, PDO::PARAM_INT);
                        break;
                    case 'p18':
                        $stmt->bindValue($identifier, $this->p18, PDO::PARAM_INT);
                        break;
                    case 'p19':
                        $stmt->bindValue($identifier, $this->p19, PDO::PARAM_INT);
                        break;
                    case 'p20':
                        $stmt->bindValue($identifier, $this->p20, PDO::PARAM_INT);
                        break;
                    case 'p21':
                        $stmt->bindValue($identifier, $this->p21, PDO::PARAM_INT);
                        break;
                    case 'p22':
                        $stmt->bindValue($identifier, $this->p22, PDO::PARAM_INT);
                        break;
                    case 'p23':
                        $stmt->bindValue($identifier, $this->p23, PDO::PARAM_INT);
                        break;
                    case 'p24':
                        $stmt->bindValue($identifier, $this->p24, PDO::PARAM_INT);
                        break;
                    case 'p25':
                        $stmt->bindValue($identifier, $this->p25, PDO::PARAM_INT);
                        break;
                    case 'p26':
                        $stmt->bindValue($identifier, $this->p26, PDO::PARAM_INT);
                        break;
                    case 'p27':
                        $stmt->bindValue($identifier, $this->p27, PDO::PARAM_INT);
                        break;
                    case 'p28':
                        $stmt->bindValue($identifier, $this->p28, PDO::PARAM_INT);
                        break;
                    case 'p29':
                        $stmt->bindValue($identifier, $this->p29, PDO::PARAM_INT);
                        break;
                    case 'p30':
                        $stmt->bindValue($identifier, $this->p30, PDO::PARAM_INT);
                        break;
                    case 'p31':
                        $stmt->bindValue($identifier, $this->p31, PDO::PARAM_INT);
                        break;
                    case 'p32':
                        $stmt->bindValue($identifier, $this->p32, PDO::PARAM_INT);
                        break;
                    case 'p33':
                        $stmt->bindValue($identifier, $this->p33, PDO::PARAM_INT);
                        break;
                    case 'p34':
                        $stmt->bindValue($identifier, $this->p34, PDO::PARAM_INT);
                        break;
                    case 'p35':
                        $stmt->bindValue($identifier, $this->p35, PDO::PARAM_INT);
                        break;
                    case 'p1n':
                        $stmt->bindValue($identifier, $this->p1n, PDO::PARAM_STR);
                        break;
                    case 'p2n':
                        $stmt->bindValue($identifier, $this->p2n, PDO::PARAM_STR);
                        break;
                    case 'p3n':
                        $stmt->bindValue($identifier, $this->p3n, PDO::PARAM_STR);
                        break;
                    case 'p4n':
                        $stmt->bindValue($identifier, $this->p4n, PDO::PARAM_STR);
                        break;
                    case 'p5n':
                        $stmt->bindValue($identifier, $this->p5n, PDO::PARAM_STR);
                        break;
                    case 'p6n':
                        $stmt->bindValue($identifier, $this->p6n, PDO::PARAM_STR);
                        break;
                    case 'p7n':
                        $stmt->bindValue($identifier, $this->p7n, PDO::PARAM_STR);
                        break;
                    case 'p8n':
                        $stmt->bindValue($identifier, $this->p8n, PDO::PARAM_STR);
                        break;
                    case 'p9n':
                        $stmt->bindValue($identifier, $this->p9n, PDO::PARAM_STR);
                        break;
                    case 'p10n':
                        $stmt->bindValue($identifier, $this->p10n, PDO::PARAM_STR);
                        break;
                    case 'p11n':
                        $stmt->bindValue($identifier, $this->p11n, PDO::PARAM_STR);
                        break;
                    case 'p12n':
                        $stmt->bindValue($identifier, $this->p12n, PDO::PARAM_STR);
                        break;
                    case 'p13n':
                        $stmt->bindValue($identifier, $this->p13n, PDO::PARAM_STR);
                        break;
                    case 'p14n':
                        $stmt->bindValue($identifier, $this->p14n, PDO::PARAM_STR);
                        break;
                    case 'p15n':
                        $stmt->bindValue($identifier, $this->p15n, PDO::PARAM_STR);
                        break;
                    case 'p16n':
                        $stmt->bindValue($identifier, $this->p16n, PDO::PARAM_STR);
                        break;
                    case 'p17n':
                        $stmt->bindValue($identifier, $this->p17n, PDO::PARAM_STR);
                        break;
                    case 'p18n':
                        $stmt->bindValue($identifier, $this->p18n, PDO::PARAM_STR);
                        break;
                    case 'p19n':
                        $stmt->bindValue($identifier, $this->p19n, PDO::PARAM_STR);
                        break;
                    case 'p20n':
                        $stmt->bindValue($identifier, $this->p20n, PDO::PARAM_STR);
                        break;
                    case 'p21n':
                        $stmt->bindValue($identifier, $this->p21n, PDO::PARAM_STR);
                        break;
                    case 'p22n':
                        $stmt->bindValue($identifier, $this->p22n, PDO::PARAM_STR);
                        break;
                    case 'p23n':
                        $stmt->bindValue($identifier, $this->p23n, PDO::PARAM_STR);
                        break;
                    case 'p24n':
                        $stmt->bindValue($identifier, $this->p24n, PDO::PARAM_STR);
                        break;
                    case 'p25n':
                        $stmt->bindValue($identifier, $this->p25n, PDO::PARAM_STR);
                        break;
                    case 'p26n':
                        $stmt->bindValue($identifier, $this->p26n, PDO::PARAM_STR);
                        break;
                    case 'p27n':
                        $stmt->bindValue($identifier, $this->p27n, PDO::PARAM_STR);
                        break;
                    case 'p28n':
                        $stmt->bindValue($identifier, $this->p28n, PDO::PARAM_STR);
                        break;
                    case 'p29n':
                        $stmt->bindValue($identifier, $this->p29n, PDO::PARAM_STR);
                        break;
                    case 'p30n':
                        $stmt->bindValue($identifier, $this->p30n, PDO::PARAM_STR);
                        break;
                    case 'p31n':
                        $stmt->bindValue($identifier, $this->p31n, PDO::PARAM_STR);
                        break;
                    case 'p32n':
                        $stmt->bindValue($identifier, $this->p32n, PDO::PARAM_STR);
                        break;
                    case 'p33n':
                        $stmt->bindValue($identifier, $this->p33n, PDO::PARAM_STR);
                        break;
                    case 'p34n':
                        $stmt->bindValue($identifier, $this->p34n, PDO::PARAM_STR);
                        break;
                    case 'p35n':
                        $stmt->bindValue($identifier, $this->p35n, PDO::PARAM_STR);
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
        $pos = AlbumsTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getName();
                break;
            case 2:
                return $this->getArtist1id();
                break;
            case 3:
                return $this->getArtist2id();
                break;
            case 4:
                return $this->getDopylnitelnoinfo();
                break;
            case 5:
                return $this->getYear();
                break;
            case 6:
                return $this->getImage();
                break;
            case 7:
                return $this->getVid();
                break;
            case 8:
                return $this->getUpId();
                break;
            case 9:
                return $this->getVa();
                break;
            case 10:
                return $this->getP1();
                break;
            case 11:
                return $this->getP2();
                break;
            case 12:
                return $this->getP3();
                break;
            case 13:
                return $this->getP4();
                break;
            case 14:
                return $this->getP5();
                break;
            case 15:
                return $this->getP6();
                break;
            case 16:
                return $this->getP7();
                break;
            case 17:
                return $this->getP8();
                break;
            case 18:
                return $this->getP9();
                break;
            case 19:
                return $this->getP10();
                break;
            case 20:
                return $this->getP11();
                break;
            case 21:
                return $this->getP12();
                break;
            case 22:
                return $this->getP13();
                break;
            case 23:
                return $this->getP14();
                break;
            case 24:
                return $this->getP15();
                break;
            case 25:
                return $this->getP16();
                break;
            case 26:
                return $this->getP17();
                break;
            case 27:
                return $this->getP18();
                break;
            case 28:
                return $this->getP19();
                break;
            case 29:
                return $this->getP20();
                break;
            case 30:
                return $this->getP21();
                break;
            case 31:
                return $this->getP22();
                break;
            case 32:
                return $this->getP23();
                break;
            case 33:
                return $this->getP24();
                break;
            case 34:
                return $this->getP25();
                break;
            case 35:
                return $this->getP26();
                break;
            case 36:
                return $this->getP27();
                break;
            case 37:
                return $this->getP28();
                break;
            case 38:
                return $this->getP29();
                break;
            case 39:
                return $this->getP30();
                break;
            case 40:
                return $this->getP31();
                break;
            case 41:
                return $this->getP32();
                break;
            case 42:
                return $this->getP33();
                break;
            case 43:
                return $this->getP34();
                break;
            case 44:
                return $this->getP35();
                break;
            case 45:
                return $this->getP1n();
                break;
            case 46:
                return $this->getP2n();
                break;
            case 47:
                return $this->getP3n();
                break;
            case 48:
                return $this->getP4n();
                break;
            case 49:
                return $this->getP5n();
                break;
            case 50:
                return $this->getP6n();
                break;
            case 51:
                return $this->getP7n();
                break;
            case 52:
                return $this->getP8n();
                break;
            case 53:
                return $this->getP9n();
                break;
            case 54:
                return $this->getP10n();
                break;
            case 55:
                return $this->getP11n();
                break;
            case 56:
                return $this->getP12n();
                break;
            case 57:
                return $this->getP13n();
                break;
            case 58:
                return $this->getP14n();
                break;
            case 59:
                return $this->getP15n();
                break;
            case 60:
                return $this->getP16n();
                break;
            case 61:
                return $this->getP17n();
                break;
            case 62:
                return $this->getP18n();
                break;
            case 63:
                return $this->getP19n();
                break;
            case 64:
                return $this->getP20n();
                break;
            case 65:
                return $this->getP21n();
                break;
            case 66:
                return $this->getP22n();
                break;
            case 67:
                return $this->getP23n();
                break;
            case 68:
                return $this->getP24n();
                break;
            case 69:
                return $this->getP25n();
                break;
            case 70:
                return $this->getP26n();
                break;
            case 71:
                return $this->getP27n();
                break;
            case 72:
                return $this->getP28n();
                break;
            case 73:
                return $this->getP29n();
                break;
            case 74:
                return $this->getP30n();
                break;
            case 75:
                return $this->getP31n();
                break;
            case 76:
                return $this->getP32n();
                break;
            case 77:
                return $this->getP33n();
                break;
            case 78:
                return $this->getP34n();
                break;
            case 79:
                return $this->getP35n();
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
     *
     * @return array an associative array containing the field names (as keys) and field values
     */
    public function toArray($keyType = TableMap::TYPE_PHPNAME, $includeLazyLoadColumns = true, $alreadyDumpedObjects = array())
    {

        if (isset($alreadyDumpedObjects['Albums'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Albums'][$this->hashCode()] = true;
        $keys = AlbumsTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getName(),
            $keys[2] => $this->getArtist1id(),
            $keys[3] => $this->getArtist2id(),
            $keys[4] => $this->getDopylnitelnoinfo(),
            $keys[5] => $this->getYear(),
            $keys[6] => $this->getImage(),
            $keys[7] => $this->getVid(),
            $keys[8] => $this->getUpId(),
            $keys[9] => $this->getVa(),
            $keys[10] => $this->getP1(),
            $keys[11] => $this->getP2(),
            $keys[12] => $this->getP3(),
            $keys[13] => $this->getP4(),
            $keys[14] => $this->getP5(),
            $keys[15] => $this->getP6(),
            $keys[16] => $this->getP7(),
            $keys[17] => $this->getP8(),
            $keys[18] => $this->getP9(),
            $keys[19] => $this->getP10(),
            $keys[20] => $this->getP11(),
            $keys[21] => $this->getP12(),
            $keys[22] => $this->getP13(),
            $keys[23] => $this->getP14(),
            $keys[24] => $this->getP15(),
            $keys[25] => $this->getP16(),
            $keys[26] => $this->getP17(),
            $keys[27] => $this->getP18(),
            $keys[28] => $this->getP19(),
            $keys[29] => $this->getP20(),
            $keys[30] => $this->getP21(),
            $keys[31] => $this->getP22(),
            $keys[32] => $this->getP23(),
            $keys[33] => $this->getP24(),
            $keys[34] => $this->getP25(),
            $keys[35] => $this->getP26(),
            $keys[36] => $this->getP27(),
            $keys[37] => $this->getP28(),
            $keys[38] => $this->getP29(),
            $keys[39] => $this->getP30(),
            $keys[40] => $this->getP31(),
            $keys[41] => $this->getP32(),
            $keys[42] => $this->getP33(),
            $keys[43] => $this->getP34(),
            $keys[44] => $this->getP35(),
            $keys[45] => $this->getP1n(),
            $keys[46] => $this->getP2n(),
            $keys[47] => $this->getP3n(),
            $keys[48] => $this->getP4n(),
            $keys[49] => $this->getP5n(),
            $keys[50] => $this->getP6n(),
            $keys[51] => $this->getP7n(),
            $keys[52] => $this->getP8n(),
            $keys[53] => $this->getP9n(),
            $keys[54] => $this->getP10n(),
            $keys[55] => $this->getP11n(),
            $keys[56] => $this->getP12n(),
            $keys[57] => $this->getP13n(),
            $keys[58] => $this->getP14n(),
            $keys[59] => $this->getP15n(),
            $keys[60] => $this->getP16n(),
            $keys[61] => $this->getP17n(),
            $keys[62] => $this->getP18n(),
            $keys[63] => $this->getP19n(),
            $keys[64] => $this->getP20n(),
            $keys[65] => $this->getP21n(),
            $keys[66] => $this->getP22n(),
            $keys[67] => $this->getP23n(),
            $keys[68] => $this->getP24n(),
            $keys[69] => $this->getP25n(),
            $keys[70] => $this->getP26n(),
            $keys[71] => $this->getP27n(),
            $keys[72] => $this->getP28n(),
            $keys[73] => $this->getP29n(),
            $keys[74] => $this->getP30n(),
            $keys[75] => $this->getP31n(),
            $keys[76] => $this->getP32n(),
            $keys[77] => $this->getP33n(),
            $keys[78] => $this->getP34n(),
            $keys[79] => $this->getP35n(),
        );
        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
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
     * @return $this|\Tekstove\TekstoveBundle\Model\Entity\Albums
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = AlbumsTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\Tekstove\TekstoveBundle\Model\Entity\Albums
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setId($value);
                break;
            case 1:
                $this->setName($value);
                break;
            case 2:
                $this->setArtist1id($value);
                break;
            case 3:
                $this->setArtist2id($value);
                break;
            case 4:
                $this->setDopylnitelnoinfo($value);
                break;
            case 5:
                $this->setYear($value);
                break;
            case 6:
                $this->setImage($value);
                break;
            case 7:
                $this->setVid($value);
                break;
            case 8:
                $this->setUpId($value);
                break;
            case 9:
                $this->setVa($value);
                break;
            case 10:
                $this->setP1($value);
                break;
            case 11:
                $this->setP2($value);
                break;
            case 12:
                $this->setP3($value);
                break;
            case 13:
                $this->setP4($value);
                break;
            case 14:
                $this->setP5($value);
                break;
            case 15:
                $this->setP6($value);
                break;
            case 16:
                $this->setP7($value);
                break;
            case 17:
                $this->setP8($value);
                break;
            case 18:
                $this->setP9($value);
                break;
            case 19:
                $this->setP10($value);
                break;
            case 20:
                $this->setP11($value);
                break;
            case 21:
                $this->setP12($value);
                break;
            case 22:
                $this->setP13($value);
                break;
            case 23:
                $this->setP14($value);
                break;
            case 24:
                $this->setP15($value);
                break;
            case 25:
                $this->setP16($value);
                break;
            case 26:
                $this->setP17($value);
                break;
            case 27:
                $this->setP18($value);
                break;
            case 28:
                $this->setP19($value);
                break;
            case 29:
                $this->setP20($value);
                break;
            case 30:
                $this->setP21($value);
                break;
            case 31:
                $this->setP22($value);
                break;
            case 32:
                $this->setP23($value);
                break;
            case 33:
                $this->setP24($value);
                break;
            case 34:
                $this->setP25($value);
                break;
            case 35:
                $this->setP26($value);
                break;
            case 36:
                $this->setP27($value);
                break;
            case 37:
                $this->setP28($value);
                break;
            case 38:
                $this->setP29($value);
                break;
            case 39:
                $this->setP30($value);
                break;
            case 40:
                $this->setP31($value);
                break;
            case 41:
                $this->setP32($value);
                break;
            case 42:
                $this->setP33($value);
                break;
            case 43:
                $this->setP34($value);
                break;
            case 44:
                $this->setP35($value);
                break;
            case 45:
                $this->setP1n($value);
                break;
            case 46:
                $this->setP2n($value);
                break;
            case 47:
                $this->setP3n($value);
                break;
            case 48:
                $this->setP4n($value);
                break;
            case 49:
                $this->setP5n($value);
                break;
            case 50:
                $this->setP6n($value);
                break;
            case 51:
                $this->setP7n($value);
                break;
            case 52:
                $this->setP8n($value);
                break;
            case 53:
                $this->setP9n($value);
                break;
            case 54:
                $this->setP10n($value);
                break;
            case 55:
                $this->setP11n($value);
                break;
            case 56:
                $this->setP12n($value);
                break;
            case 57:
                $this->setP13n($value);
                break;
            case 58:
                $this->setP14n($value);
                break;
            case 59:
                $this->setP15n($value);
                break;
            case 60:
                $this->setP16n($value);
                break;
            case 61:
                $this->setP17n($value);
                break;
            case 62:
                $this->setP18n($value);
                break;
            case 63:
                $this->setP19n($value);
                break;
            case 64:
                $this->setP20n($value);
                break;
            case 65:
                $this->setP21n($value);
                break;
            case 66:
                $this->setP22n($value);
                break;
            case 67:
                $this->setP23n($value);
                break;
            case 68:
                $this->setP24n($value);
                break;
            case 69:
                $this->setP25n($value);
                break;
            case 70:
                $this->setP26n($value);
                break;
            case 71:
                $this->setP27n($value);
                break;
            case 72:
                $this->setP28n($value);
                break;
            case 73:
                $this->setP29n($value);
                break;
            case 74:
                $this->setP30n($value);
                break;
            case 75:
                $this->setP31n($value);
                break;
            case 76:
                $this->setP32n($value);
                break;
            case 77:
                $this->setP33n($value);
                break;
            case 78:
                $this->setP34n($value);
                break;
            case 79:
                $this->setP35n($value);
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
        $keys = AlbumsTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setId($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setName($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setArtist1id($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setArtist2id($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setDopylnitelnoinfo($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setYear($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setImage($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setVid($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setUpId($arr[$keys[8]]);
        }
        if (array_key_exists($keys[9], $arr)) {
            $this->setVa($arr[$keys[9]]);
        }
        if (array_key_exists($keys[10], $arr)) {
            $this->setP1($arr[$keys[10]]);
        }
        if (array_key_exists($keys[11], $arr)) {
            $this->setP2($arr[$keys[11]]);
        }
        if (array_key_exists($keys[12], $arr)) {
            $this->setP3($arr[$keys[12]]);
        }
        if (array_key_exists($keys[13], $arr)) {
            $this->setP4($arr[$keys[13]]);
        }
        if (array_key_exists($keys[14], $arr)) {
            $this->setP5($arr[$keys[14]]);
        }
        if (array_key_exists($keys[15], $arr)) {
            $this->setP6($arr[$keys[15]]);
        }
        if (array_key_exists($keys[16], $arr)) {
            $this->setP7($arr[$keys[16]]);
        }
        if (array_key_exists($keys[17], $arr)) {
            $this->setP8($arr[$keys[17]]);
        }
        if (array_key_exists($keys[18], $arr)) {
            $this->setP9($arr[$keys[18]]);
        }
        if (array_key_exists($keys[19], $arr)) {
            $this->setP10($arr[$keys[19]]);
        }
        if (array_key_exists($keys[20], $arr)) {
            $this->setP11($arr[$keys[20]]);
        }
        if (array_key_exists($keys[21], $arr)) {
            $this->setP12($arr[$keys[21]]);
        }
        if (array_key_exists($keys[22], $arr)) {
            $this->setP13($arr[$keys[22]]);
        }
        if (array_key_exists($keys[23], $arr)) {
            $this->setP14($arr[$keys[23]]);
        }
        if (array_key_exists($keys[24], $arr)) {
            $this->setP15($arr[$keys[24]]);
        }
        if (array_key_exists($keys[25], $arr)) {
            $this->setP16($arr[$keys[25]]);
        }
        if (array_key_exists($keys[26], $arr)) {
            $this->setP17($arr[$keys[26]]);
        }
        if (array_key_exists($keys[27], $arr)) {
            $this->setP18($arr[$keys[27]]);
        }
        if (array_key_exists($keys[28], $arr)) {
            $this->setP19($arr[$keys[28]]);
        }
        if (array_key_exists($keys[29], $arr)) {
            $this->setP20($arr[$keys[29]]);
        }
        if (array_key_exists($keys[30], $arr)) {
            $this->setP21($arr[$keys[30]]);
        }
        if (array_key_exists($keys[31], $arr)) {
            $this->setP22($arr[$keys[31]]);
        }
        if (array_key_exists($keys[32], $arr)) {
            $this->setP23($arr[$keys[32]]);
        }
        if (array_key_exists($keys[33], $arr)) {
            $this->setP24($arr[$keys[33]]);
        }
        if (array_key_exists($keys[34], $arr)) {
            $this->setP25($arr[$keys[34]]);
        }
        if (array_key_exists($keys[35], $arr)) {
            $this->setP26($arr[$keys[35]]);
        }
        if (array_key_exists($keys[36], $arr)) {
            $this->setP27($arr[$keys[36]]);
        }
        if (array_key_exists($keys[37], $arr)) {
            $this->setP28($arr[$keys[37]]);
        }
        if (array_key_exists($keys[38], $arr)) {
            $this->setP29($arr[$keys[38]]);
        }
        if (array_key_exists($keys[39], $arr)) {
            $this->setP30($arr[$keys[39]]);
        }
        if (array_key_exists($keys[40], $arr)) {
            $this->setP31($arr[$keys[40]]);
        }
        if (array_key_exists($keys[41], $arr)) {
            $this->setP32($arr[$keys[41]]);
        }
        if (array_key_exists($keys[42], $arr)) {
            $this->setP33($arr[$keys[42]]);
        }
        if (array_key_exists($keys[43], $arr)) {
            $this->setP34($arr[$keys[43]]);
        }
        if (array_key_exists($keys[44], $arr)) {
            $this->setP35($arr[$keys[44]]);
        }
        if (array_key_exists($keys[45], $arr)) {
            $this->setP1n($arr[$keys[45]]);
        }
        if (array_key_exists($keys[46], $arr)) {
            $this->setP2n($arr[$keys[46]]);
        }
        if (array_key_exists($keys[47], $arr)) {
            $this->setP3n($arr[$keys[47]]);
        }
        if (array_key_exists($keys[48], $arr)) {
            $this->setP4n($arr[$keys[48]]);
        }
        if (array_key_exists($keys[49], $arr)) {
            $this->setP5n($arr[$keys[49]]);
        }
        if (array_key_exists($keys[50], $arr)) {
            $this->setP6n($arr[$keys[50]]);
        }
        if (array_key_exists($keys[51], $arr)) {
            $this->setP7n($arr[$keys[51]]);
        }
        if (array_key_exists($keys[52], $arr)) {
            $this->setP8n($arr[$keys[52]]);
        }
        if (array_key_exists($keys[53], $arr)) {
            $this->setP9n($arr[$keys[53]]);
        }
        if (array_key_exists($keys[54], $arr)) {
            $this->setP10n($arr[$keys[54]]);
        }
        if (array_key_exists($keys[55], $arr)) {
            $this->setP11n($arr[$keys[55]]);
        }
        if (array_key_exists($keys[56], $arr)) {
            $this->setP12n($arr[$keys[56]]);
        }
        if (array_key_exists($keys[57], $arr)) {
            $this->setP13n($arr[$keys[57]]);
        }
        if (array_key_exists($keys[58], $arr)) {
            $this->setP14n($arr[$keys[58]]);
        }
        if (array_key_exists($keys[59], $arr)) {
            $this->setP15n($arr[$keys[59]]);
        }
        if (array_key_exists($keys[60], $arr)) {
            $this->setP16n($arr[$keys[60]]);
        }
        if (array_key_exists($keys[61], $arr)) {
            $this->setP17n($arr[$keys[61]]);
        }
        if (array_key_exists($keys[62], $arr)) {
            $this->setP18n($arr[$keys[62]]);
        }
        if (array_key_exists($keys[63], $arr)) {
            $this->setP19n($arr[$keys[63]]);
        }
        if (array_key_exists($keys[64], $arr)) {
            $this->setP20n($arr[$keys[64]]);
        }
        if (array_key_exists($keys[65], $arr)) {
            $this->setP21n($arr[$keys[65]]);
        }
        if (array_key_exists($keys[66], $arr)) {
            $this->setP22n($arr[$keys[66]]);
        }
        if (array_key_exists($keys[67], $arr)) {
            $this->setP23n($arr[$keys[67]]);
        }
        if (array_key_exists($keys[68], $arr)) {
            $this->setP24n($arr[$keys[68]]);
        }
        if (array_key_exists($keys[69], $arr)) {
            $this->setP25n($arr[$keys[69]]);
        }
        if (array_key_exists($keys[70], $arr)) {
            $this->setP26n($arr[$keys[70]]);
        }
        if (array_key_exists($keys[71], $arr)) {
            $this->setP27n($arr[$keys[71]]);
        }
        if (array_key_exists($keys[72], $arr)) {
            $this->setP28n($arr[$keys[72]]);
        }
        if (array_key_exists($keys[73], $arr)) {
            $this->setP29n($arr[$keys[73]]);
        }
        if (array_key_exists($keys[74], $arr)) {
            $this->setP30n($arr[$keys[74]]);
        }
        if (array_key_exists($keys[75], $arr)) {
            $this->setP31n($arr[$keys[75]]);
        }
        if (array_key_exists($keys[76], $arr)) {
            $this->setP32n($arr[$keys[76]]);
        }
        if (array_key_exists($keys[77], $arr)) {
            $this->setP33n($arr[$keys[77]]);
        }
        if (array_key_exists($keys[78], $arr)) {
            $this->setP34n($arr[$keys[78]]);
        }
        if (array_key_exists($keys[79], $arr)) {
            $this->setP35n($arr[$keys[79]]);
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
     * @return $this|\Tekstove\TekstoveBundle\Model\Entity\Albums The current object, for fluid interface
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
        $criteria = new Criteria(AlbumsTableMap::DATABASE_NAME);

        if ($this->isColumnModified(AlbumsTableMap::COL_ID)) {
            $criteria->add(AlbumsTableMap::COL_ID, $this->id);
        }
        if ($this->isColumnModified(AlbumsTableMap::COL_NAME)) {
            $criteria->add(AlbumsTableMap::COL_NAME, $this->name);
        }
        if ($this->isColumnModified(AlbumsTableMap::COL_ARTIST1ID)) {
            $criteria->add(AlbumsTableMap::COL_ARTIST1ID, $this->artist1id);
        }
        if ($this->isColumnModified(AlbumsTableMap::COL_ARTIST2ID)) {
            $criteria->add(AlbumsTableMap::COL_ARTIST2ID, $this->artist2id);
        }
        if ($this->isColumnModified(AlbumsTableMap::COL_DOPYLNITELNOINFO)) {
            $criteria->add(AlbumsTableMap::COL_DOPYLNITELNOINFO, $this->dopylnitelnoinfo);
        }
        if ($this->isColumnModified(AlbumsTableMap::COL_YEAR)) {
            $criteria->add(AlbumsTableMap::COL_YEAR, $this->year);
        }
        if ($this->isColumnModified(AlbumsTableMap::COL_IMAGE)) {
            $criteria->add(AlbumsTableMap::COL_IMAGE, $this->image);
        }
        if ($this->isColumnModified(AlbumsTableMap::COL_VID)) {
            $criteria->add(AlbumsTableMap::COL_VID, $this->vid);
        }
        if ($this->isColumnModified(AlbumsTableMap::COL_UP_ID)) {
            $criteria->add(AlbumsTableMap::COL_UP_ID, $this->up_id);
        }
        if ($this->isColumnModified(AlbumsTableMap::COL_VA)) {
            $criteria->add(AlbumsTableMap::COL_VA, $this->va);
        }
        if ($this->isColumnModified(AlbumsTableMap::COL_P1)) {
            $criteria->add(AlbumsTableMap::COL_P1, $this->p1);
        }
        if ($this->isColumnModified(AlbumsTableMap::COL_P2)) {
            $criteria->add(AlbumsTableMap::COL_P2, $this->p2);
        }
        if ($this->isColumnModified(AlbumsTableMap::COL_P3)) {
            $criteria->add(AlbumsTableMap::COL_P3, $this->p3);
        }
        if ($this->isColumnModified(AlbumsTableMap::COL_P4)) {
            $criteria->add(AlbumsTableMap::COL_P4, $this->p4);
        }
        if ($this->isColumnModified(AlbumsTableMap::COL_P5)) {
            $criteria->add(AlbumsTableMap::COL_P5, $this->p5);
        }
        if ($this->isColumnModified(AlbumsTableMap::COL_P6)) {
            $criteria->add(AlbumsTableMap::COL_P6, $this->p6);
        }
        if ($this->isColumnModified(AlbumsTableMap::COL_P7)) {
            $criteria->add(AlbumsTableMap::COL_P7, $this->p7);
        }
        if ($this->isColumnModified(AlbumsTableMap::COL_P8)) {
            $criteria->add(AlbumsTableMap::COL_P8, $this->p8);
        }
        if ($this->isColumnModified(AlbumsTableMap::COL_P9)) {
            $criteria->add(AlbumsTableMap::COL_P9, $this->p9);
        }
        if ($this->isColumnModified(AlbumsTableMap::COL_P10)) {
            $criteria->add(AlbumsTableMap::COL_P10, $this->p10);
        }
        if ($this->isColumnModified(AlbumsTableMap::COL_P11)) {
            $criteria->add(AlbumsTableMap::COL_P11, $this->p11);
        }
        if ($this->isColumnModified(AlbumsTableMap::COL_P12)) {
            $criteria->add(AlbumsTableMap::COL_P12, $this->p12);
        }
        if ($this->isColumnModified(AlbumsTableMap::COL_P13)) {
            $criteria->add(AlbumsTableMap::COL_P13, $this->p13);
        }
        if ($this->isColumnModified(AlbumsTableMap::COL_P14)) {
            $criteria->add(AlbumsTableMap::COL_P14, $this->p14);
        }
        if ($this->isColumnModified(AlbumsTableMap::COL_P15)) {
            $criteria->add(AlbumsTableMap::COL_P15, $this->p15);
        }
        if ($this->isColumnModified(AlbumsTableMap::COL_P16)) {
            $criteria->add(AlbumsTableMap::COL_P16, $this->p16);
        }
        if ($this->isColumnModified(AlbumsTableMap::COL_P17)) {
            $criteria->add(AlbumsTableMap::COL_P17, $this->p17);
        }
        if ($this->isColumnModified(AlbumsTableMap::COL_P18)) {
            $criteria->add(AlbumsTableMap::COL_P18, $this->p18);
        }
        if ($this->isColumnModified(AlbumsTableMap::COL_P19)) {
            $criteria->add(AlbumsTableMap::COL_P19, $this->p19);
        }
        if ($this->isColumnModified(AlbumsTableMap::COL_P20)) {
            $criteria->add(AlbumsTableMap::COL_P20, $this->p20);
        }
        if ($this->isColumnModified(AlbumsTableMap::COL_P21)) {
            $criteria->add(AlbumsTableMap::COL_P21, $this->p21);
        }
        if ($this->isColumnModified(AlbumsTableMap::COL_P22)) {
            $criteria->add(AlbumsTableMap::COL_P22, $this->p22);
        }
        if ($this->isColumnModified(AlbumsTableMap::COL_P23)) {
            $criteria->add(AlbumsTableMap::COL_P23, $this->p23);
        }
        if ($this->isColumnModified(AlbumsTableMap::COL_P24)) {
            $criteria->add(AlbumsTableMap::COL_P24, $this->p24);
        }
        if ($this->isColumnModified(AlbumsTableMap::COL_P25)) {
            $criteria->add(AlbumsTableMap::COL_P25, $this->p25);
        }
        if ($this->isColumnModified(AlbumsTableMap::COL_P26)) {
            $criteria->add(AlbumsTableMap::COL_P26, $this->p26);
        }
        if ($this->isColumnModified(AlbumsTableMap::COL_P27)) {
            $criteria->add(AlbumsTableMap::COL_P27, $this->p27);
        }
        if ($this->isColumnModified(AlbumsTableMap::COL_P28)) {
            $criteria->add(AlbumsTableMap::COL_P28, $this->p28);
        }
        if ($this->isColumnModified(AlbumsTableMap::COL_P29)) {
            $criteria->add(AlbumsTableMap::COL_P29, $this->p29);
        }
        if ($this->isColumnModified(AlbumsTableMap::COL_P30)) {
            $criteria->add(AlbumsTableMap::COL_P30, $this->p30);
        }
        if ($this->isColumnModified(AlbumsTableMap::COL_P31)) {
            $criteria->add(AlbumsTableMap::COL_P31, $this->p31);
        }
        if ($this->isColumnModified(AlbumsTableMap::COL_P32)) {
            $criteria->add(AlbumsTableMap::COL_P32, $this->p32);
        }
        if ($this->isColumnModified(AlbumsTableMap::COL_P33)) {
            $criteria->add(AlbumsTableMap::COL_P33, $this->p33);
        }
        if ($this->isColumnModified(AlbumsTableMap::COL_P34)) {
            $criteria->add(AlbumsTableMap::COL_P34, $this->p34);
        }
        if ($this->isColumnModified(AlbumsTableMap::COL_P35)) {
            $criteria->add(AlbumsTableMap::COL_P35, $this->p35);
        }
        if ($this->isColumnModified(AlbumsTableMap::COL_P1N)) {
            $criteria->add(AlbumsTableMap::COL_P1N, $this->p1n);
        }
        if ($this->isColumnModified(AlbumsTableMap::COL_P2N)) {
            $criteria->add(AlbumsTableMap::COL_P2N, $this->p2n);
        }
        if ($this->isColumnModified(AlbumsTableMap::COL_P3N)) {
            $criteria->add(AlbumsTableMap::COL_P3N, $this->p3n);
        }
        if ($this->isColumnModified(AlbumsTableMap::COL_P4N)) {
            $criteria->add(AlbumsTableMap::COL_P4N, $this->p4n);
        }
        if ($this->isColumnModified(AlbumsTableMap::COL_P5N)) {
            $criteria->add(AlbumsTableMap::COL_P5N, $this->p5n);
        }
        if ($this->isColumnModified(AlbumsTableMap::COL_P6N)) {
            $criteria->add(AlbumsTableMap::COL_P6N, $this->p6n);
        }
        if ($this->isColumnModified(AlbumsTableMap::COL_P7N)) {
            $criteria->add(AlbumsTableMap::COL_P7N, $this->p7n);
        }
        if ($this->isColumnModified(AlbumsTableMap::COL_P8N)) {
            $criteria->add(AlbumsTableMap::COL_P8N, $this->p8n);
        }
        if ($this->isColumnModified(AlbumsTableMap::COL_P9N)) {
            $criteria->add(AlbumsTableMap::COL_P9N, $this->p9n);
        }
        if ($this->isColumnModified(AlbumsTableMap::COL_P10N)) {
            $criteria->add(AlbumsTableMap::COL_P10N, $this->p10n);
        }
        if ($this->isColumnModified(AlbumsTableMap::COL_P11N)) {
            $criteria->add(AlbumsTableMap::COL_P11N, $this->p11n);
        }
        if ($this->isColumnModified(AlbumsTableMap::COL_P12N)) {
            $criteria->add(AlbumsTableMap::COL_P12N, $this->p12n);
        }
        if ($this->isColumnModified(AlbumsTableMap::COL_P13N)) {
            $criteria->add(AlbumsTableMap::COL_P13N, $this->p13n);
        }
        if ($this->isColumnModified(AlbumsTableMap::COL_P14N)) {
            $criteria->add(AlbumsTableMap::COL_P14N, $this->p14n);
        }
        if ($this->isColumnModified(AlbumsTableMap::COL_P15N)) {
            $criteria->add(AlbumsTableMap::COL_P15N, $this->p15n);
        }
        if ($this->isColumnModified(AlbumsTableMap::COL_P16N)) {
            $criteria->add(AlbumsTableMap::COL_P16N, $this->p16n);
        }
        if ($this->isColumnModified(AlbumsTableMap::COL_P17N)) {
            $criteria->add(AlbumsTableMap::COL_P17N, $this->p17n);
        }
        if ($this->isColumnModified(AlbumsTableMap::COL_P18N)) {
            $criteria->add(AlbumsTableMap::COL_P18N, $this->p18n);
        }
        if ($this->isColumnModified(AlbumsTableMap::COL_P19N)) {
            $criteria->add(AlbumsTableMap::COL_P19N, $this->p19n);
        }
        if ($this->isColumnModified(AlbumsTableMap::COL_P20N)) {
            $criteria->add(AlbumsTableMap::COL_P20N, $this->p20n);
        }
        if ($this->isColumnModified(AlbumsTableMap::COL_P21N)) {
            $criteria->add(AlbumsTableMap::COL_P21N, $this->p21n);
        }
        if ($this->isColumnModified(AlbumsTableMap::COL_P22N)) {
            $criteria->add(AlbumsTableMap::COL_P22N, $this->p22n);
        }
        if ($this->isColumnModified(AlbumsTableMap::COL_P23N)) {
            $criteria->add(AlbumsTableMap::COL_P23N, $this->p23n);
        }
        if ($this->isColumnModified(AlbumsTableMap::COL_P24N)) {
            $criteria->add(AlbumsTableMap::COL_P24N, $this->p24n);
        }
        if ($this->isColumnModified(AlbumsTableMap::COL_P25N)) {
            $criteria->add(AlbumsTableMap::COL_P25N, $this->p25n);
        }
        if ($this->isColumnModified(AlbumsTableMap::COL_P26N)) {
            $criteria->add(AlbumsTableMap::COL_P26N, $this->p26n);
        }
        if ($this->isColumnModified(AlbumsTableMap::COL_P27N)) {
            $criteria->add(AlbumsTableMap::COL_P27N, $this->p27n);
        }
        if ($this->isColumnModified(AlbumsTableMap::COL_P28N)) {
            $criteria->add(AlbumsTableMap::COL_P28N, $this->p28n);
        }
        if ($this->isColumnModified(AlbumsTableMap::COL_P29N)) {
            $criteria->add(AlbumsTableMap::COL_P29N, $this->p29n);
        }
        if ($this->isColumnModified(AlbumsTableMap::COL_P30N)) {
            $criteria->add(AlbumsTableMap::COL_P30N, $this->p30n);
        }
        if ($this->isColumnModified(AlbumsTableMap::COL_P31N)) {
            $criteria->add(AlbumsTableMap::COL_P31N, $this->p31n);
        }
        if ($this->isColumnModified(AlbumsTableMap::COL_P32N)) {
            $criteria->add(AlbumsTableMap::COL_P32N, $this->p32n);
        }
        if ($this->isColumnModified(AlbumsTableMap::COL_P33N)) {
            $criteria->add(AlbumsTableMap::COL_P33N, $this->p33n);
        }
        if ($this->isColumnModified(AlbumsTableMap::COL_P34N)) {
            $criteria->add(AlbumsTableMap::COL_P34N, $this->p34n);
        }
        if ($this->isColumnModified(AlbumsTableMap::COL_P35N)) {
            $criteria->add(AlbumsTableMap::COL_P35N, $this->p35n);
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
        $criteria = ChildAlbumsQuery::create();
        $criteria->add(AlbumsTableMap::COL_ID, $this->id);

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
     * @param      object $copyObj An object of \Tekstove\TekstoveBundle\Model\Entity\Albums (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setName($this->getName());
        $copyObj->setArtist1id($this->getArtist1id());
        $copyObj->setArtist2id($this->getArtist2id());
        $copyObj->setDopylnitelnoinfo($this->getDopylnitelnoinfo());
        $copyObj->setYear($this->getYear());
        $copyObj->setImage($this->getImage());
        $copyObj->setVid($this->getVid());
        $copyObj->setUpId($this->getUpId());
        $copyObj->setVa($this->getVa());
        $copyObj->setP1($this->getP1());
        $copyObj->setP2($this->getP2());
        $copyObj->setP3($this->getP3());
        $copyObj->setP4($this->getP4());
        $copyObj->setP5($this->getP5());
        $copyObj->setP6($this->getP6());
        $copyObj->setP7($this->getP7());
        $copyObj->setP8($this->getP8());
        $copyObj->setP9($this->getP9());
        $copyObj->setP10($this->getP10());
        $copyObj->setP11($this->getP11());
        $copyObj->setP12($this->getP12());
        $copyObj->setP13($this->getP13());
        $copyObj->setP14($this->getP14());
        $copyObj->setP15($this->getP15());
        $copyObj->setP16($this->getP16());
        $copyObj->setP17($this->getP17());
        $copyObj->setP18($this->getP18());
        $copyObj->setP19($this->getP19());
        $copyObj->setP20($this->getP20());
        $copyObj->setP21($this->getP21());
        $copyObj->setP22($this->getP22());
        $copyObj->setP23($this->getP23());
        $copyObj->setP24($this->getP24());
        $copyObj->setP25($this->getP25());
        $copyObj->setP26($this->getP26());
        $copyObj->setP27($this->getP27());
        $copyObj->setP28($this->getP28());
        $copyObj->setP29($this->getP29());
        $copyObj->setP30($this->getP30());
        $copyObj->setP31($this->getP31());
        $copyObj->setP32($this->getP32());
        $copyObj->setP33($this->getP33());
        $copyObj->setP34($this->getP34());
        $copyObj->setP35($this->getP35());
        $copyObj->setP1n($this->getP1n());
        $copyObj->setP2n($this->getP2n());
        $copyObj->setP3n($this->getP3n());
        $copyObj->setP4n($this->getP4n());
        $copyObj->setP5n($this->getP5n());
        $copyObj->setP6n($this->getP6n());
        $copyObj->setP7n($this->getP7n());
        $copyObj->setP8n($this->getP8n());
        $copyObj->setP9n($this->getP9n());
        $copyObj->setP10n($this->getP10n());
        $copyObj->setP11n($this->getP11n());
        $copyObj->setP12n($this->getP12n());
        $copyObj->setP13n($this->getP13n());
        $copyObj->setP14n($this->getP14n());
        $copyObj->setP15n($this->getP15n());
        $copyObj->setP16n($this->getP16n());
        $copyObj->setP17n($this->getP17n());
        $copyObj->setP18n($this->getP18n());
        $copyObj->setP19n($this->getP19n());
        $copyObj->setP20n($this->getP20n());
        $copyObj->setP21n($this->getP21n());
        $copyObj->setP22n($this->getP22n());
        $copyObj->setP23n($this->getP23n());
        $copyObj->setP24n($this->getP24n());
        $copyObj->setP25n($this->getP25n());
        $copyObj->setP26n($this->getP26n());
        $copyObj->setP27n($this->getP27n());
        $copyObj->setP28n($this->getP28n());
        $copyObj->setP29n($this->getP29n());
        $copyObj->setP30n($this->getP30n());
        $copyObj->setP31n($this->getP31n());
        $copyObj->setP32n($this->getP32n());
        $copyObj->setP33n($this->getP33n());
        $copyObj->setP34n($this->getP34n());
        $copyObj->setP35n($this->getP35n());
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
     * @return \Tekstove\TekstoveBundle\Model\Entity\Albums Clone of current object.
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
     * Clears the current object, sets all attributes to their default values and removes
     * outgoing references as well as back-references (from other objects to this one. Results probably in a database
     * change of those foreign objects when you call `save` there).
     */
    public function clear()
    {
        $this->id = null;
        $this->name = null;
        $this->artist1id = null;
        $this->artist2id = null;
        $this->dopylnitelnoinfo = null;
        $this->year = null;
        $this->image = null;
        $this->vid = null;
        $this->up_id = null;
        $this->va = null;
        $this->p1 = null;
        $this->p2 = null;
        $this->p3 = null;
        $this->p4 = null;
        $this->p5 = null;
        $this->p6 = null;
        $this->p7 = null;
        $this->p8 = null;
        $this->p9 = null;
        $this->p10 = null;
        $this->p11 = null;
        $this->p12 = null;
        $this->p13 = null;
        $this->p14 = null;
        $this->p15 = null;
        $this->p16 = null;
        $this->p17 = null;
        $this->p18 = null;
        $this->p19 = null;
        $this->p20 = null;
        $this->p21 = null;
        $this->p22 = null;
        $this->p23 = null;
        $this->p24 = null;
        $this->p25 = null;
        $this->p26 = null;
        $this->p27 = null;
        $this->p28 = null;
        $this->p29 = null;
        $this->p30 = null;
        $this->p31 = null;
        $this->p32 = null;
        $this->p33 = null;
        $this->p34 = null;
        $this->p35 = null;
        $this->p1n = null;
        $this->p2n = null;
        $this->p3n = null;
        $this->p4n = null;
        $this->p5n = null;
        $this->p6n = null;
        $this->p7n = null;
        $this->p8n = null;
        $this->p9n = null;
        $this->p10n = null;
        $this->p11n = null;
        $this->p12n = null;
        $this->p13n = null;
        $this->p14n = null;
        $this->p15n = null;
        $this->p16n = null;
        $this->p17n = null;
        $this->p18n = null;
        $this->p19n = null;
        $this->p20n = null;
        $this->p21n = null;
        $this->p22n = null;
        $this->p23n = null;
        $this->p24n = null;
        $this->p25n = null;
        $this->p26n = null;
        $this->p27n = null;
        $this->p28n = null;
        $this->p29n = null;
        $this->p30n = null;
        $this->p31n = null;
        $this->p32n = null;
        $this->p33n = null;
        $this->p34n = null;
        $this->p35n = null;
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
        } // if ($deep)

    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(AlbumsTableMap::DEFAULT_STRING_FORMAT);
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
