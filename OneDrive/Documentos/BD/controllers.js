const connection = require('./db');

exports.obtenerUsuarios = (req, res) => {
  connection.query('SELECT * FROM usuarios', (error, results) => {
    if (error) {
      console.error('Error al obtener usuarios', error);
      res.status(500).send('Error del servidor');
    } else {
      res.json(results);
    }
  });
};

exports.crearUsuario = (req, res) => {
  const { nombre, correo } = req.body;
  const nuevoUsuario = { nombre, correo };

  connection.query('INSERT INTO usuarios SET ?', nuevoUsuario, (error) => {
    if (error) {
      console.error('Error al crear usuario', error);
      res.status(500).send('Error del servidor');
    } else {
      res.send('Usuario creado exitosamente');
    }
  });
};