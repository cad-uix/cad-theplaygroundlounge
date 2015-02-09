<div class="wrap">
    <h2>CAD: The Playground Lounge</h2>
    <form method="post" action="options.php"> 
        <?php @settings_fields('cad_the_playground_lounge_template-group'); ?>
        <?php @do_settings_fields('cad_the_playground_lounge_template-group'); ?>

        <?php do_settings_sections('cad_the_playground_lounge_template'); ?>

        <?php @submit_button(); ?>
    </form>
</div>