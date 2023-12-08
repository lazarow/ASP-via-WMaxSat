liczba(1..45).
nr_bloku(1..4).
{blok(L, N) : nr_bloku(N)} = 1 :- liczba(L).
1 {blok(L, N) : liczba(L)} :- nr_bloku(N).
:- nr_bloku(N), blok(L1, N), blok(L2, N), blok(L1 + L2, N).
