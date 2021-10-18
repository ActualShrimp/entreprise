<?php

// echo '<pre>'; print_r($data); echo '</pre>';

?>

<table class="table table-bordered text-center">

    <thead>

        <tr>
            <?php foreach($fields as $value): ?>
                    <th><?= $value['Field'] ?></th>
            <?php endforeach; ?>
            <th>View</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>

    </thead>

    <tbody>

        <?php foreach($data as $dataEmploye): ?>

            <tr>

                <td><?= implode('</td><td>', $dataEmploye); ?></td>
                <td><a href="?op=select&id=<?= $dataEmploye[$id]?>" class= "btn btn-primary"><i class="fas fa-eye"></i></a></td>
                <td><a href="?op=update&id=<?= $dataEmploye[$id]?>" class= "btn btn-dark"><i class="far fa-edit"></i></a></td>
                <td><a href="?op=delete&id=<?= $dataEmploye[$id]?>" class= "btn btn-danger"><i class="far fa-trash-alt"></i></a></td>

            </tr>

        <?php endforeach ?>

    </tbody>

</table>