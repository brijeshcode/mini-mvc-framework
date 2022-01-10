<?php 
/**
 * Model class responsible for all the tasks related to db
 */
namespace Core;
use \MysqliDb;

class Model extends MysqliDb
{
	protected $table = '';
	protected $limit = 20;
	protected $pageNo = 1;
	protected $db = '';
	protected $quotes = array();
	protected $columns = [];


	function __construct()
	{
		$db_config = [
			'host' => 'localhost',
	        'username' => 'root',
	        'password' => '1111',
	        'db'=> 'wishyouapp',
	        'port' => 3306,
	        'charset' => 'utf8mb4_0900_ai_ci'
		];

		$this->db = new MysqliDb ($db_config);
		$this->limit($this->limit);
		$this->db->ObjectBuilder(); // default return type will be objects ;

		if (isset($_GET['page'])) $this->pageNo = $_GET['page'];
	}

	public function all()
	{
        return $this->db->ObjectBuilder()->get($this->table , null , $this->columns);
	}

	public function latest()
	{
        return $this->db->ObjectBuilder()->orderBy("id")->get($this->table , 1 , $this->columns);
	}

	public function page($pageNo)
	{
		$this->pageNo = $pageNo; return $this;
	}

	// page size limit
	public function limit($limit)
	{
		$this->db->pageLimit = $limit; return $this;
	}

	public function with($relation)
	{
		$temp = explode(':', $relation);
		$relationTb = $temp[0];
		return $this->$relationTb();
	}

	public function belongsTo($class , $primaryKey, $forigenKey)
	{
		return $class;
	}

	public function withPagination($limit = '')
	{
		if ($limit != '' ) $this->db->pageLimit = $limit;
        $data = $this->db->orderBy("id")->ObjectBuilder()->paginate($this->table , $this->pageNo , $this->columns);
        return $this->formatPagiationData($data);
	}

	public function formatPagiationData($data)
    {
        return [
            'data'=> $data,
            'pagination' =>[
                    'current_page' => $this->pageNo,
                    'next_page' => $this->pageNo + 1,
                    'previous_page' => $this->pageNo == 1 ? null : $this->pageNo - 1,
                    'per_page' => $this->db->pageLimit,
                    'total_items' => $this->db->totalCount,
                    'total_pages' => $this->db->totalPages,
                ]
        ];
    }
}

?>
