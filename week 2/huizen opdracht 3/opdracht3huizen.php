<?php

abstract class Product {
    public $naam;
    public $inkoopprijs;
    public $btw;
    public $omschrijving;

    public function __construct($naam, $inkoopprijs, $btw, $omschrijving) {
        $this->naam = $naam;
        $this->inkoopprijs = $inkoopprijs;
        $this->btw = $btw;
        $this->omschrijving = $omschrijving;
    }

    abstract public function getProductInformatie();
}

class Music extends Product {
    public $artiest;
    public $nummers;

    public function __construct($naam, $inkoopprijs, $btw, $omschrijving, $artiest, $nummers) {
        parent::__construct($naam, $inkoopprijs, $btw, $omschrijving);
        $this->artiest = $artiest;
        $this->nummers = $nummers;
    }

    public function getProductInformatie() {
        $nummersList = "<ul>";
        foreach ($this->nummers as $nummer) {
            $nummersList .= "<li>$nummer</li>";
        }
        $nummersList .= "</ul>";
    
        return "Artiest: " . $this->artiest . "<br> Nummers: " . $nummersList . "Details: " . $this->omschrijving;
    }
    
}

class Film extends Product {
    public $kwaliteit;

    public function __construct($naam, $inkoopprijs, $btw, $omschrijving, $kwaliteit) {
        parent::__construct($naam, $inkoopprijs, $btw, $omschrijving);
        $this->kwaliteit = $kwaliteit;
    }

    public function getProductInformatie() {
        return "Kwaliteit: " . $this->kwaliteit;
    }
}

class Game extends Product {
    public $genre;
    public $minimaleHardware;

    public function __construct($naam, $inkoopprijs, $btw, $omschrijving, $genre, $minimaleHardware) {
        parent::__construct($naam, $inkoopprijs, $btw, $omschrijving);
        $this->genre = $genre;
        $this->minimaleHardware = $minimaleHardware;
    }

    public function getProductInformatie() {
        return "Genre: " . $this->genre . "<br> Minimale hardware eisen: <br> " . $this->minimaleHardware;
    }
}

class ProductList {
    public $producten = [];

    public function voegProductToe($product) {
        $this->producten[] = $product;
    }

    public function toonProducten() {
        echo "<table border='1'>";
        echo "<tr><th>Naam van product</th><th>Categorie</th><th>Verkoopprijs</th><th>Informatie over het product</th></tr>";
        foreach ($this->producten as $product) {
            $verkoopprijs = $product->inkoopprijs * (1 + $product->btw) * 1.2; 
            echo "<tr>";
            echo "<td>" . $product->naam . "</td>";
            echo "<td>" . $this->getCategorie($product) . "</td>";
            echo "<td>" . $verkoopprijs . "</td>";
            echo "<td>" . $product->getProductInformatie() . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    }

    private function getCategorie($product) {
        $className = get_class($product);
        $categories = [
            'Music' => 'Music',
            'Film' => 'Film',
            'Game' => 'Game'
        ];
    
        return $categories[$className];
    }
    
}

// Voorbeeld van gebruik:
$productList = new ProductList();
$productList->voegProductToe(new Music("Principes", 20, 0.21, "2020 Lijpemusic", "Fatah", ["Wie tegen mij is", "Dans la vide"]));
$productList->voegProductToe(new Music("Madvillany", 20, 0.21, "Stones Throw Records", "Madvillan", ["The Illest Villians", "Accordion"]));
$productList->voegProductToe(new Film("Free Guy", 15.0, 0.21, "20th Century Studios", "4k"));
$productList->voegProductToe(new Film("Dilwale", 15.0, 0.21, "Red Chillies Entertainment", "HD"));
$productList->voegProductToe(new Game("Dragon Ball Fighterz", 10, 0.21, "Bandai Namco Entertainment", "2D Fighter", "4 GB RAM, AMD FX-4350"));
$productList->voegProductToe(new Game("Ghostrunner", 20, 0.21, "Exciting game", "Action", "8 GB RAM, Core i5-4590"));


$productList->toonProducten();
?>