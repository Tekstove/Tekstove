<?php

namespace Tekstove\TekstoveBundle\Model\Entity\Map;

use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\InstancePoolTrait;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\DataFetcher\DataFetcherInterface;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\RelationMap;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Map\TableMapTrait;
use Tekstove\TekstoveBundle\Model\Entity\Lyric;
use Tekstove\TekstoveBundle\Model\Entity\LyricQuery;


/**
 * This class defines the structure of the 'lyric' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class LyricTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'src.Tekstove.TekstoveBundle.Model.Entity.Map.LyricTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'lyric';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\Tekstove\\TekstoveBundle\\Model\\Entity\\Lyric';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'src.Tekstove.TekstoveBundle.Model.Entity.Lyric';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 73;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 73;

    /**
     * the column name for the id field
     */
    const COL_ID = 'lyric.id';

    /**
     * the column name for the zaglavie_palno field
     */
    const COL_ZAGLAVIE_PALNO = 'lyric.zaglavie_palno';

    /**
     * the column name for the zaglavie_sakrateno field
     */
    const COL_ZAGLAVIE_SAKRATENO = 'lyric.zaglavie_sakrateno';

    /**
     * the column name for the up_id field
     */
    const COL_UP_ID = 'lyric.up_id';

    /**
     * the column name for the text field
     */
    const COL_TEXT = 'lyric.text';

    /**
     * the column name for the text_bg field
     */
    const COL_TEXT_BG = 'lyric.text_bg';

    /**
     * the column name for the artist1 field
     */
    const COL_ARTIST1 = 'lyric.artist1';

    /**
     * the column name for the artist2 field
     */
    const COL_ARTIST2 = 'lyric.artist2';

    /**
     * the column name for the artist3 field
     */
    const COL_ARTIST3 = 'lyric.artist3';

    /**
     * the column name for the artist4 field
     */
    const COL_ARTIST4 = 'lyric.artist4';

    /**
     * the column name for the artist5 field
     */
    const COL_ARTIST5 = 'lyric.artist5';

    /**
     * the column name for the artist6 field
     */
    const COL_ARTIST6 = 'lyric.artist6';

    /**
     * the column name for the title field
     */
    const COL_TITLE = 'lyric.title';

    /**
     * the column name for the album1 field
     */
    const COL_ALBUM1 = 'lyric.album1';

    /**
     * the column name for the album2 field
     */
    const COL_ALBUM2 = 'lyric.album2';

    /**
     * the column name for the video field
     */
    const COL_VIDEO = 'lyric.video';

    /**
     * the column name for the video_vbox7 field
     */
    const COL_VIDEO_VBOX7 = 'lyric.video_vbox7';

    /**
     * the column name for the video_vbox7_orig field
     */
    const COL_VIDEO_VBOX7_ORIG = 'lyric.video_vbox7_orig';

    /**
     * the column name for the video_youtube field
     */
    const COL_VIDEO_YOUTUBE = 'lyric.video_youtube';

    /**
     * the column name for the video_youtube_orig field
     */
    const COL_VIDEO_YOUTUBE_ORIG = 'lyric.video_youtube_orig';

    /**
     * the column name for the video_metacafe field
     */
    const COL_VIDEO_METACAFE = 'lyric.video_metacafe';

    /**
     * the column name for the video_metacafe_orig field
     */
    const COL_VIDEO_METACAFE_ORIG = 'lyric.video_metacafe_orig';

    /**
     * the column name for the download field
     */
    const COL_DOWNLOAD = 'lyric.download';

    /**
     * the column name for the image field
     */
    const COL_IMAGE = 'lyric.image';

    /**
     * the column name for the podnovena field
     */
    const COL_PODNOVENA = 'lyric.podnovena';

    /**
     * the column name for the ip_upload field
     */
    const COL_IP_UPLOAD = 'lyric.ip_upload';

    /**
     * the column name for the dopylnitelnoinfo field
     */
    const COL_DOPYLNITELNOINFO = 'lyric.dopylnitelnoinfo';

    /**
     * the column name for the glasa field
     */
    const COL_GLASA = 'lyric.glasa';

    /**
     * the column name for the vidqna field
     */
    const COL_VIDQNA = 'lyric.vidqna';

    /**
     * the column name for the populqrnost field
     */
    const COL_POPULQRNOST = 'lyric.populqrnost';

    /**
     * the column name for the stilraphiphop field
     */
    const COL_STILRAPHIPHOP = 'lyric.stilraphiphop';

    /**
     * the column name for the stilhiphop field
     */
    const COL_STILHIPHOP = 'lyric.stilhiphop';

    /**
     * the column name for the stileastcoast field
     */
    const COL_STILEASTCOAST = 'lyric.stileastcoast';

    /**
     * the column name for the pee_se_na field
     */
    const COL_PEE_SE_NA = 'lyric.pee_se_na';

    /**
     * the column name for the stilskit field
     */
    const COL_STILSKIT = 'lyric.stilskit';

    /**
     * the column name for the stilelektronna field
     */
    const COL_STILELEKTRONNA = 'lyric.stilelektronna';

    /**
     * the column name for the stilrok field
     */
    const COL_STILROK = 'lyric.stilrok';

    /**
     * the column name for the stilrok_clas field
     */
    const COL_STILROK_CLAS = 'lyric.stilrok_clas';

    /**
     * the column name for the stilrok_alt field
     */
    const COL_STILROK_ALT = 'lyric.stilrok_alt';

    /**
     * the column name for the stilrok_hard field
     */
    const COL_STILROK_HARD = 'lyric.stilrok_hard';

    /**
     * the column name for the stildisko field
     */
    const COL_STILDISKO = 'lyric.stildisko';

    /**
     * the column name for the stillatam field
     */
    const COL_STILLATAM = 'lyric.stillatam';

    /**
     * the column name for the stilsamba field
     */
    const COL_STILSAMBA = 'lyric.stilsamba';

    /**
     * the column name for the stiltango field
     */
    const COL_STILTANGO = 'lyric.stiltango';

    /**
     * the column name for the stilsalsa field
     */
    const COL_STILSALSA = 'lyric.stilsalsa';

    /**
     * the column name for the stilklasi field
     */
    const COL_STILKLASI = 'lyric.stilklasi';

    /**
     * the column name for the stildetski field
     */
    const COL_STILDETSKI = 'lyric.stildetski';

    /**
     * the column name for the stilfolk field
     */
    const COL_STILFOLK = 'lyric.stilfolk';

    /**
     * the column name for the stilnarodna field
     */
    const COL_STILNARODNA = 'lyric.stilnarodna';

    /**
     * the column name for the stilchalga field
     */
    const COL_STILCHALGA = 'lyric.stilchalga';

    /**
     * the column name for the stilpopfolk field
     */
    const COL_STILPOPFOLK = 'lyric.stilpopfolk';

    /**
     * the column name for the stilmetal field
     */
    const COL_STILMETAL = 'lyric.stilmetal';

    /**
     * the column name for the stilmetal_heavy field
     */
    const COL_STILMETAL_HEAVY = 'lyric.stilmetal_heavy';

    /**
     * the column name for the stilmetal_power field
     */
    const COL_STILMETAL_POWER = 'lyric.stilmetal_power';

    /**
     * the column name for the stilmetal_death field
     */
    const COL_STILMETAL_DEATH = 'lyric.stilmetal_death';

    /**
     * the column name for the stilmetal_nu field
     */
    const COL_STILMETAL_NU = 'lyric.stilmetal_nu';

    /**
     * the column name for the stilmetal_gothic field
     */
    const COL_STILMETAL_GOTHIC = 'lyric.stilmetal_gothic';

    /**
     * the column name for the stilmetal_symphonic field
     */
    const COL_STILMETAL_SYMPHONIC = 'lyric.stilmetal_symphonic';

    /**
     * the column name for the stilsoundtrack field
     */
    const COL_STILSOUNDTRACK = 'lyric.stilsoundtrack';

    /**
     * the column name for the stildance field
     */
    const COL_STILDANCE = 'lyric.stildance';

    /**
     * the column name for the stilRnB field
     */
    const COL_STILRNB = 'lyric.stilRnB';

    /**
     * the column name for the stilsoul field
     */
    const COL_STILSOUL = 'lyric.stilsoul';

    /**
     * the column name for the stilnew_rave field
     */
    const COL_STILNEW_RAVE = 'lyric.stilnew_rave';

    /**
     * the column name for the stilreggae field
     */
    const COL_STILREGGAE = 'lyric.stilreggae';

    /**
     * the column name for the stilkantri field
     */
    const COL_STILKANTRI = 'lyric.stilkantri';

    /**
     * the column name for the stilpunk field
     */
    const COL_STILPUNK = 'lyric.stilpunk';

    /**
     * the column name for the stilemo field
     */
    const COL_STILEMO = 'lyric.stilemo';

    /**
     * the column name for the stilbreakbeat field
     */
    const COL_STILBREAKBEAT = 'lyric.stilbreakbeat';

    /**
     * the column name for the stilbigbeat field
     */
    const COL_STILBIGBEAT = 'lyric.stilbigbeat';

    /**
     * the column name for the stiljaz field
     */
    const COL_STILJAZ = 'lyric.stiljaz';

    /**
     * the column name for the stilblus field
     */
    const COL_STILBLUS = 'lyric.stilblus';

    /**
     * the column name for the stilelectronica field
     */
    const COL_STILELECTRONICA = 'lyric.stilelectronica';

    /**
     * the column name for the stilska field
     */
    const COL_STILSKA = 'lyric.stilska';

    /**
     * The default string format for model objects of the related table
     */
    const DEFAULT_STRING_FORMAT = 'YAML';

    /**
     * holds an array of fieldnames
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
     */
    protected static $fieldNames = array (
        self::TYPE_PHPNAME       => array('Id', 'ZaglaviePalno', 'FullTitleShort', 'UpId', 'Text', 'TextBg', 'Artist1', 'Artist2', 'Artist3', 'Artist4', 'Artist5', 'Artist6', 'Title', 'Album1', 'Album2', 'Video', 'VideoVbox7', 'VideoVbox7Orig', 'VideoYoutube', 'VideoYoutubeOrig', 'VideoMetacafe', 'VideoMetacafeOrig', 'Download', 'Image', 'Podnovena', 'IpUpload', 'Dopylnitelnoinfo', 'Glasa', 'Vidqna', 'Populqrnost', 'Stilraphiphop', 'Stilhiphop', 'Stileastcoast', 'PeeSeNa', 'Stilskit', 'Stilelektronna', 'Stilrok', 'StilrokClas', 'StilrokAlt', 'StilrokHard', 'Stildisko', 'Stillatam', 'Stilsamba', 'Stiltango', 'Stilsalsa', 'Stilklasi', 'Stildetski', 'Stilfolk', 'Stilnarodna', 'Stilchalga', 'Stilpopfolk', 'Stilmetal', 'StilmetalHeavy', 'StilmetalPower', 'StilmetalDeath', 'StilmetalNu', 'StilmetalGothic', 'StilmetalSymphonic', 'Stilsoundtrack', 'Stildance', 'Stilrnb', 'Stilsoul', 'StilnewRave', 'Stilreggae', 'Stilkantri', 'Stilpunk', 'Stilemo', 'Stilbreakbeat', 'Stilbigbeat', 'Stiljaz', 'Stilblus', 'Stilelectronica', 'Stilska', ),
        self::TYPE_CAMELNAME     => array('id', 'zaglaviePalno', 'fullTitleShort', 'upId', 'text', 'textBg', 'artist1', 'artist2', 'artist3', 'artist4', 'artist5', 'artist6', 'title', 'album1', 'album2', 'video', 'videoVbox7', 'videoVbox7Orig', 'videoYoutube', 'videoYoutubeOrig', 'videoMetacafe', 'videoMetacafeOrig', 'download', 'image', 'podnovena', 'ipUpload', 'dopylnitelnoinfo', 'glasa', 'vidqna', 'populqrnost', 'stilraphiphop', 'stilhiphop', 'stileastcoast', 'peeSeNa', 'stilskit', 'stilelektronna', 'stilrok', 'stilrokClas', 'stilrokAlt', 'stilrokHard', 'stildisko', 'stillatam', 'stilsamba', 'stiltango', 'stilsalsa', 'stilklasi', 'stildetski', 'stilfolk', 'stilnarodna', 'stilchalga', 'stilpopfolk', 'stilmetal', 'stilmetalHeavy', 'stilmetalPower', 'stilmetalDeath', 'stilmetalNu', 'stilmetalGothic', 'stilmetalSymphonic', 'stilsoundtrack', 'stildance', 'stilrnb', 'stilsoul', 'stilnewRave', 'stilreggae', 'stilkantri', 'stilpunk', 'stilemo', 'stilbreakbeat', 'stilbigbeat', 'stiljaz', 'stilblus', 'stilelectronica', 'stilska', ),
        self::TYPE_COLNAME       => array(LyricTableMap::COL_ID, LyricTableMap::COL_ZAGLAVIE_PALNO, LyricTableMap::COL_ZAGLAVIE_SAKRATENO, LyricTableMap::COL_UP_ID, LyricTableMap::COL_TEXT, LyricTableMap::COL_TEXT_BG, LyricTableMap::COL_ARTIST1, LyricTableMap::COL_ARTIST2, LyricTableMap::COL_ARTIST3, LyricTableMap::COL_ARTIST4, LyricTableMap::COL_ARTIST5, LyricTableMap::COL_ARTIST6, LyricTableMap::COL_TITLE, LyricTableMap::COL_ALBUM1, LyricTableMap::COL_ALBUM2, LyricTableMap::COL_VIDEO, LyricTableMap::COL_VIDEO_VBOX7, LyricTableMap::COL_VIDEO_VBOX7_ORIG, LyricTableMap::COL_VIDEO_YOUTUBE, LyricTableMap::COL_VIDEO_YOUTUBE_ORIG, LyricTableMap::COL_VIDEO_METACAFE, LyricTableMap::COL_VIDEO_METACAFE_ORIG, LyricTableMap::COL_DOWNLOAD, LyricTableMap::COL_IMAGE, LyricTableMap::COL_PODNOVENA, LyricTableMap::COL_IP_UPLOAD, LyricTableMap::COL_DOPYLNITELNOINFO, LyricTableMap::COL_GLASA, LyricTableMap::COL_VIDQNA, LyricTableMap::COL_POPULQRNOST, LyricTableMap::COL_STILRAPHIPHOP, LyricTableMap::COL_STILHIPHOP, LyricTableMap::COL_STILEASTCOAST, LyricTableMap::COL_PEE_SE_NA, LyricTableMap::COL_STILSKIT, LyricTableMap::COL_STILELEKTRONNA, LyricTableMap::COL_STILROK, LyricTableMap::COL_STILROK_CLAS, LyricTableMap::COL_STILROK_ALT, LyricTableMap::COL_STILROK_HARD, LyricTableMap::COL_STILDISKO, LyricTableMap::COL_STILLATAM, LyricTableMap::COL_STILSAMBA, LyricTableMap::COL_STILTANGO, LyricTableMap::COL_STILSALSA, LyricTableMap::COL_STILKLASI, LyricTableMap::COL_STILDETSKI, LyricTableMap::COL_STILFOLK, LyricTableMap::COL_STILNARODNA, LyricTableMap::COL_STILCHALGA, LyricTableMap::COL_STILPOPFOLK, LyricTableMap::COL_STILMETAL, LyricTableMap::COL_STILMETAL_HEAVY, LyricTableMap::COL_STILMETAL_POWER, LyricTableMap::COL_STILMETAL_DEATH, LyricTableMap::COL_STILMETAL_NU, LyricTableMap::COL_STILMETAL_GOTHIC, LyricTableMap::COL_STILMETAL_SYMPHONIC, LyricTableMap::COL_STILSOUNDTRACK, LyricTableMap::COL_STILDANCE, LyricTableMap::COL_STILRNB, LyricTableMap::COL_STILSOUL, LyricTableMap::COL_STILNEW_RAVE, LyricTableMap::COL_STILREGGAE, LyricTableMap::COL_STILKANTRI, LyricTableMap::COL_STILPUNK, LyricTableMap::COL_STILEMO, LyricTableMap::COL_STILBREAKBEAT, LyricTableMap::COL_STILBIGBEAT, LyricTableMap::COL_STILJAZ, LyricTableMap::COL_STILBLUS, LyricTableMap::COL_STILELECTRONICA, LyricTableMap::COL_STILSKA, ),
        self::TYPE_FIELDNAME     => array('id', 'zaglavie_palno', 'zaglavie_sakrateno', 'up_id', 'text', 'text_bg', 'artist1', 'artist2', 'artist3', 'artist4', 'artist5', 'artist6', 'title', 'album1', 'album2', 'video', 'video_vbox7', 'video_vbox7_orig', 'video_youtube', 'video_youtube_orig', 'video_metacafe', 'video_metacafe_orig', 'download', 'image', 'podnovena', 'ip_upload', 'dopylnitelnoinfo', 'glasa', 'vidqna', 'populqrnost', 'stilraphiphop', 'stilhiphop', 'stileastcoast', 'pee_se_na', 'stilskit', 'stilelektronna', 'stilrok', 'stilrok_clas', 'stilrok_alt', 'stilrok_hard', 'stildisko', 'stillatam', 'stilsamba', 'stiltango', 'stilsalsa', 'stilklasi', 'stildetski', 'stilfolk', 'stilnarodna', 'stilchalga', 'stilpopfolk', 'stilmetal', 'stilmetal_heavy', 'stilmetal_power', 'stilmetal_death', 'stilmetal_nu', 'stilmetal_gothic', 'stilmetal_symphonic', 'stilsoundtrack', 'stildance', 'stilRnB', 'stilsoul', 'stilnew_rave', 'stilreggae', 'stilkantri', 'stilpunk', 'stilemo', 'stilbreakbeat', 'stilbigbeat', 'stiljaz', 'stilblus', 'stilelectronica', 'stilska', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 36, 37, 38, 39, 40, 41, 42, 43, 44, 45, 46, 47, 48, 49, 50, 51, 52, 53, 54, 55, 56, 57, 58, 59, 60, 61, 62, 63, 64, 65, 66, 67, 68, 69, 70, 71, 72, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Id' => 0, 'ZaglaviePalno' => 1, 'FullTitleShort' => 2, 'UpId' => 3, 'Text' => 4, 'TextBg' => 5, 'Artist1' => 6, 'Artist2' => 7, 'Artist3' => 8, 'Artist4' => 9, 'Artist5' => 10, 'Artist6' => 11, 'Title' => 12, 'Album1' => 13, 'Album2' => 14, 'Video' => 15, 'VideoVbox7' => 16, 'VideoVbox7Orig' => 17, 'VideoYoutube' => 18, 'VideoYoutubeOrig' => 19, 'VideoMetacafe' => 20, 'VideoMetacafeOrig' => 21, 'Download' => 22, 'Image' => 23, 'Podnovena' => 24, 'IpUpload' => 25, 'Dopylnitelnoinfo' => 26, 'Glasa' => 27, 'Vidqna' => 28, 'Populqrnost' => 29, 'Stilraphiphop' => 30, 'Stilhiphop' => 31, 'Stileastcoast' => 32, 'PeeSeNa' => 33, 'Stilskit' => 34, 'Stilelektronna' => 35, 'Stilrok' => 36, 'StilrokClas' => 37, 'StilrokAlt' => 38, 'StilrokHard' => 39, 'Stildisko' => 40, 'Stillatam' => 41, 'Stilsamba' => 42, 'Stiltango' => 43, 'Stilsalsa' => 44, 'Stilklasi' => 45, 'Stildetski' => 46, 'Stilfolk' => 47, 'Stilnarodna' => 48, 'Stilchalga' => 49, 'Stilpopfolk' => 50, 'Stilmetal' => 51, 'StilmetalHeavy' => 52, 'StilmetalPower' => 53, 'StilmetalDeath' => 54, 'StilmetalNu' => 55, 'StilmetalGothic' => 56, 'StilmetalSymphonic' => 57, 'Stilsoundtrack' => 58, 'Stildance' => 59, 'Stilrnb' => 60, 'Stilsoul' => 61, 'StilnewRave' => 62, 'Stilreggae' => 63, 'Stilkantri' => 64, 'Stilpunk' => 65, 'Stilemo' => 66, 'Stilbreakbeat' => 67, 'Stilbigbeat' => 68, 'Stiljaz' => 69, 'Stilblus' => 70, 'Stilelectronica' => 71, 'Stilska' => 72, ),
        self::TYPE_CAMELNAME     => array('id' => 0, 'zaglaviePalno' => 1, 'fullTitleShort' => 2, 'upId' => 3, 'text' => 4, 'textBg' => 5, 'artist1' => 6, 'artist2' => 7, 'artist3' => 8, 'artist4' => 9, 'artist5' => 10, 'artist6' => 11, 'title' => 12, 'album1' => 13, 'album2' => 14, 'video' => 15, 'videoVbox7' => 16, 'videoVbox7Orig' => 17, 'videoYoutube' => 18, 'videoYoutubeOrig' => 19, 'videoMetacafe' => 20, 'videoMetacafeOrig' => 21, 'download' => 22, 'image' => 23, 'podnovena' => 24, 'ipUpload' => 25, 'dopylnitelnoinfo' => 26, 'glasa' => 27, 'vidqna' => 28, 'populqrnost' => 29, 'stilraphiphop' => 30, 'stilhiphop' => 31, 'stileastcoast' => 32, 'peeSeNa' => 33, 'stilskit' => 34, 'stilelektronna' => 35, 'stilrok' => 36, 'stilrokClas' => 37, 'stilrokAlt' => 38, 'stilrokHard' => 39, 'stildisko' => 40, 'stillatam' => 41, 'stilsamba' => 42, 'stiltango' => 43, 'stilsalsa' => 44, 'stilklasi' => 45, 'stildetski' => 46, 'stilfolk' => 47, 'stilnarodna' => 48, 'stilchalga' => 49, 'stilpopfolk' => 50, 'stilmetal' => 51, 'stilmetalHeavy' => 52, 'stilmetalPower' => 53, 'stilmetalDeath' => 54, 'stilmetalNu' => 55, 'stilmetalGothic' => 56, 'stilmetalSymphonic' => 57, 'stilsoundtrack' => 58, 'stildance' => 59, 'stilrnb' => 60, 'stilsoul' => 61, 'stilnewRave' => 62, 'stilreggae' => 63, 'stilkantri' => 64, 'stilpunk' => 65, 'stilemo' => 66, 'stilbreakbeat' => 67, 'stilbigbeat' => 68, 'stiljaz' => 69, 'stilblus' => 70, 'stilelectronica' => 71, 'stilska' => 72, ),
        self::TYPE_COLNAME       => array(LyricTableMap::COL_ID => 0, LyricTableMap::COL_ZAGLAVIE_PALNO => 1, LyricTableMap::COL_ZAGLAVIE_SAKRATENO => 2, LyricTableMap::COL_UP_ID => 3, LyricTableMap::COL_TEXT => 4, LyricTableMap::COL_TEXT_BG => 5, LyricTableMap::COL_ARTIST1 => 6, LyricTableMap::COL_ARTIST2 => 7, LyricTableMap::COL_ARTIST3 => 8, LyricTableMap::COL_ARTIST4 => 9, LyricTableMap::COL_ARTIST5 => 10, LyricTableMap::COL_ARTIST6 => 11, LyricTableMap::COL_TITLE => 12, LyricTableMap::COL_ALBUM1 => 13, LyricTableMap::COL_ALBUM2 => 14, LyricTableMap::COL_VIDEO => 15, LyricTableMap::COL_VIDEO_VBOX7 => 16, LyricTableMap::COL_VIDEO_VBOX7_ORIG => 17, LyricTableMap::COL_VIDEO_YOUTUBE => 18, LyricTableMap::COL_VIDEO_YOUTUBE_ORIG => 19, LyricTableMap::COL_VIDEO_METACAFE => 20, LyricTableMap::COL_VIDEO_METACAFE_ORIG => 21, LyricTableMap::COL_DOWNLOAD => 22, LyricTableMap::COL_IMAGE => 23, LyricTableMap::COL_PODNOVENA => 24, LyricTableMap::COL_IP_UPLOAD => 25, LyricTableMap::COL_DOPYLNITELNOINFO => 26, LyricTableMap::COL_GLASA => 27, LyricTableMap::COL_VIDQNA => 28, LyricTableMap::COL_POPULQRNOST => 29, LyricTableMap::COL_STILRAPHIPHOP => 30, LyricTableMap::COL_STILHIPHOP => 31, LyricTableMap::COL_STILEASTCOAST => 32, LyricTableMap::COL_PEE_SE_NA => 33, LyricTableMap::COL_STILSKIT => 34, LyricTableMap::COL_STILELEKTRONNA => 35, LyricTableMap::COL_STILROK => 36, LyricTableMap::COL_STILROK_CLAS => 37, LyricTableMap::COL_STILROK_ALT => 38, LyricTableMap::COL_STILROK_HARD => 39, LyricTableMap::COL_STILDISKO => 40, LyricTableMap::COL_STILLATAM => 41, LyricTableMap::COL_STILSAMBA => 42, LyricTableMap::COL_STILTANGO => 43, LyricTableMap::COL_STILSALSA => 44, LyricTableMap::COL_STILKLASI => 45, LyricTableMap::COL_STILDETSKI => 46, LyricTableMap::COL_STILFOLK => 47, LyricTableMap::COL_STILNARODNA => 48, LyricTableMap::COL_STILCHALGA => 49, LyricTableMap::COL_STILPOPFOLK => 50, LyricTableMap::COL_STILMETAL => 51, LyricTableMap::COL_STILMETAL_HEAVY => 52, LyricTableMap::COL_STILMETAL_POWER => 53, LyricTableMap::COL_STILMETAL_DEATH => 54, LyricTableMap::COL_STILMETAL_NU => 55, LyricTableMap::COL_STILMETAL_GOTHIC => 56, LyricTableMap::COL_STILMETAL_SYMPHONIC => 57, LyricTableMap::COL_STILSOUNDTRACK => 58, LyricTableMap::COL_STILDANCE => 59, LyricTableMap::COL_STILRNB => 60, LyricTableMap::COL_STILSOUL => 61, LyricTableMap::COL_STILNEW_RAVE => 62, LyricTableMap::COL_STILREGGAE => 63, LyricTableMap::COL_STILKANTRI => 64, LyricTableMap::COL_STILPUNK => 65, LyricTableMap::COL_STILEMO => 66, LyricTableMap::COL_STILBREAKBEAT => 67, LyricTableMap::COL_STILBIGBEAT => 68, LyricTableMap::COL_STILJAZ => 69, LyricTableMap::COL_STILBLUS => 70, LyricTableMap::COL_STILELECTRONICA => 71, LyricTableMap::COL_STILSKA => 72, ),
        self::TYPE_FIELDNAME     => array('id' => 0, 'zaglavie_palno' => 1, 'zaglavie_sakrateno' => 2, 'up_id' => 3, 'text' => 4, 'text_bg' => 5, 'artist1' => 6, 'artist2' => 7, 'artist3' => 8, 'artist4' => 9, 'artist5' => 10, 'artist6' => 11, 'title' => 12, 'album1' => 13, 'album2' => 14, 'video' => 15, 'video_vbox7' => 16, 'video_vbox7_orig' => 17, 'video_youtube' => 18, 'video_youtube_orig' => 19, 'video_metacafe' => 20, 'video_metacafe_orig' => 21, 'download' => 22, 'image' => 23, 'podnovena' => 24, 'ip_upload' => 25, 'dopylnitelnoinfo' => 26, 'glasa' => 27, 'vidqna' => 28, 'populqrnost' => 29, 'stilraphiphop' => 30, 'stilhiphop' => 31, 'stileastcoast' => 32, 'pee_se_na' => 33, 'stilskit' => 34, 'stilelektronna' => 35, 'stilrok' => 36, 'stilrok_clas' => 37, 'stilrok_alt' => 38, 'stilrok_hard' => 39, 'stildisko' => 40, 'stillatam' => 41, 'stilsamba' => 42, 'stiltango' => 43, 'stilsalsa' => 44, 'stilklasi' => 45, 'stildetski' => 46, 'stilfolk' => 47, 'stilnarodna' => 48, 'stilchalga' => 49, 'stilpopfolk' => 50, 'stilmetal' => 51, 'stilmetal_heavy' => 52, 'stilmetal_power' => 53, 'stilmetal_death' => 54, 'stilmetal_nu' => 55, 'stilmetal_gothic' => 56, 'stilmetal_symphonic' => 57, 'stilsoundtrack' => 58, 'stildance' => 59, 'stilRnB' => 60, 'stilsoul' => 61, 'stilnew_rave' => 62, 'stilreggae' => 63, 'stilkantri' => 64, 'stilpunk' => 65, 'stilemo' => 66, 'stilbreakbeat' => 67, 'stilbigbeat' => 68, 'stiljaz' => 69, 'stilblus' => 70, 'stilelectronica' => 71, 'stilska' => 72, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 36, 37, 38, 39, 40, 41, 42, 43, 44, 45, 46, 47, 48, 49, 50, 51, 52, 53, 54, 55, 56, 57, 58, 59, 60, 61, 62, 63, 64, 65, 66, 67, 68, 69, 70, 71, 72, )
    );

    /**
     * Initialize the table attributes and columns
     * Relations are not initialized by this method since they are lazy loaded
     *
     * @return void
     * @throws PropelException
     */
    public function initialize()
    {
        // attributes
        $this->setName('lyric');
        $this->setPhpName('Lyric');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Tekstove\\TekstoveBundle\\Model\\Entity\\Lyric');
        $this->setPackage('src.Tekstove.TekstoveBundle.Model.Entity');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('zaglavie_palno', 'ZaglaviePalno', 'LONGVARCHAR', true, null, null);
        $this->addColumn('zaglavie_sakrateno', 'FullTitleShort', 'VARCHAR', true, 280, null);
        $this->addColumn('up_id', 'UpId', 'INTEGER', true, null, null);
        $this->addColumn('text', 'Text', 'LONGVARCHAR', true, null, null);
        $this->addColumn('text_bg', 'TextBg', 'LONGVARCHAR', false, null, null);
        $this->addColumn('artist1', 'Artist1', 'INTEGER', true, null, null);
        $this->addColumn('artist2', 'Artist2', 'INTEGER', true, null, null);
        $this->addColumn('artist3', 'Artist3', 'INTEGER', true, null, null);
        $this->addColumn('artist4', 'Artist4', 'INTEGER', true, null, null);
        $this->addColumn('artist5', 'Artist5', 'INTEGER', true, null, null);
        $this->addColumn('artist6', 'Artist6', 'INTEGER', true, null, null);
        $this->addColumn('title', 'Title', 'VARCHAR', true, 60, null);
        $this->addColumn('album1', 'Album1', 'INTEGER', true, null, null);
        $this->addColumn('album2', 'Album2', 'INTEGER', true, null, null);
        $this->addColumn('video', 'Video', 'VARCHAR', true, 100, null);
        $this->addColumn('video_vbox7', 'VideoVbox7', 'VARCHAR', true, 100, null);
        $this->addColumn('video_vbox7_orig', 'VideoVbox7Orig', 'VARCHAR', true, 100, null);
        $this->addColumn('video_youtube', 'VideoYoutube', 'VARCHAR', true, 100, null);
        $this->addColumn('video_youtube_orig', 'VideoYoutubeOrig', 'VARCHAR', true, 100, null);
        $this->addColumn('video_metacafe', 'VideoMetacafe', 'VARCHAR', true, 150, null);
        $this->addColumn('video_metacafe_orig', 'VideoMetacafeOrig', 'VARCHAR', true, 150, null);
        $this->addColumn('download', 'Download', 'VARCHAR', false, 255, null);
        $this->addColumn('image', 'Image', 'VARCHAR', true, 100, null);
        $this->addColumn('podnovena', 'Podnovena', 'TIMESTAMP', true, null, 'CURRENT_TIMESTAMP');
        $this->addColumn('ip_upload', 'IpUpload', 'VARCHAR', true, 30, null);
        $this->addColumn('dopylnitelnoinfo', 'Dopylnitelnoinfo', 'LONGVARCHAR', true, null, null);
        $this->addColumn('glasa', 'Glasa', 'INTEGER', true, null, null);
        $this->addColumn('vidqna', 'Vidqna', 'INTEGER', true, null, null);
        $this->addColumn('populqrnost', 'Populqrnost', 'INTEGER', true, null, null);
        $this->addColumn('stilraphiphop', 'Stilraphiphop', 'BOOLEAN', true, 1, null);
        $this->addColumn('stilhiphop', 'Stilhiphop', 'BOOLEAN', true, 1, null);
        $this->addColumn('stileastcoast', 'Stileastcoast', 'BOOLEAN', true, 1, null);
        $this->addColumn('pee_se_na', 'PeeSeNa', 'BOOLEAN', true, 1, null);
        $this->addColumn('stilskit', 'Stilskit', 'BOOLEAN', true, 1, null);
        $this->addColumn('stilelektronna', 'Stilelektronna', 'BOOLEAN', true, 1, null);
        $this->addColumn('stilrok', 'Stilrok', 'BOOLEAN', true, 1, null);
        $this->addColumn('stilrok_clas', 'StilrokClas', 'BOOLEAN', true, 1, null);
        $this->addColumn('stilrok_alt', 'StilrokAlt', 'BOOLEAN', true, 1, null);
        $this->addColumn('stilrok_hard', 'StilrokHard', 'BOOLEAN', true, 1, null);
        $this->addColumn('stildisko', 'Stildisko', 'BOOLEAN', true, 1, null);
        $this->addColumn('stillatam', 'Stillatam', 'BOOLEAN', true, 1, null);
        $this->addColumn('stilsamba', 'Stilsamba', 'BOOLEAN', true, 1, null);
        $this->addColumn('stiltango', 'Stiltango', 'BOOLEAN', true, 1, null);
        $this->addColumn('stilsalsa', 'Stilsalsa', 'BOOLEAN', true, 1, null);
        $this->addColumn('stilklasi', 'Stilklasi', 'BOOLEAN', true, 1, null);
        $this->addColumn('stildetski', 'Stildetski', 'BOOLEAN', true, 1, null);
        $this->addColumn('stilfolk', 'Stilfolk', 'BOOLEAN', true, 1, null);
        $this->addColumn('stilnarodna', 'Stilnarodna', 'BOOLEAN', true, 1, null);
        $this->addColumn('stilchalga', 'Stilchalga', 'BOOLEAN', true, 1, null);
        $this->addColumn('stilpopfolk', 'Stilpopfolk', 'BOOLEAN', true, 1, null);
        $this->addColumn('stilmetal', 'Stilmetal', 'BOOLEAN', true, 1, null);
        $this->addColumn('stilmetal_heavy', 'StilmetalHeavy', 'BOOLEAN', true, 1, null);
        $this->addColumn('stilmetal_power', 'StilmetalPower', 'BOOLEAN', true, 1, null);
        $this->addColumn('stilmetal_death', 'StilmetalDeath', 'BOOLEAN', true, 1, null);
        $this->addColumn('stilmetal_nu', 'StilmetalNu', 'BOOLEAN', true, 1, null);
        $this->addColumn('stilmetal_gothic', 'StilmetalGothic', 'BOOLEAN', true, 1, null);
        $this->addColumn('stilmetal_symphonic', 'StilmetalSymphonic', 'BOOLEAN', true, 1, null);
        $this->addColumn('stilsoundtrack', 'Stilsoundtrack', 'BOOLEAN', true, 1, null);
        $this->addColumn('stildance', 'Stildance', 'BOOLEAN', true, 1, null);
        $this->addColumn('stilRnB', 'Stilrnb', 'BOOLEAN', true, 1, null);
        $this->addColumn('stilsoul', 'Stilsoul', 'BOOLEAN', true, 1, null);
        $this->addColumn('stilnew_rave', 'StilnewRave', 'BOOLEAN', true, 1, null);
        $this->addColumn('stilreggae', 'Stilreggae', 'BOOLEAN', true, 1, null);
        $this->addColumn('stilkantri', 'Stilkantri', 'BOOLEAN', true, 1, null);
        $this->addColumn('stilpunk', 'Stilpunk', 'BOOLEAN', true, 1, null);
        $this->addColumn('stilemo', 'Stilemo', 'BOOLEAN', true, 1, null);
        $this->addColumn('stilbreakbeat', 'Stilbreakbeat', 'BOOLEAN', true, 1, null);
        $this->addColumn('stilbigbeat', 'Stilbigbeat', 'BOOLEAN', true, 1, null);
        $this->addColumn('stiljaz', 'Stiljaz', 'BOOLEAN', true, 1, null);
        $this->addColumn('stilblus', 'Stilblus', 'BOOLEAN', true, 1, null);
        $this->addColumn('stilelectronica', 'Stilelectronica', 'BOOLEAN', true, 1, null);
        $this->addColumn('stilska', 'Stilska', 'BOOLEAN', true, 1, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Comments', '\\Tekstove\\TekstoveBundle\\Model\\Entity\\Comments', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':zakoqpesen',
    1 => ':id',
  ),
), 'CASCADE', null, 'Commentss', false);
        $this->addRelation('EditAddPrevod', '\\Tekstove\\TekstoveBundle\\Model\\Entity\\EditAddPrevod', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':za_pesen',
    1 => ':id',
  ),
), 'CASCADE', null, 'EditAddPrevods', false);
        $this->addRelation('Glasuvane', '\\Tekstove\\TekstoveBundle\\Model\\Entity\\Glasuvane', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':za',
    1 => ':id',
  ),
), 'CASCADE', null, 'Glasuvanes', false);
        $this->addRelation('Liubimi', '\\Tekstove\\TekstoveBundle\\Model\\Entity\\Liubimi', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':pesen',
    1 => ':id',
  ),
), 'CASCADE', null, 'Liubimis', false);
        $this->addRelation('Lyric18', '\\Tekstove\\TekstoveBundle\\Model\\Entity\\Lyric18', RelationMap::ONE_TO_ONE, array (
  0 =>
  array (
    0 => ':id',
    1 => ':id',
  ),
), 'CASCADE', null, null, false);
        $this->addRelation('LyricRedirect', '\\Tekstove\\TekstoveBundle\\Model\\Entity\\LyricRedirect', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':redirect_id',
    1 => ':id',
  ),
), null, null, 'LyricRedirects', false);
    } // buildRelations()
    /**
     * Method to invalidate the instance pool of all tables related to lyric     * by a foreign key with ON DELETE CASCADE
     */
    public static function clearRelatedInstancePool()
    {
        // Invalidate objects in related instance pools,
        // since one or more of them may be deleted by ON DELETE CASCADE/SETNULL rule.
        CommentsTableMap::clearInstancePool();
        EditAddPrevodTableMap::clearInstancePool();
        GlasuvaneTableMap::clearInstancePool();
        LiubimiTableMap::clearInstancePool();
        Lyric18TableMap::clearInstancePool();
    }

    /**
     * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
     *
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, a serialize()d version of the primary key will be returned.
     *
     * @param array  $row       resultset row.
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return string The primary key hash of the row
     */
    public static function getPrimaryKeyHashFromRow($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        // If the PK cannot be derived from the row, return NULL.
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
    }

    /**
     * Retrieves the primary key from the DB resultset row
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, an array of the primary key columns will be returned.
     *
     * @param array  $row       resultset row.
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return mixed The primary key of the row
     */
    public static function getPrimaryKeyFromRow($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        return (int) $row[
            $indexType == TableMap::TYPE_NUM
                ? 0 + $offset
                : self::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)
        ];
    }

    /**
     * The class that the tableMap will make instances of.
     *
     * If $withPrefix is true, the returned path
     * uses a dot-path notation which is translated into a path
     * relative to a location on the PHP include_path.
     * (e.g. path.to.MyClass -> 'path/to/MyClass.php')
     *
     * @param boolean $withPrefix Whether or not to return the path with the class name
     * @return string path.to.ClassName
     */
    public static function getOMClass($withPrefix = true)
    {
        return $withPrefix ? LyricTableMap::CLASS_DEFAULT : LyricTableMap::OM_CLASS;
    }

    /**
     * Populates an object of the default type or an object that inherit from the default.
     *
     * @param array  $row       row returned by DataFetcher->fetch().
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType The index type of $row. Mostly DataFetcher->getIndexType().
                                 One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     * @return array           (Lyric object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = LyricTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = LyricTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + LyricTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = LyricTableMap::OM_CLASS;
            /** @var Lyric $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            LyricTableMap::addInstanceToPool($obj, $key);
        }

        return array($obj, $col);
    }

    /**
     * The returned array will contain objects of the default type or
     * objects that inherit from the default.
     *
     * @param DataFetcherInterface $dataFetcher
     * @return array
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function populateObjects(DataFetcherInterface $dataFetcher)
    {
        $results = array();

        // set the class once to avoid overhead in the loop
        $cls = static::getOMClass(false);
        // populate the object(s)
        while ($row = $dataFetcher->fetch()) {
            $key = LyricTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = LyricTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Lyric $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                LyricTableMap::addInstanceToPool($obj, $key);
            } // if key exists
        }

        return $results;
    }
    /**
     * Add all the columns needed to create a new object.
     *
     * Note: any columns that were marked with lazyLoad="true" in the
     * XML schema will not be added to the select list and only loaded
     * on demand.
     *
     * @param Criteria $criteria object containing the columns to add.
     * @param string   $alias    optional table alias
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function addSelectColumns(Criteria $criteria, $alias = null)
    {
        if (null === $alias) {
            $criteria->addSelectColumn(LyricTableMap::COL_ID);
            $criteria->addSelectColumn(LyricTableMap::COL_ZAGLAVIE_PALNO);
            $criteria->addSelectColumn(LyricTableMap::COL_ZAGLAVIE_SAKRATENO);
            $criteria->addSelectColumn(LyricTableMap::COL_UP_ID);
            $criteria->addSelectColumn(LyricTableMap::COL_TEXT);
            $criteria->addSelectColumn(LyricTableMap::COL_TEXT_BG);
            $criteria->addSelectColumn(LyricTableMap::COL_ARTIST1);
            $criteria->addSelectColumn(LyricTableMap::COL_ARTIST2);
            $criteria->addSelectColumn(LyricTableMap::COL_ARTIST3);
            $criteria->addSelectColumn(LyricTableMap::COL_ARTIST4);
            $criteria->addSelectColumn(LyricTableMap::COL_ARTIST5);
            $criteria->addSelectColumn(LyricTableMap::COL_ARTIST6);
            $criteria->addSelectColumn(LyricTableMap::COL_TITLE);
            $criteria->addSelectColumn(LyricTableMap::COL_ALBUM1);
            $criteria->addSelectColumn(LyricTableMap::COL_ALBUM2);
            $criteria->addSelectColumn(LyricTableMap::COL_VIDEO);
            $criteria->addSelectColumn(LyricTableMap::COL_VIDEO_VBOX7);
            $criteria->addSelectColumn(LyricTableMap::COL_VIDEO_VBOX7_ORIG);
            $criteria->addSelectColumn(LyricTableMap::COL_VIDEO_YOUTUBE);
            $criteria->addSelectColumn(LyricTableMap::COL_VIDEO_YOUTUBE_ORIG);
            $criteria->addSelectColumn(LyricTableMap::COL_VIDEO_METACAFE);
            $criteria->addSelectColumn(LyricTableMap::COL_VIDEO_METACAFE_ORIG);
            $criteria->addSelectColumn(LyricTableMap::COL_DOWNLOAD);
            $criteria->addSelectColumn(LyricTableMap::COL_IMAGE);
            $criteria->addSelectColumn(LyricTableMap::COL_PODNOVENA);
            $criteria->addSelectColumn(LyricTableMap::COL_IP_UPLOAD);
            $criteria->addSelectColumn(LyricTableMap::COL_DOPYLNITELNOINFO);
            $criteria->addSelectColumn(LyricTableMap::COL_GLASA);
            $criteria->addSelectColumn(LyricTableMap::COL_VIDQNA);
            $criteria->addSelectColumn(LyricTableMap::COL_POPULQRNOST);
            $criteria->addSelectColumn(LyricTableMap::COL_STILRAPHIPHOP);
            $criteria->addSelectColumn(LyricTableMap::COL_STILHIPHOP);
            $criteria->addSelectColumn(LyricTableMap::COL_STILEASTCOAST);
            $criteria->addSelectColumn(LyricTableMap::COL_PEE_SE_NA);
            $criteria->addSelectColumn(LyricTableMap::COL_STILSKIT);
            $criteria->addSelectColumn(LyricTableMap::COL_STILELEKTRONNA);
            $criteria->addSelectColumn(LyricTableMap::COL_STILROK);
            $criteria->addSelectColumn(LyricTableMap::COL_STILROK_CLAS);
            $criteria->addSelectColumn(LyricTableMap::COL_STILROK_ALT);
            $criteria->addSelectColumn(LyricTableMap::COL_STILROK_HARD);
            $criteria->addSelectColumn(LyricTableMap::COL_STILDISKO);
            $criteria->addSelectColumn(LyricTableMap::COL_STILLATAM);
            $criteria->addSelectColumn(LyricTableMap::COL_STILSAMBA);
            $criteria->addSelectColumn(LyricTableMap::COL_STILTANGO);
            $criteria->addSelectColumn(LyricTableMap::COL_STILSALSA);
            $criteria->addSelectColumn(LyricTableMap::COL_STILKLASI);
            $criteria->addSelectColumn(LyricTableMap::COL_STILDETSKI);
            $criteria->addSelectColumn(LyricTableMap::COL_STILFOLK);
            $criteria->addSelectColumn(LyricTableMap::COL_STILNARODNA);
            $criteria->addSelectColumn(LyricTableMap::COL_STILCHALGA);
            $criteria->addSelectColumn(LyricTableMap::COL_STILPOPFOLK);
            $criteria->addSelectColumn(LyricTableMap::COL_STILMETAL);
            $criteria->addSelectColumn(LyricTableMap::COL_STILMETAL_HEAVY);
            $criteria->addSelectColumn(LyricTableMap::COL_STILMETAL_POWER);
            $criteria->addSelectColumn(LyricTableMap::COL_STILMETAL_DEATH);
            $criteria->addSelectColumn(LyricTableMap::COL_STILMETAL_NU);
            $criteria->addSelectColumn(LyricTableMap::COL_STILMETAL_GOTHIC);
            $criteria->addSelectColumn(LyricTableMap::COL_STILMETAL_SYMPHONIC);
            $criteria->addSelectColumn(LyricTableMap::COL_STILSOUNDTRACK);
            $criteria->addSelectColumn(LyricTableMap::COL_STILDANCE);
            $criteria->addSelectColumn(LyricTableMap::COL_STILRNB);
            $criteria->addSelectColumn(LyricTableMap::COL_STILSOUL);
            $criteria->addSelectColumn(LyricTableMap::COL_STILNEW_RAVE);
            $criteria->addSelectColumn(LyricTableMap::COL_STILREGGAE);
            $criteria->addSelectColumn(LyricTableMap::COL_STILKANTRI);
            $criteria->addSelectColumn(LyricTableMap::COL_STILPUNK);
            $criteria->addSelectColumn(LyricTableMap::COL_STILEMO);
            $criteria->addSelectColumn(LyricTableMap::COL_STILBREAKBEAT);
            $criteria->addSelectColumn(LyricTableMap::COL_STILBIGBEAT);
            $criteria->addSelectColumn(LyricTableMap::COL_STILJAZ);
            $criteria->addSelectColumn(LyricTableMap::COL_STILBLUS);
            $criteria->addSelectColumn(LyricTableMap::COL_STILELECTRONICA);
            $criteria->addSelectColumn(LyricTableMap::COL_STILSKA);
        } else {
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.zaglavie_palno');
            $criteria->addSelectColumn($alias . '.zaglavie_sakrateno');
            $criteria->addSelectColumn($alias . '.up_id');
            $criteria->addSelectColumn($alias . '.text');
            $criteria->addSelectColumn($alias . '.text_bg');
            $criteria->addSelectColumn($alias . '.artist1');
            $criteria->addSelectColumn($alias . '.artist2');
            $criteria->addSelectColumn($alias . '.artist3');
            $criteria->addSelectColumn($alias . '.artist4');
            $criteria->addSelectColumn($alias . '.artist5');
            $criteria->addSelectColumn($alias . '.artist6');
            $criteria->addSelectColumn($alias . '.title');
            $criteria->addSelectColumn($alias . '.album1');
            $criteria->addSelectColumn($alias . '.album2');
            $criteria->addSelectColumn($alias . '.video');
            $criteria->addSelectColumn($alias . '.video_vbox7');
            $criteria->addSelectColumn($alias . '.video_vbox7_orig');
            $criteria->addSelectColumn($alias . '.video_youtube');
            $criteria->addSelectColumn($alias . '.video_youtube_orig');
            $criteria->addSelectColumn($alias . '.video_metacafe');
            $criteria->addSelectColumn($alias . '.video_metacafe_orig');
            $criteria->addSelectColumn($alias . '.download');
            $criteria->addSelectColumn($alias . '.image');
            $criteria->addSelectColumn($alias . '.podnovena');
            $criteria->addSelectColumn($alias . '.ip_upload');
            $criteria->addSelectColumn($alias . '.dopylnitelnoinfo');
            $criteria->addSelectColumn($alias . '.glasa');
            $criteria->addSelectColumn($alias . '.vidqna');
            $criteria->addSelectColumn($alias . '.populqrnost');
            $criteria->addSelectColumn($alias . '.stilraphiphop');
            $criteria->addSelectColumn($alias . '.stilhiphop');
            $criteria->addSelectColumn($alias . '.stileastcoast');
            $criteria->addSelectColumn($alias . '.pee_se_na');
            $criteria->addSelectColumn($alias . '.stilskit');
            $criteria->addSelectColumn($alias . '.stilelektronna');
            $criteria->addSelectColumn($alias . '.stilrok');
            $criteria->addSelectColumn($alias . '.stilrok_clas');
            $criteria->addSelectColumn($alias . '.stilrok_alt');
            $criteria->addSelectColumn($alias . '.stilrok_hard');
            $criteria->addSelectColumn($alias . '.stildisko');
            $criteria->addSelectColumn($alias . '.stillatam');
            $criteria->addSelectColumn($alias . '.stilsamba');
            $criteria->addSelectColumn($alias . '.stiltango');
            $criteria->addSelectColumn($alias . '.stilsalsa');
            $criteria->addSelectColumn($alias . '.stilklasi');
            $criteria->addSelectColumn($alias . '.stildetski');
            $criteria->addSelectColumn($alias . '.stilfolk');
            $criteria->addSelectColumn($alias . '.stilnarodna');
            $criteria->addSelectColumn($alias . '.stilchalga');
            $criteria->addSelectColumn($alias . '.stilpopfolk');
            $criteria->addSelectColumn($alias . '.stilmetal');
            $criteria->addSelectColumn($alias . '.stilmetal_heavy');
            $criteria->addSelectColumn($alias . '.stilmetal_power');
            $criteria->addSelectColumn($alias . '.stilmetal_death');
            $criteria->addSelectColumn($alias . '.stilmetal_nu');
            $criteria->addSelectColumn($alias . '.stilmetal_gothic');
            $criteria->addSelectColumn($alias . '.stilmetal_symphonic');
            $criteria->addSelectColumn($alias . '.stilsoundtrack');
            $criteria->addSelectColumn($alias . '.stildance');
            $criteria->addSelectColumn($alias . '.stilRnB');
            $criteria->addSelectColumn($alias . '.stilsoul');
            $criteria->addSelectColumn($alias . '.stilnew_rave');
            $criteria->addSelectColumn($alias . '.stilreggae');
            $criteria->addSelectColumn($alias . '.stilkantri');
            $criteria->addSelectColumn($alias . '.stilpunk');
            $criteria->addSelectColumn($alias . '.stilemo');
            $criteria->addSelectColumn($alias . '.stilbreakbeat');
            $criteria->addSelectColumn($alias . '.stilbigbeat');
            $criteria->addSelectColumn($alias . '.stiljaz');
            $criteria->addSelectColumn($alias . '.stilblus');
            $criteria->addSelectColumn($alias . '.stilelectronica');
            $criteria->addSelectColumn($alias . '.stilska');
        }
    }

    /**
     * Returns the TableMap related to this object.
     * This method is not needed for general use but a specific application could have a need.
     * @return TableMap
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function getTableMap()
    {
        return Propel::getServiceContainer()->getDatabaseMap(LyricTableMap::DATABASE_NAME)->getTable(LyricTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(LyricTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(LyricTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new LyricTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a Lyric or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or Lyric object or primary key or array of primary keys
     *              which is used to create the DELETE statement
     * @param  ConnectionInterface $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
     public static function doDelete($values, ConnectionInterface $con = null)
     {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(LyricTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Tekstove\TekstoveBundle\Model\Entity\Lyric) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(LyricTableMap::DATABASE_NAME);
            $criteria->add(LyricTableMap::COL_ID, (array) $values, Criteria::IN);
        }

        $query = LyricQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            LyricTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                LyricTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the lyric table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return LyricQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Lyric or Criteria object.
     *
     * @param mixed               $criteria Criteria or Lyric object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(LyricTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Lyric object
        }

        if ($criteria->containsKey(LyricTableMap::COL_ID) && $criteria->keyContainsValue(LyricTableMap::COL_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.LyricTableMap::COL_ID.')');
        }


        // Set the correct dbName
        $query = LyricQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // LyricTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
LyricTableMap::buildTableMap();
