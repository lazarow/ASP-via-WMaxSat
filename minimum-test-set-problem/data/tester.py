import subprocess

for i in range(2, 11):
    while True:        
        subprocess.run(["python3", "generate.py"])
        status = subprocess.run(["timeout", "120", "clingo", f"p{i}.lp"])        
        if status.returncode == 0:
            print(f"found problem, file is p{i}.lp")
            break
        print(f"status code is {status.returncode}, repeating")
