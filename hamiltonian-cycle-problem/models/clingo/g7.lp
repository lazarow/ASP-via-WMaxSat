vertex(0..24).
initialnode(0).
arc(0, 15).
arc(0, 4).
arc(0, 23).
arc(1, 5).
arc(1, 21).
arc(1, 19).
arc(1, 8).
arc(1, 12).
arc(2, 8).
arc(2, 13).
arc(2, 6).
arc(2, 24).
arc(2, 5).
arc(2, 0).
arc(2, 15).
arc(3, 0).
arc(3, 14).
arc(3, 6).
arc(3, 18).
arc(3, 1).
arc(4, 23).
arc(4, 21).
arc(4, 7).
arc(4, 16).
arc(4, 22).
arc(4, 9).
arc(4, 20).
arc(4, 18).
arc(5, 16).
arc(5, 9).
arc(5, 0).
arc(5, 23).
arc(5, 21).
arc(5, 20).
arc(5, 12).
arc(5, 6).
arc(5, 8).
arc(5, 11).
arc(5, 19).
arc(5, 24).
arc(6, 22).
arc(6, 14).
arc(6, 9).
arc(6, 5).
arc(6, 21).
arc(6, 0).
arc(7, 23).
arc(7, 20).
arc(7, 19).
arc(7, 4).
arc(7, 18).
arc(7, 13).
arc(7, 12).
arc(8, 7).
arc(8, 16).
arc(8, 18).
arc(8, 22).
arc(8, 10).
arc(8, 15).
arc(8, 4).
arc(8, 1).
arc(9, 23).
arc(9, 20).
arc(9, 1).
arc(10, 17).
arc(10, 16).
arc(10, 19).
arc(10, 1).
arc(10, 20).
arc(10, 15).
arc(10, 5).
arc(11, 0).
arc(11, 1).
arc(11, 21).
arc(11, 7).
arc(11, 9).
arc(11, 16).
arc(11, 6).
arc(12, 23).
arc(12, 8).
arc(12, 14).
arc(12, 24).
arc(12, 11).
arc(12, 6).
arc(13, 20).
arc(13, 2).
arc(13, 15).
arc(13, 21).
arc(13, 11).
arc(13, 17).
arc(13, 6).
arc(14, 24).
arc(14, 20).
arc(14, 23).
arc(14, 12).
arc(14, 15).
arc(14, 13).
arc(14, 11).
arc(14, 21).
arc(14, 9).
arc(15, 13).
arc(16, 24).
arc(16, 20).
arc(16, 19).
arc(17, 8).
arc(18, 19).
arc(18, 7).
arc(18, 1).
arc(18, 14).
arc(18, 8).
arc(19, 12).
arc(19, 21).
arc(19, 1).
arc(19, 9).
arc(19, 24).
arc(19, 16).
arc(20, 6).
arc(20, 18).
arc(20, 19).
arc(20, 8).
arc(20, 11).
arc(21, 11).
arc(21, 10).
arc(21, 17).
arc(21, 5).
arc(21, 1).
arc(21, 20).
arc(21, 8).
arc(21, 13).
arc(22, 15).
arc(22, 20).
arc(22, 8).
arc(22, 17).
arc(23, 6).
arc(23, 18).
arc(23, 8).
arc(23, 10).
arc(23, 5).
arc(23, 12).
arc(23, 22).
arc(23, 17).
arc(24, 6).
arc(24, 8).
arc(24, 16).
arc(24, 10).
arc(24, 2).
arc(24, 13).
arc(24, 18).
arc(24, 1).
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

