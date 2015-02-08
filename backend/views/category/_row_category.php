<?php 
use yii\helpers\Html;

if($item['id']) { 
?>
            <tr class="row-category">
                <td></td>
                <td>
                    <div class="cursor-pointer place-for-phantom" id="category-name-<?= $item['id'] ?>"><?= $item['name'] ?></div>
                </td>
                <td style="width: 20px;">
                    <?php 
                    if($item['pos'] > 1) {
                        echo Html::a('<div class="arrows"></div>', ['category/shift', 'direction' => 'up', 'id' => $item['id'], 'parent_id'=> $item['parent_id']]); 
                    } ?>
                </td> 
                <td style="width: 20px;">
                    <?php
                    if(isset($items[$k+1]) && $items[$k+1]['parent_id'] == $prevParentId) {
                        echo Html::a('<div class="arrows down"></div>', ['category/shift', 'direction' => 'down', 'id' => $item['id'], 'parent_id'=> $item['parent_id']]);
                    } ?>
                </td>
                <td>
                    <?= Html::a('<div class="icon_delete"></div>', ['category/delete', 'id' => $item['id']], ['class' => 'confirm-delete']); ?>
                </td>
            </tr>
<?php
}
?>