<?php
include "model/M_notificacion.php";
include "controller/C_notificacion.php";
include 'model/M_medico.php';

$medicoModel = new M_medico();
$notificacionModel = new M_notificacion();
$notificacionControlador = new C_notificacion();
$notificacionControlador->manejarSolicitud();
$medicos = $medicoModel->obtenerMedicos();

$notificacionesPorPagina = 10;
$paginaActual = isset($_GET['pagina']) ? (int) $_GET['pagina'] : 1;
$totalNotificaciones = count($notificacionModel->obtenerNotificaciones());
$totalPaginas = ceil($totalNotificaciones / $notificacionesPorPagina);

$inicio = ($paginaActual - 1) * $notificacionesPorPagina;

$notificaciones = array_slice($notificacionModel->obtenerNotificaciones(), $inicio, $notificacionesPorPagina);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario con Modal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
        integrity="sha384-k6RqeWeci5ZR/Lv4MR0sA0FfDOMk0E5hE7gE1Y2Xn5gU2GCD+5wJ6VzMv+G2pO1D" crossorigin="anonymous">
    <link rel="stylesheet" href="style/styleNotificaciones.css">
</head>

<body>
    <header class="d-flex justify-content-between align-items-center p-3 bg-dark text-white">
        <h5 class="m-0">Bienvenido, Jefferson</h5>
        <div class="d-none d-md-flex">
            <a href="#" class="header-btn text-decoration-none me-4"><i class="fas fa-home"></i>Inicio</a>
            <a href="#" class="header-btn text-decoration-none me-4"><i class="fas fa-user"></i>Perfil</a>
            <a href="#" class="header-btn text-decoration-none"><i class="fas fa-sign-out-alt"></i>Cerrar Sesión</a>
        </div>

        <div class="dropdown d-md-none">
            <a class="header-btn" href="#" id="dropdownMenuLink" role="button" data-bs-toggle="dropdown"
                aria-expanded="false">
                <i class="fas fa-bars"></i>
            </a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                <li><a class="dropdown-item" href="#"><i class="fas fa-home"></i> Inicio</a></li>
                <li><a class="dropdown-item" href="#"><i class="fas fa-user"></i> Perfil</a></li>
                <li><a class="dropdown-item" href="#"><i class="fas fa-sign-out-alt"></i> Cerrar Sesión</a></li>
            </ul>
        </div>
    </header>

    <h1 class="text-center p-3">Cuenta con las Siguientes Notificaciones</h1>
    <div class="content-container">
        <div class="table-container col-12 col-md-8 col-lg-6 mb-4">
            <div class="mb-3" style="margin-left: -15px;">
                <strong></strong>
                <button type="button" class="btn btn-primary ms-3" data-bs-toggle="modal" data-bs-target="#crearModal">
                    Crear Nuevo
                </button>
            </div>
            <table class="table">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">Motivo</th>
                        <th scope="col">Mensaje</th>
                        <th scope="col">Fecha</th>
                        <th scope="col">Interactuar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($notificaciones as $notificacion): ?>
                        <tr>
                            <td><?php echo $notificacion->motivo ?></td>
                            <td><?php echo $notificacion->mensaje; ?></td>
                            <td><?php echo $notificacion->programado_para; ?></td>
                            <td>
                                <button class="btn btn-warning btn-sm" title="Editar" data-bs-toggle="modal"
                                    data-bs-target="#editarModal<?php echo $notificacion->idnotificacion; ?>">
                                    <i class="fas fa-edit"></i>
                                </button>

                                <form action="index.php" method="GET" class="d-inline">
                                    <input type="hidden" name="accion" value="eliminar">
                                    <input type="hidden" name="idnotificacion"
                                        value="<?php echo $notificacion->idnotificacion; ?>">
                                    <button type="submit" class="btn btn-danger btn-sm ms-2" title="Eliminar"
                                        onclick="return confirm('¿Estás seguro de que deseas eliminar esta notificación?');">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>

                                <div class="modal fade" id="editarModal<?php echo $notificacion->idnotificacion; ?>"
                                    tabindex="-1"
                                    aria-labelledby="editarModalLabel<?php echo $notificacion->idnotificacion; ?>"
                                    aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form action="index.php" method="POST">
                                                <div class="modal-header">
                                                    <h5 class="modal-title"
                                                        id="editarModalLabel<?php echo $notificacion->idnotificacion; ?>">
                                                        Editar Notificación</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Cerrar"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <input type="hidden" name="accion" value="editar">
                                                    <input type="hidden" name="idnotificacion"
                                                        value="<?php echo $notificacion->idnotificacion; ?>">
                                                        
                                                    <div class="mb-3">
                                                        <label for="motivo<?php echo $notificacion->idnotificacion; ?>"
                                                            class="form-label">Motivo</label>
                                                        <input type="text" class="form-control"
                                                            id="motivo<?php echo $notificacion->idnotificacion; ?>"
                                                            name="motivo"
                                                            value="<?php echo htmlspecialchars($notificacion->motivo); ?>"
                                                            required>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="medico_id<?php echo $notificacion->idnotificacion; ?>"
                                                            class="form-label">Seleccionar Médico</label>
                                                        <select class="form-select"
                                                            id="medico_id<?php echo $notificacion->idnotificacion; ?>"
                                                            name="medico_id" required>
                                                            <option value="" disabled>Seleccione un médico</option>
                                                            <?php foreach ($medicos as $medico): ?>
                                                                <option value="<?php echo $medico->idmedico; ?>" <?php echo ($medico->idmedico == $notificacion->medico_id) ? 'selected' : ''; ?>>
                                                                    <?php echo htmlspecialchars($medico->nombre . ' ' . $medico->apellido); ?>
                                                                </option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="mensaje<?php echo $notificacion->idnotificacion; ?>"
                                                            class="form-label">Mensaje</label>
                                                        <input type="text" class="form-control"
                                                            id="mensaje<?php echo $notificacion->idnotificacion; ?>"
                                                            name="mensaje"
                                                            value="<?php echo htmlspecialchars($notificacion->mensaje); ?>"
                                                            required>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label
                                                            for="programado_para<?php echo $notificacion->idnotificacion; ?>"
                                                            class="form-label">Programado Para</label>
                                                        <input type="datetime-local" class="form-control"
                                                            id="programado_para<?php echo $notificacion->idnotificacion; ?>"
                                                            name="programado_para"
                                                            value="<?php echo date('Y-m-d\TH:i', strtotime($notificacion->programado_para)); ?>"
                                                            required>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Cancelar</button>
                                                    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>


                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <nav aria-label="Paginación">
                <ul class="pagination justify-content-center">
                    <li class="page-item <?php if ($paginaActual <= 1)
                        echo 'disabled'; ?>">
                        <a class="page-link" href="?pagina=<?php echo $paginaActual - 1; ?>" aria-label="Anterior">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                    <?php for ($i = 1; $i <= $totalPaginas; $i++): ?>
                        <li class="page-item <?php if ($paginaActual == $i)
                            echo 'active'; ?>">
                            <a class="page-link" href="?pagina=<?php echo $i; ?>"><?php echo $i; ?></a>
                        </li>
                    <?php endfor; ?>
                    <li class="page-item <?php if ($paginaActual >= $totalPaginas)
                        echo 'disabled'; ?>">
                        <a class="page-link" href="?pagina=<?php echo $paginaActual + 1; ?>" aria-label="Siguiente">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                </ul>
            </nav>

        </div>
    </div>


    <div class="modal fade" id="crearModal" tabindex="-1" aria-labelledby="crearModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="crearModalLabel">Crear Nueva Notificación</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="index.php" method="POST" onsubmit="setDefaultTimeIfNeeded()">
                        <div class="mb-3">
                            <label for="id_paciente" class="form-label">Id Paciente</label>
                            <input type="text" class="form-control" id="paciente_id" name="paciente_id" required>
                        </div>
                        <div class="mb-3">
                            <label for="motivo" class="form-label">Motivo</label>
                            <input type="text" class="form-control" id="motivo" name="motivo" required>
                        </div>
                        <div class="mb-3">
                            <label for="medico_id" class="form-label">Médico</label>
                            <select class="form-select" id="medico_id" name="medico_id" required>
                                <option value="">Seleccione un médico</option>
                                <?php foreach ($medicos as $medico): ?>
                                    <option value="<?= $medico->idmedico ?>">
                                        <?= $medico->nombre . ' ' . $medico->apellido ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="mensaje" class="form-label">Mensaje</label>
                            <textarea class="form-control" name="mensaje" id="mensaje" rows="4" required
                                placeholder="Escribe tu mensaje aquí..."></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="programado_para" class="form-label">Fecha y Hora</label>
                            <input type="datetime-local" class="form-control" id="programado_para"
                                name="programado_para" required>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <script>
        function setDefaultTimeIfNeeded() {
            const dateTimeField = document.getElementById("programado_para");
            if (dateTimeField.value === "") {
                const today = new Date().toISOString().slice(0, 10);
                dateTimeField.value = `${today}T00:00`;
            }
        }
    </script>




    <script src="https://kit.fontawesome.com/c84c2127d2.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>