<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\ImporterInterface;

class ImportCustomers extends Command
{
    protected $signature = 'import:customers';
    protected $description = 'Import customers from the third-party API and save them to the database.';
    protected $importer;

    public function __construct(ImporterInterface $importer)
    {
        parent::__construct();
        $this->importer = $importer;
    }

    public function handle()
    {
        $this->importer->importCustomers();
        $this->info('Customers imported successfully.');
    }
}
