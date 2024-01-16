vertex(0..24).
initialnode(0).
arc(0, 16).
arc(0, 13).
arc(1, 9).
arc(1, 3).
arc(2, 9).
arc(2, 1).
arc(2, 6).
arc(2, 0).
arc(3, 20).
arc(3, 14).
arc(3, 15).
arc(3, 7).
arc(3, 4).
arc(4, 7).
arc(4, 23).
arc(5, 3).
arc(5, 8).
arc(5, 6).
arc(5, 18).
arc(6, 0).
arc(6, 24).
arc(6, 3).
arc(6, 13).
arc(6, 12).
arc(6, 11).
arc(7, 4).
arc(7, 24).
arc(7, 3).
arc(7, 23).
arc(7, 11).
arc(8, 6).
arc(8, 3).
arc(8, 23).
arc(8, 18).
arc(8, 22).
arc(9, 16).
arc(9, 19).
arc(9, 14).
arc(9, 1).
arc(9, 4).
arc(9, 5).
arc(10, 23).
arc(10, 19).
arc(11, 10).
arc(11, 22).
arc(11, 23).
arc(12, 7).
arc(12, 11).
arc(12, 9).
arc(12, 2).
arc(12, 16).
arc(12, 17).
arc(13, 10).
arc(13, 11).
arc(13, 14).
arc(13, 4).
arc(13, 20).
arc(14, 8).
arc(14, 17).
arc(14, 15).
arc(15, 20).
arc(15, 0).
arc(15, 16).
arc(15, 3).
arc(16, 11).
arc(16, 6).
arc(16, 0).
arc(16, 15).
arc(17, 19).
arc(17, 16).
arc(17, 7).
arc(18, 23).
arc(18, 1).
arc(18, 9).
arc(18, 8).
arc(19, 9).
arc(19, 1).
arc(19, 24).
arc(20, 9).
arc(20, 4).
arc(20, 17).
arc(20, 7).
arc(20, 15).
arc(20, 13).
arc(21, 15).
arc(21, 16).
arc(21, 2).
arc(22, 7).
arc(22, 9).
arc(22, 13).
arc(22, 14).
arc(22, 15).
arc(22, 1).
arc(22, 8).
arc(23, 4).
arc(23, 17).
arc(23, 16).
arc(23, 24).
arc(24, 0).
arc(24, 23).


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

