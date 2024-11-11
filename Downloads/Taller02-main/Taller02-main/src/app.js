const express = require('express');
const dotenv = require('dotenv');
const pokeneasRouter = require('./routes/pokeneas');

dotenv.config();
const app = express();

app.use('/pokeneas', pokeneasRouter);

const PORT = process.env.PORT || 3000;
app.listen(PORT, () => console.log(`Servidor escuchando en el puerto ${PORT}`));