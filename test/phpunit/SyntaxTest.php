<?php

class phpunit_SyntaxTest extends phpunit_bootstrap
{
    /**
     * Test.
     */
    public function testVariablesInImport()
    {
        echo "\nSyntax Tests";

        $parser = new Less_Parser();
        $parser->parseFile(__DIR__ . '/../Fixtures/variables/style.less');
        $css = $parser->getCss();

        $this->assertEquals(implode("\n", array(
            'body {',
            '  color: #ff0000;',
            '}',
            ''
        )), $css);
    }

    /**
     * Test.
     */
    public function testMath()
    {
        echo "\nSyntax Tests";

        $parser = new Less_Parser();
        $parser->parseFile(__DIR__ . '/../Fixtures/math/style.less');
        $css = $parser->getCss();

        $this->assertEquals(implode("\n", array(
            '#foo {',
            '  font-size: 13.07692308rem;',
            '  line-height: 13.84615385rem;',
            '}',
            '',
        )), $css);
    }
}
