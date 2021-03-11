<aside class="main-sidebar">

    <section class="sidebar">

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu'],
                'items' => [
                    ['label' => 'Заявки', 'icon' => 'fa fa-file-code-o', 'url' => [\yii\helpers\Url::to(['/request'])]],
                    ['label' => 'Перевозки', 'icon' => 'fa fa-file-code-o', 'url' => [\yii\helpers\Url::to(['/transportation'])]],
                    ['label' => 'Перевозчики', 'icon' => 'fa fa-file-code-o', 'url' => [\yii\helpers\Url::to(['/transporter'])]],
                    ['label' => 'Рейсы', 'icon' => 'fa fa-file-code-o', 'url' => [\yii\helpers\Url::to(['/voyage'])]],

                ],
            ]
        ) ?>

    </section>

</aside>
