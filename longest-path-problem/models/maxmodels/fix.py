import sys

print("test")
edges = []
headers = []
with open(sys.argv[1]) as f:
    lines = f.readlines()
    for line in lines:
        if "," in line:
            e = line.split(", ")
            a = f"{e[0]} -> {e[1]} [weight={e[2].rstrip().replace(';', '')}];\n"
            print(a)
            edges.append(a)
        elif len(edges) == 0:
            headers.append(line)


with open(sys.argv[1], "w") as f:
    f.writelines(headers)
    f.writelines(edges)
    f.write("\n}")
    f.close()

print("done")