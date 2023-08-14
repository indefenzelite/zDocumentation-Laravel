<?php
/**
 *
 * @category ZStarter
 *
 * @ref     Defenzelite Product
 * @author  <Defenzelite hq@defenzelite.com>
 * @license <https://www.defenzelite.com Defenzelite Private Limited>
 * @version <zStarter: 202306-V1.0>
 * @link    <https://www.defenzelite.com>
 */

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use App\Traits\CanSendMail;
use App\Traits\HasResponse;
use App\Traits\CanManageFiles;
use App\Traits\ControlOrder;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests, ControlOrder;
    use HasResponse,CanManageFiles,CanSendMail;
}
