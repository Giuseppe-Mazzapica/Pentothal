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
use Pentothal\Stubs;

/**
 * @author  Giuseppe Mazzapica <giuseppe.mazzapica@gmail.com>
 * @license http://opensource.org/licenses/MIT MIT
 * @package Pentothal
 */
class UtilsTest extends PHPUnit_Framework_TestCase
{

    public function testVariadicCall()
    {
        $function = function($a = null, $b = null, $c = null, $d = null) {
            return func_get_args();
        };

        $zero = P\variadicCall($function, []);
        $one = P\variadicCall($function, [1]);
        $two = P\variadicCall($function, [1, 2]);
        $three = P\variadicCall($function, [1, 2, 3]);
        $four = P\variadicCall($function, [1, 2, 3, 4]);

        assertSame($zero, []);
        assertSame($one, [1]);
        assertSame($two, [1, 2]);
        assertSame($three, [1, 2, 3]);
        assertSame($four, [1, 2, 3, 4]);
    }

    /**
     * @dataProvider polymorphicSizeDataProvider
     * @param mixed $element
     * @param int $expected
     */
    public function testPolymorphicSize($element, $expected)
    {
        assertSame($expected, P\polymorphicSize($element));
    }

    public function polymorphicSizeDataProvider()
    {
        return [
            ['abc', 3],
            [123, 123],
            [123.33, 123],
            [0.9999, 0],
            [new Stubs\CountThree(), 3],
            [['a', 1, [], null], 4],
            [(object)['a' => 'b', 'c' => 'd'], 1],
            [[], 0],
            [null, 0],
            [new \ArrayObject(['foo', 'bar']), 2]
        ];
    }

    /**
     * @dataProvider polymorphicKeyValueDataProvider
     * @param $object
     * @param $key
     * @param $expected
     */
    public function testPolymorphicKeyValue($object, $key, $expected)
    {
        assertSame($expected, P\polymorphicKeyValue($object, $key));
    }

    public function polymorphicKeyValueDataProvider()
    {
        return [
            [['foo' => 'bar'], 'foo', 'bar'],
            [['foo' => ['a', 'b', 'c']], 'foo', ['a', 'b', 'c']],
            [(object)['foo' => ['a', 'b', 'c']], 'foo', ['a', 'b', 'c']],
            [new \ArrayObject(['foo' => ['a', 'b', 'c']]), 'foo', ['a', 'b', 'c']],
        ];
    }

    public function testApplyOnClone()
    {
        $stub = new Stubs\Incrementable();
        $incremented1 = P\applyOnClone($stub, 'increment');
        $incremented3 = P\applyOnClone($stub, 'increment', [3]);

        assertSame(0, $stub->n);
        assertSame(1, $incremented1->n);
        assertSame(3, $incremented3->n);

    }
}