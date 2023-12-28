import random

time = 30
tasks = 60
processors = 8

print(f"time(1..{time}).")
print(f"task(1..{tasks}).")
print(f"processor(1..{processors}).")
all = list(range(1, tasks + 1))
chosen = random.sample(all[:-1], 5*tasks//6)
chosen.sort()
for el1 in chosen:
  j = (tasks) // 10 - random.randint(1, 3)
  taken = random.sample(all[el1+1:], min(j, tasks - el1 - 1))
  for el2 in taken:
    print(f"precedes({el1}, {el2}).")
