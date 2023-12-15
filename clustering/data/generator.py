import sys
import random

basename = str(sys.argv[1])

N = int(sys.argv[2])
K = int(sys.argv[3])
B = int(sys.argv[4])

anomaly_probability = float(sys.argv[5]) if len(sys.argv) > 5 else .0

min_block_size = int(sys.argv[6]) if len(sys.argv) > 6 else 2

# Creating distances matrix.
distances = [[-1 for _ in range(N)] for _ in range(N)]

# Calculating block sizes.
block_sizes = [0 for _ in range(K)]
remaining = N
for i in range(K - 1):
    size = random.randint(min_block_size, remaining - (K - i - 1) * min_block_size)
    block_sizes[i] = size
    remaining -= size
block_sizes[K - 1] = remaining

# Creating the X set.
X = [x for x in range(N)]

# Creating blocks' assignments.
blocks = [[] for _ in range(K)]
block_assignments = [-1 for _ in range(N)]
random.shuffle(X);
current = 0
for i in range(K):
    for j in range(current, current + block_sizes[i]):
        block_assignments[X[j]] = i
        blocks[i].append(str(X[j]))
    current += block_sizes[i]

# Calculating distances between objects.
for i in range(N - 1):
    for j in range(i + 1, N):
        anomaly = random.random() < anomaly_probability
        if anomaly or block_assignments[i] == block_assignments[j]:
            distances[i][j] = random.randint(B-2, B)
        else:
            distances[i][j] = random.randint(B + 1, B +3)

problem_fp =  open(basename + ".in", "w")
problem_fp.write("{0}\n".format(N))
for i in range(N - 1):
    for j in range(i + 1, N):
        problem_fp.write("{0} {1} {2}\n".format(i, j, distances[i][j]))
problem_fp.write("{0} {1}\n".format(K, B))
problem_fp.close()

solution_fp = open(basename + ".sol", "w")
for i in range(K):
    solution_fp.write("{0}\n".format(",".join(blocks[i])))
solution_fp.close()

print("Done.")
