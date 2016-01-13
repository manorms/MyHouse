<?php
if( !function_exists("money_format") )
{
function money_format($format, $number)
{

    $regex  = '/%((?:[\^!\-]|\+|\(|\=.)*)([0-9]+)?'.

              '(?:#([0-9]+))?(?:\.([0-9]+))?([in%])/';

    if (setlocale(LC_MONETARY, 0) == 'C') {

        setlocale(LC_MONETARY, '');

    }

    $locale = localeconv();

    preg_match_all($regex, $format, $matches, PREG_SET_ORDER);

    foreach ($matches as $fmatch) {

        $value = floatval($number);

        $flags = array(

            'fillchar'  => preg_match('/\=(.)/', $fmatch[1], $match) ?

                           $match[1] : ' ',

            'nogroup'   => preg_match('/\^/', $fmatch[1]) > 0,

            'usesignal' => preg_match('/\+|\(/', $fmatch[1], $match) ?

                           $match[0] : '+',

            'nosimbol'  => preg_match('/\!/', $fmatch[1]) > 0,

            'isleft'    => preg_match('/\-/', $fmatch[1]) > 0

        );

        $width      = trim($fmatch[2]) ? (int)$fmatch[2] : 0;

        $left       = trim($fmatch[3]) ? (int)$fmatch[3] : 0;

        $right      = trim($fmatch[4]) ? (int)$fmatch[4] : $locale['int_frac_digits'];

        $conversion = $fmatch[5];



        $positive = true;

        if ($value < 0) {

            $positive = false;

            $value  *= -1;

        }

        $letter = $positive ? 'p' : 'n';

        $prefix = $suffix = $cprefix = $csuffix = $signal = '';

        $signal = $positive ? $locale['positive_sign'] : $locale['negative_sign'];

        switch (true) {

            case $locale["{$letter}_sign_posn"] == 1 && $flags['usesignal'] == '+':

                $prefix = $signal;

                break;

            case $locale["{$letter}_sign_posn"] == 2 && $flags['usesignal'] == '+':

                $suffix = $signal;

                break;

            case $locale["{$letter}_sign_posn"] == 3 && $flags['usesignal'] == '+':

                $cprefix = $signal;

                break;

            case $locale["{$letter}_sign_posn"] == 4 && $flags['usesignal'] == '+':

                $csuffix = $signal;

                break;

            case $flags['usesignal'] == '(':

            case $locale["{$letter}_sign_posn"] == 0:

                $prefix = '(';

                $suffix = ')';

                break;

        }

        if (!$flags['nosimbol']) {

            $currency = $cprefix .

                        ($conversion == 'i' ? $locale['int_curr_symbol'] : $locale['currency_symbol']) .

                        $csuffix;

        } else {

            $currency = '';

        }

        $space  = $locale["{$letter}_sep_by_space"] ? ' ' : '';

        $value = number_format($value, $right, $locale['mon_decimal_point'],

                 $flags['nogroup'] ? '' : $locale['mon_thousands_sep']);

        $value = @explode($locale['mon_decimal_point'], $value);


        $n = strlen($prefix) + strlen($currency) + strlen($value[0]);

        if ($left > 0 && $left > $n) {

            $value[0] = str_repeat($flags['fillchar'], $left - $n) . $value[0];

        }

        $value = implode($locale['mon_decimal_point'], $value);

        if ($locale["{$letter}_cs_precedes"]) {

            $value = $prefix . $currency . $space . $value . $suffix;

        } else {

            $value = $prefix . $value . $space . $currency . $suffix;

        }

        if ($width > 0) {

            $value = str_pad($value, $width, $flags['fillchar'], $flags['isleft'] ?

                     STR_PAD_RIGHT : STR_PAD_LEFT);

        }



        $format = str_replace($fmatch[0], $value, $format);

    }

    return $format;

}
}
//constantes para el systema
define("NAME_SYSTEM", "MyHouse v5.1");
define("URL_SYSTEM", "http://myhouse.alpha-soluciones.com/");
/**
 * This file is loaded automatically by the app/webroot/index.php file after core.php
 *
 * This file should load/create any application wide configuration settings, such as
 * Caching, Logging, loading additional configuration files.
 *
 * You should also use this file to include any files that provide global functions/constants
 * that your application uses.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Config
 * @since         CakePHP(tm) v 0.10.8.2117
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

// Setup a 'default' cache configuration for use in the application.
Cache::config('default', array('engine' => 'File'));

/**
 * The settings below can be used to set additional paths to models, views and controllers.
 *
 * App::build(array(
 *     'Model'                     => array('/path/to/models/', '/next/path/to/models/'),
 *     'Model/Behavior'            => array('/path/to/behaviors/', '/next/path/to/behaviors/'),
 *     'Model/Datasource'          => array('/path/to/datasources/', '/next/path/to/datasources/'),
 *     'Model/Datasource/Database' => array('/path/to/databases/', '/next/path/to/database/'),
 *     'Model/Datasource/Session'  => array('/path/to/sessions/', '/next/path/to/sessions/'),
 *     'Controller'                => array('/path/to/controllers/', '/next/path/to/controllers/'),
 *     'Controller/Component'      => array('/path/to/components/', '/next/path/to/components/'),
 *     'Controller/Component/Auth' => array('/path/to/auths/', '/next/path/to/auths/'),
 *     'Controller/Component/Acl'  => array('/path/to/acls/', '/next/path/to/acls/'),
 *     'View'                      => array('/path/to/views/', '/next/path/to/views/'),
 *     'View/Helper'               => array('/path/to/helpers/', '/next/path/to/helpers/'),
 *     'Console'                   => array('/path/to/consoles/', '/next/path/to/consoles/'),
 *     'Console/Command'           => array('/path/to/commands/', '/next/path/to/commands/'),
 *     'Console/Command/Task'      => array('/path/to/tasks/', '/next/path/to/tasks/'),
 *     'Lib'                       => array('/path/to/libs/', '/next/path/to/libs/'),
 *     'Locale'                    => array('/path/to/locales/', '/next/path/to/locales/'),
 *     'Vendor'                    => array('/path/to/vendors/', '/next/path/to/vendors/'),
 *     'Plugin'                    => array('/path/to/plugins/', '/next/path/to/plugins/'),
 * ));
 *
 */

/**
 * Custom Inflector rules can be set to correctly pluralize or singularize table, model, controller names or whatever other
 * string is passed to the inflection functions
 *
 * Inflector::rules('singular', array('rules' => array(), 'irregular' => array(), 'uninflected' => array()));
 * Inflector::rules('plural', array('rules' => array(), 'irregular' => array(), 'uninflected' => array()));
 *
 */

/**
 * Plugins need to be loaded manually, you can either load them one by one or all of them in a single call
 * Uncomment one of the lines below, as you need. Make sure you read the documentation on CakePlugin to use more
 * advanced ways of loading plugins
 *
 * CakePlugin::loadAll(); // Loads all plugins at once
 * CakePlugin::load('DebugKit'); //Loads a single plugin named DebugKit
 *
 */

/**
 * You can attach event listeners to the request lifecycle as Dispatcher Filter. By default CakePHP bundles two filters:
 *
 * - AssetDispatcher filter will serve your asset files (css, images, js, etc) from your themes and plugins
 * - CacheDispatcher filter will read the Cache.check configure variable and try to serve cached content generated from controllers
 *
 * Feel free to remove or add filters as you see fit for your application. A few examples:
 *
 * Configure::write('Dispatcher.filters', array(
 *		'MyCacheFilter', //  will use MyCacheFilter class from the Routing/Filter package in your app.
 *		'MyPlugin.MyFilter', // will use MyFilter class from the Routing/Filter package in MyPlugin plugin.
 * 		array('callable' => $aFunction, 'on' => 'before', 'priority' => 9), // A valid PHP callback type to be called on beforeDispatch
 *		array('callable' => $anotherMethod, 'on' => 'after'), // A valid PHP callback type to be called on afterDispatch
 *
 * ));
 */
Configure::write('Dispatcher.filters', array(
	'AssetDispatcher',
	'CacheDispatcher'
));

/**
 * Configures default file logging options
 */
App::uses('CakeLog', 'Log');
CakeLog::config('debug', array(
	'engine' => 'File',
	'types' => array('notice', 'info', 'debug'),
	'file' => 'debug',
));
CakeLog::config('error', array(
	'engine' => 'File',
	'types' => array('warning', 'error', 'critical', 'alert', 'emergency'),
	'file' => 'error',
));
CakePlugin::load('Upload');
CakePlugin::load('BoostCake');
CakePlugin::load('Acl', array('bootstrap' => true));
CakePlugin::load('Facebook');
