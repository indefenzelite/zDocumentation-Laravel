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

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Notification;
use App\Models\User;
use App\Models\Conversation;
use App\Models\Lead;
use App\Models\Order;
use App\Models\Role;
use App\Http\Requests\UserRequest;

class DashboardController extends Controller
{

    public $label;

    function __construct()
    {
        $this->label = 'Dashboard';
    }
    public function index()
    {
        // return "s";
        $newUser = getNewAcquisitionForUsers();
        $newOrder = getNewAcquisitionForOrders();
        $user = auth()->user();
        $label = $this->label;
        $readNotifications = Notification::where('user_id',auth()->id())->where('is_read',1)->get();
        $unreadNotifications = Notification::where('user_id',auth()->id())->where('is_read',0)->get();
        $stats['adminsCount']  = User::whereRoleIs(['Admin'])->count();
        $stats['customersCount']  = User::whereRoleIs(['customers'])->count();
        $stats['leadConversationsCount']  = Conversation::where('type',Lead::class)->groupBy('type_id')->count();
        $stats['leadsCount']  = Lead::where('lead_type_id',5)->count();
        $orders  = Order::where('payment_status','!=',1)->get();
        // dd($stats);
        return view('admin.dashboard.index',compact('readNotifications','unreadNotifications','user','label','orders','stats','newUser','newOrder'));
    }
    public function createModule()
    {
        $roles =Role::whereNotIn('id', [1])->pluck('display_name');
        return view('admin.module.create', compact('roles'));
    }

    public function logoutAs()
    {
        // If for some reason route is getting hit without someone already logged in
        if (!auth()->user()) {
            return redirect()->url('/');
        }
        
        // If admin id is set, relogin
        if (session()->has('admin_user_id') && session()->has('temp_user_id')) {
            // Save admin id

            if (authRole() == "User") {
                $role = "?role=User";
            } else {
                $role = "?role=Admin";
            }
            $admin_id = session()->get('admin_user_id');

            session()->forget('admin_user_id');
            session()->forget('admin_user_name');
            session()->forget('temp_user_id');

            // Re-login admin
            auth()->loginUsingId((int) $admin_id);

            // Redirect to backend user page
            return redirect(route('admin.users.index').$role);
        } else {
            // return 'f';
            session()->forget('admin_user_id');
            session()->forget('admin_user_name');
            session()->forget('temp_user_id');

            // Otherwise logout and redirect to login
            auth()->logout();

            return redirect('/');
        }
    }
}
