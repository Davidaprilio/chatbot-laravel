
@extends('layouts.admin')
@section('content')
    <link rel="stylesheet" href="bootstrap-iconpicker/css/bootstrap-iconpicker.min.css">
    <main class="page-content">
        <iframe id="preview-frame" src="https://chatbot.msd.biz.id/qa/demo" name="preview-frame" frameborder="0" noresize="noresize" style="height: 902px;">
        </iframe>
    @endsection

    @section('js')
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
        <script src='bootstrap-iconpicker/jquery-menu-editor.js?v3'></script>
        <script type="text/javascript" src="bootstrap-iconpicker/js/iconset/fontawesome5-3-1.min.js"></script>
        <script type="text/javascript" src="bootstrap-iconpicker/js/bootstrap-iconpicker.min.js"></script>
        <script>
            jQuery(document).ready(function() {
                /* =============== DEMO =============== */
                // menu items
                var arrayjson = [{
                    "href": "http://home.com",
                    "icon": "fas fa-home",
                    "text": "Home",
                    "target": "_top",
                    "title": "My Home"
                }, {
                    "icon": "fas fa-chart-bar",
                    "text": "Opcion2"
                }, {
                    "icon": "fas fa-bell",
                    "text": "Opcion3"
                }, {
                    "icon": "fas fa-crop",
                    "text": "Opcion4"
                }, {
                    "icon": "fas fa-flask",
                    "text": "Opcion5"
                }, {
                    "icon": "fas fa-map-marker",
                    "text": "Opcion6"
                }, {
                    "icon": "fas fa-search",
                    "text": "Opcion7",
                    "children": [{
                        "icon": "fas fa-plug",
                        "text": "Opcion7-1",
                        "children": [{
                            "icon": "fas fa-filter",
                            "text": "Opcion7-1-1"
                        }]
                    }]
                }];
                // icon picker options
                var iconPickerOptions = {
                    searchText: "Buscar...",
                    labelHeader: "{0}/{1}"
                };
                // sortable list options
                var sortableListOptions = {
                    placeholderCss: {
                        'background-color': "#cccccc"
                    }
                };

                var editor = new MenuEditor('myEditor', {
                    listOptions: sortableListOptions,
                    iconPicker: iconPickerOptions
                });
                editor.setForm($('#frmEdit'));
                editor.setUpdateButton($('#btnUpdate'));
                $('#btnReload').on('click', function() {
                    editor.setData(arrayjson);
                });

                $('#btnOutput').on('click', function() {
                    var str = editor.getString();
                    $("#out").text(str);
                });

                $("#btnUpdate").click(function() {
                    editor.update();
                });

                $('#btnAdd').click(function() {
                    editor.add();
                });
                /* ====================================== */

                /** PAGE ELEMENTS **/
                $('[data-toggle="tooltip"]').tooltip();
                $.getJSON("https://api.github.com/repos/davicotico/jQuery-Menu-Editor", function(data) {
                    $('#btnStars').html(data.stargazers_count);
                    $('#btnForks').html(data.forks_count);
                });
            });
        </script>
    @endsection
