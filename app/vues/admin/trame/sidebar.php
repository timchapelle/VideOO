<?php
/*
 * Barre latérale (gauche) de la section admin
 */

?>
<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
    <div class="panel panel-default">
        <div class="panel-heading" role="tab" id="headingOne">
            <h4 class="panel-title">
                <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    Articles
                </a>
            </h4>
        </div>
        <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
            <div class="list-group">
                <div class="list-group-item">
                    <i class="fa fa-newspaper-o"></i><a href="?p=admin.articles.index" >Articles</a>
                </div>
                <div class="list-group-item">
                    <i class="fa fa-sitemap"></i><a href="?p=admin.categories.index">Catégories</a>
                </div>
            </div>
        </div>
    </div>
    
    <div class="panel panel-default">
        <div class="panel-heading" role="tab" id="util">
            <h4 class="panel-title">
                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#utilisateurs" aria-expanded="false" aria-controls="collapseThree">
                    Utilisateurs 
                </a>
            </h4>
        </div>
        <div id="utilisateurs" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="util">
            <div class="list-group">
                <div class="list-group-item">
                    <i class="fa fa-user"></i><a href="?p=admin.utilisateurs.index" >Utilisateurs</a>
                </div>
                <div class="list-group-item">
                    <i class="fa fa-users"></i><a href="?p=admin.groupes.index" >Groupes</a>
                </div>
                <div class="list-group-item">
                    Utilisateurs connectés : <br>
                    <ul>
                    
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

