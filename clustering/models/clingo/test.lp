objects(0..2).
distance(0, 1, 3).
distance(0, 2, 3).
distance(1, 2, 5).
blocks(0..1).
upper_bound(4).

1 { in(N, M): blocks(M) } 1 :- objects(N).
:- objects(X), objects(Y), in(X, B), in(Y, B), X < Y, upper_bound(U), distance(X, Y, D), D > U.