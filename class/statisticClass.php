<?php
class statistic {
	public $date_start;
	public $date_end;
	public $message;
	public $err;
	private $file_name;
	private $link;
	private $end_day = 86399;
	
	function __construct($args) {
		$this->date_start = self::clear($args["start"]);
		$this->date_end = self::clear($args["end"]) + $this->end_day;
		$this->link = $args["link"];
		$this->file_name = $args["file"];
		
		if ($this->date_start == $this->date_end) {
			$this->date_end = $this->date_end + $this->$end_day;
		}
		if (!$this->date_start) {
			$this->message[] = "No start date";
		}
		if (!$this->date_end) {
			$this->message[] = "No end date";
		}
		if ($this->date_start > $this->date_end) {
			$this->message[] = "Start date cannot be more end date";		
		}
		if (!count($this->message)) {
			$this->message[] = "Okay";
		}
	}
	
	function getMessage() {
		return $this->message;
	}
	
	function getErr() {
		return $this->err;
	}
	
	function clear($a) {
		$r = (int)trim(strip_tags($a));
		return $r;
	}
	
	function getInfoSimple() {
		$data["start"] = date("d.m.Y H:i:s",$this->date_start);
		$data["end"] = date("d.m.Y H:i:s",$this->date_end);
		return $data;
	}
	
	function readFileStatistic() {
		/*
			the file stores information in this format
			$f[1595203200] = 123;
			$f[1595289600] = 14;
			$f[1595376000] = 56;
			$f[1595462400] = 98;
			serialize($f);
			
			where key = date timestamp
			where data = number users in this day
		*/
		$i = unserialize(file_get_contents($this->file_name));
		return $i;
	}
	
	function readMysqlStatistic() {
		/*
			format
			$m[1595203200] = 123;
			$m[1595289600] = 14;
			$m[1595376000] = 56;
			$m[1595462400] = 98;
		*/		
		$result = mysqli_query($this->link,"SELECT * FROM statistics");
		while($data = mysqli_fetch_array($result)) {
			$info[$data["datas"]] = $data["numbers"];
		}	
		return $info;		
	}
	
	function readGoogleStatistic() {
		/*
			get google analitics statistic and unified format
		*/			
		$g[1595192400] = 1232;
		$g[1595278800] = 33;
		$g[1595365200] = 66;
		$g[1595451600] = 77;		
	
		return $g;		
	}	
	
	function getStat($qq) {
		foreach ($qq as $key=>$data) {
			if ($this->date_start <= $key && $this->date_end >= $key) {
				$all_statistic = $all_statistic + $data;
			}
		}
		return $all_statistic;
	}

	function getInfoAll() {
		$x = self::getStat(self::readFileStatistic()) + self::getStat(self::readFileStatistic()) + self::getStat(self::readGoogleStatistic());
		return $x;
	}
	
	function getInfoFile() {
		return self::getStat(self::readFileStatistic());
	}
	
	function getInfoMysql() {
		return self::getStat(self::readMysqlStatistic());
	}
	
	function getInfoGoogle() {
		return self::getStat(self::readGoogleStatistic());
	}	
}
?>