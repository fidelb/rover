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

    public $tauler = array(array());
    public $offset = 3;
    public $fletxes = ['^', '>', 'v', '<'];

    public function __construct($ample, $alt, $x, $y, $orientacio){        
        $this->ample = $ample;
        $this->alt = $alt;
        $this->x = $this->offset + $x;
        $this->y = $this->offset + $y;
        $this->orientacio = strtoupper($orientacio);

        $this->inicialitzaTauler();
        $this->tauler[$this->x][$this->y] = $this->fletxes[array_search($this->orientacio, $this->orientacions)];       
        
    }

    public function executaOrdres($ordres)
    {
        $this->ordres = strtoupper($ordres);
        $this->estatF = true;
        $peticions = str_split($this->ordres);
        foreach($peticions as $peticio){
            switch ($peticio) {
                case 'R':
                    //echo "Rebut: {$peticio}, orientacioActual: {$this->orientacio}<br />";
                    $posOrientacioActual = array_search($this->orientacio, $this->orientacions);
                    //echo "posOrientacioActual {$posOrientacioActual}<br />";
                    $posOrientacioActual++;
                    if($posOrientacioActual >= count($this->orientacions)) {
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
                            $this->x++;
                            break;
                        case 'E':
                            $this->y++;
                            break;
                        case 'S':
                            $this->x--;
                            break;
                        case 'W':
                            $this->y--;
                            break;
                    }   
                    if ($this->x - $this->offset >= $this->ample || $this->x < $this->offset || $this->y - $this->offset >= $this->alt  || $this->y < $this->offset ){
                        $this->estatF = false;     
                    }
                    //echo "x: {$this->x}, y: {$this->y}, estat: {$this->estatF}<br />";
                    //$this->tauler[$this->x][$this->y] = $this->fletxes[array_search($this->orientacio, $this->orientacions)];              
                    $this->tauler[$this->x][$this->y] = $this->fletxes[array_search($this->orientacio, $this->orientacions)];
                    break;
                default:
                    $this->estatF = false;   
            }        

        }
        return [$this->estatF, $this->x - $this->offset, $this->y - $this->offset, $this->orientacio];
    }

    public function inicialitzaTauler(){
        for ($i = 0; $i <= $this->offset + $this->alt -1 + $this->offset; $i++) {
            for ($j = 0; $j <= $this->offset + $this->ample -1 + $this->offset; $j++) {
                $this->tauler[$i][$j] = '.';
            }
        }
        for ($i = $this->offset; $i <= $this->offset + $this->alt - 1; $i++) {
            for ($j = $this->offset; $j <= -1 + $this->offset + $this->ample; $j++) {
                $this->tauler[$i][$j] = '_';
            }
        }
    }

    public function mostraTauler(){
        foreach(array_reverse($this->tauler) as $filera){
            echo "<p style=\"font-family: 'Roboto Mono', monospace\">";
            foreach($filera as $cuadre){
                echo ' '.$cuadre;
            }
            echo "</p>";
        }
    }
}

?>