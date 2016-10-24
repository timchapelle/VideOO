<?php
/*
 * Editeur de contenu live sur le serveur
 * 
 */

if (empty($_POST["path"])) {
    $path = getcwd();
    $ls = scandir($path);
} else {
    $path = $_POST["path"];
    $ls = scandir($path);
}
?><div id="ls">
<?php
foreach ($ls as $elem => $v) {
    if ($v == ".") {
        echo '<i class="fa fa-bomb"></i>' . '<a href="#">.</a><br>';
    }
    else if ($v == "..") {
        chdir('..');
        echo '<i class="fa fa-arrow-up"></i>';
        echo '<a class="up" href="#" title="' . $path . '/' . $v . '">' . $v . '</a><br>';
    } else if(is_dir($path . '/' . $v)) {
        chdir($path);
        echo '<i class="fa fa-folder"></i> <a class="up" href="#" title="' . $path . '/' . $v . '">' . $v . '</a><br>';
    } else if (is_file($path . '/' . $v)) {
        echo '<i class="fa fa-file-o"></i> <a class="lien" href="#" title="' . $path . '/' . $v . '">' . $v . '</a><br>';
    }
}
?>
</div>


<!-- HTML -->
<style>.CodeMirror {
        border: 1px solid #eee;
        height: auto;
    }
    #abc {height:50px}
    .blink {background-color: rgba(127, 191, 63, 0.67);}
</style>
<?php if (empty($_POST["path"])) { ?>
<h1>
    <i class="fa fa-code"></i>    Editeur de code
</h1>

    <textarea id="code" name="code"></textarea>

<div class="col-sm-4">

    <button class="btn btn-success-outline" type="submit" name="save" id="save">Sauvegarder</button>

</div>
<?php } ?>
<!-- INCLUSIONS CODEMIRROR -->
<script src="../assets/codemirror/lib/codemirror.js"></script>
<!-- Addons -->
<script src="../assets/codemirror/addon/edit/matchbrackets.js"></script>
<script src="../assets/codemirror/addon/edit/closetag.js"></script>
<script src="../assets/codemirror/addon/edit/matchtags.js"></script>
<script src="../assets/codemirror/addon/edit/closebrackets.js"></script>
<script src="../assets/codemirror/addon/fold/xml-fold.js"></script>
<script src="../assets/codemirror/addon/hint/show-hint.js"></script>
<script src="../assets/codemirror/addon/hint/html-hint.js"></script>
<script src="../assets/codemirror/addon/hint/xml-hint.js"></script>
<script src="../assets/codemirror/addon/hint/javascript-hint.js"></script>
<script src="../assets/codemirror/addon/hint/anyword-hint.js"></script>
<script src="../assets/codemirror/addon/hint/sql-hint.js"></script>
<script src="../assets/codemirror/addon/search/search.js"></script>
<script src="../assets/codemirror/addon/search/searchcursor.js"></script>
<script src="../assets/codemirror/addon/search/jump-to-line.js"></script>
<script src="../assets/codemirror/addon/dialog/dialog.js"></script>
<script src="../assets/codemirror/addon/fold/foldcode.js"></script>
<script src="../assets/codemirror/addon/fold/foldgutter.js"></script>
<script src="../assets/codemirror/addon/fold/brace-fold.js"></script>
<script src="../assets/codemirror/addon/fold/xml-fold.js"></script>
<script src="../assets/codemirror/addon/fold/markdown-fold.js"></script>
<script src="../assets/codemirror/addon/fold/comment-fold.js"></script>
<!-- Modes -->
<script src="../assets/codemirror/mode/xml/xml.js"></script>
<script src="../assets/codemirror/mode/javascript/javascript.js"></script>
<script src="../assets/codemirror/mode/css/css.js"></script>
<script src="../assets/codemirror/mode/htmlmixed/htmlmixed.js"></script>
<script src="../assets/codemirror/mode/clike/clike.js"></script>
<script src="../assets/codemirror/mode/sql/sql.js"></script>
<script src="../assets/codemirror/mode/php/php.js"></script>
<script src="../assets/codemirror/mode/markdown/markdown.js"></script>

<!-- JQUERY -->
<script>
    $(document).ready(function () {

        var code = $("#code")[0];
        if (code != null) {
            var editor = CodeMirror.fromTextArea(code, {
                lineNumbers: true,
                matchBrackets: true,
                autoCloseBrackets: true,
                matchTags: {bothTags: true},
                autoCloseTags: true,
                mode: "<?= isset($mode) ? $mode : "application/x-httpd-php" ?>",
                indentUnit: 4,
                extraKeys: {
                    "Ctrl-Space": "autocomplete",
                    "Ctrl-J": "toMatchingTag",
                    "Ctrl-A": "selectAll",
                },
                value: document.documentElement.innerHTML
            });
            
        }
        $(".lien").click(function () {
            jQuery.ajax({
                url: "index.php?p=editeurs.ajax",
                data: 'fichier=' + $(this).attr("title"),
                dataType: 'text',
                type: 'POST',
                success: function (data) {
                    editor.setValue("");
                    editor.clearHistory();
                    editor.setValue(data);
                    editor.clearGutter();
                },
                error: function () {
                    $("#code").text('Impossible de charger le fichier...');
                }
            });
            
        });
        $(".up").click(function () {
            jQuery.ajax({
                url: "index.php?p=editeurs.editLive",
                data: 'path=' + $(this).attr("title"),
                dataType: 'text',
                type: 'POST',
                success: function (data) {
                    $("#ls").html(data);
                    editor.setValue("");
                    editor.clearHistory();
                    editor.clearGutter();
                },
                error: function () {
                    $("#code").text('Impossible de charger le fichier...');
                }
            });
        });
    });



    //   $(":file").filestyle({buttonBefore: true});
</script>


