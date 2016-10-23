<?php
/*
 * Editeur de contenu live sur le serveur
 * 
 */

if (isset($_GET["dossier"])) {
    $adresseFichier = $_GET["dossier"] . '/' . $_GET["fichier"];
    $_SESSION["adr"] = $adresseFichier;
    chdir($adresseFichier);
} else if (isset($_SESSION["adr"])) {
    chdir($_SESSION["adr"]);
    $adresseFichier = $_SESSION["adr"];
}
$ls = scandir(getcwd());
$dossier = getcwd();
foreach ($ls as $elem => $v) {
    if ($v == "..") {
        chdir('..');
        echo '<i class="fa fa-chevron-up"></i>';
    }

    echo '<a href="index.php?p=editeurs.live&dossier=' . $dossier . '&fichier=' . $v . '">' . $v . '</a><br>';
}
$contenuLive = file_get_contents($adresseFichier);
// Sauvegarde du fichier
if (isset($_POST["save"])) {

    $file = $_SESSION["adr"];

    $contenuTextarea = $_POST["code"];
    if (file_put_contents($file, $contenuTextarea)) {
        echo 'youpie';
    };
}

/* Fichier */

// Extensions autorisées : 
$extensions = array('.php', '.html', '.css', '.cpp', '.js', '.sql', '.txt', '.h', '.md');
// Extension du fichier : 
$extension = strrchr($_GET["fichier"], '.');
?>

<style>.CodeMirror {
        border: 1px solid #eee;
        height: auto;
    }
    #abc {height:50px}
    .blink {background-color: rgba(127, 191, 63, 0.67);}
</style>

<h1>
    <i class="fa fa-code"></i>    Editeur de code
</h1>
<form action="index.php?p=editeurs.live" method="POST">
    <textarea id="code" name="code">
<?= $contenuLive ?>
    </textarea>
</div>
<div class="col-sm-4">

    <button class="btn btn-success-outline" type="submit" name="save" id="save">Sauvegarder</button>

</div>
</form>

<?php if (isset($extension) && in_array($extension, $extensions)) : ?>


    <?php
    switch ($extension) {
        case '.php' :
            $mode = "application/x-httpd-php";
            break;
        case '.css':
            $mode = "css";
            break;
        case '.js':
            $mode = "javascript";
            break;
        case '.html':
            $mode = "text/html";
            break;
        case '.sql':
            $mode = "text/x-mysql";
            break;
        case '.cpp':
            $mode = "text/x-c++src";
            break;
        case '.h':
            $mode = "text/x-c++src";
            break;
        case '.md':
            $mode = "markdown";
            break;
        default:
            $mode = "text";
            break;
    }
endif;
?>
<div id="content"></div>
<!-- Librairie de base -->
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

<script>
    $(document).ready(function () {
        $("#fichier").click(function () {
            setInterval(function () {
                $('#ok').toggleClass('blink');
            }, 1000);
        });

        var code = $("#code")[0];
        if (code != null) {
            var editor = CodeMirror.fromTextArea(code, {
                lineNumbers: true,
                matchBrackets: true,
                autoCloseBrackets: true,
                matchTags: {bothTags: true},
                autoCloseTags: true,
                mode: "<?= isset($mode) ? $mode : "text/html" ?>",
                indentUnit: 4,
                extraKeys: {
                    "Ctrl-Space": "autocomplete",
                    "Ctrl-J": "toMatchingTag",
                    "Ctrl-A": "selectAll",
                },
                value: document.documentElement.innerHTML
            });
        }
    });
  


    //   $(":file").filestyle({buttonBefore: true});
</script>


