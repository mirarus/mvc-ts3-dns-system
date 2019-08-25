<?php
/**
* Validation class
*/
class Validation extends Validation_Core
{
	// These function are part of the default $steps array to help you
	// illustrate how this script works. Feel free to delete them.

	function validate_system_path($value, $params = array())
	{
		if ( !is_file(rtrim($value, '/').'/core/config.php') || !is_writable(rtrim($value, '/').'/core/config.php') ) {
			$this->error = rtrim($value, '/').'/core/config.php dosya mevcut değil veya yazılabilir değil.';
			return false;
		}

		return true;
	}

}
