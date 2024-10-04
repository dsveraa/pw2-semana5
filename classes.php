<?php

class Package {
    public $hotel;
    public $city;
    public $country;
    public $date;
    public $nights;

    public function __construct($hotel, $city, $country, $date, $nights) {
        $this->hotel = $hotel;
        $this->city = $city;
        $this->country = $country;
        $this->date = $date;
        $this->nights = $nights;
    }

    public function show_info() {
        echo '<div class="my-3">';
        echo '<b>Hotel</b>: ' . $this-> hotel . '<br>';
        echo '<b>Ciudad</b>: ' . $this-> city . '<br>';
        echo '<b>País</b>: ' . $this-> country . '<br>';

        $this->es_date($this->date);
        
        echo '<b>Fecha</b>: ' . $this-> date . '<br>';
        echo '<b>Noches</b>: ' . $this-> nights . '<br>';
        echo '</div>';
    }

    private function es_date() {
        list($year, $month, $day) = explode("-", $this->date);
        $this->date = "$day-$month-$year";
    }
}
