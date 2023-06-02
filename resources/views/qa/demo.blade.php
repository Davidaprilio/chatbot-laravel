<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Chatbot Flow</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"     integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" href="/bootstrap-iconpicker/css/bootstrap-iconpicker.min.css">
    {{-- token csrf --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">    
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style type="text/css">
        .container {
            margin: 150px auto;
        }

        body {
            background-color: #fafafa;
        }

        ol.example li.placeholder:before {
            position: absolute;
        }

        .list-group-item>div {
            margin-bottom: 5px;
        }
    </style>
</head>

<body>

    <div class="container">
        <div id="carbon-block" align="center"></div>        
        <div class="row">
            <div class="col-md-12">
                <h1>Template Chatbot </h1>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="card mb-3">
                    <div class="card-header">
                        <h5 class="float-left">Menu</h5>
                        <div class="float-right">
                            <button id="btnReload" type="button" class="btn btn-outline-secondary"><i class="fa fa-play"></i> Load Data</button>
                            <button id="btnOutput" type="button" class="btn btn-success"><i class="fas fa-check-square"></i> Save</button>
                        </div>
                    </div>
                    <div class="card-body">
                        <ul id="myEditor" class="sortableLists list-group">
                        </ul>
                    </div>
                </div>
                {{-- <p>Click the Output button to execute the function <code>getString();</code></p> --}}
                <div class="card d-none">
                    <div class="card-header">
                        <div class="float-right">
                            {{-- <button id="btnOutput" type="button" class="btn btn-success"><i class="fas fa-check-square"></i> Save</button> --}}
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group"><textarea id="out" class="form-control" cols="50" rows="10"></textarea>
                        </div>
                    </div>
                </div>
            </div>



            <div class="col-md-6">
                <div class="card border-primary mb-3">
                    <div class="card-header bg-primary text-white">Template Pesan</div>
                    <div class="card-body">
                        <form id="frmEdit" class="form-horizontal">
                            <div class="form-group">
                                <label for="text">Judul</label>
                                <div class="input-group">
                                    <input type="text" class="form-control item-menu" name="text" id="text"
                                        placeholder="Text">
                                    <div class="input-group-append">
                                        <button type="button" id="myEditor_icon"
                                            class="btn btn-outline-secondary"></button>
                                    </div>
                                </div>
                                <input type="hidden" name="icon" class="item-menu">
                            </div>
                            <div class="form-group">
                                <label for="href">Description</label>
                                <!-- <input type="text" class="form-control item-menu" id="href" name="href" placeholder="URL"> -->
                                    <textarea name="Keterangan" class="form-control item-menu" id="Keterangan" cols="30" rows="10"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="target">Validasi Jawaban</label>  
                                <select name="target" id="target" class="form-control item-menu">
                                    <option value="List Menu">List Menu</option>
                                    <option value="Jawaban Langsung">Jawaban Langsung</option>
                                    <option value="maps">Maps</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="Ya"></label>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer">
                        <button type="button" id="btnUpdate" class="btn btn-primary" disabled><i
                                class="fas fa-sync-alt"></i> Update</button>
                        <button type="button" id="btnAdd" class="btn btn-success"><i class="fas fa-plus"></i>
                            Add</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns"
        crossorigin="anonymous"></script>
    <script src='/bootstrap-iconpicker/jquery-menu-editor.js?v3'></script>
    <script type="text/javascript" src="/bootstrap-iconpicker/js/iconset/fontawesome5-3-1.min.js"></script>
    <script type="text/javascript" src="/bootstrap-iconpicker/js/bootstrap-iconpicker.min.js"></script>
    <script>
        jQuery(document).ready(function () {
            /* =============== DEMO =============== */
            // menu items
            var arrayjson = [{ "href": "http://home.com", "icon": "fas fa-home", "text": "Home", "target": "_top", "title": "My Home" }, { "icon": "fas fa-chart-bar", "text": "Opcion2" }, { "icon": "fas fa-bell", "text": "Opcion3" }, { "icon": "fas fa-crop", "text": "Opcion4" }, { "icon": "fas fa-flask", "text": "Opcion5" }, { "icon": "fas fa-map-marker", "text": "Opcion6" }, { "icon": "fas fa-search", "text": "Opcion7", "children": [{ "icon": "fas fa-plug", "text": "Opcion7-1", "children": [{ "icon": "fas fa-filter", "text": "Opcion7-1-1" }] }] }];
            // icon picker options
            var iconPickerOptions = { searchText: "Buscar...", labelHeader: "{0}/{1}" };
            // sortable list options
            var sortableListOptions = {
                placeholderCss: { 'background-color': "#cccccc" }
            };

            var editor = new MenuEditor('myEditor', { listOptions: sortableListOptions, iconPicker: iconPickerOptions });
            editor.setForm($('#frmEdit'));
            editor.setUpdateButton($('#btnUpdate'));
            function loadData() {
                $.ajax({
                    url: "{{ url('qa/ajax-load-qa') }}",
                    type: "GET",
                    success: function (data) {
                        console.log(data);
                        let json = data.data || arrayjson;
                        editor.setData(json);
                    }
                });
            }
            loadData();
            $('#btnReload').on('click', function () {
                // editor.setData(arrayjson);
                // ajax-load-qa
                loadData();
            });

            $('#btnOutput').on('click', function () {
                var str = editor.getString();
                $("#out").text(str);
                // ajax save json post
                $.ajax({
                    url: "{{ url('qa/save-json') }}",
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        json: str
                    },
                    success: function (data) {
                        console.log(data);
                    }
                });
            });

            $("#btnUpdate").click(function () {
                editor.update();
            });

            $('#btnAdd').click(function () {
                editor.add();
            });
            /* ====================================== */

            /** PAGE ELEMENTS **/
            $('[data-toggle="tooltip"]').tooltip();
            $.getJSON("https://api.github.com/repos/davicotico/jQuery-Menu-Editor", function (data) {
                $('#btnStars').html(data.stargazers_count);
                $('#btnForks').html(data.forks_count);
            });
        });
    </script>
    
    
</body>

</html>