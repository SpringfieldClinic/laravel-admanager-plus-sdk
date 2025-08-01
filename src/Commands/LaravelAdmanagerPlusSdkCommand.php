<?php

namespace SpringfieldClinic\LaravelAdmanagerPlusSdk\Commands;

use Illuminate\Console\Command;

class LaravelAdmanagerPlusSdkCommand extends Command
{
    public $signature = 'laravel-admanager-plus-sdk';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
