<?php 
use App\Models\UserAddress;

//// General System Helpers
if (!function_exists('getSetting')) {
    function getSetting($key)
    {
        if(is_array($key)){
            $records = App\Models\Setting::select('group','key','value')->whereIn('group', $key)->get();
            $settings = [];
            foreach ($records as $key => $record) {
                $settings[$record->key] = $record->value;
            }
        }else{
            $settings = App\Models\Setting::where('key',$key)->first()->value ?? ''; 
        }
        return $settings;
    }
}
if (!function_exists('UserRole')) {
    function UserRole($id)
    {
        return App\Models\User::find($id)->roles[0];
    }
}
if (!function_exists('getAdminId')) {
    function getAdminId()
    {
        return App\Models\User::whereRoleIs(['Admin'])->value('id');
    }
}
function commentOutStart() 
{
  return "{{--";
}
function commentOutEnd() 
{
  return "--}}";
}
if (!function_exists('getSeoData')) {
    function getSeoData($code)
    {
        return  App\Models\SeoTag::where('code',$code)->first() ?? '';
    }
}

if (!function_exists('getBackendLogo')) {
    function getBackendLogo($img_name)
    {
        return asset($img_name);
    }
}

if (!function_exists('getSocialLinks')) {
    function getSocialLinks()
    {
        $social_links = [];

        if (getSetting('facebook_login_active')) {
            $social_links[] = "<a href='".route('social.login', 'facebook')."' class='btn social-btn btn-facebook'><i class='fab fa-facebook-f'></i></a>";
        }

        if (getSetting('google_login_active')) {
            $social_links[] = "<a href='".route('social.login', 'google')."' class='btn social-btn btn-google'><i class='fab fa-google'></i></a>";
        }

        if (getSetting('linkedin_login_active')) {
            $social_links[] = "<a href='".route('social.login', 'linkedin')."' class='btn social-btn btn-linkedin'><i class='fab fa-linkedin'></i></a>";
        }

        if (getSetting('twitter_login_active')) {
            $social_links[] = "<a href='".route('social.login', 'twitter')."' class='btn social-btn btn-twitter'><i class='fab fa-twitter'></i></a>";
        }

        return $social_links;
    }
}

if (!function_exists('getBlogImage')) {
    function getBlogImage($path){
        $profile_img = asset($path);
        if($profile_img){
            return $profile_img;
        }else{
            asset('admin/default/default-avatar.png');
        }
    }
}
// if (!function_exists('getBlogImage')) {
//     function getBlogImage($path){
//         $profile_img = asset('storage/site/blog/'.$path);
//         if($profile_img){
//             return $profile_img;
//         }else{
//             asset('admin/default/default-avatar.png');
//         }
//     }
// }



if (!function_exists('AuthRole')) {
    function AuthRole()
    {
        return ucWords(auth()->user()->roles[0]->name ?? '');
    }
}

if (!function_exists('getAuthProfileImage')) {
    function getAuthProfileImage($path){
        if(\Str::contains($path, 'https:')){
            return $path;
        }
        $profile_img = $path;
        if($profile_img != null){
            return $profile_img;
        }
    }
}

if (!function_exists('unlinkFile')) {
    function unlinkFile($filepath, $filename)
    {
        if ($filename != null) {
            $file = $filepath.'/'.$filename;
            if (file_exists($file)) {
                unlink($file);
            }
        }
    }
}

if (!function_exists('activeClassIfRoutes')){
    function activeClassIfRoutes($routes, $output = 'active', $fallback = '')
    {
        if (in_array(Route::currentRouteName(), $routes)){
            return $output;
        } else {
            return $fallback;
        }
    }
}
if (!function_exists('activeClassIfRoute')){
    function activeClassIfRoute($route, $output = 'active', $fallback = '')
    {
        if (Route::currentRouteName() == $route) {
            return $output;
        } else {
            return $fallback;
        }
    }
}
//formats currency
if (! function_exists('format_price')) {
    function format_price($price)
    {   
        if (App\Models\Setting::where('key', 'decimal_separator')->first()->value == 1) {
            $formatted_price = number_format($price, App\Models\Setting::where('key', 'no_of_decimal')->first()->value);
        } else {
            $formatted_price = number_format($price, App\Models\Setting::where('key', 'no_of_decimal')->first()->value, ',', '.');
        }

        if (App\Models\Setting::where('key', 'currency_position')->first()->value == 1) {
            return getSetting('app_currency').$formatted_price;
        }
        return $formatted_price.getSetting('app_currency');
    }
}

if (! function_exists('getAuthenticationMode')) {
    function getAuthenticationMode($id = -1)
    {
        if($id == -1){
            return [
                ['id'=>1,'name'=>"Login with Password"],
                ['id'=>2,'name'=>"Login with OTP"],
            ];
            }else{
                foreach(getAuthenticationMode() as $row){
                    if($id == $row['id']){
                    return $row;
                }
            }
            return ['id'=>0,'name'=>''];
        }
    }
}

function getKeysByValue($val, $array)
{
    $arr = [];
    foreach ($array as $k => $ar) {
        if (is_array($ar)) {
            getKeysByValue($val, $ar);
        } else {
            if($val == $ar)
            $arr[] = $k;
        }
    }
    return $arr;
}

if (! function_exists('getPublishStatus')) {
    function getPublishStatus($id = -1)
    {
        if($id == -1){
            return [
                ['id'=>0,'name'=>"Unpublished",'color'=>"danger"],
                ['id'=>1,'name'=>"Published",'color'=>"success"],
            ];
            }else{
                foreach(getPublishStatus() as $row){
                    if($id == $row['id']){
                    return $row;
                }
            }
            return ['id'=>0,'name'=>''];
        }
    }
}

if (! function_exists('getCategoryCount')) {
    function getCategoryCount($id)
    {
        return App\Models\Category::whereCategoryTypeId($id)->count();
    }
}

if (! function_exists('getSliderCount')) {
    function getSliderCount($id)
    {
        return App\Models\Slider::whereSliderTypeId($id)->count();
    }
}


function getSelectValues($arr,$noKey=true,$char=":"){
    if($noKey){
        $temp = [];
        foreach ($arr as $key => $val){
        $temp[] = str_after($val,":");
        }
        return $temp;
    }else{
        $temp = [];
        foreach ($arr as $key => $val){
            if(str_contains($val,$char)) {
                $temp[explode($char,$val)[0]] = explode($char,$val)[1];
            }else{
                $temp[$val] = $temp[$val];
            }
        }
        return $temp;
    }
}




if (! function_exists('getHelp')) {
    function getHelp($message)
    {
        return '<i class="ik ik-help-circle text-muted" title="'.$message.'"></i>';
    }
}
//
//// Categories List By Using Code
//
if (!function_exists('getCategoriesByCode')) {
    function getCategoriesByCode($code,$parent = null)
    {
        $chk = App\Models\CategoryType::whereCode($code)->first();
        if($chk){
            if($parent != null){
                return App\Models\Category::select('id','name','category_type_id','parent_id','icon')->whereCategoryTypeId($chk->id)->where('parent_id',$parent)->latest()->get();
            }
            return App\Models\Category::select('id','name','category_type_id','parent_id','icon')->whereCategoryTypeId($chk->id)->where('parent_id',null)->latest()->get();
        }
        return [];
    }
}

// Paragraph Content by Code
if (!function_exists('getParagraphContent')) {
    function getParagraphContent($code)
    {
        if(is_array($code)){
            $records = App\Models\ParagraphContent::select('code','value')->whereIn('code', $code)->get();
            $content = [];
            foreach ($records as $key => $record) {
                $content[$record->code] = $record->value;
            }
        }else{
            $content = App\Models\ParagraphContent::select('code','value')->where('code',$code)->first();
        }
        return $content;
    }
}


// 
//// Communication Helpers
// 

if (!function_exists('pushOnSiteNotification')) {
    function pushOnSiteNotification($data)
    {
        // Check if notification enable
        if(getSetting('notification') == 1){
            $notification = App\Models\Notification::create([
                'user_id' => $data['user_id'],
                'title' => $data['title'],
                'link' => $data['link'],
                'notification' => $data['notification'],
                'is_read' => 0, // unseen
            ]);
            return $notification;
        }
    }
}
// Check File Exists 
if (!function_exists('fileExists')) {
    function fileExists($path)
    {
        return File::exists($path);
    }
}


// 
//// Data Processing Helpers
// 

function taxFormatter($tax, $name, $slap, $amount)
{
    $tax_format = App\Models\Order::TAX_STRUCTURE;
    $tax_format['name'] = $name;
    $tax_format['slap'] = $slap;
    $tax_format['amount'] = $amount;
    return $tax_format;
}

function getTxnCode()
{
    $code = now()->format('Ymd').'-UID'.auth()->id().'-'.rand(0000,9999);
    if(App\Models\Order::where('txn_no', '=', $code)->count() > 0) {
        getTxnCode();
    }
    return $code;
}

function str_after($str, $search)
{
    return $search === '' ? $str : array_reverse(explode($search, $str, 2))[0];
}

// 
//// Typing Validations
// 

function getTypingValidation($code = -1)
{
    if($code == -1){
        return [
            ['code'=>"code",'pattern'=>"[^\s]+"],
            ['code'=>"email",'pattern'=>"[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$"],
            ['code'=>"search",'pattern'=>"[^'\x22]"],
        ];
        }else{
            foreach(getTypingValidation() as $row){
                if($code == $row['code']){
                return $row['code'];
            }
        }
        return null;
    }
    
}

if (!function_exists('manualEmail')) {
    function manualEmail($emails,$mailSubject,$mailBody,$replaceable,$data = []){

        // Replace User Defined Variables
        foreach (array_keys($replaceable) as $key) {
            $mailBody = str_replace($key, $replaceable[$key], $mailBody);
            $mailSubject = str_replace($key, $replaceable[$key], $mailSubject);
        }

        // Replace default Variables
        $mailBody = str_replace('{nl}', '<br>', $mailBody);
        $mailBody = str_replace('{br}', '<br>', $mailBody);
        $mailBody = str_replace('{app.name}', getSetting('app_name'), $mailBody);
        $mailBody = str_replace('{app.url}', url('/'), $mailBody);
        // Replace variables from Subject
        $mailSubject = str_replace('{app.name}', getSetting('app_name'), $mailSubject);
        $mailSubject = str_replace('{app.url}', url('/'), $mailSubject);
        $attachment = [];
        if(@$data['attachments'] && !empty($data['attachments']))
            $attachment = $data['attachments'];
        
        // With provided mail template
        $mail = \Mail::to($emails);
        if(@$data['cc'] && !empty($data['cc']))
            $mail->cc($data['cc']);
        if(@$data['bcc'] && !empty($data['bcc']))
            $mail->bcc($data['bcc']);
      

        if ((int)getSetting('mail_queue_enabled')) {
            $mail->send(new App\Mail\DynamicMailQueued($mailSubject, $mailBody),function($message) use($attachment){
                if (is_array($attachment)) {
                    foreach ($attachment as $file) {
                        $message->attach($file->getRealPath(), [
                            'as' => $file->getClientOriginalName(),
                            'mime' => $file->getClientMimeType()
                        ]);
                    }
                } else {
                    $message->attach($attachment->getRealPath(), [
                        'as' => $attachment->getClientOriginalName(),
                        'mime' => $attachment->getClientMimeType()
                    ]);
                }
            });
        } else {
            $mail->send(new App\Mail\DynamicMail($mailSubject, $mailBody),function($message) use($attachment){
                if (is_array($attachment)) {
                    foreach ($attachment as $file) {
                        $message->attach($file->getRealPath(), [
                            'as' => $file->getClientOriginalName(),
                            'mime' => $file->getClientMimeType()
                        ]);
                    }
                } else {
                    $message->attach($attachment->getRealPath(), [
                        'as' => $attachment->getClientOriginalName(),
                        'mime' => $attachment->getClientMimeType()
                    ]);
                }
            });
        }
    }
}
if (!function_exists('getBankName')) {
    function getBankName($id = -1)
    {
        if($id == -1){
            return [
                ["name"=>'AXIS Bank'],
                ["name"=>'ICICI Bank'],
                ["name"=>'SBI Bank'],
                ["name"=>'UNION Bank'],
                ["name"=>'HDFC Bank'],

                ];
            }else{
                foreach(getBankName() as $row){
                if($id == $row['id']){
                return $row;
                }
            }
            return ["name"=>' '];
        }
    }
}

function storeDefaultAddress($userId,$request=null)
{
    $data = new UserAddress();
    $data->user_id = $userId;
    $data->is_primary = $request->is_primary ?? 0;
    $arr = [
        'name'   => 'default address',
        'address_1' => null,
        'address_2' => null,
        'phone' => null,
        'type' => null,
        'pincode_id' => null,
        'country' => null,
        'state' => null,
        'city' => null
    ];
    $data->details = $arr;
    $data->save();
    return $data;

}
function getSellerAddresses($id = -1)
{
    if($id == -1){
        return [
            (object)['id'=>1,'name'=> 'Seller 1','address_1' => "near tilwada road gandhi nagar",'address_2' => "beside shri ram mandir",'phone' => "0000-000-000",'type' => "Home",'pincode_id' => "480661",'country' => "India",'state' =>"Madhya Pradesh",'city' => "seoni"],
            (object)['id'=>2,'name'=> 'Seller 1','address_1' => "near nehru road shukrawari road",'address_2' => "beside shri ram mandir",'phone' => "0000-000-000",'type' => "Office",'pincode_id' => "480661",'country' => "India",'state' =>"Madhya Pradesh",'city' => "seoni"],
            (object)['id'=>3,'name'=> 'Seller 2','address_1' => "near tilwada road gandhi nagar",'address_2' => "beside shri ram mandir",'phone' => "0000-000-000",'type' => "Home",'pincode_id' => "480661",'country' => "India",'state' =>"Madhya Pradesh",'city' => "seoni"],
            (object)['id'=>4,'name'=> 'Seller 2','address_1' => "near tilwada road gandhi nagar",'address_2' => "beside shri ram mandir",'phone' => "0000-000-000",'type' => "Office",'pincode_id' => "480661",'country' => "India",'state' =>"Madhya Pradesh",'city' => "seoni"],
        ];       
    }else{
        foreach(getSellerAddresses() as $address){
            if($address->id == $id)
                return $address;
        }
        return false;
    }
}
if (!function_exists('formatNumber')) {
    function formatNumber($number)
    {
        if ($number >= 10000000) {
            // Convert to crore (1Cr = 10 million)
            $formattedNumber = round($number / 10000000, 2) . 'Cr';
        } elseif ($number >= 100000) {
            // Convert to lakh (1L = 100 thousand)
            $formattedNumber = round($number / 100000, 2) . 'L';
        } elseif ($number >= 1000) {
            // Convert to thousand (1k = 1000)
            $formattedNumber = round($number / 1000, 2) . 'k';
        } else {
            // No conversion needed
            $formattedNumber = $number;
        }
    
        return $formattedNumber;
    }
    
 }
if (!function_exists('getGreetingBasedOnTime')) {
    function getGreetingBasedOnTime()
    {
        $utc_time  = auth()->user()->timezone;
        $timezone = $utc_time != null ? $utc_time : 'UTC';
        $dat = new DateTime('now', new DateTimeZone($timezone));
        $hour = $dat->format('H');
        if ($hour >= 20) {
            $greetings = "Good Night";
        } elseif ($hour > 17) {
            $greetings = "Good Evening";
        } elseif ($hour > 11) {
            $greetings = "Good Afternoon";
        } elseif ($hour < 12) {
            $greetings = "Good Morning";
        }
        return $greetings;
        
    }
 }

if (!function_exists('pushItemVisit')) {
    function pushItemVisit($item_id)
    {
        $item = App\Models\Item::where('id', $item_id)->first();
        $item->update([
            'views' => $item->views+1,
        ]);
        return true;
    }
}

if (!function_exists('getSliderData')) {
    function getSliderData($code)
    {
       return $sliderType = App\Models\SliderType::where('code', $code)->with('sliders')->first();
    }
}
function getExtensionFromMimeType($mimeType) {
    $mimeExtensions = [
        'image/jpeg' => 'jpg',
        'image/png' => 'png',
        'image/gif' => 'gif',
        'image/bmp' => 'bmp',
        'image/webp' => 'webp',
        'image/svg+xml' => 'svg',
        'video/mp4' => 'mp4',
        'video/mpeg' => 'mpeg',
        'video/quicktime' => 'mov',
        'video/x-flv' => 'flv',
        'video/x-msvideo' => 'avi',
        'video/x-ms-wmv' => 'wmv',
        'audio/mpeg' => 'mp3',
        'audio/wav' => 'wav',
        'audio/ogg' => 'ogg',
        'application/pdf' => 'pdf',
        'application/msword' => 'doc',
        'application/vnd.openxmlformats-officedocument.wordprocessingml.document' => 'docx',
        'application/vnd.ms-excel' => 'xls',
        'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' => 'xlsx',
        'application/vnd.ms-powerpoint' => 'ppt',
        'application/vnd.openxmlformats-officedocument.presentationml.presentation' => 'pptx',
        'application/zip' => 'zip',
        'application/x-gzip' => 'gzip',
        'application/x-tar' => 'tar',
        'text/plain' => 'txt',
        'text/html' => 'html',
        // Add more MIME types and their corresponding extensions as needed
    ];

    $mimeType = strtok($mimeType, ';');
    return $mimeExtensions[$mimeType] ?? null;
}
function mime2ext($mime)
{
  $all_mimes = '{"png":["image\/png","image\/x-png"],"bmp":["image\/bmp","image\/x-bmp","image\/x-bitmap","image\/x-xbitmap","image\/x-win-bitmap","image\/x-windows-bmp","image\/ms-bmp","image\/x-ms-bmp","application\/bmp","application\/x-bmp","application\/x-win-bitmap"],"gif":["image\/gif"],"jpeg":["image\/jpeg","image\/pjpeg"],"xspf":["application\/xspf+xml"],"vlc":["application\/videolan"],"wmv":["video\/x-ms-wmv","video\/x-ms-asf"],"au":["audio\/x-au"],"ac3":["audio\/ac3"],"flac":["audio\/x-flac"],"ogg":["audio\/ogg","video\/ogg","application\/ogg"],"kmz":["application\/vnd.google-earth.kmz"],"kml":["application\/vnd.google-earth.kml+xml"],"rtx":["text\/richtext"],"rtf":["text\/rtf"],"jar":["application\/java-archive","application\/x-java-application","application\/x-jar"],"zip":["application\/x-zip","application\/zip","application\/x-zip-compressed","application\/s-compressed","multipart\/x-zip"],"7zip":["application\/x-compressed"],"xml":["application\/xml","text\/xml"],"svg":["image\/svg+xml"],"3g2":["video\/3gpp2"],"3gp":["video\/3gp","video\/3gpp"],"mp4":["video\/mp4"],"m4a":["audio\/x-m4a"],"f4v":["video\/x-f4v"],"flv":["video\/x-flv"],"webm":["video\/webm"],"aac":["audio\/x-acc"],"m4u":["application\/vnd.mpegurl"],"pdf":["application\/pdf","application\/octet-stream"],"pptx":["application\/vnd.openxmlformats-officedocument.presentationml.presentation"],"ppt":["application\/powerpoint","application\/vnd.ms-powerpoint","application\/vnd.ms-office","application\/msword"],"docx":["application\/vnd.openxmlformats-officedocument.wordprocessingml.document"],"xlsx":["application\/vnd.openxmlformats-officedocument.spreadsheetml.sheet","application\/vnd.ms-excel"],"xl":["application\/excel"],"xls":["application\/msexcel","application\/x-msexcel","application\/x-ms-excel","application\/x-excel","application\/x-dos_ms_excel","application\/xls","application\/x-xls"],"xsl":["text\/xsl"],"mpeg":["video\/mpeg"],"mov":["video\/quicktime"],"avi":["video\/x-msvideo","video\/msvideo","video\/avi","application\/x-troff-msvideo"],"movie":["video\/x-sgi-movie"],"log":["text\/x-log"],"txt":["text\/plain"],"css":["text\/css"],"html":["text\/html"],"wav":["audio\/x-wav","audio\/wave","audio\/wav"],"xhtml":["application\/xhtml+xml"],"tar":["application\/x-tar"],"tgz":["application\/x-gzip-compressed"],"psd":["application\/x-photoshop","image\/vnd.adobe.photoshop"],"exe":["application\/x-msdownload"],"js":["application\/x-javascript"],"mp3":["audio\/mpeg","audio\/mpg","audio\/mpeg3","audio\/mp3"],"rar":["application\/x-rar","application\/rar","application\/x-rar-compressed"],"gzip":["application\/x-gzip"],"hqx":["application\/mac-binhex40","application\/mac-binhex","application\/x-binhex40","application\/x-mac-binhex40"],"cpt":["application\/mac-compactpro"],"bin":["application\/macbinary","application\/mac-binary","application\/x-binary","application\/x-macbinary"],"oda":["application\/oda"],"ai":["application\/postscript"],"smil":["application\/smil"],"mif":["application\/vnd.mif"],"wbxml":["application\/wbxml"],"wmlc":["application\/wmlc"],"dcr":["application\/x-director"],"dvi":["application\/x-dvi"],"gtar":["application\/x-gtar"],"php":["application\/x-httpd-php","application\/php","application\/x-php","text\/php","text\/x-php","application\/x-httpd-php-source"],"swf":["application\/x-shockwave-flash"],"sit":["application\/x-stuffit"],"z":["application\/x-compress"],"mid":["audio\/midi"],"aif":["audio\/x-aiff","audio\/aiff"],"ram":["audio\/x-pn-realaudio"],"rpm":["audio\/x-pn-realaudio-plugin"],"ra":["audio\/x-realaudio"],"rv":["video\/vnd.rn-realvideo"],"jp2":["image\/jp2","video\/mj2","image\/jpx","image\/jpm"],"tiff":["image\/tiff"],"eml":["message\/rfc822"],"pem":["application\/x-x509-user-cert","application\/x-pem-file"],"p10":["application\/x-pkcs10","application\/pkcs10"],"p12":["application\/x-pkcs12"],"p7a":["application\/x-pkcs7-signature"],"p7c":["application\/pkcs7-mime","application\/x-pkcs7-mime"],"p7r":["application\/x-pkcs7-certreqresp"],"p7s":["application\/pkcs7-signature"],"crt":["application\/x-x509-ca-cert","application\/pkix-cert"],"crl":["application\/pkix-crl","application\/pkcs-crl"],"pgp":["application\/pgp"],"gpg":["application\/gpg-keys"],"rsa":["application\/x-pkcs7"],"ics":["text\/calendar"],"zsh":["text\/x-scriptzsh"],"cdr":["application\/cdr","application\/coreldraw","application\/x-cdr","application\/x-coreldraw","image\/cdr","image\/x-cdr","zz-application\/zz-winassoc-cdr"],"wma":["audio\/x-ms-wma"],"vcf":["text\/x-vcard"],"srt":["text\/srt"],"vtt":["text\/vtt"],"ico":["image\/x-icon","image\/x-ico","image\/vnd.microsoft.icon"],"csv":["text\/x-comma-separated-values","text\/comma-separated-values","application\/vnd.msexcel"],"json":["application\/json","text\/json"]}';
  $all_mimes = json_decode($all_mimes,true);
  foreach($all_mimes as $key => $value ) 
    if( array_search($mime,$value) !== false ) return $key;
  return false;
}
if (!function_exists('getTextWrapped')) {
    function getTextWrapped($content, $class)
    {
        $wrapped_content = preg_replace("/\*\*(.*?)\*\*/", "<span class='$class'>$1</span>", $content);
        return $wrapped_content;
    }
}

if (!function_exists('getPermissionName')) {
    function getPermissionName($id)
    {
       return $permission_name = App\Models\Permission::where('id', $id)->first()->name;
    }
}

if (!function_exists('makeUrlFriendly')) {
    function makeUrlFriendly($param) {
        // Replace spaces with hyphens
        $param = str_replace(' ', '-', $param);
      
        // Remove any non-alphanumeric characters except hyphens
        $param = preg_replace('/[^a-zA-Z0-9-]/', '', $param);
      
        // Convert to lowercase
        $param = strtolower($param);
      
        return $param;
      }
}
//Support ticket subject 
if (!function_exists('getSupportPrioity')) {
    function getSupportPrioity() {
        return [
            ["id"=>1,"name"=>"Low"],
            ["id"=>2,"name"=>"Medium"],
            ["id"=>3,"name"=>"High"],
        ];
    }
}

if (!function_exists('secureToken')) {
    function secureToken($id , $mode='encrypt') 
    {
        if(env('SECURE_ENDPOINT') == 0){
            return $id;
        }
        if($mode == 'encrypt'){
            return encrypt($id);
        }
        else{
            return decrypt($id);
        }
        
    }
}

if (!function_exists('NameByEmail')) {
    function NameByEmail($email){
        $pattern = '/^([^@]*)@.*$/';
        preg_match($pattern, $email, $matches);
        $name = $matches[1];
        $name = ucwords(trim(preg_replace('/[^A-Za-z\s]/', ' ',preg_replace('/\d+/', '', $name))));
        return $name;
    }
}
if (!function_exists('getTemplateVariables')) {
    function getTemplateVariables($str)
    {
        $start='{';
        $end='}';
        $with_from_to=true;
        $arr = []; 
        $last_pos = 0;
        $last_pos = strpos($str, $start, $last_pos);
        while ($last_pos !== false) {
            $t = strpos($str, $end, $last_pos);
            $arr[] = ($with_from_to ? $start : '').substr($str, $last_pos + 1, $t - $last_pos - 1).($with_from_to ? $end : '');
            $last_pos = strpos($str, $start, $last_pos+1);
        }
        $arr[] = '{app.name}'; 
        $arr[] = '{app.url}'; 
        $arr[] = '{nl}'; 
        $arr[] = '{br}';
        $array = array_unique($arr);
        return $array;
    }
}
if (!function_exists('getNewAcquisitionForUsers')) {
    function getNewAcquisitionForUsers() {
        $previousMonth = \Carbon\Carbon::now()->subMonth();
        $latestMonth = \Carbon\Carbon::now();
        $previousMonthUsers = App\Models\User::whereRoleIs(['User'])->whereYear('created_at', $previousMonth->year)
        ->whereMonth('created_at', $previousMonth->month)
        ->count();
        $latestMonthUsers = App\Models\User::whereRoleIs(['User'])->whereYear('created_at', $latestMonth->year)
        ->whereMonth('created_at', $latestMonth->month)
        ->count();
         $count = $latestMonthUsers - $previousMonthUsers;
        if($count == 0){
            $count = $count;
        }else{
            if($count > 0){
                $count = '+'. $count;
            }else{
                $count = $count;
            }
        }
        return $count;
    }
}
if (!function_exists('getNewAcquisitionForOrders')) {
    function getNewAcquisitionForOrders() {
        $previousMonth = \Carbon\Carbon::now()->subMonth();
        $latestMonth = \Carbon\Carbon::now();
        $previousMonthUsers = App\Models\Order::whereYear('created_at', $previousMonth->year)
        ->whereMonth('created_at', $previousMonth->month)
        ->count();
        $latestMonthUsers = App\Models\Order::whereYear('created_at', $latestMonth->year)
        ->whereMonth('created_at', $latestMonth->month)
        ->count();
         $count = $latestMonthUsers - $previousMonthUsers;
        if($count == 0){
            $count = $count;
        }else{
            if($count > 0){
                $count = '+'. $count;
            }else{
                $count = $count;
            }
        }
        return $count;
    }
}
if (!function_exists('getFaqByCreatedBy')) {
    function getFaqByCreatedBy($user_id) {
        return $faqs = App\Models\Faq::where('created_by',$user_id)->count();
    }
}
if (!function_exists('getUserVote')) {
    function getUserVote($faq_id,$ip_address,$status) {
        return $vote = App\Models\Vote::where('faq_id',$faq_id)->where('ip_address',$ip_address)->where('status',$status)->first();
    }
}
if (!function_exists('getVoteCountByStatus')) {
       function getVoteCountByStatus($faq_id,$status) {
           return $voteCount = App\Models\Vote::where('faq_id',$faq_id)->where('status',$status)->count();
       }
}
