<?php

class solver {
    /** @var array - distribution of balls based on color; color number -> number of balls for that color */
    public $colorDistribution = array();

    /** @integer  numberOfColors - number of colos provided by the user*/
    private $numberOfColors = 1;

    function __construct($colorNumbers) {
        $this->numberOfColors = $colorNumbers;
        $this->generateRandomDistribution();
    }

    /**
     * Recursive function - distributes balls on each row. The color with the least number of balls left is chosen first, than the rest of the row is filled with balls of the color with the most number of balls left.
     * @param array $ballsNotDistributed - same pattern as $colorDistribution; we keep subtracting from each color while we assign them on rows
     * @param array $solution - bidimensional array filled with color codes
     * @return array - bidimensional array filled with color codes
     */
    function generateSolution($ballsNotDistributed = array(), $solution = array()) {
        if (!$ballsNotDistributed) //first pass
            $ballsNotDistributed = $this->colorDistribution;

        if (max($ballsNotDistributed) < 1) {
            return $solution;
        }

        $max = 0; $min = 100; $minKey = 0; $maxKey = 0;

        foreach ($ballsNotDistributed as $key => $value) {
            if ($value > 0) {
                if ($value < $min) {
                    $min = $value;
                    $minKey = $key;
                }

                if ($value > $max) {
                    $max = $value;
                    $maxKey = $key;
                }
            }
        }

        if ($minKey == $maxKey)//defense against 1 color left
            $min = 0;

        $max = $this->numberOfColors - $min;
        $ballsNotDistributed[$minKey] -= $min;
        $ballsNotDistributed[$maxKey] -= ($this->numberOfColors - $min);
        $currentRow = count($solution);

        while ($min > 0) {
            $solution[$currentRow][] = $minKey;
            $min--;
        }


        while ($max > 0) {
            $solution[$currentRow][] = $maxKey;
            $max--;
        }

        $solution = $this->generateSolution($ballsNotDistributed, $solution);
        return $solution;
    }


    /**
     * Fills the $colorDistribution array with randomly generated values
     */
    private function generateRandomDistribution() {
        $numberOfBallsGenerated = 0;

        $this->colorDistribution = array_fill(1, $this->numberOfColors, 0);
        while ($numberOfBallsGenerated < $this->numberOfColors * $this->numberOfColors) {
            $newRandomBall = rand(1, $this->numberOfColors);
            $this->colorDistribution[$newRandomBall]++;
            $numberOfBallsGenerated++;
        }
    }
}
?>