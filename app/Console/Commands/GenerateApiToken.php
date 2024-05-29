<?php

namespace App\Console\Commands;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Console\Command;

class GenerateApiToken extends Command
{
    public function handle()
    {
        $token = Str::random(60);
        DB::table('api_clients')->whereNotnull('api_token')->delete();
        DB::table('api_clients')->insert([
            'api_token' => hash('sha256', $token),
        ]);
        $this->info($token);
        return 0;
    }
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:name';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

}
