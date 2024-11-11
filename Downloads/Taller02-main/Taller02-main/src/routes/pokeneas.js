const express = require('express');
const router = express.Router();
const pokeneas = require('../data/pokeneasData');

// Ruta para retornar JSON con id, nombre, altura y habilidad de un Pokenea aleatorio
router.get('/json', (req, res) => {
  const randomPokenea = pokeneas[Math.floor(Math.random() * pokeneas.length)];
  const containerId = process.env.CONTAINER_ID || 'container_id_desconocido';
  res.json({
    id: randomPokenea.id,
    nombre: randomPokenea.nombre,
    altura: randomPokenea.altura,
    habilidad: randomPokenea.habilidad,
    containerId: containerId
  });
});

// Ruta para mostrar imagen y frase de un Pokenea aleatorio
router.get('/imagen', (req, res) => {
  const randomPokenea = pokeneas[Math.floor(Math.random() * pokeneas.length)];
  const containerId = process.env.CONTAINER_ID || 'container_id_desconocido';
  res.send(`
    <div style="text-align: center;">
      <img src="${randomPokenea.imagen}" alt="${randomPokenea.nombre}" width="200"/>
      <p><em>${randomPokenea.fraseFilosofica}</em></p>
      <p>Container ID: ${containerId}</p>
    </div>
  `);
});

module.exports = router;