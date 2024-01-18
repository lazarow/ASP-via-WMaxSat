<?php
$data = <<<'DATA'
p1	69,763	TL	UNKNOWN	58,944*
p2	67,295	TL	UNKNOWN	42,117*
p3	47,85*	TL	UNKNOWN	60,7
p4	52,795*	TL	UNKNOWN	58,55
p5	50,324*	TL	UNKNOWN	60,635
p6	68,729	TL	UNKNOWN	48,358*
p7	30,755*	TL	UNKNOWN	55
p8	53,189*	TL	UNKNOWN	68,786
p9	48,655*	TL	UNKNOWN	52,672
p10	91,471	TL	UNKNOWN	54,626*
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
