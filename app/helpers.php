<?php

function dds($info)
{
    $trace = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 2);
    $caller = $trace[1];
    dump('Called from ' . $caller['file'] . ' line ' . $caller['line']);
    // dd($info);
}
