<?php 
use yii\helpers\Html;
?>

            <tr class="row-parent-category">
                <td class="menu-accordion">
                    <span class="toggle-resize fa fa-bars"></span>
                </td>
                <td class="place-for-phantom cursor-pointer" id="category-name-<?= $item['parent_id'] ?>" style="height: 50px;"><?= $item['parent_name'] ?></td>
                <td style="width: 20px;">
                    <?php 
                    if($item['parent_pos'] > 1) {
                    echo Html::a('<div class="arrows"></div>', ['category/shift', 'direction' => 'up', 'id' => $item['parent_id'], 'parent_id'=> 0]);
                    } ?>
                </td>
                <td style="width: 20px;">
                    <?php 
                    if($item['parent_pos'] < $parentMaxPos) {
                    echo Html::a('<div class="arrows down"></div>', ['category/shift', 'direction' => 'down', 'id' => $item['parent_id'], 'parent_id'=> 0]);
                    } ?>
                </td>
                <td>
                    <?= Html::a('<div class="icon_delete"></div>', ['category/delete', 'id' => $item['parent_id']], ['class' => 'confirm-delete']);
                    ?>
                </td>
            </tr>