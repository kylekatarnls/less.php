<?php

namespace Less\Node;

class Negative{

	public $type = 'Negative';
	public $value;

	function __construct($node){
		$this->value = $node;
	}

	function accept($visitor) {
		$this->value = $visitor->visit($this->value);
	}

	function toCSS($env){
		return '-'.$this->value->toCSS($env);
	}

	function compile($env) {
		if( $env->isMathsOn() ){
			$ret = new \Less\Node\Operation('*', array( new \Less\Node\Dimension(-1), $this->value ) );
			return $ret->compile($env);
		}
		return new \Less\Node\Negative( $this->value->compile($env) );
	}
}