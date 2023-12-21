# CLUSTERING PROBLEM GENERATING

1. Go to the folder `clustering`.
2. Run `python generate.py PROBLEM_NAME N K B S` (requires `numpy`).
3. The generation script creates:
    - a problem file (see the below format description) in the data folder;
    - all ASP models (Clingo, DLV, smodels, cmodels) in the models folder.

## PROBLEM FORMAT

Problem files are described in the following format:
N
x1 x2 d1
x1 y3 d2
...
K B

N is the number of objects in the set X.
Each object is identified by a number started from 0 to N-1.

The number of pairs is equal to N * (N - 1) / 2.
Each pair's distance are denoted as: `xi xj distance`, where
xi and xj are identifiers of objects in X, and xi < xj.

K is the number of clusters.
B is the upper bound (inclusive) for each pair in clusters.

Example:
3
0 1 4
0 2 4
1 2 6
2 5

The answer is yes, because:
{0, 1}, {2}
or
{0, 2}, {1}
