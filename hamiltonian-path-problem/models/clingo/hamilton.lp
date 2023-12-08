vertex(0..15).
initialnode(0).
arc(0, 5).
arc(0, 2).
arc(0, 13).
arc(0, 14).
arc(1, 8).
arc(1, 6).
arc(2, 11).
arc(2, 0).
arc(2, 3).
arc(2, 4).
arc(3, 2).
arc(3, 0).
arc(3, 4).
arc(3, 9).
arc(3, 10).
arc(3, 1).
arc(4, 7).
arc(4, 5).
arc(4, 12).
arc(4, 10).
arc(4, 13).
arc(4, 0).
arc(4, 3).
arc(5, 7).
arc(5, 15).
arc(5, 0).
arc(5, 13).
arc(6, 14).
arc(6, 12).
arc(6, 0).
arc(6, 11).
arc(6, 4).
arc(7, 2).
arc(7, 5).
arc(7, 14).
arc(7, 12).
arc(7, 6).
arc(8, 13).
arc(8, 10).
arc(8, 14).
arc(8, 9).
arc(9, 3).
arc(9, 0).
arc(9, 14).
arc(9, 4).
arc(9, 11).
arc(10, 14).
arc(10, 5).
arc(10, 15).
arc(10, 3).
arc(11, 5).
arc(11, 8).
arc(11, 0).
arc(11, 6).
arc(11, 2).
arc(12, 0).
arc(12, 6).
arc(13, 6).
arc(13, 3).
arc(13, 9).
arc(13, 14).
arc(14, 12).
arc(14, 3).
arc(14, 4).
arc(14, 13).
arc(15, 11).
arc(15, 14).
arc(15, 2).
arc(15, 9).
arc(15, 3).

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
