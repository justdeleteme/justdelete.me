<?php
$sites = json_decode(file_get_contents("sites.json"));
$definitions = json_decode(file_get_contents('definitions.json'));
$langs = preg_split("/,/", $definitions[1]->langs);

if (isset($_GET['deldefinition']))
{
    $definitionname = $_GET['deldefinition'];
    unset($definitions[0]->$definitionname);
    file_put_contents("definitions.json", json_encode($definitions, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE)); 
    exit;
}
else if (isset($_GET['editdefinition']) && isset($_GET['lang']) && isset($_GET['text']))
{
    $definitionname = $_GET['editdefinition'];
    $lang = $_GET['lang'];
    $text = $_GET['text'];
    $definitions[0]->$definitionname->$lang = $text;
    file_put_contents("definitions.json", json_encode($definitions, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE)); 
    exit;
}
else if (isset($_GET['newlanguage']))
{
    $newlang = "," . $_GET['newlanguage'];
    
    $definitions[1]->langs = $definitions[1]->langs . $newlang;
    file_put_contents("definitions.json", json_encode($definitions, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE)); 
}
?>
<!doctype html>

<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>JustDelete.me Developers Helper</title>
        <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
        <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
        <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>   
        <script src="./inc/jquery.autosize.min.js"></script>
        <script>
            $(function() {
                $(".accordion-resizer").resizable({
                    minHeight: 140,
                    minWidth: 200,
                    resize: function() {
                        $("#accordion").accordion("refresh");
                    }
                });
                $("#accordion-sites").accordion({
                    heightStyle: "content",
                    autoHeight: false,
                    clearStyle: true
                });
                $("#accordion-translations").accordion({
                    heightStyle: "content",
                    autoHeight: false,
                    clearStyle: true
                });
                $('textarea').autosize();
                $(document).on('click', ".edit", function(event) {
                    event.preventDefault();
                    var status =  $(this).next().next().prop("disabled");
                   
                    if (status)
                    {
                        $(this).next().next().prop("disabled", false);
                        $(this).text("Save edit");
                        $(this).after("&nbsp;<a class='edit-cancel' href='#'>Cancel</a>");
                    }
                    else if (!status)
                    {                    
                        $(this).next().remove();
                        $(this).next().next().prop("disabled", true);
                        $(this).text("Edit");
                        var parent = $(this).closest('div');
                        var head = parent.prev('h3');
                        var definitionname = head.text();
                        var lang = $(this).prev().text();
                        var text = $(this).next().next().val();
                        $.get("helper.php", {editdefinition: definitionname, lang: lang, text: text});
                    }
                });
                $(document).on('click', ".edit-cancel", function(event) {
                    event.preventDefault();
                    if ($(this).next().next().css("backgroundColor") !== "")
                        $(this).next().next().css("background-color", "");
                    $(this).next().next().prop("disabled", true);
                    $(this).prev().text("Edit");
                    $(this).remove();                 
                });
                $('.del-definition').click(function(event) {
                    event.preventDefault();
                    var parent = $(this).closest('div');
                    var head = parent.prev('h3');
                    var definitionname = head.text();
                    $.get("helper.php", {deldefinition: definitionname});
                    parent.add(head).fadeOut('slow', function() {
                        $(this).remove();
                    });
                });
                $("#tabs").tabs();
                $("#search").click(function(event) {
                    $(this).val("");
                }).keyup(function() {
                    var searchText = $(this).val().toLowerCase();
                    if (searchText.length > 0) {
                        $('#sites h3').each(function() {
                            var currentText = $(this).text(),
                            showCurrent = currentText.toLowerCase().indexOf(searchText) === 0;
                            var parent = $(this).next('div');
                            if (!showCurrent)
                            {
                                parent.add($(this)).hide();
                            }
                            else
                            {
                                parent.add($(this)).show();
                            }
                        })
                    } else {
                        $('#sites h3').show();
                    }
                    return false;
                });
                $("#newlanguagedef").click(function(event) {
                    var language = prompt("Enter the new language code (Example: \"en\"):", "");
                    if (language.length != 2)
                    {
                        alert("The language code must be two characters long");
                    }
                    else
                    {
                        alert('Fill all yellow fields with the translation');                    
                        $('#definitions p').each(function() {
                            $(this).after('<label for="lang">' + language + '</label> <a class="edit" href="#">Save Edit</a>&nbsp;<a class="edit-cancel" href="#">Cancel</a><br><textarea style="width: 100%; background-color:#FFFF66;"></textarea>');
                            $('textarea').autosize();                            
                        })
                        $('#definitions div').each(function() {
                            $(this).slideDown();
                        })
                        $.get("helper.php", {newlanguage: language});
                    }
                });
            });
        </script>
        <style>
            body {
               	font-family: "Trebuchet MS", "Helvetica", "Arial",  "Verdana", "sans-serif";
                font-size: 62.5%;
                margin: 0;
                padding: 0;
                background-color: #D4D8DC;
            }
            #tabs {               
                margin: 20px auto;             
                width: 50%;                       
            }     
            input {
                width: 100%;
                height: auto;
            }
            #search {
                padding: 5px;
                width: 20%;
                float:right;
            }
        </style>
    </head>
    <body>
        <div id="tabs">
            <ul>
                <li><a href="#definitions">Definitions</a></li>
                <li><a href="#sites">Sites</a></li>               
            </ul>
            <div id="definitions">  
                <a id="newlanguagedef" href="#">Create new language definitions</a><br><br>
            <div id="accordion-translations">
                <?php
                foreach ($definitions[0] as $definition => $values) {
                    echo "<h3>" . $definition . "</h3>";
                    echo "<div><p><a class='del-definition' href='#'>Delete definition</a><br><br>";
                    foreach ($langs as $lang) {
                        echo "<label for='lang'>" . $lang . "</label> <a class='edit' href='#'>Edit</a><br>";
                        echo "<textarea style='width: 100%;' disabled>";
                        if (isset($values->$lang))
                            echo $values->$lang;
                        else echo "";
                        echo "</textarea><br>";
                    }
                    echo "</p></div>";
                }
                ?>             
            </div></div><br><br>
            <div id="sites">
                <input id="search" type="text" value="Search..."></input><br><br><br>
            <div id = "accordion-sites">
                <?php
                foreach ($sites as $site) {
                    echo "<h3>" . $site->name . "</h3>";
                    echo "<div><p>";
                    echo "Url: <input type='text' value='" . $site->url . "' disabled></input><br>";
                    echo "Difficulty: <input type='text' value='" . $site->difficulty . "' disabled></input><br>";
                    echo (isset($site->notes) ? "<br><b>Notes</b><br><br> " : null);
                    foreach ($langs as $lang) {
                        if ($lang == "en")
                            $fullstring = "notes";
                        else
                            $fullstring = "notes_" . $lang;
                        if (isset($site->$fullstring)) {
                            echo $lang . "<br><input type='text' value='" . $site->$fullstring . "' disabled></input>";
                        }
                    }
                    echo "</p></div>";
                }
                ?>               
            </div>
            </div>
        </div>
    </body>
</html>
