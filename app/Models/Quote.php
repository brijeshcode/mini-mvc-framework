<?php 
/**
 * Quotes Model
 */
namespace App\Models;
use Core\Model;
use App\Models\Category;

class Quote Extends Model
{
	protected $table = 'tbl_quotes';
    // protected $columns = ['id', 'quote', 'cat_id'];
    protected $columns = '*';

	public function category()
    {
        return $this->belongsTo(Category::class, 'cat_id' , 'cid' );
    }

    public function quotesWithCategory($limit = '')
    {
    	if ($limit != '' ) $this->db->pageLimit = $limit;

    	$categoryTb = 'tbl_category';
    	$this->db->join("{$categoryTb} c", "q.cat_id=c.cid", "LEFT");
        $quotes = $this->db->withTotalCount()->orderBy("id")->paginate("{$this->table} q" , $this->pageNo  , $this->columns);

        return $this->formatPagiationData($quotes);
    }


    public function links($template = 'default')
    {
        view($template);
    }

}

?>
