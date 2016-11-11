<?php

namespace TekstoveTest\Site\Model\Lyric;

use PHPUnit\Framework\TestCase;
use Tekstove\SiteBundle\Model\Lyric\Lyric;

/**
 * @author po_taka <angel.koilov@gmail.com>
 */
class LyricTest extends TestCase
{
    public function testGetChangedFields()
    {
        $changableFields = [
            'text',
            'textBg',
            'extraInfo',
            'title',
            'download',
            'videoYoutube',
            'videoVbox7',
        ];
        
        $lyric = new Lyric();
        $expectedChangeSet = [];
        foreach ($changableFields as $fieldName) {
            $setter = 'set' . $fieldName;
            $lyric->{$setter}($fieldName);
            $changeSet = $lyric->getChangeSet();
            $expectedChangeSet[$fieldName] = $fieldName;
            $this->assertSame($expectedChangeSet, $changeSet);
        }
    }
}
