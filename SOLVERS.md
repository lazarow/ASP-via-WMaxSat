# ASP solvers

All solvers were installed on Ubuntu 22.04.3 (WSL) for preparation before running experiments on a computational server.

-   **DLV** (Disjunctive Datalog)  
    Version: build BEN/Dec 17 2012  
    URL: https://www.dlvsystem.it/dlvsite/dlv-download/  
    Comment: The executable file was downloaded directly from the website.
-   **Clingo**  
    Version: 5.6.2  
    URL: https://github.com/potassco/clingo  
    Comment: Built directly from the GitHub's source code (gcc 11.4.0, cmake 3.22.1) according to the installation instruction. On WSL, I needed to add `-DCMAKE_C_COMPILER=\usr\bin\gcc` due to problems with the cygwin's gcc.
-   **Smodels**  
    Version: 2.34  
    URL: http://www.tcs.hut.fi/Software/smodels/  
    Comment: We needed to change the C++ standard to `c++98`.
-   **lparse**  
    Commend: We used _lparse_ via _DLV_ `dlv --pre=lparse` because the original _lparse_ had problems with handling larger problems.
-   **Cmodels**  
    Version: 3.86.1  
    URL: https://www.cs.utexas.edu/users/tag/cmodels/  
    Comment: We needed to change the C++ standard to `c++98` and add `-fpermissive` to the g++ command.
