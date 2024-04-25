<?php

class Kettle
{
    private bool $isBoiling = false;
    private float $waterTemperature = 20.0;
    private float $waterLevel = 0;

    public function boilWater(): void
    {
        if (!$this->isBoiling && $this->waterLevel > 0) {
            $this->isBoiling = true;
            while ($this->isBoiling) {
                if($this->waterTemperature >= 100) {
                    $this->isBoiling = false;
                	echo "Steam comes out and the kettle whistles" . PHP_EOL;
                } elseif($this->waterLevel <= 0) {
                    $this->isBoiling = false;
                	throw new Exception("There is no water in the kettle.");
                } else {
                	$this->increaseTemperature();
                }
            }
        } else {
            echo "There is no water in the kettle or the water is already boiling." . PHP_EOL;
        }
    }

    private function increaseTemperature(): void
    {
        $this->waterTemperature += 10.0;
        $this->waterLevel -= 0.5;
        echo "Current water temperature: {$this->waterTemperature}°C" . PHP_EOL;
        echo "Current water level: {$this->waterLevel}l" . PHP_EOL;
    }

    public function addWater(float $amount): void
    {
        $this->waterLevel += $amount;
        echo "Added {$amount} liters of water to the kettle. Current water level: {$this->waterLevel} liters." . PHP_EOL;
    }
}

// water boiled
$kettle = new Kettle();
$kettle->addWater(4.5);
$kettle->boilWater();

// the water ran out before it boiled
$kettle = new Kettle();
$kettle->addWater(2.5);
$kettle->boilWater();

