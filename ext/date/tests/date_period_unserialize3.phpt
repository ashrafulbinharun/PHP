--TEST--
Test that calling DatePeriod::__unserialize() directly with wrong argument type throws
--FILE--
<?php

$start = new DateTime("2022-07-14 00:00:00", new DateTimeZone("UTC"));
$interval = new DateInterval('P1D');
$end = new DateTime("2022-07-16 00:00:00", new DateTimeZone("UTC"));
$period = new DatePeriod($start, $interval, $end);

try {
    $period->__unserialize(
        [
            "current" => new DateTime("2024-08-27 00:00:00"),
            "start" => new DateTime("2024-08-28 00:00:00"),
            "end" => new DateTime("2024-08-29 00:00:00"),
            "interval" => new DateInterval('P2D'),
            "recurrences" => 2,
            "include_start_date" => "wrong type",
            "include_end_date" => true,
        ]
    );
} catch (\Error $e) {
    echo $e::class, ': ', $e->getMessage(), "\n";
}

var_dump($period);

?>
--EXPECTF--
Error: Invalid serialization data for DatePeriod object
object(DatePeriod)#%d (%d) {
  ["start"]=>
  object(DateTime)#%d (%d) {
    ["date"]=>
    string(26) "2024-08-28 00:00:00.000000"
    ["timezone_type"]=>
    int(3)
    ["timezone"]=>
    string(3) "UTC"
  }
  ["current"]=>
  object(DateTime)#%d (%d) {
    ["date"]=>
    string(26) "2024-08-27 00:00:00.000000"
    ["timezone_type"]=>
    int(3)
    ["timezone"]=>
    string(3) "UTC"
  }
  ["end"]=>
  object(DateTime)#%d (%d) {
    ["date"]=>
    string(26) "2024-08-29 00:00:00.000000"
    ["timezone_type"]=>
    int(3)
    ["timezone"]=>
    string(3) "UTC"
  }
  ["interval"]=>
  object(DateInterval)#%d (%d) {
    ["y"]=>
    int(0)
    ["m"]=>
    int(0)
    ["d"]=>
    int(2)
    ["h"]=>
    int(0)
    ["i"]=>
    int(0)
    ["s"]=>
    int(0)
    ["f"]=>
    float(0)
    ["invert"]=>
    int(0)
    ["days"]=>
    bool(false)
    ["from_string"]=>
    bool(false)
  }
  ["recurrences"]=>
  int(2)
  ["include_start_date"]=>
  bool(true)
  ["include_end_date"]=>
  bool(false)
}
