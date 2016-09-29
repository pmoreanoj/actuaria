<div class="centered center-block">
    <h3>Reportes de <?php echo $campaign->name . ' - ' . $campaign->company->name; ?></h3>
</div>
<input type="hidden" id="campaign_id" value="<?php echo $campaign; ?>" >

<div id="tabs">
    <ul>
        <li><a href="#tabs-1">Generales</a></li>
        <li><a href="#tabs-2">Competencias Transversales</a></li>
        <li><a href="#tabs-3">Competencias Específicas</a></li>
        <li><a href="#tabs-4">Reportes Individuales</a></li>
    </ul>
    <div id="tabs-1">
        <div class="row mt">
            <h3>Distribución de la Población</h3>

            <div class="row col-md-offset-1">
                <hr class="col-md-10">
            </div>

            <div class="col-md-4 col-sm-4 mb">
                <div class="white-panel pn">
                    <div class="white-header" style="background-color:#002C6A">
                        <h5>Distribución por Niveles</h5>
                        <div class="row data">                
                            <div id="levels_chart"></div>                
                        </div>
                    </div>
                </div>
                <a><button class="btn btn-warning">Exportar a CSV</button></a>
            </div>

            <div class="col-md-4 col-sm-4 mb">
                <div class="white-panel pn">
                    <div class="white-header" style="background-color:#002C6A">
                        <h5>Distribución por Áreas</h5>
                        <div class="row data">
                            <div id="areas_chart"></div>                
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4 col-sm-4 mb">
                <div class="white-panel pn">
                    <div class="white-header" style="background-color:#002C6A">
                        <h5>Distribución por Género</h5>
                        <div class="row data">
                            <div id="genre_chart"></div>                
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt">
            <div class="row col-md-offset-1">
                <hr class="col-md-10">
            </div>

            <div class="col-md-4 col-sm-4 mb">
                <div class="white-panel pn">
                    <div class="white-header" style="background-color:#002C6A">
                        <h5>Distribución por Edades</h5>
                        <div class="row data">
                            <div id="age_chart"></div>                
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4 col-sm-4 mb">
                <div class="white-panel pn">
                    <div class="white-header" style="background-color:#002C6A">
                        <h5>Distribución por Rango Salarial</h5>
                        <div class="row data">
                            <div id="income_chart"></div>                
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="tabs-2">
        <div class="row mt">
            <h3>Rendimientos Grupales</h3>
            <div class="row col-md-offset-1">
                <hr class="col-md-10">
            </div>            

            <div class="col-md-6 col-sm-6 mb">
                <div class="white-panel pn">
                    <div class="white-header" style="background-color:#002C6A">
                        <h5>Rendimiento por Niveles</h5>
                    </div>
                    <div class="row">
                        <div id="questions_per_level_chart"></div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-sm-6 mb">
                <div class="white-panel pn">
                    <div class="white-header" style="background-color:#002C6A">
                        <h5>Rendimiento por Áreas</h5>
                    </div>
                    <div class="row data">
                        <div id="questions_per_area_chart"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt">
            <div class="col-md-6 col-sm-6 mb">
                <div class="white-panel pn">
                    <div class="white-header" style="background-color:#002C6A">
                        <h5>Rendimiento por Género</h5>
                        <div class="row data">
                            <div id="questions_per_gender_chart"></div>                
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-sm-6 mb">
                <div class="white-panel pn">
                    <div class="white-header" style="background-color:#002C6A">
                        <h5>Rendimiento por Edades</h5>
                        <div class="row data">
                            <div id="questions_per_age_chart"></div>                
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt">
            <h3>Rendimientos por Características Individuales</h3>

            <div class="row col-md-offset-1">
                <hr class="col-md-10">
            </div>

            <div class="col-md-6 col-sm-6 mb">
                <div class="white-panel pn">
                    <div class="white-header" style="background-color:#002C6A">
                        <h5>Evaluación por Niveles</h5>
                        <div class="row data">
                            <div id="average_per_level"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-sm-6 mb">
                <div class="white-panel pn">
                    <div class="white-header" style="background-color:#002C6A">
                        <h5>Evaluación por Áreas</h5>
                        <div class="row data">
                            <div id="average_per_area"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt">
            <div class="row col-md-offset-1">
                <hr class="col-md-10">
            </div>

            <div class="col-md-6 col-sm-6 mb">
                <div class="white-panel pn">
                    <div class="white-header" style="background-color:#002C6A">
                        <h5>Evaluación por Edades</h5>
                        <div class="row data">
                            <div id="average_per_age"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-sm-6 mb">
                <div class="white-panel pn">
                    <div class="white-header" style="background-color:#002C6A">
                        <h5>Evaluación por Salarios</h5>
                        <div class="row data">
                            <div id="average_per_income"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="tabs-3">
        <div class="row mt">
            <h3>Desempeño Individual por Nivel</h3>
            <div class="row col-md-offset-1">
                <hr class="col-md-10">
            </div>

            <div class="col-md-4 col-sm-4 mb">
                <div class="white-panel pn">
                    <div class="white-header" style="background-color:#002C6A">
                        <h5>Empleados Nivel 1</h5>
                        <div class="row data">
                            <div id="level1_performance_chart"></div>                
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4 col-sm-4 mb">
                <div class="white-panel pn">
                    <div class="white-header" style="background-color:#002C6A">
                        <h5>Empleados Nivel 2</h5>
                        <div class="row data">
                            <div id="level2_performance_chart"></div>                
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4 col-sm-4 mb">
                <div class="white-panel pn">
                    <div class="white-header" style="background-color:#002C6A">
                        <h5>Empleados Nivel 3</h5>
                        <div class="row data">
                            <div id="level3_performance_chart"></div>                
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt">

            <div class="col-md-4 col-sm-4 mb">
                <div class="white-panel pn">
                    <div class="white-header" style="background-color:#002C6A">
                        <h5>Empleados Nivel 4</h5>
                        <div class="row data">
                            <div id="level4_performance_chart"></div>                
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4 col-sm-4 mb">
                <div class="white-panel pn">
                    <div class="white-header" style="background-color:#002C6A">
                        <h5>Empleados Nivel 5</h5>
                        <div class="row data">
                            <div id="level5_performance_chart"></div>                
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="tabs-4">
        <div class="row mt">
            <h3>Desempeño Individual por Empleado</h3>

            <div class="row col-md-offset-1">
                <hr class="col-md-10">
            </div>
            
            <div class="row col-md-2">
                <h4>Elegir Empleado:</h4>
            </div>
            <div>
                <select id="employee">
                    <?php foreach ($employees as $employee) {
                        ?>
                        <option value="<?php echo $employee->id; ?>" class="employee_selected"> <?php echo $employee->name; ?></option>
                        <?php
                    }
                    ?>
                </select>
            </div>
        </div>
        <div class="row mt">
            <h4 class="centered center-block">Informe Individual</h4>
            <div class="content-panel centered center-block" style="width:50%">
                <canvas id="canvas">
                    <div id="singleEmployee">

                    </div>
                </canvas>             
            </div> 
        </div>
    </div>
</div>