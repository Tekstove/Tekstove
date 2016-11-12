<?php

namespace TekstoveTest\Site\Model\Lyric;

use PHPUnit\Framework\TestCase;
use Tekstove\SiteBundle\Model\Lyric\Lyric;

/**
 * @author po_taka <angel.koilov@gmail.com>
 */
class LyricTest extends TestCase
{
    private $simpleFields = [
        'text',
        'textBg',
        'extraInfo',
        'title',
        'download',
        'videoYoutube',
        'videoVbox7',
    ];
    
    public function testGetChangedFields()
    {
        $lyric = new Lyric();
        $expectedChangeSet = [];
        foreach ($this->simpleFields as $fieldName) {
            $setter = 'set' . $fieldName;
            $lyric->{$setter}($fieldName);
            $changeSet = $lyric->getChangeSet();
            $expectedChangeSet[$fieldName] = $fieldName;
            $this->assertSame($expectedChangeSet, $changeSet);
        }
    }
    
    public function testIsChanged()
    {
        $lyric = new Lyric();
        foreach ($this->simpleFields as $fieldName) {
            $this->assertFalse($lyric->isChanged($fieldName));
            $setter = 'set' . $fieldName;
            $lyric->{$setter}($fieldName);
            $this->assertTrue($lyric->isChanged($fieldName));
        }
    }
    
    public function testHasVideo()
    {
        $videoFields = [
            'videoYoutube',
            'VideoVbox7',
        ];
        
        // test with no video
        $lyric = new Lyric();
        $this->assertFalse($lyric->hasVideo());
        
        // test with existing video
        foreach ($videoFields as $videoField) {
            $lyric = new Lyric();
            $setter = 'set' . $videoField;
            $lyric->{$setter}('someVideo');
            $this->assertTrue($lyric->hasVideo());
        }
    }
    
    public function testConstruct()
    {
        $simpleFields = $this->simpleFields;
        $data = array_fill_keys($simpleFields, 'testData');
        
        $lyric = new Lyric($data);
        foreach ($simpleFields as $fieldName) {
            $getter = 'get' . $fieldName;
            $this->assertSame(
                $data[$fieldName],
                $lyric->{$getter}()
            );
        }
        
        // special test for id
        $lyric = new Lyric(['id' => 4]);
        $this->assertSame(4, $lyric->getId());
    }
    
    public function testConstructCensor()
    {
        $lyricWithoutCensor = new Lyric(['censor' => false]);
        $this->assertFalse($lyricWithoutCensor->isCensor());
        
        $lyricWithCensor = new Lyric(['censor' => true]);
        $this->assertTrue($lyricWithCensor->isCensor());
    }
    
    public function testGetCensorWithNoData()
    {
        $this->expectException(\Exception::class);
        $lyric = new Lyric();
        $lyric->isCensor();
    }
}
