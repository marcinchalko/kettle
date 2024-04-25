<?php

class Water 
{    
    public bool $isBoiling = false;

    public function __construct(
        public float $waterLevel = 0, 
        public float $waterTemperature = 20.0
    ) {}
}

class Kettle
{
    public function __construct(private Water $water) {}

    public function boilWater(): void
    {
        if ($this->water->isBoiling && $this->water->waterLevel <= 0) {
            throw new Exception('There is no water in the kettle or the water is already boiling.');
        }
        
        $this->water->isBoiling  = true;
        $this->boiling();
    }

    private function boiling(): void
    {
        while ($this->water->isBoiling) {
            if($this->water->waterTemperature >= 100) {
                $this->water->isBoiling = false;
                echo "Steam comes out and the kettle whistles" . PHP_EOL;
            } elseif($this->water->waterLevel <= 0) {
                $this->water->isBoiling = false;
                throw new Exception("There is no water in the kettle.");
            } else {
                $this->increaseTemperature();
            }
        }
    }

    private function increaseTemperature(): void
    {
        $this->water->waterTemperature += 10.0;
        $this->water->waterLevel -= 0.5;
        echo "Current water temperature: {$this->water->waterTemperature}°C" . PHP_EOL;
        echo "Current water level: {$this->water->waterLevel}l" . PHP_EOL;
    }

    public function addWater(float $amount): void
    {
        $this->water->waterLevel += $amount;
        echo "Added {$amount} liters of water to the kettle. Current water level: {$this->water->waterLevel} liters." . PHP_EOL;
    }
}

// water boiled
$kettle = new Kettle(new Water());
$kettle->addWater(4.5);
$kettle->boilWater();

// the water ran out before it boiled
$kettle = new Kettle(new Water());
$kettle->addWater(2.5);
$kettle->boilWater();

