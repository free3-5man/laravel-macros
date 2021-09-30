# A supplement of Laravel macros and helpers

This repository contains some useful collection macros and helper functions.

## Installation

You can pull in the package via composer:

``` bash
composer require freeman/laravel-macros
```

The package will automatically register itself.

## Macros
- [`Collection`](#collection)
    - [`append`](#append)
    - [`camelCaseKeys`](#camelcasekeys)
    - [`dig`](#dig)
    - [`equals`](#equals)
    - [`ifAll`](#ifall)
    - [`ifAny`](#ifany)
    - [`indexOfAll`](#indexofall)
    - [`initial`](#initial)
    - [`kebabCaseKeys`](#kebabcasekeys)
    - [`limit`](#limit)
    - [`lowerCaseKeys`](#lowercasekeys)
    - [`mapExcept`](#mapexcept)
    - [`mapKeys`](#mapkeys)
    - [`mapOnly`](#maponly)
    - [`nest`](#nest)
    - [`offset`](#offset)
    - [`snakeCaseKeys`](#snakecasekeys)
    - [`sortKeysByKeysRanking`](#sortkeysbykeysranking)
    - [`tail`](#tail)
    - [`toCSV`](#tocsv)
    - [`transformKeys`](#transformkeys)
    - [`whereLike`](#wherelike)
    - [`whereNotLike`](#wherenotlike)
    - [`zipWithKeys`](#zipwithkeys)
- [`Eloquent Collection`](#eloquent-collection)
    - [`addAppends`](#addappends)
    - [`addHidden`](#addhidden)
- [`Query Builder`](#query-builder)
    - [`addSelectSub`](#addselectsub)
    - [`filter`](#filter)
    - [`filterRange`](#filterrange)
    - [`filterWhereNull`](#filterwherenull)
    - [`overlaps`](#overlaps)
- [`Eloquent Builder`](#eloquent-builder)
    - [`dumpSql`](#dumpsql)
    - [`enhancedPaginate`](#enhancedpaginate)
    - [`getFullSql`](#getfullsql)
- [`Arr`](#arr)
    - [`buildQuery`](#buildquery)
    - [`dotOnly`](#dotonly)
    - [`expand`](#expand)
    - [`isAssoc`](#isassoc)
    - [`isSub`](#issub)
    - [`parseQuery`](#parsequery)
    - [`range`](#range)
    - [`remove`](#remove)
    - [`repeat`](#repeat)
    - [`toObject`](#toobject)
- [`Str`](#str)
    - [`allWords`](#allwords)
    - [`capitalize`](#capitalize)
    - [`chars`](#chars)
    - [`decapitalize`](#decapitalize)
    - [`each`](#each)
    - [`humanize`](#humanize)
    - [`lines`](#lines)
    - [`map`](#map)
    - [`mask`](#mask)
    - [`reduce`](#reduce)
    - [`repeat`](#repeat-1)
    - [`reverse`](#reverse)
    - [`swapCase`](#swapcase)
- [`Carbon`](#carbon)
    - [`getNaturalWeeks`](#getnaturalweeks)
- [`CarbonPeriod`](#carbonperiod)
    - [`countWeeks`](#countweeks)

## helpers
- [`getDateTimeString`](#getdatetimestring)
- [`getTimestamp`](#gettimestamp)
- [`formatDateTimeAssoc`](#formatdatetimeassoc)

### `Collection`
#### `append`

Same with push, is a pair of prepend.

```php
collect([1, 2, 3])->append(0);  // [1, 2, 3, 0]
```

#### `camelCaseKeys`

Creates a new array from the specified assoc array, where all the keys are in camel-case.

```php
collect([
    'First_name' => 'Adam',
    'last-name' => 'Smith',
])->camelCaseKeys();
// [
//     'firstName' => "Adam",
//     'lastName' => "Smith",
// ]
```

#### `dig`

Returns the target value in a nested JSON object, based on the given key.

```php
$coll = collect([
    'level1' => [
        'level2' => [
            'level3' => 'some data',
        ],
    ],
]);
$coll->dig('level2');   // ['level3' => 'some data']
$coll->dig('level3');   // 'some data'
$coll->dig('level4');   // null
```

#### `equals`

Checks if the collection is equal to the given value.

```php
collect([1, 2, 3])->equals([1, 2, 3]);  // true
collect([1, 2, 3])->equals([1, 2 => 2, 3]);  // false
```

#### `ifAll`

Returns true if the fallback function returns true for all elements in a collection,false otherwise.

```php
collect([1, '1', true, 'null'])->ifAll();   // true
collect([2, 3, 4])->ifAll(function ($item) {
    return $item > 1;
}); // true
collect([1, 2, 3, 4])->ifAll(function ($item) {
    return $item > 1;
}); // false
```

#### `ifAny`

Returns true if the fallback function returns true for at least one element in a collection, false otherwise.

```php
collect([0, 1, 2])->ifAny(function ($item) {
    return $item > 1;
}); // true
collect([0, 1])->ifAny(function ($item) {
    return $item > 1;
}); // false
collect([0, '0', false, null, [], ''])->ifAny();    // false
```

#### `indexOfAll`

Returns all indices of value in the array. If value never occurs, returns [].

```php
collect([1, 2, 3, 1, 2, 3])->indexOfAll(1); // [0, 3]
collect(['1', 2, 3, 1, 2, 3])->indexOfAll(1, $strict = true);   // [3]
collect([1, 2, 3])->indexOfAll(4);  // []
```

#### `initial`

Returns all the elements of an array except the last one.

```php
collect([1, 2, 3])->initial();  // [1, 2]
```

#### `kebabCaseKeys`

Creates a new array from the specified assoc array, where all the keys are in kebab-case.

```php
collect([
    'First_name' => 'Adam',
    'lastName' => 'Smith',
])->kebabCaseKeys();
// [
//     'first-name' => "Adam",
//     'last-name' => "Smith",
// ]
```

#### `limit`

An alias of take.

```php
collect([2, 1, 2, 5])->limit(2);    // [2, 1]
```

#### `lowerCaseKeys`

Creates a new array from the specified assoc array, where all the keys are in camel-case.

```php
collect([
    'First_name' => 'Adam',
    'lastName' => 'Smith',
])->lowerCaseKeys();
// [
//     'first_name' => "Adam",
//     'lastname' => "Smith",
// ]
```

#### `mapExcept`

First do high-order map, then except keys for each item.

```php
collect([
    [
        'id' => 1,
        'name' => 'Michael',
        'age' => 18,
    ],
    [
        'id' => 2,
        'name' => 'David',
        'age' => 20,
    ],
    [
        'id' => 3,
        'name' => 'James',
        'age' => 22,
    ],
])->mapExcept(['age']);
// [
//     [
//         'id' => 1,
//         'name' => 'Michael',
//     ],
//     [
//         'id' => 2,
//         'name' => 'David',
//     ],
//     [
//         'id' => 3,
//         'name' => 'James',
//     ],
// ]
```

#### `mapKeys`

First do high-order map, then only keys for each item.

```php
collect([
    'First_name' => 'Adam',
    'last-name' => 'Smith',
])->mapKeys(function($key) {
    return Str::camel($key);
});
// [
//     'firstName' => "Adam",
//     'lastName' => "Smith",
// ]
```

#### `mapOnly`

First do high-order map, then only keys for each item.

```php
collect([
    [
        'id' => 1,
        'name' => 'Michael',
        'age' => 18,
    ],
    [
        'id' => 2,
        'name' => 'David',
        'age' => 20,
    ],
    [
        'id' => 3,
        'name' => 'James',
        'age' => 22,
    ],
])->mapOnly(['id', 'name']);
// [
//     [
//         'id' => 1,
//         'name' => 'Michael',
//     ],
//     [
//         'id' => 2,
//         'name' => 'David',
//     ],
//     [
//         'id' => 3,
//         'name' => 'James',
//     ],
// ]
```

#### `nest`

Given a flat array of objects linked to one another, it will nest them recursively.

```php
collect([
    ['id' => 1, 'comment_id' => null],
    ['id' => 2, 'comment_id' => 1],
    ['id' => 3, 'comment_id' => 1],
    ['id' => 4, 'comment_id' => 2],
    ['id' => 5, 'comment_id' => 4],
])->nest('comment_id');
// [
//     [
//         'id' => 1,
//         'comment_id' => null,
//         'children' => [
//             [
//                 'id' => 2,
//                 'comment_id' => 1,
//                 'children' => [
//                     [
//                         'id' => 4,
//                         'comment_id' => 2,
//                         'children' => [
//                             [
//                                 'id' => 5,
//                                 'comment_id' => 4,
//                             ],
//                         ],
//                     ],
//                 ],
//             ],
//             [
//                 'id' => 3,
//                 'comment_id' => 1,
//             ],
//         ],
//     ]
// ]

collect([
    ['_id' => 1, 'comment_id' => null],
    ['_id' => 2, 'comment_id' => 1],
    ['_id' => 3, 'comment_id' => 1],
    ['_id' => 4, 'comment_id' => 2],
    ['_id' => 5, 'comment_id' => 4],
])->nest('comment_id', '_id');
// [
//     [
//         '_id' => 1,
//         'comment_id' => null,
//         'children' => [
//             [
//                 '_id' => 2,
//                 'comment_id' => 1,
//                 'children' => [
//                     [
//                         '_id' => 4,
//                         'comment_id' => 2,
//                         'children' => [
//                             [
//                                 '_id' => 5,
//                                 'comment_id' => 4,
//                             ],
//                         ],
//                     ],
//                 ],
//             ],
//             [
//                 '_id' => 3,
//                 'comment_id' => 1,
//             ],
//         ],
//     ]
// ]

collect([
    ['id' => 1, 'comment_id' => null],
    ['id' => 2, 'comment_id' => 1],
    ['id' => 3, 'comment_id' => 1],
    ['id' => 4, 'comment_id' => 2],
    ['id' => 5, 'comment_id' => 4],
])->nest('comment_id', 'id', 'child');
// [
//     [
//         'id' => 1,
//         'comment_id' => null,
//         'child' => [
//             [
//                 'id' => 2,
//                 'comment_id' => 1,
//                 'child' => [
//                     [
//                         'id' => 4,
//                         'comment_id' => 2,
//                         'child' => [
//                             [
//                                 'id' => 5,
//                                 'comment_id' => 4,
//                             ],
//                         ],
//                     ],
//                 ],
//             ],
//             [
//                 'id' => 3,
//                 'comment_id' => 1,
//             ],
//         ],
//     ]
// ]

collect([
    ['id' => 1, 'comment_id' => null],
    ['id' => 2, 'comment_id' => 1],
    ['id' => 3, 'comment_id' => 1],
    ['id' => 4, 'comment_id' => 2],
    ['id' => 5, 'comment_id' => 4],
])->nest('comment_id', 'id', 'child', true);
// [
//     [
//         'id' => 1,
//         'comment_id' => null,
//         'children' => [
//             [
//                 'id' => 2,
//                 'comment_id' => 1,
//                 'children' => [
//                     [
//                         'id' => 4,
//                         'comment_id' => 2,
//                         'children' => [
//                             [
//                                 'id' => 5,
//                                 'comment_id' => 4,
//                                 'children' => [],
//                             ],
//                         ],
//                     ],
//                 ],
//             ],
//             [
//                 'id' => 3,
//                 'comment_id' => 1,
//                 'children' => [],
//             ],
//         ],
//     ]
// ]
```

#### `offset`

An alias of skip.

```php
collect([2, 1, 2, 5])->offset(1)->values(); // [1, 2, 5]
```

#### `snakeCaseKeys`

Creates a new array from the specified assoc array, where all the keys are in snake-case.

```php
collect([
    'First_name' => 'Adam',
    'lastName' => 'Smith',
])->snakeCaseKeys();
// [
//     'first_name' => "Adam",
//     'last_name' => "Smith",
// ]
```

#### `sortKeysByKeysRanking`

Sort the collection by the keys ranking.

```php
collect([
    'A' => 'a',
    'B' => 'b',
    'C' => 'c',
    'D' => 'd',
    'E' => 'e',
])->sortKeysByKeysRanking([
    'A' => 3,
    'B' => 2,
    'C' => 1,
    'D' => 5,
    'E' => 4,
]);
// [
//     'C' => 'c',
//     'B' => 'b',
//     'A' => 'a',
//     'E' => 'e',
//     'D' => 'd',
// ]
```

#### `tail`

Returns all the elements of an array except the first one.

```php
collect([1, 2, 3]); // [1, 2]
```

#### `toCSV`

Converts a 2D array to a comma-separated values (CSV) string.

```php
collect([['a', 'b'], ['c', 'd']])->toCSV(); // 'a,b\nc,d'
collect([['a', 'b'], ['c', 'd']])->toCSV(';');  // 'a;b\nc;d'
```

#### `transformKeys`

Transform only keys, values unchanged.

```php
$coll = collect([
    'First_name' => 'Adam',
    'last-name' => 'Smith',
]);
$coll->transformKeys(function ($key) {
    return Str::camel($key);
});
// $coll->dump();
// [
//     'firstName' => "Adam",
//     'lastName' => "Smith",
// ]
```

#### `whereLike`

Filter with regex.

```php
collect(["foo", "bar", "hello", "world"])->whereLike('o');  // ["foo", "hello", "world"]
collect([
    ['foo' => "hello"],
    ['foo' => "bar"],
    ['foo' => "world"],
])->whereLike('foo', 'o');
// [
//     ['foo' => "hello"],
//     ['foo' => "world"],
// ]
```

#### `whereNotLike`

Reject with regex.

```php
collect(["foo", "bar", "hello", "world"])->whereNotLike('o');   // ["bar"]
collect([
    ['foo' => "hello"],
    ['foo' => "bar"],
    ['foo' => "world"],
])->whereNotLike('foo', 'o');   // [['foo' => "bar"]]
```

#### `zipWithKeys`

Given an array of valid property identifiers and an array of values, return an object associating the properties to the values.
Similar but not same with collection method: combine.

```php
collect(['a', 'b'])->zipWithKeys([1, 2]);   // ['a' => 1, 'b' => 2]
collect(['a', 'b', 'c'])->zipWithKeys([1, 2]);  // ['a' => 1, 'b' => 2, 'c' => null]
collect(['a', 'b'])->zipWithKeys([1, 2, 3]);    // ['a' => 1, 'b' => 2]
```

### `Eloquent Collection`
```php
// models
class User extends Model
{
    protected $table = 'users';

    public function getGenderZhCnAttribute()
    {
        return [
            'male' => '男',
            'female' => '女',
            'unknown' => '未知',
        ][$this->gender];
    }
}

// migrations
Schema::create('users', function (Blueprint $table) {
    $table->increments('id');
    $table->timestamps();
    $table->softDeletes();

    $table->string('name');
    $table->date('birthday');
    $table->integer('height');
    $table->string('email')->nullable();
    $table->string('gender');
});
Schema::create('articles', function (Blueprint $table) {
    $table->increments('id');
    $table->timestamps();
    $table->softDeletes();

    $table->string('title');
    $table->text('content');
    $table->integer('author_id');
});

// seeders
DB::table('users')->insert([
    [
        'name' => 'freeman',
        'birthday' => '2020-01-01',
        'height' => 175,
        'email' => 'freeman@163.com',
        'gender' => 'male',
    ],
    [
        'name' => 'michael',
        'birthday' => '2020-02-01',
        'height' => 185,
        'email' => null,
        'gender' => 'male',
    ],
    [
        'name' => 'david',
        'birthday' => '2020-03-01',
        'height' => 165,
        'email' => null,
        'gender' => 'male',
    ],
]);

factory(Article::class)->times(5)->create([
    'author_id' => 1,
]);
factory(Article::class)->times(3)->create([
    'author_id' => 2,
]);
factory(Article::class)->times(8)->create([
    'author_id' => 3,
]);

DB::table('films')->insert([
    [
        'name' => 'Star Wars',
        'start_time' => '2020-12-31 19:00:00',
        'end_time' => '2020-12-31 22:00:00',
    ],
    [
        'name' => 'The Avengers 4',
        'start_time' => '2020-12-31 21:30:00',
        'end_time' => '2021-01-01 00:30:00',
    ],
    [
        'name' => 'Avatar',
        'start_time' => '2021-01-01 01:00:00',
        'end_time' => '2021-01-01 03:00:00',
    ],
]);
```
#### `addAppends`

Append attributes for each model in the collection.

```php
$users = User::all(['name', 'gender']);
// [
//     [
//         'name' => 'freeman',
//         'gender' => 'male',
//     ],
//     [
//         'name' => 'michael',
//         'gender' => 'male',
//     ],
//     [
//         'name' => 'david',
//         'gender' => 'male',
//     ],
// ]
$users->addAppends(['gender_zh_cn']);
// [
//     [
//         'name' => 'freeman',
//         'gender' => 'male',
//         'gender_zh_cn' => '男',
//     ],
//     [
//         'name' => 'michael',
//         'gender' => 'male',
//         'gender_zh_cn' => '男',
//     ],
//     [
//         'name' => 'david',
//         'gender' => 'male',
//         'gender_zh_cn' => '男',
//     ],
// ]
```

#### `addHidden`

Make the hidden attributes for each model in the collection.

```php
$users = User::all();
$users->addHidden(['id', 'birthday', 'email', 'gender', 'created_at', 'updated_at']);
// [
//     [
//         'name' => 'freeman',
//         'height' => 175,
//     ],
//     [
//         'name' => 'michael',
//         'height' => 185,
//     ],
//     [
//         'name' => 'david',
//         'height' => 165,
//     ],
// ]
```

### `Query Builder`
#### `addSelectSub`

Add a subquery as a column to the query.

```php
$builder = User::query()->select([
    'name',
]);

$builder->addSelectSub('sub_articles_count', Article::query()
    ->whereColumn('author_id', 'users.id')
    ->select(DB::raw('count(id)')))
    ->get();

// [
//     [
//         "name" => "freeman",
//         "sub_articles_count" => "5",
//     ],
//     [
//         "name" => "michael",
//         "sub_articles_count" => "3",
//     ],
//     [
//         "name" => "david",
//         "sub_articles_count" => "8",
//     ],
// ]
```

#### `filter`

Filter using whereIn or where with the request input data or specified data.

```php
// if request field equals to db field
$whereFields = [
    'users' => [
        'name',
        'birthday',
    ],
];
$data = [
    'name' => 'michael',
    'birthday' => '2020-02-01',
];
// the param '$data' retrieve request input default if not passed
User::query()->filter($whereFields, $useWhereIn = false, $data)->count();   // 1

// if request field doesn't equal to db field
$whereFields = [
    'users' => [
        'name' => 'name_field_in_request_query',
        'birthday' => 'birthday_field_in_request_query',
    ],
];
$data = [
    'name_field_in_request_query' => 'michael',
    'birthday_field_in_request_query' => '2020-02-01',
];
// the param '$data' retrieve request input default if not passed
User::query()->filter($whereFields, $useWhereIn = false, $data)->count();    // 1

// use whereIn for each field
$whereFields = [
    'users' => [
        'name',
        'birthday',
    ],
];
$data = [
    'name' => [
        'freeman',
        'michael',
    ],
    'birthday' => [
        '2020-02-01',
    ],
];
// the param '$data' retrieve request input default if not passed
User::query()->filter($whereFields, $useWhereIn = true, $data)->count();    // 1
```

#### `filterRange`

Filter using where or whereDate with the ranged request input data or specified data.

```php
// if request field equals to db field
$whereFields = [
    'users' => [
        'height',
    ],
];
$data = [
    'height_begin' => 170,
    'height_end' => 180,
];
// the param '$data' retrieve request input default if not passed
User::query()->filterRange($whereFields, $useWhereDate = false, $data)->count();    // 1

// if request field doesn't equal to db field
$whereFields = [
    'users' => [
        'height' => 'height_field_in_request_query',
    ],
];
$data = [
    'height_field_in_request_query_begin' => 170,
    'height_field_in_request_query_end' => 180,
];
// the param '$data' retrieve request input default if not passed
User::query()->filterRange($whereFields, $useWhereDate = false, $data)->count();    // 1

// use whereDate for each field
$whereFields = [
    'users' => [
        'birthday',
    ],
];
$data = [
    'birthday_begin' => '2020-01-15',
    'birthday_end' => '2020-02-15',
];
// the param '$data' retrieve request input default if not passed
User::query()->filterRange($whereFields, $useWhereDate = true, $data)->count(); // 1

// specify the suffix to replace default _begin and _end
$whereFields = [
    'users' => [
        'birthday',
    ],
];
$data = [
    'birthday_start' => '2020-01-15',
    'birthday_finish' => '2020-02-15',
];
// the param '$data' retrieve request input default if not passed
$builder->filterRange($whereFields, $useWhereDate = true, $data, '_start', '_finish')->count(); // 1
```

#### `filterWhereNull`

Filter using whereNull with the request input data or specified data.

```php
// if request field equals to db field
$whereFields = [
    'users' => [
        'email',
    ],
];
$data = [
    'email' => null,
];
// the param '$data' retrieve request input default if not passed
User::query()->filterWhereNull($whereFields, $data)->count();   // 2

// if request field doesn't equal to db field
$whereFields = [
    'users' => [
        'email' => 'email_field_in_request_query',
    ],
];
$data = [
    'email_field_in_request_query' => null,
];
// the param '$data' retrieve request input default if not passed
$builder->filterWhereNull($whereFields, $data)->count();    // 2
```

#### `overlaps`

Filter overlaps with the given period.

```php
Film::query()->overlaps('start_time', 'end_time', CarbonPeriod::create('2020-12-31 18:00:00', '2020-12-31 19:00:00'))->count();    // 0

Film::query()->overlaps('start_time', 'end_time', CarbonPeriod::create('2020-12-31 19:00:00', '2020-12-31 19:00:01'))->count();    // 1
Film::query()->overlaps('start_time', 'end_time', CarbonPeriod::create('2020-12-31 21:29:59', '2020-12-31 21:30:00'))->count();    // 1

Film::query()->overlaps('start_time', 'end_time', CarbonPeriod::create('2020-12-31 21:30:00', '2020-12-31 21:30:01'))->count();    // 2

Film::query()->overlaps('start_time', 'end_time', CarbonPeriod::create('2021-01-01 00:29:59', '2021-01-01 00:30:00'))->count();    // 1
Film::query()->overlaps('start_time', 'end_time', CarbonPeriod::create('2021-01-01 00:30:00', '2021-01-01 00:30:01'))->count();    // 0

Film::query()->overlaps('start_time', 'end_time', CarbonPeriod::create('2020-12-31 21:59:59', '2021-01-01 01:00:01'))->count();    // 3
```

### `Eloquent Builder`
#### `dumpSql`

Dump sql with bindings.

```php
User::query()->distinct()->select(['id', 'name'])->dumpSql();
// 'select distinct "id", "name" from "users" where "users"."deleted_at" is null'
```

#### `enhancedPaginate`

Enhance the existing paginate method with a map function and a given total number.

```php
// correct total when using distinct query
$paginator = User::query()->distinct()->enhancedPaginate(10, ['gender']);
$paginator->total();    // 3, the total maybe wrong when query using distinct

$builder = User::query()->distinct();
$total = $builder->count('gender'); // query the exact total here
$paginator = $builder->enhancedPaginate(10, ['gender'], null, $total);
$paginator->total();    // 1, the total here is correct

// do map with paginator but keep the data format as LengthAwarePaginator
$paginator = User::query()->enhancedPaginate(10, ['id', 'name', 'height'], function($user) {
    // format height with cm
    return $user->fill([
        'height' => $user->height . ' cm',
    ]);
});
// Illuminate\Pagination\LengthAwarePaginator
// [
//   "current_page" => 1,
//   "data" => [
//     [
//       "id" => 1,
//       "name" => "freeman",
//       "height" => "175 cm",
//     ],
//     [
//       "id" => 2,
//       "name" => "michael",
//       "height" => "185 cm",
//     ],
//     [
//       "id" => 3,
//       "name" => "david",
//       "height" => "165 cm",
//     ],
//   ],
//   "first_page_url" => "http://localhost?page=1",
//   "from" => 1,
//   "last_page" => 1,
//   "last_page_url" => "http://localhost?page=1",
//   "next_page_url" => null,
//   "path" => "http://localhost",
//   "per_page" => 10,
//   "prev_page_url" => null,
//   "to" => 3,
//   "total" => 3,
// ]
```

#### `getFullSql`

Get full sql string with bindings.

```php
User::query()->distinct()->select(['id', 'name'])->getFullSql();
// 'select distinct "id", "name" from "users" where "users"."deleted_at" is null'
```
### `Arr`
#### `buildQuery`

Build URL-encoded http query string.

```php
Arr::buildQuery([
    'per_page' => 10,
    'page' => 1,
    'a' => [
        'b' => 'c',
    ],
    'd' => ['e'],
]); // 'per_page=10&page=1&a%5Bb%5D=c&d%5B0%5D=e'
```

#### `dotOnly`

Returns only the specified key / value pairs from a deeply nested array using "dot" notation.

```php
Arr::dotOnly([
    'user' => [
        'id' => 1,
        'email' => 'a@a.com',
        'password' => 'password1',
        'profile' => [
            'birthday' => '2000-01-01',
            'gender' => 'male',
        ],
    ],
], [
    'user.id',
    'user.email',
    'user.profile.birthday',
]);
// [
//     "user" => [
//         "id" => 1,
//         "email" => "a@a.com",
//         "profile" => [
//             "birthday" => "2000-01-01",
//         ],
//     ],
// ]
```

#### `expand`

Expand the flattened dot key array to multi-dimensional array.
Has the reverse effect with the existing method Arr::dot($array).

```php
Arr::expand(['products.desk.price' => 100], '.');   // ['products' => ['desk' => ['price' => 100]]]
```

#### `isAssoc`

Judge a var is a assoc array.

```php
Arr::isAssoc(['a' => 2, 'b' => 3]); // true
Arr::isAssoc([2 => 'a', 3 => 'b']); // true
Arr::isAssoc(['a', 'b']); // false
```

#### `isSub`

Judge an array is subset of another array.

```php
Arr::isSub(['b', 'c'], ['a', 'b', 'c']);    // true
Arr::isSub(['d'], ['a', 'b', 'c']); // false
```

#### `parseQuery`

Parse the URL-encoded query string to array.

```php
Arr::parseQuery('per_page=10&page=1&a%5Bb%5D=c&d%5B0%5D=e');
// [
//     'per_page' => 10,
//     'page' => 1,
//     'a' => [
//         'b' => 'c',
//     ],
//     'd' => ['e'],
// ]
```

#### `range`

Initializes an array containing the numbers in the specified range where start and end are inclusive with there common difference step.

```php
Arr::range(5);  // [0, 1, 2, 3, 4, 5]
Arr::range(7, 3);   // [3, 4, 5, 6, 7]
Arr::range(9, 0, 2);    // [0, 2, 4, 6, 8]
```

#### `remove`

Remove an element or elements from array.

```php
Arr::remove(['a', 'c', 'b'], 'c');  // ['a', 'b']
Arr::remove(['a', 'c', 'b'], ['a']);    // ['c', 'b']
Arr::remove(['a', 'c', 'b'], ['a', 'b']);   // ['c']
```

#### `repeat`

Initializes and fills an array with the specified value.

```php
Arr::repeat(5, 2);  // [2, 2, 2, 2, 2]
Arr::repeat(5, '2');    // ['2', '2', '2', '2', '2']
```

#### `toObject`

Convert an assoc array to an object, else null.

```php
Arr::toObject(['a' => 'c']); // {'a': 'c'}
Arr::toObject(['a', 'c']);  // null
```

### `Str`
#### `allWords`

Converts a given string into an array of words with some pattern.

```php
Str::allWords('I love china!!!');   // ['I', 'love', 'china']
Str::allWords('python, javaScript & coffee first_name');    // ['python', 'javaScript', 'coffee', 'first_name']
```

#### `capitalize`

Returns the capitalized string.

```php
Str::capitalize('foo bar'); // 'Foo bar'
Str::capitalize('hello world', true);   // 'Hello World'
```

#### `chars`

Returns an array of the string’s character.

```php
Str::chars('Hello'); //["H", "e", "l", "l", "o"]
```

#### `decapitalize`

Returns the decapitalized string.

```php
Str::decapitalize(' Foo Bar '); // ' foo Bar '
Str::decapitalize(' HellO  World', true);   // ' hellO  world'
```

#### `each`

Just like collection each.

```php
$indexOfO = null;
Str::each('Hello', function ($char, $index) use(&$indexOfO) {
    if($char == 'o')
        $indexOfO = $index;
});
dump($indexOfO);  // 4
```

#### `humanize`

Converts an underscored, camelized, or dasherized string into a humanized one. Also removes beginning and ending whitespace.

```php
Str::humanize('  capitalize dash-CamelCase_underscore trim  '); // 'Capitalize dash camel case underscore trim'
```

#### `lines`

Splits a multiline string into an array of lines.

```php
Str::lines("This\nis a\nmultiline\nstring.\n"); // ['This', 'is a', 'multiline', 'string.', '']
```

#### `map`

Just like collection map.

```php
Str::map('Hello', function ($char) {
    return $char == 'o' ? 'O' : $char;
});    // 'HellO'
```

#### `mask`

Replaces part of string with the specified mask character.

```php
Str::mask('1234567890', 0, 6);  // '******7890'
Str::mask('1234567890', 7, 3);  // '1234567***'
Str::mask('1234567890', 4, 3, '$'); // '1234$$$890'
```

#### `reduce`

Just like collection reduce.

```php
Str::reduce('123', function ($carry, $char) {
    return $carry + $char;
}, 0);  // 6
```

#### `repeat`

Initializes and fills an string with the specified value.

```php
Str::repeat('foobar', 3);   // 'foobarfoobarfoobar'
```

#### `reverse`

Reverses the string.

```php
Str::reverse('foobar'); // 'raboof'
```

#### `swapCase`

Returns a copy of the string in which all the case-based characters have had their case swapped.

```php
Str::swapCase('Hello'); // 'hELLO'
```

### `Carbon`
#### `getNaturalWeeks`

Get natural weeks array of this week, each item in this array has the week start date and the week end date.
Assume monday is a week start while sunday is a week end.

```php
(new Carbon('2021-09-06'))->getNaturalWeeks();
// [
//     ['2021-09-01', '2021-09-05'],
//     ['2021-09-06', '2021-09-12'],
//     ['2021-09-13', '2021-09-19'],
//     ['2021-09-20', '2021-09-26'],
//     ['2021-09-27', '2021-09-30'],
// ]

(new Carbon('2021-08'))->getNaturalWeeks();
// [
//     ['2021-08-01', '2021-08-01'],
//     ['2021-08-02', '2021-08-08'],
//     ['2021-08-09', '2021-08-15'],
//     ['2021-08-16', '2021-08-22'],
//     ['2021-08-23', '2021-08-29'],
//     ['2021-08-30', '2021-08-31'],
// ]

(new Carbon('2022-01'))->getNaturalWeeks();
// [
//     ['2022-01-01', '2022-01-02'],
//     ['2022-01-03', '2022-01-09'],
//     ['2022-01-10', '2022-01-16'],
//     ['2022-01-17', '2022-01-23'],
//     ['2022-01-24', '2022-01-30'],
//     ['2022-01-31', '2022-01-31'],
// ]
```

### `CarbonPeriod`
#### `countWeeks`

Count natural weeks in a period, just same as calculate the sundays count.
Assume monday is a week start while sunday is a week end.

```php
(new CarbonPeriod('2021-07-31', '2021-08-01'))->countWeeks();   // 1
(new CarbonPeriod('2021-08-01', '2021-08-01'))->countWeeks();   // 1
(new CarbonPeriod('2021-08-01', '2021-08-02'))->countWeeks();   // 2
(new CarbonPeriod('2021-08-02', '2021-08-01'))->countWeeks();   // 2
(new CarbonPeriod('2021-08-01', '2021-08-31'))->countWeeks();   // 6
(new CarbonPeriod('2021-09-01', '2021-09-30'))->countWeeks();   // 5
(new CarbonPeriod('2021-12-31', '2022-01-01'))->countWeeks();   // 1
(new CarbonPeriod('2021-12-31', '2022-01-03'))->countWeeks();   // 2
```

## `helpers`
### `getDateTimeString`

Get the specified formatted datetime string of a variable.

```php
getDateTimeString(new DateTime('2020-01-02 03:06:58')); // '2020-01-02 03:06:58'
getDateTimeString(new Carbon('2020-01-02 03:06:58'));   // '2020-01-02 03:06:58'
getDateTimeString('2020-01-02 03:06:58');   // '2020-01-02 03:06:58'
getDateTimeString('2020-01-02 03:06:58', 'Y-m-d');  // '2020-01-02'

getDateTimeString(123); // null
getDateTimeString(null);    // null
```

### `getTimestamp`

Get the timestamp of a variable.

```php
getTimestamp(new DateTime('2020-01-02 03:06:58'));  // 1577934418
getTimestamp(new Carbon('2020-01-02 03:06:58'));    // 1577934418
getTimestamp('2020-01-02 03:06:58');    // 1577934418

getTimestamp(123);  // null
getTimestamp(null); // null
```

### `formatDateTimeAssoc`

Format the assoc to specified format with keys.

```php
$assoc1 = $assoc2 = [
    'a' => new DateTime('2020-01-02 03:06:58'),
    'b' => new Carbon('2020-01-02 03:06:58'),
    'c' => '2020-01-02 03:06:58',
    'd' => null,
    'e' => [
        'f' => '2020-01',
        'g' => '2020-01-01',
    ],
    'h' => 'milan',
];
formatDateTimeAssoc($assoc1, ['a', 'b', 'c', 'd', 'e.f', 'e.g'], 'Y-m-d H:i');
dump($assoc1);
// [
//     'a' => '2020-01-02 03:06',
//     'b' => '2020-01-02 03:06',
//     'c' => '2020-01-02 03:06',
//     'd' => null,
//     'e' => [
//         'f' => '2020-01-01 00:00',
//         'g' => '2020-01-01 00:00',
//     ],
//     'h' => 'milan',
// ]

formatDateTimeAssoc($assoc2, ['a', 'b', 'c', 'd'], 'timestamp');
dump($assoc2);
// [
//     'a' => 1577934418,
//     'b' => 1577934418,
//     'c' => 1577934418,
//     'd' => null,
//     'e' => [
//         'f' => '2020-01',
//         'g' => '2020-01-01',
//     ],
//     'h' => 'milan',
// ]
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Testing

``` bash
$ composer test
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security

If you discover any security related issues, please email free3_5man@163.com instead of using the issue tracker.

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
