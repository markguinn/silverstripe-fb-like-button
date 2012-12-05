<?php
/**
 *
 *
 * @author Mark Guinn <mark@adaircreative.com>
 * @date 12.05.2012
 * @package silverstripe-facebook-like
 */
class FBLikeButtonExtension extends SiteTreeExtension
{
	public static $default_button_config = array(
		'action'		=> 'like',
		'colorscheme'	=> 'light',
		'send'			=> 'false',
		'show_faces'	=> 'false',
		'width'			=> '450',
		'layout'		=> 'standard',
	);

	/**
	 * @var static string - only needed if not using the silverstripe-opengraph module
	 */
	public static $application_id;


	/**
	 * @return string
	 */
	protected function getAppID() {
		if (class_exists('OpenGraph')) {
			return OpenGraph::get_config('application');
		} else {
			return self::$application_id;
		}
	}


	/**
	 * @return array
	 */
	protected function getButtonConfig() {
		$cfg = self::$default_button_config;

		if ($this->getOwner()->hasMethod('getFBLikeButtonConfig')) {
			$cfg = $this->getOwner()->getFBLikeButtonConfig();
		}

		return $cfg;
	}


	/**
	 * Should be included in the template immediately after the body tag
	 * @return string
	 */
	public function FacebookJSSDK() {
		$appID = $this->getAppID();
		return <<<HTML
				<div id="fb-root"></div>
				<script>(function(d, s, id) {
				  var js, fjs = d.getElementsByTagName(s)[0];
				  if (d.getElementById(id)) return;
				  js = d.createElement(s); js.id = id;
				  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId={$appID}";
				  fjs.parentNode.insertBefore(js, fjs);
				}(document, 'script', 'facebook-jssdk'));</script>
HTML
		;
	}


	/**
	 * Should be used in the template wherever the like button is placed
	 * @return string
	 */
	public function LikeButton() {
		$cfg = $this->getButtonConfig();
		$str = '<div class="fb-like"';
		foreach ($cfg as $k => $v) {
			$str .= ' data-' . str_replace('_', '-', $k) . '="' . Convert::raw2att($v) . '"';
		}
		$str .= '></div>';
		return $str;
	}

}
