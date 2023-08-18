const express = require('express');
const app = express();
const port = 80;

app.get('/', (req, res) => {
  res.send('¡Hola, mundo!');
});

app.listen(port, () => {
  console.log(`Servidor web en ejecución en http://localhost:${port}`);
});

//Conexión

const mysql = require('mysql');

const connection = mysql.createConnection({
  host: 'nombre-del-host-de-la-base-de-datos',
  user: 'usuario',
  password: 'contraseña',
  database: 'nombre-de-la-base-de-datos',
});

connection.connect((error) => {
  if (error) {
    console.error('Error al conectarse a la base de datos', error);
  } else {
    console.log('Conexión exitosa a la base de datos');
  }
});

//Importación de rutas

const routes = require('./routes');

app.use(express.json());
app.use('/', routes);

