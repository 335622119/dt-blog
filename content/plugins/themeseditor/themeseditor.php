<?php
/*
  Plugin Name: 主题编辑插件
  Version: 3.0
  Plugin URL: http://www.emlog.net/plugin/28
  Description: 可以在线直接编辑你的主题文件。
  Author: GodSon
  ForEmlog:4.0.0+
  Author Email: wmails@126.com
  Author URL: http://www.btboys.com
 */
!defined('EMLOG_ROOT') && exit('access deined!');

function themeseditor() {//写入插件导航
    echo '<div class="sidebarsubmenu" id="themeseditor"><a href="./plugin.php?plugin=themeseditor">主题编辑</a></div>';
}

addAction('adm_sidebar_ext', 'themeseditor');
?>