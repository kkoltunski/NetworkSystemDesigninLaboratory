<?php

namespace app\transfer;

use core\App;
use core\Utils;

class PaginationInfo{
	public $firstPage;
	public $lastPage;
	public $currentPage;

	public $dbFrom;
	public $dbTo;

	public $maxPagesToShow;
	public $recordsCountOnPage;
	
	public function __construct()
	{
		$this->maxPagesToShow = 3;
		$this->recordsCountOnPage = 2;
	}

	public function updateSelection($selected, $totalCount)
	{
		$this->firstPage = 0;
		$this->lastPage = floor($totalCount / $this->recordsCountOnPage);

		if($selected > $this->lastPage)
		{
			$this->currentPage = $this->lastPage;
			
		}
		else if($selected < $this->firstPage)
		{
			$this->currentPage = $this->firstPage;
		}
		else
		{
			$this->currentPage = $selected;
		}

		$this->dbFrom = $this->currentPage * $this->recordsCountOnPage;
		$this->dbTo = $this->recordsCountOnPage;
	}
}