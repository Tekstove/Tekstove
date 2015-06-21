<?php

namespace Tekstove\TekstoveBundle\Model\Entity\Base;

use \Exception;
use \PDO;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;
use Tekstove\TekstoveBundle\Model\Entity\Lyric as ChildLyric;
use Tekstove\TekstoveBundle\Model\Entity\LyricQuery as ChildLyricQuery;
use Tekstove\TekstoveBundle\Model\Entity\Map\LyricTableMap;

/**
 * Base class that represents a query for the 'lyric' table.
 *
 *
 *
 * @method     ChildLyricQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildLyricQuery orderByZaglaviePalno($order = Criteria::ASC) Order by the zaglavie_palno column
 * @method     ChildLyricQuery orderByFullTitleShort($order = Criteria::ASC) Order by the zaglavie_sakrateno column
 * @method     ChildLyricQuery orderByUpId($order = Criteria::ASC) Order by the up_id column
 * @method     ChildLyricQuery orderByText($order = Criteria::ASC) Order by the text column
 * @method     ChildLyricQuery orderByTextBg($order = Criteria::ASC) Order by the text_bg column
 * @method     ChildLyricQuery orderByArtist1($order = Criteria::ASC) Order by the artist1 column
 * @method     ChildLyricQuery orderByArtist2($order = Criteria::ASC) Order by the artist2 column
 * @method     ChildLyricQuery orderByArtist3($order = Criteria::ASC) Order by the artist3 column
 * @method     ChildLyricQuery orderByArtist4($order = Criteria::ASC) Order by the artist4 column
 * @method     ChildLyricQuery orderByArtist5($order = Criteria::ASC) Order by the artist5 column
 * @method     ChildLyricQuery orderByArtist6($order = Criteria::ASC) Order by the artist6 column
 * @method     ChildLyricQuery orderByTitle($order = Criteria::ASC) Order by the title column
 * @method     ChildLyricQuery orderByAlbum1($order = Criteria::ASC) Order by the album1 column
 * @method     ChildLyricQuery orderByAlbum2($order = Criteria::ASC) Order by the album2 column
 * @method     ChildLyricQuery orderByVideo($order = Criteria::ASC) Order by the video column
 * @method     ChildLyricQuery orderByVideoVbox7($order = Criteria::ASC) Order by the video_vbox7 column
 * @method     ChildLyricQuery orderByVideoVbox7Orig($order = Criteria::ASC) Order by the video_vbox7_orig column
 * @method     ChildLyricQuery orderByVideoYoutube($order = Criteria::ASC) Order by the video_youtube column
 * @method     ChildLyricQuery orderByVideoYoutubeOrig($order = Criteria::ASC) Order by the video_youtube_orig column
 * @method     ChildLyricQuery orderByVideoMetacafe($order = Criteria::ASC) Order by the video_metacafe column
 * @method     ChildLyricQuery orderByVideoMetacafeOrig($order = Criteria::ASC) Order by the video_metacafe_orig column
 * @method     ChildLyricQuery orderByDownload($order = Criteria::ASC) Order by the download column
 * @method     ChildLyricQuery orderByImage($order = Criteria::ASC) Order by the image column
 * @method     ChildLyricQuery orderByPodnovena($order = Criteria::ASC) Order by the podnovena column
 * @method     ChildLyricQuery orderByIpUpload($order = Criteria::ASC) Order by the ip_upload column
 * @method     ChildLyricQuery orderByDopylnitelnoinfo($order = Criteria::ASC) Order by the dopylnitelnoinfo column
 * @method     ChildLyricQuery orderByGlasa($order = Criteria::ASC) Order by the glasa column
 * @method     ChildLyricQuery orderByVidqna($order = Criteria::ASC) Order by the vidqna column
 * @method     ChildLyricQuery orderByPopulqrnost($order = Criteria::ASC) Order by the populqrnost column
 * @method     ChildLyricQuery orderByStilraphiphop($order = Criteria::ASC) Order by the stilraphiphop column
 * @method     ChildLyricQuery orderByStilhiphop($order = Criteria::ASC) Order by the stilhiphop column
 * @method     ChildLyricQuery orderByStileastcoast($order = Criteria::ASC) Order by the stileastcoast column
 * @method     ChildLyricQuery orderByPeeSeNa($order = Criteria::ASC) Order by the pee_se_na column
 * @method     ChildLyricQuery orderByStilskit($order = Criteria::ASC) Order by the stilskit column
 * @method     ChildLyricQuery orderByStilelektronna($order = Criteria::ASC) Order by the stilelektronna column
 * @method     ChildLyricQuery orderByStilrok($order = Criteria::ASC) Order by the stilrok column
 * @method     ChildLyricQuery orderByStilrokClas($order = Criteria::ASC) Order by the stilrok_clas column
 * @method     ChildLyricQuery orderByStilrokAlt($order = Criteria::ASC) Order by the stilrok_alt column
 * @method     ChildLyricQuery orderByStilrokHard($order = Criteria::ASC) Order by the stilrok_hard column
 * @method     ChildLyricQuery orderByStildisko($order = Criteria::ASC) Order by the stildisko column
 * @method     ChildLyricQuery orderByStillatam($order = Criteria::ASC) Order by the stillatam column
 * @method     ChildLyricQuery orderByStilsamba($order = Criteria::ASC) Order by the stilsamba column
 * @method     ChildLyricQuery orderByStiltango($order = Criteria::ASC) Order by the stiltango column
 * @method     ChildLyricQuery orderByStilsalsa($order = Criteria::ASC) Order by the stilsalsa column
 * @method     ChildLyricQuery orderByStilklasi($order = Criteria::ASC) Order by the stilklasi column
 * @method     ChildLyricQuery orderByStildetski($order = Criteria::ASC) Order by the stildetski column
 * @method     ChildLyricQuery orderByStilfolk($order = Criteria::ASC) Order by the stilfolk column
 * @method     ChildLyricQuery orderByStilnarodna($order = Criteria::ASC) Order by the stilnarodna column
 * @method     ChildLyricQuery orderByStilchalga($order = Criteria::ASC) Order by the stilchalga column
 * @method     ChildLyricQuery orderByStilpopfolk($order = Criteria::ASC) Order by the stilpopfolk column
 * @method     ChildLyricQuery orderByStilmetal($order = Criteria::ASC) Order by the stilmetal column
 * @method     ChildLyricQuery orderByStilmetalHeavy($order = Criteria::ASC) Order by the stilmetal_heavy column
 * @method     ChildLyricQuery orderByStilmetalPower($order = Criteria::ASC) Order by the stilmetal_power column
 * @method     ChildLyricQuery orderByStilmetalDeath($order = Criteria::ASC) Order by the stilmetal_death column
 * @method     ChildLyricQuery orderByStilmetalNu($order = Criteria::ASC) Order by the stilmetal_nu column
 * @method     ChildLyricQuery orderByStilmetalGothic($order = Criteria::ASC) Order by the stilmetal_gothic column
 * @method     ChildLyricQuery orderByStilmetalSymphonic($order = Criteria::ASC) Order by the stilmetal_symphonic column
 * @method     ChildLyricQuery orderByStilsoundtrack($order = Criteria::ASC) Order by the stilsoundtrack column
 * @method     ChildLyricQuery orderByStildance($order = Criteria::ASC) Order by the stildance column
 * @method     ChildLyricQuery orderByStilrnb($order = Criteria::ASC) Order by the stilRnB column
 * @method     ChildLyricQuery orderByStilsoul($order = Criteria::ASC) Order by the stilsoul column
 * @method     ChildLyricQuery orderByStilnewRave($order = Criteria::ASC) Order by the stilnew_rave column
 * @method     ChildLyricQuery orderByStilreggae($order = Criteria::ASC) Order by the stilreggae column
 * @method     ChildLyricQuery orderByStilkantri($order = Criteria::ASC) Order by the stilkantri column
 * @method     ChildLyricQuery orderByStilpunk($order = Criteria::ASC) Order by the stilpunk column
 * @method     ChildLyricQuery orderByStilemo($order = Criteria::ASC) Order by the stilemo column
 * @method     ChildLyricQuery orderByStilbreakbeat($order = Criteria::ASC) Order by the stilbreakbeat column
 * @method     ChildLyricQuery orderByStilbigbeat($order = Criteria::ASC) Order by the stilbigbeat column
 * @method     ChildLyricQuery orderByStiljaz($order = Criteria::ASC) Order by the stiljaz column
 * @method     ChildLyricQuery orderByStilblus($order = Criteria::ASC) Order by the stilblus column
 * @method     ChildLyricQuery orderByStilelectronica($order = Criteria::ASC) Order by the stilelectronica column
 * @method     ChildLyricQuery orderByStilska($order = Criteria::ASC) Order by the stilska column
 *
 * @method     ChildLyricQuery groupById() Group by the id column
 * @method     ChildLyricQuery groupByZaglaviePalno() Group by the zaglavie_palno column
 * @method     ChildLyricQuery groupByFullTitleShort() Group by the zaglavie_sakrateno column
 * @method     ChildLyricQuery groupByUpId() Group by the up_id column
 * @method     ChildLyricQuery groupByText() Group by the text column
 * @method     ChildLyricQuery groupByTextBg() Group by the text_bg column
 * @method     ChildLyricQuery groupByArtist1() Group by the artist1 column
 * @method     ChildLyricQuery groupByArtist2() Group by the artist2 column
 * @method     ChildLyricQuery groupByArtist3() Group by the artist3 column
 * @method     ChildLyricQuery groupByArtist4() Group by the artist4 column
 * @method     ChildLyricQuery groupByArtist5() Group by the artist5 column
 * @method     ChildLyricQuery groupByArtist6() Group by the artist6 column
 * @method     ChildLyricQuery groupByTitle() Group by the title column
 * @method     ChildLyricQuery groupByAlbum1() Group by the album1 column
 * @method     ChildLyricQuery groupByAlbum2() Group by the album2 column
 * @method     ChildLyricQuery groupByVideo() Group by the video column
 * @method     ChildLyricQuery groupByVideoVbox7() Group by the video_vbox7 column
 * @method     ChildLyricQuery groupByVideoVbox7Orig() Group by the video_vbox7_orig column
 * @method     ChildLyricQuery groupByVideoYoutube() Group by the video_youtube column
 * @method     ChildLyricQuery groupByVideoYoutubeOrig() Group by the video_youtube_orig column
 * @method     ChildLyricQuery groupByVideoMetacafe() Group by the video_metacafe column
 * @method     ChildLyricQuery groupByVideoMetacafeOrig() Group by the video_metacafe_orig column
 * @method     ChildLyricQuery groupByDownload() Group by the download column
 * @method     ChildLyricQuery groupByImage() Group by the image column
 * @method     ChildLyricQuery groupByPodnovena() Group by the podnovena column
 * @method     ChildLyricQuery groupByIpUpload() Group by the ip_upload column
 * @method     ChildLyricQuery groupByDopylnitelnoinfo() Group by the dopylnitelnoinfo column
 * @method     ChildLyricQuery groupByGlasa() Group by the glasa column
 * @method     ChildLyricQuery groupByVidqna() Group by the vidqna column
 * @method     ChildLyricQuery groupByPopulqrnost() Group by the populqrnost column
 * @method     ChildLyricQuery groupByStilraphiphop() Group by the stilraphiphop column
 * @method     ChildLyricQuery groupByStilhiphop() Group by the stilhiphop column
 * @method     ChildLyricQuery groupByStileastcoast() Group by the stileastcoast column
 * @method     ChildLyricQuery groupByPeeSeNa() Group by the pee_se_na column
 * @method     ChildLyricQuery groupByStilskit() Group by the stilskit column
 * @method     ChildLyricQuery groupByStilelektronna() Group by the stilelektronna column
 * @method     ChildLyricQuery groupByStilrok() Group by the stilrok column
 * @method     ChildLyricQuery groupByStilrokClas() Group by the stilrok_clas column
 * @method     ChildLyricQuery groupByStilrokAlt() Group by the stilrok_alt column
 * @method     ChildLyricQuery groupByStilrokHard() Group by the stilrok_hard column
 * @method     ChildLyricQuery groupByStildisko() Group by the stildisko column
 * @method     ChildLyricQuery groupByStillatam() Group by the stillatam column
 * @method     ChildLyricQuery groupByStilsamba() Group by the stilsamba column
 * @method     ChildLyricQuery groupByStiltango() Group by the stiltango column
 * @method     ChildLyricQuery groupByStilsalsa() Group by the stilsalsa column
 * @method     ChildLyricQuery groupByStilklasi() Group by the stilklasi column
 * @method     ChildLyricQuery groupByStildetski() Group by the stildetski column
 * @method     ChildLyricQuery groupByStilfolk() Group by the stilfolk column
 * @method     ChildLyricQuery groupByStilnarodna() Group by the stilnarodna column
 * @method     ChildLyricQuery groupByStilchalga() Group by the stilchalga column
 * @method     ChildLyricQuery groupByStilpopfolk() Group by the stilpopfolk column
 * @method     ChildLyricQuery groupByStilmetal() Group by the stilmetal column
 * @method     ChildLyricQuery groupByStilmetalHeavy() Group by the stilmetal_heavy column
 * @method     ChildLyricQuery groupByStilmetalPower() Group by the stilmetal_power column
 * @method     ChildLyricQuery groupByStilmetalDeath() Group by the stilmetal_death column
 * @method     ChildLyricQuery groupByStilmetalNu() Group by the stilmetal_nu column
 * @method     ChildLyricQuery groupByStilmetalGothic() Group by the stilmetal_gothic column
 * @method     ChildLyricQuery groupByStilmetalSymphonic() Group by the stilmetal_symphonic column
 * @method     ChildLyricQuery groupByStilsoundtrack() Group by the stilsoundtrack column
 * @method     ChildLyricQuery groupByStildance() Group by the stildance column
 * @method     ChildLyricQuery groupByStilrnb() Group by the stilRnB column
 * @method     ChildLyricQuery groupByStilsoul() Group by the stilsoul column
 * @method     ChildLyricQuery groupByStilnewRave() Group by the stilnew_rave column
 * @method     ChildLyricQuery groupByStilreggae() Group by the stilreggae column
 * @method     ChildLyricQuery groupByStilkantri() Group by the stilkantri column
 * @method     ChildLyricQuery groupByStilpunk() Group by the stilpunk column
 * @method     ChildLyricQuery groupByStilemo() Group by the stilemo column
 * @method     ChildLyricQuery groupByStilbreakbeat() Group by the stilbreakbeat column
 * @method     ChildLyricQuery groupByStilbigbeat() Group by the stilbigbeat column
 * @method     ChildLyricQuery groupByStiljaz() Group by the stiljaz column
 * @method     ChildLyricQuery groupByStilblus() Group by the stilblus column
 * @method     ChildLyricQuery groupByStilelectronica() Group by the stilelectronica column
 * @method     ChildLyricQuery groupByStilska() Group by the stilska column
 *
 * @method     ChildLyricQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildLyricQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildLyricQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildLyricQuery leftJoinComments($relationAlias = null) Adds a LEFT JOIN clause to the query using the Comments relation
 * @method     ChildLyricQuery rightJoinComments($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Comments relation
 * @method     ChildLyricQuery innerJoinComments($relationAlias = null) Adds a INNER JOIN clause to the query using the Comments relation
 *
 * @method     ChildLyricQuery leftJoinEditAddPrevod($relationAlias = null) Adds a LEFT JOIN clause to the query using the EditAddPrevod relation
 * @method     ChildLyricQuery rightJoinEditAddPrevod($relationAlias = null) Adds a RIGHT JOIN clause to the query using the EditAddPrevod relation
 * @method     ChildLyricQuery innerJoinEditAddPrevod($relationAlias = null) Adds a INNER JOIN clause to the query using the EditAddPrevod relation
 *
 * @method     ChildLyricQuery leftJoinGlasuvane($relationAlias = null) Adds a LEFT JOIN clause to the query using the Glasuvane relation
 * @method     ChildLyricQuery rightJoinGlasuvane($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Glasuvane relation
 * @method     ChildLyricQuery innerJoinGlasuvane($relationAlias = null) Adds a INNER JOIN clause to the query using the Glasuvane relation
 *
 * @method     ChildLyricQuery leftJoinLiubimi($relationAlias = null) Adds a LEFT JOIN clause to the query using the Liubimi relation
 * @method     ChildLyricQuery rightJoinLiubimi($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Liubimi relation
 * @method     ChildLyricQuery innerJoinLiubimi($relationAlias = null) Adds a INNER JOIN clause to the query using the Liubimi relation
 *
 * @method     ChildLyricQuery leftJoinLyric18($relationAlias = null) Adds a LEFT JOIN clause to the query using the Lyric18 relation
 * @method     ChildLyricQuery rightJoinLyric18($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Lyric18 relation
 * @method     ChildLyricQuery innerJoinLyric18($relationAlias = null) Adds a INNER JOIN clause to the query using the Lyric18 relation
 *
 * @method     ChildLyricQuery leftJoinLyricRedirect($relationAlias = null) Adds a LEFT JOIN clause to the query using the LyricRedirect relation
 * @method     ChildLyricQuery rightJoinLyricRedirect($relationAlias = null) Adds a RIGHT JOIN clause to the query using the LyricRedirect relation
 * @method     ChildLyricQuery innerJoinLyricRedirect($relationAlias = null) Adds a INNER JOIN clause to the query using the LyricRedirect relation
 *
 * @method     \Tekstove\TekstoveBundle\Model\Entity\CommentsQuery|\Tekstove\TekstoveBundle\Model\Entity\EditAddPrevodQuery|\Tekstove\TekstoveBundle\Model\Entity\GlasuvaneQuery|\Tekstove\TekstoveBundle\Model\Entity\LiubimiQuery|\Tekstove\TekstoveBundle\Model\Entity\Lyric18Query|\Tekstove\TekstoveBundle\Model\Entity\LyricRedirectQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildLyric findOne(ConnectionInterface $con = null) Return the first ChildLyric matching the query
 * @method     ChildLyric findOneOrCreate(ConnectionInterface $con = null) Return the first ChildLyric matching the query, or a new ChildLyric object populated from the query conditions when no match is found
 *
 * @method     ChildLyric findOneById(int $id) Return the first ChildLyric filtered by the id column
 * @method     ChildLyric findOneByZaglaviePalno(string $zaglavie_palno) Return the first ChildLyric filtered by the zaglavie_palno column
 * @method     ChildLyric findOneByFullTitleShort(string $zaglavie_sakrateno) Return the first ChildLyric filtered by the zaglavie_sakrateno column
 * @method     ChildLyric findOneByUpId(int $up_id) Return the first ChildLyric filtered by the up_id column
 * @method     ChildLyric findOneByText(string $text) Return the first ChildLyric filtered by the text column
 * @method     ChildLyric findOneByTextBg(string $text_bg) Return the first ChildLyric filtered by the text_bg column
 * @method     ChildLyric findOneByArtist1(int $artist1) Return the first ChildLyric filtered by the artist1 column
 * @method     ChildLyric findOneByArtist2(int $artist2) Return the first ChildLyric filtered by the artist2 column
 * @method     ChildLyric findOneByArtist3(int $artist3) Return the first ChildLyric filtered by the artist3 column
 * @method     ChildLyric findOneByArtist4(int $artist4) Return the first ChildLyric filtered by the artist4 column
 * @method     ChildLyric findOneByArtist5(int $artist5) Return the first ChildLyric filtered by the artist5 column
 * @method     ChildLyric findOneByArtist6(int $artist6) Return the first ChildLyric filtered by the artist6 column
 * @method     ChildLyric findOneByTitle(string $title) Return the first ChildLyric filtered by the title column
 * @method     ChildLyric findOneByAlbum1(int $album1) Return the first ChildLyric filtered by the album1 column
 * @method     ChildLyric findOneByAlbum2(int $album2) Return the first ChildLyric filtered by the album2 column
 * @method     ChildLyric findOneByVideo(string $video) Return the first ChildLyric filtered by the video column
 * @method     ChildLyric findOneByVideoVbox7(string $video_vbox7) Return the first ChildLyric filtered by the video_vbox7 column
 * @method     ChildLyric findOneByVideoVbox7Orig(string $video_vbox7_orig) Return the first ChildLyric filtered by the video_vbox7_orig column
 * @method     ChildLyric findOneByVideoYoutube(string $video_youtube) Return the first ChildLyric filtered by the video_youtube column
 * @method     ChildLyric findOneByVideoYoutubeOrig(string $video_youtube_orig) Return the first ChildLyric filtered by the video_youtube_orig column
 * @method     ChildLyric findOneByVideoMetacafe(string $video_metacafe) Return the first ChildLyric filtered by the video_metacafe column
 * @method     ChildLyric findOneByVideoMetacafeOrig(string $video_metacafe_orig) Return the first ChildLyric filtered by the video_metacafe_orig column
 * @method     ChildLyric findOneByDownload(string $download) Return the first ChildLyric filtered by the download column
 * @method     ChildLyric findOneByImage(string $image) Return the first ChildLyric filtered by the image column
 * @method     ChildLyric findOneByPodnovena(string $podnovena) Return the first ChildLyric filtered by the podnovena column
 * @method     ChildLyric findOneByIpUpload(string $ip_upload) Return the first ChildLyric filtered by the ip_upload column
 * @method     ChildLyric findOneByDopylnitelnoinfo(string $dopylnitelnoinfo) Return the first ChildLyric filtered by the dopylnitelnoinfo column
 * @method     ChildLyric findOneByGlasa(int $glasa) Return the first ChildLyric filtered by the glasa column
 * @method     ChildLyric findOneByVidqna(int $vidqna) Return the first ChildLyric filtered by the vidqna column
 * @method     ChildLyric findOneByPopulqrnost(int $populqrnost) Return the first ChildLyric filtered by the populqrnost column
 * @method     ChildLyric findOneByStilraphiphop(boolean $stilraphiphop) Return the first ChildLyric filtered by the stilraphiphop column
 * @method     ChildLyric findOneByStilhiphop(boolean $stilhiphop) Return the first ChildLyric filtered by the stilhiphop column
 * @method     ChildLyric findOneByStileastcoast(boolean $stileastcoast) Return the first ChildLyric filtered by the stileastcoast column
 * @method     ChildLyric findOneByPeeSeNa(boolean $pee_se_na) Return the first ChildLyric filtered by the pee_se_na column
 * @method     ChildLyric findOneByStilskit(boolean $stilskit) Return the first ChildLyric filtered by the stilskit column
 * @method     ChildLyric findOneByStilelektronna(boolean $stilelektronna) Return the first ChildLyric filtered by the stilelektronna column
 * @method     ChildLyric findOneByStilrok(boolean $stilrok) Return the first ChildLyric filtered by the stilrok column
 * @method     ChildLyric findOneByStilrokClas(boolean $stilrok_clas) Return the first ChildLyric filtered by the stilrok_clas column
 * @method     ChildLyric findOneByStilrokAlt(boolean $stilrok_alt) Return the first ChildLyric filtered by the stilrok_alt column
 * @method     ChildLyric findOneByStilrokHard(boolean $stilrok_hard) Return the first ChildLyric filtered by the stilrok_hard column
 * @method     ChildLyric findOneByStildisko(boolean $stildisko) Return the first ChildLyric filtered by the stildisko column
 * @method     ChildLyric findOneByStillatam(boolean $stillatam) Return the first ChildLyric filtered by the stillatam column
 * @method     ChildLyric findOneByStilsamba(boolean $stilsamba) Return the first ChildLyric filtered by the stilsamba column
 * @method     ChildLyric findOneByStiltango(boolean $stiltango) Return the first ChildLyric filtered by the stiltango column
 * @method     ChildLyric findOneByStilsalsa(boolean $stilsalsa) Return the first ChildLyric filtered by the stilsalsa column
 * @method     ChildLyric findOneByStilklasi(boolean $stilklasi) Return the first ChildLyric filtered by the stilklasi column
 * @method     ChildLyric findOneByStildetski(boolean $stildetski) Return the first ChildLyric filtered by the stildetski column
 * @method     ChildLyric findOneByStilfolk(boolean $stilfolk) Return the first ChildLyric filtered by the stilfolk column
 * @method     ChildLyric findOneByStilnarodna(boolean $stilnarodna) Return the first ChildLyric filtered by the stilnarodna column
 * @method     ChildLyric findOneByStilchalga(boolean $stilchalga) Return the first ChildLyric filtered by the stilchalga column
 * @method     ChildLyric findOneByStilpopfolk(boolean $stilpopfolk) Return the first ChildLyric filtered by the stilpopfolk column
 * @method     ChildLyric findOneByStilmetal(boolean $stilmetal) Return the first ChildLyric filtered by the stilmetal column
 * @method     ChildLyric findOneByStilmetalHeavy(boolean $stilmetal_heavy) Return the first ChildLyric filtered by the stilmetal_heavy column
 * @method     ChildLyric findOneByStilmetalPower(boolean $stilmetal_power) Return the first ChildLyric filtered by the stilmetal_power column
 * @method     ChildLyric findOneByStilmetalDeath(boolean $stilmetal_death) Return the first ChildLyric filtered by the stilmetal_death column
 * @method     ChildLyric findOneByStilmetalNu(boolean $stilmetal_nu) Return the first ChildLyric filtered by the stilmetal_nu column
 * @method     ChildLyric findOneByStilmetalGothic(boolean $stilmetal_gothic) Return the first ChildLyric filtered by the stilmetal_gothic column
 * @method     ChildLyric findOneByStilmetalSymphonic(boolean $stilmetal_symphonic) Return the first ChildLyric filtered by the stilmetal_symphonic column
 * @method     ChildLyric findOneByStilsoundtrack(boolean $stilsoundtrack) Return the first ChildLyric filtered by the stilsoundtrack column
 * @method     ChildLyric findOneByStildance(boolean $stildance) Return the first ChildLyric filtered by the stildance column
 * @method     ChildLyric findOneByStilrnb(boolean $stilRnB) Return the first ChildLyric filtered by the stilRnB column
 * @method     ChildLyric findOneByStilsoul(boolean $stilsoul) Return the first ChildLyric filtered by the stilsoul column
 * @method     ChildLyric findOneByStilnewRave(boolean $stilnew_rave) Return the first ChildLyric filtered by the stilnew_rave column
 * @method     ChildLyric findOneByStilreggae(boolean $stilreggae) Return the first ChildLyric filtered by the stilreggae column
 * @method     ChildLyric findOneByStilkantri(boolean $stilkantri) Return the first ChildLyric filtered by the stilkantri column
 * @method     ChildLyric findOneByStilpunk(boolean $stilpunk) Return the first ChildLyric filtered by the stilpunk column
 * @method     ChildLyric findOneByStilemo(boolean $stilemo) Return the first ChildLyric filtered by the stilemo column
 * @method     ChildLyric findOneByStilbreakbeat(boolean $stilbreakbeat) Return the first ChildLyric filtered by the stilbreakbeat column
 * @method     ChildLyric findOneByStilbigbeat(boolean $stilbigbeat) Return the first ChildLyric filtered by the stilbigbeat column
 * @method     ChildLyric findOneByStiljaz(boolean $stiljaz) Return the first ChildLyric filtered by the stiljaz column
 * @method     ChildLyric findOneByStilblus(boolean $stilblus) Return the first ChildLyric filtered by the stilblus column
 * @method     ChildLyric findOneByStilelectronica(boolean $stilelectronica) Return the first ChildLyric filtered by the stilelectronica column
 * @method     ChildLyric findOneByStilska(boolean $stilska) Return the first ChildLyric filtered by the stilska column *

 * @method     ChildLyric requirePk($key, ConnectionInterface $con = null) Return the ChildLyric by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLyric requireOne(ConnectionInterface $con = null) Return the first ChildLyric matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildLyric requireOneById(int $id) Return the first ChildLyric filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLyric requireOneByZaglaviePalno(string $zaglavie_palno) Return the first ChildLyric filtered by the zaglavie_palno column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLyric requireOneByFullTitleShort(string $zaglavie_sakrateno) Return the first ChildLyric filtered by the zaglavie_sakrateno column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLyric requireOneByUpId(int $up_id) Return the first ChildLyric filtered by the up_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLyric requireOneByText(string $text) Return the first ChildLyric filtered by the text column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLyric requireOneByTextBg(string $text_bg) Return the first ChildLyric filtered by the text_bg column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLyric requireOneByArtist1(int $artist1) Return the first ChildLyric filtered by the artist1 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLyric requireOneByArtist2(int $artist2) Return the first ChildLyric filtered by the artist2 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLyric requireOneByArtist3(int $artist3) Return the first ChildLyric filtered by the artist3 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLyric requireOneByArtist4(int $artist4) Return the first ChildLyric filtered by the artist4 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLyric requireOneByArtist5(int $artist5) Return the first ChildLyric filtered by the artist5 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLyric requireOneByArtist6(int $artist6) Return the first ChildLyric filtered by the artist6 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLyric requireOneByTitle(string $title) Return the first ChildLyric filtered by the title column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLyric requireOneByAlbum1(int $album1) Return the first ChildLyric filtered by the album1 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLyric requireOneByAlbum2(int $album2) Return the first ChildLyric filtered by the album2 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLyric requireOneByVideo(string $video) Return the first ChildLyric filtered by the video column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLyric requireOneByVideoVbox7(string $video_vbox7) Return the first ChildLyric filtered by the video_vbox7 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLyric requireOneByVideoVbox7Orig(string $video_vbox7_orig) Return the first ChildLyric filtered by the video_vbox7_orig column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLyric requireOneByVideoYoutube(string $video_youtube) Return the first ChildLyric filtered by the video_youtube column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLyric requireOneByVideoYoutubeOrig(string $video_youtube_orig) Return the first ChildLyric filtered by the video_youtube_orig column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLyric requireOneByVideoMetacafe(string $video_metacafe) Return the first ChildLyric filtered by the video_metacafe column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLyric requireOneByVideoMetacafeOrig(string $video_metacafe_orig) Return the first ChildLyric filtered by the video_metacafe_orig column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLyric requireOneByDownload(string $download) Return the first ChildLyric filtered by the download column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLyric requireOneByImage(string $image) Return the first ChildLyric filtered by the image column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLyric requireOneByPodnovena(string $podnovena) Return the first ChildLyric filtered by the podnovena column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLyric requireOneByIpUpload(string $ip_upload) Return the first ChildLyric filtered by the ip_upload column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLyric requireOneByDopylnitelnoinfo(string $dopylnitelnoinfo) Return the first ChildLyric filtered by the dopylnitelnoinfo column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLyric requireOneByGlasa(int $glasa) Return the first ChildLyric filtered by the glasa column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLyric requireOneByVidqna(int $vidqna) Return the first ChildLyric filtered by the vidqna column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLyric requireOneByPopulqrnost(int $populqrnost) Return the first ChildLyric filtered by the populqrnost column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLyric requireOneByStilraphiphop(boolean $stilraphiphop) Return the first ChildLyric filtered by the stilraphiphop column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLyric requireOneByStilhiphop(boolean $stilhiphop) Return the first ChildLyric filtered by the stilhiphop column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLyric requireOneByStileastcoast(boolean $stileastcoast) Return the first ChildLyric filtered by the stileastcoast column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLyric requireOneByPeeSeNa(boolean $pee_se_na) Return the first ChildLyric filtered by the pee_se_na column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLyric requireOneByStilskit(boolean $stilskit) Return the first ChildLyric filtered by the stilskit column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLyric requireOneByStilelektronna(boolean $stilelektronna) Return the first ChildLyric filtered by the stilelektronna column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLyric requireOneByStilrok(boolean $stilrok) Return the first ChildLyric filtered by the stilrok column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLyric requireOneByStilrokClas(boolean $stilrok_clas) Return the first ChildLyric filtered by the stilrok_clas column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLyric requireOneByStilrokAlt(boolean $stilrok_alt) Return the first ChildLyric filtered by the stilrok_alt column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLyric requireOneByStilrokHard(boolean $stilrok_hard) Return the first ChildLyric filtered by the stilrok_hard column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLyric requireOneByStildisko(boolean $stildisko) Return the first ChildLyric filtered by the stildisko column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLyric requireOneByStillatam(boolean $stillatam) Return the first ChildLyric filtered by the stillatam column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLyric requireOneByStilsamba(boolean $stilsamba) Return the first ChildLyric filtered by the stilsamba column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLyric requireOneByStiltango(boolean $stiltango) Return the first ChildLyric filtered by the stiltango column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLyric requireOneByStilsalsa(boolean $stilsalsa) Return the first ChildLyric filtered by the stilsalsa column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLyric requireOneByStilklasi(boolean $stilklasi) Return the first ChildLyric filtered by the stilklasi column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLyric requireOneByStildetski(boolean $stildetski) Return the first ChildLyric filtered by the stildetski column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLyric requireOneByStilfolk(boolean $stilfolk) Return the first ChildLyric filtered by the stilfolk column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLyric requireOneByStilnarodna(boolean $stilnarodna) Return the first ChildLyric filtered by the stilnarodna column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLyric requireOneByStilchalga(boolean $stilchalga) Return the first ChildLyric filtered by the stilchalga column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLyric requireOneByStilpopfolk(boolean $stilpopfolk) Return the first ChildLyric filtered by the stilpopfolk column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLyric requireOneByStilmetal(boolean $stilmetal) Return the first ChildLyric filtered by the stilmetal column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLyric requireOneByStilmetalHeavy(boolean $stilmetal_heavy) Return the first ChildLyric filtered by the stilmetal_heavy column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLyric requireOneByStilmetalPower(boolean $stilmetal_power) Return the first ChildLyric filtered by the stilmetal_power column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLyric requireOneByStilmetalDeath(boolean $stilmetal_death) Return the first ChildLyric filtered by the stilmetal_death column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLyric requireOneByStilmetalNu(boolean $stilmetal_nu) Return the first ChildLyric filtered by the stilmetal_nu column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLyric requireOneByStilmetalGothic(boolean $stilmetal_gothic) Return the first ChildLyric filtered by the stilmetal_gothic column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLyric requireOneByStilmetalSymphonic(boolean $stilmetal_symphonic) Return the first ChildLyric filtered by the stilmetal_symphonic column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLyric requireOneByStilsoundtrack(boolean $stilsoundtrack) Return the first ChildLyric filtered by the stilsoundtrack column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLyric requireOneByStildance(boolean $stildance) Return the first ChildLyric filtered by the stildance column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLyric requireOneByStilrnb(boolean $stilRnB) Return the first ChildLyric filtered by the stilRnB column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLyric requireOneByStilsoul(boolean $stilsoul) Return the first ChildLyric filtered by the stilsoul column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLyric requireOneByStilnewRave(boolean $stilnew_rave) Return the first ChildLyric filtered by the stilnew_rave column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLyric requireOneByStilreggae(boolean $stilreggae) Return the first ChildLyric filtered by the stilreggae column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLyric requireOneByStilkantri(boolean $stilkantri) Return the first ChildLyric filtered by the stilkantri column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLyric requireOneByStilpunk(boolean $stilpunk) Return the first ChildLyric filtered by the stilpunk column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLyric requireOneByStilemo(boolean $stilemo) Return the first ChildLyric filtered by the stilemo column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLyric requireOneByStilbreakbeat(boolean $stilbreakbeat) Return the first ChildLyric filtered by the stilbreakbeat column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLyric requireOneByStilbigbeat(boolean $stilbigbeat) Return the first ChildLyric filtered by the stilbigbeat column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLyric requireOneByStiljaz(boolean $stiljaz) Return the first ChildLyric filtered by the stiljaz column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLyric requireOneByStilblus(boolean $stilblus) Return the first ChildLyric filtered by the stilblus column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLyric requireOneByStilelectronica(boolean $stilelectronica) Return the first ChildLyric filtered by the stilelectronica column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildLyric requireOneByStilska(boolean $stilska) Return the first ChildLyric filtered by the stilska column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildLyric[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildLyric objects based on current ModelCriteria
 * @method     ChildLyric[]|ObjectCollection findById(int $id) Return ChildLyric objects filtered by the id column
 * @method     ChildLyric[]|ObjectCollection findByZaglaviePalno(string $zaglavie_palno) Return ChildLyric objects filtered by the zaglavie_palno column
 * @method     ChildLyric[]|ObjectCollection findByFullTitleShort(string $zaglavie_sakrateno) Return ChildLyric objects filtered by the zaglavie_sakrateno column
 * @method     ChildLyric[]|ObjectCollection findByUpId(int $up_id) Return ChildLyric objects filtered by the up_id column
 * @method     ChildLyric[]|ObjectCollection findByText(string $text) Return ChildLyric objects filtered by the text column
 * @method     ChildLyric[]|ObjectCollection findByTextBg(string $text_bg) Return ChildLyric objects filtered by the text_bg column
 * @method     ChildLyric[]|ObjectCollection findByArtist1(int $artist1) Return ChildLyric objects filtered by the artist1 column
 * @method     ChildLyric[]|ObjectCollection findByArtist2(int $artist2) Return ChildLyric objects filtered by the artist2 column
 * @method     ChildLyric[]|ObjectCollection findByArtist3(int $artist3) Return ChildLyric objects filtered by the artist3 column
 * @method     ChildLyric[]|ObjectCollection findByArtist4(int $artist4) Return ChildLyric objects filtered by the artist4 column
 * @method     ChildLyric[]|ObjectCollection findByArtist5(int $artist5) Return ChildLyric objects filtered by the artist5 column
 * @method     ChildLyric[]|ObjectCollection findByArtist6(int $artist6) Return ChildLyric objects filtered by the artist6 column
 * @method     ChildLyric[]|ObjectCollection findByTitle(string $title) Return ChildLyric objects filtered by the title column
 * @method     ChildLyric[]|ObjectCollection findByAlbum1(int $album1) Return ChildLyric objects filtered by the album1 column
 * @method     ChildLyric[]|ObjectCollection findByAlbum2(int $album2) Return ChildLyric objects filtered by the album2 column
 * @method     ChildLyric[]|ObjectCollection findByVideo(string $video) Return ChildLyric objects filtered by the video column
 * @method     ChildLyric[]|ObjectCollection findByVideoVbox7(string $video_vbox7) Return ChildLyric objects filtered by the video_vbox7 column
 * @method     ChildLyric[]|ObjectCollection findByVideoVbox7Orig(string $video_vbox7_orig) Return ChildLyric objects filtered by the video_vbox7_orig column
 * @method     ChildLyric[]|ObjectCollection findByVideoYoutube(string $video_youtube) Return ChildLyric objects filtered by the video_youtube column
 * @method     ChildLyric[]|ObjectCollection findByVideoYoutubeOrig(string $video_youtube_orig) Return ChildLyric objects filtered by the video_youtube_orig column
 * @method     ChildLyric[]|ObjectCollection findByVideoMetacafe(string $video_metacafe) Return ChildLyric objects filtered by the video_metacafe column
 * @method     ChildLyric[]|ObjectCollection findByVideoMetacafeOrig(string $video_metacafe_orig) Return ChildLyric objects filtered by the video_metacafe_orig column
 * @method     ChildLyric[]|ObjectCollection findByDownload(string $download) Return ChildLyric objects filtered by the download column
 * @method     ChildLyric[]|ObjectCollection findByImage(string $image) Return ChildLyric objects filtered by the image column
 * @method     ChildLyric[]|ObjectCollection findByPodnovena(string $podnovena) Return ChildLyric objects filtered by the podnovena column
 * @method     ChildLyric[]|ObjectCollection findByIpUpload(string $ip_upload) Return ChildLyric objects filtered by the ip_upload column
 * @method     ChildLyric[]|ObjectCollection findByDopylnitelnoinfo(string $dopylnitelnoinfo) Return ChildLyric objects filtered by the dopylnitelnoinfo column
 * @method     ChildLyric[]|ObjectCollection findByGlasa(int $glasa) Return ChildLyric objects filtered by the glasa column
 * @method     ChildLyric[]|ObjectCollection findByVidqna(int $vidqna) Return ChildLyric objects filtered by the vidqna column
 * @method     ChildLyric[]|ObjectCollection findByPopulqrnost(int $populqrnost) Return ChildLyric objects filtered by the populqrnost column
 * @method     ChildLyric[]|ObjectCollection findByStilraphiphop(boolean $stilraphiphop) Return ChildLyric objects filtered by the stilraphiphop column
 * @method     ChildLyric[]|ObjectCollection findByStilhiphop(boolean $stilhiphop) Return ChildLyric objects filtered by the stilhiphop column
 * @method     ChildLyric[]|ObjectCollection findByStileastcoast(boolean $stileastcoast) Return ChildLyric objects filtered by the stileastcoast column
 * @method     ChildLyric[]|ObjectCollection findByPeeSeNa(boolean $pee_se_na) Return ChildLyric objects filtered by the pee_se_na column
 * @method     ChildLyric[]|ObjectCollection findByStilskit(boolean $stilskit) Return ChildLyric objects filtered by the stilskit column
 * @method     ChildLyric[]|ObjectCollection findByStilelektronna(boolean $stilelektronna) Return ChildLyric objects filtered by the stilelektronna column
 * @method     ChildLyric[]|ObjectCollection findByStilrok(boolean $stilrok) Return ChildLyric objects filtered by the stilrok column
 * @method     ChildLyric[]|ObjectCollection findByStilrokClas(boolean $stilrok_clas) Return ChildLyric objects filtered by the stilrok_clas column
 * @method     ChildLyric[]|ObjectCollection findByStilrokAlt(boolean $stilrok_alt) Return ChildLyric objects filtered by the stilrok_alt column
 * @method     ChildLyric[]|ObjectCollection findByStilrokHard(boolean $stilrok_hard) Return ChildLyric objects filtered by the stilrok_hard column
 * @method     ChildLyric[]|ObjectCollection findByStildisko(boolean $stildisko) Return ChildLyric objects filtered by the stildisko column
 * @method     ChildLyric[]|ObjectCollection findByStillatam(boolean $stillatam) Return ChildLyric objects filtered by the stillatam column
 * @method     ChildLyric[]|ObjectCollection findByStilsamba(boolean $stilsamba) Return ChildLyric objects filtered by the stilsamba column
 * @method     ChildLyric[]|ObjectCollection findByStiltango(boolean $stiltango) Return ChildLyric objects filtered by the stiltango column
 * @method     ChildLyric[]|ObjectCollection findByStilsalsa(boolean $stilsalsa) Return ChildLyric objects filtered by the stilsalsa column
 * @method     ChildLyric[]|ObjectCollection findByStilklasi(boolean $stilklasi) Return ChildLyric objects filtered by the stilklasi column
 * @method     ChildLyric[]|ObjectCollection findByStildetski(boolean $stildetski) Return ChildLyric objects filtered by the stildetski column
 * @method     ChildLyric[]|ObjectCollection findByStilfolk(boolean $stilfolk) Return ChildLyric objects filtered by the stilfolk column
 * @method     ChildLyric[]|ObjectCollection findByStilnarodna(boolean $stilnarodna) Return ChildLyric objects filtered by the stilnarodna column
 * @method     ChildLyric[]|ObjectCollection findByStilchalga(boolean $stilchalga) Return ChildLyric objects filtered by the stilchalga column
 * @method     ChildLyric[]|ObjectCollection findByStilpopfolk(boolean $stilpopfolk) Return ChildLyric objects filtered by the stilpopfolk column
 * @method     ChildLyric[]|ObjectCollection findByStilmetal(boolean $stilmetal) Return ChildLyric objects filtered by the stilmetal column
 * @method     ChildLyric[]|ObjectCollection findByStilmetalHeavy(boolean $stilmetal_heavy) Return ChildLyric objects filtered by the stilmetal_heavy column
 * @method     ChildLyric[]|ObjectCollection findByStilmetalPower(boolean $stilmetal_power) Return ChildLyric objects filtered by the stilmetal_power column
 * @method     ChildLyric[]|ObjectCollection findByStilmetalDeath(boolean $stilmetal_death) Return ChildLyric objects filtered by the stilmetal_death column
 * @method     ChildLyric[]|ObjectCollection findByStilmetalNu(boolean $stilmetal_nu) Return ChildLyric objects filtered by the stilmetal_nu column
 * @method     ChildLyric[]|ObjectCollection findByStilmetalGothic(boolean $stilmetal_gothic) Return ChildLyric objects filtered by the stilmetal_gothic column
 * @method     ChildLyric[]|ObjectCollection findByStilmetalSymphonic(boolean $stilmetal_symphonic) Return ChildLyric objects filtered by the stilmetal_symphonic column
 * @method     ChildLyric[]|ObjectCollection findByStilsoundtrack(boolean $stilsoundtrack) Return ChildLyric objects filtered by the stilsoundtrack column
 * @method     ChildLyric[]|ObjectCollection findByStildance(boolean $stildance) Return ChildLyric objects filtered by the stildance column
 * @method     ChildLyric[]|ObjectCollection findByStilrnb(boolean $stilRnB) Return ChildLyric objects filtered by the stilRnB column
 * @method     ChildLyric[]|ObjectCollection findByStilsoul(boolean $stilsoul) Return ChildLyric objects filtered by the stilsoul column
 * @method     ChildLyric[]|ObjectCollection findByStilnewRave(boolean $stilnew_rave) Return ChildLyric objects filtered by the stilnew_rave column
 * @method     ChildLyric[]|ObjectCollection findByStilreggae(boolean $stilreggae) Return ChildLyric objects filtered by the stilreggae column
 * @method     ChildLyric[]|ObjectCollection findByStilkantri(boolean $stilkantri) Return ChildLyric objects filtered by the stilkantri column
 * @method     ChildLyric[]|ObjectCollection findByStilpunk(boolean $stilpunk) Return ChildLyric objects filtered by the stilpunk column
 * @method     ChildLyric[]|ObjectCollection findByStilemo(boolean $stilemo) Return ChildLyric objects filtered by the stilemo column
 * @method     ChildLyric[]|ObjectCollection findByStilbreakbeat(boolean $stilbreakbeat) Return ChildLyric objects filtered by the stilbreakbeat column
 * @method     ChildLyric[]|ObjectCollection findByStilbigbeat(boolean $stilbigbeat) Return ChildLyric objects filtered by the stilbigbeat column
 * @method     ChildLyric[]|ObjectCollection findByStiljaz(boolean $stiljaz) Return ChildLyric objects filtered by the stiljaz column
 * @method     ChildLyric[]|ObjectCollection findByStilblus(boolean $stilblus) Return ChildLyric objects filtered by the stilblus column
 * @method     ChildLyric[]|ObjectCollection findByStilelectronica(boolean $stilelectronica) Return ChildLyric objects filtered by the stilelectronica column
 * @method     ChildLyric[]|ObjectCollection findByStilska(boolean $stilska) Return ChildLyric objects filtered by the stilska column
 * @method     ChildLyric[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class LyricQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Tekstove\TekstoveBundle\Model\Entity\Base\LyricQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\Tekstove\\TekstoveBundle\\Model\\Entity\\Lyric', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildLyricQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildLyricQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildLyricQuery) {
            return $criteria;
        }
        $query = new ChildLyricQuery();
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
     * @return ChildLyric|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = LyricTableMap::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(LyricTableMap::DATABASE_NAME);
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
     * @return ChildLyric A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, zaglavie_palno, zaglavie_sakrateno, up_id, text, text_bg, artist1, artist2, artist3, artist4, artist5, artist6, title, album1, album2, video, video_vbox7, video_vbox7_orig, video_youtube, video_youtube_orig, video_metacafe, video_metacafe_orig, download, image, podnovena, ip_upload, dopylnitelnoinfo, glasa, vidqna, populqrnost, stilraphiphop, stilhiphop, stileastcoast, pee_se_na, stilskit, stilelektronna, stilrok, stilrok_clas, stilrok_alt, stilrok_hard, stildisko, stillatam, stilsamba, stiltango, stilsalsa, stilklasi, stildetski, stilfolk, stilnarodna, stilchalga, stilpopfolk, stilmetal, stilmetal_heavy, stilmetal_power, stilmetal_death, stilmetal_nu, stilmetal_gothic, stilmetal_symphonic, stilsoundtrack, stildance, stilRnB, stilsoul, stilnew_rave, stilreggae, stilkantri, stilpunk, stilemo, stilbreakbeat, stilbigbeat, stiljaz, stilblus, stilelectronica, stilska FROM lyric WHERE id = :p0';
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
            /** @var ChildLyric $obj */
            $obj = new ChildLyric();
            $obj->hydrate($row);
            LyricTableMap::addInstanceToPool($obj, (string) $key);
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
     * @return ChildLyric|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildLyricQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(LyricTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildLyricQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(LyricTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildLyricQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(LyricTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(LyricTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LyricTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the zaglavie_palno column
     *
     * Example usage:
     * <code>
     * $query->filterByZaglaviePalno('fooValue');   // WHERE zaglavie_palno = 'fooValue'
     * $query->filterByZaglaviePalno('%fooValue%'); // WHERE zaglavie_palno LIKE '%fooValue%'
     * </code>
     *
     * @param     string $zaglaviePalno The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildLyricQuery The current query, for fluid interface
     */
    public function filterByZaglaviePalno($zaglaviePalno = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($zaglaviePalno)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $zaglaviePalno)) {
                $zaglaviePalno = str_replace('*', '%', $zaglaviePalno);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(LyricTableMap::COL_ZAGLAVIE_PALNO, $zaglaviePalno, $comparison);
    }

    /**
     * Filter the query on the zaglavie_sakrateno column
     *
     * Example usage:
     * <code>
     * $query->filterByFullTitleShort('fooValue');   // WHERE zaglavie_sakrateno = 'fooValue'
     * $query->filterByFullTitleShort('%fooValue%'); // WHERE zaglavie_sakrateno LIKE '%fooValue%'
     * </code>
     *
     * @param     string $fullTitleShort The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildLyricQuery The current query, for fluid interface
     */
    public function filterByFullTitleShort($fullTitleShort = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($fullTitleShort)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $fullTitleShort)) {
                $fullTitleShort = str_replace('*', '%', $fullTitleShort);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(LyricTableMap::COL_ZAGLAVIE_SAKRATENO, $fullTitleShort, $comparison);
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
     * @return $this|ChildLyricQuery The current query, for fluid interface
     */
    public function filterByUpId($upId = null, $comparison = null)
    {
        if (is_array($upId)) {
            $useMinMax = false;
            if (isset($upId['min'])) {
                $this->addUsingAlias(LyricTableMap::COL_UP_ID, $upId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($upId['max'])) {
                $this->addUsingAlias(LyricTableMap::COL_UP_ID, $upId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LyricTableMap::COL_UP_ID, $upId, $comparison);
    }

    /**
     * Filter the query on the text column
     *
     * Example usage:
     * <code>
     * $query->filterByText('fooValue');   // WHERE text = 'fooValue'
     * $query->filterByText('%fooValue%'); // WHERE text LIKE '%fooValue%'
     * </code>
     *
     * @param     string $text The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildLyricQuery The current query, for fluid interface
     */
    public function filterByText($text = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($text)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $text)) {
                $text = str_replace('*', '%', $text);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(LyricTableMap::COL_TEXT, $text, $comparison);
    }

    /**
     * Filter the query on the text_bg column
     *
     * Example usage:
     * <code>
     * $query->filterByTextBg('fooValue');   // WHERE text_bg = 'fooValue'
     * $query->filterByTextBg('%fooValue%'); // WHERE text_bg LIKE '%fooValue%'
     * </code>
     *
     * @param     string $textBg The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildLyricQuery The current query, for fluid interface
     */
    public function filterByTextBg($textBg = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($textBg)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $textBg)) {
                $textBg = str_replace('*', '%', $textBg);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(LyricTableMap::COL_TEXT_BG, $textBg, $comparison);
    }

    /**
     * Filter the query on the artist1 column
     *
     * Example usage:
     * <code>
     * $query->filterByArtist1(1234); // WHERE artist1 = 1234
     * $query->filterByArtist1(array(12, 34)); // WHERE artist1 IN (12, 34)
     * $query->filterByArtist1(array('min' => 12)); // WHERE artist1 > 12
     * </code>
     *
     * @param     mixed $artist1 The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildLyricQuery The current query, for fluid interface
     */
    public function filterByArtist1($artist1 = null, $comparison = null)
    {
        if (is_array($artist1)) {
            $useMinMax = false;
            if (isset($artist1['min'])) {
                $this->addUsingAlias(LyricTableMap::COL_ARTIST1, $artist1['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($artist1['max'])) {
                $this->addUsingAlias(LyricTableMap::COL_ARTIST1, $artist1['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LyricTableMap::COL_ARTIST1, $artist1, $comparison);
    }

    /**
     * Filter the query on the artist2 column
     *
     * Example usage:
     * <code>
     * $query->filterByArtist2(1234); // WHERE artist2 = 1234
     * $query->filterByArtist2(array(12, 34)); // WHERE artist2 IN (12, 34)
     * $query->filterByArtist2(array('min' => 12)); // WHERE artist2 > 12
     * </code>
     *
     * @param     mixed $artist2 The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildLyricQuery The current query, for fluid interface
     */
    public function filterByArtist2($artist2 = null, $comparison = null)
    {
        if (is_array($artist2)) {
            $useMinMax = false;
            if (isset($artist2['min'])) {
                $this->addUsingAlias(LyricTableMap::COL_ARTIST2, $artist2['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($artist2['max'])) {
                $this->addUsingAlias(LyricTableMap::COL_ARTIST2, $artist2['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LyricTableMap::COL_ARTIST2, $artist2, $comparison);
    }

    /**
     * Filter the query on the artist3 column
     *
     * Example usage:
     * <code>
     * $query->filterByArtist3(1234); // WHERE artist3 = 1234
     * $query->filterByArtist3(array(12, 34)); // WHERE artist3 IN (12, 34)
     * $query->filterByArtist3(array('min' => 12)); // WHERE artist3 > 12
     * </code>
     *
     * @param     mixed $artist3 The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildLyricQuery The current query, for fluid interface
     */
    public function filterByArtist3($artist3 = null, $comparison = null)
    {
        if (is_array($artist3)) {
            $useMinMax = false;
            if (isset($artist3['min'])) {
                $this->addUsingAlias(LyricTableMap::COL_ARTIST3, $artist3['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($artist3['max'])) {
                $this->addUsingAlias(LyricTableMap::COL_ARTIST3, $artist3['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LyricTableMap::COL_ARTIST3, $artist3, $comparison);
    }

    /**
     * Filter the query on the artist4 column
     *
     * Example usage:
     * <code>
     * $query->filterByArtist4(1234); // WHERE artist4 = 1234
     * $query->filterByArtist4(array(12, 34)); // WHERE artist4 IN (12, 34)
     * $query->filterByArtist4(array('min' => 12)); // WHERE artist4 > 12
     * </code>
     *
     * @param     mixed $artist4 The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildLyricQuery The current query, for fluid interface
     */
    public function filterByArtist4($artist4 = null, $comparison = null)
    {
        if (is_array($artist4)) {
            $useMinMax = false;
            if (isset($artist4['min'])) {
                $this->addUsingAlias(LyricTableMap::COL_ARTIST4, $artist4['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($artist4['max'])) {
                $this->addUsingAlias(LyricTableMap::COL_ARTIST4, $artist4['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LyricTableMap::COL_ARTIST4, $artist4, $comparison);
    }

    /**
     * Filter the query on the artist5 column
     *
     * Example usage:
     * <code>
     * $query->filterByArtist5(1234); // WHERE artist5 = 1234
     * $query->filterByArtist5(array(12, 34)); // WHERE artist5 IN (12, 34)
     * $query->filterByArtist5(array('min' => 12)); // WHERE artist5 > 12
     * </code>
     *
     * @param     mixed $artist5 The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildLyricQuery The current query, for fluid interface
     */
    public function filterByArtist5($artist5 = null, $comparison = null)
    {
        if (is_array($artist5)) {
            $useMinMax = false;
            if (isset($artist5['min'])) {
                $this->addUsingAlias(LyricTableMap::COL_ARTIST5, $artist5['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($artist5['max'])) {
                $this->addUsingAlias(LyricTableMap::COL_ARTIST5, $artist5['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LyricTableMap::COL_ARTIST5, $artist5, $comparison);
    }

    /**
     * Filter the query on the artist6 column
     *
     * Example usage:
     * <code>
     * $query->filterByArtist6(1234); // WHERE artist6 = 1234
     * $query->filterByArtist6(array(12, 34)); // WHERE artist6 IN (12, 34)
     * $query->filterByArtist6(array('min' => 12)); // WHERE artist6 > 12
     * </code>
     *
     * @param     mixed $artist6 The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildLyricQuery The current query, for fluid interface
     */
    public function filterByArtist6($artist6 = null, $comparison = null)
    {
        if (is_array($artist6)) {
            $useMinMax = false;
            if (isset($artist6['min'])) {
                $this->addUsingAlias(LyricTableMap::COL_ARTIST6, $artist6['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($artist6['max'])) {
                $this->addUsingAlias(LyricTableMap::COL_ARTIST6, $artist6['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LyricTableMap::COL_ARTIST6, $artist6, $comparison);
    }

    /**
     * Filter the query on the title column
     *
     * Example usage:
     * <code>
     * $query->filterByTitle('fooValue');   // WHERE title = 'fooValue'
     * $query->filterByTitle('%fooValue%'); // WHERE title LIKE '%fooValue%'
     * </code>
     *
     * @param     string $title The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildLyricQuery The current query, for fluid interface
     */
    public function filterByTitle($title = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($title)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $title)) {
                $title = str_replace('*', '%', $title);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(LyricTableMap::COL_TITLE, $title, $comparison);
    }

    /**
     * Filter the query on the album1 column
     *
     * Example usage:
     * <code>
     * $query->filterByAlbum1(1234); // WHERE album1 = 1234
     * $query->filterByAlbum1(array(12, 34)); // WHERE album1 IN (12, 34)
     * $query->filterByAlbum1(array('min' => 12)); // WHERE album1 > 12
     * </code>
     *
     * @param     mixed $album1 The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildLyricQuery The current query, for fluid interface
     */
    public function filterByAlbum1($album1 = null, $comparison = null)
    {
        if (is_array($album1)) {
            $useMinMax = false;
            if (isset($album1['min'])) {
                $this->addUsingAlias(LyricTableMap::COL_ALBUM1, $album1['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($album1['max'])) {
                $this->addUsingAlias(LyricTableMap::COL_ALBUM1, $album1['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LyricTableMap::COL_ALBUM1, $album1, $comparison);
    }

    /**
     * Filter the query on the album2 column
     *
     * Example usage:
     * <code>
     * $query->filterByAlbum2(1234); // WHERE album2 = 1234
     * $query->filterByAlbum2(array(12, 34)); // WHERE album2 IN (12, 34)
     * $query->filterByAlbum2(array('min' => 12)); // WHERE album2 > 12
     * </code>
     *
     * @param     mixed $album2 The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildLyricQuery The current query, for fluid interface
     */
    public function filterByAlbum2($album2 = null, $comparison = null)
    {
        if (is_array($album2)) {
            $useMinMax = false;
            if (isset($album2['min'])) {
                $this->addUsingAlias(LyricTableMap::COL_ALBUM2, $album2['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($album2['max'])) {
                $this->addUsingAlias(LyricTableMap::COL_ALBUM2, $album2['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LyricTableMap::COL_ALBUM2, $album2, $comparison);
    }

    /**
     * Filter the query on the video column
     *
     * Example usage:
     * <code>
     * $query->filterByVideo('fooValue');   // WHERE video = 'fooValue'
     * $query->filterByVideo('%fooValue%'); // WHERE video LIKE '%fooValue%'
     * </code>
     *
     * @param     string $video The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildLyricQuery The current query, for fluid interface
     */
    public function filterByVideo($video = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($video)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $video)) {
                $video = str_replace('*', '%', $video);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(LyricTableMap::COL_VIDEO, $video, $comparison);
    }

    /**
     * Filter the query on the video_vbox7 column
     *
     * Example usage:
     * <code>
     * $query->filterByVideoVbox7('fooValue');   // WHERE video_vbox7 = 'fooValue'
     * $query->filterByVideoVbox7('%fooValue%'); // WHERE video_vbox7 LIKE '%fooValue%'
     * </code>
     *
     * @param     string $videoVbox7 The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildLyricQuery The current query, for fluid interface
     */
    public function filterByVideoVbox7($videoVbox7 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($videoVbox7)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $videoVbox7)) {
                $videoVbox7 = str_replace('*', '%', $videoVbox7);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(LyricTableMap::COL_VIDEO_VBOX7, $videoVbox7, $comparison);
    }

    /**
     * Filter the query on the video_vbox7_orig column
     *
     * Example usage:
     * <code>
     * $query->filterByVideoVbox7Orig('fooValue');   // WHERE video_vbox7_orig = 'fooValue'
     * $query->filterByVideoVbox7Orig('%fooValue%'); // WHERE video_vbox7_orig LIKE '%fooValue%'
     * </code>
     *
     * @param     string $videoVbox7Orig The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildLyricQuery The current query, for fluid interface
     */
    public function filterByVideoVbox7Orig($videoVbox7Orig = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($videoVbox7Orig)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $videoVbox7Orig)) {
                $videoVbox7Orig = str_replace('*', '%', $videoVbox7Orig);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(LyricTableMap::COL_VIDEO_VBOX7_ORIG, $videoVbox7Orig, $comparison);
    }

    /**
     * Filter the query on the video_youtube column
     *
     * Example usage:
     * <code>
     * $query->filterByVideoYoutube('fooValue');   // WHERE video_youtube = 'fooValue'
     * $query->filterByVideoYoutube('%fooValue%'); // WHERE video_youtube LIKE '%fooValue%'
     * </code>
     *
     * @param     string $videoYoutube The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildLyricQuery The current query, for fluid interface
     */
    public function filterByVideoYoutube($videoYoutube = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($videoYoutube)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $videoYoutube)) {
                $videoYoutube = str_replace('*', '%', $videoYoutube);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(LyricTableMap::COL_VIDEO_YOUTUBE, $videoYoutube, $comparison);
    }

    /**
     * Filter the query on the video_youtube_orig column
     *
     * Example usage:
     * <code>
     * $query->filterByVideoYoutubeOrig('fooValue');   // WHERE video_youtube_orig = 'fooValue'
     * $query->filterByVideoYoutubeOrig('%fooValue%'); // WHERE video_youtube_orig LIKE '%fooValue%'
     * </code>
     *
     * @param     string $videoYoutubeOrig The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildLyricQuery The current query, for fluid interface
     */
    public function filterByVideoYoutubeOrig($videoYoutubeOrig = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($videoYoutubeOrig)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $videoYoutubeOrig)) {
                $videoYoutubeOrig = str_replace('*', '%', $videoYoutubeOrig);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(LyricTableMap::COL_VIDEO_YOUTUBE_ORIG, $videoYoutubeOrig, $comparison);
    }

    /**
     * Filter the query on the video_metacafe column
     *
     * Example usage:
     * <code>
     * $query->filterByVideoMetacafe('fooValue');   // WHERE video_metacafe = 'fooValue'
     * $query->filterByVideoMetacafe('%fooValue%'); // WHERE video_metacafe LIKE '%fooValue%'
     * </code>
     *
     * @param     string $videoMetacafe The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildLyricQuery The current query, for fluid interface
     */
    public function filterByVideoMetacafe($videoMetacafe = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($videoMetacafe)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $videoMetacafe)) {
                $videoMetacafe = str_replace('*', '%', $videoMetacafe);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(LyricTableMap::COL_VIDEO_METACAFE, $videoMetacafe, $comparison);
    }

    /**
     * Filter the query on the video_metacafe_orig column
     *
     * Example usage:
     * <code>
     * $query->filterByVideoMetacafeOrig('fooValue');   // WHERE video_metacafe_orig = 'fooValue'
     * $query->filterByVideoMetacafeOrig('%fooValue%'); // WHERE video_metacafe_orig LIKE '%fooValue%'
     * </code>
     *
     * @param     string $videoMetacafeOrig The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildLyricQuery The current query, for fluid interface
     */
    public function filterByVideoMetacafeOrig($videoMetacafeOrig = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($videoMetacafeOrig)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $videoMetacafeOrig)) {
                $videoMetacafeOrig = str_replace('*', '%', $videoMetacafeOrig);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(LyricTableMap::COL_VIDEO_METACAFE_ORIG, $videoMetacafeOrig, $comparison);
    }

    /**
     * Filter the query on the download column
     *
     * Example usage:
     * <code>
     * $query->filterByDownload('fooValue');   // WHERE download = 'fooValue'
     * $query->filterByDownload('%fooValue%'); // WHERE download LIKE '%fooValue%'
     * </code>
     *
     * @param     string $download The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildLyricQuery The current query, for fluid interface
     */
    public function filterByDownload($download = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($download)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $download)) {
                $download = str_replace('*', '%', $download);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(LyricTableMap::COL_DOWNLOAD, $download, $comparison);
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
     * @return $this|ChildLyricQuery The current query, for fluid interface
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

        return $this->addUsingAlias(LyricTableMap::COL_IMAGE, $image, $comparison);
    }

    /**
     * Filter the query on the podnovena column
     *
     * Example usage:
     * <code>
     * $query->filterByPodnovena('2011-03-14'); // WHERE podnovena = '2011-03-14'
     * $query->filterByPodnovena('now'); // WHERE podnovena = '2011-03-14'
     * $query->filterByPodnovena(array('max' => 'yesterday')); // WHERE podnovena > '2011-03-13'
     * </code>
     *
     * @param     mixed $podnovena The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildLyricQuery The current query, for fluid interface
     */
    public function filterByPodnovena($podnovena = null, $comparison = null)
    {
        if (is_array($podnovena)) {
            $useMinMax = false;
            if (isset($podnovena['min'])) {
                $this->addUsingAlias(LyricTableMap::COL_PODNOVENA, $podnovena['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($podnovena['max'])) {
                $this->addUsingAlias(LyricTableMap::COL_PODNOVENA, $podnovena['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LyricTableMap::COL_PODNOVENA, $podnovena, $comparison);
    }

    /**
     * Filter the query on the ip_upload column
     *
     * Example usage:
     * <code>
     * $query->filterByIpUpload('fooValue');   // WHERE ip_upload = 'fooValue'
     * $query->filterByIpUpload('%fooValue%'); // WHERE ip_upload LIKE '%fooValue%'
     * </code>
     *
     * @param     string $ipUpload The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildLyricQuery The current query, for fluid interface
     */
    public function filterByIpUpload($ipUpload = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($ipUpload)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $ipUpload)) {
                $ipUpload = str_replace('*', '%', $ipUpload);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(LyricTableMap::COL_IP_UPLOAD, $ipUpload, $comparison);
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
     * @return $this|ChildLyricQuery The current query, for fluid interface
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

        return $this->addUsingAlias(LyricTableMap::COL_DOPYLNITELNOINFO, $dopylnitelnoinfo, $comparison);
    }

    /**
     * Filter the query on the glasa column
     *
     * Example usage:
     * <code>
     * $query->filterByGlasa(1234); // WHERE glasa = 1234
     * $query->filterByGlasa(array(12, 34)); // WHERE glasa IN (12, 34)
     * $query->filterByGlasa(array('min' => 12)); // WHERE glasa > 12
     * </code>
     *
     * @param     mixed $glasa The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildLyricQuery The current query, for fluid interface
     */
    public function filterByGlasa($glasa = null, $comparison = null)
    {
        if (is_array($glasa)) {
            $useMinMax = false;
            if (isset($glasa['min'])) {
                $this->addUsingAlias(LyricTableMap::COL_GLASA, $glasa['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($glasa['max'])) {
                $this->addUsingAlias(LyricTableMap::COL_GLASA, $glasa['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LyricTableMap::COL_GLASA, $glasa, $comparison);
    }

    /**
     * Filter the query on the vidqna column
     *
     * Example usage:
     * <code>
     * $query->filterByVidqna(1234); // WHERE vidqna = 1234
     * $query->filterByVidqna(array(12, 34)); // WHERE vidqna IN (12, 34)
     * $query->filterByVidqna(array('min' => 12)); // WHERE vidqna > 12
     * </code>
     *
     * @param     mixed $vidqna The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildLyricQuery The current query, for fluid interface
     */
    public function filterByVidqna($vidqna = null, $comparison = null)
    {
        if (is_array($vidqna)) {
            $useMinMax = false;
            if (isset($vidqna['min'])) {
                $this->addUsingAlias(LyricTableMap::COL_VIDQNA, $vidqna['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($vidqna['max'])) {
                $this->addUsingAlias(LyricTableMap::COL_VIDQNA, $vidqna['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LyricTableMap::COL_VIDQNA, $vidqna, $comparison);
    }

    /**
     * Filter the query on the populqrnost column
     *
     * Example usage:
     * <code>
     * $query->filterByPopulqrnost(1234); // WHERE populqrnost = 1234
     * $query->filterByPopulqrnost(array(12, 34)); // WHERE populqrnost IN (12, 34)
     * $query->filterByPopulqrnost(array('min' => 12)); // WHERE populqrnost > 12
     * </code>
     *
     * @param     mixed $populqrnost The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildLyricQuery The current query, for fluid interface
     */
    public function filterByPopulqrnost($populqrnost = null, $comparison = null)
    {
        if (is_array($populqrnost)) {
            $useMinMax = false;
            if (isset($populqrnost['min'])) {
                $this->addUsingAlias(LyricTableMap::COL_POPULQRNOST, $populqrnost['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($populqrnost['max'])) {
                $this->addUsingAlias(LyricTableMap::COL_POPULQRNOST, $populqrnost['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LyricTableMap::COL_POPULQRNOST, $populqrnost, $comparison);
    }

    /**
     * Filter the query on the stilraphiphop column
     *
     * Example usage:
     * <code>
     * $query->filterByStilraphiphop(true); // WHERE stilraphiphop = true
     * $query->filterByStilraphiphop('yes'); // WHERE stilraphiphop = true
     * </code>
     *
     * @param     boolean|string $stilraphiphop The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildLyricQuery The current query, for fluid interface
     */
    public function filterByStilraphiphop($stilraphiphop = null, $comparison = null)
    {
        if (is_string($stilraphiphop)) {
            $stilraphiphop = in_array(strtolower($stilraphiphop), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(LyricTableMap::COL_STILRAPHIPHOP, $stilraphiphop, $comparison);
    }

    /**
     * Filter the query on the stilhiphop column
     *
     * Example usage:
     * <code>
     * $query->filterByStilhiphop(true); // WHERE stilhiphop = true
     * $query->filterByStilhiphop('yes'); // WHERE stilhiphop = true
     * </code>
     *
     * @param     boolean|string $stilhiphop The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildLyricQuery The current query, for fluid interface
     */
    public function filterByStilhiphop($stilhiphop = null, $comparison = null)
    {
        if (is_string($stilhiphop)) {
            $stilhiphop = in_array(strtolower($stilhiphop), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(LyricTableMap::COL_STILHIPHOP, $stilhiphop, $comparison);
    }

    /**
     * Filter the query on the stileastcoast column
     *
     * Example usage:
     * <code>
     * $query->filterByStileastcoast(true); // WHERE stileastcoast = true
     * $query->filterByStileastcoast('yes'); // WHERE stileastcoast = true
     * </code>
     *
     * @param     boolean|string $stileastcoast The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildLyricQuery The current query, for fluid interface
     */
    public function filterByStileastcoast($stileastcoast = null, $comparison = null)
    {
        if (is_string($stileastcoast)) {
            $stileastcoast = in_array(strtolower($stileastcoast), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(LyricTableMap::COL_STILEASTCOAST, $stileastcoast, $comparison);
    }

    /**
     * Filter the query on the pee_se_na column
     *
     * Example usage:
     * <code>
     * $query->filterByPeeSeNa(true); // WHERE pee_se_na = true
     * $query->filterByPeeSeNa('yes'); // WHERE pee_se_na = true
     * </code>
     *
     * @param     boolean|string $peeSeNa The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildLyricQuery The current query, for fluid interface
     */
    public function filterByPeeSeNa($peeSeNa = null, $comparison = null)
    {
        if (is_string($peeSeNa)) {
            $peeSeNa = in_array(strtolower($peeSeNa), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(LyricTableMap::COL_PEE_SE_NA, $peeSeNa, $comparison);
    }

    /**
     * Filter the query on the stilskit column
     *
     * Example usage:
     * <code>
     * $query->filterByStilskit(true); // WHERE stilskit = true
     * $query->filterByStilskit('yes'); // WHERE stilskit = true
     * </code>
     *
     * @param     boolean|string $stilskit The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildLyricQuery The current query, for fluid interface
     */
    public function filterByStilskit($stilskit = null, $comparison = null)
    {
        if (is_string($stilskit)) {
            $stilskit = in_array(strtolower($stilskit), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(LyricTableMap::COL_STILSKIT, $stilskit, $comparison);
    }

    /**
     * Filter the query on the stilelektronna column
     *
     * Example usage:
     * <code>
     * $query->filterByStilelektronna(true); // WHERE stilelektronna = true
     * $query->filterByStilelektronna('yes'); // WHERE stilelektronna = true
     * </code>
     *
     * @param     boolean|string $stilelektronna The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildLyricQuery The current query, for fluid interface
     */
    public function filterByStilelektronna($stilelektronna = null, $comparison = null)
    {
        if (is_string($stilelektronna)) {
            $stilelektronna = in_array(strtolower($stilelektronna), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(LyricTableMap::COL_STILELEKTRONNA, $stilelektronna, $comparison);
    }

    /**
     * Filter the query on the stilrok column
     *
     * Example usage:
     * <code>
     * $query->filterByStilrok(true); // WHERE stilrok = true
     * $query->filterByStilrok('yes'); // WHERE stilrok = true
     * </code>
     *
     * @param     boolean|string $stilrok The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildLyricQuery The current query, for fluid interface
     */
    public function filterByStilrok($stilrok = null, $comparison = null)
    {
        if (is_string($stilrok)) {
            $stilrok = in_array(strtolower($stilrok), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(LyricTableMap::COL_STILROK, $stilrok, $comparison);
    }

    /**
     * Filter the query on the stilrok_clas column
     *
     * Example usage:
     * <code>
     * $query->filterByStilrokClas(true); // WHERE stilrok_clas = true
     * $query->filterByStilrokClas('yes'); // WHERE stilrok_clas = true
     * </code>
     *
     * @param     boolean|string $stilrokClas The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildLyricQuery The current query, for fluid interface
     */
    public function filterByStilrokClas($stilrokClas = null, $comparison = null)
    {
        if (is_string($stilrokClas)) {
            $stilrokClas = in_array(strtolower($stilrokClas), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(LyricTableMap::COL_STILROK_CLAS, $stilrokClas, $comparison);
    }

    /**
     * Filter the query on the stilrok_alt column
     *
     * Example usage:
     * <code>
     * $query->filterByStilrokAlt(true); // WHERE stilrok_alt = true
     * $query->filterByStilrokAlt('yes'); // WHERE stilrok_alt = true
     * </code>
     *
     * @param     boolean|string $stilrokAlt The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildLyricQuery The current query, for fluid interface
     */
    public function filterByStilrokAlt($stilrokAlt = null, $comparison = null)
    {
        if (is_string($stilrokAlt)) {
            $stilrokAlt = in_array(strtolower($stilrokAlt), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(LyricTableMap::COL_STILROK_ALT, $stilrokAlt, $comparison);
    }

    /**
     * Filter the query on the stilrok_hard column
     *
     * Example usage:
     * <code>
     * $query->filterByStilrokHard(true); // WHERE stilrok_hard = true
     * $query->filterByStilrokHard('yes'); // WHERE stilrok_hard = true
     * </code>
     *
     * @param     boolean|string $stilrokHard The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildLyricQuery The current query, for fluid interface
     */
    public function filterByStilrokHard($stilrokHard = null, $comparison = null)
    {
        if (is_string($stilrokHard)) {
            $stilrokHard = in_array(strtolower($stilrokHard), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(LyricTableMap::COL_STILROK_HARD, $stilrokHard, $comparison);
    }

    /**
     * Filter the query on the stildisko column
     *
     * Example usage:
     * <code>
     * $query->filterByStildisko(true); // WHERE stildisko = true
     * $query->filterByStildisko('yes'); // WHERE stildisko = true
     * </code>
     *
     * @param     boolean|string $stildisko The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildLyricQuery The current query, for fluid interface
     */
    public function filterByStildisko($stildisko = null, $comparison = null)
    {
        if (is_string($stildisko)) {
            $stildisko = in_array(strtolower($stildisko), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(LyricTableMap::COL_STILDISKO, $stildisko, $comparison);
    }

    /**
     * Filter the query on the stillatam column
     *
     * Example usage:
     * <code>
     * $query->filterByStillatam(true); // WHERE stillatam = true
     * $query->filterByStillatam('yes'); // WHERE stillatam = true
     * </code>
     *
     * @param     boolean|string $stillatam The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildLyricQuery The current query, for fluid interface
     */
    public function filterByStillatam($stillatam = null, $comparison = null)
    {
        if (is_string($stillatam)) {
            $stillatam = in_array(strtolower($stillatam), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(LyricTableMap::COL_STILLATAM, $stillatam, $comparison);
    }

    /**
     * Filter the query on the stilsamba column
     *
     * Example usage:
     * <code>
     * $query->filterByStilsamba(true); // WHERE stilsamba = true
     * $query->filterByStilsamba('yes'); // WHERE stilsamba = true
     * </code>
     *
     * @param     boolean|string $stilsamba The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildLyricQuery The current query, for fluid interface
     */
    public function filterByStilsamba($stilsamba = null, $comparison = null)
    {
        if (is_string($stilsamba)) {
            $stilsamba = in_array(strtolower($stilsamba), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(LyricTableMap::COL_STILSAMBA, $stilsamba, $comparison);
    }

    /**
     * Filter the query on the stiltango column
     *
     * Example usage:
     * <code>
     * $query->filterByStiltango(true); // WHERE stiltango = true
     * $query->filterByStiltango('yes'); // WHERE stiltango = true
     * </code>
     *
     * @param     boolean|string $stiltango The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildLyricQuery The current query, for fluid interface
     */
    public function filterByStiltango($stiltango = null, $comparison = null)
    {
        if (is_string($stiltango)) {
            $stiltango = in_array(strtolower($stiltango), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(LyricTableMap::COL_STILTANGO, $stiltango, $comparison);
    }

    /**
     * Filter the query on the stilsalsa column
     *
     * Example usage:
     * <code>
     * $query->filterByStilsalsa(true); // WHERE stilsalsa = true
     * $query->filterByStilsalsa('yes'); // WHERE stilsalsa = true
     * </code>
     *
     * @param     boolean|string $stilsalsa The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildLyricQuery The current query, for fluid interface
     */
    public function filterByStilsalsa($stilsalsa = null, $comparison = null)
    {
        if (is_string($stilsalsa)) {
            $stilsalsa = in_array(strtolower($stilsalsa), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(LyricTableMap::COL_STILSALSA, $stilsalsa, $comparison);
    }

    /**
     * Filter the query on the stilklasi column
     *
     * Example usage:
     * <code>
     * $query->filterByStilklasi(true); // WHERE stilklasi = true
     * $query->filterByStilklasi('yes'); // WHERE stilklasi = true
     * </code>
     *
     * @param     boolean|string $stilklasi The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildLyricQuery The current query, for fluid interface
     */
    public function filterByStilklasi($stilklasi = null, $comparison = null)
    {
        if (is_string($stilklasi)) {
            $stilklasi = in_array(strtolower($stilklasi), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(LyricTableMap::COL_STILKLASI, $stilklasi, $comparison);
    }

    /**
     * Filter the query on the stildetski column
     *
     * Example usage:
     * <code>
     * $query->filterByStildetski(true); // WHERE stildetski = true
     * $query->filterByStildetski('yes'); // WHERE stildetski = true
     * </code>
     *
     * @param     boolean|string $stildetski The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildLyricQuery The current query, for fluid interface
     */
    public function filterByStildetski($stildetski = null, $comparison = null)
    {
        if (is_string($stildetski)) {
            $stildetski = in_array(strtolower($stildetski), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(LyricTableMap::COL_STILDETSKI, $stildetski, $comparison);
    }

    /**
     * Filter the query on the stilfolk column
     *
     * Example usage:
     * <code>
     * $query->filterByStilfolk(true); // WHERE stilfolk = true
     * $query->filterByStilfolk('yes'); // WHERE stilfolk = true
     * </code>
     *
     * @param     boolean|string $stilfolk The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildLyricQuery The current query, for fluid interface
     */
    public function filterByStilfolk($stilfolk = null, $comparison = null)
    {
        if (is_string($stilfolk)) {
            $stilfolk = in_array(strtolower($stilfolk), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(LyricTableMap::COL_STILFOLK, $stilfolk, $comparison);
    }

    /**
     * Filter the query on the stilnarodna column
     *
     * Example usage:
     * <code>
     * $query->filterByStilnarodna(true); // WHERE stilnarodna = true
     * $query->filterByStilnarodna('yes'); // WHERE stilnarodna = true
     * </code>
     *
     * @param     boolean|string $stilnarodna The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildLyricQuery The current query, for fluid interface
     */
    public function filterByStilnarodna($stilnarodna = null, $comparison = null)
    {
        if (is_string($stilnarodna)) {
            $stilnarodna = in_array(strtolower($stilnarodna), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(LyricTableMap::COL_STILNARODNA, $stilnarodna, $comparison);
    }

    /**
     * Filter the query on the stilchalga column
     *
     * Example usage:
     * <code>
     * $query->filterByStilchalga(true); // WHERE stilchalga = true
     * $query->filterByStilchalga('yes'); // WHERE stilchalga = true
     * </code>
     *
     * @param     boolean|string $stilchalga The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildLyricQuery The current query, for fluid interface
     */
    public function filterByStilchalga($stilchalga = null, $comparison = null)
    {
        if (is_string($stilchalga)) {
            $stilchalga = in_array(strtolower($stilchalga), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(LyricTableMap::COL_STILCHALGA, $stilchalga, $comparison);
    }

    /**
     * Filter the query on the stilpopfolk column
     *
     * Example usage:
     * <code>
     * $query->filterByStilpopfolk(true); // WHERE stilpopfolk = true
     * $query->filterByStilpopfolk('yes'); // WHERE stilpopfolk = true
     * </code>
     *
     * @param     boolean|string $stilpopfolk The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildLyricQuery The current query, for fluid interface
     */
    public function filterByStilpopfolk($stilpopfolk = null, $comparison = null)
    {
        if (is_string($stilpopfolk)) {
            $stilpopfolk = in_array(strtolower($stilpopfolk), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(LyricTableMap::COL_STILPOPFOLK, $stilpopfolk, $comparison);
    }

    /**
     * Filter the query on the stilmetal column
     *
     * Example usage:
     * <code>
     * $query->filterByStilmetal(true); // WHERE stilmetal = true
     * $query->filterByStilmetal('yes'); // WHERE stilmetal = true
     * </code>
     *
     * @param     boolean|string $stilmetal The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildLyricQuery The current query, for fluid interface
     */
    public function filterByStilmetal($stilmetal = null, $comparison = null)
    {
        if (is_string($stilmetal)) {
            $stilmetal = in_array(strtolower($stilmetal), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(LyricTableMap::COL_STILMETAL, $stilmetal, $comparison);
    }

    /**
     * Filter the query on the stilmetal_heavy column
     *
     * Example usage:
     * <code>
     * $query->filterByStilmetalHeavy(true); // WHERE stilmetal_heavy = true
     * $query->filterByStilmetalHeavy('yes'); // WHERE stilmetal_heavy = true
     * </code>
     *
     * @param     boolean|string $stilmetalHeavy The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildLyricQuery The current query, for fluid interface
     */
    public function filterByStilmetalHeavy($stilmetalHeavy = null, $comparison = null)
    {
        if (is_string($stilmetalHeavy)) {
            $stilmetalHeavy = in_array(strtolower($stilmetalHeavy), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(LyricTableMap::COL_STILMETAL_HEAVY, $stilmetalHeavy, $comparison);
    }

    /**
     * Filter the query on the stilmetal_power column
     *
     * Example usage:
     * <code>
     * $query->filterByStilmetalPower(true); // WHERE stilmetal_power = true
     * $query->filterByStilmetalPower('yes'); // WHERE stilmetal_power = true
     * </code>
     *
     * @param     boolean|string $stilmetalPower The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildLyricQuery The current query, for fluid interface
     */
    public function filterByStilmetalPower($stilmetalPower = null, $comparison = null)
    {
        if (is_string($stilmetalPower)) {
            $stilmetalPower = in_array(strtolower($stilmetalPower), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(LyricTableMap::COL_STILMETAL_POWER, $stilmetalPower, $comparison);
    }

    /**
     * Filter the query on the stilmetal_death column
     *
     * Example usage:
     * <code>
     * $query->filterByStilmetalDeath(true); // WHERE stilmetal_death = true
     * $query->filterByStilmetalDeath('yes'); // WHERE stilmetal_death = true
     * </code>
     *
     * @param     boolean|string $stilmetalDeath The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildLyricQuery The current query, for fluid interface
     */
    public function filterByStilmetalDeath($stilmetalDeath = null, $comparison = null)
    {
        if (is_string($stilmetalDeath)) {
            $stilmetalDeath = in_array(strtolower($stilmetalDeath), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(LyricTableMap::COL_STILMETAL_DEATH, $stilmetalDeath, $comparison);
    }

    /**
     * Filter the query on the stilmetal_nu column
     *
     * Example usage:
     * <code>
     * $query->filterByStilmetalNu(true); // WHERE stilmetal_nu = true
     * $query->filterByStilmetalNu('yes'); // WHERE stilmetal_nu = true
     * </code>
     *
     * @param     boolean|string $stilmetalNu The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildLyricQuery The current query, for fluid interface
     */
    public function filterByStilmetalNu($stilmetalNu = null, $comparison = null)
    {
        if (is_string($stilmetalNu)) {
            $stilmetalNu = in_array(strtolower($stilmetalNu), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(LyricTableMap::COL_STILMETAL_NU, $stilmetalNu, $comparison);
    }

    /**
     * Filter the query on the stilmetal_gothic column
     *
     * Example usage:
     * <code>
     * $query->filterByStilmetalGothic(true); // WHERE stilmetal_gothic = true
     * $query->filterByStilmetalGothic('yes'); // WHERE stilmetal_gothic = true
     * </code>
     *
     * @param     boolean|string $stilmetalGothic The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildLyricQuery The current query, for fluid interface
     */
    public function filterByStilmetalGothic($stilmetalGothic = null, $comparison = null)
    {
        if (is_string($stilmetalGothic)) {
            $stilmetalGothic = in_array(strtolower($stilmetalGothic), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(LyricTableMap::COL_STILMETAL_GOTHIC, $stilmetalGothic, $comparison);
    }

    /**
     * Filter the query on the stilmetal_symphonic column
     *
     * Example usage:
     * <code>
     * $query->filterByStilmetalSymphonic(true); // WHERE stilmetal_symphonic = true
     * $query->filterByStilmetalSymphonic('yes'); // WHERE stilmetal_symphonic = true
     * </code>
     *
     * @param     boolean|string $stilmetalSymphonic The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildLyricQuery The current query, for fluid interface
     */
    public function filterByStilmetalSymphonic($stilmetalSymphonic = null, $comparison = null)
    {
        if (is_string($stilmetalSymphonic)) {
            $stilmetalSymphonic = in_array(strtolower($stilmetalSymphonic), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(LyricTableMap::COL_STILMETAL_SYMPHONIC, $stilmetalSymphonic, $comparison);
    }

    /**
     * Filter the query on the stilsoundtrack column
     *
     * Example usage:
     * <code>
     * $query->filterByStilsoundtrack(true); // WHERE stilsoundtrack = true
     * $query->filterByStilsoundtrack('yes'); // WHERE stilsoundtrack = true
     * </code>
     *
     * @param     boolean|string $stilsoundtrack The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildLyricQuery The current query, for fluid interface
     */
    public function filterByStilsoundtrack($stilsoundtrack = null, $comparison = null)
    {
        if (is_string($stilsoundtrack)) {
            $stilsoundtrack = in_array(strtolower($stilsoundtrack), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(LyricTableMap::COL_STILSOUNDTRACK, $stilsoundtrack, $comparison);
    }

    /**
     * Filter the query on the stildance column
     *
     * Example usage:
     * <code>
     * $query->filterByStildance(true); // WHERE stildance = true
     * $query->filterByStildance('yes'); // WHERE stildance = true
     * </code>
     *
     * @param     boolean|string $stildance The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildLyricQuery The current query, for fluid interface
     */
    public function filterByStildance($stildance = null, $comparison = null)
    {
        if (is_string($stildance)) {
            $stildance = in_array(strtolower($stildance), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(LyricTableMap::COL_STILDANCE, $stildance, $comparison);
    }

    /**
     * Filter the query on the stilRnB column
     *
     * Example usage:
     * <code>
     * $query->filterByStilrnb(true); // WHERE stilRnB = true
     * $query->filterByStilrnb('yes'); // WHERE stilRnB = true
     * </code>
     *
     * @param     boolean|string $stilrnb The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildLyricQuery The current query, for fluid interface
     */
    public function filterByStilrnb($stilrnb = null, $comparison = null)
    {
        if (is_string($stilrnb)) {
            $stilrnb = in_array(strtolower($stilrnb), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(LyricTableMap::COL_STILRNB, $stilrnb, $comparison);
    }

    /**
     * Filter the query on the stilsoul column
     *
     * Example usage:
     * <code>
     * $query->filterByStilsoul(true); // WHERE stilsoul = true
     * $query->filterByStilsoul('yes'); // WHERE stilsoul = true
     * </code>
     *
     * @param     boolean|string $stilsoul The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildLyricQuery The current query, for fluid interface
     */
    public function filterByStilsoul($stilsoul = null, $comparison = null)
    {
        if (is_string($stilsoul)) {
            $stilsoul = in_array(strtolower($stilsoul), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(LyricTableMap::COL_STILSOUL, $stilsoul, $comparison);
    }

    /**
     * Filter the query on the stilnew_rave column
     *
     * Example usage:
     * <code>
     * $query->filterByStilnewRave(true); // WHERE stilnew_rave = true
     * $query->filterByStilnewRave('yes'); // WHERE stilnew_rave = true
     * </code>
     *
     * @param     boolean|string $stilnewRave The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildLyricQuery The current query, for fluid interface
     */
    public function filterByStilnewRave($stilnewRave = null, $comparison = null)
    {
        if (is_string($stilnewRave)) {
            $stilnewRave = in_array(strtolower($stilnewRave), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(LyricTableMap::COL_STILNEW_RAVE, $stilnewRave, $comparison);
    }

    /**
     * Filter the query on the stilreggae column
     *
     * Example usage:
     * <code>
     * $query->filterByStilreggae(true); // WHERE stilreggae = true
     * $query->filterByStilreggae('yes'); // WHERE stilreggae = true
     * </code>
     *
     * @param     boolean|string $stilreggae The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildLyricQuery The current query, for fluid interface
     */
    public function filterByStilreggae($stilreggae = null, $comparison = null)
    {
        if (is_string($stilreggae)) {
            $stilreggae = in_array(strtolower($stilreggae), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(LyricTableMap::COL_STILREGGAE, $stilreggae, $comparison);
    }

    /**
     * Filter the query on the stilkantri column
     *
     * Example usage:
     * <code>
     * $query->filterByStilkantri(true); // WHERE stilkantri = true
     * $query->filterByStilkantri('yes'); // WHERE stilkantri = true
     * </code>
     *
     * @param     boolean|string $stilkantri The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildLyricQuery The current query, for fluid interface
     */
    public function filterByStilkantri($stilkantri = null, $comparison = null)
    {
        if (is_string($stilkantri)) {
            $stilkantri = in_array(strtolower($stilkantri), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(LyricTableMap::COL_STILKANTRI, $stilkantri, $comparison);
    }

    /**
     * Filter the query on the stilpunk column
     *
     * Example usage:
     * <code>
     * $query->filterByStilpunk(true); // WHERE stilpunk = true
     * $query->filterByStilpunk('yes'); // WHERE stilpunk = true
     * </code>
     *
     * @param     boolean|string $stilpunk The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildLyricQuery The current query, for fluid interface
     */
    public function filterByStilpunk($stilpunk = null, $comparison = null)
    {
        if (is_string($stilpunk)) {
            $stilpunk = in_array(strtolower($stilpunk), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(LyricTableMap::COL_STILPUNK, $stilpunk, $comparison);
    }

    /**
     * Filter the query on the stilemo column
     *
     * Example usage:
     * <code>
     * $query->filterByStilemo(true); // WHERE stilemo = true
     * $query->filterByStilemo('yes'); // WHERE stilemo = true
     * </code>
     *
     * @param     boolean|string $stilemo The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildLyricQuery The current query, for fluid interface
     */
    public function filterByStilemo($stilemo = null, $comparison = null)
    {
        if (is_string($stilemo)) {
            $stilemo = in_array(strtolower($stilemo), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(LyricTableMap::COL_STILEMO, $stilemo, $comparison);
    }

    /**
     * Filter the query on the stilbreakbeat column
     *
     * Example usage:
     * <code>
     * $query->filterByStilbreakbeat(true); // WHERE stilbreakbeat = true
     * $query->filterByStilbreakbeat('yes'); // WHERE stilbreakbeat = true
     * </code>
     *
     * @param     boolean|string $stilbreakbeat The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildLyricQuery The current query, for fluid interface
     */
    public function filterByStilbreakbeat($stilbreakbeat = null, $comparison = null)
    {
        if (is_string($stilbreakbeat)) {
            $stilbreakbeat = in_array(strtolower($stilbreakbeat), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(LyricTableMap::COL_STILBREAKBEAT, $stilbreakbeat, $comparison);
    }

    /**
     * Filter the query on the stilbigbeat column
     *
     * Example usage:
     * <code>
     * $query->filterByStilbigbeat(true); // WHERE stilbigbeat = true
     * $query->filterByStilbigbeat('yes'); // WHERE stilbigbeat = true
     * </code>
     *
     * @param     boolean|string $stilbigbeat The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildLyricQuery The current query, for fluid interface
     */
    public function filterByStilbigbeat($stilbigbeat = null, $comparison = null)
    {
        if (is_string($stilbigbeat)) {
            $stilbigbeat = in_array(strtolower($stilbigbeat), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(LyricTableMap::COL_STILBIGBEAT, $stilbigbeat, $comparison);
    }

    /**
     * Filter the query on the stiljaz column
     *
     * Example usage:
     * <code>
     * $query->filterByStiljaz(true); // WHERE stiljaz = true
     * $query->filterByStiljaz('yes'); // WHERE stiljaz = true
     * </code>
     *
     * @param     boolean|string $stiljaz The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildLyricQuery The current query, for fluid interface
     */
    public function filterByStiljaz($stiljaz = null, $comparison = null)
    {
        if (is_string($stiljaz)) {
            $stiljaz = in_array(strtolower($stiljaz), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(LyricTableMap::COL_STILJAZ, $stiljaz, $comparison);
    }

    /**
     * Filter the query on the stilblus column
     *
     * Example usage:
     * <code>
     * $query->filterByStilblus(true); // WHERE stilblus = true
     * $query->filterByStilblus('yes'); // WHERE stilblus = true
     * </code>
     *
     * @param     boolean|string $stilblus The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildLyricQuery The current query, for fluid interface
     */
    public function filterByStilblus($stilblus = null, $comparison = null)
    {
        if (is_string($stilblus)) {
            $stilblus = in_array(strtolower($stilblus), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(LyricTableMap::COL_STILBLUS, $stilblus, $comparison);
    }

    /**
     * Filter the query on the stilelectronica column
     *
     * Example usage:
     * <code>
     * $query->filterByStilelectronica(true); // WHERE stilelectronica = true
     * $query->filterByStilelectronica('yes'); // WHERE stilelectronica = true
     * </code>
     *
     * @param     boolean|string $stilelectronica The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildLyricQuery The current query, for fluid interface
     */
    public function filterByStilelectronica($stilelectronica = null, $comparison = null)
    {
        if (is_string($stilelectronica)) {
            $stilelectronica = in_array(strtolower($stilelectronica), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(LyricTableMap::COL_STILELECTRONICA, $stilelectronica, $comparison);
    }

    /**
     * Filter the query on the stilska column
     *
     * Example usage:
     * <code>
     * $query->filterByStilska(true); // WHERE stilska = true
     * $query->filterByStilska('yes'); // WHERE stilska = true
     * </code>
     *
     * @param     boolean|string $stilska The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildLyricQuery The current query, for fluid interface
     */
    public function filterByStilska($stilska = null, $comparison = null)
    {
        if (is_string($stilska)) {
            $stilska = in_array(strtolower($stilska), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(LyricTableMap::COL_STILSKA, $stilska, $comparison);
    }

    /**
     * Filter the query by a related \Tekstove\TekstoveBundle\Model\Entity\Comments object
     *
     * @param \Tekstove\TekstoveBundle\Model\Entity\Comments|ObjectCollection $comments the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildLyricQuery The current query, for fluid interface
     */
    public function filterByComments($comments, $comparison = null)
    {
        if ($comments instanceof \Tekstove\TekstoveBundle\Model\Entity\Comments) {
            return $this
                ->addUsingAlias(LyricTableMap::COL_ID, $comments->getZakoqpesen(), $comparison);
        } elseif ($comments instanceof ObjectCollection) {
            return $this
                ->useCommentsQuery()
                ->filterByPrimaryKeys($comments->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByComments() only accepts arguments of type \Tekstove\TekstoveBundle\Model\Entity\Comments or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Comments relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildLyricQuery The current query, for fluid interface
     */
    public function joinComments($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Comments');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'Comments');
        }

        return $this;
    }

    /**
     * Use the Comments relation Comments object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Tekstove\TekstoveBundle\Model\Entity\CommentsQuery A secondary query class using the current class as primary query
     */
    public function useCommentsQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinComments($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Comments', '\Tekstove\TekstoveBundle\Model\Entity\CommentsQuery');
    }

    /**
     * Filter the query by a related \Tekstove\TekstoveBundle\Model\Entity\EditAddPrevod object
     *
     * @param \Tekstove\TekstoveBundle\Model\Entity\EditAddPrevod|ObjectCollection $editAddPrevod the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildLyricQuery The current query, for fluid interface
     */
    public function filterByEditAddPrevod($editAddPrevod, $comparison = null)
    {
        if ($editAddPrevod instanceof \Tekstove\TekstoveBundle\Model\Entity\EditAddPrevod) {
            return $this
                ->addUsingAlias(LyricTableMap::COL_ID, $editAddPrevod->getZaPesen(), $comparison);
        } elseif ($editAddPrevod instanceof ObjectCollection) {
            return $this
                ->useEditAddPrevodQuery()
                ->filterByPrimaryKeys($editAddPrevod->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByEditAddPrevod() only accepts arguments of type \Tekstove\TekstoveBundle\Model\Entity\EditAddPrevod or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the EditAddPrevod relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildLyricQuery The current query, for fluid interface
     */
    public function joinEditAddPrevod($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('EditAddPrevod');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'EditAddPrevod');
        }

        return $this;
    }

    /**
     * Use the EditAddPrevod relation EditAddPrevod object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Tekstove\TekstoveBundle\Model\Entity\EditAddPrevodQuery A secondary query class using the current class as primary query
     */
    public function useEditAddPrevodQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinEditAddPrevod($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'EditAddPrevod', '\Tekstove\TekstoveBundle\Model\Entity\EditAddPrevodQuery');
    }

    /**
     * Filter the query by a related \Tekstove\TekstoveBundle\Model\Entity\Glasuvane object
     *
     * @param \Tekstove\TekstoveBundle\Model\Entity\Glasuvane|ObjectCollection $glasuvane the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildLyricQuery The current query, for fluid interface
     */
    public function filterByGlasuvane($glasuvane, $comparison = null)
    {
        if ($glasuvane instanceof \Tekstove\TekstoveBundle\Model\Entity\Glasuvane) {
            return $this
                ->addUsingAlias(LyricTableMap::COL_ID, $glasuvane->getZa(), $comparison);
        } elseif ($glasuvane instanceof ObjectCollection) {
            return $this
                ->useGlasuvaneQuery()
                ->filterByPrimaryKeys($glasuvane->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByGlasuvane() only accepts arguments of type \Tekstove\TekstoveBundle\Model\Entity\Glasuvane or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Glasuvane relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildLyricQuery The current query, for fluid interface
     */
    public function joinGlasuvane($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Glasuvane');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'Glasuvane');
        }

        return $this;
    }

    /**
     * Use the Glasuvane relation Glasuvane object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Tekstove\TekstoveBundle\Model\Entity\GlasuvaneQuery A secondary query class using the current class as primary query
     */
    public function useGlasuvaneQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinGlasuvane($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Glasuvane', '\Tekstove\TekstoveBundle\Model\Entity\GlasuvaneQuery');
    }

    /**
     * Filter the query by a related \Tekstove\TekstoveBundle\Model\Entity\Liubimi object
     *
     * @param \Tekstove\TekstoveBundle\Model\Entity\Liubimi|ObjectCollection $liubimi the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildLyricQuery The current query, for fluid interface
     */
    public function filterByLiubimi($liubimi, $comparison = null)
    {
        if ($liubimi instanceof \Tekstove\TekstoveBundle\Model\Entity\Liubimi) {
            return $this
                ->addUsingAlias(LyricTableMap::COL_ID, $liubimi->getPesen(), $comparison);
        } elseif ($liubimi instanceof ObjectCollection) {
            return $this
                ->useLiubimiQuery()
                ->filterByPrimaryKeys($liubimi->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByLiubimi() only accepts arguments of type \Tekstove\TekstoveBundle\Model\Entity\Liubimi or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Liubimi relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildLyricQuery The current query, for fluid interface
     */
    public function joinLiubimi($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Liubimi');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'Liubimi');
        }

        return $this;
    }

    /**
     * Use the Liubimi relation Liubimi object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Tekstove\TekstoveBundle\Model\Entity\LiubimiQuery A secondary query class using the current class as primary query
     */
    public function useLiubimiQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinLiubimi($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Liubimi', '\Tekstove\TekstoveBundle\Model\Entity\LiubimiQuery');
    }

    /**
     * Filter the query by a related \Tekstove\TekstoveBundle\Model\Entity\Lyric18 object
     *
     * @param \Tekstove\TekstoveBundle\Model\Entity\Lyric18|ObjectCollection $lyric18 the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildLyricQuery The current query, for fluid interface
     */
    public function filterByLyric18($lyric18, $comparison = null)
    {
        if ($lyric18 instanceof \Tekstove\TekstoveBundle\Model\Entity\Lyric18) {
            return $this
                ->addUsingAlias(LyricTableMap::COL_ID, $lyric18->getId(), $comparison);
        } elseif ($lyric18 instanceof ObjectCollection) {
            return $this
                ->useLyric18Query()
                ->filterByPrimaryKeys($lyric18->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByLyric18() only accepts arguments of type \Tekstove\TekstoveBundle\Model\Entity\Lyric18 or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Lyric18 relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildLyricQuery The current query, for fluid interface
     */
    public function joinLyric18($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Lyric18');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'Lyric18');
        }

        return $this;
    }

    /**
     * Use the Lyric18 relation Lyric18 object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Tekstove\TekstoveBundle\Model\Entity\Lyric18Query A secondary query class using the current class as primary query
     */
    public function useLyric18Query($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinLyric18($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Lyric18', '\Tekstove\TekstoveBundle\Model\Entity\Lyric18Query');
    }

    /**
     * Filter the query by a related \Tekstove\TekstoveBundle\Model\Entity\LyricRedirect object
     *
     * @param \Tekstove\TekstoveBundle\Model\Entity\LyricRedirect|ObjectCollection $lyricRedirect the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildLyricQuery The current query, for fluid interface
     */
    public function filterByLyricRedirect($lyricRedirect, $comparison = null)
    {
        if ($lyricRedirect instanceof \Tekstove\TekstoveBundle\Model\Entity\LyricRedirect) {
            return $this
                ->addUsingAlias(LyricTableMap::COL_ID, $lyricRedirect->getRedirectId(), $comparison);
        } elseif ($lyricRedirect instanceof ObjectCollection) {
            return $this
                ->useLyricRedirectQuery()
                ->filterByPrimaryKeys($lyricRedirect->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByLyricRedirect() only accepts arguments of type \Tekstove\TekstoveBundle\Model\Entity\LyricRedirect or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the LyricRedirect relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildLyricQuery The current query, for fluid interface
     */
    public function joinLyricRedirect($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('LyricRedirect');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'LyricRedirect');
        }

        return $this;
    }

    /**
     * Use the LyricRedirect relation LyricRedirect object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Tekstove\TekstoveBundle\Model\Entity\LyricRedirectQuery A secondary query class using the current class as primary query
     */
    public function useLyricRedirectQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinLyricRedirect($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'LyricRedirect', '\Tekstove\TekstoveBundle\Model\Entity\LyricRedirectQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildLyric $lyric Object to remove from the list of results
     *
     * @return $this|ChildLyricQuery The current query, for fluid interface
     */
    public function prune($lyric = null)
    {
        if ($lyric) {
            $this->addUsingAlias(LyricTableMap::COL_ID, $lyric->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the lyric table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(LyricTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            LyricTableMap::clearInstancePool();
            LyricTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(LyricTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(LyricTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            LyricTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            LyricTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // LyricQuery
