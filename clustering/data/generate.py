import math
import sys
import numpy as np

#region INPUT PARAMETERS
problem_name = str(sys.argv[1])
N = int(sys.argv[2]) # Number of objects in set X.
K = int(sys.argv[3]) # Number of blocks (K).
B = int(sys.argv[4]) # Distance constraint (B).
S = int(sys.argv[5]) # Seed for RNG.
R = int(sys.argv[6]) if len(sys.argv) > 6 else 25
print("Number of objects:", N)
print("Number of blocks:", K)
print("Pairs' distance constraint:", B)
print("Seed:", S)
np.random.seed(S)
print("Radius of spheres:", R)
print("+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+")
#endregion

#region HELPERS
def draw_random_normal_int(low:int, high:int):
    normal = np.random.normal(loc=0, scale=1, size=1)
    normal = -3 if normal < -3 else normal
    normal = 3 if normal > 3 else normal
    scaling_factor = (high-low) / 6
    scaled_normal = normal * scaling_factor
    scaled_normal += low + (high-low)/2
    return (np.round(scaled_normal)).astype(int).item()
#endregion

#region GENERATING A PROBLEM
print("Generating a problem... ", end="")
centroids = []
for _ in range(K):
    centroids.append((
        draw_random_normal_int(-R, R),
        draw_random_normal_int(-R, R)
    ))
centroids = list(set(centroids))
K = len(centroids) # Fixes the number of blocks if a position is repeated .

centroid_sizes = [0 for _ in range(len(centroids))]
remaining = N
for i in range(len(centroids) - 1):
    size = math.floor(N / K)
    centroid_sizes[i] = size
    remaining -= size
centroid_sizes[len(centroids) - 1] = remaining

positions = []
for i in range(len(centroids)):
    while centroid_sizes[i] > 0:
        positions.append((
            centroids[i][0] + draw_random_normal_int(-R, R),
            centroids[i][1] + draw_random_normal_int(-R, R)
        ))
        centroid_sizes[i] -= 1
positions = list(set(positions))
N = len(positions) # Fixes if an object's position is repeated.

distances = [[-1 for _ in range(N)] for _ in range(N)]
for i in range(N - 1):
    for j in range(i + 1, N):
        distances[i][j] = abs(positions[i][0]-positions[j][0]) + abs(positions[i][1]-positions[j][1])
print("done.")
print("Number of objects:", N)
print("Number of blocks:", K)
print("+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+")
#endregion

#region SAVING THE PROBLEM AS A PROBLEM FILE
print("Saving the problem as a problem file (see README to check the format)... ", end="")
fp =  open("../models/wmaxsat/" + problem_name + ".in", "w")
fp.write("{0}\n".format(N-1))
for i in range(N - 1):
    for j in range(i + 1, N):
        fp.write("{0} {1} {2}\n".format(i, j, distances[i][j]))
fp.write("{0} {1}\n".format(K, B))
fp.close()
print("done.")
#endregion

#region SAVING THE PROBLEM AS A CLINGO MODEL
print("Saving the problem as a Clingo model... ", end="")
fp =  open("../models/clingo/" + problem_name + ".lp", "w")
fp.write("objects(0..{0}).\n".format(N-1))
for i in range(N - 1):
    for j in range(i + 1, N):
        fp.write("distance({0},{1},{2}).\n".format(i, j, distances[i][j]))
fp.write("1 {")
for i in range(K):
    if i == 0:
        fp.write("in(N,{0})".format(i))
    else:
        fp.write(";in(N,{0})".format(i))
fp.write("} 1 :- objects(N).\n")
fp.write(":- objects(X), objects(Y), in(X, B), in(Y, B), X < Y, distance(X, Y, D), D > {0}.\n".format(B))
fp.close()
print("done.")
#endregion

#region SAVING THE PROBLEM AS A DLV MODEL
print("Saving the problem as a DLV model... ", end="")
fp =  open("../models/dlv/" + problem_name + ".dl", "w")
fp.write("objects(0..{0}).\n".format(N-1))
for i in range(N - 1):
    for j in range(i + 1, N):
        fp.write("distance({0},{1},{2}).\n".format(i, j, distances[i][j]))
for i in range(K):
    if i == 0:
        fp.write("in(N,{0})".format(i))
    else:
        fp.write(" | in(N,{0})".format(i))
fp.write(" :- objects(N).\n")
fp.write(":- objects(X), objects(Y), in(X, B), in(Y, B), X < Y, distance(X, Y, D), D > {0}.\n".format(B))
fp.close()
print("done.")
#endregion
