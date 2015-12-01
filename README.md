# Compress & Twig modules integration

Kohana module to integrate [Kohana Compress](https://github.com/azampagl/kohana-compress) module with [Kohana Twig](https://github.com/jonathangeiger/kohana-twig) module.

## Requirements

- PHP 5.2+
- Kohana PHP 3.3.x


## Setup

- Enable the compress module in Kohana's bootstrap file.


## Configuration (config/compress_for_twig.php)

		'disabled_in_environments' => array(),

List of environment modes on which compress tag should be disabled. For instance if you want to disabled compress tag on DEVELOPMENT environment add Kohana::DEVELOPMENT into array. 

## Usage

Just wrap javascripts or stylesheets into {% compress %} template tag. You can use variables, filters and different template tags inside compress tag like: block, for, if etc. Compress template tag first render piece of html under {% compress %} and then find stylesheets or javascripts to compress them.

NOTE: if you put javascripts and stylesheets in common block, result will be only compressed stylesheet file. Javascripts files will be skipped. So please do not mix your stylesheets and javascripts files into one block. 

### JavaScript files compress into one file:

In your HTML template use template tag {% compress %}:

    {% compress %}
      <script src="/bower_components/jquery/dist/jquery.js" type="text/javascript"></script>        
      <script src="/bower_components/history.js/scripts/bundled-uncompressed/html4+html5/jquery.history.js" type="text/javascript"></script>
      <script src="/bower_components/jquery-touchswipe/jquery.touchSwipe.js" type="text/javascript"></script>
      <script src="/js/app.js" type="text/javascript"></script>
    {% endcompress %}

Result in rendered HTML will be:

    <script type="text/javascript" src="/static/cache/b00433df1d20b42b150d0cef412baeba0e9e8375.js"></script>

### Stylesheets files compress into one file:

In your HTML template use template tag {% compress %}:

    {% compress %}
      <link href="/static/css/style.css" rel="stylesheet" type="text/css" />
      <link href="/bower_components/bootstrap/dist/css/bootstrap.css" rel="stylesheet" type="text/css" />
      <link href="/bower_components/normalize.css/normalize.css" rel="stylesheet" type="text/css" />
      <link href="/static/css/style.css" rel="stylesheet" type="text/css" />
    {% endcompress %}

Result in rendered HTML will be:

    <link type="text/css" href="/static/cache/092dafa16671cc9768cb21ec7fb74b3f8fa14153.css" rel="stylesheet" />

## Links

[Kohana Twig](https://github.com/jonathangeiger/kohana-twig)

[Kohana Compress](https://github.com/azampagl/kohana-compress)

[Kohana PHP Framework](http://kohanaframework.org/)

[Twig](http://twig.sensiolabs.org/)
