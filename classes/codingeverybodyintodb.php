<?php #codingeverybodyintodb
class codingeverybodyintodb
{
	public $db;
	public $message = "message into database 한글 입력 테스트";
	public $tag = "tag into datatabse 태그 입력";
	public $permalink = "peramlink into databases";
	public $source_id = "source_id";
	public $create_time; 
	public $created; 
	public $post_id = "post_id into database";
	public $filter_key = "filter into database";

	public $actor_id = "actor_id into database";
	public $like_info = "like info into databse";
	public $comment_info = "comment info into databse";
 
  	public $sql = "insert into stream(message, message_tags, permalink, source_id, created_time, created, post_id, filter_key, actor_id, like_info, comment_info) values (:message, :message_tag, :permalink, :source_id, :created_time, :created, :post_id, :filter_key, :actor_id, :like_info, :comment_info);";

	public $searchSql = "select * from stream s WHERE s.message like '%".$_POST['query']."%'";

	public function __construct($db)
	{
		$this->db = $db;
		$this->create_time = date("Y-m-d H:i:s");
		$this->created = date("Y-m-d H:i:s");
	}

	public function insert()
	{
		$stmt = $this->db->prepare($this->sql);
		$stmt->bindParam(':message', $this->message, PDO::PARAM_STR);
		$stmt->bindParam(":message_tag", $this->tag, PDO::PARAM_STR);
		$stmt->bindParam(":permalink", $this->permalink, PDO::PARAM_STR);
		$stmt->bindParam(":source_id", $this->source_id, PDO::PARAM_STR);
		$stmt->bindParam(":created_time", $this->create_time, PDO::PARAM_STR);
		$stmt->bindParam(":created", $this->created, PDO::PARAM_STR);
		$stmt->bindParam(":post_id", $this->post_id, PDO::PARAM_STR);
		$stmt->bindParam(":filter_key",$this->filter_key, PDO::PARAM_STR);
		$stmt->bindParam(":actor_id",$this->actor_id, PDO::PARAM_STR);
		$stmt->bindParam(":comment_info", $this->comment_info, PDO::PARAM_STR);
		$stmt->bindParam(":like_info", $this->like_info, PDO::PARAM_STR);

		$stmt->execute();
		$stmt->id = $this->db->lastInsertId();
		$db = null;
	}

	public function search($query_str)
	{
		echo "검색 질의 어 " . $_POST['query'] . "11<br /> ";
		$result = $this->db->query($this->searchSql);
		foreach($result as $row){
			print_r($row);
		}
		return false;
		print_r($result);	
		$stmt = $this->db->prepare($this->searchSql);
		$stmt->bindParam(':query', $query_str, PDO::PARAM_STR);
		$stmt->execute();
		$stmt->get_result();
		while($row = $stmt->fetch_array(MYSQLI_NUM)){
			foreach($row as $r){
				print $r;
			}
		}
		
	}
}
?>
