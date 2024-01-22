<?php
$data = <<<'DATA'
p1	60	1500	731	25,469	TL	6,114*	43,101
p2	50	1000	454	2,904	TL	1,024*	8,689
p3	40	700	737	0,146	5,492	0,168*	0,704
p4	40	600	297	0,215	6,423	0,17*	1,874
p5	75	2000	354	97,145	TL	9,154*	75,854
p6	80	2200	397	44,584	TL	10,335*	72,938
p7	80	2100	289	38,46	TL	9,708*	42,465
p8	90	2100	178	13,403	TL	6,146*	26,596
p9	75	2000	331	95,404	TL	8,984*	78,422
p10	80	2000	252	30,106	TL	7,416*	46,408
DATA;

$data = array_map('trim', explode("\n", trim($data)));
$firstRow = preg_split('/\s+/', $data[0]);
$total = array_fill(0, count($firstRow), 0);

for ($i = 0; $i < count($data); ++$i) {
    $row = preg_split('/\s+/', $data[$i]);
    for ($j = 0; $j < count($row); ++$j) {
        if ($j > 0) {
            echo ' & ';
        }
        if (is_numeric($row[$j][0]) && strpos($row[$j], ',') !== false) {
            if (strpos($row[$j], '*') !== false) {
                $value = (float) strtr(mb_substr($row[$j], 0, -1), [',' => '.']);
                $total[$j] += $value;
                echo '$ \\mathbf{' . number_format(
                    $value,
                    2,
                    '.',
                    ''
                ) . '} $ \unit{\second}';
            } else {
                $value = (float) strtr($row[$j], [',' => '.']);
                $total[$j] += $value;
                echo '$ ' . number_format(
                    (float) strtr($row[$j], [',' => '.']),
                    2,
                    '.',
                    ''
                ) . ' $ \unit{\second}';
            }
        } else if (is_numeric($row[$j])) {
            $total[$j] += (int) $row[$j];
            echo '$ ' . ((int) $row[$j]) . ' $';
        } else if ($row[$j] === 'Tak') {
            echo 'Yes';
        } else if ($row[$j] === 'Nie') {
            echo 'No';
        } else if ($row[$j] === 'TL') {
            $total[$j] += 240;
            echo $row[$j];
        } else {
            echo $row[$j];
        }
    }
    echo " \\\\ \n";    
}

echo "\midrule\n";
echo 'Total';
for ($i = 1; $i < count($total); ++$i) {
    echo ' & $ ' . number_format(
        $total[$i],
        2,
        '.',
        ''
    ) . ' $ \unit{\second}';
}
echo " \\\\ \n";
