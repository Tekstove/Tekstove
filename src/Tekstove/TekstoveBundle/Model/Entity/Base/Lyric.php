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
use Tekstove\TekstoveBundle\Model\Entity\Comments as ChildComments;
use Tekstove\TekstoveBundle\Model\Entity\CommentsQuery as ChildCommentsQuery;
use Tekstove\TekstoveBundle\Model\Entity\EditAddPrevod as ChildEditAddPrevod;
use Tekstove\TekstoveBundle\Model\Entity\EditAddPrevodQuery as ChildEditAddPrevodQuery;
use Tekstove\TekstoveBundle\Model\Entity\Languages as ChildLanguages;
use Tekstove\TekstoveBundle\Model\Entity\LanguagesQuery as ChildLanguagesQuery;
use Tekstove\TekstoveBundle\Model\Entity\Liubimi as ChildLiubimi;
use Tekstove\TekstoveBundle\Model\Entity\LiubimiQuery as ChildLiubimiQuery;
use Tekstove\TekstoveBundle\Model\Entity\Lyric as ChildLyric;
use Tekstove\TekstoveBundle\Model\Entity\Lyric18 as ChildLyric18;
use Tekstove\TekstoveBundle\Model\Entity\Lyric18Query as ChildLyric18Query;
use Tekstove\TekstoveBundle\Model\Entity\LyricQuery as ChildLyricQuery;
use Tekstove\TekstoveBundle\Model\Entity\LyricRedirect as ChildLyricRedirect;
use Tekstove\TekstoveBundle\Model\Entity\LyricRedirectQuery as ChildLyricRedirectQuery;
use Tekstove\TekstoveBundle\Model\Entity\Lyric\Votes;
use Tekstove\TekstoveBundle\Model\Entity\Lyric\VotesQuery;
use Tekstove\TekstoveBundle\Model\Entity\Lyric\Base\Votes as BaseVotes;
use Tekstove\TekstoveBundle\Model\Entity\Map\LyricTableMap;

/**
 * Base class that represents a row from the 'lyric' table.
 *
 *
 *
* @package    propel.generator.Tekstove.TekstoveBundle.Model.Entity.Base
*/
abstract class Lyric implements ActiveRecordInterface
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\Tekstove\\TekstoveBundle\\Model\\Entity\\Map\\LyricTableMap';


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
     * The value for the cache_title_full field.
     * @var        string
     */
    protected $cache_title_full;

    /**
     * The value for the cache_title_short field.
     * @var        string
     */
    protected $cache_title_short;

    /**
     * The value for the uploaded_by field.
     * @var        int
     */
    protected $uploaded_by;

    /**
     * The value for the text field.
     * @var        string
     */
    protected $text;

    /**
     * The value for the text_bg field.
     * @var        string
     */
    protected $text_bg;

    /**
     * The value for the artist1 field.
     * @var        int
     */
    protected $artist1;

    /**
     * The value for the artist2 field.
     * @var        int
     */
    protected $artist2;

    /**
     * The value for the artist3 field.
     * @var        int
     */
    protected $artist3;

    /**
     * The value for the artist4 field.
     * @var        int
     */
    protected $artist4;

    /**
     * The value for the artist5 field.
     * @var        int
     */
    protected $artist5;

    /**
     * The value for the artist6 field.
     * @var        int
     */
    protected $artist6;

    /**
     * The value for the title field.
     * @var        string
     */
    protected $title;

    /**
     * The value for the album1 field.
     * @var        int
     */
    protected $album1;

    /**
     * The value for the album2 field.
     * @var        int
     */
    protected $album2;

    /**
     * The value for the video field.
     * @var        string
     */
    protected $video;

    /**
     * The value for the video_vbox7 field.
     * @var        string
     */
    protected $video_vbox7;

    /**
     * The value for the video_vbox7_orig field.
     * @var        string
     */
    protected $video_vbox7_orig;

    /**
     * The value for the video_youtube field.
     * @var        string
     */
    protected $video_youtube;

    /**
     * The value for the video_youtube_orig field.
     * @var        string
     */
    protected $video_youtube_orig;

    /**
     * The value for the video_metacafe field.
     * @var        string
     */
    protected $video_metacafe;

    /**
     * The value for the video_metacafe_orig field.
     * @var        string
     */
    protected $video_metacafe_orig;

    /**
     * The value for the download field.
     * @var        string
     */
    protected $download;

    /**
     * The value for the image field.
     * @var        string
     */
    protected $image;

    /**
     * The value for the podnovena field.
     * Note: this column has a database default value of: (expression) CURRENT_TIMESTAMP
     * @var        \DateTime
     */
    protected $podnovena;

    /**
     * The value for the ip_upload field.
     * @var        string
     */
    protected $ip_upload;

    /**
     * The value for the dopylnitelnoinfo field.
     * @var        string
     */
    protected $dopylnitelnoinfo;

    /**
     * The value for the glasa field.
     * @var        int
     */
    protected $glasa;

    /**
     * The value for the views field.
     * @var        int
     */
    protected $views;

    /**
     * The value for the popularity field.
     * @var        int
     */
    protected $popularity;

    /**
     * The value for the stilraphiphop field.
     * @var        boolean
     */
    protected $stilraphiphop;

    /**
     * The value for the stilhiphop field.
     * @var        boolean
     */
    protected $stilhiphop;

    /**
     * The value for the stileastcoast field.
     * @var        boolean
     */
    protected $stileastcoast;

    /**
     * The value for the language field.
     * @var        int
     */
    protected $language;

    /**
     * The value for the stilskit field.
     * @var        boolean
     */
    protected $stilskit;

    /**
     * The value for the stilelektronna field.
     * @var        boolean
     */
    protected $stilelektronna;

    /**
     * The value for the stilrok field.
     * @var        boolean
     */
    protected $stilrok;

    /**
     * The value for the stilrok_clas field.
     * @var        boolean
     */
    protected $stilrok_clas;

    /**
     * The value for the stilrok_alt field.
     * @var        boolean
     */
    protected $stilrok_alt;

    /**
     * The value for the stilrok_hard field.
     * @var        boolean
     */
    protected $stilrok_hard;

    /**
     * The value for the stildisko field.
     * @var        boolean
     */
    protected $stildisko;

    /**
     * The value for the stillatam field.
     * @var        boolean
     */
    protected $stillatam;

    /**
     * The value for the stilsamba field.
     * @var        boolean
     */
    protected $stilsamba;

    /**
     * The value for the stiltango field.
     * @var        boolean
     */
    protected $stiltango;

    /**
     * The value for the stilsalsa field.
     * @var        boolean
     */
    protected $stilsalsa;

    /**
     * The value for the stilklasi field.
     * @var        boolean
     */
    protected $stilklasi;

    /**
     * The value for the stildetski field.
     * @var        boolean
     */
    protected $stildetski;

    /**
     * The value for the stilfolk field.
     * @var        boolean
     */
    protected $stilfolk;

    /**
     * The value for the stilnarodna field.
     * @var        boolean
     */
    protected $stilnarodna;

    /**
     * The value for the stilchalga field.
     * @var        boolean
     */
    protected $stilchalga;

    /**
     * The value for the stilpopfolk field.
     * @var        boolean
     */
    protected $stilpopfolk;

    /**
     * The value for the stilmetal field.
     * @var        boolean
     */
    protected $stilmetal;

    /**
     * The value for the stilmetal_heavy field.
     * @var        boolean
     */
    protected $stilmetal_heavy;

    /**
     * The value for the stilmetal_power field.
     * @var        boolean
     */
    protected $stilmetal_power;

    /**
     * The value for the stilmetal_death field.
     * @var        boolean
     */
    protected $stilmetal_death;

    /**
     * The value for the stilmetal_nu field.
     * @var        boolean
     */
    protected $stilmetal_nu;

    /**
     * The value for the stilmetal_gothic field.
     * @var        boolean
     */
    protected $stilmetal_gothic;

    /**
     * The value for the stilmetal_symphonic field.
     * @var        boolean
     */
    protected $stilmetal_symphonic;

    /**
     * The value for the stilsoundtrack field.
     * @var        boolean
     */
    protected $stilsoundtrack;

    /**
     * The value for the stildance field.
     * @var        boolean
     */
    protected $stildance;

    /**
     * The value for the stilrnb field.
     * @var        boolean
     */
    protected $stilrnb;

    /**
     * The value for the stilsoul field.
     * @var        boolean
     */
    protected $stilsoul;

    /**
     * The value for the stilnew_rave field.
     * @var        boolean
     */
    protected $stilnew_rave;

    /**
     * The value for the stilreggae field.
     * @var        boolean
     */
    protected $stilreggae;

    /**
     * The value for the stilkantri field.
     * @var        boolean
     */
    protected $stilkantri;

    /**
     * The value for the stilpunk field.
     * @var        boolean
     */
    protected $stilpunk;

    /**
     * The value for the stilemo field.
     * @var        boolean
     */
    protected $stilemo;

    /**
     * The value for the stilbreakbeat field.
     * @var        boolean
     */
    protected $stilbreakbeat;

    /**
     * The value for the stilbigbeat field.
     * @var        boolean
     */
    protected $stilbigbeat;

    /**
     * The value for the stiljaz field.
     * @var        boolean
     */
    protected $stiljaz;

    /**
     * The value for the stilblus field.
     * @var        boolean
     */
    protected $stilblus;

    /**
     * The value for the stilelectronica field.
     * @var        boolean
     */
    protected $stilelectronica;

    /**
     * The value for the stilska field.
     * @var        boolean
     */
    protected $stilska;

    /**
     * @var        ChildLanguages
     */
    protected $aLanguages;

    /**
     * @var        ObjectCollection|ChildEditAddPrevod[] Collection to store aggregation of ChildEditAddPrevod objects.
     */
    protected $collEditAddPrevods;
    protected $collEditAddPrevodsPartial;

    /**
     * @var        ObjectCollection|ChildLiubimi[] Collection to store aggregation of ChildLiubimi objects.
     */
    protected $collLiubimis;
    protected $collLiubimisPartial;

    /**
     * @var        ChildLyric18 one-to-one related ChildLyric18 object
     */
    protected $singleLyric18;

    /**
     * @var        ObjectCollection|ChildLyricRedirect[] Collection to store aggregation of ChildLyricRedirect objects.
     */
    protected $collLyricRedirects;
    protected $collLyricRedirectsPartial;

    /**
     * @var        ObjectCollection|ChildComments[] Collection to store aggregation of ChildComments objects.
     */
    protected $collCommentss;
    protected $collCommentssPartial;

    /**
     * @var        ObjectCollection|Votes[] Collection to store aggregation of Votes objects.
     */
    protected $collVotess;
    protected $collVotessPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var boolean
     */
    protected $alreadyInSave = false;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildEditAddPrevod[]
     */
    protected $editAddPrevodsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildLiubimi[]
     */
    protected $liubimisScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildLyricRedirect[]
     */
    protected $lyricRedirectsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildComments[]
     */
    protected $commentssScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|Votes[]
     */
    protected $votessScheduledForDeletion = null;

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
     * Initializes internal state of Tekstove\TekstoveBundle\Model\Entity\Base\Lyric object.
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
     * Get the [cache_title_full] column value.
     *
     * @return string
     */
    public function getcacheTitleFull()
    {
        return $this->cache_title_full;
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
     * Get the [uploaded_by] column value.
     *
     * @return int
     */
    public function getuploader()
    {
        return $this->uploaded_by;
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
     * Get the [artist1] column value.
     *
     * @return int
     */
    public function getArtist1()
    {
        return $this->artist1;
    }

    /**
     * Get the [artist2] column value.
     *
     * @return int
     */
    public function getArtist2()
    {
        return $this->artist2;
    }

    /**
     * Get the [artist3] column value.
     *
     * @return int
     */
    public function getArtist3()
    {
        return $this->artist3;
    }

    /**
     * Get the [artist4] column value.
     *
     * @return int
     */
    public function getArtist4()
    {
        return $this->artist4;
    }

    /**
     * Get the [artist5] column value.
     *
     * @return int
     */
    public function getArtist5()
    {
        return $this->artist5;
    }

    /**
     * Get the [artist6] column value.
     *
     * @return int
     */
    public function getArtist6()
    {
        return $this->artist6;
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
     * Get the [album1] column value.
     *
     * @return int
     */
    public function getAlbum1()
    {
        return $this->album1;
    }

    /**
     * Get the [album2] column value.
     *
     * @return int
     */
    public function getAlbum2()
    {
        return $this->album2;
    }

    /**
     * Get the [video] column value.
     *
     * @return string
     */
    public function getVideo()
    {
        return $this->video;
    }

    /**
     * Get the [video_vbox7] column value.
     *
     * @return string
     */
    public function getVideoVbox7()
    {
        return $this->video_vbox7;
    }

    /**
     * Get the [video_vbox7_orig] column value.
     *
     * @return string
     */
    public function getVideoVbox7Orig()
    {
        return $this->video_vbox7_orig;
    }

    /**
     * Get the [video_youtube] column value.
     *
     * @return string
     */
    public function getVideoYoutube()
    {
        return $this->video_youtube;
    }

    /**
     * Get the [video_youtube_orig] column value.
     *
     * @return string
     */
    public function getVideoYoutubeOrig()
    {
        return $this->video_youtube_orig;
    }

    /**
     * Get the [video_metacafe] column value.
     *
     * @return string
     */
    public function getVideoMetacafe()
    {
        return $this->video_metacafe;
    }

    /**
     * Get the [video_metacafe_orig] column value.
     *
     * @return string
     */
    public function getVideoMetacafeOrig()
    {
        return $this->video_metacafe_orig;
    }

    /**
     * Get the [download] column value.
     *
     * @return string
     */
    public function getDownload()
    {
        return $this->download;
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
     * Get the [optionally formatted] temporal [podnovena] column value.
     *
     *
     * @param      string $format The date/time format string (either date()-style or strftime()-style).
     *                            If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getPodnovena($format = NULL)
    {
        if ($format === null) {
            return $this->podnovena;
        } else {
            return $this->podnovena instanceof \DateTime ? $this->podnovena->format($format) : null;
        }
    }

    /**
     * Get the [ip_upload] column value.
     *
     * @return string
     */
    public function getIpUpload()
    {
        return $this->ip_upload;
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
     * Get the [glasa] column value.
     *
     * @return int
     */
    public function getcacheVotes()
    {
        return $this->glasa;
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
     * Get the [stilraphiphop] column value.
     *
     * @return boolean
     */
    public function getStilraphiphop()
    {
        return $this->stilraphiphop;
    }

    /**
     * Get the [stilraphiphop] column value.
     *
     * @return boolean
     */
    public function isStilraphiphop()
    {
        return $this->getStilraphiphop();
    }

    /**
     * Get the [stilhiphop] column value.
     *
     * @return boolean
     */
    public function getStilhiphop()
    {
        return $this->stilhiphop;
    }

    /**
     * Get the [stilhiphop] column value.
     *
     * @return boolean
     */
    public function isStilhiphop()
    {
        return $this->getStilhiphop();
    }

    /**
     * Get the [stileastcoast] column value.
     *
     * @return boolean
     */
    public function getStileastcoast()
    {
        return $this->stileastcoast;
    }

    /**
     * Get the [stileastcoast] column value.
     *
     * @return boolean
     */
    public function isStileastcoast()
    {
        return $this->getStileastcoast();
    }

    /**
     * Get the [language] column value.
     *
     * @return int
     */
    public function getlanguage()
    {
        return $this->language;
    }

    /**
     * Get the [stilskit] column value.
     *
     * @return boolean
     */
    public function getStilskit()
    {
        return $this->stilskit;
    }

    /**
     * Get the [stilskit] column value.
     *
     * @return boolean
     */
    public function isStilskit()
    {
        return $this->getStilskit();
    }

    /**
     * Get the [stilelektronna] column value.
     *
     * @return boolean
     */
    public function getStilelektronna()
    {
        return $this->stilelektronna;
    }

    /**
     * Get the [stilelektronna] column value.
     *
     * @return boolean
     */
    public function isStilelektronna()
    {
        return $this->getStilelektronna();
    }

    /**
     * Get the [stilrok] column value.
     *
     * @return boolean
     */
    public function getStilrok()
    {
        return $this->stilrok;
    }

    /**
     * Get the [stilrok] column value.
     *
     * @return boolean
     */
    public function isStilrok()
    {
        return $this->getStilrok();
    }

    /**
     * Get the [stilrok_clas] column value.
     *
     * @return boolean
     */
    public function getStilrokClas()
    {
        return $this->stilrok_clas;
    }

    /**
     * Get the [stilrok_clas] column value.
     *
     * @return boolean
     */
    public function isStilrokClas()
    {
        return $this->getStilrokClas();
    }

    /**
     * Get the [stilrok_alt] column value.
     *
     * @return boolean
     */
    public function getStilrokAlt()
    {
        return $this->stilrok_alt;
    }

    /**
     * Get the [stilrok_alt] column value.
     *
     * @return boolean
     */
    public function isStilrokAlt()
    {
        return $this->getStilrokAlt();
    }

    /**
     * Get the [stilrok_hard] column value.
     *
     * @return boolean
     */
    public function getStilrokHard()
    {
        return $this->stilrok_hard;
    }

    /**
     * Get the [stilrok_hard] column value.
     *
     * @return boolean
     */
    public function isStilrokHard()
    {
        return $this->getStilrokHard();
    }

    /**
     * Get the [stildisko] column value.
     *
     * @return boolean
     */
    public function getStildisko()
    {
        return $this->stildisko;
    }

    /**
     * Get the [stildisko] column value.
     *
     * @return boolean
     */
    public function isStildisko()
    {
        return $this->getStildisko();
    }

    /**
     * Get the [stillatam] column value.
     *
     * @return boolean
     */
    public function getStillatam()
    {
        return $this->stillatam;
    }

    /**
     * Get the [stillatam] column value.
     *
     * @return boolean
     */
    public function isStillatam()
    {
        return $this->getStillatam();
    }

    /**
     * Get the [stilsamba] column value.
     *
     * @return boolean
     */
    public function getStilsamba()
    {
        return $this->stilsamba;
    }

    /**
     * Get the [stilsamba] column value.
     *
     * @return boolean
     */
    public function isStilsamba()
    {
        return $this->getStilsamba();
    }

    /**
     * Get the [stiltango] column value.
     *
     * @return boolean
     */
    public function getStiltango()
    {
        return $this->stiltango;
    }

    /**
     * Get the [stiltango] column value.
     *
     * @return boolean
     */
    public function isStiltango()
    {
        return $this->getStiltango();
    }

    /**
     * Get the [stilsalsa] column value.
     *
     * @return boolean
     */
    public function getStilsalsa()
    {
        return $this->stilsalsa;
    }

    /**
     * Get the [stilsalsa] column value.
     *
     * @return boolean
     */
    public function isStilsalsa()
    {
        return $this->getStilsalsa();
    }

    /**
     * Get the [stilklasi] column value.
     *
     * @return boolean
     */
    public function getStilklasi()
    {
        return $this->stilklasi;
    }

    /**
     * Get the [stilklasi] column value.
     *
     * @return boolean
     */
    public function isStilklasi()
    {
        return $this->getStilklasi();
    }

    /**
     * Get the [stildetski] column value.
     *
     * @return boolean
     */
    public function getStildetski()
    {
        return $this->stildetski;
    }

    /**
     * Get the [stildetski] column value.
     *
     * @return boolean
     */
    public function isStildetski()
    {
        return $this->getStildetski();
    }

    /**
     * Get the [stilfolk] column value.
     *
     * @return boolean
     */
    public function getStilfolk()
    {
        return $this->stilfolk;
    }

    /**
     * Get the [stilfolk] column value.
     *
     * @return boolean
     */
    public function isStilfolk()
    {
        return $this->getStilfolk();
    }

    /**
     * Get the [stilnarodna] column value.
     *
     * @return boolean
     */
    public function getStilnarodna()
    {
        return $this->stilnarodna;
    }

    /**
     * Get the [stilnarodna] column value.
     *
     * @return boolean
     */
    public function isStilnarodna()
    {
        return $this->getStilnarodna();
    }

    /**
     * Get the [stilchalga] column value.
     *
     * @return boolean
     */
    public function getStilchalga()
    {
        return $this->stilchalga;
    }

    /**
     * Get the [stilchalga] column value.
     *
     * @return boolean
     */
    public function isStilchalga()
    {
        return $this->getStilchalga();
    }

    /**
     * Get the [stilpopfolk] column value.
     *
     * @return boolean
     */
    public function getStilpopfolk()
    {
        return $this->stilpopfolk;
    }

    /**
     * Get the [stilpopfolk] column value.
     *
     * @return boolean
     */
    public function isStilpopfolk()
    {
        return $this->getStilpopfolk();
    }

    /**
     * Get the [stilmetal] column value.
     *
     * @return boolean
     */
    public function getStilmetal()
    {
        return $this->stilmetal;
    }

    /**
     * Get the [stilmetal] column value.
     *
     * @return boolean
     */
    public function isStilmetal()
    {
        return $this->getStilmetal();
    }

    /**
     * Get the [stilmetal_heavy] column value.
     *
     * @return boolean
     */
    public function getStilmetalHeavy()
    {
        return $this->stilmetal_heavy;
    }

    /**
     * Get the [stilmetal_heavy] column value.
     *
     * @return boolean
     */
    public function isStilmetalHeavy()
    {
        return $this->getStilmetalHeavy();
    }

    /**
     * Get the [stilmetal_power] column value.
     *
     * @return boolean
     */
    public function getStilmetalPower()
    {
        return $this->stilmetal_power;
    }

    /**
     * Get the [stilmetal_power] column value.
     *
     * @return boolean
     */
    public function isStilmetalPower()
    {
        return $this->getStilmetalPower();
    }

    /**
     * Get the [stilmetal_death] column value.
     *
     * @return boolean
     */
    public function getStilmetalDeath()
    {
        return $this->stilmetal_death;
    }

    /**
     * Get the [stilmetal_death] column value.
     *
     * @return boolean
     */
    public function isStilmetalDeath()
    {
        return $this->getStilmetalDeath();
    }

    /**
     * Get the [stilmetal_nu] column value.
     *
     * @return boolean
     */
    public function getStilmetalNu()
    {
        return $this->stilmetal_nu;
    }

    /**
     * Get the [stilmetal_nu] column value.
     *
     * @return boolean
     */
    public function isStilmetalNu()
    {
        return $this->getStilmetalNu();
    }

    /**
     * Get the [stilmetal_gothic] column value.
     *
     * @return boolean
     */
    public function getStilmetalGothic()
    {
        return $this->stilmetal_gothic;
    }

    /**
     * Get the [stilmetal_gothic] column value.
     *
     * @return boolean
     */
    public function isStilmetalGothic()
    {
        return $this->getStilmetalGothic();
    }

    /**
     * Get the [stilmetal_symphonic] column value.
     *
     * @return boolean
     */
    public function getStilmetalSymphonic()
    {
        return $this->stilmetal_symphonic;
    }

    /**
     * Get the [stilmetal_symphonic] column value.
     *
     * @return boolean
     */
    public function isStilmetalSymphonic()
    {
        return $this->getStilmetalSymphonic();
    }

    /**
     * Get the [stilsoundtrack] column value.
     *
     * @return boolean
     */
    public function getStilsoundtrack()
    {
        return $this->stilsoundtrack;
    }

    /**
     * Get the [stilsoundtrack] column value.
     *
     * @return boolean
     */
    public function isStilsoundtrack()
    {
        return $this->getStilsoundtrack();
    }

    /**
     * Get the [stildance] column value.
     *
     * @return boolean
     */
    public function getStildance()
    {
        return $this->stildance;
    }

    /**
     * Get the [stildance] column value.
     *
     * @return boolean
     */
    public function isStildance()
    {
        return $this->getStildance();
    }

    /**
     * Get the [stilrnb] column value.
     *
     * @return boolean
     */
    public function getStilrnb()
    {
        return $this->stilrnb;
    }

    /**
     * Get the [stilrnb] column value.
     *
     * @return boolean
     */
    public function isStilrnb()
    {
        return $this->getStilrnb();
    }

    /**
     * Get the [stilsoul] column value.
     *
     * @return boolean
     */
    public function getStilsoul()
    {
        return $this->stilsoul;
    }

    /**
     * Get the [stilsoul] column value.
     *
     * @return boolean
     */
    public function isStilsoul()
    {
        return $this->getStilsoul();
    }

    /**
     * Get the [stilnew_rave] column value.
     *
     * @return boolean
     */
    public function getStilnewRave()
    {
        return $this->stilnew_rave;
    }

    /**
     * Get the [stilnew_rave] column value.
     *
     * @return boolean
     */
    public function isStilnewRave()
    {
        return $this->getStilnewRave();
    }

    /**
     * Get the [stilreggae] column value.
     *
     * @return boolean
     */
    public function getStilreggae()
    {
        return $this->stilreggae;
    }

    /**
     * Get the [stilreggae] column value.
     *
     * @return boolean
     */
    public function isStilreggae()
    {
        return $this->getStilreggae();
    }

    /**
     * Get the [stilkantri] column value.
     *
     * @return boolean
     */
    public function getStilkantri()
    {
        return $this->stilkantri;
    }

    /**
     * Get the [stilkantri] column value.
     *
     * @return boolean
     */
    public function isStilkantri()
    {
        return $this->getStilkantri();
    }

    /**
     * Get the [stilpunk] column value.
     *
     * @return boolean
     */
    public function getStilpunk()
    {
        return $this->stilpunk;
    }

    /**
     * Get the [stilpunk] column value.
     *
     * @return boolean
     */
    public function isStilpunk()
    {
        return $this->getStilpunk();
    }

    /**
     * Get the [stilemo] column value.
     *
     * @return boolean
     */
    public function getStilemo()
    {
        return $this->stilemo;
    }

    /**
     * Get the [stilemo] column value.
     *
     * @return boolean
     */
    public function isStilemo()
    {
        return $this->getStilemo();
    }

    /**
     * Get the [stilbreakbeat] column value.
     *
     * @return boolean
     */
    public function getStilbreakbeat()
    {
        return $this->stilbreakbeat;
    }

    /**
     * Get the [stilbreakbeat] column value.
     *
     * @return boolean
     */
    public function isStilbreakbeat()
    {
        return $this->getStilbreakbeat();
    }

    /**
     * Get the [stilbigbeat] column value.
     *
     * @return boolean
     */
    public function getStilbigbeat()
    {
        return $this->stilbigbeat;
    }

    /**
     * Get the [stilbigbeat] column value.
     *
     * @return boolean
     */
    public function isStilbigbeat()
    {
        return $this->getStilbigbeat();
    }

    /**
     * Get the [stiljaz] column value.
     *
     * @return boolean
     */
    public function getStiljaz()
    {
        return $this->stiljaz;
    }

    /**
     * Get the [stiljaz] column value.
     *
     * @return boolean
     */
    public function isStiljaz()
    {
        return $this->getStiljaz();
    }

    /**
     * Get the [stilblus] column value.
     *
     * @return boolean
     */
    public function getStilblus()
    {
        return $this->stilblus;
    }

    /**
     * Get the [stilblus] column value.
     *
     * @return boolean
     */
    public function isStilblus()
    {
        return $this->getStilblus();
    }

    /**
     * Get the [stilelectronica] column value.
     *
     * @return boolean
     */
    public function getStilelectronica()
    {
        return $this->stilelectronica;
    }

    /**
     * Get the [stilelectronica] column value.
     *
     * @return boolean
     */
    public function isStilelectronica()
    {
        return $this->getStilelectronica();
    }

    /**
     * Get the [stilska] column value.
     *
     * @return boolean
     */
    public function getStilska()
    {
        return $this->stilska;
    }

    /**
     * Get the [stilska] column value.
     *
     * @return boolean
     */
    public function isStilska()
    {
        return $this->getStilska();
    }

    /**
     * Set the value of [id] column.
     *
     * @param int $v new value
     * @return $this|\Tekstove\TekstoveBundle\Model\Entity\Lyric The current object (for fluent API support)
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
     * Set the value of [cache_title_full] column.
     *
     * @param string $v new value
     * @return $this|\Tekstove\TekstoveBundle\Model\Entity\Lyric The current object (for fluent API support)
     */
    public function setcacheTitleFull($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->cache_title_full !== $v) {
            $this->cache_title_full = $v;
            $this->modifiedColumns[LyricTableMap::COL_CACHE_TITLE_FULL] = true;
        }

        return $this;
    } // setcacheTitleFull()

    /**
     * Set the value of [cache_title_short] column.
     *
     * @param string $v new value
     * @return $this|\Tekstove\TekstoveBundle\Model\Entity\Lyric The current object (for fluent API support)
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
     * Set the value of [uploaded_by] column.
     *
     * @param int $v new value
     * @return $this|\Tekstove\TekstoveBundle\Model\Entity\Lyric The current object (for fluent API support)
     */
    public function setuploader($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->uploaded_by !== $v) {
            $this->uploaded_by = $v;
            $this->modifiedColumns[LyricTableMap::COL_UPLOADED_BY] = true;
        }

        return $this;
    } // setuploader()

    /**
     * Set the value of [text] column.
     *
     * @param string $v new value
     * @return $this|\Tekstove\TekstoveBundle\Model\Entity\Lyric The current object (for fluent API support)
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
     * @return $this|\Tekstove\TekstoveBundle\Model\Entity\Lyric The current object (for fluent API support)
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
     * Set the value of [artist1] column.
     *
     * @param int $v new value
     * @return $this|\Tekstove\TekstoveBundle\Model\Entity\Lyric The current object (for fluent API support)
     */
    public function setArtist1($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->artist1 !== $v) {
            $this->artist1 = $v;
            $this->modifiedColumns[LyricTableMap::COL_ARTIST1] = true;
        }

        return $this;
    } // setArtist1()

    /**
     * Set the value of [artist2] column.
     *
     * @param int $v new value
     * @return $this|\Tekstove\TekstoveBundle\Model\Entity\Lyric The current object (for fluent API support)
     */
    public function setArtist2($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->artist2 !== $v) {
            $this->artist2 = $v;
            $this->modifiedColumns[LyricTableMap::COL_ARTIST2] = true;
        }

        return $this;
    } // setArtist2()

    /**
     * Set the value of [artist3] column.
     *
     * @param int $v new value
     * @return $this|\Tekstove\TekstoveBundle\Model\Entity\Lyric The current object (for fluent API support)
     */
    public function setArtist3($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->artist3 !== $v) {
            $this->artist3 = $v;
            $this->modifiedColumns[LyricTableMap::COL_ARTIST3] = true;
        }

        return $this;
    } // setArtist3()

    /**
     * Set the value of [artist4] column.
     *
     * @param int $v new value
     * @return $this|\Tekstove\TekstoveBundle\Model\Entity\Lyric The current object (for fluent API support)
     */
    public function setArtist4($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->artist4 !== $v) {
            $this->artist4 = $v;
            $this->modifiedColumns[LyricTableMap::COL_ARTIST4] = true;
        }

        return $this;
    } // setArtist4()

    /**
     * Set the value of [artist5] column.
     *
     * @param int $v new value
     * @return $this|\Tekstove\TekstoveBundle\Model\Entity\Lyric The current object (for fluent API support)
     */
    public function setArtist5($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->artist5 !== $v) {
            $this->artist5 = $v;
            $this->modifiedColumns[LyricTableMap::COL_ARTIST5] = true;
        }

        return $this;
    } // setArtist5()

    /**
     * Set the value of [artist6] column.
     *
     * @param int $v new value
     * @return $this|\Tekstove\TekstoveBundle\Model\Entity\Lyric The current object (for fluent API support)
     */
    public function setArtist6($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->artist6 !== $v) {
            $this->artist6 = $v;
            $this->modifiedColumns[LyricTableMap::COL_ARTIST6] = true;
        }

        return $this;
    } // setArtist6()

    /**
     * Set the value of [title] column.
     *
     * @param string $v new value
     * @return $this|\Tekstove\TekstoveBundle\Model\Entity\Lyric The current object (for fluent API support)
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
     * Set the value of [album1] column.
     *
     * @param int $v new value
     * @return $this|\Tekstove\TekstoveBundle\Model\Entity\Lyric The current object (for fluent API support)
     */
    public function setAlbum1($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->album1 !== $v) {
            $this->album1 = $v;
            $this->modifiedColumns[LyricTableMap::COL_ALBUM1] = true;
        }

        return $this;
    } // setAlbum1()

    /**
     * Set the value of [album2] column.
     *
     * @param int $v new value
     * @return $this|\Tekstove\TekstoveBundle\Model\Entity\Lyric The current object (for fluent API support)
     */
    public function setAlbum2($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->album2 !== $v) {
            $this->album2 = $v;
            $this->modifiedColumns[LyricTableMap::COL_ALBUM2] = true;
        }

        return $this;
    } // setAlbum2()

    /**
     * Set the value of [video] column.
     *
     * @param string $v new value
     * @return $this|\Tekstove\TekstoveBundle\Model\Entity\Lyric The current object (for fluent API support)
     */
    public function setVideo($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->video !== $v) {
            $this->video = $v;
            $this->modifiedColumns[LyricTableMap::COL_VIDEO] = true;
        }

        return $this;
    } // setVideo()

    /**
     * Set the value of [video_vbox7] column.
     *
     * @param string $v new value
     * @return $this|\Tekstove\TekstoveBundle\Model\Entity\Lyric The current object (for fluent API support)
     */
    public function setVideoVbox7($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->video_vbox7 !== $v) {
            $this->video_vbox7 = $v;
            $this->modifiedColumns[LyricTableMap::COL_VIDEO_VBOX7] = true;
        }

        return $this;
    } // setVideoVbox7()

    /**
     * Set the value of [video_vbox7_orig] column.
     *
     * @param string $v new value
     * @return $this|\Tekstove\TekstoveBundle\Model\Entity\Lyric The current object (for fluent API support)
     */
    public function setVideoVbox7Orig($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->video_vbox7_orig !== $v) {
            $this->video_vbox7_orig = $v;
            $this->modifiedColumns[LyricTableMap::COL_VIDEO_VBOX7_ORIG] = true;
        }

        return $this;
    } // setVideoVbox7Orig()

    /**
     * Set the value of [video_youtube] column.
     *
     * @param string $v new value
     * @return $this|\Tekstove\TekstoveBundle\Model\Entity\Lyric The current object (for fluent API support)
     */
    public function setVideoYoutube($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->video_youtube !== $v) {
            $this->video_youtube = $v;
            $this->modifiedColumns[LyricTableMap::COL_VIDEO_YOUTUBE] = true;
        }

        return $this;
    } // setVideoYoutube()

    /**
     * Set the value of [video_youtube_orig] column.
     *
     * @param string $v new value
     * @return $this|\Tekstove\TekstoveBundle\Model\Entity\Lyric The current object (for fluent API support)
     */
    public function setVideoYoutubeOrig($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->video_youtube_orig !== $v) {
            $this->video_youtube_orig = $v;
            $this->modifiedColumns[LyricTableMap::COL_VIDEO_YOUTUBE_ORIG] = true;
        }

        return $this;
    } // setVideoYoutubeOrig()

    /**
     * Set the value of [video_metacafe] column.
     *
     * @param string $v new value
     * @return $this|\Tekstove\TekstoveBundle\Model\Entity\Lyric The current object (for fluent API support)
     */
    public function setVideoMetacafe($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->video_metacafe !== $v) {
            $this->video_metacafe = $v;
            $this->modifiedColumns[LyricTableMap::COL_VIDEO_METACAFE] = true;
        }

        return $this;
    } // setVideoMetacafe()

    /**
     * Set the value of [video_metacafe_orig] column.
     *
     * @param string $v new value
     * @return $this|\Tekstove\TekstoveBundle\Model\Entity\Lyric The current object (for fluent API support)
     */
    public function setVideoMetacafeOrig($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->video_metacafe_orig !== $v) {
            $this->video_metacafe_orig = $v;
            $this->modifiedColumns[LyricTableMap::COL_VIDEO_METACAFE_ORIG] = true;
        }

        return $this;
    } // setVideoMetacafeOrig()

    /**
     * Set the value of [download] column.
     *
     * @param string $v new value
     * @return $this|\Tekstove\TekstoveBundle\Model\Entity\Lyric The current object (for fluent API support)
     */
    public function setDownload($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->download !== $v) {
            $this->download = $v;
            $this->modifiedColumns[LyricTableMap::COL_DOWNLOAD] = true;
        }

        return $this;
    } // setDownload()

    /**
     * Set the value of [image] column.
     *
     * @param string $v new value
     * @return $this|\Tekstove\TekstoveBundle\Model\Entity\Lyric The current object (for fluent API support)
     */
    public function setImage($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->image !== $v) {
            $this->image = $v;
            $this->modifiedColumns[LyricTableMap::COL_IMAGE] = true;
        }

        return $this;
    } // setImage()

    /**
     * Sets the value of [podnovena] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTime value.
     *               Empty strings are treated as NULL.
     * @return $this|\Tekstove\TekstoveBundle\Model\Entity\Lyric The current object (for fluent API support)
     */
    public function setPodnovena($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->podnovena !== null || $dt !== null) {
            if ($this->podnovena === null || $dt === null || $dt->format("Y-m-d H:i:s") !== $this->podnovena->format("Y-m-d H:i:s")) {
                $this->podnovena = $dt === null ? null : clone $dt;
                $this->modifiedColumns[LyricTableMap::COL_PODNOVENA] = true;
            }
        } // if either are not null

        return $this;
    } // setPodnovena()

    /**
     * Set the value of [ip_upload] column.
     *
     * @param string $v new value
     * @return $this|\Tekstove\TekstoveBundle\Model\Entity\Lyric The current object (for fluent API support)
     */
    public function setIpUpload($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->ip_upload !== $v) {
            $this->ip_upload = $v;
            $this->modifiedColumns[LyricTableMap::COL_IP_UPLOAD] = true;
        }

        return $this;
    } // setIpUpload()

    /**
     * Set the value of [dopylnitelnoinfo] column.
     *
     * @param string $v new value
     * @return $this|\Tekstove\TekstoveBundle\Model\Entity\Lyric The current object (for fluent API support)
     */
    public function setDopylnitelnoinfo($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->dopylnitelnoinfo !== $v) {
            $this->dopylnitelnoinfo = $v;
            $this->modifiedColumns[LyricTableMap::COL_DOPYLNITELNOINFO] = true;
        }

        return $this;
    } // setDopylnitelnoinfo()

    /**
     * Set the value of [glasa] column.
     *
     * @param int $v new value
     * @return $this|\Tekstove\TekstoveBundle\Model\Entity\Lyric The current object (for fluent API support)
     */
    public function setcacheVotes($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->glasa !== $v) {
            $this->glasa = $v;
            $this->modifiedColumns[LyricTableMap::COL_GLASA] = true;
        }

        return $this;
    } // setcacheVotes()

    /**
     * Set the value of [views] column.
     *
     * @param int $v new value
     * @return $this|\Tekstove\TekstoveBundle\Model\Entity\Lyric The current object (for fluent API support)
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
     * @return $this|\Tekstove\TekstoveBundle\Model\Entity\Lyric The current object (for fluent API support)
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
     * Sets the value of the [stilraphiphop] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param  boolean|integer|string $v The new value
     * @return $this|\Tekstove\TekstoveBundle\Model\Entity\Lyric The current object (for fluent API support)
     */
    public function setStilraphiphop($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->stilraphiphop !== $v) {
            $this->stilraphiphop = $v;
            $this->modifiedColumns[LyricTableMap::COL_STILRAPHIPHOP] = true;
        }

        return $this;
    } // setStilraphiphop()

    /**
     * Sets the value of the [stilhiphop] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param  boolean|integer|string $v The new value
     * @return $this|\Tekstove\TekstoveBundle\Model\Entity\Lyric The current object (for fluent API support)
     */
    public function setStilhiphop($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->stilhiphop !== $v) {
            $this->stilhiphop = $v;
            $this->modifiedColumns[LyricTableMap::COL_STILHIPHOP] = true;
        }

        return $this;
    } // setStilhiphop()

    /**
     * Sets the value of the [stileastcoast] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param  boolean|integer|string $v The new value
     * @return $this|\Tekstove\TekstoveBundle\Model\Entity\Lyric The current object (for fluent API support)
     */
    public function setStileastcoast($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->stileastcoast !== $v) {
            $this->stileastcoast = $v;
            $this->modifiedColumns[LyricTableMap::COL_STILEASTCOAST] = true;
        }

        return $this;
    } // setStileastcoast()

    /**
     * Set the value of [language] column.
     *
     * @param int $v new value
     * @return $this|\Tekstove\TekstoveBundle\Model\Entity\Lyric The current object (for fluent API support)
     */
    public function setlanguage($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->language !== $v) {
            $this->language = $v;
            $this->modifiedColumns[LyricTableMap::COL_LANGUAGE] = true;
        }

        if ($this->aLanguages !== null && $this->aLanguages->getId() !== $v) {
            $this->aLanguages = null;
        }

        return $this;
    } // setlanguage()

    /**
     * Sets the value of the [stilskit] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param  boolean|integer|string $v The new value
     * @return $this|\Tekstove\TekstoveBundle\Model\Entity\Lyric The current object (for fluent API support)
     */
    public function setStilskit($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->stilskit !== $v) {
            $this->stilskit = $v;
            $this->modifiedColumns[LyricTableMap::COL_STILSKIT] = true;
        }

        return $this;
    } // setStilskit()

    /**
     * Sets the value of the [stilelektronna] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param  boolean|integer|string $v The new value
     * @return $this|\Tekstove\TekstoveBundle\Model\Entity\Lyric The current object (for fluent API support)
     */
    public function setStilelektronna($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->stilelektronna !== $v) {
            $this->stilelektronna = $v;
            $this->modifiedColumns[LyricTableMap::COL_STILELEKTRONNA] = true;
        }

        return $this;
    } // setStilelektronna()

    /**
     * Sets the value of the [stilrok] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param  boolean|integer|string $v The new value
     * @return $this|\Tekstove\TekstoveBundle\Model\Entity\Lyric The current object (for fluent API support)
     */
    public function setStilrok($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->stilrok !== $v) {
            $this->stilrok = $v;
            $this->modifiedColumns[LyricTableMap::COL_STILROK] = true;
        }

        return $this;
    } // setStilrok()

    /**
     * Sets the value of the [stilrok_clas] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param  boolean|integer|string $v The new value
     * @return $this|\Tekstove\TekstoveBundle\Model\Entity\Lyric The current object (for fluent API support)
     */
    public function setStilrokClas($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->stilrok_clas !== $v) {
            $this->stilrok_clas = $v;
            $this->modifiedColumns[LyricTableMap::COL_STILROK_CLAS] = true;
        }

        return $this;
    } // setStilrokClas()

    /**
     * Sets the value of the [stilrok_alt] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param  boolean|integer|string $v The new value
     * @return $this|\Tekstove\TekstoveBundle\Model\Entity\Lyric The current object (for fluent API support)
     */
    public function setStilrokAlt($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->stilrok_alt !== $v) {
            $this->stilrok_alt = $v;
            $this->modifiedColumns[LyricTableMap::COL_STILROK_ALT] = true;
        }

        return $this;
    } // setStilrokAlt()

    /**
     * Sets the value of the [stilrok_hard] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param  boolean|integer|string $v The new value
     * @return $this|\Tekstove\TekstoveBundle\Model\Entity\Lyric The current object (for fluent API support)
     */
    public function setStilrokHard($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->stilrok_hard !== $v) {
            $this->stilrok_hard = $v;
            $this->modifiedColumns[LyricTableMap::COL_STILROK_HARD] = true;
        }

        return $this;
    } // setStilrokHard()

    /**
     * Sets the value of the [stildisko] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param  boolean|integer|string $v The new value
     * @return $this|\Tekstove\TekstoveBundle\Model\Entity\Lyric The current object (for fluent API support)
     */
    public function setStildisko($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->stildisko !== $v) {
            $this->stildisko = $v;
            $this->modifiedColumns[LyricTableMap::COL_STILDISKO] = true;
        }

        return $this;
    } // setStildisko()

    /**
     * Sets the value of the [stillatam] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param  boolean|integer|string $v The new value
     * @return $this|\Tekstove\TekstoveBundle\Model\Entity\Lyric The current object (for fluent API support)
     */
    public function setStillatam($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->stillatam !== $v) {
            $this->stillatam = $v;
            $this->modifiedColumns[LyricTableMap::COL_STILLATAM] = true;
        }

        return $this;
    } // setStillatam()

    /**
     * Sets the value of the [stilsamba] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param  boolean|integer|string $v The new value
     * @return $this|\Tekstove\TekstoveBundle\Model\Entity\Lyric The current object (for fluent API support)
     */
    public function setStilsamba($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->stilsamba !== $v) {
            $this->stilsamba = $v;
            $this->modifiedColumns[LyricTableMap::COL_STILSAMBA] = true;
        }

        return $this;
    } // setStilsamba()

    /**
     * Sets the value of the [stiltango] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param  boolean|integer|string $v The new value
     * @return $this|\Tekstove\TekstoveBundle\Model\Entity\Lyric The current object (for fluent API support)
     */
    public function setStiltango($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->stiltango !== $v) {
            $this->stiltango = $v;
            $this->modifiedColumns[LyricTableMap::COL_STILTANGO] = true;
        }

        return $this;
    } // setStiltango()

    /**
     * Sets the value of the [stilsalsa] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param  boolean|integer|string $v The new value
     * @return $this|\Tekstove\TekstoveBundle\Model\Entity\Lyric The current object (for fluent API support)
     */
    public function setStilsalsa($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->stilsalsa !== $v) {
            $this->stilsalsa = $v;
            $this->modifiedColumns[LyricTableMap::COL_STILSALSA] = true;
        }

        return $this;
    } // setStilsalsa()

    /**
     * Sets the value of the [stilklasi] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param  boolean|integer|string $v The new value
     * @return $this|\Tekstove\TekstoveBundle\Model\Entity\Lyric The current object (for fluent API support)
     */
    public function setStilklasi($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->stilklasi !== $v) {
            $this->stilklasi = $v;
            $this->modifiedColumns[LyricTableMap::COL_STILKLASI] = true;
        }

        return $this;
    } // setStilklasi()

    /**
     * Sets the value of the [stildetski] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param  boolean|integer|string $v The new value
     * @return $this|\Tekstove\TekstoveBundle\Model\Entity\Lyric The current object (for fluent API support)
     */
    public function setStildetski($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->stildetski !== $v) {
            $this->stildetski = $v;
            $this->modifiedColumns[LyricTableMap::COL_STILDETSKI] = true;
        }

        return $this;
    } // setStildetski()

    /**
     * Sets the value of the [stilfolk] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param  boolean|integer|string $v The new value
     * @return $this|\Tekstove\TekstoveBundle\Model\Entity\Lyric The current object (for fluent API support)
     */
    public function setStilfolk($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->stilfolk !== $v) {
            $this->stilfolk = $v;
            $this->modifiedColumns[LyricTableMap::COL_STILFOLK] = true;
        }

        return $this;
    } // setStilfolk()

    /**
     * Sets the value of the [stilnarodna] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param  boolean|integer|string $v The new value
     * @return $this|\Tekstove\TekstoveBundle\Model\Entity\Lyric The current object (for fluent API support)
     */
    public function setStilnarodna($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->stilnarodna !== $v) {
            $this->stilnarodna = $v;
            $this->modifiedColumns[LyricTableMap::COL_STILNARODNA] = true;
        }

        return $this;
    } // setStilnarodna()

    /**
     * Sets the value of the [stilchalga] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param  boolean|integer|string $v The new value
     * @return $this|\Tekstove\TekstoveBundle\Model\Entity\Lyric The current object (for fluent API support)
     */
    public function setStilchalga($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->stilchalga !== $v) {
            $this->stilchalga = $v;
            $this->modifiedColumns[LyricTableMap::COL_STILCHALGA] = true;
        }

        return $this;
    } // setStilchalga()

    /**
     * Sets the value of the [stilpopfolk] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param  boolean|integer|string $v The new value
     * @return $this|\Tekstove\TekstoveBundle\Model\Entity\Lyric The current object (for fluent API support)
     */
    public function setStilpopfolk($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->stilpopfolk !== $v) {
            $this->stilpopfolk = $v;
            $this->modifiedColumns[LyricTableMap::COL_STILPOPFOLK] = true;
        }

        return $this;
    } // setStilpopfolk()

    /**
     * Sets the value of the [stilmetal] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param  boolean|integer|string $v The new value
     * @return $this|\Tekstove\TekstoveBundle\Model\Entity\Lyric The current object (for fluent API support)
     */
    public function setStilmetal($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->stilmetal !== $v) {
            $this->stilmetal = $v;
            $this->modifiedColumns[LyricTableMap::COL_STILMETAL] = true;
        }

        return $this;
    } // setStilmetal()

    /**
     * Sets the value of the [stilmetal_heavy] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param  boolean|integer|string $v The new value
     * @return $this|\Tekstove\TekstoveBundle\Model\Entity\Lyric The current object (for fluent API support)
     */
    public function setStilmetalHeavy($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->stilmetal_heavy !== $v) {
            $this->stilmetal_heavy = $v;
            $this->modifiedColumns[LyricTableMap::COL_STILMETAL_HEAVY] = true;
        }

        return $this;
    } // setStilmetalHeavy()

    /**
     * Sets the value of the [stilmetal_power] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param  boolean|integer|string $v The new value
     * @return $this|\Tekstove\TekstoveBundle\Model\Entity\Lyric The current object (for fluent API support)
     */
    public function setStilmetalPower($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->stilmetal_power !== $v) {
            $this->stilmetal_power = $v;
            $this->modifiedColumns[LyricTableMap::COL_STILMETAL_POWER] = true;
        }

        return $this;
    } // setStilmetalPower()

    /**
     * Sets the value of the [stilmetal_death] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param  boolean|integer|string $v The new value
     * @return $this|\Tekstove\TekstoveBundle\Model\Entity\Lyric The current object (for fluent API support)
     */
    public function setStilmetalDeath($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->stilmetal_death !== $v) {
            $this->stilmetal_death = $v;
            $this->modifiedColumns[LyricTableMap::COL_STILMETAL_DEATH] = true;
        }

        return $this;
    } // setStilmetalDeath()

    /**
     * Sets the value of the [stilmetal_nu] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param  boolean|integer|string $v The new value
     * @return $this|\Tekstove\TekstoveBundle\Model\Entity\Lyric The current object (for fluent API support)
     */
    public function setStilmetalNu($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->stilmetal_nu !== $v) {
            $this->stilmetal_nu = $v;
            $this->modifiedColumns[LyricTableMap::COL_STILMETAL_NU] = true;
        }

        return $this;
    } // setStilmetalNu()

    /**
     * Sets the value of the [stilmetal_gothic] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param  boolean|integer|string $v The new value
     * @return $this|\Tekstove\TekstoveBundle\Model\Entity\Lyric The current object (for fluent API support)
     */
    public function setStilmetalGothic($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->stilmetal_gothic !== $v) {
            $this->stilmetal_gothic = $v;
            $this->modifiedColumns[LyricTableMap::COL_STILMETAL_GOTHIC] = true;
        }

        return $this;
    } // setStilmetalGothic()

    /**
     * Sets the value of the [stilmetal_symphonic] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param  boolean|integer|string $v The new value
     * @return $this|\Tekstove\TekstoveBundle\Model\Entity\Lyric The current object (for fluent API support)
     */
    public function setStilmetalSymphonic($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->stilmetal_symphonic !== $v) {
            $this->stilmetal_symphonic = $v;
            $this->modifiedColumns[LyricTableMap::COL_STILMETAL_SYMPHONIC] = true;
        }

        return $this;
    } // setStilmetalSymphonic()

    /**
     * Sets the value of the [stilsoundtrack] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param  boolean|integer|string $v The new value
     * @return $this|\Tekstove\TekstoveBundle\Model\Entity\Lyric The current object (for fluent API support)
     */
    public function setStilsoundtrack($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->stilsoundtrack !== $v) {
            $this->stilsoundtrack = $v;
            $this->modifiedColumns[LyricTableMap::COL_STILSOUNDTRACK] = true;
        }

        return $this;
    } // setStilsoundtrack()

    /**
     * Sets the value of the [stildance] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param  boolean|integer|string $v The new value
     * @return $this|\Tekstove\TekstoveBundle\Model\Entity\Lyric The current object (for fluent API support)
     */
    public function setStildance($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->stildance !== $v) {
            $this->stildance = $v;
            $this->modifiedColumns[LyricTableMap::COL_STILDANCE] = true;
        }

        return $this;
    } // setStildance()

    /**
     * Sets the value of the [stilrnb] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param  boolean|integer|string $v The new value
     * @return $this|\Tekstove\TekstoveBundle\Model\Entity\Lyric The current object (for fluent API support)
     */
    public function setStilrnb($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->stilrnb !== $v) {
            $this->stilrnb = $v;
            $this->modifiedColumns[LyricTableMap::COL_STILRNB] = true;
        }

        return $this;
    } // setStilrnb()

    /**
     * Sets the value of the [stilsoul] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param  boolean|integer|string $v The new value
     * @return $this|\Tekstove\TekstoveBundle\Model\Entity\Lyric The current object (for fluent API support)
     */
    public function setStilsoul($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->stilsoul !== $v) {
            $this->stilsoul = $v;
            $this->modifiedColumns[LyricTableMap::COL_STILSOUL] = true;
        }

        return $this;
    } // setStilsoul()

    /**
     * Sets the value of the [stilnew_rave] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param  boolean|integer|string $v The new value
     * @return $this|\Tekstove\TekstoveBundle\Model\Entity\Lyric The current object (for fluent API support)
     */
    public function setStilnewRave($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->stilnew_rave !== $v) {
            $this->stilnew_rave = $v;
            $this->modifiedColumns[LyricTableMap::COL_STILNEW_RAVE] = true;
        }

        return $this;
    } // setStilnewRave()

    /**
     * Sets the value of the [stilreggae] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param  boolean|integer|string $v The new value
     * @return $this|\Tekstove\TekstoveBundle\Model\Entity\Lyric The current object (for fluent API support)
     */
    public function setStilreggae($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->stilreggae !== $v) {
            $this->stilreggae = $v;
            $this->modifiedColumns[LyricTableMap::COL_STILREGGAE] = true;
        }

        return $this;
    } // setStilreggae()

    /**
     * Sets the value of the [stilkantri] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param  boolean|integer|string $v The new value
     * @return $this|\Tekstove\TekstoveBundle\Model\Entity\Lyric The current object (for fluent API support)
     */
    public function setStilkantri($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->stilkantri !== $v) {
            $this->stilkantri = $v;
            $this->modifiedColumns[LyricTableMap::COL_STILKANTRI] = true;
        }

        return $this;
    } // setStilkantri()

    /**
     * Sets the value of the [stilpunk] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param  boolean|integer|string $v The new value
     * @return $this|\Tekstove\TekstoveBundle\Model\Entity\Lyric The current object (for fluent API support)
     */
    public function setStilpunk($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->stilpunk !== $v) {
            $this->stilpunk = $v;
            $this->modifiedColumns[LyricTableMap::COL_STILPUNK] = true;
        }

        return $this;
    } // setStilpunk()

    /**
     * Sets the value of the [stilemo] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param  boolean|integer|string $v The new value
     * @return $this|\Tekstove\TekstoveBundle\Model\Entity\Lyric The current object (for fluent API support)
     */
    public function setStilemo($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->stilemo !== $v) {
            $this->stilemo = $v;
            $this->modifiedColumns[LyricTableMap::COL_STILEMO] = true;
        }

        return $this;
    } // setStilemo()

    /**
     * Sets the value of the [stilbreakbeat] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param  boolean|integer|string $v The new value
     * @return $this|\Tekstove\TekstoveBundle\Model\Entity\Lyric The current object (for fluent API support)
     */
    public function setStilbreakbeat($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->stilbreakbeat !== $v) {
            $this->stilbreakbeat = $v;
            $this->modifiedColumns[LyricTableMap::COL_STILBREAKBEAT] = true;
        }

        return $this;
    } // setStilbreakbeat()

    /**
     * Sets the value of the [stilbigbeat] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param  boolean|integer|string $v The new value
     * @return $this|\Tekstove\TekstoveBundle\Model\Entity\Lyric The current object (for fluent API support)
     */
    public function setStilbigbeat($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->stilbigbeat !== $v) {
            $this->stilbigbeat = $v;
            $this->modifiedColumns[LyricTableMap::COL_STILBIGBEAT] = true;
        }

        return $this;
    } // setStilbigbeat()

    /**
     * Sets the value of the [stiljaz] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param  boolean|integer|string $v The new value
     * @return $this|\Tekstove\TekstoveBundle\Model\Entity\Lyric The current object (for fluent API support)
     */
    public function setStiljaz($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->stiljaz !== $v) {
            $this->stiljaz = $v;
            $this->modifiedColumns[LyricTableMap::COL_STILJAZ] = true;
        }

        return $this;
    } // setStiljaz()

    /**
     * Sets the value of the [stilblus] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param  boolean|integer|string $v The new value
     * @return $this|\Tekstove\TekstoveBundle\Model\Entity\Lyric The current object (for fluent API support)
     */
    public function setStilblus($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->stilblus !== $v) {
            $this->stilblus = $v;
            $this->modifiedColumns[LyricTableMap::COL_STILBLUS] = true;
        }

        return $this;
    } // setStilblus()

    /**
     * Sets the value of the [stilelectronica] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param  boolean|integer|string $v The new value
     * @return $this|\Tekstove\TekstoveBundle\Model\Entity\Lyric The current object (for fluent API support)
     */
    public function setStilelectronica($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->stilelectronica !== $v) {
            $this->stilelectronica = $v;
            $this->modifiedColumns[LyricTableMap::COL_STILELECTRONICA] = true;
        }

        return $this;
    } // setStilelectronica()

    /**
     * Sets the value of the [stilska] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param  boolean|integer|string $v The new value
     * @return $this|\Tekstove\TekstoveBundle\Model\Entity\Lyric The current object (for fluent API support)
     */
    public function setStilska($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->stilska !== $v) {
            $this->stilska = $v;
            $this->modifiedColumns[LyricTableMap::COL_STILSKA] = true;
        }

        return $this;
    } // setStilska()

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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : LyricTableMap::translateFieldName('cacheTitleFull', TableMap::TYPE_PHPNAME, $indexType)];
            $this->cache_title_full = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : LyricTableMap::translateFieldName('cacheTitleShort', TableMap::TYPE_PHPNAME, $indexType)];
            $this->cache_title_short = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : LyricTableMap::translateFieldName('uploader', TableMap::TYPE_PHPNAME, $indexType)];
            $this->uploaded_by = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : LyricTableMap::translateFieldName('Text', TableMap::TYPE_PHPNAME, $indexType)];
            $this->text = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : LyricTableMap::translateFieldName('textBg', TableMap::TYPE_PHPNAME, $indexType)];
            $this->text_bg = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : LyricTableMap::translateFieldName('Artist1', TableMap::TYPE_PHPNAME, $indexType)];
            $this->artist1 = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : LyricTableMap::translateFieldName('Artist2', TableMap::TYPE_PHPNAME, $indexType)];
            $this->artist2 = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : LyricTableMap::translateFieldName('Artist3', TableMap::TYPE_PHPNAME, $indexType)];
            $this->artist3 = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : LyricTableMap::translateFieldName('Artist4', TableMap::TYPE_PHPNAME, $indexType)];
            $this->artist4 = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 10 + $startcol : LyricTableMap::translateFieldName('Artist5', TableMap::TYPE_PHPNAME, $indexType)];
            $this->artist5 = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 11 + $startcol : LyricTableMap::translateFieldName('Artist6', TableMap::TYPE_PHPNAME, $indexType)];
            $this->artist6 = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 12 + $startcol : LyricTableMap::translateFieldName('Title', TableMap::TYPE_PHPNAME, $indexType)];
            $this->title = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 13 + $startcol : LyricTableMap::translateFieldName('Album1', TableMap::TYPE_PHPNAME, $indexType)];
            $this->album1 = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 14 + $startcol : LyricTableMap::translateFieldName('Album2', TableMap::TYPE_PHPNAME, $indexType)];
            $this->album2 = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 15 + $startcol : LyricTableMap::translateFieldName('Video', TableMap::TYPE_PHPNAME, $indexType)];
            $this->video = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 16 + $startcol : LyricTableMap::translateFieldName('VideoVbox7', TableMap::TYPE_PHPNAME, $indexType)];
            $this->video_vbox7 = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 17 + $startcol : LyricTableMap::translateFieldName('VideoVbox7Orig', TableMap::TYPE_PHPNAME, $indexType)];
            $this->video_vbox7_orig = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 18 + $startcol : LyricTableMap::translateFieldName('VideoYoutube', TableMap::TYPE_PHPNAME, $indexType)];
            $this->video_youtube = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 19 + $startcol : LyricTableMap::translateFieldName('VideoYoutubeOrig', TableMap::TYPE_PHPNAME, $indexType)];
            $this->video_youtube_orig = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 20 + $startcol : LyricTableMap::translateFieldName('VideoMetacafe', TableMap::TYPE_PHPNAME, $indexType)];
            $this->video_metacafe = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 21 + $startcol : LyricTableMap::translateFieldName('VideoMetacafeOrig', TableMap::TYPE_PHPNAME, $indexType)];
            $this->video_metacafe_orig = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 22 + $startcol : LyricTableMap::translateFieldName('Download', TableMap::TYPE_PHPNAME, $indexType)];
            $this->download = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 23 + $startcol : LyricTableMap::translateFieldName('Image', TableMap::TYPE_PHPNAME, $indexType)];
            $this->image = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 24 + $startcol : LyricTableMap::translateFieldName('Podnovena', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->podnovena = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 25 + $startcol : LyricTableMap::translateFieldName('IpUpload', TableMap::TYPE_PHPNAME, $indexType)];
            $this->ip_upload = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 26 + $startcol : LyricTableMap::translateFieldName('Dopylnitelnoinfo', TableMap::TYPE_PHPNAME, $indexType)];
            $this->dopylnitelnoinfo = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 27 + $startcol : LyricTableMap::translateFieldName('cacheVotes', TableMap::TYPE_PHPNAME, $indexType)];
            $this->glasa = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 28 + $startcol : LyricTableMap::translateFieldName('Views', TableMap::TYPE_PHPNAME, $indexType)];
            $this->views = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 29 + $startcol : LyricTableMap::translateFieldName('Popularity', TableMap::TYPE_PHPNAME, $indexType)];
            $this->popularity = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 30 + $startcol : LyricTableMap::translateFieldName('Stilraphiphop', TableMap::TYPE_PHPNAME, $indexType)];
            $this->stilraphiphop = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 31 + $startcol : LyricTableMap::translateFieldName('Stilhiphop', TableMap::TYPE_PHPNAME, $indexType)];
            $this->stilhiphop = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 32 + $startcol : LyricTableMap::translateFieldName('Stileastcoast', TableMap::TYPE_PHPNAME, $indexType)];
            $this->stileastcoast = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 33 + $startcol : LyricTableMap::translateFieldName('language', TableMap::TYPE_PHPNAME, $indexType)];
            $this->language = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 34 + $startcol : LyricTableMap::translateFieldName('Stilskit', TableMap::TYPE_PHPNAME, $indexType)];
            $this->stilskit = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 35 + $startcol : LyricTableMap::translateFieldName('Stilelektronna', TableMap::TYPE_PHPNAME, $indexType)];
            $this->stilelektronna = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 36 + $startcol : LyricTableMap::translateFieldName('Stilrok', TableMap::TYPE_PHPNAME, $indexType)];
            $this->stilrok = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 37 + $startcol : LyricTableMap::translateFieldName('StilrokClas', TableMap::TYPE_PHPNAME, $indexType)];
            $this->stilrok_clas = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 38 + $startcol : LyricTableMap::translateFieldName('StilrokAlt', TableMap::TYPE_PHPNAME, $indexType)];
            $this->stilrok_alt = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 39 + $startcol : LyricTableMap::translateFieldName('StilrokHard', TableMap::TYPE_PHPNAME, $indexType)];
            $this->stilrok_hard = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 40 + $startcol : LyricTableMap::translateFieldName('Stildisko', TableMap::TYPE_PHPNAME, $indexType)];
            $this->stildisko = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 41 + $startcol : LyricTableMap::translateFieldName('Stillatam', TableMap::TYPE_PHPNAME, $indexType)];
            $this->stillatam = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 42 + $startcol : LyricTableMap::translateFieldName('Stilsamba', TableMap::TYPE_PHPNAME, $indexType)];
            $this->stilsamba = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 43 + $startcol : LyricTableMap::translateFieldName('Stiltango', TableMap::TYPE_PHPNAME, $indexType)];
            $this->stiltango = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 44 + $startcol : LyricTableMap::translateFieldName('Stilsalsa', TableMap::TYPE_PHPNAME, $indexType)];
            $this->stilsalsa = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 45 + $startcol : LyricTableMap::translateFieldName('Stilklasi', TableMap::TYPE_PHPNAME, $indexType)];
            $this->stilklasi = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 46 + $startcol : LyricTableMap::translateFieldName('Stildetski', TableMap::TYPE_PHPNAME, $indexType)];
            $this->stildetski = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 47 + $startcol : LyricTableMap::translateFieldName('Stilfolk', TableMap::TYPE_PHPNAME, $indexType)];
            $this->stilfolk = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 48 + $startcol : LyricTableMap::translateFieldName('Stilnarodna', TableMap::TYPE_PHPNAME, $indexType)];
            $this->stilnarodna = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 49 + $startcol : LyricTableMap::translateFieldName('Stilchalga', TableMap::TYPE_PHPNAME, $indexType)];
            $this->stilchalga = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 50 + $startcol : LyricTableMap::translateFieldName('Stilpopfolk', TableMap::TYPE_PHPNAME, $indexType)];
            $this->stilpopfolk = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 51 + $startcol : LyricTableMap::translateFieldName('Stilmetal', TableMap::TYPE_PHPNAME, $indexType)];
            $this->stilmetal = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 52 + $startcol : LyricTableMap::translateFieldName('StilmetalHeavy', TableMap::TYPE_PHPNAME, $indexType)];
            $this->stilmetal_heavy = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 53 + $startcol : LyricTableMap::translateFieldName('StilmetalPower', TableMap::TYPE_PHPNAME, $indexType)];
            $this->stilmetal_power = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 54 + $startcol : LyricTableMap::translateFieldName('StilmetalDeath', TableMap::TYPE_PHPNAME, $indexType)];
            $this->stilmetal_death = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 55 + $startcol : LyricTableMap::translateFieldName('StilmetalNu', TableMap::TYPE_PHPNAME, $indexType)];
            $this->stilmetal_nu = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 56 + $startcol : LyricTableMap::translateFieldName('StilmetalGothic', TableMap::TYPE_PHPNAME, $indexType)];
            $this->stilmetal_gothic = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 57 + $startcol : LyricTableMap::translateFieldName('StilmetalSymphonic', TableMap::TYPE_PHPNAME, $indexType)];
            $this->stilmetal_symphonic = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 58 + $startcol : LyricTableMap::translateFieldName('Stilsoundtrack', TableMap::TYPE_PHPNAME, $indexType)];
            $this->stilsoundtrack = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 59 + $startcol : LyricTableMap::translateFieldName('Stildance', TableMap::TYPE_PHPNAME, $indexType)];
            $this->stildance = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 60 + $startcol : LyricTableMap::translateFieldName('Stilrnb', TableMap::TYPE_PHPNAME, $indexType)];
            $this->stilrnb = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 61 + $startcol : LyricTableMap::translateFieldName('Stilsoul', TableMap::TYPE_PHPNAME, $indexType)];
            $this->stilsoul = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 62 + $startcol : LyricTableMap::translateFieldName('StilnewRave', TableMap::TYPE_PHPNAME, $indexType)];
            $this->stilnew_rave = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 63 + $startcol : LyricTableMap::translateFieldName('Stilreggae', TableMap::TYPE_PHPNAME, $indexType)];
            $this->stilreggae = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 64 + $startcol : LyricTableMap::translateFieldName('Stilkantri', TableMap::TYPE_PHPNAME, $indexType)];
            $this->stilkantri = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 65 + $startcol : LyricTableMap::translateFieldName('Stilpunk', TableMap::TYPE_PHPNAME, $indexType)];
            $this->stilpunk = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 66 + $startcol : LyricTableMap::translateFieldName('Stilemo', TableMap::TYPE_PHPNAME, $indexType)];
            $this->stilemo = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 67 + $startcol : LyricTableMap::translateFieldName('Stilbreakbeat', TableMap::TYPE_PHPNAME, $indexType)];
            $this->stilbreakbeat = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 68 + $startcol : LyricTableMap::translateFieldName('Stilbigbeat', TableMap::TYPE_PHPNAME, $indexType)];
            $this->stilbigbeat = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 69 + $startcol : LyricTableMap::translateFieldName('Stiljaz', TableMap::TYPE_PHPNAME, $indexType)];
            $this->stiljaz = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 70 + $startcol : LyricTableMap::translateFieldName('Stilblus', TableMap::TYPE_PHPNAME, $indexType)];
            $this->stilblus = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 71 + $startcol : LyricTableMap::translateFieldName('Stilelectronica', TableMap::TYPE_PHPNAME, $indexType)];
            $this->stilelectronica = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 72 + $startcol : LyricTableMap::translateFieldName('Stilska', TableMap::TYPE_PHPNAME, $indexType)];
            $this->stilska = (null !== $col) ? (boolean) $col : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 73; // 73 = LyricTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\Tekstove\\TekstoveBundle\\Model\\Entity\\Lyric'), 0, $e);
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
        if ($this->aLanguages !== null && $this->language !== $this->aLanguages->getId()) {
            $this->aLanguages = null;
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

            $this->aLanguages = null;
            $this->collEditAddPrevods = null;

            $this->collLiubimis = null;

            $this->singleLyric18 = null;

            $this->collLyricRedirects = null;

            $this->collCommentss = null;

            $this->collVotess = null;

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

            // We call the save method on the following object(s) if they
            // were passed to this object by their corresponding set
            // method.  This object relates to these object(s) by a
            // foreign key reference.

            if ($this->aLanguages !== null) {
                if ($this->aLanguages->isModified() || $this->aLanguages->isNew()) {
                    $affectedRows += $this->aLanguages->save($con);
                }
                $this->setLanguages($this->aLanguages);
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

            if ($this->editAddPrevodsScheduledForDeletion !== null) {
                if (!$this->editAddPrevodsScheduledForDeletion->isEmpty()) {
                    \Tekstove\TekstoveBundle\Model\Entity\EditAddPrevodQuery::create()
                        ->filterByPrimaryKeys($this->editAddPrevodsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->editAddPrevodsScheduledForDeletion = null;
                }
            }

            if ($this->collEditAddPrevods !== null) {
                foreach ($this->collEditAddPrevods as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->liubimisScheduledForDeletion !== null) {
                if (!$this->liubimisScheduledForDeletion->isEmpty()) {
                    \Tekstove\TekstoveBundle\Model\Entity\LiubimiQuery::create()
                        ->filterByPrimaryKeys($this->liubimisScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->liubimisScheduledForDeletion = null;
                }
            }

            if ($this->collLiubimis !== null) {
                foreach ($this->collLiubimis as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->singleLyric18 !== null) {
                if (!$this->singleLyric18->isDeleted() && ($this->singleLyric18->isNew() || $this->singleLyric18->isModified())) {
                    $affectedRows += $this->singleLyric18->save($con);
                }
            }

            if ($this->lyricRedirectsScheduledForDeletion !== null) {
                if (!$this->lyricRedirectsScheduledForDeletion->isEmpty()) {
                    \Tekstove\TekstoveBundle\Model\Entity\LyricRedirectQuery::create()
                        ->filterByPrimaryKeys($this->lyricRedirectsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->lyricRedirectsScheduledForDeletion = null;
                }
            }

            if ($this->collLyricRedirects !== null) {
                foreach ($this->collLyricRedirects as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->commentssScheduledForDeletion !== null) {
                if (!$this->commentssScheduledForDeletion->isEmpty()) {
                    \Tekstove\TekstoveBundle\Model\Entity\CommentsQuery::create()
                        ->filterByPrimaryKeys($this->commentssScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->commentssScheduledForDeletion = null;
                }
            }

            if ($this->collCommentss !== null) {
                foreach ($this->collCommentss as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->votessScheduledForDeletion !== null) {
                if (!$this->votessScheduledForDeletion->isEmpty()) {
                    \Tekstove\TekstoveBundle\Model\Entity\Lyric\VotesQuery::create()
                        ->filterByPrimaryKeys($this->votessScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->votessScheduledForDeletion = null;
                }
            }

            if ($this->collVotess !== null) {
                foreach ($this->collVotess as $referrerFK) {
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
        if ($this->isColumnModified(LyricTableMap::COL_CACHE_TITLE_FULL)) {
            $modifiedColumns[':p' . $index++]  = 'cache_title_full';
        }
        if ($this->isColumnModified(LyricTableMap::COL_CACHE_TITLE_SHORT)) {
            $modifiedColumns[':p' . $index++]  = 'cache_title_short';
        }
        if ($this->isColumnModified(LyricTableMap::COL_UPLOADED_BY)) {
            $modifiedColumns[':p' . $index++]  = 'uploaded_by';
        }
        if ($this->isColumnModified(LyricTableMap::COL_TEXT)) {
            $modifiedColumns[':p' . $index++]  = 'text';
        }
        if ($this->isColumnModified(LyricTableMap::COL_TEXT_BG)) {
            $modifiedColumns[':p' . $index++]  = 'text_bg';
        }
        if ($this->isColumnModified(LyricTableMap::COL_ARTIST1)) {
            $modifiedColumns[':p' . $index++]  = 'artist1';
        }
        if ($this->isColumnModified(LyricTableMap::COL_ARTIST2)) {
            $modifiedColumns[':p' . $index++]  = 'artist2';
        }
        if ($this->isColumnModified(LyricTableMap::COL_ARTIST3)) {
            $modifiedColumns[':p' . $index++]  = 'artist3';
        }
        if ($this->isColumnModified(LyricTableMap::COL_ARTIST4)) {
            $modifiedColumns[':p' . $index++]  = 'artist4';
        }
        if ($this->isColumnModified(LyricTableMap::COL_ARTIST5)) {
            $modifiedColumns[':p' . $index++]  = 'artist5';
        }
        if ($this->isColumnModified(LyricTableMap::COL_ARTIST6)) {
            $modifiedColumns[':p' . $index++]  = 'artist6';
        }
        if ($this->isColumnModified(LyricTableMap::COL_TITLE)) {
            $modifiedColumns[':p' . $index++]  = 'title';
        }
        if ($this->isColumnModified(LyricTableMap::COL_ALBUM1)) {
            $modifiedColumns[':p' . $index++]  = 'album1';
        }
        if ($this->isColumnModified(LyricTableMap::COL_ALBUM2)) {
            $modifiedColumns[':p' . $index++]  = 'album2';
        }
        if ($this->isColumnModified(LyricTableMap::COL_VIDEO)) {
            $modifiedColumns[':p' . $index++]  = 'video';
        }
        if ($this->isColumnModified(LyricTableMap::COL_VIDEO_VBOX7)) {
            $modifiedColumns[':p' . $index++]  = 'video_vbox7';
        }
        if ($this->isColumnModified(LyricTableMap::COL_VIDEO_VBOX7_ORIG)) {
            $modifiedColumns[':p' . $index++]  = 'video_vbox7_orig';
        }
        if ($this->isColumnModified(LyricTableMap::COL_VIDEO_YOUTUBE)) {
            $modifiedColumns[':p' . $index++]  = 'video_youtube';
        }
        if ($this->isColumnModified(LyricTableMap::COL_VIDEO_YOUTUBE_ORIG)) {
            $modifiedColumns[':p' . $index++]  = 'video_youtube_orig';
        }
        if ($this->isColumnModified(LyricTableMap::COL_VIDEO_METACAFE)) {
            $modifiedColumns[':p' . $index++]  = 'video_metacafe';
        }
        if ($this->isColumnModified(LyricTableMap::COL_VIDEO_METACAFE_ORIG)) {
            $modifiedColumns[':p' . $index++]  = 'video_metacafe_orig';
        }
        if ($this->isColumnModified(LyricTableMap::COL_DOWNLOAD)) {
            $modifiedColumns[':p' . $index++]  = 'download';
        }
        if ($this->isColumnModified(LyricTableMap::COL_IMAGE)) {
            $modifiedColumns[':p' . $index++]  = 'image';
        }
        if ($this->isColumnModified(LyricTableMap::COL_PODNOVENA)) {
            $modifiedColumns[':p' . $index++]  = 'podnovena';
        }
        if ($this->isColumnModified(LyricTableMap::COL_IP_UPLOAD)) {
            $modifiedColumns[':p' . $index++]  = 'ip_upload';
        }
        if ($this->isColumnModified(LyricTableMap::COL_DOPYLNITELNOINFO)) {
            $modifiedColumns[':p' . $index++]  = 'dopylnitelnoinfo';
        }
        if ($this->isColumnModified(LyricTableMap::COL_GLASA)) {
            $modifiedColumns[':p' . $index++]  = 'glasa';
        }
        if ($this->isColumnModified(LyricTableMap::COL_VIEWS)) {
            $modifiedColumns[':p' . $index++]  = 'views';
        }
        if ($this->isColumnModified(LyricTableMap::COL_POPULARITY)) {
            $modifiedColumns[':p' . $index++]  = 'popularity';
        }
        if ($this->isColumnModified(LyricTableMap::COL_STILRAPHIPHOP)) {
            $modifiedColumns[':p' . $index++]  = 'stilraphiphop';
        }
        if ($this->isColumnModified(LyricTableMap::COL_STILHIPHOP)) {
            $modifiedColumns[':p' . $index++]  = 'stilhiphop';
        }
        if ($this->isColumnModified(LyricTableMap::COL_STILEASTCOAST)) {
            $modifiedColumns[':p' . $index++]  = 'stileastcoast';
        }
        if ($this->isColumnModified(LyricTableMap::COL_LANGUAGE)) {
            $modifiedColumns[':p' . $index++]  = 'language';
        }
        if ($this->isColumnModified(LyricTableMap::COL_STILSKIT)) {
            $modifiedColumns[':p' . $index++]  = 'stilskit';
        }
        if ($this->isColumnModified(LyricTableMap::COL_STILELEKTRONNA)) {
            $modifiedColumns[':p' . $index++]  = 'stilelektronna';
        }
        if ($this->isColumnModified(LyricTableMap::COL_STILROK)) {
            $modifiedColumns[':p' . $index++]  = 'stilrok';
        }
        if ($this->isColumnModified(LyricTableMap::COL_STILROK_CLAS)) {
            $modifiedColumns[':p' . $index++]  = 'stilrok_clas';
        }
        if ($this->isColumnModified(LyricTableMap::COL_STILROK_ALT)) {
            $modifiedColumns[':p' . $index++]  = 'stilrok_alt';
        }
        if ($this->isColumnModified(LyricTableMap::COL_STILROK_HARD)) {
            $modifiedColumns[':p' . $index++]  = 'stilrok_hard';
        }
        if ($this->isColumnModified(LyricTableMap::COL_STILDISKO)) {
            $modifiedColumns[':p' . $index++]  = 'stildisko';
        }
        if ($this->isColumnModified(LyricTableMap::COL_STILLATAM)) {
            $modifiedColumns[':p' . $index++]  = 'stillatam';
        }
        if ($this->isColumnModified(LyricTableMap::COL_STILSAMBA)) {
            $modifiedColumns[':p' . $index++]  = 'stilsamba';
        }
        if ($this->isColumnModified(LyricTableMap::COL_STILTANGO)) {
            $modifiedColumns[':p' . $index++]  = 'stiltango';
        }
        if ($this->isColumnModified(LyricTableMap::COL_STILSALSA)) {
            $modifiedColumns[':p' . $index++]  = 'stilsalsa';
        }
        if ($this->isColumnModified(LyricTableMap::COL_STILKLASI)) {
            $modifiedColumns[':p' . $index++]  = 'stilklasi';
        }
        if ($this->isColumnModified(LyricTableMap::COL_STILDETSKI)) {
            $modifiedColumns[':p' . $index++]  = 'stildetski';
        }
        if ($this->isColumnModified(LyricTableMap::COL_STILFOLK)) {
            $modifiedColumns[':p' . $index++]  = 'stilfolk';
        }
        if ($this->isColumnModified(LyricTableMap::COL_STILNARODNA)) {
            $modifiedColumns[':p' . $index++]  = 'stilnarodna';
        }
        if ($this->isColumnModified(LyricTableMap::COL_STILCHALGA)) {
            $modifiedColumns[':p' . $index++]  = 'stilchalga';
        }
        if ($this->isColumnModified(LyricTableMap::COL_STILPOPFOLK)) {
            $modifiedColumns[':p' . $index++]  = 'stilpopfolk';
        }
        if ($this->isColumnModified(LyricTableMap::COL_STILMETAL)) {
            $modifiedColumns[':p' . $index++]  = 'stilmetal';
        }
        if ($this->isColumnModified(LyricTableMap::COL_STILMETAL_HEAVY)) {
            $modifiedColumns[':p' . $index++]  = 'stilmetal_heavy';
        }
        if ($this->isColumnModified(LyricTableMap::COL_STILMETAL_POWER)) {
            $modifiedColumns[':p' . $index++]  = 'stilmetal_power';
        }
        if ($this->isColumnModified(LyricTableMap::COL_STILMETAL_DEATH)) {
            $modifiedColumns[':p' . $index++]  = 'stilmetal_death';
        }
        if ($this->isColumnModified(LyricTableMap::COL_STILMETAL_NU)) {
            $modifiedColumns[':p' . $index++]  = 'stilmetal_nu';
        }
        if ($this->isColumnModified(LyricTableMap::COL_STILMETAL_GOTHIC)) {
            $modifiedColumns[':p' . $index++]  = 'stilmetal_gothic';
        }
        if ($this->isColumnModified(LyricTableMap::COL_STILMETAL_SYMPHONIC)) {
            $modifiedColumns[':p' . $index++]  = 'stilmetal_symphonic';
        }
        if ($this->isColumnModified(LyricTableMap::COL_STILSOUNDTRACK)) {
            $modifiedColumns[':p' . $index++]  = 'stilsoundtrack';
        }
        if ($this->isColumnModified(LyricTableMap::COL_STILDANCE)) {
            $modifiedColumns[':p' . $index++]  = 'stildance';
        }
        if ($this->isColumnModified(LyricTableMap::COL_STILRNB)) {
            $modifiedColumns[':p' . $index++]  = 'stilRnB';
        }
        if ($this->isColumnModified(LyricTableMap::COL_STILSOUL)) {
            $modifiedColumns[':p' . $index++]  = 'stilsoul';
        }
        if ($this->isColumnModified(LyricTableMap::COL_STILNEW_RAVE)) {
            $modifiedColumns[':p' . $index++]  = 'stilnew_rave';
        }
        if ($this->isColumnModified(LyricTableMap::COL_STILREGGAE)) {
            $modifiedColumns[':p' . $index++]  = 'stilreggae';
        }
        if ($this->isColumnModified(LyricTableMap::COL_STILKANTRI)) {
            $modifiedColumns[':p' . $index++]  = 'stilkantri';
        }
        if ($this->isColumnModified(LyricTableMap::COL_STILPUNK)) {
            $modifiedColumns[':p' . $index++]  = 'stilpunk';
        }
        if ($this->isColumnModified(LyricTableMap::COL_STILEMO)) {
            $modifiedColumns[':p' . $index++]  = 'stilemo';
        }
        if ($this->isColumnModified(LyricTableMap::COL_STILBREAKBEAT)) {
            $modifiedColumns[':p' . $index++]  = 'stilbreakbeat';
        }
        if ($this->isColumnModified(LyricTableMap::COL_STILBIGBEAT)) {
            $modifiedColumns[':p' . $index++]  = 'stilbigbeat';
        }
        if ($this->isColumnModified(LyricTableMap::COL_STILJAZ)) {
            $modifiedColumns[':p' . $index++]  = 'stiljaz';
        }
        if ($this->isColumnModified(LyricTableMap::COL_STILBLUS)) {
            $modifiedColumns[':p' . $index++]  = 'stilblus';
        }
        if ($this->isColumnModified(LyricTableMap::COL_STILELECTRONICA)) {
            $modifiedColumns[':p' . $index++]  = 'stilelectronica';
        }
        if ($this->isColumnModified(LyricTableMap::COL_STILSKA)) {
            $modifiedColumns[':p' . $index++]  = 'stilska';
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
                    case 'cache_title_full':
                        $stmt->bindValue($identifier, $this->cache_title_full, PDO::PARAM_STR);
                        break;
                    case 'cache_title_short':
                        $stmt->bindValue($identifier, $this->cache_title_short, PDO::PARAM_STR);
                        break;
                    case 'uploaded_by':
                        $stmt->bindValue($identifier, $this->uploaded_by, PDO::PARAM_INT);
                        break;
                    case 'text':
                        $stmt->bindValue($identifier, $this->text, PDO::PARAM_STR);
                        break;
                    case 'text_bg':
                        $stmt->bindValue($identifier, $this->text_bg, PDO::PARAM_STR);
                        break;
                    case 'artist1':
                        $stmt->bindValue($identifier, $this->artist1, PDO::PARAM_INT);
                        break;
                    case 'artist2':
                        $stmt->bindValue($identifier, $this->artist2, PDO::PARAM_INT);
                        break;
                    case 'artist3':
                        $stmt->bindValue($identifier, $this->artist3, PDO::PARAM_INT);
                        break;
                    case 'artist4':
                        $stmt->bindValue($identifier, $this->artist4, PDO::PARAM_INT);
                        break;
                    case 'artist5':
                        $stmt->bindValue($identifier, $this->artist5, PDO::PARAM_INT);
                        break;
                    case 'artist6':
                        $stmt->bindValue($identifier, $this->artist6, PDO::PARAM_INT);
                        break;
                    case 'title':
                        $stmt->bindValue($identifier, $this->title, PDO::PARAM_STR);
                        break;
                    case 'album1':
                        $stmt->bindValue($identifier, $this->album1, PDO::PARAM_INT);
                        break;
                    case 'album2':
                        $stmt->bindValue($identifier, $this->album2, PDO::PARAM_INT);
                        break;
                    case 'video':
                        $stmt->bindValue($identifier, $this->video, PDO::PARAM_STR);
                        break;
                    case 'video_vbox7':
                        $stmt->bindValue($identifier, $this->video_vbox7, PDO::PARAM_STR);
                        break;
                    case 'video_vbox7_orig':
                        $stmt->bindValue($identifier, $this->video_vbox7_orig, PDO::PARAM_STR);
                        break;
                    case 'video_youtube':
                        $stmt->bindValue($identifier, $this->video_youtube, PDO::PARAM_STR);
                        break;
                    case 'video_youtube_orig':
                        $stmt->bindValue($identifier, $this->video_youtube_orig, PDO::PARAM_STR);
                        break;
                    case 'video_metacafe':
                        $stmt->bindValue($identifier, $this->video_metacafe, PDO::PARAM_STR);
                        break;
                    case 'video_metacafe_orig':
                        $stmt->bindValue($identifier, $this->video_metacafe_orig, PDO::PARAM_STR);
                        break;
                    case 'download':
                        $stmt->bindValue($identifier, $this->download, PDO::PARAM_STR);
                        break;
                    case 'image':
                        $stmt->bindValue($identifier, $this->image, PDO::PARAM_STR);
                        break;
                    case 'podnovena':
                        $stmt->bindValue($identifier, $this->podnovena ? $this->podnovena->format("Y-m-d H:i:s") : null, PDO::PARAM_STR);
                        break;
                    case 'ip_upload':
                        $stmt->bindValue($identifier, $this->ip_upload, PDO::PARAM_STR);
                        break;
                    case 'dopylnitelnoinfo':
                        $stmt->bindValue($identifier, $this->dopylnitelnoinfo, PDO::PARAM_STR);
                        break;
                    case 'glasa':
                        $stmt->bindValue($identifier, $this->glasa, PDO::PARAM_INT);
                        break;
                    case 'views':
                        $stmt->bindValue($identifier, $this->views, PDO::PARAM_INT);
                        break;
                    case 'popularity':
                        $stmt->bindValue($identifier, $this->popularity, PDO::PARAM_INT);
                        break;
                    case 'stilraphiphop':
                        $stmt->bindValue($identifier, (int) $this->stilraphiphop, PDO::PARAM_INT);
                        break;
                    case 'stilhiphop':
                        $stmt->bindValue($identifier, (int) $this->stilhiphop, PDO::PARAM_INT);
                        break;
                    case 'stileastcoast':
                        $stmt->bindValue($identifier, (int) $this->stileastcoast, PDO::PARAM_INT);
                        break;
                    case 'language':
                        $stmt->bindValue($identifier, $this->language, PDO::PARAM_INT);
                        break;
                    case 'stilskit':
                        $stmt->bindValue($identifier, (int) $this->stilskit, PDO::PARAM_INT);
                        break;
                    case 'stilelektronna':
                        $stmt->bindValue($identifier, (int) $this->stilelektronna, PDO::PARAM_INT);
                        break;
                    case 'stilrok':
                        $stmt->bindValue($identifier, (int) $this->stilrok, PDO::PARAM_INT);
                        break;
                    case 'stilrok_clas':
                        $stmt->bindValue($identifier, (int) $this->stilrok_clas, PDO::PARAM_INT);
                        break;
                    case 'stilrok_alt':
                        $stmt->bindValue($identifier, (int) $this->stilrok_alt, PDO::PARAM_INT);
                        break;
                    case 'stilrok_hard':
                        $stmt->bindValue($identifier, (int) $this->stilrok_hard, PDO::PARAM_INT);
                        break;
                    case 'stildisko':
                        $stmt->bindValue($identifier, (int) $this->stildisko, PDO::PARAM_INT);
                        break;
                    case 'stillatam':
                        $stmt->bindValue($identifier, (int) $this->stillatam, PDO::PARAM_INT);
                        break;
                    case 'stilsamba':
                        $stmt->bindValue($identifier, (int) $this->stilsamba, PDO::PARAM_INT);
                        break;
                    case 'stiltango':
                        $stmt->bindValue($identifier, (int) $this->stiltango, PDO::PARAM_INT);
                        break;
                    case 'stilsalsa':
                        $stmt->bindValue($identifier, (int) $this->stilsalsa, PDO::PARAM_INT);
                        break;
                    case 'stilklasi':
                        $stmt->bindValue($identifier, (int) $this->stilklasi, PDO::PARAM_INT);
                        break;
                    case 'stildetski':
                        $stmt->bindValue($identifier, (int) $this->stildetski, PDO::PARAM_INT);
                        break;
                    case 'stilfolk':
                        $stmt->bindValue($identifier, (int) $this->stilfolk, PDO::PARAM_INT);
                        break;
                    case 'stilnarodna':
                        $stmt->bindValue($identifier, (int) $this->stilnarodna, PDO::PARAM_INT);
                        break;
                    case 'stilchalga':
                        $stmt->bindValue($identifier, (int) $this->stilchalga, PDO::PARAM_INT);
                        break;
                    case 'stilpopfolk':
                        $stmt->bindValue($identifier, (int) $this->stilpopfolk, PDO::PARAM_INT);
                        break;
                    case 'stilmetal':
                        $stmt->bindValue($identifier, (int) $this->stilmetal, PDO::PARAM_INT);
                        break;
                    case 'stilmetal_heavy':
                        $stmt->bindValue($identifier, (int) $this->stilmetal_heavy, PDO::PARAM_INT);
                        break;
                    case 'stilmetal_power':
                        $stmt->bindValue($identifier, (int) $this->stilmetal_power, PDO::PARAM_INT);
                        break;
                    case 'stilmetal_death':
                        $stmt->bindValue($identifier, (int) $this->stilmetal_death, PDO::PARAM_INT);
                        break;
                    case 'stilmetal_nu':
                        $stmt->bindValue($identifier, (int) $this->stilmetal_nu, PDO::PARAM_INT);
                        break;
                    case 'stilmetal_gothic':
                        $stmt->bindValue($identifier, (int) $this->stilmetal_gothic, PDO::PARAM_INT);
                        break;
                    case 'stilmetal_symphonic':
                        $stmt->bindValue($identifier, (int) $this->stilmetal_symphonic, PDO::PARAM_INT);
                        break;
                    case 'stilsoundtrack':
                        $stmt->bindValue($identifier, (int) $this->stilsoundtrack, PDO::PARAM_INT);
                        break;
                    case 'stildance':
                        $stmt->bindValue($identifier, (int) $this->stildance, PDO::PARAM_INT);
                        break;
                    case 'stilRnB':
                        $stmt->bindValue($identifier, (int) $this->stilrnb, PDO::PARAM_INT);
                        break;
                    case 'stilsoul':
                        $stmt->bindValue($identifier, (int) $this->stilsoul, PDO::PARAM_INT);
                        break;
                    case 'stilnew_rave':
                        $stmt->bindValue($identifier, (int) $this->stilnew_rave, PDO::PARAM_INT);
                        break;
                    case 'stilreggae':
                        $stmt->bindValue($identifier, (int) $this->stilreggae, PDO::PARAM_INT);
                        break;
                    case 'stilkantri':
                        $stmt->bindValue($identifier, (int) $this->stilkantri, PDO::PARAM_INT);
                        break;
                    case 'stilpunk':
                        $stmt->bindValue($identifier, (int) $this->stilpunk, PDO::PARAM_INT);
                        break;
                    case 'stilemo':
                        $stmt->bindValue($identifier, (int) $this->stilemo, PDO::PARAM_INT);
                        break;
                    case 'stilbreakbeat':
                        $stmt->bindValue($identifier, (int) $this->stilbreakbeat, PDO::PARAM_INT);
                        break;
                    case 'stilbigbeat':
                        $stmt->bindValue($identifier, (int) $this->stilbigbeat, PDO::PARAM_INT);
                        break;
                    case 'stiljaz':
                        $stmt->bindValue($identifier, (int) $this->stiljaz, PDO::PARAM_INT);
                        break;
                    case 'stilblus':
                        $stmt->bindValue($identifier, (int) $this->stilblus, PDO::PARAM_INT);
                        break;
                    case 'stilelectronica':
                        $stmt->bindValue($identifier, (int) $this->stilelectronica, PDO::PARAM_INT);
                        break;
                    case 'stilska':
                        $stmt->bindValue($identifier, (int) $this->stilska, PDO::PARAM_INT);
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
                return $this->getcacheTitleFull();
                break;
            case 2:
                return $this->getcacheTitleShort();
                break;
            case 3:
                return $this->getuploader();
                break;
            case 4:
                return $this->getText();
                break;
            case 5:
                return $this->gettextBg();
                break;
            case 6:
                return $this->getArtist1();
                break;
            case 7:
                return $this->getArtist2();
                break;
            case 8:
                return $this->getArtist3();
                break;
            case 9:
                return $this->getArtist4();
                break;
            case 10:
                return $this->getArtist5();
                break;
            case 11:
                return $this->getArtist6();
                break;
            case 12:
                return $this->getTitle();
                break;
            case 13:
                return $this->getAlbum1();
                break;
            case 14:
                return $this->getAlbum2();
                break;
            case 15:
                return $this->getVideo();
                break;
            case 16:
                return $this->getVideoVbox7();
                break;
            case 17:
                return $this->getVideoVbox7Orig();
                break;
            case 18:
                return $this->getVideoYoutube();
                break;
            case 19:
                return $this->getVideoYoutubeOrig();
                break;
            case 20:
                return $this->getVideoMetacafe();
                break;
            case 21:
                return $this->getVideoMetacafeOrig();
                break;
            case 22:
                return $this->getDownload();
                break;
            case 23:
                return $this->getImage();
                break;
            case 24:
                return $this->getPodnovena();
                break;
            case 25:
                return $this->getIpUpload();
                break;
            case 26:
                return $this->getDopylnitelnoinfo();
                break;
            case 27:
                return $this->getcacheVotes();
                break;
            case 28:
                return $this->getViews();
                break;
            case 29:
                return $this->getPopularity();
                break;
            case 30:
                return $this->getStilraphiphop();
                break;
            case 31:
                return $this->getStilhiphop();
                break;
            case 32:
                return $this->getStileastcoast();
                break;
            case 33:
                return $this->getlanguage();
                break;
            case 34:
                return $this->getStilskit();
                break;
            case 35:
                return $this->getStilelektronna();
                break;
            case 36:
                return $this->getStilrok();
                break;
            case 37:
                return $this->getStilrokClas();
                break;
            case 38:
                return $this->getStilrokAlt();
                break;
            case 39:
                return $this->getStilrokHard();
                break;
            case 40:
                return $this->getStildisko();
                break;
            case 41:
                return $this->getStillatam();
                break;
            case 42:
                return $this->getStilsamba();
                break;
            case 43:
                return $this->getStiltango();
                break;
            case 44:
                return $this->getStilsalsa();
                break;
            case 45:
                return $this->getStilklasi();
                break;
            case 46:
                return $this->getStildetski();
                break;
            case 47:
                return $this->getStilfolk();
                break;
            case 48:
                return $this->getStilnarodna();
                break;
            case 49:
                return $this->getStilchalga();
                break;
            case 50:
                return $this->getStilpopfolk();
                break;
            case 51:
                return $this->getStilmetal();
                break;
            case 52:
                return $this->getStilmetalHeavy();
                break;
            case 53:
                return $this->getStilmetalPower();
                break;
            case 54:
                return $this->getStilmetalDeath();
                break;
            case 55:
                return $this->getStilmetalNu();
                break;
            case 56:
                return $this->getStilmetalGothic();
                break;
            case 57:
                return $this->getStilmetalSymphonic();
                break;
            case 58:
                return $this->getStilsoundtrack();
                break;
            case 59:
                return $this->getStildance();
                break;
            case 60:
                return $this->getStilrnb();
                break;
            case 61:
                return $this->getStilsoul();
                break;
            case 62:
                return $this->getStilnewRave();
                break;
            case 63:
                return $this->getStilreggae();
                break;
            case 64:
                return $this->getStilkantri();
                break;
            case 65:
                return $this->getStilpunk();
                break;
            case 66:
                return $this->getStilemo();
                break;
            case 67:
                return $this->getStilbreakbeat();
                break;
            case 68:
                return $this->getStilbigbeat();
                break;
            case 69:
                return $this->getStiljaz();
                break;
            case 70:
                return $this->getStilblus();
                break;
            case 71:
                return $this->getStilelectronica();
                break;
            case 72:
                return $this->getStilska();
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
            $keys[1] => $this->getcacheTitleFull(),
            $keys[2] => $this->getcacheTitleShort(),
            $keys[3] => $this->getuploader(),
            $keys[4] => $this->getText(),
            $keys[5] => $this->gettextBg(),
            $keys[6] => $this->getArtist1(),
            $keys[7] => $this->getArtist2(),
            $keys[8] => $this->getArtist3(),
            $keys[9] => $this->getArtist4(),
            $keys[10] => $this->getArtist5(),
            $keys[11] => $this->getArtist6(),
            $keys[12] => $this->getTitle(),
            $keys[13] => $this->getAlbum1(),
            $keys[14] => $this->getAlbum2(),
            $keys[15] => $this->getVideo(),
            $keys[16] => $this->getVideoVbox7(),
            $keys[17] => $this->getVideoVbox7Orig(),
            $keys[18] => $this->getVideoYoutube(),
            $keys[19] => $this->getVideoYoutubeOrig(),
            $keys[20] => $this->getVideoMetacafe(),
            $keys[21] => $this->getVideoMetacafeOrig(),
            $keys[22] => $this->getDownload(),
            $keys[23] => $this->getImage(),
            $keys[24] => $this->getPodnovena(),
            $keys[25] => $this->getIpUpload(),
            $keys[26] => $this->getDopylnitelnoinfo(),
            $keys[27] => $this->getcacheVotes(),
            $keys[28] => $this->getViews(),
            $keys[29] => $this->getPopularity(),
            $keys[30] => $this->getStilraphiphop(),
            $keys[31] => $this->getStilhiphop(),
            $keys[32] => $this->getStileastcoast(),
            $keys[33] => $this->getlanguage(),
            $keys[34] => $this->getStilskit(),
            $keys[35] => $this->getStilelektronna(),
            $keys[36] => $this->getStilrok(),
            $keys[37] => $this->getStilrokClas(),
            $keys[38] => $this->getStilrokAlt(),
            $keys[39] => $this->getStilrokHard(),
            $keys[40] => $this->getStildisko(),
            $keys[41] => $this->getStillatam(),
            $keys[42] => $this->getStilsamba(),
            $keys[43] => $this->getStiltango(),
            $keys[44] => $this->getStilsalsa(),
            $keys[45] => $this->getStilklasi(),
            $keys[46] => $this->getStildetski(),
            $keys[47] => $this->getStilfolk(),
            $keys[48] => $this->getStilnarodna(),
            $keys[49] => $this->getStilchalga(),
            $keys[50] => $this->getStilpopfolk(),
            $keys[51] => $this->getStilmetal(),
            $keys[52] => $this->getStilmetalHeavy(),
            $keys[53] => $this->getStilmetalPower(),
            $keys[54] => $this->getStilmetalDeath(),
            $keys[55] => $this->getStilmetalNu(),
            $keys[56] => $this->getStilmetalGothic(),
            $keys[57] => $this->getStilmetalSymphonic(),
            $keys[58] => $this->getStilsoundtrack(),
            $keys[59] => $this->getStildance(),
            $keys[60] => $this->getStilrnb(),
            $keys[61] => $this->getStilsoul(),
            $keys[62] => $this->getStilnewRave(),
            $keys[63] => $this->getStilreggae(),
            $keys[64] => $this->getStilkantri(),
            $keys[65] => $this->getStilpunk(),
            $keys[66] => $this->getStilemo(),
            $keys[67] => $this->getStilbreakbeat(),
            $keys[68] => $this->getStilbigbeat(),
            $keys[69] => $this->getStiljaz(),
            $keys[70] => $this->getStilblus(),
            $keys[71] => $this->getStilelectronica(),
            $keys[72] => $this->getStilska(),
        );

        $utc = new \DateTimeZone('utc');
        if ($result[$keys[24]] instanceof \DateTime) {
            // When changing timezone we don't want to change existing instances
            $dateTime = clone $result[$keys[24]];
            $result[$keys[24]] = $dateTime->setTimezone($utc)->format('Y-m-d\TH:i:s\Z');
        }

        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->aLanguages) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'languages';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'languages';
                        break;
                    default:
                        $key = 'Languages';
                }

                $result[$key] = $this->aLanguages->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->collEditAddPrevods) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'editAddPrevods';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'edit_add_prevods';
                        break;
                    default:
                        $key = 'EditAddPrevods';
                }

                $result[$key] = $this->collEditAddPrevods->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collLiubimis) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'liubimis';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'liubimis';
                        break;
                    default:
                        $key = 'Liubimis';
                }

                $result[$key] = $this->collLiubimis->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->singleLyric18) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'lyric18';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'lyric_18';
                        break;
                    default:
                        $key = 'Lyric18';
                }

                $result[$key] = $this->singleLyric18->toArray($keyType, $includeLazyLoadColumns, $alreadyDumpedObjects, true);
            }
            if (null !== $this->collLyricRedirects) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'lyricRedirects';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'lyric_redirects';
                        break;
                    default:
                        $key = 'LyricRedirects';
                }

                $result[$key] = $this->collLyricRedirects->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collCommentss) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'commentss';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'commentss';
                        break;
                    default:
                        $key = 'Commentss';
                }

                $result[$key] = $this->collCommentss->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collVotess) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'votess';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'lyric_votess';
                        break;
                    default:
                        $key = 'Votess';
                }

                $result[$key] = $this->collVotess->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
     * @return $this|\Tekstove\TekstoveBundle\Model\Entity\Lyric
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
     * @return $this|\Tekstove\TekstoveBundle\Model\Entity\Lyric
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setId($value);
                break;
            case 1:
                $this->setcacheTitleFull($value);
                break;
            case 2:
                $this->setcacheTitleShort($value);
                break;
            case 3:
                $this->setuploader($value);
                break;
            case 4:
                $this->setText($value);
                break;
            case 5:
                $this->settextBg($value);
                break;
            case 6:
                $this->setArtist1($value);
                break;
            case 7:
                $this->setArtist2($value);
                break;
            case 8:
                $this->setArtist3($value);
                break;
            case 9:
                $this->setArtist4($value);
                break;
            case 10:
                $this->setArtist5($value);
                break;
            case 11:
                $this->setArtist6($value);
                break;
            case 12:
                $this->setTitle($value);
                break;
            case 13:
                $this->setAlbum1($value);
                break;
            case 14:
                $this->setAlbum2($value);
                break;
            case 15:
                $this->setVideo($value);
                break;
            case 16:
                $this->setVideoVbox7($value);
                break;
            case 17:
                $this->setVideoVbox7Orig($value);
                break;
            case 18:
                $this->setVideoYoutube($value);
                break;
            case 19:
                $this->setVideoYoutubeOrig($value);
                break;
            case 20:
                $this->setVideoMetacafe($value);
                break;
            case 21:
                $this->setVideoMetacafeOrig($value);
                break;
            case 22:
                $this->setDownload($value);
                break;
            case 23:
                $this->setImage($value);
                break;
            case 24:
                $this->setPodnovena($value);
                break;
            case 25:
                $this->setIpUpload($value);
                break;
            case 26:
                $this->setDopylnitelnoinfo($value);
                break;
            case 27:
                $this->setcacheVotes($value);
                break;
            case 28:
                $this->setViews($value);
                break;
            case 29:
                $this->setPopularity($value);
                break;
            case 30:
                $this->setStilraphiphop($value);
                break;
            case 31:
                $this->setStilhiphop($value);
                break;
            case 32:
                $this->setStileastcoast($value);
                break;
            case 33:
                $this->setlanguage($value);
                break;
            case 34:
                $this->setStilskit($value);
                break;
            case 35:
                $this->setStilelektronna($value);
                break;
            case 36:
                $this->setStilrok($value);
                break;
            case 37:
                $this->setStilrokClas($value);
                break;
            case 38:
                $this->setStilrokAlt($value);
                break;
            case 39:
                $this->setStilrokHard($value);
                break;
            case 40:
                $this->setStildisko($value);
                break;
            case 41:
                $this->setStillatam($value);
                break;
            case 42:
                $this->setStilsamba($value);
                break;
            case 43:
                $this->setStiltango($value);
                break;
            case 44:
                $this->setStilsalsa($value);
                break;
            case 45:
                $this->setStilklasi($value);
                break;
            case 46:
                $this->setStildetski($value);
                break;
            case 47:
                $this->setStilfolk($value);
                break;
            case 48:
                $this->setStilnarodna($value);
                break;
            case 49:
                $this->setStilchalga($value);
                break;
            case 50:
                $this->setStilpopfolk($value);
                break;
            case 51:
                $this->setStilmetal($value);
                break;
            case 52:
                $this->setStilmetalHeavy($value);
                break;
            case 53:
                $this->setStilmetalPower($value);
                break;
            case 54:
                $this->setStilmetalDeath($value);
                break;
            case 55:
                $this->setStilmetalNu($value);
                break;
            case 56:
                $this->setStilmetalGothic($value);
                break;
            case 57:
                $this->setStilmetalSymphonic($value);
                break;
            case 58:
                $this->setStilsoundtrack($value);
                break;
            case 59:
                $this->setStildance($value);
                break;
            case 60:
                $this->setStilrnb($value);
                break;
            case 61:
                $this->setStilsoul($value);
                break;
            case 62:
                $this->setStilnewRave($value);
                break;
            case 63:
                $this->setStilreggae($value);
                break;
            case 64:
                $this->setStilkantri($value);
                break;
            case 65:
                $this->setStilpunk($value);
                break;
            case 66:
                $this->setStilemo($value);
                break;
            case 67:
                $this->setStilbreakbeat($value);
                break;
            case 68:
                $this->setStilbigbeat($value);
                break;
            case 69:
                $this->setStiljaz($value);
                break;
            case 70:
                $this->setStilblus($value);
                break;
            case 71:
                $this->setStilelectronica($value);
                break;
            case 72:
                $this->setStilska($value);
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
            $this->setcacheTitleFull($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setcacheTitleShort($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setuploader($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setText($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->settextBg($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setArtist1($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setArtist2($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setArtist3($arr[$keys[8]]);
        }
        if (array_key_exists($keys[9], $arr)) {
            $this->setArtist4($arr[$keys[9]]);
        }
        if (array_key_exists($keys[10], $arr)) {
            $this->setArtist5($arr[$keys[10]]);
        }
        if (array_key_exists($keys[11], $arr)) {
            $this->setArtist6($arr[$keys[11]]);
        }
        if (array_key_exists($keys[12], $arr)) {
            $this->setTitle($arr[$keys[12]]);
        }
        if (array_key_exists($keys[13], $arr)) {
            $this->setAlbum1($arr[$keys[13]]);
        }
        if (array_key_exists($keys[14], $arr)) {
            $this->setAlbum2($arr[$keys[14]]);
        }
        if (array_key_exists($keys[15], $arr)) {
            $this->setVideo($arr[$keys[15]]);
        }
        if (array_key_exists($keys[16], $arr)) {
            $this->setVideoVbox7($arr[$keys[16]]);
        }
        if (array_key_exists($keys[17], $arr)) {
            $this->setVideoVbox7Orig($arr[$keys[17]]);
        }
        if (array_key_exists($keys[18], $arr)) {
            $this->setVideoYoutube($arr[$keys[18]]);
        }
        if (array_key_exists($keys[19], $arr)) {
            $this->setVideoYoutubeOrig($arr[$keys[19]]);
        }
        if (array_key_exists($keys[20], $arr)) {
            $this->setVideoMetacafe($arr[$keys[20]]);
        }
        if (array_key_exists($keys[21], $arr)) {
            $this->setVideoMetacafeOrig($arr[$keys[21]]);
        }
        if (array_key_exists($keys[22], $arr)) {
            $this->setDownload($arr[$keys[22]]);
        }
        if (array_key_exists($keys[23], $arr)) {
            $this->setImage($arr[$keys[23]]);
        }
        if (array_key_exists($keys[24], $arr)) {
            $this->setPodnovena($arr[$keys[24]]);
        }
        if (array_key_exists($keys[25], $arr)) {
            $this->setIpUpload($arr[$keys[25]]);
        }
        if (array_key_exists($keys[26], $arr)) {
            $this->setDopylnitelnoinfo($arr[$keys[26]]);
        }
        if (array_key_exists($keys[27], $arr)) {
            $this->setcacheVotes($arr[$keys[27]]);
        }
        if (array_key_exists($keys[28], $arr)) {
            $this->setViews($arr[$keys[28]]);
        }
        if (array_key_exists($keys[29], $arr)) {
            $this->setPopularity($arr[$keys[29]]);
        }
        if (array_key_exists($keys[30], $arr)) {
            $this->setStilraphiphop($arr[$keys[30]]);
        }
        if (array_key_exists($keys[31], $arr)) {
            $this->setStilhiphop($arr[$keys[31]]);
        }
        if (array_key_exists($keys[32], $arr)) {
            $this->setStileastcoast($arr[$keys[32]]);
        }
        if (array_key_exists($keys[33], $arr)) {
            $this->setlanguage($arr[$keys[33]]);
        }
        if (array_key_exists($keys[34], $arr)) {
            $this->setStilskit($arr[$keys[34]]);
        }
        if (array_key_exists($keys[35], $arr)) {
            $this->setStilelektronna($arr[$keys[35]]);
        }
        if (array_key_exists($keys[36], $arr)) {
            $this->setStilrok($arr[$keys[36]]);
        }
        if (array_key_exists($keys[37], $arr)) {
            $this->setStilrokClas($arr[$keys[37]]);
        }
        if (array_key_exists($keys[38], $arr)) {
            $this->setStilrokAlt($arr[$keys[38]]);
        }
        if (array_key_exists($keys[39], $arr)) {
            $this->setStilrokHard($arr[$keys[39]]);
        }
        if (array_key_exists($keys[40], $arr)) {
            $this->setStildisko($arr[$keys[40]]);
        }
        if (array_key_exists($keys[41], $arr)) {
            $this->setStillatam($arr[$keys[41]]);
        }
        if (array_key_exists($keys[42], $arr)) {
            $this->setStilsamba($arr[$keys[42]]);
        }
        if (array_key_exists($keys[43], $arr)) {
            $this->setStiltango($arr[$keys[43]]);
        }
        if (array_key_exists($keys[44], $arr)) {
            $this->setStilsalsa($arr[$keys[44]]);
        }
        if (array_key_exists($keys[45], $arr)) {
            $this->setStilklasi($arr[$keys[45]]);
        }
        if (array_key_exists($keys[46], $arr)) {
            $this->setStildetski($arr[$keys[46]]);
        }
        if (array_key_exists($keys[47], $arr)) {
            $this->setStilfolk($arr[$keys[47]]);
        }
        if (array_key_exists($keys[48], $arr)) {
            $this->setStilnarodna($arr[$keys[48]]);
        }
        if (array_key_exists($keys[49], $arr)) {
            $this->setStilchalga($arr[$keys[49]]);
        }
        if (array_key_exists($keys[50], $arr)) {
            $this->setStilpopfolk($arr[$keys[50]]);
        }
        if (array_key_exists($keys[51], $arr)) {
            $this->setStilmetal($arr[$keys[51]]);
        }
        if (array_key_exists($keys[52], $arr)) {
            $this->setStilmetalHeavy($arr[$keys[52]]);
        }
        if (array_key_exists($keys[53], $arr)) {
            $this->setStilmetalPower($arr[$keys[53]]);
        }
        if (array_key_exists($keys[54], $arr)) {
            $this->setStilmetalDeath($arr[$keys[54]]);
        }
        if (array_key_exists($keys[55], $arr)) {
            $this->setStilmetalNu($arr[$keys[55]]);
        }
        if (array_key_exists($keys[56], $arr)) {
            $this->setStilmetalGothic($arr[$keys[56]]);
        }
        if (array_key_exists($keys[57], $arr)) {
            $this->setStilmetalSymphonic($arr[$keys[57]]);
        }
        if (array_key_exists($keys[58], $arr)) {
            $this->setStilsoundtrack($arr[$keys[58]]);
        }
        if (array_key_exists($keys[59], $arr)) {
            $this->setStildance($arr[$keys[59]]);
        }
        if (array_key_exists($keys[60], $arr)) {
            $this->setStilrnb($arr[$keys[60]]);
        }
        if (array_key_exists($keys[61], $arr)) {
            $this->setStilsoul($arr[$keys[61]]);
        }
        if (array_key_exists($keys[62], $arr)) {
            $this->setStilnewRave($arr[$keys[62]]);
        }
        if (array_key_exists($keys[63], $arr)) {
            $this->setStilreggae($arr[$keys[63]]);
        }
        if (array_key_exists($keys[64], $arr)) {
            $this->setStilkantri($arr[$keys[64]]);
        }
        if (array_key_exists($keys[65], $arr)) {
            $this->setStilpunk($arr[$keys[65]]);
        }
        if (array_key_exists($keys[66], $arr)) {
            $this->setStilemo($arr[$keys[66]]);
        }
        if (array_key_exists($keys[67], $arr)) {
            $this->setStilbreakbeat($arr[$keys[67]]);
        }
        if (array_key_exists($keys[68], $arr)) {
            $this->setStilbigbeat($arr[$keys[68]]);
        }
        if (array_key_exists($keys[69], $arr)) {
            $this->setStiljaz($arr[$keys[69]]);
        }
        if (array_key_exists($keys[70], $arr)) {
            $this->setStilblus($arr[$keys[70]]);
        }
        if (array_key_exists($keys[71], $arr)) {
            $this->setStilelectronica($arr[$keys[71]]);
        }
        if (array_key_exists($keys[72], $arr)) {
            $this->setStilska($arr[$keys[72]]);
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
     * @return $this|\Tekstove\TekstoveBundle\Model\Entity\Lyric The current object, for fluid interface
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
        if ($this->isColumnModified(LyricTableMap::COL_CACHE_TITLE_FULL)) {
            $criteria->add(LyricTableMap::COL_CACHE_TITLE_FULL, $this->cache_title_full);
        }
        if ($this->isColumnModified(LyricTableMap::COL_CACHE_TITLE_SHORT)) {
            $criteria->add(LyricTableMap::COL_CACHE_TITLE_SHORT, $this->cache_title_short);
        }
        if ($this->isColumnModified(LyricTableMap::COL_UPLOADED_BY)) {
            $criteria->add(LyricTableMap::COL_UPLOADED_BY, $this->uploaded_by);
        }
        if ($this->isColumnModified(LyricTableMap::COL_TEXT)) {
            $criteria->add(LyricTableMap::COL_TEXT, $this->text);
        }
        if ($this->isColumnModified(LyricTableMap::COL_TEXT_BG)) {
            $criteria->add(LyricTableMap::COL_TEXT_BG, $this->text_bg);
        }
        if ($this->isColumnModified(LyricTableMap::COL_ARTIST1)) {
            $criteria->add(LyricTableMap::COL_ARTIST1, $this->artist1);
        }
        if ($this->isColumnModified(LyricTableMap::COL_ARTIST2)) {
            $criteria->add(LyricTableMap::COL_ARTIST2, $this->artist2);
        }
        if ($this->isColumnModified(LyricTableMap::COL_ARTIST3)) {
            $criteria->add(LyricTableMap::COL_ARTIST3, $this->artist3);
        }
        if ($this->isColumnModified(LyricTableMap::COL_ARTIST4)) {
            $criteria->add(LyricTableMap::COL_ARTIST4, $this->artist4);
        }
        if ($this->isColumnModified(LyricTableMap::COL_ARTIST5)) {
            $criteria->add(LyricTableMap::COL_ARTIST5, $this->artist5);
        }
        if ($this->isColumnModified(LyricTableMap::COL_ARTIST6)) {
            $criteria->add(LyricTableMap::COL_ARTIST6, $this->artist6);
        }
        if ($this->isColumnModified(LyricTableMap::COL_TITLE)) {
            $criteria->add(LyricTableMap::COL_TITLE, $this->title);
        }
        if ($this->isColumnModified(LyricTableMap::COL_ALBUM1)) {
            $criteria->add(LyricTableMap::COL_ALBUM1, $this->album1);
        }
        if ($this->isColumnModified(LyricTableMap::COL_ALBUM2)) {
            $criteria->add(LyricTableMap::COL_ALBUM2, $this->album2);
        }
        if ($this->isColumnModified(LyricTableMap::COL_VIDEO)) {
            $criteria->add(LyricTableMap::COL_VIDEO, $this->video);
        }
        if ($this->isColumnModified(LyricTableMap::COL_VIDEO_VBOX7)) {
            $criteria->add(LyricTableMap::COL_VIDEO_VBOX7, $this->video_vbox7);
        }
        if ($this->isColumnModified(LyricTableMap::COL_VIDEO_VBOX7_ORIG)) {
            $criteria->add(LyricTableMap::COL_VIDEO_VBOX7_ORIG, $this->video_vbox7_orig);
        }
        if ($this->isColumnModified(LyricTableMap::COL_VIDEO_YOUTUBE)) {
            $criteria->add(LyricTableMap::COL_VIDEO_YOUTUBE, $this->video_youtube);
        }
        if ($this->isColumnModified(LyricTableMap::COL_VIDEO_YOUTUBE_ORIG)) {
            $criteria->add(LyricTableMap::COL_VIDEO_YOUTUBE_ORIG, $this->video_youtube_orig);
        }
        if ($this->isColumnModified(LyricTableMap::COL_VIDEO_METACAFE)) {
            $criteria->add(LyricTableMap::COL_VIDEO_METACAFE, $this->video_metacafe);
        }
        if ($this->isColumnModified(LyricTableMap::COL_VIDEO_METACAFE_ORIG)) {
            $criteria->add(LyricTableMap::COL_VIDEO_METACAFE_ORIG, $this->video_metacafe_orig);
        }
        if ($this->isColumnModified(LyricTableMap::COL_DOWNLOAD)) {
            $criteria->add(LyricTableMap::COL_DOWNLOAD, $this->download);
        }
        if ($this->isColumnModified(LyricTableMap::COL_IMAGE)) {
            $criteria->add(LyricTableMap::COL_IMAGE, $this->image);
        }
        if ($this->isColumnModified(LyricTableMap::COL_PODNOVENA)) {
            $criteria->add(LyricTableMap::COL_PODNOVENA, $this->podnovena);
        }
        if ($this->isColumnModified(LyricTableMap::COL_IP_UPLOAD)) {
            $criteria->add(LyricTableMap::COL_IP_UPLOAD, $this->ip_upload);
        }
        if ($this->isColumnModified(LyricTableMap::COL_DOPYLNITELNOINFO)) {
            $criteria->add(LyricTableMap::COL_DOPYLNITELNOINFO, $this->dopylnitelnoinfo);
        }
        if ($this->isColumnModified(LyricTableMap::COL_GLASA)) {
            $criteria->add(LyricTableMap::COL_GLASA, $this->glasa);
        }
        if ($this->isColumnModified(LyricTableMap::COL_VIEWS)) {
            $criteria->add(LyricTableMap::COL_VIEWS, $this->views);
        }
        if ($this->isColumnModified(LyricTableMap::COL_POPULARITY)) {
            $criteria->add(LyricTableMap::COL_POPULARITY, $this->popularity);
        }
        if ($this->isColumnModified(LyricTableMap::COL_STILRAPHIPHOP)) {
            $criteria->add(LyricTableMap::COL_STILRAPHIPHOP, $this->stilraphiphop);
        }
        if ($this->isColumnModified(LyricTableMap::COL_STILHIPHOP)) {
            $criteria->add(LyricTableMap::COL_STILHIPHOP, $this->stilhiphop);
        }
        if ($this->isColumnModified(LyricTableMap::COL_STILEASTCOAST)) {
            $criteria->add(LyricTableMap::COL_STILEASTCOAST, $this->stileastcoast);
        }
        if ($this->isColumnModified(LyricTableMap::COL_LANGUAGE)) {
            $criteria->add(LyricTableMap::COL_LANGUAGE, $this->language);
        }
        if ($this->isColumnModified(LyricTableMap::COL_STILSKIT)) {
            $criteria->add(LyricTableMap::COL_STILSKIT, $this->stilskit);
        }
        if ($this->isColumnModified(LyricTableMap::COL_STILELEKTRONNA)) {
            $criteria->add(LyricTableMap::COL_STILELEKTRONNA, $this->stilelektronna);
        }
        if ($this->isColumnModified(LyricTableMap::COL_STILROK)) {
            $criteria->add(LyricTableMap::COL_STILROK, $this->stilrok);
        }
        if ($this->isColumnModified(LyricTableMap::COL_STILROK_CLAS)) {
            $criteria->add(LyricTableMap::COL_STILROK_CLAS, $this->stilrok_clas);
        }
        if ($this->isColumnModified(LyricTableMap::COL_STILROK_ALT)) {
            $criteria->add(LyricTableMap::COL_STILROK_ALT, $this->stilrok_alt);
        }
        if ($this->isColumnModified(LyricTableMap::COL_STILROK_HARD)) {
            $criteria->add(LyricTableMap::COL_STILROK_HARD, $this->stilrok_hard);
        }
        if ($this->isColumnModified(LyricTableMap::COL_STILDISKO)) {
            $criteria->add(LyricTableMap::COL_STILDISKO, $this->stildisko);
        }
        if ($this->isColumnModified(LyricTableMap::COL_STILLATAM)) {
            $criteria->add(LyricTableMap::COL_STILLATAM, $this->stillatam);
        }
        if ($this->isColumnModified(LyricTableMap::COL_STILSAMBA)) {
            $criteria->add(LyricTableMap::COL_STILSAMBA, $this->stilsamba);
        }
        if ($this->isColumnModified(LyricTableMap::COL_STILTANGO)) {
            $criteria->add(LyricTableMap::COL_STILTANGO, $this->stiltango);
        }
        if ($this->isColumnModified(LyricTableMap::COL_STILSALSA)) {
            $criteria->add(LyricTableMap::COL_STILSALSA, $this->stilsalsa);
        }
        if ($this->isColumnModified(LyricTableMap::COL_STILKLASI)) {
            $criteria->add(LyricTableMap::COL_STILKLASI, $this->stilklasi);
        }
        if ($this->isColumnModified(LyricTableMap::COL_STILDETSKI)) {
            $criteria->add(LyricTableMap::COL_STILDETSKI, $this->stildetski);
        }
        if ($this->isColumnModified(LyricTableMap::COL_STILFOLK)) {
            $criteria->add(LyricTableMap::COL_STILFOLK, $this->stilfolk);
        }
        if ($this->isColumnModified(LyricTableMap::COL_STILNARODNA)) {
            $criteria->add(LyricTableMap::COL_STILNARODNA, $this->stilnarodna);
        }
        if ($this->isColumnModified(LyricTableMap::COL_STILCHALGA)) {
            $criteria->add(LyricTableMap::COL_STILCHALGA, $this->stilchalga);
        }
        if ($this->isColumnModified(LyricTableMap::COL_STILPOPFOLK)) {
            $criteria->add(LyricTableMap::COL_STILPOPFOLK, $this->stilpopfolk);
        }
        if ($this->isColumnModified(LyricTableMap::COL_STILMETAL)) {
            $criteria->add(LyricTableMap::COL_STILMETAL, $this->stilmetal);
        }
        if ($this->isColumnModified(LyricTableMap::COL_STILMETAL_HEAVY)) {
            $criteria->add(LyricTableMap::COL_STILMETAL_HEAVY, $this->stilmetal_heavy);
        }
        if ($this->isColumnModified(LyricTableMap::COL_STILMETAL_POWER)) {
            $criteria->add(LyricTableMap::COL_STILMETAL_POWER, $this->stilmetal_power);
        }
        if ($this->isColumnModified(LyricTableMap::COL_STILMETAL_DEATH)) {
            $criteria->add(LyricTableMap::COL_STILMETAL_DEATH, $this->stilmetal_death);
        }
        if ($this->isColumnModified(LyricTableMap::COL_STILMETAL_NU)) {
            $criteria->add(LyricTableMap::COL_STILMETAL_NU, $this->stilmetal_nu);
        }
        if ($this->isColumnModified(LyricTableMap::COL_STILMETAL_GOTHIC)) {
            $criteria->add(LyricTableMap::COL_STILMETAL_GOTHIC, $this->stilmetal_gothic);
        }
        if ($this->isColumnModified(LyricTableMap::COL_STILMETAL_SYMPHONIC)) {
            $criteria->add(LyricTableMap::COL_STILMETAL_SYMPHONIC, $this->stilmetal_symphonic);
        }
        if ($this->isColumnModified(LyricTableMap::COL_STILSOUNDTRACK)) {
            $criteria->add(LyricTableMap::COL_STILSOUNDTRACK, $this->stilsoundtrack);
        }
        if ($this->isColumnModified(LyricTableMap::COL_STILDANCE)) {
            $criteria->add(LyricTableMap::COL_STILDANCE, $this->stildance);
        }
        if ($this->isColumnModified(LyricTableMap::COL_STILRNB)) {
            $criteria->add(LyricTableMap::COL_STILRNB, $this->stilrnb);
        }
        if ($this->isColumnModified(LyricTableMap::COL_STILSOUL)) {
            $criteria->add(LyricTableMap::COL_STILSOUL, $this->stilsoul);
        }
        if ($this->isColumnModified(LyricTableMap::COL_STILNEW_RAVE)) {
            $criteria->add(LyricTableMap::COL_STILNEW_RAVE, $this->stilnew_rave);
        }
        if ($this->isColumnModified(LyricTableMap::COL_STILREGGAE)) {
            $criteria->add(LyricTableMap::COL_STILREGGAE, $this->stilreggae);
        }
        if ($this->isColumnModified(LyricTableMap::COL_STILKANTRI)) {
            $criteria->add(LyricTableMap::COL_STILKANTRI, $this->stilkantri);
        }
        if ($this->isColumnModified(LyricTableMap::COL_STILPUNK)) {
            $criteria->add(LyricTableMap::COL_STILPUNK, $this->stilpunk);
        }
        if ($this->isColumnModified(LyricTableMap::COL_STILEMO)) {
            $criteria->add(LyricTableMap::COL_STILEMO, $this->stilemo);
        }
        if ($this->isColumnModified(LyricTableMap::COL_STILBREAKBEAT)) {
            $criteria->add(LyricTableMap::COL_STILBREAKBEAT, $this->stilbreakbeat);
        }
        if ($this->isColumnModified(LyricTableMap::COL_STILBIGBEAT)) {
            $criteria->add(LyricTableMap::COL_STILBIGBEAT, $this->stilbigbeat);
        }
        if ($this->isColumnModified(LyricTableMap::COL_STILJAZ)) {
            $criteria->add(LyricTableMap::COL_STILJAZ, $this->stiljaz);
        }
        if ($this->isColumnModified(LyricTableMap::COL_STILBLUS)) {
            $criteria->add(LyricTableMap::COL_STILBLUS, $this->stilblus);
        }
        if ($this->isColumnModified(LyricTableMap::COL_STILELECTRONICA)) {
            $criteria->add(LyricTableMap::COL_STILELECTRONICA, $this->stilelectronica);
        }
        if ($this->isColumnModified(LyricTableMap::COL_STILSKA)) {
            $criteria->add(LyricTableMap::COL_STILSKA, $this->stilska);
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
     * @param      object $copyObj An object of \Tekstove\TekstoveBundle\Model\Entity\Lyric (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setcacheTitleFull($this->getcacheTitleFull());
        $copyObj->setcacheTitleShort($this->getcacheTitleShort());
        $copyObj->setuploader($this->getuploader());
        $copyObj->setText($this->getText());
        $copyObj->settextBg($this->gettextBg());
        $copyObj->setArtist1($this->getArtist1());
        $copyObj->setArtist2($this->getArtist2());
        $copyObj->setArtist3($this->getArtist3());
        $copyObj->setArtist4($this->getArtist4());
        $copyObj->setArtist5($this->getArtist5());
        $copyObj->setArtist6($this->getArtist6());
        $copyObj->setTitle($this->getTitle());
        $copyObj->setAlbum1($this->getAlbum1());
        $copyObj->setAlbum2($this->getAlbum2());
        $copyObj->setVideo($this->getVideo());
        $copyObj->setVideoVbox7($this->getVideoVbox7());
        $copyObj->setVideoVbox7Orig($this->getVideoVbox7Orig());
        $copyObj->setVideoYoutube($this->getVideoYoutube());
        $copyObj->setVideoYoutubeOrig($this->getVideoYoutubeOrig());
        $copyObj->setVideoMetacafe($this->getVideoMetacafe());
        $copyObj->setVideoMetacafeOrig($this->getVideoMetacafeOrig());
        $copyObj->setDownload($this->getDownload());
        $copyObj->setImage($this->getImage());
        $copyObj->setPodnovena($this->getPodnovena());
        $copyObj->setIpUpload($this->getIpUpload());
        $copyObj->setDopylnitelnoinfo($this->getDopylnitelnoinfo());
        $copyObj->setcacheVotes($this->getcacheVotes());
        $copyObj->setViews($this->getViews());
        $copyObj->setPopularity($this->getPopularity());
        $copyObj->setStilraphiphop($this->getStilraphiphop());
        $copyObj->setStilhiphop($this->getStilhiphop());
        $copyObj->setStileastcoast($this->getStileastcoast());
        $copyObj->setlanguage($this->getlanguage());
        $copyObj->setStilskit($this->getStilskit());
        $copyObj->setStilelektronna($this->getStilelektronna());
        $copyObj->setStilrok($this->getStilrok());
        $copyObj->setStilrokClas($this->getStilrokClas());
        $copyObj->setStilrokAlt($this->getStilrokAlt());
        $copyObj->setStilrokHard($this->getStilrokHard());
        $copyObj->setStildisko($this->getStildisko());
        $copyObj->setStillatam($this->getStillatam());
        $copyObj->setStilsamba($this->getStilsamba());
        $copyObj->setStiltango($this->getStiltango());
        $copyObj->setStilsalsa($this->getStilsalsa());
        $copyObj->setStilklasi($this->getStilklasi());
        $copyObj->setStildetski($this->getStildetski());
        $copyObj->setStilfolk($this->getStilfolk());
        $copyObj->setStilnarodna($this->getStilnarodna());
        $copyObj->setStilchalga($this->getStilchalga());
        $copyObj->setStilpopfolk($this->getStilpopfolk());
        $copyObj->setStilmetal($this->getStilmetal());
        $copyObj->setStilmetalHeavy($this->getStilmetalHeavy());
        $copyObj->setStilmetalPower($this->getStilmetalPower());
        $copyObj->setStilmetalDeath($this->getStilmetalDeath());
        $copyObj->setStilmetalNu($this->getStilmetalNu());
        $copyObj->setStilmetalGothic($this->getStilmetalGothic());
        $copyObj->setStilmetalSymphonic($this->getStilmetalSymphonic());
        $copyObj->setStilsoundtrack($this->getStilsoundtrack());
        $copyObj->setStildance($this->getStildance());
        $copyObj->setStilrnb($this->getStilrnb());
        $copyObj->setStilsoul($this->getStilsoul());
        $copyObj->setStilnewRave($this->getStilnewRave());
        $copyObj->setStilreggae($this->getStilreggae());
        $copyObj->setStilkantri($this->getStilkantri());
        $copyObj->setStilpunk($this->getStilpunk());
        $copyObj->setStilemo($this->getStilemo());
        $copyObj->setStilbreakbeat($this->getStilbreakbeat());
        $copyObj->setStilbigbeat($this->getStilbigbeat());
        $copyObj->setStiljaz($this->getStiljaz());
        $copyObj->setStilblus($this->getStilblus());
        $copyObj->setStilelectronica($this->getStilelectronica());
        $copyObj->setStilska($this->getStilska());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getEditAddPrevods() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addEditAddPrevod($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getLiubimis() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addLiubimi($relObj->copy($deepCopy));
                }
            }

            $relObj = $this->getLyric18();
            if ($relObj) {
                $copyObj->setLyric18($relObj->copy($deepCopy));
            }

            foreach ($this->getLyricRedirects() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addLyricRedirect($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getCommentss() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addComments($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getVotess() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addVotes($relObj->copy($deepCopy));
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
     * @return \Tekstove\TekstoveBundle\Model\Entity\Lyric Clone of current object.
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
     * Declares an association between this object and a ChildLanguages object.
     *
     * @param  ChildLanguages $v
     * @return $this|\Tekstove\TekstoveBundle\Model\Entity\Lyric The current object (for fluent API support)
     * @throws PropelException
     */
    public function setLanguages(ChildLanguages $v = null)
    {
        if ($v === null) {
            $this->setlanguage(NULL);
        } else {
            $this->setlanguage($v->getId());
        }

        $this->aLanguages = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildLanguages object, it will not be re-added.
        if ($v !== null) {
            $v->addLyric($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildLanguages object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildLanguages The associated ChildLanguages object.
     * @throws PropelException
     */
    public function getLanguages(ConnectionInterface $con = null)
    {
        if ($this->aLanguages === null && ($this->language !== null)) {
            $this->aLanguages = ChildLanguagesQuery::create()->findPk($this->language, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aLanguages->addLyrics($this);
             */
        }

        return $this->aLanguages;
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
        if ('EditAddPrevod' == $relationName) {
            return $this->initEditAddPrevods();
        }
        if ('Liubimi' == $relationName) {
            return $this->initLiubimis();
        }
        if ('LyricRedirect' == $relationName) {
            return $this->initLyricRedirects();
        }
        if ('Comments' == $relationName) {
            return $this->initCommentss();
        }
        if ('Votes' == $relationName) {
            return $this->initVotess();
        }
    }

    /**
     * Clears out the collEditAddPrevods collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addEditAddPrevods()
     */
    public function clearEditAddPrevods()
    {
        $this->collEditAddPrevods = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collEditAddPrevods collection loaded partially.
     */
    public function resetPartialEditAddPrevods($v = true)
    {
        $this->collEditAddPrevodsPartial = $v;
    }

    /**
     * Initializes the collEditAddPrevods collection.
     *
     * By default this just sets the collEditAddPrevods collection to an empty array (like clearcollEditAddPrevods());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initEditAddPrevods($overrideExisting = true)
    {
        if (null !== $this->collEditAddPrevods && !$overrideExisting) {
            return;
        }
        $this->collEditAddPrevods = new ObjectCollection();
        $this->collEditAddPrevods->setModel('\Tekstove\TekstoveBundle\Model\Entity\EditAddPrevod');
    }

    /**
     * Gets an array of ChildEditAddPrevod objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildLyric is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildEditAddPrevod[] List of ChildEditAddPrevod objects
     * @throws PropelException
     */
    public function getEditAddPrevods(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collEditAddPrevodsPartial && !$this->isNew();
        if (null === $this->collEditAddPrevods || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collEditAddPrevods) {
                // return empty collection
                $this->initEditAddPrevods();
            } else {
                $collEditAddPrevods = ChildEditAddPrevodQuery::create(null, $criteria)
                    ->filterByLyric($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collEditAddPrevodsPartial && count($collEditAddPrevods)) {
                        $this->initEditAddPrevods(false);

                        foreach ($collEditAddPrevods as $obj) {
                            if (false == $this->collEditAddPrevods->contains($obj)) {
                                $this->collEditAddPrevods->append($obj);
                            }
                        }

                        $this->collEditAddPrevodsPartial = true;
                    }

                    return $collEditAddPrevods;
                }

                if ($partial && $this->collEditAddPrevods) {
                    foreach ($this->collEditAddPrevods as $obj) {
                        if ($obj->isNew()) {
                            $collEditAddPrevods[] = $obj;
                        }
                    }
                }

                $this->collEditAddPrevods = $collEditAddPrevods;
                $this->collEditAddPrevodsPartial = false;
            }
        }

        return $this->collEditAddPrevods;
    }

    /**
     * Sets a collection of ChildEditAddPrevod objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $editAddPrevods A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildLyric The current object (for fluent API support)
     */
    public function setEditAddPrevods(Collection $editAddPrevods, ConnectionInterface $con = null)
    {
        /** @var ChildEditAddPrevod[] $editAddPrevodsToDelete */
        $editAddPrevodsToDelete = $this->getEditAddPrevods(new Criteria(), $con)->diff($editAddPrevods);


        $this->editAddPrevodsScheduledForDeletion = $editAddPrevodsToDelete;

        foreach ($editAddPrevodsToDelete as $editAddPrevodRemoved) {
            $editAddPrevodRemoved->setLyric(null);
        }

        $this->collEditAddPrevods = null;
        foreach ($editAddPrevods as $editAddPrevod) {
            $this->addEditAddPrevod($editAddPrevod);
        }

        $this->collEditAddPrevods = $editAddPrevods;
        $this->collEditAddPrevodsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related EditAddPrevod objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related EditAddPrevod objects.
     * @throws PropelException
     */
    public function countEditAddPrevods(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collEditAddPrevodsPartial && !$this->isNew();
        if (null === $this->collEditAddPrevods || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collEditAddPrevods) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getEditAddPrevods());
            }

            $query = ChildEditAddPrevodQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByLyric($this)
                ->count($con);
        }

        return count($this->collEditAddPrevods);
    }

    /**
     * Method called to associate a ChildEditAddPrevod object to this object
     * through the ChildEditAddPrevod foreign key attribute.
     *
     * @param  ChildEditAddPrevod $l ChildEditAddPrevod
     * @return $this|\Tekstove\TekstoveBundle\Model\Entity\Lyric The current object (for fluent API support)
     */
    public function addEditAddPrevod(ChildEditAddPrevod $l)
    {
        if ($this->collEditAddPrevods === null) {
            $this->initEditAddPrevods();
            $this->collEditAddPrevodsPartial = true;
        }

        if (!$this->collEditAddPrevods->contains($l)) {
            $this->doAddEditAddPrevod($l);
        }

        return $this;
    }

    /**
     * @param ChildEditAddPrevod $editAddPrevod The ChildEditAddPrevod object to add.
     */
    protected function doAddEditAddPrevod(ChildEditAddPrevod $editAddPrevod)
    {
        $this->collEditAddPrevods[]= $editAddPrevod;
        $editAddPrevod->setLyric($this);
    }

    /**
     * @param  ChildEditAddPrevod $editAddPrevod The ChildEditAddPrevod object to remove.
     * @return $this|ChildLyric The current object (for fluent API support)
     */
    public function removeEditAddPrevod(ChildEditAddPrevod $editAddPrevod)
    {
        if ($this->getEditAddPrevods()->contains($editAddPrevod)) {
            $pos = $this->collEditAddPrevods->search($editAddPrevod);
            $this->collEditAddPrevods->remove($pos);
            if (null === $this->editAddPrevodsScheduledForDeletion) {
                $this->editAddPrevodsScheduledForDeletion = clone $this->collEditAddPrevods;
                $this->editAddPrevodsScheduledForDeletion->clear();
            }
            $this->editAddPrevodsScheduledForDeletion[]= clone $editAddPrevod;
            $editAddPrevod->setLyric(null);
        }

        return $this;
    }

    /**
     * Clears out the collLiubimis collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addLiubimis()
     */
    public function clearLiubimis()
    {
        $this->collLiubimis = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collLiubimis collection loaded partially.
     */
    public function resetPartialLiubimis($v = true)
    {
        $this->collLiubimisPartial = $v;
    }

    /**
     * Initializes the collLiubimis collection.
     *
     * By default this just sets the collLiubimis collection to an empty array (like clearcollLiubimis());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initLiubimis($overrideExisting = true)
    {
        if (null !== $this->collLiubimis && !$overrideExisting) {
            return;
        }
        $this->collLiubimis = new ObjectCollection();
        $this->collLiubimis->setModel('\Tekstove\TekstoveBundle\Model\Entity\Liubimi');
    }

    /**
     * Gets an array of ChildLiubimi objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildLyric is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildLiubimi[] List of ChildLiubimi objects
     * @throws PropelException
     */
    public function getLiubimis(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collLiubimisPartial && !$this->isNew();
        if (null === $this->collLiubimis || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collLiubimis) {
                // return empty collection
                $this->initLiubimis();
            } else {
                $collLiubimis = ChildLiubimiQuery::create(null, $criteria)
                    ->filterByLyric($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collLiubimisPartial && count($collLiubimis)) {
                        $this->initLiubimis(false);

                        foreach ($collLiubimis as $obj) {
                            if (false == $this->collLiubimis->contains($obj)) {
                                $this->collLiubimis->append($obj);
                            }
                        }

                        $this->collLiubimisPartial = true;
                    }

                    return $collLiubimis;
                }

                if ($partial && $this->collLiubimis) {
                    foreach ($this->collLiubimis as $obj) {
                        if ($obj->isNew()) {
                            $collLiubimis[] = $obj;
                        }
                    }
                }

                $this->collLiubimis = $collLiubimis;
                $this->collLiubimisPartial = false;
            }
        }

        return $this->collLiubimis;
    }

    /**
     * Sets a collection of ChildLiubimi objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $liubimis A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildLyric The current object (for fluent API support)
     */
    public function setLiubimis(Collection $liubimis, ConnectionInterface $con = null)
    {
        /** @var ChildLiubimi[] $liubimisToDelete */
        $liubimisToDelete = $this->getLiubimis(new Criteria(), $con)->diff($liubimis);


        $this->liubimisScheduledForDeletion = $liubimisToDelete;

        foreach ($liubimisToDelete as $liubimiRemoved) {
            $liubimiRemoved->setLyric(null);
        }

        $this->collLiubimis = null;
        foreach ($liubimis as $liubimi) {
            $this->addLiubimi($liubimi);
        }

        $this->collLiubimis = $liubimis;
        $this->collLiubimisPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Liubimi objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related Liubimi objects.
     * @throws PropelException
     */
    public function countLiubimis(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collLiubimisPartial && !$this->isNew();
        if (null === $this->collLiubimis || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collLiubimis) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getLiubimis());
            }

            $query = ChildLiubimiQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByLyric($this)
                ->count($con);
        }

        return count($this->collLiubimis);
    }

    /**
     * Method called to associate a ChildLiubimi object to this object
     * through the ChildLiubimi foreign key attribute.
     *
     * @param  ChildLiubimi $l ChildLiubimi
     * @return $this|\Tekstove\TekstoveBundle\Model\Entity\Lyric The current object (for fluent API support)
     */
    public function addLiubimi(ChildLiubimi $l)
    {
        if ($this->collLiubimis === null) {
            $this->initLiubimis();
            $this->collLiubimisPartial = true;
        }

        if (!$this->collLiubimis->contains($l)) {
            $this->doAddLiubimi($l);
        }

        return $this;
    }

    /**
     * @param ChildLiubimi $liubimi The ChildLiubimi object to add.
     */
    protected function doAddLiubimi(ChildLiubimi $liubimi)
    {
        $this->collLiubimis[]= $liubimi;
        $liubimi->setLyric($this);
    }

    /**
     * @param  ChildLiubimi $liubimi The ChildLiubimi object to remove.
     * @return $this|ChildLyric The current object (for fluent API support)
     */
    public function removeLiubimi(ChildLiubimi $liubimi)
    {
        if ($this->getLiubimis()->contains($liubimi)) {
            $pos = $this->collLiubimis->search($liubimi);
            $this->collLiubimis->remove($pos);
            if (null === $this->liubimisScheduledForDeletion) {
                $this->liubimisScheduledForDeletion = clone $this->collLiubimis;
                $this->liubimisScheduledForDeletion->clear();
            }
            $this->liubimisScheduledForDeletion[]= clone $liubimi;
            $liubimi->setLyric(null);
        }

        return $this;
    }

    /**
     * Gets a single ChildLyric18 object, which is related to this object by a one-to-one relationship.
     *
     * @param  ConnectionInterface $con optional connection object
     * @return ChildLyric18
     * @throws PropelException
     */
    public function getLyric18(ConnectionInterface $con = null)
    {

        if ($this->singleLyric18 === null && !$this->isNew()) {
            $this->singleLyric18 = ChildLyric18Query::create()->findPk($this->getPrimaryKey(), $con);
        }

        return $this->singleLyric18;
    }

    /**
     * Sets a single ChildLyric18 object as related to this object by a one-to-one relationship.
     *
     * @param  ChildLyric18 $v ChildLyric18
     * @return $this|\Tekstove\TekstoveBundle\Model\Entity\Lyric The current object (for fluent API support)
     * @throws PropelException
     */
    public function setLyric18(ChildLyric18 $v = null)
    {
        $this->singleLyric18 = $v;

        // Make sure that that the passed-in ChildLyric18 isn't already associated with this object
        if ($v !== null && $v->getLyric(null, false) === null) {
            $v->setLyric($this);
        }

        return $this;
    }

    /**
     * Clears out the collLyricRedirects collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addLyricRedirects()
     */
    public function clearLyricRedirects()
    {
        $this->collLyricRedirects = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collLyricRedirects collection loaded partially.
     */
    public function resetPartialLyricRedirects($v = true)
    {
        $this->collLyricRedirectsPartial = $v;
    }

    /**
     * Initializes the collLyricRedirects collection.
     *
     * By default this just sets the collLyricRedirects collection to an empty array (like clearcollLyricRedirects());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initLyricRedirects($overrideExisting = true)
    {
        if (null !== $this->collLyricRedirects && !$overrideExisting) {
            return;
        }
        $this->collLyricRedirects = new ObjectCollection();
        $this->collLyricRedirects->setModel('\Tekstove\TekstoveBundle\Model\Entity\LyricRedirect');
    }

    /**
     * Gets an array of ChildLyricRedirect objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildLyric is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildLyricRedirect[] List of ChildLyricRedirect objects
     * @throws PropelException
     */
    public function getLyricRedirects(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collLyricRedirectsPartial && !$this->isNew();
        if (null === $this->collLyricRedirects || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collLyricRedirects) {
                // return empty collection
                $this->initLyricRedirects();
            } else {
                $collLyricRedirects = ChildLyricRedirectQuery::create(null, $criteria)
                    ->filterByLyric($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collLyricRedirectsPartial && count($collLyricRedirects)) {
                        $this->initLyricRedirects(false);

                        foreach ($collLyricRedirects as $obj) {
                            if (false == $this->collLyricRedirects->contains($obj)) {
                                $this->collLyricRedirects->append($obj);
                            }
                        }

                        $this->collLyricRedirectsPartial = true;
                    }

                    return $collLyricRedirects;
                }

                if ($partial && $this->collLyricRedirects) {
                    foreach ($this->collLyricRedirects as $obj) {
                        if ($obj->isNew()) {
                            $collLyricRedirects[] = $obj;
                        }
                    }
                }

                $this->collLyricRedirects = $collLyricRedirects;
                $this->collLyricRedirectsPartial = false;
            }
        }

        return $this->collLyricRedirects;
    }

    /**
     * Sets a collection of ChildLyricRedirect objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $lyricRedirects A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildLyric The current object (for fluent API support)
     */
    public function setLyricRedirects(Collection $lyricRedirects, ConnectionInterface $con = null)
    {
        /** @var ChildLyricRedirect[] $lyricRedirectsToDelete */
        $lyricRedirectsToDelete = $this->getLyricRedirects(new Criteria(), $con)->diff($lyricRedirects);


        //since at least one column in the foreign key is at the same time a PK
        //we can not just set a PK to NULL in the lines below. We have to store
        //a backup of all values, so we are able to manipulate these items based on the onDelete value later.
        $this->lyricRedirectsScheduledForDeletion = clone $lyricRedirectsToDelete;

        foreach ($lyricRedirectsToDelete as $lyricRedirectRemoved) {
            $lyricRedirectRemoved->setLyric(null);
        }

        $this->collLyricRedirects = null;
        foreach ($lyricRedirects as $lyricRedirect) {
            $this->addLyricRedirect($lyricRedirect);
        }

        $this->collLyricRedirects = $lyricRedirects;
        $this->collLyricRedirectsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related LyricRedirect objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related LyricRedirect objects.
     * @throws PropelException
     */
    public function countLyricRedirects(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collLyricRedirectsPartial && !$this->isNew();
        if (null === $this->collLyricRedirects || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collLyricRedirects) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getLyricRedirects());
            }

            $query = ChildLyricRedirectQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByLyric($this)
                ->count($con);
        }

        return count($this->collLyricRedirects);
    }

    /**
     * Method called to associate a ChildLyricRedirect object to this object
     * through the ChildLyricRedirect foreign key attribute.
     *
     * @param  ChildLyricRedirect $l ChildLyricRedirect
     * @return $this|\Tekstove\TekstoveBundle\Model\Entity\Lyric The current object (for fluent API support)
     */
    public function addLyricRedirect(ChildLyricRedirect $l)
    {
        if ($this->collLyricRedirects === null) {
            $this->initLyricRedirects();
            $this->collLyricRedirectsPartial = true;
        }

        if (!$this->collLyricRedirects->contains($l)) {
            $this->doAddLyricRedirect($l);
        }

        return $this;
    }

    /**
     * @param ChildLyricRedirect $lyricRedirect The ChildLyricRedirect object to add.
     */
    protected function doAddLyricRedirect(ChildLyricRedirect $lyricRedirect)
    {
        $this->collLyricRedirects[]= $lyricRedirect;
        $lyricRedirect->setLyric($this);
    }

    /**
     * @param  ChildLyricRedirect $lyricRedirect The ChildLyricRedirect object to remove.
     * @return $this|ChildLyric The current object (for fluent API support)
     */
    public function removeLyricRedirect(ChildLyricRedirect $lyricRedirect)
    {
        if ($this->getLyricRedirects()->contains($lyricRedirect)) {
            $pos = $this->collLyricRedirects->search($lyricRedirect);
            $this->collLyricRedirects->remove($pos);
            if (null === $this->lyricRedirectsScheduledForDeletion) {
                $this->lyricRedirectsScheduledForDeletion = clone $this->collLyricRedirects;
                $this->lyricRedirectsScheduledForDeletion->clear();
            }
            $this->lyricRedirectsScheduledForDeletion[]= clone $lyricRedirect;
            $lyricRedirect->setLyric(null);
        }

        return $this;
    }

    /**
     * Clears out the collCommentss collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addCommentss()
     */
    public function clearCommentss()
    {
        $this->collCommentss = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collCommentss collection loaded partially.
     */
    public function resetPartialCommentss($v = true)
    {
        $this->collCommentssPartial = $v;
    }

    /**
     * Initializes the collCommentss collection.
     *
     * By default this just sets the collCommentss collection to an empty array (like clearcollCommentss());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initCommentss($overrideExisting = true)
    {
        if (null !== $this->collCommentss && !$overrideExisting) {
            return;
        }
        $this->collCommentss = new ObjectCollection();
        $this->collCommentss->setModel('\Tekstove\TekstoveBundle\Model\Entity\Comments');
    }

    /**
     * Gets an array of ChildComments objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildLyric is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildComments[] List of ChildComments objects
     * @throws PropelException
     */
    public function getCommentss(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collCommentssPartial && !$this->isNew();
        if (null === $this->collCommentss || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collCommentss) {
                // return empty collection
                $this->initCommentss();
            } else {
                $collCommentss = ChildCommentsQuery::create(null, $criteria)
                    ->filterByLyric($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collCommentssPartial && count($collCommentss)) {
                        $this->initCommentss(false);

                        foreach ($collCommentss as $obj) {
                            if (false == $this->collCommentss->contains($obj)) {
                                $this->collCommentss->append($obj);
                            }
                        }

                        $this->collCommentssPartial = true;
                    }

                    return $collCommentss;
                }

                if ($partial && $this->collCommentss) {
                    foreach ($this->collCommentss as $obj) {
                        if ($obj->isNew()) {
                            $collCommentss[] = $obj;
                        }
                    }
                }

                $this->collCommentss = $collCommentss;
                $this->collCommentssPartial = false;
            }
        }

        return $this->collCommentss;
    }

    /**
     * Sets a collection of ChildComments objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $commentss A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildLyric The current object (for fluent API support)
     */
    public function setCommentss(Collection $commentss, ConnectionInterface $con = null)
    {
        /** @var ChildComments[] $commentssToDelete */
        $commentssToDelete = $this->getCommentss(new Criteria(), $con)->diff($commentss);


        $this->commentssScheduledForDeletion = $commentssToDelete;

        foreach ($commentssToDelete as $commentsRemoved) {
            $commentsRemoved->setLyric(null);
        }

        $this->collCommentss = null;
        foreach ($commentss as $comments) {
            $this->addComments($comments);
        }

        $this->collCommentss = $commentss;
        $this->collCommentssPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Comments objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related Comments objects.
     * @throws PropelException
     */
    public function countCommentss(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collCommentssPartial && !$this->isNew();
        if (null === $this->collCommentss || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collCommentss) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getCommentss());
            }

            $query = ChildCommentsQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByLyric($this)
                ->count($con);
        }

        return count($this->collCommentss);
    }

    /**
     * Method called to associate a ChildComments object to this object
     * through the ChildComments foreign key attribute.
     *
     * @param  ChildComments $l ChildComments
     * @return $this|\Tekstove\TekstoveBundle\Model\Entity\Lyric The current object (for fluent API support)
     */
    public function addComments(ChildComments $l)
    {
        if ($this->collCommentss === null) {
            $this->initCommentss();
            $this->collCommentssPartial = true;
        }

        if (!$this->collCommentss->contains($l)) {
            $this->doAddComments($l);
        }

        return $this;
    }

    /**
     * @param ChildComments $comments The ChildComments object to add.
     */
    protected function doAddComments(ChildComments $comments)
    {
        $this->collCommentss[]= $comments;
        $comments->setLyric($this);
    }

    /**
     * @param  ChildComments $comments The ChildComments object to remove.
     * @return $this|ChildLyric The current object (for fluent API support)
     */
    public function removeComments(ChildComments $comments)
    {
        if ($this->getCommentss()->contains($comments)) {
            $pos = $this->collCommentss->search($comments);
            $this->collCommentss->remove($pos);
            if (null === $this->commentssScheduledForDeletion) {
                $this->commentssScheduledForDeletion = clone $this->collCommentss;
                $this->commentssScheduledForDeletion->clear();
            }
            $this->commentssScheduledForDeletion[]= clone $comments;
            $comments->setLyric(null);
        }

        return $this;
    }

    /**
     * Clears out the collVotess collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addVotess()
     */
    public function clearVotess()
    {
        $this->collVotess = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collVotess collection loaded partially.
     */
    public function resetPartialVotess($v = true)
    {
        $this->collVotessPartial = $v;
    }

    /**
     * Initializes the collVotess collection.
     *
     * By default this just sets the collVotess collection to an empty array (like clearcollVotess());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initVotess($overrideExisting = true)
    {
        if (null !== $this->collVotess && !$overrideExisting) {
            return;
        }
        $this->collVotess = new ObjectCollection();
        $this->collVotess->setModel('\Tekstove\TekstoveBundle\Model\Entity\Lyric\Votes');
    }

    /**
     * Gets an array of Votes objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildLyric is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|Votes[] List of Votes objects
     * @throws PropelException
     */
    public function getVotess(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collVotessPartial && !$this->isNew();
        if (null === $this->collVotess || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collVotess) {
                // return empty collection
                $this->initVotess();
            } else {
                $collVotess = VotesQuery::create(null, $criteria)
                    ->filterByLyric($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collVotessPartial && count($collVotess)) {
                        $this->initVotess(false);

                        foreach ($collVotess as $obj) {
                            if (false == $this->collVotess->contains($obj)) {
                                $this->collVotess->append($obj);
                            }
                        }

                        $this->collVotessPartial = true;
                    }

                    return $collVotess;
                }

                if ($partial && $this->collVotess) {
                    foreach ($this->collVotess as $obj) {
                        if ($obj->isNew()) {
                            $collVotess[] = $obj;
                        }
                    }
                }

                $this->collVotess = $collVotess;
                $this->collVotessPartial = false;
            }
        }

        return $this->collVotess;
    }

    /**
     * Sets a collection of Votes objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $votess A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildLyric The current object (for fluent API support)
     */
    public function setVotess(Collection $votess, ConnectionInterface $con = null)
    {
        /** @var Votes[] $votessToDelete */
        $votessToDelete = $this->getVotess(new Criteria(), $con)->diff($votess);


        $this->votessScheduledForDeletion = $votessToDelete;

        foreach ($votessToDelete as $votesRemoved) {
            $votesRemoved->setLyric(null);
        }

        $this->collVotess = null;
        foreach ($votess as $votes) {
            $this->addVotes($votes);
        }

        $this->collVotess = $votess;
        $this->collVotessPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BaseVotes objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related BaseVotes objects.
     * @throws PropelException
     */
    public function countVotess(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collVotessPartial && !$this->isNew();
        if (null === $this->collVotess || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collVotess) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getVotess());
            }

            $query = VotesQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByLyric($this)
                ->count($con);
        }

        return count($this->collVotess);
    }

    /**
     * Method called to associate a Votes object to this object
     * through the Votes foreign key attribute.
     *
     * @param  Votes $l Votes
     * @return $this|\Tekstove\TekstoveBundle\Model\Entity\Lyric The current object (for fluent API support)
     */
    public function addVotes(Votes $l)
    {
        if ($this->collVotess === null) {
            $this->initVotess();
            $this->collVotessPartial = true;
        }

        if (!$this->collVotess->contains($l)) {
            $this->doAddVotes($l);
        }

        return $this;
    }

    /**
     * @param Votes $votes The Votes object to add.
     */
    protected function doAddVotes(Votes $votes)
    {
        $this->collVotess[]= $votes;
        $votes->setLyric($this);
    }

    /**
     * @param  Votes $votes The Votes object to remove.
     * @return $this|ChildLyric The current object (for fluent API support)
     */
    public function removeVotes(Votes $votes)
    {
        if ($this->getVotess()->contains($votes)) {
            $pos = $this->collVotess->search($votes);
            $this->collVotess->remove($pos);
            if (null === $this->votessScheduledForDeletion) {
                $this->votessScheduledForDeletion = clone $this->collVotess;
                $this->votessScheduledForDeletion->clear();
            }
            $this->votessScheduledForDeletion[]= clone $votes;
            $votes->setLyric(null);
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
        if (null !== $this->aLanguages) {
            $this->aLanguages->removeLyric($this);
        }
        $this->id = null;
        $this->cache_title_full = null;
        $this->cache_title_short = null;
        $this->uploaded_by = null;
        $this->text = null;
        $this->text_bg = null;
        $this->artist1 = null;
        $this->artist2 = null;
        $this->artist3 = null;
        $this->artist4 = null;
        $this->artist5 = null;
        $this->artist6 = null;
        $this->title = null;
        $this->album1 = null;
        $this->album2 = null;
        $this->video = null;
        $this->video_vbox7 = null;
        $this->video_vbox7_orig = null;
        $this->video_youtube = null;
        $this->video_youtube_orig = null;
        $this->video_metacafe = null;
        $this->video_metacafe_orig = null;
        $this->download = null;
        $this->image = null;
        $this->podnovena = null;
        $this->ip_upload = null;
        $this->dopylnitelnoinfo = null;
        $this->glasa = null;
        $this->views = null;
        $this->popularity = null;
        $this->stilraphiphop = null;
        $this->stilhiphop = null;
        $this->stileastcoast = null;
        $this->language = null;
        $this->stilskit = null;
        $this->stilelektronna = null;
        $this->stilrok = null;
        $this->stilrok_clas = null;
        $this->stilrok_alt = null;
        $this->stilrok_hard = null;
        $this->stildisko = null;
        $this->stillatam = null;
        $this->stilsamba = null;
        $this->stiltango = null;
        $this->stilsalsa = null;
        $this->stilklasi = null;
        $this->stildetski = null;
        $this->stilfolk = null;
        $this->stilnarodna = null;
        $this->stilchalga = null;
        $this->stilpopfolk = null;
        $this->stilmetal = null;
        $this->stilmetal_heavy = null;
        $this->stilmetal_power = null;
        $this->stilmetal_death = null;
        $this->stilmetal_nu = null;
        $this->stilmetal_gothic = null;
        $this->stilmetal_symphonic = null;
        $this->stilsoundtrack = null;
        $this->stildance = null;
        $this->stilrnb = null;
        $this->stilsoul = null;
        $this->stilnew_rave = null;
        $this->stilreggae = null;
        $this->stilkantri = null;
        $this->stilpunk = null;
        $this->stilemo = null;
        $this->stilbreakbeat = null;
        $this->stilbigbeat = null;
        $this->stiljaz = null;
        $this->stilblus = null;
        $this->stilelectronica = null;
        $this->stilska = null;
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
            if ($this->collEditAddPrevods) {
                foreach ($this->collEditAddPrevods as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collLiubimis) {
                foreach ($this->collLiubimis as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->singleLyric18) {
                $this->singleLyric18->clearAllReferences($deep);
            }
            if ($this->collLyricRedirects) {
                foreach ($this->collLyricRedirects as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collCommentss) {
                foreach ($this->collCommentss as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collVotess) {
                foreach ($this->collVotess as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collEditAddPrevods = null;
        $this->collLiubimis = null;
        $this->singleLyric18 = null;
        $this->collLyricRedirects = null;
        $this->collCommentss = null;
        $this->collVotess = null;
        $this->aLanguages = null;
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
