# Solving ASP via the Weighted MaxSat solver

The repository consists benchmark data that were used in the experiment, which verifies our new solver for _Answer Set Programming_ (ASP) named **maxmodels**.

We conducted experiments on the following problems:

-   clustering problem,
-   longest path problem,
-   maximum cut problem,
-   maximum edge-weighted clique problem,
-   minimum cover problem,
-   minimum test set problem,
-   precedence constrained scheduling.

Each problem has its own folders that holds benchmark data, models, and necessary descriptions.

We compared our solution with the following solvers:

-   DLV,
-   Clingo,
-   smodels,
-   cmodels (only for decision problems).

Check the [Solvers](#solvers) section for details.

## Solvers

Note that the time limit in command can differ in different problems. In all installations, we made all executables available in `PATH`.

**DLV** (Disjunctive Datalog)  
Version: build BEN/Dec 17 2012  
URL: https://www.dlvsystem.it/dlvsite/dlv-download/  
Comment: The executable file was downloaded directly from the website.
Run command: `time timelimit -t240 dlv --silent=2 p1.dl`

**Clingo**  
Version: 5.6.2  
URL: https://github.com/potassco/clingo  
Comment: Built directly from the GitHub's source code (gcc 11.4.0, cmake 3.22.1) according to the installation instruction. On WSL, I needed to add `-DCMAKE_C_COMPILER=\usr\bin\gcc` due to problems with the cygwin's gcc.
Run command: `time timelimit -t240 clingo -q p1.lp`

**Smodels**  
Version: 2.34  
URL: http://www.tcs.hut.fi/Software/smodels/  
Comment: We needed to change the C++ standard to `--std=c++98`.
Run command (for a decision problem): `time gringo --output=smodels p1.lp | timelimit -t240 smodels 1`  
Run command (for an optimization problem): `time gringo --output=smodels p1.lp | timelimit -t240 smodels 0`

**Cmodels**  
Version: 3.86.1  
URL: https://www.cs.utexas.edu/users/tag/cmodels/  
Comment: We needed to change the C++ standard to `--std=c++98` and add `-fpermissive` to the g++ command.
Run command (only for a decision problem): `time dlv --pre=lparse p1.dl | timelimit -t240 cmodels -out_f_c`

**maxmodels**  
Comment: It requires _dotnet-sdk-8.0_ (or _dotnet-runtime-8.0_) and two MaxSAT solvers downloaded from [here](https://maxsat-evaluations.github.io/2023/descriptions.html), i.e. WMaxCDCL and Open-WBO. Both MaxSAT solvers should be available via PATH as the `wmaxcdcl` and `open-wbo` commands.
Run command: `time timelimit -t240 maxmodels_clustering p1.in`
Note: maxmodels executables use a general problem file as an input, hence they are merged programs consisting a problem reader and a ASP solver.

## Experiments

The experiments were conducted on the machine with the following parameters:

-   Intel(R) Xeon(R) W-2135 CPU @ 3.70GHz,
-   RAM 32GB.
