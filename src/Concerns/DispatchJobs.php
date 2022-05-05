<?php

namespace Yng\Console\Concerns;

trait DispatchJobs
{
    public function dispatch($command)
    {
        return make($command)->handle();
    }
}
