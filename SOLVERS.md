# ASP solvers

All solvers were installed on Ubuntu 22.04.3 (WSL) for preparation before running experiments on a computational server.

-   **DLV** (Disjunctive Datalog)  
    Version: build BEN/Dec 17 2012  
    URL: https://www.dlvsystem.it/dlvsite/dlv-download/  
    Comment: The executable file was downloaded directly from the website.
-   **Clingo**  
    Version: 5.6.2  
    URL: https://github.com/potassco/clingo  
    Comment: Built directly from the GitHub's source code (gcc 11.4.0, cmake 3.22.1). On WSL, I needed to add `-DCMAKE_C_COMPILER=\usr\bin\gcc` due to problems with the cygwin's gcc.
-   **Smodels**  
    Version: 2.34  
    URL: http://www.tcs.hut.fi/Software/smodels/  
    Comment: I needed to change the C++ standard to `cpp++98`.
-   **lparse**  
    Version: 1.1.2  
    URL: http://www.tcs.hut.fi/Software/smodels/  
    Comment: I needed to fix `use POSIX` in the `configure` file. See https://github.com/brockgr/csshx/issues/103 for details.  
    I needed to install `bison`.  
    I needed to change the C++ standard to `cpp++98`.  
    I needed to alter the name of the function `runtime_error` (`error.cc`).
    I needed to remove an empty line in `parse.cc` (line 146, I did changes on Windows so maybe it adds some unwelcome characters).
-   **Cmodels**  
    Version: 3.86.1  
    URL: https://www.cs.utexas.edu/users/tag/cmodels/  
    Comment: I needed to change the C++ standard to `cpp++98` and add `-fpermissive` to the g++ command.
-   **ASSAT**  
    Version: _uninstalled_  
    URL: https://web.archive.org/web/20110717180541/http://assat.cs.ust.hk/
