# Usage exmaple

~~~
use alcamo\collection\Collection;

class CollectionWithHash extends Collection
{
    public function sha1(): string
    {
        return sha1(implode('|', $this->data_));
    }
}

$collection = new CollectionWithHash([ 'foo', 'bar' ]);

echo $collection[0] . "\n";

echo count($collection) . "\n";

echo $collection->sha1() . "\n";
~~~

This will output

~~~
foo
2
4fa0d6984df3b91af1f0942b7522987783050b90
~~~

The `$collection` object behaves very much like an array, supporting
`count()`, iteration and array access. You can add functionality by
adding more methods to your class derived from `Collection`.


# Overview

This package provides collection traits and classes featuring
array-like behaviour by accessing an inner object `$data_`, which may
be, for instance, an array or an SPL object.

This allows to restrict access to the inner object, for example
implementing a readonly array, or to add further methods.

In addition, this package contains some specific collection classes,
some of which are based on this mechanism.

# Ready-to-use traits and classes

* `Collection` is a class with an array as `$data_` that implements
  the `Countable`, `Iterator` and `ArrayAccess` interfaces and
  provides some further methods. All indexes are converted to strings
  so that objects having a `__toString()` method can be used as keys
  without need for explicit conversion.
  
  All of its functionality is actually contained in the trait
  `CollectionTrait` so that it is easy to integrate into existing
  class hierarchies.
* `ReadonlyCollection` is the same except that it prevents write
  access through the `ArrayAccess` interface. Again, all of its
  functionality is contained in a trait, `ReadonlyCollectionTrait`.
* `SplObjectStorageCollection` (using
  `SplObjectStorageCollectionTrait`) and
  `ReadonlySplObjectStorageCollection` (using
  `ReadonlySplObjectStorageCollectionTrait`) do the same with an
  `SplObjectStorage` object as `$data_`.
* `PrefixFirstMatchCollection` (using
  `PrefixFirstMatchCollectionTrait`) and
  `ReadonlyPrefixFirstMatchCollection` (using
  `ReadonlyPrefixFirstMatchCollectionTrait`) do the same as
  `Collection` and `ReadonlyCollection` except that array access works
  on the *first* array elementwhose key matches an *initial substring*
  of the supplied offset string (or object which is implicitly
  converted to a string).
* `ReadonlyPrefixSet` is a particular-purpose class making use of the
  traits in this package. It implements a set of prefixes and provides
  an efficient method `contains()` that checks whether a given string
  matches one of the prefixes in the set.
* `ReadonlyPrefixBlackWhiteList` is based on `ReadonlyPrefixSet`,
  adding the feature that the object can be used as either a blacklist
  or a whitelist.
* `StringSetOrAnyString` implements an object which represents either
  a finite set of strings or the set of all strings.

# Provided traits

The above classes and traits are built from the following atomic traits.

## Traits providing the inner object

* `ArrayDataTrait` provides an inner object of type `array`.
* `SplObjectStorageDataTrait` provides an inner object of type `SplObjectStorage`

Extensions of this package can easily provide similar traits for other
object types.

## Cloning

`CloneTrait` provides a `__clone()` method to create a deep copy of
`$data_`. It works for both arrays and objects.

## Item count

`CountableTrait` provides a method `count()` telling the number of
items in `$data_`. It works for both arrays and objects.

## Iteration

* `ArrayIteratorTrait` provides the methods needed for the [`Iterator`
  interface](https://www.php.net/manual/en/class.iterator) when
  `$data_` is an array. In addition, this trait supplies methods to
  access the first and the last value in the array and to get all keys
  of the array.
* `ObjectIteratorTrait` does the same for an inner object that
  implements `Iterator`.
* `SplObjectStorageIteratorTrait` does the same for an inner object of
  class `SplObjectStorageIterator`. A separate trait is needed because
  `SplObjectStorage` iteration [does not behave as one would
  expect](https://bugs.php.net/bug.php?id=49967).
* `IteratorAggregateTrait` provides the methods needed for the
  [`IteratorAggregate`
  interface](https://www.php.net/manual/en/class.iteratoraggregate). To
  use it, `$data_` must be an object that implements
  `IteratorAggregate`.
  
All of these traits result in a collection object that supports
iteration, but the developer must know at compile time which type
`$data_` will have.

## Array access

* `ReadArrayAccessTrait` provides the methods of the [`ArrayAccess`
  interface](https://www.php.net/manual/en/class.arrayaccess) needed
  for reading.
* `StringIndexedReadArrayAccessTrait` does the same but converts all
  keys to strings. This allows for direct use of objects as keys if
  the have a `__toString()` method.
* `PrefixFirstMatchReadArrayAccessTrait` works similar to
  `StringIndexedReadArrayAccessTrait` but works on the *first* array
  element whose key matches an *initial substring* of the supplied
  offset string (or object which is implicitly converted to a
  string).
* `WriteArrayAccessTrait` provides the methods of `ArrayAccess` needed
  for writing.
* `StringIndexedWriteArrayAccessTrait` does the same but converts all
  keys to strings. Again, this allows for direct use of objects as keys if
  the have a `__toString()` method.
* `PreventWriteArrayAccessTrait` implements the methods needed for
  writing in a way that they throw a `ReadonlyViolation` exception on
  each write attempt. Hence a class using `ReadArrayAccessTrait` and
  `PreventWriteArrayAccessTrait` implements the `ArrayAccess`
  interface for a readonly array.

## contains()

`ContainsTrait` provides a method `contains()` telling whether
`$data_` has an item with the indicated value. It works for both
arrays and objects.

## Calling methods of the inner object

`DecoratorTrait` forwards calls of unknown methods to `$data_`.

## Other traits

* `BlackWhiteListTrait` adds functionality that declares a collection
  to be a blacklist or a whitelist.
