<?php
$menus = \backend\components\Menu::getMenuItem();
?>

<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block sidebar collapse accordion">
    <div class="sidebar-sticky pt-3 accordion">
        <?php foreach ($menus as $k1 => $v1): ?>
            <?php $heading = 'heading' . $k1; $collapse = 'collapse' . $k1; ?>
            <ul class="nav flex-column mb-2" <?php echo $v1[0]['hide']; ?> >
                <li class="nav-item" id="<?php echo $heading; ?>">
                    <a class="nav-link" data-toggle="collapse" data-target=".<?php echo $collapse; ?>" aria-expanded="true"
                       aria-controls="<?php echo $collapse ?>" href="<?php echo $v1[0]['url']; ?>">
                        <span class="glyphicon glyphicon-user"></span>
                        <span class="ml-8"><?php echo $v1[0]['name'] ?></span>
                    </a>
                </li>
                <div class="collapse <?php echo $collapse . ' ' . $v1[0]['show']; ?>" aria-labelledby="<?php echo $heading; ?>" data-parent="#sidebarMenu">
                    <?php foreach ($v1 as $k2 => $v2): ?>
                        <?php if ($k2 != 0): ?>
                            <li class="nav-item" <?php echo $v2['hide']; ?>>
                                <a <?php echo $v2['checked']; ?> class="nav-link" href="<?php echo $v2['url']; ?>">
                                    <span class="ml-26"><?php echo $v2['name']; ?></span>
                                </a>
                            </li>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
            </ul>
        <?php endforeach; ?>
    </div>
</nav>