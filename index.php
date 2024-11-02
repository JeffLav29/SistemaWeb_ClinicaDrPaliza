<?php
include "model/M_notificacion.php";
include "controller/C_notificacion.php";

$notificacionModel = new M_notificacion();
$notificacionControlador = new C_notificacion();
$notificacionControlador->manejarSolicitud();

$notificaciones = $notificacionModel->obtenerNotificaciones();

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
</head>

<body>

    <h1 class="text-center p-3">Cuenta con las Siguientes Notificaciones</h1>
    <div class="container d-flex flex-column align-items-center">
        <!-- Mostrar mensaje de éxito o error -->
        <?php if (isset($_GET['mensaje'])): ?>
            <div class="alert alert-success">
                <?php echo htmlspecialchars($_GET['mensaje']); ?>
            </div>
        <?php endif; ?>

        <div class="col-12 col-md-8 col-lg-6 mb-4">
            <!-- Tabla para mostrar los datos -->
            <table class="table">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">Mensaje</th>
                        <th scope="col">Fecha</th>
                        <th scope="col">Interactuar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($notificaciones as $notificacion): ?>
                        <tr>
                            <td><?php echo $notificacion->mensaje; ?></td>
                            <td><?php echo $notificacion->creado_en; ?></td>
                            <td>
                                <!-- Botones de editar y eliminar -->
                                <button class="btn btn-warning btn-sm" title="Editar">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <form action="controller/C_notificacion.php" method="POST" class="d-inline">
                                    <input type="hidden" name="id_notificacion" value="<?php echo $notificacion->id_notificacion; ?>">
                                    <input type="hidden" name="action" value="eliminar">
                                    <button type="submit" class="btn btn-danger btn-sm ms-2" title="Eliminar">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>

                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <div class="col-12 col-md-8 col-lg-6 mb-4">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#crearModal">
                Crear
            </button>
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
                    <form action="index.php" method="POST">
                        <div class="mb-3">
                            <label for="id_paciente" class="form-label">Id Paciente</label>
                            <input type="text" class="form-control" id="paciente_id" name="paciente_id" required>
                        </div>
                        <div class="mb-3">
                            <label for="mensaje" class="form-label">Mensaje</label>
                            <textarea class="form-control" name="mensaje" id="mensaje" rows="4" required
                                placeholder="Escribe tu mensaje aquí..."></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="fecha" class="form-label">Fecha</label>
                            <input type="date" class="form-control" id="programado_para" name="programado_para"
                                required>
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



    <script src="https://kit.fontawesome.com/c84c2127d2.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>