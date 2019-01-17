<?php
class Pagination {
	public $page = 1;
	public $limit = 20;
	public $total = 0;
	public $num_links = 8;
	public $url = '';
	public $ulcssc = 'pagination';
	public $licssc = 'active';
	public $text_first = '|&lt;';
	public $text_last = '&gt;|';
	public $text_next = '&gt;';
	public $text_prev = '&lt;';

    public function sqlLimit() {
        return 'LIMIT '.(($this->page*$this->limit)-$this->limit).', '.(1*$this->limit);
    }

    public function getSqlLimitStart() {
        return (($this->page*$this->limit)-$this->limit);
    }

    public function render() {
        $total = $this->total;
        $limit = $this->limit;
        $num_links = $this->num_links;
        $num_pages = ceil($total / $limit);

		if ($this->page < 1) {
			$page = 1;
		} elseif ($this->page > $num_pages) {
		    $page = $num_pages;
        } else {
			$page = $this->page;
		}

		$this->url = str_replace('%7Bpage%7D', '{page}', $this->url);

		$output = '<ul class="'.$this->ulcssc.'">';

		if ($page > 1) {
            $output .= '<li><a href="' . str_replace('{page}', 1, $this->url) . '">' . $this->text_first . '</a></li>';
			if ($page - 1 === 1) {
                $output .= '<li><a href="' . str_replace('{page}', 1, $this->url) . '">' . $this->text_prev . '</a></li>';
			} else {
                $output .= '<li><a href="' . str_replace('{page}', $page - 1, $this->url) . '">' . $this->text_prev . '</a></li>';
			}
		}

		if ($num_pages > 1) {
			if ($num_pages <= $num_links) {
				$start = 1;
				$end = $num_pages;
			} else {
				$start = $page - floor($num_links / 2);
				$end = $page + floor($num_links / 2);

				if ($start < 1) {
					$end += abs($start) + 1;
					$start = 1;
				}

				if ($end > $num_pages) {
					$start -= ($end - $num_pages);
					$end = $num_pages;
				}
			}

			for ($i = $start; $i <= $end; $i++) {
				if ($page == $i) {
					$output .= '<li class="'.$this->licssc.'"><span>' . $i . '</span></li>';
				} else {
                    $output .= '<li><a href="' . str_replace('{page}', $i, $this->url) . '">' . $i . '</a></li>';
				}
			}
		}

		if ($page < $num_pages) {
			$output .= '<li><a href="' . str_replace('{page}', $page + 1, $this->url) . '">' . $this->text_next . '</a></li>';
			$output .= '<li><a href="' . str_replace('{page}', $num_pages, $this->url) . '">' . $this->text_last . '</a></li>';
		}

		$output .= '</ul>';

		if ($num_pages > 1) {
			return $output;
		} else {
			return '';
		}
	}
}
