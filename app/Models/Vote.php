<?php
/**
 * Class Vote
 *
 * @category ZStarter
 *
 * @ref zCURD
 * @author  Defenzelite <hq@defenzelite.com>
 * @license https://www.defenzelite.com Defenzelite Private Limited
 * @version <zStarter: 1.1.0>
 * @link    https://www.defenzelite.com
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasFormattedTimestamps;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\SoftDeletes;
 



class Vote extends Model {
    use HasFactory,HasFormattedTimestamps;
    use SoftDeletes;    
    protected $guarded = ['id'];
     
    public const STATUS_USEFUL = 0;
    public const STATUS_NEUTRAL = 1;
    public const STATUS_UN_USEFUL = 2;

    public const BULK_ACTIVATION = 0;    
    public function getPrefix() {
        return "#V".str_replace('_1','','_'.(100000 +$this->id));
    }
     
    public function  faq(){
      return  $this->belongsTo(Faq::class,'faq_id','id');
    }     
    public function  user(){
      return  $this->belongsTo(User::class,'user_id','id');
    }    


}
