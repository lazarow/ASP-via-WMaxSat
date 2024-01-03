<?php
$data = <<<'DATA'
p1	90,056	6,798	TL	6,742*
p2	67,57	25,328	TL	15,259*
p3	60,131	4,656*	TL	6,759
p4	54,76	5,011*	TL	6,409
p5	84,532	40,616	TL	16,198*
p6	54,263	8,296*	TL	9,551
p7	65,532	5,368*	TL	6,51
p8	88,948	16,613	TL	11,262*
p9	75,27	18,115	TL	11,151*
p10	57,639	5,081*	TL	5,41
DATA;

$data = array_map('trim', explode("\n", trim($data)));

for ($i = 0; $i < count($data); ++$i) {
    $row = preg_split('/\s+/', $data[$i]);
    for ($j = 0; $j < count($row); ++$j) {
        if ($j > 0) {
            echo ' & ';
        }
        if (is_numeric($row[$j][0]) && strpos($row[$j], ',') !== false) {
            if (strpos($row[$j], '*') !== false) {
                echo '$ \\mathbf{' . number_format(
                    (float) strtr(mb_substr($row[$j], 0, -1), [',' => '.']),
                    2,
                    '.',
                    ''
                ) . '} $ s';
            } else {
                echo '$ ' . number_format(
                    (float) strtr($row[$j], [',' => '.']),
                    2,
                    '.',
                    ''
                ) . ' $ s';
            }
        } else if (is_numeric($row[$j])) {
            echo '$ ' . ((int) $row[$j]) . ' $';
        } else if ($row[$j] === 'Tak') {
            echo 'Yes';
        } else if ($row[$j] === 'Nie') {
            echo 'No';
        } else {
            echo $row[$j];
        }
    }
    echo " \\\\ \n";    
}
