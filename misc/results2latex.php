<?php
$data = <<<'DATA'
p1	75	9	15	69,763	TL	TL	58,944*
p2	75	9	15	67,295	TL	TL	42,117*
p3	75	9	15	47,85*	TL	TL	60,7
p4	75	9	15	52,795*	TL	TL	58,55
p5	75	9	15	50,324*	TL	TL	60,635
p6	75	9	15	68,729	TL	TL	48,358*
p7	75	9	15	30,755*	TL	TL	55
p8	75	9	15	53,189*	TL	TL	68,786
p9	75	9	15	48,655*	TL	TL	52,672
p10	75	9	15	91,471	TL	TL	54,626*
DATA;

$skip = 3;

$data = array_map('trim', explode("\n", trim($data)));
$firstRow = preg_split('/\s+/', $data[0]);
$total = array_fill(0, count($firstRow), 0);
$successes = array_fill(0, count($firstRow), 0);
$nofInstances = count($data);

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
                $successes[$j]++;
                echo '$ \\mathbf{' . number_format(
                    $value,
                    2,
                    '.',
                    ''
                ) . '} $ \unit{\second}';
            } else {
                $value = (float) strtr($row[$j], [',' => '.']);
                $total[$j] += $value;
                $successes[$j]++;
                echo '$ ' . number_format(
                    (float) strtr($row[$j], [',' => '.']),
                    2,
                    '.',
                    ''
                ) . ' $ \unit{\second}';
            }
        } else if (is_numeric($row[$j])) {
            $total[$j] += (int) $row[$j];
            $successes[$j]++;
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
    if ($i <= $skip) {
        echo ' & ';
        continue;
    }
    echo ' & $ ' . number_format(
        $total[$i],
        2,
        '.',
        ''
    ) . ' $ \unit{\second}';
}
echo " \\\\ \n";

echo "\midrule\n";
echo 'Average';
for ($i = 1; $i < count($total); ++$i) {
    if ($i <= $skip) {
        echo ' & ';
        continue;
    }
    echo ' & $ ' . number_format(
        $total[$i] / $nofInstances,
        2,
        '.',
        ''
    ) . ' $ \unit{\second}';
}
echo " \\\\ \n";

echo "\midrule\n";
echo 'Success Rate';
for ($i = 1; $i < count($total); ++$i) {
    if ($i <= $skip) {
        echo ' & ';
        continue;
    }
    echo ' & $ ' . number_format(
        ($successes[$i] / $nofInstances) * 100,
        0,
        '.',
        ''
    ) . '\% $';
}
echo " \\\\ \n";
