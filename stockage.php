<h1 class="title">Tableau de présence du <?php echo $dateEnFrancais; ?></h1>

    <table>
        <thead>
            <tr>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Promotion</th>
                <th>Présence Matin</th>
                <th>Heure Matin</th>
                <th>Présence Après-midi</th>
                <th>Heure Après-midi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($presences as $presence) : ?>
                <tr>
                    <td><?php echo $presence['Nom']; ?></td>
                    <td><?php echo $presence['Prénom']; ?></td>
                    <td><?php echo $presence['Promotion']; ?></td>
                    <td><?php echo $presence['Présence_matin']; ?></td>
                    <td><?php echo $presence['Heure_matin']; ?></td>
                    <td><?php echo $presence['Présence_aprem']; ?></td>
                    <td><?php echo $presence['Heure_aprem']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>