<?php


return [
  'mapPermissions' => ['c' => 'create', 'r' => 'read', 'u' => 'update', 'd' => 'delete'],
  'rowsPerPage' => [10, 20, 50, 100],
  'locales' => ['en', 'ar'],
  'default_locale' => 'en',
  'experienceRange' => [0, 30],
  'perPage' => 10,
  'limitResults' => 10,
  'limit_delivery_company'  => 5,
  'limit_visitor_time'  => 24 * 60 * 60, //24 hours
  'cache_daily_visitors'  => 4 * 60 * 60,//4 hours
  'cache_monthly_visitors'  => 4 * 60 * 60,//24 hours
];
