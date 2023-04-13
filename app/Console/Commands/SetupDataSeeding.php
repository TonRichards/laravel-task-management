<?php

namespace App\Console\Commands;

use App\Models\Status;
use App\Models\Type;
use Illuminate\Console\Command;

class SetupDataSeeding extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'setup:data-seeding';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Setup: seeding the necessary data';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info("Started seeding data");

        $this->seedingStatuses();
        $this->seedingTypes();

        $this->info("Finished seeding data");
    }

    private function seedingStatuses()
    {
        $statuses = config('data-seeding.statuses.data');

        foreach ($statuses as $status) {
            Status::updateOrCreate([
                'name' => $status['name'],
            ],[
                'name' => $status['name'],
                'display_name' => $status['display_name'],
            ]);
        };
    }

    private function seedingTypes()
    {
        $types = config('data-seeding.types.data');

        foreach ($types as $type) {
            Type::updateOrCreate([
                'name' => $type['name'],
                'scope' => $type['scope']
            ],[
                'name' => $type['name'],
                'scope' => $type['scope'],
                'display_name' =>$type['display_name']
            ]);
        };
    }
}
