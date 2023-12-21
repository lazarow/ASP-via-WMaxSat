import random

fileName = "p2"
s = 50
m = 70
universum = list(range(s))
collection = []
for i in range(m):
    collection.append(random.sample(universum, random.randint(6, 11)))

with open(fileName+".in", "w") as f:
    print(f"universum: {s}", file=f)
    print("collection:", file=f)
    for i in range(m):
        print(f"- [{collection[i][0]}", end="", file=f)
        for j in range(1, len(collection[i])):
            print(f", {collection[i][j]}", end="", file=f)
        print("]", file=f)

with open(fileName+".lp", "w") as f:
    print(f"s(0..{s-1}).", file=f)
    for i in range(m):
        for j in collection[i]:
            print(f"c({i}, {j}).", file=f)
    print("1 {in(X) : c(X, N)}.", file=f)
    print(":- s(N), {in(X) : c(X, N)} = 0.", file=f)
    print("#minimize {1, X : in(X)}.", file=f)
