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
use Tekstove\TekstoveBundle\Model\Entity\Album;
use Tekstove\TekstoveBundle\Model\Entity\AlbumQuery;


/**
 * This class defines the structure of the 'albums' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class AlbumTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'Tekstove.TekstoveBundle.Model.Entity.Map.AlbumTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'albums';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\Tekstove\\TekstoveBundle\\Model\\Entity\\Album';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'Tekstove.TekstoveBundle.Model.Entity.Album';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 80;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 80;

    /**
     * the column name for the id field
     */
    const COL_ID = 'albums.id';

    /**
     * the column name for the name field
     */
    const COL_NAME = 'albums.name';

    /**
     * the column name for the artist1id field
     */
    const COL_ARTIST1ID = 'albums.artist1id';

    /**
     * the column name for the artist2id field
     */
    const COL_ARTIST2ID = 'albums.artist2id';

    /**
     * the column name for the dopylnitelnoinfo field
     */
    const COL_DOPYLNITELNOINFO = 'albums.dopylnitelnoinfo';

    /**
     * the column name for the year field
     */
    const COL_YEAR = 'albums.year';

    /**
     * the column name for the image field
     */
    const COL_IMAGE = 'albums.image';

    /**
     * the column name for the vid field
     */
    const COL_VID = 'albums.vid';

    /**
     * the column name for the up_id field
     */
    const COL_UP_ID = 'albums.up_id';

    /**
     * the column name for the va field
     */
    const COL_VA = 'albums.va';

    /**
     * the column name for the p1 field
     */
    const COL_P1 = 'albums.p1';

    /**
     * the column name for the p2 field
     */
    const COL_P2 = 'albums.p2';

    /**
     * the column name for the p3 field
     */
    const COL_P3 = 'albums.p3';

    /**
     * the column name for the p4 field
     */
    const COL_P4 = 'albums.p4';

    /**
     * the column name for the p5 field
     */
    const COL_P5 = 'albums.p5';

    /**
     * the column name for the p6 field
     */
    const COL_P6 = 'albums.p6';

    /**
     * the column name for the p7 field
     */
    const COL_P7 = 'albums.p7';

    /**
     * the column name for the p8 field
     */
    const COL_P8 = 'albums.p8';

    /**
     * the column name for the p9 field
     */
    const COL_P9 = 'albums.p9';

    /**
     * the column name for the p10 field
     */
    const COL_P10 = 'albums.p10';

    /**
     * the column name for the p11 field
     */
    const COL_P11 = 'albums.p11';

    /**
     * the column name for the p12 field
     */
    const COL_P12 = 'albums.p12';

    /**
     * the column name for the p13 field
     */
    const COL_P13 = 'albums.p13';

    /**
     * the column name for the p14 field
     */
    const COL_P14 = 'albums.p14';

    /**
     * the column name for the p15 field
     */
    const COL_P15 = 'albums.p15';

    /**
     * the column name for the p16 field
     */
    const COL_P16 = 'albums.p16';

    /**
     * the column name for the p17 field
     */
    const COL_P17 = 'albums.p17';

    /**
     * the column name for the p18 field
     */
    const COL_P18 = 'albums.p18';

    /**
     * the column name for the p19 field
     */
    const COL_P19 = 'albums.p19';

    /**
     * the column name for the p20 field
     */
    const COL_P20 = 'albums.p20';

    /**
     * the column name for the p21 field
     */
    const COL_P21 = 'albums.p21';

    /**
     * the column name for the p22 field
     */
    const COL_P22 = 'albums.p22';

    /**
     * the column name for the p23 field
     */
    const COL_P23 = 'albums.p23';

    /**
     * the column name for the p24 field
     */
    const COL_P24 = 'albums.p24';

    /**
     * the column name for the p25 field
     */
    const COL_P25 = 'albums.p25';

    /**
     * the column name for the p26 field
     */
    const COL_P26 = 'albums.p26';

    /**
     * the column name for the p27 field
     */
    const COL_P27 = 'albums.p27';

    /**
     * the column name for the p28 field
     */
    const COL_P28 = 'albums.p28';

    /**
     * the column name for the p29 field
     */
    const COL_P29 = 'albums.p29';

    /**
     * the column name for the p30 field
     */
    const COL_P30 = 'albums.p30';

    /**
     * the column name for the p31 field
     */
    const COL_P31 = 'albums.p31';

    /**
     * the column name for the p32 field
     */
    const COL_P32 = 'albums.p32';

    /**
     * the column name for the p33 field
     */
    const COL_P33 = 'albums.p33';

    /**
     * the column name for the p34 field
     */
    const COL_P34 = 'albums.p34';

    /**
     * the column name for the p35 field
     */
    const COL_P35 = 'albums.p35';

    /**
     * the column name for the p1n field
     */
    const COL_P1N = 'albums.p1n';

    /**
     * the column name for the p2n field
     */
    const COL_P2N = 'albums.p2n';

    /**
     * the column name for the p3n field
     */
    const COL_P3N = 'albums.p3n';

    /**
     * the column name for the p4n field
     */
    const COL_P4N = 'albums.p4n';

    /**
     * the column name for the p5n field
     */
    const COL_P5N = 'albums.p5n';

    /**
     * the column name for the p6n field
     */
    const COL_P6N = 'albums.p6n';

    /**
     * the column name for the p7n field
     */
    const COL_P7N = 'albums.p7n';

    /**
     * the column name for the p8n field
     */
    const COL_P8N = 'albums.p8n';

    /**
     * the column name for the p9n field
     */
    const COL_P9N = 'albums.p9n';

    /**
     * the column name for the p10n field
     */
    const COL_P10N = 'albums.p10n';

    /**
     * the column name for the p11n field
     */
    const COL_P11N = 'albums.p11n';

    /**
     * the column name for the p12n field
     */
    const COL_P12N = 'albums.p12n';

    /**
     * the column name for the p13n field
     */
    const COL_P13N = 'albums.p13n';

    /**
     * the column name for the p14n field
     */
    const COL_P14N = 'albums.p14n';

    /**
     * the column name for the p15n field
     */
    const COL_P15N = 'albums.p15n';

    /**
     * the column name for the p16n field
     */
    const COL_P16N = 'albums.p16n';

    /**
     * the column name for the p17n field
     */
    const COL_P17N = 'albums.p17n';

    /**
     * the column name for the p18n field
     */
    const COL_P18N = 'albums.p18n';

    /**
     * the column name for the p19n field
     */
    const COL_P19N = 'albums.p19n';

    /**
     * the column name for the p20n field
     */
    const COL_P20N = 'albums.p20n';

    /**
     * the column name for the p21n field
     */
    const COL_P21N = 'albums.p21n';

    /**
     * the column name for the p22n field
     */
    const COL_P22N = 'albums.p22n';

    /**
     * the column name for the p23n field
     */
    const COL_P23N = 'albums.p23n';

    /**
     * the column name for the p24n field
     */
    const COL_P24N = 'albums.p24n';

    /**
     * the column name for the p25n field
     */
    const COL_P25N = 'albums.p25n';

    /**
     * the column name for the p26n field
     */
    const COL_P26N = 'albums.p26n';

    /**
     * the column name for the p27n field
     */
    const COL_P27N = 'albums.p27n';

    /**
     * the column name for the p28n field
     */
    const COL_P28N = 'albums.p28n';

    /**
     * the column name for the p29n field
     */
    const COL_P29N = 'albums.p29n';

    /**
     * the column name for the p30n field
     */
    const COL_P30N = 'albums.p30n';

    /**
     * the column name for the p31n field
     */
    const COL_P31N = 'albums.p31n';

    /**
     * the column name for the p32n field
     */
    const COL_P32N = 'albums.p32n';

    /**
     * the column name for the p33n field
     */
    const COL_P33N = 'albums.p33n';

    /**
     * the column name for the p34n field
     */
    const COL_P34N = 'albums.p34n';

    /**
     * the column name for the p35n field
     */
    const COL_P35N = 'albums.p35n';

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
        self::TYPE_PHPNAME       => array('Id', 'Name', 'Artist1id', 'Artist2id', 'Dopylnitelnoinfo', 'Year', 'Image', 'Vid', 'UpId', 'Va', 'P1', 'P2', 'P3', 'P4', 'P5', 'P6', 'P7', 'P8', 'P9', 'P10', 'P11', 'P12', 'P13', 'P14', 'P15', 'P16', 'P17', 'P18', 'P19', 'P20', 'P21', 'P22', 'P23', 'P24', 'P25', 'P26', 'P27', 'P28', 'P29', 'P30', 'P31', 'P32', 'P33', 'P34', 'P35', 'P1n', 'P2n', 'P3n', 'P4n', 'P5n', 'P6n', 'P7n', 'P8n', 'P9n', 'P10n', 'P11n', 'P12n', 'P13n', 'P14n', 'P15n', 'P16n', 'P17n', 'P18n', 'P19n', 'P20n', 'P21n', 'P22n', 'P23n', 'P24n', 'P25n', 'P26n', 'P27n', 'P28n', 'P29n', 'P30n', 'P31n', 'P32n', 'P33n', 'P34n', 'P35n', ),
        self::TYPE_CAMELNAME     => array('id', 'name', 'artist1id', 'artist2id', 'dopylnitelnoinfo', 'year', 'image', 'vid', 'upId', 'va', 'p1', 'p2', 'p3', 'p4', 'p5', 'p6', 'p7', 'p8', 'p9', 'p10', 'p11', 'p12', 'p13', 'p14', 'p15', 'p16', 'p17', 'p18', 'p19', 'p20', 'p21', 'p22', 'p23', 'p24', 'p25', 'p26', 'p27', 'p28', 'p29', 'p30', 'p31', 'p32', 'p33', 'p34', 'p35', 'p1n', 'p2n', 'p3n', 'p4n', 'p5n', 'p6n', 'p7n', 'p8n', 'p9n', 'p10n', 'p11n', 'p12n', 'p13n', 'p14n', 'p15n', 'p16n', 'p17n', 'p18n', 'p19n', 'p20n', 'p21n', 'p22n', 'p23n', 'p24n', 'p25n', 'p26n', 'p27n', 'p28n', 'p29n', 'p30n', 'p31n', 'p32n', 'p33n', 'p34n', 'p35n', ),
        self::TYPE_COLNAME       => array(AlbumTableMap::COL_ID, AlbumTableMap::COL_NAME, AlbumTableMap::COL_ARTIST1ID, AlbumTableMap::COL_ARTIST2ID, AlbumTableMap::COL_DOPYLNITELNOINFO, AlbumTableMap::COL_YEAR, AlbumTableMap::COL_IMAGE, AlbumTableMap::COL_VID, AlbumTableMap::COL_UP_ID, AlbumTableMap::COL_VA, AlbumTableMap::COL_P1, AlbumTableMap::COL_P2, AlbumTableMap::COL_P3, AlbumTableMap::COL_P4, AlbumTableMap::COL_P5, AlbumTableMap::COL_P6, AlbumTableMap::COL_P7, AlbumTableMap::COL_P8, AlbumTableMap::COL_P9, AlbumTableMap::COL_P10, AlbumTableMap::COL_P11, AlbumTableMap::COL_P12, AlbumTableMap::COL_P13, AlbumTableMap::COL_P14, AlbumTableMap::COL_P15, AlbumTableMap::COL_P16, AlbumTableMap::COL_P17, AlbumTableMap::COL_P18, AlbumTableMap::COL_P19, AlbumTableMap::COL_P20, AlbumTableMap::COL_P21, AlbumTableMap::COL_P22, AlbumTableMap::COL_P23, AlbumTableMap::COL_P24, AlbumTableMap::COL_P25, AlbumTableMap::COL_P26, AlbumTableMap::COL_P27, AlbumTableMap::COL_P28, AlbumTableMap::COL_P29, AlbumTableMap::COL_P30, AlbumTableMap::COL_P31, AlbumTableMap::COL_P32, AlbumTableMap::COL_P33, AlbumTableMap::COL_P34, AlbumTableMap::COL_P35, AlbumTableMap::COL_P1N, AlbumTableMap::COL_P2N, AlbumTableMap::COL_P3N, AlbumTableMap::COL_P4N, AlbumTableMap::COL_P5N, AlbumTableMap::COL_P6N, AlbumTableMap::COL_P7N, AlbumTableMap::COL_P8N, AlbumTableMap::COL_P9N, AlbumTableMap::COL_P10N, AlbumTableMap::COL_P11N, AlbumTableMap::COL_P12N, AlbumTableMap::COL_P13N, AlbumTableMap::COL_P14N, AlbumTableMap::COL_P15N, AlbumTableMap::COL_P16N, AlbumTableMap::COL_P17N, AlbumTableMap::COL_P18N, AlbumTableMap::COL_P19N, AlbumTableMap::COL_P20N, AlbumTableMap::COL_P21N, AlbumTableMap::COL_P22N, AlbumTableMap::COL_P23N, AlbumTableMap::COL_P24N, AlbumTableMap::COL_P25N, AlbumTableMap::COL_P26N, AlbumTableMap::COL_P27N, AlbumTableMap::COL_P28N, AlbumTableMap::COL_P29N, AlbumTableMap::COL_P30N, AlbumTableMap::COL_P31N, AlbumTableMap::COL_P32N, AlbumTableMap::COL_P33N, AlbumTableMap::COL_P34N, AlbumTableMap::COL_P35N, ),
        self::TYPE_FIELDNAME     => array('id', 'name', 'artist1id', 'artist2id', 'dopylnitelnoinfo', 'year', 'image', 'vid', 'up_id', 'va', 'p1', 'p2', 'p3', 'p4', 'p5', 'p6', 'p7', 'p8', 'p9', 'p10', 'p11', 'p12', 'p13', 'p14', 'p15', 'p16', 'p17', 'p18', 'p19', 'p20', 'p21', 'p22', 'p23', 'p24', 'p25', 'p26', 'p27', 'p28', 'p29', 'p30', 'p31', 'p32', 'p33', 'p34', 'p35', 'p1n', 'p2n', 'p3n', 'p4n', 'p5n', 'p6n', 'p7n', 'p8n', 'p9n', 'p10n', 'p11n', 'p12n', 'p13n', 'p14n', 'p15n', 'p16n', 'p17n', 'p18n', 'p19n', 'p20n', 'p21n', 'p22n', 'p23n', 'p24n', 'p25n', 'p26n', 'p27n', 'p28n', 'p29n', 'p30n', 'p31n', 'p32n', 'p33n', 'p34n', 'p35n', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 36, 37, 38, 39, 40, 41, 42, 43, 44, 45, 46, 47, 48, 49, 50, 51, 52, 53, 54, 55, 56, 57, 58, 59, 60, 61, 62, 63, 64, 65, 66, 67, 68, 69, 70, 71, 72, 73, 74, 75, 76, 77, 78, 79, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Id' => 0, 'Name' => 1, 'Artist1id' => 2, 'Artist2id' => 3, 'Dopylnitelnoinfo' => 4, 'Year' => 5, 'Image' => 6, 'Vid' => 7, 'UpId' => 8, 'Va' => 9, 'P1' => 10, 'P2' => 11, 'P3' => 12, 'P4' => 13, 'P5' => 14, 'P6' => 15, 'P7' => 16, 'P8' => 17, 'P9' => 18, 'P10' => 19, 'P11' => 20, 'P12' => 21, 'P13' => 22, 'P14' => 23, 'P15' => 24, 'P16' => 25, 'P17' => 26, 'P18' => 27, 'P19' => 28, 'P20' => 29, 'P21' => 30, 'P22' => 31, 'P23' => 32, 'P24' => 33, 'P25' => 34, 'P26' => 35, 'P27' => 36, 'P28' => 37, 'P29' => 38, 'P30' => 39, 'P31' => 40, 'P32' => 41, 'P33' => 42, 'P34' => 43, 'P35' => 44, 'P1n' => 45, 'P2n' => 46, 'P3n' => 47, 'P4n' => 48, 'P5n' => 49, 'P6n' => 50, 'P7n' => 51, 'P8n' => 52, 'P9n' => 53, 'P10n' => 54, 'P11n' => 55, 'P12n' => 56, 'P13n' => 57, 'P14n' => 58, 'P15n' => 59, 'P16n' => 60, 'P17n' => 61, 'P18n' => 62, 'P19n' => 63, 'P20n' => 64, 'P21n' => 65, 'P22n' => 66, 'P23n' => 67, 'P24n' => 68, 'P25n' => 69, 'P26n' => 70, 'P27n' => 71, 'P28n' => 72, 'P29n' => 73, 'P30n' => 74, 'P31n' => 75, 'P32n' => 76, 'P33n' => 77, 'P34n' => 78, 'P35n' => 79, ),
        self::TYPE_CAMELNAME     => array('id' => 0, 'name' => 1, 'artist1id' => 2, 'artist2id' => 3, 'dopylnitelnoinfo' => 4, 'year' => 5, 'image' => 6, 'vid' => 7, 'upId' => 8, 'va' => 9, 'p1' => 10, 'p2' => 11, 'p3' => 12, 'p4' => 13, 'p5' => 14, 'p6' => 15, 'p7' => 16, 'p8' => 17, 'p9' => 18, 'p10' => 19, 'p11' => 20, 'p12' => 21, 'p13' => 22, 'p14' => 23, 'p15' => 24, 'p16' => 25, 'p17' => 26, 'p18' => 27, 'p19' => 28, 'p20' => 29, 'p21' => 30, 'p22' => 31, 'p23' => 32, 'p24' => 33, 'p25' => 34, 'p26' => 35, 'p27' => 36, 'p28' => 37, 'p29' => 38, 'p30' => 39, 'p31' => 40, 'p32' => 41, 'p33' => 42, 'p34' => 43, 'p35' => 44, 'p1n' => 45, 'p2n' => 46, 'p3n' => 47, 'p4n' => 48, 'p5n' => 49, 'p6n' => 50, 'p7n' => 51, 'p8n' => 52, 'p9n' => 53, 'p10n' => 54, 'p11n' => 55, 'p12n' => 56, 'p13n' => 57, 'p14n' => 58, 'p15n' => 59, 'p16n' => 60, 'p17n' => 61, 'p18n' => 62, 'p19n' => 63, 'p20n' => 64, 'p21n' => 65, 'p22n' => 66, 'p23n' => 67, 'p24n' => 68, 'p25n' => 69, 'p26n' => 70, 'p27n' => 71, 'p28n' => 72, 'p29n' => 73, 'p30n' => 74, 'p31n' => 75, 'p32n' => 76, 'p33n' => 77, 'p34n' => 78, 'p35n' => 79, ),
        self::TYPE_COLNAME       => array(AlbumTableMap::COL_ID => 0, AlbumTableMap::COL_NAME => 1, AlbumTableMap::COL_ARTIST1ID => 2, AlbumTableMap::COL_ARTIST2ID => 3, AlbumTableMap::COL_DOPYLNITELNOINFO => 4, AlbumTableMap::COL_YEAR => 5, AlbumTableMap::COL_IMAGE => 6, AlbumTableMap::COL_VID => 7, AlbumTableMap::COL_UP_ID => 8, AlbumTableMap::COL_VA => 9, AlbumTableMap::COL_P1 => 10, AlbumTableMap::COL_P2 => 11, AlbumTableMap::COL_P3 => 12, AlbumTableMap::COL_P4 => 13, AlbumTableMap::COL_P5 => 14, AlbumTableMap::COL_P6 => 15, AlbumTableMap::COL_P7 => 16, AlbumTableMap::COL_P8 => 17, AlbumTableMap::COL_P9 => 18, AlbumTableMap::COL_P10 => 19, AlbumTableMap::COL_P11 => 20, AlbumTableMap::COL_P12 => 21, AlbumTableMap::COL_P13 => 22, AlbumTableMap::COL_P14 => 23, AlbumTableMap::COL_P15 => 24, AlbumTableMap::COL_P16 => 25, AlbumTableMap::COL_P17 => 26, AlbumTableMap::COL_P18 => 27, AlbumTableMap::COL_P19 => 28, AlbumTableMap::COL_P20 => 29, AlbumTableMap::COL_P21 => 30, AlbumTableMap::COL_P22 => 31, AlbumTableMap::COL_P23 => 32, AlbumTableMap::COL_P24 => 33, AlbumTableMap::COL_P25 => 34, AlbumTableMap::COL_P26 => 35, AlbumTableMap::COL_P27 => 36, AlbumTableMap::COL_P28 => 37, AlbumTableMap::COL_P29 => 38, AlbumTableMap::COL_P30 => 39, AlbumTableMap::COL_P31 => 40, AlbumTableMap::COL_P32 => 41, AlbumTableMap::COL_P33 => 42, AlbumTableMap::COL_P34 => 43, AlbumTableMap::COL_P35 => 44, AlbumTableMap::COL_P1N => 45, AlbumTableMap::COL_P2N => 46, AlbumTableMap::COL_P3N => 47, AlbumTableMap::COL_P4N => 48, AlbumTableMap::COL_P5N => 49, AlbumTableMap::COL_P6N => 50, AlbumTableMap::COL_P7N => 51, AlbumTableMap::COL_P8N => 52, AlbumTableMap::COL_P9N => 53, AlbumTableMap::COL_P10N => 54, AlbumTableMap::COL_P11N => 55, AlbumTableMap::COL_P12N => 56, AlbumTableMap::COL_P13N => 57, AlbumTableMap::COL_P14N => 58, AlbumTableMap::COL_P15N => 59, AlbumTableMap::COL_P16N => 60, AlbumTableMap::COL_P17N => 61, AlbumTableMap::COL_P18N => 62, AlbumTableMap::COL_P19N => 63, AlbumTableMap::COL_P20N => 64, AlbumTableMap::COL_P21N => 65, AlbumTableMap::COL_P22N => 66, AlbumTableMap::COL_P23N => 67, AlbumTableMap::COL_P24N => 68, AlbumTableMap::COL_P25N => 69, AlbumTableMap::COL_P26N => 70, AlbumTableMap::COL_P27N => 71, AlbumTableMap::COL_P28N => 72, AlbumTableMap::COL_P29N => 73, AlbumTableMap::COL_P30N => 74, AlbumTableMap::COL_P31N => 75, AlbumTableMap::COL_P32N => 76, AlbumTableMap::COL_P33N => 77, AlbumTableMap::COL_P34N => 78, AlbumTableMap::COL_P35N => 79, ),
        self::TYPE_FIELDNAME     => array('id' => 0, 'name' => 1, 'artist1id' => 2, 'artist2id' => 3, 'dopylnitelnoinfo' => 4, 'year' => 5, 'image' => 6, 'vid' => 7, 'up_id' => 8, 'va' => 9, 'p1' => 10, 'p2' => 11, 'p3' => 12, 'p4' => 13, 'p5' => 14, 'p6' => 15, 'p7' => 16, 'p8' => 17, 'p9' => 18, 'p10' => 19, 'p11' => 20, 'p12' => 21, 'p13' => 22, 'p14' => 23, 'p15' => 24, 'p16' => 25, 'p17' => 26, 'p18' => 27, 'p19' => 28, 'p20' => 29, 'p21' => 30, 'p22' => 31, 'p23' => 32, 'p24' => 33, 'p25' => 34, 'p26' => 35, 'p27' => 36, 'p28' => 37, 'p29' => 38, 'p30' => 39, 'p31' => 40, 'p32' => 41, 'p33' => 42, 'p34' => 43, 'p35' => 44, 'p1n' => 45, 'p2n' => 46, 'p3n' => 47, 'p4n' => 48, 'p5n' => 49, 'p6n' => 50, 'p7n' => 51, 'p8n' => 52, 'p9n' => 53, 'p10n' => 54, 'p11n' => 55, 'p12n' => 56, 'p13n' => 57, 'p14n' => 58, 'p15n' => 59, 'p16n' => 60, 'p17n' => 61, 'p18n' => 62, 'p19n' => 63, 'p20n' => 64, 'p21n' => 65, 'p22n' => 66, 'p23n' => 67, 'p24n' => 68, 'p25n' => 69, 'p26n' => 70, 'p27n' => 71, 'p28n' => 72, 'p29n' => 73, 'p30n' => 74, 'p31n' => 75, 'p32n' => 76, 'p33n' => 77, 'p34n' => 78, 'p35n' => 79, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 36, 37, 38, 39, 40, 41, 42, 43, 44, 45, 46, 47, 48, 49, 50, 51, 52, 53, 54, 55, 56, 57, 58, 59, 60, 61, 62, 63, 64, 65, 66, 67, 68, 69, 70, 71, 72, 73, 74, 75, 76, 77, 78, 79, )
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
        $this->setName('albums');
        $this->setPhpName('Album');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Tekstove\\TekstoveBundle\\Model\\Entity\\Album');
        $this->setPackage('Tekstove.TekstoveBundle.Model.Entity');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('name', 'Name', 'VARCHAR', true, 40, null);
        $this->addColumn('artist1id', 'Artist1id', 'INTEGER', true, null, null);
        $this->addColumn('artist2id', 'Artist2id', 'INTEGER', true, null, null);
        $this->addColumn('dopylnitelnoinfo', 'Dopylnitelnoinfo', 'LONGVARCHAR', true, null, null);
        $this->addColumn('year', 'Year', 'INTEGER', true, 6, null);
        $this->addColumn('image', 'Image', 'VARCHAR', true, 100, null);
        $this->addColumn('vid', 'Vid', 'TINYINT', true, 3, null);
        $this->addColumn('up_id', 'UpId', 'INTEGER', true, null, null);
        $this->addColumn('va', 'Va', 'BOOLEAN', true, 1, null);
        $this->addColumn('p1', 'P1', 'INTEGER', true, null, null);
        $this->addColumn('p2', 'P2', 'INTEGER', true, null, null);
        $this->addColumn('p3', 'P3', 'INTEGER', true, null, null);
        $this->addColumn('p4', 'P4', 'INTEGER', true, null, null);
        $this->addColumn('p5', 'P5', 'INTEGER', true, null, null);
        $this->addColumn('p6', 'P6', 'INTEGER', true, null, null);
        $this->addColumn('p7', 'P7', 'INTEGER', true, null, null);
        $this->addColumn('p8', 'P8', 'INTEGER', true, null, null);
        $this->addColumn('p9', 'P9', 'INTEGER', true, null, null);
        $this->addColumn('p10', 'P10', 'INTEGER', true, null, null);
        $this->addColumn('p11', 'P11', 'INTEGER', true, null, null);
        $this->addColumn('p12', 'P12', 'INTEGER', true, null, null);
        $this->addColumn('p13', 'P13', 'INTEGER', true, null, null);
        $this->addColumn('p14', 'P14', 'INTEGER', true, null, null);
        $this->addColumn('p15', 'P15', 'INTEGER', true, null, null);
        $this->addColumn('p16', 'P16', 'INTEGER', true, null, null);
        $this->addColumn('p17', 'P17', 'INTEGER', true, null, null);
        $this->addColumn('p18', 'P18', 'INTEGER', true, null, null);
        $this->addColumn('p19', 'P19', 'INTEGER', true, null, null);
        $this->addColumn('p20', 'P20', 'INTEGER', true, null, null);
        $this->addColumn('p21', 'P21', 'INTEGER', true, null, null);
        $this->addColumn('p22', 'P22', 'INTEGER', true, null, null);
        $this->addColumn('p23', 'P23', 'INTEGER', true, null, null);
        $this->addColumn('p24', 'P24', 'INTEGER', true, null, null);
        $this->addColumn('p25', 'P25', 'INTEGER', true, null, null);
        $this->addColumn('p26', 'P26', 'INTEGER', true, null, null);
        $this->addColumn('p27', 'P27', 'INTEGER', true, null, null);
        $this->addColumn('p28', 'P28', 'INTEGER', true, null, null);
        $this->addColumn('p29', 'P29', 'INTEGER', true, null, null);
        $this->addColumn('p30', 'P30', 'INTEGER', true, null, null);
        $this->addColumn('p31', 'P31', 'INTEGER', true, null, null);
        $this->addColumn('p32', 'P32', 'INTEGER', true, null, null);
        $this->addColumn('p33', 'P33', 'INTEGER', true, null, null);
        $this->addColumn('p34', 'P34', 'INTEGER', true, null, null);
        $this->addColumn('p35', 'P35', 'INTEGER', true, null, null);
        $this->addColumn('p1n', 'P1n', 'VARCHAR', true, 60, null);
        $this->addColumn('p2n', 'P2n', 'VARCHAR', true, 60, null);
        $this->addColumn('p3n', 'P3n', 'VARCHAR', true, 60, null);
        $this->addColumn('p4n', 'P4n', 'VARCHAR', true, 60, null);
        $this->addColumn('p5n', 'P5n', 'VARCHAR', true, 60, null);
        $this->addColumn('p6n', 'P6n', 'VARCHAR', true, 60, null);
        $this->addColumn('p7n', 'P7n', 'VARCHAR', true, 60, null);
        $this->addColumn('p8n', 'P8n', 'VARCHAR', true, 60, null);
        $this->addColumn('p9n', 'P9n', 'VARCHAR', true, 60, null);
        $this->addColumn('p10n', 'P10n', 'VARCHAR', true, 60, null);
        $this->addColumn('p11n', 'P11n', 'VARCHAR', true, 60, null);
        $this->addColumn('p12n', 'P12n', 'VARCHAR', true, 60, null);
        $this->addColumn('p13n', 'P13n', 'VARCHAR', true, 60, null);
        $this->addColumn('p14n', 'P14n', 'VARCHAR', true, 60, null);
        $this->addColumn('p15n', 'P15n', 'VARCHAR', true, 60, null);
        $this->addColumn('p16n', 'P16n', 'VARCHAR', true, 60, null);
        $this->addColumn('p17n', 'P17n', 'VARCHAR', true, 60, null);
        $this->addColumn('p18n', 'P18n', 'VARCHAR', true, 60, null);
        $this->addColumn('p19n', 'P19n', 'VARCHAR', true, 60, null);
        $this->addColumn('p20n', 'P20n', 'VARCHAR', true, 60, null);
        $this->addColumn('p21n', 'P21n', 'VARCHAR', true, 60, null);
        $this->addColumn('p22n', 'P22n', 'VARCHAR', true, 60, null);
        $this->addColumn('p23n', 'P23n', 'VARCHAR', true, 60, null);
        $this->addColumn('p24n', 'P24n', 'VARCHAR', true, 60, null);
        $this->addColumn('p25n', 'P25n', 'VARCHAR', true, 60, null);
        $this->addColumn('p26n', 'P26n', 'VARCHAR', true, 60, null);
        $this->addColumn('p27n', 'P27n', 'VARCHAR', true, 60, null);
        $this->addColumn('p28n', 'P28n', 'VARCHAR', true, 60, null);
        $this->addColumn('p29n', 'P29n', 'VARCHAR', true, 60, null);
        $this->addColumn('p30n', 'P30n', 'VARCHAR', true, 60, null);
        $this->addColumn('p31n', 'P31n', 'VARCHAR', true, 60, null);
        $this->addColumn('p32n', 'P32n', 'VARCHAR', true, 60, null);
        $this->addColumn('p33n', 'P33n', 'VARCHAR', true, 60, null);
        $this->addColumn('p34n', 'P34n', 'VARCHAR', true, 60, null);
        $this->addColumn('p35n', 'P35n', 'VARCHAR', true, 60, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
    } // buildRelations()

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
        return $withPrefix ? AlbumTableMap::CLASS_DEFAULT : AlbumTableMap::OM_CLASS;
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
     * @return array           (Album object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = AlbumTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = AlbumTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + AlbumTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = AlbumTableMap::OM_CLASS;
            /** @var Album $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            AlbumTableMap::addInstanceToPool($obj, $key);
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
            $key = AlbumTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = AlbumTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Album $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                AlbumTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(AlbumTableMap::COL_ID);
            $criteria->addSelectColumn(AlbumTableMap::COL_NAME);
            $criteria->addSelectColumn(AlbumTableMap::COL_ARTIST1ID);
            $criteria->addSelectColumn(AlbumTableMap::COL_ARTIST2ID);
            $criteria->addSelectColumn(AlbumTableMap::COL_DOPYLNITELNOINFO);
            $criteria->addSelectColumn(AlbumTableMap::COL_YEAR);
            $criteria->addSelectColumn(AlbumTableMap::COL_IMAGE);
            $criteria->addSelectColumn(AlbumTableMap::COL_VID);
            $criteria->addSelectColumn(AlbumTableMap::COL_UP_ID);
            $criteria->addSelectColumn(AlbumTableMap::COL_VA);
            $criteria->addSelectColumn(AlbumTableMap::COL_P1);
            $criteria->addSelectColumn(AlbumTableMap::COL_P2);
            $criteria->addSelectColumn(AlbumTableMap::COL_P3);
            $criteria->addSelectColumn(AlbumTableMap::COL_P4);
            $criteria->addSelectColumn(AlbumTableMap::COL_P5);
            $criteria->addSelectColumn(AlbumTableMap::COL_P6);
            $criteria->addSelectColumn(AlbumTableMap::COL_P7);
            $criteria->addSelectColumn(AlbumTableMap::COL_P8);
            $criteria->addSelectColumn(AlbumTableMap::COL_P9);
            $criteria->addSelectColumn(AlbumTableMap::COL_P10);
            $criteria->addSelectColumn(AlbumTableMap::COL_P11);
            $criteria->addSelectColumn(AlbumTableMap::COL_P12);
            $criteria->addSelectColumn(AlbumTableMap::COL_P13);
            $criteria->addSelectColumn(AlbumTableMap::COL_P14);
            $criteria->addSelectColumn(AlbumTableMap::COL_P15);
            $criteria->addSelectColumn(AlbumTableMap::COL_P16);
            $criteria->addSelectColumn(AlbumTableMap::COL_P17);
            $criteria->addSelectColumn(AlbumTableMap::COL_P18);
            $criteria->addSelectColumn(AlbumTableMap::COL_P19);
            $criteria->addSelectColumn(AlbumTableMap::COL_P20);
            $criteria->addSelectColumn(AlbumTableMap::COL_P21);
            $criteria->addSelectColumn(AlbumTableMap::COL_P22);
            $criteria->addSelectColumn(AlbumTableMap::COL_P23);
            $criteria->addSelectColumn(AlbumTableMap::COL_P24);
            $criteria->addSelectColumn(AlbumTableMap::COL_P25);
            $criteria->addSelectColumn(AlbumTableMap::COL_P26);
            $criteria->addSelectColumn(AlbumTableMap::COL_P27);
            $criteria->addSelectColumn(AlbumTableMap::COL_P28);
            $criteria->addSelectColumn(AlbumTableMap::COL_P29);
            $criteria->addSelectColumn(AlbumTableMap::COL_P30);
            $criteria->addSelectColumn(AlbumTableMap::COL_P31);
            $criteria->addSelectColumn(AlbumTableMap::COL_P32);
            $criteria->addSelectColumn(AlbumTableMap::COL_P33);
            $criteria->addSelectColumn(AlbumTableMap::COL_P34);
            $criteria->addSelectColumn(AlbumTableMap::COL_P35);
            $criteria->addSelectColumn(AlbumTableMap::COL_P1N);
            $criteria->addSelectColumn(AlbumTableMap::COL_P2N);
            $criteria->addSelectColumn(AlbumTableMap::COL_P3N);
            $criteria->addSelectColumn(AlbumTableMap::COL_P4N);
            $criteria->addSelectColumn(AlbumTableMap::COL_P5N);
            $criteria->addSelectColumn(AlbumTableMap::COL_P6N);
            $criteria->addSelectColumn(AlbumTableMap::COL_P7N);
            $criteria->addSelectColumn(AlbumTableMap::COL_P8N);
            $criteria->addSelectColumn(AlbumTableMap::COL_P9N);
            $criteria->addSelectColumn(AlbumTableMap::COL_P10N);
            $criteria->addSelectColumn(AlbumTableMap::COL_P11N);
            $criteria->addSelectColumn(AlbumTableMap::COL_P12N);
            $criteria->addSelectColumn(AlbumTableMap::COL_P13N);
            $criteria->addSelectColumn(AlbumTableMap::COL_P14N);
            $criteria->addSelectColumn(AlbumTableMap::COL_P15N);
            $criteria->addSelectColumn(AlbumTableMap::COL_P16N);
            $criteria->addSelectColumn(AlbumTableMap::COL_P17N);
            $criteria->addSelectColumn(AlbumTableMap::COL_P18N);
            $criteria->addSelectColumn(AlbumTableMap::COL_P19N);
            $criteria->addSelectColumn(AlbumTableMap::COL_P20N);
            $criteria->addSelectColumn(AlbumTableMap::COL_P21N);
            $criteria->addSelectColumn(AlbumTableMap::COL_P22N);
            $criteria->addSelectColumn(AlbumTableMap::COL_P23N);
            $criteria->addSelectColumn(AlbumTableMap::COL_P24N);
            $criteria->addSelectColumn(AlbumTableMap::COL_P25N);
            $criteria->addSelectColumn(AlbumTableMap::COL_P26N);
            $criteria->addSelectColumn(AlbumTableMap::COL_P27N);
            $criteria->addSelectColumn(AlbumTableMap::COL_P28N);
            $criteria->addSelectColumn(AlbumTableMap::COL_P29N);
            $criteria->addSelectColumn(AlbumTableMap::COL_P30N);
            $criteria->addSelectColumn(AlbumTableMap::COL_P31N);
            $criteria->addSelectColumn(AlbumTableMap::COL_P32N);
            $criteria->addSelectColumn(AlbumTableMap::COL_P33N);
            $criteria->addSelectColumn(AlbumTableMap::COL_P34N);
            $criteria->addSelectColumn(AlbumTableMap::COL_P35N);
        } else {
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.name');
            $criteria->addSelectColumn($alias . '.artist1id');
            $criteria->addSelectColumn($alias . '.artist2id');
            $criteria->addSelectColumn($alias . '.dopylnitelnoinfo');
            $criteria->addSelectColumn($alias . '.year');
            $criteria->addSelectColumn($alias . '.image');
            $criteria->addSelectColumn($alias . '.vid');
            $criteria->addSelectColumn($alias . '.up_id');
            $criteria->addSelectColumn($alias . '.va');
            $criteria->addSelectColumn($alias . '.p1');
            $criteria->addSelectColumn($alias . '.p2');
            $criteria->addSelectColumn($alias . '.p3');
            $criteria->addSelectColumn($alias . '.p4');
            $criteria->addSelectColumn($alias . '.p5');
            $criteria->addSelectColumn($alias . '.p6');
            $criteria->addSelectColumn($alias . '.p7');
            $criteria->addSelectColumn($alias . '.p8');
            $criteria->addSelectColumn($alias . '.p9');
            $criteria->addSelectColumn($alias . '.p10');
            $criteria->addSelectColumn($alias . '.p11');
            $criteria->addSelectColumn($alias . '.p12');
            $criteria->addSelectColumn($alias . '.p13');
            $criteria->addSelectColumn($alias . '.p14');
            $criteria->addSelectColumn($alias . '.p15');
            $criteria->addSelectColumn($alias . '.p16');
            $criteria->addSelectColumn($alias . '.p17');
            $criteria->addSelectColumn($alias . '.p18');
            $criteria->addSelectColumn($alias . '.p19');
            $criteria->addSelectColumn($alias . '.p20');
            $criteria->addSelectColumn($alias . '.p21');
            $criteria->addSelectColumn($alias . '.p22');
            $criteria->addSelectColumn($alias . '.p23');
            $criteria->addSelectColumn($alias . '.p24');
            $criteria->addSelectColumn($alias . '.p25');
            $criteria->addSelectColumn($alias . '.p26');
            $criteria->addSelectColumn($alias . '.p27');
            $criteria->addSelectColumn($alias . '.p28');
            $criteria->addSelectColumn($alias . '.p29');
            $criteria->addSelectColumn($alias . '.p30');
            $criteria->addSelectColumn($alias . '.p31');
            $criteria->addSelectColumn($alias . '.p32');
            $criteria->addSelectColumn($alias . '.p33');
            $criteria->addSelectColumn($alias . '.p34');
            $criteria->addSelectColumn($alias . '.p35');
            $criteria->addSelectColumn($alias . '.p1n');
            $criteria->addSelectColumn($alias . '.p2n');
            $criteria->addSelectColumn($alias . '.p3n');
            $criteria->addSelectColumn($alias . '.p4n');
            $criteria->addSelectColumn($alias . '.p5n');
            $criteria->addSelectColumn($alias . '.p6n');
            $criteria->addSelectColumn($alias . '.p7n');
            $criteria->addSelectColumn($alias . '.p8n');
            $criteria->addSelectColumn($alias . '.p9n');
            $criteria->addSelectColumn($alias . '.p10n');
            $criteria->addSelectColumn($alias . '.p11n');
            $criteria->addSelectColumn($alias . '.p12n');
            $criteria->addSelectColumn($alias . '.p13n');
            $criteria->addSelectColumn($alias . '.p14n');
            $criteria->addSelectColumn($alias . '.p15n');
            $criteria->addSelectColumn($alias . '.p16n');
            $criteria->addSelectColumn($alias . '.p17n');
            $criteria->addSelectColumn($alias . '.p18n');
            $criteria->addSelectColumn($alias . '.p19n');
            $criteria->addSelectColumn($alias . '.p20n');
            $criteria->addSelectColumn($alias . '.p21n');
            $criteria->addSelectColumn($alias . '.p22n');
            $criteria->addSelectColumn($alias . '.p23n');
            $criteria->addSelectColumn($alias . '.p24n');
            $criteria->addSelectColumn($alias . '.p25n');
            $criteria->addSelectColumn($alias . '.p26n');
            $criteria->addSelectColumn($alias . '.p27n');
            $criteria->addSelectColumn($alias . '.p28n');
            $criteria->addSelectColumn($alias . '.p29n');
            $criteria->addSelectColumn($alias . '.p30n');
            $criteria->addSelectColumn($alias . '.p31n');
            $criteria->addSelectColumn($alias . '.p32n');
            $criteria->addSelectColumn($alias . '.p33n');
            $criteria->addSelectColumn($alias . '.p34n');
            $criteria->addSelectColumn($alias . '.p35n');
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
        return Propel::getServiceContainer()->getDatabaseMap(AlbumTableMap::DATABASE_NAME)->getTable(AlbumTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(AlbumTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(AlbumTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new AlbumTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a Album or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or Album object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(AlbumTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Tekstove\TekstoveBundle\Model\Entity\Album) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(AlbumTableMap::DATABASE_NAME);
            $criteria->add(AlbumTableMap::COL_ID, (array) $values, Criteria::IN);
        }

        $query = AlbumQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            AlbumTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                AlbumTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the albums table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return AlbumQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Album or Criteria object.
     *
     * @param mixed               $criteria Criteria or Album object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(AlbumTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Album object
        }

        if ($criteria->containsKey(AlbumTableMap::COL_ID) && $criteria->keyContainsValue(AlbumTableMap::COL_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.AlbumTableMap::COL_ID.')');
        }


        // Set the correct dbName
        $query = AlbumQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // AlbumTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
AlbumTableMap::buildTableMap();
