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

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\BulkRequest;
use App\Models\User;
use App\Imports\UsersImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;

class BulkController extends Controller
{
    public function user(BulkRequest $request,)
    {
        
        Excel::import(new UsersImport, request()->file('file'));
        return redirect(route('admin.users.index', ['role' => 'User']))->with('success', 'User added Successfully');
    }
}
