<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class TestForRefactorCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:refactor {--distance=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test for refactor code';

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
        $distance = $this->option('distance');
        if (!$distance) {
            $distance = 350;
        }

        $this->info("Duration of each vehicle to reach destination\n");

        $vehicleTypes = ['sport-car', 'truck', 'bike', 'boat'];

        foreach ($vehicleTypes as $key => $vehicleType) {

            switch ($vehicleType) {
                case "sport-car":
                    $transportationType = new SportCar;
                    break;
                case "truck":
                    $transportationType = new Truck;
                    break;
                case "bike":
                    $transportationType = new Bike;
                    break;
                case "boat":
                    $transportationType = new Boat;
                    break;
                default:
                    $transportationType = new Bike;
            }

            $this->info("$vehicleType : " . $transportationType->getDuration($distance));
        }
    }
}

interface TransportationInterface
{
    public function getSpeed();

    public function getDuration($distance);
}

class SportCar implements TransportationInterface
{
    public function getSpeed()
    {
        return 150;
    }

    public function getDuration($distance)
    {
        return $distance / self::getSpeed();
    }
}

class Truck implements TransportationInterface
{
    public function getSpeed()
    {
        return 60;
    }

    public function getDuration($distance)
    {
        return $distance / self::getSpeed();
    }
}

class Bike implements TransportationInterface
{
    public function getSpeed()
    {
        return 100;
    }

    public function getDuration($distance)
    {
        return $distance / self::getSpeed();
    }
}

class Boat implements TransportationInterface
{
    public function getSpeed()
    {
        return 50;
    }

    public function getDuration($distance)
    {
        return ($distance / self::getSpeed()) + 0.25;
    }
}
