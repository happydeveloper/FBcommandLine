<?php
require 'bootstrap.php';

class Comment extends baseTaskFacebook
{
	public $fql;
	public $result;
	public $commentCnt;
	public $maxCommentCnt = 300;

	public function __construct() 
	{
		parent::__construct();
	}

	public function getComment($post_id)
	{
		if($this->user) {
			try {
			$fqlmanager = new fqlManager();
			$this->fql = $fqlmanager->loadFql("COMMENT").$post_id."'";
			$this->fql = "SELECT fromid, username, text, time, post_id FROM comment WHERE post_id = '".$post_id."'";
			$params = array('method' => 'fql.query', 'query' => $this->fql, );
			$this->result = $this->facebook->api($params);
			$this->commentCnt = count($this->result);
			//return $this->result;
			} catch (Exception $e) {
				echo 'Caught exception: ', $e->getMessage(), "\n";
			}
		}
	}

	public function getCommentText($post_id)
	{
		$this->getComment($post_id);

		if($this->result != null)
		{
			$commentCnt = count($this->result);

			if($commentCnt > $this->maxCommentCnt) {
				echo "<div class='note'> 댓글이 많아 아작스로 처리함니다. 댓글개수 : ".$commentCnt."</div>";
			} else {
				foreach($this->result as $row)
				{
				foreach($row as $key=>$value)
				{
					if($key == 'text')
					{ 
						echo "<div class='note'>".$value."</div>";
					}
				}	
				} 
			}
		}
	}
}
