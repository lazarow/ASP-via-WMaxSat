import sys
import random
import math

basename = str(sys.argv[1])

N = int(sys.argv[2])
K = int(sys.argv[3])
B = int(sys.argv[4])

min_block_size = int(sys.argv[5]) if len(sys.argv) > 5 else 2

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
random.shuffle(X)
current = 0
for i in range(K):
    for j in range(current, current + block_sizes[i]):
        block_assignments[X[j]] = i
        blocks[i].append(X[j])
    current += block_sizes[i]

# Calculating distances between objects.
for i in range(N - 1):
    for j in range(i + 1, N):
        distances[i][j] = random.randint(1, B)

# Adding some longer distances.
for i in range(K):
    for j in range(K):
        if i != j:
            continue
        for x in blocks[i]:
            for _ in range(max(1, math.floor(len(blocks[j]) * 0.2))):
                y = random.choice(blocks[j])
                if x < y:
                    distances[x][y] = random.randint(B+1, B+2)
                else:
                    distances[y][x] = random.randint(B+1, B+2)

problem_fp =  open(basename + ".in", "w")
problem_fp.write("{0}\n".format(N))
for i in range(N - 1):
    for j in range(i + 1, N):
        problem_fp.write("{0} {1} {2}\n".format(i, j, distances[i][j]))
problem_fp.write("{0} {1}\n".format(K, B))
problem_fp.close()

print("Done.")
