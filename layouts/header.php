<?php
    $brands = [];
    $categories = [];
?>
<!doctype html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>
        PageVamp
        <?php
        if(function_exists('title')) {
            echo title();
        }
        ?>
    </title>
    <meta name="description" content="">

    <!-- Place favicon.ico in the root directory -->
    <link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico">
    <link rel="apple-touch-icon" href="apple-touch-icon.png">

    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, minimal-ui">


    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900|Material+Icons" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/vuetify/dist/vuetify.min.css" rel="stylesheet">
    <!-- All css files are included here. -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">

    <link rel="stylesheet" href="<?php asset('css/prios.css'); ?>">
    <link rel="stylesheet" href="<?php asset('css/prios-vue-wysiwyg.css'); ?>">
    <script src="<?php asset('js/modernizr-2.8.3.min.js'); ?>"></script>


    <?php
    if(isset($_CSS)) {
        foreach($CSS as $css) {
            $css = explode(',');
            if(end($css)==='cdn') {
                echo "<link rel='stylesheet' href='$css'>";
            } else {
                 echo "<link rel='stylesheet' href='css/$css'>";
            }
        }
    }
    ?>


</head>

<body>
<!-- Body main wrapper start -->
<div id="app" class="wrapper fixed__footer">
    <v-app v-cloak <?php echo strpos(App::$url, '/admin')>-1?'dark':'' ?> id="pageContainer">
        <v-progress-linear id="loading" :indeterminate="true">Loading..</v-progress-linear>
        <v-navigation-drawer v-model="drawer" :mini-variant="miniVariant" :clipped="clipped" fixed app>
            <v-list>
                <v-list-tile v-for="(item, i) in links" :key="i" :href="item.to" exact>
                    <v-list-tile-action>
                        <v-icon>{{ item.icon }}</v-icon>
                    </v-list-tile-action>
                    <v-list-tile-content>
                        <v-list-tile-title v-text="item.title" />
                    </v-list-tile-content>
                </v-list-tile>
                <v-list-group v-if="adminLoggedIn" prepend-icon="account_circle" value="true">
                    <v-list-tile slot="activator">
                        <v-list-tile-title>Admin</v-list-tile-title>
                    </v-list-tile>

                    <v-list-group sub-group no-action v-for="(BREAD, i) in BREADS" :key="i" @click="">
                        <v-list-tile slot="activator">
                            <v-list-tile-title v-text="BREAD[0]"></v-list-tile-title>
                            <v-list-tile-action>
                                <v-icon v-text="BREAD[1]"></v-icon>
                            </v-list-tile-action>
                        </v-list-tile>

                        <v-list-tile v-for="(crud, i) in cruds" :href="baseURL+'admin/'+BREAD[0].toLowerCase()+'.php?action='+crud[0].toLowerCase()" :key="i" @click="">
                            <v-list-tile-title v-text="crud[0]"></v-list-tile-title>
                            <v-list-tile-action>
                                <v-icon v-text="crud[1]"></v-icon>
                            </v-list-tile-action>
                        </v-list-tile>
                    </v-list-group>
                </v-list-group>
            </v-list>
        </v-navigation-drawer>
        <v-toolbar :clipped-left="clipped" fixed app>
            <v-toolbar-side-icon @click="drawer = !drawer"></v-toolbar-side-icon>
            <v-btn icon @click.stop="miniVariant = !miniVariant">
                <v-icon>{{ `chevron_${miniVariant ? 'right' : 'left'}` }}</v-icon>
            </v-btn>
            <v-btn icon @click.stop="clipped = !clipped">
                <v-icon>web</v-icon>
            </v-btn>
            <v-btn icon @click.stop="fixed = !fixed">
                <v-icon>remove</v-icon>
            </v-btn>
            <v-toolbar-title v-text="title"></v-toolbar-title>
            <v-spacer></v-spacer>
            <v-avatar v-if="adminLoggedIn">
                <img :src="admin.avatar" :alt="admin.name">
            </v-avatar>
            <v-btn icon @click.stop="rightDrawer = !rightDrawer">
                <v-icon>shopping_cart</v-icon>
            </v-btn>
        </v-toolbar>

        <v-content>