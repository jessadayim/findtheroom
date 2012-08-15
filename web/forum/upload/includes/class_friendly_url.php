<?php if (!class_exists('vB_Database')) exit;
/*======================================================================*\
|| #################################################################### ||
|| # vBulletin 4.0.5
|| # ---------------------------------------------------------------- # ||
|| # Copyright ©2000-2010 vBulletin Solutions Inc. All Rights Reserved. ||
|| # This file may not be redistributed in whole or significant part. # ||
|| # ---------------- VBULLETIN IS NOT FREE SOFTWARE ---------------- # ||
|| # http://www.vbulletin.com | http://www.vbulletin.com/license.html # ||
|| #################################################################### ||
\*======================================================================*/

/**#@+
* Friendly URL types
* @TODO: move to constants in vB_Friendly_Url
*/
define('FRIENDLY_URL_OFF', 0);
define('FRIENDLY_URL_BASIC',	1);
define('FRIENDLY_URL_ADVANCED', 2);
define('FRIENDLY_URL_REWRITE',  3);

define('SEO_NOSESSION', 1);
define('SEO_JS', 2);
/**#@-*/

/**
 * Base class for friendly URLs.
 *
 * @package vBulletin
 * @author vBulletin Development Team
 * @version $Revision: 32878 $
 * @since $Date: 2009-10-28 18:38:49 +0000 (Wed, 28 Oct 2009) $
 * @copyright vBulletin Solutions Inc.
 */
abstract class vB_Friendly_Url
{
	/**
	 * Regex to clean fragments.
	 *
	 * @var string
	 */
	const CLEAN_URL_REGEX = '*([\s$+,/:=\?@"\'<>%{}|\\^~[\]`\r\n\t\x00-\x1f\x7f]|(?(?<!&)#|#(?![0-9]+;))|&(?!#[0-9]+;)|(?<!&#\d|&#\d{2}|&#\d{3}|&#\d{4}|&#\d{5});)*s';

	/**
	 * Unicode URL options
	 *
	 * @var int
	 */
	const UNI_IGNORE = 0;
	const UNI_CONVERT = 1;
	const UNI_STRIP = 2;

	/**
	 * Canonical URL options
	 *
	 * @var int
	 */
	const CANON_OFF = 0;
	const CANON_STANDARD = 1;
	const CANON_STRICT = 2;

	/**
	 * The current resource id.
	 *
	 * @var string
	 */
	protected $id;

	/**
	 * The current title of the resource.
	 *
	 * @var string
	 */
	protected $title;

	/**
	 * The URL parsed from the request.
	 *
	 * @var string
	 */
	protected static $request_url;

	/**
	 * The URI parsed from the request.
	 *
	 * @var string
	 */
	protected static $request_uri;

	/**
	 * Whether we have parsed the request uri.
	 *
	 * @var bool
	 */
	protected static $parsed_request;

	/**
	 * The resolved uri for the friendly url.
	 *
	 * @var string
	 */
	protected $uri;

	/**
	 * The request variable for the resource id.
	 *
	 * @var string
	 */
	protected $idvar;

	/**
	 * Page info.
	 * Additional properties to either build into the link path or always add to the
	 * query string.
	 *
	 * @var array
	 */
	protected $pageinfo = array();

	/**
	 * Link info index of the resource id.
	 *
	 * @var string
	 */
	protected $idkey = 'id';

	/**
	 * Link info index of the title.
	 *
	 * @var string
	 */
	protected $titlekey = 'title';

	/**
	 * Array of pageinfo vars to ignore when building the uri.
	 *
	 * @var array string
	 */
	protected $ignorelist = array();

	/**
	 * The name of the script that the URL links to.
	 *
	 * @var string
	 */
	protected $script;

	/**
	 * The rewrite segment to identify this friendly url type.
	 *
	 * @var string
	 */
	protected $rewrite_segment;

	/**
	 * Reference to the $vbulletin registry.
	 *
	 * @var vB_Registry
	 */
	protected $registry;

	/**
	 * URL options bitfield.
	 * Whether to include the session hash or whether the link is for js.
	 * @see SEO_NOSESSION, SEO_JS, __construct(), get_qs_arguments()
	 *
	 * @var int
	 */
	protected $urloptions = 0;

	/**
	 * Whether to use the friendly uri in POST requests.
	 *
	 * @var bool
	 */
	protected $parse_post;

	/**
	 * Whether to always set the route, even if friendly urls are off.
	 *
	 * @var bool
	 */
	protected $always_route;


	/**
	 * Constructor.
	 * Note: The factory method must be used to create a vB_Friendly_Url.
	 * @see vB_Friendly_Url::fetchLibrary()
	 *
	 * @param vB_Registry $registry				- Reference to the vBulletin registry
	 * @param array $linkinfo					- Info about the link, the id, title etc
	 * @param array $pageinfo					- Additional info about the required request; pagenumber and query string
	 * @param string $idkey						- Override the key in $linkinfo for the resource id
	 * @param string $titlekey					- Override the key in $linkinfo for the resource title
	 * @param int $urloptions					- Bitfield of environment options SEO_NOSESSION, SEO_JS, etc
	 */
	protected function __construct(&$registry, $linkinfo = null, $pageinfo = null, $idkey = false, $titlekey = false, $urloptions = 0)
	{
		$this->idkey = $idkey ? $idkey : $this->idkey;
		$this->titlekey = $titlekey ? $titlekey : $this->titlekey;
		$this->registry =& $registry;
		$this->urloptions = $urloptions;

		// Ensure linkinfo and pageinfo are arrays
		$linkinfo = $linkinfo ? (array)$linkinfo : null;
		$pageinfo = $pageinfo ? (array)$pageinfo : null;

		// Resolve the rewrite segment that identifies the script
		if (!$this->rewrite_segment)
		{
			if (defined('VB_ROUTER_SEGMENT'))
			{
				$this->rewrite_segment = VB_ROUTER_SEGMENT;
			}
			else
			{
				$pathinfo = pathinfo(SCRIPT);
				$this->rewrite_segment = $pathinfo['filename'];
			}
		}

		// If $linkinfo isn't set then parse it from the request
		$linkinfo ? $this->set_linkinfo($linkinfo) : $this->consume_request_uri();

		// Set the pageinfo
		if ($pageinfo)
		{
			$this->set_pageinfo($pageinfo);
		}
	}


	/**
	 * Factory method.
	 *
	 * @param vB_Registry $registry				- Reference to the vBulletin registry
	 * @param string $link						- The type of link to create and additional link options
	 * @param array $linkinfo					- Info about the link, the id, title etc
	 * @param array $pageinfo					- Additional info about the required request; pagenumber and query string
	 * @param string $idkey						- Override the key in $linkinfo for the resource id
	 * @param string $titlekey					- Override the key in $linkinfo for the resource title
	 * @return vB_Friendly_Url					- The apprpriate friendly url class
	 */
	public static function fetchLibrary(&$registry, $link, $linkinfo = null, $pageinfo = null, $idkey = null, $titlekey = null)
	{
		global $show;

		$linkoptions = explode('|', $link);
		$linktype = $linkoptions[0];

		$urloptions = 0;
		if (in_array('nosession', $linkoptions))
		{
			$urloptions += SEO_NOSESSION;
		}
		if (in_array('js', $linkoptions))
		{
			$urloptions += SEO_JS;
		}

		// Allow hooks to override the class
		($hook = vBulletinHook::fetch_hook('friendlyurl_resolve_class')) ? eval($hook) : false;

		if (!isset($class))
		{
			$class = 'vB_Friendly_Url_' . ucfirst($linktype);
		}

		if (class_exists($class, false))
		{
			$instance = new $class($registry, $linkinfo, $pageinfo, $idkey, $titlekey, $urloptions);
		}
		else
		{
			$instance = new vB_Friendly_Url_Error($linktype);
		}

		return $instance;
	}


	/**
	 * Checks if the friendly url is relevant for this request.
	 *
	 * @return bool
	 */
	protected function is_eligible()
	{
		return $this->parse_post OR ($_SERVER['REQUEST_METHOD'] == 'GET');
	}


	/**
	 * Sets the linkinfo properties.
	 *
	 * @param array mixed $linkinfo
	 */
	protected function set_linkinfo(array $linkinfo)
	{
		$this->id = intval($linkinfo[$this->idkey]);
		$this->title = $linkinfo[$this->titlekey];

		// Unset the uri as it has changed
		unset($this->uri);
	}


	/**
	 * Sets the pageinfo properties.
	 *
	 * @param array mixed $pageinfo
	 */
	protected function set_pageinfo(array $pageinfo)
	{
		$this->pageinfo = $pageinfo;

		unset($this->uri);
	}


	/**
	 * Cleans output to be parsed into the uri.
	 * Setting $canonical is useful for creating redirect url's that cannot be
	 * encoded for redirects.
	 *
	 * @param string $fragment
	 * @param bool $canonical							- Whether to encode for output
	 * @return string
	 */
	public static function clean_fragment($fragment, $canonical = false)
	{
		global $vbulletin;

		// Convert to UTF-8
		if (self::UNI_CONVERT == $vbulletin->options['friendlyurl_unicode'])
		{
			// convert to UTF-8
			$fragment = to_utf8($fragment, $vbulletin->userinfo['lang_charset']);

			// convert NCRs
			$fragment = unhtmlspecialchars($fragment, true);
		}
		else if (self::UNI_STRIP == $vbulletin->options['friendlyurl_unicode'])
		{
			// strip NCRs
			$fragment = stripncrs($fragment);
		}

		// Remove url entities
		$fragment = self::clean_entities($fragment);

		// Prepare the URL for output
		if (!$canonical AND (self::UNI_CONVERT == $vbulletin->options['friendlyurl_unicode']) AND ('UTF-8' != $vbulletin->userinfo['lang_charset']))
		{
			if (is_browser('ie'))
			{
				if ($vbulletin->options['friendlyurl_ncrencode'])
				{
					$fragment = ncrencode($fragment, true);
				}
			}
			else
			{
				$fragment = urlencode($fragment);
			}
		}
		else if ($canonical AND (self::UNI_IGNORE == $vbulletin->options['friendlyurl_unicode']))
		{
			// ensure NCRs are converted
			$fragment = unhtmlspecialchars($fragment, true);
		}

		return $fragment;
	}


	/**
	 * Replaces url entities with -
	 *
	 * @param string $fragment
	 * @return string
	 */
	public static function clean_entities($fragment)
	{
		$fragment = preg_replace(self::CLEAN_URL_REGEX, '-', strip_tags($fragment));
		$fragment = trim(preg_replace('#-+#', '-', $fragment), '-');

		return $fragment;
	}


	/**
	 * Renders the pageinfo query string.
	 * Vars that are included in the main uri should be defined in $ignorelist so
	 * they can be skipped.
	 *
	 * @return string
	 */
	protected function get_query()
	{
		$arguments = array();

		// Add session argument if settings require it
		if (!($this->urloptions & SEO_NOSESSION) AND isset($this->registry->session) AND $this->registry->session->visible)
		{
			$arguments['s'] = $this->registry->session->vars['dbsessionhash'];
		}

		// Add any arguments that are not already displayed as part of friendly url
		if (!empty($this->pageinfo) AND is_array($this->pageinfo))
		{
			foreach ($this->pageinfo AS $var => $value)
			{
				if (!$this->skip_query_var($var, false))
				{
					$arguments[$var] = $value;
				}
			}
		}

		// Check ampersand to use
		$amp = ($this->urloptions & SEO_JS) ? '&' : '&amp;';
		$arguments = implode_both('=', $amp, $arguments);

		return $arguments;
	}


	/**
	 * Checks whether to ignore a pageinfo element when building the uri.
	 *
	 * @param string $key						- The key of the var to check
	 * @param bool $skip_pageinfo				- Whether to skip current pageinfo
	 * @return bool								- Whether to skip the argument
	 */
	protected function skip_query_var($key, $skip_pageinfo = true)
	{
		if (in_array($key, $this->ignorelist) OR ($skip_pageinfo AND isset($this->pageinfo[$key])))
		{
			return true;
		}

		return false;
	}


	/**
	 * Returns only the uri.
	 * Setting $canonical gets the uri without encoding it for output.
	 * @see vB_Friendly_Url::redirect_canonical_url()
	 *
	 * @param bool $canonical							- If true, don't encode for output
	 * @return string
	 */
	public function get_uri($canonical = false)
	{
		if (isset($this->uri) AND !$canonical)
		{
			return $this->uri;
		}

		if (!$this->always_route AND (FRIENDLY_URL_OFF == $this->registry->options['friendlyurl']))
		{
			return false;
		}

		return $this->uri = $this->clean_fragment($this->id . '-' . $this->title, $canonical);
	}


	/**
	 * Sets the uri from the current request.
	 */
	protected function consume_request_uri()
	{
		// Ensure the request was parsed
		$this->parse_request_uri();

		$this->uri = self::$request_uri;
		$this->id = $_GET[$this->idvar];
	}


	/**
	 * Adds pageinfo from the current request's query string.
	 */
	protected function consume_request_pageinfo($clean = false)
	{
		// Ensure the request was parsed
		$this->parse_request_uri();

		// Get the query string
		if (!VB_URL_QUERY)
		{
			return;
		}

		parse_str(VB_URL_QUERY, $query);

		// If using FRIENDLY_URL_BASIC ignore the first query var that was requested as it is the uri
		if (FRIENDLY_URL_BASIC == FRIENDLY_URL)
		{
			array_shift($query);
		}

		// Build the pageinfo from the query string
		foreach ($query AS $key => $value)
		{
			if (!$this->skip_query_var($key))
			{
				if ($clean)
				{
					$key = $this->registry->input->xss_clean($key);
					$value = $this->registry->input->xss_clean($value);
				}

				$this->pageinfo[$key] = $value;
			}
		}
	}


	/**
	 * Parses the uri from the current request.
	 * This method also sets FRIENDLY_URL as the detected method and applies the
	 * results to $_REQUEST and $_GET.
	 */
	public function parse_request_uri()
	{
		// Check if we have already defined the request method
		if (self::$parsed_request)
		{
			return;
		}

		// Mark the request as parsed
		self::$parsed_request = true;

		// Check if script uses friendly urls
		if (!$this->is_eligible())
		{
			define('FRIENDLY_URL', FRIENDLY_URL_OFF);

			return;
		}

		// Initialise resolution vars
		$method = $uri = false;

		// Get the requested path info
		$rewrite = false;

		// Check if script is in the uri
		if (stripos(VB_URL_CLEAN, $this->script) !== false)
		{
			// if the primaryvar was requested then we're not using friendly urls
			if (isset($_GET[$this->idvar]))
			{
				$method = FRIENDLY_URL_OFF;

				// Get raw uri for 'always_route' friendlies
				if ($this->always_route)
				{
					$pat_off = preg_quote($this->script, '#') . '\?' . preg_quote($this->idvar, '#') . '=([^=]*)(?:\?|&|$)';
					$matches = array();

					if (preg_match("#$pat_off#sui", VB_URL_CLEAN, $matches))
					{
						$uri = $matches[1];
					}
				}
				else
				{
					// the friendly will build the uri from the parsed query
					$uri = false;
				}
			}
			else
			{
				// Check for BASIC and ADVANCED
				$pat_basic = preg_quote($this->script, '#') . '\?([^=]*)(?:\?|&|$)';
				$pat_advanced = preg_quote($this->script, '#') . '/([^\?]*)';
				$matches = array();

				if (preg_match("#$pat_basic#si", VB_URL_CLEAN, $matches))
				{
					$method = FRIENDLY_URL_BASIC;
					$uri = $matches[1];
				}
				else if (preg_match("#$pat_advanced#i", VB_URL_CLEAN, $matches))
				{
					$method = FRIENDLY_URL_ADVANCED;
					$uri = $matches[1];
				}
			}
		}
		else
		{
			// Check for REWRITE
			$pat_rewrite = '(?:' . preg_quote($this->rewrite_segment, '#') . '/)*' . preg_quote($this->rewrite_segment, '#') . '/([^\?]*|$)';
			if (preg_match("#$pat_rewrite#sui", VB_URL_CLEAN, $matches))
			{
				$method = FRIENDLY_URL_REWRITE;
				$uri = $matches[1];
			}
		}

		// Check if we didn't detect a method
		if (!$method)
		{
			$method = FRIENDLY_URL_OFF;
		}

		// Set the decoded uri
		self::$request_uri = urldecode($uri);

		// Define the resolved friendly url method
		define('FRIENDLY_URL', $method);

		// If friendly url is off then there's nothing more to do
		if (FRIENDLY_URL == FRIENDLY_URL_OFF)
		{
			return;
		}

		// Remove the request uri from the query string
		if (FRIENDLY_URL == FRIENDLY_URL_BASIC)
		{
			unset($_REQUEST[self::$request_uri]);
			array_shift($_GET);
		}

		// Fix a known issue with apache
		if (is_server('apache') AND isset($_SERVER['REDIRECT_URL']))
		{
			self::fix_query_string($url);
		}

		// Set the request based on the decoded fragment
		if ($this->always_route)
		{
			$_REQUEST[$this->idvar] = $_GET[$this->idvar] = self::$request_uri;
		}
		else
		{
			$this->set_request(self::$request_uri);
		}

		$this->registry->input->convert_shortvars($_GET, true);
	}


	/**
	 * Render the friendly url.
	 *
	 * @example
	 * 	FRIENDLY_URL_OFF
	 *	showthread.php?t=1234&p=2
	 *
	 *	FRIENDLY_URL_BASIC
	 *	showthread.php?1234-Thread-Title/page2&pp=2
	 *
	 *	FRIENDLY_URL_ADVANCED
	 *	showthread.php/1234-Thread-Title/page2?pp=2
	 *
	 *	FRIENDLY_URL_REWRITE
	 *	/threads/1234-Thread-Title/page2?pp=2
	 *	RewriteRule ^/vb4/threads/([0-9]+)(?:/?$|(?:-[^/]+))(?:/?$|(?:/page([0-9]+)?)) /vb4/showthread.php?t=$1&page=$2 [QSA]
	 *
	 * @param int $method_override				- Force a Friendly URL method
	 * @param bool $canonical					- Whether to skip encoding for output
	 * @return string
	 */
	public function get_url($method_override = false, $canonical = false)
	{
		// Get the fragments
		$uri = $this->get_uri($canonical);

		// Check ampersand to use
		$amp = ($this->urloptions & SEO_JS) ? '&' : '&amp;';

		// Get the pageinfo arguments
		$query = $this->get_query();

		// Resolve method
		$method = (false !== $method_override) ? $method_override : $this->registry->options['friendlyurl'];

		// Get the appropriate url
		switch ($method)
		{
			case FRIENDLY_URL_BASIC:
				return $this->script . '?' . $uri . ($query ? $amp . $query : '');

			case FRIENDLY_URL_ADVANCED:
				return $this->script . '/' . $uri . ($query ? '?' . $query : '');

			case FRIENDLY_URL_REWRITE:
				return $this->rewrite_segment . '/' . $uri . ($query ? '?' . $query : '');

			case FRIENDLY_URL_OFF:
			default:
				return $this->script . '?' . $this->idvar . '=' . $this->id . ($this->page ? $amp . $this->pagevar . '=' . $this->page : '') . ($query ? $amp . $query : '');
		}

	}

	/**
	 * Redirects to our url if the given uri is not canonical.
	 *
	 * @param string $request_uri				- The current uri to check
	 */
	public function redirect_canonical_url($request_uri)
	{
		// Never redirect a post
		if ('GET' != $_SERVER['REQUEST_METHOD'])
		{
			return;
		}

		// Allow hooks to handle non canonical urls
		($hook = vBulletinHook::fetch_hook('friendlyurl_redirect_canonical')) ? eval($hook) : false;

		// Check if canonical enforcement is enabled
		if (self::CANON_OFF == $this->registry->options['friendlyurl_canonical'])
		{
			return;
		}

		// Only redirect guests and search engines
		if ($this->registry->userinfo['userid'] AND !$this->registry->options['friendlyurl_canonical_registered'])
		{
			return;
		}

		// Get the canonical uri
		if (!isset($canonical_uri))
		{
			// Get the canonical uri
			$canonical_uri = $this->get_uri(true);
		}

		// Whether the request was canonical
		$canonical = true;

		// Check Friendly URL method
		if (FRIENDLY_URL != $this->registry->options['friendlyurl'])
		{
			$canonical = false;
		}

		// Check URI
		if ($canonical AND (self::CANON_STRICT == $this->registry->options['friendlyurl_canonical']))
		{
			if ($request_uri != $canonical_uri)
			{
				$canonical = false;

				// request may have been in the current charset, try UTF-8.
				if ($canonical_uri == to_utf8($request_uri, $this->registry->userinfo['lang_charset']))
				{
					$canonical = true;
				}

				// request may have been in UTF-8, try current charset
				if ($request_uri == to_utf8($canonical_uri, $this->registry->userinfo['lang_charset']))
				{
					$canonical = true;
				}
			}
		}

		// Redirect if incorrect
		if (!$canonical)
		{
			// add the request query string to the pageinfo
			$this->consume_request_pageinfo();

			// redirect url must be raw
			$url = $this->get_url(false, true);
			$code = 301;

			// workaround for goto
			if (defined('THREADNEXT'))
			{
				$url = str_replace('&goto=nextnewest', '', str_replace('&goto=nextoldest', '',
						str_replace('?goto=nextnewest', '', str_replace('?goto=nextoldest', '', $url))));

				$code = 302;
			}

			// redirect to the correct url
			exec_header_redirect($url, $code);
		}
	}


	/**
	 * Set the request based on the given uri.
	 * @see vB_Friendly_Url::decode_friendly_url()
	 *
	 * The fragment given here is already decoded and should be used as is.
	 *
	 * @param string $uri
	 */
	protected function set_request($uri)
	{
		// Set the request based on the given uri
		$pat = '#^(\d+)#si';
		$matches = array();

		if (preg_match($pat, $uri, $matches))
		{
			$_REQUEST[$this->idvar] = $_GET[$this->idvar] = $matches[1];
		}
	}


	/**
	 * Removes bad $_GET variables that may be set by apache when using mod_rewrite.
	 * @see https://issues.apache.org/bugzilla/show_bug.cgi?id=34602
	 *
	 * When using mod_rewrite, the fragment is urldecoded before the QS is appended
	 * to the rewritten url.  If the fragment contains & then $_GET will be
	 * corrupted.
	 *
	 * This method checks the correct uri and resolves the correct values for $_GET.
	 *
	 * @param string $fragment					- The decoded fragment
	 */
	public function fix_query_string($uri)
	{
		static $fixed = false;

		if ($fixed)
		{
			return;
		}

		$fixed = true;

		// Probably also need to return if this is not apache
		if (FRIENDLY_URL_REWRITE != FRIENDLY_URL)
		{
			return;
		}

		$uri = parse_url($uri);
		$_SERVER['QUERY_STRING'] = $uri['query'];

		$_REQUEST = array_diff($_REQUEST, array_diff($_GET, $_POST, $_COOKIE));
		$_GET = array();

		if ($_SERVER['QUERY_STRING'])
		{
			// Get the query string
			parse_str($_SERVER['QUERY_STRING'], $query);

			$_GET = array_merge($_GET, $query);
			$_REQUEST = array_merge($_REQUEST, $_GET);
		}

		$this->registry->input->convert_shortvars($_REQUEST);
		$this->registry->input->convert_shortvars($_GET);
	}


	/**
	 * Fetches a friendly name for a FRIENDLY_URL method.
	 * Note: This is only for debugging so the names are unphrased.
	 *
	 * @param int $method						- The method to fetch a name for
	 * @return string							- The friendly name
	 */
	public static function getMethodName($method)
	{
		static $methods = array(
			FRIENDLY_URL_OFF => 'Off',
			FRIENDLY_URL_BASIC => 'Basic',
			FRIENDLY_URL_ADVANCED => 'Advanced',
			FRIENDLY_URL_REWRITE => 'Rewrite'
		);

		return (isset($methods[$method])) ? $methods[$method] : 'Unknown (' . $method . ')';
	}
}


/**
 * Base class for paged friendly urls.
 *
 * @package vBulletin
 * @author vBulletin Development Team
 * @version $Revision: 32878 $
 * @since $Date: 2009-10-28 18:38:49 +0000 (Wed, 28 Oct 2009) $
 * @copyright vBulletin Solutions Inc.
 */
abstract class vB_Friendly_Url_Paged extends vB_Friendly_Url
{
	/**
	 * The request var to use for the page number.
	 *
	 * @var string
	 */
	protected $pagevar = 'page';

	/**
	 * The current page.
	 *
	 * @var int
	 */
	protected $page;


	/**
	 * Checks whether to ignore a pageinfo element when building the uri.
	 *
	 * @param string $argument					- The argument to check
	 * @param bool $skip_pageinfo				- Whether to skip current pageinfo
	 * @return bool								- Whether to skip the argument
	 */
	protected function skip_query_var($argument, $skip_pageinfo = true)
	{
		if (in_array($argument, array('page', 'pagenumber')))
		{
			if ($this->registry->options['friendlyurl'] != FRIENDLY_URL_OFF)
			{
				return true;
			}
		}

		return parent::skip_query_var($argument, $skip_pageinfo);
	}


	/**
	 * Sets the pageinfo properties.
	 *
	 * @param array mixed $pageinfo
	 */
	protected function set_pageinfo(array $pageinfo)
	{
		if (isset($pageinfo['pagenumber']))
		{
			$this->page = $pageinfo['pagenumber'];
			unset($pageinfo['pagenumber']);
		}
		else if (isset($pageinfo['page']))
		{
			$this->page = $pageinfo['page'];
			unset($pageinfo['page']);
		}

		$this->page = max(0, intval($this->page));

		$this->pageinfo = $pageinfo;

		// Unset the uri as it's changed
		unset($this->uri);
	}


	/**
	 * Gets all of the fragments for the uri.
	 *
	 * @param bool $canonical							- If true, don't encode for output
	 * @return string
	 */
	public function get_uri($canonical = false)
	{
		if (isset($this->uri) AND !$canonical)
		{
			return $this->uri;
		}

		if (!$this->always_route AND (FRIENDLY_URL_OFF == $this->registry->options['friendlyurl']))
		{
			return false;
		}

		return $this->uri = $this->clean_fragment($this->id . '-' . $this->title, $canonical) . (($this->page > 1)? '/page' . $this->page : '');
	}


	/**
	 * Set the request based on the given uri.
	 * @see vB_Friendly_Url::decode_friendly_url()
	 *
	 * @param string $uri
	 */
	protected function set_request($uri)
	{
		$pat = '#^(\d+).*?(?:/page(\d+)|$)#si';
		$matches = array();

		if (preg_match($pat, $uri, $matches))
		{
			$_REQUEST[$this->idvar] = $_GET[$this->idvar] = $matches[1];

			if ($matches[2])
			{
				$_REQUEST[$this->pagevar] = $_GET[$this->pagevar] = intval($matches[2]);
			}
		}
	}
}


/**
 * Friendly URL class to use for errors.
 * This is used when an appropriate class could not be resolved.
 * @see vB_Friendly_Url::fetchLibrary()
 *
 * @package vBulletin
 * @author vBulletin Development Team
 * @version $Revision: 32878 $
 * @since $Date: 2009-10-28 18:38:49 +0000 (Wed, 28 Oct 2009) $
 * @copyright vBulletin Solutions Inc.
 */
class vB_Friendly_Url_Error
{
	/**
	* Constructor
	*
	* @return	void
	*/
	public function __construct($link)
	{
		$this->link = $link;
	}

	/**
	* Generic error
	*
	* @return	string
	*/
	public function output()
	{
		global $vbulletin, $vbphrase;

		if ($vbulletin->debug)
		{
			return construct_phrase($vbphrase['invalid_link_type'], htmlspecialchars_uni($this->link));
		}

		return '';
	}
}


/**
 * Friendly URL for showthread.php
 *
 * @package vBulletin
 * @author vBulletin Development Team
 * @version $Revision: 32878 $
 * @since $Date: 2009-10-28 18:38:49 +0000 (Wed, 28 Oct 2009) $
 * @copyright vBulletin Solutions Inc.
 */
class vB_Friendly_Url_Thread extends vB_Friendly_Url_Paged
{
	/**
	 * The request variable for the resource id.
	 *
	 * @var string
	 */
	protected $idvar = 't';

	/**
	 * Link info index of the resource id.
	 *
	 * @var string
	 */
	protected $idkey = 'threadid';

	/**
	 * Array of pageinfo vars to ignore when building the uri.
	 *
	 * @var array string
	 */
	protected $ignorelist = array('t', 'threadid');

	/**
	 * The name of the script that the URL links to.
	 *
	 * @var string
	 */
	protected $script = 'showthread.php';

	/**
	 * The segment of the uri that identifies this type.
	 *
	 * @var string
	 */
	protected $rewrite_segment = 'threads';
}

/**
 * Friendly URL for showpost.php
 *
 * @package vBulletin
 * @author vBulletin Development Team
 * @version $Revision: 32878 $
 * @since $Date: 2009-10-28 18:38:49 +0000 (Wed, 28 Oct 2009) $
 * @copyright vBulletin Solutions Inc.
 */
class vB_Friendly_Url_Post extends vB_Friendly_Url
{
	/**
	 * The request variable for the resource id.
	 *
	 * @var string
	 */
	protected $idvar = 'p';

	/**
	 * Link info index of the resource id.
	 *
	 * @var string
	 */
	protected $idkey = 'postid';

	/**
	 * Link info index of the title.
	 *
	 * @var string
	 */
	protected $titlekey = 'title';

	/**
	 * Array of pageinfo vars to ignore when building the uri.
	 *
	 * @var array string
	 */
	protected $ignorelist = array('p', 'postid', 'title');

	/**
	 * The name of the script that the URL links to.
	 *
	 * @var string
	 */
	protected $script = 'showpost.php';

	/**
	 * The segment of the uri that identifies this type.
	 *
	 * @var string
	 */
	protected $rewrite_segment = 'post';
}


/**
 * Friendly URL for member.php
 *
 * @package vBulletin
 * @author vBulletin Development Team
 * @version $Revision: 32878 $
 * @since $Date: 2009-10-28 18:38:49 +0000 (Wed, 28 Oct 2009) $
 * @copyright vBulletin Solutions Inc.
 */
class vB_Friendly_Url_Member extends vB_Friendly_Url
{
	/**
	 * The request variable for the resource id.
	 *
	 * @var string
	 */
	protected $idvar = 'u';

	/**
	 * Link info index of the resource id.
	 *
	 * @var string
	 */
	protected $idkey = 'userid';

	/**
	 * Link info index of the title.
	 *
	 * @var string
	 */
	protected $titlekey = 'username';

	/**
	 * Array of pageinfo vars to ignore when building the uri.
	 *
	 * @var array string
	 */
	protected $ignorelist = array('u', 'userid', 'username');

	/**
	 * The name of the script that the URL links to.
	 *
	 * @var string
	 */
	protected $script = 'member.php';

	/**
	 * The segment of the uri that identifies this type.
	 *
	 * @var string
	 */
	protected $rewrite_segment = 'members';
}


/**
 * Friendly URL for forumdisplay.php
 *
 * @package vBulletin
 * @author vBulletin Development Team
 * @version $Revision: 32878 $
 * @since $Date: 2009-10-28 18:38:49 +0000 (Wed, 28 Oct 2009) $
 * @copyright vBulletin Solutions Inc.
 */
class vB_Friendly_Url_Forum extends vB_Friendly_Url_Paged
{
	/**
	 * The request variable for the resource id.
	 *
	 * @var string
	 */
	protected $idvar = 'f';

	/**
	 * Link info index of the resource id.
	 *
	 * @var string
	 */
	protected $idkey = 'forumid';

	/**
	 * Array of pageinfo vars to ignore when building the uri.
	 *
	 * @var array string
	 */
	protected $ignorelist = array('f', 'forumid');

	/**
	 * The name of the script that the URL links to.
	 *
	 * @var string
	 */
	protected $script = 'forumdisplay.php';

	/**
	 * The segment of the uri that identifies this type.
	 *
	 * @var string
	 */
	protected $rewrite_segment = 'forums';
}


/**
 * Friendly URL for blog.php
 *
 * @package vBulletin
 * @author vBulletin Development Team
 * @version $Revision: 32878 $
 * @since $Date: 2009-10-28 18:38:49 +0000 (Wed, 28 Oct 2009) $
 * @copyright vBulletin Solutions Inc.
 */
class vB_Friendly_Url_Blog extends vB_Friendly_Url_Paged
{
	/**
	 * The request variable for the resource id.
	 *
	 * @var string
	 */
	protected $idvar = 'u';

	/**
	 * Link info index of the resource id.
	 *
	 * @var string
	 */
	protected $idkey = 'userid';

	/**
	 * Link info index of the title.
	 *
	 * @var string
	 */
	protected $titlekey = 'blog_title';

	/**
	 * Array of pageinfo vars to ignore when building the uri.
	 *
	 * @var array string
	 */
	protected $ignorelist = array('u', 'userid', 'b', 'blogid');

	/**
	 * The name of the script that the URL links to.
	 *
	 * @var string
	 */
	protected $script = 'blog.php';

	/**
	 * The segment of the uri that identifies this type.
	 *
	 * @var string
	 */
	protected $rewrite_segment = 'blogs';
}


/**
 * Friendly URL for entry.php
 *
 * @package vBulletin
 * @author vBulletin Development Team
 * @version $Revision: 32878 $
 * @since $Date: 2009-10-28 18:38:49 +0000 (Wed, 28 Oct 2009) $
 * @copyright vBulletin Solutions Inc.
 */
class vB_Friendly_Url_Entry extends vB_Friendly_Url_Paged
{
	/**
	 * The request variable for the resource id.
	 *
	 * @var string
	 */
	protected $idvar = 'b';

	/**
	 * Link info index of the resource id.
	 *
	 * @var string
	 */
	protected $idkey = 'blogid';

	/**
	 * Array of pageinfo vars to ignore when building the uri.
	 *
	 * @var array string
	 */
	protected $ignorelist = array('b', 'blogid');

	/**
	 * The name of the script that the URL links to.
	 *
	 * @var string
	 */
	protected $script = 'entry.php';

	/**
	 * The segment of the uri that identifies this type.
	 *
	 * @var string
	 */
	protected $rewrite_segment = 'entries';
}


/**
 * Friendly URL for vBCms
 *
 * @TODO: Resolve the properties automatically.
 *
 * @package vBulletin
 * @author vBulletin Development Team
 * @version $Revision: 32878 $
 * @since $Date: 2009-10-28 18:38:49 +0000 (Wed, 28 Oct 2009) $
 * @copyright vBulletin Solutions Inc.
 */
class vB_Friendly_Url_vBCms extends vB_Friendly_Url
{
	/**
	 * Array of pageinfo vars to ignore when building the uri.
	 *
	 * @var array string
	 */
	protected $ignorelist = array();

	/**
	 * The name of the script that the URL links to.
	 *
	 * @var string
	 */
	protected $script;

	/**
	 * The segment of the uri that identifies this type.
	 *
	 * @var string
	 */
	protected $rewrite_segment;


	/**
	 * Whether to use the friendly uri in POST requests.
	 *
	 * @var bool
	 */
	protected $parse_post = true;

	/**
	 * Whether to always set the route, even if friendly urls are off.
	 *
	 * @var bool
	 */
	protected $always_route = true;


	/**
	 * Constructor.
	 *
	 * @param vB_Registry $registry				- Reference to the vBulletin registry
	 * @param array $linkinfo					- Info about the link, the id, title etc
	 * @param array $pageinfo					- Additional info about the required request; pagenumber and query string
	 * @param string $idkey						- Override the key in $linkinfo for the resource id
	 * @param string $titlekey					- Override the key in $linkinfo for the resource title
	 * @param int $urloptions					- Bitfield of environment options SEO_NOSESSION, SEO_JS, etc
	 */
	protected function __construct(&$registry, array $linkinfo = null, array $pageinfo = null, $idkey = false, $titlekey = false, $urloptions = 0)
	{
		$this->idvar = $this->ignorelist[] = $registry->options['route_requestvar'];
		$this->script = basename(SCRIPT);

		parent::__construct($registry, $linkinfo, $pageinfo, $idkey, $titlekey, $urloptions);
	}
}

/*======================================================================*\
|| ####################################################################
|| #
|| # CVS: $RCSfile$ - $Revision: 27657 $
|| ####################################################################
\*======================================================================*/