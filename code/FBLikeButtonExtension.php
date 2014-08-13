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
	private static $default_button_config = array(
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
	private static $application_id;


	/**
	 * @return string
	 */
	protected function getAppID() {
		if (class_exists('OpenGraph')) {
			return OpenGraph::get_config('application_id');
		} else {
			return Config::inst()->get('FBLikeButtonExtension', 'application_id');
		}
	}


	/**
	 * @return array
	 */
	protected function getButtonConfig() {
		if ($this->getOwner()->hasMethod('getFBLikeButtonConfig')) {
			$cfg = $this->getOwner()->getFBLikeButtonConfig();
		} else {
			$cfg = Config::inst()->get('FBLikeButtonExtension', 'default_button_config');
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
		if (!isset($cfg['href'])) $cfg['href'] = $this->getOwner()->AbsoluteLink();

		$str = '<div class="fb-like"';
		foreach ($cfg as $k => $v) {
			$str .= ' data-' . str_replace('_', '-', $k) . '="' . Convert::raw2att($v) . '"';
		}
		$str .= '></div>';

		return $str;
	}

	/**
	 * Just an alternate template tag if you'd prefer more specificity
	 * @return string
	 */
	public function FacebookLikeButton() {
		return $this->LikeButton();
	}


	/**
	 * Twitter sharing is so easy it doesn't even need it's own module, really
	 * so I'm sticking this here in case it's helpful.
	 * @return string
	 */
	public function TwitterShareButton() {
		Requirements::customScript("!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');", 'twitterJS');
		return '<a href="https://twitter.com/share" class="twitter-share-button" data-url="' . $this->getOwner()->AbsoluteLink() . '" data-text="' . Convert::raw2att($this->ShareText()) . '">Tweet</a>';
	}

	/**
	 * @return string
	 */
	protected function ShareText() {
		if ($this->getOwner()->hasMethod('getShareText')) {
			return $this->getOwner()->getShareText();
		} else {
			return $this->getOwner()->Title;
		}
	}
}
