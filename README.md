Pentothal
=========

-------

[![travis-ci status](https://img.shields.io/travis/Giuseppe-Mazzapica/Pentothal.svg?style=flat-square)](https://travis-ci.org/Giuseppe-Mazzapica/Pentothal)
[![codecov.io](https://img.shields.io/codecov/c/github/Giuseppe-Mazzapica/Pentothal.svg?style=flat-square)](http://codecov.io/github/Giuseppe-Mazzapica/Pentothal?branch=master)
[![license](https://img.shields.io/packagist/l/gmazzap/pentothal.svg?style=flat-square)](http://opensource.org/licenses/MIT)
[![release](https://img.shields.io/github/release/Giuseppe-Mazzapica/Pentothal.svg?style=flat-square)](https://github.com/Giuseppe-Mazzapica/Pentothal/releases/latest)

-------

> Higher order predicates library.

----------------------------------

# What?

An "higher order function" is a function that either returns a function or takes a function as argument.

A "functional predicate" is a function that receives one or more arguments (subject) and returns `true` or `false`.

**This library is a collections of functions that return functional predicates**.

# Why?

In PHP there are some functions like `array_map`, `array_filter`, and so on, that take a functional predicate
as argument.

For example:

```php
$data = [
  'foo',
  1,
  true,
  'bar',
  [],
  ''
];

$strings = array_filter($data, 'is_string'); // ['foo', 'bar', '']
```

This can be done thanks to the fact that a `is_string` is a named function.

But if we need something more complex, e.g. we also want to strip empty strings, we need to:

```php
$strings = array_filter($data, function($item) {
    return is_string($item) && $item !== '';
});
```

One of the functions of this library is `isType()` that accepts a string representing a type 
and returns a predicate that can be used to check subjects against that typoe.

Another of the functions of this library is `isNotEmpty()` that returns a predicate that verifies non-empty values.

Another function is `combine()` that takes an arbitrary number of predicates and returns a predicate
that returns `true` when all the combined predicates return true.

Using these 3 functions the code above can be written like this:

```php
use Pentothal as P;

$strings = array_filter($data, P\combine(P\isType('string'), P\isNotEmpty()));
```

All the functions in this library are in `Pentothal` namespace.


# Installation

Served by Composer using `gmazzap/pentothal`.


# List of functions

Here a list of all the functions currently provided by library (namespace omitted):

### General

 - `always()` Return a predicate that always return `true`
 - `never()` Return a predicate that always return `false`
 - `isEmpty()`
 - `isNotEmpty()`
 
### Comparison
 
 - `isSame($value)`
 - `isNotSame($value)`
 - `isEqual($value)`
 - `isNotEqual($value)`
 - `match(string $regex)` 
 - `notMatch(string $regex)`
 
### Type check

 - `isType(string $type)` Works with scalar types, classes and interfaces
 - `isNotType(string $type)`
 - `isInt()`
 - `isNotInt()`
 - `isFloat()`
 - `isNotFloat()`
 - `isNumber()`
 - `isNotNumber()`
 - `isString()`
 - `isNotString()`
 - `isBool()`
 - `isNotBool()`
 - `isNull()`
 - `isNotNull()`
 - `isObject()`
 - `isNotObject()`
 - `isArray()`
 - `isNotArray()`

### Var filtering check

 - `filterVar(int $filter, $options = null)` Returns a predicate that applies `filter_var()` to subject using given filter and options.
 - `isEmail()`
 - `isNotEmail()`
 - `isUrl()`
 - `isNotUrl()`
 - `isIp()`
 - `isNotIp()`
 - `isMac()`
 - `isNotMac()`
 
### Size check

 - `size(int $size)` Verify elements count of arrays and countable objects and string length
 - `sizeMax(int $size)`
 - `sizeMaxStrict(int $size)`
 - `sizeMin(int $size)`
 - `sizeMinStrict(int $size)`
 - `between(int $min, int $max)`
 - `notBetween(int $min, int $max)`
 - `betweenInner(int $min, int $max)`
 - `notBetweenInner(int $min, int $max)`
 - `betweenLeft(int $min, int $max)`
 - `notBetweenLeft(int $min, int $max)`
 - `betweenRight(int $min, int $max)`
 - `notBetweenRight(int $min, int $max)`
 
### Elements check (for arrays and strings)

 - `contain($item)` Verify `$item` is present in arrays, or if both `$item` and subject are strings check the subject contain `$item`
 - `notContain($item)`
 - `startWith($item)` Verify first element of arrays, or if both `$item` and subject are strings check the subject string starts with `$item`
 - `notStartWith($item)` Verify first element of arrays, or if both `$item` and subject are strings check the subject string starts with `$item`
 - `endWith($item)`
 - `notEndWith($item)`
 
### Elements check for arrays only

 - `anyOfValues(array $values)` Verify array subject for intersection with given values
 - `notAnyOfValues(array $values)`
 - `anyOf(...$values)` Like `anyOfValues` but with variadic arguments
 - `notAnyOf(...$values)`
 
### Elements check for arrays and objects
 
 - `hasValue($value)` Return a predicate that checks an array or a traversable object to find an element equal to value given
 - `hasNotValue($value)`
 - `hasValues(array $value)`
 - `hasNotValues(array $values)`
 - `hasAnyOfValues(array $values)`
 - `hasNotAnyOfValues(array $values)`
 
### Object properties check (works with associative arrays as well)

 - `hasKey(string $key)`
 - `hasKeys(array $keys)`
 - `hasNotKeys(array $keys)`
 - `hasAnyOfKeys(array $keys)`
 - `hasNotAnyOfKeys(array $keys)`
 - `keyIs(string $key, $value)`
 - `keyIsNot(string $key, $value)`
 - `keyIsAnyOf(string $key, array values)`
 - `keyIsNotAnyOf(string $key, array $values)`
 - `keyIsType(string $key, string $type)`
 - `keyInNotType(string $key, string $type)`
 - `keyApply(string $key, callable $predicate)` Return a predicate that applies a predicate to a key of the subject
 
### Object methods check

 - `hasMethod(string $method)`
 - `hasNotMethod(string $method)`
 - `methodReturn(string $method, $value, array $methodArgs = [])`
 - `methodNotReturn(string $method, $value, array $methodArgs = [])`
 - `methodReturnAnyOf(string $method, array $values, array $methodArgs = [])`
 - `methodNotReturnAnyOf(string $method, array $values, array $methodArgs = [])`
 - `methodReturnType(string $method, string $type, array $methodArgs = [])`
 - `methodNotReturnType(string $method, string $type, array $methodArgs = [])`
 - `methodReturnEmpty(string $method, array $methodArgs = [])`
 - `methodReturnNotEmpty(string $method, array $methodArgs = [])`
 - `methodReturnApply(string $method, callable $predicate, array $methodArgs = [])` Return a predicate that applies a predicate return value of given method of the subject

 
### Bulk

 - `bulk(callable $predicate)` Return a predicate that applies the same predicate to an array of values and returns true when the given predicate return true for all values
 - `bulkPool(callable $predicate)` Like `bulk()` but returned predicate return `true` the given predicate returns `true` for any of the values

### Predicates composition

- `negate(callable $predicate)` Return a predicate that return `true` when given predicate return `false` and viceversa
- `combine(...$predicates)` Return a predicate that returns `true` when all the given predicates returns true
- `pool(...$predicates)` Return a predicate that returns `true` when any of the given predicates returns true
- `combineCallbacks(array $predicates)` Like `combine()` but accepts an array of predicates
- `poolCallbacks(...$predicates)` Like `pool()` but accepts an array of predicates
- `combineMap(array $predicates)` Takes a map of predicates and return a predicates that applies to a map value, returns true when all the predicates return true
- `poolMap(array $predicates)` Like combineMap, but the returned predicates return `true` when any the predicates returns `true`

### Transforming a value before applying the predicate

- `applyAfter(callable $transformation, callable $predicate)` Returns a predicate
  which returns the result of the predicate, after it has been applied
  the the input value, transformed by the `$transformation` function.

#### Example

```php
use Pentothal as P;

function getYear(DateTime $data)
{
    return $data->format('Y');
}

$datesFrom2016 = array_filter($dates, P\applyAfter('getYear', isSame('2016')));

```
 
# Quite complex example

```php
use Pentothal as P;

// some example data
$countableOne = new \ArrayObject(['foo' => 'bar']);
$countableTwo = new \ArrayObject(['a' => 'a', 'b' => 'b']);
$plainObj = new \stdClass();
$string1 = 'a';
$string3 = 'abc';
$number1 = 1;
$number3 = 3;

$list = [
  'a' => $countableOne,
  'b' => $countableTwo,
  'c' => $plainObj,
  'd' => $string1,
  'e' => $string3,
  'f' => $number1,
  'g' => $number3
];


$predicate = P\combine(
  P\pool(P\isNotObject(), P\isType('Countable')), // filter out: ['c' => $plainObj]
  P\pool(P\isNotString(), P\size(3)), // filter out: ['d' => $string1]
  P\pool(P\isString(), P\size(1)) // filter out: ['a' => $countableTwo, 'g' => $number3]
);

$negatePredicate = negate($predicate);

$in = array_filter($list, $predicate);
$out = array_filter($list, $negatePredicate);

var_dump($in); // array('a' => $countableOne, 'e' => $string3, 'f' => $number1];
var_dump($out); // array('b' => $countableTwo, 'c' => $plainObj, 'd' => $string1, 'g' => $number3];    
```
