<ul class="nav nav-pills level-three" id="renovacion-options" role="tablist">
    <li class="nav-item" role="presentation">
        <a class="nav-link active" id="beyond-renovacion-resumen-tab" data-toggle="pill"
            href="#beyond-renovacion-resumen" role="tab" aria-controls="beyond-renovacion-resumen"
            aria-selected="true">Resumen</a>
    </li>
    <li class="nav-item" role="presentation">
        <a class="nav-link" id="beyond-renovacion-callcenter-tab" data-toggle="pill"
            href="#beyond-renovacion-callcenter" role="tab" aria-controls="beyond-renovacion-callcenter"
            aria-selected="false">Call Center</a>
    </li>
    <li class="nav-item" role="presentation">
        <a class="nav-link" id="beyond-renovacion-reportes-tab" data-toggle="pill" href="#beyond-renovacion-reportes"
            role="tab" aria-controls="beyond-renovacion-reportes" aria-selected="false">Reportes</a>
    </li>
    <?php
    if (in_array('menu_ubbitt_beyond_renewal_database_upload', Yii::$app->session->get("userPermissions"))) {
    ?>
    <li class="nav-item" role="presentation">
        <a class="nav-link" id="beyond-renovacion-carga-base-datos-tab" data-toggle="pill"
            href="#beyond-renovacion-carga-base-datos" role="tab" aria-controls="beyond-renovacion-carga-base-datos"
            aria-selected="true">Carga de base de datos</a>
    </li>
    <?php } ?>
</ul>