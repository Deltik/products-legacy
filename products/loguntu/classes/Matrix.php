<?php
/**
 * Loguntu
 *  Classes
 *   Third-Party
 *    "Class That Contains Matrix Operations"
 *     By: Diego Carrera & Kleber Baño
 *      Translated and Optimized By: Nick Liu <webmaster@deltik.org>
 */

#### CONTENTS ####
# Class Variables   - "Matrix Variable Declarations"
# Class Constructor - "Matrix Class Constructor"
# Access Functions  - "Getters & Setters"
# Verifications     - "Matrix Checkers"
# Basic Operations  - "Basic Matrix Operations"
# Advanced Features - "Advanced Matrix Operations"
##################

class Matrix
  {
  /**
   * ################################
   * # Matrix Variable Declarations #
   * ################################
   */
  // Global Variables
  public $rows;
  public $columns;
  public $matrix = array();
  // So-called "Advanced" Global Variables
  public $average;
  public $covariance;
  
  /**
   * ############################
   * # Matrix Class Constructor #
   * ############################
   */
  public function Matrix($array = null)
    {
    if ($array == null)
      return true;
    $this->setMatrix($array);
    if (!$this->setDimensions())
      return false;
    return true;
    }
  
  /**
   * ################################
   * # Matrix Variable Declarations #
   * ################################
   */
  
  /**
   * Really Basic Setters
   */
  // Set Number of Rows
  public function setRows() { $this->rows = count($this->matrix); }
  // Set Number of Columns
  public function setColumns() { $this->columns = count($this->matrix[0]); }
  
  /**
   * Really Basic Getters
   */
  // Get Number of Rows
  public function getRows() { return $this->rows; }
  // Get Number of Columns
  public function getColumns() { return $this->columns; }
  // Get Average
  public function getAverage($array) { $this->average = $this->average($array); return $this->average; }
  // Get Covariance
  public function getCovariance($array) { $this->covariance = $this->covariance($array); return $this->covariance; }
  // Get Number of Rows from Array
  public function getRowsArray($array) { return count($array); }
  // Get Number of Columns from Array
  public function getColumnsArray($array) { return count($array[0]); }
  
  /**
   * Set Matrix Data (called by constructor)
   * @param array $array The array to be converted into a matrix object
   */
  private function setMatrix($array)
    {
    foreach ($array as $x => $array_rows)
      {
      foreach ($array_rows as $y => $array_cell)
        {
        $this->matrix[$x][$y] = $array_cell;
        }
      }
    }
  
  /**
   * Set the Dimensions of the Matrix
   * @param null
   * @returns bool Whether the configuration was successful
   */
  private function setDimensions()
    {
    $this->rows    = count($this->matrix);
    $this->columns = count($this->matrix[0]);
    if ($this->checkDimensionsGiven($this->rows, $this->columns))
      return true;
    $this->rows    = null;
    $this->columns = null;
    return false;
    }
  
  /**
   * ###################
   * # Matrix Checkers #
   * ###################
   */
  
  /**
   * Check If the Dimensions of Two Matrices Are Equal
   * @param matrix $a First matrix to compare
   * @param matrix $b Other matrix to compare
   * @returns bool Whether the dimensions for the matrix objects are the same
   */
  public function checkDimensions($a, $b)
    {
    if ($a->rows == $b->rows && $a->columns == $b->columns)
      return true;
    return false;
    }
  
  /**
   * Check If Square Matrix
   * @returns bool Whether this matrix object is a square in dimensions
   */
  public function checkSquare()
    {
    if ($this->rows == $this->columns)
      return true;
    return false;
    }
  
  /**
   * Check That This Matrix Has the Same Dimensions as Specified
   * @param int $x Desired number of rows
   * @param int $y Desired number of columns
   * @returns bool Whether the matrix object matched dimensions
   */
  public function checkDimensionsGiven($x, $y)
    {
    for ($i = 0; $i < $x; $i ++)
      {
      if ($y != count($this->matrix[$i]))
        return false;
      }
    return true;
    }
  
  /**
   * Check That the Number of Columns Is the Same in Each Row, Given an Array
   * @param array $array The array to check
   * @param int $x Desired number of rows
   * @param int $y Desired number of columns
   */
  public function checkDimensionsGivenArray($array, $x, $y)
    {
    for ($i = 0; $i < $x; $i ++)
      {
      if ($y != count($array[$x]))
        return false;
      }
    return true;
    }
  
  /**
   * ###########################
   * # Basic Matrix Operations #
   * ###########################
   */
  
  /**
   * Subtract Two Matrices
   * @requires Matrices of the same dimension
   * @param array $a Minuend matrix
   * @param array $b Subtrahend matrix
   * @returns array Difference matrix
   */
  public function subtract($a, $b)
    {
    foreach ($a as $x => $a_row)
      {
      foreach ($a[0] as $y => $a_cell)
        {
        $final[$x][$y] = $a[$x][$y] - $b[$x][$y];
        }
      }
    return $final;
    }
  // Alias for "Subtract Two Matrices"
  public function difference($a, $b) { return $this->subtract($a, $b); }
  public function minus($a, $b) { return $this->subtract($a, $b); }
  
  /**
   * Add Two Matrices
   * @requires Matrices of the same dimension
   * @param array $a First addend matrix
   * @param array $b Other addend matrix
   * @returns array Sum matrix
   */
  public function add($a, $b)
    {
    foreach ($a as $x => $a_row)
      {
      foreach ($a[0] as $y => $a_cell)
        {
        $final[$x][$y] = $a[$x][$y] + $b[$x][$y];
        }
      }
    return $final;
    }
  // Alias for "Add Two Matrices"
  public function sum($a, $b) { return $this->add($a, $b); }
  public function plus($a, $b) { return $this->add($a, $b); }
  
  /**
   * Multiply Two Matrices
   * @requires Number of columns in $a is equal to number of rows in $b
   * @param array $a Multiplicand matrix
   * @param array $b Multiplier matrix
   * @returns array Product matrix
   */
  public function multiply($a, $b)
    {
    // Multiplying Scalar Compatibility
    if (is_numeric($b)) return $this->divide($a, 1/$b);
    
    // Normal Two-Matrices Multiplication
    foreach ($a as $x => $a_row)
      {
      foreach ($b[0] as $y => $b_cell_cruft)
        {
        foreach ($a[0] as $z => $a_cell_cruft)
          {
          $final[$x][$y] = $final[$x][$y] + $a[$x][$z] * $b[$z][$y];
          }
        }
      }
    return $final;
    }
  // Alias for "Multiply Two Matrices"
  public function product($a, $b) { return $this->multiply($a, $b); }
  public function times($a, $b) { return $this->multiply($a, $b); }
  
  /**
   * Divide a Matrix by a Scalar
   * @param array $matrix Dividend matrix
   * @param double $scalar Divisor scalar
   * @returns array Quotient matrix
   */
  public function divide($matrix, $scalar)
    {
    foreach ($matrix as $x => $matrix_row)
      {
      foreach ($matrix_row as $y => $matrix_cell)
        {
        $final[$x][$y] = $matrix_cell / $scalar;
        }
      }
    return $final;
    }
  // Alias for "Divide a Matrix by a Scalar"
  public function quotient($a, $b) { return $this->divide($a, $b); }
  
  /**
   * Determinant of a Matrix
   * @requires Square matrix
   * @param array $matrix Matrix to calculate the determinant of
   * @returns double The determinant
   */
  public function determinant($matrix)
    {
    $rows = $this->getRowsArray($matrix);
    $columns = $this->getColumnsArray($matrix);
    $det = 0;
    if ($rows == 1 && $columns == 1)
      {
      $det = $matrix[0][0];
      }
    elseif ($rows == 2 && $columns == 2)
      {
      $det = $matrix[0][0] * $matrix[1][1] - $matrix[0][1] * $matrix[1][0];
      }
    else
      {
      // Visiting the pivot columns...
      for ($y = 0; $y < $columns; $y ++)
        {
        // This creates a sub-matrix.
        $matrix_proc = $this->subMatrix($matrix, 0, $y);
        if (fmod($y, 2) == 0)
          $det += $matrix[0][$y] * $this->determinant($matrix_proc);
        else
          $det -= $matrix[0][$y] * $this->determinant($matrix_proc);
        }
      }
    return $det;
    }
  
  /**
   * Create a Sub-Matrix
   * @param array $matrix Matrix to extract from
   * @param int $x X-Pivot
   * @param int $y Y-Pivot
   * @returns array The sub-matrix
   */
  public function subMatrix($matrix, $x, $y)
    {
    // $p is the indicator for the row of the new sub-matrix.
    // $q is the indicator for the column of the new sub-matrix.
    $p = 0;
    foreach ($matrix as $i => $matrix_row)
      {
      $q = 0;
      if ($x != $i)
        {
        foreach ($matrix_row as $j => $matrix_cell)
          {
          if ($y != $j)
            {
            $final[$p][$q] = $matrix[$i][$j];
            $q ++;
            }
          }
        $p ++;
        }
      }
    return $final;
    }
  
  /**
   * Transpose Matrix
   * @param array $matrix Matrix to transpose
   * @returns array Transposed matrix
   */
  public function transpose($matrix)
    {
    foreach ($matrix as $x => $matrix_row)
      {
      foreach ($matrix_row as $y => $matrix_cell)
        {
        $final[$y][$x] = $matrix_cell;
        }
      }
    return $final;
    }
  
  /**
   * Inverse Matrix
   * @param array $matrix Matrix to invert
   * @returns array Inverted matrix
   */
  public function inverse($matrix)
    {
    foreach ($matrix as $x => $matrix_row)
      {
      foreach ($matrix_row as $y => $matrix_cell)
        {
        if (fmod($x + $y, 2) == 0)
          {
          $final[$x][$y] = $this->determinant($this->subMatrix($matrix, $x, $y));
          }
        else 
          {
          $final[$x][$y] = -$this->determinant($this->subMatrix($matrix, $x, $y));
          }
        }
      }
    return $this->transpose($this->divide($final, $this->determinant($matrix)));
    }
  
  /**
   * ############################## XXX: It appears that in the original
   * # Advanced Matrix Operations # script, the author did not complete this
   * ############################## section, Advanced Operation Functions for
   *  Matrices. Deltik has taken no effort in completing this, as not enough
   *  of it has been pre-completed for the remaining to be translated.
   */
  
  /**
   * Average of the Matrix Object
   * @returns bool TRUE - Guaranteed success
   */
  private function average()
    {
    // Polish the values for the array that will store the averages and sums.
    foreach ($this->matrix[0] as $y => $cell)
      {
      $this->average[$y] = 0;
      $sums_average[$y]  = 0;
      }
    foreach ($this->matrix[0] as $y => $cell_cruft)
      {
      foreach ($this->matrix as $x => $column)
        {
        $sums_average[$y] += $this->matrix[$x][$y];
        }
      $this->average[$y] = $sums_average[$y] / $this->rows;
      }
    return true;
    }
  
  /**
   * Covariance of the Matrix Object
   * @returns bool TRUE - Guaranteed success
   */
  private function covariance()
    {
    return $this->multiply($this->matrix, $this->transpose($this->matrix));
    }
  }

?>
