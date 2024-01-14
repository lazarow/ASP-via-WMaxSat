import pydot
import networkx as nx
import sys
from random import sample, randrange


fileName = sys.argv[1]
print(f"writing file {fileName}")

node_count = 370
edges = set()

nodes_list = [i for i in range(1, node_count)]

from_node = 0

while len(nodes_list) > 0:     
    to_node = sample(nodes_list, k=1)[0]
    edges.add((from_node, to_node))
    from_node = to_node
    nodes_list.remove(to_node) 

edges.add((from_node, 0))

nodes_list = [i for i in range(0, node_count)]

while len(nodes_list) > 0:
    from_node = sample(nodes_list, k=1)[0]
    for _ in range(400):
        to_node = randrange(0, node_count)
        if from_node != to_node:
            edges.add((from_node, to_node))
    nodes_list.remove(from_node)

    
G: nx.DiGraph = nx.DiGraph()
G.add_nodes_from([i for i in range(0, node_count)])
G.add_edges_from(edges)

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
