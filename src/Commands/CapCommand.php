<?php

namespace Totov\Cap\Commands;

use Illuminate\Console\Command;

class CapCommand extends Command
{
    public $signature = 'laravel-cap-hpi';

    public $description = 'My command';

    public function handle()
    {
        $this->comment('All done');
    }
}
