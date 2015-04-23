<?php

namespace Tekstove;

/**
 * Description of Registry
 * 
 * @author po_taka
 * 
 * @property adsense
 */
class Registry
{
    /**
     * @property string test 
     */

    /**
     *
     * @var type 
     */
    private static $instance = null;
    private static $contentCheckerInstance = null;
    private $data = array(
    );
    private $adsense = null;

    /**
     *
     * @return Registry
     */
    public static function getInstance()
    {
        if (self::$instance === null) {
            $classname = __CLASS__;
            self::$instance = new $classname();
        }

        return self::$instance;
    }

    public function __get($name)
    {
        return self::$data[$name];
    }

    public function __set($name, $value)
    {
        self::$data[$name] = $value;
    }

    public function getAdsense()
    {
        return $this->adsense;
    }

    public function setAdsense($adsense)
    {
        /**
         * disable change from FALSE tor TRUE 
         */
        if ($this->adsense !== null && $adsense == true && $this->adsense == false) {
            return false;
        }

        $this->adsense = (bool) $adsense;
    }

    /**
     * 
     * @return \Tekstove\ContentChecker\Checker
     */
    public function getContentCecker()
    {
        if (self::$contentCheckerInstance) {
            $return = self::$contentCheckerInstance;
        } else {
            $checker = new \Tekstove\ContentChecker\Checker();
            $regExpChecker = new \Tekstove\ContentChecker\Checker\RegExp();
            $regExpChecker->setPrefix('[^\p{Cyrillic}a-z]')
                          ->setSuffix('[^\p{Cyrillic}a-z]');
            
            $wordsEn = explode(PHP_EOL, file_get_contents(SITE_PATH . 'vendor/tekstove/content-checker/Dictionaries/En/Data.txt'));
            $wordsBg = explode(PHP_EOL, file_get_contents(SITE_PATH . 'vendor/tekstove/content-checker/Dictionaries/Bg/Data.txt'));
            $dictionaryRegExp = new ContentChecker\Dictionary\RegExpDictionary($wordsEn);
            $dictionaryRegExp->addWords($wordsEn)
                             ->addWords($wordsBg);
            $regExpChecker->addDictionary($dictionaryRegExp);
            $checker->addChecker($regExpChecker);
            
            $return = $checker;
        }
        
        
        
        return $return;
    }

}
