<?php

use Illuminate\Support\Facades\Schedule;

Schedule::command('app:verification-account-user')->everyMinute();
