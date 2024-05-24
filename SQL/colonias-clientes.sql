CREATE TABLE Colonia_has_Lider (
ID_Colonia INT,
CI_Lider INT,
Colonias_Asociacion_Nombre VARCHAR(100), -
PRIMARY KEY (ID_Colonia, CI_Lider),
FOREIGN KEY (ID_Colonia) REFERENCES Colonias(Codigo),
FOREIGN KEY (CI_Lider) REFERENCES Lideres_de_grupo(CI),
FOREIGN KEY (Colonias_Asociacion_Nombre) REFERENCES Asociacion(Nombre) --
Clave foránea hacia Asociacion);