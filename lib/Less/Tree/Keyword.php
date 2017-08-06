<?php

/**
 * Keyword.
 */
class Less_Tree_Keyword extends Less_Tree
{
    public $value;
    public $type = 'Keyword';

    /**
     * @param string $value
     */
    public function __construct($value)
    {
        $this->value = $value;
    }

    public function compile()
    {
        return $this;
    }

    /**
     * @see Less_Tree::genCSS
     */
    public function genCSS($output)
    {
        if ($this->value === '%') {
            throw new Less_Exception_Compiler('Invalid % without number');
        }

        $output->add($this->value);
    }

    public function compare($other)
    {
        if ($other instanceof self) {
            return $other->value === $this->value ? 0 : 1;
        } else {
            return -1;
        }
    }
}
