<?php

// Language Switcher Class
// Patchesoft 2015 Copyrighted

class Language_Switcher 
{

	public function switch_lang() 
	{
		// Get CI
		$CFG =& load_class('Config', 'core');
		// Check session
		if(!isset($_COOKIE['language'])) return;
		$lang = strip_tags($_COOKIE["language"]);

		$languages = $CFG->item("available_languages");

		if(!in_array($lang, $languages, TRUE)) return;

		if(empty($lang)) return;
		$CFG->set_item('language', $lang);

	}

}

?>