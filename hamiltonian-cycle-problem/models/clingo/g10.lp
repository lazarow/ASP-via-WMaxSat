vertex(0..14).
initialnode(0).
arc(0, 7).
arc(0, 2).
arc(0, 1).
arc(0, 6).
arc(0, 3).
arc(0, 4).
arc(0, 10).
arc(1, 13).
arc(1, 8).
arc(1, 7).
arc(1, 4).
arc(1, 9).
arc(1, 10).
arc(2, 12).
arc(2, 4).
arc(2, 7).
arc(2, 10).
arc(2, 6).
arc(2, 5).
arc(2, 3).
arc(2, 9).
arc(3, 6).
arc(3, 7).
arc(3, 4).
arc(3, 11).
arc(3, 8).
arc(3, 5).
arc(3, 13).
arc(4, 2).
arc(4, 7).
arc(4, 13).
arc(4, 14).
arc(4, 9).
arc(4, 3).
arc(5, 7).
arc(5, 1).
arc(5, 0).
arc(5, 11).
arc(5, 14).
arc(5, 3).
arc(5, 4).
arc(5, 12).
arc(5, 2).
arc(6, 7).
arc(6, 5).
arc(6, 3).
arc(7, 9).
arc(7, 0).
arc(7, 4).
arc(7, 11).
arc(7, 5).
arc(7, 10).
arc(7, 1).
arc(8, 6).
arc(8, 7).
arc(8, 4).
arc(8, 5).
arc(8, 12).
arc(8, 11).
arc(8, 10).
arc(8, 2).
arc(8, 0).
arc(9, 2).
arc(9, 10).
arc(9, 6).
arc(9, 0).
arc(10, 6).
arc(10, 3).
arc(10, 0).
arc(10, 4).
arc(10, 8).
arc(10, 2).
arc(11, 7).
arc(11, 0).
arc(11, 5).
arc(11, 3).
arc(12, 11).
arc(12, 0).
arc(12, 10).
arc(12, 1).
arc(12, 2).
arc(12, 5).
arc(12, 14).
arc(13, 2).
arc(13, 3).
arc(13, 5).
arc(13, 7).
arc(14, 11).
arc(14, 4).
arc(14, 7).


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

