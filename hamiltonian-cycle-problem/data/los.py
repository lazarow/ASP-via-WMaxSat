import pydot
import networkx as nx
import sys


fileName = sys.argv[1]
print(f"writing file {fileName}")

G = nx.gnm_random_graph(400, 3000, directed=True)

footer = \
"""

% According to ASSAT: Computing Answer Sets of A Logic Program 
% By SAT Solvers

% r1
hc(V1, V2) :- arc(V1, V2), not otherroute(V1, V2).

% r2
otherroute(V1, V2) :- arc(V1, V2), arc(V1, V3), hc(V1, V3), V2 != V3.

% r3
otherroute(V1, V2) :- arc(V1, V2), arc(V3, V2), hc(V3, V2), V1 != V3.

% r4
reached(V2) :- arc(V1, V2), hc(V1, V2), reached(V1), not initialnode(V1).

% r5
reached(V2) :- arc(V1, V2), hc(V1, V2), initialnode(V1).

% r6
:- vertex(V), not reached(V).
"""

with open(fileName+".lp", "w") as f:
    print(f"vertex(0..{len(G.nodes)-1}).", file=f)
    print("initialnode(0).", file=f)
    for e1, e2 in G.edges:
        print(f"arc({e1}, {e2}).", file=f)
    print(footer, file=f)
