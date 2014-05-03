<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
session_start();
/**
* Session class using native PHP session features and hardened against session fixation.
*
* @package     CodeIgniter
* @subpackage  Libraries
* @category    Sessions
* @author      Dariusz Debowczyk
* @link        http://www.codeigniter.com/user_guide/libraries/sessions.html
*/
class CI_Session {

	var $flash_key = 'flash'; // prefix for "flash" variables (eg. flash:new:message)

	var $sess_encrypt_cookie		= FALSE;
	var $sess_use_database			= FALSE;
	var $sess_table_name			= '';
	var $sess_expiration			= 7200;
	var $sess_expire_on_close		= FALSE;
	var $sess_match_ip				= FALSE;
	var $sess_match_useragent		= TRUE;
	var $sess_cookie_name			= 'ci_session';
	var $cookie_prefix				= '';
	var $cookie_path				= '';
	var $cookie_domain				= '';
	var $cookie_secure				= FALSE;
	var $sess_time_to_update		= 300;
	var $encryption_key				= '';
	var $flashdata_key				= 'flash';
	var $time_reference				= 'time';
	var $gc_probability				= 5;
	var $userdata					= array();
	var $CI;
	var $now;

	/**
	 * Session Constructor
	 *
	 * The constructor runs the session routines automatically
	 * whenever the class is instantiated.
	 */
	public function __construct($params = array())
	{
		log_message('debug', "Session Class Initialized");

		// Set the super object to a local variable for use throughout the class
		$this->CI =& get_instance();

		// Set all the session preferences, which can either be set
		// manually via the $params array above or via the config file
		foreach (array('sess_encrypt_cookie', 'sess_use_database', 'sess_table_name', 'sess_expiration', 'sess_expire_on_close', 'sess_match_ip', 'sess_match_useragent', 'sess_cookie_name', 'cookie_path', 'cookie_domain', 'cookie_secure', 'sess_time_to_update', 'time_reference', 'cookie_prefix', 'encryption_key') as $key)
		{
			$this->$key = (isset($params[$key])) ? $params[$key] : $this->CI->config->item($key);
		}

		if ($this->encryption_key == '')
		{
			show_error('In order to use the Session class you are required to set an encryption key in your config file.');
		}

		// Load the string helper so we can use the strip_slashes() function
		$this->CI->load->helper('string');

		// Do we need encryption? If so, load the encryption class
		if ($this->sess_encrypt_cookie == TRUE)
		{
			$this->CI->load->library('encrypt');
		}

		// Are we using a database?  If so, load it
		if ($this->sess_use_database === TRUE AND $this->sess_table_name != '')
		{
			$this->CI->load->database();
		}

		// Set the "now" time.  Can either be GMT or server time, based on the
		// config prefs.  We use this to set the "last activity" time
		$this->now = $this->_get_time();

		// Set the session length. If the session expiration is
		// set to zero we'll set the expiration two years from now.
		if ($this->sess_expiration == 0)
		{
			$this->sess_expiration = (60*60*24*365*2);
		}

		// Set the cookie name
		$this->sess_cookie_name = $this->cookie_prefix.$this->sess_cookie_name;

		// Run the Session routine. If a session doesn't exist we'll
		// create a new one.  If it does, we'll update it.
		if ( ! $this->sess_read())
		{
			$this->sess_create();
		}
		else
		{
			$this->sess_update();
		}

		// Delete 'old' flashdata (from last request)
		$this->_flashdata_sweep();

		// Mark all new flashdata as old (data will be deleted before next request)
		$this->_flashdata_mark();

		// Delete expired sessions if necessary
		$this->_sess_gc();

		log_message('debug', "Session routines successfully run");
	}
	/**
    * Regenerates session id
    */
	function regenerate_id()
	{
		// copy old session data, including its id
		$old_session_id = session_id();
		$old_session_data = $_SESSION;

		// regenerate session id and store it
		session_regenerate_id();
		$new_session_id = session_id();

		// switch to the old session and destroy its storage
		session_id($old_session_id);
		session_destroy();

		// switch back to the new session id and send the cookie
		session_id($new_session_id);
		session_start();

		// restore the old session data into the new session
		$_SESSION = $old_session_data;

		// update the session creation time
		$_SESSION['regenerated'] = time();

		// session_write_close() patch based on this thread
		// http://www.codeigniter.com/forums/viewthread/1624/
		// there is a question mark ?? as to side affects

		// end the current session and store session data.
		session_write_close();
	}

	/**
    * Destroys the session and erases session storage
    */
	function destroy()
	{
		unset($_SESSION);
		if ( isset( $_COOKIE[session_name()] ) )
		{
			setcookie(session_name(), '', time()-42000, '/');
		}
		session_destroy();
	}

	/**
    * Reads given session attribute value
    */    
	function userdata($item)
	{
		if($item == 'session_id'){ //added for backward-compatibility
			return session_id();
		}else{
			return ( ! isset($_SESSION[$item])) ? false : $_SESSION[$item];
		}
	}

	/**
    * Sets session attributes to the given values
    */
	function set_userdata($newdata = array(), $newval = '')
	{
		if (is_string($newdata))
		{
			$newdata = array($newdata => $newval);
		}

		if (count($newdata) > 0)
		{
			foreach ($newdata as $key => $val)
			{
				$_SESSION[$key] = $val;
			}
		}
	}

	/**
    * Erases given session attributes
    */
	function unset_userdata($newdata = array())
	{
		if (is_string($newdata))
		{
			$newdata = array($newdata => '');
		}

		if (count($newdata) > 0)
		{
			foreach ($newdata as $key => $val)
			{
				unset($_SESSION[$key]);
			}
		}
	}

	/**
    * Starts up the session system for current request
    */
	function _sess_run()
	{
		session_start();

		$session_id_ttl = $this->object->config->item('sess_expiration');

		if (is_numeric($session_id_ttl))
		{
			if ($session_id_ttl > 0)
			{
				$this->session_id_ttl = $this->object->config->item('sess_expiration');
			}
			else
			{
				$this->session_id_ttl = (60*60*24*365*2);
			}
		}

		// check if session id needs regeneration
		if ( $this->_session_id_expired() )
		{
			// regenerate session id (session data stays the
			// same, but old session storage is destroyed)
			$this->regenerate_id();
		}

		// delete old flashdata (from last request)
		$this->_flashdata_sweep();

		// mark all new flashdata as old (data will be deleted before next request)
		$this->_flashdata_mark();
	}

	/**
    * Checks if session has expired
    */
	function _session_id_expired()
	{
		if ( !isset( $_SESSION['regenerated'] ) )
		{
			$_SESSION['regenerated'] = time();
			return false;
		}

		$expiry_time = time() - $this->session_id_ttl;

		if ( $_SESSION['regenerated'] <=  $expiry_time )
		{
			return true;
		}

		return false;
	}

	/**
    * Sets "flash" data which will be available only in next request (then it will
    * be deleted from session). You can use it to implement "Save succeeded" messages
    * after redirect.
    */
	function set_flashdata($key, $value)
	{
		$flash_key = $this->flash_key.':new:'.$key;
		$this->set_userdata($flash_key, $value);
	}

	/**
    * Keeps existing "flash" data available to next request.
    */
	function keep_flashdata($key)
	{
		$old_flash_key = $this->flash_key.':old:'.$key;
		$value = $this->userdata($old_flash_key);

		$new_flash_key = $this->flash_key.':new:'.$key;
		$this->set_userdata($new_flash_key, $value);
	}

	/**
    * Returns "flash" data for the given key.
    */
	function flashdata($key)
	{
		$flash_key = $this->flash_key.':old:'.$key;
		return $this->userdata($flash_key);
	}

	/**
    * PRIVATE: Internal method - marks "flash" session attributes as 'old'
    */
	function _flashdata_mark()
	{
		foreach ($_SESSION as $name => $value)
		{
			$parts = explode(':new:', $name);
			if (is_array($parts) && count($parts) == 2)
			{
				$new_name = $this->flash_key.':old:'.$parts[1];
				$this->set_userdata($new_name, $value);
				$this->unset_userdata($name);
			}
		}
	}

	/**
    * PRIVATE: Internal method - removes "flash" session marked as 'old'
    */
	function _flashdata_sweep()
	{
		foreach ($_SESSION as $name => $value)
		{
			$parts = explode(':old:', $name);
			if (is_array($parts) && count($parts) == 2 && $parts[0] == $this->flash_key)
			{
				$this->unset_userdata($name);
			}
		}
	}
	function sess_destroy()
    {

        // Kill the session DB row

        if ($this->sess_use_database === true && isset($this->userdata['session_id'])) {

            $this->CI->db->where('session_id', $this->userdata['session_id']);

            $this->CI->db->delete($this->sess_table_name);

        }


        // Kill the cookie

        setcookie($this->sess_cookie_name, addslashes(serialize(array())), ($this->now -
            31500000), $this->cookie_path, $this->cookie_domain, 0);


        // Kill session data

        $this->userdata = array();

    }
	function _get_time()
	{
		if (strtolower($this->time_reference) == 'gmt')
		{
			$now = time();
			$time = mktime(gmdate("H", $now), gmdate("i", $now), gmdate("s", $now), gmdate("m", $now), gmdate("d", $now), gmdate("Y", $now));
		}
		else
		{
			$time = time();
		}

		return $time;
	}
	function sess_read()
	{
		// Fetch the cookie
		$session = $this->CI->input->cookie($this->sess_cookie_name);

		// No cookie?  Goodbye cruel world!...
		if ($session === FALSE)
		{
			log_message('debug', 'A session cookie was not found.');
			return FALSE;
		}

		// Decrypt the cookie data
		if ($this->sess_encrypt_cookie == TRUE)
		{
			$session = $this->CI->encrypt->decode($session);
		}
		else
		{
			// encryption was not used, so we need to check the md5 hash
			$hash	 = substr($session, strlen($session)-32); // get last 32 chars
			$session = substr($session, 0, strlen($session)-32);

			// Does the md5 hash match?  This is to prevent manipulation of session data in userspace
			if ($hash !==  md5($session.$this->encryption_key))
			{
				log_message('error', 'The session cookie data did not match what was expected. This could be a possible hacking attempt.');
				$this->sess_destroy();
				return FALSE;
			}
		}

		// Unserialize the session array
		$session = $this->_unserialize($session);

		// Is the session data we unserialized an array with the correct format?
		if ( ! is_array($session) OR ! isset($session['session_id']) OR ! isset($session['ip_address']) OR ! isset($session['user_agent']) OR ! isset($session['last_activity']))
		{
			$this->sess_destroy();
			return FALSE;
		}

		// Is the session current?
		if (($session['last_activity'] + $this->sess_expiration) < $this->now)
		{
			$this->sess_destroy();
			return FALSE;
		}

		// Does the IP Match?
		if ($this->sess_match_ip == TRUE AND $session['ip_address'] != $this->CI->input->ip_address())
		{
			$this->sess_destroy();
			return FALSE;
		}

		// Does the User Agent Match?
		if ($this->sess_match_useragent == TRUE AND trim($session['user_agent']) != trim(substr($this->CI->input->user_agent(), 0, 120)))
		{
			$this->sess_destroy();
			return FALSE;
		}

		// Is there a corresponding session in the DB?
		if ($this->sess_use_database === TRUE)
		{
			$this->CI->db->where('session_id', $session['session_id']);

			if ($this->sess_match_ip == TRUE)
			{
				$this->CI->db->where('ip_address', $session['ip_address']);
			}

			if ($this->sess_match_useragent == TRUE)
			{
				$this->CI->db->where('user_agent', $session['user_agent']);
			}

			$query = $this->CI->db->get($this->sess_table_name);

			// No result?  Kill it!
			if ($query->num_rows() == 0)
			{
				$this->sess_destroy();
				return FALSE;
			}

			// Is there custom data?  If so, add it to the main session array
			$row = $query->row();
			if (isset($row->user_data) AND $row->user_data != '')
			{
				$custom_data = $this->_unserialize($row->user_data);

				if (is_array($custom_data))
				{
					foreach ($custom_data as $key => $val)
					{
						$session[$key] = $val;
					}
				}
			}
		}

		// Session is valid!
		$this->userdata = $session;
		unset($session);

		return TRUE;
	}
	function sess_create()
	{
		$sessid = '';
		while (strlen($sessid) < 32)
		{
			$sessid .= mt_rand(0, mt_getrandmax());
		}

		// To make the session ID even more secure we'll combine it with the user's IP
		$sessid .= $this->CI->input->ip_address();

		$this->userdata = array(
							'session_id'	=> md5(uniqid($sessid, TRUE)),
							'ip_address'	=> $this->CI->input->ip_address(),
							'user_agent'	=> substr($this->CI->input->user_agent(), 0, 120),
							'last_activity'	=> $this->now,
							'user_data'		=> ''
							);


		// Save the data to the DB if needed
		if ($this->sess_use_database === TRUE)
		{
			$this->CI->db->query($this->CI->db->insert_string($this->sess_table_name, $this->userdata));
		}

		// Write the cookie
		$this->_set_cookie();
	}
	function _set_cookie($cookie_data = NULL)
	{
		if (is_null($cookie_data))
		{
			$cookie_data = $this->userdata;
		}

		// Serialize the userdata for the cookie
		$cookie_data = $this->_serialize($cookie_data);

		if ($this->sess_encrypt_cookie == TRUE)
		{
			$cookie_data = $this->CI->encrypt->encode($cookie_data);
		}
		else
		{
			// if encryption is not used, we provide an md5 hash to prevent userside tampering
			$cookie_data = $cookie_data.md5($cookie_data.$this->encryption_key);
		}

		$expire = ($this->sess_expire_on_close === TRUE) ? 0 : $this->sess_expiration + time();

		// Set the cookie
		setcookie(
					$this->sess_cookie_name,
					$cookie_data,
					$expire,
					$this->cookie_path,
					$this->cookie_domain,
					$this->cookie_secure
				);
	}
	function _serialize($data)
	{
		if (is_array($data))
		{
			foreach ($data as $key => $val)
			{
				if (is_string($val))
				{
					$data[$key] = str_replace('\\', '{{slash}}', $val);
				}
			}
		}
		else
		{
			if (is_string($data))
			{
				$data = str_replace('\\', '{{slash}}', $data);
			}
		}

		return serialize($data);
	}
	function _sess_gc()
	{
		if ($this->sess_use_database != TRUE)
		{
			return;
		}

		srand(time());
		if ((rand() % 100) < $this->gc_probability)
		{
			$expire = $this->now - $this->sess_expiration;

			$this->CI->db->where("last_activity < {$expire}");
			$this->CI->db->delete($this->sess_table_name);

			log_message('debug', 'Session garbage collection performed.');
		}
	}
	function _unserialize($data)
	{
		$data = @unserialize(strip_slashes($data));

		if (is_array($data))
		{
			foreach ($data as $key => $val)
			{
				if (is_string($val))
				{
					$data[$key] = str_replace('{{slash}}', '\\', $val);
				}
			}

			return $data;
		}

		return (is_string($data)) ? str_replace('{{slash}}', '\\', $data) : $data;
	}
}
?>