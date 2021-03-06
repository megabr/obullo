<?php
defined('BASE') or exit('Access Denied!');

/**
 * Obullo Framework (c) 2009.
 *
 * PHP5 MVC Based Minimalist Software.
 *
 * @package         obullo
 * @author          obullo.com
 * @copyright       Ersin Guvenc (c) 2010.
 * @filesource
 * @license
 */

/**
 * Obullo Head Tag Helper
 *
 * @package     Obullo
 * @subpackage  Helpers
 * @category    Language
 * @author      Ersin Guvenc
 * @version     0.1
 * @version     0.2 added script functions
 * @link
 */
// --------------------------------------------------------------------

/**
* Build css files in <head> tags
*
* css('welcome.css');
* css('subfolder/welcome.css')
* css('../module/welcome.css');  from /modules dir
* css('../extension/welcome.css');  from /extension dir
* css(array('welcome.css', 'hello.css'));
* css('#main {display: block; color: red;}', 'embed');
*
* @author   Ersin Guvenc
* @param    mixed   $filename array or string
* @param    string  $title_or_embed
* @param    string  $media  'all' or 'print' etc..
* @version  0.1
* @version  0.2 added $path variable
* @version  0.2 added _ent->css_folder variable
* @version  0.3 depreciated $path param
* @return   string
*/
if( ! function_exists('css') )
{
    function css($href, $title_or_embed = '', $media = '', $rel = 'stylesheet', $index_page = FALSE)
    {
        $ob = this();
        
        if($title_or_embed == 'embed')
        {
            $css = '<style type="text/css" ';
            $css.= ($media != '') ? 'media="'.$media.'" ' : '';
            $css.= '>';
            $css.= $href;
            $css.= "</style>\n";
            
            return $css;
        }
            
        $title = $title_or_embed;
        $link = '<link ';

        $_ob = base_register('Storage');   // obullo changes ..

        // When user use view_set_folder('css', 'iphone'); ..  /public/iphone/css/welcome.css
        $extra_path = '';
        if( isset($_ob->view->css_folder{1}) )
        {
            $extra_path = $_ob->view->css_folder;
        }

        if (is_array($href))
        {
            $link = '';

            foreach ($href as $v)
            {
                $link .= '<link ';

                $v = ltrim($v, '/');   // remove first slash  ( Obullo changes )

                if ( strpos($v, '://') !== FALSE)
                {
                    $link .= ' href="'. $v .'" ';
                }
                else
                {
                    $link .= ' href="'. _get_public_path($v, $extra_path) .'" ';
                }

                $link .= 'rel="'.$rel.'" type="text/css" ';

                if ($media    != '')
                {
                    $link .= 'media="'.$media.'" ';
                }

                if ($title    != '')
                {
                    $link .= 'title="'.$title.'" ';
                }

                $link .= "/>\n";
            }
        }
        else
        {
            $href = ltrim($href, '/');  // remove first slash

            if ( strpos($href, '://') !== FALSE)
            {
                $link .= ' href="'.$href.'" ';
            }
            elseif ($index_page === TRUE)
            {
                $link .= ' href="'. $ob->config->site_url($href, false) .'" ';
            }
            else
            {
                $link .= ' href="'. _get_public_path($href, $extra_path) .'" ';
            }

            $link .= 'rel="'.$rel.'" type="text/css" ';

            if ($media    != '')
            {
                $link .= 'media="'.$media.'" ';
            }

            if ($title    != '')
            {
                $link .= 'title="'.$title.'" ';
            }

            $link .= "/>\n";
        }

        return $link;
    }
}
// ------------------------------------------------------------------------

/**
* Build js files in <head> tags
*
* js('welcome.js');
* js('subfolder/welcome.js')
* js('../module/welcome.js');  from /modules dir
* js(array('welcome.js', 'hello.js'));
*
* @author   Ersin Guvenc
* @param    string $src  it can be via a path
* @param    string $arguments
* @param    string $type
* @param    string $index_page load js dynamically
* @version  0.1
* @version  0.2 removed /js dir, added _get_public_path() func.
*
*/
if( ! function_exists('js') )
{
    function js($src, $arguments = '', $type = 'text/javascript', $index_page = FALSE)
    {
        $ob = this();

        $link = '<script type="'.$type.'" ';

        $_ob = base_register('Storage');   // obullo changes ..

        // When user use view_set_folder('js', 'iphone'); ..  /public/iphone/css/welcome.css
        $extra_path = '';
        if( isset($_ob->view->js_folder{1}) )
        {
            $extra_path = $_ob->view->js_folder;
        }
        
        if (is_array($src))
        {
            $link = '';

            foreach ($src as $v)
            {
                $link .= '<script type="'.$type.'" ';

                $v = ltrim($v, '/');   // remove first slash  ( Obullo changes )

                if ( strpos($v, '://') !== FALSE)
                {
                    $link .= ' src="'. $v .'" ';
                }
                else
                {
                    $link .= ' src="'. _get_public_path($v, $extra_path) .'" ';
                }

                $link .= "></script>\n";
            }

        }
        else
        {
            $src = ltrim($src, '/');   // remove first slash

            if ( strpos($src, '://') !== FALSE)
            {
                $link .= ' src="'. $src .'" ';
            }
            elseif ($index_page === TRUE)  // .js file as PHP
            {
                $link .= ' src="'. $ob->config->site_url($src, false) .'" ';
            }
            else
            {
                $link .= ' src="'. _get_public_path($src, $extra_path) .'" ';
            }

            $link .= $arguments;
            $link .= "></script>\n";
        }

        return $link;

    }
}

// ------------------------------------------------------------------------

/**
* Generates meta tags from an array of key/values
*
* @access   public
* @param    array
* @return   string
*/
if( ! function_exists('meta') )
{
    function meta($name = '', $content = '', $type = 'name', $newline = "\n")
    {
        // Since we allow the data to be passes as a string, a simple array
        // or a multidimensional one, we need to do a little prepping.
        if ( ! is_array($name))
        {
            $name = array(array('name' => $name, 'content' => $content, 'type' => $type, 'newline' => $newline));
        }
        else
        {
            // Turn single array into multidimensional
            if (isset($name['name']))
            {
                $name = array($name);
            }
        }

        $str = '';
        foreach ($name as $meta)
        {
            $type       = ( ! isset($meta['type']) OR $meta['type'] == 'name') ? 'name' : 'http-equiv';
            $name       = ( ! isset($meta['name']))     ? ''     : $meta['name'];
            $content    = ( ! isset($meta['content']))    ? ''     : $meta['content'];
            $newline    = ( ! isset($meta['newline']))    ? "\n"    : $meta['newline'];

            $str .= '<meta '.$type.'="'.$name.'" content="'.$content.'" />'.$newline;
        }

        return $str;
    }
}

// ------------------------------------------------------------------------

/**
 * Link
 *
 * Generates link to a CSS file
 *
 * @access   public
 * @param    mixed    stylesheet hrefs or an array
 * @param    string   rel
 * @param    string   type
 * @param    string   title
 * @param    string   media
 * @param    boolean  should index_page be added to the css path
 * @return   string
 */
if( ! function_exists('link_tag') )
{
    function link_tag($href = '', $rel = 'stylesheet', $type = '', $title = '', $media = '', $index_page = FALSE)
    {
        $ob = this();

        $link = '<link ';

        if ( strpos($href, '://') !== FALSE)
        {
            $link .= ' href="'.$href.'" ';
        }
        elseif ($index_page === TRUE)
        {
            $link .= ' href="'. $ob->config->site_url($href, false) .'" ';
        }
        else
        {
            $public_path = ' href="'. _get_public_path($href) .'" ';

            if($public_path == FALSE)
            {
                $link .= ' href="'. $ob->config->site_url($href, false) .'" ';
            }
            else
            {
                $link .= $public_path;
            }
        }

        $link .= 'rel="'.$rel.'" ';

        if ($type    != '')
        {
            $link .= 'type="'.$type.'" ';
        }

        if ($media    != '')
        {
            $link .= 'media="'.$media.'" ';
        }

        if ($title    != '')
        {
            $link .= 'title="'.$title.'" ';
        }

        $link .= '/>';

        return $link."\n";
    }
}

// ------------------------------------------------------------------------

/**
* Generates a page document type declaration
*
* Valid options are xhtml11, xhtml-strict, xhtml-trans, xhtml-frame,
* html4-strict, html4-trans, and html4-frame.
*
* Values are saved in the doctypes config file.
*
* @access  public
*/
if( ! function_exists('doctype') )
{
    function doctype($type = 'xhtml1-strict')
    {
        return config_item($type, 'doctypes');
    }
}

/* End of file head_tag.php */
/* Location: ./obullo/helpers/head_tag.php */
