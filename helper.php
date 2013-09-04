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
else if (isset($_GET['newsite']))
{  
    $sites = json_decode(file_get_contents("sites.json"), true);
    $newsite = $_GET['newsite'];
    $sites[] = array( 'name' => $newsite, 'url' => '', 'difficulty' => 'easy' );
    usort($sites, function($a, $b)
    {
        $a = strtolower($a['name']);
        $b = strtolower($b['name']);
        
        if ($a < $b) {
            return -1;
        }
        if ($a > $b) {
            return 1;
        }
        return 0;
    });
    
    $sites_sort = json_encode($sites, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);   
    $sites_sort = preg_replace("/(},)(\s+{)/", "$1\n$2", $sites_sort);
    file_put_contents("sites.json", $sites_sort);
    exit;
}
else if (isset($_GET['editsite']) && isset($_GET['lang']) && isset($_GET['text'])) {
    $sitename = $_GET['editsite'];
    foreach ($sites as $site) {
        if ($site->name == $sitename) {
            $lang = $_GET['lang'];
            $text = $_GET['text'];
            if ($lang == "Url") {
                $site->url = $text;
            } else {
                if ($lang == "en")
                    $notestring = "notes";
                else
                    $notestring = "notes_" . $lang;              
                $site->$notestring = $text;                
            }
            file_put_contents("sites.json", json_encode($sites, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE));
            break;
        }
    }
    exit;
}
else if (isset($_GET['editdifficulty']) && isset($_GET['newdifficulty'])) {
    $sitename = $_GET['editdifficulty'];
    foreach ($sites as $site) {
        if ($site->name == $sitename) {
            $newdifficulty = $_GET['newdifficulty'];
            $site->difficulty = $newdifficulty;
            file_put_contents("sites.json", json_encode($sites, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE));
            break;
        }
    }
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
                $(document).ready(function() {
                    $('#body').show();
                    $('#msg').hide();
                });                
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
                $("#accordion-definitions").accordion({
                    heightStyle: "content",
                    autoHeight: false,
                    clearStyle: true
                });
                
                $(document).on('click', ".edit-def", function(event) {
                    event.preventDefault();
                    var status =  $(this).next().next().prop("disabled");
                    $(this).next().next().autosize();
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
                    $(document).on('click', ".edit-site", function(event) {
                        event.preventDefault();
                        var status = $(this).next().next().prop("disabled");
                        $(this).next().next().autosize();
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
                            var sitename = head.text();
                            var lang = $(this).prev().text();
                            var text = $(this).next().next().val();
                            $.get("helper.php", {editsite: sitename, lang: lang, text: text});

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
                        });
                    } else {
                        $('#sites h3').show();
                    }
                    return false;
                });
                $("#newlanguagedef").click(function(event) {
                    var language = prompt("Enter the new language code (Example: \"en\"):", "");
                    if (language.length !== 2)
                    {
                        alert("The language code must be two characters long");
                    }
                    else
                    {
                        alert('Fill all yellow fields with the translation');
                        $('#definitions p').each(function() {
                            $(this).after('<label for="lang">' + language + '</label> <a class="edit-def" href="#">Save Edit</a>&nbsp;<a class="edit-cancel" href="#">Cancel</a><br><textarea style="width: 100%; background-color:#FFFF66;"></textarea>');
                            $('#definitions textarea').autosize();
                        });
                        $('#sites p').each(function() {
                            $(this).after('<label for="lang">' + language + '</label> <a class="edit-site" href="#">Edit</a><br><textarea style="width: 100%;" disabled></textarea>');
                        });
                        $('#definitions div').each(function() {
                            $(this).slideDown();
                        });
                        $.get("helper.php", {newlanguage: language});
                    }
                });
                $('#showonlyinctranslations').change(function() {
                    if ($(this).is(":checked")) {
                        $('#definitions textarea').each(function() {
                            if ($(this).val() !== "")
                            {
                                $(this).hide();
                                $(this).prev().prev().hide();
                                $(this).prev().prev().prev().hide();
                            }
                        });
                        $('#definitions .ui-accordion-content').each(function() {
                            $(this).slideDown();
                        });
                    }
                    else
                    {
                        $('#definitions textarea').each(function() {
                            $(this).show();
                            $(this).prev().prev().show();
                            $(this).prev().prev().prev().show();
                        });
                        $('#definitions .ui-accordion-content').each(function() {
                            $(this).slideUp();
                        });
                    }
                });
                $('#showonlyincsitenotes').change(function() {
                    if ($(this).is(":checked")) {
                        $('.sitenotes').each(function() {
                            if ($(this).val() !== "")
                            {
                                $(this).hide();
                                $(this).prev().prev().hide();
                                $(this).prev().prev().prev().hide();
                            }
                        });
                    }
                    else
                    {
                        $('.sitenotes').each(function() {
                            $(this).show();
                            $(this).prev().prev().show();
                            $(this).prev().prev().prev().show();
                        });
                    }
                });
                $(document).on('click', '.edit-difficulty', function(event) {

                    event.preventDefault();
                    var status = $(this).prev().prop("disabled");

                    if (status)
                    {
                        $(this).prev().prop("disabled", false);
                        $(this).text("Save edit");
                        $(this).after("&nbsp;<a class='edit-site-cancel' href='#'>Cancel</a>");
                    }
                    else if (!status)
                    {
                        $(this).next().remove();
                        $(this).prev().prop("disabled", true);
                        $(this).text("Edit");
                        var newdifficulty = $(this).prev().find("option:selected").val();
                        var parent = $(this).closest('div');
                        var head = parent.prev('h3');
                        var sitename = head.text();
                        $.get("helper.php", {editdifficulty: sitename, newdifficulty: newdifficulty});
                    }
                });
                $(document).on('click', ".edit-site-cancel", function(event) {
                    event.preventDefault();
                    $(this).prev().prev().prop("disabled", true);
                    $(this).prev().text("Edit");
                    $(this).remove();
                });
                $('#newsite').click(function()
                {
                    var newsitename = prompt("Enter the site name", "");
                    if (newsitename !== null && newsitename !== "")
                    {
                        $('#sites h3').each(function() {
                            var sitename = $(this).text();

                            if (sitename.toLowerCase() > newsitename.toLowerCase())
                            {
                                var langshtml = "";
                                $.ajax({
                                    async: false,
                                    url: "definitions.json",
                                    success: function(json) {                                        
                                        var langs = json[1]["langs"].split(",");
                                        var length = langs.length;

                                        for (var i = 0; i < length; i++) {
                                            var lang = langs[i];

                                            langshtml += "<label for='lang'>" + lang + "</label> <a class='edit-site' href='#'>Edit</a><br>" +
                                                    "<textarea class='sitenotes' style='width: 100%;' disabled>" +
                                                    "</textarea><br>";
                                        }
                                    }
                                });

                                var newelement = $("<h3>" + newsitename + "</h3><div><p>" +
                                        "<label for='lang'>Url</label> <a class='edit-site' href='#'>Edit</a><br><textarea style='width: 100%;' disabled>" +
                                        "</textarea><br>Difficulty: " +
                                        "<select disabled>" +
                                        "<option value='easy' selected>Easy</option>" +
                                        "<option value='medium'>Medium</option>" +
                                        "<option value='hard'>Hard</option>" +
                                        "<option value='impossible'>Impossible</option>" +
                                        "</select>" +
                                        " <a class='edit-difficulty' href='#'>Edit</a> <br><b>Notes</b><br><br> " +
                                        langshtml
                                        + "</p></div>");

                                $(this).before(newelement);
                                $('#accordion-sites').accordion("refresh");
                                newelement.slideDown();
                                $('html, body').animate({
                                    scrollTop: newelement.offset().top
                                }, 3000);
                                $.get("helper.php", {newsite: newsitename});
                                return false;
                            }
                        });
                    }
                    else
                        alert("Insert site name");
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
            #search {
                padding: 5px;
                width: 20%;
                float:right;
            }
            #msg {
                font-size: 16px;
            }
            input[type='checkbox'] {
                margin: 0;
            }                       
        </style>
    </head>
    <body>
        <div id="msg" style="font-size:largest;">           
            <center>Loading, please wait...<center>
        </div>
        <div id="body" style="display:none;">            
            <div id="tabs">
                <ul>
                    <li><a href="#definitions">Definitions</a></li>
                    <li><a href="#sites">Sites</a></li>               
                </ul>
                <div id="definitions">  
                    <input id="showonlyinctranslations" type="checkbox" /> Show only incomplete translations<br>                   
                    <a id="newlanguagedef" href="#">Create new language definitions</a><br><br>                    
                    <div id="accordion-definitions">
                        <?php
                        foreach ($definitions[0] as $definition => $values) {
                            echo "<h3>" . $definition . "</h3>";
                            echo "<div><p><a class='del-definition' href='#'>Delete definition</a><br><br>";
                            foreach ($langs as $lang) {
                                echo "<label for='lang'>" . $lang . "</label> <a class='edit-def' href='#'>Edit</a><br>";
                                echo "<textarea style='width: 100%;' disabled>";
                                echo (isset($values->$lang) ? $values->$lang : "");
                                echo "</textarea><br>";
                            }
                            echo "</p></div>";
                        }
                        ?>             
                    </div></div><br><br>
                <div id="sites">
                    <input id="showonlyincsitenotes" type="checkbox" /> Show only incomplete site notes<br>
                    <a href="#" id="newsite">Insert new site</a>
                    <input id="search" type="text" value="Search..."></input><br><br><br>
                    <div id="accordion-sites">
                        <?php
                        foreach ($sites as $site) {                           
                            echo "<h3>" . $site->name . "</h3>";
                            echo "<div><p>";
                            echo "<label for='lang'>Url</label> <a class='edit-site' href='#'>Edit</a><br><textarea style='width: 100%;' disabled>";
                            echo $site->url;
                            echo "</textarea><br>Difficulty: ";
                            echo '<select disabled>
                                <option value="easy" ' . ($site->difficulty == "easy" ? "selected" : null ) . '>Easy</option>
                                <option value="medium" ' . ($site->difficulty == "medium" ? "selected" : null ) . '>Medium</option>
                                <option value="hard" ' . ($site->difficulty == "hard" ? "selected" : null ) . '>Hard</option>
                                <option value="impossible" ' . ($site->difficulty == "impossible" ? "selected" : null ) . '>Impossible</option>
                                </select>';                                                  
                            echo " <a class='edit-difficulty' href='#'>Edit</a> <br><b>Notes</b><br><br> ";
                            foreach ($langs as $lang) {
                                if ($lang == "en")
                                    $notestring = "notes";
                                else
                                    $notestring = "notes_" . $lang;

                                echo "<label for='lang'>" . $lang . "</label> <a class='edit-site' href='#'>Edit</a><br>";
                                echo "<textarea class='sitenotes' style='width: 100%;' disabled>";
                                echo (isset($site->$notestring) ? $site->$notestring : "");
                                echo "</textarea><br>";
                            }
                            echo "</p></div>";
                        }
                        ?>               
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
