<?php

include ("session.php");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title id='Description'>Liste des élèves</title>
    <link rel="stylesheet" href="styles/presence.css">
    <link rel="stylesheet" href="jQWidgets/jqwidgets/styles/jqx.base.css" type="text/css" />
    <link rel="stylesheet" href="jQWidgets/jqwidgets/styles/jqx.energyblue.css" type="text/css"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1 maximum-scale=1 minimum-scale=1" />	
    
    <script type="text/javascript" src="jQWidgets/jqwidgets/jqxcore.js"></script>
    <script type="text/javascript" src="jQWidgets/jqwidgets/jqx-all.js"></script> 
    <script type="text/javascript">
        $(document).ready(function () {

            var url = "data/data-eleves.php";
            // prepare the data
            var source =
            {
                datatype: "json",
                datafields: [
                    { name: 'id_eleve' },
                    { name: 'nom' },
                    { name: 'prenom' },
                    { name: 'promo' }
                ],
                id: 'id_eleve', // Si vous avez un champ ID dans vos données, spécifiez-le ici.
                url: url,
                root: '' // Vous n'avez pas besoin de spécifier 'root' s'il n'y a pas de niveau de données supplémentaire.
            };
            var dataAdapter = new $.jqx.dataAdapter(source);
            $("#grid").jqxGrid(
            {
                width: "100%",
                height: 800,
                source: dataAdapter,
                columnsresize: true,
                theme: 'energyblue',
                filterable: true,
                groupable: true,
                sortable: true,
                showfilterrow: true,

                columnsmenu: false,

                columns: [
                    { text: 'Identifiant', dataField: 'id_eleve', width: "25%", getdatainformation: true},
                    { text: 'Nom', dataField: 'nom', width: "25%", getdatainformation: true},
                    { text: 'Prénom', dataField: 'prenom', width: "25%" },
                    { text: 'Promotion', dataField: 'promo', width: "25%", cellsalign: "center", align: "center", filtertype: "checkedlist"},
                ]
            });
        });
    </script>

</head>
<body class='default'>
    <div class="nav">
        <h1 class="title">Liste des élèves</h1>
        <a class="ref-accueil" href="accueil.php">Accueil</a>    
    </div>
    <div style="width: 75%; margin-left:auto; margin-right:auto; margin-top:3%;">
        <div id="grid"></div>
        <a class="historique" href="historique.php">Accèder à l'historique</a>
    </div>
    
</body>
</html>
