<?php
//Christian Johanne Hutahaean
/**
 * @param int $size Ukuran matriks (misalnya, 7 untuk matriks 7x7).
 */
function generatePattern(int $size): void
{
    
    for ($i = 0; $i < $size; $i++) {
        for ($j = 0; $j < $size; $j++) {   
            if ($i == $j || $i + $j == $size - 1) {
             
        echo "X ";
            } else {
          
                echo "O ";
     }
        }
        echo "\n";
    }
}

generatePattern(7);

?>
