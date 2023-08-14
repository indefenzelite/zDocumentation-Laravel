
@extends('layouts.main') 
@section('title', 'Create CRUD')
@section('content')
@php
$breadcrumb_arr = [
    ['name'=> ' ', 'url'=> "javascript:void(0);", 'class' => '']
];
$icons = [
    'fa-user',
    'fa-users',
    'fa-user-md',
    'fa-user-slash',
    'fa-users-slash',
    'fa-user-shield',
    'fa-user-times',
    'fa-user-tie',
    'fa-user-minus',
    'fa-user-plus',
    'fa-weight-hanging',
    'fa-window-close',
    'fa-wave-square',
    'fa-vr-cardboard',
    'fa-wifi',
    ];
@endphp
   
@push('head')
    <style>
        .btn:focus{
            box-shadow: none;
        }
        .icon-menus{
            right: 0px!important; width: 120%!important; height: 100px!important; overflow-y: auto;
        }
        
    </style>
@endpush
    <div class="container-fluid">
    	<div class="page-header mb-0">   
            <div class="row align-items-end">
                <div class="col-lg-12">
                    <div class="page-header-title">
                        <div class="d-flex justify-content-between">
                            <h5>{{ __('Create CRUD')}}</h5>
                            <nav class="breadcrumb-container" aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="{{route('admin.dashboard.index')}}" target="_blank">Dashboard</a>
                                    </li>
                                    <li class="breadcrumb-item">
                                        <a href="#">Create CRUD</a>
                                    </li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <i class="ik ik-x"></i>
                        </button>
                
                    </div>
                @endif 
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <i class="ik ik-x"></i>
                        </button>
                
                    </div>
                @endif 
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-12">
                <form action="">
                    <div class="card ">
                        <div class="card-header">
                            <h3>{{ __('CRUD Details')}}</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">                                    
                                <div class="col-12 col-md">
                                    <div class="form-group">
                                        <label class="form-control-label" for="name">Model Name <span class="text-danger">*</span></label>
                                        <input type="text" value="{{ old('model') }}" class="form-control first-upper model_name" name="model" id="model_name" placeholder="Model Name" requireds>
                                        <small class="text-muted">Enter model name for the crud e.g: <span class="text-accent">UserContact</span> (<span class="text-danger">Name needs to be in singular</span>)</small>
                                    </div>
                                </div>
                                <div class="col-12 col-md">
                                    <div class="form-group">
                                        <label class="form-control-label" for="name">Table Name <span class="text-danger">*</span></label>
                                        <input type="text" value="{{ old('name') }}" class="form-control lower crud_name" name="name" id="name" placeholder="Table Name" requireds>
                                        <small class="text-muted">Enter name for the crud e.g: <span class="text-accent">user_contacts</span> (<span class="text-danger">Name needs to be in plural</span>)</small>
                                    </div>
                                </div>
                                <div class="col-12 col-md">
                                    <div class="form-group">
                                        <label for="">Menu Icon<span class="text-danger">*</span></label><br>
                                        <div class="btn-group">
                                            <input class="form-control" name="menu_icon">
                                            <button type="button" style="min-height:35px;" class="btn btn-sm btn-secondary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                              <i class="fa fa-thumbs-up"></i>
                                            </button>
                                            <div class="dropdown-menu icon-menus">
                                                @foreach($icons as $icon)
                                                <span class=" icon-sm m-2" data-icon="fas {{ $icon }}"><i class="fas {{ $icon }} fa-lg"></i></span>
                                                @endforeach
                                            </div>
                                          </div>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <a class="dropdown-item" href="#">Action</a>
                                            <a class="dropdown-item" href="#">Another action</a>
                                            <a class="dropdown-item" href="#">Something else here</a>
                                          </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row mb-2">
                               <div class="col-6">
                                    <label for="">Form Splits in 2 parts i.e. Left/Right</label>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="">Left Column</label>
                                            <input type="number" name="left_col" value="8" class="form-control">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="">Right Column <small>(having save btn)</small></label>
                                            <input type="number" name="right_col" value="4" class="form-control">
                                        </div>
                                    </div>
                               </div>
                               <div class="col-6">
                                    <label for="">Add Card in both Columns</label>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="">Left Card Group</label>
                                            <input type="number" name="left_card" value="1" class="form-control">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="">Right Card Group <small>(having save btn)</small></label>
                                            <input type="number" name="right_card" value="1" class="form-control">
                                        </div>
                                    </div>
                               </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-md-12">
                                    <label for="">Under In Modules:</label>
                                    <label class="form-check-label">
                                        <input name="" type="checkbox" checked=""><span class="checkbox-label">Admin CRUD</span>
                                    </label>
                                    <label for=""><span class="" title="resources/views/admin"><i class="fa fa-info-circle"></i> View Path</span></label>
                                    <label for=""><span class="" title="App\Http\Controllers\Admin"> <i class="fa fa-info-circle"></i> Controllers Path</span></label>
                                    <label for=""><span class="" title="admin.php"> <i class="fa fa-info-circle"></i> Routes </span></label>
                                    <label class="form-check-label">
                                        <input name="" type="checkbox" ><span class="checkbox-label">User CRUD</span>
                                    </label>
                                    <label for=""><span class="" title="resources/views/user"><i class="fa fa-info-circle"></i> View Path</span></label>
                                    <label for=""><span class="" title="App\Http\Controllers\User"> <i class="fa fa-info-circle"></i> Controllers Path</span></label>
                                    <label for=""><span class="" title="user.php"> <i class="fa fa-info-circle"></i> Routes </span></label>
                                </div>
                                <div class="col-12 col-md-12 my-2">
                                    <label for="">CRUD Addons:</label>
                                    <label class="form-check-label" for="softdelete"><input type="checkbox" id="softdelete" name="softdelete" value="1" @if(old('softdelete') == 1) checked @endif /><span class="checkbox-label"> Soft Delete</span></label>
                                    <label class="form-check-label" for="api"><input type="checkbox" id="api" name="api" value="1" @if(old('api') == 1) checked @endif /><span class="checkbox-label"> Generate API</span></label>
                                    <label class="form-check-label" for="date_filter"><input type="checkbox" id="date_filter" name="date_filter" value="1" checked /><span class="checkbox-label"> Date Filter</span></label>
                                    <label class="form-check-label" for="mail"><input type="checkbox" id="mail" name="mail" value="1" @if(old('mail') == 1) checked @endif /><span class="checkbox-label"> Mail Notification</span></label>
                                    <label class="form-check-label" for="notification"><input type="checkbox" id="notification" name="notification" value="1"@if(old('notification') == 1) checked @endif  /><span class="checkbox-label"> Site Notification</span></label>
                                    <label class="form-check-label" for="excel_btn"><input type="checkbox" id="excel_btn" name="excel_btn" value="1"@if(old('excel_btn') == 1) checked @endif  /><span class="checkbox-label"> Excel </span></label>
                                    <label class="form-check-label" for="print_btn"><input type="checkbox" id="print_btn" name="print_btn" value="1"@if(old('print_btn') == 1) checked @endif  /><span class="checkbox-label"> Print</span></label>
                                
                                </div>
                                <div class="col-12 col-md-12">
                                    <label for="">Form Options:</label>
                                    <label class="form-check-label">
                                        <input name="" type="checkbox" checked=""><span class="checkbox-label">Create form</span>
                                    </label>
                                    <label class="form-check-label">
                                        <input name="" type="checkbox" checked=""><span class="checkbox-label">Edit form</span>
                                    </label>
                                    <label class="form-check-label">
                                        <input name="" type="checkbox" checked=""><span class="checkbox-label">Show page</span>
                                    </label>
                                    <label class="form-check-label">
                                        <input name="" type="checkbox" checked=""><span class="checkbox-label">Delete action</span>
                                    </label>
                                    <label class="form-check-label">
                                        <input name="" type="checkbox" checked=""><span class="checkbox-label">Multi-delete action</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h3>{{ __('Fields')}}</h3>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th class="">&nbsp;</th>
                                            <th>Field Type</th>
                                            <th>Database Column</th>
                                            <th>Visual Title</th>
                                            <th>In List</th>
                                            <th>In Create</th>
                                            <th>In Edit</th>
                                            <th>In Show</th>
                                            <th>Is Sortable</th>
                                            <th>Required</th>
                                            <th>Nullable</th>
                                            <th>Unique</th>
                                            <th>Multi Action</th>
                                            <th>Export</th>
                                            <th>Import</th>
                                            <th>Edit</th>
                                            <th>Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody id="sortable">
                                        <tr >
                                            <td class="field-handle-column">
                                                {{-- <span class="btn btn-info text-white"> #</span> --}}
                                            </td>
                                            <td>auto_increment</td>
                                            <td>id</td>
                                            <td>ID</td>
                                            <td><i class="changeIcon fa fa-check text-success fa-2x" data-field-status="1"></i></td>
                                            <td><button class="btn bg-white fw-600 changeIcon" type="button"  data-field-status="1"><i class="fa fa-check text-success fa-2x"></i></button></td>
                                            <td><i class="changeIcon fa fa-check text-success fa-2x" data-field-status="1"></i></td>
                                            <td><button class="btn bg-white fw-600 changeIcon" type="button"  data-field-status="1"><i class="fa fa-check text-success fa-2x"></i></button></td>
                                            <td><i class="changeIcon fa fa-check text-success fa-2x" data-field-status="1"></i></td>
                                            <td><button class="btn bg-white fw-600 changeIcon" type="button"  data-field-status="1"><i class="fa fa-check text-success fa-2x"></i></button></td>
                                            <td><i class="changeIcon fa fa-check text-success fa-2x" data-field-status="1"></i></td>
                                            <td><button class="btn bg-white fw-600 changeIcon" type="button"  data-field-status="1"><i class="fa fa-check text-success fa-2x"></i></button></td>
                                            <td><i class="changeIcon fa fa-check text-success fa-2x" data-field-status="1"></i></td>
                                            <td><button class="btn bg-white fw-600 changeIcon" type="button"  data-field-status="1"><i class="fa fa-check text-success fa-2x"></i></button></td>
                                            <td><i class="changeIcon fa fa-check text-success fa-2x" data-field-status="1"></i></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td  class="field-handle-column">
                                                {{-- <span class="btn btn-info text-white"> #</span> --}}
                                            </td>
                                            <td>datetime</td>
                                            <td>created_at</td>
                                            <td>Created at</td>
                                            <td><button class="btn bg-white fw-700 changeIcon" data-field-status="0" type="button" ><i class="fa fa-times text-danger fa-2x"  ></i></button></td>
                                            <td><button class="btn bg-white fw-600 changeIcon"  data-field-status="0" type="button"><i class="fa fa-times text-danger fa-2x" ></i></button></td>
                                            <td><button class="btn bg-white fw-700 changeIcon" data-field-status="0" type="button" ><i class="fa fa-times text-danger fa-2x"  ></i></button></td>
                                            <td><button class="btn bg-white fw-600 changeIcon"  data-field-status="0" type="button"><i class="fa fa-times text-danger fa-2x" ></i></button></td>
                                            <td><button class="btn bg-white fw-700 changeIcon" data-field-status="0" type="button" ><i class="fa fa-times text-danger fa-2x"  ></i></button></td>
                                            <td><button class="btn bg-white fw-600 changeIcon"  data-field-status="0" type="button"><i class="fa fa-times text-danger fa-2x" ></i></button></td>
                                            <td><button class="btn bg-white fw-700 changeIcon" data-field-status="0" type="button" ><i class="fa fa-times text-danger fa-2x"  ></i></button></td>
                                            <td><button class="btn bg-white fw-600 changeIcon"  data-field-status="0" type="button"><i class="fa fa-times text-danger fa-2x" ></i></button></td>
                                            <td><button class="btn bg-white fw-700 changeIcon" data-field-status="0" type="button" ><i class="fa fa-times text-danger fa-2x"  ></i></button></td>
                                            <td><button class="btn bg-white fw-600 changeIcon"  data-field-status="0" type="button"><i class="fa fa-times text-danger fa-2x" ></i></button></td>
                                            <td><button class="btn bg-white fw-600 changeIcon"  data-field-status="0" type="button"><i class="fa fa-times text-danger fa-2x" ></i></button></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td >
                                                {{-- <span class="btn btn-info text-white"> #</span> --}}
                                            </td>
                                            <td>datetime</td>
                                            <td>updated_at</td>
                                            <td>updated at</td>
                                            <td><button class="btn bg-white fw-700 changeIcon" data-field-status="0" type="button" ><i class="fa fa-times text-danger fa-2x"  ></i></button></td>
                                            <td><button class="btn bg-white fw-600 changeIcon"  data-field-status="0" type="button"><i class="fa fa-times text-danger fa-2x" ></i></button></td>
                                            <td><button class="btn bg-white fw-700 changeIcon" data-field-status="0" type="button" ><i class="fa fa-times text-danger fa-2x"  ></i></button></td>
                                            <td><button class="btn bg-white fw-600 changeIcon"  data-field-status="0" type="button"><i class="fa fa-times text-danger fa-2x" ></i></button></td>
                                            <td><button class="btn bg-white fw-700 changeIcon" data-field-status="0" type="button" ><i class="fa fa-times text-danger fa-2x"  ></i></button></td>
                                            <td><button class="btn bg-white fw-600 changeIcon"  data-field-status="0" type="button"><i class="fa fa-times text-danger fa-2x" ></i></button></td>
                                            <td><button class="btn bg-white fw-700 changeIcon" data-field-status="0" type="button" ><i class="fa fa-times text-danger fa-2x"  ></i></button></td>
                                            <td><button class="btn bg-white fw-600 changeIcon"  data-field-status="0" type="button"><i class="fa fa-times text-danger fa-2x" ></i></button></td>
                                            <td><button class="btn bg-white fw-700 changeIcon" data-field-status="0" type="button" ><i class="fa fa-times text-danger fa-2x"  ></i></button></td>
                                            <td><button class="btn bg-white fw-600 changeIcon"  data-field-status="0" type="button"><i class="fa fa-times text-danger fa-2x" ></i></button></td>
                                            <td><button class="btn bg-white fw-600 changeIcon"  data-field-status="0" type="button"><i class="fa fa-times text-danger fa-2x" ></i></button></td>
                                          
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr class="softdelete d-none">
                                            <td >
                                                {{-- <span class="btn btn-info text-white"> #</span> --}}
                                            </td>
                                            <td>datetime</td>
                                            <td>deleted_at</td>
                                            <td>deleted at</td>
                                            <td><button class="btn bg-white fw-700 changeIcon" data-field-status="0" type="button" ><i class="fa fa-times text-danger fa-2x"  ></i></button></td>
                                            <td><button class="btn bg-white fw-600 changeIcon"  data-field-status="0" type="button"><i class="fa fa-times text-danger fa-2x" ></i></button></td>
                                            <td><button class="btn bg-white fw-700 changeIcon" data-field-status="0" type="button" ><i class="fa fa-times text-danger fa-2x"  ></i></button></td>
                                            <td><button class="btn bg-white fw-600 changeIcon"  data-field-status="0" type="button"><i class="fa fa-times text-danger fa-2x" ></i></button></td>
                                            <td><button class="btn bg-white fw-700 changeIcon" data-field-status="0" type="button" ><i class="fa fa-times text-danger fa-2x"  ></i></button></td>
                                            <td><button class="btn bg-white fw-600 changeIcon"  data-field-status="0" type="button"><i class="fa fa-times text-danger fa-2x" ></i></button></td>
                                            <td><button class="btn bg-white fw-700 changeIcon" data-field-status="0" type="button" ><i class="fa fa-times text-danger fa-2x"  ></i></button></td>
                                            <td><button class="btn bg-white fw-600 changeIcon"  data-field-status="0" type="button"><i class="fa fa-times text-danger fa-2x" ></i></button></td>
                                            <td><button class="btn bg-white fw-700 changeIcon" data-field-status="0" type="button" ><i class="fa fa-times text-danger fa-2x"  ></i></button></td>
                                            <td><button class="btn bg-white fw-700 changeIcon" data-field-status="0" type="button" ><i class="fa fa-times text-danger fa-2x"  ></i></button></td>
                                            <td><button class="btn bg-white fw-600 changeIcon"  data-field-status="0" type="button"><i class="fa fa-times text-danger fa-2x" ></i></button></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <button data-toggle="modal" data-target="#createModule" class="btn btn-info btn-block" type="button"><i class="fa fa-plus"></i>Add new field</button>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h3>{{ __('Table')}}</h3>
                        </div>
                        <div class="card-body">
                            
                        </div>
                    </div>
                    <div class="">
                        <a class="btn btn-default float-right" href="">Cancel</a>
                        <button class="btn btn-primary float-right" type="submit">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @include('crudgenrator.module-fields')
    <!-- push external js -->
    @push('script')
    <script src="{{ asset('admin/js/validation.js') }}"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <script>
        var pluralized = (function () {
            const vowels = "aeiou";
        
            const irregulars = { "addendum": "addenda", "aircraft": "aircraft", "alumna": "alumnae", "alumnus": "alumni", "analysis": "analyses", "antenna": "antennae", "antithesis": "antitheses", "apex": "apices", "appendix": "appendices", "axis": "axes", "bacillus": "bacilli", "bacterium": "bacteria", "basis": "bases", "beau": "beaux", "bison": "bison", "bureau": "bureaux", "cactus": "cacti", "château": "châteaux", "child": "children", "codex": "codices", "concerto": "concerti", "corpus": "corpora", "crisis": "crises", "criterion": "criteria", "curriculum": "curricula", "datum": "data", "deer": "deer", "diagnosis": "diagnoses", "die": "dice", "dwarf": "dwarves", "ellipsis": "ellipses", "erratum": "errata", "faux pas": "faux pas", "fez": "fezzes", "fish": "fish", "focus": "foci", "foot": "feet", "formula": "formulae", "fungus": "fungi", "genus": "genera", "goose": "geese", "graffito": "graffiti", "grouse": "grouse", "half": "halves", "hoof": "hooves", "hypothesis": "hypotheses", "index": "indices", "larva": "larvae", "libretto": "libretti", "loaf": "loaves", "locus": "loci", "louse": "lice", "man": "men", "matrix": "matrices", "medium": "media", "memorandum": "memoranda", "minutia": "minutiae", "moose": "moose", "mouse": "mice", "nebula": "nebulae", "nucleus": "nuclei", "oasis": "oases", "offspring": "offspring", "opus": "opera", "ovum": "ova", "ox": "oxen", "parenthesis": "parentheses", "phenomenon": "phenomena", "phylum": "phyla", "quiz": "quizzes", "radius": "radii", "referendum": "referenda", "salmon": "salmon", "scarf": "scarves", "self": "selves", "series": "series", "sheep": "sheep", "shrimp": "shrimp", "species": "species", "stimulus": "stimuli", "stratum": "strata", "swine": "swine", "syllabus": "syllabi", "symposium": "symposia", "synopsis": "synopses", "tableau": "tableaux", "thesis": "theses", "thief": "thieves", "tooth": "teeth", "trout": "trout", "tuna": "tuna", "vertebra": "vertebrae", "vertex": "vertices", "vita": "vitae", "vortex": "vortices", "wharf": "wharves", "wife": "wives", "wolf": "wolves", "woman": "women", "guy": "guys", "buy": "buys", "person": "people" };
        
            function pluralized(word) {
                word = word.toLowerCase();
        
        
                if (irregulars[word]) {
                    return irregulars[word];
                }
        
                if (word.length >= 2 && vowels.includes(word[word.length - 2])) {
                    return word + "s";
                }
        
                if (word.endsWith("s") || word.endsWith("sh") || word.endsWith("ch") || word.endsWith("x") || word.endsWith("z")) {
                    return word + "es";
                }
        
                if (word.endsWith("y")) {
                    return word.slice(0, -1) + "ies";
                }
        
        
                return word + "s";
            }
        
            return pluralized;
        })();
        String.prototype.ucwords = function() {
            return (this + '').replace(/^([a-z])|\s+([a-z])/g, function ($1) {
                return $1.toUpperCase();
            });// w w  w.j  a  va  2 s  .c om
        }
    </script>
    <script>
        $('#softdelete').on('click', function(){
            if($(this).prop('checked') == true)
            $('.softdelete').removeClass('d-none');
            else
            $('.softdelete').addClass('d-none');
        })
        function selectRefresh() {
            $('.select2').select2({
                //-^^^^^^^^--- update here
                tags: true,
                placeholder: "Select an Option",
                allowClear: true,
                width: '100%'
            });
        }
        $(document).on('input', '.lower', function (e) {
                    allLower(e);
                })
                $(document).on('focusout', '.crud_name', function (e) {
                    let element = e.target.value;
                    if(element[element.length-1] != "s"){
                        e.target.value = pluralize(0,e.target.value);
                    }
                })
                function singularize(event) {
                    word = event.target.value;
                    const endings = {
                        ves: 'fe',
                        ies: 'y',
                        i: 'us',
                        zes: '',
                        ses: '',
                        es: '',
                        s: ''
                    };
                    event.target.value = word.replace(
                        new RegExp(`(${Object.keys(endings).join('|')})$`), 
                        r => endings[r]
                    );
                }
                const pluralize = (val, word, plural = word + 's') => {
                    const _pluralize = (num, word, plural = word + 's') =>
                        [1, -1].includes(Number(num)) ? word : plural;
                    if (typeof val === 'object') return (num, word) => _pluralize(num, word, val[word]);
                    return _pluralize(val, word, plural);
                };

                function firstUpper(event) {
                    let words = event.target.value.split(/\s+/g);
                    let newWords = words.map(function(element){
                        return element !== "" ?  element[0].toUpperCase() + element.substr(1, element.length) : "";
                    });
                    event.target.value = newWords.join("");
                }
            
                function allLower(event) {
                    let words = event.target.value.toLowerCase().split(/\s+/g);
        
                    event.target.value = words.join("");
                    return event.target.value;
                }
                
                function slugFunction() {
                    let x = document.getElementById("slugInput").value;
                    document.getElementById("slugOutput").innerHTML = "{{ url('/page/') }}/" + convertToSlug(x);
                }
                function convertToSlug(Text)
                {
                    return Text
                        .toLowerCase()
                        .replace(/ /g,'-')
                        .replace(/[^\w-]+/g,'')
                        ;
                }
        $('.icon-sm').click(function () {
            $('[name=menu_icon]').val($(this).data('icon'));
        });
        $(document).ready(function() {
                $('.select2').each(function () {
                    $(this).select2();
        });
        $(document).on('input', '.first-upper', function (e) {
                firstUpper(e);
            })
            $(document).on('focusout', '.model_name', function (e) {
                singularize(e);
                let str= e.target.value;
                // s = str.replace(/([a-z])([A-Z])/g, '$1_$2');
                // $('.crud_name').val(s.toLowerCase());
                // $('.crud_name').focus();
                s = str.replace(/([A-Z])/g, '_$1');
                str = s.toLowerCase().substring(1);
                console.log(pluralized(str));
                $('.crud_name').val(pluralized(str));
                $('.crud_name').focus();
            })
            $(document).on('keyup', '.col_name, .media_col_name', function(e) {
                // console.log(e.which);
                let col_id = $(this).data('id');
               text = allLower(e);
               text = text.replace(/ /g,'_').replace(/-/g,'').replace(/[^\w-]+/g,'');
               if (e.which == 32 || e.which == 45){
                   console.log('Space or hypen Detected');
                   return false;
               }
                $(this).val(text);
                let label = text.replace(/_/g, ' ');
                label = label.replace('Id', '');
                label = label.replace('Is', '');
                $('.label_name').val(label.ucwords());
            //     if($(this).hasClass('col_name'))
            //    $('#validation'+col_id).val(text);
            });
            $(document).on('change', '.col_name, .media_col_name', function(e) {
                // console.log(e.which);
                let col_id = $(this).data('id');
                let $this = $(this);
               text = allLower(e);
               let count = 0;
               $('.col_name').each(function(){
                    if($(this).val() == text && col_id != $(this).data('id')){
                        count++;
                    }
               })
               if(count != 0){
                   $(this).val('');
                    alert('Please enter unique column names.');
               }
                if (e.which == 32 || e.which == 45){
                    console.log('Space or hypen Detected');
                    return false;
                }
                if($this.hasClass('col_name')){
                    autoSelect(text,$(this));
                    $('#validation'+col_id).val(text);
                }
            });
        });
        $( "#sortable" ).sortable({
            handle: "td.field-handle-column",
            placeholder: "ui-state-highlight"
        });
    </script>
    {{-- calcualtion script start --}}
    <script>
        var leftColValue = 8;
        var rightColValue = 4;
        var leftCardsCount = 1; 
        var rightCardsCount = 1; 
        $('[name=left_col]').change(function(){
            leftColValue = $(this).val();
        });
        $('[name=right_col]').change(function(){
            rightColValue = $(this).val();
        });
        $('[name=left_card]').change(function(){
            leftCardsCount = $(this).val();
        });
        $('[name=right_card]').change(function(){
            rightCardsCount = $(this).val();
        });
        $('[name=direction]').change(function(){
            let html = '<option value="1">1<option> '
           for(i = 2; i <= leftCardsCount+rightCardsCount; i++)
           html += '<option value="'+i+'">'+i+'</option>';
            $('[name=field_group]').html(html);
        });
    </script>
    {{-- calcualtion script end --}}
    <script>

            $(document).on('change', '#type', function () {
                var col_id = $('.col_name').data('id');
                var col_value = $('.col_name').val();
                var target1 = $('.table-div');
                console.log(target1);
                console.log($(this).val());
                if($(this).val() === 'select_via_table') {
                    target1.find('.table').addClass('select2').removeClass('d-none');
                } else  {
                    target1.find('.table').removeClass('select2').addClass('d-none').siblings('.select2').remove();
                } 
                $(this).parent().parent().find('[value="multiple"]').attr('disabled', true);
                if($(this).val() == "select" || $(this).val() == "select_via_table" || $(this).val() == "file")  {
                    $(this).parent().parent().find('[value="multiple"]').attr('disabled', false);
                }
                selectRefresh();
            })
    </script>
    @endpush
@endsection
 

