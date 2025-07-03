<?php

/**
 * Fungsi untuk menghasilkan pola 'X' dan 'O' pada matriks NxN.
 * Pola 'X' terbentuk di diagonal utama dan diagonal sekunder.
 *
 * @param int $size Ukuran matriks (misalnya, 7 untuk matriks 7x7).
 */
function generatePattern(int $size): void
{
    
    for ($i = 0; $i < $size; $i++) {
        // Loop melalui setiap kolom
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
