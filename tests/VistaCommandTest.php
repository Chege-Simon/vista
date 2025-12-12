<?php

namespace Vista\Tests;

use Orchestra\Testbench\TestCase;

class VistaCommandTest extends TestCase
{
    protected function getPackageProviders($app)
    {
        return [\Vista\Providers\VistaServiceProvider::class];
    }
    
    public function testVistaCommandRuns()
    {
        $this->artisan('vista')
            ->expectsOutput('Vista scheduler started. Checking tasks every 60 seconds...')
            ->assertExitCode(0);
    }
}
