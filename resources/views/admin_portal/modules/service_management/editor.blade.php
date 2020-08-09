<div class="row m-0">
   <div class="col-lg-6 p-4 border-right">
      <span class="">Major Categories</span>
      <br>
      <br>
      <div class="alert alert-primary" role="alert">
        Click on a Major Category box to load all corresponding Minor categories.
      </div>
      <ul class="list-group" id="sortable">
         @foreach($major_categories as $cat)
         <li class="list-group-item"  id="mjc-{{$cat->id}}" onclick="setMajorCatSelection(this.id);">
            <i class="fas fa-sort mr-3  handle-major-cat"></i>
            <input type="text" class="border-0 form-control-sm forn-control  "  style="min-width:400px!important;" id="in-{{$cat->id}}" onchange="update_major_cat_name(this.value, this.id);" placeholder="Enter service name"  value="{{$cat->service_name}}">
         </li>
         @endforeach
      </ul>
   </div>
   <div class="col-lg-6 p-4 border-right">
      <span class="">Minor Categories</span>
      <br>
      <br>
      <div class="alert alert-primary" role="alert">
        Click on a Major Category box to load all corresponding Minor categories.
      </div>
      <ul class="list-group" id="minor-sortable">
      </ul>
   </div>
</div>



<script>
var app_url = "{{secure_url('/')}}";
var csrf_token = "{{csrf_token()}}";
$.ajaxSetup({
         headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         }
         });

$(function() {
    $("#sortable").sortable();
    $("#sortable").disableSelection();
});

var $sortableList = $("#sortable");

var sortEventHandler = function(event, ui) {
    var listElements = $sortableList.children();
    update_phase_priority(listElements);
};

$sortableList.sortable({
    stop: sortEventHandler,
    handle: '.handle-major-cat',

});

$sortableList.on("drop", sortEventHandler);

function update_phase_priority(list) {
    var phases_priority_list = [];
    for (i = 0; i < list.length; ++i) {
        var tmp = list[i].id.substring(4);
        phases_priority_list.push(tmp);
    };
    $.ajax({
        type: "POST",
        url: "{{route('app_portal_admin_update_major_priority_list')}}",
        data: {
            'phases_priority_list': phases_priority_list,
            "_token": csrf_token,
        },
        success: function(results) {
            location.reload();
        },
        error: function(results, status, err) { 
            Snackbar.show({ text: 'Failed to Update Major Category Priority List.', pos: 'top-center' }); 
            
        }
    });
}

var major_cat_id = null;

function setMajorCatSelection(id){
    major_cat_id = id.substring(4);
    var el = document.getElementById(id);
    var container = document.getElementById('sortable').children;
    for (i = 0; i < container.length; i++) { 
        if(id == container[i].id) {
        container[i].classList = 'list-group-item bg-light';
        } else {
        container[i].classList = 'list-group-item  ';
        }
    }
    get_minor_cat(major_cat_id);
}

function update_major_cat_name(value, id) {
    if(value.length > 3 ) {
    $.ajax({
        type: "POST",
        url: "{{route('app_portal_admin_update_major_name')}}",
        data: {
            'value': value,
            'id' : id.substring(3),
            "_token": csrf_token,
        },
        success: function(results) {
            Snackbar.show({ text: 'Major category name changed to ' + value, pos: 'top-center' });
        },
        error: function(results, status, err) {
            console.log(err);
        }
    });
    } else {
        alert('Major category name must be atleast 3 characters long!')
    }
}

//minor category load values
function get_minor_cat(cat_id) {
    $.ajax({
        type: "POST",
        url: "{{route('app_portal_admin_fetch_minor_cat_list')}}",
        data: {
            'cat_id': cat_id,
            "_token": csrf_token,
        },
        success: function(results) {
            display_mnc_list(results, cat_id);
        },
        error: function(results, status, err) {
            console.log(err);
        }
    });
}

$(function() {
    $("#minor-sortable").sortable();
    $("#minor-sortable").disableSelection();
});

var $sortableListMinor= $("#minor-sortable");
var sortEventHandlerMinor = function(event, ui) {
    var listElements = $sortableListMinor.children();
    update_minor_priority(listElements);
};

$sortableListMinor.sortable({
    stop: sortEventHandlerMinor,
    handle: '.handle-minor-cat',

});
$sortableListMinor.on("drop", sortEventHandlerMinor);

//display minor category list
function display_mnc_list(task_list, major_cat_id) {
    major_cat_id = major_cat_id;
    var task_ul_list = document.getElementById("minor-sortable");
    task_ul_list.innerHTML = '';
    for (var i = 0; i < task_list.length; i++) {
        var li = document.createElement("li");
        li.classList = "list-group-item";
        li.id = 'mnc-' + task_list[i]['id'];

        var x = document.createElement("INPUT");
        x.setAttribute("type", "text");
        x.value = task_list[i]['service_subname'];
        x.classList = "form-control form-control-sm rounded-0 d-inline border-bottom"
        x.id = "imc-"+task_list[i]['id'];
        x.style.width = "400px";
        x.addEventListener("change", function(){ update_minor_cat_name(this.value, this.id); });
        var icon = document.createElement("i");
        icon.classList = "fas fa-sort mr-3  handle-minor-cat ";

        
       
        
        li.appendChild(icon);
        li.appendChild(x);
       // li.innerHTML = "<i class='fas fa-sort mr-3  handle-minor-cat'></i>" + ;
        task_ul_list.appendChild(li);
    };
}

function update_minor_cat_name(value, id) {
    if(value.length > 3 ) {
    $.ajax({
        type: "POST",
        url: "{{route('app_portal_admin_update_minor_name')}}",
        data: {
            'value': value,
            'id' : id.substring(4),
            "_token": csrf_token,
        },
        success: function(results) {
            Snackbar.show({ text: 'Minor category name changed to ' + value, pos: 'top-center' });
        },
        error: function(results, status, err) {
            console.log(err);
        }
    });
    } else {
        alert('Minor category name must be atleast 3 characters long!')
    }
}

function update_minor_priority(list) {
    console.log(list);
    var  phases_priority_list = [];
    for (i = 0; i < list.length; ++i) {
        var tmp = list[i].id.substring(4);
        phases_priority_list.push(tmp);
    };
    $.ajax({
        type: "POST",
        url: "{{route('app_portal_admin_update_minor_priority_list')}}",
        data: {
            'phases_priority_list': phases_priority_list,
            "_token": csrf_token,
        },
        success: function(results) {
            Snackbar.show({ text: 'Updated Minor Category Priority List.', pos: 'top-center' });
        },
        error: function(results, status, err) { 
            Snackbar.show({ text: 'Failed to Update Minor Category Priority List.', pos: 'top-center' }); 
            
        }
    });
}


function grabData(a) {
        
        var select = document.getElementById('sel2');
        select.innerHTML = "";
        $.ajax({
            type: "POST",
            url: "{{route('app_portal_admin_fetch_minor_cat_list')}}",
            data: {
                'id': a
            },
            success: function(results) {
   
                var opt = document.createElement("option");
                opt.value = '0000';
                //opt.disabled = true;
                opt.innerHTML = 'Select sub-category'; // whatever property it has
   
                // then append it to the select element
                select.appendChild(opt);
                for (i = 0; i < results.length; i++) {
   
                    var opt = document.createElement("option");
                    opt.value = results[i]['id'];
                    opt.innerHTML = results[i]['service_subname']; // whatever property it has
   
                    // then append it to the select element
                    select.appendChild(opt);
   
                }   
            },
            error: function(result, status, err) {
   
                console.log(err);
   
            }
        });
   
    }
</script>
@push('header-script')
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
@endpush