<?php

class Parse {
	protected $curl;

	public function __construct(){
		$this->curl = curl_init();
		$this->setopt(CURLOPT_RETURNTRANSFER,true);
	}

	public function setopt($key, $val) {
   		curl_setopt($this->curl, $key, $val);
   	return $this;
	}

	public function getResults($text,$page){
		$this->setopt(CURLOPT_URL,'https://www.google.by/search?q='.urlencode($text).'&start='.$page*10);
		$response = curl_exec($this->curl);
		preg_match_all("|<h3 class=\"r\">(.*?)</h3>|is",$response,$all_results);
		return $all_results[1];
	}
	
	public function results($text){
		for ($i=0;$i<20;$i++){
			$results = $this->getResults($text,$i);
			foreach ($results as $r){
				$r = str_replace('/url?q=','',$r);
				$res[] = iconv("windows-1251","UTF-8",$r);
			}
		}
		return json_encode($res);
	}
}
?>