<?php
include ("session.php");
require 'vendor/autoload.php'; // Incluez l'autoloader de Composer


if (!($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["promo"]))) {
    die("Paramètre non trouvé");
}  

$promo = $_POST["promo"];

$dateEnFrancais = \Carbon\Carbon::now()->locale('fr_FR')->isoFormat('dddd DD MMMM YYYY');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title id='Description'>Feuille de présence</title>
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

            var url = "data/presence.json?promo=<?php echo $promo;?>";
            // prepare the data
            var source =
            {
                datatype: "json",
                datafields: [
                    { name: 'nom' },
                    { name: 'prenom' },
                    { name: 'promo' },
                    { name: 'presence_matin' },
                    { name: 'heure_matin' },
                    { name: 'presence_aprem' },
                    { name: 'heure_aprem' }
                ],
                id: 'id', // Si vous avez un champ ID dans vos données, spécifiez-le ici.
                url: url,
                root: '' // Vous n'avez pas besoin de spécifier 'root' s'il n'y a pas de niveau de données supplémentaire.
            };

            var getLocalization = function () {
                var localizationobj = {};
                localizationobj.groupsheaderstring = "Déplacez des colonnes pour effectuer un regroupement";
                localizationobj.filterselectstring = "Filtrer";
                localizationobj.clearstring = "Effacer";
                localizationobj.todaystring = "Aujourd'hui";

                return localizationobj;
            }

            var cellclassname = function (row, column, value, data) {
                var val_presence_matin = $('#grid').jqxGrid('getcellvalue', row, "presence_matin");
                var val_presence_aprem = $('#grid').jqxGrid('getcellvalue', row, "presence_aprem");
                if (val_presence_matin == 'Absent' && val_presence_aprem == 'Absent') {
                    return 'red';
                }
                if (
                    (val_presence_matin == 'Absent' && val_presence_aprem == 'Présent') 
                    || 
                    (val_presence_matin =='Présent' && val_presence_aprem == 'Absent')
                    ) {
                    return 'lowred';
                }
                else{
                    return 'green';
                }
            }

            var cellclassname_matin = function (row, column, value, data) {
                var val_presence_matin = $('#grid').jqxGrid('getcellvalue', row, "presence_matin");
                var val_presence_aprem = $('#grid').jqxGrid('getcellvalue', row, "presence_aprem");

                if (val_presence_matin == 'Absent' && val_presence_aprem == 'Absent') {
                    return 'red';
                }
                if (val_presence_matin == 'Absent' && val_presence_aprem == 'Présent'){
                    return 'lowred-matin';
                }
                else{
                    return 'green';
                }
            }

            var cellclassname_aprem = function (row, column, value, data) {
                var val_presence_matin = $('#grid').jqxGrid('getcellvalue', row, "presence_matin");
                var val_presence_aprem = $('#grid').jqxGrid('getcellvalue', row, "presence_aprem");
                if (val_presence_matin == 'Absent' && val_presence_aprem == 'Absent') {
                    return 'red';
                }
                if (val_presence_matin == 'Présent' && val_presence_aprem == 'Absent'){
                    return 'lowred-aprem';
                }
                else{
                    return 'green';
                }
            }
            
            var dataAdapter = new $.jqx.dataAdapter(source);
            $("#grid").jqxGrid(
            {
                width: "100%",
                height: 700,
                source: dataAdapter,
                columnsresize: true,
                theme: 'energyblue',
                filterable: true,
                groupable: true,
                sortable: true,
                showfilterrow: true,
                columnsmenu: false,
                localization: getLocalization(),
                columns: [
                    { text: 'Nom', dataField: 'nom', width: "18%", cellclassname: cellclassname},
                    { text: 'Prénom', dataField: 'prenom', width: "17%", cellclassname: cellclassname },
                    { text: 'Promotion', dataField: 'promo', width: "20%", cellsalign: "center", align: "center", filterable: false, cellclassname: cellclassname},
                    { text: 'Présence Matin', dataField: 'presence_matin', width: "13%" , cellsalign: "center", align: "center", filterable: false, filtertype: "checkedlist", cellclassname: cellclassname, cellclassname: cellclassname_matin},
                    { text: 'Heure Matin', dataField: 'heure_matin', width: "10%", cellsalign: "center", align: "center", filterable: false, cellclassname: cellclassname, cellclassname: cellclassname_matin },
                    { text: 'Présence Après-midi', dataField: 'presence_aprem', width: "12%" , cellsalign: "center", align: "center", filterable: false, filtertype: "checkedlist", cellclassname: cellclassname, cellclassname: cellclassname_aprem},
                    { text: 'Heure Après-midi', dataField: 'heure_aprem', width: "10%", cellsalign: "center", align: "center", filterable: false, cellclassname: cellclassname, cellclassname: cellclassname_aprem}
                ]
            });
        });
    </script>


    <style type="text/css">
        .green {
        color: black !important;
        background-color: #88E659 !important;
        }

        .lowred {
        color: black !important;
        background-color: #FF8181 !important;
        }
        .lowred-matin {
        color: black !important;
        background-color: #FF8181 !important;
        }
        .lowred-aprem {
        color: black !important;
        background-color: #FF8181 !important;
        }

        .red {
        color: black !important;
        background-color: #FF5252 !important;
        }

    </style>
    
</head>
<body class='default'>
    <div class="nav">
        <h1 class="title">Feuille de présence du <?php echo $dateEnFrancais?></h1>
        <a class="ref-accueil" href="accueil.php">Accueil</a>    
    </div>
    <div style="width: 75%; margin-left:auto; margin-right:auto; margin-top:3%;">
        <div id="grid"></div>
        <a class="historique" href="historique.php">Accèder à l'historique</a>
    </div>
    
</body>
</html>