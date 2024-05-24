CREATE TABLE Cliente_has_Colonias (
Numero_cliente INT,
ID_Colonia INT,
Colonias_Asociacion_Nombre VARCHAR(100), 
PRIMARY KEY (Numero_cliente, ID_Colonia),
FOREIGN KEY (Numero_cliente) REFERENCES Cliente(Numero_cliente),
FOREIGN KEY (ID_Colonia) REFERENCES Colonias(Codigo),
FOREIGN KEY (Colonias_Asociacion_Nombre) REFERENCES Asociacion(Nombre) --
Clave foránea hacia Asociacion);