<?php

class Rover
{
    public $ordres = '';
    public $ample = 0;
    public $alt = 0;
    public $orientacions = ['N', 'E', 'S', 'W'];

    public $x = 0;     //x inicial
    public $y = 0;
    public $orientacio = '';  
    
    public $estatF = true;

    public function __construct($ordres, $ample, $alt, $x, $y, $orientacio){
        $this->ordres = strtoupper($ordres);
        $this->ample = $ample;
        $this->alt = $alt;
        $this->x = $x;
        $this->y = $y;
        $this->orientacio = strtoupper($orientacio);

        $this->executaOrdres($this->ordres);
        
    }

    public function executaOrdres($ordres)
    {
        $this->estatF = true;
        $peticions = str_split($ordres);
        foreach($peticions as $peticio){
            switch ($peticio) {
                case 'R':
                    //echo "Rebut: {$peticio}, orientacioActual: {$this->orientacio}<br />";
                    $posOrientacioActual = array_search($this->orientacio, $this->orientacions);
                    //echo "posOrientacioActual {$posOrientacioActual}<br />";
                    $posOrientacioActual++;
                    if($posOrientacioActual >= count($this->orientacions) - 1) {
                        $posOrientacioActual = 0;
                    }
                    $this->orientacio = $this->orientacions[$posOrientacioActual];
                    //echo "OrientacioF: {$this->orientacio}<br />";
                    break;
                case 'L':
                    //echo "Rebut: {$peticio}, orientacioActual: {$this->orientacio}<br />";
                    $posOrientacioActual = array_search($this->orientacio, $this->orientacions);
                    //echo "posOrientacioActual {$posOrientacioActual}<br />";
                    $posOrientacioActual--;
                    if($posOrientacioActual < 0) {
                        $posOrientacioActual = count($this->orientacions) - 1;
                    }
                    $this->orientacio = $this->orientacions[$posOrientacioActual];
                    //echo "OrientacioF: {$this->orientacio}<br />";
                    break;
                case 'A':
                    switch ($this->orientacio) {
                        case 'N':
                            $this->y++;
                            break;
                        case 'E':
                            $this->x++;
                            break;
                        case 'S':
                            $this->y--;
                            break;
                        case 'W':
                            $this->x--;
                            break;
                    }   
                    if ($this->x > $this->ample || $this->x < 0 || $this->y > $this->alt  || $this->y < 0 ){
                        $this->estatF = false;     
                    }
                    //echo "x: {$this->x}, y: {$this->y}, estat: {$this->estatF}<br />";              
                    break;
                default:
                    $this->estatF = false;   
            }        

        }
    }
}

?>