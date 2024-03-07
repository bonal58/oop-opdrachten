<?php
abstract class Person {
    private $name;
    private $eyeColor;
    private $hairColor;
    private $height;
    private $weight;

    public function __construct($name, $eyeColor, $hairColor, $height, $weight) {
        $this->name = $name;
        $this->eyeColor = $eyeColor;
        $this->hairColor = $hairColor;
        $this->height = $height;
        $this->weight = $weight;
    }

    public function getName() {
        return $this->name;
    }

    public function getEyeColor() {
        return $this->eyeColor;
    }

    public function getHairColor() {
        return $this->hairColor;
    }

    public function getHeight() {
        return $this->height;
    }

    public function getWeight() {
        return $this->weight;
    }

    abstract public function determineRole();
}

class Patient extends Person {
    public function determineRole() {
        return "Patient";
    }
}

abstract class Staff extends Person {
    abstract public function calculateSalary($hoursWorked);
}

class Doctor extends Staff {
    private $hourlyRate;

    public function __construct($name, $eyeColor, $hairColor, $height, $weight, $hourlyRate) {
        parent::__construct($name, $eyeColor, $hairColor, $height, $weight);
        $this->hourlyRate = $hourlyRate;
    }

    public function calculateSalary($hoursWorked) {
        return $hoursWorked * $this->hourlyRate;
    }

    public function determineRole() {
        return "Doctor";
    }
}


class Nurse extends Staff {
    private $weeklySalary;

    public function __construct($name, $eyeColor, $hairColor, $height, $weight, $weeklySalary) {
        parent::__construct($name, $eyeColor, $hairColor, $height, $weight);
        $this->weeklySalary = $weeklySalary;
    }

    public function calculateSalary($hoursWorked) {
        // Hier wordt alleen de bonus van afspraken toegevoegd, het vaste salaris wordt niet berekend
        return $hoursWorked * $this->getHourlyRate();
    }

    public function getHourlyRate() {
        return $this->weeklySalary / 40; // Aannemend dat een werkweek 40 uur is
    }

    public function determineRole() {
        return "Nurse";
    }
}

class Appointment {
    private $doctor;
    private $patient;
    private $nurse;
    private $startTime;
    private $endTime;

    public function __construct($doctor, $patient, $startTime, $endTime, $nurse = null) {
        $this->doctor = $doctor;
        $this->patient = $patient;
        $this->nurse = $nurse;
        $this->startTime = $startTime;
        $this->endTime = $endTime;
    }

    public static function calculateDuration($startTime, $endTime) {
        // Bereken de duur van de afspraak in uren
        $duration = $endTime->diff($startTime)->h;
        return $duration;
    }

    public function calculateCost() {
        $duration = self::calculateDuration($this->startTime, $this->endTime);
        $doctorSalary = $this->doctor->calculateSalary($duration);
        $nurseBonus = 0;
        if ($this->nurse) {
            $nurseBonus = $this->nurse->calculateSalary($duration);
        }
        return array($doctorSalary, $nurseBonus);
    }
}

// Testen
$doctor = new Doctor("Dr. Smith", "Brown", "Black", 180, 75, 50);
$patient = new Patient("John Doe", "Blue", "Blond", 175, 70);
$nurse = new Nurse("Nurse Jane", "Green", "Red", 165, 60, 1000);

$startTime = new DateTime("2024-03-07 09:00:00");
$endTime = new DateTime("2024-03-07 11:00:00");

$appointment = new Appointment($doctor, $patient, $startTime, $endTime, $nurse);
$cost = $appointment->calculateCost();

echo "Doctor's salary: $" . $cost[0] . "\n";
echo "Nurse's bonus: $" . $cost[1] . "\n";
?>