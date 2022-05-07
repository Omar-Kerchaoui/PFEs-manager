<?php



if (isset($_POST['save']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
    require "../connect.php";

    $sql = "SELECT * FROM etudiant INNER JOIN stage ON etudiant.id_stage = stage.id_stage";

    $stm = $pdo->prepare($sql);
    $stm->execute();
    $rows = $stm->fetchAll();

    $output = "
        <table borered>
                        <thead>
                            <tr>
                                <th>#ID</th>
                                <th>Etudiant</th>
                                <th>Note</th>
                            </tr>
                        </thead>
                        <tbody>";

    foreach ($rows as $row) {

        $output .=
            " <tr>
                <th scope='row'>" . $row['id_stage'] . "</th>
                            <td>" . $row['prenom'] . " " . $row['nom'] . "</td>
                            <th scope='row'>" . $row['note'] . "</th>
                            </tr>";
    }

    $output .= '</tbody>
        </table>
    ';

    header('content-Type: application/xls');
    header('Content-Disposition: attachement; filename=download.xls');
    echo $output;
}

?>
</tbody>
</table>
"
}