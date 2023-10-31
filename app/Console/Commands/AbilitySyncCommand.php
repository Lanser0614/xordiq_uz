<?php

namespace App\Console\Commands;

use App\Enums\Ability\AbilityEnum;
use App\Models\Ability;
use Illuminate\Console\Command;

class AbilitySyncCommand extends Command {
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:ability-sync-command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(): void {
        $abilities = AbilityEnum::getAbilityAsArray();

        $abilitiesArray = [];

        foreach ($abilities as $ability) {
            $abilitiesArray[] = [
                'name' => $ability->value,
            ];
        }

        Ability::query()->upsert($abilitiesArray, 'name');
    }
}
