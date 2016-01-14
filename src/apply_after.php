<?php
/*
 * This file is part of the Pentothal package.
 *
 * (c) Giuseppe Mazzapica <giuseppe.mazzapica@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Pentothal;

/**
 * Returns a function which applies a transformation function to it's imput
 * before testing it with the predicate function.
 *
 * @param  callable $transformation
 * @param  callable $predicate
 *
 * @return \Clojure
 */
function applyAfter(callable $transformation, callable $predicate)
{
    return function ($value) use ($transformation, $predicate) {
        return $predicate($transformation($value));
    };
}
