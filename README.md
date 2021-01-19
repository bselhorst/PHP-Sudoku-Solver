# PHP-Sudoku-Solver
It is a solver for the sudoku problem using PHP

It is probably not the best way to solve this problem, but it is possible to solve it using this code.

Explaining the code is very simple. Some steps are used to solve the Sudoku problem.

First step
Take all unsolved positions and add the array, just add an xy field position. example: 23 (x = 2 and y = 3). Thus, it is easy to consult the position to add a solution or search the column.

Second step
Make an array foreach with unsolved positions.

Third step
Within a foreach, the algorithm will make three checks
  -First (Line check): Algorithm just makes a difference between two matrices, the complete matrix (1 to 9) and the checked matrix (line matrix with line numbers), creating a new matrix with remaining numbers and then , counting the matrix of remaining numbers, if you count == 1, get the number for the position and removing the position from the matrix of positions, if you count> 1, go to the next check.
  -Second (column check): Algorithm just does a search to get the column position and remove it from the matrix of remaining numbers, then counting the matrix of remaining numbers, if count == 1, get the number for the position and remove the position from the position matrix, if count> 1, go to the next check.
  -Last check (matrix check): the algorithm checks the 3x3 matrix and removes all numbers from the array, then counts the array, if count == 1, puts the number in position and removes the position from the position matrix, if you count> 1, go to the next number and leave this position worthless for now

First Image: Clean Sudoku
![alt text](https://github.com/bselhorst/PHP-Sudoku-Solver/blob/main/sudoku1.png)

Second Image: Solved Sudoku after fill the numbers and click to solve sudoku, also it shows the description of solution.
![alt text](https://github.com/bselhorst/PHP-Sudoku-Solver/blob/main/sudoku2.png)
