<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Laratrust\Models\LaratrustPermission;
use Laratrust\Models\LaratrustRole;
use App\Models\User;

class RolesAndPermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Roles
        $admin = LaratrustRole::firstOrCreate(
            [
            'name' => 'admin',
            'display_name' => 'Admin'
            ]
        );
        LaratrustRole::firstOrCreate(
            [
            'name' => 'user',
            'display_name' => 'User'
            ]
        );

        // Permissions
        $manageViewOrders = LaratrustPermission::firstOrCreate(
            [
            'name' => 'view_orders',
            'display_name' => 'Manage View Orders',
            'group' => 'Finance'
            ]
        );
        $manageShowOrders = LaratrustPermission::firstOrCreate(
            [
            'name' => 'show_order',
            'display_name' => 'Manage Show Order',
            'group' => 'Finance'
            ]
        );
        $manageControlOrders = LaratrustPermission::firstOrCreate(
            [
            'name' => 'control_order',
            'display_name' => 'Manage Control Order',
            'group' => 'Finance'
            ]
        );
        $manageAddOrders = LaratrustPermission::firstOrCreate(
            [
            'name' => 'add_order',
            'display_name' => 'Manage Add Order',
            'group' => 'Finance'
            ]
        );
        $manageEditOrders = LaratrustPermission::firstOrCreate(
            [
            'name' => 'edit_order',
            'display_name' => 'Manage Edit Order',
            'group' => 'Finance'
            ]
        );
        $manageDeleteOrders = LaratrustPermission::firstOrCreate(
            [
            'name' => 'delete_order',
            'display_name' => 'Manage Delete Order',
            'group' => 'Finance'
            ]
        );
        $manageViewPayouts = LaratrustPermission::firstOrCreate(
            [
            'name' => 'view_payouts',
            'display_name' => 'Manage View Payouts',
            'group' => 'Payout'
            ]
        );
        $manageShowPayouts = LaratrustPermission::firstOrCreate(
            [
            'name' => 'show_payout',
            'display_name' => 'Manage Show Payout',
            'group' => 'Payout'
            ]
        );
        $manageControlPayouts = LaratrustPermission::firstOrCreate(
            [
            'name' => 'control_payout',
            'display_name' => 'Manage Control Payout',
            'group' => 'Payout'
            ]
        );
        $manageAddPayouts = LaratrustPermission::firstOrCreate(
            [
            'name' => 'add_payout',
            'display_name' => 'Manage Add Payout',
            'group' => 'Payout'
            ]
        );
        $manageEditPayouts = LaratrustPermission::firstOrCreate(
            [
            'name' => 'edit_payout',
            'display_name' => 'Manage Edit Payout',
            'group' => 'Payout'
            ]
        );
        $manageDeletePayouts = LaratrustPermission::firstOrCreate(
            [
            'name' => 'delete_payout',
            'display_name' => 'Manage Delete Payout',
            'group' => 'Payout'
            ]
        );
        $manageViewItems = LaratrustPermission::firstOrCreate(
            [
            'name' => 'view_items',
            'display_name' => 'Manage View Items',
            'group' => 'Item'
            ]
        );
        $manageShowItems = LaratrustPermission::firstOrCreate(
            [
            'name' => 'show_item',
            'display_name' => 'Manage Show Item',
            'group' => 'Item'
            ]
        );
        $manageAddItems = LaratrustPermission::firstOrCreate(
            [
            'name' => 'add_item',
            'display_name' => 'Manage Add Item',
            'group' => 'Item'
            ]
        );
        $manageEditItems = LaratrustPermission::firstOrCreate(
            [
            'name' => 'edit_item',
            'display_name' => 'Manage Edit Item',
            'group' => 'Item'
            ]
        );
        $manageDeleteItems = LaratrustPermission::firstOrCreate(
            [
            'name' => 'delete_item',
            'display_name' => 'Manage Delete Item',
            'group' => 'Item'
            ]
        );
        $manageViewUsers = LaratrustPermission::firstOrCreate(
            [
            'name' => 'view_users',
            'display_name' => 'Manage User View',
            'group' => 'User'
            ]
        );
        $manageAddUsers = LaratrustPermission::firstOrCreate(
            [
            'name' => 'add_user',
            'display_name' => 'Manage User Add',
            'group' => 'User'
            ]
        );
        $manageEditUsers = LaratrustPermission::firstOrCreate(
            [
            'name' => 'edit_user',
            'display_name' => 'Manage User Edit',
            'group' => 'User'
            ]
        );
        $manageControlMfaUsers = LaratrustPermission::firstOrCreate(
            [
            'name' => 'control_mfa_user',
            'display_name' => 'Manage User Control MFA',
            'group' => 'User'
            ]
        );
        $manageDeleteUsers = LaratrustPermission::firstOrCreate(
            [
            'name' => 'delete_user ',
            'display_name' => 'Manage User Delete',
            'group' => 'User'
            ]
        );
        $manageControlWallet = LaratrustPermission::firstOrCreate(
            [
            'name' => 'control_wallet',
            'display_name' => 'Manage Control Wallet',
            'group' => 'Wallet'
            ]
        );
        $manageViewRoles = LaratrustPermission::firstOrCreate(
            [
            'name' => 'view_roles',
            'display_name' => 'Manage View Role',
            'group' => 'Role'
            ]
        );
        $manageAddRoles = LaratrustPermission::firstOrCreate(
            [
            'name' => 'add_role',
            'display_name' => 'Manage Add Role',
            'group' => 'Role'
            ]
        );
        $manageEditRoles = LaratrustPermission::firstOrCreate(
            [
            'name' => 'edit_role',
            'display_name' => 'Manage Edit Role',
            'group' => 'Role'
            ]
        );
        $manageDeleteRoles = LaratrustPermission::firstOrCreate(
            [
            'name' => 'delete_role',
            'display_name' => 'Manage Delete Role',
            'group' => 'Role'
            ]
        );
        $manageViewPermissions = LaratrustPermission::firstOrCreate(
            [
            'name' => 'view_permissions',
            'display_name' => 'Manage View Permission',
            'group' => 'Permissions'
            ]
        );
        $manageAddPermissions = LaratrustPermission::firstOrCreate(
            [
            'name' => 'add_permission',
            'display_name' => 'Manage Add Permission',
            'group' => 'Permissions'
            ]
        );
        $manageEditPermissions = LaratrustPermission::firstOrCreate(
            [
            'name' => 'edit_permission',
            'display_name' => 'Manage Edit Permission',
            'group' => 'Permissions'
            ]
        );
        $manageDeletePermissions = LaratrustPermission::firstOrCreate(
            [
            'name' => 'delete_permission',
            'display_name' => 'Manage Delete Permission',
            'group' => 'Permissions'
            ]
        );
        $manageViewEnquiries = LaratrustPermission::firstOrCreate(
            [
            'name' => 'view_enquiries',
            'display_name' => 'Manage View Enquiries',
            'group' => 'Enquiry'
            ]
        );
        $manageShowEnquiries = LaratrustPermission::firstOrCreate(
            [
            'name' => 'show_enquiry',
            'display_name' => 'Manage Show Enquiry',
            'group' => 'Enquiry'
            ]
        );
        $manageControlEnquiries = LaratrustPermission::firstOrCreate(
            [
            'name' => 'control_enquiry',
            'display_name' => 'Manage Control Enquiry',
            'group' => 'Enquiry'
            ]
        );
        $manageAddEnquiries = LaratrustPermission::firstOrCreate(
            [
            'name' => 'add_enquiry',
            'display_name' => 'Manage Add Enquiry',
            'group' => 'Enquiry'
            ]
        );
        $manageEditEnquiries = LaratrustPermission::firstOrCreate(
            [
            'name' => 'edit_enquiry',
            'display_name' => 'Manage Edit Enquiry',
            'group' => 'Enquiry'
            ]
        );
        $manageDeleteEnquiries = LaratrustPermission::firstOrCreate(
            [
            'name' => 'delete_enquiry',
            'display_name' => 'Manage Delete Enquiry',
            'group' => 'Enquiry'
            ]
        );
        $manageViewTickets = LaratrustPermission::firstOrCreate(
            [
            'name' => 'view_tickets',
            'display_name' => 'Manage View Tickets',
            'group' => 'Ticket'
            ]
        );
        $manageShowTickets = LaratrustPermission::firstOrCreate(
            [
            'name' => 'show_ticket',
            'display_name' => 'Manage Show Ticket',
            'group' => 'Ticket'
            ]
        );
        $manageControlTickets = LaratrustPermission::firstOrCreate(
            [
            'name' => 'control_ticket',
            'display_name' => 'Manage Control Ticket',
            'group' => 'Ticket'
            ]
        );
        $manageAddTickets = LaratrustPermission::firstOrCreate(
            [
            'name' => 'add_ticket',
            'display_name' => 'Manage Add Ticket',
            'group' => 'Ticket'
            ]
        );
        $manageEditTickets = LaratrustPermission::firstOrCreate(
            [
            'name' => 'edit_ticket',
            'display_name' => 'Manage Edit Ticket',
            'group' => 'Ticket'
            ]
        );
        $manageDeleteTickets = LaratrustPermission::firstOrCreate(
            [
            'name' => 'delete_ticket',
            'display_name' => 'Manage Delete Ticket',
            'group' => 'Ticket'
            ]
        );
        $manageViewNewletters = LaratrustPermission::firstOrCreate(
            [
            'name' => 'view_newletters',
            'display_name' => 'Manage View Newletters',
            'group' => 'Newletter'
            ]
        );
        $manageShowNewletters = LaratrustPermission::firstOrCreate(
            [
            'name' => 'show_newletter',
            'display_name' => 'Manage Show Newletter',
            'group' => 'Newletter'
            ]
        );
        $manageControlNewletters = LaratrustPermission::firstOrCreate(
            [
            'name' => 'control_newletter',
            'display_name' => 'Manage Control Newletter',
            'group' => 'Newletter'
            ]
        );
        $manageAddNewletters = LaratrustPermission::firstOrCreate(
            [
            'name' => 'add_newletter',
            'display_name' => 'Manage Add Newletter',
            'group' => 'Newletter'
            ]
        );
        $manageEditNewletters = LaratrustPermission::firstOrCreate(
            [
            'name' => 'edit_newletter',
            'display_name' => 'Manage Edit Newletter',
            'group' => 'Newletter'
            ]
        );
        $manageDeleteNewletters = LaratrustPermission::firstOrCreate(
            [
            'name' => 'delete_newletter',
            'display_name' => 'Manage Delete Newletter',
            'group' => 'Newletter'
            ]
        );
        $manageViewLeads = LaratrustPermission::firstOrCreate(
            [
            'name' => 'view_leads',
            'display_name' => 'Manage View Leads',
            'group' => 'Lead'
            ]
        );
        $manageShowLeads = LaratrustPermission::firstOrCreate(
            [
            'name' => 'show_lead',
            'display_name' => 'Manage Show Lead',
            'group' => 'Lead'
            ]
        );
        $manageControlLeads = LaratrustPermission::firstOrCreate(
            [
            'name' => 'control_lead',
            'display_name' => 'Manage Control Lead',
            'group' => 'Lead'
            ]
        );
        $manageAddLeads = LaratrustPermission::firstOrCreate(
            [
            'name' => 'add_lead',
            'display_name' => 'Manage Add Lead',
            'group' => 'Lead'
            ]
        );
        $manageEditLeads = LaratrustPermission::firstOrCreate(
            [
            'name' => 'edit_lead',
            'display_name' => 'Manage Edit Lead',
            'group' => 'Lead'
            ]
        );
        $manageDeleteLeads = LaratrustPermission::firstOrCreate(
            [
            'name' => 'delete_lead',
            'display_name' => 'Manage Delete Lead',
            'group' => 'Lead'
            ]
        );
        $manageViewNotes = LaratrustPermission::firstOrCreate(
            [
            'name' => 'view_notes',
            'display_name' => 'Manage View Notes',
            'group' => 'Note'
            ]
        );
        $manageShowNotes = LaratrustPermission::firstOrCreate(
            [
            'name' => 'show_note',
            'display_name' => 'Manage Show Note',
            'group' => 'Note'
            ]
        );
        $manageControlNotes = LaratrustPermission::firstOrCreate(
            [
            'name' => 'control_note',
            'display_name' => 'Manage Control Note',
            'group' => 'Note'
            ]
        );
        $manageAddNotes = LaratrustPermission::firstOrCreate(
            [
            'name' => 'add_note',
            'display_name' => 'Manage Add Note',
            'group' => 'Note'
            ]
        );
        $manageEditNotes = LaratrustPermission::firstOrCreate(
            [
            'name' => 'edit_note',
            'display_name' => 'Manage Edit Note',
            'group' => 'Note'
            ]
        );
        $manageDeleteNotes = LaratrustPermission::firstOrCreate(
            [
            'name' => 'delete_note',
            'display_name' => 'Manage Delete Note',
            'group' => 'Note'
            ]
        );
        $manageViewContacts = LaratrustPermission::firstOrCreate(
            [
            'name' => 'view_contacts',
            'display_name' => 'Manage View Contacts',
            'group' => 'Contact'
            ]
        );
        $manageShowContacts = LaratrustPermission::firstOrCreate(
            [
            'name' => 'show_contact',
            'display_name' => 'Manage Show Contact',
            'group' => 'Contact'
            ]
        );
        $manageControlContacts = LaratrustPermission::firstOrCreate(
            [
            'name' => 'control_contact',
            'display_name' => 'Manage Control Contact',
            'group' => 'Contact'
            ]
        );
        $manageAddContacts = LaratrustPermission::firstOrCreate(
            [
            'name' => 'add_contact',
            'display_name' => 'Manage Add Contact',
            'group' => 'Contact'
            ]
        );
        $manageEditContacts = LaratrustPermission::firstOrCreate(
            [
            'name' => 'edit_contact',
            'display_name' => 'Manage Edit Contact',
            'group' => 'Contact'
            ]
        );
        $manageDeleteContacts = LaratrustPermission::firstOrCreate(
            [
            'name' => 'delete_contact',
            'display_name' => 'Manage Delete Contact',
            'group' => 'Contact'
            ]
        );
        $manageViewAddresses = LaratrustPermission::firstOrCreate(
            [
            'name' => 'view_addresses',
            'display_name' => 'Manage View Addresses',
            'group' => 'User Address'
            ]
        );
        $manageShowAddresses = LaratrustPermission::firstOrCreate(
            [
            'name' => 'show_address',
            'display_name' => 'Manage Show Address',
            'group' => 'User Address'
            ]
        );
        $manageControlAddresses = LaratrustPermission::firstOrCreate(
            [
            'name' => 'control_address',
            'display_name' => 'Manage Control Address',
            'group' => 'User Address'
            ]
        );
        $manageAddAddresses = LaratrustPermission::firstOrCreate(
            [
            'name' => 'add_address',
            'display_name' => 'Manage Add Address',
            'group' => 'User Address'
            ]
        );
        $manageEditAddresses = LaratrustPermission::firstOrCreate(
            [
            'name' => 'edit_address',
            'display_name' => 'Manage Edit Address',
            'group' => 'User Address'
            ]
        );
        $manageDeleteAddresses = LaratrustPermission::firstOrCreate(
            [
            'name' => 'delete_address',
            'display_name' => 'Manage Delete Address',
            'group' => 'User Address'
            ]
        );
        $manageViewBanks = LaratrustPermission::firstOrCreate(
            [
            'name' => 'view_banks',
            'display_name' => 'Manage View Banks',
            'group' => 'User Bank'
            ]
        );
        $manageShowBanks = LaratrustPermission::firstOrCreate(
            [
            'name' => 'show_bank',
            'display_name' => 'Manage Show Bank',
            'group' => 'User Bank'
            ]
        );
        $manageControlBanks = LaratrustPermission::firstOrCreate(
            [
            'name' => 'control_bank',
            'display_name' => 'Manage Control Bank',
            'group' => 'User Bank'
            ]
        );
        $manageAddBanks = LaratrustPermission::firstOrCreate(
            [
            'name' => 'add_bank',
            'display_name' => 'Manage Add Bank',
            'group' => 'User Bank'
            ]
        );
        $manageEditBanks = LaratrustPermission::firstOrCreate(
            [
            'name' => 'edit_bank',
            'display_name' => 'Manage Edit Bank',
            'group' => 'User Bank'
            ]
        );
        $manageDeleteBanks = LaratrustPermission::firstOrCreate(
            [
            'name' => 'delete_bank',
            'display_name' => 'Manage Delete Bank',
            'group' => 'User Bank'
            ]
        );
        $manageViewBlogs = LaratrustPermission::firstOrCreate(
            [
            'name' => 'view_blogs',
            'display_name' => 'Manage View Blogs',
            'group' => 'Blog'
            ]
        );
        $manageAddBlogs = LaratrustPermission::firstOrCreate(
            [
            'name' => 'add_blog',
            'display_name' => 'Manage Add Blog',
            'group' => 'Blog'
            ]
        );
        $manageEditBlogs = LaratrustPermission::firstOrCreate(
            [
            'name' => 'edit_blog',
            'display_name' => 'Manage Edit Blog',
            'group' => 'Blog'
            ]
        );
        $manageDeleteBlogs = LaratrustPermission::firstOrCreate(
            [
            'name' => 'delete_blog',
            'display_name' => 'Manage Delete Blog',
            'group' => 'Blog'
            ]
        );
        $manageControlCategoryTypes = LaratrustPermission::firstOrCreate(
            [
            'name' => 'control_category_type',
            'display_name' => 'Manage Control Category Type',
            'group' => 'Category Type'
            ]
        );
        $manageViewCategories = LaratrustPermission::firstOrCreate(
            [
            'name' => 'view_categories',
            'display_name' => 'Manage View Categories',
            'group' => 'Category'
            ]
        );
        $manageAddCategories = LaratrustPermission::firstOrCreate(
            [
            'name' => 'add_category',
            'display_name' => 'Manage Add Category',
            'group' => 'Category'
            ]
        );
        $manageEditCategories = LaratrustPermission::firstOrCreate(
            [
            'name' => 'edit_category',
            'display_name' => 'Manage Edit Category',
            'group' => 'Category'
            ]
        );
        $manageDeleteCategories = LaratrustPermission::firstOrCreate(
            [
            'name' => 'delete_category',
            'display_name' => 'Manage Delete Category',
            'group' => 'Category'
            ]
        );
        $manageControlSliderTypes = LaratrustPermission::firstOrCreate(
            [
            'name' => 'control_slider_type',
            'display_name' => 'Manage Control Slider Type',
            'group' => 'SliderType'
            ]
        );
        $manageViewSliders = LaratrustPermission::firstOrCreate(
            [
            'name' => 'view_sliders',
            'display_name' => 'Manage View Sliders',
            'group' => 'Slider'
            ]
        );
        $manageAddSliders = LaratrustPermission::firstOrCreate(
            [
            'name' => 'add_slider',
            'display_name' => 'Manage Add Slider',
            'group' => 'Slider'
            ]
        );
        $manageEditSliders = LaratrustPermission::firstOrCreate(
            [
            'name' => 'edit_slider',
            'display_name' => 'Manage Edit Slider',
            'group' => 'Slider'
            ]
        );
        $manageDeleteSliders = LaratrustPermission::firstOrCreate(
            [
            'name' => 'delete_slider',
            'display_name' => 'Manage Delete Slider',
            'group' => 'Slider'
            ]
        );
        $manageViewParagraphContents = LaratrustPermission::firstOrCreate(
            [
            'name' => 'view_paragraph_contents',
            'display_name' => 'Manage View Paragraph Contents',
            'group' => 'Paragraph Content'
            ]
        );
        $manageAddParagraphContents = LaratrustPermission::firstOrCreate(
            [
            'name' => 'add_paragraph_content',
            'display_name' => 'Manage Add Paragraph Content',
            'group' => 'Paragraph Content'
            ]
        );
        $manageEditParagraphContents = LaratrustPermission::firstOrCreate(
            [
            'name' => 'edit_paragraph_content',
            'display_name' => 'Manage Edit Paragraph Content',
            'group' => 'Paragraph Content'
            ]
        );
        $manageDeleteParagraphContents = LaratrustPermission::firstOrCreate(
            [
            'name' => 'delete_paragraph_content',
            'display_name' => 'Manage Delete Paragraph Content',
            'group' => 'Paragraph Content'
            ]
        );
        $manageViewFaqs = LaratrustPermission::firstOrCreate(
            [
            'name' => 'view_faqs',
            'display_name' => 'Manage View Faqs',
            'group' => 'FAQs'
            ]
        );
        $manageAddFaqs = LaratrustPermission::firstOrCreate(
            [
            'name' => 'add_faq',
            'display_name' => 'Manage Add Faq',
            'group' => 'FAQs'
            ]
        );
        $manageEditFaqs = LaratrustPermission::firstOrCreate(
            [
            'name' => 'edit_faq',
            'display_name' => 'Manage Edit Faq',
            'group' => 'FAQs'
            ]
        );
        $manageDeleteFaqs = LaratrustPermission::firstOrCreate(
            [
            'name' => 'delete_faq',
            'display_name' => 'Manage Delete Faq',
            'group' => 'FAQs'
            ]
        );
        $manageViewLocations = LaratrustPermission::firstOrCreate(
            [
            'name' => 'view_locations',
            'display_name' => 'Manage View Locations',
            'group' => 'Location'
            ]
        );
        $manageAddLocations = LaratrustPermission::firstOrCreate(
            [
            'name' => 'add_location',
            'display_name' => 'Manage Add Location',
            'group' => 'Location'
            ]
        );
        $manageEditLocations = LaratrustPermission::firstOrCreate(
            [
            'name' => 'edit_location',
            'display_name' => 'Manage Edit Location',
            'group' => 'Location'
            ]
        );
        $manageDeleteLocations = LaratrustPermission::firstOrCreate(
            [
            'name' => 'delete_location',
            'display_name' => 'Manage Delete Location',
            'group' => 'Location'
            ]
        );
        $manageViewSubscriptionPlans = LaratrustPermission::firstOrCreate(
            [
            'name' => 'view_subscription_plans',
            'display_name' => 'Manage View Subscription Plans',
            'group' => 'Subscription Plan'
            ]
        );
        $manageAddSubscriptionPlans = LaratrustPermission::firstOrCreate(
            [
            'name' => 'add_subscription_plan',
            'display_name' => 'Manage Add Subscription Plan',
            'group' => 'Subscription Plan'
            ]
        );
        $manageEditSubscriptionPlans = LaratrustPermission::firstOrCreate(
            [
            'name' => 'edit_subscription_plan',
            'display_name' => 'Manage Edit Subscription Plan',
            'group' => 'Subscription Plan'
            ]
        );
        $manageDeleteSubscriptionPlans = LaratrustPermission::firstOrCreate(
            [
            'name' => 'delete_subscription_plan',
            'display_name' => 'Manage Delete Subscription Plan',
            'group' => 'Subscription Plan'
            ]
        );
        $manageViewMailTemplates = LaratrustPermission::firstOrCreate(
            [
            'name' => 'view_mail_templates',
            'display_name' => 'Manage View Mail Templates',
            'group' => 'Mail/SMS/Template'
            ]
        );
        $manageAddMailTemplates = LaratrustPermission::firstOrCreate(
            [
            'name' => 'add_mail_template',
            'display_name' => 'Manage Add Mail Template',
            'group' => 'Mail/SMS/Template'
            ]
        );
        $manageEditMailTemplates = LaratrustPermission::firstOrCreate(
            [
            'name' => 'edit_mail_template',
            'display_name' => 'Manage Edit Mail Template',
            'group' => 'Mail/SMS/Template'
            ]
        );
        $manageDeleteMailTemplates = LaratrustPermission::firstOrCreate(
            [
            'name' => 'delete_mail_template',
            'display_name' => 'Manage Delete Mail Template',
            'group' => 'Mail/SMS/Template'
            ]
        );
        $manageViewPages = LaratrustPermission::firstOrCreate(
            [
            'name' => 'view_pages',
            'display_name' => 'Manage View Pages',
            'group' => 'Page'
            ]
        );
        $manageAddPages = LaratrustPermission::firstOrCreate(
            [
            'name' => 'add_page',
            'display_name' => 'Manage Add Page',
            'group' => 'Page'
            ]
        );
        $manageEditPages = LaratrustPermission::firstOrCreate(
            [
            'name' => 'edit_page',
            'display_name' => 'Manage Edit Page',
            'group' => 'Page'
            ]
        );
        $manageDeletePages = LaratrustPermission::firstOrCreate(
            [
            'name' => 'delete_page',
            'display_name' => 'Manage Delete Page',
            'group' => 'Page'
            ]
        );
        $manageAccessGeneralSettings = LaratrustPermission::firstOrCreate(
            [
            'name' => 'access_general_setting',
            'display_name' => 'Manage Access General Setting',
            'group' => 'Setting'
            ]
        );
        $manageAccessCurrencySettings = LaratrustPermission::firstOrCreate(
            [
            'name' => 'access_currency_setting',
            'display_name' => 'Manage Access Currency Setting',
            'group' => 'Setting'
            ]
        );
        $manageAccessDateTimeSettings = LaratrustPermission::firstOrCreate(
            [
            'name' => 'access_date_time_setting',
            'display_name' => 'Manage Access Date Time Setting',
            'group' => 'Setting'
            ]
        );
        $manageAccessNotificationSettings = LaratrustPermission::firstOrCreate(
            [
            'name' => 'access_notification_setting',
            'display_name' => 'Manage Access Notification Setting',
            'group' => 'Setting'
            ]
        );
        $manageAccessTroubleshootSettings = LaratrustPermission::firstOrCreate(
            [
            'name' => 'access_troubleshoot_setting',
            'display_name' => 'Manage Access Troubleshoot Setting',
            'group' => 'Setting'
            ]
        );
        $manageAccessEmailSettings = LaratrustPermission::firstOrCreate(
            [
            'name' => 'access_email_setting',
            'display_name' => 'Manage Access Email Setting',
            'group' => 'Setting'
            ]
        );
        $manageAccessSmsSettings = LaratrustPermission::firstOrCreate(
            [
            'name' => 'access_sms_setting',
            'display_name' => 'Manage Access Sms Setting',
            'group' => 'Setting'
            ]
        );
        $manageAccessFcmSettings = LaratrustPermission::firstOrCreate(
            [
            'name' => 'access_fcm_setting',
            'display_name' => 'Manage Access Fcm Setting',
            'group' => 'Setting'
            ]
        );
        $manageControlBasicDetails = LaratrustPermission::firstOrCreate(
            [
            'name' => 'control_basic_details',
            'display_name' => 'Manage Control Basic Details',
            'group' => 'Website Setup'
            ]
        );
        $manageControlSocialLoginsDetails = LaratrustPermission::firstOrCreate(
            [
            'name' => 'control_social_logins_details',
            'display_name' => 'Manage Control Social Logins Details',
            'group' => 'Website Setup'
            ]
        );
        $manageViewseoTags = LaratrustPermission::firstOrCreate(
            [
            'name' => 'view_seo_tags',
            'display_name' => 'Manage View seo Tags',
            'group' => 'SEO Tag'
            ]
        );
        $manageAddseoTags = LaratrustPermission::firstOrCreate(
            [
            'name' => 'add_seo_tag',
            'display_name' => 'Manage Add SEO Tags',
            'group' => 'SEO Tag'
            ]
        );
        $manageEditseoTags = LaratrustPermission::firstOrCreate(
            [
            'name' => 'edit_seo_tag',
            'display_name' => 'Manage Edit SEO Tags',
            'group' => 'SEO Tag'
            ]
        );
        $manageDeleteseoTags = LaratrustPermission::firstOrCreate(
            [
            'name' => 'delete_seo_tag',
            'display_name' => 'Manage Delete SEO Tags',
            'group' => 'SEO Tag'
            ]
        );
        
       
        
        
       

        // Attaching
        $admin->attachPermission($manageViewOrders);
        $admin->attachPermission($manageShowOrders);
        $admin->attachPermission($manageControlOrders);
        $admin->attachPermission($manageAddOrders);
        $admin->attachPermission($manageEditOrders);
        $admin->attachPermission($manageDeleteOrders);
        $admin->attachPermission($manageViewPayouts);
        $admin->attachPermission($manageShowPayouts);
        $admin->attachPermission($manageControlPayouts);
        $admin->attachPermission($manageAddPayouts);
        $admin->attachPermission($manageEditPayouts);
        $admin->attachPermission($manageDeletePayouts);
        $admin->attachPermission($manageViewItems);
        $admin->attachPermission($manageShowItems);
        $admin->attachPermission($manageAddItems);
        $admin->attachPermission($manageEditItems);
        $admin->attachPermission($manageDeleteItems);
        $admin->attachPermission($manageViewUsers);
        $admin->attachPermission($manageAddUsers);
        $admin->attachPermission($manageEditUsers);
        $admin->attachPermission($manageControlMfaUsers);
        $admin->attachPermission($manageDeleteUsers);
        $admin->attachPermission($manageControlWallet);
        $admin->attachPermission($manageViewRoles);
        $admin->attachPermission($manageAddRoles);
        $admin->attachPermission($manageEditRoles);
        $admin->attachPermission($manageDeleteRoles);
        $admin->attachPermission($manageViewPermissions);
        $admin->attachPermission($manageAddPermissions);
        $admin->attachPermission($manageEditPermissions);
        $admin->attachPermission($manageDeletePermissions);
        $admin->attachPermission($manageViewEnquiries);
        $admin->attachPermission($manageShowEnquiries);
        $admin->attachPermission($manageControlEnquiries);
        $admin->attachPermission($manageAddEnquiries);
        $admin->attachPermission($manageEditEnquiries);
        $admin->attachPermission($manageDeleteEnquiries);
        $admin->attachPermission($manageViewTickets);
        $admin->attachPermission($manageShowTickets);
        $admin->attachPermission($manageControlTickets);
        $admin->attachPermission($manageAddTickets);
        $admin->attachPermission($manageEditTickets);
        $admin->attachPermission($manageDeleteTickets);
        $admin->attachPermission($manageViewNewletters);
        $admin->attachPermission($manageShowNewletters);
        $admin->attachPermission($manageControlNewletters);
        $admin->attachPermission($manageAddNewletters);
        $admin->attachPermission($manageEditNewletters);
        $admin->attachPermission($manageDeleteNewletters);
        $admin->attachPermission($manageViewLeads);
        $admin->attachPermission($manageShowLeads);
        $admin->attachPermission($manageControlLeads);
        $admin->attachPermission($manageAddLeads);
        $admin->attachPermission($manageEditLeads);
        $admin->attachPermission($manageDeleteLeads);
        $admin->attachPermission($manageViewNotes);
        $admin->attachPermission($manageShowNotes);
        $admin->attachPermission($manageControlNotes);
        $admin->attachPermission($manageAddNotes);
        $admin->attachPermission($manageEditNotes);
        $admin->attachPermission($manageDeleteNotes);
        $admin->attachPermission($manageViewContacts);
        $admin->attachPermission($manageShowContacts);
        $admin->attachPermission($manageControlContacts);
        $admin->attachPermission($manageAddContacts);
        $admin->attachPermission($manageEditContacts);
        $admin->attachPermission($manageDeleteContacts);
        $admin->attachPermission($manageViewAddresses);
        $admin->attachPermission($manageShowAddresses);
        $admin->attachPermission($manageControlAddresses);
        $admin->attachPermission($manageAddAddresses);
        $admin->attachPermission($manageEditAddresses);
        $admin->attachPermission($manageDeleteAddresses);
        $admin->attachPermission($manageViewBanks);
        $admin->attachPermission($manageShowBanks);
        $admin->attachPermission($manageControlBanks);
        $admin->attachPermission($manageAddBanks);
        $admin->attachPermission($manageEditBanks);
        $admin->attachPermission($manageDeleteBanks);
        $admin->attachPermission($manageViewBlogs);
        $admin->attachPermission($manageAddBlogs);
        $admin->attachPermission($manageEditBlogs);
        $admin->attachPermission($manageDeleteBlogs);
        $admin->attachPermission($manageControlCategoryTypes);
        $admin->attachPermission($manageViewCategories);
        $admin->attachPermission($manageAddCategories);
        $admin->attachPermission($manageEditCategories);
        $admin->attachPermission($manageDeleteCategories);
        $admin->attachPermission($manageControlSliderTypes);
        $admin->attachPermission($manageViewSliders);
        $admin->attachPermission($manageAddSliders);
        $admin->attachPermission($manageEditSliders);
        $admin->attachPermission($manageDeleteSliders);
        $admin->attachPermission($manageViewParagraphContents);
        $admin->attachPermission($manageAddParagraphContents);
        $admin->attachPermission($manageEditParagraphContents);
        $admin->attachPermission($manageDeleteParagraphContents);
        $admin->attachPermission($manageViewFaqs);
        $admin->attachPermission($manageAddFaqs);
        $admin->attachPermission($manageEditFaqs);
        $admin->attachPermission($manageDeleteFaqs);
        $admin->attachPermission($manageViewLocations);
        $admin->attachPermission($manageAddLocations);
        $admin->attachPermission($manageEditLocations);
        $admin->attachPermission($manageDeleteLocations);
        $admin->attachPermission($manageViewSubscriptionPlans);
        $admin->attachPermission($manageAddSubscriptionPlans);
        $admin->attachPermission($manageEditSubscriptionPlans);
        $admin->attachPermission($manageDeleteSubscriptionPlans);
        $admin->attachPermission($manageViewMailTemplates);
        $admin->attachPermission($manageAddMailTemplates);
        $admin->attachPermission($manageEditMailTemplates);
        $admin->attachPermission($manageDeleteMailTemplates);
        $admin->attachPermission($manageViewPages);
        $admin->attachPermission($manageAddPages);
        $admin->attachPermission($manageEditPages);
        $admin->attachPermission($manageDeletePages);
        $admin->attachPermission($manageAccessGeneralSettings);
        $admin->attachPermission($manageAccessCurrencySettings);
        $admin->attachPermission($manageAccessDateTimeSettings);
        $admin->attachPermission($manageAccessNotificationSettings);
        $admin->attachPermission($manageAccessTroubleshootSettings);
        $admin->attachPermission($manageAccessEmailSettings);
        $admin->attachPermission($manageAccessSmsSettings);
        $admin->attachPermission($manageAccessFcmSettings);
        $admin->attachPermission($manageControlBasicDetails);
        $admin->attachPermission($manageControlSocialLoginsDetails);
        $admin->attachPermission($manageViewseoTags);
        $admin->attachPermission($manageAddseoTags);
        $admin->attachPermission($manageEditseoTags);
        $admin->attachPermission($manageDeleteseoTags);
       
        
     
    }
}
