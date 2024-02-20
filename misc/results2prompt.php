<?php
$data = <<<'DATA'
Clingo	DLV	smodels	maxmodels
90,056	6,798	TL	6,742*
67,57	25,328	TL	15,259*
60,131	4,656*	TL	6,759
54,76	5,011*	TL	6,409
84,532	40,616	TL	16,198*
54,263	8,296*	TL	9,551
65,532	5,368*	TL	6,51
88,948	16,613	TL	11,262*
75,27	18,115	TL	11,151*
57,639	5,081*	TL	5,41
DATA;

$skip = 3;

$data = array_map('trim', explode("\n", trim($data)));
$solvers = preg_split('/\s+/', $data[0]);
$total = array_fill(0, count($solvers), 0);
$successes = array_fill(0, count($solvers), 0);
$nofInstances = count($data) - 1;
$results = array_fill(0, count($solvers), []);

for ($i = 1; $i < count($data); ++$i) {
    $row = preg_split('/\s+/', $data[$i]);
    for ($j = 0; $j < count($row); ++$j) {
        if (is_numeric($row[$j][0]) && strpos($row[$j], ',') !== false) {
            if (strpos($row[$j], '*') !== false) {
                $value = (float) strtr(mb_substr($row[$j], 0, -1), [',' => '.']);
                $total[$j] += $value;
                $successes[$j]++;
                $results[$j][] = number_format($value, 2) . ' s';
            } else {
                $value = (float) strtr($row[$j], [',' => '.']);
                $total[$j] += $value;
                $successes[$j]++;
                $results[$j][] = number_format($value, 2) . ' s';
            }
        } else if (is_numeric($row[$j])) {
            $value = (int) $row[$j];
            $total[$j] += (int) $value;
            $successes[$j]++;
            $results[$j][] = $value . ' s';
        } else if ($row[$j] === 'TL') {
            $total[$j] += 240;
            $results[$j][] = 'TL';
        }
    }  
}

echo "In the conducted experiment, there were " . $nofInstances . " instances of a problem. ";
echo "There were " . count($solvers) . " solvers named " . implode(', ', $solvers) . ". ";
for ($i = 0; $i < count($solvers); $i++) {
    echo $solvers[$i] . " had the following solving times " . implode(', ', $results[$i]) . ", so the total solving time was "
        . number_format($total[$i], 2) . " s and the success rate was " . number_format($successes[$i] / $nofInstances * 100, 0) .  "%. ";
}
echo "TL denotes the time limit, which was 240 s. ";
echo "The success rate denotes how many instances a solver was able to solve within the time limit. ";
echo "Please write a detailed and academic comparison of the solvers based on the obtained results. Please rank up the solvers based on the efficiency.";
