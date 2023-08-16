@extends('backend.layouts.empty') 
@section('title', 'Votes')
@section('content')
@php
/**
 * Vote 
 *
 * @category ZStarter
 *
 * @ref zCURD
 * @author  Defenzelite <hq@defenzelite.com>
 * @license https://www.defenzelite.com Defenzelite Private Limited
 * @version <zStarter: 1.1.0>
 * @link    https://www.defenzelite.com
 */
@endphp
   

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">                     
                    <div class="table-responsive">
                        <table id="table" class="table">
                            <thead>
                                <tr>                                      
                                    <th>Faq  </th>
                                    <th>Status</th>
                                    <th>User  </th>
                                    <th>Ip Address</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                @if($votes->count() > 0)
                                    @foreach($votes as  $vote)
                                        <tr>
                                            <td>{{fetchFirst(App\Models\'Faq',$vote['faq_id'],'name','--')}}</td>
                                             <td>{{$vote['status'] }}</td>
                                             <td>{{fetchFirst(App\Models\'User',$vote['user_id'],'name','--')}}</td>
                                             <td>{{$vote['ip_address'] }}</td>
                                                 
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td class="text-center" colspan="8">No Data Found...</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
