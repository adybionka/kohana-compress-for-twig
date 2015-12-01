<?php

class Twig_TokenParser_Compress extends Twig_TokenParser
{
	public function parse(Twig_Token $token)
	{
        $lineno = $token->getLine();

        $this->parser->getStream()->expect(Twig_Token::BLOCK_END_TYPE);
        $body = $this->parser->subparse(array($this, 'decideCompressEnd'), true);
        $this->parser->getStream()->expect(Twig_Token::BLOCK_END_TYPE);

        return new Twig_Node_Compress($body, $lineno, $this->getTag());
	}

	public function getTag()
	{
		return 'compress';
	}

    public function decideCompressEnd(Twig_Token $token)
    {
        return $token->test('endcompress');
    }

	public function decideBlockEnd($token)
	{
		return $token->test('endcompress');
	}
}
