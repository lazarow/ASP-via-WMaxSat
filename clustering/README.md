# Clustering

The directory contains the benchmark data for the Clustering problem. It contains the python script that generates random problem
instances (see the procedure described below).

The configurations that were used for generating benchmark alongside with the results are described in `clustering_results.ods` (the LibreOffice Calc format).

## Usage

1. Go to the folder `data`.
2. Run `python generate.py PROBLEM_NAME N K B S` (requires `numpy`).
3. The generation script creates:
    - a problem file (see the below format description) in the WMaxSAT folder;
    - Clingo and DLV models in the models folder.

## Generating procedure

1. Find `K` circles centroids started from the point `(0,0)`. Point coordinates are drawn from normally distributed integers
   ranged from `[-R,R]` (see `generated.py` for details). The default value of `R` is `25`.
2. Remove duplicated centroids (possibly reduces `K`).
3. Started from each centroid position, generate `N / K` points, which positions are drawn from normally distributed integers
   ranged from `[-R,R]`.
4. Remove duplicated points (possibly reduces `N`).
5. Calculate distances between points based on Manhattan Distance.

## Problem file format

Problem files are described in the following format:

```
N
x1 x2 d1
x1 y3 d2
...
K B
```

N is the number of objects in the set X.
Each object is identified by a number started from 0 to N-1.

The number of pairs is equal to N \* (N - 1) / 2.
Each pair's distance are denoted as: `xi xj distance`, where
xi and xj are identifiers of objects in X, and xi < xj.

K is the number of clusters.
B is the upper bound (inclusive) for each pair in clusters.

Example:

```
3
0 1 4
0 2 4
1 2 6
2 5
```

The answer is yes, because:
`{0, 1}, {2}`
or
`{0, 2}, {1}`
