const express = require('express');
const router = express.Router();
const controller = require('./controllers');

router.get('/usuarios', controller.obtenerUsuarios);
router.post('/usuarios', controller.crearUsuario);
// Agrega más rutas según tus necesidades

module.exports = router;