<?php

class Twig_Node_Compress extends Twig_Node
{
    public function __construct(Twig_NodeInterface $body, $lineno, $tag = 'compress')
    {
        parent::__construct(array('body' => $body), array(), $lineno, $tag);
    }

    /**
     * Converts paths to absolute paths and check whether or not path exits
     * @param array with list of path to convert and check
     * @return array with list of paths with absolute paths
     */
    public static function fix_paths($files)
    {
    	foreach($files as $key => $path)
    	{
    		$files[$key] = DOCROOT.$path;

    		if ( !file_exists($files[$key]))
    		{
    			throw new Kohana_Exception('File '.$files[$key].' does not exist');
    		}
    	}

    	return $files;
    }

    /**
     * Takes rendered piece of html inside compress tag
     * and finds all css and js files to compress them.
     * @param string piece of rendered html
     * @return html with compressed css or js file
     */
    public static function compress($html)
    {
        if (in_array(Kohana::$environment, Kohana::$config->load('compress_for_twig.disabled_in_environments')))
        {
            return $html;
        }

		preg_match_all('/<link[ a-zA-Z0-9="]+href="(.+?)"/s', $html, $files);

		if (Arr::get($files, 1)) 
		{				
			$result = Compress::instance('stylesheets')->styles(self::fix_paths(Arr::get($files, 1)));
    		return HTML::style($result);
		}

		preg_match_all('/<script[ a-zA-Z0-9="]+src="(.+?)"/s', $html, $files);

		if (Arr::get($files, 1)) 
		{				
			$result = Compress::instance('javascripts')->scripts(self::fix_paths(Arr::get($files, 1)));
    		return HTML::script($result);
		}

		return $html;
    }

    /**
     * Compiles the node to PHP.
     *
     * @param Twig_Compiler A Twig_Compiler instance
     * @return void
     */
    public function compile(Twig_Compiler $compiler)
    {
        $compiler
            ->addDebugInfo($this)
            ->write("ob_start();\n")
            ->subcompile($this->getNode('body'))
            ->write("echo Twig_Node_Compress::compress(ob_get_clean());\n")
        ;
    }
}
