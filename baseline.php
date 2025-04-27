<?php

declare(strict_types=1);

$ignoreErrors = [];
$ignoreErrors[] = [
    'message' => '#^Method DateType\\\\(Immutable|Mutable)Date\\:\\:splitIntervalComponents\\(\\) should return array\\{DateInterval, DateInterval, DateInterval\\} but returns array\\{DateInterval\\|false, DateInterval\\|false, DateInterval\\|false\\}\\.$#',
    'identifier' => 'return.type',
];
$ignoreErrors[] = [
    'message' => '#^Return type \\(DateType\\\\ImmutableDate\\) of method DateType\\\\ImmutableDate\\:\\:modify\\(\\) should be covariant with return type \\(static\\(DateTimeImmutable\\)\\|false\\) of method DateTimeImmutable\\:\\:modify\\(\\)$#',
    'identifier' => 'method.childReturnType',
    'count' => 1,
    'path' => __DIR__ . '/src/ImmutableDate.php',
];
$ignoreErrors[] = [
    'message' => '#^Return type \\(DateType\\\\ImmutableDate\\) of method DateType\\\\ImmutableDate\\:\\:setDate\\(\\) should be covariant with return type \\(static\\(DateTimeImmutable\\)\\|false\\) of method DateTimeImmutable\\:\\:setDate\\(\\)$#',
    'identifier' => 'method.childReturnType',
    'count' => 1,
    'path' => __DIR__ . '/src/ImmutableDate.php',
];
$ignoreErrors[] = [
    'message' => '#^Return type \\(DateType\\\\ImmutableDate\\) of method DateType\\\\ImmutableDate\\:\\:setISODate\\(\\) should be covariant with return type \\(static\\(DateTimeImmutable\\)\\|false\\) of method DateTimeImmutable\\:\\:setISODate\\(\\)$#',
    'identifier' => 'method.childReturnType',
    'count' => 1,
    'path' => __DIR__ . '/src/ImmutableDate.php',
];
$ignoreErrors[] = [
    'message' => '#^Return type \\(DateType\\\\ImmutableDate\\) of method DateType\\\\ImmutableDate\\:\\:setTime\\(\\) should be covariant with return type \\(static\\(DateTimeImmutable\\)\\|false\\) of method DateTimeImmutable\\:\\:setTime\\(\\)$#',
    'identifier' => 'method.childReturnType',
    'count' => 1,
    'path' => __DIR__ . '/src/ImmutableDate.php',
];
$ignoreErrors[] = [
    'message' => '#^Short ternary operator is not allowed\\. Use null coalesce operator if applicable or consider using long ternary\\.$#',
    'identifier' => 'ternary.shortNotAllowed',
];
$ignoreErrors[] = [
    'message' => '#^Unsafe usage of new static\\(\\)\\.$#',
    'identifier' => 'new.static',
];

return ['parameters' => ['ignoreErrors' => $ignoreErrors]];
