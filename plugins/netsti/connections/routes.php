<?php

use NetSTI\Connections\Models\Calendar;

// DEV
Route::group(['prefix' => 'api'], function () {
Route::get('calendar/{id}/calendar.ics', function ($id) {

$calendar = Calendar::find($id);
$time_zone = date_default_timezone_get();

if($calendar){

echo "
BEGIN:VCALENDAR\n
METHOD:PUBLISH\n
VERSION:2.0\n
X-WR-CALNAME:$calendar->name\n
PRODID:-//Apple Inc.//Mac OS X 10.11.3//EN\n
X-APPLE-CALENDAR-COLOR:$calendar->color\n
X-WR-TIMEZONE:$time_zone\n
CALSCALE:GREGORIAN\n
BEGIN:VTIMEZONE\n
TZID:$time_zone\n
END:VTIMEZONE\n";

foreach ($calendar->events as $event) {
$uid = uniqid();
$auid = uniqid();
$start = date('Ymd\THis', strtotime($event->start_date));
$end = date('Ymd\THis', strtotime($event->end_date));

echo "
BEGIN:VEVENT\n
TRANSP:TRANSPARENT\n
DTEND;TZID=$time_zone:$end\n
UID:$uid\n
DTSTAMP:$start\n
LOCATION:$event->address\n
DESCRIPTION:$event->summary\n
STATUS:CONFIRMED\n
SEQUENCE:0\n
X-APPLE-TRAVEL-ADVISORY-BEHAVIOR:AUTOMATIC\n
SUMMARY:$event->name\n
DTSTART;TZID=$time_zone:$start\n
BEGIN:VALARM\n
X-WR-ALARMUID:$auid\n
UID:$auid\n
TRIGGER:-PT30M\n
DESCRIPTION:$event->summary\n
ACTION:DISPLAY\n
END:VALARM\n
END:VEVENT\n";
}

echo "END:VCALENDAR\n";
}
});
});
?>