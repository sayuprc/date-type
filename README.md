# sayuprc/date-type

A library for handling result types in PHP.

## Requirements

|name|version|
|---|---|
|PHP|^8.4|

## Installation

```bash
composer require sayuprc/date-type
```

## Usage

```php
<?php

use DateType\DateImmutable;

// A date is generated with the time in the state 00:00:00.000000
$date = new DateImmutable();
```
