<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class TestForLogicCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:logic {input*}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test for logic command';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $input = $this->argument('input');
        $output = $this->transformedArray($input);

        $this->newLine();
        $this->info('Input  : [' . implode(', ', $input) . ']');
        $this->newLine();
        $this->info('Output : [' . implode(', ', $output) . ']');
        $this->info('-------------------------------------');
    }

    private function transformedArray(array $inputArray): array
    {
        $total = 0;

        foreach ($inputArray as $key => $value) {
            if ($value == 0) {
                unset($inputArray[$key]);
                $total++;
            }
        }

        for ($i = 1; $i <= $total; $i++) {
            if ($i % 2) {
                array_unshift($inputArray, 0);
            } else {
                $inputArray[] = 0;
            }
        }

        return $inputArray;
    }
}
