<?php
include ("session.php");

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
        var url = "data/data-historique.php";

        var source =
        {
            datatype: "json",
            datafields: [
                { name: 'jour'},
                { name: 'nom' },
                { name: 'prenom' },
                { name: 'promo' },
                { name: 'presence_matin' },
                { name: 'heure_matin' },
                { name: 'presence_aprem' },
                { name: 'heure_aprem' }
            ],
            id: 'id_presence', // Changer id en id_presence
            url: url,
            root: ''
        };

        var getLocalization = function () {
            var localizationobj = {};
            localizationobj.groupsheaderstring = "Déplacez des colonnes pour effectuer un regroupement";
            localizationobj.filterselectstring = "Filtrer";
            localizationobj.clearstring = "Effacer";
            localizationobj.todaystring = "Aujourd'hui";

            return localizationobj;
        }

        var addDefaultfilter = function() {
            var datefiltergroup = new $.jqx.filter();
            var operator = 0;
            var today = new Date();
            var currentDay = today.getDay();
            var daysSinceMonday = (currentDay + 6) % 7; // Adjust daysSinceMonday calculation

            var weekago = new Date(today);
            weekago.setDate(today.getDate() - daysSinceMonday);

            var filtervalue = weekago;
            var filtercondition = 'GREATER_THAN_OR_EQUAL';
            var filter4 = datefiltergroup.createfilter('datefilter', filtervalue, filtercondition);

            filtervalue = today;
            filtercondition = 'LESS_THAN_OR_EQUAL';
            var filter5 = datefiltergroup.createfilter('datefilter', filtervalue, filtercondition);

            datefiltergroup.addfilter(operator, filter4);
            datefiltergroup.addfilter(operator, filter5);

            $("#grid").jqxGrid('addfilter', 'jour', datefiltergroup);
            $("#grid").jqxGrid('applyfilters');
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
            height: 800,
            source: dataAdapter,
            columnsresize: true,
            theme: 'energyblue',
            filterable: true,
            groupable: true,
            sortable: true,
            showfilterrow: true,
            columnsmenu: false,
            localization: getLocalization(),
            ready: function () {
                addDefaultfilter();
            },
            columns: [
                { text: 'Jour', dataField: 'jour', cellsformat: 'yyyy-MM-dd', width: "10%", filtertype: "range", cellsalign: "center", align: "center", cellclassname: cellclassname},
                { text: 'Nom', dataField: 'nom', width: "15%" , cellclassname: cellclassname},
                { text: 'Prénom', dataField: 'prenom', width: "15%" , cellclassname: cellclassname},
                { text: 'Promotion', dataField: 'promo', width: "15%", cellsalign: "center", align: "center", filtertype: "checkedlist", cellclassname: cellclassname},
                { text: 'Présence Matin', dataField: 'presence_matin', width: "13%", cellsalign: "center", align: "center", filtertype: "checkedlist", cellclassname: cellclassname, cellclassname: cellclassname_matin},
                { text: 'Heure Matin', dataField: 'heure_matin', width: "10%", cellsalign: "center", align: "center", filterable: false, cellclassname: cellclassname, cellclassname: cellclassname_matin},
                { text: 'Présence Après-midi', dataField: 'presence_aprem', width: "12%", cellsalign: "center", align: "center", filtertype: "checkedlist", cellclassname: cellclassname, cellclassname: cellclassname_aprem},
                { text: 'Heure Après-midi', dataField: 'heure_aprem', width: "10%", cellsalign: "center", align: "center", filterable: false, cellclassname: cellclassname, cellclassname: cellclassname_aprem }
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
    <table width=100%>
        <tr>
            <td width=80%>
                <h1 class="title">Historique des présences</h1>
            </td>
            <td width=20% align=right>
                <a class="ref-accueil" href="accueil.php">Accueil</a>    
            </td>
        </tr>
    </table>
    <div style="width: 75%; margin-left:auto; margin-right:auto; margin-top:3%;">
        <div id="grid"></div>
    </div>
    
</body>
</html>