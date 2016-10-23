<?php
/*
 * Page d'accueil de l'éditeur de code
 */

// Sauvegarde du fichier
if (isset($_POST["save"])) {

    $file = $_SESSION["lastFile"];

    $contenuTextarea = $_POST["contenu"];
    file_put_contents($file, $contenuTextarea);
    if (file_exists($file)) {

        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . basename($file) . '"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($file));
        if (readfile($file)) {
            unlink($_SESSION["lastFile"]);
        };
        exit;
    }
}

/* Fichier */
if (isset($_FILES['fichier']) && !empty($_FILES['fichier'])) {

    $infos = $_FILES['fichier'];
    $fichier = $infos['name'];
    $fichier_tmp = $infos['tmp_name'];
// Extensions autorisées : 
    $extensions = array('.php', '.html', '.css', '.cpp', '.js', '.sql', '.txt', '.h', '.md');
// Extension du fichier : 
    $extension = strrchr($fichier, '.');
// Vérification
    if (!in_array($extension, $extensions)) {
        $erreur = "Extensions autorisées : *.css, *.cpp, *.h, *.html, *.js, *.md, *.php, *.sql ou *.txt";   
    } else {

        $destination = "../assets/fichiers/$fichier";
        $_SESSION["lastFile"] = $destination;
        if ($destination != '') {
            if (!copy($fichier_tmp, $destination)) {
                $erreur = 'fichier non copié';
            }
            $cont = file_get_contents($destination);
        }
    }
} else {
    echo "Veuillez choisir un fichier";
}

if (isset($erreur)) : ?>
<div class="alert alert-danger"><?= $erreur ?></div>
<?php endif; ?>

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

</div>
<div class="col-sm-4">
    <form action="index.php?p=editeurs.index" method="POST" enctype="multipart/form-data">
        <label for="fichier" class="btn btn-primary-outline"><i class="fa fa-folder-open-o"></i></label>
        <input  type="file" name="fichier" id="fichier" class="hide">

            <button class="btn btn-default" type="submit" name="ok" id="ok">Afficher</button>
            <button class="btn btn-success-outline" type="submit" name="save" id="save">Sauvegarder</button>


            <br>
                </div>
                <?php if (isset($extension) && in_array($extension, $extensions)) : ?>
                    <div class="col-sm-9">
                        <textarea id="code">
    <?= $cont ?>
</textarea>

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
                        ?>
                    </div>
                <?php endif; ?>
                </form>
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
