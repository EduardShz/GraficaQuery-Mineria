<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class TestDatabaseConnections extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:test-database-connections';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $connections = ['sqlsrv'];

        foreach ($connections as $connection) {
            $this->info("Probando conexión a {$connection}...");

            try {
                DB::connection($connection)->getPDO();
                $this->info("✓ Conexión a {$connection} establecida correctamente");
            } catch (\Exception $e) {
                $this->error("✗ Error conectando a {$connection}: " . $e->getMessage());
            }
        }

        return 0;
    }
}
