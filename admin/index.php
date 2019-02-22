<?php require_once '../layouts/app.php' ?>
<?php
function title() {
    echo "- Admin Dashboard";
}
?>
<?php require_once '../layouts/header.php' ?>
<v-container fluid fill-height>
    <v-layout align-center justify-center>
        <v-flex xs12 sm8 md4 text-center>
            <v-card-text>
                <p class="text-xs-center">Welcome To Admin Section!</p>
            </v-card-text>
        </v-flex>
    </v-layout>
</v-container>

<?php require_once '../layouts/footer.php'; ?>

<!--//mixins here-->
<script>
    var mixin = {};
</script>

<?php require_once '../includes/vue.php'; ?>
