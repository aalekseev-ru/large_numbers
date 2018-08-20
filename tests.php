<?php
require_once('LargeNumbers.php');
const PASSED = "passed. \n";
const FAILED = "FAILED! \n";

echo "Test max int: ";
echo LargeNumbers::sum((string)PHP_INT_MAX, (string)PHP_INT_MAX) == '18446744073709551614' ? PASSED : FAILED;