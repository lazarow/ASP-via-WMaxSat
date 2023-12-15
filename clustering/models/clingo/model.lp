% Data will be added above.

% objects(0..9).
% distance(0, 1, 3).
% blocks(0..3).
% upper_bound(5).

1 { in(N, M): blocks(M) } 1 :- objects(N).
:- objects(X), objects(Y), in(X, B), in(Y, B), X < Y, upper_bound(U), distance(X, Y, D), D > U.
#show in/2.
