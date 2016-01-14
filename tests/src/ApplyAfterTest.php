<?php
/*
 * This file is part of the Pentothal package.
 *
 * (c) Giuseppe Mazzapica <giuseppe.mazzapica@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Pentothal\Tests;

use PHPUnit_Framework_TestCase;
use Pentothal as P;

/**
 * @license http://opensource.org/licenses/MIT MIT
 * @package Pentothal
 */
final class ApplyAfterTest extends PHPUnit_Framework_TestCase
{
    public function testApplyAfter()
    {
        $frank = ['name' => 'frank'];
        $jane  = ['name' => 'jane'];

        $getName = function (array $user) {
            return $user['name'];
        };

        $isFrank = P\applyAfter($getName, P\isSame('frank'));

        assertTrue($isFrank($frank));
        assertFalse($isFrank($jane));
    }
}
