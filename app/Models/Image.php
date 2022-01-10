<?php
/**
 * Quotes Model
 */
namespace App\Models;
use Core\Model;
use App\Models\Category;

class Image Extends Model
{
	protected $table = 'tbl_ringtone';

    public function withCategory($limit = '')
    {
    	if ($limit != '' ) $this->db->pageLimit = $limit;

    	$categoryTb = 'tbl_author';

        $images = $this->db
            ->join("{$categoryTb} c", "i.cat_id=c.author_id", "LEFT")
            ->orderBy("id")
            ->paginate("{$this->table} i" , $this->pageNo );

        return $this->formatPagiationData($images);
    }


}

?>
