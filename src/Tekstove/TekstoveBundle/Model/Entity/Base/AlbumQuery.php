<?php

namespace Tekstove\TekstoveBundle\Model\Entity\Base;

use \Exception;
use \PDO;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;
use Tekstove\TekstoveBundle\Model\Entity\Album as ChildAlbum;
use Tekstove\TekstoveBundle\Model\Entity\AlbumQuery as ChildAlbumQuery;
use Tekstove\TekstoveBundle\Model\Entity\Map\AlbumTableMap;

/**
 * Base class that represents a query for the 'albums' table.
 *
 *
 *
 * @method     ChildAlbumQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildAlbumQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method     ChildAlbumQuery orderByArtist1id($order = Criteria::ASC) Order by the artist1id column
 * @method     ChildAlbumQuery orderByArtist2id($order = Criteria::ASC) Order by the artist2id column
 * @method     ChildAlbumQuery orderByDopylnitelnoinfo($order = Criteria::ASC) Order by the dopylnitelnoinfo column
 * @method     ChildAlbumQuery orderByYear($order = Criteria::ASC) Order by the year column
 * @method     ChildAlbumQuery orderByImage($order = Criteria::ASC) Order by the image column
 * @method     ChildAlbumQuery orderByVid($order = Criteria::ASC) Order by the vid column
 * @method     ChildAlbumQuery orderByUpId($order = Criteria::ASC) Order by the up_id column
 * @method     ChildAlbumQuery orderByVa($order = Criteria::ASC) Order by the va column
 * @method     ChildAlbumQuery orderByP1($order = Criteria::ASC) Order by the p1 column
 * @method     ChildAlbumQuery orderByP2($order = Criteria::ASC) Order by the p2 column
 * @method     ChildAlbumQuery orderByP3($order = Criteria::ASC) Order by the p3 column
 * @method     ChildAlbumQuery orderByP4($order = Criteria::ASC) Order by the p4 column
 * @method     ChildAlbumQuery orderByP5($order = Criteria::ASC) Order by the p5 column
 * @method     ChildAlbumQuery orderByP6($order = Criteria::ASC) Order by the p6 column
 * @method     ChildAlbumQuery orderByP7($order = Criteria::ASC) Order by the p7 column
 * @method     ChildAlbumQuery orderByP8($order = Criteria::ASC) Order by the p8 column
 * @method     ChildAlbumQuery orderByP9($order = Criteria::ASC) Order by the p9 column
 * @method     ChildAlbumQuery orderByP10($order = Criteria::ASC) Order by the p10 column
 * @method     ChildAlbumQuery orderByP11($order = Criteria::ASC) Order by the p11 column
 * @method     ChildAlbumQuery orderByP12($order = Criteria::ASC) Order by the p12 column
 * @method     ChildAlbumQuery orderByP13($order = Criteria::ASC) Order by the p13 column
 * @method     ChildAlbumQuery orderByP14($order = Criteria::ASC) Order by the p14 column
 * @method     ChildAlbumQuery orderByP15($order = Criteria::ASC) Order by the p15 column
 * @method     ChildAlbumQuery orderByP16($order = Criteria::ASC) Order by the p16 column
 * @method     ChildAlbumQuery orderByP17($order = Criteria::ASC) Order by the p17 column
 * @method     ChildAlbumQuery orderByP18($order = Criteria::ASC) Order by the p18 column
 * @method     ChildAlbumQuery orderByP19($order = Criteria::ASC) Order by the p19 column
 * @method     ChildAlbumQuery orderByP20($order = Criteria::ASC) Order by the p20 column
 * @method     ChildAlbumQuery orderByP21($order = Criteria::ASC) Order by the p21 column
 * @method     ChildAlbumQuery orderByP22($order = Criteria::ASC) Order by the p22 column
 * @method     ChildAlbumQuery orderByP23($order = Criteria::ASC) Order by the p23 column
 * @method     ChildAlbumQuery orderByP24($order = Criteria::ASC) Order by the p24 column
 * @method     ChildAlbumQuery orderByP25($order = Criteria::ASC) Order by the p25 column
 * @method     ChildAlbumQuery orderByP26($order = Criteria::ASC) Order by the p26 column
 * @method     ChildAlbumQuery orderByP27($order = Criteria::ASC) Order by the p27 column
 * @method     ChildAlbumQuery orderByP28($order = Criteria::ASC) Order by the p28 column
 * @method     ChildAlbumQuery orderByP29($order = Criteria::ASC) Order by the p29 column
 * @method     ChildAlbumQuery orderByP30($order = Criteria::ASC) Order by the p30 column
 * @method     ChildAlbumQuery orderByP31($order = Criteria::ASC) Order by the p31 column
 * @method     ChildAlbumQuery orderByP32($order = Criteria::ASC) Order by the p32 column
 * @method     ChildAlbumQuery orderByP33($order = Criteria::ASC) Order by the p33 column
 * @method     ChildAlbumQuery orderByP34($order = Criteria::ASC) Order by the p34 column
 * @method     ChildAlbumQuery orderByP35($order = Criteria::ASC) Order by the p35 column
 * @method     ChildAlbumQuery orderByP1n($order = Criteria::ASC) Order by the p1n column
 * @method     ChildAlbumQuery orderByP2n($order = Criteria::ASC) Order by the p2n column
 * @method     ChildAlbumQuery orderByP3n($order = Criteria::ASC) Order by the p3n column
 * @method     ChildAlbumQuery orderByP4n($order = Criteria::ASC) Order by the p4n column
 * @method     ChildAlbumQuery orderByP5n($order = Criteria::ASC) Order by the p5n column
 * @method     ChildAlbumQuery orderByP6n($order = Criteria::ASC) Order by the p6n column
 * @method     ChildAlbumQuery orderByP7n($order = Criteria::ASC) Order by the p7n column
 * @method     ChildAlbumQuery orderByP8n($order = Criteria::ASC) Order by the p8n column
 * @method     ChildAlbumQuery orderByP9n($order = Criteria::ASC) Order by the p9n column
 * @method     ChildAlbumQuery orderByP10n($order = Criteria::ASC) Order by the p10n column
 * @method     ChildAlbumQuery orderByP11n($order = Criteria::ASC) Order by the p11n column
 * @method     ChildAlbumQuery orderByP12n($order = Criteria::ASC) Order by the p12n column
 * @method     ChildAlbumQuery orderByP13n($order = Criteria::ASC) Order by the p13n column
 * @method     ChildAlbumQuery orderByP14n($order = Criteria::ASC) Order by the p14n column
 * @method     ChildAlbumQuery orderByP15n($order = Criteria::ASC) Order by the p15n column
 * @method     ChildAlbumQuery orderByP16n($order = Criteria::ASC) Order by the p16n column
 * @method     ChildAlbumQuery orderByP17n($order = Criteria::ASC) Order by the p17n column
 * @method     ChildAlbumQuery orderByP18n($order = Criteria::ASC) Order by the p18n column
 * @method     ChildAlbumQuery orderByP19n($order = Criteria::ASC) Order by the p19n column
 * @method     ChildAlbumQuery orderByP20n($order = Criteria::ASC) Order by the p20n column
 * @method     ChildAlbumQuery orderByP21n($order = Criteria::ASC) Order by the p21n column
 * @method     ChildAlbumQuery orderByP22n($order = Criteria::ASC) Order by the p22n column
 * @method     ChildAlbumQuery orderByP23n($order = Criteria::ASC) Order by the p23n column
 * @method     ChildAlbumQuery orderByP24n($order = Criteria::ASC) Order by the p24n column
 * @method     ChildAlbumQuery orderByP25n($order = Criteria::ASC) Order by the p25n column
 * @method     ChildAlbumQuery orderByP26n($order = Criteria::ASC) Order by the p26n column
 * @method     ChildAlbumQuery orderByP27n($order = Criteria::ASC) Order by the p27n column
 * @method     ChildAlbumQuery orderByP28n($order = Criteria::ASC) Order by the p28n column
 * @method     ChildAlbumQuery orderByP29n($order = Criteria::ASC) Order by the p29n column
 * @method     ChildAlbumQuery orderByP30n($order = Criteria::ASC) Order by the p30n column
 * @method     ChildAlbumQuery orderByP31n($order = Criteria::ASC) Order by the p31n column
 * @method     ChildAlbumQuery orderByP32n($order = Criteria::ASC) Order by the p32n column
 * @method     ChildAlbumQuery orderByP33n($order = Criteria::ASC) Order by the p33n column
 * @method     ChildAlbumQuery orderByP34n($order = Criteria::ASC) Order by the p34n column
 * @method     ChildAlbumQuery orderByP35n($order = Criteria::ASC) Order by the p35n column
 *
 * @method     ChildAlbumQuery groupById() Group by the id column
 * @method     ChildAlbumQuery groupByName() Group by the name column
 * @method     ChildAlbumQuery groupByArtist1id() Group by the artist1id column
 * @method     ChildAlbumQuery groupByArtist2id() Group by the artist2id column
 * @method     ChildAlbumQuery groupByDopylnitelnoinfo() Group by the dopylnitelnoinfo column
 * @method     ChildAlbumQuery groupByYear() Group by the year column
 * @method     ChildAlbumQuery groupByImage() Group by the image column
 * @method     ChildAlbumQuery groupByVid() Group by the vid column
 * @method     ChildAlbumQuery groupByUpId() Group by the up_id column
 * @method     ChildAlbumQuery groupByVa() Group by the va column
 * @method     ChildAlbumQuery groupByP1() Group by the p1 column
 * @method     ChildAlbumQuery groupByP2() Group by the p2 column
 * @method     ChildAlbumQuery groupByP3() Group by the p3 column
 * @method     ChildAlbumQuery groupByP4() Group by the p4 column
 * @method     ChildAlbumQuery groupByP5() Group by the p5 column
 * @method     ChildAlbumQuery groupByP6() Group by the p6 column
 * @method     ChildAlbumQuery groupByP7() Group by the p7 column
 * @method     ChildAlbumQuery groupByP8() Group by the p8 column
 * @method     ChildAlbumQuery groupByP9() Group by the p9 column
 * @method     ChildAlbumQuery groupByP10() Group by the p10 column
 * @method     ChildAlbumQuery groupByP11() Group by the p11 column
 * @method     ChildAlbumQuery groupByP12() Group by the p12 column
 * @method     ChildAlbumQuery groupByP13() Group by the p13 column
 * @method     ChildAlbumQuery groupByP14() Group by the p14 column
 * @method     ChildAlbumQuery groupByP15() Group by the p15 column
 * @method     ChildAlbumQuery groupByP16() Group by the p16 column
 * @method     ChildAlbumQuery groupByP17() Group by the p17 column
 * @method     ChildAlbumQuery groupByP18() Group by the p18 column
 * @method     ChildAlbumQuery groupByP19() Group by the p19 column
 * @method     ChildAlbumQuery groupByP20() Group by the p20 column
 * @method     ChildAlbumQuery groupByP21() Group by the p21 column
 * @method     ChildAlbumQuery groupByP22() Group by the p22 column
 * @method     ChildAlbumQuery groupByP23() Group by the p23 column
 * @method     ChildAlbumQuery groupByP24() Group by the p24 column
 * @method     ChildAlbumQuery groupByP25() Group by the p25 column
 * @method     ChildAlbumQuery groupByP26() Group by the p26 column
 * @method     ChildAlbumQuery groupByP27() Group by the p27 column
 * @method     ChildAlbumQuery groupByP28() Group by the p28 column
 * @method     ChildAlbumQuery groupByP29() Group by the p29 column
 * @method     ChildAlbumQuery groupByP30() Group by the p30 column
 * @method     ChildAlbumQuery groupByP31() Group by the p31 column
 * @method     ChildAlbumQuery groupByP32() Group by the p32 column
 * @method     ChildAlbumQuery groupByP33() Group by the p33 column
 * @method     ChildAlbumQuery groupByP34() Group by the p34 column
 * @method     ChildAlbumQuery groupByP35() Group by the p35 column
 * @method     ChildAlbumQuery groupByP1n() Group by the p1n column
 * @method     ChildAlbumQuery groupByP2n() Group by the p2n column
 * @method     ChildAlbumQuery groupByP3n() Group by the p3n column
 * @method     ChildAlbumQuery groupByP4n() Group by the p4n column
 * @method     ChildAlbumQuery groupByP5n() Group by the p5n column
 * @method     ChildAlbumQuery groupByP6n() Group by the p6n column
 * @method     ChildAlbumQuery groupByP7n() Group by the p7n column
 * @method     ChildAlbumQuery groupByP8n() Group by the p8n column
 * @method     ChildAlbumQuery groupByP9n() Group by the p9n column
 * @method     ChildAlbumQuery groupByP10n() Group by the p10n column
 * @method     ChildAlbumQuery groupByP11n() Group by the p11n column
 * @method     ChildAlbumQuery groupByP12n() Group by the p12n column
 * @method     ChildAlbumQuery groupByP13n() Group by the p13n column
 * @method     ChildAlbumQuery groupByP14n() Group by the p14n column
 * @method     ChildAlbumQuery groupByP15n() Group by the p15n column
 * @method     ChildAlbumQuery groupByP16n() Group by the p16n column
 * @method     ChildAlbumQuery groupByP17n() Group by the p17n column
 * @method     ChildAlbumQuery groupByP18n() Group by the p18n column
 * @method     ChildAlbumQuery groupByP19n() Group by the p19n column
 * @method     ChildAlbumQuery groupByP20n() Group by the p20n column
 * @method     ChildAlbumQuery groupByP21n() Group by the p21n column
 * @method     ChildAlbumQuery groupByP22n() Group by the p22n column
 * @method     ChildAlbumQuery groupByP23n() Group by the p23n column
 * @method     ChildAlbumQuery groupByP24n() Group by the p24n column
 * @method     ChildAlbumQuery groupByP25n() Group by the p25n column
 * @method     ChildAlbumQuery groupByP26n() Group by the p26n column
 * @method     ChildAlbumQuery groupByP27n() Group by the p27n column
 * @method     ChildAlbumQuery groupByP28n() Group by the p28n column
 * @method     ChildAlbumQuery groupByP29n() Group by the p29n column
 * @method     ChildAlbumQuery groupByP30n() Group by the p30n column
 * @method     ChildAlbumQuery groupByP31n() Group by the p31n column
 * @method     ChildAlbumQuery groupByP32n() Group by the p32n column
 * @method     ChildAlbumQuery groupByP33n() Group by the p33n column
 * @method     ChildAlbumQuery groupByP34n() Group by the p34n column
 * @method     ChildAlbumQuery groupByP35n() Group by the p35n column
 *
 * @method     ChildAlbumQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildAlbumQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildAlbumQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildAlbum findOne(ConnectionInterface $con = null) Return the first ChildAlbum matching the query
 * @method     ChildAlbum findOneOrCreate(ConnectionInterface $con = null) Return the first ChildAlbum matching the query, or a new ChildAlbum object populated from the query conditions when no match is found
 *
 * @method     ChildAlbum findOneById(int $id) Return the first ChildAlbum filtered by the id column
 * @method     ChildAlbum findOneByName(string $name) Return the first ChildAlbum filtered by the name column
 * @method     ChildAlbum findOneByArtist1id(int $artist1id) Return the first ChildAlbum filtered by the artist1id column
 * @method     ChildAlbum findOneByArtist2id(int $artist2id) Return the first ChildAlbum filtered by the artist2id column
 * @method     ChildAlbum findOneByDopylnitelnoinfo(string $dopylnitelnoinfo) Return the first ChildAlbum filtered by the dopylnitelnoinfo column
 * @method     ChildAlbum findOneByYear(int $year) Return the first ChildAlbum filtered by the year column
 * @method     ChildAlbum findOneByImage(string $image) Return the first ChildAlbum filtered by the image column
 * @method     ChildAlbum findOneByVid(int $vid) Return the first ChildAlbum filtered by the vid column
 * @method     ChildAlbum findOneByUpId(int $up_id) Return the first ChildAlbum filtered by the up_id column
 * @method     ChildAlbum findOneByVa(boolean $va) Return the first ChildAlbum filtered by the va column
 * @method     ChildAlbum findOneByP1(int $p1) Return the first ChildAlbum filtered by the p1 column
 * @method     ChildAlbum findOneByP2(int $p2) Return the first ChildAlbum filtered by the p2 column
 * @method     ChildAlbum findOneByP3(int $p3) Return the first ChildAlbum filtered by the p3 column
 * @method     ChildAlbum findOneByP4(int $p4) Return the first ChildAlbum filtered by the p4 column
 * @method     ChildAlbum findOneByP5(int $p5) Return the first ChildAlbum filtered by the p5 column
 * @method     ChildAlbum findOneByP6(int $p6) Return the first ChildAlbum filtered by the p6 column
 * @method     ChildAlbum findOneByP7(int $p7) Return the first ChildAlbum filtered by the p7 column
 * @method     ChildAlbum findOneByP8(int $p8) Return the first ChildAlbum filtered by the p8 column
 * @method     ChildAlbum findOneByP9(int $p9) Return the first ChildAlbum filtered by the p9 column
 * @method     ChildAlbum findOneByP10(int $p10) Return the first ChildAlbum filtered by the p10 column
 * @method     ChildAlbum findOneByP11(int $p11) Return the first ChildAlbum filtered by the p11 column
 * @method     ChildAlbum findOneByP12(int $p12) Return the first ChildAlbum filtered by the p12 column
 * @method     ChildAlbum findOneByP13(int $p13) Return the first ChildAlbum filtered by the p13 column
 * @method     ChildAlbum findOneByP14(int $p14) Return the first ChildAlbum filtered by the p14 column
 * @method     ChildAlbum findOneByP15(int $p15) Return the first ChildAlbum filtered by the p15 column
 * @method     ChildAlbum findOneByP16(int $p16) Return the first ChildAlbum filtered by the p16 column
 * @method     ChildAlbum findOneByP17(int $p17) Return the first ChildAlbum filtered by the p17 column
 * @method     ChildAlbum findOneByP18(int $p18) Return the first ChildAlbum filtered by the p18 column
 * @method     ChildAlbum findOneByP19(int $p19) Return the first ChildAlbum filtered by the p19 column
 * @method     ChildAlbum findOneByP20(int $p20) Return the first ChildAlbum filtered by the p20 column
 * @method     ChildAlbum findOneByP21(int $p21) Return the first ChildAlbum filtered by the p21 column
 * @method     ChildAlbum findOneByP22(int $p22) Return the first ChildAlbum filtered by the p22 column
 * @method     ChildAlbum findOneByP23(int $p23) Return the first ChildAlbum filtered by the p23 column
 * @method     ChildAlbum findOneByP24(int $p24) Return the first ChildAlbum filtered by the p24 column
 * @method     ChildAlbum findOneByP25(int $p25) Return the first ChildAlbum filtered by the p25 column
 * @method     ChildAlbum findOneByP26(int $p26) Return the first ChildAlbum filtered by the p26 column
 * @method     ChildAlbum findOneByP27(int $p27) Return the first ChildAlbum filtered by the p27 column
 * @method     ChildAlbum findOneByP28(int $p28) Return the first ChildAlbum filtered by the p28 column
 * @method     ChildAlbum findOneByP29(int $p29) Return the first ChildAlbum filtered by the p29 column
 * @method     ChildAlbum findOneByP30(int $p30) Return the first ChildAlbum filtered by the p30 column
 * @method     ChildAlbum findOneByP31(int $p31) Return the first ChildAlbum filtered by the p31 column
 * @method     ChildAlbum findOneByP32(int $p32) Return the first ChildAlbum filtered by the p32 column
 * @method     ChildAlbum findOneByP33(int $p33) Return the first ChildAlbum filtered by the p33 column
 * @method     ChildAlbum findOneByP34(int $p34) Return the first ChildAlbum filtered by the p34 column
 * @method     ChildAlbum findOneByP35(int $p35) Return the first ChildAlbum filtered by the p35 column
 * @method     ChildAlbum findOneByP1n(string $p1n) Return the first ChildAlbum filtered by the p1n column
 * @method     ChildAlbum findOneByP2n(string $p2n) Return the first ChildAlbum filtered by the p2n column
 * @method     ChildAlbum findOneByP3n(string $p3n) Return the first ChildAlbum filtered by the p3n column
 * @method     ChildAlbum findOneByP4n(string $p4n) Return the first ChildAlbum filtered by the p4n column
 * @method     ChildAlbum findOneByP5n(string $p5n) Return the first ChildAlbum filtered by the p5n column
 * @method     ChildAlbum findOneByP6n(string $p6n) Return the first ChildAlbum filtered by the p6n column
 * @method     ChildAlbum findOneByP7n(string $p7n) Return the first ChildAlbum filtered by the p7n column
 * @method     ChildAlbum findOneByP8n(string $p8n) Return the first ChildAlbum filtered by the p8n column
 * @method     ChildAlbum findOneByP9n(string $p9n) Return the first ChildAlbum filtered by the p9n column
 * @method     ChildAlbum findOneByP10n(string $p10n) Return the first ChildAlbum filtered by the p10n column
 * @method     ChildAlbum findOneByP11n(string $p11n) Return the first ChildAlbum filtered by the p11n column
 * @method     ChildAlbum findOneByP12n(string $p12n) Return the first ChildAlbum filtered by the p12n column
 * @method     ChildAlbum findOneByP13n(string $p13n) Return the first ChildAlbum filtered by the p13n column
 * @method     ChildAlbum findOneByP14n(string $p14n) Return the first ChildAlbum filtered by the p14n column
 * @method     ChildAlbum findOneByP15n(string $p15n) Return the first ChildAlbum filtered by the p15n column
 * @method     ChildAlbum findOneByP16n(string $p16n) Return the first ChildAlbum filtered by the p16n column
 * @method     ChildAlbum findOneByP17n(string $p17n) Return the first ChildAlbum filtered by the p17n column
 * @method     ChildAlbum findOneByP18n(string $p18n) Return the first ChildAlbum filtered by the p18n column
 * @method     ChildAlbum findOneByP19n(string $p19n) Return the first ChildAlbum filtered by the p19n column
 * @method     ChildAlbum findOneByP20n(string $p20n) Return the first ChildAlbum filtered by the p20n column
 * @method     ChildAlbum findOneByP21n(string $p21n) Return the first ChildAlbum filtered by the p21n column
 * @method     ChildAlbum findOneByP22n(string $p22n) Return the first ChildAlbum filtered by the p22n column
 * @method     ChildAlbum findOneByP23n(string $p23n) Return the first ChildAlbum filtered by the p23n column
 * @method     ChildAlbum findOneByP24n(string $p24n) Return the first ChildAlbum filtered by the p24n column
 * @method     ChildAlbum findOneByP25n(string $p25n) Return the first ChildAlbum filtered by the p25n column
 * @method     ChildAlbum findOneByP26n(string $p26n) Return the first ChildAlbum filtered by the p26n column
 * @method     ChildAlbum findOneByP27n(string $p27n) Return the first ChildAlbum filtered by the p27n column
 * @method     ChildAlbum findOneByP28n(string $p28n) Return the first ChildAlbum filtered by the p28n column
 * @method     ChildAlbum findOneByP29n(string $p29n) Return the first ChildAlbum filtered by the p29n column
 * @method     ChildAlbum findOneByP30n(string $p30n) Return the first ChildAlbum filtered by the p30n column
 * @method     ChildAlbum findOneByP31n(string $p31n) Return the first ChildAlbum filtered by the p31n column
 * @method     ChildAlbum findOneByP32n(string $p32n) Return the first ChildAlbum filtered by the p32n column
 * @method     ChildAlbum findOneByP33n(string $p33n) Return the first ChildAlbum filtered by the p33n column
 * @method     ChildAlbum findOneByP34n(string $p34n) Return the first ChildAlbum filtered by the p34n column
 * @method     ChildAlbum findOneByP35n(string $p35n) Return the first ChildAlbum filtered by the p35n column *

 * @method     ChildAlbum requirePk($key, ConnectionInterface $con = null) Return the ChildAlbum by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAlbum requireOne(ConnectionInterface $con = null) Return the first ChildAlbum matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildAlbum requireOneById(int $id) Return the first ChildAlbum filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAlbum requireOneByName(string $name) Return the first ChildAlbum filtered by the name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAlbum requireOneByArtist1id(int $artist1id) Return the first ChildAlbum filtered by the artist1id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAlbum requireOneByArtist2id(int $artist2id) Return the first ChildAlbum filtered by the artist2id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAlbum requireOneByDopylnitelnoinfo(string $dopylnitelnoinfo) Return the first ChildAlbum filtered by the dopylnitelnoinfo column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAlbum requireOneByYear(int $year) Return the first ChildAlbum filtered by the year column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAlbum requireOneByImage(string $image) Return the first ChildAlbum filtered by the image column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAlbum requireOneByVid(int $vid) Return the first ChildAlbum filtered by the vid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAlbum requireOneByUpId(int $up_id) Return the first ChildAlbum filtered by the up_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAlbum requireOneByVa(boolean $va) Return the first ChildAlbum filtered by the va column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAlbum requireOneByP1(int $p1) Return the first ChildAlbum filtered by the p1 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAlbum requireOneByP2(int $p2) Return the first ChildAlbum filtered by the p2 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAlbum requireOneByP3(int $p3) Return the first ChildAlbum filtered by the p3 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAlbum requireOneByP4(int $p4) Return the first ChildAlbum filtered by the p4 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAlbum requireOneByP5(int $p5) Return the first ChildAlbum filtered by the p5 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAlbum requireOneByP6(int $p6) Return the first ChildAlbum filtered by the p6 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAlbum requireOneByP7(int $p7) Return the first ChildAlbum filtered by the p7 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAlbum requireOneByP8(int $p8) Return the first ChildAlbum filtered by the p8 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAlbum requireOneByP9(int $p9) Return the first ChildAlbum filtered by the p9 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAlbum requireOneByP10(int $p10) Return the first ChildAlbum filtered by the p10 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAlbum requireOneByP11(int $p11) Return the first ChildAlbum filtered by the p11 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAlbum requireOneByP12(int $p12) Return the first ChildAlbum filtered by the p12 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAlbum requireOneByP13(int $p13) Return the first ChildAlbum filtered by the p13 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAlbum requireOneByP14(int $p14) Return the first ChildAlbum filtered by the p14 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAlbum requireOneByP15(int $p15) Return the first ChildAlbum filtered by the p15 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAlbum requireOneByP16(int $p16) Return the first ChildAlbum filtered by the p16 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAlbum requireOneByP17(int $p17) Return the first ChildAlbum filtered by the p17 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAlbum requireOneByP18(int $p18) Return the first ChildAlbum filtered by the p18 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAlbum requireOneByP19(int $p19) Return the first ChildAlbum filtered by the p19 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAlbum requireOneByP20(int $p20) Return the first ChildAlbum filtered by the p20 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAlbum requireOneByP21(int $p21) Return the first ChildAlbum filtered by the p21 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAlbum requireOneByP22(int $p22) Return the first ChildAlbum filtered by the p22 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAlbum requireOneByP23(int $p23) Return the first ChildAlbum filtered by the p23 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAlbum requireOneByP24(int $p24) Return the first ChildAlbum filtered by the p24 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAlbum requireOneByP25(int $p25) Return the first ChildAlbum filtered by the p25 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAlbum requireOneByP26(int $p26) Return the first ChildAlbum filtered by the p26 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAlbum requireOneByP27(int $p27) Return the first ChildAlbum filtered by the p27 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAlbum requireOneByP28(int $p28) Return the first ChildAlbum filtered by the p28 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAlbum requireOneByP29(int $p29) Return the first ChildAlbum filtered by the p29 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAlbum requireOneByP30(int $p30) Return the first ChildAlbum filtered by the p30 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAlbum requireOneByP31(int $p31) Return the first ChildAlbum filtered by the p31 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAlbum requireOneByP32(int $p32) Return the first ChildAlbum filtered by the p32 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAlbum requireOneByP33(int $p33) Return the first ChildAlbum filtered by the p33 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAlbum requireOneByP34(int $p34) Return the first ChildAlbum filtered by the p34 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAlbum requireOneByP35(int $p35) Return the first ChildAlbum filtered by the p35 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAlbum requireOneByP1n(string $p1n) Return the first ChildAlbum filtered by the p1n column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAlbum requireOneByP2n(string $p2n) Return the first ChildAlbum filtered by the p2n column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAlbum requireOneByP3n(string $p3n) Return the first ChildAlbum filtered by the p3n column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAlbum requireOneByP4n(string $p4n) Return the first ChildAlbum filtered by the p4n column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAlbum requireOneByP5n(string $p5n) Return the first ChildAlbum filtered by the p5n column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAlbum requireOneByP6n(string $p6n) Return the first ChildAlbum filtered by the p6n column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAlbum requireOneByP7n(string $p7n) Return the first ChildAlbum filtered by the p7n column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAlbum requireOneByP8n(string $p8n) Return the first ChildAlbum filtered by the p8n column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAlbum requireOneByP9n(string $p9n) Return the first ChildAlbum filtered by the p9n column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAlbum requireOneByP10n(string $p10n) Return the first ChildAlbum filtered by the p10n column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAlbum requireOneByP11n(string $p11n) Return the first ChildAlbum filtered by the p11n column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAlbum requireOneByP12n(string $p12n) Return the first ChildAlbum filtered by the p12n column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAlbum requireOneByP13n(string $p13n) Return the first ChildAlbum filtered by the p13n column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAlbum requireOneByP14n(string $p14n) Return the first ChildAlbum filtered by the p14n column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAlbum requireOneByP15n(string $p15n) Return the first ChildAlbum filtered by the p15n column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAlbum requireOneByP16n(string $p16n) Return the first ChildAlbum filtered by the p16n column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAlbum requireOneByP17n(string $p17n) Return the first ChildAlbum filtered by the p17n column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAlbum requireOneByP18n(string $p18n) Return the first ChildAlbum filtered by the p18n column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAlbum requireOneByP19n(string $p19n) Return the first ChildAlbum filtered by the p19n column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAlbum requireOneByP20n(string $p20n) Return the first ChildAlbum filtered by the p20n column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAlbum requireOneByP21n(string $p21n) Return the first ChildAlbum filtered by the p21n column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAlbum requireOneByP22n(string $p22n) Return the first ChildAlbum filtered by the p22n column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAlbum requireOneByP23n(string $p23n) Return the first ChildAlbum filtered by the p23n column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAlbum requireOneByP24n(string $p24n) Return the first ChildAlbum filtered by the p24n column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAlbum requireOneByP25n(string $p25n) Return the first ChildAlbum filtered by the p25n column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAlbum requireOneByP26n(string $p26n) Return the first ChildAlbum filtered by the p26n column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAlbum requireOneByP27n(string $p27n) Return the first ChildAlbum filtered by the p27n column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAlbum requireOneByP28n(string $p28n) Return the first ChildAlbum filtered by the p28n column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAlbum requireOneByP29n(string $p29n) Return the first ChildAlbum filtered by the p29n column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAlbum requireOneByP30n(string $p30n) Return the first ChildAlbum filtered by the p30n column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAlbum requireOneByP31n(string $p31n) Return the first ChildAlbum filtered by the p31n column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAlbum requireOneByP32n(string $p32n) Return the first ChildAlbum filtered by the p32n column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAlbum requireOneByP33n(string $p33n) Return the first ChildAlbum filtered by the p33n column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAlbum requireOneByP34n(string $p34n) Return the first ChildAlbum filtered by the p34n column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAlbum requireOneByP35n(string $p35n) Return the first ChildAlbum filtered by the p35n column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildAlbum[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildAlbum objects based on current ModelCriteria
 * @method     ChildAlbum[]|ObjectCollection findById(int $id) Return ChildAlbum objects filtered by the id column
 * @method     ChildAlbum[]|ObjectCollection findByName(string $name) Return ChildAlbum objects filtered by the name column
 * @method     ChildAlbum[]|ObjectCollection findByArtist1id(int $artist1id) Return ChildAlbum objects filtered by the artist1id column
 * @method     ChildAlbum[]|ObjectCollection findByArtist2id(int $artist2id) Return ChildAlbum objects filtered by the artist2id column
 * @method     ChildAlbum[]|ObjectCollection findByDopylnitelnoinfo(string $dopylnitelnoinfo) Return ChildAlbum objects filtered by the dopylnitelnoinfo column
 * @method     ChildAlbum[]|ObjectCollection findByYear(int $year) Return ChildAlbum objects filtered by the year column
 * @method     ChildAlbum[]|ObjectCollection findByImage(string $image) Return ChildAlbum objects filtered by the image column
 * @method     ChildAlbum[]|ObjectCollection findByVid(int $vid) Return ChildAlbum objects filtered by the vid column
 * @method     ChildAlbum[]|ObjectCollection findByUpId(int $up_id) Return ChildAlbum objects filtered by the up_id column
 * @method     ChildAlbum[]|ObjectCollection findByVa(boolean $va) Return ChildAlbum objects filtered by the va column
 * @method     ChildAlbum[]|ObjectCollection findByP1(int $p1) Return ChildAlbum objects filtered by the p1 column
 * @method     ChildAlbum[]|ObjectCollection findByP2(int $p2) Return ChildAlbum objects filtered by the p2 column
 * @method     ChildAlbum[]|ObjectCollection findByP3(int $p3) Return ChildAlbum objects filtered by the p3 column
 * @method     ChildAlbum[]|ObjectCollection findByP4(int $p4) Return ChildAlbum objects filtered by the p4 column
 * @method     ChildAlbum[]|ObjectCollection findByP5(int $p5) Return ChildAlbum objects filtered by the p5 column
 * @method     ChildAlbum[]|ObjectCollection findByP6(int $p6) Return ChildAlbum objects filtered by the p6 column
 * @method     ChildAlbum[]|ObjectCollection findByP7(int $p7) Return ChildAlbum objects filtered by the p7 column
 * @method     ChildAlbum[]|ObjectCollection findByP8(int $p8) Return ChildAlbum objects filtered by the p8 column
 * @method     ChildAlbum[]|ObjectCollection findByP9(int $p9) Return ChildAlbum objects filtered by the p9 column
 * @method     ChildAlbum[]|ObjectCollection findByP10(int $p10) Return ChildAlbum objects filtered by the p10 column
 * @method     ChildAlbum[]|ObjectCollection findByP11(int $p11) Return ChildAlbum objects filtered by the p11 column
 * @method     ChildAlbum[]|ObjectCollection findByP12(int $p12) Return ChildAlbum objects filtered by the p12 column
 * @method     ChildAlbum[]|ObjectCollection findByP13(int $p13) Return ChildAlbum objects filtered by the p13 column
 * @method     ChildAlbum[]|ObjectCollection findByP14(int $p14) Return ChildAlbum objects filtered by the p14 column
 * @method     ChildAlbum[]|ObjectCollection findByP15(int $p15) Return ChildAlbum objects filtered by the p15 column
 * @method     ChildAlbum[]|ObjectCollection findByP16(int $p16) Return ChildAlbum objects filtered by the p16 column
 * @method     ChildAlbum[]|ObjectCollection findByP17(int $p17) Return ChildAlbum objects filtered by the p17 column
 * @method     ChildAlbum[]|ObjectCollection findByP18(int $p18) Return ChildAlbum objects filtered by the p18 column
 * @method     ChildAlbum[]|ObjectCollection findByP19(int $p19) Return ChildAlbum objects filtered by the p19 column
 * @method     ChildAlbum[]|ObjectCollection findByP20(int $p20) Return ChildAlbum objects filtered by the p20 column
 * @method     ChildAlbum[]|ObjectCollection findByP21(int $p21) Return ChildAlbum objects filtered by the p21 column
 * @method     ChildAlbum[]|ObjectCollection findByP22(int $p22) Return ChildAlbum objects filtered by the p22 column
 * @method     ChildAlbum[]|ObjectCollection findByP23(int $p23) Return ChildAlbum objects filtered by the p23 column
 * @method     ChildAlbum[]|ObjectCollection findByP24(int $p24) Return ChildAlbum objects filtered by the p24 column
 * @method     ChildAlbum[]|ObjectCollection findByP25(int $p25) Return ChildAlbum objects filtered by the p25 column
 * @method     ChildAlbum[]|ObjectCollection findByP26(int $p26) Return ChildAlbum objects filtered by the p26 column
 * @method     ChildAlbum[]|ObjectCollection findByP27(int $p27) Return ChildAlbum objects filtered by the p27 column
 * @method     ChildAlbum[]|ObjectCollection findByP28(int $p28) Return ChildAlbum objects filtered by the p28 column
 * @method     ChildAlbum[]|ObjectCollection findByP29(int $p29) Return ChildAlbum objects filtered by the p29 column
 * @method     ChildAlbum[]|ObjectCollection findByP30(int $p30) Return ChildAlbum objects filtered by the p30 column
 * @method     ChildAlbum[]|ObjectCollection findByP31(int $p31) Return ChildAlbum objects filtered by the p31 column
 * @method     ChildAlbum[]|ObjectCollection findByP32(int $p32) Return ChildAlbum objects filtered by the p32 column
 * @method     ChildAlbum[]|ObjectCollection findByP33(int $p33) Return ChildAlbum objects filtered by the p33 column
 * @method     ChildAlbum[]|ObjectCollection findByP34(int $p34) Return ChildAlbum objects filtered by the p34 column
 * @method     ChildAlbum[]|ObjectCollection findByP35(int $p35) Return ChildAlbum objects filtered by the p35 column
 * @method     ChildAlbum[]|ObjectCollection findByP1n(string $p1n) Return ChildAlbum objects filtered by the p1n column
 * @method     ChildAlbum[]|ObjectCollection findByP2n(string $p2n) Return ChildAlbum objects filtered by the p2n column
 * @method     ChildAlbum[]|ObjectCollection findByP3n(string $p3n) Return ChildAlbum objects filtered by the p3n column
 * @method     ChildAlbum[]|ObjectCollection findByP4n(string $p4n) Return ChildAlbum objects filtered by the p4n column
 * @method     ChildAlbum[]|ObjectCollection findByP5n(string $p5n) Return ChildAlbum objects filtered by the p5n column
 * @method     ChildAlbum[]|ObjectCollection findByP6n(string $p6n) Return ChildAlbum objects filtered by the p6n column
 * @method     ChildAlbum[]|ObjectCollection findByP7n(string $p7n) Return ChildAlbum objects filtered by the p7n column
 * @method     ChildAlbum[]|ObjectCollection findByP8n(string $p8n) Return ChildAlbum objects filtered by the p8n column
 * @method     ChildAlbum[]|ObjectCollection findByP9n(string $p9n) Return ChildAlbum objects filtered by the p9n column
 * @method     ChildAlbum[]|ObjectCollection findByP10n(string $p10n) Return ChildAlbum objects filtered by the p10n column
 * @method     ChildAlbum[]|ObjectCollection findByP11n(string $p11n) Return ChildAlbum objects filtered by the p11n column
 * @method     ChildAlbum[]|ObjectCollection findByP12n(string $p12n) Return ChildAlbum objects filtered by the p12n column
 * @method     ChildAlbum[]|ObjectCollection findByP13n(string $p13n) Return ChildAlbum objects filtered by the p13n column
 * @method     ChildAlbum[]|ObjectCollection findByP14n(string $p14n) Return ChildAlbum objects filtered by the p14n column
 * @method     ChildAlbum[]|ObjectCollection findByP15n(string $p15n) Return ChildAlbum objects filtered by the p15n column
 * @method     ChildAlbum[]|ObjectCollection findByP16n(string $p16n) Return ChildAlbum objects filtered by the p16n column
 * @method     ChildAlbum[]|ObjectCollection findByP17n(string $p17n) Return ChildAlbum objects filtered by the p17n column
 * @method     ChildAlbum[]|ObjectCollection findByP18n(string $p18n) Return ChildAlbum objects filtered by the p18n column
 * @method     ChildAlbum[]|ObjectCollection findByP19n(string $p19n) Return ChildAlbum objects filtered by the p19n column
 * @method     ChildAlbum[]|ObjectCollection findByP20n(string $p20n) Return ChildAlbum objects filtered by the p20n column
 * @method     ChildAlbum[]|ObjectCollection findByP21n(string $p21n) Return ChildAlbum objects filtered by the p21n column
 * @method     ChildAlbum[]|ObjectCollection findByP22n(string $p22n) Return ChildAlbum objects filtered by the p22n column
 * @method     ChildAlbum[]|ObjectCollection findByP23n(string $p23n) Return ChildAlbum objects filtered by the p23n column
 * @method     ChildAlbum[]|ObjectCollection findByP24n(string $p24n) Return ChildAlbum objects filtered by the p24n column
 * @method     ChildAlbum[]|ObjectCollection findByP25n(string $p25n) Return ChildAlbum objects filtered by the p25n column
 * @method     ChildAlbum[]|ObjectCollection findByP26n(string $p26n) Return ChildAlbum objects filtered by the p26n column
 * @method     ChildAlbum[]|ObjectCollection findByP27n(string $p27n) Return ChildAlbum objects filtered by the p27n column
 * @method     ChildAlbum[]|ObjectCollection findByP28n(string $p28n) Return ChildAlbum objects filtered by the p28n column
 * @method     ChildAlbum[]|ObjectCollection findByP29n(string $p29n) Return ChildAlbum objects filtered by the p29n column
 * @method     ChildAlbum[]|ObjectCollection findByP30n(string $p30n) Return ChildAlbum objects filtered by the p30n column
 * @method     ChildAlbum[]|ObjectCollection findByP31n(string $p31n) Return ChildAlbum objects filtered by the p31n column
 * @method     ChildAlbum[]|ObjectCollection findByP32n(string $p32n) Return ChildAlbum objects filtered by the p32n column
 * @method     ChildAlbum[]|ObjectCollection findByP33n(string $p33n) Return ChildAlbum objects filtered by the p33n column
 * @method     ChildAlbum[]|ObjectCollection findByP34n(string $p34n) Return ChildAlbum objects filtered by the p34n column
 * @method     ChildAlbum[]|ObjectCollection findByP35n(string $p35n) Return ChildAlbum objects filtered by the p35n column
 * @method     ChildAlbum[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class AlbumQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Tekstove\TekstoveBundle\Model\Entity\Base\AlbumQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\Tekstove\\TekstoveBundle\\Model\\Entity\\Album', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildAlbumQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildAlbumQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildAlbumQuery) {
            return $criteria;
        }
        $query = new ChildAlbumQuery();
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
     * @return ChildAlbum|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = AlbumTableMap::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(AlbumTableMap::DATABASE_NAME);
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
     * @return ChildAlbum A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, name, artist1id, artist2id, dopylnitelnoinfo, year, image, vid, up_id, va, p1, p2, p3, p4, p5, p6, p7, p8, p9, p10, p11, p12, p13, p14, p15, p16, p17, p18, p19, p20, p21, p22, p23, p24, p25, p26, p27, p28, p29, p30, p31, p32, p33, p34, p35, p1n, p2n, p3n, p4n, p5n, p6n, p7n, p8n, p9n, p10n, p11n, p12n, p13n, p14n, p15n, p16n, p17n, p18n, p19n, p20n, p21n, p22n, p23n, p24n, p25n, p26n, p27n, p28n, p29n, p30n, p31n, p32n, p33n, p34n, p35n FROM albums WHERE id = :p0';
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
            /** @var ChildAlbum $obj */
            $obj = new ChildAlbum();
            $obj->hydrate($row);
            AlbumTableMap::addInstanceToPool($obj, (string) $key);
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
     * @return ChildAlbum|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildAlbumQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(AlbumTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildAlbumQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(AlbumTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildAlbumQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(AlbumTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(AlbumTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AlbumTableMap::COL_ID, $id, $comparison);
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
     * @return $this|ChildAlbumQuery The current query, for fluid interface
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

        return $this->addUsingAlias(AlbumTableMap::COL_NAME, $name, $comparison);
    }

    /**
     * Filter the query on the artist1id column
     *
     * Example usage:
     * <code>
     * $query->filterByArtist1id(1234); // WHERE artist1id = 1234
     * $query->filterByArtist1id(array(12, 34)); // WHERE artist1id IN (12, 34)
     * $query->filterByArtist1id(array('min' => 12)); // WHERE artist1id > 12
     * </code>
     *
     * @param     mixed $artist1id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAlbumQuery The current query, for fluid interface
     */
    public function filterByArtist1id($artist1id = null, $comparison = null)
    {
        if (is_array($artist1id)) {
            $useMinMax = false;
            if (isset($artist1id['min'])) {
                $this->addUsingAlias(AlbumTableMap::COL_ARTIST1ID, $artist1id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($artist1id['max'])) {
                $this->addUsingAlias(AlbumTableMap::COL_ARTIST1ID, $artist1id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AlbumTableMap::COL_ARTIST1ID, $artist1id, $comparison);
    }

    /**
     * Filter the query on the artist2id column
     *
     * Example usage:
     * <code>
     * $query->filterByArtist2id(1234); // WHERE artist2id = 1234
     * $query->filterByArtist2id(array(12, 34)); // WHERE artist2id IN (12, 34)
     * $query->filterByArtist2id(array('min' => 12)); // WHERE artist2id > 12
     * </code>
     *
     * @param     mixed $artist2id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAlbumQuery The current query, for fluid interface
     */
    public function filterByArtist2id($artist2id = null, $comparison = null)
    {
        if (is_array($artist2id)) {
            $useMinMax = false;
            if (isset($artist2id['min'])) {
                $this->addUsingAlias(AlbumTableMap::COL_ARTIST2ID, $artist2id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($artist2id['max'])) {
                $this->addUsingAlias(AlbumTableMap::COL_ARTIST2ID, $artist2id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AlbumTableMap::COL_ARTIST2ID, $artist2id, $comparison);
    }

    /**
     * Filter the query on the dopylnitelnoinfo column
     *
     * Example usage:
     * <code>
     * $query->filterByDopylnitelnoinfo('fooValue');   // WHERE dopylnitelnoinfo = 'fooValue'
     * $query->filterByDopylnitelnoinfo('%fooValue%'); // WHERE dopylnitelnoinfo LIKE '%fooValue%'
     * </code>
     *
     * @param     string $dopylnitelnoinfo The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAlbumQuery The current query, for fluid interface
     */
    public function filterByDopylnitelnoinfo($dopylnitelnoinfo = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($dopylnitelnoinfo)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $dopylnitelnoinfo)) {
                $dopylnitelnoinfo = str_replace('*', '%', $dopylnitelnoinfo);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(AlbumTableMap::COL_DOPYLNITELNOINFO, $dopylnitelnoinfo, $comparison);
    }

    /**
     * Filter the query on the year column
     *
     * Example usage:
     * <code>
     * $query->filterByYear(1234); // WHERE year = 1234
     * $query->filterByYear(array(12, 34)); // WHERE year IN (12, 34)
     * $query->filterByYear(array('min' => 12)); // WHERE year > 12
     * </code>
     *
     * @param     mixed $year The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAlbumQuery The current query, for fluid interface
     */
    public function filterByYear($year = null, $comparison = null)
    {
        if (is_array($year)) {
            $useMinMax = false;
            if (isset($year['min'])) {
                $this->addUsingAlias(AlbumTableMap::COL_YEAR, $year['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($year['max'])) {
                $this->addUsingAlias(AlbumTableMap::COL_YEAR, $year['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AlbumTableMap::COL_YEAR, $year, $comparison);
    }

    /**
     * Filter the query on the image column
     *
     * Example usage:
     * <code>
     * $query->filterByImage('fooValue');   // WHERE image = 'fooValue'
     * $query->filterByImage('%fooValue%'); // WHERE image LIKE '%fooValue%'
     * </code>
     *
     * @param     string $image The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAlbumQuery The current query, for fluid interface
     */
    public function filterByImage($image = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($image)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $image)) {
                $image = str_replace('*', '%', $image);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(AlbumTableMap::COL_IMAGE, $image, $comparison);
    }

    /**
     * Filter the query on the vid column
     *
     * Example usage:
     * <code>
     * $query->filterByVid(1234); // WHERE vid = 1234
     * $query->filterByVid(array(12, 34)); // WHERE vid IN (12, 34)
     * $query->filterByVid(array('min' => 12)); // WHERE vid > 12
     * </code>
     *
     * @param     mixed $vid The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAlbumQuery The current query, for fluid interface
     */
    public function filterByVid($vid = null, $comparison = null)
    {
        if (is_array($vid)) {
            $useMinMax = false;
            if (isset($vid['min'])) {
                $this->addUsingAlias(AlbumTableMap::COL_VID, $vid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($vid['max'])) {
                $this->addUsingAlias(AlbumTableMap::COL_VID, $vid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AlbumTableMap::COL_VID, $vid, $comparison);
    }

    /**
     * Filter the query on the up_id column
     *
     * Example usage:
     * <code>
     * $query->filterByUpId(1234); // WHERE up_id = 1234
     * $query->filterByUpId(array(12, 34)); // WHERE up_id IN (12, 34)
     * $query->filterByUpId(array('min' => 12)); // WHERE up_id > 12
     * </code>
     *
     * @param     mixed $upId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAlbumQuery The current query, for fluid interface
     */
    public function filterByUpId($upId = null, $comparison = null)
    {
        if (is_array($upId)) {
            $useMinMax = false;
            if (isset($upId['min'])) {
                $this->addUsingAlias(AlbumTableMap::COL_UP_ID, $upId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($upId['max'])) {
                $this->addUsingAlias(AlbumTableMap::COL_UP_ID, $upId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AlbumTableMap::COL_UP_ID, $upId, $comparison);
    }

    /**
     * Filter the query on the va column
     *
     * Example usage:
     * <code>
     * $query->filterByVa(true); // WHERE va = true
     * $query->filterByVa('yes'); // WHERE va = true
     * </code>
     *
     * @param     boolean|string $va The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAlbumQuery The current query, for fluid interface
     */
    public function filterByVa($va = null, $comparison = null)
    {
        if (is_string($va)) {
            $va = in_array(strtolower($va), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(AlbumTableMap::COL_VA, $va, $comparison);
    }

    /**
     * Filter the query on the p1 column
     *
     * Example usage:
     * <code>
     * $query->filterByP1(1234); // WHERE p1 = 1234
     * $query->filterByP1(array(12, 34)); // WHERE p1 IN (12, 34)
     * $query->filterByP1(array('min' => 12)); // WHERE p1 > 12
     * </code>
     *
     * @param     mixed $p1 The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAlbumQuery The current query, for fluid interface
     */
    public function filterByP1($p1 = null, $comparison = null)
    {
        if (is_array($p1)) {
            $useMinMax = false;
            if (isset($p1['min'])) {
                $this->addUsingAlias(AlbumTableMap::COL_P1, $p1['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($p1['max'])) {
                $this->addUsingAlias(AlbumTableMap::COL_P1, $p1['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AlbumTableMap::COL_P1, $p1, $comparison);
    }

    /**
     * Filter the query on the p2 column
     *
     * Example usage:
     * <code>
     * $query->filterByP2(1234); // WHERE p2 = 1234
     * $query->filterByP2(array(12, 34)); // WHERE p2 IN (12, 34)
     * $query->filterByP2(array('min' => 12)); // WHERE p2 > 12
     * </code>
     *
     * @param     mixed $p2 The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAlbumQuery The current query, for fluid interface
     */
    public function filterByP2($p2 = null, $comparison = null)
    {
        if (is_array($p2)) {
            $useMinMax = false;
            if (isset($p2['min'])) {
                $this->addUsingAlias(AlbumTableMap::COL_P2, $p2['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($p2['max'])) {
                $this->addUsingAlias(AlbumTableMap::COL_P2, $p2['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AlbumTableMap::COL_P2, $p2, $comparison);
    }

    /**
     * Filter the query on the p3 column
     *
     * Example usage:
     * <code>
     * $query->filterByP3(1234); // WHERE p3 = 1234
     * $query->filterByP3(array(12, 34)); // WHERE p3 IN (12, 34)
     * $query->filterByP3(array('min' => 12)); // WHERE p3 > 12
     * </code>
     *
     * @param     mixed $p3 The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAlbumQuery The current query, for fluid interface
     */
    public function filterByP3($p3 = null, $comparison = null)
    {
        if (is_array($p3)) {
            $useMinMax = false;
            if (isset($p3['min'])) {
                $this->addUsingAlias(AlbumTableMap::COL_P3, $p3['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($p3['max'])) {
                $this->addUsingAlias(AlbumTableMap::COL_P3, $p3['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AlbumTableMap::COL_P3, $p3, $comparison);
    }

    /**
     * Filter the query on the p4 column
     *
     * Example usage:
     * <code>
     * $query->filterByP4(1234); // WHERE p4 = 1234
     * $query->filterByP4(array(12, 34)); // WHERE p4 IN (12, 34)
     * $query->filterByP4(array('min' => 12)); // WHERE p4 > 12
     * </code>
     *
     * @param     mixed $p4 The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAlbumQuery The current query, for fluid interface
     */
    public function filterByP4($p4 = null, $comparison = null)
    {
        if (is_array($p4)) {
            $useMinMax = false;
            if (isset($p4['min'])) {
                $this->addUsingAlias(AlbumTableMap::COL_P4, $p4['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($p4['max'])) {
                $this->addUsingAlias(AlbumTableMap::COL_P4, $p4['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AlbumTableMap::COL_P4, $p4, $comparison);
    }

    /**
     * Filter the query on the p5 column
     *
     * Example usage:
     * <code>
     * $query->filterByP5(1234); // WHERE p5 = 1234
     * $query->filterByP5(array(12, 34)); // WHERE p5 IN (12, 34)
     * $query->filterByP5(array('min' => 12)); // WHERE p5 > 12
     * </code>
     *
     * @param     mixed $p5 The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAlbumQuery The current query, for fluid interface
     */
    public function filterByP5($p5 = null, $comparison = null)
    {
        if (is_array($p5)) {
            $useMinMax = false;
            if (isset($p5['min'])) {
                $this->addUsingAlias(AlbumTableMap::COL_P5, $p5['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($p5['max'])) {
                $this->addUsingAlias(AlbumTableMap::COL_P5, $p5['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AlbumTableMap::COL_P5, $p5, $comparison);
    }

    /**
     * Filter the query on the p6 column
     *
     * Example usage:
     * <code>
     * $query->filterByP6(1234); // WHERE p6 = 1234
     * $query->filterByP6(array(12, 34)); // WHERE p6 IN (12, 34)
     * $query->filterByP6(array('min' => 12)); // WHERE p6 > 12
     * </code>
     *
     * @param     mixed $p6 The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAlbumQuery The current query, for fluid interface
     */
    public function filterByP6($p6 = null, $comparison = null)
    {
        if (is_array($p6)) {
            $useMinMax = false;
            if (isset($p6['min'])) {
                $this->addUsingAlias(AlbumTableMap::COL_P6, $p6['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($p6['max'])) {
                $this->addUsingAlias(AlbumTableMap::COL_P6, $p6['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AlbumTableMap::COL_P6, $p6, $comparison);
    }

    /**
     * Filter the query on the p7 column
     *
     * Example usage:
     * <code>
     * $query->filterByP7(1234); // WHERE p7 = 1234
     * $query->filterByP7(array(12, 34)); // WHERE p7 IN (12, 34)
     * $query->filterByP7(array('min' => 12)); // WHERE p7 > 12
     * </code>
     *
     * @param     mixed $p7 The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAlbumQuery The current query, for fluid interface
     */
    public function filterByP7($p7 = null, $comparison = null)
    {
        if (is_array($p7)) {
            $useMinMax = false;
            if (isset($p7['min'])) {
                $this->addUsingAlias(AlbumTableMap::COL_P7, $p7['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($p7['max'])) {
                $this->addUsingAlias(AlbumTableMap::COL_P7, $p7['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AlbumTableMap::COL_P7, $p7, $comparison);
    }

    /**
     * Filter the query on the p8 column
     *
     * Example usage:
     * <code>
     * $query->filterByP8(1234); // WHERE p8 = 1234
     * $query->filterByP8(array(12, 34)); // WHERE p8 IN (12, 34)
     * $query->filterByP8(array('min' => 12)); // WHERE p8 > 12
     * </code>
     *
     * @param     mixed $p8 The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAlbumQuery The current query, for fluid interface
     */
    public function filterByP8($p8 = null, $comparison = null)
    {
        if (is_array($p8)) {
            $useMinMax = false;
            if (isset($p8['min'])) {
                $this->addUsingAlias(AlbumTableMap::COL_P8, $p8['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($p8['max'])) {
                $this->addUsingAlias(AlbumTableMap::COL_P8, $p8['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AlbumTableMap::COL_P8, $p8, $comparison);
    }

    /**
     * Filter the query on the p9 column
     *
     * Example usage:
     * <code>
     * $query->filterByP9(1234); // WHERE p9 = 1234
     * $query->filterByP9(array(12, 34)); // WHERE p9 IN (12, 34)
     * $query->filterByP9(array('min' => 12)); // WHERE p9 > 12
     * </code>
     *
     * @param     mixed $p9 The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAlbumQuery The current query, for fluid interface
     */
    public function filterByP9($p9 = null, $comparison = null)
    {
        if (is_array($p9)) {
            $useMinMax = false;
            if (isset($p9['min'])) {
                $this->addUsingAlias(AlbumTableMap::COL_P9, $p9['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($p9['max'])) {
                $this->addUsingAlias(AlbumTableMap::COL_P9, $p9['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AlbumTableMap::COL_P9, $p9, $comparison);
    }

    /**
     * Filter the query on the p10 column
     *
     * Example usage:
     * <code>
     * $query->filterByP10(1234); // WHERE p10 = 1234
     * $query->filterByP10(array(12, 34)); // WHERE p10 IN (12, 34)
     * $query->filterByP10(array('min' => 12)); // WHERE p10 > 12
     * </code>
     *
     * @param     mixed $p10 The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAlbumQuery The current query, for fluid interface
     */
    public function filterByP10($p10 = null, $comparison = null)
    {
        if (is_array($p10)) {
            $useMinMax = false;
            if (isset($p10['min'])) {
                $this->addUsingAlias(AlbumTableMap::COL_P10, $p10['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($p10['max'])) {
                $this->addUsingAlias(AlbumTableMap::COL_P10, $p10['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AlbumTableMap::COL_P10, $p10, $comparison);
    }

    /**
     * Filter the query on the p11 column
     *
     * Example usage:
     * <code>
     * $query->filterByP11(1234); // WHERE p11 = 1234
     * $query->filterByP11(array(12, 34)); // WHERE p11 IN (12, 34)
     * $query->filterByP11(array('min' => 12)); // WHERE p11 > 12
     * </code>
     *
     * @param     mixed $p11 The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAlbumQuery The current query, for fluid interface
     */
    public function filterByP11($p11 = null, $comparison = null)
    {
        if (is_array($p11)) {
            $useMinMax = false;
            if (isset($p11['min'])) {
                $this->addUsingAlias(AlbumTableMap::COL_P11, $p11['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($p11['max'])) {
                $this->addUsingAlias(AlbumTableMap::COL_P11, $p11['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AlbumTableMap::COL_P11, $p11, $comparison);
    }

    /**
     * Filter the query on the p12 column
     *
     * Example usage:
     * <code>
     * $query->filterByP12(1234); // WHERE p12 = 1234
     * $query->filterByP12(array(12, 34)); // WHERE p12 IN (12, 34)
     * $query->filterByP12(array('min' => 12)); // WHERE p12 > 12
     * </code>
     *
     * @param     mixed $p12 The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAlbumQuery The current query, for fluid interface
     */
    public function filterByP12($p12 = null, $comparison = null)
    {
        if (is_array($p12)) {
            $useMinMax = false;
            if (isset($p12['min'])) {
                $this->addUsingAlias(AlbumTableMap::COL_P12, $p12['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($p12['max'])) {
                $this->addUsingAlias(AlbumTableMap::COL_P12, $p12['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AlbumTableMap::COL_P12, $p12, $comparison);
    }

    /**
     * Filter the query on the p13 column
     *
     * Example usage:
     * <code>
     * $query->filterByP13(1234); // WHERE p13 = 1234
     * $query->filterByP13(array(12, 34)); // WHERE p13 IN (12, 34)
     * $query->filterByP13(array('min' => 12)); // WHERE p13 > 12
     * </code>
     *
     * @param     mixed $p13 The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAlbumQuery The current query, for fluid interface
     */
    public function filterByP13($p13 = null, $comparison = null)
    {
        if (is_array($p13)) {
            $useMinMax = false;
            if (isset($p13['min'])) {
                $this->addUsingAlias(AlbumTableMap::COL_P13, $p13['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($p13['max'])) {
                $this->addUsingAlias(AlbumTableMap::COL_P13, $p13['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AlbumTableMap::COL_P13, $p13, $comparison);
    }

    /**
     * Filter the query on the p14 column
     *
     * Example usage:
     * <code>
     * $query->filterByP14(1234); // WHERE p14 = 1234
     * $query->filterByP14(array(12, 34)); // WHERE p14 IN (12, 34)
     * $query->filterByP14(array('min' => 12)); // WHERE p14 > 12
     * </code>
     *
     * @param     mixed $p14 The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAlbumQuery The current query, for fluid interface
     */
    public function filterByP14($p14 = null, $comparison = null)
    {
        if (is_array($p14)) {
            $useMinMax = false;
            if (isset($p14['min'])) {
                $this->addUsingAlias(AlbumTableMap::COL_P14, $p14['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($p14['max'])) {
                $this->addUsingAlias(AlbumTableMap::COL_P14, $p14['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AlbumTableMap::COL_P14, $p14, $comparison);
    }

    /**
     * Filter the query on the p15 column
     *
     * Example usage:
     * <code>
     * $query->filterByP15(1234); // WHERE p15 = 1234
     * $query->filterByP15(array(12, 34)); // WHERE p15 IN (12, 34)
     * $query->filterByP15(array('min' => 12)); // WHERE p15 > 12
     * </code>
     *
     * @param     mixed $p15 The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAlbumQuery The current query, for fluid interface
     */
    public function filterByP15($p15 = null, $comparison = null)
    {
        if (is_array($p15)) {
            $useMinMax = false;
            if (isset($p15['min'])) {
                $this->addUsingAlias(AlbumTableMap::COL_P15, $p15['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($p15['max'])) {
                $this->addUsingAlias(AlbumTableMap::COL_P15, $p15['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AlbumTableMap::COL_P15, $p15, $comparison);
    }

    /**
     * Filter the query on the p16 column
     *
     * Example usage:
     * <code>
     * $query->filterByP16(1234); // WHERE p16 = 1234
     * $query->filterByP16(array(12, 34)); // WHERE p16 IN (12, 34)
     * $query->filterByP16(array('min' => 12)); // WHERE p16 > 12
     * </code>
     *
     * @param     mixed $p16 The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAlbumQuery The current query, for fluid interface
     */
    public function filterByP16($p16 = null, $comparison = null)
    {
        if (is_array($p16)) {
            $useMinMax = false;
            if (isset($p16['min'])) {
                $this->addUsingAlias(AlbumTableMap::COL_P16, $p16['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($p16['max'])) {
                $this->addUsingAlias(AlbumTableMap::COL_P16, $p16['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AlbumTableMap::COL_P16, $p16, $comparison);
    }

    /**
     * Filter the query on the p17 column
     *
     * Example usage:
     * <code>
     * $query->filterByP17(1234); // WHERE p17 = 1234
     * $query->filterByP17(array(12, 34)); // WHERE p17 IN (12, 34)
     * $query->filterByP17(array('min' => 12)); // WHERE p17 > 12
     * </code>
     *
     * @param     mixed $p17 The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAlbumQuery The current query, for fluid interface
     */
    public function filterByP17($p17 = null, $comparison = null)
    {
        if (is_array($p17)) {
            $useMinMax = false;
            if (isset($p17['min'])) {
                $this->addUsingAlias(AlbumTableMap::COL_P17, $p17['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($p17['max'])) {
                $this->addUsingAlias(AlbumTableMap::COL_P17, $p17['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AlbumTableMap::COL_P17, $p17, $comparison);
    }

    /**
     * Filter the query on the p18 column
     *
     * Example usage:
     * <code>
     * $query->filterByP18(1234); // WHERE p18 = 1234
     * $query->filterByP18(array(12, 34)); // WHERE p18 IN (12, 34)
     * $query->filterByP18(array('min' => 12)); // WHERE p18 > 12
     * </code>
     *
     * @param     mixed $p18 The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAlbumQuery The current query, for fluid interface
     */
    public function filterByP18($p18 = null, $comparison = null)
    {
        if (is_array($p18)) {
            $useMinMax = false;
            if (isset($p18['min'])) {
                $this->addUsingAlias(AlbumTableMap::COL_P18, $p18['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($p18['max'])) {
                $this->addUsingAlias(AlbumTableMap::COL_P18, $p18['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AlbumTableMap::COL_P18, $p18, $comparison);
    }

    /**
     * Filter the query on the p19 column
     *
     * Example usage:
     * <code>
     * $query->filterByP19(1234); // WHERE p19 = 1234
     * $query->filterByP19(array(12, 34)); // WHERE p19 IN (12, 34)
     * $query->filterByP19(array('min' => 12)); // WHERE p19 > 12
     * </code>
     *
     * @param     mixed $p19 The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAlbumQuery The current query, for fluid interface
     */
    public function filterByP19($p19 = null, $comparison = null)
    {
        if (is_array($p19)) {
            $useMinMax = false;
            if (isset($p19['min'])) {
                $this->addUsingAlias(AlbumTableMap::COL_P19, $p19['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($p19['max'])) {
                $this->addUsingAlias(AlbumTableMap::COL_P19, $p19['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AlbumTableMap::COL_P19, $p19, $comparison);
    }

    /**
     * Filter the query on the p20 column
     *
     * Example usage:
     * <code>
     * $query->filterByP20(1234); // WHERE p20 = 1234
     * $query->filterByP20(array(12, 34)); // WHERE p20 IN (12, 34)
     * $query->filterByP20(array('min' => 12)); // WHERE p20 > 12
     * </code>
     *
     * @param     mixed $p20 The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAlbumQuery The current query, for fluid interface
     */
    public function filterByP20($p20 = null, $comparison = null)
    {
        if (is_array($p20)) {
            $useMinMax = false;
            if (isset($p20['min'])) {
                $this->addUsingAlias(AlbumTableMap::COL_P20, $p20['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($p20['max'])) {
                $this->addUsingAlias(AlbumTableMap::COL_P20, $p20['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AlbumTableMap::COL_P20, $p20, $comparison);
    }

    /**
     * Filter the query on the p21 column
     *
     * Example usage:
     * <code>
     * $query->filterByP21(1234); // WHERE p21 = 1234
     * $query->filterByP21(array(12, 34)); // WHERE p21 IN (12, 34)
     * $query->filterByP21(array('min' => 12)); // WHERE p21 > 12
     * </code>
     *
     * @param     mixed $p21 The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAlbumQuery The current query, for fluid interface
     */
    public function filterByP21($p21 = null, $comparison = null)
    {
        if (is_array($p21)) {
            $useMinMax = false;
            if (isset($p21['min'])) {
                $this->addUsingAlias(AlbumTableMap::COL_P21, $p21['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($p21['max'])) {
                $this->addUsingAlias(AlbumTableMap::COL_P21, $p21['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AlbumTableMap::COL_P21, $p21, $comparison);
    }

    /**
     * Filter the query on the p22 column
     *
     * Example usage:
     * <code>
     * $query->filterByP22(1234); // WHERE p22 = 1234
     * $query->filterByP22(array(12, 34)); // WHERE p22 IN (12, 34)
     * $query->filterByP22(array('min' => 12)); // WHERE p22 > 12
     * </code>
     *
     * @param     mixed $p22 The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAlbumQuery The current query, for fluid interface
     */
    public function filterByP22($p22 = null, $comparison = null)
    {
        if (is_array($p22)) {
            $useMinMax = false;
            if (isset($p22['min'])) {
                $this->addUsingAlias(AlbumTableMap::COL_P22, $p22['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($p22['max'])) {
                $this->addUsingAlias(AlbumTableMap::COL_P22, $p22['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AlbumTableMap::COL_P22, $p22, $comparison);
    }

    /**
     * Filter the query on the p23 column
     *
     * Example usage:
     * <code>
     * $query->filterByP23(1234); // WHERE p23 = 1234
     * $query->filterByP23(array(12, 34)); // WHERE p23 IN (12, 34)
     * $query->filterByP23(array('min' => 12)); // WHERE p23 > 12
     * </code>
     *
     * @param     mixed $p23 The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAlbumQuery The current query, for fluid interface
     */
    public function filterByP23($p23 = null, $comparison = null)
    {
        if (is_array($p23)) {
            $useMinMax = false;
            if (isset($p23['min'])) {
                $this->addUsingAlias(AlbumTableMap::COL_P23, $p23['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($p23['max'])) {
                $this->addUsingAlias(AlbumTableMap::COL_P23, $p23['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AlbumTableMap::COL_P23, $p23, $comparison);
    }

    /**
     * Filter the query on the p24 column
     *
     * Example usage:
     * <code>
     * $query->filterByP24(1234); // WHERE p24 = 1234
     * $query->filterByP24(array(12, 34)); // WHERE p24 IN (12, 34)
     * $query->filterByP24(array('min' => 12)); // WHERE p24 > 12
     * </code>
     *
     * @param     mixed $p24 The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAlbumQuery The current query, for fluid interface
     */
    public function filterByP24($p24 = null, $comparison = null)
    {
        if (is_array($p24)) {
            $useMinMax = false;
            if (isset($p24['min'])) {
                $this->addUsingAlias(AlbumTableMap::COL_P24, $p24['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($p24['max'])) {
                $this->addUsingAlias(AlbumTableMap::COL_P24, $p24['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AlbumTableMap::COL_P24, $p24, $comparison);
    }

    /**
     * Filter the query on the p25 column
     *
     * Example usage:
     * <code>
     * $query->filterByP25(1234); // WHERE p25 = 1234
     * $query->filterByP25(array(12, 34)); // WHERE p25 IN (12, 34)
     * $query->filterByP25(array('min' => 12)); // WHERE p25 > 12
     * </code>
     *
     * @param     mixed $p25 The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAlbumQuery The current query, for fluid interface
     */
    public function filterByP25($p25 = null, $comparison = null)
    {
        if (is_array($p25)) {
            $useMinMax = false;
            if (isset($p25['min'])) {
                $this->addUsingAlias(AlbumTableMap::COL_P25, $p25['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($p25['max'])) {
                $this->addUsingAlias(AlbumTableMap::COL_P25, $p25['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AlbumTableMap::COL_P25, $p25, $comparison);
    }

    /**
     * Filter the query on the p26 column
     *
     * Example usage:
     * <code>
     * $query->filterByP26(1234); // WHERE p26 = 1234
     * $query->filterByP26(array(12, 34)); // WHERE p26 IN (12, 34)
     * $query->filterByP26(array('min' => 12)); // WHERE p26 > 12
     * </code>
     *
     * @param     mixed $p26 The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAlbumQuery The current query, for fluid interface
     */
    public function filterByP26($p26 = null, $comparison = null)
    {
        if (is_array($p26)) {
            $useMinMax = false;
            if (isset($p26['min'])) {
                $this->addUsingAlias(AlbumTableMap::COL_P26, $p26['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($p26['max'])) {
                $this->addUsingAlias(AlbumTableMap::COL_P26, $p26['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AlbumTableMap::COL_P26, $p26, $comparison);
    }

    /**
     * Filter the query on the p27 column
     *
     * Example usage:
     * <code>
     * $query->filterByP27(1234); // WHERE p27 = 1234
     * $query->filterByP27(array(12, 34)); // WHERE p27 IN (12, 34)
     * $query->filterByP27(array('min' => 12)); // WHERE p27 > 12
     * </code>
     *
     * @param     mixed $p27 The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAlbumQuery The current query, for fluid interface
     */
    public function filterByP27($p27 = null, $comparison = null)
    {
        if (is_array($p27)) {
            $useMinMax = false;
            if (isset($p27['min'])) {
                $this->addUsingAlias(AlbumTableMap::COL_P27, $p27['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($p27['max'])) {
                $this->addUsingAlias(AlbumTableMap::COL_P27, $p27['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AlbumTableMap::COL_P27, $p27, $comparison);
    }

    /**
     * Filter the query on the p28 column
     *
     * Example usage:
     * <code>
     * $query->filterByP28(1234); // WHERE p28 = 1234
     * $query->filterByP28(array(12, 34)); // WHERE p28 IN (12, 34)
     * $query->filterByP28(array('min' => 12)); // WHERE p28 > 12
     * </code>
     *
     * @param     mixed $p28 The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAlbumQuery The current query, for fluid interface
     */
    public function filterByP28($p28 = null, $comparison = null)
    {
        if (is_array($p28)) {
            $useMinMax = false;
            if (isset($p28['min'])) {
                $this->addUsingAlias(AlbumTableMap::COL_P28, $p28['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($p28['max'])) {
                $this->addUsingAlias(AlbumTableMap::COL_P28, $p28['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AlbumTableMap::COL_P28, $p28, $comparison);
    }

    /**
     * Filter the query on the p29 column
     *
     * Example usage:
     * <code>
     * $query->filterByP29(1234); // WHERE p29 = 1234
     * $query->filterByP29(array(12, 34)); // WHERE p29 IN (12, 34)
     * $query->filterByP29(array('min' => 12)); // WHERE p29 > 12
     * </code>
     *
     * @param     mixed $p29 The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAlbumQuery The current query, for fluid interface
     */
    public function filterByP29($p29 = null, $comparison = null)
    {
        if (is_array($p29)) {
            $useMinMax = false;
            if (isset($p29['min'])) {
                $this->addUsingAlias(AlbumTableMap::COL_P29, $p29['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($p29['max'])) {
                $this->addUsingAlias(AlbumTableMap::COL_P29, $p29['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AlbumTableMap::COL_P29, $p29, $comparison);
    }

    /**
     * Filter the query on the p30 column
     *
     * Example usage:
     * <code>
     * $query->filterByP30(1234); // WHERE p30 = 1234
     * $query->filterByP30(array(12, 34)); // WHERE p30 IN (12, 34)
     * $query->filterByP30(array('min' => 12)); // WHERE p30 > 12
     * </code>
     *
     * @param     mixed $p30 The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAlbumQuery The current query, for fluid interface
     */
    public function filterByP30($p30 = null, $comparison = null)
    {
        if (is_array($p30)) {
            $useMinMax = false;
            if (isset($p30['min'])) {
                $this->addUsingAlias(AlbumTableMap::COL_P30, $p30['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($p30['max'])) {
                $this->addUsingAlias(AlbumTableMap::COL_P30, $p30['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AlbumTableMap::COL_P30, $p30, $comparison);
    }

    /**
     * Filter the query on the p31 column
     *
     * Example usage:
     * <code>
     * $query->filterByP31(1234); // WHERE p31 = 1234
     * $query->filterByP31(array(12, 34)); // WHERE p31 IN (12, 34)
     * $query->filterByP31(array('min' => 12)); // WHERE p31 > 12
     * </code>
     *
     * @param     mixed $p31 The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAlbumQuery The current query, for fluid interface
     */
    public function filterByP31($p31 = null, $comparison = null)
    {
        if (is_array($p31)) {
            $useMinMax = false;
            if (isset($p31['min'])) {
                $this->addUsingAlias(AlbumTableMap::COL_P31, $p31['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($p31['max'])) {
                $this->addUsingAlias(AlbumTableMap::COL_P31, $p31['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AlbumTableMap::COL_P31, $p31, $comparison);
    }

    /**
     * Filter the query on the p32 column
     *
     * Example usage:
     * <code>
     * $query->filterByP32(1234); // WHERE p32 = 1234
     * $query->filterByP32(array(12, 34)); // WHERE p32 IN (12, 34)
     * $query->filterByP32(array('min' => 12)); // WHERE p32 > 12
     * </code>
     *
     * @param     mixed $p32 The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAlbumQuery The current query, for fluid interface
     */
    public function filterByP32($p32 = null, $comparison = null)
    {
        if (is_array($p32)) {
            $useMinMax = false;
            if (isset($p32['min'])) {
                $this->addUsingAlias(AlbumTableMap::COL_P32, $p32['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($p32['max'])) {
                $this->addUsingAlias(AlbumTableMap::COL_P32, $p32['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AlbumTableMap::COL_P32, $p32, $comparison);
    }

    /**
     * Filter the query on the p33 column
     *
     * Example usage:
     * <code>
     * $query->filterByP33(1234); // WHERE p33 = 1234
     * $query->filterByP33(array(12, 34)); // WHERE p33 IN (12, 34)
     * $query->filterByP33(array('min' => 12)); // WHERE p33 > 12
     * </code>
     *
     * @param     mixed $p33 The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAlbumQuery The current query, for fluid interface
     */
    public function filterByP33($p33 = null, $comparison = null)
    {
        if (is_array($p33)) {
            $useMinMax = false;
            if (isset($p33['min'])) {
                $this->addUsingAlias(AlbumTableMap::COL_P33, $p33['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($p33['max'])) {
                $this->addUsingAlias(AlbumTableMap::COL_P33, $p33['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AlbumTableMap::COL_P33, $p33, $comparison);
    }

    /**
     * Filter the query on the p34 column
     *
     * Example usage:
     * <code>
     * $query->filterByP34(1234); // WHERE p34 = 1234
     * $query->filterByP34(array(12, 34)); // WHERE p34 IN (12, 34)
     * $query->filterByP34(array('min' => 12)); // WHERE p34 > 12
     * </code>
     *
     * @param     mixed $p34 The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAlbumQuery The current query, for fluid interface
     */
    public function filterByP34($p34 = null, $comparison = null)
    {
        if (is_array($p34)) {
            $useMinMax = false;
            if (isset($p34['min'])) {
                $this->addUsingAlias(AlbumTableMap::COL_P34, $p34['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($p34['max'])) {
                $this->addUsingAlias(AlbumTableMap::COL_P34, $p34['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AlbumTableMap::COL_P34, $p34, $comparison);
    }

    /**
     * Filter the query on the p35 column
     *
     * Example usage:
     * <code>
     * $query->filterByP35(1234); // WHERE p35 = 1234
     * $query->filterByP35(array(12, 34)); // WHERE p35 IN (12, 34)
     * $query->filterByP35(array('min' => 12)); // WHERE p35 > 12
     * </code>
     *
     * @param     mixed $p35 The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAlbumQuery The current query, for fluid interface
     */
    public function filterByP35($p35 = null, $comparison = null)
    {
        if (is_array($p35)) {
            $useMinMax = false;
            if (isset($p35['min'])) {
                $this->addUsingAlias(AlbumTableMap::COL_P35, $p35['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($p35['max'])) {
                $this->addUsingAlias(AlbumTableMap::COL_P35, $p35['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AlbumTableMap::COL_P35, $p35, $comparison);
    }

    /**
     * Filter the query on the p1n column
     *
     * Example usage:
     * <code>
     * $query->filterByP1n('fooValue');   // WHERE p1n = 'fooValue'
     * $query->filterByP1n('%fooValue%'); // WHERE p1n LIKE '%fooValue%'
     * </code>
     *
     * @param     string $p1n The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAlbumQuery The current query, for fluid interface
     */
    public function filterByP1n($p1n = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($p1n)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $p1n)) {
                $p1n = str_replace('*', '%', $p1n);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(AlbumTableMap::COL_P1N, $p1n, $comparison);
    }

    /**
     * Filter the query on the p2n column
     *
     * Example usage:
     * <code>
     * $query->filterByP2n('fooValue');   // WHERE p2n = 'fooValue'
     * $query->filterByP2n('%fooValue%'); // WHERE p2n LIKE '%fooValue%'
     * </code>
     *
     * @param     string $p2n The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAlbumQuery The current query, for fluid interface
     */
    public function filterByP2n($p2n = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($p2n)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $p2n)) {
                $p2n = str_replace('*', '%', $p2n);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(AlbumTableMap::COL_P2N, $p2n, $comparison);
    }

    /**
     * Filter the query on the p3n column
     *
     * Example usage:
     * <code>
     * $query->filterByP3n('fooValue');   // WHERE p3n = 'fooValue'
     * $query->filterByP3n('%fooValue%'); // WHERE p3n LIKE '%fooValue%'
     * </code>
     *
     * @param     string $p3n The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAlbumQuery The current query, for fluid interface
     */
    public function filterByP3n($p3n = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($p3n)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $p3n)) {
                $p3n = str_replace('*', '%', $p3n);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(AlbumTableMap::COL_P3N, $p3n, $comparison);
    }

    /**
     * Filter the query on the p4n column
     *
     * Example usage:
     * <code>
     * $query->filterByP4n('fooValue');   // WHERE p4n = 'fooValue'
     * $query->filterByP4n('%fooValue%'); // WHERE p4n LIKE '%fooValue%'
     * </code>
     *
     * @param     string $p4n The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAlbumQuery The current query, for fluid interface
     */
    public function filterByP4n($p4n = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($p4n)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $p4n)) {
                $p4n = str_replace('*', '%', $p4n);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(AlbumTableMap::COL_P4N, $p4n, $comparison);
    }

    /**
     * Filter the query on the p5n column
     *
     * Example usage:
     * <code>
     * $query->filterByP5n('fooValue');   // WHERE p5n = 'fooValue'
     * $query->filterByP5n('%fooValue%'); // WHERE p5n LIKE '%fooValue%'
     * </code>
     *
     * @param     string $p5n The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAlbumQuery The current query, for fluid interface
     */
    public function filterByP5n($p5n = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($p5n)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $p5n)) {
                $p5n = str_replace('*', '%', $p5n);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(AlbumTableMap::COL_P5N, $p5n, $comparison);
    }

    /**
     * Filter the query on the p6n column
     *
     * Example usage:
     * <code>
     * $query->filterByP6n('fooValue');   // WHERE p6n = 'fooValue'
     * $query->filterByP6n('%fooValue%'); // WHERE p6n LIKE '%fooValue%'
     * </code>
     *
     * @param     string $p6n The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAlbumQuery The current query, for fluid interface
     */
    public function filterByP6n($p6n = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($p6n)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $p6n)) {
                $p6n = str_replace('*', '%', $p6n);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(AlbumTableMap::COL_P6N, $p6n, $comparison);
    }

    /**
     * Filter the query on the p7n column
     *
     * Example usage:
     * <code>
     * $query->filterByP7n('fooValue');   // WHERE p7n = 'fooValue'
     * $query->filterByP7n('%fooValue%'); // WHERE p7n LIKE '%fooValue%'
     * </code>
     *
     * @param     string $p7n The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAlbumQuery The current query, for fluid interface
     */
    public function filterByP7n($p7n = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($p7n)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $p7n)) {
                $p7n = str_replace('*', '%', $p7n);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(AlbumTableMap::COL_P7N, $p7n, $comparison);
    }

    /**
     * Filter the query on the p8n column
     *
     * Example usage:
     * <code>
     * $query->filterByP8n('fooValue');   // WHERE p8n = 'fooValue'
     * $query->filterByP8n('%fooValue%'); // WHERE p8n LIKE '%fooValue%'
     * </code>
     *
     * @param     string $p8n The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAlbumQuery The current query, for fluid interface
     */
    public function filterByP8n($p8n = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($p8n)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $p8n)) {
                $p8n = str_replace('*', '%', $p8n);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(AlbumTableMap::COL_P8N, $p8n, $comparison);
    }

    /**
     * Filter the query on the p9n column
     *
     * Example usage:
     * <code>
     * $query->filterByP9n('fooValue');   // WHERE p9n = 'fooValue'
     * $query->filterByP9n('%fooValue%'); // WHERE p9n LIKE '%fooValue%'
     * </code>
     *
     * @param     string $p9n The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAlbumQuery The current query, for fluid interface
     */
    public function filterByP9n($p9n = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($p9n)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $p9n)) {
                $p9n = str_replace('*', '%', $p9n);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(AlbumTableMap::COL_P9N, $p9n, $comparison);
    }

    /**
     * Filter the query on the p10n column
     *
     * Example usage:
     * <code>
     * $query->filterByP10n('fooValue');   // WHERE p10n = 'fooValue'
     * $query->filterByP10n('%fooValue%'); // WHERE p10n LIKE '%fooValue%'
     * </code>
     *
     * @param     string $p10n The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAlbumQuery The current query, for fluid interface
     */
    public function filterByP10n($p10n = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($p10n)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $p10n)) {
                $p10n = str_replace('*', '%', $p10n);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(AlbumTableMap::COL_P10N, $p10n, $comparison);
    }

    /**
     * Filter the query on the p11n column
     *
     * Example usage:
     * <code>
     * $query->filterByP11n('fooValue');   // WHERE p11n = 'fooValue'
     * $query->filterByP11n('%fooValue%'); // WHERE p11n LIKE '%fooValue%'
     * </code>
     *
     * @param     string $p11n The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAlbumQuery The current query, for fluid interface
     */
    public function filterByP11n($p11n = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($p11n)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $p11n)) {
                $p11n = str_replace('*', '%', $p11n);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(AlbumTableMap::COL_P11N, $p11n, $comparison);
    }

    /**
     * Filter the query on the p12n column
     *
     * Example usage:
     * <code>
     * $query->filterByP12n('fooValue');   // WHERE p12n = 'fooValue'
     * $query->filterByP12n('%fooValue%'); // WHERE p12n LIKE '%fooValue%'
     * </code>
     *
     * @param     string $p12n The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAlbumQuery The current query, for fluid interface
     */
    public function filterByP12n($p12n = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($p12n)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $p12n)) {
                $p12n = str_replace('*', '%', $p12n);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(AlbumTableMap::COL_P12N, $p12n, $comparison);
    }

    /**
     * Filter the query on the p13n column
     *
     * Example usage:
     * <code>
     * $query->filterByP13n('fooValue');   // WHERE p13n = 'fooValue'
     * $query->filterByP13n('%fooValue%'); // WHERE p13n LIKE '%fooValue%'
     * </code>
     *
     * @param     string $p13n The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAlbumQuery The current query, for fluid interface
     */
    public function filterByP13n($p13n = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($p13n)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $p13n)) {
                $p13n = str_replace('*', '%', $p13n);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(AlbumTableMap::COL_P13N, $p13n, $comparison);
    }

    /**
     * Filter the query on the p14n column
     *
     * Example usage:
     * <code>
     * $query->filterByP14n('fooValue');   // WHERE p14n = 'fooValue'
     * $query->filterByP14n('%fooValue%'); // WHERE p14n LIKE '%fooValue%'
     * </code>
     *
     * @param     string $p14n The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAlbumQuery The current query, for fluid interface
     */
    public function filterByP14n($p14n = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($p14n)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $p14n)) {
                $p14n = str_replace('*', '%', $p14n);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(AlbumTableMap::COL_P14N, $p14n, $comparison);
    }

    /**
     * Filter the query on the p15n column
     *
     * Example usage:
     * <code>
     * $query->filterByP15n('fooValue');   // WHERE p15n = 'fooValue'
     * $query->filterByP15n('%fooValue%'); // WHERE p15n LIKE '%fooValue%'
     * </code>
     *
     * @param     string $p15n The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAlbumQuery The current query, for fluid interface
     */
    public function filterByP15n($p15n = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($p15n)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $p15n)) {
                $p15n = str_replace('*', '%', $p15n);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(AlbumTableMap::COL_P15N, $p15n, $comparison);
    }

    /**
     * Filter the query on the p16n column
     *
     * Example usage:
     * <code>
     * $query->filterByP16n('fooValue');   // WHERE p16n = 'fooValue'
     * $query->filterByP16n('%fooValue%'); // WHERE p16n LIKE '%fooValue%'
     * </code>
     *
     * @param     string $p16n The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAlbumQuery The current query, for fluid interface
     */
    public function filterByP16n($p16n = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($p16n)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $p16n)) {
                $p16n = str_replace('*', '%', $p16n);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(AlbumTableMap::COL_P16N, $p16n, $comparison);
    }

    /**
     * Filter the query on the p17n column
     *
     * Example usage:
     * <code>
     * $query->filterByP17n('fooValue');   // WHERE p17n = 'fooValue'
     * $query->filterByP17n('%fooValue%'); // WHERE p17n LIKE '%fooValue%'
     * </code>
     *
     * @param     string $p17n The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAlbumQuery The current query, for fluid interface
     */
    public function filterByP17n($p17n = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($p17n)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $p17n)) {
                $p17n = str_replace('*', '%', $p17n);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(AlbumTableMap::COL_P17N, $p17n, $comparison);
    }

    /**
     * Filter the query on the p18n column
     *
     * Example usage:
     * <code>
     * $query->filterByP18n('fooValue');   // WHERE p18n = 'fooValue'
     * $query->filterByP18n('%fooValue%'); // WHERE p18n LIKE '%fooValue%'
     * </code>
     *
     * @param     string $p18n The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAlbumQuery The current query, for fluid interface
     */
    public function filterByP18n($p18n = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($p18n)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $p18n)) {
                $p18n = str_replace('*', '%', $p18n);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(AlbumTableMap::COL_P18N, $p18n, $comparison);
    }

    /**
     * Filter the query on the p19n column
     *
     * Example usage:
     * <code>
     * $query->filterByP19n('fooValue');   // WHERE p19n = 'fooValue'
     * $query->filterByP19n('%fooValue%'); // WHERE p19n LIKE '%fooValue%'
     * </code>
     *
     * @param     string $p19n The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAlbumQuery The current query, for fluid interface
     */
    public function filterByP19n($p19n = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($p19n)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $p19n)) {
                $p19n = str_replace('*', '%', $p19n);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(AlbumTableMap::COL_P19N, $p19n, $comparison);
    }

    /**
     * Filter the query on the p20n column
     *
     * Example usage:
     * <code>
     * $query->filterByP20n('fooValue');   // WHERE p20n = 'fooValue'
     * $query->filterByP20n('%fooValue%'); // WHERE p20n LIKE '%fooValue%'
     * </code>
     *
     * @param     string $p20n The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAlbumQuery The current query, for fluid interface
     */
    public function filterByP20n($p20n = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($p20n)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $p20n)) {
                $p20n = str_replace('*', '%', $p20n);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(AlbumTableMap::COL_P20N, $p20n, $comparison);
    }

    /**
     * Filter the query on the p21n column
     *
     * Example usage:
     * <code>
     * $query->filterByP21n('fooValue');   // WHERE p21n = 'fooValue'
     * $query->filterByP21n('%fooValue%'); // WHERE p21n LIKE '%fooValue%'
     * </code>
     *
     * @param     string $p21n The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAlbumQuery The current query, for fluid interface
     */
    public function filterByP21n($p21n = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($p21n)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $p21n)) {
                $p21n = str_replace('*', '%', $p21n);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(AlbumTableMap::COL_P21N, $p21n, $comparison);
    }

    /**
     * Filter the query on the p22n column
     *
     * Example usage:
     * <code>
     * $query->filterByP22n('fooValue');   // WHERE p22n = 'fooValue'
     * $query->filterByP22n('%fooValue%'); // WHERE p22n LIKE '%fooValue%'
     * </code>
     *
     * @param     string $p22n The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAlbumQuery The current query, for fluid interface
     */
    public function filterByP22n($p22n = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($p22n)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $p22n)) {
                $p22n = str_replace('*', '%', $p22n);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(AlbumTableMap::COL_P22N, $p22n, $comparison);
    }

    /**
     * Filter the query on the p23n column
     *
     * Example usage:
     * <code>
     * $query->filterByP23n('fooValue');   // WHERE p23n = 'fooValue'
     * $query->filterByP23n('%fooValue%'); // WHERE p23n LIKE '%fooValue%'
     * </code>
     *
     * @param     string $p23n The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAlbumQuery The current query, for fluid interface
     */
    public function filterByP23n($p23n = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($p23n)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $p23n)) {
                $p23n = str_replace('*', '%', $p23n);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(AlbumTableMap::COL_P23N, $p23n, $comparison);
    }

    /**
     * Filter the query on the p24n column
     *
     * Example usage:
     * <code>
     * $query->filterByP24n('fooValue');   // WHERE p24n = 'fooValue'
     * $query->filterByP24n('%fooValue%'); // WHERE p24n LIKE '%fooValue%'
     * </code>
     *
     * @param     string $p24n The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAlbumQuery The current query, for fluid interface
     */
    public function filterByP24n($p24n = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($p24n)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $p24n)) {
                $p24n = str_replace('*', '%', $p24n);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(AlbumTableMap::COL_P24N, $p24n, $comparison);
    }

    /**
     * Filter the query on the p25n column
     *
     * Example usage:
     * <code>
     * $query->filterByP25n('fooValue');   // WHERE p25n = 'fooValue'
     * $query->filterByP25n('%fooValue%'); // WHERE p25n LIKE '%fooValue%'
     * </code>
     *
     * @param     string $p25n The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAlbumQuery The current query, for fluid interface
     */
    public function filterByP25n($p25n = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($p25n)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $p25n)) {
                $p25n = str_replace('*', '%', $p25n);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(AlbumTableMap::COL_P25N, $p25n, $comparison);
    }

    /**
     * Filter the query on the p26n column
     *
     * Example usage:
     * <code>
     * $query->filterByP26n('fooValue');   // WHERE p26n = 'fooValue'
     * $query->filterByP26n('%fooValue%'); // WHERE p26n LIKE '%fooValue%'
     * </code>
     *
     * @param     string $p26n The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAlbumQuery The current query, for fluid interface
     */
    public function filterByP26n($p26n = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($p26n)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $p26n)) {
                $p26n = str_replace('*', '%', $p26n);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(AlbumTableMap::COL_P26N, $p26n, $comparison);
    }

    /**
     * Filter the query on the p27n column
     *
     * Example usage:
     * <code>
     * $query->filterByP27n('fooValue');   // WHERE p27n = 'fooValue'
     * $query->filterByP27n('%fooValue%'); // WHERE p27n LIKE '%fooValue%'
     * </code>
     *
     * @param     string $p27n The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAlbumQuery The current query, for fluid interface
     */
    public function filterByP27n($p27n = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($p27n)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $p27n)) {
                $p27n = str_replace('*', '%', $p27n);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(AlbumTableMap::COL_P27N, $p27n, $comparison);
    }

    /**
     * Filter the query on the p28n column
     *
     * Example usage:
     * <code>
     * $query->filterByP28n('fooValue');   // WHERE p28n = 'fooValue'
     * $query->filterByP28n('%fooValue%'); // WHERE p28n LIKE '%fooValue%'
     * </code>
     *
     * @param     string $p28n The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAlbumQuery The current query, for fluid interface
     */
    public function filterByP28n($p28n = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($p28n)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $p28n)) {
                $p28n = str_replace('*', '%', $p28n);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(AlbumTableMap::COL_P28N, $p28n, $comparison);
    }

    /**
     * Filter the query on the p29n column
     *
     * Example usage:
     * <code>
     * $query->filterByP29n('fooValue');   // WHERE p29n = 'fooValue'
     * $query->filterByP29n('%fooValue%'); // WHERE p29n LIKE '%fooValue%'
     * </code>
     *
     * @param     string $p29n The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAlbumQuery The current query, for fluid interface
     */
    public function filterByP29n($p29n = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($p29n)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $p29n)) {
                $p29n = str_replace('*', '%', $p29n);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(AlbumTableMap::COL_P29N, $p29n, $comparison);
    }

    /**
     * Filter the query on the p30n column
     *
     * Example usage:
     * <code>
     * $query->filterByP30n('fooValue');   // WHERE p30n = 'fooValue'
     * $query->filterByP30n('%fooValue%'); // WHERE p30n LIKE '%fooValue%'
     * </code>
     *
     * @param     string $p30n The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAlbumQuery The current query, for fluid interface
     */
    public function filterByP30n($p30n = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($p30n)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $p30n)) {
                $p30n = str_replace('*', '%', $p30n);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(AlbumTableMap::COL_P30N, $p30n, $comparison);
    }

    /**
     * Filter the query on the p31n column
     *
     * Example usage:
     * <code>
     * $query->filterByP31n('fooValue');   // WHERE p31n = 'fooValue'
     * $query->filterByP31n('%fooValue%'); // WHERE p31n LIKE '%fooValue%'
     * </code>
     *
     * @param     string $p31n The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAlbumQuery The current query, for fluid interface
     */
    public function filterByP31n($p31n = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($p31n)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $p31n)) {
                $p31n = str_replace('*', '%', $p31n);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(AlbumTableMap::COL_P31N, $p31n, $comparison);
    }

    /**
     * Filter the query on the p32n column
     *
     * Example usage:
     * <code>
     * $query->filterByP32n('fooValue');   // WHERE p32n = 'fooValue'
     * $query->filterByP32n('%fooValue%'); // WHERE p32n LIKE '%fooValue%'
     * </code>
     *
     * @param     string $p32n The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAlbumQuery The current query, for fluid interface
     */
    public function filterByP32n($p32n = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($p32n)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $p32n)) {
                $p32n = str_replace('*', '%', $p32n);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(AlbumTableMap::COL_P32N, $p32n, $comparison);
    }

    /**
     * Filter the query on the p33n column
     *
     * Example usage:
     * <code>
     * $query->filterByP33n('fooValue');   // WHERE p33n = 'fooValue'
     * $query->filterByP33n('%fooValue%'); // WHERE p33n LIKE '%fooValue%'
     * </code>
     *
     * @param     string $p33n The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAlbumQuery The current query, for fluid interface
     */
    public function filterByP33n($p33n = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($p33n)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $p33n)) {
                $p33n = str_replace('*', '%', $p33n);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(AlbumTableMap::COL_P33N, $p33n, $comparison);
    }

    /**
     * Filter the query on the p34n column
     *
     * Example usage:
     * <code>
     * $query->filterByP34n('fooValue');   // WHERE p34n = 'fooValue'
     * $query->filterByP34n('%fooValue%'); // WHERE p34n LIKE '%fooValue%'
     * </code>
     *
     * @param     string $p34n The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAlbumQuery The current query, for fluid interface
     */
    public function filterByP34n($p34n = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($p34n)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $p34n)) {
                $p34n = str_replace('*', '%', $p34n);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(AlbumTableMap::COL_P34N, $p34n, $comparison);
    }

    /**
     * Filter the query on the p35n column
     *
     * Example usage:
     * <code>
     * $query->filterByP35n('fooValue');   // WHERE p35n = 'fooValue'
     * $query->filterByP35n('%fooValue%'); // WHERE p35n LIKE '%fooValue%'
     * </code>
     *
     * @param     string $p35n The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAlbumQuery The current query, for fluid interface
     */
    public function filterByP35n($p35n = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($p35n)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $p35n)) {
                $p35n = str_replace('*', '%', $p35n);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(AlbumTableMap::COL_P35N, $p35n, $comparison);
    }

    /**
     * Exclude object from result
     *
     * @param   ChildAlbum $album Object to remove from the list of results
     *
     * @return $this|ChildAlbumQuery The current query, for fluid interface
     */
    public function prune($album = null)
    {
        if ($album) {
            $this->addUsingAlias(AlbumTableMap::COL_ID, $album->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the albums table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(AlbumTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            AlbumTableMap::clearInstancePool();
            AlbumTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(AlbumTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(AlbumTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            AlbumTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            AlbumTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // AlbumQuery
