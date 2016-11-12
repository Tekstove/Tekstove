<?php

namespace Test\Helper;

use PHPUnit\Framework\TestCase;
use Tekstove\SiteBundle\Helper\ChangeSetable;

/**
 * Description of ChangeSetableTest
 *
 * @author po_taka
 */
class ChangeSetableTest extends TestCase
{
    public function testEmptyChangeset()
    {
        $mockBuilder = $this->getMockBuilder(ChangeSetable::class);
        $changeSetable = $mockBuilder->getMockForTrait();
        $this->assertEmpty($changeSetable->getChangeSet());
    }
}
