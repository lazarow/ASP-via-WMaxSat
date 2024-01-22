<?php
$data = <<<'DATA'
p1	24	58	7	90,056	6,798	TL	6,742*
p2	23	56	7	67,57	25,328	TL	15,259*
p3	23	56	7	60,131	4,656*	TL	6,759
p4	23	56	7	54,76	5,011*	TL	6,409
p5	23	56	7	84,532	40,616	TL	16,198*
p6	23	56	7	54,263	8,296*	TL	9,551
p7	23	56	7	65,532	5,368*	TL	6,51
p8	23	56	7	88,948	16,613	TL	11,262*
p9	23	56	7	75,27	18,115	TL	11,151*
p10	23	56	7	57,639	5,081*	TL	5,41
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
