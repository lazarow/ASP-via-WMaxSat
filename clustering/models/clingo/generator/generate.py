import sys
import math

problem_filepath = str(sys.argv[1])
model_filepath = str(sys.argv[2])

problem_fp = open(problem_filepath, "r")
N = int(problem_fp.readline().rstrip());
print("objects(0.." + str(N-1) + ").")
for _ in range(math.floor(N * (N - 1) / 2)):
    row = problem_fp.readline().rstrip().split(" ")
    print("distance(",row[0],",",row[1],",",row[2],").", sep="")
row = problem_fp.readline().rstrip().split(" ")
print("blocks(0.." + str(int(row[0])-1) + ").")
print("upper_bound(" + row[1] + ").")
problem_fp.close()

model_fp = open(model_filepath, "r")
line = model_fp.readline()
while line:
    line = line.rstrip()
    if line != "" and line.startswith("%") == False:
        print(line)
    line = model_fp.readline()
model_fp.close()
