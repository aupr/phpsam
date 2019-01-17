<?php
class Url {
	private $url;
	private $ssl;

	public function __construct($url, $ssl = '') {
		$this->url = $url;
		$this->ssl = $ssl;
	}

	public function api($route, $args = '', $secure = false) {
		if ($this->ssl && $secure) {
			$url = $this->ssl . '?api=' . $route;
		} else {
			$url = $this->url . '?api=' . $route;
		}
		
		if ($args) {
			if (is_array($args)) {
				$url .= '&amp;' . http_build_query($args);
			} else {
				$url .= str_replace('&', '&amp;', '&' . ltrim($args, '&'));
			}
		}

		return $url; 
	}

    public function transfer($route, $args = '', $secure = false) {
        if ($this->ssl && $secure) {
            $url = $this->ssl . '?transfer=' . $route;
        } else {
            $url = $this->url . '?transfer=' . $route;
        }

        if ($args) {
            if (is_array($args)) {
                $url .= '&amp;' . http_build_query($args);
            } else {
                $url .= str_replace('&', '&amp;', '&' . ltrim($args, '&'));
            }
        }

        return $url;
    }
}
