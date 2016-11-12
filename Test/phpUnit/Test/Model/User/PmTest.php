<?php

use PHPUnit\Framework\TestCase;

use Tekstove\SiteBundle\Model\User\Pm;
use Tekstove\SiteBundle\Model\User\User;

/**
 * @author po_taka <angel.koilov@gmail.com>
 */
class PmTest extends TestCase
{
    public function testGetChangeSet()
    {
        $pm = new Pm();
        $pm->setTitle('some title');
        $user = new User([
            'id' => 7,
            'username' => 'someusername',
        ]);
        $pm->setUserTo($user);
        
        $this->assertSame(
                [
                    'title' => 'some title',
                    'userTo' => [
                        'id' => 7,
                    ]
                ],
                $pm->getChangeSet()
        );
    }
}
