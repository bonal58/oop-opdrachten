<?php

class Room {
    private $length;
    private $width;
    private $height;

    public function __construct($length, $width, $height) {
        $this->length = $length;
        $this->width = $width;
        $this->height = $height;
    }

    public function calculateVolume() {
        return $this->length * $this->width * $this->height;
    }
}

class House {
    private $floors;
    private $rooms = [];

    public function __construct($floors) {
        $this->floors = $floors;
    }

    public function addRoom(Room $room) {
        $this->rooms[] = $room;
    }

    public function calculateTotalVolume() {
        $totalVolume = 0;
        foreach ($this->rooms as $room) {
            $totalVolume += $room->calculateVolume();
        }
        return $totalVolume;
    }

    public function calculatePrice() {
        $pricePerCubicMeter = 1000;
        return $this->calculateTotalVolume() * $pricePerCubicMeter;
    }

    public function printDetails() {
        echo "Aantal verdiepingen: " . $this->floors . "<br>";
        echo "Aantal kamers: " . count($this->rooms) . "<br>";
        echo "Prijs: €" . $this->calculatePrice() . "<br><br>";
    }
}

// Maak kamers aan en voeg ze toe aan huizen
$room1 = new Room(5, 4, 3);
$room2 = new Room(6, 4, 3);
$room3 = new Room(4, 3, 3);

$house1 = new House(2);
$house1->addRoom($room1);
$house1->addRoom($room2);
$house1->addRoom($room3);

$room4 = new Room(8, 6, 3);
$room5 = new Room(7, 5, 3);

$house2 = new House(1);
$house2->addRoom($room4);
$house2->addRoom($room5);

$room6 = new Room(10, 8, 4);
$room7 = new Room(12, 9, 3);
$room8 = new Room(6, 5, 3);

$house3 = new House(3);
$house3->addRoom($room6);
$house3->addRoom($room7);
$house3->addRoom($room8);

// Print details van de huizen
$house1->printDetails();
$house2->printDetails();
$house3->printDetails();

?>
